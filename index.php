<?php //consumindo api
        $content_json = file_get_contents("https://stephen-king-api.onrender.com/api/books");
        $content = json_decode($content_json);
?>

<?php
require_once 'Database/MySQL.php';

// Criar uma instância da classe MySQL
$mysql = new MySQL();

// Verificar se o formulário foi submetido
if (isset($_POST['btn-sub'])) {
    // Obter os dados do livro do formulário
    $title = $_POST["title"];
    $handle = $_POST['handle'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $pages = $_POST['pages'];
    $id = $_POST['id'];

    // Inserir o livro no banco de dados
    $inserted = $mysql->insertBook($title, $handle, $publisher, $year, $pages, $id);
    if ($inserted) {
        $messageCorrect = ">>>livro inserido ao banco de dados com sucesso!<<<";
        echo "<script>alert('$messageCorrect');</script>";
    } else {
        $messageError = ">>>erro ao inserir o livro ao banco de dados<<<";
        echo "<script>alert('$messageError');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+15&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
    <title>stephen king api</title>
</head>
<body>
    
    <div class="title-content">
        <h1>livros</h1>
    </div>
    <div class="content">
        
    <?php
        if ($content !== null) {
            if (!empty($content->data)) {
                foreach ($content->data as $book) {
                    echo "<form method='POST'>";
                    echo "<div class='books'>";
                    echo "Titulo: " . $book->Title . "<br>";
                    echo "Identificador: " . $book->handle . "<br>";
                    echo "Editora: " . $book->Publisher . "<br>";
                    echo "Ano: " . $book->Year . "<br>";
                    echo "Quantidade de Páginas: " . $book->Pages . "<br>";
                    echo "código: " . $book->id . "<br>";
                    echo "<input type='hidden' name='title' value='" . $book->Title . "'>";
                    echo "<input type='hidden' name='handle' value='" . $book->handle . "'>";
                    echo "<input type='hidden' name='publisher' value='" . $book->Publisher . "'>";
                    echo "<input type='hidden' name='year' value='" . $book->Year . "'>";
                    echo "<input type='hidden' name='pages' value='" . $book->Pages . "'>";
                    echo "<input type='hidden' name='id' value='" . $book->id . "'>";
                    echo "<button type='submit' class='btn-env' name='btn-sub'>enviar</button>";
                    echo "</div>";
                    echo "</form>";
                }
            }
        }
    ?>
    </div>
    
</body>
</html>