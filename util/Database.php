<?php
class Database {
    private $server;
    private $username;
    private $password;
    
    private $connection;

    private $lastResult;

    public function __construct() {
        $this->server = 'localhost:3306';
        $this->username = "ivan";
        $this->password = "2345";
        $this->lastResult = NULL;
    }

    public function __destruct() {
        $this->connection->close();
    }

    public function connect() {
        $this->connection = new MySQLi($this->server, $this->username, $this->password);
        if($this->connection->connect_error) {
            die("Connection failed : " . $this->connection->connect_error);
        }
    }

    public function connectWithAdminPasswd($psswd) {
        $this->connection = new MySQLi($this->server, 'root', $psswd);
        if($this->connection->connect_error) {
            die("Connection failed : " . $this->connection->connect_error);
        }
    }

    public function query($str) {
        $res = $this->connection->query($str);
        $lastResult = $res;
        return $res;
    }

    public function getRow() {
        if($this->lastResult != NULL) {
            if($this->lastResult->num_rows > 0) {
                if($row = $this->lastResult->fetch_assoc()) {
                    return $row;
                }
            }
        }
    }
}
?>