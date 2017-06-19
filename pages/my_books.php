<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require '../shared/config.php';
    if(!is_loged_in()){
        header('location: ../index.php');
    }
    $conn = connect_to_db();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT book.id AS id, book.name AS name, book.description AS description, book.author_id AS author_id, user_book.user_id AS user_id,
    user_book.date AS date FROM book INNER JOIN user_book ON book.id = user_book.book_id AND user_book.user_id = $_SESSION[id]";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require '../shared/head.php';?>
    </head>
    <body>
        <?php require '../shared/header.php';?>
        <div class="container">
            <div class="page-header">
                <h2>My books list</h2>
             </div>
            <div class="books-list">

            <?php
                if ($result->num_rows > 0) {
                    $index = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='book-item row'>
                                <div class='col-xs-4 col-md-2'>
                                    <a href='book_details.php?id=$row[id]'>
                                        <img class='book-photo' src='../img/book_icon" . $index%3 . ".png' alt='photo'>
                                    </a>
                                </div>
                                <div class='col-xs-8 col-md-9'>
                                    <h3>$row[name]</h3>
                                    <p>added - $row[date]</p>
                                    <p>" . substr($row['description'], 0, 200) . "...</p>
                                </div>
                                <div class='col-xs-12 col-md-1'>
                                    <a class='pull-right' href='book_details.php?id=$row[id]'>
                                        <button class='btn btn-primary btn-author'>info</button>
                                    </a>
                                    <a class='pull-right' href='author_details.php?id=$row[author_id]'>
                                        <button class='btn btn-secondary btn-author'>author</button>
                                    </a>
                                    <a class='pull-right' href='../actions/delete_book_from_my.php?book_id=$row[id]&user_id=$_SESSION[id]&from=my_books'>
                                                <button class='btn btn-danger btn-author'>delete</button>
                                    </a>
                                    </div>
                                    </div>";
                              $index++;
                    }
                } else {
                    echo "No books";
                } 
            ?>
            </div>
        </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
    </body>
</html>
