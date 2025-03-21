-- DATOS PARA TABLA BODEGA
INSERT INTO bodega (bodega_nombre) VALUES
('Bodega 1'),
('Bodega 2'),
('Bodega 3');

-- DATOS PARA TABLA DIVISA
INSERT INTO divisa (divisa_nombre) VALUES
('DÓLAR'),
('EURO'),
('PESOS CHILENOS');

-- DATOS PARA TABLA SUCURSAL
INSERT INTO sucursal (sucursal_nombre, bodega_id) VALUES
('Sucursal 1', 1),
('Sucursal 2', 1),
('Sucursal 3', 1),
('Sucursal 4', 2),
('Sucursal 5', 2),
('Sucursal 6', 2),
('Sucursal 7', 3),
('Sucursal 8', 3),
('Sucursal 9', 3);

/* DATOS PARA TABLA MATERIAL, CONSIDERÉ MÁS VIABLE TRAER LOS 
MATERIALES DESDE LA BB.DD AUNQUE NO LO PIDIERA LA PRUEBA */

INSERT INTO material (material_nombre) VALUES
('Plástico'),
('Metal'),
('Madera'),
('Vidrio'),
('Textil');

