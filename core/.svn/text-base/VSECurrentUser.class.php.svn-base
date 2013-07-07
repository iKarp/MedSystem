<?php

/**
 * VSECurrentUser
 * 
 * @package VSE
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSECurrentUser {
    
    public $user_id;
    public $person_id;
    public $person;
    public $login;
    
    public $roles;
    public $arms;
    
    
    /**
     * VSECurrentUser::__construct()
     * Инициализация объекта. Так же создается встроеный объект person класса VSEPerson  
     * @param mixed $user_id
     * @return
     */
    function __construct($user_id) {
        
        global $db;
        
        $this->user_id = $user_id;
        
        $item = $db->select_row("SELECT * FROM core_users WHERE user_id = ".$user_id);
        // assign roles and arms
        if ($item) {
            $this->login = $item['login'];
            $this->person_id = $item['person_id'];
            $this->roles = $this->get_roles();
            $this->arms = $this->get_arms();
        }
        // create person object
        if ($this->person_id) {
            $this->person = new VSEPerson($this->person_id);
        }
    }



    /**
     * VSECurrentUser::showname()
     * 
     * @return string Возращает строку с именем пользователя
     */
    function showname() {
        
        global $db;        
        $db->mysqli->next_result();
		return $db->select_item("SELECT CONCAT_WS(' ' ,`fname`,`mname`,`sname`) FROM `core_persons` WHERE person_id = ".$this->person_id);
        
    }
    
    /**
     * VSECurrentUser::check_arm_access()
     * 
     * @param mixed $arm_name
     * @return true|false
     */
    function check_arm_access($arm_name) {
        $arm_name = strtolower($arm_name);
        return in_array($arm_name,$this->arms);
    }
    
    /**
     * VSECurrentUser::check_role_access()
     * Проверяет доступность данной роли в рамках определенного АРМ
     * @param array $role_names
     * @return true|false
     */
    function check_role_access($role_names) {
        
        global $db;
        
        $r = false;
        
        if (defined('ARM_NAME')) {
            $r = true;
            foreach ($role_names as $rol_name) {
                $r = $r && in_array($rol_name,$this->roles); 
            }       
        }
        
        return $r;
    }
    
    
    
    /**
     * VSECurrentUser::get_roles()
     * 
     * @return array Массив ролей
     */
    private function get_roles() {
        
        global $db;
        
        if (defined('ARM_NAME')) {
            
            $arm_id = $db->select_item("SELECT arm_id FROM core_arms WHERE arm_name = '".ARM_NAME."'");
            
            return  $db->select_prepare_options("SELECT DISTINCT r.id,r.code FROM core_user_roles ur JOIN core_roles r ON (r.id = ur.role_id) WHERE ur.user_id=".$this->user_id." AND r.arm_id = ".$arm_id);
            
        } else {
        
		    return  $db->select_prepare_options("SELECT DISTINCT r.id,r.code FROM core_user_roles ur JOIN core_roles r ON (r.id = ur.role_id) WHERE ur.user_id=".$this->user_id);
            
        }
    }
	
	/**
     * VSECurrentUser::get_arms()
     * 
     * @return array Массив всех доступных АРМ
     */
    private function get_arms() {
        
        global $db;
        
        $roles = $db->select_column("SELECT role_id FROM core_user_roles WHERE user_id = ".$this->user_id);
        
        if ($roles) {
			return $db->select_prepare_options("SELECT DISTINCT a.arm_id,a.arm_name FROM core_roles r JOIN core_arms a ON (a.arm_id = r.arm_id) WHERE r.id IN (".implode(",",$roles).")"); 
		} else {
			return array ();
		}         
    }
    
}



?>
