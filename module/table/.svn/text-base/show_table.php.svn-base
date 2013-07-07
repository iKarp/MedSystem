<?php

	if (!empty($_POST['table'])) {
		require_once(CORE_ROOT."/main/VSETable.class.php");
		$table = new VSETable($_POST['table']);	
		if (!empty($_POST['filter'])) echo $table->show($_POST['filter']); 
		else echo $table->show();
	}
	else echo 'Error: no table name';

?>
