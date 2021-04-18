<?php require_once '../database.php';

$alertHistoryEntries = $conn->prepare("SELECT * FROM $database.Alert_History AS Alert_History");
$alertHistoryEntries->execute();
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
    <h1>Alert History</h1>
    <a href="./create.php">Add a new Alert</a>
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
            <?php while ($row = $alertHistoryEntries->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["region_name"] ?></td>
                    <td><?= $row["alert_level"] ?></td>
                    <td><?= $row["date_issued"] ?></td>
                    <td><?= $row["is_active"] ?></td>
                    <td>
                        <a href="./show.php?region_name=<?= $row["region_name"] ?>&alert_level=<?= $row["alert_level"]?>&date_issued=<?= $row["date_issued"] ?>">Show</a>
                        <a href="./delete.php?region_name=<?= $row["region_name"] ?>&alert_level=<?= $row["alert_level"]?>&date_issued=<?= $row["date_issued"] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>