<?php require_once '../database.php';

if (isset($_POST["id"])&&isset($_POST["description"])) {
    $region = $conn->prepare("INSERT INTO $database.Recommendation (id, description)
                                    VALUES (:id, :description);");

    $region->bindParam(':id', $_POST["id"]);
    $region->bindParam(':description', $_POST["description"]);

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
    <title>Create Health Recommendation</title>
</head>

<body>
    <h1>Create Health Recommendation</h1>
    <form action="./edit.php" method="post">
        <label for="id">ID</label><br>
        <input type="text" name="id" id="id" > <br>
        
        <label for="description">Description</label><br>
        <textarea type="text" name="description" id="description" > </textarea><br />
        
        <input type="submit">Create</button>
    <a href="./">Back to Recommendations list</a>
</body>

</html>