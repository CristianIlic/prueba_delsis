<?php
include __DIR__ . '/../config/db.php';

function getSucursales($bodegaId)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM sucursal WHERE bodega_id = :bodega_id");
  $stmt->bindParam(':bodega_id', $bodegaId, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['bodega_id'])) {
  $bodegaId = $_GET['bodega_id'];
  $sucursales = getSucursales($bodegaId);
  echo json_encode($sucursales);
}
