<?php include('includes/header.php'); ?>

    <div id="wrapper">

    <?php include('includes/navigation.php'); ?>

        <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">
                          Posts
                          <small>All Posts</small>
                      </h1>
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Commens</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php show_posts_in_table(); ?>
                        </tbody>
                      </table>
                  </div>
              </div>
              <!-- /.row -->

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include('includes/footer.php'); ?>
