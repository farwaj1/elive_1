<?php

if (isset($_SESSION['login_user'])) {
    echo '<div class="row">';
    echo '<div class="row">';
    echo '<div class="col-sm-offset-2 col-sm-2">';
    echo $user['username'];
    echo '</div>';
    echo '</div>';
    echo '<div class="row">';
    echo '<div class="col-sm-offset-2 col-sm-2">';
    echo '<img src="image/profile_pic/' . $user["profile_pic"] . '?>" class="img-circle" width="147" height="118" position="center">';
    echo '</div>';
    echo '<div class="col-sm-6">';
    echo '<form id="review_form" method="post" >';
    echo '<div class="form-group">';
    echo '<span class="error"></span>';
    echo '<div id="output5" style="color: black"></div>';
    echo '<textarea style="color: black; font-size:150%;" class="form-control" rows="2" name="comment" class="comment" id="comment"></textarea>';
    echo '<input type="hidden" name="post_id" id="post_id" value ="' . $result['post_id'] . '">';
    echo '<input type="hidden" name="user_id" id="user_id"value ="' . $user['user_id'] . '">';
    echo '</div>';
    echo '<button type="button" class="btn btn-default"  id="btn_add_review">Add</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<div class="row">';
    echo ' <div class="col-sm-offset-3 col-sm-4">';
    echo '<h2><strong>Log In to make Comment</strong><h2>';
    echo '</div>';
    echo '</div>';
}
