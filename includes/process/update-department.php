<?php 

$msg = $dept_id = $dept_name = "";

$v = new Validator;

if (isset($_POST['submit'])) {
	$dept_id = htmlspecialchars($_POST['dept_id']);
	$old_dept_id = htmlspecialchars($_POST['old_dept_id']);
	$dept_name = htmlspecialchars($_POST['dept_name']);

	$fields = [
		"dept_id" => [$dept_id, "Department I.D."],
		"dept_name" => [$dept_name, "Department Name"],
	];

	if ($v->is_empty($fields))
		return;

	if ($deptObject->is_id_exist($dept_id) && $old_dept_id != $dept_id) {	
		$v->add_error('dept_id', 'Department I.D. already exist.');
		return;
	}
		
	try {
		$deptObject->update($dept_name, $dept_id);
		header("Location: /dashboard/departments?update=1");
	} catch(Exception $e) {
		$msg = "<strong>Oops! </strong> Something went wrong";
		$error = 1;
	} 
}