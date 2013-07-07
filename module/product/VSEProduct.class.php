<?php

class VSEProduct {
    
    public $id;
    
    function __construct($id) {
        global $db;
        $this->id = $id;
        $db->select_to_object("SELECT * FROM price_data WHERE id = ".$id,&$this);
        
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
                 ,price_per_works.relation_id
                 ,price_per_works.work_count as material_count
                 ,production_measurement.name as measurement_name
                FROM
                 price_per_works
                 
                JOIN production_works ON (production_works.id = price_per_works.work_id)
                
                LEFT JOIN production_measurement ON (production_measurement.id = production_works.measurement_id)
                 
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
    
    function save($data) {
        global $dbw;
        //$fields = array ("name","price","code","comment_enabled","amortization",'accruals_zp','oncost','tax','efficiency','price_cost');
        $fields = array ("name",'code',"price","comment_enabled","number","amortization",'accruals_zp','oncost','tax','efficiency');
		foreach ($fields as $field)	if (isset($data[$field])) $this->{$field} = $data[$field];
		return $dbw->update_from_object("price_data",$fields,"id=".$this->id,$this);
    }
    
    function save_mwp($data) {
    	global $dbw;
	    global $db;
	    
	    $types = array(
	        1=>array(
	            'tbl' =>'price_per_material'
	            ,'prefix' => 'm'
	            ,'field_id' => 'material_id'
	            ,'field_count' => 'material_count'
	            ,'master_price_field' => 'price_id'
	        )
	        ,2 => array(
	            'tbl' =>'price_per_works'
	            ,'prefix' => 'w'
	            ,'field_id' => 'work_id'
	            ,'field_count' => 'work_count'
	            ,'master_price_field' => 'price_id'
	        )
	        ,3 => array(
	            'tbl' =>'price_per_price'
	            ,'prefix' => 'p'
	            ,'field_id' => 'price_id'
	            ,'field_count' => 'price_count'
	            ,'master_price_field' => 'parent_price_id'
	            
	        )
	    );
	    
	    
	    foreach ($types as $t) {
	        
	        $old_items  = $db->select_column("SELECT relation_id FROM ".$t['tbl']." WHERE ".$t['master_price_field']." =".$data['prod_id']);
	        $old_items = $old_items ? $old_items : array();
	        
	        $key_id = $t['prefix'].'id';
	        $key_relation = $t['prefix'].'relation';
	        $key_count = $t['prefix'].'count';
	        
	        
	        if ($data[$key_id]) {
	            foreach ($data[$key_id] as $index=>$material_id) {
	                if ($data[$key_relation][$index] == 0) {
	                    $q[] =  "INSERT INTO ".$t['tbl']." (".$t['master_price_field'].",".$t['field_id'].",".$t['field_count'].") VALUES
	                    (".$data['prod_id'].",".$material_id.",".$data[$key_count][$index].")";
	                    
	                } else {
	                    $updated_items[] = $data[$key_relation][$index];
	                    $q[] = "UPDATE ".$t['tbl']." SET ".$t['field_count']." = ".$data[$key_count][$index]." WHERE relation_id = ".$data[$key_relation][$index];
	                }
	            }    
	        }    
	        
	        
	        // DELETE OLD RECORDS
	        $updated_items = $updated_items ? $updated_items : array();
	        
	        $del_items = array_diff($old_items,$updated_items);
	        //print_r($del_items);
	        
	        if ($del_items) {
	            foreach ($del_items as $del_id) {
	                $q[] = "DELETE FROM ".$t['tbl']." WHERE relation_id = ".$del_id;
	            }
	        }
	       
	        if ($q) {
	            foreach ($q  as $query) {
	                $dbw->q($query);
	            }
	        }
	        
	        unset($q); unset ($updated_items); unset($del_items);
	    }        	
    }
    
    function save_child_prices($data) {
    	global $db;
    	global $dbw;
    	
    	$old_ids = $db->select_column('SELECT relation_id FROM price_per_price WHERE parent_price_id = '.$this->id);
    	if (!is_array($old_ids)) {$old_ids = array();}
		
    	if ($data['prelation_id']) {
    		$index = 0;
    		foreach ($data['prelation_id'] as $relation_id) {
    			if (!in_array($relation_id,$old_ids)) {
    				// INSERT
    				$dbw->q('INSERT INTO price_per_price (parent_price_id,price_id) VALUES ('.$this->id.','.$data['price_id'][$index].')');
    			}    			
    			$index++;
    		}
    	} else {
    		$data['prelation_id'] = array();
    	}
    	
    	$delete_relations = array_diff($old_ids, $data['prelation_id']);    	
    	
    	if ($delete_relations) {
    		$query = 'DELETE FROM price_per_price WHERE relation_id IN ('.implode(',',$delete_relations).')';
    		$dbw->q($query);
    	}
    }
       
}

?>
