<?php 

require_once 'Database.php';

class Employee {
	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function get($filter = null) {
		$sql = "SELECT * FROM employees ";
		$values = [];
		if($filter != null){
			$sql.= "WHERE ";
			foreach ($filter as $key => $value) {
				$sql.= $key." = :".$key." and ";
				$values[":".$key] = $value;
			}
			// $sql.= "WHERE emp_id = :emp_id and ";
		}
		else 
			$sql.= "WHERE ";
		$sql .= "status=1";

		return $this->db->query($sql, Database::FETCH_ALL, $values);
	}

	public function insert() {

	}

	public function update() {

	}

	public function delete() {

	}

}