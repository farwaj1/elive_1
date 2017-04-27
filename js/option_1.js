$(document).ready(function () {
    $(".delete_modal").click(function () {
        $(this).next().modal();
    });

    $(".delete").click(function () {
        var post_id = $(this).siblings(".post_id").val();
        var tr = $(this).parent().closest("tr");
        $.ajax({
            url: "./includes/delete_post.php",
            type: "POST",
            data: {
                post_id: post_id
            },
            success: function (data) {
                var assArr = jQuery.parseJSON(data);
                if (assArr['success'] && assArr["message"] == "")
                {
                    tr.find('td').fadeOut(800, function () {
                        tr.remove();
                    });
                } else {
                    $(".output").html(assArr["message"]);
                }
            },
            error: function (data)
            {
                alert(data);
            }
        });

    });
    $(".status").click(function () {
        var post_id = $(this).siblings(".post_id").val();
        var status = $(this).siblings(".status").val();
        var button = $(this);
        $.ajax({
            url: "./includes/update_post_status.php",
            type: "POST",
            data: {
                post_id: post_id,
                status: status
            },
            success: function (data) {
                var assArr = jQuery.parseJSON(data);
                if (assArr['success'] && assArr["message"] == "")
                {
                    if (assArr['status'] == "Draft") {
                        button.html("Publish");
                    } else {
                        button.html("Save to Draft");
                    }
                } else {
                    $(".output").html(assArr["message"]);
                }
            },
            error: function (data)
            {
                alert(data);
            }
        });


    });


});