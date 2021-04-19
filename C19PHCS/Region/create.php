<?php require_once '../database.php';

if (isset($_POST["region_name"])) {
    $region = $conn->prepare("INSERT INTO $database.Region (region_name)
                                    VALUES (:region_name);");

    $region->bindParam(':region_name', $_POST["region_name"]);

    if ($region->execute())
        header("Location: .");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Region</title>
</head>

<body>
    <h1>Add Region</h1>
    <form action="./create.php" method="post">
        <label for="region_name">Region Name</label><br>
        <input type="text" name="region_name" id="region_name"> <br>
        <br/>
        <button type="submit">Add</button>
    </form>
    <a href="./">Back Region list</a>
</body>

</html>