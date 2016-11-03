<?php
  if (isset($_POST['create_post'])) {
    $post_title            = $_POST['post_title'];
    $post_cat_id           = $_POST['post_category_id'];
    $post_author           = $_POST['post_author'];
    $post_tags             = $_POST['post_tags'];
    $post_status           = $_POST['post_status'];
    // in order to post images we need to use _FILES and access both temporary Location
    // look up $_FILES[file][tmp_name] for futher information.
    $post_image            = $_FILES['post_image']['name'];
    $post_image_temp       = $_FILES['post_image']['tmp_name'];

    $post_content          = $_POST['post_content'];
    $post_date             = date('d-m-y');
    $post_commment_count   = 4;

    // method used for choosing where you want images uploaded to
    move_uploaded_file($post_image_temp, "../img/$post_image");
  }
?>

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
