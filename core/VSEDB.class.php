<?php

define("PMYSQLI_SELECT_TYPE", 1);
define("PMYSQLI_INSERT_TYPE", 2);
define("PMYSQLI_OTHER_TYPE", 3);

/**
 * VSEDB
 * 
 * @package VSE
 * @author petun
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class VSEDB {

	private $debug_buffer = array();
    // MySQLi Object
    public $mysqli;
    // Erroros
    public $err_buffer = array();
    // Queryes array
    public $query_stack = array();

    /**
     * VSEDB::__construct()
     * 
     * @return
     */
    function __construct() {
		
		global $config;
		

        $this->mysqli = new mysqli($config['dbhost'], $config['dbusername'], $config['dbpassword'], $config['dbname']);

        if (!$this->mysqli) { // TUT NE RABOTAET!!! ESLI NEPRAVILNO USER AND PASS
            $this->err_buffer[] = mysqli_connect_error();
        } else {
           
           $this->mysqli->query("SET NAMES '" . $config['db_charset'] . "'");
            
                
            $this->debug_buffer[] = sprintf("Host info: %s",$this->mysqli->host_info);
            $this->debug_buffer[] = sprintf("Proto version: %s",$this->mysqli->protocol_version);
            $this->debug_buffer[] = sprintf("Server: %s (%s)",$this->mysqli->server_info , $this->mysqli->server_version);

            //NOT PROPERLY WORKED ON OLD MYSQL SERVSERS
            $this->debug_buffer[] = "Current character set is " . $this->mysqli->character_set_name();
        }
    }


    /**
     * If Query return false, then return false. IF query is enmpty, return empty.
     * If Query is OK. Return mysqli->result.
     */
    /**
     * VSEDB::preload_query()
     * 
     * @param mixed $query
     * @param mixed $op_type
     * @return 
     */
    private function preload_query($query, $op_type) {

        $this->query_stack[] = $query;

        if ($result = $this->mysqli->query($query)) {

			$this->debug_buffer[] = sprintf("Query: %s. (%s)",$query,microtime());
			
			
            switch ($op_type) {

                case PMYSQLI_SELECT_TYPE:

                    if ($result->num_rows > 0) {

                        return $result;

                    } else {

                        return array();
                    }

                    break;

                case PMYSQLI_INSERT_TYPE:

                    return $this->mysqli->insert_id ? $this->mysqli->insert_id:
                    $this->mysqli->affected_rows;

                    break;

                case PMYSQLI_OTHER_TYPE:

                    return $this->mysqli->affected_rows;

                    break;
            }

        } else {
            $this->err_buffer[] = $this->mysqli->error . ". Query is: ".$query."\n";
            return false;
        }
    }

    /**
     * VSEDB::select()
     * 
     * @param mixed $query
     * @param mixed $return_accos
     * @return Массив полученных значений
     */
    public function select($query, $return_accos = MYSQLI_ASSOC) {

        if ($result = $this->preload_query($query, PMYSQLI_SELECT_TYPE)) {

            while ($row = $result->fetch_array($return_accos)) {
                $r[] = $row;
            }
            return $r;

        } else {

            return $result;
        }
    }

    /**
     * VSEDB::select_row()
     * 
     * @param mixed $query
     * @param mixed $return_accos
     * @return Массив, где ключами являются имена столбцов
     */
    public function select_row($query, $return_accos = MYSQLI_ASSOC) {

        if ($result = $this->preload_query($query, PMYSQLI_SELECT_TYPE)) {

            return $result->fetch_array($return_accos);

        } else {

            return $result;
        }
    }

     /**
     * VSEDB::select_item()
     * 
     * @param mixed $query
     * @return Единичное значение
     */
    public function select_item($query) {

        if ($result = $this->preload_query($query, PMYSQLI_SELECT_TYPE)) {

            list($r) = $result->fetch_array(MYSQLI_NUM);
            
            if (!empty($r)) {
                return $r;    
            } else {
                return false;
            }
        } else {
            return $result;
        }
    }


    /**
     * VSEDB::select_prepare_options()
     * 
     * @param mixed $query
     * @return Массив, ключами являются результаты из первой колонки, а ззначения из второй
     */
    public function select_prepare_options($query) {
        if ($items = $this->select($query, MYSQLI_NUM)) {

            foreach ($items as $item) {
                $result[$item[0]] = $item[1];
            }
            return $result;

        } else {

            return false;
        }
    }
    
    /**
     * VSEDB::select_column()
     * 
     * @param mixed $query
     * @return Массив значений первой колонки
     */
    public function select_column($query) {
        if ($items = $this->select($query, MYSQLI_NUM)) {
            
            if (count($items)) {
                foreach ($items as $item) {
                    $result[] = $item[0];
                }
                return $result;    
            } else {
                return array();
            }
            

        } else {
            
            

            return false;
        }
    }
    
    
    /**
     * VSEDB::insert()
     * 
     * @param mixed $query
     * @return Возращает ID новой записи, либо false если ошибка в запросе
     */
    public function insert($query) {
    	$r = $this->preload_query($query, PMYSQLI_INSERT_TYPE);
    	return $r ? $r : false;	
    }
    
    
     /**
      * VSEDB::q()
      * 
      * @param mixed $query
      * @return Количество true if ok, false если запрос с ошибкой
      */
     public function q($query) {
     	$r = $this->preload_query($query, PMYSQLI_OTHER_TYPE);
        if ($r != -1) {
            return true;
        } else {
            return false;
        }
     }
     
     
      /**
       * VSEDB::debug_output()
       * Выводит отладочную информацию
       * 
       * @param string $separator
       * @param bool $is_show
       * @return
       */
      public function debug_output($separator = "<br>",$is_show = true) {
      	
      	$msg = implode($separator,$this->debug_buffer) . $separator;
      	
   		$msg .= "<b>Error's:</b>".$separator;
		$msg .=  implode($separator,$this->err_buffer) . $separator;
   		
      	$msg .= "<b>Query List:</b>".$separator;
      	$msg .= implode($separator,$this->query_stack) . $separator;
      	
      	//$msg .= $separator."<b>Most Used Query List:</b>".$separator.$this->mysqli->info.$separator;
      	if ($is_show) {echo $msg; return;} else {return $msg;}
      	
      }
      
      
      /**
       * VSEDB::escape_string()
       * 
       * @param mixed $string
       * @return
       */
      public function escape_string($string) {
        return $this->mysqli->real_escape_string($string);
      }
      
      
      /**
       * VSEDB::select_to_object()
       * 
       * @param mixed $query
       * @param mixed $object
       * @return
       */
      public function select_to_object ($query,$object) {
			
			$item = $this->select_row($query);
			
			if ($item) {
				
				foreach ($item as $key=>$value) {
					$object->$key = $value;
				}
				return true;	
			} else {
				return false;
			}
	  }
	  
      
      /**
       * 
       * 
       */
	  /**
	   * VSEDB::update_from_object()
	   * 
	   * @param mixed $table
	   * @param mixed $fields
	   * @param mixed $where
	   * @param mixed $object
	   * @return
	   */
	  public function update_from_object ($table,$fields,$where,$object) {
			
			foreach ($fields as $value) {
				if (isset($object->$value)) {
					if ($object->$value != "") $items[] = "`".$value."` = '".$object->$value."'";
					else $items[] = "`".$value."` = NULL";
				}
			}
			if ($items)	return $this->q ("UPDATE $table SET ".implode (",",$items)." WHERE $where");
			else return false;
			
	  }
	  /**
	   * VSEDB::update_from_array()
	   * 
	   * @param mixed $table
	   * @param mixed $fields
	   * @param mixed $where
	   * @param mixed $array
	   * @return
	   */
	  public function update_from_array ($table,$fields,$where,$array) {
			
			
			foreach ($fields as $value) {
				if (isset($array[$value])) {
					if ($array[$value] != "") $items[] = "`".$value."` = '".$array[$value]."'";
					else $items[] = "`".$value."` = NULL";
				}
			}
		
			return $this->q ("UPDATE $table SET ".implode (",",$items)." WHERE $where");  
	  }
	  
      /**
       * INSERT DATA FROM Object
       */
      /**
       * VSEDB::insert_from_object()
       * 
       * @param mixed $table
       * @param mixed $fields
       * @param mixed $data
       * @return
       */
      public function insert_from_object($table,$fields,$data) {
            
            foreach ($fields as $field) {
                if (isset($data[$field])) $items[] = "`".$field."` = '".$data[$field]."'";   
            }
            
            return $this->insert("INSERT INTO $table SET ".implode (",",$items));
      }
     


}

?>
