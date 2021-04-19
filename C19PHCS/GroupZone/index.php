<?php require_once '../database.php';

$groupzone = $conn->prepare("SELECT * FROM $database.groupZone AS GroupZone");
$groupzone->execute();
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
    <h1>List of Group zones.</h1>
    <a href="./create.php">Add a new Group zones</a>
    <table>
        <thead>
            <tr>
                <td>Group zone name</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $groupzone->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["gz_name"] ?></td>
                    <td>
                        <a href="./show.php?gz_name=<?= $row["gz_name"] ?>">Show</a>
                        <a href="./edit.php?gz_name=<?= $row["gz_name"] ?>">Edit</a>
                        <a href="./delete.php?gz_name=<?= $row["gz_name"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>