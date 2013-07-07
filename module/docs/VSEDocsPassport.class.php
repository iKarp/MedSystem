<?php

/**
 * VSEDocsPassport
 * 
 * @package ModuleDocs
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEDocsPassport {
			
		public $address;
		
		/**
		 * VSEDocsPassport::__construct()
		 * Инифиализация. Так же создается объект типа VSEAddress
		 * @param mixed $id Принимает значения либо person_id либо passport_id. ПО passport_id объект создается в случае если $by_id = true
		 * @return
		 */
		function __construct ($id,$by_id = false) {
			global $db;	
            
            // create by passport id
            if ($by_id) {
                $db->select_to_object("SELECT * FROM core_person_docs_passport WHERE passport_id = ".$id,&$this);
			$lenght = strlen($this->number); 
			if($lenght == '5'){ $this->number = "0".$this->number;} // приведение к виду 000000
			$lenght = strlen($this->series); 
			if($lenght == '3'){ $this->series = "0".$this->series;} // приведение к виду 0000
            // created by person_id
            } else {
                if ($id) {
                    $db->select_to_object("SELECT * FROM core_person_docs_passport WHERE person_id = ".$id." ORDER BY passport_id DESC LIMIT 1",&$this);
			$lenght = strlen($this->number); 
			if($lenght == '5'){ $this->number = "0".$this->number;} // приведение к виду 000000
			$lenght = strlen($this->series); 
			if($lenght == '3'){ $this->series = "0".$this->series;} // приведение к виду 0000
                }    
            }
            
            // adress create
            //if ($this->address_id) {
                $this->address = new VSEAddress ($this->address_id);     
            //}
            				
			
		}
		
		/**
		 * VSEDocsPassport::save()
		 * Сохраняет данные в БД
		 * @return true|false
		 */
		function save () {
			global $dbw;
			// update address
			$this->address->save();
			// self 
			$fields = array('series',"number","person_id","give_out_date","give_out_who","address_id");
			return $dbw->update_from_object ("core_person_docs_passport",$fields,"passport_id=".$this->passport_id,$this);
		}
		
		/**
		 * VSEDocsPassport::history()
		 * Возвращает массив с ID всех паспортов пользователя
		 * @return array
		 */
		function history () {
			return $this->db->select_column("SELECT passport_id FROM core_person_docs_passport WHERE person_id =".$person_id." ORDER BY passport_id DESC");
		}
		
		/**
		 * VSEDocsPassport::new_passport()
		 * Создает новый объект в БД
		 * @param mixed $passport_data Ассоциативный  массив. Ключи массива: "series","number","person_id","give_out_date","give_out_who","address_id"
		 * @return integer|false
		 */
		static function new_passport ($passport_data) {
			global $dbw;
	    $passport_data['series'] = str_replace(" ","",$passport_data['series']);
            $fields = array ("series","number","person_id","give_out_date","give_out_who","address_id");
            return $dbw->insert_from_object("core_person_docs_passport",$fields,$passport_data);
		}
        
        
        /**
         * VSEDocsPassport::delete()
         * Удаляет запись из БД. Так же удаляет информацию об адресе, описанном в паспорте
         * @return true|false
         */
        function delete() {
            
            global $dbw;
            
            if ($this->address) {
                $this->address->delete();
            }
            
            if ($this->person_id) {
                return $dbw->q("DELETE FROM core_person_docs_passport WHERE passport_id=".$this->passport_id);
            }
        }
        
        
}

?>
