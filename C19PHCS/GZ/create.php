<?php require_once '../database.php';

if (isset($_POST["gz_name"])) {
    $region = $conn->prepare("INSERT INTO $database.groupZone (gz_name)
                                    VALUES (:gz_name);");

    $region->bindParam(':gz_name', $_POST["gz_name"]);

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
    <h1>Add Group Zone</h1>
    <form action="./create.php" method="post">
        <label for="gz_name">Region Name</label><br>
        <input type="text" name="gz_name" id="gz_name"> <br>
        <br/>
        <button type="submit">Add</button>
    </form>
    <a href="./">Back to Persons list</a>
</body>

</html>