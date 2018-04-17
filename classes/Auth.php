<?php

class Auth {
    private $connection;
    public $table;

    // Field table
    public $id;
    public $jenis;
    public $username;
    public $nama;
    public $nohp;
    public $email;
    public $password;

	public $user_data;

	public function __construct($database, $table) {
        $this->connection = $database;
        $this->table = $table;
	}

    public function login() {
        if ($user_data = $this->checkCredentials()) {
            $this->user_data = $user_data;
            session_start();
            $_SESSION['id'] = $user_data['id'];
            $_SESSION['nama'] = $user_data['nama'];
            $_SESSION['nohp'] = $user_data['nohp'];
            if ($this->table == "admin") {
                $_SESSION['username'] = $user_data['username'];
                $_SESSION['jenis'] = $user_data['jenis'];
            } else {
                $_SESSION['email'] = $user_data['email'];
            }
            $_SESSION['type'] = $this->table;
            $_SESSION['is_logged'] = true;
            
            return $user_data['nama'];
        }
        return false;
    }

    protected function checkCredentials() {
        $field = ($this->table == "admin") ? "username" : "email";
        $sql = "SELECT * FROM {$this->table} WHERE {$field}=? AND password=?";
        $query = $this->connection->prepare($sql);
        $identifier = ($this->table == "admin") ? $this->username : $this->email;
        $query->bindParam(1, $identifier);
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
