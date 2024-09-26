<?php
   require __DIR__ . '/../config/Database.php';
   
    class  CD {
        private $db;

        public function __construct(){
            $this->db = new Database();
        }
        

        /**
         * Different SELECT functions
         * Each SELECT returns for different Parameters
         */

        public function selectAll() {
            $sql = "SELECT * FROM cds ORDER BY id DESC";
            $params = [];
            return $this->db->select($sql,$params);
             
        }

        public function selectByID($id) {
            $sql = "SELECT * FROM cds WHERE id = :id";
            $params = [
                ":id" => $id,
            ];
            return $this->db->selectOne($sql,$params);
        }

        public function selectByTitle($title) {
            $sql = "SELECT * FROM cds WHERE title = :title";
            $params = [
                ":title" => $title,
            ];
            return $this->db->select($sql, $params);
        }
    
        public function selectByLength($length) {
            $sql = "SELECT * FROM cds WHERE length = :length";
            $params = [
                ":length" => $length,
            ];
            return $this->db->select($sql, $params);
        }
    
       
        public function selectByAuthor($author) {
            $sql = "SELECT * FROM cds WHERE author = :author";
            $params = [
                ":author" => $author,
            ];
            return $this->db->select($sql, $params);
        }
    
        
        public function selectByReleaseDate($releaseDate) {
            $sql = "SELECT * FROM cds WHERE release_date = :release_date";
            $params = [
                ":release_date" => $releaseDate,
            ];
            return $this->db->select($sql, $params);
        }

        // Create a new CD
        public function createCD($title, $length, $author, $releaseDate) {
            $sql = "INSERT INTO cds (title, length, author, release_date) VALUES (:title, :length, :author, :release_date)";
            $params = [
                ":title" => $title,
                ":length" => $length,
                ":author" => $author,
                ":release_date" => $releaseDate,
            ];
            return $this->db->insert($sql, $params);
        }

        // Edit an existing CD
        public function editCD($id, $title, $length, $author, $releaseDate) {
            $sql = "UPDATE cds SET title = :title, length = :length, author = :author, release_date = :release_date WHERE id = :id";
            $params = [
                ":id" => $id,
                ":title" => $title,
                ":length" => $length,
                ":author" => $author,
                ":release_date" => $releaseDate,
            ];
            return $this->db->update($sql, $params);
        }

        // Delete a CD
        public function deleteCD($id) {
            $sql = "DELETE FROM cds WHERE id = :id";
            $params = [
                ":id" => $id,
            ];
            return $this->db->delete($sql, $params);
        }

        

    }