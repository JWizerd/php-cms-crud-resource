<form action="" method="post">
  <div class="form-group">
    <label for="cat_title">Edit a Category</label>
    <!-- update category in database -->
    <?php update_category(); ?>
  </div>
  <div class="form-group">
    <input value="Update" type="submit" name="update_category" class="btn btn-primary">
  </div>
</form>
