<?php 

require_once 'Database.php';
require_once 'Helper.php';

class Employee {
	private $db;
	private $helper;

	public function __construct() {
		$this->db = new Database;
		$this->helper = new Helper();
	}

	public function find($id) {
		$sql = "SELECT * FROM employees where id=:id";
		return $this->db->query($sql, Database::FETCH_SINGLE, [':id' => $id]); 
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

	public function insert($fields) {
		$sql = "INSERT INTO employees (name, email, contact_num, emp_id, dept_id, job_title, emp_status, emp_image) VALUES (:name, :email, :contact_num, :emp_id, :dept_id, :job_title, :emp_status, :emp_image)";
		$values = $this->helper->get_fields_values($fields);
		return $this->db->query($sql, Database::EXECUTE, $values);
	}

	public function update($fields, $id) {
		$sql = "UPDATE employees SET name=:name, email=:email, contact_num=:contact_num, emp_id=:emp_id, dept_id=:dept_id, job_title=:job_title, emp_status=:emp_status WHERE id=:id";
		$values = $this->helper->get_fields_values($fields);
		$values[':id'] = $id;
 		return $this->db->query($sql, Database::EXECUTE, $values);
	}

	public function update_image($emp_image, $id) {
		$sql = "UPDATE employees SET emp_image=:emp_image WHERE id=:id";
		return $this->db->query($sql, Database::EXECUTE, [':emp_image' => $emp_image, ':id' => $id]);
	}

	public function add_rfid($rfid, $id) {
		$sql = "UPDATE employees SET rfid_tag=:rfid WHERE id=:id";
		return $this->db->query($sql, Database::EXECUTE, [':rfid' => $rfid, ':id' => $id]);
	}

	public function delete($id) {
		$sql = "DELETE FROM employees WHERE id=:id";
		return $this->db->query($sql, Database::EXECUTE, [':id' => $id]);
	}

	public function is_id_exist($emp_id) {
		$sql = "SELECT * FROM employees WHERE emp_id=:emp_id";
		$result = $this->db->query($sql, Database::FETCH_ALL, [':emp_id' => $emp_id]);
		return count($result) > 0 ? true : false;
	}

}