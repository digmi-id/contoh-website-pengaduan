<?php

class Admin {
	private $connection;
	private $table = "admin";

	// Field tabel
	public $id;
	public $jenis;
	public $username;
	public $nama;
	public $password;

	public function __construct($database) {
		$this->connection = $database;
	}

	public function insert() {
		$sql = "INSERT INTO {$this->table} VALUES(NULL, ?, ?, ?, ?)";
		$query = $this->connection->prepare($sql);
		$query->bindParam(1, $this->jenis);
		$query->bindParam(2, $this->username);
		$query->bindParam(3, $this->nama);
		$query->bindParam(4, $this->password);

		if ($query->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function readAll(){
		$sql = "SELECT * FROM {$this->table} ORDER BY id ASC";
		$query = $this->connection->prepare($sql);
		$query->execute();
		return $query;
	}
}
