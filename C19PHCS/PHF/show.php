<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.PHF AS PHF WHERE PHF.phf_id = :phf_id");
$statement->bindParam(":phf_id", $_GET["phf_id"]);
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
<table>
        <thead>
            <tr>
                <td>phf_id</td>
                <td>name</td>
                <td>address</td>
                <td>phone_num</td>
                <td>email</td>
                <td>drive_thru</td>
                <td>type</td>
                <td>acceptance_method</td>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?= $PHF["phf_id"] ?></td>
                    <td><?= $PHF["name"] ?></td>
                    <td><?= $PHF["address"] ?></td>
                    <td><?= $PHF["phone_num"] ?></td>
                    <td><?= $PHF["email"] ?></td>
                    <td><?= $PHF["drive_thru"] ?></td>
                    <td><?= $PHF["type"] ?></td>
                    <td><?= $PHF["acceptance_method"] ?></td>
                    <td>
                        <a href="./show.php?phf_id=<?= $PHF["phf_id"] ?>">Show</a>
                        <a href="./edit.php?phf_id=<?= $PHF["phf_id"] ?>">Edit</a>
                        <a href="./delete.php?phf_id=<?= $PHF["phf_id"] ?>">Delete</a>
                    </td>
                </tr>
</body>
</html>