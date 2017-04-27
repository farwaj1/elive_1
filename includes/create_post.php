<?php require_once("database.php");
include_once ('validate.php');
session_start();
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
$form_errors = array();
$required_fields = array('title', 'content');
$form_errors = array_merge($form_errors, check_empty_fields($required_fields));

$assocArray["message"] = "";
$assocArray['success'] = false;
$error_message = "";
if (empty($form_errors)) {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    
 $mysqlDateTime = date('c');

    try {
        $queryAddPost = "INSERT INTO post(user_id,title,content,created_at,edit_at,comment_enable,status) VALUES (:user_id,:title, :content,:created_at , :edit_at,'1',:status)";
        $statement = $db->prepare($queryAddPost);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':content', $content);
        $statement->bindValue(':user_id', $_SESSION['login_user_id']);
        $statement->bindValue(':created_at', $mysqlDateTime);
        $statement->bindValue(':edit_at', $mysqlDateTime);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $statement->closeCursor();

        $queryGetPost = "SELECT * FROM post ORDER BY post_id DESC LIMIT 1";
        $statement5 = $db->prepare($queryGetPost);
        $statement5->execute();
        $result2 = $statement5->fetch();
        $statement5->closeCursor();
        $post_id = $result2["post_id"];
        

      
    } catch (Exception $e) {
        $error_message .= $e->getMessage();
        include('db_error.php');
        exit();
    }


    $assocArray['success'] = true;
    $assocArray['post_id']=$post_id;

} else {
    $str = "";
    foreach ($form_errors as $errors) {
        $str .= $errors . "**\t";
    }
    $assocArray["message"] = $str;
    $assocArray['success'] = false;
}

echo json_encode($assocArray);
