<?php
require_once ("includes/database.php");
session_start();
$error_message = "";

try {
$query = 'SELECT * FROM post WHERE user_id= :user_id ORDER BY created_at DESC';
$statement = $db->prepare($query);
$statement->bindValue(":user_id", $_SESSION['login_user_id']);
$statement->execute();
$result = $statement->fetchAll();
$statement->closeCursor();


} catch (Exception $e) {
$error_message .= $e->getMessage();
include('includes/db_error.php');
exit();
}
?>

<html>
    <?php
    require_once 'basic_code/head.php';
    ?>
     <script src="js/home.js" type="text/javascript"></script>
      <link href="css/home.css" rel="stylesheet" type="text/css"/>
    <body>
        <?php
        require_once 'basic_code/navigation.php';
        ?>         
        <div class="container">

            <div class="row">
                <div class="col-md-8">

                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>
                    <?php foreach($result as $post): ?>
                    <h2>
                        <a href="#"><?php echo $post['title'] ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="user.php"><?php
                            $query1 = 'SELECT * FROM user u, post p WHERE p.post_id=:post_id AND u.user_id=p.user_id ';
                            $statement1 = $db->prepare($query1);
                            $statement1->bindValue(":post_id", $post['post_id']);
                            $statement1->execute();
                            $author = $statement1->fetch();
                            $statement1->closeCursor();
                            $author_name = $author['username'];
                            echo $author_name;
                            ?>
                        </a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php $post['created_at'] ?></p>
                    <hr>
                    <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                    <hr>
                    <p class="content"><?php echo $post['content'] ?></p>
                    <input type="hidden" value="<?php echo $post['post_id']?>" id="post_id">
                    <hr>
                    <?php endforeach; ?>

                    <!-- Pager -->
                    <ul class="pager">
                        <li class="previous">
                            <a href="#">&larr; Older</a>
                        </li>
                        <li class="next">
                            <a href="#">Newer &rarr;</a>
                        </li>
                    </ul>

                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-md-4">

                    <!-- Blog Search Well -->
                    <div class="well">
                        <h4>Blog Search</h4>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                        <!-- /.input-group -->
                    </div>

                    <!-- Blog Categories Well -->
                    <div class="well">
                        <h4>Blog Categories</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                    <li><a href="#">Category Name</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-lg-6 -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <!-- Side Widget Well -->
                    <div class="well">
                        <h4>Side Widget Well</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                    </div>

                </div>

            </div>
            <!-- /.row -->

            <hr>


            <?php
            require_once 'basic_code/footer.php';
            ?>

        </div>
    </body>
</html>
