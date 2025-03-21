<?php

$host = 'localhost';
$port = 5432;
$dbname = 'prueba_delsis';
$user = 'postgres';
$password = 'tu_contraseña';

try {
  $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
  exit;
}
