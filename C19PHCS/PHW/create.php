<?php require_once '../database.php';

if (isset($_POST["phw_id"])
    &&isset($_POST["phf_id"])
    &&isset($_POST["person"])) {
    $region = $conn->prepare("INSERT INTO $database.PHW (region_name)
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
    <title>Add Public Health Worker</title>
</head>

<body>
    <h1>Add Public Health Worker</h1>
    <form action="./create.php" method="post">
        <label for="phw_id">phw_id</label><br>
        <input type="text" name="phw_id" id="phw_id"> <br>

        <label for="phf_id">phf_id</label><br>
        <input type="text" name="phf_id" id="phf_id"> <br>

        <label for="person">person</label><br>
        <input type="text" name="person" id="person"> <br>
        <br/>
        <button type="submit">Add</button>
    </form>
    <a href="./">Back PHW list</a>
</body>

</html>