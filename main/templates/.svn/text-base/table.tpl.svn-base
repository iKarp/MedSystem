<table id="{$table}" class="view-1" cellspacing="0" cellpadding="3">
	<tr>
		{foreach from=$columns item=column}
		<th width="{$column.width}">{$column.caption}</th>
		{/foreach}
	</tr>
	<tr class="newrow" onmouseover="style.backgroundColor='#BECFFF'" onmouseout="style.backgroundColor=''">
		<td colspan="{$columns_count}"><span class="ui-icon ui-icon-plusthick" unselectable="on">Добавить</span></td>
	</tr>
	{if $rows}
	{foreach from=$rows item=row}
	<tr data_id="{$row.id}" class="datarow" onmouseover="style.backgroundColor='#BECFFF'" onmouseout="style.backgroundColor=''">
		{$row.html}
	</tr>
	{/foreach}
	{else}
	<tr><td colspan="{$columns_count}">
		<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		Данные не найдены
	</td></tr>
	{/if}
	<tr class="newrow" onmouseover="style.backgroundColor='#BECFFF'" onmouseout="style.backgroundColor=''">
		<td colspan="{$columns_count}"><span class="ui-icon ui-icon-plusthick" unselectable="on">Добавить</span></td>
	</tr>
</table>
