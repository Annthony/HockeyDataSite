<?php
  /*
   * PHP file for Connecting to atran94assign3db database
   */
  $dbhost = "dbserver";
  $dbuser= "username";
  $dbpass = "password";
  $dbname = "usernameassign3db";
  $connection = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpass");
  // echo "<p>Attempting to connect...</p>";
  if (!$connection) {
    echo "Database Connection Failed";
     }
  else {
    // echo "Database Connected.";
  }
?>
