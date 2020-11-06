<?php 

$msg = $dept_id = $dept_name = "";
$error = 0;
$v = new Validator;

if (isset($_POST['submit'])) {
	$dept_id = htmlspecialchars($_POST['dept_id']);
	$dept_name = htmlspecialchars($_POST['dept_name']);

	$fields = [
		"dept_id" => [$dept_id, "Department I.D."],
		"dept_name" => [$dept_name, "Department Name"],
	];

	if ($v->is_empty($fields))
		return;

	if(!$v->is_proper_name($dept_name)) {
		$v->add_error('dept_name', 'Invalid characters in department name.');
		return;
	}

	if(!$v->is_alphanum($dept_id)) {
		$v->add_error('dept_id', 'Invalid characters in department id.');
		return;
	}

	$department = new Department;

	if ($department->is_id_exist($dept_id)) {	
		$v->add_error('dept_id', 'Department I.D. already exist.');
		return;
	}
	

	try {
		$department->insert($dept_id, $dept_name);

		$msg = "<strong>Success! </strong> Department created.";
		$dept_id = $dept_name = "";
		$error = 0;

	} catch(Exception $e) {
		$msg = "<strong>Oops! </strong> Something went wrong";
		$error = 1;
	} 
}