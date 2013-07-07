<?php

/**
 * VSEPerson
 * 
 * @package VSE
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEPerson {
	
	public $address;
	
    /**
     * VSEPerson::__construct()
     * Инициализация объекта. Так же создается встроеный объект address класса VSEAddress
     * @param mixed $person_id
     * @return
     */
    function __construct ($person_id) {
    	
    	global $db;
    	$db->select_to_object("SELECT * FROM core_persons WHERE person_id=".$person_id,&$this);
    	$this->address = new VSEAddress ($this->address_id);
    
    }	
    
    
    /**
     * VSEPerson::save() - save object to DB
     * 
	 * Сохранение данных
     * 
     * @return true|false если запись удалясь, false если ошибка
     */
    public function save () {
    	global $dbw;
    	$fields = array ("fname","mname","sname","birthday","birth_place","address_id","sex","pension_number","card_number");
    	$dbw->update_from_object ("core_persons",$fields,"person_id = ".$this->person_id,$this);
    }
    
    
    
    /**
     * VSEPerson::new_person()
     * 
     * Создание нового пользователя
     * 
     * @param mixed $data
     * @return int|false id нового элемента, false - если запись не удалась
     */
    public static function new_person($data) {
        global $dbw;
        
        $fields = array ("fname","mname","sname","birthday","birth_place","address_id","sex","pension_number","card_number");
        
        return $dbw->insert_from_object("core_persons",$fields,$data);
    }
    
    public static function new_contact($data) {
        global $dbw;
        
        $fields = array ("person_id","type","data");
        
        return $dbw->insert_from_object("core_person_contacts",$fields,$data);
    }
    
     /**
     * VSEPerson::new_pacient()
     * 
     * Создание нового пользователя (упрощенная функция)
     * Требуется модуль Docs. $VSECore->LoadModule('docs');
     * 
     * @param mixed $data
     * @return int|false id нового элемента, false - если запись не удалась или не все поял заполнены
     */
    public static function new_pacient($data,&$err) {
        global $db;
        /* CHECK EMPTY DATA */
        if (empty($data['fname']) || empty($data['mname']) || empty($data['sname']) || empty($data['birthday'])) {
            $err = "Поля Фамилия, Имя, Отчество и Дата рождения должны быть заполнены";
            return false;
        }
                
        /* CHECk UNIQUE FIELDS 
            BIRTHDAY AND FIO
        */
        $query = "SELECT * FROM core_persons WHERE STRCMP(fname,'$data[fname]')=0 AND STRCMP(mname,'$data[mname]')=0 AND STRCMP(sname,'$data[sname]')=0 AND birthday = '$data[birthday]'";
        $items = $db->select($query);
        if (count($items)) {
            $err = "Пользовать с такой фамилией и датой рождения есть в системе";
            return false;
        }
        
        /* CHECk UNIQUE FIELDS 
            SNILS
        */
        if ($data['pension_number']) {
            $query = "SELECT * FROM core_persons WHERE pension_number = '$data[pension_number]'";
            $items = $db->select($query);
            if ($items) {
                $err = "Такой пенсионный номер есть в системе";
                return false;
            }
            
        }
        
        /* CHECk UNIQUE FIELDS 
            Амб Карта
        */
        if ($data['card_number']) {
            $query = "SELECT * FROM core_persons WHERE card_number = $data[card_number]";
            $items = $db->select($query);
            if ($items) {
                $err = "Такой номер карточки есть в системе";
                return false;
            }
        }
        
        
        /* CREATING Address */
        $address_id = VSEAddress::new_address($data);
        $data['address_id'] = $address_id;
        
        $person_id = self::new_person($data);
        
        if ($person_id) {
            // CREATING PASSPORT
            VSEDocsPassport::new_passport(array( "person_id"=>$person_id,"address_id"=>VSEAddress::new_address(array('code'=>0)) ) );
            
            // CREATING POLIS
            VSEDocsOMSPolis::new_polis(array("person_id"=>$person_id));
            
            return $person_id;
            
        } else {
            return false;
        }
    } 
    
    /**
     * VSEPerson::delete()
     * Удаляет объект из БД.
     * @return true|false
     */
    function delete () {
        
        global $dbw;
        
        if ($this->address) {$this->address->delete();}
        if ($this->person_id) {
            return $dbw->q("DELETE FROM core_persons WHERE person_id=".$this->person_id);
        } else {
            return false;
        }
	
    }



}


?>
