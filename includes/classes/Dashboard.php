<?php 

require_once 'Database.php';

class Dashboard {


	public function __construct() {
		$this->db = new Database;
	}

	public function count_employees() {
		$sql = "SELECT count(id) as count_emp from employees WHERE status = 1";
		$res = $this->db->query($sql, Database::FETCH_SINGLE);

		return $res->count_emp;
	}

	public function count_department() {
		$sql = "SELECT count(dept_id) as count_dept from departments";
		$res = $this->db->query($sql, Database::FETCH_SINGLE);

		return $res->count_dept;
	}

	public function count_log() {
		$sql = "SELECT count(id) as count_log from logs";
		$res = $this->db->query($sql, Database::FETCH_SINGLE);

		return $res->count_log;
	}

}