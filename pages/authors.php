<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require '../shared/config.php';
    $conn = connect_to_db();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM author ORDER BY fname";
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
                <h2>Authors</h2>
                <?php 
                    if(is_loged_in() && admin_check()){
                        echo '<a href="./new_author.php">
                                <button class="add-btn pull-right btn btn-success">add new</button>
                            </a>';
                    }
                ?>
             </div>
            <div class="author-list">

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='author-item row'>
                                <div class='col-xs-4 col-md-2'>
                                    <a href='author_details.php?id=$row[id]'>
                                        <img class='author-photo' src='../img/author_default.jpg' alt='photo'>
                                    </a>
                                </div>
                                <div class='col-xs-8 col-md-9'>
                                    <h3>$row[fname] $row[lname]</h3>
                                    <p>was born - $row[birth_date]</p>
                                    <p>" . substr($row['biography'], 0, 200) . "...</p>
                                </div>
                                <div class='col-xs-12 col-md-1'>
                                    <a class='pull-right' href='author_details.php?id=$row[id]'>
                                        <button class='btn btn-secondary btn-author'>info</button>
                                    </a>
                                    <a class='pull-right' href='books.php?author=$row[id]'>
                                        <button class='btn btn-primary btn-author'>books</button>
                                    </a>
                                </div>
                                
                                
                              </div>";
                    }
                } else {
                    echo "No authors";
                } 
            ?>
            </div>
        </div>
        
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
    </body>
</html>
<?php
    $conn->close();
?>
