<?php
class Connection
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "todo";
    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        } catch (Exception $e) {
            $e->getMessage();
            echo $e;
        }
    }
}
