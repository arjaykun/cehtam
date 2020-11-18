<?php 

require_once 'Database.php';

class TimeLog {

	private $db;

	public function __construct() {
		$this->db = new Database;
	}

	public function count() {
		$sql = "SELECT COUNT(id) as count from logs";
		return $this->db->query($sql, Database::FETCH_SINGLE);
	}

	public function get($start = null, $end = null) {
		$sql = "SELECT name, e.id, time_in, time_out, time_work  FROM logs as l inner join employees as e on l.emp_id = e.emp_id ";
		if($start) {
			$sql .= "WHERE time_in >= :start and time_in <= DATE_ADD(:end, INTERVAL 1 DAY) ";
		}
		$sql .= "ORDER BY time_in DESC";

		return $this->db->query($sql, Database::FETCH_ALL, [':start' => $start, ':end' => $end]);
	}

	public function get_by_emp($emp_id) {
		$sql = "SELECT time_in, time_out, time_work FROM logs WHERE emp_id=:emp_id ORDER BY time_in DESC ";
		return $this->db->query($sql, Database::FETCH_ALL, [":emp_id" => $emp_id]);
	}

	public function get_total_work_time($emp_id) {
		$sql = "SELECT sum(time_work) as total FROM logs WHERE emp_id=:emp_id";
		$res = $this->db->query($sql, Database::FETCH_SINGLE, [":emp_id" => $emp_id]);
		if ($res) {
			return round(($res->total /60), 2);
		}
		return 0;
	}

	public function get_recent() {
		$sql = "SELECT name, emp_image, employees.emp_id from logs INNER JOIN employees on logs.emp_id = employees.emp_id ORDER BY logs.recent_time DESC LIMIT 12";
		return $this->db->query($sql, Database::FETCH_ALL);
	}

	public function time_in($emp_id) {
		$sql = "INSERT into logs SET emp_id = :emp_id";
		return $this->db->query($sql, Database::EXECUTE, [":emp_id" => $emp_id]);
	}

	public function get_employee($rfid) {
		$sql = "SELECT emp_id from employees WHERE rfid_tag = :rfid";
		return $this->db->query($sql, Database::FETCH_SINGLE, [":rfid" => $rfid]);
	}


	public function get_log($emp_id) {
		$sql = "SELECT * FROM logs WHERE emp_id = :emp_id and time_in >= CURDATE()";
		return $this->db->query($sql, Database::FETCH_SINGLE, [":emp_id" => $emp_id]);
	}

	public function time_out($emp_id) {
		$sql = "UPDATE logs SET time_out = NOW(), recent_time = NOW() WHERE emp_id = :emp_id and time_in >= CURDATE()";
		return $this->db->query($sql, Database::EXECUTE, [":emp_id" => $emp_id]);
	}

	public function could_time_out($emp_id) {
		$sql = "SELECT TIMESTAMPDIFF(MINUTE, time_in, NOW()) as diff  FROM `logs` WHERE emp_id=:emp_id and time_in >= CURDATE()";
		$result = $this->db->query($sql, Database::FETCH_SINGLE, [":emp_id" => $emp_id]);
		return $result->diff >= 5 ? true : false;
	}

	public function get_hours_work($time_work, $time_in, $time_out) {
		$start = intval(Date("H", strtotime($time_in)));
		$end = intval(Date("H", strtotime($time_out)));
		$time = floatval($time_work/60);

		if($start < 12 && $end >= 13) {
			return round($time - 1);
		}

		return round($time);
		
	}
	
}