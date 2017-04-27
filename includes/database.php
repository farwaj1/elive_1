<?php
    $dsn = 'mysql:host=localhost;dbname=elive';
    $username='root';
    $password ='';
    try
    {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
        error_reporting(E_ALL);

               
    } catch (Exception $e) {
        $error_message = 'Connection Failed';
        $error_message .= $e->getMessage();
        
        include('db_error.php');
        exit();
    }
