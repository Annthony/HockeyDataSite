<?php
  /*
   * PHP file for getting Official data
   */
  // error_reporting(0);
  include 'connectdb.php';

  //Query to get all Official Data ordered by Last Name
  $query='SELECT * FROM Official ORDER BY LastName';
  $result = pg_query($query);
  if (!$result) {
     die ("Database query failed!");
  }

  //Output the data in a table
  echo "*Ordered by Last Name. <br/>";
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
      <th>Official ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Home City</th>
  </tr>";

  while ($row = pg_fetch_array($result)) {
    echo "<tr>";
    echo("<td>".$row["officialid"]."</td>");
    echo("<td>".$row["firstname"]."</td>");
    echo("<td>".$row["lastname"]."</td>");
    echo("<td>".$row["homecity"]."</td>");
    echo "</tr>";
  }
  echo "</table>";

  //Free Results
  pg_free_result($result);
  pg_close($connection);
?>
