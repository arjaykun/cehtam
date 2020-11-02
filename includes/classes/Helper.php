<?php 

class Helper {

	public function get_fields_values($fields) {
		$values = [];
		foreach ($fields as $key => $value) {
			$values[":".$key] = $value;
		}
		return $values;
	}

}