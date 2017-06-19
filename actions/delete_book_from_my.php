<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../shared/config.php';
$conn = connect_to_db();

if(!isset($_GET['book_id']) || !isset($_GET['user_id']) || !is_loged_in()){
    header('location: ../');
}

$sql = "DELETE FROM user_book WHERE user_id=$_GET[user_id] AND book_id=$_GET[book_id]";
if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
    die();
}

if($_GET['from'] === 'my_books'){
    header('location: ../pages/my_books.php');
}elseif ($_GET['from'] === 'books'){
    header('location: ../pages/books.php');
} else if($_GET['from'] === 'book_details'){
    header('location: ../pages/book_details.php?id=' . $_GET['book_id']);
}




