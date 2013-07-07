<?php

/** 
 * @author [Eugene Marsakov] 
 * @copyright 2009 
 * @site [http://forwebm.net] 
 */ 

 /* 
 ������ ������ � ������� �� ������ �������������� �������� ����� � ������� ������������� 
 �� ����� Object Pascal (Delphi) � ���������� ���� php + ���������� ������ � ���������. 
 ���������� ������ �������� ������, ���������� �� Object Pascal (delphi). 
 ��������� �������� � ��� php - ������ ���� �� 100% ������������� ���������. 
  
  
 �������, �������������� ������������ ����� ������� 
 function FloatToText($R,$Precision) 
 ����������� ������������ (�����) ����� � ��������� ������������� � ��������� 
 �� Precision <= 4 ������ ����� �����. 
  
 function CurrencyToText($sum,$price = "RUR")  
 ����������� ����� � ����� (��� �����, ��� � �������) 
 ���� �������� $price = RUR - ������� �� ������� ������ ���� ������, 
 ���� $price = USD - �� ������� �������� ���� ������ 
 ------------------- 
 function ArabicToRoman($num_int) 
 ��������� ����� ����� $num_int � ������� ������������� ����� 
  
 function RomanToArabic($rim_num)  
 ��������� ����� �� �������� ������������� � �������� 
 ------------------- 
  
  
  

 function AmountOfUnits($AUnit,$R,$Precision,$Options) 
 �� ��, ��� � FloatToText, �� � ������ ������� ��������� � �������: 
 ntoExplicitZero: "���� �����" 
 ntoMinus, ntoPlus: "�����", "����". 
 ntoNotReduceFrac: "��������� �����" ������ "���� �������". 

 function CountOfUnits($AUnit,$N,$Options) 
 �� �� ��� ����� �����. ��� ������� ������ ����������� ����� ��. 
*/  

//-----------------------------------------------------------------------  
/* set as constants */ 
 define('GENMASCULINE','genMasculine', false);  
 define('GENNEUTER','genNeuter', false); 
 define('GENFEMININE','genFeminine', false); 
