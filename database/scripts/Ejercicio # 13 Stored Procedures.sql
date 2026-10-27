-- ============================================================
-- TourSystem - Stored Procedures
-- Base de datos: Destinos_Soñados_SA
-- Ejecutar en MySQL Workbench UNA SOLA VEZ
-- ============================================================

USE Destinos_Soñados_SA;

-- ============================================================
-- DESTINO TURÍSTICO
-- ============================================================
DROP PROCEDURE IF EXISTS sp_destino_insert;
DROP PROCEDURE IF EXISTS sp_destino_update;
DROP PROCEDURE IF EXISTS sp_destino_delete;
DROP PROCEDURE IF EXISTS sp_destino_get_by_id;
DROP PROCEDURE IF EXISTS sp_destino_get_all;

DELIMITER //

CREATE PROCEDURE sp_destino_insert(
    IN p_codigo VARCHAR(20),
    IN p_nombre VARCHAR(150),
    IN p_latitud DECIMAL(9,6),
    IN p_longitud DECIMAL(9,6),
    IN p_descripcion TEXT,
    IN p_popularidad TINYINT,
    IN p_restricciones TEXT,
    IN p_id_tipo INT,
    IN p_id_pais INT,
    IN p_id_region INT
)
BEGIN
    INSERT INTO Destino_Turistico
    (codigo, nombre, latitud, longitud, descripcion, nivel_popularidad,
     restricciones, id_tipo_destino, id_pais, id_region)
    VALUES
    (p_codigo, p_nombre, p_latitud, p_longitud, p_descripcion, p_popularidad,
     p_restricciones, p_id_tipo, p_id_pais, p_id_region);
    SELECT LAST_INSERT_ID() AS id_generado;
END //

CREATE PROCEDURE sp_destino_update(
    IN p_id INT,
    IN p_codigo VARCHAR(20),
    IN p_nombre VARCHAR(150),
    IN p_latitud DECIMAL(9,6),
    IN p_longitud DECIMAL(9,6),
    IN p_descripcion TEXT,
    IN p_popularidad TINYINT,
    IN p_restricciones TEXT,
    IN p_id_tipo INT,
    IN p_id_pais INT,
    IN p_id_region INT
)
BEGIN
    UPDATE Destino_Turistico
    SET codigo = p_codigo,
        nombre = p_nombre,
        latitud = p_latitud,
        longitud = p_longitud,
        descripcion = p_descripcion,
        nivel_popularidad = p_popularidad,
        restricciones = p_restricciones,
        id_tipo_destino = p_id_tipo,
        id_pais = p_id_pais,
        id_region = p_id_region
    WHERE id_destino = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_destino_delete(
    IN p_id INT
)
BEGIN
    DELETE FROM Destino_Turistico WHERE id_destino = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_destino_get_by_id(
    IN p_id INT
)
BEGIN
    SELECT d.*, 
           td.nombre AS tipo_nombre,
           p.nombre AS pais_nombre,
           r.nombre AS region_nombre
    FROM Destino_Turistico d
    LEFT JOIN Tipo_Destino td ON d.id_tipo_destino = td.id_tipo_destino
    LEFT JOIN Pais p ON d.id_pais = p.id_pais
    LEFT JOIN Region r ON d.id_region = r.id_region
    WHERE d.id_destino = p_id;
END //

CREATE PROCEDURE sp_destino_get_all()
BEGIN
    SELECT d.*, 
           td.nombre AS tipo_nombre,
           p.nombre AS pais_nombre,
           r.nombre AS region_nombre
    FROM Destino_Turistico d
    LEFT JOIN Tipo_Destino td ON d.id_tipo_destino = td.id_tipo_destino
    LEFT JOIN Pais p ON d.id_pais = p.id_pais
    LEFT JOIN Region r ON d.id_region = r.id_region
    ORDER BY d.id_destino DESC;
END //

DELIMITER ;


#########################################

DROP PROCEDURE IF EXISTS sp_cliente_insert;
DROP PROCEDURE IF EXISTS sp_cliente_update;
DROP PROCEDURE IF EXISTS sp_cliente_delete;
DROP PROCEDURE IF EXISTS sp_cliente_get_by_id;
DROP PROCEDURE IF EXISTS sp_cliente_get_all;

DELIMITER //

CREATE PROCEDURE sp_cliente_insert(
    IN p_codigo VARCHAR(20),
    IN p_nombres VARCHAR(200),
    IN p_documento VARCHAR(30),
    IN p_nacionalidad VARCHAR(100),
    IN p_direccion VARCHAR(200),
    IN p_telefono VARCHAR(10),
    IN p_correo VARCHAR(150),
    IN p_fidelizacion VARCHAR(100),
    IN p_id_tipo_cliente INT
)
BEGIN
    INSERT INTO Cliente
    (codigo, nombres_razon_social, documento, nacionalidad, direccion,
     telefono, correo, programa_fidelizacion, id_tipo_cliente)
    VALUES
    (p_codigo, p_nombres, p_documento, p_nacionalidad, p_direccion,
     p_telefono, p_correo, p_fidelizacion, p_id_tipo_cliente);
    SELECT LAST_INSERT_ID() AS id_generado;
