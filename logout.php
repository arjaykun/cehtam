<?php 

session_start();
session_unset($_SESSION['auth']);
session_destroy();

if(isset($_GET['update']) && $_GET['update'] == 1 ) {
	header("Location: /login?u=1");	
	exit();
}

if(isset($_GET['change_pwd']) && $_GET['change_pwd'] == 1 ) {
	header("Location: /login?p=1");	
	exit();
}



header("Location: /login?s=1");
exit();