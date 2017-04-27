<?php
if (!isset($error_message)) {
    $error_message = "";
}
?>
<html>
    <head>
        <?php
        require_once 'basic_code/head.php';
        ?>
        <script src="https://use.fontawesome.com/487ba7c19c.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Architects+Daughter|Happy+Monkey|Lobster|Lobster+Two|Unkempt" rel="stylesheet">
        <link href="./css/general.css" rel="stylesheet" type="text/css"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="messageBox" style="font-size: 300%; text-align: center;" class="col-sm-12">
                    <?php echo $error_message ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-3 col-sm-3">
                    Elive Ireland
                </div>
                <div class="col-sm-3">
                    &COPY; copyright <?php echo date("Y"); ?>
                </div>
            </div>

        </div>
    </body>
</html>
