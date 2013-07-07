<?php

	define ('ARM_NAME',"main");

	require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");
	
	$text = VSECore::UTF2Win1251($_REQUEST['term']);
    $table = VSECore::UTF2Win1251($_REQUEST['list']);
	
    $query = "SELECT `id`,`name` FROM $table WHERE `name` LIKE '%$text%'";
    $items = $db->select($query);
    
    if ($items) {
        
        foreach ($items as $item) {
            
			$a['id'] = $item['id'];
            $a['label'] = VSECore::Win12512UTF8($item['name']);
            $r[] = $a;
        }
        
        echo json_encode($r);
        
    } 
	else echo 0;

?>
