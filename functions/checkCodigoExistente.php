<?php
include __DIR__ . '/../config/db.php';

if (isset($_GET['codigo'])) {
  $codigo = $_GET['codigo'];

  $stmt = $pdo->prepare('SELECT 1 FROM producto WHERE producto_id = :codigo');
  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    echo json_encode(['exists' => true]);
  } else {
    echo json_encode(['exists' => false]);
  }
}
