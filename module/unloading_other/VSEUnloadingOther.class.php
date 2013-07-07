<?php

class VSEUnloadingOther {
	public $dbf_name = "" ;       // VC25551
	public $code_orgn = "";
/*	// при создании запроса ? формирования данных
	protected $code_orgn = "";   // код головной организации
	protected $source_financing = ""; // источник финансирования
	protected $article = ""; // по всем статьям расчет
	protected $d_beg_coupon = "";   // период талонов с
	protected $d_end_coupon = "";     // по такое число
	protected $d_beg_calc = "";              // период расчета с
	protected $d_end_calc = "";                // по такое число
	protected $number_document = ""; // номер документа в месяце
	protected $raschet_chet = ""; // к платежно - рачетному документы № (6 символов)
	protected $raschet_chet_date = ""; // от даты
*/
	// из списка выбираеться  , наменование организации кому выставлен счет
	// для счет-фактура
	public $lpu_k1 = OMS_LPU_K1; // код ЛПУ
	public $lpu_k2 = OMS_LPU_K2; // код ЛПУ
	public $lpu_name = OMS_LPU_NAME; // наименование организации выставивший счет
	public $kod_raion = OMS_LPU_KOD_RAION;
	public $smo_name = "ПЧ-57";
	public $ur_lpu = OMS_UR_LPU;  // категория ЛПУ
	//public $vid_med = OMS_VID_MED;  // код вида мед помощи | добавлен фильтр выбора 
	public $inn = OMS_LPU_INN;  // ИНН организации
	//protected $nom_ch = "1111"; // номер счета фактуры  (4 символа )
	//protected $date_ch = "11.11.1111"; // дата (11.11.1111)
	public $ed_izm = "ПОСЕЩЕНИЕ";
	//protected $kolvo = "555"; // общее число записей
	//protected $summ_ch = "5555";
	//protected $date_per = "01.08.2010";  // дата формирования
	public $fail_ch = "2" ; // .$dbf_name; // имя файла мед помощи
	public $reestr_id =''; // номер реестра
	public $tarif ='';

