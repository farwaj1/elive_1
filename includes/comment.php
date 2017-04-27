<?php

require_once("database.php");
include_once ('validate.php');
session_start();

$form_errors = array();
$required_fields = array('post_id', 'user_id', 'comment');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));
$fields_to_check_length = array('comment' => 1);
$form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

$assocArray["message"] = "";
$assocArray['success'] = false;
$error_message = "";

if (empty($form_errors)) {
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);

    try {

        $queryAddReview = "INSERT INTO comment (post_id, user_id,comment,created_at) VALUES (:post_id,:user_id, :comment, :time)";
        $statement = $db->prepare($queryAddReview);
        $statement->bindValue(':post_id', $post_id);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':comment', $comment);
        $statement->bindValue(':time', date('c'));
        $statement->execute();
        $statement->closeCursor();
    } catch (Exception $e) {
        $error_message .= $e->getMessage();
        include('db_error.php');
        exit();
    }
    $assocArray['success'] = true;
} else {
    $str = "";
    foreach ($form_errors as $errors) {
        $str .= $errors . "**\t";
    }
    $assocArray["message"] = $str;
    $assocArray['success'] = false;
}

echo json_encode($assocArray);

