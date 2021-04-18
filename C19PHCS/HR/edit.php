<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.Recommendation AS Recommendation WHERE Recommendation.id = :id");
$statement->bindParam(":id", $_GET["id"]);
$statement->bindParam(":description", $_GET["description"]);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["id"])
) {
    $statement = $conn->prepare("UPDATE $database.Recommendation SET  description=:description
                                    WHERE id = :id;");

    $statement->bindParam(':id', $_POST["id"]);
    $statement->bindParam(':description', $_POST["description"]);

    if ($statement->execute()){
        header("Location: .");
    } else {
        header("Location: ./edit.php?id=".$_POST["id"]);
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Health Recommendation</title>
</head>

<body>
    <h1>Edit Health Recommendation</h1>
    <form action="./edit.php" method="post">
        <label for="id">ID</label><br>
        <input type="text" name="id" id="id" > <br>
        
        <label for="description">Description</label><br>
        <textarea type="text" name="description" id="description" > </textarea><br />
        
        <input type="submit">Create</button>
    <a href="./">Back to Recommendations list</a>
</body>

</html>