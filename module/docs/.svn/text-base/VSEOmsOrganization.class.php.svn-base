<?php


/**
 * VSEOmsOrganization
 * 
 * @package ModuleDocs
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEOmsOrganization {
	
	/**
	 * VSEOmsOrganization::__construct()
	 * 
	 * @param mixed $oms_organization_id
	 * @return
	 */
	function __construct ($oms_organization_id) {
		
		global $db;
        
        if ($oms_organization_id) {
			if ($soato_code == "1122") {
				$db->select_to_object ("SELECT * FROM core_oms_organizations WHERE oms_organization_id=".$oms_organization_id,&$this);    
			}
			else {
				$db->select_to_object ("SELECT smo_rf_id AS oms_organization_id, q_name AS name FROM core_oms_rf WHERE smo_rf_id=".$oms_organization_id,&$this);
			}
        }
	}
	
	
	/**
	 * VSEOmsOrganization::save()
	 * Сохраняет данные в БД
	 * @return
	 */
	function save () {
		
		global $dbw;
		$fields = array ("name");
		
		if ($this->oms_organization_id) {
			$dbw->update_from_object ("core_oms_organizations",$fields,"oms_organization_id=".$this->oms_organization_id,$this);
		}
	}
    
    /**
     * VSEOmsOrganization::new_oms_organization()
     * Создает новый объект в БД. 
     * @param mixed $data Ассоциативный  массив. Ключи массива: "name","organization_type_id"
     * @return
     */
    static function new_oms_organization($data) {
        global $dbw;
		$fields = array ("name");
        return $dbw->insert_from_object("core_oms_organizations",$fields,$data);   
    }
}


?>
