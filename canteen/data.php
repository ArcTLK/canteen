<?php
//setting header to json
header('Content-Type: application/json');

require_once 'connection.php';

//query to get data from the table
$query = '
  SELECT createdAt AS `date`, SUM(amount) AS amount
    FROM (
      SELECT DATE(createdAt) AS createdAt, amount
        FROM transactions
    ) sub
  GROUP BY createdAt
  ORDER BY createdAt
';

//execute query
$result = $pdo->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//now print the data
print json_encode($data);