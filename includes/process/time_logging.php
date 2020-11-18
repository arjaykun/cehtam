<?php 

include_once '../loadclasses.php';

$log = new TimeLog;

if(isset($_POST['rfid'])) {
	$rfid = $_POST['rfid'];


	try {
		$employee = $log->get_employee($rfid);

		if($employee) {
			$prev_log = $log->get_log($employee->emp_id);

			// if there is no log today;
			if (!$prev_log) {
				$log->time_in($employee->emp_id);
				echo json_encode(['msg' => "time_in"]);
			} else {
				
				$log->time_out($employee->emp_id);
				echo json_encode(['msg' => "time_out"]);
				
			}
			

		} else {
			http_response_code(500);
			echo json_encode(['msg' => "Invalid RFID!"]);
		}
	} catch (Exception $e) {
		http_response_code(500);
		echo json_encode(['msg' => "Something went wrong."]);
	}
}