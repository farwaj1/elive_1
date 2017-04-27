$(document).ready(function() {
//change CAPTCHA on each click or on refreshing page
$("#reload").click(function() {

$("img#img").remove();
var id = Math.random();
$('<img id="img" src="captcha/captcha.php?id='+id+'"/>').appendTo("#imgdiv");
id ='';
});


//validation function
$('#button').click(function() {
var captcha = $("#captcha1").val();

if (captcha == '')
{
alert("Fill in Fields");
}

else
{ //validating CAPTCHA with user input text
var dataString = 'captcha=' + captcha;
$.ajax({
type: "POST",
url: "captcha/verify.php",
data: dataString,
success: function(html) {
alert(html);
}
});
}
});
});

