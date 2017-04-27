<?php

session_start();
if(empty($_SESSION["login_user"]))
{
	header("Location: ./index.php");
	exit();
}
session_unset();
session_destroy();
header("Location:../index.php");
exit();
