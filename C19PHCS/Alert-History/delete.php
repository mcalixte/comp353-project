<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM $database.Alert_History WHERE Alert_History.region_name = :region_name 
                                    AND Alert_History.alert_level = :alert_level 
                                    AND Alert_History.date_issued = :date_issued");
                                    
$statement->bindParam(":region_name", $_GET["region_name"]);
$statement->bindParam(":alert_level", $_GET["alert_level"]);
$statement->bindParam(":date_issued", $_GET["date_issued"]);
$statement->execute();

header("Location: .");

?>