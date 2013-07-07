<?php

class VSEStatCoupon {
        
    function __construct($coupon_id){

        global $db;
		$db->select_to_object("SELECT * FROM `view_coupons` WHERE `coupon_id`=".$coupon_id,&$this);
		$this->person = new VSEPerson($this->person_id);
		if ($this->passport_id) $this->person->passport = new VSEDocsPassport($this->passport_id,true);
		if ($this->oms_id) $this->person->polis = new VSEDocsOMSPolis($this->oms_id,true);
        $this->services = $db->select("SELECT * FROM `core_coupon_services_view` WHERE coupon_id = $coupon_id");
		$this->coupon_num .= '/'.date('y',strtotime($this->open_date));
    }
    /**
     * @return true|false
     */
    
	function newCoupon($data){

        global $dbw;
        global $db;  
        
        $num = $db->select_item("SELECT MAX(coupon_num) FROM core_coupon WHERE YEAR(`open_date`) = YEAR(NOW())");
        $data['coupon_num'] = !empty($num) ? (int)$num+1 : 1;
        $fields = array('person_id','send_doctor_id','total_price','open_person_id','coupon_num','department_id');
        
		return $dbw->insert_from_object("core_coupon",$fields,$data);
    }
    
    
    
    
  private $rules = array(
                         'attending_doctor_code'=>array(
                                                      'isDoctorExists'=>array(
                                                                        'label'=>'Код врача указан не верно'
                                                                        )
                                                      )
                         ,'diagnosis_primary_code'=>array('isDSO'=>array('label'=>'Код МКБ-10 диагноза заболевания указан неверно'))
                         ,'diagnosis_secondary_code'=>array('isDSO'=>array('label'=>'Код МКБ-10 диагноза заболевания указан неверно'))
                         ,'goal_code'=>array('isGoalCode'=>array('label'=>'Цель посещения указана неверно'))
                         ,'help_code'=>array('isMedPom'=>array('label'=>'Вид медпомощи указан неверно'))
                         ,'result_code'=>array('isResultCode'=>array('label'=>'Результат обращения указан неверно'))
                         );
  
  private $validationErrors;
  
    
  public function validate($fields = array()) {
      if (empty($fields)) {
        $fields = array_keys($this->rules);
      }
            
      //plog('Fields is '.implode(',' , $fields));
      
      
      // reset all checked fields
      $result = true; $this->validationErrors = array();
      foreach ($fields as $field) {
        if (property_exists($this, $field)) {
          
          //plog('Property exists  - '. $field);
          // check every rool in list
          
          foreach ($this->rules[$field] as $f => $f_props) {
            if (method_exists($this, 'rule_'.$f)) {
              //plog('Check '.'rule_'.$f. ' for property - '.$field .' value='.$this->{$field});
              
              if (!($r =  $this->{'rule_'.$f}($this->{$field}))) {                
                $this->validationErrors[] = $field. ' - '. $f_props['label'];
              }
              
              $result = $result && $r;
            }
          }
        }
      }
      
            
      return $result;      
  }
  
  
  
  public function invalidFields() {
    return $this->validationErrors;
  }
  
  function rule_isDoctorExists($val) {    
    global $db;        
    return (int) $db->select_item("SELECT COUNT(*) FROM core_doctors WHERE code = $val") > 0;
  }
  
  function rule_isDSO($val) { 
    global $db;
    return (int) $db->select_item("SELECT COUNT(*) FROM class_mkb WHERE code = '$val'") > 0; 
  }
  
  function rule_isGoalCode($val) {
    global $db;
    return (int) $db->select_item("SELECT COUNT(*) FROM oms_list_c_pos_st WHERE id = $val") > 0;  
  }
  
