<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.Region AS Region");
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
    <h1>List of Regions.</h1>
    <a href="./create.php">Add a new Region</a>
    <table>
        <thead>
            <tr>
                <td>region_name</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["region_name"] ?></td>
                    <td>
                        <a href="./edit.php?region_name=<?= $row["region_name"] ?>">Edit</a>
                        <a href="./delete.php?region_name=<?= $row["region_name"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>