END //

CREATE PROCEDURE sp_cliente_update(
    IN p_id INT,
    IN p_codigo VARCHAR(20),
    IN p_nombres VARCHAR(200),
    IN p_documento VARCHAR(30),
    IN p_nacionalidad VARCHAR(100),
    IN p_direccion VARCHAR(200),
    IN p_telefono VARCHAR(10),
    IN p_correo VARCHAR(150),
    IN p_fidelizacion VARCHAR(100),
    IN p_id_tipo_cliente INT
)
BEGIN
    UPDATE Cliente
    SET codigo = p_codigo,
        nombres_razon_social = p_nombres,
        documento = p_documento,
        nacionalidad = p_nacionalidad,
        direccion = p_direccion,
        telefono = p_telefono,
        correo = p_correo,
        programa_fidelizacion = p_fidelizacion,
        id_tipo_cliente = p_id_tipo_cliente
    WHERE id_cliente = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_cliente_delete(
    IN p_id INT
)
BEGIN
    DELETE FROM Cliente WHERE id_cliente = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_cliente_get_by_id(
    IN p_id INT
)
BEGIN
    SELECT c.*, tc.nombre AS tipo_cliente_nombre
    FROM Cliente c
    LEFT JOIN Tipo_Cliente tc ON c.id_tipo_cliente = tc.id_tipo_cliente
    WHERE c.id_cliente = p_id;
END //

CREATE PROCEDURE sp_cliente_get_all()
BEGIN
    SELECT c.*, tc.nombre AS tipo_cliente_nombre
    FROM Cliente c
    LEFT JOIN Tipo_Cliente tc ON c.id_tipo_cliente = tc.id_tipo_cliente
    ORDER BY c.id_cliente DESC;
END //

DELIMITER ;

#########################################
-- ============================================================
-- RESERVA
-- ============================================================
DROP PROCEDURE IF EXISTS sp_reserva_insert;
DROP PROCEDURE IF EXISTS sp_reserva_update;
DROP PROCEDURE IF EXISTS sp_reserva_delete;
DROP PROCEDURE IF EXISTS sp_reserva_get_by_id;
DROP PROCEDURE IF EXISTS sp_reserva_get_all;

DELIMITER //

CREATE PROCEDURE sp_reserva_insert(
    IN p_numero VARCHAR(20),
    IN p_fecha_inicio DATE,
    IN p_fecha_fin DATE,
    IN p_adultos SMALLINT,
    IN p_ninos SMALLINT,
    IN p_solicitudes TEXT,
    IN p_precio DECIMAL(10,2),
    IN p_abonos DECIMAL(10,2),
    IN p_estado VARCHAR(50),
    IN p_id_cliente INT,
    IN p_id_metodo INT,
    IN p_id_paquete INT,
    IN p_id_guia INT
)
BEGIN
    INSERT INTO Reserva
    (numero_reserva, fecha_creacion, fecha_inicio, fecha_fin,
     cantidad_adultos, cantidad_ninos, solicitudes_especiales,
     precio_total, abonos_realizados, saldo_pendiente, estado,
     id_cliente, id_metodo_pago, id_paquete, id_guia)
    VALUES
    (p_numero, NOW(), p_fecha_inicio, p_fecha_fin,
     p_adultos, p_ninos, p_solicitudes,
     p_precio, p_abonos, (p_precio - p_abonos), p_estado,
     p_id_cliente, p_id_metodo, p_id_paquete, p_id_guia);
    SELECT LAST_INSERT_ID() AS id_generado;
END //

