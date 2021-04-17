<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM comp353.books AS book WHERE book.book_id = :book_id");
$statement->bindParam(":book_id", $_GET["book_id"]);
$statement->execute();
$PHF = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $PHF["name"] ?></title>
</head>
<body>
    <h1><?= $PHF["phf_id"] ?></h1>
    <p>address: <?= $PHF["address"] ?></p>
    <p>phone_num: <?= $PHF["phone_num"] ?></p>
    <p>email: <?= $PHF["email"] ?></p>
    <p>drive_thru: <?= $PHF["drive_thru"] ?></p>
    <p>type: <?= $PHF["type"] ?></p>
    <p>acceptance_method: <?= $PHF["acceptance_method"] ?></p>
</body>
</html>