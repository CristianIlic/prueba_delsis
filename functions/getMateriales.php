<?php
include __DIR__ . '/../config/db.php';

function getMateriales()
{
  global $pdo;
  $stmt = $pdo->query("SELECT * FROM material");
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
};
