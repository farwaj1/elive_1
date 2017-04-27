<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
    <?php
    require_once 'basic_code/head.php';
    ?>
    <link href="css/user_page.css" rel="stylesheet" type="text/css"/>
    <body>
        <?php
        require_once 'basic_code/navigation.php';
        ?>
        <div class="container">
            <div class="row">
                <div class='col-sm-2'>
                    <ul style="list-style-type:none">
                        <li> <span style="cursor:pointer" id="s_1"><i class="fa fa-caret-down" aria-hidden="true" id='change'></i>Post</span>
                            <ul id="sub-menu-1" style="list-style-type:disc">
                                <li><span style="cursor:pointer" id="all">All</span></li>
                                <li><span style="cursor:pointer" id="publish">Published</span></li>
                                <li><span style="cursor:pointer" id="draft">Draft</span></li>
                            </ul>
                        </li>
                        <li> <span style="cursor:pointer" id="s_2"><i class="fa fa-caret-right" aria-hidden="true"></i>Comment</span></li>
                        <li>  <span style="cursor:pointer" id="s_3"><i class="fa fa-caret-right" aria-hidden="true"></i>Setting</span></li>
                    </ul>


                </div>
                <div class='col-sm-10'>
                    <div id='display_option'>

                    </div>

                </div>

            </div>


        </div>
        <?php require_once 'basic_code/footer.php'; ?>


    </body>
    <script src="js/user_page.js" type="text/javascript"></script>

</html>
