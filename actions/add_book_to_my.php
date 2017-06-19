<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
require '../shared/config.php';
$conn = connect_to_db();

if(!isset($_GET['book_id']) || !isset($_GET['user_id']) || !is_loged_in()){
    header('location: ../');
}

$sql = "INSERT INTO user_book (date, user_id, book_id) VALUES (now(), $_GET[user_id], $_GET[book_id])";
if ($conn->query($sql) === FALSE) {
    if (strpos($conn->error, 'Duplicate entry') !== false) {
        header('location: ../');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }
}

if($_GET['from'] === 'books'){
    header('location: ../pages/books.php');
} else if($_GET['from'] === 'book_details'){
    header('location: ../pages/book_details.php?id=' . $_GET['book_id']);
}




