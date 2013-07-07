<div style="width:100%; font-size: 20px;">
	<div>ИП Карпов А.Е.</div>
	<div align="center" style="font-size: 26px;"><b>ТОВАРНЫЙ ЧЕК</b></div>
	<div align="right" style="height: 40px;">Дата выдачи: {$date}</div>
	<table cellspacing="0" cellpadding="5" style="border:2px solid black; width:100%; text-align: center;">
		<tr>
			<th style="border:2px solid black;" width="50">№</th>
			<th style="border:2px solid black;">Наименование товара</th>
			<th style="border:2px solid black;" width="100">Кол-во</th>
			<th style="border:2px solid black;" width="100">Цена</th>
			<th style="border:2px solid black;" width="100">Сумма</th>
		</tr>
		{foreach from=$rows item=row}
		<tr style="border:inherit;">
			<td style="border:2px solid black;">{$row.num}</td>
			<td style="border:2px solid black; text-align: left;">{$row.name}</td>
			<td style="border:2px solid black;">{$row.count}</td>
			<td style="border:2px solid black;">{$row.price}</td>
			<td style="border:2px solid black;">{$row.sum}</td>
		</tr>
		{/foreach}
	</table>
	<br />
	<div>Итого к оплате: {$total_sum}</div>
	<br />
	<div style="width:100%"><span>Товар отпустил</span><span style="float: right;">{$user}</span></div>
</div>