CREATE PROCEDURE sp_reserva_update(
    IN p_id INT,
    IN p_numero VARCHAR(20),
    IN p_fecha_inicio DATE,
    IN p_fecha_fin DATE,
    IN p_adultos SMALLINT,
    IN p_ninos SMALLINT,
    IN p_solicitudes TEXT,
    IN p_precio DECIMAL(10,2),
    IN p_abonos DECIMAL(10,2),
    IN p_estado VARCHAR(50),
    IN p_id_cliente INT,
    IN p_id_metodo INT,
    IN p_id_paquete INT,
    IN p_id_guia INT
)
BEGIN
    UPDATE Reserva
    SET numero_reserva = p_numero,
        fecha_inicio = p_fecha_inicio,
        fecha_fin = p_fecha_fin,
        cantidad_adultos = p_adultos,
        cantidad_ninos = p_ninos,
        solicitudes_especiales = p_solicitudes,
        precio_total = p_precio,
        abonos_realizados = p_abonos,
        saldo_pendiente = (p_precio - p_abonos),
        estado = p_estado,
        id_cliente = p_id_cliente,
        id_metodo_pago = p_id_metodo,
        id_paquete = p_id_paquete,
        id_guia = p_id_guia
    WHERE id_reserva = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_reserva_delete(
    IN p_id INT
)
BEGIN
    DELETE FROM Reserva WHERE id_reserva = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_reserva_get_by_id(
    IN p_id INT
)
BEGIN
    SELECT r.*,
           c.nombres_razon_social AS cliente_nombre,
           p.nombre_comercial AS paquete_nombre,
           g.nombres AS guia_nombres, g.apellidos AS guia_apellidos,
           mp.nombre AS metodo_pago_nombre
    FROM Reserva r
    LEFT JOIN Cliente c ON r.id_cliente = c.id_cliente
    LEFT JOIN Paquete_Turistico p ON r.id_paquete = p.id_paquete
    LEFT JOIN Guia_Turistico g ON r.id_guia = g.id_guia
    LEFT JOIN Metodo_Pago mp ON r.id_metodo_pago = mp.id_metodo_pago
    WHERE r.id_reserva = p_id;
END //

CREATE PROCEDURE sp_reserva_get_all()
BEGIN
    SELECT r.*,
           c.nombres_razon_social AS cliente_nombre,
           p.nombre_comercial AS paquete_nombre,
           g.nombres AS guia_nombres, g.apellidos AS guia_apellidos,
           mp.nombre AS metodo_pago_nombre
    FROM Reserva r
    LEFT JOIN Cliente c ON r.id_cliente = c.id_cliente
    LEFT JOIN Paquete_Turistico p ON r.id_paquete = p.id_paquete
    LEFT JOIN Guia_Turistico g ON r.id_guia = g.id_guia
    LEFT JOIN Metodo_Pago mp ON r.id_metodo_pago = mp.id_metodo_pago
    ORDER BY r.id_reserva DESC;
END //

DELIMITER ;

#####################################

-- ============================================================
-- PAQUETE TURÍSTICO
-- ============================================================
DROP PROCEDURE IF EXISTS sp_paquete_insert;
DROP PROCEDURE IF EXISTS sp_paquete_update;
DROP PROCEDURE IF EXISTS sp_paquete_delete;
DROP PROCEDURE IF EXISTS sp_paquete_get_by_id;
DROP PROCEDURE IF EXISTS sp_paquete_get_all;

DELIMITER //

CREATE PROCEDURE sp_paquete_insert(
    IN p_codigo VARCHAR(20),
    IN p_nombre VARCHAR(150),
    IN p_dias TINYINT,
    IN p_noches TINYINT,
    IN p_precio DECIMAL(10,2),
    IN p_min_participantes SMALLINT,
    IN p_dificultad TINYINT,
    IN p_id_transporte INT,
    IN p_id_categoria INT,
    IN p_id_regimen INT
)
BEGIN
    INSERT INTO Paquete_Turistico
    (codigo, nombre_comercial, duracion_dias, duracion_noches, precio_base,
     minimo_participantes, nivel_dificultad, id_tipo_transporte,
     id_categoria_alojamiento, id_regimen)
    VALUES
    (p_codigo, p_nombre, p_dias, p_noches, p_precio,
     p_min_participantes, p_dificultad, p_id_transporte,
     p_id_categoria, p_id_regimen);
    SELECT LAST_INSERT_ID() AS id_generado;
END //

CREATE PROCEDURE sp_paquete_update(
    IN p_id INT,
    IN p_codigo VARCHAR(20),
    IN p_nombre VARCHAR(150),
    IN p_dias TINYINT,
    IN p_noches TINYINT,
    IN p_precio DECIMAL(10,2),
    IN p_min_participantes SMALLINT,
    IN p_dificultad TINYINT,
    IN p_id_transporte INT,
    IN p_id_categoria INT,
    IN p_id_regimen INT
)
BEGIN
    UPDATE Paquete_Turistico
    SET codigo = p_codigo,
        nombre_comercial = p_nombre,
        duracion_dias = p_dias,
        duracion_noches = p_noches,
        precio_base = p_precio,
        minimo_participantes = p_min_participantes,
        nivel_dificultad = p_dificultad,
        id_tipo_transporte = p_id_transporte,
        id_categoria_alojamiento = p_id_categoria,
        id_regimen = p_id_regimen
    WHERE id_paquete = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_paquete_delete(
    IN p_id INT
)
BEGIN
    DELETE FROM Paquete_Turistico WHERE id_paquete = p_id;
    SELECT ROW_COUNT() AS filas_afectadas;
END //

