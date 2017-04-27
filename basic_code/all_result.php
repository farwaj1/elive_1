
<tr>
    <td><?php echo $post['title'] ?></td>
    <td><?php echo $post['status'] ?></td>
    <td>
        <form class="form"  action="./user.php" method="post">
            <input type="hidden" id="post_id" name="post_id" value="<?php echo $post["post_id"]; ?>">
            <button class="btn btn-default" type="submit"><i class="fa fa-eye" aria-hidden="true"></i></button>
        </form>
        <form  action="./create_post.php" method="GET"> 
            <input type="hidden" id="post_id" name="post_id" value="<?php echo $post["post_id"]; ?>">
            <button class="btn btn-default" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        </form>

        <form class="form">
            <input type="hidden" class="post_id" name="post_id" value="<?php echo $post["post_id"] ?> ">
            <?php
            if ($post['status'] == "Draft") {
                echo '<input type="hidden" class="status" name="status" value="Published">';
                echo '<button class="btn btn-default status" type="button">Publish</button> ';
            } else {
                echo '<input type="hidden" class="status" name="status" value="Draft">';
                echo '<button class="btn btn-default status" type="button">Save to Draft</button> ';
            }
            ?>

        </form>
        <input class="post_id" value="<?php echo $post["post_id"]; ?>" type="hidden">
        <button type="button" class="btn btn-default delete_modal" data-toggle="modal" ><i class="fa fa-trash" aria-hidden="true"></i></button>
        <div  style="color:black;" class="modal fade"   onsubmit="return false" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this post?</h2>
                            <h6 style="color: red">**Delete action is unable to undo**</h6>
                            <p><b><?php echo $post["title"]; ?></b></p>
                            <p><?php echo $post["content"]; ?></p>
                            <form id="delete_post_form" method="post" action="./includes/delete_post.php">
                                <div id="output1"></div>
                                <input type="hidden" class="post_id" value="<?php echo $post["post_id"]; ?>" name="post_id">

                                <button type="button" class="btn btn-default delete" data-dismiss="modal">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </form>
                    </div>

                </div>
            </div>
        </div>
    </td>
</tr>