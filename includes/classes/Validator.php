<?php 

class Validator {

	private $err_fields = [];

	public function is_empty($fields) {
		foreach ($fields as $key => $value) {
			if(trim($value[0]) == '') 
				$this->err_fields[$key] = ucwords( (count($value) > 1) ? $value[1] : $key) . ' is required.';
		}

		return count($this->err_fields) > 0 ? true : false;
	}

	public function add_error($field, $err_msg) {
		$this->err_fields[$field] = $err_msg;
	}

	public function is_proper_name($text) {
		return preg_match('/^[A-Za-z\.\'\- ]+$/', $text);
	}

	public function is_alphanum($text) {
		return preg_match('/^[A-Za-z0-9]+$/', $text);
	}

	public function error($field) {
		return isset($this->err_fields[$field]) ? $this->err_fields[$field] : false;
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
			$this->err_fields[$field] = 'Image format is not allowed.';
			return false;
		}
		return true;
	}

}