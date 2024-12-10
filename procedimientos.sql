DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizarDatosCliente`(
    IN p_usr_id INT,
    IN p_cli_email VARCHAR(255),
    IN p_cli_nombre VARCHAR(100),
    IN p_cli_sNombre VARCHAR(100),
    IN p_cli_apellidos VARCHAR(255),
    IN p_cli_fNacimiento DATE,
    IN p_cli_rfc VARCHAR(255)
)
BEGIN
    DECLARE cliente_id INT;

    -- Buscar el cli_id relacionado con el usr_id
    SELECT cli_id INTO cliente_id
    FROM cliente
    WHERE usr_id = p_usr_id;

    -- Actualizar los datos del cliente
    UPDATE cliente
    SET cli_email = p_cli_email,
        cli_nombre = p_cli_nombre,
        cli_sNombre = p_cli_sNombre,
        cli_apelloidos = p_cli_apellidos,
        cli_fNacimiento = p_cli_fNacimiento,
        cli_rfc = p_cli_rfc
    WHERE cli_id = cliente_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_estado_entrega`(
    IN p_comp_id INT
)
BEGIN
    -- Actualizar la compra: establecer el estado como "Entregado" y asignar la fecha de entrega actual
    UPDATE compra
    SET comp_status = 'Entregado',
        comp_fEntrega = NOW()  -- Establece la fecha de entrega actual
    WHERE comp_id = p_comp_id;
    
    -- Comprobar si la actualización fue exitosa
    IF ROW_COUNT() = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Compra no encontrada o no se pudo actualizar';
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarArtista`(
    IN nombre VARCHAR(255),
    IN descripcion TEXT,
    IN anioNacimiento YEAR,
    IN lugarNacimiento VARCHAR(255),
    IN imagenURL VARCHAR(255),
    IN generosJSON JSON
)
BEGIN
    -- Insertar en la tabla `artista`
    INSERT INTO artista (art_nombre, art_desc, art_fNacim, art_lugNaci, art_imgURL)
    VALUES (nombre, descripcion, anioNacimiento, lugarNacimiento, imagenURL);

    -- Obtener el ID del artista recién insertado
    SET @artista_id = LAST_INSERT_ID();

    -- Procesar géneros
    SET @index = 0;
    SET @total = JSON_LENGTH(generosJSON);

    WHILE @index < @total DO
        SET @gen_nombre = JSON_UNQUOTE(JSON_EXTRACT(generosJSON, CONCAT('$[', @index, ']')));
        INSERT INTO art_gen (art_id, gen_id)
        SELECT @artista_id, gen_id FROM genero WHERE gen_gen = @gen_nombre;
        SET @index = @index + 1;
    END WHILE;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregarVinilo`(
    IN nombreVinilo VARCHAR(255),
    IN fechaLanz DATE,
    IN stock INTEGER,
    IN imgURL VARCHAR(255),
    IN nombreArtista VARCHAR(255),
    IN precio DECIMAL(10, 2),
    IN generos JSON
)
BEGIN
    DECLARE viniloID INTEGER;
    DECLARE artistaID INTEGER;
    DECLARE generoID INTEGER;
    DECLARE generoNombre VARCHAR(100);
    DECLARE i INT DEFAULT 0;

    -- Buscar el ID del artista basado en su nombre
    SET artistaID = (SELECT art_id FROM artista WHERE art_nombre = nombreArtista);

    -- Si el artista no existe, lanzar un error
    IF artistaID IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El artista especificado no existe';
    END IF;

    -- Insertar el nuevo vinilo en la tabla vinilo
    INSERT INTO vinilo (vin_nombre, vin_fLanz, vin_stok, vin_imgURL, art_id, vin_precio)
    VALUES (nombreVinilo, fechaLanz, stock, imgURL, artistaID, precio);

    -- Obtener el ID del último vinilo insertado
    SET viniloID = LAST_INSERT_ID();

    -- Recorrer la lista de géneros (JSON array) y relacionarlos con el vinilo
    WHILE i < JSON_LENGTH(generos) DO
        SET generoNombre = JSON_UNQUOTE(JSON_EXTRACT(generos, CONCAT('$[', i, ']')));

        -- Buscar el ID del género basado en el nombre
        SET generoID = (SELECT gen_id FROM genero WHERE gen_gen = generoNombre);

        -- Si el género no existe, insertarlo y obtener su nuevo ID
        IF generoID IS NULL THEN
            INSERT INTO genero (gen_gen) VALUES (generoNombre);
            SET generoID = LAST_INSERT_ID();
        END IF;

        -- Insertar el vínculo en la tabla gen_vin
        INSERT INTO gen_vin (gen_id, vin_id) VALUES (generoID, viniloID);

        SET i = i + 1;
    END WHILE;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_direccion`(
    IN p_estado VARCHAR(255),
    IN p_ciudad VARCHAR(255),
    IN p_cPostal CHAR(5),
    IN p_direccion VARCHAR(255),
    IN p_descripcion VARCHAR(255),
    IN p_usr_id INT
)
BEGIN
    DECLARE cliente_id INT;
    SET cliente_id = (SELECT cli_id FROM cliente WHERE usr_id = p_usr_id);
    
    IF cliente_id IS NOT NULL THEN
        INSERT INTO direccion (dir_estado, dir_ciudad, dir_cPostal, dic_direccion, dir_descrip, cli_id)
        VALUES (p_estado, p_ciudad, p_cPostal, p_direccion, p_descripcion, cliente_id);
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se encontró cliente asociado al usuario';
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_user_and_client`(
    IN p_usuario VARCHAR(100),
    IN p_password VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_nombre VARCHAR(100),
    IN p_sNombre VARCHAR(100),
    IN p_apellidos VARCHAR(255),
    IN p_fNacimiento DATE,
    IN p_rfc VARCHAR(255)
)
BEGIN
    -- Insert into usuario table
    INSERT INTO usuario (usr_usuario, usr_pword)
    VALUES (p_usuario, p_password);  -- Use a strong hashing algorithm like PASSWORD()

    -- Get the last inserted user ID
    SET @last_user_id = LAST_INSERT_ID();

    -- Insert into cliente table
    INSERT INTO cliente (cli_email, cli_nombre, cli_sNombre, cli_apelloidos, cli_fNacimiento, cli_rfc, usr_id)
    VALUES (p_email, p_nombre, p_sNombre, p_apellidos, p_fNacimiento, p_rfc, @last_user_id);
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminarDireccionEspecifica`(
    IN p_usr_id INT,
    IN p_dir_descrip VARCHAR(255)
)
BEGIN
    DECLARE cliente_id INT;

    -- Buscar el cli_id relacionado con el usr_id
    SELECT cli_id INTO cliente_id
    FROM cliente
    WHERE usr_id = p_usr_id;

    -- Eliminar la dirección específica asociada a ese cli_id y p_dir_descrip
    DELETE FROM direccion
    WHERE cli_id = cliente_id
      AND dir_descrip = p_dir_descrip
    LIMIT 1;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_compra`(IN compra_id INT)
