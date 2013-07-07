<?php

/**
 * VSESession
 * 
 * @package VSE
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSESession implements VSESessionInterface {
    
      
    /**
     * VSESession::__construct()
     * 
     * @return
     */
    function __construct() {
        session_start();
    }
    
    /**
     * VSESession::__set()
     * 
     * @param mixed $name
     * @param mixed $value
     * @return
     */
    function __set($name,$value) {
        $_SESSION[$name] = $value;    
    }
    
    /**
     * VSESession::__get()
     * 
     * @param mixed $name
     * @return
     */
    function __get($name) {
        return $_SESSION[$name];
    }
    
    /**
     * VSESession::register_session()
     * –егистрирует сессию
     * @param mixed $login Ћогин пользовател€
     * @return true|false ≈сли такой пользователь есть, и регистраци€ сессии прошла успешно, возращаетс€ true, в противном случае false
     */
    function register_session($login) {
        
        global $db;
        
        $user = $db->select_row("SELECT * FROM core_users WHERE login = '$login'");
        
        if ($user) {
            $this->user_id = $user['user_id'];
            $this->login = $user['login'];
            $this->start_time = time();
            
            return true;
            
        } else {
            
            return false;
        
        }
    }
    
    /**
     * VSESession::unregister_session()
     * ќкончание сессии
     * @return true
     */
    function unregister_session() {
        
        foreach ($_SESSION as $key=>$val) {
            unset($_SESSION[$key]);    
        }
        return true;
        
    }
    
    /**
     * VSESession::is_registered()
     * ѕровер€ет, зарегестрировал ли пользователь в системе
     * @return true|false
     */
    function is_registered() {
        
        if ($this->user_id  && $this->login) {
            return true;
        } else {
             //echo "Session false". $this->user_id . $this->login;
            return false;
        }
        
    }
    
    /**
     * VSESession::authuser()
     * ѕроизводит авторизацию пользовател€
     * @param mixed $login
     * @param mixed $pass
     * @return true|false
     */
    function authuser($login,$pass) {
        
        global $db;
        
        $r = false;
        // not clear password enable
        if ($login && $pass) {
            
            $pass = md5($pass);
            // escape only user. because pass in md5
            $user = $db->escape_string($login);
            $user = $db->select_row("SELECT * FROM core_users WHERE login = '$login' AND password = '$pass'");
            
            $r = !empty($user);      
        }
        
        return $r;
      
    }
    
    
}



?>