<?php

/**
 * @author petun
 * @copyright 2010
 */
 
 
 /**
  * VSEEvents
  * 
  * @package VSE
  * @author petun
  * @copyright 2010
  * @version $Id$
  * @access public
  */
 class VSEEvents {
    
    static $filename = "";
    
    
    /**
     * VSEEvents::addevent()
     * 
     * @param string Source string
     * @param const $type Тип события (VSE_MSG_NOTIFY, VSE_MSG_WARNING, VSE_MSG_ERR)
     * @param string $message Сообщение
     * @param integer $user_id UserId
     * @return true|false
     */
    function addevent($src,$type,$message,$user_id = 0) {
        
        global $dbw;
        
        $user_id = $user_id ? $user_id : 0;
        
        $r = false;
        
        if ($type && $message) {
            
            $query = sprintf("INSERT INTO core_events_log (event_source,type,message,user_id) VALUES ('%s',%d,'%s',%d)",$src,$type,$message,$user_id);
             
            // write to file
            if (self::$filename) {
                if (!$this->append_to_log(sprintf("%s : Source: %s. Type: %d. Message: %s\n",date("r"),$src,$type,$message))) {
					$query2 = sprintf("INSERT INTO core_events_log (event_source,type,message,user_id) VALUES ('core',%d,'%s',%d)",VSE_MSG_ERR,'Ошибка при записи журнала в файл. Имя файла: '.self::$filename,$user_id);
					$dbw->insert($query2);
					
				}
            }
            
            // write to db
            if ($dbw->insert($query)) {
                $r = true;
            }
        }
        
        return $r;
    }
    
    /**
     * VSEEvents::append_to_log()
     * ДОбавляет запись в лог файл
     * @param mixed $string
     * @return integer|false
     */
    private function append_to_log($string) {
        
        return @file_put_contents(self::$filename,$string,FILE_APPEND);
               
    }
 
 
 }


?>
