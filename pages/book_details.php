<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require '../shared/config.php';
    $conn = connect_to_db();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_GET['id']) && is_loged_in()){
        $sql = "SELECT (SELECT Count(id) FROM user_book WHERE book_id =" . $_GET['id'] . ") AS rate, book.id AS id, book.name AS name, 
        book.description AS description, book.author_id AS author_id, author.fname AS fname, author.lname AS lname,
        (SELECT Count(id) FROM user_book WHERE book_id =" . $_GET['id'] . " AND user_id=" . $_SESSION['id'] . ") AS added
        FROM book INNER JOIN author ON book.author_id = author.id WHERE book.id=" . $_GET['id'];
    } else if(isset($_GET['id'])) {
         $sql = "SELECT (SELECT Count(id) FROM user_book WHERE book_id =" . $_GET['id'] . ") AS rate, book.id AS id, book.name AS name, 
        book.description AS description, book.author_id AS author_id, author.fname AS fname, author.lname AS lname
        FROM book INNER JOIN author ON book.author_id = author.id WHERE book.id=" . $_GET['id'];
    } else {
        header('location: ../');
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
                <h2>Book details</h2>
             </div>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='row'>
                                <div class='col-xs-6 col-md-3'>
                                    <a href='book_details.php?id=$row[id]'>
                                        <img class='book-photo' src='../img/book_icon1.png' alt='photo'>
                                    </a>
                                </div>
                                <div class='col-xs-6 col-md-9'>
                                    <h3>$row[name]</h3>
                                    <a href='author_details.php?id=$row[author_id]'>$row[fname] $row[lname]</a>
                                    <p style='margin-top: 10px'>people added to their favorite: $row[rate]</p>";

                                    if(is_loged_in() && !admin_check() && $row['added']){
                                        echo "<a href='../actions/delete_book_from_my.php?book_id=$row[id]&user_id=$_SESSION[id]&from=book_details'>
                                                <button class='btn btn-danger btn-author'>delete</button>
                                            </a>";
                                    } else if(is_loged_in() && !admin_check()){
                                        echo "<a href='../actions/add_book_to_my.php?book_id=$row[id]&user_id=$_SESSION[id]&from=book_details'>
                                                <button class='btn btn-success btn-author'>add</button>
                                            </a>";
                                    }
                                    echo "
                                </div>
                                <div class='col-xs-12 col-md-12'>
                                    <p class='line-read'>$row[description]</p>
                                </div>
                                
                                
                              </div>";
                    }
                } else {
                    echo "No book";
                } 
            ?>
            </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
    </body>
</html>
