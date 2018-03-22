-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2018 at 08:21 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_pkl_2_rev`
--

-- --------------------------------------------------------

--
-- Table structure for table `mkategori`
--

CREATE TABLE `mkategori` (
  `id` int(11) NOT NULL,
  `cnokategori` varchar(3) NOT NULL,
  `cnmkategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mkegiatan`
--

CREATE TABLE `mkegiatan` (
  `id` int(11) NOT NULL,
  `cnokegiatan` varchar(3) NOT NULL,
  `cnmkegiatan` varchar(100) NOT NULL,
  `ctingkat` enum('l','n','i','') NOT NULL,
  `cnokategori` varchar(3) NOT NULL,
  `mkategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mmhs`
--

CREATE TABLE `mmhs` (
  `id` int(11) NOT NULL,
  `cnim` varchar(10) NOT NULL,
  `cnama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mteammhs`
--

CREATE TABLE `mteammhs` (
  `id` int(11) NOT NULL,
  `cnoteam` varchar(5) NOT NULL,
  `cnmteam` varchar(100) NOT NULL,
  `cjmlagt` int(11) NOT NULL,
  `csmt` enum('e','o','','') NOT NULL,
  `cthnajar` varchar(8) NOT NULL,
  `dtglawallomba` date NOT NULL,
  `dtglakhirlomba` date NOT NULL,
  `ctempatlomba` varchar(100) NOT NULL,
  `cbukti` varchar(100) NOT NULL,
  `cuserentri` int(11) NOT NULL,
  `ctglentri` int(11) NOT NULL,
  `cnokegiatan` varchar(3) NOT NULL,
  `mkegiatan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tagtteam`
--

CREATE TABLE `tagtteam` (
  `id` int(11) NOT NULL,
  `cnim` varchar(10) NOT NULL,
  `cnoteam` varchar(100) NOT NULL,
  `cprestasi` varchar(100) NOT NULL,
  `mteammhs_id` int(11) NOT NULL,
  `mmhs_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mkategori`
--
ALTER TABLE `mkategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnokategori` (`cnokategori`);

--
-- Indexes for table `mkegiatan`
--
ALTER TABLE `mkegiatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnokegiatan` (`cnokegiatan`),
  ADD UNIQUE KEY `mkategori_id` (`mkategori_id`),
  ADD UNIQUE KEY `cnokategori` (`cnokategori`);

--
-- Indexes for table `mmhs`
--
ALTER TABLE `mmhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mteammhs`
--
ALTER TABLE `mteammhs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnokegiatan` (`cnokegiatan`),
  ADD UNIQUE KEY `cnoteam` (`cnoteam`),
  ADD UNIQUE KEY `cuserentri` (`cuserentri`),
  ADD UNIQUE KEY `mkegiatan_id` (`mkegiatan_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tagtteam`
--
ALTER TABLE `tagtteam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mkategori`
--
ALTER TABLE `mkategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mkegiatan`
--
ALTER TABLE `mkegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mmhs`
--
ALTER TABLE `mmhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mteammhs`
--
ALTER TABLE `mteammhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tagtteam`
--
ALTER TABLE `tagtteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mkegiatan`
--
ALTER TABLE `mkegiatan`
  ADD CONSTRAINT `mkegiatan_ibfk_1` FOREIGN KEY (`mkategori_id`) REFERENCES `mkategori` (`id`);

--
-- Constraints for table `mteammhs`
--
ALTER TABLE `mteammhs`
  ADD CONSTRAINT `mteammhs_ibfk_1` FOREIGN KEY (`mkegiatan_id`) REFERENCES `mkegiatan` (`id`),
  ADD CONSTRAINT `mteammhs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
