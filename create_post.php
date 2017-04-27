<?php
require_once ("includes/database.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["login_user"])) {
    header("Location: login_register.php");
    exit();
}

$edited_post_id = "";
if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $queryEditedPost = "SELECT * FROM post WHERE post_id = :post_id";
    $statement1 = $db->prepare($queryEditedPost);
    $statement1->bindValue(":post_id", $post_id);
    $statement1->execute();
    $edited_post = $statement1->fetch();
    $statement1->closeCursor();
    $edited_post_id = $edited_post['post_id'];
}
?>
<!DOCTYPE html>
<html>
    <?php
    require_once 'basic_code/head.php';
    ?>
    <link href="css/create_post.css" rel="stylesheet" type="text/css"/>
    <body>
        <?php
        require_once 'basic_code/navigation.php';
        ?>


        <div class="container">
            <form id="create_post_form" method='post' action="includes/create_post.php">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group ">

                            <input type="text" class="form-control" placeholder="title" value="<?php
                            if (strcasecmp($edited_post_id, "")) {
                                echo $edited_post['title'];
                            }
                            ?>" id="title" name="title">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">

                        <div class="form-group">
                            <textarea   data-autoresize rows="25"class="form-control" placeholder="type here..." name="content" id="content" ><?php
                                if (strcasecmp($edited_post_id, "")) {
                                    echo $edited_post['content'];
                                }
                                ?></textarea>
                        </div>
                        <input type="hidden" value="" id="status" name="status">
                        <input type="hidden" value="<?php echo $edited_post_id ?>"  name="post_id" id="post_id">
                        <?php
                        if ($edited_post_id == "") {
                            echo '<button type="button" id="btn-save-draft"class="btn btn-default">Save as Draft</button>';
                            echo '<button type="button" id="btn-publish"class="btn btn-default">Publish</button>';
                        } else {

                            echo '<button type="button" id="btn-save"class="btn btn-default">Save</button>';
                        }
                        ?>

                    </div>
                </div>
            </form>



        </div>

    </body>
    <script src="js/create_post.js" type="text/javascript"></script>

</html>