  function rule_isMedPom($val) {
    global $db;    
    return (int) $db->select_item("SELECT COUNT(*) FROM oms_list_vmedpom WHERE code = '$val'") > 0;      
  }
  
  
  function rule_isResultCode($val) {
    global $db;    
    return (int) $db->select_item("SELECT COUNT(*) FROM oms_list_ishod WHERE id = $val") > 0;        
  }
  
  
  
	
    /**
    * ГЂГ­Г Г«Г®ГЈ VSEDB::select_row()
    * @return ГЊГ Г±Г±ГЁГў, ГЈГ¤ГҐ ГЄГ«ГѕГ·Г Г¬ГЁ ГїГўГ«ГїГѕГІГ±Гї ГЁГ¬ГҐГ­Г  Г±ГІГ®Г«ГЎГ¶Г®Гў 
    */
    function searchCoupon($coupon_id){

        global $db;
        $query = "
        select 
            CONCAT_WS(' ',core_persons.`fname`,core_persons.`mname`,core_persons.`sname`) as fio,
            CONCAT_WS(' ',core_person_docs_passport.`series`,core_person_docs_passport.`number`) as passport,
            core_coupon.`coupon_id`,
            core_coupon.`ambul_cart_id`,
            core_coupon.`diagnoz_osn`,
            core_coupon.`diagnoz_sop`,
            core_coupon.`code_act_doctor`,
            core_persons.`pension_number`,
            core_coupon.`status`
        from 
            `core_coupon`
        left join 
            core_persons
        on 
            core_coupon.`person_id`=core_persons.`person_id`
        left join 
            core_person_docs_passport
        on 
            core_coupon.`person_id`=core_person_docs_passport.`person_id`
        where 
            core_coupon.`coupon_id`=".intval($coupon_id);
        return $db->select_row($query);
		
    
    }
    
    function close(){
    
        global $dbw;
        if (!$this->close_person_id) return false;
        if (!$this->close_date) $this->close_date = strftime("%Y-%m-%d %H:%M",time());
        return $dbw->q("UPDATE `core_coupon` SET status=1, `close_date`='".$this->close_date."', `close_person_id`=".$this->close_person_id."  WHERE coupon_id=".$this->coupon_id);
        
    }
    
    function open(){
        
        global $dbw;
        return $dbw->q("UPDATE `core_coupon` SET status=0 WHERE coupon_id=".$this->coupon_id);
        //return $dbw->q("UPDATE `core_coupon` SET status=0, `close_date`=NULL, `close_person_id`=NULL  WHERE coupon_id=".$this->coupon_id);
        
    }
                              
    function saveD($data){
                              
        global $dbw;
        global $db;
        $r = true;
        
        // save new services
        $r = $r && $this->save_services($data);
                              
        // Save to coupon
        $fields = array ('passport_id','oms_id','total_price','send_doctor_id','bill_num','payment_type','open_date','department_id');
		$r = $r && $dbw->update_from_array("core_coupon",$fields,"coupon_id=".$this->coupon_id,$data);
        
        if ($data[payment_type] == '3') {
            plog('Add to new table');
            if ($db->select_item("SELECT count(coupon_id) FROM oms_coupons WHERE coupon_id=".$this->coupon_id) == 0){
                $q = "INSERT INTO oms_coupons (coupon_id,person_id,doc_id,polis_id,dbeg) VALUES (".$this->coupon_id.",".$this->person_id.",".$data[passport_id].",".$data[oms_id].",'".$this->open_date."')"; 
                plog($q);
                $r = $r && $dbw->q($q);

            }

        }
        
        return $r;
                              
    }
    
