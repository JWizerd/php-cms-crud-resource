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
                          <a href="http://localhost/php-cms-crud-resource/admin/posts.php?source=post_add" class="btn btn-primary">Add Post</a>
                      </h1>
                      <p style="color:red;"><?php echo delete_post(); ?></p>
                      <?php
                      if(isset($_GET['source'])) {
                        $source = $_GET['source'];
                      } else {
                        $source = '';
                      }

                      switch ($source) {
                        case 'post_add':
                          include('includes/post_add.php');
                          break;

                        case 'post_edit':
                          include('includes/post_edit.php');
                          break;

                        default:
                          include('includes/post_view_all.php');
                          break;
                      }
                      ?>
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
