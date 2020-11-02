<?php 

require_once 'Database.php';

class Auth {

	const USER = '0';
	const ADMIN = '1';

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function login($user, $password) {
		$sql = "SELECT * FROM users WHERE username=:user or email=:user";
		$result = $this->db->query($sql, Database::FETCH_SINGLE, [':user' => $user]); //result will be either false or the obj;

		if($result == false)
			return false;
		elseif(!password_verify($password, $result->password))
			return false;
		else
			return $result;
	}

	public function user() {
		return $_SESSION['auth'];
	}

}