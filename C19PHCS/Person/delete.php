<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM $database.Person AS Person WHERE Person.medicare_num = :medicare_num;");
$statement->bindParam(":medicare_num", $_GET["medicare_num"]);
$statement->execute();

header("Location: .");

?>