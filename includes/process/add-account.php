<?php

include_once '../loadclasses.php';

$v = new Validator;

header('Content-Type: application/json');

try {

	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	$values = [ 'name' => [$name], 'email' => [$email, "e-mail"], 'username' => [$username], 'password' => [$password] ];

	function respond_error() {
		global $v;
		http_response_code(400);
		echo json_encode($v->get_errors());
	}

	if($v->is_empty($values)) {
		respond_error();
		return;
	}

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {	
		$v->add_error('email', 'Invalid e-mail.');
		respond_error();
		return;
	}

	if (strlen($username) < 5 || strlen($username) > 20) {	
		$v->add_error('username', 'Invalid username, must be at least 6 characters long.');
		respond_error();		
		return;
	}


	if (strlen($password) < 6 || strlen($password) > 20) {	
		$v->add_error('password', 'Invalid password, must be at least 6 characters long.');
		respond_error();		
		return;
	}


	$account = new Account;

	if($account->is_username_exist($username)) {
		$v->add_error('username', 'Username already exists.');
		respond_error();		
		return;
	}

	if($account->is_email_exist($email)) {
		$v->add_error('email', 'E-mail already exists.');
		respond_error();		
		return;
	}

	$hashedPassword = password_hash($values['password'][0], PASSWORD_DEFAULT);


	$account->insert(['name'=>$name, 'email'=>$email, 'username'=>$username, 'password' => $hashedPassword]);

	echo json_encode(['msg' => 'Ok']);		

} catch(Exception $e) {

	http_response_code(500);
	echo json_encode(['msg' => 'Something went wrong!', 'error' => $e->getMessage()]);

}