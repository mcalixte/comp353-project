<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM comp353.books AS book WHERE book.book_id = :book_id");
$statement->bindParam(":book_id", $_GET["book_id"]);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $book["book_title"] ?></title>
</head>
<body>
    <h1><?= $book["book_title"] ?></h1>
    <p>Publish Date: <?= $book["publish_date"] ?></p>
    <p>Price: <?= $book["price"] ?></p>
</body>
</html>