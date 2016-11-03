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
         "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td></tr>";
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

// posts.php
