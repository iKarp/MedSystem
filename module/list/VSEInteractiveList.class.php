<?php
/**     VSEInteractiveList
* 		пример использования
*		вывод по запросу LIKE
*		$array_fields = array("name","socr","code");
*		$where = $_POST['value'];
*		$inter = new VSEInteractiveList($array_fields,$where);
*		$order = "name";*
*		$inter->add_filter('',$order);
*       $find = $inter->select();
*       $VSECore->output->assign("find",$find);
*****************************************
*		при создание объекта new VSEInteractiveList($array_fileds,$where) передаються массив полей для выборки, и условие выбора , то есть в данном случае значения из поля ввода ищеться при помощи LIKE , передаються начальные буквы
*		select() выполнить выборку
*		selectCity($code) возвращает имя города по переданному коду
*		selectRayon($code) возвращает имя район по переданному коду
*		selectOblast($code) возвращает имя области по переданному коду
********************************************
*		FullAdress(); - возвращет полный адрес
*		$inter = new VSEInteractiveList("*",$_POST['search_value']);
*		$find = $inter->FullAdress();
*		$VSECore->output->assign("find",$find);
*/

class VSEInteractiveList extends VSEObjectList{

    protected $db_table = "kladr_kladr";
    protected $str = "";

    function __construct ($array_fields,$where){
        parent::__construct($array_fields);
        $this->str = $where;
	}

	function FullAdress(){		global $db;

		$notin = "'Респ','край','обл','Аобл','округ','АО','р-н'";
		$myrow = $db->select("SELECT ".$this->fields." FROM ".$this->db_table." WHERE name LIKE '".$this->str."%' AND socr  NOT IN (".$notin.") ORDER BY priority DESC");

        if(is_array($myrow)){
       		 /*  старый варинт
	        foreach($myrow as &$row){	        	// выбор области
	        	$code1 = substr($row['code'],0,2);
	        	$result1 = $db->select_item("SELECT name FROM ".$this->db_table." WHERE code = '".$code1."00000000000'");
	        	$row['obl'] = $result1;
	        	// выбор район
	        	$code2 = substr($row['code'],0,5);
	        	$result2 = $db->select_item("SELECT name FROM ".$this->db_table." WHERE code = '".$code2."00000000'");
	        	$row['ray'] = $result2;
	        }            */
	        return $myrow;
	     }
	     else{	     	return false;
	     }

	}
    function address($code){    	 global $db;    	$code = trim($code);    	$var = substr($code,8,-2);
    	if($var=='000'){
			$code1 = substr($code,0,8);
			$code2 = substr($code,0,15);
			$query = "SELECT CONCAT_WS(' ',socr,name) AS street  FROM kladr_street WHERE code = '".$code2."00'";
			$myrow['street'] = $db->select($query);
			$query = "SELECT CONCAT_WS(' ',socr,name) AS city FROM kladr_kladr WHERE code = '".$code1."00000'";
			$myrow['city'] = $db->select($query);
			return $myrow;

    	}
    	else{
			$code1 = substr($code,0,11);
			$code2 = substr($code,0,15);
			$query = "SELECT CONCAT_WS(' ',socr,name) AS street  FROM kladr_street WHERE code = '".$code2."00'";
			$myrow['street'] = $db->select($query);
			$query = "SELECT CONCAT_WS(' ',socr,name) AS city FROM kladr_kladr WHERE code = '".$code1."00'";
			$myrow['city'] = $db->select($query);
			return $myrow;
    	}
    }
    /*
	function selectCity($code){
		global $db;		$code = substr($code,0,8);
		$query = "SELECT name, code FROM ".$this->db_table." WHERE code = '".$code."00000'";
		return $db->select($query);

	}
	function selectRayon($code){		global $db;
		$code = substr($code,0,5);
		$query = "SELECT name, code FROM ".$this->db_table." WHERE code = '".$code."00000000'";
		return $db->select($query);
	}
	function selectOblast($code){		global $db;
		$code = substr($code,0,2);

		$query = "SELECT name, code FROM ".$this->db_table." WHERE code = '".$code."00000000000'";
		return $db->select($query);
	}  */
}
?>
