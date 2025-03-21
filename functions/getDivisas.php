<?php
include __DIR__ . '/../config/db.php';

function getDivisas()
{
  global $pdo;
  $stmt = $pdo->query("SELECT * FROM divisa");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
};
