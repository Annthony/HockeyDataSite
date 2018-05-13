<?php
  /*
   * PHP file for Deleting a Team from the database
   */
  include 'connectdb.php';

  //Retrieve the user submitted posted data for Team ID
  $teamid=$_POST["teamid"];

  //Query, find the team with the corresponding Team ID
  $query1="SELECT teamid FROM Team WHERE teamid='".$teamid."' LIMIT 1";
  $result1 = pg_query($query1);
  if (pg_num_rows($result1) == 1) {
    $query2="DELETE FROM Team WHERE teamid='".$teamid."'"; //Delete if found
    if (!pg_query($query2)) {
         die("Error: delete failed-->" . pg_last_error($connection));
     }
    echo "The team was deleted!";
  }
  else {
    echo "The team with id: '".$teamid."' does not exist.";
  }

  //Free Results
  pg_free_result($result1);
  pg_close($connection);
?>
