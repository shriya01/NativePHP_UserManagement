<?php 
class DataBaseConnection
{
    private $host = "localhost"; //server name
    private $username ="root"; //database username
    private $password =""; //database password
    private $databasename="php_user_management"; //database
    public function getConnection()
    {
        $this->conn = null;
        if (! $this->conn = new mysqli($this->host, $this->username, $this->password, $this->databasename)) {
            echo $this->conn->connect_error;
        }
        return $this->conn;
    }
}
