<?php
  /*
   * PHP file for getting Team Data
   */
  error_reporting(0);
  include 'connectdb.php';

  //Order by Team Name by default
  $option = "TeamName" ;

  //Query all team data sorted by Team Name
  $query='SELECT * FROM Team ORDER BY teamname ASC';
  $result = pg_query($query);
  if (!$result) {
     die ("Database query failed!");
  }

  //Query all team data sorted by Team Name
  if ($_POST["option1"] == "TeamName") {
    $query='SELECT * FROM Team ORDER BY teamname ASC';
    $result = pg_query($query);
    if (!$result) {
       die ("Database query failed!");
    }
  }

  //Query all team data sorted by Team City
  if ($_POST["option1"] == "TeamCity") {
    $query='SELECT * FROM Team ORDER BY teamcity ASC';
    $result = pg_query($query);
    if (!$result) {
       die ("Database query failed!");
    }
  }

  //Output the querried data in a table
  echo
  "<style>
  table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
  }
  th {
    text-align: left;
  }
  </style>";
  echo
  "<table style=\"width:30%\">
      <th>Team ID</th>
      <th>Team Name</th>
      <th>Team City</th>
  </tr>";
  while ($row = pg_fetch_array($result)) {
    echo "<tr>";
    echo("<td>".$row["teamid"]."</td>");
    echo("<td>".$row["teamname"]."</td>");
    echo("<td>".$row["teamcity"]."</td>");
    echo "</tr>";
  }
  echo "</table>";

  //Free results
  pg_free_result($result);
  pg_close($connection);
?>
