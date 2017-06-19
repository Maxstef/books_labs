<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require '../shared/config.php';
    if(!admin_check()){
        header('location: ../index.php');
    }
    $conn =  connect_to_db();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM user ORDER BY username";
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
                <h2>Users</h2>
                <a href="./new_user.php">
                    <button class="add-btn pull-right btn btn-success">add new</button>
                </a>
             </div>
            <div class="user-list">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='book-item row'>
                            username - $row[username]<br>
                            email - $row[email]
                                </div>";
                    }
                } else {
                    echo "No users";
                } 
            ?>
                </div>
        </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
    </body>
</html>
