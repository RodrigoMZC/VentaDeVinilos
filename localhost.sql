-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 05-12-2024 a las 19:30:31
-- Versión del servidor: 5.7.39
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `alumnos`
--
CREATE DATABASE IF NOT EXISTS `alumnos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `alumnos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `correo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Base de datos: `ventaDeVinilos`
--
CREATE DATABASE IF NOT EXISTS `ventaDeVinilos` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ventaDeVinilos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

CREATE TABLE `artista` (
  `art_id` int(11) NOT NULL,
  `art_nombre` varchar(255) NOT NULL,
  `art_desc` text NOT NULL,
  `art_fNacim` year(4) NOT NULL,
  `art_lugNaci` varchar(255) NOT NULL,
  `art_imgURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `artista`
--

INSERT INTO `artista` (`art_id`, `art_nombre`, `art_desc`, `art_fNacim`, `art_lugNaci`, `art_imgURL`) VALUES
(3, 'Panic! At the Disco', 'When Panic! At the Disco’s Brendon Urie joined the cast of the Broadway show Kinky Boots in 2017, it was like a prophecy fulfilled. After all, Panic! had always, on some level, been an excuse for Urie and his bandmates to dress up, to cultivate their inner thespian with as much flair as possible. Even in their early, post-emo days, the band’s music felt like an ornately tailored garment, every square inch fussed over with a care that verged on obsessive. By the maximalist pop of 2016’s Death of a Bachelor, Urie was invoking his passion for Frank Sinatra—with the caveat that one of his first impressions of the singer was the Sinatra-esque sword crooning “Witchcraft” in the animated movie Who Framed Roger Rabbit: A bright, shiny cartoon.\r\n\r\nFormed by a group of childhood friends in 2004, the band was part of a wave of artists—including My Chemical Romance and Fall Out Boy, whose Pete Wentz was an early booster—who played what was effectively a pop-punk take on musical theatre: dandyish and self-consciously overblown, but with a sense of uplift that made them manna for their fans. That Urie had grown up near the Vegas Strip watching stuff like Cirque du Soleil and Blue Man Group made sense; that the band’s live act eventually incorporated stilt walkers, contortionists and ribbon dancers made more: Panic! was here to give you a show.\r\n\r\nOver the years, the group’s sound moved closer to the polish and style of mainstream pop while retaining the kind of high-drama pith that made them fodder for yearbook quotes and Instagram captions the world over. A series of lineup changes—including the departure of original lyricist Ryan Ross and, later, primary songwriter Spencer Smith—effectively stripped Panic! down to a solo project. Urie honed his idiosyncrasies further on 2018’s Pray for the Wicked, joining his Rat Pack and swing-kid proclivities with hip-hop, R&B and dance music.', 2004, 'Las Vegas, NV, United States', 'https://i.imgur.com/yPwfZua.png'),
(4, 'Caifanes', 'Caifanes are the quintessential Mexican rock band. In many ways, they were the group that brought rock music out of obscurity in their home country and propelled it to the masses, packing stadiums and large auditoriums with classic anthems like “Viento” (1988) and “Afuera” (1994). Named after the classic 1967 Mexican film Los caifanes, the group was formed by lead singer Saúl Hernández in the late ‘80s as an offshoot of Las Insólitas Imágenes de Aurora. Their early look, showcased on the album cover of their 1988 self-titled debut, borrowed heavily from gothic rock of the era (most notably The Cure). Yet by their second album, El Diablito (1990), the group was delving head-on into folklore and mysticism in songs like “Los Dioses Ocultos” and “La Célula Que Explota”, the latter of which fused elements of mariachi with rock, foreshadowing the band’s future sound and aesthetic. It was their third album El Silencio (1992)––produced by Adrian Belew, who worked with legendary acts like David Bowie and Talking Heads––that would catapult them to international stardom with memorable songs like “Nubes” and “No Dejes Que…”. Though the group would only release one more album before dissolving, El Nervio del Volcán (1994), their legacy lived on through their spiritual successor group Jaguares.', 1987, 'Ciudad de México, México', 'https://i.imgur.com/jDL7qP2.jpg'),
(5, 'José José', 'José José is a master of romantic pop balladry and his ability to home in on loves most heart-wrenching moments has made him a Latin music icon. Also known as \"El Príncipe de la Canción\" or the “Prince of Song”, the late Mexican crooner is still revered for his electrifying operatic vocal delivery and yearning inflections. Born José Romulo Sosa Ortíz in Mexico City in 1948 to musician parents, José José picked up the guitar and piano in his teens. After cutting his teeth singing jazz and bossa nova tunes, José José broke through in Latin America with the release of the 1970 single “La Nave del Olvido”. Later that year, he achieved international fame after singing the heartbreaking ballad “El Triste” at Festival Mundial de la Canción Latina (later named the OTI Festival), an annual televised Eurovision-style singing competition. Over three decades, José José would release a seemingly endless number of lovelorn, gut-wrenching hits like “Amar y Querer”, “Almohada”, “Gavilán o Paloma”, “Lo Dudo” and “Mañana Si”, earning the singer the admiration of Latin music’s biggest exports like Marc Anthony and Luis Fonsi. Even Frank Sinatra praised the crooner and expressed a desire to collaborate with him. In 2018, Telemundo released a biographical telenovela series, José José: el príncipe de la canción, about the singer’s life and legacy, before his passing at the age of 71 in September of 2019. The following month, José José was posthumously inducted into the Latin Songwriters Hall of Fame for his indelible contributions to Latin pop.', 1948, 'Ciudad de México, México', 'https://i.imgur.com/hfbjuOb.jpg'),
(6, 'Nat \"King\" Cole', 'Nat \"King\" Cole lo hacía todo sonar fácil. Esa era el arte de Nathaniel Adams Coles, nacido en Montgomery, Alabama en 1919—él ocultaba el sudor. Su familia se unió a la Gran Migración de Afroamericanos del Sur que se trasladaron al Norte, en su caso a Chicago, donde Cole formó un combo de jazz. Influenciado por el ligero y energético swing del pianista Earl Hines, Cole fue pionero de un sonido de trío de cócteles que era divertido y elegante. En grabaciones de los años 40 como \"Straighten Up and Fly Right\", \"Sweet Lorraine\" e \"Its Only a Paper Moon\", emergió como un cantante animado (a veces) y un instrumentista de primera. Si se hubiera quedado ahí, todavía sería celebrado hoy. Menos mal que siguió adelante. Sin ninguna formación vocal, descubrió que su barítono conversacional amaba una balada y al público le encantaba su canto. Hizo la transición a un sonido de pop-jazz, con grandes bandas y orquestas. Esta era la música del Rat Pack de una noche en la ciudad; canciones como \"(I Love You) For Sentimental Reasons\", \"Smile\" y (When I Fall In Love) eran casi cortesanas en sus modales. Un converso temprano a los ritmos latinos, Cole aprendió lo suficiente de español para convertirse en un ícono internacional en los años 50. Cole murió en 1965, pero volvió a estar en las listas de éxitos en 1991, haciendo un dueto con su hija Natalie en \"Unforgettable\" y un álbum homenaje que arrasó en los premios Grammy.', 1919, 'Montgomery, Alabama', 'https://i.imgur.com/WfW2zdD.jpg'),
(7, 'Los Ángeles Negros', 'Los Ángeles Negros es una banda chilena formada en 1968. Originalmente compuesta por Germain de la Fuente, Mario Gutiérrez, Cristian Blasser, Federico Blasser y Sergio Rojas, ganaron popularidad tras ganar un concurso de radio y lanzar su primer sencillo ¿Por qué te quiero? en 1968. A lo largo de la década de 1970, el grupo alcanzó un gran éxito en toda América Latina con baladas románticas como Y volveré, Pasión y vida y Mi niña. En 1982, se trasladaron a México y, a pesar de varios cambios en su formación, continuaron su carrera. Germain de la Fuente, el vocalista original, más tarde emprendió una carrera como solista. Su música sigue siendo influyente, dejando un impacto duradero en la música romántica latina.', 1968, 'San Carlos, Chile', 'https://i.imgur.com/azWWV0I.jpg'),
(8, 'Enjambre', 'Formada alrededor del talento de los hermanos Luis y Rafael Navejas, los rockeros retro Enjambre, originarios de la Ciudad de México, lanzaron su álbum debut Consuelo en Domingo en 2005. Tras obtener cierto éxito regional, los hermanos sumaron a su hermano menor Julián al grupo, junto con los amigos de toda la vida Ángel Sánchez y Javier Mejía. En 2008, lanzaron El Segundo Es Felino, lo que les valió un contrato con EMI. Su aclamado debut con la disquera, Daltónico, llegó en 2010. En 2012, la banda lanzó su esperado cuarto álbum de estudio, Huéspedes del Orbe, seguido en 2015 por Proaño, producido por Phil Vinall. Su sexto disco, Imperfecto Extraño, salió en 2017.', 2008, 'México', 'https://i.imgur.com/Dtu6zXA.png'),
(9, 'Luis Miguel', 'Luis Miguel es uno de los baladistas más poderosos y versátiles de la música latina. Apodado \"El Sol de México\" por su voz dorada, el cantante ha sacado el máximo provecho de su amplio rango vocal en baladas pop soleadas, canciones de amor desgarradoras y alegres pistas de mariachi. Nacido como Luis Miguel Gallego Basteri en 1970 en Puerto Rico, de padre español y madre italiana, se mudó con su familia a México cuando era niño. Bajo el estímulo de su padre músico, el prodigioso joven logró un lugar en la televisión nacional, interpretando el huapango clásico \"La Malagueña\" y mostrando su falsete único y su increíble control vocal a tan solo 11 años. A finales de esa década, Luis Miguel reavivó el interés de los oyentes por un estilo clásico de crooner melancólico, popularizado por predecesores del pop romántico como José José, con la nostálgica canción \"La Incondicional\" de 1988. Sin embargo, otros grandes éxitos como \"Ahora Te Puedes Marchar\", una pegajosa canción pop, demostraron su destreza en la pista de baile. Retomó el rol de líder del crooner latino y popularizó los boleros con el lanzamiento de Romance en 1991, que pasó 32 semanas en el primer lugar de la lista de Álbumes de Pop Latino de Billboard, un logro raro en esa época para un cantante de habla hispana. En los años 2000, Luis Miguel colaboró con Michael Jackson para la canción homenaje al 9/11 Todo Para Ti y conquistó la música regional mexicana con álbumes posteriores como ¡MÉXICO Por Siempre! de 2017.', 1970, 'San Juan, Purto Rico, Estados Unidos', 'https://i.imgur.com/t0VPNEm.png'),
(10, 'Ice Nine Kills', 'Originalmente formada como una banda de ska-punk, la banda estadounidense de \"theatricore\" ICE NINE KILLS tomó su nombre de la sustancia letal en la novela Cat’s Cradle de Kurt Vonnegut.\r\nObtuvieron su primer éxito con The Predator Becomes the Prey (2014), que llegó al Top 20 en la lista de Hard Rock de Billboard. Un ambicioso álbum conceptual inspirado en películas de terror, The Silver Scream (2018), fue un éxito en el Top 30 de Pop. La actriz de Stranger Things, Chelsea Talmadge, aportó voces invitadas en la oscura y cinematográfica \"Love Bites\" de The Silver Scream. En 2019, Matt Heafy, líder de Trivium, colaboró con la banda en una versión acústica de \"Stabbing in the Dark\", lanzada en la edición expandida de The Silver Scream (FINAL CUT). En 2020, presentaron The Silent Stream, un evento en vivo de Halloween que combinó imágenes de conciertos de 2019 con escenas representadas de los miembros de la banda y un acosador enmascarado.', 2002, 'Boston, MA, Estados Unidos', 'https://i.imgur.com/ojEfJwO.png'),
(11, 'Don Omar', 'Dotado de una poderosa voz que corta limpiamente a través de ritmos pesados de sintetizadores, Don Omar emergió como una de las figuras clave en la explosión internacional del reggaetón a principios de los 2000. Nacido William Omar Landrón Rivera en 1978 en el barrio Santurce de San Juan, Puerto Rico, era un adolescente cuando el género comenzó a tomar forma en los 90, y creció bajo la tutela de artistas pioneros como Luny Tunes y Noriega, ganando experiencia con mixtapes. Con su éxito de 2003, “Dale Don Dale”, Don Omar perfeccionó su estilo, alternando entre un rap-canto monotónico inspirado en dancehall y ganchos melódicos entregados con un trino flamenco. En el mismo año, “Dile” combinó los característicos tambores del reggaetón con bachata, consolidando a Omar como un embajador de los sonidos puertorriqueños.\r\n\r\nQue el sonido obrero del reggaetón aún enfrentara críticas gubernamentales hizo que el éxito de Don Omar fuera aún más dulce. Tras su debut en 2003 con The Last Don, el álbum King of Kings (2006) rompió barreras, convirtiéndose en el álbum de reggaetón mejor clasificado, debutando en la cima de la lista Billboard Top Latin Albums y alcanzando el puesto 7 en el Billboard 200. Pero Don Omar no estaba interesado en mantenerse en su zona de confort estilística. Para Danza Kuduro (2010), Omar se asoció con el músico portugués-francés Lucenzo, fusionando reggaetón con sonidos angoleños. Aunque anunció su retiro en 2017, regresó en 2019 con The Last Album; al año siguiente, Bad Bunny lo invitó a colaborar en “PA’ ROMPERLA”, pasando el testigo y confirmando el estatus de Omar en la historia de la música urbana.', 1978, 'Trappes, Francia', 'https://i.imgur.com/HPNKSOI.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `art_gen`
--

CREATE TABLE `art_gen` (
  `art_id` int(11) NOT NULL,
  `gen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `art_gen`
--

INSERT INTO `art_gen` (`art_id`, `gen_id`) VALUES
(3, 1),
(6, 2),
(10, 10),
(5, 16),
(9, 16),
(3, 17),
(4, 17),
(8, 17),
(4, 18),
(8, 18),
(11, 23),
(7, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion`
--

CREATE TABLE `cancion` (
  `can_id` int(11) NOT NULL,
  `can_nombre` varchar(255) NOT NULL,
  `can_duracion` time NOT NULL,
  `vin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `can_art`
--

CREATE TABLE `can_art` (
  `can_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_id` int(11) NOT NULL,
  `cli_email` varchar(255) NOT NULL,
  `cli_nombre` varchar(100) NOT NULL,
  `cli_sNombre` varchar(100) DEFAULT NULL,
  `cli_apelloidos` varchar(255) NOT NULL,
  `cli_fNacimiento` date NOT NULL,
  `cli_rfc` varchar(255) NOT NULL,
  `usr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_id`, `cli_email`, `cli_nombre`, `cli_sNombre`, `cli_apelloidos`, `cli_fNacimiento`, `cli_rfc`, `usr_id`) VALUES
(6, 'rodrigomazuca3@gmail.com', 'Rodrigo', '', 'Mazuca', '2003-12-31', 'MARR0311231HCLZMDA1', 10),
(7, 'fer@gmail.com', 'Fernanda', '', 'Ramirez Moralez', '2003-12-31', 'MARR0311231MC', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `comp_id` int(11) NOT NULL,
  `comp_status` varchar(255) NOT NULL,
  `comp_fPedio` date NOT NULL,
  `comp_fEntrega` datetime DEFAULT NULL,
  `comp_total` decimal(10,2) DEFAULT NULL,
  `cli_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`comp_id`, `comp_status`, `comp_fPedio`, `comp_fEntrega`, `comp_total`, `cli_id`) VALUES
(1, 'Entregado', '2024-11-25', '2024-12-03 21:44:01', '3300.00', 6),
(2, 'Entregado', '2024-11-27', '2024-12-03 21:51:46', '1100.00', 6),
(3, 'Entregado', '2024-12-02', '2024-12-03 22:39:31', '3900.00', 6),
(4, 'Entregado', '2024-12-03', '2024-12-03 22:51:49', '3200.00', 6),
(5, 'Entregado', '2024-12-03', '2024-12-03 22:55:54', '3600.00', 6),
(6, 'Entregado', '2024-12-03', '2024-12-03 22:56:46', '3600.00', 6);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `compras_vinilos_detalles`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `compras_vinilos_detalles` (
`comp_id` int(11)
,`comp_status` varchar(255)
,`comp_fPedio` date
,`comp_fEntrega` datetime
,`comp_total` decimal(10,2)
,`cli_nombre` varchar(100)
,`cli_sNombre` varchar(100)
,`cli_apelloidos` varchar(255)
,`cli_email` varchar(255)
,`cli_rfc` varchar(255)
,`vin_nombre` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comp_vin`
--

CREATE TABLE `comp_vin` (
  `comp_id` int(11) NOT NULL,
  `vin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comp_vin`
--

INSERT INTO `comp_vin` (`comp_id`, `vin_id`) VALUES
(4, 34),
(5, 41),
(6, 41),
(2, 42),
(4, 44),
(1, 45),
(5, 48),
(6, 48),
(4, 51),
(1, 55),
(3, 60),
(3, 61);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `dir_id` int(11) NOT NULL,
  `dir_estado` varchar(255) NOT NULL,
  `dir_ciudad` varchar(255) NOT NULL,
  `dir_cPostal` char(5) NOT NULL,
  `dic_direccion` varchar(255) NOT NULL,
  `dir_descrip` varchar(255) NOT NULL,
  `cli_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`dir_id`, `dir_estado`, `dir_ciudad`, `dir_cPostal`, `dic_direccion`, `dir_descrip`, `cli_id`) VALUES
(1, 'Coahuila', 'Matamoros', '27440', 'Gonzalez #230', 'Tapiceria Blanca', 6),
(2, 'Coahuila', 'Matamoros', '27440', 'Zaragoza #230s', 'Casa Blanca', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `gen_id` int(11) NOT NULL,
  `gen_gen` varchar(100) NOT NULL,
  `gen_imgURL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`gen_id`, `gen_gen`, `gen_imgURL`) VALUES
(1, 'Rock', NULL),
(2, 'Jazz', NULL),
(3, 'Blues', NULL),
(4, 'Soul', NULL),
(5, 'Funk', NULL),
(6, 'Reggae', NULL),
(7, 'Pop', NULL),
(8, 'Hip-Hop', NULL),
(9, 'Electrónica', NULL),
(10, 'Metal', NULL),
(11, 'Punk', NULL),
(12, 'Country', NULL),
(13, 'Clásica', NULL),
(14, 'Folk', NULL),
(15, 'R&B', NULL),
(16, 'Pop en Español', NULL),
(17, 'Alternativo', NULL),
(18, 'Rock Latino', NULL),
(19, 'Regional Mexicano', NULL),
(20, 'Baladas', NULL),
(21, 'Boleros', NULL),
(23, 'Latina Urbano', NULL),
(24, 'Latina', NULL),
(27, 'Rock en Español', NULL),
(28, 'Latino Urbano', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_vin`
--

CREATE TABLE `gen_vin` (
  `gen_id` int(11) NOT NULL,
  `vin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gen_vin`
--

INSERT INTO `gen_vin` (`gen_id`, `vin_id`) VALUES
(2, 32),
(16, 33),
(16, 34),
(2, 37),
(2, 38),
(1, 40),
(17, 40),
(1, 41),
(17, 41),
(18, 42),
(24, 42),
(18, 43),
(24, 43),
(18, 44),
(24, 44),
(18, 45),
(24, 45),
(18, 46),
(24, 46),
(16, 47),
(24, 47),
(16, 48),
(24, 48),
(19, 49),
(24, 49),
(20, 51),
(21, 51),
(24, 51),
(24, 54),
(1, 55),
(17, 55),
(16, 56),
(20, 56),
(24, 56),
(20, 57),
(21, 57),
(24, 57),
(24, 58),
(28, 58),
(24, 59),
(28, 59),
(10, 60),
(10, 61),
(18, 62),
(20, 62),
(24, 62);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usr_id` int(11) NOT NULL,
  `usr_usuario` varchar(100) NOT NULL,
  `usr_pword` varbinary(255) NOT NULL,
  `usr_fCreacion` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usr_id`, `usr_usuario`, `usr_pword`, `usr_fCreacion`) VALUES
(10, 'rodrigo', 0x24327924313024716635794d5453756e476d39664c506b73667179374f7279347a53704d6c6e4638452e52456f694a566f58594262766d344e716a43, '2024-11-09 19:40:23'),
(11, 'fernanda', 0x243279243130245459716d766a6a5a4d62725766683730395a395841654d7a41767a476975424a6a52543045726e554c436e5571566d7348786f6e4f, '2024-11-25 19:07:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinilo`
--

CREATE TABLE `vinilo` (
  `vin_id` int(11) NOT NULL,
  `vin_nombre` varchar(255) NOT NULL,
  `vin_fLanz` date NOT NULL,
  `vin_stok` int(11) NOT NULL,
  `vin_imgURL` varchar(255) DEFAULT NULL,
  `art_id` int(11) NOT NULL,
  `vin_precio` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vinilo`
--

INSERT INTO `vinilo` (`vin_id`, `vin_nombre`, `vin_fLanz`, `vin_stok`, `vin_imgURL`, `art_id`, `vin_precio`) VALUES
(32, 'After Midnight: The Complete Session', '1956-08-15', 21, 'https://i.imgur.com/G2a3xDY.jpg', 6, '1200.00'),
(33, '40 y 20', '1992-11-24', 33, 'https://i.imgur.com/qPTLxSQ.jpg', 5, '1800.00'),
(34, 'Amor Amor', '1980-01-01', 11, 'https://i.imgur.com/R6J8ifZ.jpg', 5, '1300.00'),
(37, 'Ballads of the Day', '1956-04-01', 8, 'https://i.imgur.com/OwHaaAt.jpg', 6, '900.00'),
(38, 'Cole Español', '1958-01-01', 12, 'https://i.imgur.com/uZlRJMQ.jpg', 6, '900.00'),
(40, 'Vices & Virtues (Deluxe Edition)', '2011-03-22', 9, 'https://i.imgur.com/OUNtAh7.jpg', 3, '1400.00'),
(41, 'Too Weird to Live, Too Rare to Die!', '2013-10-08', 12, 'https://i.imgur.com/OvVX7CV.jpg', 3, '1400.00'),
(42, 'Caifanes', '1988-08-28', 13, 'https://i.imgur.com/3TU7pQo.jpg', 4, '1100.00'),
(43, 'Heridos', '2017-03-07', 26, 'https://i.imgur.com/dhXImUD.jpg', 4, '1100.00'),
(44, 'El Diablito', '1990-06-19', 35, 'https://i.imgur.com/qJhMvQF.jpg', 4, '1100.00'),
(45, 'El Nervio del Volcán', '1994-06-29', 20, 'https://i.imgur.com/fWgGJrD.jpg', 4, '1500.00'),
(46, 'El Silencio', '1992-05-29', 61, 'https://i.imgur.com/GSJ2RcL.jpg', 4, '1500.00'),
(47, 'Gracias', '1981-11-24', 35, 'https://i.imgur.com/rLUlls9.jpg', 5, '1300.00'),
(48, 'Secretos', '1983-11-11', 0, 'https://i.imgur.com/2mOgqpE.jpg', 5, '2200.00'),
(49, 'José José Ranchero', '2010-01-26', 6, 'https://i.imgur.com/VMM2lbz.jpg', 5, '800.00'),
(51, 'Sinfonico', '2018-02-23', 5, 'https://i.imgur.com/VOsKKSP.jpg', 5, '800.00'),
(54, 'Y Volvere', '1969-10-01', 21, 'https://i.imgur.com/1cV2kf7.jpg', 7, '1800.00'),
(55, 'A Fever You Cant Sweat out', '2005-09-27', 30, 'https://i.imgur.com/6fNNg8r.jpg', 3, '1800.00'),
(56, 'Aries', '1993-06-22', 22, 'https://i.imgur.com/0mT3iE2.jpg', 9, '1100.00'),
(57, 'Romance', '1991-11-19', 5, 'https://i.imgur.com/KAiJvbN.jpg', 9, '1100.00'),
(58, 'iDon', '2009-04-28', 2, 'https://i.imgur.com/8WuexoY.jpg', 11, '1100.00'),
(59, 'The Last Don 2', '2015-06-16', 5, 'https://i.imgur.com/P3AvGQq.jpg', 11, '1100.00'),
(60, 'The Silver Scream', '2018-10-05', 8, 'https://i.imgur.com/JavzDj4.jpg', 10, '1500.00'),
(61, 'Welcome to Horrorwood: Under Fire', '2023-10-20', 9, 'https://i.imgur.com/pxQhIDr.png', 10, '2400.00'),
(62, 'Noches de Salon', '2023-09-01', 10, 'https://i.imgur.com/AUr5aNY.jpg', 8, '1800.00');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_artistas_generos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_artistas_generos` (
`art_id` int(11)
,`art_nombre` varchar(255)
,`art_desc` text
,`art_fNacim` year(4)
,`art_lugNaci` varchar(255)
,`art_imgURL` varchar(255)
,`gen_id` int(11)
,`gen_gen` varchar(100)
,`gen_imgURL` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_cliente` (
`cli_email` varchar(255)
,`cli_nombre` varchar(100)
,`cli_sNombre` varchar(100)
,`cli_apelloidos` varchar(255)
,`cli_fNacimiento` date
,`cli_rfc` varchar(255)
,`usr_id` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_compras`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_compras` (
`id_compra` int(11)
,`nombre_cliente` varchar(100)
,`apellidos_cliente` varchar(255)
,`direccion_envio` varchar(255)
,`fecha_pedido` date
,`fecha_entrega` datetime
,`estado_compra` varchar(255)
,`total_compra` decimal(10,2)
,`producto` varchar(255)
,`imagen_producto` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_compras_con_email`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_compras_con_email` (
`comp_id` int(11)
,`comp_status` varchar(255)
,`comp_fPedio` date
,`comp_fEntrega` datetime
,`comp_total` decimal(10,2)
,`cli_email` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_direccion`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_direccion` (
`dir_id` int(11)
,`dir_estado` varchar(255)
,`dir_ciudad` varchar(255)
,`dir_cPostal` char(5)
,`dic_direccion` varchar(255)
,`dir_descrip` varchar(255)
,`cli_id` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_direcciones_usuario`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_direcciones_usuario` (
`usr_id` int(11)
,`usr_usuario` varchar(100)
,`cli_id` int(11)
,`cli_email` varchar(255)
,`cli_nombre` varchar(100)
,`cli_sNombre` varchar(100)
,`cli_apelloidos` varchar(255)
,`cli_fNacimiento` date
,`cli_rfc` varchar(255)
,`dir_id` int(11)
,`dir_estado` varchar(255)
,`dir_ciudad` varchar(255)
,`dir_cPostal` char(5)
,`dic_direccion` varchar(255)
,`dir_descrip` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuarios` (
`usr_id` int(11)
,`usr_usuario` varchar(100)
,`usr_fCreacion` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_vinilos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_vinilos` (
`vin_id` int(11)
,`vin_nombre` varchar(255)
,`vin_fLanz` date
,`vin_stok` int(11)
,`vin_precio` decimal(10,2)
,`vin_imgURL` varchar(255)
,`art_nombre` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_vinilos_con_generos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_vinilos_con_generos` (
`vin_id` int(11)
,`vin_nombre` varchar(255)
,`vin_fLanz` date
,`vin_stok` int(11)
,`vin_precio` decimal(10,2)
,`vin_imgURL` varchar(255)
,`art_nombre` varchar(255)
,`genero` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `compras_vinilos_detalles`
--
DROP TABLE IF EXISTS `compras_vinilos_detalles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `compras_vinilos_detalles`  AS SELECT `c`.`comp_id` AS `comp_id`, `c`.`comp_status` AS `comp_status`, `c`.`comp_fPedio` AS `comp_fPedio`, `c`.`comp_fEntrega` AS `comp_fEntrega`, `c`.`comp_total` AS `comp_total`, `cl`.`cli_nombre` AS `cli_nombre`, `cl`.`cli_sNombre` AS `cli_sNombre`, `cl`.`cli_apelloidos` AS `cli_apelloidos`, `cl`.`cli_email` AS `cli_email`, `cl`.`cli_rfc` AS `cli_rfc`, `v`.`vin_nombre` AS `vin_nombre` FROM (((`compra` `c` join `comp_vin` `cv` on((`c`.`comp_id` = `cv`.`comp_id`))) join `vinilo` `v` on((`cv`.`vin_id` = `v`.`vin_id`))) join `cliente` `cl` on((`c`.`cli_id` = `cl`.`cli_id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_artistas_generos`
--
DROP TABLE IF EXISTS `vista_artistas_generos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_artistas_generos`  AS SELECT `a`.`art_id` AS `art_id`, `a`.`art_nombre` AS `art_nombre`, `a`.`art_desc` AS `art_desc`, `a`.`art_fNacim` AS `art_fNacim`, `a`.`art_lugNaci` AS `art_lugNaci`, `a`.`art_imgURL` AS `art_imgURL`, `g`.`gen_id` AS `gen_id`, `g`.`gen_gen` AS `gen_gen`, `g`.`gen_imgURL` AS `gen_imgURL` FROM ((`artista` `a` join `art_gen` `ag` on((`a`.`art_id` = `ag`.`art_id`))) join `genero` `g` on((`ag`.`gen_id` = `g`.`gen_id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cliente`
--
DROP TABLE IF EXISTS `vista_cliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_cliente`  AS SELECT `cliente`.`cli_email` AS `cli_email`, `cliente`.`cli_nombre` AS `cli_nombre`, `cliente`.`cli_sNombre` AS `cli_sNombre`, `cliente`.`cli_apelloidos` AS `cli_apelloidos`, `cliente`.`cli_fNacimiento` AS `cli_fNacimiento`, `cliente`.`cli_rfc` AS `cli_rfc`, `cliente`.`usr_id` AS `usr_id` FROM `cliente``cliente`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_compras`
--
DROP TABLE IF EXISTS `vista_compras`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_compras`  AS SELECT `compra`.`comp_id` AS `id_compra`, `cliente`.`cli_nombre` AS `nombre_cliente`, `cliente`.`cli_apelloidos` AS `apellidos_cliente`, `direccion`.`dic_direccion` AS `direccion_envio`, `compra`.`comp_fPedio` AS `fecha_pedido`, `compra`.`comp_fEntrega` AS `fecha_entrega`, `compra`.`comp_status` AS `estado_compra`, `compra`.`comp_total` AS `total_compra`, `vinilo`.`vin_nombre` AS `producto`, `vinilo`.`vin_imgURL` AS `imagen_producto` FROM ((((`compra` join `cliente` on((`compra`.`cli_id` = `cliente`.`cli_id`))) join `direccion` on((`cliente`.`cli_id` = `direccion`.`cli_id`))) join `comp_vin` on((`compra`.`comp_id` = `comp_vin`.`comp_id`))) join `vinilo` on((`comp_vin`.`vin_id` = `vinilo`.`vin_id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_compras_con_email`
--
DROP TABLE IF EXISTS `vista_compras_con_email`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_compras_con_email`  AS SELECT `c`.`comp_id` AS `comp_id`, `c`.`comp_status` AS `comp_status`, `c`.`comp_fPedio` AS `comp_fPedio`, `c`.`comp_fEntrega` AS `comp_fEntrega`, `c`.`comp_total` AS `comp_total`, `cl`.`cli_email` AS `cli_email` FROM (`compra` `c` join `cliente` `cl` on((`c`.`cli_id` = `cl`.`cli_id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_direccion`
--
DROP TABLE IF EXISTS `vista_direccion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_direccion`  AS SELECT `direccion`.`dir_id` AS `dir_id`, `direccion`.`dir_estado` AS `dir_estado`, `direccion`.`dir_ciudad` AS `dir_ciudad`, `direccion`.`dir_cPostal` AS `dir_cPostal`, `direccion`.`dic_direccion` AS `dic_direccion`, `direccion`.`dir_descrip` AS `dir_descrip`, `direccion`.`cli_id` AS `cli_id` FROM `direccion``direccion`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_direcciones_usuario`
--
DROP TABLE IF EXISTS `vista_direcciones_usuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_direcciones_usuario`  AS SELECT `usuario`.`usr_id` AS `usr_id`, `usuario`.`usr_usuario` AS `usr_usuario`, `cliente`.`cli_id` AS `cli_id`, `cliente`.`cli_email` AS `cli_email`, `cliente`.`cli_nombre` AS `cli_nombre`, `cliente`.`cli_sNombre` AS `cli_sNombre`, `cliente`.`cli_apelloidos` AS `cli_apelloidos`, `cliente`.`cli_fNacimiento` AS `cli_fNacimiento`, `cliente`.`cli_rfc` AS `cli_rfc`, `direccion`.`dir_id` AS `dir_id`, `direccion`.`dir_estado` AS `dir_estado`, `direccion`.`dir_ciudad` AS `dir_ciudad`, `direccion`.`dir_cPostal` AS `dir_cPostal`, `direccion`.`dic_direccion` AS `dic_direccion`, `direccion`.`dir_descrip` AS `dir_descrip` FROM ((`usuario` join `cliente` on((`usuario`.`usr_id` = `cliente`.`usr_id`))) join `direccion` on((`cliente`.`cli_id` = `direccion`.`cli_id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuarios`
--
DROP TABLE IF EXISTS `vista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuarios`  AS SELECT `usuario`.`usr_id` AS `usr_id`, `usuario`.`usr_usuario` AS `usr_usuario`, `usuario`.`usr_fCreacion` AS `usr_fCreacion` FROM `usuario``usuario`  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_vinilos`
--
DROP TABLE IF EXISTS `vista_vinilos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_vinilos`  AS SELECT `vinilo`.`vin_id` AS `vin_id`, `vinilo`.`vin_nombre` AS `vin_nombre`, `vinilo`.`vin_fLanz` AS `vin_fLanz`, `vinilo`.`vin_stok` AS `vin_stok`, `vinilo`.`vin_precio` AS `vin_precio`, `vinilo`.`vin_imgURL` AS `vin_imgURL`, `artista`.`art_nombre` AS `art_nombre` FROM (`vinilo` join `artista` on((`vinilo`.`art_id` = `artista`.`art_id`)))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_vinilos_con_generos`
--
DROP TABLE IF EXISTS `vista_vinilos_con_generos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_vinilos_con_generos`  AS SELECT `v`.`vin_id` AS `vin_id`, `v`.`vin_nombre` AS `vin_nombre`, `v`.`vin_fLanz` AS `vin_fLanz`, `v`.`vin_stok` AS `vin_stok`, `v`.`vin_precio` AS `vin_precio`, `v`.`vin_imgURL` AS `vin_imgURL`, `a`.`art_nombre` AS `art_nombre`, `g`.`gen_gen` AS `genero` FROM (((`vinilo` `v` join `artista` `a` on((`v`.`art_id` = `a`.`art_id`))) join `gen_vin` `gv` on((`v`.`vin_id` = `gv`.`vin_id`))) join `genero` `g` on((`gv`.`gen_id` = `g`.`gen_id`)))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `idx_anrtista_Nombre` (`art_nombre`);

--
-- Indices de la tabla `art_gen`
--
ALTER TABLE `art_gen`
  ADD PRIMARY KEY (`art_id`,`gen_id`),
  ADD KEY `gen_id` (`gen_id`);

--
-- Indices de la tabla `cancion`
--
ALTER TABLE `cancion`
  ADD PRIMARY KEY (`can_id`),
  ADD KEY `vin_id` (`vin_id`),
  ADD KEY `idx_cancion_nombre` (`can_nombre`);

--
-- Indices de la tabla `can_art`
--
ALTER TABLE `can_art`
  ADD PRIMARY KEY (`can_id`,`art_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_id`),
  ADD UNIQUE KEY `cli_email` (`cli_email`),
  ADD UNIQUE KEY `cli_rfc` (`cli_rfc`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`comp_id`),
  ADD KEY `cli_id` (`cli_id`);

--
-- Indices de la tabla `comp_vin`
--
ALTER TABLE `comp_vin`
  ADD PRIMARY KEY (`comp_id`,`vin_id`),
  ADD KEY `vin_id` (`vin_id`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`dir_id`),
  ADD KEY `cli_id` (`cli_id`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`gen_id`);

--
-- Indices de la tabla `gen_vin`
--
ALTER TABLE `gen_vin`
  ADD PRIMARY KEY (`gen_id`,`vin_id`),
  ADD KEY `vin_id` (`vin_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_usuario` (`usr_usuario`);

--
-- Indices de la tabla `vinilo`
--
ALTER TABLE `vinilo`
  ADD PRIMARY KEY (`vin_id`),
  ADD KEY `art_id` (`art_id`),
  ADD KEY `idx_vinilo_nombre` (`vin_nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cancion`
--
ALTER TABLE `cancion`
  MODIFY `can_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `dir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `gen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `vinilo`
--
ALTER TABLE `vinilo`
  MODIFY `vin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `art_gen`
--
ALTER TABLE `art_gen`
  ADD CONSTRAINT `art_gen_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `artista` (`art_id`),
  ADD CONSTRAINT `art_gen_ibfk_2` FOREIGN KEY (`gen_id`) REFERENCES `genero` (`gen_id`);

--
-- Filtros para la tabla `cancion`
--
ALTER TABLE `cancion`
  ADD CONSTRAINT `cancion_ibfk_1` FOREIGN KEY (`vin_id`) REFERENCES `vinilo` (`vin_id`);

--
-- Filtros para la tabla `can_art`
--
ALTER TABLE `can_art`
  ADD CONSTRAINT `can_art_ibfk_1` FOREIGN KEY (`can_id`) REFERENCES `cancion` (`can_id`),
  ADD CONSTRAINT `can_art_ibfk_2` FOREIGN KEY (`art_id`) REFERENCES `artista` (`art_id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `usuario` (`usr_id`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`);

--
-- Filtros para la tabla `comp_vin`
--
ALTER TABLE `comp_vin`
  ADD CONSTRAINT `comp_vin_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `compra` (`comp_id`),
  ADD CONSTRAINT `comp_vin_ibfk_2` FOREIGN KEY (`vin_id`) REFERENCES `vinilo` (`vin_id`);

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`cli_id`) REFERENCES `cliente` (`cli_id`);

--
-- Filtros para la tabla `gen_vin`
--
ALTER TABLE `gen_vin`
  ADD CONSTRAINT `gen_vin_ibfk_1` FOREIGN KEY (`gen_id`) REFERENCES `genero` (`gen_id`),
  ADD CONSTRAINT `gen_vin_ibfk_2` FOREIGN KEY (`vin_id`) REFERENCES `vinilo` (`vin_id`);

--
-- Filtros para la tabla `vinilo`
--
ALTER TABLE `vinilo`
  ADD CONSTRAINT `vinilo_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `artista` (`art_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