    private function save_services($data) {
                              
        global $dbw;
        global $db;
        $r = true; $i=0;
        $upd_serv_id = array(0);
        $old_serv_id = $db->select_column("SELECT serv_id FROM core_coupon_services WHERE coupon_id=".$this->coupon_id);
                              
        if ($data['service_id']) foreach ($data['service_id'] as $service_id) {
            if ($service_id != "") {
                $s = $db->select_row("SELECT number,`name` FROM price_data WHERE id=$service_id");
                $q = sprintf("insert into core_coupon_services (coupon_id, service_id, service_name, service_price, service_comment, service_id_doc, service_code_mkb, service_yet, service_count) values (%d,%d,'%s',%f,'%s',%d,'%s','%s',%d)",$this->coupon_id,$service_id,$s['name'],$data['service_price'][$i],$data['service_comment'][$i],$data['service_id_doc'][$i],$data['service_code_mkb'][$i],$s['yet'],$data['service_count'][$i]);
            }
            elseif ($data['serv_id'][$i] != "") {
                $q = sprintf("update core_coupon_services set service_comment='%s', service_id_doc=%d, service_code_mkb='%s', service_count=%d WHERE serv_id=%d", $data['service_comment'][$i],$data['service_id_doc'][$i],$data['service_code_mkb'][$i],$data['service_count'][$i],$data['serv_id'][$i]);
                $upd_serv_id[] = $data['serv_id'][$i];

            }
            $r = $r && $dbw->q($q);
            $i++;
        }
        if (!$old_serv_id) $old_serv_id = array(0);
        $new_serv_id = $db->select_column("SELECT serv_id FROM core_coupon_services WHERE coupon_id=".$this->coupon_id." AND serv_id NOT IN (".implode(',', $old_serv_id).")");
        if (!$new_serv_id) $new_serv_id = array(0);
        $r = $r && $dbw->q("DELETE FROM core_coupon_services WHERE coupon_id=".$this->coupon_id." AND serv_id NOT IN (".implode(',', $new_serv_id).",".implode(',', $upd_serv_id).")");
        return $r;
                              
    }
    
    private function save_new_services() {
        
        global $dbw;
        global $db;
        $r = true;
         // Save additional services
        if ($this->new_services) {
            foreach ($this->new_services as $service) {
				$service_yet = $db->select_item("SELECT number FROM price_data WHERE id='".$service['service_id']."'");
                $q = sprintf("insert into core_coupon_services(coupon_id,service_id,service_name,service_price,service_comment,service_id_doc,service_code_mkb,service_yet,service_count) values (%d,%d,'%s',%f,'%s',%d,'%s','%s',%d)",
                $this->coupon_id,$service['service_id'],$service['service_name'],$service['service_price'],$service['service_comment'],$service['service_id_doc'],$service['service_code_mkb'],$service_yet,$service['service_count']);
                $r = $r && $dbw->q($q);
            }
        }
        
        return $r;
        
    }
	
	private function update_services() {
        
        global $dbw;
        
        $r = true;
         // Save additional services
        if (is_array($this->upd_services)) {
            foreach ($this->upd_services as $service) {
				
                $q = sprintf("update core_coupon_services set service_comment='%s', service_id_doc=%d, service_code_mkb='%s', service_count=%d WHERE serv_id=%d",
                $service['service_comment'],$service['service_id_doc'],$service['service_code_mkb'],$service['service_count'],$service['serv_id']);
                $r = $r && $dbw->q($q);
            }
        }
        
        return $r;
        
    }
    /**
     * @return true|false
     */
    function delete($coupon_id){

        global $dbw;
		$dbw->q ("DELETE FROM `core_coupon` WHERE `coupon_id`=".$coupon_id);

    }
    
    function unactive($close_person_id) {
        global $dbw;
		$r = $dbw->q("DELETE oms_coupons WHERE coupon_id = ".$this->coupon_id);
		return $r && $dbw->q("UPDATE core_coupon SET status=2, close_person_id=$close_person_id WHERE coupon_id = ".$this->coupon_id);
    }    
    
    function change_bill_date($new_date) {
        global $dbw;
        return $dbw->q("UPDATE core_coupon SET bill_date = '$new_date' WHERE coupon_id=".$this->coupon_id);
    }
    
