<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<title>����� �� ������������</title>
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
    font-size:20px;
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
<div class="dog_a"><p>����� �� ������������</p></div>

<div class="content">
    <table width="100%">
		<tr>
			<td width="20%"><b>�������(�):</b></td>
			<td width="80%">{$user->showname()}</td>
		</tr>
		<tr>
			<td width="20%"><b>��������� ����:</b></td>
			<td width="80%">{$begin_date}</td>
		</tr>
		<tr>
			<td width="20%"><b>�������� ����:</b></td>
			<td width="80%">{$end_date}</td>
		</tr>
		<tr>
			<td width="20%"><b>����� �����������:</b></td>
			<td width="80%">{$total_number}</td>
		</tr>
		<tr>
			<td width="20%"><b>����� �����, ���:</b></td>
			<td width="80%">{$total_price}</td>
		</tr>
	</table>
	<br>
	 <table width="100%" border="1px solid black" cellspacing="0" cellpadding="3" style="border-collapse:collapse;">
		
            <thead>
                <th width="5%">�</td>
                <th width="25%">�������</td>
                <th width="25%">������� ����</td>
				<th width="7%">� ����.</td>
                <th width="7%">�����, ���</td>
                <th width="10%">����� ��������</td>
				<th width="10%">����� ��������</td>
            </thead>
			{*include file='wnd_coupons_list.tpl'*}
						{foreach from=$coupons item=coupon}
			<tr onClick="OpenCouponDlg({$coupon.coupon_id})" onmouseover="style.backgroundColor='#BECFFF'" onmouseout="style.backgroundColor=''">
				<td align="center">{$coupon.coupon_num|default:'-'}/11</td>
                <td>{$coupon.client_fio}</td>
                <td>{$coupon.doctor_fio|default:'---'}</td>
                <td align="center">{$coupon.bill_num}</td>
				<td align="center">{$coupon.total_price}</td>
				<td align="center">{$coupon.open_date}</td>
				<td align="center">{if !$coupon.is_active}������� {$coupon.closer_fio}{else}{if $coupon.status}{$coupon.close_date}{else}�� �������{/if}{/if}</td>
            </tr>
			{foreachelse}
			<tr>
				<td colspan="6">����������� �� �������</td>
			</tr>
			{/foreach}
	</table>
	<br>
	<p>
		C�������(�) ______________________  {$user->showname()}<br>
		{$current_date}
	</p>
	<p>
		��������(�) ______________________  /___________________/<br>
	</p>
</div>                                                                                     
    
</body>
</html>
