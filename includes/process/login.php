<?php 

include_once '../includes/loadclasses.php';

$v = new Validator;
$error = false;
$user = '';

if (isset($_POST['submit'])) {
	$user = htmlspecialchars($_POST['user']);
	$password = htmlspecialchars($_POST['password']);

	if($v->is_empty(['user' => $user, 'password' => $password]))
		return $error = true;

	$auth = new Auth;

	$result = $auth->login($user, $password);
	
	if(!$result)
		return $error = true;

	$_SESSION['auth'] = $result;

	header("Location: /dashboard");
	exit();
}