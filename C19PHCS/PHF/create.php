<?php require_once '../database.php';

if (isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["phone_num"]) && isset($_POST["email"]) && isset($_POST["drive_thru"]) && isset($_POST["type"]) && isset($_POST["acceptance_method"])) {
    $PHF = $conn->prepare("INSERT INTO  $database.PHF (name, address, phone_num, email, drive_thru, type, acceptance_method)
                                    VALUES (:name, :address, :phone_num, email, drive_thru, type, acceptance_method);");

    $PHF->bindParam(':name', $_POST["name"]);
    $PHF->bindParam(':address', $_POST["address"]);
    $PHF->bindParam(':phone_num', $_POST["phone_num"]);
    $PHF->bindParam(':email', $_POST["email"]);
    $PHF->bindParam(':drive_thru', $_POST["drive_thru"]);
    $PHF->bindParam(':type', $_POST["type"]);
    $PHF->bindParam(':acceptance_method', $_POST["acceptance_method"]);

    if ($book->execute())
        header("Location: .");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add PHF</title>
</head>

<body>
    <h1>Add PHF</h1>
    <form action="./create.php" method="post">
        <label for="name">Title</label><br>
        <input type="text" name="name" id="name" value="<?= $PHF["name"] ?>"> <br>
        <label for="address">address</label><br>
        <input type="text" name="address" id="address" value="<?= $PHF["address"] ?>"> <br>
        <label for="phone_num">phone_num</label><br>
        <input type="text" name="phone_num" id="phone_num" value="<?= $PHF["phone_num"] ?>"> <br>
        <label for="email">email</label><br>
        <input type="text" name="email" id="email" value="<?= $PHF["email"] ?>"> <br>
        <label for="drive_thru">drive_thru</label><br>
        <input type="text" name="drive_thru" id="drive_thru" value="<?= $PHF["drive_thru"] ?>"> <br>
        <label for="type">type</label><br>
        <input type="text" name="type" id="type" value="<?= $PHF["type"] ?>"> <br>
        <label for="acceptance_method">Title</label><br>
        <input type="text" name="acceptance_method" id="acceptance_method" value="<?= $PHF["acceptance_method"] ?>"> <br>
         <br>
        <button type="submit">Add</button>
    </form>
    <a href="./">Back to PHF list</a>
</body>

</html>