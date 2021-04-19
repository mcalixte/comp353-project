<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.PHF AS PHF WHERE PHF.phf_id = :phf_id");
$statement->bindParam(":phf_id", $_GET["phf_id"]);
$statement->execute();
$PHF = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["name"])
    && isset($_POST["address"])
    && isset($_POST["phone_num"])
    && isset($_POST["email"])
    && isset($_POST["drive_thru"])
    && isset($_POST["type"])
    && isset($_POST["acceptance_method"])
) {
    $statement = $conn->prepare("UPDATE $database.PHF SET  
                                    address =:address,
                                    phone_num = :phone_num,
                                    email = :email,
                                    drive_thru = :drive_thru,
                                    type = :type,
                                    acceptance_method = :acceptance_method 
                                    WHERE phf_id = :phf_id;");

    $statement->bindParam(':address', $_POST["address"]);
    $statement->bindParam(':phone_num', $_POST["phone_num"]);
    $statement->bindParam(':email', $_POST["email"]);
    $statement->bindParam(':drive_thru', $_POST["drive_thru"]);
    $statement->bindParam(':type', $_POST["type"]);
    $statement->bindParam(':acceptance_method', $_POST["acceptance_method"]);

    if ($statement->execute()){
        header("Location: .");
    } else {
        header("Location: ./edit.php?phf_id=".$_POST["phf_id"]);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit PHF</title>
</head>

<body>
    <h1>Edit PHF</h1>
    <form action="./edit.php" method="post">
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
        <button type="submit">Update</button>
    </form>
    <a href="./">Back to PHF list</a>
</body>

</html>