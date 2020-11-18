<?php 

$msg = $name = $email = $contacts = $department = $emp_id = $emp_status = $job_title = "";
$error = 0;
$v = new Validator;

if (isset($_POST['submit'])) {
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$contacts = htmlspecialchars($_POST['contacts']);
	$emp_id = htmlspecialchars($_POST['emp_id']);
	$emp_status = htmlspecialchars($_POST['emp_status']);
	$department= htmlspecialchars($_POST['department']);
	$job_title = htmlspecialchars($_POST['job_title']);
	$emp_image = $_FILES['emp_image'];
	$file_name = "default.png";


	$fields = [
		"name" => [$name],
		"email" => [$email],
		"contact_num" => [$contacts, 'Contact #'],
		"emp_id" => [$emp_id, "Employee ID"],
		"job_title" => [$job_title, "Position"],
		"emp_status" => [$emp_status, "Employment Status"],
		"department" => [$department],
	];

	if ($v->is_empty($fields))
		return;

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {	
		$v->add_error('email', 'Invalid e-mail.');
		return;
	}

	if (!preg_match('/^(\+63)?[0-9]{6,11}$/', $contacts)) {	
		$v->add_error('contact_num', 'Invalid Contact Number.');
		return;
	}

	$employee = new Employee;

	if ($employee->is_id_exist($emp_id)) {	
		$v->add_error('emp_id', 'Employee ID already exist.');
		return;
	}

	//image
	
	if (file_exists($emp_image['tmp_name'])) {
		// Get file extension
	  $imageExt = strtolower(pathinfo($emp_image['name'], PATHINFO_EXTENSION));
		// Set image placement folder
	  $file_name = implode('-', explode(' ', strtolower($name))).'-'.time().'.'.$imageExt;
	  $destination = '../assets/images/employees/'.$file_name;

		if(!$v->isAllowedFile($imageExt, 'emp_image'))
			return;
	} 
	
	try {
		$employee->insert([
			'name' => $name,
			'email' => $email,
			'contact_num' => $contacts,
			'dept_id' => $department,
			'emp_status' => $emp_status,
			'emp_id' => $emp_id,
			'job_title' => $job_title,
			'emp_image' => $file_name
		]);

		if(isset($destination)) { 
			move_uploaded_file($emp_image['tmp_name'], $destination);
		}
		$msg = "<strong>Success! </strong> Employee created.";
		$name = $email = $contacts = $department = $emp_id = $emp_status = $job_title = "";
		$error = 0;
	} catch(Exception $e) {
		echo $e->getMessage();
		exit();
		$msg = "<strong>Oops! </strong> Something went wrong";
		$error = 1;
	} 
}