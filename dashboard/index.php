<?php

$uri = $_SERVER['REQUEST_URI'];

switch ($uri) {
	// dashboar route
	case '/dashboard/':
		include_once './views/dashboard/index.php';
		break;
	case preg_match('/^\/dashboard\/accounts\/?/', $uri)?true:false:
		include_once './views/accounts/index.php';
		break;
	case preg_match('/^\/dashboard\/profile\/?/', $uri)?true:false:
		include_once './views/profile/index.php';
		break;
	// employee routes
	case preg_match('/^\/dashboard\/employees\/[0-9]+\/edit\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		$token = explode("/", $uri);
		$id = $token[count($token) - 2];	
		include_once './views/employees/edit.php';
		break;
	case preg_match('/^\/dashboard\/employees\/[0-9]+\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		$token = explode("/", $uri);
		if($uri[strlen($uri) -1] == "/") {
			$id = $token[count($token) - 2];
		} else {
			$id = $token[count($token) - 1];
		}
		include_once './views/employees/select.php';
		break;
	case preg_match('/^\/dashboard\/employees\/create\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		include_once './views/employees/create.php';
		break;
	case preg_match('/^\/dashboard\/employees\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		include_once './views/employees/index.php';
		break;
	// department routes
	case preg_match('/^\/dashboard\/departments\/[A-Za-z0-9-_]+\/edit\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		$token = explode("/", $uri);
		$id = $token[count($token) - 2];	
		include_once './views/departments/edit.php';
		break;
	case preg_match('/^\/dashboard\/departments\/create\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		include_once './views/departments/create.php';
		break;
	case preg_match('/^\/dashboard\/departments\/[A-Za-z0-9-_]+\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		$token = explode("/", $uri);
		$id = $token[count($token) - 1];
		include_once './views/departments/select.php';
		break;
	case preg_match('/^\/dashboard\/departments\/?\??(update=|delete=|pwd=)?[01]?$/', $uri)?true:false:
		include_once './views/departments/index.php';
		break;
	// logs routes
	case preg_match('/^\/dashboard\/logs\/[0-9]+\/?\??(from=\d\d\d\d-\d\d-\d\d&to=\d\d\d\d-\d\d-\d\d)?$/', $uri)?true:false:
		$token = explode("/", $uri);
		if($uri[strlen($uri) -1] == "/") {
			$id = $token[count($token) - 2];
		} else {
			$id = $token[count($token) - 1];
		}
		include_once './views/logs/employee.php';
		break;
	case preg_match('/^\/dashboard\/logs\/?\??(from=\d\d\d\d-\d\d-\d\d&to=\d\d\d\d-\d\d-\d\d)?$/', $uri)?true:false:
		include_once './views/logs/index.php';
		break;
	default:
		// header('Location: /404.html');
		break;
}