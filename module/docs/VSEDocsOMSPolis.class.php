<?php

/**
 * VSEDocsOMSPolis
 * 
 * @package ModuleDocs
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEDocsOMSPolis {
	
		public $organization;
        
        private $check_errors;
	
		/**
		 * VSEDocsOMSPolis::__construct()
		 * Инициализация объекта
		 * @param mixed $id Принимает значения либо person_id либо oms_polis_id. ПО oms_polis_id объект создается в случае если $by_id = true
		 * @return true
		 */
		function __construct ($id,$by_id = false) {
				
				global $db;	
                   
                // create by oms_polis_id
                if ($by_id) {
                    
                   $db->select_to_object("SELECT * FROM  `core_person_docs_oms_polis` WHERE oms_polis_id=".$id,&$this);       
                
                // create by person_id    
                } else {
                    if ($id) {
                        $db->select_to_object("SELECT * FROM  `core_person_docs_oms_polis` WHERE person_id=".$id." ORDEr BY oms_polis_id DESC LIMIT 1",&$this);       
                    }    
                }
                
                // create organization
                if (!empty($this->organization_id)) {
                    $this->organization = new VSEOrganization ($this->organization_id);   
                }   
                
                // create oms org if exists
                if ($this->oms_organization_id) {
                    $this->oms_organization = new VSEOmsOrganization($this->oms_organization_id,$this->soato_code);
                }    
		}
        
        
        private function check_polis_data($data,&$err) {
            
            global $db;
            // CHECK FOR DUBLICATE RECORDS
            if ($data['series']*1 != 0 && $data['number']*1 != 0) {
                $items = $db->select_column("SELECT DISTINCT person_id FROM core_person_docs_oms_polis WHERE series = ".$data['series']." AND number = ".$data['number'] ." AND person_id != ".$data['person_id']);
                if ($items) {
                    $err = implode(",",$items);
                  // print_r($items);
                    return false;
                    /*$err['str'] = "Обшибка. Такие же номер и серия полиса уже присутствуют в базе. ";
                    $err['person_id'] = implode(",",$items);
                    return false;*/
                }
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
            
            // update organization
            if ($this->organization->organization_id) {
                   $this->organization->save();    
            }
			
			// self
			$fields = array ("person_id","series","number","ind_number","organization_id","expiration_date","work_type_id","soato_code","oms_organization_id","oms_polis_type_id");
			return $dbw->update_from_object ("core_person_docs_oms_polis",$fields,"oms_polis_id=".$this->oms_polis_id,$this);
		}
        
        /**
         * VSEDocsOMSPolis::new_polis()
         * Созлает новую запись
         * @param mixed $data Ассоциативный  массив. Ключи массива: "person_id","series","number","ind_number","organization_id","expiration_date"
         * @return integer|false
         */
        static function new_polis($data,&$err = "") {
            
            global $dbw;
            
            $fields = array("person_id","series","number","ind_number","organization_id","expiration_date","work_type_id","soato_code","oms_organization_id","oms_polis_type_id");
            
            $r = false;
            if (VSEDocsOMSPolis::check_polis_data($data,$err_ids)) {
                if ($id  = $dbw->insert_from_object("core_person_docs_oms_polis",$fields,$data)) {
                    $err  = "All done. Id is $id";
                    $r = true;
                } else {
                    $err = "Системная ошибка при записи в БД.";
                }
            } else {
                $err = "Ошибка при проверке данных. Найдены записи с такими же номером и серией полиса. " . $err_ids;
            }
            
            return $r;
        }
        
        
        function delete() {
            
            global $dbw;
            
            if ($this->oms_polis_id) {
                return $dbw->q("DELETE FROM core_person_docs_oms_polis WHERE oms_polis_id=".$this->oms_polis_id);    
            } else {
                return false;
            }
        }
}

?>
