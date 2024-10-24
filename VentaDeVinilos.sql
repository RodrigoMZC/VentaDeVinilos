CREATE DATABASE ventaDeVinilos;

USE ventaDeVinilos;

CREATE TABLE artista (
	art_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    art_nombre VARCHAR(255) NOT NULL,
    art_desc TEXT NOT NULL,
    art_fNacim DATE NOT NULL,
    art_lugNaci VARCHAR(255) NOT NULL,
    art_imgURL VARCHAR(255) NOT NULL
);
CREATE INDEX idx_anrtista_Nombre ON artista(art_nombre);

ALTER TABLE artista MODIFY COLUMN art_fNacim YEAR NOT NULL;

CREATE TABLE genero (
	gen_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    gen_gen VARCHAR(100) NOT NULL,
    gen_imgURL VARCHAR(255) NULL
);

CREATE TABLE art_gen (
	art_id INTEGER NOT NULL,
    gen_id INTEGER NOT NULL,
	PRIMARY KEY (art_id, gen_id),
    FOREIGN KEY (art_id) REFERENCES artista (art_id),
    FOREIGN KEY (gen_id) REFERENCES genero (gen_id)
);

CREATE TABLE selloDiscografico (
	sello_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    sello_nombre VARCHAR(255) NOT NULL,
    sello_fCreacion DATE NOT NULL,
    sello_pais VARCHAR(255) NOT NULL
);

CREATE TABLE vinilo (
	vin_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    vin_nombre VARCHAR(255) NOT NULL,
    vin_fLanz DATE NOT NULL,
    vin_stok INTEGER NOT NULL DEFAULT(0),
    vin_imgURL VARCHAR(255) NULL,
    art_id INTEGER NOT NULL,
    sello_id INTEGER NOT NULL,
    FOREIGN KEY (sello_id) REFERENCES selloDiscografico (sello_id),
    FOREIGN KEY (art_id) REFERENCES artista (art_id)
);
CREATE INDEX idx_vinilo_nombre ON vinilo(vin_nombre);

CREATE TABLE gen_vin (
	gen_id INTEGER NOT NULL,
    vin_id INTEGER NOT NULL,
    PRIMARY KEY (gen_id, vin_id),
    FOREIGN KEY (gen_id) REFERENCES genero (gen_id),
    FOREIGN KEY (vin_id) REFERENCES vinilo (vin_id)
);

CREATE TABLE cancion (
	can_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    can_nombre VARCHAR(255) NOT NULL,
    can_duracion TIME NOT NULL,
    vin_id INTEGER NOT NULL,
    FOREIGN KEY (vin_id) REFERENCES vinilo (vin_id)
);

CREATE INDEX idx_cancion_nombre ON cancion (can_nombre);

CREATE TABLE can_art (
	can_id INTEGER NOT NULL,
    art_id INTEGER NOT NULL,
    PRIMARY KEY (can_id, art_id),
    FOREIGN KEY (can_id) REFERENCES cancion (can_id),
    FOREIGN KEY (art_id) REFERENCES artista (art_id)
);

CREATE TABLE usuario (
	usr_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    usr_usuario VARCHAR(100) NOT NULL UNIQUE,
    usr_pword VARBINARY(255) NOT NULL,
    usr_fCreacion DATETIME DEFAULT(NOW())
); 

CREATE TABLE cliente (
	cli_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    cli_email VARCHAR(255) NOT NULL UNIQUE,
    cli_nombre VARCHAR(100) NOT NULL, 
    cli_sNombre VARCHAR(100) NULL,
    cli_apelloidos VARCHAR(255) NOT NULL,
    cli_fNacimiento DATE NOT NULL,
    cli_edad INTEGER NOT NULL,
    cli_rfc VARCHAR(255) NOT NULL UNIQUE,
    usr_id INTEGER NOT NULL,
    FOREIGN KEY (usr_id) REFERENCES usuario (usr_id)
);

