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
		 * �������������. ��� �� ��������� ������ ���� VSEAddress
		 * @param mixed $id ��������� �������� ���� person_id ���� passport_id. �� passport_id ������ ��������� � ������ ���� $by_id = true
		 * @return
		 */
		function __construct ($id,$by_id = false) {
			global $db;	
            
            // create by passport id
            if ($by_id) {
                $db->select_to_object("SELECT * FROM core_person_docs_passport WHERE passport_id = ".$id,&$this);
			$lenght = strlen($this->number); 
			if($lenght == '5'){ $this->number = "0".$this->number;} // ���������� � ���� 000000
			$lenght = strlen($this->series); 
			if($lenght == '3'){ $this->series = "0".$this->series;} // ���������� � ���� 0000
            // created by person_id
            } else {
                if ($id) {
                    $db->select_to_object("SELECT * FROM core_person_docs_passport WHERE person_id = ".$id." ORDER BY passport_id DESC LIMIT 1",&$this);
			$lenght = strlen($this->number); 
			if($lenght == '5'){ $this->number = "0".$this->number;} // ���������� � ���� 000000
			$lenght = strlen($this->series); 
			if($lenght == '3'){ $this->series = "0".$this->series;} // ���������� � ���� 0000
                }    
            }
            
            // adress create
            //if ($this->address_id) {
                $this->address = new VSEAddress ($this->address_id);     
            //}
            				
			
		}
		
		/**
		 * VSEDocsPassport::save()
		 * ��������� ������ � ��
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
		 * ���������� ������ � ID ���� ��������� ������������
		 * @return array
		 */
		function history () {
			return $this->db->select_column("SELECT passport_id FROM core_person_docs_passport WHERE person_id =".$person_id." ORDER BY passport_id DESC");
		}
		
		/**
		 * VSEDocsPassport::new_passport()
		 * ������� ����� ������ � ��
		 * @param mixed $passport_data �������������  ������. ����� �������: "series","number","person_id","give_out_date","give_out_who","address_id"
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
         * ������� ������ �� ��. ��� �� ������� ���������� �� ������, ��������� � ��������
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
