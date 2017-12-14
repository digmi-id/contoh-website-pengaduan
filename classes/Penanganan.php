<?php

class Penanganan {
	private $connection;
	private $table = "penanganan";

	// Field tabel
	public $id;
	public $id_aduan;
	public $id_admin;
	public $status;
	public $stok;
	public $tanggal_pengerjaan;
	public $catatan;

	public function __construct($database) {
		$this->connection = $database;
	}

	public function insert() {
		$sql = "INSERT INTO {$this->table} VALUES(NULL, ?, ?, ?, ?, ?, ?)";
		$query = $this->connection->prepare($sql);
		$query->bindParam(1, $this->id_aduan);
		$query->bindParam(2, $this->id_admin);
		$query->bindParam(3, $this->status);
		$query->bindParam(4, $this->stok);
		$query->bindParam(5, $this->tanggal_pengerjaan);
		$query->bindParam(6, $this->catatan);

		if ($query->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function readAll(){
		$sql = "";
		$query = $this->connection->prepare($sql);
		$query->execute();
		return $query;
	}

	public function readByUser($id_user) {
		$sql = "";
		$query = $this->connection->prepare($sql);
		$query->execute();
		return $query;
	}

	public function getStatus($id) {
		$sql = "SELECT id_aduan FROM {$this->table} WHERE id_aduan={$id}";
		$query = $this->connection->prepare($sql);
        $query->execute();

        if ($query->rowCount()) {
			return true;
        }
        return false;
	}
}
