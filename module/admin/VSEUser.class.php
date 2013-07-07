<?


/**
 * VSEUser
 *
 * @package ModuleAdmin
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEUser {
    
    
    /**
     * VSEUser::__construct()
     *
     * @param integer $user_id
     * @return
     */
    function __construct($user_id) {
        global $db;
    	$db->select_to_object("SELECT *, PersonFullName(person_id) as person_fio FROM core_users WHERE user_id=".$user_id,&$this);
    	// roles assign
    	if ($this->user_id) {
			$this->roles = $db->select_column ("SELECT role_id FROM core_user_roles WHERE user_id=".$this->user_id);
		}
		// нужно чтобы нормально работало сохранение ролей
		if (!$this->roles) {$this->roles = array ();}
    }
    
    /**
     * VSEUser::new_user()
     *
     * @param array $data ѕол€: $data[person_id], $data[login], $data[password]
     * @return integer|false ≈сли все данные есть и пользователь создан, возращаетс€ id пользовател€, в противном случае false
     */
    static function new_user($data) {
        
        global $dbw;
        
        $data['password'] = md5($data['password']);
        return $dbw->insert ("INSERT INTO core_users SET person_id = $data[person_id], login='$data[login]', password='$data[password]', office_id='$data[office_id]' ");
        
    }
    
    /**
     * VSEUser::delete()
     * ”дал€ет все роли из таблички core_user_roles и затем удал€ет самого пользовател€
     * @return true|false
     */
    function delete() {
		global $dbw;
		
        if ($this->user_id) {
			$dbw->q ("DELETE FROM core_user_roles WHERE user_id=".$this->user_id);
			$dbw->q ("DELETE FROM core_users WHERE user_id=".$this->user_id);
			return true;
		} else {
			return false;
		}
    }
    
    /**
     * VSEUser::passwod_change()
     * —мена парол€ пользовател€
     * @param string $new_password
     * @return true|false
     */
    function passwod_change($new_password) {
        global $dbw;
        $new_password = md5($new_password);
        return $dbw->q ("UPDATE core_users SET password='$new_password' WHERE user_id=".$this->user_id);
    }
    
    /**
     * VSEUser::login_change()
     * »зменение логина пользовател€
     * @param mixed $new_login
     * @return true|false
     */
    function login_change($new_login) {
        
        global $dbw;
        return $dbw->q ("UPDATE core_users SET login='$new_login' WHERE user_id=".$this->user_id);
        
    }
    
    /**
     * VSEUser::role_add()
     * ƒобавл€ет роль $role_id к пользователю
     * @param integer $role_id
     * @return true|false
     */
    function role_add($role_id) {
		global $dbw;
		return $dbw->insert ("INSERT INTO core_user_roles SET user_id=".$this->user_id.", role_id=".$role_id);	
    }
    
    /**
     * VSEUser::role_delete()
     * ”дал€ет роль $role_id у пользовател€
     * @param mixed $role_id
     * @return
     */
    function role_delete($role_id) {
        global $dbw;
		return $dbw->insert ("DELETE FROM core_user_roles WHERE user_id=".$this->user_id." AND role_id=".$role_id);
    }
	
}




?>
