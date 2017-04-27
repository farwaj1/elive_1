$(document).ready(function () {
    $("#mainNav").attr("class", "navbar navbar-default");
    $("#mainNav").css("background-color", "gold");
    $('.content').each(function (event) {
        var max_length = 3;
        if ($(this).html().length > max_length) {
            var short_content = $(this).html().substr(0, max_length);
            var id = $('.content').next().val();
            $(this).html(short_content +
                    '<a href="post.php?post_id=' + id + '" class="read_more"><br/>read more....</a>');
        }
    });


});