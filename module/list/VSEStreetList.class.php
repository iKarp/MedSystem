<?php

/*      VSEStreetList
*		���������� ������ ������ VSEStreetList($array_fields,$where) ����������� ���� ��� �������, � ��� ��� ������, ���������� �� ������ �� ������, ��� ������ ������ ����
*		select() ��������� �������
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