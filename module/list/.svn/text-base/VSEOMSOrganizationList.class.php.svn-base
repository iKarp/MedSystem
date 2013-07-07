<?php

class VSEOMSOrganizationList extends VSEObjectList{

    protected  $db_table = "core_oms_organizations";

    function selectType($var){    	global $db;
		$query = "SELECT * FROM core_organizations_type WHERE organization_type_id = '".$var."'";
		return $db->select($query);
    }

}
?>