<?php
//---------------------------------------//
// Основной контроллер аяксовых запросов //
//---------------------------------------//

define ("ARM_NAME","main");
require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");
$VSECore->CheckAuth();
//$VSECore->InitArm();
//header ("Content-Type: content=text/html; charset=Windows-1251");
global $r;




// Если запросили только тип действия ----
if (isset($_REQUEST['gettype'])) { 	
	echo json_encode($db->select_row("select `type`,`result_type` from core_actions where `name` = '".$_REQUEST['action']."'"));	
	exit;
};
//----------------------------------------

// Если печатается форма -----------------
//if (isset($_REQUEST['print'])) { 	
//	$_REQUEST['action'] = 'print_'.$_REQUEST['print']
//};
//----------------------------------------

// Выполнение действия -------------------
$action = $db->select_row("select * from core_actions where `name` = '".$_REQUEST['action']."'");
if ($action) {
	if ($VSECore->user->check_role_access(array($action['role']))) {
		$file = "./".$action['path'].$action['name'].".php";
		if (file_exists($file)) require_once($file);
		else $r['error'] = "Нет исполняемого файла";		          
	}
	else $r['error'] = "Недостаточно прав";
}
else $r['error'] = "Неправильное действие";
//----------------------------------------

// Логирование ---------------------------
if ($action['event'] != "") {
	$params = '';
	$data = VSECore::UTF2Win1251($_REQUEST);
	foreach ($data as $key => $value) $params .= $key.'='.$value.'  ';
	if ($r['error']) 
		$VSECore->events->addevent(ARM_NAME,VSE_MSG_ERR,$action['event'].". Ошибка - ".$r['error'].". Параметры - ".$params,$VSECore->user->user_id);
	else 
		$VSECore->events->addevent(ARM_NAME,VSE_MSG_NOTIFY,$action['event'].". Параметры - ".$params ,$VSECore->user->user_id);
}
//----------------------------------------

if ($r['error']) $r['error'] = $VSECore->Win12512UTF8($r['error']);
if ($r['html']) $r['html'] = $VSECore->Win12512UTF8($r['html']);

if ($r) echo json_encode($r);

?>