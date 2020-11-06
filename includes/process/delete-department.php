<?php 

include_once '../loadclasses.php';

if(isset($_POST['id'])) {

	$id = htmlspecialchars($_POST['id']);
	header('Content-Type: application/json');

	try {
		$department = new Department;

		$result = $department->delete($id);

		if($result)
			echo json_encode(['msg' => $result]);
		else{
			http_response_code(400);
			echo json_encode(['msg' => 'Failed to delete department.']);
		}
	} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['msg' => 'Something went wrong!']);
	}
	
} else {
	http_response_code(500);
	echo json_encode(['msg' => 'Something went wrong!']);
}
