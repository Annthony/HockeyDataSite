<?php
  /*
   * PHP file for viewing Game Data
   */
  include 'connectdb.php';

  //Get the posted Game ID the user wants Game Data for
  $gameidoption=$_POST["gameidoption"];
  //Query for the appropriate game data
  $gameq="SELECT * FROM Game WHERE gameid='".$gameidoption."'";
  $teamsq="SELECT * FROM Team INNER JOIN Plays on Team.teamid = Plays.teamid WHERE gameid='".$gameidoption."' ORDER BY Score DESC";
  $hofficialq="SELECT * FROM Official INNER JOIN Game on Official.OfficialID = Game.HeadOfficialID WHERE gameid='".$gameidoption."'";
  $officialq="SELECT * FROM Officiate INNER JOIN Official on Officiate.OfficialID = Official.OfficialID WHERE gameid='".$gameidoption."'";

  //Game data
  $gamer = pg_query($gameq);
  if (!$gamer) {
     die ("Database query failed!");
  }
  //Team data
  $teamsr = pg_query($teamsq);
  if (!$teamsr) {
     die ("Database query failed!");
  }
  //Head official data
  $hofficialr = pg_query($hofficialq);
  if (!$hofficialr) {
     die ("Database query failed!");
  }
  //Other official Data
  $officialr = pg_query($officialq);
  if (!$officialr) {
     die ("Database query failed!");
  }

  //Output the information in a table
  echo
  "<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    padding: 5px
  }
  th {
    text-align: centre;
  }
  </style>";
  echo
  "<table style=\"width:100%\">
    <th>Winner Team Name</th>
    <th>Team City</th>
    <th>Team Score</th>
    <th>Loser Team Name</th>
    <th>Team City</th>
    <th>Team Score</th>
    <th>Game City</th>
    <th>Game Date</th>
    <th>Head Official</th>
    <th>Game Official(s)</th>
  </tr>";
  echo "<tr>";
  while (($row1 = pg_fetch_array($gamer)) && ($row2 = pg_fetch_array($hofficialr))) {
    while ($row3 = pg_fetch_array($teamsr)) {
      echo("<td>".$row3["teamname"]."</td>");
      echo("<td>".$row3["teamcity"]."</td>");
      echo("<td>".$row3["score"]."</td>");
    }
    echo("<td>".$row1["gamecity"]."</td>");
    echo("<td>".$row1["gamedate"]."</td>");
    echo("<td>".$row2["firstname"]." ".$row2["lastname"]."</td>");
    echo "<td>";
    while ($row4 = pg_fetch_array($officialr)) {
      echo($row4["firstname"]." ".$row4["lastname"]."<br/>");
    }
    echo "</td>";
    echo "</tr>";
  }
  pg_free_result($gamer);
  pg_free_result($teamsr);
  pg_free_result($hofficialr);
  pg_free_result($officialr);
  pg_close($connection);
?>
