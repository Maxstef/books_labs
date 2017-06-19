<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require '../shared/config.php';
    $conn = connect_to_db();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_GET['id'])){
        $sql = "SELECT * FROM author WHERE id=" . $_GET['id'];
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
                <h2>Author details</h2>
             </div>

            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='row'>
                                <div class='col-xs-6 col-md-3'>
                                    <a href='author_details.php?id=$row[id]'>
                                        <img class='author-photo' src='../img/author_default.jpg' alt='photo'>
                                    </a>
                                </div>
                                <div class='col-xs-6 col-md-8'>
                                    <h3>$row[fname] $row[lname]</h3>
                                    <p>was born - $row[birth_date]</p>
                                </div>
                                <div class='col-xs-12 col-md-1'>
                                    <a class='pull-right' href='books.php?author=$row[id]'>
                                        <button class='btn btn-primary btn-author'>books</button>
                                    </a>
                                </div>
                                <div class='col-xs-12 col-md-12'>
                                    <p class='line-read'>$row[biography]</p>
                                </div>
                                
                                
                              </div>";
                    }
                } else {
                    echo "No authors";
                } 
            ?>
            </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
    </body>
</html>
