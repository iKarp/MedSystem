<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<title>НАПРАВЛЕНИЕ № {$coupon->coupon_num}/{$coupon_num_year} ({$person->fname} {$person->mname} {$person->sname})</title>
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
<div class="dog_a">ДОГОВОР ОКАЗАНИЯ ПЛАТНЫХ МЕДИЦИНСКИХ УСЛУГ № {$coupon->coupon_num}/{$coupon_num_year}/А (Договор обследования)</div>
<div class="dog_a">{$date_begin}</div>

<div class="content">
    <p>Мы, нижеподписавшиеся, Общество с ограниченной ответственностью «Коммерсант», 
    именуемое в дальнейшем ИСПОЛНИТЕЛЬ, в лице Директора Смирновой Елены Николаевны, 
    действующего на основании Устава, лицензий №№52-01-000764 от 05.07.2007г., ЛО-52-001234 от 26.08.2010г.,
    на оказание медицинских услуг и Постановления Правительства РФ от 13 января 1996 г. № 27 с одной стороны, 
    и {$person->fname} {$person->mname} {$person->sname} именуем{if $person->sex==1}ая{else}ый{/if} в дальнейшем ЗАКАЗЧИК,  с другой стороны, заключили настоящий договор о нижеследующем:</p>
	
    <ol>
        {assign var=doctor_name value=$coupon->attending_doctor_id}
        <li value="1"><p>ИСПОЛНИТЕЛЬ обязуется произвести в оговоренное с ЗАКАЗЧИКОМ время диагностическое обследование ЗАКАЗЧИКА следующих видов: 
        <br />
		{if $coupon->services}
            <ul>
            {foreach from=$coupon->services item=item key=key}
                <li>{$item.service_name} ({$item.service_price} руб.) - врач {$item.service_name_doc}</li>
            {/foreach}
            </ul> 
        {/if}
		<br />
        для установления диагноза, о результатах обследования проинформировать ЗАКАЗЧИКА.<br>
При обследовании стоматологом, ЗАКАЗЧИК делает письменную отметку в амбулаторной карте об ознакомлении с предварительный диагнозом, планом лечения и возможными осложнениями.</p></li>
        <li value="2"><p>
        ЗАКАЗЧИК обязуется предварительно оплатить стоимость действий, 
        предусмотренных п. 1 настоящего договора, по расценкам прейскуранта, 
        с которыми ЗАКАЗЧИК предварительно ознакомился.</p></li>                                                                                                                            </li>
        <li value="3"><p>ЗАКАЗЧИК соглашается с тем, что при предварительном осмотре может возникнуть необходимость 
        проведения рентгенографических и других необходимых диагностических мероприятий, 
        которые осуществляются ИСПОЛНИТЕЛЕМ за отдельную плату. 
        При отсутствии соответствующих технических возможностей у ИСПОЛНИТЕЛЯ, ИСПОЛНИТЕЛЬ оставляет 
        за собой право направить ЗАКАЗЧИКА в иную специализированную медицинскую организацию.
        </p></li>
    </ol>
</div>

<div class="footer">
    <div class="l">
     ИСПОЛНИТЕЛЬ: <br />
     <b>ООО «Коммерсант»</b>   <br /> 
     г. Выкса, ул. Островского, д. 50  <br />                                     
     помещение №1 <br />                                                               
     ИНН 5247002828 КПП 524701001 <br /> .
        <div class="dov">Доверенность</div>                                                                                       
    </div>
    
    <div class="r">
        ЗАКАЗЧИК:<br />
        <b>{$person->fname} {$person->mname} {$person->sname}</b><br /> 
        Паспорт: серия {$person->passport->series} № {$person->passport->number}<br />
        Адрес: {$person->passport->address->full_address()}
    </div>
</div>


</body>
</html>
