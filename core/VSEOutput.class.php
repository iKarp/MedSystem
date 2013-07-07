<?php


require_once (dirname(__FILE__)."/Smarty.class.php");

/**
 * VSEOutput
 * 
 * @package VSE
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEOutput {
    
    public $smarty;
    
    private $html;
    
    private $header;
    
    private $messages;
     
    /**
     * VSEOutput::__construct()
     * Инициализация. Создается объект Smarty
     * @return
     */
    function __construct() {
        
        $this->html = "";
        $this->smarty = new Smarty();  
        /*$this->smarty->template_dir = CORE_ROOT."templates"; */
        $this->smarty->compile_dir = CORE_ROOT."templates_c";
    }
    
    /**
     * VSEOutput::body()
     * 
     * @param bool $isreturn - Если $isreturn = true, то возращается строка, если false, по происходит вывод на страницу
     * @return string 
     */
    function body($isreturn = false) {
        if ($isreturn) {
				return $this->html;
		} else {
				echo $this->html;
		}
    }
    
    /**
     * VSEOutput::assign()
     * Производит присвоение определенной переменной в Samrty. Аналог $smarty->assign()
     * @param mixed $name Имя переменной 
     * @param mixed $value Значение переменной
     * @return true|false
     */
    function assign($name,$value) {
        return $this->smarty->assign($name,$value);
    }
    
    /**
     * VSEOutput::fetch()
     * Добавляет к общему выводу шаблон $tepmlate
     * @param mixed $tepmlate
     * @return true
     */
    function fetch($tepmlate){
        $this->html .= $this->smarty->fetch($tepmlate);
    }
    
    
    /**
     * VSEOutput::fetch_html()
     * Добавляет к общему выводу призвольный HTML код
     * @param mixed $html
     * @return true
     */
    function fetch_html($html) {
        $this->html .= $html;
    }
    
    /**
     * VSEOutput::add_message()
     * Добавляет сообщение
     * @param mixed $type Тип сообщения (VSE_MSG_NOTIFY, VSE_MSG_WARNING, VSE_MSG_ERR)
     * @param mixed $text Текст сообщения
     * @return
     */
    function add_message($type,$text) {
            $this->messages[] = array($type,$text);
    }
    
    /**
     * VSEOutput::messages()
     * Возращает сформированый HTML блок отладочных сообщений
     * @param string $separator
     * @return
     */
    function messages($separator = "<br />") {
        // gen message html block
    }
    
    /**
     * VSEOutput::set_cookie()
     * Устанавливает cookies
     * @param mixed $name Имя 
     * @param mixed $value Значение
     * @return true|false
     */
    function set_cookie($name,$value) {
            
    }
    
    /**
     * VSEOutput::clear()
     * Очищает вывод
     * @return false
     */
    function clear() {
        $this->html = '';
    }
    
    function set_templates_dir($dir) {
		
		$dirs['templates'] = './templates/'.$dir;
		$dirs['compile'] = './templates_c/'.$dir;
		
		$r = true;
		foreach ($dirs as $dir) {
			if (!file_exists($dir)) {
				$r = $r && mkdir($dir);
			}
		}
		
		if ($r) {
			$this->smarty->template_dir = $dirs['templates'];
			$this->smarty->compile_dir = $dirs['compile'];
			return true;
		} else {
			return false;
		}
	}
	
	
	function get_tpl_output($template) {
		return $this->smarty->fetch($template);
	}
	
}




?>
