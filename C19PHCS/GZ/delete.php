<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM C19PHCS.groupZone AS GroupZone WHERE Region.gz_name = :gz_name; ");
$statement->bindParam(":gz_name", $_GET["gz_name"]);
$statement->execute();

header("Location: .");

?>