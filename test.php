<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="container-fluid video">
                <video poster="#" id="bgvid" playsinline autoplay muted loop>
                    <!-- -->
                    <source src="https://drive.google.com/uc?export=download&id=0B-ldJJbw0AnkTmZCT0E1S0pwZFk" type="video/mp4">
                </video>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="logo text-center">
                        <a href="index.html"><h1>Company</h1></a>
                    </div>
                    <div class="headText text-center col-sm-6">
                        <h1>Selling Online Was Never So Easy</h1>
                    </div>
                    <div id="polina" class="col-sm-6">
                        <h4 class="text-center">Register as a New User</h4>
<!--                        <div class="social text-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a class="btn btn-block btn-social btn-facebook" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);">
                                        <span class="fa fa-facebook"></span> Sign Up
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-block btn-social btn-google" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-google']);">
                                        <span class="fa fa-google"></span> Sign up
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5>OR</h5>
                        </div>-->
                        <form class="form-horizontal">
                            <div class="form-group has-success has-feedback">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="inputSuccess" placeholder="Full Name" required>
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-success has-feedback">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="inputSuccess" placeholder="Email" required>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-success has-feedback">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="inputSuccess" placeholder="Mobile Number" required>
                                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="form-group has-success has-feedback">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="inputSuccess" placeholder="Password" required>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-center">By signing up, you agree to our <a href="#">T&C</a> and <a href="#">privacy policy</a></p>
                                <button type="button" class="btn sellBtn btn-success">START SELLING</button>
                            </div>
                        </form>
                        <br>
                        <div class="text-right">
                            <p>Already Registered?<a href="#"> Login Here </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
