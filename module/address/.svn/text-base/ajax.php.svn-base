<?php


require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");

$VSECore->LoadModule ('list');

header ("Content-Type: content=text/html; charset=Windows-1251");

$action = $_GET['action'];

if ($action == "search_town") {

	if (!empty ($_GET['term'])) {

		$str = iconv ('utf-8','windows-1251',$_GET['term']);
		$list  =  new VSEInteractiveList("*",$str);
		$items = $list->FullAdress ();

	//	print_r($items);

		if ($items) {
			foreach ($items as $item) {

                $namefull = $item['socr'].". ".$item['name'];

                if (($item['obl'] == $item['ray'])) {
                    $name_label = iconv ('Windows-1251','UTF-8',$item['obl']." מבכאסעü, <b>".$item['socr'].". ".$item['name']."</b>");
                } else {
                    $name_label = iconv ('Windows-1251','UTF-8',$item['obl']." מבכאסעü, ".$item['ray']." נאימם, <b>".$namefull."</b>");
                }

				$name = iconv ('Windows-1251','UTF-8',$namefull);
				$r[] = array ('id'=>$item['code'],'value'=>$name,'label'=>$name_label);
			}
		}
	}
    if ($r)	echo json_encode($r); else echo "[ ]";
	//$db->debug_output("\n");
}

elseif ($action == "search_street") {
		if (!empty($_GET['town_id']) && !empty($_GET['term'])) {

				$str = iconv ('utf-8','windows-1251',$_GET['term']);

				/*$inter = new VSEStreetList("*",$_GET['town_id']);
				$where = " AND name LIKE '".$str."%'";
				$inter->add_filter($where,'');
				$items = $inter->select();*/
//				$towncode = $_GET['town_id'];
				$towncode = substr($_GET['town_id'],0,11);  //
                $items = $db->select("SELECT * FROM kladr_street WHERE code LIKE '$towncode%' AND name LIKE '$str%'");
				//$items = $db->select ("SELECT * FROM kladr_street WHERE code = '".$_GET['town_id']."' AND name LIKE '$str%'");
				//print_r($items);
				//$db->debug_output ("\n");
				if ($items) {
					foreach ($items as $item) {
						$name_label = $name  = iconv ('Windows-1251','UTF-8',$item['socr'].". ".$item['name']);
						//$name = iconv ('Windows-1251','UTF-8',$item['name']);
						$r[] = array ('id'=>$item['code'],'value'=>$name,'label'=>$name_label);
					}
				}
				if ($r)	echo json_encode($r); else echo "[ ]";
		} else {
			echo "Not enouth params";
		}
} 

elseif ($action == "search_org") {
    if (!empty($_GET['term'])) {
        $str = iconv ('utf-8','windows-1251',$_GET['term']);
        $items = $db->select("SELECT * FROM `core_organizations` WHERE `agreement_number` LIKE '$str%' AND name != '' AND agreement_date !='0000-00-00' ORDER BY name");
        if ($items) {
            foreach ($items as $item) {
				$org_name = iconv ('Windows-1251','UTF-8',$item['name']);
				$agr_number = iconv ('Windows-1251','UTF-8',$item['agreement_number']);
                $label = iconv('Windows-1251','UTF-8',$item['name']." (".$item['agreement_number']." מע ".$item['agreement_date'].")");
				$r[] = array ('id'=>$item['organization_id'],'value'=>$agr_number,'label'=>$label,'name'=>$org_name,'agreement_date'=>$item['agreement_date'],'oms_organization_id'=>$item['oms_organization_id']);
            }
            echo json_encode($r);
        } 
		else echo "[ ]";
    }
}
elseif($action == "search_parent") {
	if (!empty($_GET['term'])) { 
        $fio = split(" ",iconv('UTF-8','Windows-1251',$_GET['term']));       
        $items = $db->select("SELECT * FROM core_persons where `fname` like '$fio[0]%' and `mname` like '$fio[1]%' and `sname` like '$fio[2]%'");
		if ($items) {
            foreach ($items as $item) {
				$fname = iconv ('Windows-1251','UTF-8',$item['fname']);
				$mname = iconv ('Windows-1251','UTF-8',$item['mname']);
                $label = iconv('Windows-1251','UTF-8',$item['fname']." ".$item['mname']." ".$item['sname'].")");
				$r[] = array ('id'=>$item['person_id'],'label'=>$label,'name'=>$label);
            }
            echo json_encode($r);
        } 
		else echo "[ ]";
	}
}

?>
