<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM C19PHCS.Region AS Region WHERE Region.region_name = :region_name; ");
$statement->bindParam(":region_name", $_GET["region_name"]);
$statement->execute();

header("Location: .");

?>