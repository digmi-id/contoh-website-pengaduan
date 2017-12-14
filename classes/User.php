<?php

class User {
	private $connection;
	private $table = "user";

	// Field tabel
	public $id;
	public $nama;
	public $nohp;
	public $email;
	public $password;

	public function __construct($database) {
		$this->connection = $database;
	}

	public function insert() {
		$sql = "INSERT INTO {$this->table} VALUES(NULL, ?, ?, ?, ?)";
		$query = $this->connection->prepare($sql);
		$query->bindParam(1, $this->nama);
		$query->bindParam(2, $this->nohp);
		$query->bindParam(3, $this->email);
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
