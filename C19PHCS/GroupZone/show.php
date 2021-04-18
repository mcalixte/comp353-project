<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.groupZone AS GroupZone WHERE GroupZone.gz_name = :gz_name");
$statement->bindParam(":gz_name", $_GET["gz_name"]);
$statement->execute();
$groupzone = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $groupzone["book_title"] ?></title>
</head>
<body>
    <h1><?= $groupzone["gz_name"] ?></h1>
    <a href="./edit.php?gz_name=<?= $row["gz_name"] ?>">Edit</a>
    <a href="./delete.php?gz_name=<?= $row["gz_name"] ?>">Delete</a>
</body>
</html>