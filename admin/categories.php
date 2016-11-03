<?php include('includes/header.php'); ?>

    <div id="wrapper">

    <?php include('includes/navigation.php'); ?>

        <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Categories
                          <small>Add / Remove Categories</small>
                      </h1>
                  </div>
              </div>
              <!-- /.row -->
              <div class="row">
                <div class="col-xs-6">
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="cat_title">Enter a Category</label>
                      <input type="text" name="cat_title" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include('includes/footer.php'); ?>
