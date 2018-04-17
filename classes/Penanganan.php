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
		$sql = "SELECT `status` FROM {$this->table} WHERE id_aduan={$id}";
		$query = $this->connection->prepare($sql);
        $query->execute();

		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		return ($row['status']) ? $row['status'] : "Menunggu Persetujuan";
	}

	public function getStatusColor($id) {
		$sql = "SELECT `status` FROM {$this->table} WHERE id_aduan={$id}";
		$query = $this->connection->prepare($sql);
        $query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC);

		if ($row['status'] == "Menunggu Persetujuan") {
			return "dark";
		} else if ($row['status'] == "Disetujui") {
			return "info";
		} else if ($row['status'] == "Ditolak") {
			return "danger";
		} else if ($row['status'] == "Sedang Dikerjakan") {
			return "primary";
		} else if ($row['status'] == "Selesai") {
			return "success";
		}
	}
}
