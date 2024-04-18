<!-- ESTE TESTE É APENAS PARA VISUALIZAR A ESTRUTURA DA API-->

<?php
        $content_json = file_get_contents("https://stephen-king-api.onrender.com/api/books");
        $content = json_decode($content_json);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <pre>

        <?php

            print_r($content);

        ?>

    </pre>

</body>
</html>
