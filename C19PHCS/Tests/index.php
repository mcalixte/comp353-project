<?php require_once '../database.php';


$statement = $conn->prepare("SELECT results, first_name, last_name, dob, phone_num, email from $database.Test, $database.Person 
WHERE result_date = :result_date AND $database.Person.medicare_num = $database.Test.conducted_on ORDER BY results;");
$statement->bindParam(':result_date', $_GET["result_date"]);
$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>List of Persons and Tests</h1>
    <form action="./" method="get">
        <label for="result_date">Search Test Results Date</label><br>
        <input type="date" name="result_date" id="result_date"> <br>

        <input type="submit">
        <br>
        <br>
        <br>
    </form>
    <table>
        <thead>
            <tr>
                <td><b>results</b></td>
                <td><b>first_name</b></td>
                <td><b>last_name</b></td>
                <td><b>phone_num</b></td>
                <td><b>dob</b></td>
                <td><b>email</b></td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["results"] ?></td>
                    <td><?= $row["first_name"] ?></td>
                    <td><?= $row["last_name"] ?></td>
                    <td><?= $row["phone_num"] ?></td>
                    <td><?= $row["dob"] ?></td>
                    <td><?= $row["email"] ?></td>    
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>