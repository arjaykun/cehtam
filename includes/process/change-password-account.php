<?php 

include_once '../loadclasses.php';
header('Content-Type: application/json');


if (isset($_POST['new_pwd']) && isset($_POST['confirm_pwd'])) {
	
	$new = htmlspecialchars($_POST['new_pwd']);
	$confirm = htmlspecialchars($_POST['confirm_pwd']);
	$username = htmlspecialchars($_POST['username']);

	if (empty($new) || empty($confirm)) {
		http_response_code(400);
		echo json_encode(['msg' => 'All fields are required.']);
		return;
	}

	if ($new != $confirm) {
		http_response_code(400);
		echo json_encode(['msg' => 'Password does not match.']);
		return;
	}

	try {
		$account = new Account;
		$new_pwd = password_hash($new, PASSWORD_DEFAULT);
		if($account->change_password($new_pwd, $username)) {
			echo json_encode(['msg' => 'Ok']);
			return;
		} 
		http_response_code(500);
		echo json_encode(['msg' => 'Something went wrong.']);

	} catch (Exception $e) {
		http_response_code(500);
		echo json_encode(['msg' => 'Something went wrong.']);
		return;
	}

} else {
	http_response_code(500);
	echo json_encode(['msg' => 'Something went wrong.']);
	return;
}
