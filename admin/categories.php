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

                  <?php include('includes/categories_create.php'); ?>

                  <!-- add category to db -->
                  <?php create_category(); ?>

                  <?php include('includes/categories_update.php'); ?>

                  <!-- delete category from db -->
                  <?php delete_category(); ?>

                </div>
                <!-- col-xs-6 -->

                <div class="col-xs-6">

                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Id</th>
                      </tr>
                    </thead>
                    <?php show_categories_in_table(); ?>
                  </table>

                </div>

              </div>
              <!-- row -->

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include('includes/footer.php'); ?>
