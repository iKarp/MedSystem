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
                <td class="coupon_title">ТАЛОН АМБУЛАТОРНОГО ПАЦИЕНТА № {$coupon->coupon_id}
                </td>
            </tr>
        </table>
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="ds"><span>Договор страхования: </span><span id="ds">
                {if $person->polis->organization->agreement_number }
                    № {$person->polis->organization->agreement_number} c {$person->polis->organization->agreement_date} по {$person->polis->expiration_date}
                {else}
                    &nbsp;
                {/if}
                </span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="polis"><span>Полис Серия</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {if $person->polis->series }
                        {$person->polis->series|vsetd}
                    {else}
                     <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    {/if}
                </tr></table></span>
                <span>№</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {if $person->polis->number }
                        {$person->polis->number|vsetd}
                    {else}
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    {/if}
                </tr></table></span>
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
                <td class="passport"><span>Паспорт&nbsp;
                Серия&nbsp;</span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$person->passport->series|vsetd}
                </tr></table></span>
                <span>№</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$person->passport->number|vsetd}
                </tr></table></span>
		<span>Дата выдачи</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$coupon->person->passport->give_out_date|vsetd}
                </tr></table></span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="snils"><span>СНИЛС</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                {$person->pension_number|vsetd}
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
                <td class="sex"><span>3. Пол (мужчина - 2, женщина - 1)</span>
                <div>&nbsp;{$person->sex}</div>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="category"><span>4. Отношение к категории:</span>
                <div>&nbsp;</div><span>ИОВ</span><div>&nbsp;</div><span>УВОВ</span><div>&nbsp;</div><span>Вдова УВОВ</span><div>&nbsp;</div><span>Блокадник</span><br /><br />
                <div>&nbsp;</div><span>Нагр. орд. и мед.</span><div>&nbsp;</div><span>Инв. труда</span><div>&nbsp;</div><span>Ребенок инвалид</span><div>&nbsp;</div><span>Участник боевых действий</span><br />
                <div>&nbsp;</div><span>Реабилитированный</span><div>&nbsp;</div><span>Подросток</span><div>&nbsp;</div><span>Ребенок до года</span><div>&nbsp;</div><span>Прочие</span><br />
                <span>Подв. радиац. излучению:&nbsp;</span><div>&nbsp;</div><span>ЧАЭС</span><div>&nbsp;</div><span>Семипалат. полигон</span><div>&nbsp;</div><span>Другие</span>
                </td>
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
                <td class="obsluzh"><span>7. Место обслуживания:</span> <span><table cellspacing="1" cellpadding="0"><tr>{$coupon->places_id|vsetd}</tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - данной поликлиникой<br />
                    2 - данной поликлиникой - стационар на дому<br />
                    3 - данной поликлиникой - дневной стационар<br />
                    4 - другой поликлиникой<br />
                    5 - другой поликлиникой - стационар на дому<br />
                    6 - другой поликлиникой - дневной стационар
                    </span>
                    <span>
                    7 - сельской поликлиникой<br />
                    8 - сельской поликлиникой - стационар на дому<br />
                    9 - сельской поликлиникой - дневной стационар<br />
                    10 - поликлиникой др. области<br />
                    11 - поликлиникой др. области - стационар на дому<br />
                    12 - поликлиникой др. области - дневной стационар
                    </span>                    
                </div>
                <div><span>Время прибывания в стационаре:</span></div>
                <div><span>с</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span>
                <span>по</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><br /></div>
                <div><span>Номер медицинской карты стационарного больного</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span></div>
                <div><span>Фактическое число дней:</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td></tr></table></span></div>
                <div><span>Дата и номер КЭК:</span><span id="kek">&nbsp;</span></div>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="work">
                <div><span>8. Отношение к работе: </span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
						{if $person->polis->work_type_id}
                           
							{$person->polis->work_type_id|vsetd}
						{else}
							<td>&nbsp;</td>
						{/if}
				</tr></table></span></div><br />
                <div id="work">
                    <span>
                    1 - работает<br />
                    2 - не работает<br />
                    3 - учится в школе<br />
                    </span>
                    <span>
                    4 - учится в ПТУ<br />
                    5 - учится в техникуме<br />
                    6 - учится в ВУЗе<br />
                    </span>
                    <span>
                    7 - не учится<br />
                    8 - посещает ДДУ<br />
                    9 - не посещает ДДУ<br />
                    </span>                         
                </div>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="gruppa">
                <span>9. Группа инвалидности:</span><span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td></tr></table></span>
                <span>1 - установлена впервые, 2 - подтверждена, 3 - снята группа</span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="">
                <span>10. Место работы</span><span id="work_place">
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
                <span>11. Источник финансирования:</span><span><table cellspacing="1" cellpadding="0"><tr>{$coupon->payment_code|vsetd}</tr></table></span>
                <span>1 - ОМС, 2 - Бюджет, 3 - ДМС, 4 - Ср-ва работадателя, 5 - Личные ср-ва</span>
                </td>
            </tr>
        </table>
  	      <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="date">
                <span>12. Дата обращения</span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
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
                <td class="visit">
                <span>13. Посещение специалистов:</span><br />
                <span><table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
                    <tr id="title">
                        <td colspan="6">Код врача
                        </td>
                        <td colspan="21">Код посещения
                        </td>
                        <td colspan="6">Дата
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td rowspan="7">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td rowspan="7">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td rowspan="7">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td rowspan="7">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td rowspan="7">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                        <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
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
                <span>14. Диагностическое исследование и лечебные мероприятия:</span><br />
                <span>
					<table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
						<tr>
							<td>Физиотер.</td>
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
							<td>Каб.дов.пом.</td>
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
							<td>Лаборат.</td>
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
							<td>Смотр.каб.</td>
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
						<tr id="title">
							<td>Рентгенол.</td>
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
							<td>Иммун.каб.</td>
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
						<tr id="title">
							<td>Функ.диаг.</td>
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
							<td>Опер.пособ.</td>
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
						<tr id="title">
							<td>Проц.каб..</td>
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
					<tr>
						<td class="sex"><span>15. Диагноз заключительный (рубрики МКБ-Х)</span>
						<br><span>Основной________________________________________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span>
						<br><span>Сопутствующий___________________________________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span>
						<br><span>Выявлено при профосмотре-5</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td></tr></table></span>
						</td>
					</tr>
				</table>
				
				 <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>16. Вид травмы, отравления</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - промышленная<br />
                    2 - сельскохозяйственная<br />
                    3 - транспортная<br />
                    4 - автодоожная<br />
                    5 - прочая<br />
                    6 - бытовая
                    </span>
                    <span>
                    7 - уличная<br />
                    8 - транспортная<br />
                    9 - автодорожная<br />
                    10 - школьная<br />
                    11 - спортивная<br />
                    12 - прочая<br />
					13 - в результате терростических
                    </span>                    
                </div>
               </td>
            </tr>
        </table><br>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>17. Диспансеризация</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - Не состоит на учете<br />
                    2 - Состоит на учете<br />
                    3 - Взят на учет
                    </span>
                    <span>
                    4 - Снят с учета по выздоровлению<br />
                    5 - Снят с учета в связи со смерьтью<br />
                    6 - Снят с учета по выбытию<br />
                    7 - Снят с учета по изменен. диагноза
                    </span>                    
                </div>
				<span>Дата следующей явки </span><span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>18. Исход заболевания</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - Выздоровление<br />
                    2 - Улучшение
                    </span>
                    <span>
                    3 - Динамическое наблюдение<br />
                    4 - Ухудшение
                    </span>   
					<span>
					5 - Инвалидность <br />
					6 - Смерть
					</span>
                </div>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>19. Госпитализация</span> <span>______________________________________________________________________________</span>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>20. Сведения о временной нетрудоспособности по законченному случаю</span> 
				<br>
				<span>Документ нетрудоспособности:</span><span>Дата выдачи:</span><span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
                <br>
				<span>Причина выдачи:</span><span>Дата закрытия:</span><span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>21. Случай обслуживания (закончен-1, не закончен-2)</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
			   </td>
            </tr>
        </table>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>22. Уровень качества</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>23. Код лечашего врача</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>24. Рецептурный бланк: серия и №, дата выписки:</span><br>
				24.1............................................................................24.2...........................................................................	
			   </td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>Подпись лечащего врача</span>	
			   </td>
            </tr>
        </table>		
		
		
		
		</td>		
	</tr>	
</table>
</div>
</body>
</html>
