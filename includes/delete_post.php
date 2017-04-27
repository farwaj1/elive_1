<?php

require_once("database.php");
include_once ('validate.php');
session_start();

$form_errors = array();
$required_fields = array('post_id');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

$assocArray["message"] = "";
$assocArray['success'] = false;
if (empty($form_errors)) {

    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT, FILTER_SANITIZE_STRING);

    try {
        $queryDelPost= 'DELETE FROM post WHERE post_id = :post_id';
        $statement1 = $db->prepare($queryDelPost);
        $statement1->bindValue(":post_id", $post_id);
        $statement1->execute();
        $statement1->closeCursor();
    } catch (Exception $e) {
        $assocArray["message"] .= $e->getMessage();
      
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
