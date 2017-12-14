<?php

class Pengaduan {
	private $connection;
	private $table = "pengaduan";

	// Field tabel
	public $id;
	public $id_bagian;
	public $id_jenis;
	public $id_user;
	public $lokasi;
	public $masalah;
	public $tanggal;

	public function __construct($database) {
		$this->connection = $database;
		$this->tanggal = date('Y-m-d H:i:s');
	}

	public function insert() {
		$sql = "INSERT INTO {$this->table} VALUES(NULL, ?, ?, ?, ?, ?, ?)";
		$query = $this->connection->prepare($sql);
		$query->bindParam(1, $this->id_bagian);
		$query->bindParam(2, $this->id_jenis);
		$query->bindParam(3, $this->id_user);
		$query->bindParam(4, $this->lokasi);
		$query->bindParam(5, $this->masalah);
		$query->bindParam(6, $this->tanggal);

		if ($query->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function readAll(){
		$sql = "SELECT a.id, a.lokasi, a.masalah, a.tanggal, b.nama AS jenis, c.nama AS bagian, d.nama AS user FROM {$this->table} a JOIN jenis b ON a.id_jenis=b.id JOIN bagian c ON a.id_bagian=c.id JOIN user d ON a.id_user=d.id ORDER BY a.id ASC";
		$query = $this->connection->prepare($sql);
		$query->execute();
		return $query;
	}

	public function readByUser($id_user) {
		$sql = "SELECT a.lokasi, a.masalah, a.tanggal, b.nama AS jenis, c.nama AS bagian FROM {$this->table} a JOIN jenis b ON a.id_jenis=b.id JOIN bagian c ON a.id_bagian=c.id WHERE id_user={$id_user} ORDER BY a.id ASC";
		$query = $this->connection->prepare($sql);
		$query->execute();
		return $query;
	}
}
