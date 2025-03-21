<?php
include __DIR__ . '/../config/db.php';

function getBodegas()
{
  global $pdo;
  $stmt = $pdo->query("SELECT * FROM bodega");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
};
