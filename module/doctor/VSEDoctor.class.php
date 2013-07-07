<?php

/**
 * VSEDoctor
 * 
 * @package ModuleDoctor
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEDoctor {
    
    public $spec_name;
    public $person;
    
    /**
     * VSEDoctor::__construct()
     * 
     * @param integer $doctor_id
     * @return true
     */
    function __construct($doctor_id) {
        	global $db;	
            
            if ($doctor_id) {
                    $db->select_to_object("SELECT * FROM  `core_doctors` WHERE doctor_id=".$doctor_id." LIMIT 1",&$this);
                    $this->spec_name = $db->select_item("SELECT `spec_name` FROM core_doctors_spec WHERE spec_id=".$this->spec_id);	    
					$this->person = new VSEPerson($this->person_id); 
            }
            
    }
    
    /**
     * VSEDoctor::save()
     * Save object in db
     * @return
     */
    public function save () {
    	global $dbw;
    	$fields = array("spec_id","post","code","hospital_id");
    	return $dbw->update_from_object ("core_doctors",$fields,"doctor_id = ".$this->doctor_id,$this);
    }
    
    /**
     * VSEDoctor::delete()
     * Delete object from db
     * @return true|false
     */
    public function delete() {
        global $dbw;
        
        if ($this->doctor_id) {
            return $dbw->q("DELETE FROM core_doctors WHERE doctor_id = ".$this->doctor_id);
        } else {
            return false;
        }
    }
    
    /**
     * VSEDoctor::new_doctor()
     * 
     * @param array $data Fields is "person_id","spec_id","post","code"
     * @return integer|false
     */
    static function new_doctor($data) {
        global $dbw;
            
        $fields = array("person_id","spec_id","post","code","hospital_id");
        return $dbw->insert_from_object("core_doctors",$fields,$data);
    }
}

?>