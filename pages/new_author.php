<?php
    require '../shared/config.php';
    if(!is_loged_in() && !admin_check()){
        header('location: ../');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $fname = str_replace("'", '"', $_POST['fname']);
        $lname = str_replace("'", '"', $_POST['lname']);
        $biography = str_replace("'", '"', $_POST['biography']);
        $date = $_POST['date'];
        $conn =  connect_to_db();         
        $sql = "INSERT INTO author (fname, lname, biography, birth_date) VALUES ('$fname', '$lname', '$biography', '$date')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
        }
        header('location: ./authors.php');
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
                <h2>Add new author</h2>
             </div>
            <form action="" method="post" class="login-form">
              <div class="form-group">
                <label for="fname">First name</label>
                <input class="form-control" name="fname" id="fname" placeholder="first name..." required>
              </div>
              <div class="form-group">
                <label for="lname">Last name</label>
                <input class="form-control" name="lname" id="lname" placeholder="last name..." required>
              </div>
              <div class="form-group">
                <label for="password">Date of birth</label>
                <input class="form-control" type="date" name="date" id="date" required>
              </div>
              <div class="form-group">
                <label for="biography">Biography</label>
                <textarea class="form-control" name="biography" id="biography" rows="10" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
        
    </body>
</html>
