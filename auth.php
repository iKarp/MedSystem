<?php

require_once ("config.php");

// login to session
if ($_POST['login'] && $_POST['password']) {
    
    
    $login = $_POST['login']; 
    $password = $_POST['password'];
    
    if ($VSECore->session->authuser($login,$password)) {
        
        $VSECore->events->addevent("core",VSE_MSG_NOTIFY,"Вход в систему. Пользователь $login");
        $VSECore->session->register_session($login);
        $VSECore->redirect("index.php");
        
    } else {
        
        $VSECore->events->addevent("core",VSE_MSG_ERR,"Неправильные логин или пароль. ($login , $password)");
        $VSECore->output->assign("warn",true);
               
    }
}

// logout from session
if ($_GET['logout'] == 1) {
    $VSECore->session->unregister_session();
}



if ($VSECore->session->is_registered()) {
    $VSECore->output->assign("already_registered",true);
}


$VSECore->output->fetch("core_auth.tpl");

echo $VSECore->output->body();






?>
