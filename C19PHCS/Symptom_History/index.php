<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM $database.Symptom_history AS Symptom_history");
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
    <h1>List of Symptoms per person</h1>
    <table>
        <thead>
            <tr>
                <td>date_time</td>
                <td>person</td>
                <td>fever</td>
                <td>cough</td>
                <td>breath_difficulty</td>
                <td>taste_loss</td>
                <td>nausea</td>
                <td>stomach_aches</td>
                <td>vomitting</td>
                <td>headache</td>
                <td>muscle_pain</td>
                <td>diarrhea</td>
                <td>sore_throat</td>
                <td>other</td>
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
                    <td>
                        <a href="./show.php?person_medicare_num=<?= $row["person"] ?>">Show Person</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>