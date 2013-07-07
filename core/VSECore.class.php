<?php


/**
 * VSECore
 * 
 * @package VSE
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSECore {
    
    public $user;
    public $events;
    public $session;
    public $output;
    
    
    
    /**
     * VSECore::__construct()
     * 
     * @return
     */
    function __construct() {
         
        $this->session = new VSESession();
        $this->events = new VSEEvents();
        $this->output = new VSEOutput();
        
        // init current user
        if ($this->session->is_registered()) {
            $this->user = new VSECurrentUser($this->session->user_id);
        }
        
        
    }
    
    /**
     * VSECore::CheckAuth()
     * Проверяет, авторизован ли пользователь в системе
     * @return true|false 
     */
    function CheckAuth() {
        if (!$this->session->is_registered()) {
            $this->redirect("auth.php");
        }
    }
    
    /**
     * VSECore::InitArm()
     * Проверяет, доступен ли данный АРМ для текущего пользователя. Вызов данного метода осуществляется ТОЛЬКО в рамках АМР
     * @param mixed $arm_name
     * @return true|false Если АРМ  не доступен, по показывается соответствующее сообщение. Если до включения файла конфигурации не определена константа ARM_NAME, то выведется соответствующее сообщение
     */
    function InitArm() {
        
        if (!defined('ARM_NAME')) {
            $this->output->fetch_html ('No ARM Found! Define ARM_NAME First.');
            $this->output->body();
            exit;
        }
        
        if (!$this->user->check_arm_access(ARM_NAME)) {
           $this->output->fetch (CORE_ROOT.'templates/core_no_auth.tpl');
	       echo $this->output->body ();
	       exit;    
        } 
    
        return true;
    }
    
    
    /**
     * VSECore::redirect()
     * Осуществлят перенаправление на определенную страницу
     * @param mixed $page Название страницы
     * @return
     */
    function redirect($page) {
        $host  = $_SERVER['HTTP_HOST'];  
        
        $prefix = $_SERVER['HTTPS'] ? 'https://' : 'http://';
        
        header("Location: ".$prefix. $host . "/" . $page);
    }
    
    /**
     * VSECore::LoadModule()
     * Производит загрузку модуля.
     * @param mixed $name
     * @return true|false Если файл moduleload.php существует, то возращает true, в противном случае false
     */
    function LoadModule ($name) {
		$load_file = CORE_ROOT."module/$name/moduleload.php";
        
        
		if (file_exists ($load_file)) {
			require_once ($load_file);
            return true;
		} else {
		  return false;
		}
	}
    
    /**
     * VSECore::UTF2Win1251()
     * Производит конвертацию из кодировки UTF-8 в Windows-1251
     * @param mixed $name
     * @return true|false Если файл moduleload.php существует, то возращает true, в противном случае false
     */
    function UTF2Win1251($str) {
        if (is_array($str)) {
            foreach ($str as &$val) {
                if (!is_array($val)) {
                    $val  = iconv('UTF-8','Windows-1251',$val);    
                }                
            }
        } else {
            $str = iconv('UTF-8','Windows-1251',$str);
        }
        
        return $str;
    } 
    
    function Win12512UTF8($str) {
        
        if (is_array($str)) {
            foreach ($str as &$val) {
                if (!is_array($val)) {
					$val  = iconv('Windows-1251','UTF-8', (string)$val);
				}
            }
        
        } else {
            $str = iconv('Windows-1251','UTF-8',$str);
        }
        
        return $str;
        
    } 
    
    function GetSection($name,$arm_id) {
		global $db;
		
		return $db->select_row("SELECT * FROM core_roles WHERE role_name = '$name' AND arm_id = $arm_id");
	}
    
	function LoadDepartments() {
        
		global $db;
        return $db->select_prepare_options("select `name`,`id` from price_data where parent_id = 0 and is_active=1");
        
    }
	
	function LoadSection ($name) {
		global $db;
		$db->mysqli->next_result();
		return $db->select("SELECT sm.*
			FROM
				core_sections_modules sm
				left join core_sections s on s.section_id = sm.section_id
			WHERE
				s.section_name = '".$name."'");
	}
	
	function LoadDialog ($name) {
		$load_file = CORE_ROOT.'main/dialogs/'.$name.'/dlgload.php';       
		if (file_exists ($load_file)) {
			require_once ($load_file);
            return true;
		} else {
		  return false;
		}
	}
	
	function LoadElement ($name) {
		$load_file = CORE_ROOT.'main/elements/'.$name.'/elementload.php';       
		if (file_exists ($load_file)) {
			require_once ($load_file);
            return true;
		} else {
		  return false;
		}
	}
	
}


?>
