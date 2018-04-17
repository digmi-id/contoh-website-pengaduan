<?php

class Config {
	private $DB_HOST = "localhost";
	private $DB_NAME = "pengaduan";
	private $DB_USER = "root";
	private $DB_PASS = "@Root<<0";

	public $connection;

	public function getConnection() {
		$this->connection = null;
		try {
			$this->connection = new PDO("mysql:host={$this->DB_HOST};dbname=".$this->DB_NAME, $this->DB_USER, $this->DB_PASS);
		} catch (PDOException $exception) {
			echo "Connection error: {$exception->getMessage()}";
		}
		return $this->connection;
	}
}

