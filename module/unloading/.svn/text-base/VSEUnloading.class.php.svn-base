<?php

class VSEUnloading {
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
	
	
	private $dir_to_save;
	private $prefix;
	private $files;

	function __construct (	$reestr_id=0,
							$code_orgn='0',
							$source_financing='',
							$d_beg_coupon='2010-01-01',
							$d_end_coupon='2010-02-01',
							$d_beg_calc='2010-01-05',
							$d_end_calc='2010-01-25',
							$article='2',
							$help_code=2) 
	{
		global $db,$dbw; 
		
		
		
		
		
		if($reestr_id !=0){
			$db->select_to_object("SELECT * FROM `reestr_id` WHERE `reestr_id`=".$reestr_id,&$this);
			
			
			// злостный хак.. т.к. в БД два поля одинаковые.. раньше использовалось code_orgn, теперь kod_go
			$this->code_orgn = $this->kod_go;
			
			$this->dir_to_save = $_SERVER['DOCUMENT_ROOT'].'/tmp/';
			$this->prefix = $this->dir_to_save.$reestr_id.'_';
			
			$this->files['passport'] = $this->prefix."1".$this->dbf_name.".dbf";
			$this->files['med'] = $this->prefix."2".$this->dbf_name.".dbf";
			$this->files['schet'] = $this->prefix."6".$this->dbf_name.".dbf";
			$this->files['zip'] = $this->prefix."6".$this->dbf_name.".".$this->code_orgn;
			
			
		}
		else{
			$number_document = "1";
			if(empty($code_orgn)){
				$code_orgn = "000";
			}
			else {
				$this->code_orgn = " core_oms_organizations.kod_go = ".$code_orgn." AND ";
			}
			switch($article){
				case 1: $this->tarif = "core_doctors_spec.tar_l+core_doctors_spec.tar_tr1"; break;
				case 2: $this->tarif = "core_doctors_spec.tar_l1+core_doctors_spec.tar_tr"; break;
				case 3: $this->tarif = "core_doctors_spec.tar_l+core_doctors_spec.tar_l1"; break;
				default : $this->tarif = "core_doctors_spec.tar_l+core_doctors_spec.tar_l1+core_doctors_spec.tar_l2"; break;
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
					fail_ch='$this->fail_ch'");	
		} 
	}

	function CreatePassDBF (){
		// создание .dbf Паспортаная часть
		$def1 = array(
		  array("NPR", 		"N", 	7, 0),
		  array("N_OBLLPU", 	"N", 	3, 0),
		  array("REGN_PAC", 	"N", 	16, 0),
		  array("NCARD", 	"C", 	16),
		  array("FAM",		"C", 	27),
		  array("IM", 		"C", 	17),
		  array("OTCH",		"C", 	17),
		  array("FAM_R", 	"C", 	27),
		  array("IM_R", 	"C", 	17),
		  array("OTCH_R", 	"C", 	17),
		  array("POL", 		"C", 	1),
		  array("DR", 		"D"	),
		  array("SPOLIS", 	"C", 	5),
		  array("NPOLIS", 	"N", 	7, 0),
		  array("DOC_TIP", 	"N", 	2, 0),
		  array("DOC_SER", 	"C", 	10),
		  array("DOC_SER1",	"C", 	5),
		  array("DOC_NUM", 	"C", 	10),
		  array("DOC_NUM1",	"C", 	7),
		  array("RABOTA", 	"C", 	95),
		  array("ADR_RAB", 	"N", 	3, 0),
		  array("ADR_REG", 	"N", 	3, 0),
		  array("ADR_RAION", 	"N", 	2, 0),
		  array("ADR_PUNKT", 	"C", 	63),
		  array("ADR_ULICA", 	"C", 	63),
		  array("ADR_DOM", 	"C", 	10),
		  array("ADR_KORP", 	"C", 	2),
		  array("ADR_KVART", 	"C", 	5),
		  array("D_TYPE", 	"C", 	4),
		  array("FILE_VID", 	"C", 	1),
		  array("SS", 		"C", 	14),
		  array("POL_TIP", 		"N", 	1,0),
		  array("OMS_NUM", 		"C", 	16),
		  array("TMP_NUM", 		"C", 	9)
		);
		// creating
		if (!dbase_create($this->files['passport'], $def1)) {
		  echo "Ошибка при создании Паспортной Части(dbf)\n";
		}
	}

	function CreateMedDBF(){
		// создание .dbf мед помощи
		$def2 = array (
			array("NPR_S", 		"N", 	7, 0),
			array("NPR", 		"N", 	7, 0),
			array("VMEDPOM", 	"C", 	1),
			array("C_POS_ST", 	"N", 	2, 0),
			array("KOD_VRL", 	"N", 	6, 0),
			array("IDPROF", 	"N", 	5, 0),
			array("IDOTD", 		"C", 	4),
			array("DSO", 		"C", 	6),
			array("DBEG", 		"D"	),
			array("DEND", 		"D"	),
			array("TARIF", 		"N", 	10, 2),
			array("FACT_DN", 	"N", 	3, 0),
			array("KOL_YE", 	"N", 	5, 2),
			array("DOPL", 		"N", 	12, 2),
			array("SUMMA", 		"N", 	12, 2),
			array("STS", 		"N", 	3, 0),
			array("OTCL_DN", 	"N", 	4, 0),
			array("OTCL_PRO", 	"N", 	6, 1),
			array("ISHOD",		"N", 	2, 0),
			array("REGN_PAC", 	"N", 	16, 0),
			array("DATAKEK", 	"D"	),
			array("NKEK", 		"C", 	6),
			array("KOD_USL", 	"C", 	10),
			array("TIP_FILE", 	"C", 	1),
			array("KOL_USL", 	"N", 	3, 0),
			array("DLISTIN", 	"D"	),
			array("DLISTOUT", 	"D"	),
			array("LIST_NUM", 	"C", 	12),
			array("DS_S", 		"C", 	7),
			array("DATE_NS", 	"D"	),
			//array("DOPTARIF", 		"N", 	8, 2),
			//array("DOPSUMMA", 		"N", 	12, 2)
			array("KOD_OPER",	"C",	 14)
		);
		if (!dbase_create($this->files['med'], $def2)) {
		  echo "Ошибка при создании Медицинсой Помощи(dbf)\n";
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
		if (!dbase_create($this->files['schet'], $def3)) {
		  echo "Ошибка при создании Счет-Фактуры(DBF)\n";
		}
	}

	function CreateZip(){
		// упакова
		$zip = new ZipArchive();
		if ($zip->open($this->files['zip'], ZIPARCHIVE::CREATE) !== true) {
		    fwrite(STDERR, "Ошибка создания архива");
		    exit(1);
		}
		$zip->addFile($this->files['passport'],"1".$this->dbf_name.".dbf");
		$zip->addFile($this->files['med'],"2".$this->dbf_name.".dbf");
		$zip->addFile($this->files['schet'],"6".$this->dbf_name.".dbf");

		$zip->close();

		// for windows
		//chown("1".$this->dbf_name.".dbf",777);
		//chown("2".$this->dbf_name.".dbf",777);
		//chown("6".$this->dbf_name.".dbf",777);
		
		//unlink("1".$this->dbf_name.".dbf");
		//unlink("2".$this->dbf_name.".dbf");
		//unlink("6".$this->dbf_name.".dbf");
		//$link = "6".$this->dbf_name.".".$this->code_orgn."";
		
		$link = '/main/sections/oms/actions/export_oms_reestr.php?action=download&reestr_id='.$this->reestr_id;
		
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

	function InsertPassDBF (){
		// заполнения данными паспортную часть
		global $db;
		// выбор данных для паспортной части
		$myrow_pas = $db->select("SELECT * FROM reestr_passport WHERE reestr_id='$this->reestr_id'");
		$myrow_pas = VSEUnloading::iconvArray($myrow_pas,"cp866");
		$dbf_pas = dbase_open($this->files['passport'], 2);
		foreach ($myrow_pas AS $r) {			
			
			if($r[pol] == '2') $r[pol]=iconv("windows-1251","cp866","М"); else $r[pol]=iconv("windows-1251","cp866","Ж");
			if($r[file_vid] ==1) $r[file_vid]="F"; else $r[file_vid]="S";
			$birthday = $this->Date_edit($r[dr]);		// обработка даты рождения
			//$r[fname] = iconv("windows-1251", "cp866", $r[fname]);
			// добавление в паспортную часть данных
			list($dom,$kor) = explode ("/",$r[build_number]);
			dbase_add_record($dbf_pas, array(
			$r[npr],
			$r[n_obllpu],
			$r[regn_pac],
			$r[ncard],
			$r[fam],
			$r[im],
			$r[otch],
			$r[fam_r],
			$r[im_r],
			$r[otch_r],
			$r[pol],
			$birthday,
			$r[spolis],
			$r[npolis],
			$r[doc_tip],
			$r[doc_ser],
			$r[doc_ser1],
			$r[doc_num],
			$r[doc_num1],
			$r[rabota],
			$r[adr_rab],
			$r[adr_reg],
			$r[adr_raion],
			$r[adr_punkt],
			$r[adr_ulica],
			$r[adr_dom],
			$r[adr_korp],
			$r[adr_kvart],
			$r[d_type],
			$r[file_vid],
			$r[ss],
			$r[pol_tip],
			$r[oms_num],
			$r[tmp_num]));
			
		}
		dbase_close($dbf_pas);
		if($dbf_pas) {
		//echo $dbf_pas;
		}
	}
	
	function InsertMedDBF(){
		global $db;
		// заполнение данными медицинскую часть
		// выборка данных для медицинской части
		$myrow_med = $db->select("SELECT * FROM reestr_med WHERE reestr_id='$this->reestr_id'");
		$myrow_med = VSEUnloading::iconvArray($myrow_med,"cp866");
		$dbf_med = dbase_open($this->files['med'], 2);
		foreach($myrow_med AS $r){
			$open_date = $this->Date_edit($r[dlistin]);
			$close_date = $this->Date_edit($r[dlistout]);
			$dbeg = $this->Date_edit($r[dbeg]);
			$dend = $this->Date_edit($r[dend]);
			$nkek = $this->Date_edit($r[nkek]);
			$date_ns = $this->Date_edit($r[date_ns]);
			dbase_add_record($dbf_med, array(
			$r[npr_s],
			$r[npr],
			$r[vmedpom],
			$r[c_pos_st],
			$r[kod_vrl],
			$r[idprof],
			$r[idotd],
			$r[dso],
			$dbeg,
			$dend,
			$r[tarif],
			$r[fact_dn],
			$r[kol_ye],
			$r[dopl],
			$r[summa],
			$r[sts],
			$r[otcl_dn],
			$r[otcl_pro],
			$r[ishod],
			$r[regn_pac],
			$r[datakek],
			$nkek,
			$r[kod_usl],
			$r[tip_file],
			$r[kol_usl],
			$open_date,
			$close_date,
			$r[list_num],
			$r[ds_s],
			$date_ns,
			//'',''			
			''
			));
		}

        	dbase_close($dbf_med);
			//if($dbf_med) {echo "dbf open";}
	}
	
	function InsertChetDBF(){
		global $db;
		// заполнение данными счет-фактуру
		// выборка данных для счет фактура
		$myrow_chet = $db->select_row("SELECT * FROM reestr_chet WHERE reestr_id='$this->reestr_id'");
		$myrow_chet = $this->iconvArray($myrow_chet,"cp866");
		$dbf_chet = dbase_open($this->files['schet'], 2);
		
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
		 $sel_med = $db->select("SELECT 0 AS npr
						, oms_help_types.scode AS 					vmedpom
						, core_coupon.goal_code AS 					c_pos_st
						, core_doctors.code AS 						kod_vrl
						, core_doctors_spec.nomk_n AS 				idprof
						, 0 AS 										idotd
						, UPPER(core_coupon.diagnosis_primary_code) AS dso
						, core_coupon_to_doctor.visit_date AS 					dbeg
						, core_coupon_to_doctor.visit_date AS 				dend
						, ".$this->tarif." AS 						tarif
						, 0 AS 										fact_dn
						, 0 AS 									kol_ye
						, 0 AS 									dopl
						, ".$this->tarif." AS 					summa
						, 0 AS 									sts
						, 0 AS 									otcl_dn
						, 0 AS 									otcl_pro
						, core_coupon.result_code AS 			ishod
						, core_coupon.person_id AS 				regn_pac
						, 0 AS 									datakek
						, 0 AS 									nkek
						, core_coupon_to_doctor.price_code AS 		kod_usl
						, 0 AS 									tip_file
						, count(core_coupon.coupon_id) AS 									kol_usl
						, core_coupon.disability_sheet_open AS 	dlistin
						, core_coupon.disability_sheet_close AS dlistout
						, 0 AS 									list_num
						, core_coupon.diagnosis_secondary_code AS ds_s
						, 0 AS 									date_ns
							FROM
						(core_coupon
							INNER JOIN 
						core_coupon_to_doctor
							ON 
						core_coupon_to_doctor.coupon_id = core_coupon.coupon_id)
							LEFT  JOIN 
						oms_help_types
							ON 
						core_coupon.help_code = oms_help_types.code
							LEFT JOIN 
						core_person_docs_oms_polis
							ON 
						core_coupon.oms_id = core_person_docs_oms_polis.oms_polis_id
							LEFT JOIN 
						core_oms_organizations
							ON 
						core_person_docs_oms_polis.oms_organization_id = core_oms_organizations.oms_organization_id
							LEFT JOIN 
						core_doctors
							ON 
						core_doctors.code = core_coupon_to_doctor.doctor_code
							LEFT  JOIN 
						core_doctors_spec
							ON
						core_doctors.spec_id = core_doctors_spec.spec_id
							WHERE ".$this->code_orgn."
						core_coupon.payment_type = '".$reestr[source_financing]."'
						AND core_coupon_to_doctor.visit_date BETWEEN '".$reestr[d_beg_coupon]."' AND '".$reestr[d_end_coupon]."'
						/*AND core_coupon.open_date BETWEEN '".$reestr[d_beg_coupon]."' AND '".$reestr[d_end_coupon]."'
						AND core_coupon.disability_sheet_open BETWEEN '".$reestr[d_beg_calc]."' AND '".$reestr[d_end_calc]."' */
						AND core_coupon.status='1' AND core_coupon.help_code='".$reestr[help_code]."' 
						GROUP BY  core_coupon.coupon_id,kod_vrl, core_coupon_to_doctor.visit_date, core_coupon_to_doctor.price_code
						ORDER BY core_coupon_to_doctor.visit_date
		"); 

		$i=1;
		foreach($sel_med AS $r){
			$r['npr_s'] = $i;
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
			$r['summa'] = round($r['summa'],2);
			$fields = array("npr_s","npr","vmedpom","c_pos_st","kod_vrl","idprof","idotd","dso","dbeg","dend","tarif","fact_dn","kol_ye","dopl","summa","sts","otcl_dn","otcl_pro","ishod","regn_pac","datakek","nkek","kod_usl","tip_file","kol_usl","dlistin","dlistout","list_num","ds_s","date_ns","reestr_id");
			$ins_med = $dbw->insert_from_object("reestr_med",$fields,$r);
			$i++;
			}
		
		
		
		//паспортная часть
		$sel_med_r = $db->select("SELECT distinct(regn_pac) AS regn_pac FROM reestr_med WHERE reestr_id = '".$this->reestr_id."'");
		$i =1;
		foreach ($sel_med_r AS $r) {			
			$sel_pas = $db->select_row("SELECT 
					17 AS 							n_obllpu,
					core_persons.person_id AS 		regn_pac,
					core_persons.card_number AS 	ncard,
					core_persons.fname AS 			fam,
					core_persons.mname AS 			im,
					core_persons.sname AS 			otch,
					0 AS 							fam_r,
					0 AS 							im_r,
					0 AS 							otch_r,
					core_persons.sex AS 			pol,
					core_persons.birthday AS 		dr,
					core_person_docs_oms_polis.series AS spolis,
					core_person_docs_oms_polis.number AS npolis,
					2 AS 							doc_tip,
					0 AS 							doc_ser,
					core_person_docs_passport.series AS doc_ser1,
					0 AS 							doc_num,
					core_person_docs_passport.number AS doc_num1,
					core_organizations.name AS 		rabota,
					0 AS adr_rab,
					0 AS adr_reg,
					0 AS adr_raion,
					/* town AS adr_punkt,*/
					/* street AS adr_ulica,*/
					core_address.build_number AS adr_dom,
					/* korpus AS adr_korp,*/
					core_address.appartment_address AS adr_kvart,
					core_address.code AS code,
					0 AS d_type,
					core_person_docs_oms_polis.work_type_id AS file_vid,
					core_persons.pension_number AS ss,
					core_person_docs_oms_polis.oms_polis_type_id AS pol_tip,
					core_person_docs_oms_polis.number AS oms_num,
					core_person_docs_oms_polis.number AS tmp_num,
					core_persons.parent_id
						FROM 
					core_persons
						LEFT JOIN
					core_person_docs_oms_polis
						ON 
					core_persons.current_oms_polis_id=core_person_docs_oms_polis.oms_polis_id
						LEFT JOIN
					core_person_docs_passport
						ON
					core_persons.current_passport_id=core_person_docs_passport.passport_id
						LEFT JOIN
					core_organizations
						ON
					core_person_docs_oms_polis.organization_id=core_organizations.organization_id
						LEFT JOIN
					core_address
						ON
					core_person_docs_passport.address_id=core_address.address_id
						WHERE core_persons.person_id='".$r['regn_pac']."'
					");
			// выбор прописки 
			if($sel_pas['code'] !=0) {		
			$sel_pas['adr_ulica'] = $db->select_item("SELECT name FROM kladr_street WHERE code='".$sel_pas['code']."'");
			$code = substr($sel_pas['code'],0,11);
			$sel_pas['adr_punkt'] = $db->select_item("SELECT name FROM kladr_kladr WHERE code like '".$code."%'");
			$rayon= $db->select_item("SELECT ray FROM kladr_kladr WHERE code like '".$code."%'");
			// выбор кода района
			$sel_pas['adr_raion'] =  $db->select_item("SELECT code FROM spr_code_rayon WHERE name='".$rayon."' ");
			$sel_pas['adr_rab'] = $sel_pas['adr_reg'] = substr($sel_pas['code'],0,2);
			}
			
			// Выбор родителей
			if($sel_pas['parent_id'] !='0') {
				$sel_par = $db->select_row("SELECT fname, mname, sname FROM core_persons WHERE person_id='".$sel_pas['parent_id']."'");
				$sel_pas['fam_r'] = $sel_par['fname'];
				$sel_pas['im_r'] = $sel_par['mname'];
				$sel_pas['otch_r'] = $sel_par['sname'];
			}
			$sel_pas['reestr_id']= $this->reestr_id;
			
			if($sel_pas['pol_tip'] == 1) {
				$sel_pas['tmp_num'] = "";
				$sel_pas['npolis'] = "";
			}
			elseif($sel_pas['pol_tip'] == 2) {
				$sel_pas['npolis'] = "";
				$sel_pas['oms_num'] = "";
			}
			elseif($sel_pas['pol_tip'] == 3) {
				$sel_pas['oms_num'] = "";
				$sel_pas['tmp_num'] = "";
			}
			$sel_pas['npr'] = $i;
			$fields = array("npr","n_obllpu","regn_pac","ncard","fam","im","otch","fam_r","im_r","otch_r","pol","dr","spolis","npolis","doc_tip","doc_ser","doc_ser1","doc_num","doc_num1","rabota","adr_rab","adr_reg","adr_raion","adr_punkt","adr_ulica","adr_dom","adr_korp","adr_kvart","d_type","file_vid","ss","pol_tip","oms_num","tmp_num","reestr_id");
			$ins_pas = $dbw->insert_from_object("reestr_passport",$fields,$sel_pas);

			$upd_med = $dbw->q("UPDATE reestr_med SET npr='".$sel_pas[npr]."' WHERE regn_pac='".$r['regn_pac']."' and reestr_id='".$this->reestr_id."'");
			$i++;
			}
			//$db->debug_output();
			return $this->reestr_id;
			
	}

	function Create($nom_ch='55',$date_ch='1999-10-11', $date_per='1999-11-12', $smo_name='rosno'){
		global $db,$dbw;
		$result = $db->select_row("SELECT COUNT(kol_usl) AS kolvo, SUM(summa) AS summ_ch FROM reestr_med WHERE reestr_id='".$this->reestr_id."'");

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
				fail_ch='$this->fail_ch.dbf',
				reestr_id='$this->reestr_id'");
		
	}

	function Export(){
		$this->CreatePassDBF();
		$this->CreateMedDBF();
		$this->CreateSchetDBF();
		$this->InsertPassDBF();
		$this->InsertMedDBF();
		$this->InsertChetDBF();
		$r = $this->CreateZip();
		return $r;
	}

}



?>
