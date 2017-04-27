
<?php

require_once 'database.php';
require_once 'validate.php';

$form_errors = array();
$required_fields = array('username', 'password1', 'password2', 'email_address', 'last_name', 'first_name', 'gender', 'profilePicture');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));
$fields_to_check_length = array('username' => 5, 'password1' => 8);
$form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
$form_errors = array_merge($form_errors, check_email($_POST));
$form_errors = array_merge($form_errors, valid_2_password($_POST));

$assocArray['success'] = false;
if (empty($form_errors)) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password1 = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_POST, 'password2', FILTER_SANITIZE_STRING);
    $email_address = filter_input(INPUT_POST, 'email_address', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $profilePicture = filter_input(INPUT_POST, 'profilePicture', FILTER_SANITIZE_STRING);
    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
    try {

        $queryAllUser = "SELECT * FROM user";
        $statement2 = $db->prepare($queryAllUser);
        $statement2->execute();
        $allUser = $statement2->fetchAll();
        $statement2->closeCursor();

        foreach ($allUser as $user) {
            if ($user["username"] == $username) {
                $assocArray["message"] = "Username is picked by other user, please try again";
            }
        }
        $assocArray["success"] = false;
    } catch (Exception $e) {
        $assocArray["message"] .= $e->getMessage();
    }

    if (!isset($assocArray["message"])) {
        $assocArray["message"] = "";
        try {
            $query = "INSERT INTO user (username, password, email_address,last_name,first_name,gender, isAdmin, profile_pic) VALUES (:username, :password,:email_address,:last_name,:first_name,:gender, '2',:profile_picture)";
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $hashed_password);
            $statement->bindValue(':email_address', $email_address);
            $statement->bindValue(':last_name', $last_name);
            $statement->bindValue(':first_name', $first_name);
            $statement->bindValue(':gender', $gender);
            $statement->bindValue(':profile_picture', $profilePicture);
            $statement->execute();
            $statement->closeCursor();

            $queryUser = "SELECT * FROM user WHERE username = :username ";
            $statement1 = $db->prepare($queryUser);
            $statement1->bindValue(":username", $username);
            $statement1->execute();
            $result = $statement1->fetch();
            $statement1->closeCursor();
        } catch (Exception $e) {
            $assocArray["message"] .= $e->getMessage();
        }

        session_start();
        $_SESSION['login_user_id'] = $result['user_id'];
        $_SESSION['login_user'] = $username;
        $_SESSION['user_status'] = $result['isAdmin'];
        $assocArray["success"] = true;
    }
} else {
    $str = "";
    foreach ($form_errors as $errors) {
        $str .= $errors . "**\t";
    }
    $assocArray["message"] = $str;
    $assocArray["success"] = false;
}

//echo $error_message;
echo json_encode($assocArray);
