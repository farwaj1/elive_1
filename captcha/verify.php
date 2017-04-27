<?php
//CAPTCHA Matching code
session_start();
if ($_SESSION["code"] == $_POST["captcha"]) {
echo "Text entered correctly....!";
} else {
die("Wrong TEXT Entered");
}
?>

