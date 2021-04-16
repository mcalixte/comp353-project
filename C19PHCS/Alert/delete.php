<?php require_once '../database.php';

$statement = $conn->prepare("DELETE FROM comp353.books WHERE books.book_id = :book_id; ");
$statement->bindParam(":book_id", $_GET["book_id"]);
$statement->execute();

header("Location: .");

?>