<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM C19PHCS.Person AS Person WHERE Person.medicare_num = :medicare_num");
$statement->bindParam(":medicare_num", $_GET["medicare_num"]);
$statement->execute();
$person = $statement->fetch(PDO::FETCH_ASSOC);
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
    <h1><?= $person["book_title"] ?></h1>
    <table>
        <thead>
                <tr>
                    <td>medicare_num</td>
                    <td>first_name</td>
                    <td>last_name</td>
                    <td>phone_num</td>
                    <td>dob</td>
                    <td>citizenship</td>
                    <td>email</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $person["medicare_num"] ?></td>
                    <td><?= $person["first_name"] ?></td>
                    <td><?= $person["last_name"] ?></td>
                    <td><?= $person["phone_num"] ?></td>
                    <td><?= $person["dob"] ?></td>
                    <td><?= $person["citizenship"] ?></td>
                    <td><?= $person["email"] ?></td>
                    <td>
                        <a href="./edit.php?medicare_num=<?= $row["medicare_num"] ?>">Edit</a>
                        <a href="./delete.php?medicare_num=<?= $row["medicare_num"] ?>">Delete</a>
                    </td>
                </tr>
        </tbody>
    </table>
</body>
</html>