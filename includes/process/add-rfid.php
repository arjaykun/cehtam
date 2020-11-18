<?php

$error = false;
$msg = $rfid = null;

if (isset($_POST['rfid'])) {
	$rfid = htmlspecialchars($_POST['rfid']);
	$id = htmlspecialchars($_POST['id']);

	if (empty($rfid)) {
		$error = true;
		return $msg = "Warning! Invalid RFID.";
	}

	if($employee->add_rfid($rfid, $id)) {
		$error = false;
		return $msg = "Success! Added RFID to employee.";
	} else {
		$error = true;
		return $msg = "Oops! Failed to add RFID. Please try again.";
	}
}

