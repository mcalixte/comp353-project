<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM C19PHCS.PHF AS PHF WHERE PHF.phf_id = :phf_id; ");
$statement->bindParam(":phf_id", $_GET["phf_id"]);
$statement->execute();

header("Location: .");

?>