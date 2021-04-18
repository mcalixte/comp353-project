<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM $database.Recommendation AS Recommendation');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>List of Recommendations.</h1>
    <a href="./create.php">Add a new Recommendation</a>
    <table>
        <thead>
            <tr>
                <td>Recommendation id</td>
                <td>Recommendation description</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["description"] ?></td>
                    <td>
                        <a href="./show.php?id=<?= $row["id"] ?>">Show</a>
                        <a href="./edit.php?id=<?= $row["id"] ?>">Edit</a>
                        <a href="./delete.php?id=<?= $row["id"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>