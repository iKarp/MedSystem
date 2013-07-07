<?php
 class VSERegistry {
    protected static $instance;  // object instance
    private function __construct(){ /* ... @return Singleton */ }  // Защищаем от создания через new Singleton
    private function __clone()    { /* ... @return Singleton */ }  // Защищаем от создания через клонирование
    private function __wakeup()   { /* ... @return Singleton */ }  // Защищаем от создания через unserialize
    public static function getInstance() {    // Возвращает единственный экземпляр класса. @return Singleton
        if ( is_null(self::$instance) ) {
            self::$instance = new VSERegistry ();
        }
        return self::$instance;
    }
    
    
    private $storage = array();
    
    public function set($key,$value) { 
        $this->storage[$key] = $value;
    }
    public function get($key) { 
        if (array_key_exists($key, $this->storage)) {
            return $this->storage[$key];
        } else {
            plog('key '.$key.' not exists in storage');
        }
    }
 }