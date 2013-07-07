<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<title>����� ������������� �������� � {$number} ({$person->fname} {$person->mname} {$person->sname})</title>
<link href="coupon.css" rel="stylesheet" type="text/css" />
</head>
<body onload="javascript:window.print();">
<div class="div_move_right">
<table cellspacing="0" cellpadding="0" border="0" style="width: 140mm;">
    <tr>
        <td>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="coupon_title">����� ������������� �������� � {$coupon->coupon_id}
                </td>
            </tr>
        </table>
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="ds"><span>������� �����������: </span><span id="ds">
                {if $person->polis->organization->agreement_number }
                    � {$person->polis->organization->agreement_number} c {$person->polis->organization->agreement_date} �� {$person->polis->expiration_date}
                {else}
                    &nbsp;
                {/if}
                </span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="polis"><span>����� �����</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {if $person->polis->series }
                        {$person->polis->series|vsetd}
                    {else}
                     <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    {/if}
                </tr></table></span>
                <span>�</span>
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
                <td class="smo"><span>���</span>
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
                <td class="passport"><span>�������&nbsp;
                �����&nbsp;</span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$person->passport->series|vsetd}
                </tr></table></span>
                <span>�</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$person->passport->number|vsetd}
                </tr></table></span>
		<span>���� ������</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$coupon->person->passport->give_out_date|vsetd}
                </tr></table></span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="snils"><span>�����</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                {$person->pension_number|vsetd}
                </tr></table></span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="ambul"><span>1. ����� ������������ �����</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                {if $person->card_number}
					{$person->card_number|vsetd}
                {else}
					<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                {/if}
                </tr></table></span>
                <span>����� �������</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr><td>{$person->card_number[0]}</td><td>{$person->card_number[1]}</td></tr></table></span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="fio"><span>2. �������, ���, ��������</span><span id="fio">&nbsp;{$person->fname} {$person->mname} {$person->sname}</span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="sex"><span>3. ��� (������� - 2, ������� - 1)</span>
                <div>&nbsp;{$person->sex}</div>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="category"><span>4. ��������� � ���������:</span>
                <div>&nbsp;</div><span>���</span><div>&nbsp;</div><span>����</span><div>&nbsp;</div><span>����� ����</span><div>&nbsp;</div><span>���������</span><br /><br />
                <div>&nbsp;</div><span>����. ���. � ���.</span><div>&nbsp;</div><span>���. �����</span><div>&nbsp;</div><span>������� �������</span><div>&nbsp;</div><span>�������� ������ ��������</span><br />
                <div>&nbsp;</div><span>�����������������</span><div>&nbsp;</div><span>���������</span><div>&nbsp;</div><span>������� �� ����</span><div>&nbsp;</div><span>������</span><br />
                <span>����. ������. ���������:&nbsp;</span><div>&nbsp;</div><span>����</span><div>&nbsp;</div><span>���������. �������</span><div>&nbsp;</div><span>������</span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="birthday"><span>5. ���� �������� (�����, �����, ���)</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$coupon->person->birthday_f|vsetd}
                </tr></table></span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="registr">
                <span>6. ����������� �� ����� ����������:</span><br /><br />
                <div><span>��� �������</span><span id="code"><p>{$person->passport->address->region}</p></span><span>�����</span><span id="raion"><p>&nbsp;{$person->passport->address->r_str}</p></span><span>�����</span><span id="city"><p>{$person->passport->address->town_str}</p></span></div><br />
                <div><span>�����</span><span id="street"><p>{$person->passport->address->street_str}</p></span><span>���</span>
                     <span id="build"><p>{$person->passport->address->build_number}</p></span><span>��������</span><span id="appartment"><p>{$person->passport->address->appartment_address}</p></span></div>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>7. ����� ������������:</span> <span><table cellspacing="1" cellpadding="0"><tr>{$coupon->places_id|vsetd}</tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - ������ ������������<br />
                    2 - ������ ������������ - ��������� �� ����<br />
                    3 - ������ ������������ - ������� ���������<br />
                    4 - ������ ������������<br />
                    5 - ������ ������������ - ��������� �� ����<br />
                    6 - ������ ������������ - ������� ���������
                    </span>
                    <span>
                    7 - �������� ������������<br />
                    8 - �������� ������������ - ��������� �� ����<br />
                    9 - �������� ������������ - ������� ���������<br />
                    10 - ������������ ��. �������<br />
                    11 - ������������ ��. ������� - ��������� �� ����<br />
                    12 - ������������ ��. ������� - ������� ���������
                    </span>                    
                </div>
                <div><span>����� ���������� � ����������:</span></div>
                <div><span>�</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span>
                <span>��</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><br /></div>
                <div><span>����� ����������� ����� ������������� ��������</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span></div>
                <div><span>����������� ����� ����:</span> <span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td><td>&nbsp;</td></tr></table></span></div>
                <div><span>���� � ����� ���:</span><span id="kek">&nbsp;</span></div>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="work">
                <div><span>8. ��������� � ������: </span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
						{if $person->polis->work_type_id}
                           
							{$person->polis->work_type_id|vsetd}
						{else}
							<td>&nbsp;</td>
						{/if}
				</tr></table></span></div><br />
                <div id="work">
                    <span>
                    1 - ��������<br />
                    2 - �� ��������<br />
                    3 - ������ � �����<br />
                    </span>
                    <span>
                    4 - ������ � ���<br />
                    5 - ������ � ���������<br />
                    6 - ������ � ����<br />
                    </span>
                    <span>
                    7 - �� ������<br />
                    8 - �������� ���<br />
                    9 - �� �������� ���<br />
                    </span>                         
                </div>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="gruppa">
                <span>9. ������ ������������:</span><span><table cellspacing="1" cellpadding="0"><tr><td>&nbsp;</td></tr></table></span>
                <span>1 - ����������� �������, 2 - ������������, 3 - ����� ������</span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="">
                <span>10. ����� ������</span><span id="work_place">
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
                <span>11. �������� ��������������:</span><span><table cellspacing="1" cellpadding="0"><tr>{$coupon->payment_code|vsetd}</tr></table></span>
                <span>1 - ���, 2 - ������, 3 - ���, 4 - ��-�� ������������, 5 - ������ ��-��</span>
                </td>
            </tr>
        </table>
  	      <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="date">
                <span>12. ���� ���������</span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                    {$coupon->open_date|vsetd}
                </tr></table></span>
                <span>���� ���������</span><span><table cellspacing="1" cellpadding="0"><tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr></table></span>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="visit">
                <span>13. ��������� ������������:</span><br />
                <span><table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
                    <tr id="title">
                        <td colspan="6">��� �����
                        </td>
                        <td colspan="21">��� ���������
                        </td>
                        <td colspan="6">����
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
                <span>14. ��������������� ������������ � �������� �����������:</span><br />
                <span>
					<table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
						<tr>
							<td>��������.</td>
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
							<td>���.���.���.</td>
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
							<td>�������.</td>
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
							<td>�����.���.</td>
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
							<td>���������.</td>
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
							<td>�����.���.</td>
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
							<td>����.����.</td>
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
							<td>����.�����.</td>
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
							<td>����.���..</td>
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
						<td class="sex"><span>15. ������� �������������� (������� ���-�)</span>
						<br><span>��������________________________________________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span>
						<br><span>�������������___________________________________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span>
						<br><span>�������� ��� �����������-5</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td></tr></table></span>
						</td>
					</tr>
				</table>
				
				 <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>16. ��� ������, ����������</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - ������������<br />
                    2 - ��������������������<br />
                    3 - ������������<br />
                    4 - �����������<br />
                    5 - ������<br />
                    6 - �������
                    </span>
                    <span>
                    7 - �������<br />
                    8 - ������������<br />
                    9 - ������������<br />
                    10 - ��������<br />
                    11 - ����������<br />
                    12 - ������<br />
					13 - � ���������� ��������������
                    </span>                    
                </div>
               </td>
            </tr>
        </table><br>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>17. ���������������</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - �� ������� �� �����<br />
                    2 - ������� �� �����<br />
                    3 - ���� �� ����
                    </span>
                    <span>
                    4 - ���� � ����� �� �������������<br />
                    5 - ���� � ����� � ����� �� ��������<br />
                    6 - ���� � ����� �� �������<br />
                    7 - ���� � ����� �� �������. ��������
                    </span>                    
                </div>
				<span>���� ��������� ���� </span><span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>18. ����� �����������</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - �������������<br />
                    2 - ���������
                    </span>
                    <span>
                    3 - ������������ ����������<br />
                    4 - ���������
                    </span>   
					<span>
					5 - ������������ <br />
					6 - ������
					</span>
                </div>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>19. ��������������</span> <span>______________________________________________________________________________</span>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>20. �������� � ��������� ������������������ �� ������������ ������</span> 
				<br>
				<span>�������� ������������������:</span><span>���� ������:</span><span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
                <br>
				<span>������� ������:</span><span>���� ��������:</span><span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>21. ������ ������������ (��������-1, �� ��������-2)</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
			   </td>
            </tr>
        </table>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>22. ������� ��������</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>23. ��� �������� �����</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>24. ����������� �����: ����� � �, ���� �������:</span><br>
				24.1............................................................................24.2...........................................................................	
			   </td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>������� �������� �����</span>	
			   </td>
            </tr>
        </table>		
		
		
		
		</td>		
	</tr>	
</table>
</div>
</body>
</html>
