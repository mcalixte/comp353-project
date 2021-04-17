<?php require_once '../database.php';

$statement = $conn->prepare("SELECT * FROM comp353.books AS book WHERE book.book_id = :book_id");
$statement->bindParam(":book_id", $_GET["book_id"]);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_ASSOC);

if (
    isset($_POST["book_title"])
    && isset($_POST["publish_date"])
    && isset($_POST["price"])
    && isset($_POST["book_id"])
) {
    $statement = $conn->prepare("UPDATE comp353.books SET  book_title=:book_title,
                                    publish_date = :publish_date,
                                    price = :price
                                    WHERE book_id = :book_id;");

    $statement->bindParam(':book_title', $_POST["book_title"]);
    $statement->bindParam(':publish_date', $_POST["publish_date"]);
    $statement->bindParam(':price', $_POST["price"]);
    $statement->bindParam(':book_id', $_POST["book_id"]);

    if ($statement->execute()){
        header("Location: .");
    } else {
        header("Location: ./edit.php?book_id=".$_POST["book_id"]);
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>

<body>
    <h1>Edit Book</h1>
    <form action="./edit.php" method="post">
        <label for="book_title">Title</label><br>
        <input type="text" name="book_title" id="book_title" value="<?= $book["book_title"] ?>"> <br>
        <label for="publish_date">Publish Date</label><br>
        <input type="date" name="publish_date" id="publish_date" value="<?= $book["publish_date"] ?>"> <br>
        <label for="price">Price</label><br>
        <input type="number" name="price" id="price" value="<?= $book["price"] ?>"> <br>
        <input type="hidden" name="book_id" id="book_id" value="<?= $book["book_id"] ?>"> <br>
        <button type="submit">Update</button>
    </form>
    <a href="./">Back to list</a>
</body>

</html>