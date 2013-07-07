<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<title>ТАЛОН АМБУЛАТОРНОГО ПАЦИЕНТА № {$number} ({$person->fname} {$person->mname} {$person->sname})</title>
<link href="coupon.css" rel="stylesheet" type="text/css" />
</head>
<body onload="javascript:window.print();">
<div class="div_move_right">
<table cellspacing="0" cellpadding="0" border="0" style="width: 140mm;">
    <tr>
        <td>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="coupon_title">Талон стоматологического пациента № {$coupon->coupon_id}
                </td>
            </tr>
        </table>

        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td  class="registr"><span>Полис / Паспорт 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Серия</span>
				<span id="street">
                
                    {if $person->polis->series }
                        {$person->polis->series}
                    {else}
                     
                    {/if}
                </span>
                <span>№</span>
                <span><span id="street">
                    {if $person->polis->number }
                        {$person->polis->number}
                    {else}
                        &nbsp;
                    {/if}
                </span>
                </td>
            </tr>
        </table>		
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="smo"><span>СМО</span>
                <span id="smo">
                    {if $person->polis->oms_organization->name}
						&nbsp;{$person->polis->oms_organization->name}
					{/if}
                </span>
                </td>
            </tr>
        </table>
		
       <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="snils"><span>Инд. №</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                {$person->polis->ind_number|vsetd}
                </tr></table></span>
                </td>
            </tr>
        </table>		
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="ambul"><span>1. Номер амбулаторной карты</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                {if $person->card_number}
					{$person->card_number|vsetd}
                {else}
					<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                {/if}
                </tr></table></span>
                <span>Номер участка</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr><td>{$person->card_number[0]}</td><td>{$person->card_number[1]}</td></tr></table></span>
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="fio"><span>2. Фамилия, Имя, Отчество</span><span id="fio">&nbsp;{$person->fname} {$person->mname} {$person->sname}</span>
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="sex"><span>3. Пол</span>
                <div>&nbsp;{$person->sex}</div> (мужчина - 2, женщина - 1)
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="category"><span>4. Отношение к категории:</span>
                <div>&nbsp;</div><span>ИОВ</span><div>&nbsp;</div><span>УВОВ</span></td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="birthday"><span>5. Дата рождения (число, месяц, год)</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$coupon->person->birthday_f|vsetd}
                </tr></table></span>
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="registr">
                <span>6. Регистрация по месту проживания:</span><br /><br />
                <div><span>Код региона</span><span id="code"><p>{$person->passport->address->region}</p></span><span>район</span><span id="raion"><p>&nbsp;{$person->passport->address->r_str}</p></span><span>город</span><span id="city"><p>{$person->passport->address->town_str}</p></span></div><br />
                <div><span>Улица</span><span id="street"><p>{$person->passport->address->street_str}</p></span><span>Дом</span>
                     <span id="build"><p>{$person->passport->address->build_number}</p></span><span>Квартира</span><span id="appartment"><p>{$person->passport->address->appartment_address}</p></span></div>
                </td>
            </tr>
        </table>
		
 
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="work">
                <div><span>7. Отношение к работе: </span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
						{if $person->polis->work_type_id}
                           
							{$person->polis->work_type_id|vsetd}
						{else}
							<td>&nbsp;</td>
						{/if}
				</tr></table></span><span>
                   ( 1 - работает, 2 - не работает )
                    </span></div><br />
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="">
                <span>8. Место работы</span><span id="work_place">
                    {if $person->polis->organization->name}
                        &nbsp;{$person->polis->organization->name}
                    {/if}
                </span>
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="finans">
                <span>9. Источник финансирования:</span><span><table cellspacing="1" cellpadding="0"><tr>{$coupon->payment_code|vsetd}</tr></table></span><br>
                <span>1 - ОМС, 2 - Бюджет, 3 - ДМС, 4 - Ср-ва работадателя, 5 - Личные ср-ва ргаждан</span>
                </td>
            </tr>
        </table>
		
  	    <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="date">
                <span>10. Дата обращения</span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$coupon->open_date|vsetd}
                </tr></table></span>
                <span>Дата окончания</span><span><table cellspacing="1" cellpadding="0"><tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr></table></span>
                </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>11. Цель обращения:</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - лечебно-диагностическая<br />
                    2 - диспансерная<br />
                    3 - консультативная
                    </span>
                    <span>
                    4 - профосмотр (плановый)<br />
                    5 - прочие
                    </span>                    
                </div>
               </td>
            </tr>
        </table>
		
       <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="sex"><span>12. Повторное обращение:</span>
                <div></div> (1 - первичный, 2 - повторный)
                </td>
            </tr>
        </table>	

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>13. Код  врача</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>		
		
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="visit">
                <span>14. Фактический объем выполнены услуг:</span><br />
                <span><table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
                    <tr id="title">
                        <td colspan="4">Код мед.<br>услуги</td>
						<td></td>
						<td>К*</td>
						<td></td>
						<td>П**</td>
						<td></td>
						<td colspan=4>Код мед.<br>услуги</td>
						<td></td>
						<td>К*</td>
						<td></td>
						<td>П**</td>
						<td></td>
						<td colspan=4>Код мед.<br>услуги</td>
						<td></td>
						<td>К*</td>
						<td></td>
						<td>П**</td>
						<td></td>
						<td>Дата оказания<br>мед.услуги</td>
                    </tr>
                    <tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
						<td rowspan=10></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td ></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>z
                    <tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
                    </tr>
                    
                    
                    
                    
                    
                </table>
                </span>
                </td>
            </tr>
        </table>
        
		</td>
    </tr>
