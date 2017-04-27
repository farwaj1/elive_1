<?php
require_once ("includes/database.php");
session_start();
$error_message = "";
if (isset($_GET['album_id'])) {
    $album_id = $_GET['album_id'];
}

try {
    $query = 'SELECT * FROM gallery ORDER BY created_at DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $photos = $statement->fetchAll();
    $statement->closeCursor();

    $queryAlbum = "SELECT * FROM album";
    $statement3 = $db->prepare($queryAlbum);
    $statement3->execute();
    $albums = $statement3->fetchAll();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.css.map">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.js.map"></script>
    <script src="h https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js.map"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.min.js.map"></script>        
    <body>
        <?php
        require_once 'basic_code/navigation.php';
        ?>
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Thumbnail Gallery</h1>
                </div>

                <?php foreach ($photos as $photo): ?>
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="image/gallery/<?php echo $photo['directory'] ?>" data-toggle="lightbox" data-gallery="example-gallery">
                            <img src="image/gallery/<?php echo $photo['directory'] ?>" class="img-fluid">
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
            <?php
            require_once 'basic_code/footer.php';
            ?>
    </body>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
</html>
