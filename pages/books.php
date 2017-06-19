<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require '../shared/config.php';
    $conn = connect_to_db();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_GET['author']) && !is_loged_in()){
        $sql_author = "SELECT * FROM author WHERE id=" . $_GET['author'];
        $sql = "SELECT * FROM book WHERE author_id = " . $_GET['author'] . " ORDER BY name";
        $author = $conn->query($sql_author);
        $author = $author->fetch_assoc();
    } else if(!is_loged_in()) {
        $sql = "SELECT * FROM book ORDER BY name";
    } else if(is_loged_in() && isset($_GET['author'])){
        $sql_author = "SELECT * FROM author WHERE id=" . $_GET['author'];
        $sql = "SELECT book.id AS id, book.name AS name, book.author_id AS author_id, book.description AS description, 
        user_book.user_id AS user_id, user_book.date AS date_add FROM book LEFT JOIN user_book ON book.id = user_book.book_id 
        AND user_book.user_id = $_SESSION[id] WHERE author_id = " . $_GET['author'] . " ORDER BY name";
        $author = $conn->query($sql_author);
        $author = $author->fetch_assoc();
    } else {
        $sql = "SELECT book.id AS id, book.name AS name, book.author_id AS author_id, book.description AS description, 
        user_book.user_id AS user_id, user_book.date AS date_add FROM book LEFT JOIN user_book ON 
        book.id = user_book.book_id AND user_book.user_id = $_SESSION[id] ORDER BY name";
    }
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
                <h2>Books list <?php if(isset($author)){echo " (" . $author['fname'] . " " . $author['lname'] . ")";}?></h2>
                <?php 
                    if(is_loged_in() && admin_check()){
                        echo '<a href="./new_book.php">
                                <button class="add-btn pull-right btn btn-success">add new</button>
                            </a>';
                    }
                ?>
                
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
                                    <p>" . substr($row['description'], 0, 200) . "...</p>";
                                    if(is_loged_in() && !admin_check() && $row['user_id'] == $_SESSION['id']){
                                        echo "<p class='alert alert-warning'>Added in your favorite - $row[date_add]</p>";
                                    }
                                echo "</div>
                                <div class='col-xs-12 col-md-1'>
                                    <a class='pull-right' href='book_details.php?id=$row[id]'>
                                        <button class='btn btn-primary btn-author'>info</button>
                                    </a>
                                    <a class='pull-right' href='author_details.php?id=$row[author_id]'>
                                        <button class='btn btn-secondary btn-author'>author</button>
                                    </a>";
                                    if(is_loged_in() && !admin_check() && $row['user_id'] == $_SESSION['id']){
                                        echo "<a class='pull-right' href='../actions/delete_book_from_my.php?book_id=$row[id]&user_id=$_SESSION[id]&from=books'>
                                                <button class='btn btn-danger btn-author'>delete</button>
                                            </a>";
                                    } else if(is_loged_in() && !admin_check()){
                                        echo "<a class='pull-right' href='../actions/add_book_to_my.php?book_id=$row[id]&user_id=$_SESSION[id]&from=books'>
                                                <button class='btn btn-success btn-author'>add</button>
                                            </a>";
                                    }
                                    echo "</div></div>";
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