	function __construct (	$reestr_id=0,
							$code_orgn='0',
							$source_financing='',
							$d_beg_coupon='2010-01-01',
							$d_end_coupon='2010-02-01',
							$d_beg_calc='2010-01-05',
							$d_end_calc='2010-01-25',
							$article='2',
							$help_code=2,
							$other=0) 
	{
		global $db,$dbw; 
		if($reestr_id !=0){
			$db->select_to_object("SELECT * FROM `reestr_id` WHERE `reestr_id`=".$reestr_id,&$this);
		}
		else{
			$number_document = "1";
			if(empty($code_orgn)){
				$code_orgn = "000";
			}
			else {
				$this->code_orgn = " coo.kod_go = ".$code_orgn." AND ";
			}
			switch($article){
				case 1: $this->tarif = "cds.tar_l+cds.tar_tr1"; break;
				case 2: $this->tarif = "cds.tar_l1+cds.tar_tr"; break;
				case 3: $this->tarif = "cds.tar_l+cds.tar_l1"; break;
				default : $this->tarif = "cds.tar_l+cds.tar_l1+cds.tar_l2"; break;
			}
			// выделяем месяц
        	$month = substr($d_beg_calc,5,2);
        	switch($month) {
        		case "01": $month="1";  break;
        		case "02": $month="2";  break;
        		case "03": $month="3";  break;
        		case "04": $month="4";  break;
        		case "05": $month="5";  break;
        		case "06": $month="6";  break;
        		case "07": $month="7";  break;
        		case "08": $month="8";  break;
        		case "09": $month="9";  break;
        		case "10": $month="A";  break;
        		case "11": $month="B";  break;
        		case "12": $month="C";  break;
        	}
        	// выделяем год
        	$year = substr($d_end_calc,2,2);

			$this->vid_med = $db->select_item("SELECT scode FROM oms_help_types where code=$help_code");
        	// формируем имя dbf
			$this->dbf_name = $this->lpu_k1.$this->vid_med.$month.$year.$number_document;
        	$this->fail_ch .= $this->dbf_name;
		
			$this->reestr_id = $dbw->insert("INSERT INTO reestr_id SET 
					code_orgn='$code_orgn', 
					source_financing='$source_financing', 
					d_beg_coupon='$d_beg_coupon',
					d_end_coupon='$d_end_coupon',
					d_beg_calc='$d_beg_calc',
					d_end_calc='$d_end_calc',
					article='$article',
					help_code='$help_code',
					dbf_name='$this->dbf_name',
					fail_ch='',
					other='$other'");	
		} 
	}

	function CreateOtherDBF (){
		// создание .dbf Паспортаная часть
		$def1 = array(
		  array("NPR", 			"N", 	7,0),
		  array("NPP",			"N",	7,0),
		  array("N_REGI",		"N",	3,0),
		  array("NOVOR",		"C",	9),
		  array("FAM",			"C",	40),
		  array("IM",			"C",	40),
		  array("OTCH",			"C",	40),
		  array("DR",			"D",	8),
		  array("POL",			"C",	1),
		  array("FAM_R",		"C",	40),
		  array("IM_R",			"C",	40),
		  array("OTCH_R",		"C",	40),
		  array("DR_P",			"D"		),
		  array("W_P",			"C",	1),
		  array("MR",			"C",	100),
		  array("SNILS",		"C",	14),
		  array("VPOLIS",		"N",	1,0),
		  array("SPOLIS",		"C",	10),
		  array("NPOLIS",		"C",	20),
		  array("DOC_TIP",		"N",	2,0),
		  array("DOC_SER1",		"C",	10),
		  array("DOC_NUM",		"C",	20),
		  array("VMEDPOM",		"N",	2,0),
		  array("VIDPOM",		"N",	4,0),
		  array("IDPROF",		"N",	5,0),
		  array("IDPROF1",		"N",	4,0),
		  array("PROFIL",		"N",	3,0),
		  array("DET",			"N",	1,0),
		  array("DS0",			"C",	7),
		  array("DSO",			"C",	7),
		  array("DS_S",			"C",	7),
		  array("DBEG",			"D",	8),
		  array("DEND",			"D",	8),
		  array("TARIF",		"N", 	10,2),
		  array("FACT_DN",		"N",	3,0),
		  array("KOL_YE",		"N",	5,2),
		  array("KOD_USL",		"C",	10),
		  array("KOD_VRL",		"N",	6,0),
		  array("STS",			"N",	3,0),
		  array("ISHOD",		"N",	3,0),
		  array("RSLT",			"N",	3,0),
		  array("SUMMA",		"N",	11,2),
		  array("IDGOSP",		"N",	1,0),
		  array("REGN_LPU",		"N", 	7,0),
		  array("DATAKEK",		"D",	8),
		  array("NKEK",			"C",	6),
		  array("KOL_USL",		"N",	3,0),
		  array("PRVS",			"C",	9),
		  array("DATE_NS",		"D",	8),
		  array("DOPTARIF",		"N", 	10,2),
		  array("DOPSUMMA",		"N",	12,2),
		  array("EXTR",			"N",	2,0),
		  array("IDOTD",		"C",	4),
		  array("NCARD",		"C",	50),
		  array("OKATOP",		"C",	11),
		  array("ADR_REG",		"C",	11),
		  array("ADR_RAION",	"C",	150),
		  array("ADR_PUNKT",	"C",	150),
		  array("ADR_ULICA",	"C",	150),
		  array("ADR_DOM",		"C",	7),
		  array("ADR_KORP",		"C",	5),
		  array("ADR_KVART",	"C",	5),
		  array("Q_NP",			"N",	2,0),
		  array("Q_UL",			"N",	2,0)
		);
		// creating
		if (!dbase_create("Z".$this->dbf_name.".dbf", $def1)) {
		  echo "Ошибка при создании Общей Части(dbf)\n";
		}
	}

	function CreateSchetDBF(){
		// создание .dbf счет-фактура
		$def3 = array (
			array("LPU_K1", 	"C", 	2),
			array("LPU_K2", 	"C", 	2),
			array("LPU_NAME", 	"C", 	100),
			array("SMO_NAME", 	"C", 	100),
			array("UR_LPU", 	"N", 	2, 0),
			array("VID_MED", 	"C", 	2),
			array("INN", 		"N", 	12, 0),
			array("DATE_CH", 	"D"	),
			array("NOM_CH", 	"C", 	30),
			array("ED_IZM", 	"C", 	10),
			array("KOLVO", 		"N", 	12, 2),
			array("SUMM_CH", 	"N", 	12, 2),
			array("DATE_PER", 	"D"	),
			array("FAIL_CH", 	"C", 	12)
		);
		if (!dbase_create("8".$this->dbf_name.".dbf", $def3)) {
		  echo "Ошибка при создании Счет-Фактуры(DBF)\n";
		}
	}

	function CreateZip(){
		// упакова
		$zip = new ZipArchive();
		if ($zip->open("8".$this->dbf_name.".".$this->code_orgn, ZIPARCHIVE::CREATE) !== true) {
		    fwrite(STDERR, "Ошибка создания архива");
		    exit(1);
		}
		$zip->addFile("Z".$this->dbf_name.".dbf","Z".$this->dbf_name.".dbf");
		$zip->addFile("8".$this->dbf_name.".dbf","8".$this->dbf_name.".dbf");

		$zip->close();

		// for windows
		//chown("1".$this->dbf_name.".dbf",777);
		//chown("2".$this->dbf_name.".dbf",777);
		//chown("6".$this->dbf_name.".dbf",777);
		//unlink("1".$this->dbf_name.".dbf");
		//unlink("2".$this->dbf_name.".dbf");
		//unlink("6".$this->dbf_name.".dbf");
		$link = "8".$this->dbf_name.".".$this->code_orgn."";
		return $link;
	}

	function iconvArray($inputArray,$newEncoding){
		$outputArray=array();
		if ($newEncoding!=”){
			if (!empty($inputArray)){
				foreach ($inputArray as $key => $element){
					if (!is_array($element)){
						$element=iconv("windows-1251",$newEncoding,$element);
					}
					else {
						$element=$this->iconvArray($element, $newEncoding);
					}
					$outputArray[$key]=$element;
				}
			}
		}
		return $outputArray;
	}

	function InsertOtherDBF (){
		// заполнения данными паспортную часть
		global $db;
		// выбор данных для паспортной части
		$myrow = $db->select("SELECT * FROM reestr_other WHERE reestr_id='$this->reestr_id'");
		$myrow = VSEUnloading::iconvArray($myrow,"cp866");
		$dbf_other = dbase_open("Z".$this->dbf_name.".dbf", 2);
		foreach ($myrow AS $r) {			
			
			if($r[pol] == '2') $r[pol]=iconv("windows-1251","cp866","М"); elseif($r[pol] == '1') $r[pol]=iconv("windows-1251","cp866","Ж");
			if($r[w_p] == '2') $r[w_p]=iconv("windows-1251","cp866","М"); elseif($r[w_p] == '1') $r[w_p]=iconv("windows-1251","cp866","Ж");
			if($r[file_vid] ==1) $r[file_vid]="F"; else $r[file_vid]="S";
			$dr = $this->Date_edit($r[dr]);		// обработка даты рождения
			$dr_p = $this->Date_edit($r[dr_p]);		// обработка даты рождения
			$dbeg = $this->Date_edit($r[dbeg]);
			$dend = $this->Date_edit($r[dend]);
			//$r[fname] = iconv("windows-1251", "cp866", $r[fname]);
			// добавление в паспортную часть данных
			list($dom,$kor) = explode ("/",$r[build_number]);
			dbase_add_record($dbf_other, array(
			$r[npr],
			$r[npp],
			$r[n_regi],
			$r[novor],
			$r[fam],
			$r[im],
			$r[otch],
			$dr,
			$r[pol],
			$r[fam_r],
			$r[im_r],
			$r[otch_r],
			$dr_p,
			$r[w_p],
			$r[mr],
			$r[snils],
			$r[vpolis],
			$r[spolis],
			$r[npolis],
			$r[doc_tip],
			$r[doc_ser1],
			$r[doc_num],
			$r[vmedpom],
			$r[vidpom],
			$r[idprof],
			$r[idprof1],
			$r[profil],
			$r[det],
			$r[ds0],
			$r[dso],
			$r[ds_s],
			$dbeg,
			$dend,
			$r[tarif],
			$r[fact_dn],
			$r[kol_ye],
			$r[kod_usl],
			$r[kod_vrl],
			$r[sts],
			$r[ishod],
			$r[rslt],
			$r[summa],
			$r[idgosp],
			$r[regn_lpu],
			$r[datakek],
			$r[nkek],
			$r[kol_usl],
			$r[prvs],
			$r[date_ns],
			$r[doptarif],
			$r[dopsumma],
			$r[extr],
			$r[idotd],
			$r[ncard],
			$r[okatop],
			$r[adr_reg],
			$r[adr_raion],
			$r[adr_punkt],
			$r[adr_ulica],
			$r[adr_dom],
			$r[adr_korp],
			$r[adr_kvart],
			$r[q_np],
			$r[q_ul]));
			
		}
		dbase_close($dbf_other);
	}
	
	function InsertChetDBF(){
		global $db;
		// заполнение данными счет-фактуру
		// выборка данных для счет фактура
		$myrow_chet = $db->select_row("SELECT * FROM reestr_chet WHERE reestr_id='$this->reestr_id'");
		$myrow_chet = $this->iconvArray($myrow_chet,"cp866");
		$dbf_chet = dbase_open("8".$this->dbf_name.".dbf", 2);
		
			$date_ch = $this->Date_edit($myrow_chet[date_ch]);
			$date_per = $this->Date_edit($myrow_chet[date_per]);
			dbase_add_record($dbf_chet, array(
			$myrow_chet[lpu_k1],
			$myrow_chet[lpu_k2],
			$myrow_chet[lpu_name],
			$myrow_chet[smo_name],
			$myrow_chet[ur_lpu],
			$myrow_chet[vid_med],
			$myrow_chet[inn],
			$date_ch,
			$myrow_chet[nom_ch],
			$myrow_chet[ed_izm],
			$myrow_chet[kolvo],
			$myrow_chet[summ_ch],
			$date_per,
			$myrow_chet[fail_ch]
			));		

        	dbase_close($dbf_chet);

	}

	function Date_edit ($date) {
		// функция правки даты 
		return  str_replace('-','',$date);		
	}

	function Select(){
		 global $db, $dbw;
		 $reestr = $db->select_row("SELECT * FROM reestr_id WHERE reestr_id='".$this->reestr_id."'");
		 $sel = $db->select("SELECT 0 AS npr
								, oht.scode AS vmedpom
								, cc.goal_code AS c_pos_st
								, cd.code AS kod_vrl
								, cds.nomk_n AS idprof1
								, 0 AS idotd
								, upper(cc.diagnosis_primary_code) AS dso
								, cctd.visit_date AS dbeg
								, cctd.visit_date AS dend
								, 1 AS fact_dn
								, 0 AS kol_ye
								, 0 AS dopl
								, 0 AS sts
								, 0 AS otcl_dn
								, 0 AS otcl_pro
								, cc.result_code AS ishod
								, cc.person_id AS regn_lpu
								, 0 AS datakek
								, 0 AS nkek
								, cctd.price_code AS kod_usl
								, 0 AS tip_file
								, count(cc.coupon_id) AS kol_usl
								, cc.disability_sheet_open AS dlistin
								, cc.disability_sheet_close AS dlistout
								, 0 AS list_num
								, cc.diagnosis_secondary_code AS ds_s
								, 0 AS date_ns
								, 17 AS n_obllpu
								, cp.card_number AS ncard
								, cp.fname AS fam
								, cp.mname AS im
								, cp.sname AS otch
								, 0 AS fam_r
								, 0 AS im_r
								, 0 AS otch_r
								, cp.sex AS pol
								, cp.birthday AS dr
								, cpdop.series AS spolis
								, cpdop.number AS npolis
								, 2 AS doc_tip
								, 0 AS doc_ser
								, cpdp.series AS doc_ser1
								, cpdp.number AS doc_num
								, 0 AS doc_num1
								,co.name as rabota
								,0 as adr_rab
								,0 as adr_reg
								,0 as adr_raion
								,ca.build_number as adr_dom
								,ca.appartment_address as adr_kvart
								,ca.code as code
								,0 as d_type
								,cpdop.work_type_id as file_vid
								,cp.pension_number as snils
								,cpdop.oms_polis_type_id as vpolis
								,cpdop.number as oms_num
								,cpdop.number as tmp_num
								,cp.parent_id
								, ".$this->tarif." as tarif
								, ".$this->tarif." as summa
								, birth_place as mr
								, 1 as vidpom
							FROM
							  core_coupon cc
							INNER JOIN core_coupon_to_doctor cctd
							ON cc.coupon_id = cctd.coupon_id
							INNER JOIN oms_help_types oht
							ON cc.help_code = oht.code
							INNER JOIN core_person_docs_oms_polis cpdop
							ON cc.oms_id = cpdop.oms_polis_id
							INNER JOIN core_oms_organizations coo
							ON cpdop.oms_organization_id = coo.oms_organization_id
							INNER JOIN core_doctors cd
							ON cd.code = cctd.doctor_code
							INNER JOIN core_doctors_spec cds
							ON cd.spec_id = cds.spec_id
							INNER JOIN core_persons cp
							ON cc.person_id = cp.person_id
							INNER JOIN core_person_docs_passport cpdp
							ON cc.passport_id = cpdp.passport_id
							INNER JOIN core_address ca
							ON cpdp.address_id = ca.address_id
							INNER JOIN core_organizations co
							ON co.organization_id = cpdop.organization_id
							WHERE ".$this->code_orgn."
						cc.payment_type = '".$reestr[source_financing]."'
						AND cctd.visit_date BETWEEN '".$reestr[d_beg_coupon]."' AND '".$reestr[d_end_coupon]."'
						AND cc.status='1' AND cc.help_code='".$reestr[help_code]."' AND cpdop.series not like '52%'
						GROUP BY  cc.coupon_id,kod_vrl, cctd.visit_date, cctd.price_code
						ORDER BY cctd.visit_date
		"); 

		$i=1;
		foreach($sel AS $r){
				$r['npr'] = $i;
				$r['npp'] = $i;
				$r['reestr_id'] = $this->reestr_id;
				// проверка даты закрытия направления
				$dend = explode("-",$r['dend']);
				$dend = mktime(0,0,0,$dend[1],$dend[2],$dend[0]);
				$d_end_coupon = explode("-",$reestr['d_end_coupon']);
				$d_end_coupon = mktime(0,0,0,$d_end_coupon[1],$d_end_coupon[2],$d_end_coupon[0]);
				if ($dend > $d_end_coupon)  $r['dend'] = $reestr['d_end_coupon'];
				// проверка даты открытия напраления
				$dbeg = explode("-",$r['dbeg']);
				$dbeg = mktime(0,0,0,$dbeg[1],$dbeg[2],$dbeg[0]);
				$d_beg_coupon = explode("-",$reestr['d_beg_coupon']);
				$d_beg_coupon = mktime(0,0,0,$d_beg_coupon[1],$d_beg_coupon[2],$d_beg_coupon[0]);
				if ($dbeg < $d_beg_coupon) $r['dbeg'] = $reestr['d_beg_coupon'];
				
				if($r['kod_usl'] != 0) {
					$r['kol_ye'] = $db->select_item("SELECT number FROM price_data WHERE code='".$r['kod_usl']."'");
					if ( ($r['kol_ye'] != 0 ) AND  !is_array($r['kol_ye'])) {
						$r['tarif'] = OMS_PRICE_YE; 
						$r['summa'] = OMS_PRICE_YE * $r['kol_ye'] * $r['kol_usl'] ;
					}
					else{
						$result = $db->select_item("SELECT price FROM price_data WHERE code='".$r['kod_usl']."'");
						$r['tarif'] = $result;
						$r['summa'] = $result * $r['kol_usl'];
					}
				}
				
			
	
				// выбор прописки 
				if($r['code'] !=0) {		
				$r['adr_ulica'] = $db->select_item("SELECT name FROM kladr_street WHERE code='".$r['code']."'");
				$code = substr($r['code'],0,11);
				$r['adr_punkt'] = $db->select_item("SELECT name FROM kladr_kladr WHERE code like '".$code."%'");
				$rayon= $db->select_item("SELECT ray FROM kladr_kladr WHERE code like '".$code."%'");
				// выбор кода района
				$r['adr_raion'] =  $db->select_item("SELECT code FROM spr_code_rayon WHERE name='".$rayon."' ");
				$r['adr_rab'] = $r['adr_reg'] = substr($r['code'],0,2);
				}
				
				// Выбор родителей
				if($r['parent_id'] !='0') {
					$sel_par = $db->select_row("SELECT fname, mname, sname, birthday, sex FROM core_persons WHERE person_id='".$r['parent_id']."'");
					$r['fam_r'] = $sel_par['fname'];
					$r['im_r'] = $sel_par['mname'];
					$r['otch_r'] = $sel_par['sname'];
					$r['dr_p'] = $sel_par['birthday'];
					$r['w_p'] = $sel_par['sex'];
				}
				$r['reestr_id']= $this->reestr_id;
				/*
				if($r['vpolis'] == 1) {
					$r['tmp_num'] = "";
					$r['npolis'] = "";
				}
				elseif($r['vpolis'] == 2) {
					$r['npolis'] = "";
					$r['oms_num'] = "";
				}
				elseif($r['vpolis'] == 3) {
					$r['oms_num'] = "";
					$r['tmp_num'] = "";
				}
				*/
				$fields = array("npr","npp","n_regi","novor","fam","im","otch","dr","pol","fam_r","im_r","otch_r","dr_p","w_p","mr","snils","vpolis","spolis","npolis","doc_tip","doc_ser1","doc_num","vmedpom","vidpom","idprof","idprof1","profil","det","ds0","dso","ds_s","dbeg","dend","tarif","fact_dn","kol_ye","kod_usl","kod_vrl","sts","ishod","rslt","summa","idgosp","regn_lpu","datakek","nkek","kol_usl","prvs","date_ns","doptarif","dopsumma","extr","idotd","ncard","okatop","adr_reg","adr_raion","adr_punkt","adr_ulica","adr_dom","adr_korp","adr_kvart","q_np","q_ul","reestr_id");
				$ins = $dbw->insert_from_object("reestr_other",$fields,$r);
				$i++;
			}
			//$db->debug_output();
			return $this->reestr_id;
			
	}

	function Create($nom_ch='55',$date_ch='1999-10-11', $date_per='1999-11-12', $smo_name='rosno'){
		global $db,$dbw;
		$result = $db->select_row("SELECT COUNT(kol_usl) AS kolvo, SUM(summa) AS summ_ch FROM reestr_other WHERE reestr_id='".$this->reestr_id."'");

		return $dbw->insert("INSERT INTO reestr_chet SET 
				lpu_k1='$this->lpu_k1',
				lpu_k2='$this->lpu_k2',
				lpu_name='$this->lpu_name',
				smo_name='$smo_name',
				ur_lpu='$this->ur_lpu',
				vid_med='$this->vid_med',
				inn='$this->inn',
				date_ch='$date_ch',
				nom_ch='$nom_ch',
				ed_izm='$this->ed_izm',
				kolvo='".$result[kolvo]."',
				summ_ch='".$result[summ_ch]."',
				date_per='$date_per',
				fail_ch='Z".$this->dbf_name.".dbf',
				reestr_id='$this->reestr_id'");
		
	}

	function Export(){
		$this->CreateOtherDBF();
		$this->CreateSchetDBF();
		$this->InsertOtherDBF();
		$this->InsertChetDBF();
		$r = $this->CreateZip();
		return $r;
	}

}



?>