</table>
</div>

<div class="div_move_right_all">
<table cellspacing="0" cellpadding="0" border="0" style="width: 140mm;">
    <tr>
        <td>
	
			    <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td>
                <span>15. Диагностическое исследование и лечебные мероприятия:</span><br />
                <span>
					<table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
						<tr>
							<td></td>
							<td colspan=4>Код</td>
							<td></td>
							<td>К*</td>
							<td></td>
							<td colspan=4>Код</td>
							<td></td>
							<td>К*</td>
							<td></td>
							<td></td>
							<td colspan=4>Код</td>
							<td></td>
							<td>К*</td>
							<td></td>
							<td colspan=4>Код</td>
							<td></td>
							<td>К*</td>
						</tr>	
						<tr>
						<td>Физиотерапевтиче-<br>ский кабинет</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
						<tr>
						<td>Рентгенологический<br>кабинет</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
					</table>
                </span>
                </td>
            </tr>
        </table>			
		       <br><br><br><br></br>
				<table cellspacing="0" cellpadding="0" border="0">
						<tr><td class="sex"><span>16. Диагноз (рубрики МКБ-Х)</span><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;17. Сведения о диспансеризации</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(Состоит на учете, взят на учет, снят с учета)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(Состоит на учете, взят на учет, снят с учета)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(Состоит на учете, взят на учет, снят с учета)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(Состоит на учете, взят на учет, снят с учета)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(Состоит на учете, взят на учет, снят с учета)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(Состоит на учете, взят на учет, снят с учета)</span></td></tr>
				</table>
				
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>18. Подлежит санации (ортодонтическому лечению)</span></td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>19. Санирован</span></td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>20. Вид травмы, отравления</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>I. Производственная:</span>
					<span>
                    1 - промышленная<br />
                    2 - сельскохозяйственная<br />
                    3 - транспортная<br />
                    4 - дорожно-транспортная<br />
                    5 - прочая
                    </span>
					<span>II. Не связанная <br>с производством:</span>
                    <span>
					6 - бытовая<br />
                    7 - уличная<br />
                    8 - транспортная<br />
                    9 - дорожно-транспортная<br />
                    10 - школьная<br />
                    11 - спортивная<br />
                    12 - прочая
                    </span>                    
                </div>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>21. Госпитализация</span> <span>______________________________________________________________________________</span>
               </td>
            </tr>
        </table>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>22. Сведения о временной нетрудоспособности по законченному случаю:</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>Листок нетрудоспособности:</span>
					<span>
					Дата выдачи  <table cellspacing="1" cellpadding="0"><tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr></table>
                    <br>
                   Дата закрытия  <table cellspacing="1" cellpadding="0"><tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr></table>
                    </span>
					                   
                </div>
               </td>
            </tr>
        </table>		
		
       <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="sex"><span>23. Случай обслуживания</span>
                <div>&nbsp;</div> (закончен - 1, не закончен - 2)
                </td>
            </tr>
        </table>		

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>24. Уровень качества </span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>		
		
				
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Подпись лечащего врача</span>	<span>_________________________________</span>
			   </td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>К* - кратность, П** - признак плотности</span>
			   </td>
            </tr>
        </table>
		
		</td>		
	</tr>	
</table>
</div>
</body>
</html>