BEGIN
    -- Eliminar registros en comp_vin relacionados con la compra
    DELETE FROM comp_vin WHERE comp_id = compra_id;

    -- Eliminar la compra en la tabla compra
    DELETE FROM compra WHERE comp_id = compra_id;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `realizarCompra`(
    IN p_cli_id INT,          -- ID del cliente que realiza la compra
    IN p_direccion_id INT,
    IN p_carrito JSON         -- JSON con los productos del carrito
)
BEGIN
    DECLARE v_total DECIMAL(10,2) DEFAULT 0.00;
    DECLARE v_vin_id INT;
    DECLARE v_stock INT;
    DECLARE v_vin_nombre VARCHAR(255);
    DECLARE i INT DEFAULT 0;

    -- Calcular el total del carrito recorriendo los elementos JSON
    WHILE i < JSON_LENGTH(p_carrito) DO
        SET v_total = v_total + CAST(JSON_UNQUOTE(JSON_EXTRACT(p_carrito, CONCAT('$[', i, '].price'))) AS DECIMAL(10,2));
        SET i = i + 1;
    END WHILE;

    -- Validar que todos los productos en el carrito tengan stock disponible
    SET i = 0; -- Reiniciar el índice
    WHILE i < JSON_LENGTH(p_carrito) DO
        SET v_vin_id = JSON_UNQUOTE(JSON_EXTRACT(p_carrito, CONCAT('$[', i, '].id')));

        -- Consultar el stock disponible y el nombre del producto
        SELECT vin_stok, vin_nombre INTO v_stock, v_vin_nombre
        FROM vinilo
        WHERE vin_id = v_vin_id;

        -- Verificar si el stock es suficiente
        IF v_stock < 1 THEN
            SET @error_message = CONCAT('Stock insuficiente para el producto: ', v_vin_nombre);
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = @error_message;
        END IF;

        SET i = i + 1;
    END WHILE;

    -- Insertar la compra en la tabla "compra"
    INSERT INTO compra (cli_id, comp_status, comp_fPedio, comp_total)
    VALUES (p_cli_id, 'Pendiente', NOW(), v_total);

    -- Obtener el ID de la compra recién creada
    SET @comp_id = LAST_INSERT_ID();

    -- Registrar los productos en la tabla "comp_vin"
    SET i = 0; -- Reiniciar el índice
    WHILE i < JSON_LENGTH(p_carrito) DO
        SET v_vin_id = JSON_UNQUOTE(JSON_EXTRACT(p_carrito, CONCAT('$[', i, '].id')));

        -- Insertar el producto en la relación "comp_vin"
        INSERT INTO comp_vin (comp_id, vin_id)
        VALUES (@comp_id, v_vin_id);

        -- Actualizar el stock del producto
        UPDATE vinilo
        SET vin_stok = vin_stok - 1
        WHERE vin_id = v_vin_id;

        SET i = i + 1;
    END WHILE;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `realizar_compra`(
    IN p_cli_id INT,
    IN p_status VARCHAR(255),
    IN p_total DECIMAL(10,2),
    IN p_direccion_id INT,
    IN p_vinilos JSON -- JSON con formato [{"id":1}, {"id":3}]
)
BEGIN
    DECLARE v_comp_id INT;
    DECLARE viniloID INT;
    DECLARE i INT DEFAULT 0;

    -- Insertar la compra en la tabla `compra`
    INSERT INTO compra (cli_id, comp_status, comp_fPedio, comp_total)
    VALUES (p_cli_id, p_status, NOW(), p_total);

    -- Obtener el ID de la compra recién creada
    SET v_comp_id = LAST_INSERT_ID();

    -- Recorrer la lista de vinilos (JSON array) y relacionarlos con la compra
    WHILE i < JSON_LENGTH(p_vinilos) DO
        SET viniloID = JSON_UNQUOTE(JSON_EXTRACT(p_vinilos, CONCAT('$[', i, '].id')));

        -- Insertar el vínculo en la tabla comp_vin
        INSERT INTO comp_vin (comp_id, vin_id) VALUES (v_comp_id, viniloID);

        SET i = i + 1;
    END WHILE;

    -- Retornar el ID de la compra
    SELECT v_comp_id AS id_compra;
END$$
DELIMITER ;
