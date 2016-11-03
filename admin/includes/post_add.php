<?php create_post(); ?>

<p class="lead">Fill out the form to make a post!</p>

<form action="" method="post" enctype="multipart/form-data" class="col-sm-8">
  <div class="form-group">
    <label for="post_title">Post Title</label>
    <input type="text" class="form-control" name="post_title" required>
  </div>
  <div class="form-group">
    <label for="post_category_id">Post Category Id</label>
    <input type="number" class="form-control" name="post_category_id" required>
  </div>
  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author" required>
  </div>
  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" required>
  </div>
  <div class="form-group">
    <label for="post_tags">Post Status</label>
    <input type="text" class="form-control" name="post_status" required>
  </div>
  <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image">
  </div>
  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea type="text" class="form-control" name="post_content" rows="10" required></textarea>
  </div>
  <div class="form-group">
    <input type="submit" name="create_post" class="btn btn-primary">
  </div>
</form>
