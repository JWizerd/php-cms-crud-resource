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
