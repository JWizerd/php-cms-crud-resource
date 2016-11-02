<?php

include('includes/db.php');

function get_index_directory() {
  echo "/php-cms-crud-resource/";
}

function category_query() {
  global $connection;

  $query = "SELECT * FROM categories";
  $categories = mysqli_query($connection, $query);

  show_categories($categories);
}

function show_categories($db_fetch_data) {
  while($row = mysqli_fetch_assoc($db_fetch_data)) {
    $cat_title = $row['cat_title'];
    echo "<li><a href=''>{$cat_title}</a></li>";
  }
}

function show_all_posts() {
  global $connection;
  $query = "SELECT * FROM posts";
  $posts = mysqli_query($connection, $query);

  list_post_data_snippets($posts);
}

function list_post_data_snippets($db_fetch_data) {
  while($row = mysqli_fetch_assoc($db_fetch_data)) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_img_link = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];

    echo "<h2><a href='#'>{$post_title}</a></h2>" .
         "<p>by {$post_author}</p>" .
         "<p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>" .
         "<hr>" .
         "<img class='img-responsive' src='img/{$post_img_link}' alt='{$post_title} image'>" .
         "<hr>" .
         "<p>". substr($post_content, 0, 300) ."<a href='#'>...</a></p>" .
         "<a class='btn btn-primary' href=''#''>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>" .
         "<hr>";

  }
}

// get search query and produce results from db
function search_query() {
  if(isset($_POST['submit'])) {
    $search = $_POST['search'];
    search_results($search);
  }
}

function search_results($search) {
  global $connection;
  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
  $results = mysqli_query($connection, $query);

  query_validations($results);
}

function show_search_results($results) {
  list_post_data_snippets($results);
}

function query_validations($results) {
  if(!$results) {
    die('Query failed' . mysqli_query($connection));
  }

  if (mysqli_num_rows($results) == 0) {
    echo '<h2>no data for query</h2>';
  } else {
    show_search_results($results);
  }
}
