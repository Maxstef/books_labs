<?php
    require '../shared/config.php';
    if(!is_loged_in() && !admin_check()){
        header('location: ../');
    }
    $conn =  connect_to_db();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = str_replace("'", '"', $_POST['name']);
        $description = str_replace("'", '"', $_POST['description']);
        $author = $_POST['author'];
        $sql = "INSERT INTO book (name, description, author_id) VALUES ('$name', '$description', $author)";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die();
        }
        header('location: ./books.php');
    }
    $sql_authors = "SELECT * FROM author ORDER BY fname";
    $result = $conn->query($sql_authors);
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
                <h2>Add new book</h2>
             </div>
            <form action="" method="post" class="login-form">
              <div class="form-group">
                <label for="fname">Name</label>
                <input class="form-control" name="name" id="name" placeholder="name..." required>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="10" required></textarea>
              </div>
              <div class="form-group">
                <label for="author">Author</label>
                <select class="form-control" id="author" name="author">
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=$row[id]>$row[fname] $row[lname]</option>";
                            }
                        } else {
                            echo "No authors";
                        }
                    ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <?php require '../shared/footer.php';?>
        <?php require '../shared/scripts.php';?>
        
    </body>
</html>
