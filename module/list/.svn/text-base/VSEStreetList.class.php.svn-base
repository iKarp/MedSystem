<?php

/*      VSEStreetList
*		создаеться объект класса VSEStreetList($array_fields,$where) передаються поля для выборки, и код для поиска, переданный из поиска по городу, для вывода списка улиц
*		select() выполнить выборку
**/

class VSEStreetList extends VSEObjectList{

    protected  $db_table = "kladr_street";

    function __construct ($array_fields,$where){

		parent::__construct($array_fields);
		$where = substr($where,0,11);
		$where = "code LIKE '".$where."______'";
		parent::add_filter($where,'');

	}


}
?>