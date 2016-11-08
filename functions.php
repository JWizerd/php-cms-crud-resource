<?php

include('includes/db.php');

function get_index_directory() {
  echo "/php-cms-crud-resource/";
}

function category_query() {
  global $connection;
  // limit output of categories to 5
  $query = "SELECT * FROM categories LIMIT 5";
  $categories = mysqli_query($connection, $query);

  show_categories($categories);
}

function show_categories($db_fetch_data) {
  while($row = mysqli_fetch_assoc($db_fetch_data)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<li><a href='category.php?cat_id={$cat_id}'>{$cat_title}</a></li>";
  }
}

function show_all_posts() {
  global $connection;
  $query = "SELECT * FROM posts";
  $posts = mysqli_query($connection, $query);

  list_post_data_snippets($posts);
}

function show_posts_by_category() {
  if(isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    post_category_query($cat_id);
  }
}

function post_category_query($cat_id) {
  global $connection;
  $query = "SELECT * FROM posts WHERE post_category_id = $cat_id ";
  $posts = mysqli_query($connection, $query);

  if (!$posts) {
    die('error establishing database connection' . mysqli_error($connection));
  }

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
    $post_id = $row['post_id'];

    echo "<h2><a href='post.php?p_id={$post_id}'>{$post_title}</a></h2>" .
         "<p>by {$post_author}</p>" .
         "<p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>" .
         "<hr>" .
         "<img class='img-responsive' src='img/{$post_img_link}' alt='{$post_title} image'>" .
         "<hr>" .
         "<p>". substr($post_content, 0, 300) ."<a href='#'>...</a></p>" .
         "<a class='btn btn-primary' href='post.php?p_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>" .
         "<hr>";
  }
}

function the_post() {
  if(isset($_GET['p_id'])) {
    $post_id = $_GET['p_id'];
    post_query_filter_by_id($post_id);
  }
}

function post_query_filter_by_id($post_id) {
  global $connection;
  $query = "SELECT * FROM posts WHERE post_id = $post_id ";
  $results = mysqli_query($connection, $query);

  if(!$results) {
    die('Query failed' . mysqli_query($connection));
  }

  format_post_content_by_id($results);
}

function format_post_content_by_id($results) {
  while ($row = mysqli_fetch_assoc($results)) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_tags = $row['post_tags'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];

    echo "<h1>{$post_title}</h1>" .
         "<p>by {$post_author}</p>" .
         "<p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>" .
         "<p><span class='glyphicon glyphicon-tag'></span> {$post_tags}</p>" .
         "<hr>" .
         "<img class='img-responsive' src='img/{$post_image}' alt='{$post_title} image'>" .
         "<hr>" .
         "<p>{$post_content}</p>";
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
  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%'";
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
    echo '<h2>No data for query. Please try again.</h2>';
  } else {
    show_search_results($results);
  }
}
