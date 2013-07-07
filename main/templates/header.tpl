<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>

<head>
    <meta https-equiv="Content-Type" content="text/html; charset=Windows-1251" />
    <title>{$section.title}</title>
    
    <link type="text/css" href="/static/css/cupertino/jquery-ui-1.8.1.custom.css" rel="stylesheet" />
    <link type="text/css" href="/main/elements/tree/tree.css" rel="stylesheet" />
    <link type="text/css" href="/static/css/core.css" rel="stylesheet" />
    {if $section.css}{foreach from=$section.css item=css}
	<link type="text/css" href="{$css}" rel="stylesheet" />
	{/foreach} {/if}
    
	<script type="text/javascript" src="/static/javascript/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/static/javascript/jquery-ui-1.8.2.custom.min.js"></script>
	<script type="text/javascript" src="/static/javascript/jquery.cookie.js"></script>	
    <script type="text/javascript" src="/static/javascript/jquery.ui.datepicker-ru.js"></script>
	<script type="text/javascript" src="/static/javascript/jquery.street.js"></script>
	<script type="text/javascript" src="/static/javascript/jquery.org.js"></script>
	<script type="text/javascript" src="/main/elements/tree/tree.js"></script>
	<script type="text/javascript" src="/static/javascript/jquery.treeview.min.js"></script>
	<script type="text/javascript" src="/static/javascript/core.js"></script>
	{if $section.js}{foreach from=$section.js item=js}
	<script type="text/javascript" src="{$js}"></script>
	{/foreach}{/if}
    
</head>   

<body>
	{$debug}
	<div class="ui-accordion-header ui-state-active ui-corner-all d-main-header">
		<div class="d-main-header-title">Пользователь - {$user->showname()}</div>
		<div class="d-main-header-exit"><button onclick="window.location='/auth.php?logout=1'" >ВЫХОД</button></div>
	</div>

	<div class="left-menu ui-widget-content ui-corner-all">		
		{foreach from=$user_sections item=s}
			<button class="left-menu-button" onClick="location.href='?section={$s.section_name}'">{$s.section_label}</button>
		{/foreach}
	</div>

	<div id="content" class="content ui-widget-content ui-corner-all">
