<?php
/*
*		VSEmkb10List
*		при создании new VSEmkb10List($array) $array содержит масив полей для выборки, остаеться выполнить select() для выбора классов
*		после чего нужно передать функции selectPod($code) $code - код класса для раскрытия блока
*		потом так же передать этой же функции код для раскрытия   диагнозов,и еще раз для выбора
*		иерархия вот такая располложеная на wiki http://ru.wikipedia.org/wiki/%D0%9C%D0%9A%D0%91-10:_%D0%9A%D0%BB%D0%B0%D1%81%D1%81_I
*
**/

class VSEmkb10List extends VSEObjectList{	    protected $db_table = "class_mkb10";

    function __construct ($array_fields){
        parent::__construct($array_fields);
        $where = "parent_id is null";
        $order = "id";
        parent::add_filter($where,$order);

	}

    function selectPod($code){    	global $db;
    	$query = "SELECT * FROM ".$db_table." parent_id='".$code."' ORDER BY code";
		return $db->select($query);
    }


}
?>