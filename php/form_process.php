<?php
include(__DIR__ . '/../config/db.php');

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$bodega_id = $_POST['bodega'];
$sucursal_id = $_POST['sucursal'];
$moneda = $_POST['moneda'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$materiales = json_decode($_POST['materiales']);

try {
  $pdo->beginTransaction();

  $stmt = $pdo->prepare("INSERT INTO producto (producto_id, producto_nombre, bodega_id, divisa_id, sucursal_id, producto_precio, producto_descripcion) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->execute([$codigo, $nombre, $bodega_id, $moneda, $sucursal_id, $precio, $descripcion]);


  if (!empty($materiales)) {
    $stmt = $pdo->prepare("INSERT INTO producto_material (producto_id, material_id) VALUES (?, ?)");

    foreach ($materiales as $material_id) {
      $stmt->execute([$codigo, $material_id]);
    }
  }

  $pdo->commit();
  echo "Producto y materiales guardados exitosamente";
} catch (PDOException $e) {
  $pdo->rollBack();
  echo "Error: " . $e->getMessage();
}
