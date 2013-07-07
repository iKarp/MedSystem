<?php
/*      VSEObjectList
*		базовый класс для всех List
*		присоздание объекта класса VSEObjectList($array_fileds) передаються поля для выборки
*		add_filter($where,$order) переменной $where передаться условие ОДНО для выбора например 'name LIKE '$name%'' , переменной $order передаться поле ОДНО для сортировки например 'name'
*       select() выполнить выборку
**/
class VSEObjectList {    protected $where = "";
    protected $order = "";
    protected $fields = "";

	function __construct ($array_fields){        if(is_array($array_fields)){        	$this->fields = implode(",",$array_fields);
        }
        else{        	$this->fields = $array_fields;
        }

	}

	public function add_filter ($where = "",$order = "") {
		if(!empty($where)){			if(empty($this->where)){				$this->where = " WHERE ".$where;
			}
			else{				$this->where .= $where;
			}
		}
		if(!empty($order)){        	$this->order = " ORDER BY ".$order;
        }
	}

	public function select(){		global $db;		$query = "SELECT ".$this->fields." FROM ".$this->db_table." ".$this->where." ".$this->order."";		return $db->select($query);
	}
}
?>