    function validateOmsServices() {
      global $db;
      
      //plog('validateOmsServices begin' . print_r($this->doctor_code,true));
            
      $doctors = $db->select_prepare_options('SELECT doctor_id, code FROM core_doctors');
      $visits = $db->select_prepare_options('SELECT id, code FROM oms_visit_types');
      $prices = $db->select_prepare_options('SELECT name,code FROM oms_list_idprof');
      
      
      
      if (!empty($this->doctor_code)) {
        
        //plog('validateOmsServices services exists');
        
        foreach ($this->doctor_code as $i=>$value) {
          // doctor
          if (!in_array($this->doctor_code[$i], $doctors)) {
            //plog("check doctor - $i - ".$this->doctor_code[$i]);
            $this->validationErrors[] = 'Неверно указан код врача';
            return false;
          }
          
          // visit code
          if (!in_array($this->visit_code[$i], $visits)) {
            //plog("check visit_code - $i - ".$this->visit_code[$i]);
            $this->validationErrors[] = 'Неверно указан код посещения';
            return false;
          }
          
          
          //date 
          if (empty($this->visit_date[$i])) {
            $this->validationErrors[] = 'Неверно указана дата посещения';
            return false;
          }
          
          // oms_list_idprof
          if (!in_array($this->price_code[$i],$prices)) {
            //plog('check price_code - '.$this->price_code[$i]);
            $this->validationErrors[] = 'Неверно указан код услуги';
            return false;
          } 
          
          // count of services 
          if ( (int)$this->service_count[$i] < 1 ) {
            //plog('check service_count - '.$this->service_count[$i]);
            $this->validationErrors[] = 'Неверно указано количество услуг';
            return false;
          }   
          
          
        }        
      }
      
      //plog('validateOmsServices Complite');
      return true;
    }
    
    function save(){        
        global $dbw;
        // Validate Date
    		if ($this->close_date=="") $this->close_date="NULL";
    		if ($this->close_person_id=="") $this->close_person_id="NULL";
                        
        // save new services
        $this->save_new_services();
		    $this->update_services();
        
    		// Save to coupon
    		$fields = array ('passport_id'
                             ,'oms_id'
                             ,"attending_doctor_id"
                             ,"secondary_doctor_id"
                             ,"close_date"
                             ,"total_price"
                             ,"send_doctor_id"
                             ,"close_person_id"
                             ,"status"
                             ,"bill_num"
                             ,'payment_type'
                             ,'open_date'
                             ,'diagnosis_primary_code'
                             ,'diagnosis_secondary_code'
                             ,'injury_code'
                             ,'payment_code'
                             ,'disability_sheet_open'
                             ,'disability_sheet_close'
                             ,'result_code'
                             ,'disp_code'
                             ,'help_code'
                             ,'goal_code'
                             ,'attending_doctor_code'
                             ,'places_id'
                             ,'department_id');
    		$dbw->update_from_object("core_coupon",$fields,"coupon_id=".$this->coupon_id,$this);
    		
        
        
        
            for ($i=0;$i<$this->visits_number;$i++)
            {
    			$coupon_id= $this->coupon_id;
    			$doctor_code= $this->doctor_code[$i];
    			$visit_code= $this->visit_code[$i];
    			$visit_date= $this->visit_date[$i];
    			$price_code= $this->price_code[$i];
          $service_count= $this->service_count[$i];
    			if (($doctor_code!="") && ($visit_code!="") && ($visit_date!="")) {
    				//echo "INSERT INTO `core_coupon_to_doctor` SET `coupon_id`='$coupon_id', `doctor_code`='$doctor_code', `visit_code`='$visit_code', `visit_date`='$visit_date', `price_code`='$price_code'";
    				$dbw->insert ("INSERT INTO `oms_coupon_services` SET
                                  `coupon_id`='$coupon_id', 
                                  `doctor_code`='$doctor_code', 
                                  `visit_code`='$visit_code', 
                                  `visit_date`='$visit_date', 
                                  `price_code`='$price_code',
                                  `service_count`='$service_count'");
                                  }
                                  }
                                  if ($this->delete_visits != "") 
                                  $dbw->q("delete from `core_coupon_to_doctor` where id in (".$this->delete_visits.")");		
                                  
                                  return true;
                                  
                                  }
    
}

?>