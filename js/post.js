$(document).ready(function () {
    $("#mainNav").attr("class", "navbar navbar-default");
    $("#mainNav").css("background-color", "gold");
    $("#btn_add_review").click(function () {
        var post_id = $("#post_id").val();
        var user_id = $("#user_id").val();
        var comment = $("#output5").next().val();
        var errors = false;
        $("#comment").next().html("");

        if (comment == '') {
            $("#output5").prev().html("*required");
            errors = true;
        }
        if (!errors)
        {
            $.ajax({
                url: "./includes/comment.php",
                type: "POST",
                data: {
                    post_id: post_id,
                    user_id: user_id,
                    comment: comment
                },
                success: function (data) {
                    var assArr = jQuery.parseJSON(data);
                    if (assArr['success'])
                    {
                        window.location.href = './post.php?post_id=' + post_id;

                    } else {
                        $("#output5").html(assArr["message"]);
                    }
                },
                error: function ()
                {
                    alert("fail");
                    $("#output5").html("Error on submitting data");
                    $('#review_form')[0].reset();
                }
            });
        }
    });
    $(".btn_delete_review").click(function () {
        var comment_id = $(this).prev().val();
        var parent = $(this).parent().parent().parent().parent().parent();
        $.ajax({
            url: "./includes/delete_comment.php",
            type: "POST",
            data: {
                comment_id: comment_id

            },
            success: function (data) {
                var assArr = jQuery.parseJSON(data);
                if (assArr['success'])
                {
                    parent.fadeOut(800, function () {
                        parent.remove();
                    });
                }
            },
            error: function ()
            {
                alert("fail");
            }
        });

    });


});