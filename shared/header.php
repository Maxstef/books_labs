<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
?>
<header>
    <nav class="navbar navbar-inverse">
      
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../"><img src="../img/logo.png" alt="Brand"></a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li <?php if($_SERVER['REQUEST_URI'] == '/'){echo 'class="active"';}?>><a href="../">Home</a></li>
              <li <?php if($_SERVER['REQUEST_URI'] == '/pages/books.php'){echo 'class="active"';}?>><a href="../pages/books.php">Books</a></li>
              <li <?php if($_SERVER['REQUEST_URI'] == '/pages/authors.php'){echo 'class="active"';}?>><a href="../pages/authors.php">Authors</a></li>
              <?php if(is_loged_in() && !admin_check()  && $_SERVER['REQUEST_URI'] == '/pages/my_books.php'){
                        echo "<li class='active'><a href='../pages/my_books.php'>My books</a></li>";
                    } else if(is_loged_in() && !admin_check()){
                        echo "<li><a href='../pages/my_books.php'>My books</a></li>";
                    }?>
              <?php if(is_loged_in() && admin_check() && $_SERVER['REQUEST_URI'] == '/pages/users.php'){
                        echo "<li class='active'><a href='../pages/users.php'>Users</a></li>";
                    } else if(is_loged_in() && admin_check()){
                        echo "<li><a href='../pages/users.php'>Users</a></li>";
                    }?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php if(is_loged_in()){
                        echo $_SESSION['username'];
                    } else {
                        echo "Guest";
                    }?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php if(is_loged_in()){
                        echo "<li><a href='../actions/logout.php'>Logout</a></li>";
                    } else {
                        echo "<li><a href='../pages/login.php'>Login</a></li>";
                    }?>
                </ul>
              </li>
          </ul>
        </div>
    </nav>
</header>
