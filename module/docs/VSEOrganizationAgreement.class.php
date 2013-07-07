<?php

/**
 * VSEOrganizationAgreement
 * 
 * @package ModuleDocs
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEOrganizationAgreement {
	
		public $oms_organization;
	
		/**
		 * VSEOrganizationAgreement::__construct()
		 * 
		 * @param mixed $organization_id
		 * @return
		 */
		function __construct ($agreement_id) {
			
			global $db;
			
			$db->select_to_object ("SELECT * FROM core_oms_organizations_agreement WHERE agreement_id=".$agreement_id,&$this);
			
			$this->oms_organization = new VSEOmsOrganization ($this->oms_organization_id);
			
		}
		
		/**
		 * VSEOrganizationAgreement::save()
		 * Сохраняет данные в БД.
		 * @return true|false
		 */
		function save () {
			global $dbw;
			// update oms_organization
			$this->oms_organization->save ();
			// self
			$fields = array ("oms_organization_id","organization_id","number","agreement_date");
			
			if ($this->agreement_id) {
				return $dbw->update_from_object ("core_oms_organizations_agreement",$fields,"agreement_id=".$this->agreement_id,$this);
			} else {
				return false;
			}
		}
        
        /**
         * VSEOrganizationAgreement::new_agreement()
         * СОздает новый объект в БД. 
         * @param mixed $data Ассоциативный  массив. Ключи массива: "oms_organization_id","organization_id","number","agreement_date
         * @return
         */
        static function new_agreement($data) {
            global $dbw;
            
            $fields = array("oms_organization_id","organization_id","number","agreement_date");
            return $dbw->insert_from_object("core_oms_organizations_agreement",$fields,$data);
        }
        
        
        function delete() {
			
			global $dbw;
			
			if ($this->agreement_id) {
				return $dbw->q("DELETE FROM core_oms_organizations_agreement WHERE agreement_id=".$this->agreement_id);
			} else {
				return false;
			}			
		}
		
		
		
	
}



?>
