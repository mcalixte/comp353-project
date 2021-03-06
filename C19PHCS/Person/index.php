<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.Person AS Person");
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
    <h1>List of Persons</h1>
    <a href="./create.php">Add a new Person</a>
    <table>
        <thead>
            <tr>
                <td><b>medicare_num</b></td>
                <td><b>first_name</b></td>
                <td><b>last_name</b></td>
                <td><b>phone_num</b></td>
                <td><b>dob</b></td>
                <td><b>citizenship</b></td>
                <td><b>email</b></td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["medicare_num"] ?></td>
                    <td><?= $row["first_name"] ?></td>
                    <td><?= $row["last_name"] ?></td>
                    <td><?= $row["phone_num"] ?></td>
                    <td><?= $row["dob"] ?></td>
                    <td><?= $row["citizenship"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td>
                        <a href="./show.php?medicare_num=<?= $row["medicare_num"] ?>">Show</a>
                        <a href="./edit.php?medicare_num=<?= $row["medicare_num"] ?>">Edit</a>
                        <a href="./delete.php?medicare_num=<?= $row["medicare_num"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>