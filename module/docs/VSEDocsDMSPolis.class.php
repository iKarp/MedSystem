<?php

/**
 * VSEDocsDMSPolis
 * 
 * @package ModuleDocs
 * @author Arsenal IT
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEDocsDMSPolis {
	
		public $dms_organization;
        
        private $check_errors;
	
		/**
		 * VSEDocsDMSPolis::__construct()
		 * Инициализация объекта
		 * @param mixed $id Принимает значения либо person_id либо dms_polis_id. ПО dms_polis_id объект создается в случае если $by_id = true
		 * @return true
		 */
		function __construct ($id,$by_id = false) {
				
				global $db;	
                   
                // create by oms_polis_id
                if ($by_id) {
                    
                   $db->select_to_object("SELECT * FROM  `core_person_docs_dms_polis` WHERE dms_polis_id=".$id,&$this);       
                
                // create by person_id    
                } else {
                    if ($id) {
                        $db->select_to_object("SELECT * FROM  `core_person_docs_dms_polis` WHERE person_id=".$id." ORDER BY dms_polis_id DESC LIMIT 1",&$this);       
                    }    
                }
				$this->dms_organization =$db->select_to_object ("SELECT * FROM core_dms_organizations WHERE dms_organization_id=".$this->dms_organization_id,&$this);
                //$this->dms_organization = new VSEOmsOrganization($this->dms_organization_id);
                //$this->dms_organization = $this->dms_organization_id;
		}
        
        
        private function check_polis_data($data,&$err) {
            
            global $db;
            // CHECK FOR DUBLICATE RECORDS
            if ($data['series']*1 != 0 && $data['number']*1 != 0) {
                $items = $db->select_column("SELECT DISTINCT person_id FROM core_person_docs_dms_polis WHERE series = ".$data['series']." AND number = ".$data['number'] ." AND person_id != ".$data['person_id']);
                if ($items) {
                    $err = implode(",",$items);
                  // print_r($items);
                    return false;
                    /*$err['str'] = "Обшибка. Такие же номер и серия полиса уже присутствуют в базе. ";
                    $err['person_id'] = implode(",",$items);
                    return false;*/
                }
            }
            if ($data['dms_organization_id']==0){
            	return false;
            }
            return true;
        }
        
		
		/**
		 * VSEDocsOMSPolis::save()
		 * Сохраняет данные о полисе, а так же об организации, которой пренадлежит полис
		 * @return true|false
		 */
		function save () {
			
            global $dbw;  
			
			// self
			$fields = array ("person_id","series","number","organization","expiration_date","dms_organization_id");
			return $dbw->update_from_object ("core_person_docs_dms_polis",$fields,"dms_polis_id=".$this->dms_polis_id,$this);
		}
        
        /**
         * VSEDocsOMSPolis::new_polis()
         * Созлает новую запись
         * @param mixed $data Ассоциативный  массив. Ключи массива: "person_id","series","number","organization","expiration_date"
         * @return integer|false
         */
        static function new_polis($data,&$err = "") {
                    	
            global $dbw;
            $fields = array("person_id","series","number","organization","expiration_date","dms_organization_id");
            $r = false;
            //if (VSEDocsDMSPolis::check_polis_data($data,$err_ids)) {
            	if ($id  = $dbw->insert_from_object("core_person_docs_dms_polis",$fields,$data)) {
                    $err  = "All done. Id is $id";
                    $r = true;
                } else $err = "Системная ошибка при записи в БД.";
            //} else $err = "Ошибка при проверке данных. Указаны не все необходимые данные или такой полис уже существует. ".$err_ids;
            return $r;
			
        }
        
        
        function delete() {
            
            global $dbw;
            
            if ($this->dms_polis_id) {
                return $dbw->q("DELETE FROM core_person_docs_dms_polis WHERE dms_polis_id=".$this->dms_polis_id);    
            } else {
                return false;
            }
        }
}

?>
