<?php

function connectDatabase(): mysqli
{
  $host = 'localhost';
  $user = 'root';
  $password = 'Pochi-123';
  $database = 'bienesraices';
  $db = mysqli_connect($host, $user, $password, $database);

  if (!$db) exit;
  return $db;
}
