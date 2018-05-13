<?php
  /*
   * PHP file for Updating a City Name where a game was played
   */
  include 'connectdb.php';
  // echo "Game IDs and Game Citys Before: <br/>"
  //Query to get all GameIDs and correspong City Names, Output in a drop-down menu
  $query1='SELECT gameid, gamecity FROM Game';
  $result1 = pg_query($query1);
  if (!$result1) {
     die ("Database query failed!");
  }
  while ($row = pg_fetch_array($result1)) {
    echo("<option value=\"".$row["gameid"]."\">".$row["gameid"].", ".$row["gamecity"]."</option>");
  }

  //Get user submitted posted data
  $gameidoption=$_POST["gameidoption"];
  $newgamecity=$_POST["newgamecity"];

  //Set the City Names as the user input names
  $query2="UPDATE Game SET GameCity = '".$newgamecity."' WHERE GameID = '".$gameidoption."'";
  $result2 = pg_query($query2);
  if ($result2) {
    echo "Game City was successfully updated. (IDs and Cities above are before updating)";
  }
  else {
    die ("Database query failed!");
  }

  //Free Results
  pg_free_result($result1);
  pg_free_result($result2);
  pg_close($connection);
?>
