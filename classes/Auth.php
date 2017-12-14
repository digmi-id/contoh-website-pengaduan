<?php

class Auth {
    private $connection;
    public $table;

	// Field tabel
	public $id;
	public $nama;
	public $nohp;
	public $email;
	public $password;

	public $user_data;

	public function __construct($database, $tabel) {
        $this->connection = $database;
        $this->table = $tabel;
	}

    public function login() {
        if ($user_data = $this->checkCredentials()) {
            $this->user_data = $user_data;
            session_start();
            $_SESSION['id'] = $user_data['id'];
            $_SESSION['nama'] = $user_data['nama'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['nohp'] = $user_data['nohp'];
            $_SESSION['password'] = $user_data['password'];
            $_SESSION['type'] = $this->table;
            $_SESSION['is_logged'] = true;
            return $user_data['nama'];
        }
        return false;
    }

    protected function checkCredentials() {
        $sql = "SELECT * FROM {$this->table} WHERE email=? AND password=?";
        $query = $this->connection->prepare($sql);
        $query->bindParam(1, $this->email);
        $query->bindParam(2, $this->password);
        $query->execute();

        if ($query->rowCount()) {
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if ($this->password == $data['password']) {
                return $data;
            }
        }
        return false;
    }
}
