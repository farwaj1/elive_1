<?php

require_once("database.php");
include_once ('validate.php');

$form_errors = array();
$required_fields = array('username', 'password');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));
$fields_to_check_length = array('username' => 3, 'password' => 8);
$form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
$assocArray['admin'] = "";
$error_message = "";
if (empty($form_errors)) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $assocArray = array();
    $assocArray['message'] = "";
    $assocArray['admin'] = false;
    try {
        $queryUser = "SELECT * FROM user WHERE username = :username ";
        $statement1 = $db->prepare($queryUser);
        $statement1->bindValue(":username", $username);
        $statement1->execute();
        $result = $statement1->fetch();
        $statement1->closeCursor();
    } catch (Exception $e) {
        $error_message .= $e->getMessage();
        include('db_error.php');
        exit();
    }

    if (isset($result['username'])) {
        $assocArray['m2'] = $result;
        if (!password_verify($password, $result['password'])) {
            $assocArray['message'] = "Password incorrect";
        } else {
            session_start();
            $_SESSION['profile_pic'] = $result['profile_pic'];
            $_SESSION['login_user_id'] = $result['user_id'];
            $_SESSION['login_user'] = $username;
            $_SESSION['user_status'] = $result['isAdmin'];
            if ($result['isAdmin'] == "Admin") {
                $assocArray['admin'] = true;
            } else if ($result['isAdmin'] == "User") {
                $assocArray['admin'] = false;
            }
        }
    } else {
        $assocArray['message'] = "*Sorry the user doesn't exist*";
    }
} else {
    $str = "";
    foreach ($form_errors as $errors) {
        $str .= $errors . "\n";
    }
    $assocArray["message"] = $str;
}

echo json_encode($assocArray);