//-----------------------------------------------------------------------  
 //******************************************** 
 /* constants of rules */ 
 $WD_EMPTY    = array( 
  'Gender'=>GENMASCULINE, 
  'Base'=>'', 
  'End1'=>'', 
  'End2'=>'', 
  'End5'=>'', 
 ); 
 $WD_THOUSEND = array( 
  'Gender'=>GENFEMININE, 
  'Base'=>'�����', 
  'End1'=>'�', 
  'End2'=>'�', 
  'End5'=>'', 
 ); 
 $WD_MILLION  = array( 
  'Gender'=>GENMASCULINE, 
  'Base'=>'�������', 
  'End1'=>'', 
  'End2'=>'�', 
  'End5'=>'��', 
 ); 
 $WD_MILLIARD = array( 
  'Gender'=>GENMASCULINE, 
  'Base'=>'��������', 
  'End1'=>'', 
  'End2'=>'�', 
  'End5'=>'��', 
 );  
  
 $WD_INT      = array( 
  'Gender'=>GENFEMININE, 
  'Base'=>'���', 
  'End1'=>'��', 
  'End2'=>'��', 
  'End5'=>'��', 
 ); 
 $WD_FRAC     = array( 
    1=> 
     array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'�����', 
    'End1'=>'��', 
    'End2'=>'��', 
    'End5'=>'��', 
    ), 
    2=> 
     array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'co�', 
    'End1'=>'��', 
    'End2'=>'��', 
    'End5'=>'��', 
    ),     
    3=> 
     array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'������', 
    'End1'=>'��', 
    'End2'=>'��', 
    'End5'=>'��', 
    ), 
    4=> 
     array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'������������', 
    'End1'=>'��', 
    'End2'=>'��', 
    'End5'=>'��', 
    ), 
    ); 
 //******************************************** 
  /* �����, ������� */ 
 $WD_RUBLE    = array( 
    'Gender'=>GENMASCULINE, 
    'Base'=>'����', 
    'End1'=>'�', 
    'End2'=>'�', 
    'End5'=>'��', 
    ); 

 $WD_KOPECK   = array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'����', 
    'End1'=>'���', 
    'End2'=>'���', 
    'End5'=>'��', 
    ); 
 //********************************************    
  /* �������, ����� */ 
 $WD_USD    = array( 
    'Gender'=>GENMASCULINE, 
    'Base'=>'������', 
    'End1'=>'', 
    'End2'=>'�', 
    'End5'=>'��', 
    ); 

 $WD_CENT   = array( 
    'Gender'=>GENMASCULINE, 
    'Base'=>'����', 
    'End1'=>'', 
    'End2'=>'�', 
    'End5'=>'��', 
    );  
 //******************************************** 
  /* ������� */ 
 $WD_SECOND    = array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'������', 
    'End1'=>'�', 
    'End2'=>'�', 
    'End5'=>'', 
    );     
  /* ������ */ 
 $WD_MINUTES    = array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'�����', 
    'End1'=>'�', 
    'End2'=>'�', 
    'End5'=>'', 
    );     
  /* ���� */ 
 $WD_HOURS    = array( 
    'Gender'=>GENMASCULINE, 
    'Base'=>'���', 
    'End1'=>'', 
    'End2'=>'�', 
    'End5'=>'��', 
    );      
  /* ��� */ 
 $WD_DAYS    = array( 
    'Gender'=>GENMASCULINE, 
    'Base'=>'', 
    'End1'=>'����', 
    'End2'=>'���', 
    'End5'=>'����', 
    ); 
  /* ������ */ 
 $WD_WEEKS    = array( 
    'Gender'=>GENFEMININE, 
    'Base'=>'�����', 
    'End1'=>'�', 
    'End2'=>'�', 
    'End5'=>'�', 
    );     
 //������    
 $WD_MONTH    = array( 
    'Gender'=>GENMASCULINE, 
    'Base'=>'�����', 
    'End1'=>'', 
    'End2'=>'�', 
    'End5'=>'��', 
    ); 
 //����    
 $WD_YEAR    = array( 
    'Gender'=>GENMASCULINE, 
    'Base'=>'', 
    'End1'=>'���', 
    'End2'=>'����', 
    'End5'=>'���', 
    ); 
 //********************************************             

   
 $TenIn = array( 
  1=>10, 
  2=>100, 
  3=>1000, 
  4=>10000 
 );  
  
 $MaxPrecision = 4; // �� �������������� 
  
  
//----------------------------------------------------------------------- 
 /* ��� ������ � �������� ������� */ 
  $Rim  = array(1=>'I', 2=>'IV', 3=>'V', 4=>'IX', 5=>'X', 6=>'XL', 7=>'L', 8=>'XC', 9=>'C', 10=>'CD', 11=>'D', 12=>'CM', 13=>'M',);
  $Arab = array(1=>1, 2=>4, 3=>5, 4=>9, 5=>10, 6=>40, 7=>50, 8=>90, 9=>100, 10=>400, 11=>500, 12=>900, 13=>1000,);  
  
//-----------------------------------------------------------------------  
 /* declaraited functions */ 
 function mod($a,$b) { return $a%$b; } 
 function div($a,$b) { return floor($a/$b); } 
 function Trunc($a) { return div($a, 1); } 
 function Frac($a) {  $out = explode('.', $a); return $out[1]; } 
 function FreeZero($a) { 
   $s = ''; $s_len = strlen($a); 
   while ($s_len >= 0) {  
       if (substr($a,$s_len, 1) == 0) { $s_len--; } 
    else { $s = substr($a, 0,$s_len+1); break; }    
   } 
   return $s;  
 } 
//-----------------------------------------------------------------------  
  


