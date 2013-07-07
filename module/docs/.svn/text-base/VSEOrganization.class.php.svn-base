<?php

/**
 * VSEOrganization
 * 
 * @package ModuleDocs
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEOrganization {
	
		public $oms_organization;
	
		/**
		 * VSEOrganization::__construct()
		 * 
		 * @param mixed $organization_id
		 * @return
		 */
		function __construct ($organization_id) {
			
			global $db;
			
            if ($organization_id) {
                $db->select_to_object("SELECT * FROM core_organizations	WHERE organization_id=".$organization_id." LIMIT 1",&$this);
                
                /*if ($this->oms_organization_id) {
                    $this->oms_organization = new VSEOmsOrganization($this->oms_organization_id);
                }*/
            }
			
		}
		
		/**
		 * VSEOrganization::save()
		 * Сохраняет данные об организации, а так же данные об соглашении $this->agreement
		 * @return true|false
		 */
		function save () {
			
			global $dbw;
			// update agreement
			//$this->agreement->save ();
			// self
			$fields = array ("name","agreement_number","agreement_date");
			return $dbw->update_from_object ("core_organizations",$fields,"organization_id=".$this->organization_id,$this);
			
		}
        
        /**
         * VSEOrganization::new_organization()
         * Созлает новый объект в БД
         * @param mixed $data Ассоциативный  массив. Ключи массива: "name","organization_type_id"
         * @return
         */
        static function new_organization($data) {
            
            global $dbw;
            $fields = array ("name","agreement_number","agreement_date");
            return $dbw->insert_from_object("core_organizations",$fields,$data);
        }
        
        /**
         * VSEOrganization::delete()
         * Delete object in DB
         * @return integer|false
         */
        function delete() {
			 global $dbw;
             
             if ($this->organization_id) {
                return $dbw->q("DELETE FROM core_organizations WHERE organization_id = ".$this->organization_id);   
             } else {
                return false;
             }             
		}
}

?>
