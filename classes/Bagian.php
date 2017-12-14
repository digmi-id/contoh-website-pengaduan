<?php

class Bagian {
	private $connection;
	private $table = "bagian";

	// Field tabel
	public $id;
	public $nama;

	public function __construct($database) {
		$this->connection = $database;
	}

	function insert() {
		$sql = "INSERT INTO {$this->table} VALUES(NULL, ?)";
		$query = $this->connection->prepare($sql);
		$query->bindParam(1, $this->nama);

		if ($query->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function readAll(){
		$sql = "SELECT * FROM {$this->table} ORDER BY id ASC";
		$query = $this->connection->prepare($sql);
		$query->execute();
		return $query;
	}
}
