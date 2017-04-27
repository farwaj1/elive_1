$(document).ready(function () {
   $("#mainNav").attr("class","navbar navbar-default");
    $("#btn-signup").click(function () {
        var username = $("#username").val();
        var password1 = $("#password1").val();
        var password2 = $("#password2").val();
        var email_address = $("#email_address").val();
        var last_name = $("#last_name").val();
        var first_name = $("#first_name").val();
        var gender = $("#gender").val();
        var profilePicture = $("#profilePicture").val();
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var regex1 = /^(?=.*[0-9_\W]).+$/;
        var regex2 = /^(?=.*[a-z]).+$/;
        var regex3 = /^(?=.*[A-Z]).+$/;
        var errors = false;
        var passErr=[];
        $("#username").next().html("");
        $("#password1").next().html("");
        $("#password2").next().html("");
        $("#email_address").next().html("");
        $("#last_name").next().html("");
        $("#first_name").next().html("");
        $("#gender").next().html("");
    
        if (username == '')
        {
            $("#username").next().html("*required");
            errors = true;
        } else if (password1 == '')
        {
            $("#password1").next().html("*required");
             
            errors = true;
        } else if (password2 == '') {
            $("#password2").next().html("*required");
            errors = true;
        } else if (email_address == '') {
            $("#email_address").next().html("*required");
            errors = true;
        } else if (!re.test(email_address)) {
            $("#email_address").next().html("*invalid format");
            errors = true;
        } else if (last_name == '') {
            $("#last_name").next().html("*required");
            errors = true;
        } else if (first_name == '') {
            $("#first_name").next().html("*required");
            errors = true;
        }else if (gender == '') {
            $("#gender").next().html("*required");
            errors = true;
        }
        if (password1 != "")
        {
            if (password1.length < 8) {
                passErr.push("Password must be at least 8 characters");
            } else if (!regex1.test(password1)) {
                passErr.push("Password must contain at least a number or special character.");
            } else if (!regex2.test(password1))
            {

                passErr.push("Password must contain at least 1 lowercase letter.");
            } else if (!regex3.test(password1))
            {
                passErr.push("Password must contain at least 1 uppercase letter.");
            }
            if (passErr.length > 0) {
                $("#password1").next().html(passErr);
                errors = true;
            }
        }
        if (password1 != "" && password2 != "")
        {
            if (password1 != password2)
            {
                $("#password2").next().html("password doesnt match");
                errors = true;
            }
        }


        if (!errors)
        {
            $.ajax({
                url: "./includes/registration.php",
                type: "POST",
                data: {
                    username: username,
                    password1: password1,
                    password2: password2,
                    email_address: email_address,
                    last_name: last_name,
                    first_name: first_name,
                    gender: gender,
                    profilePicture: profilePicture
                },
                success: function (data) {
//                    alert(data);
                    var assArr = jQuery.parseJSON(data);
                    if (assArr['success'])
                    {
                        $("#sign_up_modal .close").click();
                        window.location.href = './user_page.php';

                    } else {
                        $("#output2").html(assArr["message"]);
                    }
                },
                error: function ()
                {
                   
                    $("#output2").html("Error on submitting data");
                    $('#signupForm')[0].reset();
                }
            });
        }
    });
        $("#btn-login").click(function () {
            
        var username = $("#login_username").val();
        var password = $("#login_password").val();
        $("#login_username").prev().html("");
        $("#login_password").prev().html("");
        var errors = false;
        var passErr = [];
        var regex1 = /^(?=.*[0-9_\W]).+$/;
        var regex2 = /^(?=.*[a-z]).+$/;
        var regex3 = /^(?=.*[A-Z]).+$/;
        if (username == '') {
            $("#login_username").prev().html("*required");
            errors = true;

        } else if (password == '')
        {
            $("#login_password").prev().html("*required");
            errors = true;
        } else if (password.length < 8) {
            passErr.push("Password must be at least 8 characters");
        } else if (!regex1.test(password)) {
            passErr.push("Password must contain at least a number or special character.");
        } else if (!regex2.test(password))
        {
            passErr.push("Password must contain at least 1 lowercase letter.");
        } else if (!regex3.test(password))
        {
            passErr.push("Password must contain at least 1 uppercase letter.");
        }
        if (passErr.length > 0) {
            $("#login_password").prev().html(passErr);
            errors = true;
        }
        
        if (!errors) {
            $.ajax({
                url: "./includes/login.php",
                type: "POST",
                data: {
                    username: username,
                    password: password
                },
                success: function (data) {
                    var assArr = jQuery.parseJSON(data);
                    if (assArr['admin'] == true)
                    {
                        window.location.href = './user_page.php';
                    } else if (!assArr['admin'] && assArr["message"] == "")
                    {
                        window.location.href = './user_page.php';
                    } else {
                        $("#output1").html(assArr["message"]);
                    }
                },
                error: function ()
                {
                    $("#output1").html("Error on submitting data");
                    $('#login_form')[0].reset();// To reset form fields
                }
            });
        }
    });
});