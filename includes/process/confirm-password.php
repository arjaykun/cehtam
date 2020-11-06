<?php 

session_start();

$hashedPassword = $_SESSION['auth']->password;

if($_POST['password']) {

	$password =  htmlspecialchars($_POST['password']);

	if(password_verify($password, $hashedPassword)){
		echo 1;
		return;
	}

	echo 0;
	
}
