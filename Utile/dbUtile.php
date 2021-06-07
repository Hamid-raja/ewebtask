<?php 
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "9799");
define("DB_NAME", "ewebtask");

class dbUtile{

    public $host   = DB_HOST;
    public $user   = DB_USER;
    public $pass   = DB_PASS;
    public $dbname = DB_NAME;

    public $conn;  //for connection
    public $errmsg; // for error messages

    public function __construct()
    {
        $this->dbConnection();
    }

    private function dbConnection()
    {
        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname
        );
        if (!$this->conn) {
            $this->errmsg = "Connection Error";
            return false;
        }
    }

    /**
     * Select data from tables
     * parameter $query 
     * */ 
    public function select($query)
    {
        // get select record 
        // echo $query;
        $resultSel = $this->conn->query($query) or  die($this->conn->connect_error . __LINE__);
        if ($resultSel->num_rows > 0) {
            return $resultSel;
        } else {
            return false;
        }
    }

    /**
     * Insert record in database
     */
    public function insert($query)
    {
        //insert record
        // echo $query;
        $insertRow = $this->conn->query($query) or  die($this->conn->connect_error."abc". __LINE__);
        if ($insertRow) {
            return $insertRow;
        } else {
            return false;
        }
    }

    /**
     * Update database table record
     */
    public function update($query)
    {
        $updateRow = $this->conn->query($query) or   die($this->conn->errmsg . __LINE__);
        if ($updateRow) {
            return $updateRow;
        } else {
            return false;
        }
    }

    /**
     * Delete record from database table
     */
    public function delete($query)
    {
        $deleteRow = $this->conn->query($query) or  die($this->conn->connect_error . __LINE__);
        if ($deleteRow) {
            return $deleteRow;
        } else {
            return false;
        }
    }
}

?>