

<?php require_once '../database.php';

$statement = $conn->prepare("SELECT Postal_Code.postal_code, City.city_name, City.region_name FROM $database.Postal_Code, $database.City 
WHERE $database.Postal_Code.city_name = $database.City.city_name;");

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
                <td>postal_code</td>
                <td>city_name</td>
                <td>region_name</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["postal_code"] ?></td>
                    <td><?= $row["city_name"] ?></td>
                    <td><?= $row["region_name"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>