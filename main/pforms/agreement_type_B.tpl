<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<title>����������� � {$coupon->coupon_num}/{$coupon_num_year} ({$person->fname} {$person->mname} {$person->sname})</title>
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

.p_pod{margin:3px;
  
}

.content {
    font-size:14px;
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

.ol_n{ margin-left:-20px;

}
/*LI { list-style-type: none; } /* ������� �������� ��������� */
/*OL { counter-reset: list1; } /* ���������� ������� */
/*OL LI:before {
/* counter-increment: list1; /* ����������� �������� �������� */
/* content: counter(list1) ". "; /* ������� �������� */
/*}
/*OL OL { counter-reset: list2; } /* ���������� ������� ���������� ������ */
/*OL OL LI:before {
/* counter-increment: list2; /* ����������� �������� �������� */
/* content: counter(list1) "." counter(list2) ". "; /* ������� �������� ���� 2.1, 2.2,... */
/*}*/	
-->
</style>
{/literal}
</head>
<body onload="javascript:window.print();">
<div class="dog_a">������� �������� ������� ����������� ����� � {$coupon->coupon_num}/{$coupon_num_year}/� (������� �������)</div>
<div class="dog_a">{$date_begin}</div>

<div class="content">
    <p>��, �����������������, �������� � ������������ ���������������� �����������, 
    ��������� � ���������� �����������, � ���� ��������� ��������� ����� ����������, 
    ������������ �� ��������� ������, �������� ��52-01-000764 �� 05.07.2007�., ��-52-001234 �� 26.08.2010�.,
    �� �������� ����������� ����� � ������������� ������������� �� �� 13 ������ 1996 �. � 27 � ����� �������, 
    � {$person->fname} {$person->mname} {$person->sname} �������{if $person->sex==1}��{else}��{/if} � ���������� ��������,  � ������ �������, ��������� ��������� ������� � �������������:</p>
	
    <ol class="ol_n">
        <li value="1"><p>����������� ���������:
			<ul class="ol_n" type="none">
				<li>
					<p>1.1 � ������������ � ��������������� ��������� � ������ �������, 
					���������� � ������������ ����� ��������� (�.1.1  �������� � ???/� �� __________) ������ 
                    {assign var=doctor_name value=$coupon->attending_doctor_id}
                    {$doctors.$doctor_name} 
					����������� ������������ �������, �������������� ���� �____________________________
					<br />
						{if $coupon->services}
							{foreach from=$coupon->services item=item key=key}
								<b>{$item.service_name} ({$item.service_price} ���.) - ���� {$item.service_name_doc}</b>,<br />  
							{/foreach} 
						{/if}
					<br /></p>
				</li>
				<li>
					<p>1.2 �������� �������, �������������� ����� {$coupon->attending_doctor}, 
					������� ������ ���������� ������������ � �������� �������������� ������ ������� � ������������ � 
					������������ �����������, � �����������, � ������ �������������, �������������� �������. 
					� ������ ��������������� ���������� �������� ����� � ����, ����������� ��� �������, 
					����������� ������ ��������� ������� ����� ��� ���������� �������.</p>
				</li>
				<li>
					<p>1.3 ������������ ��������� �������� �� ����������������� ������ ������ �� 1,5 ���� � ������� � ��������.</p>
				</li>
				<li>
					<p>1.4 "�����������" �������������  ��� ��������� ������ �� �������������� ����������
					� �������� ����������� �������, ������ "�����������" �� ����� ���������������:
					<ul  type="disc"  class="ol_n">
						<li value="1.3.1">
							<p class="p_pod">�� ����������� ����������, ���� ������ ������� � �����������  ���������� 
							� � �������������� ������� ����������. � �����, � ���, ��� �������� ������� 
							� ���������� �������� ���������� ��������������� ������������ ���������, 
							�  ������������ ���������� �������� ����������������� ������ �� ��������� 
							��������� �� �����������.</p>
						</li>
						<li value="1.3.2">
							<p class="p_pod">�� ��������������� �����������, ���������� � ����������� �������� �������. 
							��� ��������������� ������� (�������������� �������� ������� �����), ������� 
							����������� ��� ����������� ������ �������, ����� �������-��������������� � 
							��������������� ������ �� ���������� � �������������  ���������������� ��������������.</p>
						</li>
						<li value="1.3.3">
							<p class="p_pod">�� ��������� ��������������� �������. ��� ���������� ����� � ��������������� �������,
							������� ��������� � ���������������� �������������, ������������ ����������� ������, 
							������� ���� �������� ����� (�������� ������������� ��������� ������, ����������� � 
							�������� ������).</p>
						</li>
						<li value="1.3.4">
							<p class="p_pod">�� ��������� ����� � ������������� ������� ��� ���������� �������������� ������� 
							� ������� ������������� �������� �� ���� ������� ��������������� ��������, �������, 
							��� �������, ��������� � ���������� �������������, ���������� � ����� ���������� 
							���������, ��������  ������������� �����������, ���������� �������� ������� ��������, 
							� ��� �� ������ �������� ������� ��� � �� ����������� ������������ � ����� ������������
							������.</p>
						</li>
						<li value="1.3.5">
							<p class="p_pod">�� ���������� ����� � ������������� ������� ��� ���������� ��������������� �������. 
							��������  ��������������� ������ �� �������������� �����������, ��� ������������� 
							������� �������� � ������� ����� ������������ ����������, ������� ����������� � 
							�������� (�������) ����� � ������� ����� �������, ������������ ������� ������ �����, 
							��� ��� ������� ��������, ��� � ��� ��� (������, � ��������� ������� ������� �������).</p>
						</li>
					</ul>
				</p></li>
			</ul>
        </p></li>
        <li value="2"><p>�������� ���������:
			<ul  type="disc" class="ol_n">
				<li value="2.1">
					<p class="p_pod">��������� ��� �������� �������� ����� � ������������ ���������.</p>
				</li>
				<li value="2.2">
					<p class="p_pod">�������� �� ������� � �������������  �����, ������������� � ������.</p>
				</li>
				<li value="2.3">
					<p class="p_pod">��������� ������� �������  ��� � �������� �� ����������� ����������� ��������.</p>
				</li>
				<li label="2.4">
					<p class="p_pod">����������� ��������������� ������ ����������� ����� �� ��������� ������������, 
					� �������� �������� ������������ ����� ����������� ���������� ��������.</p>
					<p class="p_pod">� ������������� ����������________________________________________________________</p>
				</li>
			</ul>
		</p></li>
		<li value="3">
			<p>�������� ����������� � ���, ��� ����������� ���� ������� (�������������, ����������������, ��������������, 
			���������������, ������������������� � ��.) ����� �������������� ���������������� ������������� �����������.</p>
		</li>
		<li value="4">
			<p>����������� ����� ���������������  � ������ ������������ ���  ��������������� ���������� �����  ������������, 
			��� ������� �����  ����.</p>
		</li>
		<li value="5">
			<p>� ������ ������������� �����������  ����� ������������ � ����������  �� ������� �������� ��������� �����, 
			���� ����� ��������� ��������������� ������� ������ (������������ �������� �����) �����������. 
			� ������ �� ���������� �����������, ����� ��������������� �������-����������� ����������, � (���) ���������� 
			��������������� ����������� ����������������� ���������� ������ � ������������� �������.</p>
		</li>
		<li value="6">
			<p>������ �������:____________________________________________________________________________ </p>
		</li>
    </ol>
</div>

<div class="footer">
    <div class="l">
     �����������: <br />
     <b>��� �����������</b>   <br /> 
     �. �����, ��. �����������, �. 50  <br />                                     
     ��������� �1 <br />                                                               
     ��� 5247002828 ��� 524701001 <br /> .
        <div class="dov">������������</div>                                                                                       
    </div>
    
    <div class="r">
        ��������:<br />
        <b>{$person->fname} {$person->mname} {$person->sname}</b><br /> 
        �������: ����� {$person->passport->series} � {$person->passport->number}<br />
        �����: {$person->passport->address->full_address()}
    </div>
</div>


</body>
</html>
