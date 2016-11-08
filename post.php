<?php include('includes/header.php'); ?>
<?php include('includes/navigation.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

            <?php the_post(); ?>
            <?php include('includes/comments.php'); ?>
            </div>

            <?php include('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>
<?php include('includes/footer.php'); ?>
