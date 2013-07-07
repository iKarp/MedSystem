<?php

require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");

header ("Content-Type: content=text/html; charset=Windows-1251");

$action = $_GET['action'];

if ($action == "search_diagnosis") {

	if (!empty ($_GET['term'])) {

		$diag = iconv ('utf-8','windows-1251',$_GET['term']);
		$items = $db->select("select * from class_mkb where name like '%$diag%' and node_count = 0 limit 10");

		if ($items) {
			foreach ($items as $item) {
                $label = iconv ('Windows-1251','UTF-8',$item['code']." - ".$item['name']);
				$name = iconv ('Windows-1251','UTF-8',$item['name']);
				$r[] = array ('id'=>$item['code'],'value'=>$name,'label'=>$label);
			}
		}
	}
    if ($r)	echo json_encode($r); else echo "[ ]";

}

?>
