<?php 

session_start();
include_once '../loadclasses.php';
header('Content-Type: application/json');


if (isset($_POST['old_pwd']) && isset($_POST['new_pwd']) && isset($_POST['confirm_pwd'])) {
	
	$old = htmlspecialchars($_POST['old_pwd']);
	$new = htmlspecialchars($_POST['new_pwd']);
	$confirm = htmlspecialchars($_POST['confirm_pwd']);

	$hashedPassword = $_SESSION['auth']->password;
	$username = $_SESSION['auth']->username;

	if (empty($old) || empty($new) || empty($confirm)) {
		http_response_code(400);
		echo json_encode(['msg' => 'All fields are required.']);
		return;
	}

	if ($new != $confirm) {
		http_response_code(400);
		echo json_encode(['msg' => 'Password does not match.']);
		return;
	}

	if (!password_verify($old, $hashedPassword)) {
		http_response_code(400);
		echo json_encode(['msg' => 'Wrong password.']);
		return;
	}

	try {
		$account = new Account;
		$new_pwd = password_hash($new, PASSWORD_DEFAULT);
		$account->change_password($new_pwd, $username);
		echo json_encode(['msg' => 'Ok']);
		return;
	} catch (Exception $e) {
		http_response_code(500);
		echo json_encode(['msg' => 'Something went wrong.']);
		return;
	}



}
