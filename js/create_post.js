jQuery.each(jQuery('textarea[data-autoresize]'), function () {
    var offset = this.offsetHeight - this.clientHeight;

    var resizeTextarea = function (el) {
        jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
    };
    jQuery(this).on('keyup input', function () {
        resizeTextarea(this);
    }).removeAttr('data-autoresize');
});

$(document).ready(function () {
    var post_id = $("#post_id").val();
    if (post_id != "") {
        $("#create_post_form").attr("action", "includes/update_post.php");
    }
    $("#mainNav").attr("class", "navbar navbar-default");
    $("#mainNav").css("background-color", "gold");
    $("#btn-save-draft").click(function () {
        $("#status").attr("value", "Draft");
        $(this).attr("type", "submit");
        $("#create_post_form").submit();

    });
    $("#btn-publish").click(function () {
        $("#status").attr("value", "Published");
        $(this).attr("type", "submit");
        $("#create_post_form").submit();
    });
    $("#btn-save").click(function () {
        var post_id = $("#post_id").val();
        $(this).attr("type", "submit");
        $("#create_post_form").submit();
    });


});