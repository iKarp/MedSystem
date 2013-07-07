<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=windows-1251">
<link href="static/css/auth.style.css" type="text/css" rel="stylesheet">
<link href="/static/css/cupertino/jquery-ui-1.8.1.custom.css" type="text/css" rel="stylesheet">

<title>Вход в систему</title>
</head>
<body marginwidth="0" marginheight="0" onLoad="document.getElementById('login').focus()">
<div class="head"></div>
<div class="content">
	<div id="main">
{if $already_registered}
<div class='alrearyin'>
 <h3 style='width: 100%; text-align: center;'>Вы уже вошли</h3> <br/>
 <a href="auth.php?logout=1">Выйти из системы</a>
</div>
{else}

			<!-- <div class="title"> -->
			<div class="ui-accordion-header ui-helper-reset ui-state-active ui-corner-top add_title title">
			&nbsp;&nbsp;Вход в систему
			</div>
			<form class="ui-widget-content ui-corner-bottom add_content" method="post" action="auth.php">
			<div class="auth-left">
			<label for="login">Логин:</label>
			</div>
			<div class="auth-center">
			<input type="text" name="login" id="login"/>
			</div>
			<div class="auth-left">
			<label for="password">Пароль:</label>
			</div>
			<div class="auth-center">
			<input type="password" name="password" id="password"/>
			</div>
			<div style="text-align:right; padding-right: 10px;">
			<input type="submit" class=" auth-botton ui-button ui-widget ui-state-default ui-corner-all" value="Войти"/>
			<br>&nbsp;
			</div>
			</form>
			{if $warn}
			<div class="auth-error">
			Неверный логин или пароль
			</div>
			{else}
			</div>
			<div class="copyright">Арсенал IT &copy; 2010-2012</div>
			</div>
			{/if}
{/if}

<div class="footer"></div>
</body>
</html>

