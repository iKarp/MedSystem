<?php

/**
 * @author petun
 * @copyright 2010
 */


define (ARM_NAME,"main");

require_once ($_SERVER['DOCUMENT_ROOT']."/config.php");
$VSECore->CheckAuth();
$VSECore->InitArm(ARM_NAME);

$VSECore->LoadModule('docs');
$VSECore->LoadModule('coupon');

if (!$_GET['coupon_id']) {exit;}

function GetFormatedDate($str) {
   if (preg_match("/^(\d{4})\-(\d{2})\-(\d{2})$/",$str,$m)) {
        return $m[3].$m[2].$m[1];
   } else {
        return false;
   }
}

$coupon = new VSEStatCoupon($_GET['coupon_id']);
$person = new VSEDocsPerson($coupon->person_id);

	if($person->polis->soato_code == "1122"){
			$person->polis->oms_organization->name = $db->select_item("SELECT CONCAT(CAST(`kod_f` as CHAR),'. ',`name`,' (',`name_go`,')') as name FROM core_oms_organizations_list WHERE oms_organization_id='".$person->polis->oms_organization->oms_organization_id."'");
	}
	else{
			$person->polis->oms_organization->name = $db->select_item("SELECT   q_name AS name FROM core_oms_rf WHERE smo_rf_id='".$person->polis->oms_organization->oms_organization_id."'");		  
	}
	
	

//print_r($person);

//$VSECore->output->assign('date_end',$date_end);

//$VSECore->output->assign('doctor_code','XXXXXXXXXX');
//$VSECore->output->assign('event_code','XXXXXX');
	
	
if($_GET['type_of_dialog'] == 4 OR $_GET['type_of_dialog'] == 5 OR $_GET['type_of_dialog'] == 6){ 
	$coupon->person->birthday_f = GetFormatedDate($coupon->person->birthday);
	$coupon->person->passport->give_out_date = GetFormatedDate($person->passport->give_out_date);
	$coupon->open_date = GetFormatedDate(substr($coupon->open_date,0,10)); 
	//$date_begin = strftime("%d%m%Y",time());
	//$date_end = 'XXXXXXXX';

	
	$VSECore->output->assign('date_begin',$date_begin);
	
	//if ($coupon->oms_id == '') $VSECore->output->assign('passport_only',true);
	//else $VSECore->output->assign('passport_only',false);

}
else{
	$doctors = $db->select_prepare_options("SELECT doctor_id,person_fio FROM view_doctors WHERE hospital_id = 1");


	// GET BEGIN DATE
	$unix_time = strtotime($coupon->open_date);
	$day = strftime('%d',$unix_time);
	$year = strftime('%Y',$unix_time);

	$months = array
	('1'=>'Января','2'=>'Февраля','3'=>'Марта','4'=>'Апреля','5'=>'Мая','6'=>'Июня','7'=>'Июля','8'=>'Августа',
	'9'=>'Сентября','10'=>'Октября','11'=>'Ноября','12'=>'Декабря');
	$month = $months[strftime('%m',$unix_time)*1];

	$date_begin = "« $day » $month $year г.";

	$coupon_num_year = strftime('%y',$unix_time);


	//$date_end = 'XXXXXXXX';


	$VSECore->output->assign('date_begin',$date_begin);

	$VSECore->output->assign('coupon_num_year',$coupon_num_year);
	$VSECore->output->assign('doctors',$doctors);
	$VSECore->output->assign('p_birthday',strtotime($person->birthday));


//print_r($coupon);

//$VSECore->output->assign('date_end',$date_end);

//$VSECore->output->assign('doctor_code','XXXXXXXXXX');
//$VSECore->output->assign('event_code','XXXXXX');
}
//print_r($coupon);
//print_r($person);
	$VSECore->output->assign('person',$person);
	$VSECore->output->assign('coupon',$coupon);

			
			

// выбор печати
if ($_GET['type_of_dialog'] == 1) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/agreement_type_A.tpl');    
} 
elseif ($_GET['type_of_dialog'] == 2){
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/agreement_type_B.tpl');
} 
elseif ($_GET['type_of_dialog'] == 3) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/pf_consent_for_ct.tpl');
}
elseif ($_GET['type_of_dialog'] == 4) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/coupon_a.tpl');
}
elseif($_GET['type_of_dialog'] == 5) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/coupon_all.tpl');
}
elseif($_GET['type_of_dialog'] == 6) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/coupon_stomatology.tpl');
}
elseif($_GET['type_of_dialog'] == 7) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/coupon_all_clear.tpl');
}
elseif($_GET['type_of_dialog'] == 8) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/OMK1.tpl');
}
elseif($_GET['type_of_dialog'] == 9) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/OMK2.tpl');
}
elseif($_GET['type_of_dialog'] == 10) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/OMK3.tpl');
}
elseif($_GET['type_of_dialog'] == 11) {
    $VSECore->output->fetch($_SERVER['DOCUMENT_ROOT'].'/main/pforms/OMK4.tpl');
}

$VSECore->output->body();

//print_r($person);
?>