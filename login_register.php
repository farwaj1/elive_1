<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
    <?php
    require_once 'basic_code/head.php';
    ?>
    <link href="css/login_register.css" rel="stylesheet" type="text/css"/>
    <script src="js/login_registration.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <body>
        <?php
        require_once 'basic_code/navigation.php';
        ?>
        <div class="container">     
            <div class="row">
                <div class="col-sm-offset-1 col-sm-4">
                    <h2 style="color: white">Register as New User</h2>
                    <form id="signupForm" class="form-horizontal" method='post'>

                        <div id="output2"></div>
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <input type="text" class="form-control" placeholder="Enter Username" id="username" name="username" >
                                <span class="error" ></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id = "password1" name = "password1"  placeholder="Password" >
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id = "password2" name = "password2" placeholder="Confirm Password" >
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group"><span class="error"></span>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id = "email_address" name = "email_address"  placeholder="Email Address" >
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id = "last_name" name = "last_name" placeholder="Last Name" >
                                <span class="error"></span>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id = "first_name" name = "first_name" placeholder="First Name" >
                                <span class="error"></span>
                                <input type="hidden" id = "profilePicture" name = "profilePicture" value="defaultPro.png" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="gender" id="gender" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>   
                                <span class="error"></span>
                            </div>
                        </div>
                    
                                <div id="imgdiv">
                                    <img id="img" src="captcha/captcha.php">
                                </div>
                                <img id="reload" src="image/captcha/reload.png">
                                <input style="color: black;" type="text" id="captcha1" name="captcha1"  >
                                <input id="button" type='button' value='Submit'>

                        <button id="btn-signup" type="button" class="btn btn-default">Sign Up</button>

                    </form>
                </div>
                <div class="col-sm-offset-2 col-sm-4">
                    <h2 style="color: white">Have an account?</h2>
                    <form id="login_form" method='post'>
                        <div id="output1"></div>
                        <div class="form-group ">
                            <label><b>Username</b></label><span class="error" ></span>
                            <input type="text" class="form-control" placeholder="Enter Username" name="login_username" id="login_username">
                        </div>
                        <div class="form-group">
                            <label><b>Password</b></label><span class="error"></span>
                            <input type="password"class="form-control" placeholder="Enter Password" name="login_password" id="login_password" >
                        </div>
                        <!--                <div class="checkbox">
                                            <label><input type="checkbox" checked="checked"> Remember me</label>
                                        </div>-->
                        <button type="button" id="btn-login"class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>