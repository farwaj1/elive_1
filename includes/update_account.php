<?php
require_once("includes/database.php");
session_start();
$error_message = "";
if (!isset($_SESSION["login_user"])) {
    $e = "**Please Log in to have further action**";
    include("./index.php");
    exit();
}

if ($_SESSION["user_status"] == "User") {
    $user_id = $_SESSION['login_user_id'];
} else {
    $user_id = filter_input(INPUT_POST, "user_id", FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
}
try {
    $queryUserDetails = "SELECT * FROM user_information WHERE user_id = :user_id";
    $statement2 = $db->prepare($queryUserDetails);
    $statement2->bindValue(":user_id", $user_id);
    $statement2->execute();
    $edit_user = $statement2->fetch();
    $statement2->closeCursor();

    $queryAllUser = "SELECT * FROM user_information";
    $statement3 = $db->prepare($queryAllUser);
    $statement3->execute();
    $all_user = $statement3->fetchALl();
    $statement3->closeCursor();
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
        <?php include("code/head.php") ?>
        <script src="js/update_account.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include("code/navigation.php") ?>
            <div class="row">
                <div class="col-sm-12" style="text-align: center">
                    <h1>Update Account Form</h1>         
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="output"></div>
                    <form id='update_account' class="form-horizontal" >
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b>Username: </b></label>
                            <div class="col-sm-2">

                                <select class="form-control" name="user_id" id="user_id" required>
                                    <?php
                                    if ($_SESSION["user_status"] == "Admin") {
                                        include_once 'code/admin_update_acc.php';
                                    } else {
                                        include_once 'code/user_update_acc.php';
                                    }
                                    ?>
                                </select>
                                <span class="error"></span>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b>Email Address</b></label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id = "email_address" name = "email_address" value="<?php echo  htmlspecialchars($edit_user["email_address"]) ?>"  placeholder="Email Address" required>
                                <span class="error"></span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b>Full Name</b></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id = "last_name" name = "last_name" value="<?php echo  htmlspecialchars($edit_user["last_name"]) ?>" placeholder="Last Name" required>
                                <span class="error"></span>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id = "first_name" name = "first_name" value="<?php echo  htmlspecialchars($edit_user["first_name"]) ?>" placeholder="First Name" required>
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b>Gender</b></label>
                            <div class="col-sm-2">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="male" selected="<?php
                                    if ($edit_user["gender"] == "male") {
                                        echo "selected";
                                    }
                                    ?>">Male</option>
                                    <option value="female" selected="<?php
                                    if ($edit_user["gender"] == "female") {
                                        echo "selected";
                                    }
                                    ?>">Female</option>
                                </select>   
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-offset-5 col-sm-1">
                                    <button id="update" class="btn btn-default">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php include("code/footer.php") ?>
        </div>
    </body>
</html>
