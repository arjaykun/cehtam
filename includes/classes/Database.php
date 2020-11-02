<?php

class Database {

	const FETCH_SINGLE = 1;
	const FETCH_ALL = 2;
	const EXECUTE = 3;

	private $pdo;

	public $db_name = "cehtmar";
	public $db_username = "root";
	public $db_password = "";

	public function __construct() {
		try {
			$this->pdo = new PDO("mysql:host=localhost;dbname=" . $this->db_name, $this->db_username, $this->db_password);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		} catch(PDOException $e) {
			echo "Database connection failed: " . $e->getMessage();
			exit();
		} 
	}

	public function query($sql, $mode, $values=[]) {
		$stmt = $this->pdo->prepare($sql);
		foreach ($values as $key => $value) {
			$stmt->bindValue($key, $value); // ex: $stmt->bindValue(':username', $username)
		}
		$result = $stmt->execute();

		if ($mode != self::FETCH_SINGLE && $mode != self::FETCH_ALL && $mode != self::EXECUTE ) {
			throw new Exception("Invalid mode in database query!");
		} elseif ($mode == self::FETCH_SINGLE) {
			return $stmt->fetch();
		} elseif ($mode == self::FETCH_ALL ) {
			return $stmt->fetchAll();
		} else {
			return $stmt->rowCount();
		}
	}

}