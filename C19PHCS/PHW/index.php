<?php require_once '../database.php';
$statement = $conn->prepare('SELECT * FROM C19PHCS.PHW AS PHW');
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
    <h1>List of Public Health Workers.</h1>
    <a href="./create.php">Add a new PHW</a>
    <table>
        <thead>
            <tr>
                <td>phw_id</td>
                <td>person</td>
                <td>phf_id</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["phw_id"] ?></td>
                    <td><?= $row["person"] ?></td>
                    <td><?= $row["phf_id"] ?></td>
                    <td>
                        <a href="../Person/show.php?medicare_num=<?= $row["person"] ?>">Show</a>
                        <a href="../Person/edit.php?medicare_num=<?= $row["person"] ?>">Edit</a>
                        <a href="../Person/delete.php?medicare_num=<?= $row["person"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to PH list</a>
</body>

</html>