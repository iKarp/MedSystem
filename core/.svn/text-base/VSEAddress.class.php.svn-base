<?php
/**
 * VSEAddress
 * 
 * @package VSE
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEAddress {
    
    
    public $town_str;
    public $street_str;
    
    private $location_code;
	
	/**
	 * VSEAddress::__construct()
	 * 
	 * @param mixed $address_id
	 * @return
	 */
	function __construct ($address_id) {
		
		global $db;
        
        if ($address_id) {
            $db->select_to_object("SELECT * FROM core_address WHERE address_id = ".$address_id,&$this);    
            if ($this->code) {
                
                // if we have street
                if (strlen($this->code) > 13) {
                    $this->street_str = $db->select_item("SELECT CONCAT(socr,'. ',name) as str FROM `kladr_street` WHERE `code` = ".$this->code);
                }
                
                // if we have town or derevnya
                $town_code = substr($this->code,5,3);
                $vilage_code = substr($this->code,8,3);
                  
                if ($town_code*1 != 0) {
                    $code = substr($this->code,0,8);
                    $this->town_str = $db->select_item("SELECT CONCAT(socr,'. ',name) as name FROM `kladr_kladr` WHERE `code` = '$code"."00000'");    
                } else if ($vilage_code*1 != 0) {
                    $code = substr($this->code,0,11);
                    $this->town_str = $db->select_item("SELECT CONCAT(socr,'. ',name) as name FROM `kladr_kladr` WHERE `code` = '$code"."00'");
                }
                
                // rayon
                $code = substr($this->code,0,5);
		        $this->r_str = $db->select_item("SELECT CONCAT(socr,'. ',name) as name FROM `kladr_kladr` WHERE code = '".$code."00000000'");  
                
                // OBLaST
                $this->region = substr($this->code,0,2);
                
                // location CODE
                $this->location_code = substr($this->code,0,13);
                
            }
        }
	}
	
	/**
	 * VSEAddress::full_address()
	 * Возращает строку с полным адресом по коду КЛАДР
	 * @return string Строка с полным адресом
	 */
	function full_address() {
		$address = "";
		if ($this->town_str) $address .= $this->town_str.", ";
		if ($this->street_str) $address .= $this->street_str.", ";
		if ($this->build_number) $address .= $this->build_number." - ";
		if ($this->appartment_address) $address .= $this->appartment_address;
		return $address;
	} 
	
	/**
	 * VSEAddress::save()
	 * Сохранение изменений
	 * @return true True - если запись удалась, false если ошибка в запросе
	 */
	function save () {
		global $dbw;
		$fields = array ("appartment_address","build_number","code","town_str","street_str");
		// udpate priority
		if ($this->code) {
				$new_location_code = substr($this->code,0,13);
				
				if ($new_location_code != $this->location_code) {
					$dbw->q("UPDATE `kladr_kladr` SET priority=priority+1 WHERE code=".$new_location_code);
				}
		}
		// udpate address table
		return $dbw->update_from_object ("core_address",$fields,"address_id=".$this->address_id,$this); 
	}
    
    /**
     * VSEAddress::new_address()
     * Создает новую запись
     * @param mixed $address_data
     * @return integer ID новой записи
     */
    public static function new_address($address_data) {
        
        global $dbw;
        
        $fields = array ("appartment_address","build_number","code","town_str","street_str");
        if ($address_data) {
            return $dbw->insert_from_object("core_address",$fields,$address_data);    
        } else {
            return false;
        }
        
    }
    
    
    /**
     * VSEAddress::delete()
     * Удаляет запись из БД
     * @return true|false
     */
    function delete() {
        
        global $dbw;  
        
        if ($this->address_id) {
            return $dbw->q("DELETE FROM core_address WHERE address_id = ".$this->address_id);    
        } else {
            return false;
        }
        

    }
}

?>
