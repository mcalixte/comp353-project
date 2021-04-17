<?php require_once '../database.php';
                                                    
if (isset($_POST["medicare_num"])
    &&isset($_POST["first_name"])
    &&isset($_POST["last_name"])
    &&isset($_POST["phone_num"])
    &&isset($_POST["postal_code"])
    &&isset($_POST["dob"])
    &&isset($_POST["citizenship"])
    &&isset($_POST["email"])) {                                                
  
    $person = $conn->prepare('INSERT INTO C19PHCS.Person (medicare_num, first_name, last_name, phone_num, postal_code, dob, citizenship, email)
                                    VALUES (:medicare_num, :first_name, :last_name, :phone_num, :postal_code, :dob, :citizenship, :email);');
                                          
    $person->bindParam(':medicare_num', $_POST["medicare_num"]);
    $person->bindParam(':first_name', $_POST["first_name"]);
    $person->bindParam(':last_name', $_POST["last_name"]);
    $person->bindParam(':phone_num', $_POST["phone_num"]);
    $person->bindParam(':postal_code', $_POST["postal_code"]);
    $person->bindParam(':dob', $_POST["dob"]);
    $person->bindParam(':citizenship', $_POST["citizenship"]);
    $person->bindParam(':email', $_POST["email"]);

    if ($person->execute())
        header("Location: .");
    else {
            header("Location: ./create.php?medicare_num=".$_POST["medicare_num"]);
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Person</title>
</head>

<body>
    <h1>Add Person</h1>
    <form action="./create.php" method="post">
        <label for="medicare_num">Medicare Number</label><br>
        <input type="text" name="medicare_num" id="medicare_num" > <br>

        <label for="first_name">First Name</label><br>
        <input type="text" name="first_name" id="first_name" > <br>

        <label for="last_name">Last Name</label><br>
        <input type="text" name="last_name" id="last_name" > <br>

        <label for="phone_num">Phone Number</label><br>
        <input type="text" name="phone_num" id="phone_num" > <br>

        <label for="postal_code">Postal Code</label><br>
        <input type="text" name="postal_code" id="postal_code" > <br>

        <label for="dob">Date Of Birth</label><br>
        <input type="date" required pattern="\d{4}-\d{2}-\d{2}" name="dob" id="dob" > <br>

        <label for="citizenship">Citizenship</label><br>
        <input type="text" name="citizenship" id="citizenship" > <br>


        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" > <br>

        <button type="submit">Add</button>
    </form>
    <a href="./">Back to list</a>
</body>

</html>