<?php
    require '../shared/config.php';
    if(!is_loged_in() && !admin_check()){
        header('location: ../');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $conn =  connect_to_db();         
        $sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
        }
        header('location: ./users.php');
    }
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
                <h2>Add new user</h2>
             </div>
            <form action="" method="post" class="login-form">
              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" name="username" id="username" placeholder="username..." required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="email..." required>
              </div>
                <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="password..." required>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
        
    </body>
</html>
