<?php
class Database {
    private $host = 'localhost';  
    private $dbName = 'adminit_task';  
    private $username = 'root';  
    private $password = '';  
    private $pdo;

    public function __construct() {
        $this->connect();
    }

    // Connect to database
    private function connect() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    /**
     * All basic functions
     * They all take sql string and parameters
     * later execute them to PDO
     */
    public function insert($sql, $params = []) {
        return $this->execute($sql, $params);
    }

 
    public function update($sql, $params = []) {
        return $this->execute($sql, $params);
    }

    
    public function delete($sql, $params = []) {
        return $this->execute($sql, $params);
    }

   
    public function select($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function selectOne($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }

  
    private function execute($sql, $params) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}