//----------------------------------------------------------------------- 
 /* class as convert data */ 
 class NumberAnaliz { 
   
  private $FFirstLevel  = 0; 
  private $FSecondLevel = 0; 
  private $FThirdLevel  = 0; 
   
  var $UnitWord     = array('Gender'=>GENNEUTER,'Base'=>'','End1'=>'','End2'=>'','End5'=>'',);
  var $FNumber      = 0; 
   
  function Levels($I) {    
   switch ($I) { 
    case 1: return $this->FFirstLevel; 
    case 2: return $this->FSecondLevel; 
    case 3: return $this->FThirdLevel;     
   }       
  } 
   
  function SetNumber($AValue) { 
   if ($this->FNumber != $AValue) {     
    $this->FNumber = $AValue; 
    $this->FFirstLevel  = mod($this->FNumber, 10); 
    $this->FSecondLevel = mod(div($this->FNumber, 10), 10); 
    $this->FThirdLevel  = mod(div($this->FNumber, 100), 10); 
    if ($this->FSecondLevel == 1) { 
     $this->FFirstLevel = $this->FFirstLevel + 10; 
     $this->FSecondLevel = 0;     
    }     
   }     
  } 
   
  private function GetNumberInWord($N,$Level) {     
   if ($Level == 1) { 
    switch ($N) { 
     case 0: return ''; 
     case 1: if ($this->Gender() == GENMASCULINE) { return '����'; } 
      else if ($this->Gender() == GENFEMININE) { return '����'; }     
      else if ($this->Gender() == GENNEUTER) { return '����'; } 
     case 2: if ($this->Gender() == GENMASCULINE) { return '���'; } 
      else if ($this->Gender() == GENFEMININE) { return '���'; }     
      else if ($this->Gender() == GENNEUTER) { return '���'; }      
     case 3:  return '���'; 
     case 4:  return '������'; 
     case 5:  return '����'; 
     case 6:  return '�����'; 
     case 7:  return '����'; 
     case 8:  return '������'; 
     case 9:  return '������'; 
     case 10: return '������'; 
     case 11: return '�����������'; 
     case 12: return '����������'; 
     case 13: return '����������'; 
     case 14: return '������������'; 
     case 15: return '����������'; 
     case 16: return '�����������'; 
     case 17: return '����������'; 
     case 18: return '������������'; 
     case 19: return '������������';                    
    }//switch     
   }//level 1 
   else if ($Level == 2) { 
    switch ($N) { 
     case 0: return ''; 
     case 1: return '������'; 
     case 2: return '��������'; 
     case 3: return '��������'; 
     case 4: return '�����'; 
     case 5: return '���������'; 
     case 6: return '����������'; 
     case 7: return '���������'; 
     case 8: return '�����������'; 
     case 9: return '���������';         
    }     
   }//level 2 
   else if ($Level == 3) { 
    switch ($N) { 
     case 0: return ''; 
     case 1: return '���'; 
     case 2: return '������'; 
     case 3: return '������'; 
     case 4: return '���������'; 
     case 5: return '�������'; 
     case 6: return '��������'; 
     case 7: return '�������'; 
     case 8: return '���������'; 
     case 9: return '���������';         
    }     
   }//level 3        
  } 
   
  function Gender() { 
   return $this->UnitWord['Gender'];     
  } 
   
  function UnitWordInRightForm() { 
   $result = $this->UnitWord['Base']; 
   $slevel = $this->Levels(1); 
   if ($slevel == 1) { return $result.$this->UnitWord['End1']; } 
   if (($slevel == 0) or (($slevel >= 5) and ($slevel <= 19))) { return $result.$this->UnitWord['End5']; } 
   if (($slevel >= 2) or ($slevel <= 4)) { return $result.$this->UnitWord['End2']; }        
  } 
   
  private function Convert() {   
   if ($this->FNumber == 0) { return ''; } 
   $result = ''; 
   for ($i = 3;$i >= 1;$i--) { 
    $s = $this->GetNumberInWord($this->Levels($i),$i); 
    if ($s != "") { $result .= $s.' '; } 
   }//for 
   return $result.$this->UnitWordInRightForm().' ';         
  } 
   
  function ConvertToText($AUnit = array('Gender'=>GENNEUTER,'Base'=>'','End1'=>'','End2'=>'','End5'=>'',), $ANumber) {  
   $this->UnitWord = $AUnit; 
   $this->SetNumber($ANumber); 
   return $this->Convert();        
  } 
      
 }//end of class number 
//----------------------------------------------------------------------- 
  
 /* create global class object */ 
 $NumberAnalyser = new NumberAnaliz(); 


