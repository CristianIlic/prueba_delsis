CREATE TABLE bodega (
    bodega_id SERIAL PRIMARY KEY,
    bodega_nombre CHARACTER VARYING(100) NOT NULL
);

CREATE TABLE divisa (
    divisa_id SERIAL PRIMARY KEY,
    divisa_nombre CHARACTER VARYING(50) NOT NULL
);

CREATE TABLE sucursal (
    sucursal_id SERIAL PRIMARY KEY,
    sucursal_nombre CHARACTER VARYING(100) NOT NULL,
    bodega_id INTEGER NOT NULL,
    CONSTRAINT fk_sucursal_bodega FOREIGN KEY (bodega_id) REFERENCES bodega(bodega_id)
);

CREATE TABLE producto (
    producto_id CHARACTER VARYING(15) PRIMARY KEY,
    producto_nombre CHARACTER VARYING(50) NOT NULL,
    producto_precio NUMERIC(15,2) NOT NULL CHECK (producto_precio >= 0),
    producto_descripcion TEXT NOT NULL, 
    bodega_id INTEGER NOT NULL,
    sucursal_id INTEGER NOT NULL,
    divisa_id INTEGER NOT NULL,
    CONSTRAINT fk_producto_bodega FOREIGN KEY (bodega_id) REFERENCES bodega(bodega_id),
    CONSTRAINT fk_producto_sucursal FOREIGN KEY (sucursal_id) REFERENCES sucursal(sucursal_id),
    CONSTRAINT fk_producto_divisa FOREIGN KEY (divisa_id) REFERENCES divisa(divisa_id),
    CONSTRAINT uq_producto_id UNIQUE (producto_id),
    CONSTRAINT ck_producto_id CHECK (LENGTH(producto_id) BETWEEN 5 AND 15),
    CONSTRAINT ck_producto_nombre CHECK (LENGTH(producto_nombre) BETWEEN 2 AND 50),
    CONSTRAINT ck_producto_descripcion CHECK (LENGTH(producto_descripcion) BETWEEN 10 AND 1000)
);

CREATE TABLE material (
    material_id SERIAL PRIMARY KEY,
    material_nombre CHARACTER VARYING(20) NOT NULL
);

CREATE TABLE producto_material (
    producto_id CHARACTER VARYING(15) NOT NULL,
    material_id INTEGER NOT NULL,
    PRIMARY KEY (producto_id, material_id),
    CONSTRAINT fk_producto_material_producto FOREIGN KEY (producto_id) REFERENCES producto(producto_id),
    CONSTRAINT fk_producto_material_material FOREIGN KEY (material_id) REFERENCES material(material_id)
);

