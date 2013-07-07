<?php

class VSEPrice {
    
    private $child_ids;
    public $id;    
    
    function __construct($id) {
        global $db;
        $this->id = $id;
        $db->select_to_object("SELECT * FROM price_data WHERE id = ".$this->id,&$this);
        $this->child_ids = array();
        $this->fcost = $db->select_item("SELECT GetProductServicePrice(".$this->id.")");
		$this->vcost = $db->select_item("SELECT GetProductPrice(".$this->id.")");
		
        $this->materials = $db->select("SELECT
                 production_materials.id
                 ,production_materials.name
                 ,production_materials.price
                 ,price_per_material.material_count
                 ,price_per_material.relation_id 
                 ,production_measurement.name as measurement_name
                FROM
                 price_per_material
                 
                JOIN production_materials ON (production_materials.id = price_per_material.material_id)
                
                LEFT JOIN production_measurement ON (production_measurement.id = production_materials.measurement_id)
                 
                WHERE price_id = ".$this->id);
        $this->works = $db->select("SELECT
                 production_works.id
                 ,production_works.name
                 ,production_works.price
                 ,production_works.measurement_name
                 ,price_per_works.relation_id
                 ,price_per_works.work_count as material_count               
                FROM
                 price_per_works
                 
                JOIN production_works ON (production_works.id = price_per_works.work_id)
                
               
                 
                WHERE price_id = ".$this->id);        
        
        $this->prices = $db->select('SELECT 
				 price_per_price.relation_id
				 ,price_per_price.price_id as id
				 ,price_per_price.price_count as price_count
				 ,price_data.name
				 ,GetProductPrice(price_id) as price
				FROM 
				 price_per_price
				
				JOIN price_data ON (price_data.id = price_per_price.price_id)
				
				WHERE `parent_price_id` = '.$this->id);
    }
    
    
    static function new_item($data) {
        
        global $dbw;
        
        $fields = array("is_folder","name","parent_id");
        
        return $dbw->insert_from_object("price_data",$fields,$data);
        
    }
    
    static function copy_price($from) {
    	global $dbw;
    	
    	$q_price = "INSERT INTO price_data (`is_folder`,`name`,`price`,`parent_id`,`is_active`,`indx`,`code`,`comment_enabled`,`amortization`,`accruals_zp`,`oncost`,`tax`,`balance`,`purchase`,`efficiency`,`price_cost`)
(SELECT `is_folder`,CONCAT(`name`,' копия'),`price`,`parent_id`,`is_active`,`indx`,`code`,`comment_enabled`,`amortization`,`accruals_zp`,`oncost`,`tax`,`balance`,`purchase`,`efficiency`,`price_cost` FROM price_data WHERE id = $from);";
    	
    	$new_id = $dbw->insert($q_price);
    	
    	if (!$new_id) {return false;}
    	$q = array(
	    	 "INSERT INTO price_per_material (`price_id`,`material_id`,`material_count`) (SELECT $new_id,material_id,material_count FROM price_per_material WHERE price_id = $from)"
	    	,"INSERT INTO price_per_works (`price_id`,`work_id`,`work_count`) (SELECT $new_id,work_id,work_count FROM price_per_works WHERE price_id = $from)"
	    	,"INSERT INTO price_per_price (`parent_price_id`,`price_id`,`price_count`) (SELECT $new_id,`price_id`,`price_count` FROM price_per_price WHERE parent_price_id = $from)"
    	);
    	
    	foreach ($q as $query) {
    		$dbw->q($query);
    	}
    	
    	return true;    	
    }
    
    
    static function get_work($id) {
    	global $db;
    	return $db->select_row('SELECT * FROM production_works WHERE id = '.$id);
    }
    
	static function save_work($data) {
    	global $dbw;    	
    	$fields = array('name','measurement_id','hours');
    	return $dbw->update_from_array('production_works_hours', $fields, 'id = '.$data['id'], $data);    	
    }
    
    static function save_material($data) {
    	global $dbw;    	
    	$fields = array('name','measurement_id','price');
    	return $dbw->update_from_array('production_materials', $fields, 'id = '.$data['id'], $data);
    }
    
    private function get_childs_ids($item_id) {
        
        global $db;
        
        $ids = $db->select_column("SELECT id FROM price_data WHERE parent_id = $item_id");
        
        if ($ids) {
            
            $this->child_ids = array_merge($this->child_ids,$ids);
            
            foreach ($ids as $id) {
                $this->get_childs_ids($id);
            }
            
        }  
    }
    
    function delete() {
        
        global $dbw;
        
        $this->get_childs_ids($this->id);
        
        $ids = array_merge($this->child_ids,array($this->id));
        
        return $dbw->q("DELETE FROM price_data WHERE id IN (".implode(",",$ids).")");
    }
    
    function change_state() {
        
        global $dbw;
        
        $state = (int) ! $this->is_active;
        
        return $dbw->q("UPDATE price_data SET is_active = $state WHERE id=".$this->id);
    }
    
    function save() {
        global $dbw;
        
        $fields = array ("name","code","comment_enabled","parent_id");
        
		return 	$dbw->update_from_object ("price_data",$fields,"id=".$this->id,$this);
    }
    
    function cost() {
    	global $db;
    	return $db->select_item('SELECT GetProductPrice('.$this->id.');');
    }
    
    function cost_pre_print() {
    	global $db;
    	return $db->select_item('SELECT GetProductServicePrice('.$this->id.');');		    	    	
    }
    
    
    
    
}


?>
