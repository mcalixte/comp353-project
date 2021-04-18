<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM $database.Recommendation WHERE Recommendation.id = :id; ");
$statement->bindParam(":id", $_GET["id"]);
$statement->execute();

header("Location: .");

?>