<?php
require_once("includes/database.php");
session_start();
require_once("includes/restricted_user.php");
$movie_id = filter_input(INPUT_GET, 'movie_id', FILTER_VALIDATE_INT);
$error_message = "";
if (!isset($movie_id)) {
    try {
        $queryLastMovie = "SELECT * FROM movies ORDER BY movie_id DESC LIMIT 1";
        $statement2 = $db->prepare($queryLastMovie);
        $statement2->execute();
        $lastMovie = $statement2->fetch();
        $statement2->closeCursor();
        $movie_id = $lastMovie["movie_id"];
    } catch (Exception $e) {
        $error_message .= $e->getMessage();
        include('includes/db_error.php');
        exit();
    }
}
try {
    $queryAllMovie = "SELECT* FROM movies ORDER BY movie_id";
    $statement = $db->prepare($queryAllMovie);
    $statement->execute();
    $allMovie = $statement->fetchAll();
    $statement->closeCursor();
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

    </head>
    <body>
        <div class="container-fluid">
            <?php include("code/navigation.php") ?>
            <div class="row">
                <div class="col-sm-12" style="text-align: center">
                    <h1>Update Movie Image</h1>         
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-4">
                    <form action="includes/upload_movie_image.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-sm-offset-3 col-sm-1">Movie:</label>
                            <select class="form-control" name="movie_id" id="movie_id" required>
                                <?php foreach ($allMovie as $one) : ?>
                                    <option value="<?php echo  htmlspecialchars($one['movie_id']); ?>"
                                    <?php
                                    if ($one['movie_id'] == $movie_id)
                                        echo "selected";
                                    ?>>
                                                <?php echo  htmlspecialchars($one["title"]); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select image to upload:</label>
                            <input type="file" id = "fileToUpload" name="fileToUpload" >
                            <input style="color: black;" type="submit" id="update_image" value="Upload Image" name="submit">
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <?php include("code/footer.php") ?>
        </div>
    </body>
</html>
