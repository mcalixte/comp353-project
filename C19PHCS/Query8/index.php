<?php require_once '../database.php';
session_start();
if(isset($_POST["submit"])){  
  
    if(!empty($_POST['user']) && !empty($_POST['pass'])) {  
        $query = "SELECT * FROM C19PHCS.Person WHERE medicare_num = :user AND dob = :pass";
        $statement = $conn->prepare($query);
        $statement->execute(
            array(
                'user' => $_POST['user'],
                'pass' => $_POST['pass']
            )
        );
        $rowCount = $statement->rowCount();
        if($rowCount>0){
            $_SESSION["user"] = $_POST["user"];
            echo("User found");
            header("location:form.php");
        }
        else{
            echo("user not found");
        }

    }
    else {  
        echo "All fields are required!";  
    }  
}  
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill form</title>
</head>

<body>
    <h1>Login</h1>
    <form action="" method="post">
        <label for="medicare_num">Medicare Number</label><br>
        <input type="text" name="user" id="medicare_num" > <br>

        <label for="first_name">password</label><br>
        <input type="text" name="pass" id="first_name" > <br>
        <input type="submit" value="login" name="submit"/>
    </form>
    <a href="../">Back to home</a>
</body>

</html>