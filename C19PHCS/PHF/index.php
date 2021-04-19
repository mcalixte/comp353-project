<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.PHF AS PHF");
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
    <h1>List of Facilities</h1>
    <a href="./create.php">Add a new Public Health Facility</a>
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
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["phf_id"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["address"] ?></td>
                    <td><?= $row["phone_num"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["drive_thru"] ?></td>
                    <td><?= $row["type"] ?></td>
                    <td><?= $row["acceptance_method"] ?></td>
                    <td>
                        <a href="./show.php?phf_id=<?= $row["phf_id"] ?>">Show</a>
                        <a href="./edit.php?phf_id=<?= $row["phf_id"] ?>">Edit</a>
                        <a href="./delete.php?phf_id=<?= $row["phf_id"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>