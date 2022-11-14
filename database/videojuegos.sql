-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 09:28 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `videojuegos`
--

-- --------------------------------------------------------

--
-- Table structure for table `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `descripcion_genero` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`, `descripcion_genero`) VALUES
(1, 'Acción', 'Generalmente implican avanzar a través de niveles, eliminando hordas de enemigos y resolviendo problemas. Muchos videojuegos incluyen uno o más.'),
(3, 'Carreras', 'Un videojuego de carreras es un videojuego en el que se imitan competencias entre vehículos. Usualmente el objetivo es recorrer cierta distancia o ir de un sitio hacia otro en el menor tiempo posible, como en el automovilismo y el motociclismo'),
(4, 'Disparos', 'permiten controlar un personaje que, por norma general, dispone de un arma y por lo general son multiplayer,Si  hace uso de internet, se puede catalogar en una serie de divisiones: Los juegos en equipo y los juegos individuales'),
(5, 'Estrategia', 'requieren que el jugador ponga en práctica sus habilidades de planeamiento y pensamiento para maniobrar, gestionando recursos de diverso tipo (materiales, humanos, militares....) para conseguir la victoria'),
(6, 'Indie', 'desarrollados por grupos reducidos de individuos o pequeñas empresas. No suelen contar con el apoyo financiero de distribuidores y publicistas, sino que su difusión depende principalmente de la voluntad de los jugadores para compartirlos con otros.');

-- --------------------------------------------------------

--
-- Table structure for table `juego`
--

CREATE TABLE `juego` (
  `id_juego` int(11) NOT NULL,
  `id_genero_fk` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `imagen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `juego`
--

INSERT INTO `juego` (`id_juego`, `id_genero_fk`, `nombre`, `precio`, `descripcion`, `imagen`) VALUES
(27, 1, 'Grand Theft Auto V', 500, 'mundo abierto con historia, disparos, autos y lo que quieras.', 'images/6348592084a96.jpg'),
(28, 3, 'F1 2022', 700, 'Ponte al volante en la nueva temporada: coc434343hes rediseñados y nuevas reglas que definen las carreras, con los pilotos de 2022.', 'images/6348594e867c4.jpg'),
(29, 6, 'cult of the lamb', 1200, 'Crea tu propia secta en una tierra de falsos profetas, aventurándote en regiones diversas y misteriosas para construir una leal comunidad de adeptos de los bosques, y difunde tu Palabra para convertir tu secta en la única y verdadera.', 'images/63485980bc7aa.jpg'),
(30, 3, 'Forza Horizon 5', 1000, 'forza horizon 5', 'images/634859a32b37a.jpg'),
(31, 1, 'Assasins Creed Origins', 600, 'Ambientado en el misterioso Antiguo Egipto, Assassin’s Creed® Origins es un nuevo comienzo. Experimenta una nueva forma de pelear mientras exploras las majestuosas pirámides y las tumbas secretas a través del territorio del Antiguo Egipto y encuentra inolvidables historias a lo largo de tu travesía. Y descubre la historia del origen de la Hermandad de los Asesinos.', 'images/63485a22e1abc.jpg'),
(32, 1, 'Shadow of the Tomb Raider', 600, 'En Shadow of the Tomb Raider: Definitive Edition, vive el capítulo final de la historia sobre el origen de Lara, en el que se convierte en la saqueadora de tumbas que está destinada a ser.', 'images/63485a8f5765d.jpg'),
(45, 1, 'Grand Theft Auto V', 500, 'mundo abierto con historia, disparos, autos y lo que quieras.', ''),
(46, 1, 'PRUEBA', 500, 'mundo abierto con historia, disparos, autos y lo que quieras.', ''),
(47, 1, 'PRUWEWEEBA', 500, 'mundo abierto con historia, disparos, autos y lo que quieras.', ''),
(48, 1, 'edrretado pa', 500, 'mundo rereabierto con historia, disparos, autos y lo que quieras.', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `nombreUsuario` varchar(45) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nombreUsuario`, `password`) VALUES
('tomas', '$2y$10$87RSDzJ1wUi.6CofxGhYD.fd4jEj8JOkSc5lr0LDju2bFD7Gwzmde');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indexes for table `juego`
--
ALTER TABLE `juego`
  ADD PRIMARY KEY (`id_juego`),
  ADD KEY `fk_restriction` (`id_genero_fk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nombreUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `juego`
--
ALTER TABLE `juego`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `juego`
--
ALTER TABLE `juego`
  ADD CONSTRAINT `fk_restriction` FOREIGN KEY (`id_genero_fk`) REFERENCES `genero` (`id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
