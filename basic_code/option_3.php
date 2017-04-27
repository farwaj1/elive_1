<?php 
require_once ("../includes/database.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$e="";
$error_message = "";
 $user_id = $_SESSION['login_user_id'];
try {
    $queryUser = "SELECT * FROM user WHERE user_id = :user_id";
    $statement1 = $db->prepare($queryUser);
    $statement1->bindValue(":user_id", $user_id);
    $statement1->execute();
    $user = $statement1->fetch();
    $statement1->closeCursor();
} catch (Exception $e) {
    $error_message .= $e->getMessage();
    include('includes/db_error.php');
    exit();
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-10" style="text-align: center">
                    <h1>User</h1>         
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="messageBox" class="col-sm-8" style="text-align: center; ">
                    <?php echo $e ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="col-sm-5">
                        <img  id = "imagePro" class="img-thumbnail" src="image/profile_pic/<?php echo $user['profile_pic'] ?>" width="304" height="236" position="center">
                        <form action="includes/update_profile_picture.php" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <input type="file" id = "fileToUpload" name="fileToUpload">
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user["user_id"] ?>">
                                <button type="submit" class="btn btn-default">Change Profile Picture</button>
                            </div>
                        </form>
                        <div id="picModalBox" class="modal">
                            <span id="closeButton" class="close">&times;</span>
                            <img src="image/profile_pic/<?php echo $user['profile_pic'] ?>" class="modal-content" id="modalImg">
                        </div>

                    </div>

                    <div class="col-sm-5">
                        <?php
                        echo "<p>Username: " . htmlspecialchars($user["username"]) . "</p>";
                        echo "<p>Last Name: " . htmlspecialchars($user["last_name"]) . "</p>";
                        echo "<p>First Name: " . htmlspecialchars($user["first_name"]) . "</p>";
                        echo "<p>Email Address: " . htmlspecialchars($user["email_address"]) . "</p>";
                        echo "<p>Gender: " . htmlspecialchars($user["gender"]) . "</p>";
                        ?>

                        <?php
                        if ($_SESSION['user_status'] == "Admin") {
                            
                        } else {
                            echo '<a href="update_account.php" class="btn btn-info">Manage Account</a><br>';
                            echo '<a href="update_password.php" class="btn btn-info">Reset Password</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>

   


        </div>
    </body>
</html>
