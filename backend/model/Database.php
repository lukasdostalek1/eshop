<?php

require_once "ErrorLog.php";

class Database {
    private PDO $pdo; 

    public function __construct() {
    
        $config = require __DIR__ . "/../../config.php";

        $db_host = $config["db_host"];
        $db_name = $config["db_name"];
        $db_user = $config["db_user"];
        $db_pass = $config["db_password"];
        
        $conn = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";
        
        try {
            $this->pdo =  new PDO($conn, $db_user, $db_pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        }
        catch(PDOException $e) {
            ErrorLog::logError($e);
        }
}

    public function getConn(): PDO {
        return $this->pdo;
    }
}

?>