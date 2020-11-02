<?php 

include_once '../loadclasses.php';

if(isset($_POST['id'])) {
	$id = htmlspecialchars($_POST['id']);
	header('Content-Type: application/json');

	try {
		$account = new Account;

		$result = $account->delete($id);
		if($result)
			echo json_encode(['msg' => $result]);
		else{
			http_response_code(400);
			echo json_encode(['msg' => 'Failed to delete account.']);
		}
	} catch (Exception $e) {
			http_response_code(500);
			echo json_encode(['msg' => 'Something went wrong!']);
	}
	
} else {
	http_response_code(500);
	echo json_encode(['msg' => 'Something went wrong!']);
}
