<?php
    require '../shared/config.php';
    if(is_loged_in()){
        header('location: ../');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conn = connect_to_db();         
        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($row['username'] == $username && $row['password'] == $password){         
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['id'] = $row['id'];
                }
            }
        }
        if(is_loged_in()){
            header('location: ../');
        } else {
            $status = 'There are no user with this username or the password is wrong';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require '../shared/head.php';?>
    </head>
    <body>
        <?php require '../shared/header.php';?>

        <div class="container login-form-container">
            <form action="" method="post" class="login-form">
              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" name="username" id="username" placeholder="username...">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="password...">
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <p><?php if(isset($status)){ echo "<span class='alert alert-danger' role='alert'>$status</span>";}?></p>
        </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
        
    </body>
</html>
