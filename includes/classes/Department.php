<?php 

require_once 'Database.php';

class Department {
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function get() {
		$sql = "SELECT * FROM departments";
		return $this->db->query($sql, Database::FETCH_ALL);
	}

	public function find($id) {
		$sql = "SELECT * FROM departments WHERE dept_id=:id";
		return $this->db->query($sql, Database::FETCH_SINGLE, [":id" => $id]);
	}

	public function insert($dept_id, $dept_name) {
		$sql = "INSERT INTO departments (dept_id, dept_name) VALUES(:dept_id, :dept_name)";
		return $this->db->query($sql, Database::EXECUTE, [':dept_id' => $dept_id, ':dept_name' => $dept_name]);
	}

	public function update($dept_name, $dept_id) {
		$sql = "UPDATE departments SET dept_id=:dept_id, dept_name=:dept_name where dept_id=:dept_id";
		return $this->db->query($sql, Database::EXECUTE, [':dept_id' => $dept_id, ':dept_name' => $dept_name]);
	}

	public function delete($dept_id) {
		$sql = "DELETE FROM departments where dept_id=:dept_id";
		return $this->db->query($sql, Database::EXECUTE, [':dept_id' => $dept_id]);
	}

	public function is_id_exist($dept_id) {
		$sql = "SELECT * FROM departments WHERE dept_id=:dept_id";
		$result = $this->db->query($sql, Database::FETCH_ALL, [':dept_id' => $dept_id]);
		return count($result) > 0 ? true : false;
	}

}