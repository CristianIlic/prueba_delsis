<?php
foreach (glob(__DIR__ . "/functions/*.php") as $functions) {
  include_once $functions;
}

$bodegas = getBodegas();
$materiales = getMateriales();
$divisas = getDivisas();
$bodega_id = isset($_GET['bodega_id']) ? $_GET['bodega_id'] : 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario de Producto</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <div class="container">
    <h1>Formulario de Producto</h1>
    <form id="product-form">
      <div class="form-container">
        <div class="form-group">
          <label for="codigo">Código</label>
          <input type="text" id="codigo" value="" />
        </div>
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" value="" />
        </div>
        <div class="form-group">
          <label for="bodega">Bodega</label>
          <select id="bodega">
            <option value=""></option>
            <?php foreach ($bodegas as $bodega): ?>
              <option value="<?php echo $bodega['bodega_id']; ?>" <?php echo ($bodega['bodega_id'] == $bodega_id) ? 'selected' : ''; ?>>
                <?php echo $bodega['bodega_nombre']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="sucursal">Sucursal</label>
          <select id="sucursal">
            <option value=""></option>
            <?php foreach ($sucursales as $sucursal): ?>
              <option value="<?php echo $sucursal['sucursal_id']; ?>"><?php echo $sucursal['sucursal_nombre']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="moneda">Moneda</label>
          <select id="moneda">
            <option value=""></option>
            <?php foreach ($divisas as $divisa): ?>
              <option value="<?php echo $divisa['divisa_id']; ?>"><?php echo $divisa['divisa_nombre']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="number" id="precio" step=".01" value="" />
        </div>
        <div class="form-group full-width">
          <label>Material del Producto</label>
          <div class="checkbox-container" id="material">
            <?php foreach ($materiales as $material): ?>
              <label><input type="checkbox" value="<?php echo $material['material_id'] ?>" /> <?php echo $material['material_nombre']; ?></label>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="form-group full-width">
          <label for="descripcion">Descripción</label>
          <textarea id="descripcion" rows="4"> </textarea>
        </div>
      </div>
      <div class="button-container">
        <button type="submit" class="btn">Guardar Producto</button>
      </div>
    </form>
  </div>

  <script src="script.js"></script>
</body>

</html>