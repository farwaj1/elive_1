<?php
require_once ("includes/database.php");
session_start();
$error_message = "";

$post_id = $_GET['post_id'];

try {
    $query = 'SELECT * FROM post WHERE post_id= :post_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":post_id", $post_id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();

    $queryReview = "SELECT * FROM comment c, user u WHERE c.post_id = :post_id AND c.user_id = u.user_id";
    $statement3 = $db->prepare($queryReview);
    $statement3->bindValue(":post_id", $post_id);
    $statement3->execute();
    $reviews = $statement3->fetchAll();
    $statement3->closeCursor();
} catch (Exception $e) {
    $error_message .= $e->getMessage();
    include('includes/db_error.php');
    exit();
}
if (isset($_SESSION['login_user_id'])) {
    try {
        $queryUser = 'SELECT * FROM user WHERE user_id= :user_id';
        $statement6 = $db->prepare($queryUser);
        $statement6->bindValue(":user_id", $_SESSION['login_user_id']);
        $statement6->execute();
        $user = $statement6->fetch();
        $statement6->closeCursor();
    } catch (Exception $e) {
        $error_message .= $e->getMessage();
        include('includes/db_error.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    require_once 'basic_code/head.php';
    ?>
    <script src="js/post.js" type="text/javascript"></script>
    <!--<link href="css/user_page.css" rel="stylesheet" type="text/css"/>-->
    <body>
        <?php
        require_once 'basic_code/navigation.php';
        ?>
        <h1><?php echo $result['title']; ?></h1>
        <p><?php echo $result['content']; ?></p>
        <?php foreach ($reviews as $review) : ?>
            <div class="row">
                <div id="comment"  class="col-sm-offset-1 col-sm-10">
                    <div class="row">
                        <div class="col-sm-offset-1 col-sm-2">
                            <?php echo $review["username"] . "&nbsp;" ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset-1 col-sm-2">
                            <img src="image/profile_pic/<?php echo $review["profile_pic"] ?>" class="img-circle" width="147" height="118" position="center">
                        </div>
                        <div class="col-sm-offset-1 col-sm-4" >
                            <?php echo $review["comment"] . "&nbsp;" ?>
                        </div>
                        <?php
                        if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == "Admin" || isset($_SESSION['user_status']) && $review["username"] == $_SESSION["login_user"]) {
                            echo '<div class="col-sm-2">';
                            echo '<form action="includes/delete_comment.php" method="post">';
                            echo '<div id="output6"></div>';
                            echo '<div class="form-group">';
                            echo '<input type="hidden" name="comment_id" class="comment_id" value ="' . $review['comment_id'] . '">';
                            echo '<button  type="button" class="btn btn-default btn_delete_review"><i class="fa fa-times" aria-hidden="true"></i></button>';
                            echo '</div>';
                            echo '</form>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <br>
                </div>
            </div>
        <?php endforeach; ?>
        <?php require_once("basic_code/review.php") ?>


    </body>
</html>
