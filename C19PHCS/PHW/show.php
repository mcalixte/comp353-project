<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM C19PHCS.PHW AS PHW WHERE PHW.phw_id = :phw_id");
$statement->bindParam(":phw_id", $_GET["phw_id"]);
$statement->execute();
$PHW = $statement->fetch(PDO::FETCH_ASSOC);
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
    <h1><?= $PHW["phw_id"] ?></h1>
    <p>Person: <?= $PHW["person"] ?></p>
    <p>phf_id: <?= $PHW["phf_id"] ?></p>
</body>
</html>