<?php
class MySQL {
    private $host = 'localhost'; 
    private $dbname = 'bookdb'; 
    private $username = 'root'; 
    private $password = ''; 
    
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public function insertBook($title, $handle, $publisher, $year, $pages, $id) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO livros (title, handle, publisher, year, pages, codigo) VALUES (:title, :handle, :publisher, :year, :pages, :id)");
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(':handle', $handle);
            $stmt->bindParam(':publisher', $publisher);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':pages', $pages);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao inserir livro: " . $e->getMessage();
            return false;
        }
    }
}

?>