CREATE TABLE direccion (
	dir_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    dir_estado VARCHAR(255) NOT NULL,
    dir_ciudad VARCHAR(255) NOT NULL,
    dir_cPostal CHAR(5) NOT NULL,
    dic_direccion VARCHAR(255) NOT NULL,
    dir_descrip VARCHAR(255) NOT NULL,
    cli_id INTEGER NOT NULL,
    FOREIGN KEY (cli_id) REFERENCES cliente (cli_id)
);

CREATE TABLE tarjeta (
	tar_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    tar_numTarjeta CHAR(16) NOT NULL,
    tar_nombre VARCHAR(255) NOT NULL,
    tar_fCadu DATE NOT NULL,
    tar_cv VARCHAR(4) NULL,
    cli_id INTEGER NOT NULL,
    FOREIGN KEY (cli_id) REFERENCES cliente (cli_id)
);

CREATE TABLE compra (
	comp_id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
    comp_status VARCHAR(255) NOT NULL,
	comp_fPedio DATE NOT NULL,
    comp_fEntrega DATETIME NULL,
    comp_total DECIMAL(10,2),
    tar_id INTEGER NOT NULL,
    FOREIGN KEY (tar_id) REFERENCES tarjeta (tar_id)
);

CREATE TABLE comp_vin (
	comp_id INTEGER NOT NULL,
    vin_id INTEGER NOT NULL,
    PRIMARY KEY (comp_id, vin_id),
    FOREIGN KEY (comp_id) REFERENCES compra (comp_id),
    FOREIGN KEY (vin_id) REFERENCES vinilo (vin_id)
);

CREATE TABLE comp_usr (
	comp_id INTEGER NOT NULL,
    usr_id INTEGER NOT NULL,
    PRIMARY KEY (comp_id, usr_id),
    FOREIGN KEY (comp_id) REFERENCES compra (comp_id),
    FOREIGN KEY (usr_id) REFERENCES usuario (usr_id)
);

-- //////// ( N0 ES NECESRIO HASHEAR EN BASE DE DATOS SI SE HASHEA CORRECTAMENTE EN BACKEND ) //////// -- 



-- Generos --
INSERT INTO genero (gen_gen) VALUES
('Rock'), ('Jazz'), ('Blues'), ('Soul'), ('Funk'), ('Reggae'), ('Pop'), ('Hip-Hop'), ('Electrónica'), ('Metal'), ('Punk'), ('Country'), ('Clásica'), ('Folk'), ('R&B');

-- ------------------- INSERTAR EN artista ------------------- --
DELIMITER //
CREATE PROCEDURE insert_artista (
	IN p_art_nombre VARCHAR(255),
    IN p_art_desc TEXT,
    IN p_art_fNacim YEAR,
    IN p_art_lugNaci VARCHAR(255),
    IN p_art_imgURL VARCHAR(255)
)
	BEGIN 
		INSERT INTO artista(art_nombre, art_desc, art_fNacim, art_lugNaci, art_imgURL)
        VALUES (p_art_nombre,  p_art_desc, p_art_fNacim, p_art_lugNaci, p_art_imgURL);
	END //
DELIMITER ;

CALL insert_artista('Panic! At the Disco', 'When Panic! At the Disco’s Brendon Urie joined the cast of the Broadway show Kinky Boots in 2017, it was like a prophecy fulfilled. After all, Panic! had always, on some level, been an excuse for Urie and his bandmates to dress up, to cultivate their inner thespian with as much flair as possible. Even in their early, post-emo days, the band’s music felt like an ornately tailored garment, every square inch fussed over with a care that verged on obsessive. By the maximalist pop of 2016’s Death of a Bachelor, Urie was invoking his passion for Frank Sinatra—with the caveat that one of his first impressions of the singer was the Sinatra-esque sword crooning “Witchcraft” in the animated movie Who Framed Roger Rabbit: A bright, shiny cartoon.
Formed by a group of childhood friends in 2004, the band was part of a wave of artists—including My Chemical Romance and Fall Out Boy, whose Pete Wentz was an early booster—who played what was effectively a pop-punk take on musical theatre: dandyish and self-consciously overblown, but with a sense of uplift that made them manna for their fans. That Urie had grown up near the Vegas Strip watching stuff like Cirque du Soleil and Blue Man Group made sense; that the band’s live act eventually incorporated stilt walkers, contortionists and ribbon dancers made more: Panic! was here to give you a show.
Over the years, the group’s sound moved closer to the polish and style of mainstream pop while retaining the kind of high-drama pith that made them fodder for yearbook quotes and Instagram captions the world over. A series of lineup changes—including the departure of original lyricist Ryan Ross and, later, primary songwriter Spencer Smith—effectively stripped Panic! down to a solo project. Urie honed his idiosyncrasies further on 2018’s Pray for the Wicked, joining his Rat Pack and swing-kid proclivities with hip-hop, R&B and dance music.', 
'2004', 'Las Vegas, NV, United States', 'https://rodrigomzc-multiple-susos.s3.us-east-2.amazonaws.com/Images/PanicAtTheDisco_P.png');

