<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.Region AS Region WHERE Region.region_name = :region_name");
$statement->bindParam(":region_name", $_GET["region_name"]);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["medicare_num"])
) {
    $statement = $conn->prepare("UPDATE $database.Region SET  region_name=:region_name,
                                    WHERE region_name = :region_name;");

    $statement->bindParam(':region_name', $_POST["region_name"]);

    if ($statement->execute()){
        header("Location: .");
    } else {
        header("Location: ./edit.php?region_name=".$_POST["region_name"]);
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Region</title>
</head>

<body>
    <h1>Edit Region</h1>
    <form action="./edit.php" method="post">
        <label for="region_name">Region name</label><br>
        <input type="text" name="region_name" id="region_name" > <br>
        <input type="submit">Update</button>
    <a href="./">Back to Region list</a>
</body>

</html>