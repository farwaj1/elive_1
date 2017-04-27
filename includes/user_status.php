<?php

if (isset($_SESSION['login_user'], $_SESSION['user_status']) && $_SESSION['user_status'] == "Admin") {
    echo "<ul class='nav navbar-nav navbar-right'>";
    echo "<li><a href='./admin.php' ><i class='fa fa-user-circle' aria-hidden='true'></i> Welcome back, " . $_SESSION['user_status'] . " " . $_SESSION['login_user'] . "</a></li>";
    echo "<li><a href='./admin.php' ><i class='fa fa-id-card' aria-hidden='true'></i>Control Panel</a></li>";
    echo "<li><a href='includes/signout.php'><i class='fa fa-sign-out' aria-hidden='true'></i>Log Out</a></li>";
    echo "</ul>";
} else if (isset($_SESSION['login_user'], $_SESSION['user_status']) && $_SESSION['user_status'] == "User") {
    echo "<ul class='nav navbar-nav navbar-right'>";
    echo "<li><a href='./user_page.php' ><i class='fa fa-user' aria-hidden='true'></i>PROFILE</</a></li>";
    echo "<li><a href='includes/signout.php'><i class='fa fa-sign-out' aria-hidden='true'></i>Log Out</a></li>";
    echo "</ul>";
} else {

    echo "<ul class='nav navbar-nav navbar-right'>";
    echo "<li><a href='./create_post.php' ><i class='fa fa-user' aria-hidden='true'></i>Create Post</a></li>";
    echo "</ul>";
}