<?php require_once '../database.php';

if (isset($_POST["test_id"])
&&isset($_POST["conducted_on"])
&&isset($_POST["conducted_by"])
&&isset($_POST["conducted_at"])
&&isset($_POST["results"])
&&isset($_POST["test_date"])
&&isset($_POST["result_date"])) {
    $region = $conn->prepare("INSERT INTO Test (test_id, conducted_on, conducted_by, conducted_at, results, test_date, result_date) 
                                            VALUES (1002, 'MCLT81820471', 39, 5, 'POS', '2021-04-14', '2021-04-15');");

    $region->bindParam(':test_id', $_POST["test_id"]);
    $region->bindParam(':conducted_on', $_POST["conducted_on"]);
    $region->bindParam(':conducted_by', $_POST["conducted_by"]);
    $region->bindParam(':conducted_at', $_POST["conducted_at"]);
    $region->bindParam(':results', $_POST["results"]);
    $region->bindParam(':test_date', $_POST["test_date"]);
    $region->bindParam(':result_date', $_POST["result_date"]);

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
    <title>Add Region</title>
</head>

<body>
    <h1>Add Region</h1>
    <form action="./create.php" method="post">
        <label for="test_id">Region Name</label><br>
        <input type="text" name="test_id" id="test_id"> <br>

        <label for="conducted_on">Conducted on</label><br>
        <input type="text" name="conducted_on" id="conducted_on"> <br>

        <label for="conducted_by">Conducted By</label><br>
        <input type="text" name="conducted_by" id="conducted_by"> <br>

        <label for="conducted_at">Conducted At</label><br>
        <input type="text" name="conducted_at" id="conducted_at"> <br>

        <label for="results">Results</label><br>
        <input type="text" name="results" id="results"> <br>

        <label for="test_date">Test Date</label><br>
        <input type="date" name="test_date" id="test_date"> <br>


        <label for="result_date">Result Date</label><br>
        <input type="date" name="result_date" id="result_date"> <br>
        <br/>
        <button type="submit">Add</button>
    </form>
    <a href="./">Back Region list</a>
</body>

</html>