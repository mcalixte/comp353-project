<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM C19PHCS.Person AS Person WHERE Person.medicare_num = :medicare_num");
$statement->bindParam(":medicare_num", $_GET["medicare_num"]);
$statement->execute();
$person = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["medicare_num"])
    && isset($_POST["first_name"])
    && isset($_POST["last_name"])
    && isset($_POST["phone_num"])
    && isset($_POST["citizenship"])
    && isset($_POST["dob"])
    && isset($_POST["email"])
) {
    $statement = $conn->prepare("UPDATE C19PHCS.Person SET  first_name=:first_name,
                                    last_name = :last_name,
                                    phone_num = :phone_num,
                                    citizenship = :citizenship,
                                    dob = :dob,
                                    email = :email
                                    WHERE medicare_num = :medicare_num");

    $statement->bindParam(':medicare_num', $_POST["medicare_num"]);
    $statement->bindParam(':first_name', $_POST["first_name"]);
    $statement->bindParam(':last_name', $_POST["last_name"]);
    $statement->bindParam(':phone_num', $_POST["phone_num"]);
    $statement->bindParam(':citizenship', $_POST["citizenship"]);
    $statement->bindParam(':dob', $_POST["dob"]);
    $statement->bindParam(':email', $_POST["email"]);

    if ($statement->execute()){
        header("Location: .");
    } else {
        header("Location: ./edit.php?medicare_num=".$_POST["medicare_num"]);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
            
<body>
    <h1>Edit Person</h1>
    <form action="./edit.php" method="post">
        <label for="medicare_num">Medicare Number</label><br>
        <input type="text" name="medicare_num" id="medicare_num" value="<?= $person["medicare_num"] ?>"> <br>
        <label for="first_name">First Name</label><br>
        <input type="text" name="first_name" id="first_name" value="<?= $person["first_name"] ?>"> <br>
        <label for="last_name">Last Name</label><br>
        <input type="text" name="last_name" id="last_name" value="<?= $person["last_name"] ?>"> <br>
        <label for="phone_num">Phone Number</label><br>
        <input type="text" name="phone_num" id="phone_num" value="<?= $person["phone_num"] ?>"> <br>
        <label for="citizenship">Citizenship</label><br>
        <input type="text" name="citizenship" id="citizenship" value="<?= $person["citizenship"] ?>"> <br>
        <label for="dob">Date Of Birth</label><br>
        <input type="date" required pattern="\d{4}-\d{2}-\d{2}" name="dob" id="dob" value="<?= $person["dob"] ?>"> <br>
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" value="<?= $person["email"] ?>"> <br>
        <button type="submit">Update</button>
    </form>
    <a href="./">Back to list</a>
</body>

</html>