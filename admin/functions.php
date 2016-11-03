<?php

include('../includes/db.php');

// categories.php

function show_categories_in_table() {
  global $connection;
  $query = "SELECT * FROM categories";
  $results = mysqli_query($connection, $query);

  validate_query($results);

  display_categories_in_table($results);
}

function validate_query($results) {
  if (!$results) {
    die ('db failure' . mysqli_error($connection));
  } elseif (mysqli_num_rows($results) == 0) {
    echo '<h2>No data for query. Please try again.</h2>';
  }
}

function display_categories_in_table($results) {
  while ($row = mysqli_fetch_assoc($results)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    echo "<tr><td>{$cat_title}</td>" .
         "<td>{$cat_id}</td>" .
         "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>" .
         "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td></tr>";
  }
}

function create_category() {
  if(isset($_POST['submit'])) {
    $cat_title = strtoupper($_POST['cat_title']);
    create_category_query($cat_title);
  }
}

function create_category_query($cat_title) {
  global $connection;
  $query = "INSERT INTO categories(cat_title) ";
  $query .= "VALUE('{$cat_title}') ";
  $create_category = mysqli_query($connection, $query);
  if(!$create_category) {
    die('error establishing database' . mysqli_error($connection));
  }
}

function delete_category() {
  if(isset($_GET['delete'])) {
    $cat_id = $_GET['delete'];
    delete_category_query($cat_id);
  }
}

function delete_category_query($cat_id) {
  global $connection;
  $query = "DELETE FROM categories WHERE cat_id = {$cat_id} ";
  $delete_category = mysqli_query($connection, $query);
  if(!$delete_category) {
    die('error establishing database' . mysqli_error($connection));
  } else {
    header('Location: categories.php');
  }
}

function update_category() {
  if(isset($_GET['edit'])) {
    $category_id = $_GET['edit'];
    update_category_query($category_id);
  }
}

function update_category_query($category_id) {
  global $connection;
  $query = "SELECT * FROM categories WHERE cat_id = $category_id ";
  $select_category_id = mysqli_query($connection, $query);

  if(!$select_category_id) {
    die('error establishing database connection' . mysqli_error($connection));
  }

  while($row = mysqli_fetch_assoc($select_category_id)) {
    $cat_title = $row['cat_title'];
    echo "<input type='text' name='cat_title' class='form-control' value='{$cat_title}'>";
  }

  if(isset($_POST['update_category'])) {
    update_db_with_new_category($category_id, $cat_title);
  }
}

function update_db_with_new_category($category_id, $cat_title) {
  global $connection;
  $cat_title = strtoupper($_POST['cat_title']);
  $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $category_id ";
  $update_category = mysqli_query($connection, $query);
  if(!$update_category) {
    die('error establishing database' . mysqli_error($connection));
  } else {
    header('Location: categories.php');
  }
}

// posts.php

function show_posts_in_table() {
  global $connection;
  $query = "SELECT * FROM posts";
  $results = mysqli_query($connection, $query);

  // taken from categories on line 17
  validate_query($results);

  display_posts_in_table($results);
}

function display_posts_in_table($results) {
  while ($row = mysqli_fetch_assoc($results)) {
    $post_id = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_img_file = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_status = $row['post_status'];

    echo "<tr>" .
         "<td>{$post_id}</td>" .
         "<td>{$post_category_id}</td>" .
         "<td><a href='#'>{$post_title}</a></td>" .
         "<td>{$post_author}</td>" .
         "<td>{$post_date}</td>" .
         "<td><img style='width: 100px; height: 100px;' src='../img/{$post_img_file}' alt='{$post_img_file}' /></td>" .
         "<td><p>". substr($post_content, 0, 150) ."<a href='#'>...</a></p></td>" .
         "<td>{$post_tags}</td>" .
         "<td>{$post_comment_count}</td>" .
         "<td>{$post_status}</td>" .
         "</tr>";
  }
}

// create post
function create_post() {
  if (isset($_POST['create_post'])) {
    $post_title            = $_POST['post_title'];
    $post_cat_id           = $_POST['post_category_id'];
    $post_author           = $_POST['post_author'];
    $post_tags             = $_POST['post_tags'];
    $post_status           = $_POST['post_status'];
    // in order to post images we need to use _FILES and access both temporary Location
    // look up $_FILES[file][tmp_name] for futher information.
    $post_image            = $_FILES['post_image']['name'];
    $post_image_temp       = $_FILES['post_image']['tmp_name'];

    $post_content          = $_POST['post_content'];
    $post_date             = date('d-m-y');
    $post_comment_count    = 4;

    transport_uploaded_images($post_image_temp, $post_image);

    create_post_query($post_title, $post_cat_id, $post_author, $post_tags, $post_status, $post_image, $post_image_temp, $post_content, $post_date, $post_comment_count);
  }
}

function transport_uploaded_images($post_image_temp, $post_image) {
  // method used for choosing where you want images uploaded to
  move_uploaded_file($post_image_temp, "../img/$post_image");
}

function create_post_query($post_title, $post_cat_id, $post_author, $post_tags, $post_status, $post_image, $post_image_temp, $post_content, $post_date, $post_comment_count) {

  global $connection;
  $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";

  $query .= "VALUES({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}') ";

  $the_post = mysqli_query($connection, $query);

  if(!$the_post) {
    die('error establishing database' . mysqli_error($connection));
  }
}
