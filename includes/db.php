<?php

$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = 'root';
$db['db_name'] = 'cms_project';

foreach ($db as $key => $value) {
  define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection) {
  die('not connected');
} else {
  print_r($connection);
  print_r($db);
}
