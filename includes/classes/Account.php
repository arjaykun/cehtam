<?php 

include_once 'Database.php';
require_once 'Helper.php';


class Account {
	private $db;
	private $helper;

	public function __construct() {
		$this->db = new Database();
		$this->helper = new Helper();
	}

	public function get($field = "") {
		$sql = "SELECT * FROM users ";

		if($field!= '')
			$sql.= "WHERE username = :field or email = :field and ";
		else 
			$sql.= "WHERE ";

		$sql.= "status=1";

		return $this->db->query($sql, Database::FETCH_ALL, [':field' => $field]);
	}

	public function insert($fields) {
		$sql = "INSERT INTO users (username, name, email, password) VALUES(:username, :name, :email, :password)";
		$values = $this->helper->get_fields_values($fields);
		return $this->db->query($sql, Database::EXECUTE, $values);
	}

	public function update($fields, $old_username) {
		$sql = "UPDATE users SET username=:username, name=:name, email=:email WHERE username =:old_username";

		$values =  $this->helper->get_fields_values($fields);
		$values['old_username'] = $old_username;
		
		return $this->db->query($sql, Database::EXECUTE, $values);
	}

	public function change_password($new_password, $username) {
		$sql = "UPDATE users SET password=:password WHERE username=:username";
		return $this->db->query($sql, Database::EXECUTE, [":password" => $new_password, ":username" => $username]);
	}

	public function delete($field) {
		$sql = "DELETE FROM users WHERE username = :username and is_admin != 1";
		return $this->db->query($sql, Database::EXECUTE, [':username' => $field]);
	}

	public function is_email_exist($email) {
		$sql = "SELECT * FROM users WHERE email=:email";
		$result = $this->db->query($sql, Database::FETCH_ALL, [':email' => $email]);
		return count($result) > 0 ? true : false;
	}

	public function is_username_exist($username) {
		$sql = "SELECT * FROM users WHERE username=:username";
		$result = $this->db->query($sql, Database::FETCH_ALL, [':username' => $username]);
		return count($result) > 0 ? true : false;
	}


}