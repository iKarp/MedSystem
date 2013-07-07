<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<title>Согласие для направления № {$coupon->coupon_num}/{$coupon_num_year} ({$person->fname} {$person->mname} {$person->sname})</title>
<!--<link href="/static/arm/userreg/css/coupon.css" rel="stylesheet" type="text/css" />-->
{literal}
<style type="text/css">
<!--
.head {
    font-family:Times New Roman;
    font-size:11px;
    text-align:center;
}

.dog_a {
    font-size:12px;
    font-weight:bold;
    margin-top:10px;
    text-align:center;
}

body {
    font-family:Times New Roman;
}

.content {
    font-size:13px;
}

.footer {
    font-size:12px;
    margin-top:50px;
    margin-left:20px;
}

.footer div.l {
    width:200px;
    float: left;
}

.footer div.l div.dov{
    border-top: 1px black solid;
}
.footer div.r{
    float:right;
    margin-right:100px;   
}	
-->
</style>
{/literal}
</head>
<body onload="javascript:window.print();">
<div class="dog_a">Согласие пациента на проведение компьютерной томографии с внутривенным введением йодосодержащих констрастных препаратов</div>

<div class="content">
    <p>Я {$person->fname} {$person->mname} {$person->sname}, дата рождения {$p_birthday|date_format:"%d.%m.%Y"}, проживающ{if $person->sex==1}ая{else}ий{/if} 
	по адресу: {$person->passport->address->full_address()}, находясь на лечении (обследовании) в клинике РусИзраМед, даю свое согласие
	на проведение компьютерной томографии с внутривенным введением неионного йодосодержащего констрастного препарата.
	Об ограничениях и возможных последствиях внутривенного введения неионного йодосодержащего констрастного препарата и связанном с ним риске
	информирован{if $person->sex==1}а{/if}.</p>
	<table width="100%">
		<tr>
			<td width="70%"><p>Дата: {$smarty.now|date_format:"%d.%m.%Y"}</p></td>
			<td width="30%"><p>Подпись ______________________________</p></td>
		</tr>
	</table>
	<div style="position: fixed">
		<p>Пациент расписался в моем присутствии ____________________________________________________________</p>
		<p>Врач или зав. отделением _________________________________</p>
	</div>
	
</div>                                                                                     
    
</body>
</html>
