<?php require_once '../database.php';

    $statement = $conn->prepare("SELECT * FROM $database.Message AS Message WHERE Message.date_time Between :start_date AND :end_time;");

    $statement->bindParam(":start_date", $_GET["start_date"]);
    $statement->bindParam(":end_time", $_GET["end_time"]);
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
    <h1>List of Messages</h1>
    <form action="./" method="get">
        <label for="start_date">Start Date</label><br>
        <input type="date" name="start_date" id="start_date"> <br>

        <label for="end_time">End Date</label><br>
        <input type="date" name="end_time" id="end_time"> <br>

        <input type="submit">
        <br>
        <br>
        <br>
    </form>
    <table>
        <thead>
            <tr>
                <td>msg_id</td>
                <td>date_time</td>
                <td>description</td>
                <td>old_alert</td>
                <td>new_alert</td>
                <td>person</td>
                <td>region_name</td>
                
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["msg_id"] ?></td>
                    <td><?= $row["date_time"] ?></td>
                    <td><?= $row["description"] ?></td>
                    <td><?= $row["old_alert"] ?></td>
                    <td><?= $row["new_alert"] ?></td>
                    <td><?= $row["region_name"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>