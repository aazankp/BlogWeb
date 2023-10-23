<?php
require_once "../vendor/Library.php";
require_once "../vendor/Database.php";
$Library = new Library();
$Database = new Database();
$user_info = $Library->user();
$Library->Header("Blog Web");
$Library->Header_Nav();
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data" id="publish_post">
        <button type="button" class="btn btn-success mt-5 mb-2" data-bs-toggle="modal" data-bs-target="#myModal">
            Publish a Blog
        </button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Post Blogs</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body mt-2">
                        <input type="hidden" name="post_added_by" value="<?php echo $user_info["user_id"]; ?>" class="form-control mt-2">
                        <div class="form-group mt-2">
                            <label for="comment">Content:</label>
                            <textarea class="form-control mt-2" name="content" rows="5" id="comment"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="comment">Upload Image:</label>
                            <input type="file" name="img" class="form-control mt-2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal" name="post">Post</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <hr width="100%">
    <div class="container mt-5" id="show_posts"></div>
</div>
<?php
$Library->Footer();
?>