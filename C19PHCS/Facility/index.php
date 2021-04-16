<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM comp353.books AS books');
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
    <h1>List of books.</h1>
    <a href="./create.php">Add a new book</a>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Title</td>
                <td>Publish Date</td>
                <td>Price</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["book_id"] ?></td>
                    <td><?= $row["book_title"] ?></td>
                    <td><?= $row["publish_date"] ?></td>
                    <td><?= $row["price"] ?></td>
                    <td>
                        <a href="./show.php?book_id=<?= $row["book_id"] ?>">Show</a>
                        <a href="./edit.php?book_id=<?= $row["book_id"] ?>">Edit</a>
                        <a href="./delete.php?book_id=<?= $row["book_id"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>