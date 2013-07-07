<?php
define (ARM_NAME,"main");
require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");
$VSECore->CheckAuth();
//$VSECore->InitArm();
header ("Content-Type: content=text/html; charset=Windows-1251");

$path = $_SERVER['DOCUMENT_ROOT']."/main/dialogs/TEMPLATE/";

if (isset($_REQUEST['action'])) { $action=$_REQUEST['action']; } else {echo 'Wrong action'; exit;};

if($action == "save"){
    //if ($VSECore->user->check_role_access(array(""))) {
	    
		// SAVE CODE HERE
		
		// LOG EVENTS
        $event_type = /*____*/ ? VSE_MSG_NOTIFY : VSE_MSG_ERR;
        $VSECore->events->addevent(ARM_NAME,$event_type,"_____EVENT____",$VSECore->user->user_id);
        
	//}
	//else $r['error'] = $VSECore->Win12512UTF8(VSE_MSG_DENY);
	//echo json_encode($r);
}
elseif($action == "open"){
	
	// PRELOAD CODE HERE
	
	$VSECore->output->fetch($path.'dlg_TEMPLATE.tpl');
	$VSECore->output->body();
}


?>