CALL insert_artista('Caifanes', 'Caifanes are the quintessential Mexican rock band. In many ways, they were the group that brought rock music out of obscurity in their home country and propelled it to the masses, packing stadiums and large auditoriums with classic anthems like “Viento” (1988) and “Afuera” (1994). Named after the classic 1967 Mexican film Los caifanes, the group was formed by lead singer Saúl Hernández in the late ‘80s as an offshoot of Las Insólitas Imágenes de Aurora. Their early look, showcased on the album cover of their 1988 self-titled debut, borrowed heavily from gothic rock of the era (most notably The Cure). Yet by their second album, El Diablito (1990), the group was delving head-on into folklore and mysticism in songs like “Los Dioses Ocultos” and “La Célula Que Explota”, the latter of which fused elements of mariachi with rock, foreshadowing the band’s future sound and aesthetic. It was their third album El Silencio (1992)––produced by Adrian Belew, who worked with legendary acts like David Bowie and Talking Heads––that would catapult them to international stardom with memorable songs like “Nubes” and “No Dejes Que…”. Though the group would only release one more album before dissolving, El Nervio del Volcán (1994), their legacy lived on through their spiritual successor group Jaguares.' ,
'1987', 'Mexico City, Mwxico', 'https://rodrigomzc-multiple-susos.s3.us-east-2.amazonaws.com/Images/Caifanes_P.jpeg');

INSERT INTO selloDiscografico (sello_nombre, sello_fCreacion, sello_pais) VALUES
('Universal Music Group', '1934-03-01', 'United States'),
('Sony Music Entertainment', '1929-01-01', 'Japan'),
('Warner Music Group', '1958-02-25', 'United States'),
('EMI Music', '1931-03-14', 'United Kingdom'),
('Island Records', '1959-05-22', 'United Kingdom');

-- ------------------- INSERTAR EN vinilo ------------------- --
DELIMITER //
CREATE PROCEDURE insertarVinilo(
    IN p_vin_nombre VARCHAR(255),
    IN p_vin_fLanz DATE,
    IN p_vin_stok INTEGER,
    IN p_vin_imgURL VARCHAR(255),
    IN p_art_nombre VARCHAR(255),
    IN p_sello_nombre VARCHAR(255)
)
BEGIN
    DECLARE v_art_id INTEGER;
    DECLARE v_sello_id INTEGER;

    -- Obtener el art_id correspondiente al art_nombre
    SELECT art_id INTO v_art_id
    FROM artista
    WHERE art_nombre = p_art_nombre
    LIMIT 1;

    -- Obtener el sello_id correspondiente al sello_nombre
    SELECT sello_id INTO v_sello_id
    FROM selloDiscografico
    WHERE sello_nombre = p_sello_nombre
    LIMIT 1;

    -- Insertar en la tabla vinilo
    INSERT INTO vinilo (vin_nombre, vin_fLanz, vin_stok, vin_imgURL, art_id, sello_id)
    VALUES (p_vin_nombre, p_vin_fLanz, p_vin_stok, p_vin_imgURL, v_art_id, v_sello_id);
END //
DELIMITER ;


