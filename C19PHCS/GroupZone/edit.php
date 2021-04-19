<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.groupZone AS GroupZone WHERE GroupZone.gz_name = :gz_name");
$statement->bindParam(":gz_name", $_GET["gz_name"]);
$statement->execute();
$groupzone = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["gz_name"])
) {
    $statement = $conn->prepare("UPDATE $database.groupZone SET gz_name=:gz_name 
                                    WHERE gz_name = :gz_name;");

    $statement->bindParam(':gz_name', $_POST["gz_name"]);

    if ($statement->execute()){
        header("Location: .");
    } else {
        header("Location: ./edit.php?gz_name=".$_POST["gz_name"]);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit GroupZone</title>
</head>

<body>
    <h1>Edit GroupZone</h1>
    <form action="./edit.php" method="post">
        <label for="gz_name">GroupZone name</label><br>
        <input type="text" name="gz_name" id="gz_name" value="<?= $groupzone["gz_name"] ?>"> <br>
        
    <a href="./">Back to GroupZone list</a>
</body>

</html>