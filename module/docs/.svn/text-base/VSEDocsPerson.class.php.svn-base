<?php


/**
 * VSEDocsPerson
 * Наследник класса VSEPerson. Отличие данного класса в том, что в при инициализации d нем создаются еще два объекта типа VSEDocsPassport и VSEOmsPolis.
 * 
 * @package ModuleDocs
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEDocsPerson extends VSEPerson {
	
		
		public $passport;		
		public $polis;
		public $dmspolis;
		/**
		 * VSEDocsPerson::__construct()
		 * 
		 * @param mixed $person_id
		 * @return
		 */
		function __construct ($person_id) {
	
			global $db;
			
			$db->select_to_object("SELECT * FROM core_persons WHERE person_id=".$person_id,&$this);
			$lenght = strlen($this->card_number); 
			if($lenght == '5'){ $this->card_number = "0".$this->card_number;} // приведение к виду 000000
			
			$this->address = new VSEAddress ($this->address_id);
			$this->passport = new VSEDocsPassport($this->person_id);
			$this->polis = new VSEDocsOMSPolis($this->person_id);
			$this->dmspolis = new VSEDocsDMSPolis($this->person_id);
			
			$IsDoctor 	= $db->select_item("select person_id from core_doctors where person_id=".$person_id);
			$IsUser 	= $db->select_item("select person_id from core_users where person_id=".$person_id);
			if (($IsDoctor)||($IsUser)) $this->IsWorker = true;
			
		}
        
        
        private function check_data(&$err) {
            global $db;
            /* CHECK EMPTY DATA */
            if (empty($this->fname) || empty($this->mname) || empty($this->sname) || empty($this->birthday)) {
                $err = "fill all required filelds";
                return false;
            }
            
            /* CHECk UNIQUE FIELDS 
            BIRTHDAY AND FIO
            */
            $query = "SELECT DISTINCT person_id FROM core_persons WHERE STRCMP(fname,'".$this->fname."')=0 AND STRCMP(mname,'".$this->mname."')=0 AND STRCMP(sname,'".$this->sname."')=0 AND birthday = '".$this->birthday."' AND person_id != ".$this->person_id;
            $items = $db->select_column($query);
   //         $db->debug_output("\n");
            if ($items) {
            
                $err = "Такой пользователь уже существует. ".implode(",",$items);
                return false;
            }
            
            /* CHECk UNIQUE FIELDS 
            SNILS
            */
            if ($this->pension_number) {
                $query = "SELECT DISTINCT person_id FROM core_persons WHERE pension_number = '".$this->pension_number."' AND person_id != ".$this->person_id;
                $items = $db->select_column($query);
                
                if ($items) {
                   
                    $err = "Такой пенсионный номер уже существует. ".implode(",",$items);
                    return false;
                }
                
            }
            
            
            /* CHECk UNIQUE FIELDS 
            Амб Карта
            */
            if ($this->card_number) {
                $query = "SELECT DISTINCT person_id FROM core_persons WHERE card_number = ".$this->card_number ." AND person_id != ".$this->person_id;
                $items = $db->select_column($query);
                if ($items) {
                    $err = "Такой номер амбулаторной карты уже сужествует. ".implode(",",$items);
                    return false;
                }
            }
            
            return true;
        }
		
		
		/**
		 * VSEDocsPerson::save()
		 * Сохраняет данные в БД. Так же сохраняются объекты $passport и $polis
		 * @return
		 */
		function save (&$err) {
			global $dbw;
			// update all fields
			/*$this->address->save ();
			$this->passport->save ();
			$this->polis->save ();*/
            
            if (!$this->check_data($error)) {
                $err = $error;
                return false;
            }
            
			//self
			$fields = array ("fname","mname","sname","birthday","birth_place","address_id","sex","pension_number","card_number");
			return $dbw->update_from_object ("core_persons",$fields,"person_id=".$this->person_id,$this);
		}
        
        
        /**
         * VSEDocsPerson::delete()
         * Удаляет объект из БД. Так же удаляются паспортные данные и данные о полисе
         * @return true|false
         */
        function delete() {
            
            global $dbw;
            
            if ($this->address) {$this->address->delete();}
            if ($this->passport) {$this->passport->delete();}
            if ($this->polis) {$this->polis->delete();}
            
            if ($this->person_id) {
                return $dbw->q("DELETE FROM core_persons WHERE person_id = ".$this->person_id);    
            } else {
                return false;
            }
        }
		
}




?>
