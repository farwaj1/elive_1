<?php

require_once("database.php");
include_once ('validate.php');
session_start();

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$form_errors = array();
$required_fields = array('title', 'content');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

$error_message = "";

if (empty($form_errors)) {
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);

    try {
        $query = "UPDATE post SET title = :title,content = :content, edit_at=:edit_at WHERE post_id = :post_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':post_id', $post_id);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':edit_at', date('c'));
        $statement->execute();
        $statement->closeCursor();
    } catch (Exception $e) {
        $error_message .= $e->getMessage();
        include('db_error.php');
        exit();
    }

} else {
    $str = "";
    foreach ($form_errors as $errors) {
        $str .= $errors . "**\t";
    }
}
echo "done";