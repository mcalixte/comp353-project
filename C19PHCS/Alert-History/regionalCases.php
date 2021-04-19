<?php require_once '../database.php';

if (isset($_GET["start_date"]) && isset($_GET["end_date"])) {
    
    $statement = $conn->prepare("SELECT $database.City.region_name,
        Count(case Test.results when 'POS' then 1 else null end) as positive_cases,
        Count(case Test.results when 'NEG' then 1 else null end) as negative_cases
        FROM $database.Postal_Code, $database.City, $database.Person, $database.Test
        WHERE $database.Postal_Code.city_name = $database.City.city_name
        AND $database.Person.postal_code = $database.Postal_Code.postal_code
        AND $database.Test.conducted_on = $database.Person.medicare_num
        AND $database.Test.result_date Between :start_date AND :end_date
        GROUP BY $database.City.region_name;");

    $statement->bindParam(":start_date", $_GET["start_date"]);
    $statement->bindParam(":end_date", $_GET["end_date"]);
    $statement->execute();

    $statement2 = $conn->prepare("SELECT * FROM $database.Alert_History AS Alert_History WHERE Alert_History.date_issued BETWEEN ${start_date} AND ${end_date};");
    $statement2->bindParam(":start_date", $_GET["start_date"]);
    $statement2->bindParam(":end_date", $_GET["end_date"]);
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
    <h1>List of Messages</h1>
    <form action="./regionalCases.php" method="get">
        <label for="start_date">Start Date</label><br>
        <input type="date" name="start_date" id="start_date"> <br>

        <label for="end_date">End Date</label><br>
        <input type="date" name="end_date" id="end_date"> <br>

        <input type="submit">
        <br>
        <br>
        <br>
    </form>
    <table>
        <thead>
            <tr>
                <td>region_name</td>
                <td>positive_cases</td>
                <td>negative_cases</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["region_name"] ?></td>
                    <td><?= $row["positive_cases"] ?></td>
                    <td><?= $row["negative_cases"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br/>
    <br/>
    <br/>
    <br/>
    <table>
        <thead>
            <tr>
                <td>region_name</td>
                <td>alert_level</td>
                <td>date_issued</td>
                <td>is_active</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement2->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["region_name"] ?></td>
                    <td><?= $row["alert_level"] ?></td>
                    <td><?= $row["date_issued"] ?></td>
                    <td><?= $row["is_active"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>