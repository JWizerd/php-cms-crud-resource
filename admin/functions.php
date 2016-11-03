<?php

include('../includes/db.php');

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
         "<td>{$cat_id}</td></tr>";
  }
}
