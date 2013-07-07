<?

$s_name = 'dlg_template';
$dir = '/main/dialogs/template/';

global $dlg;

$dlg = array(
		'js'=>array($dir.$s_name.'.js'
			//,'OTHER.js'
			)
		,'tpl'=>CORE_ROOT.$dir.$s_name.'.tpl'
		,'title'=>'Template_title'
	);

?>