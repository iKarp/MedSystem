<?php
	define (ARM_NAME,"main");
	require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");
	$VSECore->CheckAuth();
	$VSECore->InitArm(ARM_NAME);

	if (isset($_POST['pf'])) echo stripslashes($_POST['pf']);
	else echo 'Error: No report!!!!!';
	
?>