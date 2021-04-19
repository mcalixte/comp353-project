<?php require_once '../database.php';

if (isset($_GET["phw_id"])&&isset($_GET["phf_id"])&&isset($_GET["test_date"])) {

$statement = $conn->prepare("SELECT phw_id, test_date FROM PHW, Test WHERE PHW.person=Test.conducted_on AND results='POS' AND phf_id=:phf_id AND test_date=:test_date;");
$statement->bindParam(':phf_id', $_GET["phf_id"]);
$statement->bindParam(':test_date', $_GET["test_date"]);
$statement->execute();

$statement2 = $conn->prepare("SELECT DISTINCT($database.PHW.phw_id) From $database.Service_History, $database.PHW 
    WHERE $database.PHW.phw_id=$database.Service_history.phw_id 
    AND phf_id=:phw_id
    AND PHW.phw_id <> :phw_id
    AND service_date IN(
    SELECT service_date FROM $database.Service_history AS Service_history where Service_history.phw_id = :phw_id AND Service_history.service_date BETWEEN DATE_ADD(:test_date, INTERVAL -14 day)
    AND :test_date);");

$statement2->bindParam(':phw_id', $_GET["phw_id"]);
$statement2->bindParam(':phf_id', $_GET["phf_id"]);
$statement2->bindParam(':test_date', $_GET["test_date"]);
$statement2->execute();
}
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
    <h1>List of Positive Public Heath workers and their colleagues</h1>
    <form action="./" method="get">
    <h2>Provide PHF and testinfo</h2>
        <label for="phf_id">Phf_id</label><br>
        <input type="text" name="phf_id" id="phf_id"> <br>

        <label for="test_date">Test date</label><br>
        <input type="date" name="test_date" id="test_date"> <br>

        <label for="phw_id">Phw_id</label><br>
        <input type="text" name="phw_id" id="phw_id"> <br>

        <input type="submit">
        <br>
        <br>
        <br>
    </form>
    <div>
        <table>
            <thead>
                <tr>
                    <td><b>phw_id</b></td>
                    <td><b>test_date</b></td>
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
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <td><b>phw_id</b></td>
                </tr>
            </thead>
            <tbody>
                <?php while ($rowStatement2 = $statement2->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr>
                        <td><?= $rowStatement2["phw_id"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
   
    <a href="../">Back to homepage</a>
</body>

</html>