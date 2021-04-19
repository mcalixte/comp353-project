<?php require_once '../database.php';


    $statement = $conn->prepare("SELECT * FROM Symptom_history AS SH
    WHERE SH.person = :person
    AND SH.date_time >= :date_time;");

    $statement->bindParam(":person", $_GET["person"]);
    $statement->bindParam(":date_time", $_GET["date_time"]);
    $statement->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom History</title>
</head>

<body>
    <h1>Symptom History</h1>
    <form action="./person.php" method="get">
        <label for="person">Person medicare ID</label><br>
        <input type="text" name="person" id="person" value="<?= $groupzone["person"] ?>"> <br>

        <label for="date_time">Result Date</label><br>
        <input type="date" name="date_time" id="date_time" value="<?= $groupzone["date_time"] ?>"> <br>

        <input type="submit">
        <br>
        <br>
        <br>
    </form>
    <div>
    <table>
        <thead>
            <tr>
                <td><b>date_time</b></td>
                <td><b>person</b></td>
                <td><b>fever</b></td>
                <td><b>cough</b></td>
                <td><b>breath_difficulty</b></td>
                <td><b>taste_loss</b></td>
                <td><b>nausea</b></td>
                <td><b>stomach_aches</b></td>
                <td><b>vomitting</b></td>
                <td><b>headache</b></td>
                <td><b>muscle_pain</b></td>
                <td><b>diarrhea</b></td>
                <td><b>sore_throat</b></td>
                <td><b>other</b></td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["date_time"] ?></td>
                    <td><?= $row["person"] ?></td>
                    <td><?= $row["fever"] ?></td>
                    <td><?= $row["cough"] ?></td>
                    <td><?= $row["breath_difficulty"] ?></td>
                    <td><?= $row["taste_loss"] ?></td>
                    <td><?= $row["nausea"] ?></td>
                    <td><?= $row["stomach_aches"] ?></td>
                    <td><?= $row["vomitting"] ?></td>
                    <td><?= $row["headache"] ?></td>
                    <td><?= $row["muscle_pain"] ?></td>
                    <td><?= $row["diarrhea"] ?></td>
                    <td><?= $row["sore_throat"] ?></td>
                    <td><?= $row["other"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>    
    <a href="./">Back to GroupZone list</a>
</body>

</html>