<?php

include_once '../loadclasses.php';

$v = new Validator;

header('Content-Type: application/json');

try {

	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$old_email = htmlspecialchars($_POST['old_email']);
	$username = htmlspecialchars($_POST['username']);
	$old_username = htmlspecialchars($_POST['old_username']);

	$values = ['name' => $name, 'email' => $email, 'username' => $username];

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
		$v->add_error('username', 'Invalid username, must be at least 5 characters long.');
		respond_error();		
		return;
	}

	$account = new Account;

	if($account->is_username_exist($username) && $username != $old_username ) {
		$v->add_error('username', 'Username already exists.');
		respond_error();		
		return;
	}

	if($account->is_email_exist($email) && $email != $old_email) {
		$v->add_error('email', 'E-mail already exists.');
		respond_error();		
		return;
	}

	$account->update($values, $old_username);
	
	echo json_encode(['msg' => 'Ok']);		

} catch(Exception $e) {

	http_response_code(500);
	echo json_encode(['msg' => 'Something went wrong!', 'error' => $e->getMessage()]);

}