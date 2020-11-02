<?php 

class Validator {

	private $err_fields = [];

	public function is_empty($fields) {
		foreach ($fields as $key => $value) {
			if(trim($value) == '') 
				array_push($this->err_fields, [$key => ucwords($key) . ' is required.']);
		}

		return count($this->err_fields) > 0 ? true : false;
	}

	public function add_error($field, $err_msg) {
		array_push($this->err_fields, [$field => $err_msg]);
		return false;
	}

	public function error($field) {
		return in_array($field, $this->err_fields);
	}

	public function has_error() {
		return count($this->err_fields) > 0;
	}

	public function get_errors() {
		return $this->err_fields;
	}

	public function isAllowedFile($ext, $field) {
		$allowed = ["jpg", "jpeg", "png"];
		if(!in_array($ext, $allowed)) {
			array_push($this->err_fields, [$field => 'Image format is not allowed.']);
			return false;
		}
		return true;
	}

}