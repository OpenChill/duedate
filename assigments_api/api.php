<?php

require '../../connection.php';

header('Content-Type: application/json');

$result;
$sql;

if ($conn) {

  try {

    $sql = $conn->query("SELECT * FROM assigments");
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    $result = json_encode($result);

  } catch (PDOException $e) {

    $result = 'error with sql: ' . $e->getMessage();

  }

  } else {

  $result = 'error connecting to database.' . $e->getMessage();

}

echo $result;