CREATE PROCEDURE sp_paquete_get_by_id(
    IN p_id INT
)
BEGIN
    SELECT p.*,
           tt.nombre AS transporte_nombre,
           ca.Estrellas AS categoria_estrellas,
           ra.nombre AS regimen_nombre
    FROM Paquete_Turistico p
    LEFT JOIN Tipo_Transporte tt ON p.id_tipo_transporte = tt.id_tipo_transporte
    LEFT JOIN Categoria_Alojamiento ca ON p.id_categoria_alojamiento = ca.id_categoria_alojamiento
    LEFT JOIN Regimen_Alimenticio ra ON p.id_regimen = ra.id_regimen
    WHERE p.id_paquete = p_id;
END //

CREATE PROCEDURE sp_paquete_get_all()
BEGIN
    SELECT p.*,
           tt.nombre AS transporte_nombre,
           ca.Estrellas AS categoria_estrellas,
           ra.nombre AS regimen_nombre
    FROM Paquete_Turistico p
    LEFT JOIN Tipo_Transporte tt ON p.id_tipo_transporte = tt.id_tipo_transporte
    LEFT JOIN Categoria_Alojamiento ca ON p.id_categoria_alojamiento = ca.id_categoria_alojamiento
    LEFT JOIN Regimen_Alimenticio ra ON p.id_regimen = ra.id_regimen
    ORDER BY p.id_paquete DESC;
END //

DELIMITER ;

##################################
-- ============================================================
-- SP DE COMBOS (para llenar Combobox en formularios)
-- ============================================================
DROP PROCEDURE IF EXISTS sp_combo_tipos_destino;
DROP PROCEDURE IF EXISTS sp_combo_paises;
DROP PROCEDURE IF EXISTS sp_combo_regiones;
DROP PROCEDURE IF EXISTS sp_combo_tipos_cliente;
DROP PROCEDURE IF EXISTS sp_combo_metodos_pago;
DROP PROCEDURE IF EXISTS sp_combo_guias;
DROP PROCEDURE IF EXISTS sp_combo_paquetes;
DROP PROCEDURE IF EXISTS sp_combo_clientes;
DROP PROCEDURE IF EXISTS sp_combo_tipos_transporte;
DROP PROCEDURE IF EXISTS sp_combo_categorias_alojamiento;
DROP PROCEDURE IF EXISTS sp_combo_regimenes;

DELIMITER //

CREATE PROCEDURE sp_combo_tipos_destino()
BEGIN
    SELECT id_tipo_destino AS id, nombre FROM Tipo_Destino ORDER BY nombre;
END //

CREATE PROCEDURE sp_combo_paises()
BEGIN
    SELECT id_pais AS id, nombre FROM Pais ORDER BY nombre;
END //

CREATE PROCEDURE sp_combo_regiones()
BEGIN
    SELECT id_region AS id, nombre FROM Region ORDER BY nombre;
END //

CREATE PROCEDURE sp_combo_tipos_cliente()
BEGIN
    SELECT id_tipo_cliente AS id, nombre FROM Tipo_Cliente ORDER BY nombre;
END //

CREATE PROCEDURE sp_combo_metodos_pago()
BEGIN
    SELECT id_metodo_pago AS id, nombre FROM Metodo_Pago ORDER BY nombre;
END //

CREATE PROCEDURE sp_combo_guias()
BEGIN
    SELECT id_guia AS id, CONCAT(nombres, ' ', apellidos) AS nombre
    FROM Guia_Turistico ORDER BY nombres;
END //

CREATE PROCEDURE sp_combo_paquetes()
BEGIN
    SELECT id_paquete AS id, nombre_comercial AS nombre
    FROM Paquete_Turistico ORDER BY nombre_comercial;
END //

CREATE PROCEDURE sp_combo_clientes()
BEGIN
    SELECT id_cliente AS id, nombres_razon_social AS nombre
    FROM Cliente ORDER BY nombres_razon_social;
END //

CREATE PROCEDURE sp_combo_tipos_transporte()
BEGIN
    SELECT id_tipo_transporte AS id, nombre FROM Tipo_Transporte ORDER BY nombre;
END //

CREATE PROCEDURE sp_combo_categorias_alojamiento()
BEGIN
    SELECT id_categoria_alojamiento AS id,
           CONCAT(Estrellas, ' estrellas') AS nombre
    FROM Categoria_Alojamiento ORDER BY Estrellas;
END //

CREATE PROCEDURE sp_combo_regimenes()
BEGIN
    SELECT id_regimen AS id, nombre FROM Regimen_Alimenticio ORDER BY nombre;
END //

DELIMITER ;

SELECT ROUTINE_NAME FROM information_schema.ROUTINES
WHERE ROUTINE_SCHEMA = 'Destinos_Soñados_SA'
ORDER BY ROUTINE_NAME;
