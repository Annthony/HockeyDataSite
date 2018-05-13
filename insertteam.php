<?php
  /*
   * PHP file for Inserting new Team data
   */
  include 'connectdb.php';

  //Retrieve user submitted posted data
  $teamid=$_POST["teamid"];
  $teamname=$_POST["teamname"];
  $teamcity=$_POST["teamcity"];

  //Query to find a team with the user submitted Team ID
  $query1="SELECT teamid FROM Team WHERE teamid='".$teamid."' LIMIT 1";
  $result1 = pg_query($query1);
  if (pg_num_rows($result1) == 1) {
     die ("Insert failed! Team ID already exists!"); //Team ID already exists
  }
  else {
    $query2="INSERT into Team(teamid, teamcity, teamname) VALUES
    ('".$teamid."','".$teamcity."','".$teamname."');"; //Inserts if Team ID doesn't exist
    if (pg_query($query2)) {
       echo "Your team was added!";
    }
    else {
        die("Error: insert failed-->" . pg_last_error($connection));
    }
  }

  //Free Results
  pg_free_result($result1);
  pg_close($connection);
?>
