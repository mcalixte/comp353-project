<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.Alert_History AS Alert_History WHERE Alert_History.region_name = :region_name 
                                        AND Alert_History.alert_level = :alert_level 
                                        AND Alert_History.date_issued = :date_issued");
                                        
$statement->bindParam(":region_name", $_GET["region_name"]);
$statement->bindParam(":alert_level", $_GET["alert_level"]);
$statement->bindParam(":date_issued", $_GET["date_issued"]);
$statement->execute();
$alert_history = $statement->fetch(PDO::FETCH_ASSOC);
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
<table>
        <thead>
            <tr>
                <td>region_name</td>
                <td>alert_level</td>
                <td>date_issued</td>
                <td>is_active</td>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td><?= $alert_history["region_name"] ?></td>
                    <td><?= $alert_history["alert_level"] ?></td>
                    <td><?= $alert_history["date_issued"] ?></td>
                    <td><?= $alert_history["is_active"] ?></td>
                    <td>
                         <a href="./delete.php?region_name=<?= $alert_history["region_name"] ?>&alert_level=<?= $alert_history["alert_level"]?>&date_issued=<?= $alert_history["date_issued"] ?>">Delete</a>
                    </td>
                </tr>
        </tbody>
    </table>
</body>
</html>