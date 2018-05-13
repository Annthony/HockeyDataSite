<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Assignment 3 Hockey Website lol</title>
</head>
<body>
<?php
  include 'connectdb.php';
?>
<h1> Ze Hockey Team Website </h1>
By Anthony Tran, username, 250 xxx xxx <br/>
CS3319 Assignment 3, Due Dec. 4, 2017 <br/>

<br/>

<h2> Team Data </h2>
<form action="index2.php" method="post">
  <?php
    include 'getteamdata.php';
  ?>
  Choose to re-order by <br/>
  <input type="radio" name="option1" value="TeamName"> Team Name <br/>
  <input type="radio" name="option1" value="TeamCity"> Team City <br/>
  <input type="submit">
</form>

<br/><br/>

<h2> Insert a new Team </h2>
<form action="insertteam.php" method="post">
  Team ID: <input type="text" name="teamid"/>
  <br/>
  Team Name: <input type="text" name="teamname"/>
  <br/>
  Team City: <input type="text" name="teamcity"/>
  <br/>
  <input type="submit" name="Insert Team" value="Insert Team">
</form>

<br/><br/>

<h2> Delete a Team </h2>
<form action="deleteteam.php" method="post">
  Team ID: <input type="text" name="teamid"/>
  <br/>
  <input type="submit" name="Delete Team" value="Delete Team">
</form>

<br/><br/>

<h2> Update a Game City </h2>
<form action="updategamecity.php" method="post">
  Choose a Game ID: <br/>
  <select name="gameidoption">
    <?php
      include 'updategamecity.php';
    ?>
  </select>
  <br/>
  New Game City: <input type="text" name="newgamecity"/>
  <br/>
  <input type="submit" name="Update City" value="Update City">
</form>

<br/><br/>

<h2> View Game Information </h2>
<form action="viewgame.php" method="post">
  Choose a Game ID: <br/>
  <select name="gameidoption">
    <?php
      include 'updategamecity.php'; //re-use to show game id options
    ?>
  </select>
  <br/>
  <input type="submit" name="View Game" value="View Game">
</form>

<br/><br/>

<h2> List of Officials </h2>
<?php
  include 'listofficials.php';
?>

<br/><br/>

<h2> For the salty and cursed Maple Leafs </h2>
<form action="index2.php" method="post">
  Choose to view: <br/>
  <input type="radio" name="option" value="gamestats"> Game Stats for all Leafs games<br/>
  <input type="radio" name="option" value="official"> Official who officiated the most Leafs games <br/>
  <input type="radio" name="option" value="losses"> Official who officiated the most Leafs losses <br/>
  <input type="radio" name="option" value="wins"> Official who officiated the most Leafs wins <br/>
  <input type="submit" value="Display">
</form>
<?php
  include 'getleafsdata.php';
?>
<?php
  pg_close($connection);
?>
</body>
</html>
