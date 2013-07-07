<?php
/*      VSEObjectList
*		������� ����� ��� ���� List
*		����������� ������� ������ VSEObjectList($array_fileds) ����������� ���� ��� �������
*		add_filter($where,$order) ���������� $where ���������� ������� ���� ��� ������ �������� 'name LIKE '$name%'' , ���������� $order ���������� ���� ���� ��� ���������� �������� 'name'
*       select() ��������� �������
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