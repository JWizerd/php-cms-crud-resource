<?php include('includes/header.php'); ?>
<?php include('includes/navigation.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

            <?php show_posts_by_category(); ?>

            </div>

            <?php include('includes/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include('includes/footer.php'); ?>
