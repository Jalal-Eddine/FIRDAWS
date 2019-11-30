<?php

  require_once('db_credentials.php');
//* |--------------------------------------------------------------------------
//! | db_connect()
//* |--------------------------------------------------------------------------
// *|connect to the database with mysqli API
// *|confirm_db_connect() is a function below
  function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    return $connection;
  }
//* |--------------------------------------------------------------------------
//! | db_disconnect
//* |--------------------------------------------------------------------------
// *|disconnect from the database if it was connected
  function db_disconnect($connection) {
    if(isset($connection)) {
      mysqli_close($connection);
    }
  }
//* |--------------------------------------------------------------------------
//! | db_escape
//* |--------------------------------------------------------------------------
// *|mysqli_real_escape_string()
// *|to prevent SQL injection
// *|all dynamic data (query request) should be escaped
  function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
  }
//* |--------------------------------------------------------------------------
//! | confirm_db_connect()
//* |--------------------------------------------------------------------------
// *| Return the Error if the connection to the database has failed
// *|
// *|
  function confirm_db_connect() {
    if(mysqli_connect_errno()) {
      $msg = "Database connection failed: ";
      $msg .= mysqli_connect_error();
      $msg .= " (" . mysqli_connect_errno() . ")";
      exit($msg);
    }
  }
//* |--------------------------------------------------------------------------
//! | confirm_result_set()
//* |--------------------------------------------------------------------------
// *| if the argument is empty then return the query failed 
// *|
// *|
  function confirm_result_set($result_set) {
    if (!$result_set) {
    	exit("Database query failed.");
    }
  }
?>
