<?php require_once '../database.php';

if (isset($_GET["address"])) {
    echo $_GET["address"];
$statement = $conn->prepare("SELECT first_name, last_name, dob, medicare_num, phone_num, citizenship, email, postal_code, Relation.father_f_name, Relation.father_l_name, Relation.mother_f_name, Relation.mother_l_name
    FROM $database.Person,
        (SELECT p.child as child, p.parent as father, p.parent_f_name as father_f_name, p.parent_l_name as father_l_name,
        pe.parent as mother, pe.parent_f_name as mother_f_name, pe.parent_l_name as mother_l_name
        FROM
            (SELECT child, parent, relation, first_name as parent_f_name, last_name as parent_l_name FROM $database.Parent, $database.Person Where $database.Parent.parent = $database.Person.medicare_num) p,
            (SELECT child, parent, relation, first_name as parent_f_name, last_name as parent_l_name FROM $database.Parent, $database.Person Where $database.Parent.parent = $database.Person.medicare_num) pe
            WHERE p.child=pe.child
            AND p.relation='Father' AND pe.relation = 'Mother') Relation
        Where $database.Person.medicare_num=Relation.child AND $database.Person.postal_code = :address;");
$statement->bindParam(':address', $_GET["address"]);
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
    <h1>List of Persons</h1>
    <form action="./find.php" method="get">
        <label for="address">Search for person by Address</label><br>
        <input type="text" name="address" id="address"> <br>

        <input type="submit">
        <br>
        <br>
        <br>
    </form>
    <table>
        <thead>
            <tr>
                <td><b>medicare_num</b></td>
                <td><b>first_name</b></td>
                <td><b>last_name</b></td>
                <td><b>phone_num</b></td>
                <td><b>dob</b></td>
                <td><b>citizenship</b></td>
                <td><b>email</b></td>
                <td><b>postal_code</b></td>
                <td><b>fathers first name</b></td>
                <td><b>fathers last name</b></td>
                <td><b>mothers first name</b></td>
                <td><b>mothers last name</b></td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row["medicare_num"] ?></td>
                    <td><?= $row["first_name"] ?></td>
                    <td><?= $row["last_name"] ?></td>
                    <td><?= $row["phone_num"] ?></td>
                    <td><?= $row["dob"] ?></td>
                    <td><?= $row["citizenship"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["postal_code"] ?></td>
                    <td><?= $row["father_f_name"] ?></td>
                    <td><?= $row["father_l_name"] ?></td>
                    <td><?= $row["mother_f_name"] ?></td>
                    <td><?= $row["mother_l_name"] ?></td>
                    
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../">Back to homepage</a>
</body>

</html>