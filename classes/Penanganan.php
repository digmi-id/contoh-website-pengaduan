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

	function update() {
		echo $sql = "UPDATE {$this->table}
				SET
					id_admin = :id_admin,
					status = :status,
					stok = :stok,
					tanggal_pengerjaan = :tanggal_pengerjaan,
					catatan = :catatan
				WHERE
					id_aduan = :id_aduan";

		$query = $this->connection->prepare($sql);
		$query->bindParam(':id_aduan', $this->id_aduan);
		$query->bindParam(':id_admin', $this->id_admin);
		$query->bindParam(':status', $this->status);
		$query->bindParam(':stok', $this->stok);
		$query->bindParam(':tanggal_pengerjaan', $this->tanggal_pengerjaan);
		$query->bindParam(':catatan', $this->catatan);

		if ($query->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function readOne($id){
		$sql = "SELECT catatan, tanggal_pengerjaan, stok, status FROM {$this->table} WHERE id_aduan={$id}";
		$query = $this->connection->prepare($sql);
		$query->execute();
		return $query;
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

	public function rowCountById($id_aduan) {
		$sql = "SELECT id_aduan FROM {$this->table} WHERE id_aduan={$id_aduan}";
		$query = $this->connection->prepare($sql);
		$query->execute();
		if ($query->rowCount()) {
			return true;
		}
		return false;
	}

	public function getStatus($id) {
		$sql = "SELECT `status` FROM {$this->table} WHERE id_aduan={$id}";
		$query = $this->connection->prepare($sql);
        $query->execute();

		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		return ($row['status']) ? $row['status'] : "Menunggu Persetujuan";
	}

	public function getStok($id) {
		$sql = "SELECT `stok` FROM {$this->table} WHERE id_aduan={$id}";
		$query = $this->connection->prepare($sql);
        $query->execute();

		$row = $query->fetch(PDO::FETCH_ASSOC);
		
		return $row['stok'];
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
