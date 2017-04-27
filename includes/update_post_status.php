<?php

require_once("database.php");
include_once ('validate.php');
session_start();

$form_errors = array();
$required_fields = array('post_id');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));
$error_message = "";
$assocArray["message"] = "";
$assocArray['success'] = false;
if (empty($form_errors)) {
$post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

 try {
        $query = "UPDATE post SET status = :status WHERE post_id = :post_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':post_id', $post_id);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $statement->closeCursor();
    } catch (Exception $e) {
        $error_message .= $e->getMessage();
        include('db_error.php');
        exit();
    }
    $assocArray['success'] = true;
    $assocArray['status'] = $status;
}else {
    $str = "";
    foreach ($form_errors as $errors) {
        $str .= $errors . "**\t";
    }
    $assocArray["message"] = $str;
    $assocArray['success'] = false;
}

echo json_encode($assocArray);
    