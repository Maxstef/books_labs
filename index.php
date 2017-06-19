<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    require './shared/config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require './shared/head.php';?>
    </head>
    <body>
        <?php require './shared/header.php';?>
        <div class="container">
            <div class="page-header">
                <h2>Home</h2>
             </div>
            <div class="image-container">
                <a class="widget-href" href="./pages/books.php">
                    <div class="widget widget-1 visible-sm-block visible-md-block visible-lg-block">
                        <h3>Books</h3>
                        <p>Look at our collection of books</p>
                    </div>
                </a>
                <a class="widget-href" href="./pages/authors.php">
                    <div class="widget widget-2 visible-sm-block visible-md-block visible-lg-block">
                        <h3>Authors</h3>
                        <p>List of authors and their works</p>
                    </div>
                </a>

                    <?php
                        if(is_loged_in()){
                            echo "<a class='widget-href' href='./pages/my_books.php'>
                            <div class='widget widget-3 visible-sm-block visible-md-block visible-lg-block'>
                            <h3>My books</h3><p>See again books saved earlier in my favorite</p></div></a>";
                        } else {
                            echo "<a class='widget-href' href='./pages/login.php'>
                            <div class='widget widget-3 visible-sm-block visible-md-block visible-lg-block'>
                            <h3>Login</h3><p>Login and add your favorites books in your list.</p></div></a>";
                        }
                    ?>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mi lorem, congue ac ligula a, pretium
              pharetra erat. Nam interdum a erat non vehicula. Morbi eu ipsum nec ligula maximus commodo nec laoreet
              odio. Integer vehicula enim turpis. Vestibulum nec lorem rutrum, faucibus erat et, sagittis tellus. Proin
              mollis, libero sed molestie mollis, felis tortor consectetur enim, id viverra dui erat et dolor. Aliquam
              tempus leo justo, eget rutrum urna euismod id. Proin purus dolor, porta at molestie in, mattis eu ipsum.
              Donec in eros lectus. Fusce nec nisi nec dui luctus varius. In ullamcorper scelerisque libero vitae
              dapibus.</p>
            <p>Duis ultricies facilisis aliquet. Pellentesque cursus nulla quis ante elementum, sed convallis arcu
              eleifend. Etiam quis aliquam quam. Phasellus tempor et ligula tempor suscipit. Vivamus quis risus
              venenatis, egestas velit ac, viverra odio. Cras massa lacus, posuere semper porttitor in, euismod quis
              magna. Ut tincidunt mi id augue dapibus, ut tempor justo aliquam. Cras sed arcu metus. Aliquam quis tortor
              at sapien imperdiet volutpat id viverra erat. Aenean eget neque eget risus euismod congue. Maecenas id est
              at quam vehicula rutrum varius at risus.</p>
            <p>Donec lobortis erat porta turpis mollis hendrerit. Nullam varius ante id molestie egestas. Ut id odio
              malesuada, eleifend dui non, sodales justo. Praesent lobortis velit purus, a malesuada lectus lobortis
              nec. Donec bibendum sagittis arcu vel volutpat. Vivamus at enim dapibus, tristique tellus in, iaculis
              risus. Quisque consequat mauris ac risus fermentum, sed pulvinar nisi venenatis. In hac habitasse platea
              dictumst. Donec eu massa at libero blandit tristique. Nulla ultricies, sem sollicitudin vulputate ornare,
              magna magna lobortis nibh, sit amet eleifend odio ipsum id elit. Nulla scelerisque iaculis ligula, quis
              dignissim risus consectetur non. Aenean euismod neque eu quam tincidunt ornare. Aliquam at porttitor
              purus, a pulvinar urna.</p>
        </div>
        <?php require './shared/footer.php';?>
        <?php require './shared/scripts.php';?>
    </body>
</html>
