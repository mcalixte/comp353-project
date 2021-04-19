<?php require_once '../database.php';

if (isset($_GET["phf_id"])) {
    $statement = $conn->prepare("SELECT person, phw_id from PHW WHERE phf_id=:phf_id;");
    $statement->bindParam(':phf_id', $_GET["phf_id"]);
    $statement->execute();
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
    <h1>List of Persons by PHF ID</h1>
    <form action="./findByPHF.php" method="get">
        <label for="phf_id">Search for person by phf_id</label><br>
        <input type="text" name="phf_id" id="phf_id"> <br>

        <input type="submit">
        <br>
        <br>
        <br>
    </form>
    <table>
        <thead>
            <tr>
                <td><b>medicare_num</b></td>
                <td><b>phf id</b></td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["person"] ?></td>
                    <td><?= $row["phw_id"] ?></td>         
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>