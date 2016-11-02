<?php include('includes/header.php'); ?>
<?php include('includes/navigation.php'); ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Search Results
            </h1>

            <?php search_query(); ?>

            <!-- show search results -->


        </div>

        <?php include('includes/sidebar.php'); ?>

    </div>


<?php include('includes/footer.php'); ?>
