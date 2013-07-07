<?php

	$debug = "DEBUG:<br>";

	define ("ARM_NAME","main");
	require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");
	$VSECore->CheckAuth();
	//$VSECore->InitArm();

	//$VSECore->output->smarty->compile_dir = './templates_c/';
	$sections = $db->select("CALL GetUserSections(".$VSECore->user->user_id.");");
	$VSECore->output->assign('user_sections',$sections);

	if (isset($_GET['section'])) {
	
		$debug .= "Section: ".$_GET['section']."<br>";
	
		$sname = $_GET['section'];
		$spath = '/main/sections/'.$sname.'/';
		$sfile = '/main/sections/'.$sname.'/'.$sname;
		
		$section['js'] = array();
		$section['css'] = array();
		$dialogs = array();
		
		if (file_exists(CORE_ROOT.$sfile.'.js')) {$section['js'][] = $sfile.'.js';}
		if (file_exists(CORE_ROOT.$sfile.'.css')) $section['css'][] = $sfile.'.css';
		
		if ($modules = $VSECore->LoadSection($_GET['section'])) {
			
			$debug .= "LoadSection: OK<br>";
			foreach ($modules as $module) {
				
				if ($module['type'] == "dlg") {			
					$dialogs[] = $module['module'];
					$file = '/main/dialogs/'.$module['module'].'/dlg_'.$module['module'];
				}
				elseif ($module['type'] == "el")		$file = '/main/elements/'.$module['module'].'/'.$module['module'];
				elseif ($module['type'] == "js")		$file = '/static/javascript/'.$module['module'];
				
				$debug .= $file.'<br>';
				if (file_exists(CORE_ROOT.$file.'.js')) $section['js'][] = $file.'.js';
				if (file_exists(CORE_ROOT.$file.'.css')) $section['css'][] = $file.'.css';
				
			}
			
		}
		/*if ($section['element']) foreach ($section['element'] as $el) {
			if ($VSECore->LoadElement($el['type'])) {
				if ($element['js']) $section['js'] = array_merge($section['js'],$element['js']);
				if ($element['css']) $section['css'] = array_merge($section['css'],$element['css']);
			}
		}*/
		
		if ($section['js']) array_unique($section['js']);
		if ($section['css']) array_unique($section['css']);
		
		$VSECore->output->assign('section',$section);
	
	} 
	else $section['title'] = 'Главный модуль';	

	$VSECore->output->assign('user',$VSECore->user);
	$VSECore->output->fetch('header.tpl');

	// Запуск php скрипта инициализирующего секцию
	if (file_exists(CORE_ROOT.$spath.'actions/'.$sname.'.php')) {
		$debug .= "InitSectionPHP: OK<br>";
		include(CORE_ROOT.$spath.'actions/'.$sname.'.php');
		$VSECore->output->fetch(CORE_ROOT.$spath.'templates/'.$sname.'.tpl');
	}
	// если его нет, то показываем вкладки
	else {
		$tabs = $db->select("CALL GetTabs(".$VSECore->user->user_id.",'".$_GET['section']."');");
		$VSECore->output->assign('tabs',$tabs);
		$VSECore->output->assign('tabs_count',count($tabs));
		$VSECore->output->fetch('main.tpl');
	}

	//$VSECore->output->assign('debug',$debug);
	$VSECore->output->assign('dialogs',$dialogs);
		$VSECore->output->fetch('footer.tpl');
	
	if (isset($_GET['section'])) $VSECore->output->smarty->template_dir = CORE_ROOT.$spath.'templates/';
	
	$VSECore->output->body();
	
	//$db->debug_output();

?>
