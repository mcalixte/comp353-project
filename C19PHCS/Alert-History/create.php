<?php require_once '../database.php';

if (isset($_POST["region_name"])
&&isset($_POST["alert_level"])
&&isset($_POST["date_issued"])
&&isset($_POST["is_active"])) {
    $statement = $conn->prepare("INSERT INTO $database.Alert_History (region_name, alert_level, date_issued, is_active) 
                                                            VALUES (:region_name, :alert_level, :date_issued, :is_active);");

    $statement->bindParam(':region_name', $_POST["region_name"]);
    $statement->bindParam(':alert_level', $_POST["alert_level"]);
    $statement->bindParam(':date_issued', $_POST["date_issued"]);
    $statement->bindParam(':is_active', $_POST["is_active"]);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Alert History</title>
</head>

<body>
    <h1>Add Alert History</h1>
    <form action="./create.php" method="post">
        <label for="region_name">Region Name</label><br>
        <input type="text" name="region_name" id="region_name"> <br>

        <label for="alert_level">Alert Level</label><br>
        <input type="text" name="alert_level" id="alert_level"> <br>

        <label for="date_issued">Date Issued</label><br>
        <input type="date" name="date_issued" id="date_issued"> <br>

        <label for="is_active">Active</label><br>
        <input type="text" name="is_active" id="is_active"> <br>
        <br/>
        <input type="submit">
    </form>
    <a href="./">Back Region list</a>
</body>

</html>