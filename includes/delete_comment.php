<?php

require_once("database.php");
$comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
$error_message = "";
$assocArray['success'] = false;
try {
    $queryDelCom = 'DELETE FROM comment WHERE comment_id = :comment_id';
    $statement1 = $db->prepare($queryDelCom);
    $statement1->bindValue(":comment_id", $comment_id);
    $statement1->execute();
    $statement1->closeCursor();
    $assocArray['success'] = true;
} catch (Exception $e) {
    $error_message .= $e->getMessage();
    include('db_error.php');
    exit();
}

echo json_encode($assocArray);
