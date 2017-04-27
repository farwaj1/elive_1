<?php

require_once("database.php");
include_once ('validate.php');
session_start();
$form_errors = array();
$required_fields = array('user_id', 'password1', 'password2');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));
$fields_to_check_length = array('password1' => 8);
$form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
$form_errors = array_merge($form_errors, valid_2_password($_POST));

$error_message = "";
$assocArray["message"] = "";
$assocArray['success'] = false;
$assocArray["isAdmin"] = false;
$assocArray["exception"] = "";
if (empty($form_errors)) {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT, FILTER_SANITIZE_NUMBER_INT);
    $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

    try {
        $query = "UPDATE user_information SET password = :password WHERE user_id = :user_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $hashed_password);
         $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (Exception $e) {
       $assocArray["exception"] = $e->getMessage();
       
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
if ($_SESSION['user_status'] == "Admin") {
    $assocArray["isAdmin"] = true;
} else {
    $assocArray["isAdmin"] = false;
}

echo json_encode($assocArray);
