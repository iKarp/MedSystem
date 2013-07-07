{if $tabs_count > 0}
	<table class="tabs">
		<tr>
		{foreach from=$tabs item=tab}
			<td id="tab-{$tab.action}">{$tab.label}</td>
		{/foreach}
		</tr>
	</table>
	<fieldset id="conteiner" style="border-radius: 0px 6px 6px 6px;">
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Выберите вкладку</p>
	</fieldset>
{else}
	<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>Выберите модуль</p>
{/if}