//----------------------------------------------------------------------- 
 //$Options = (ntoExplicitZero, ntoMinus, ntoPlus, ntoDigits, ntoNotReduceFrac) 
 function CountOfUnits($AUnit = array('Gender'=>GENNEUTER,'Base'=>'','End1'=>'','End2'=>'','End5'=>'',), $N,$Options = array()) {
  global $NumberAnalyser,$WD_MILLIARD,$WD_MILLION,$WD_THOUSEND; 
   
  $result = ''; 
  if (($N == 0) and (!@in_array('ntoExplicitZero',$Options))) { return $result; } 
   
  if (!@in_array('ntoDigits',$Options)) { 
   if (($N < 0) and (@in_array('ntoMinus',$Options))) { $result = '����� '; } 
   else  
   if (($N > 0) and (@in_array('ntoPlus',$Options))) { $result = '���� '; } 
   else 
   if ($N == 0) { return '���� '.$AUnit['Base'].$AUnit['End5']; }     
  }//if 
  else 
  { 
   if (($N < 0) and (@in_array('ntoMinus',$Options))) { $result = '-'; } 
   else 
   if (($N > 0) and (@in_array('ntoPlus',$Options))) { $result = '+'; }        
  }//else 
   
  $N = Abs($N); 
   
  if (@in_array('ntoDigits',$Options)) { 
   $NumberAnalyser->SetNumber($N); 
   $NumberAnalyser->UnitWord = $AUnit; 
   $result = $N." ".$NumberAnalyser->UnitWordInRightForm();     
  }//if 
  else 
  { 
   $Mrd = mod(div($N, 1000000000), 1000); 
   $Mil = mod(div($N, 1000000), 1000); 
   $Th  = mod(div($N, 1000), 1000); 
   $Un  = mod($N, 1000); 
    
   $result .=  
   $NumberAnalyser->ConvertToText($WD_MILLIARD,$Mrd). 
   $NumberAnalyser->ConvertToText($WD_MILLION,$Mil). 
   $NumberAnalyser->ConvertToText($WD_THOUSEND,$Th); 
    
   if ($Un > 0) { $result .= $NumberAnalyser->ConvertToText($AUnit,$Un); } 
   else { $result .= $AUnit['Base'].$AUnit['End5']; }     
     
  }//else     
  return $result; 
 } 
//----------------------------------------------------------------------- 
 //$Options = (ntoExplicitZero, ntoMinus, ntoPlus, ntoDigits, ntoNotReduceFrac) 
 function AmountOfUnits($AUnit = array('Gender'=>GENNEUTER,'Base'=>'','End1'=>'','End2'=>'','End5'=>'',), $R, $Precision, $Options = array()) {
  global $MaxPrecision,$TenIn,$WD_INT,$WD_FRAC; 
   
  // ���������� ���� ����� ������� 
  if ($Precision < 0) { $Precision = 0; } 
  if ($Precision > $MaxPrecision) { $Precision = $MaxPrecision; } 
   
  $result = ''; 
  if (($R > 0) and (@in_array('ntoPlus',$Options))) { $result = '���� '; } 
  if (($R < 0) and (@in_array('ntoMinus',$Options))) { $result = '����� '; } 
   
  $R = abs($R); 

  // ���� Precision = 0, �.�. ��� ������� �����, ����������� � ������� ������� 
  if ($Precision > 0) { $n_int = Trunc($R); } else { $n_int = round($R); } 
   
  // ������� ����� 
  $n_frac = round(($R - $n_int) * $TenIn[$Precision]); 
   
  // ������������ ����� � ������� ����� 
  // ����� ntoNotReduceFrac �� �������� ��� n_frac = 0 (�.�. �� ����� "���� �����")   
   
  if (!@in_array('ntoNotReduceFrac',$Options)) { 
   while ((mod($n_frac, 10) == 0) and ($Precision > 0)) { 
    $n_frac = div($n_frac, 10); 
    $Precision--; 
   }     
  }//if 
   
 // ����� ������ ���� 
 if ($n_int == 0) { 
  if ($n_frac == 0) { 
  // ��� ���������� ������� ����� "����" ����������� ��� ����������� �� ����� ntoExplicitZero
  // "Result +" ���������, ����� �������� "����� ����" 
  // ��� ����� ��������� ������� ����� �� ��������� ��������   
  return '���� '.$AUnit['Base'].$AUnit['End5']; } 
  else if (@in_array('ntoExplicitZero',$Options)) { $result .= '���� ����� '; }     
 }//if 
   
 if ($n_frac == 0) { $result .= CountOfUnits($AUnit,$n_int, array()); } // N ������ 
 else { $result .= CountOfUnits($WD_INT,$n_int, array()); } // �������-�� ����� 
  
 if ($n_frac == 0) { return $result; } 
  
 $result .= CountOfUnits($WD_FRAC[$Precision], $n_frac, array()); 
 // N �������, �����... 
 $result .= $AUnit['Base'].$AUnit['End2'];  
  
 return $result;     
 } 

