<?php
include_once '../loadclasses.php';

$employee = new Employee;
$v = new Validator;
if(isset($_FILES['emp_image'])){
	$id = htmlspecialchars($_POST['id']);
	$name = htmlspecialchars($_POST['name']);
	$old_image = htmlspecialchars($_POST['old_image']);
	$emp_image = $_FILES['emp_image'];


	if (file_exists($emp_image['tmp_name'])) {
		// Get file extension
	  $imageExt = strtolower(pathinfo($emp_image['name'], PATHINFO_EXTENSION));
		// Set image placement folder
	  $file_name = implode('-', explode(' ', strtolower($name))).'-'.time().'.'.$imageExt;
	  $destination = '../../assets/images/employees/'.$file_name;

		if(!$v->isAllowedFile($imageExt, 'emp_image')){
			http_response_code(400);
			return;
		}
		try {
			if($employee->update_image($file_name, $id)) {
				$result = move_uploaded_file($emp_image['tmp_name'], $destination);
				if($result == 1)
					unlink("../../assets/images/employees/".$old_image);
				echo json_encode(['msg' => 'ok']);
				return;
			}

		} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['msg' => 'Something went wrong!']);
			return;
		}
	
	} 

} 

http_response_code(500);
echo json_encode(['msg' => 'Something went wrong!']);

