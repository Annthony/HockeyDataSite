<?php
  /*
   * PHP file for getting Maple Leaf Game Data
   */
  include 'connectdb.php';

  //Queries all Maple Leafs Game stats
  $game="SELECT * FROM Team INNER JOIN Plays ON Team.TeamID = Plays.TeamID WHERE GameID IN
        (SELECT GameID FROM Plays INNER JOIN Team ON Plays.TeamID = Team.TeamID WHERE TeamName = 'Maple Leafs')
        ORDER BY GameID";
  $gamer = pg_query($game);
  if (!$gamer) {
     die ("Database query failed!");
  }

  //Queries the officials who officiated Leafs Games
  $official="SELECT FirstName, LastName, Count(Officiate.GameID) AS CountGames FROM Official
  INNER JOIN Officiate on Official.OfficialID = Officiate.OfficialID
  INNER JOIN Plays on Officiate.GameID = Plays.GameID
  INNER JOIN Team on Plays.TeamID = Team.TeamID
  WHERE TeamName = 'Maple Leafs'
  GROUP BY FirstName, LastName ORDER BY CountGames DESC";
  $officialr = pg_query($official);
  if (!$officialr) {
     die ("Database query failed!");
  }

  //Queries Officials who officiated the most Leafs Game Losses
  $losses = "SELECT DISTINCT FirstName, LastName, Count(Game.Gameid) AS cg
  FROM Game, Official, Officiate, Team AS a, Team AS b, Plays AS x, Plays AS y
  WHERE x.GameID = Game.GameID
  AND y.GameID = Game.GameID
  AND Officiate.GameID = Game.GameID
  AND Officiate.OfficialID = Official.OfficialID
  AND x.TeamID != y.TeamID
  AND a.TeamID = x.TeamID
  AND b.TeamID = y.TeamID
  AND (a.TeamName = 'Maple Leafs' AND x.Score < y.Score)
  GROUP BY FirstName, LastName ORDER BY cg DESC";
  $lossesr = pg_query($losses);
  if (!$lossesr) {
     die ("Database query failed!");
  }

  //Queries Officials who officiated the most Leafs Game Wins
  $wins = "SELECT DISTINCT FirstName, LastName, Count(Game.GameID) AS cg
  FROM Game, Official, Officiate, Team AS a, Team AS b, Plays AS x, Plays AS y
  WHERE x.GameID = Game.GameID
  AND y.GameID = Game.GameID
  AND Officiate.GameID = Game.GameID
  AND Officiate.OfficialID = Official.OfficialID
  AND x.TeamID != y.TeamID
  AND a.TeamID = x.TeamID
  AND b.TeamID = y.TeamID
  AND (a.TeamName = 'Maple Leafs' AND x.Score > y.Score)
  GROUP BY FirstName, LastName ORDER BY cg DESC";
  $winsr = pg_query($wins);
  if (!$winsr) {
     die ("Database query failed!");
  }

  //Outputs Leafs Games Stats if the corresponding radio button is submitted
  if ($_POST["option"] == "gamestats") {
    echo "<br/>Game Statistics for all Leafs games. <br/>";
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
    "<table style=\"width:50%\">
        <th>Team Name</th>
        <th>Team City</th>
        <th>Team Score</th>
        <th>Team Name</th>
        <th>Team City</th>
        <th>Team Score</th>
    </tr>";
    while ($row1 = pg_fetch_array($gamer)) {
      echo "<tr>";
      echo("<td>".$row1["teamname"]."</td>");
      echo("<td>".$row1["teamcity"]."</td>");
      echo("<td>".$row1["score"]."</td>");
      $row1 = pg_fetch_array($gamer);
      echo("<td>".$row1["teamname"]."</td>");
      echo("<td>".$row1["teamcity"]."</td>");
      echo("<td>".$row1["score"]."</td>");
      echo "</tr>";
    }
  }

  //Outputs Official data if the corresponding radio button is submitted
  if ($_POST["option"] == "official") {
    echo "<br/>Officials who officiated games where the Leafs played. <br/>";
    echo "*Ordered by number of games officiated, descending. <br/>";
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
    "<table style=\"width:50%\">
        <th>First Name</th>
        <th>Last Name</th>
        <th>Leafs Games Officiated</th>
    </tr>";
    while ($row2 = pg_fetch_array($officialr)) {
      echo "<tr>";
      echo("<td>".$row2["firstname"]."</td>");
      echo("<td>".$row2["lastname"]."</td>");
      echo("<td>".$row2["countgames"]."</td>");
      echo "</tr>";
    }
  }

  //Outputs Official data if the corresponding radio button is submitted
  if ($_POST["option"] == "losses") {
    echo "<br/>Officials who officiated games where the Leafs lose. <br/>";
    echo "*Ordered by number of games officiated, descending. <br/>";
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
    "<table style=\"width:50%\">
        <th>First Name</th>
        <th>Last Name</th>
        <th>Number Leafs of Games Officiated</th>
    </tr>";
    while ($row3 = pg_fetch_array($lossesr)) {
      echo "<tr>";
      echo("<td>".$row3["firstname"]."</td>");
      echo("<td>".$row3["lastname"]."</td>");
      echo("<td>".$row3["cg"]."</td>");
      echo "</tr>";
    }
  }

  //Outputs Official data if the corresponding radio button is submitted
  if ($_POST["option"] == "wins") {
    echo "<br/>Officials who officiated games where the Leafs win. <br/>";
    echo "*Ordered by number of games officiated, descending. <br/>";
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
    "<table style=\"width:50%\">
        <th>First Name</th>
        <th>Last Name</th>
        <th>Number Leafs of Games Officiated</th>
    </tr>";
    while ($row4 = pg_fetch_array($winsr)) {
      echo "<tr>";
      echo("<td>".$row4["firstname"]."</td>");
      echo("<td>".$row4["lastname"]."</td>");
      echo("<td>".$row4["cg"]."</td>");
      echo "</tr>";
    }
  }

  //Free Results
  pg_free_result($gamer);
  pg_free_result($officialr);
  pg_free_result($lossesr);
  pg_free_result($winsr);
  pg_close($connection);
?>
