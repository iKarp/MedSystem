<?php
    
class VSETable {
    
    function __construct($tbl) {
		
		global $db;
		
		//$this->column = array();
		$db->select_to_object("SELECT * FROM core_tables WHERE `name` = '".$tbl."'",&$this);
		$this->columns = $db->select("SELECT * FROM core_tables_data WHERE `table_id` = ".$this->id." ORDER BY indx");
		//foreach ($columns as $column) {
		//	$this->column[$column->indx]->name = $column->name;
		//}
        
    }
	
	function show($filter = false) {
	
		global $db;
		global $VSECore;
		
		if (!isset($this->name)) {return "Error: no table in database";}
		
		$rows_html = array(); $i = 0;
		
		$query = 'SELECT * FROM '.$this->table;
		if ($filter) {
			$term = array();
			foreach ($filter as $column=>$value) {
				if (!empty($value)) {
					switch ($column) {
						case 'bdate': 	$term[] = sprintf("`cdate` > '%s'",$value); break;
						case 'edate': 	$term[] = sprintf("`cdate` < '%s'",$value); break;
						default: 		$term[] = sprintf("`%s` = '%s'",$column,$value); break;
					}					
				}
			}
			$query .= " WHERE ".implode(" AND ",$term);
		}
		//echo $query;
		if ($data = $db->select($query)) {
			foreach ($data as $item) {
				$rows[$i]['id'] = $item['id'];
				$rows[$i]['html'] = '';
				foreach ($this->columns as $column) {
					switch ($column['type']) {
						case 'date': 	$rows[$i]['html'] .= '<td>'.date('d.m.Y',strtotime($item[$column['name']])).'</td>'; break;
						default: 		$rows[$i]['html'] .= '<td>'.$item[$column['name']].'</td>'; break;
					}				
				}
				$i++;
			}
		}
		
		$VSECore->output->assign('table',$this->name);
		$VSECore->output->assign('columns',$this->columns);
		$VSECore->output->assign('columns_count',count($this->columns));
		$VSECore->output->assign('rows',$rows);
		
		return $VSECore->output->get_tpl_output('table.tpl');
	
	}
    
}

?>