//-----------------------------------------------------------------------  
 //������� ������������� ����� � �������� ������������� 
 function FloatToText($R, $Precision = 4) { 
  global $WD_EMPTY; 
  try { 
   return AmountOfUnits($WD_EMPTY,$R,$Precision, array('ntoExplicitZero','ntoMinus'));        
  } catch (Exception $e)  
  {  
      return '';  
  }     
 } 
//----------------------------------------------------------------------- 
 /* ������� �������� ������� � ��������� ������������  
    $price = RUR - ������������ 
    $price = USD - ������������ 
         
    $price = SECOND - ������� (������ ����� �����) 
    $price = MINUTES - ������ (������ ����� �����) 
    $price = HOURS - ���� (������ ����� �����) 
    $price = DAY - ��� (������ ����� �����) 
    $price = WEEKS - ������ (������ ����� �����) 
    $price = MONTH - ������ (������ ����� �����) 
    $price = YEAR - ���� (������ ����� �����) 
 */ 
 function CurrencyToText($sum,$price = "RUR") { 
  global $WD_RUBLE,$WD_KOPECK,$WD_USD,$WD_CENT, 
  $WD_YEAR,$WD_MONTH,$WD_WEEKS,$WD_DAYS,$WD_HOURS,$WD_MINUTES,$WD_SECOND; 
   
  $price  = trim($price); 
  $RubSum = Trunc($sum); 
  $KopSum = Round(Frac($sum)); 
   
  if ($KopSum > 100) {  
   $KopSum = round($KopSum/100, 2); 
   $RubSum = $RubSum + Trunc($KopSum); 
   $KopSum = FreeZero(Round(Frac($KopSum) * 100));     
  } 
   
  $sprice  = $WD_RUBLE; 
  $sprice1 = $WD_KOPECK;      
  switch ($price) { 
       case 'USD'     : $sprice = $WD_USD;   $sprice1 = $WD_CENT; break; 
     
    case 'SECOND'  : $sprice = $WD_SECOND;  break; 
    case 'MINUTES' : $sprice = $WD_MINUTES; break; 
    case 'HOURS'   : $sprice = $WD_HOURS;   break; 
    case 'DAY'     : $sprice = $WD_DAYS;    break; 
    case 'WEEKS'   : $sprice = $WD_WEEKS;   break; 
    case 'MONTH'   : $sprice = $WD_MONTH;   break; 
    case 'YEAR'    : $sprice = $WD_YEAR;    break; 
  }        //echo $KopSum;    
  $result = CountOfUnits($sprice,$RubSum, array('ntoExplicitZero')).' '.CountOfUnits($sprice1,$KopSum, array());
  $result = trim($result); 
  if ($result != "") { $str = strtoupper($result[0]); $result[0] = $str; } 
  return $result;    
 } 
//----------------------------------------------------------------------- 
  
 //������� ����� (������) � ������� �������������  
 function ArabicToRoman($num_int) {  
  global $Rim,$Arab;  
  $num_int = Trunc($num_int); 
  $result = ''; 
  $i = 13; 
  while ($num_int > 0) { 
   while ($Arab[$i] > $num_int) { $i--; } 
   $result .= $Rim[$i]; 
   $num_int = $num_int - $Arab[$i];        
  } 
  return $result;         
 } 
  
 //������� �������� ����� � ������� ����� 
 function RomanToArabic($rim_num) { 
  global $Rim,$Arab; 
  $result = 0; 
  $i = 13; 
  $p = 0; 
  while ($p <= strlen($rim_num)) { 
   while (substr($rim_num,$p, strlen($Rim[$i])) != $Rim[$i]) { 
    $i--; 
    if ($i == 0) { return $result; }          
   } 
   $result .= $Arab[$i]; 
   $p = $p + strlen($Rim[$i]); 
  } 
  return $result;     
 } 
//-----------------------------------------------------------------------

?>