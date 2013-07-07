<?php



class rudates {
    
    private $months = array(
        1=>"Января"
        ,2=>"Февраля"
        ,3=>"Марта"
        ,4=>"Апреля"
        ,5=>"Мая"
        ,6=>"Июня"
        ,7=>"Июля"
        ,8=>"Августа"
        ,9=>"Сентября"
        ,10=>"Октября"
        ,11=>"Ноября"
        ,12=>"Декабря"
    );
    
    
    function unix2rus($ctime = "", $format = "%d --%m-- %Y, %H:%M") {
        
        $ctime = empty($ctime) ? time() : $ctime;
    
        $r = strftime($format,$ctime);
           
        $r = preg_replace_callback("/--(\d{1,2})--/",array($this,'get_rus_month'),$r);
        
        return $r;
    }
    
    function mysqld2rus($ctime,$format = "%d --%m-- %Y, %H:%M") {
        $r = strtotime ($ctime);
        if ($r) {
            return $this->unix2rus($r,$format);
        } else {
            return false;
        }
    }
    
    private function get_rus_month($num) {
        $num = $num[1]*1;
        return $this->months[$num];
    }
    
    
    
}



/*



echo $d->unix2rus('',"%d --%m--");
echo $d->unix2rus('',"%d --%m-- %Y");

echo $d->mysqld2rus('20-11-2010 22:40:00');




*/



?>

