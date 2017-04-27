$(document).ready(function () {
    $("#mainNav").attr("class", "navbar navbar-default");
    $("#mainNav").css("background-color", "gold");
    $("#display_option").load("./basic_code/option_1.php");
    $("#s_1").css("font-weight", "bold");
    $("#all").css("font-weight", "bold");
    $("#s_1").click(function () {
        $(this).next().toggle();
        $("#display_option").load("./basic_code/option_1.php?showStatus=all");
        $("#s_3").css("font-weight", "normal");
        $("#s_2").css("font-weight", "normal");
        $("#s_4").css("font-weight", "normal");
        $(this).css("font-weight", "bold");
        if ($("#change").attr("class") == "fa fa-caret-down")
        {
            $("#change").attr("class", "fa fa-caret-right");
        } else
        {

            $("#change").attr("class", "fa fa-caret-down");
        }

    });
    $("#s_2").click(function () {
        $("#sub-menu-1").hide();
        $("#display_option").load("./basic_code/option_1.php");
        $("#s_1").css("font-weight", "normal");
        $("#s_3").css("font-weight", "normal");
        $("#change").attr("class", "fa fa-caret-right");
        $(this).css("font-weight", "bold");
    });
    $("#s_3").click(function () {
        $("#sub-menu-1").hide();
        $("#display_option").load("./basic_code/option_3.php");
        $("#s_1").css("font-weight", "normal");
        $("#s_2").css("font-weight", "normal");
        $("#change").attr("class", "fa fa-caret-right");
        $(this).css("font-weight", "bold");
    });

    $("#publish").click(function () {
        $(this).css("font-weight", "bold");
        $("#all").css("font-weight", "normal");
        $("#draft").css("font-weight", "normal");
        $("#display_option").load("./basic_code/option_1.php?showStatus=Published");
    });
    $("#draft").click(function () {
        $(this).css("font-weight", "bold");
        $("#all").css("font-weight", "normal");
        $("#publish").css("font-weight", "normal");
        $("#display_option").load("./basic_code/option_1.php?showStatus=Draft");
    });
    $("#all").click(function () {
        $(this).css("font-weight", "bold");
        $("#draft").css("font-weight", "normal");
        $("#publish").css("font-weight", "normal");
        $("#display_option").load("./basic_code/option_1.php?showStatus=all");
    });
//        $("#closeButton").click(function () {
//        $("#picModalBox").css("display", "none");
//    });
//    $("#imagePro").click(function () {
//        $("#picModalBox").css("display", "block");
//        var imageURL = $(this).attr("src");
//        $("#modalImg").attr("src", imageURL);
//
//    });

});