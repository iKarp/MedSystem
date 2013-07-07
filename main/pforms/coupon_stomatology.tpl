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
                <td class="coupon_title">����� ������������������ �������� � {$coupon->coupon_id}
                </td>
            </tr>
        </table>

        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td  class="registr"><span>����� / ������� 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����</span>
				<span id="street">
                
                    {if $person->polis->series }
                        {$person->polis->series}
                    {else}
                     
                    {/if}
                </span>
                <span>�</span>
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
                <td class="snils"><span>���. �</span>
                <span><table cellspacing="1" cellpadding="0" class="cent"><tr>
                {$person->polis->ind_number|vsetd}
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
                <td class="sex"><span>3. ���</span>
                <div>&nbsp;{$person->sex}</div> (������� - 2, ������� - 1)
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="category"><span>4. ��������� � ���������:</span>
                <div>&nbsp;</div><span>���</span><div>&nbsp;</div><span>����</span></td>
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
                <td class="work">
                <div><span>7. ��������� � ������: </span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
						{if $person->polis->work_type_id}
                           
							{$person->polis->work_type_id|vsetd}
						{else}
							<td>&nbsp;</td>
						{/if}
				</tr></table></span><span>
                   ( 1 - ��������, 2 - �� �������� )
                    </span></div><br />
                </td>
            </tr>
        </table>
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="">
                <span>8. ����� ������</span><span id="work_place">
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
                <span>9. �������� ��������������:</span><span><table cellspacing="1" cellpadding="0"><tr>{$coupon->payment_code|vsetd}</tr></table></span><br>
                <span>1 - ���, 2 - ������, 3 - ���, 4 - ��-�� ������������, 5 - ������ ��-�� �������</span>
                </td>
            </tr>
        </table>
		
  	    <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="date">
                <span>10. ���� ���������</span><span><table cellspacing="1" cellpadding="0" class="cent"><tr>
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
                <td class="obsluzh"><span>11. ���� ���������:</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>
                    1 - �������-���������������<br />
                    2 - ������������<br />
                    3 - ���������������
                    </span>
                    <span>
                    4 - ���������� (��������)<br />
                    5 - ������
                    </span>                    
                </div>
               </td>
            </tr>
        </table>
		
       <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="sex"><span>12. ��������� ���������:</span>
                <div></div> (1 - ���������, 2 - ���������)
                </td>
            </tr>
        </table>	

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>13. ���  �����</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>		
		
		
        <table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="visit">
                <span>14. ����������� ����� ��������� �����:</span><br />
                <span><table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
                    <tr id="title">
                        <td colspan="4">��� ���.<br>������</td>
						<td></td>
						<td>�*</td>
						<td></td>
						<td>�**</td>
						<td></td>
						<td colspan=4>��� ���.<br>������</td>
						<td></td>
						<td>�*</td>
						<td></td>
						<td>�**</td>
						<td></td>
						<td colspan=4>��� ���.<br>������</td>
						<td></td>
						<td>�*</td>
						<td></td>
						<td>�**</td>
						<td></td>
						<td>���� ��������<br>���.������</td>
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
                <span>15. ��������������� ������������ � �������� �����������:</span><br />
                <span>
					<table cellspacing="1" cellpadding="0" border="0" class="visit_spec">
						<tr>
							<td></td>
							<td colspan=4>���</td>
							<td></td>
							<td>�*</td>
							<td></td>
							<td colspan=4>���</td>
							<td></td>
							<td>�*</td>
							<td></td>
							<td></td>
							<td colspan=4>���</td>
							<td></td>
							<td>�*</td>
							<td></td>
							<td colspan=4>���</td>
							<td></td>
							<td>�*</td>
						</tr>	
						<tr>
						<td>����������������-<br>���� �������</td>
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
						<td>������������������<br>�������</td>
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
						<tr><td class="sex"><span>16. ������� (������� ���-�)</span><span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;17. �������� � ���������������</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(������� �� �����, ���� �� ����, ���� � �����)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(������� �� �����, ���� �� ����, ���� � �����)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(������� �� �����, ���� �� ����, ���� � �����)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(������� �� �����, ���� �� ����, ���� � �����)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(������� �� �����, ���� �� ����, ���� � �����)</span></td></tr>
						<tr><td><span>____________________________________</span><span><table cellspacing="0" cellpadding="0" class="ambul"><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table></span><span>(������� �� �����, ���� �� ����, ���� � �����)</span></td></tr>
				</table>
				
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>18. �������� ������� (���������������� �������)</span></td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>19. ���������</span></td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>20. ��� ������, ����������</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>I. ����������������:</span>
					<span>
                    1 - ������������<br />
                    2 - ��������������������<br />
                    3 - ������������<br />
                    4 - �������-������������<br />
                    5 - ������
                    </span>
					<span>II. �� ��������� <br>� �������������:</span>
                    <span>
					6 - �������<br />
                    7 - �������<br />
                    8 - ������������<br />
                    9 - �������-������������<br />
                    10 - ��������<br />
                    11 - ����������<br />
                    12 - ������
                    </span>                    
                </div>
               </td>
            </tr>
        </table>
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>21. ��������������</span> <span>______________________________________________________________________________</span>
               </td>
            </tr>
        </table>

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>22. �������� � ��������� ������������������ �� ������������ ������:</span> <span><table cellspacing="1" cellpadding="0"><tr><td></td></tr></table></span>
                <div id="obsluzh">
                    <span>������ ������������������:</span>
					<span>
					���� ������  <table cellspacing="1" cellpadding="0"><tr>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                    <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                </tr></table>
                    <br>
                   ���� ��������  <table cellspacing="1" cellpadding="0"><tr>
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
                <td class="sex"><span>23. ������ ������������</span>
                <div>&nbsp;</div> (�������� - 1, �� �������� - 2)
                </td>
            </tr>
        </table>		

		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>24. ������� �������� </span> <span><table cellspacing="1" cellpadding="0"><tr><td></td><td></td><td></td></tr></table></span>
			   </td>
            </tr>
        </table>		
		
				
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������� �������� �����</span>	<span>_________________________________</span>
			   </td>
            </tr>
        </table>		
		
		<table cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td class="obsluzh"><span>�* - ���������, �** - ������� ���������</span>
			   </td>
            </tr>
        </table>
		
		</td>		
	</tr>	
</table>
</div>
</body>
</html>
