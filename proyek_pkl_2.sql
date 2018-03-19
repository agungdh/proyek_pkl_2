-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2018 at 04:11 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_pkl_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `mkategori`
--

CREATE TABLE `mkategori` (
  `cnokategori` varchar(3) NOT NULL,
  `cnmkategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mkategori`
--

INSERT INTO `mkategori` (`cnokategori`, `cnmkategori`) VALUES
('001', 'Seni'),
('002', 'Keagamaan'),
('003', 'Olah Raga'),
('004', 'Sains'),
('005', 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `mkegiatan`
--

CREATE TABLE `mkegiatan` (
  `cnokegiatan` varchar(3) NOT NULL,
  `cnmkegiatan` varchar(100) NOT NULL,
  `ctingkat` enum('l','n','i') NOT NULL,
  `cnokategori` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mkegiatan`
--

INSERT INTO `mkegiatan` (`cnokegiatan`, `cnmkegiatan`, `ctingkat`, `cnokategori`) VALUES
('001', 'DBL basket', 'n', '003'),
('002', 'Sepakbola', 'n', '003'),
('003', 'Modelling', 'n', '001'),
('004', 'Futsal', 'l', '003'),
('005', 'Futsal', 'l', '003'),
('006', 'Karya Ilmiah', 'i', '004'),
('007', 'Badminton', 'l', '003'),
('008', 'Judo', 'n', '003'),
('009', 'Paduan Suara', 'n', '001'),
('010', 'Pencak Silat', 'i', '003'),
('011', 'MTQ', 'n', '002'),
('012', 'Taekwondo', 'l', '003'),
('013', 'Tenis Meja', 'l', '003'),
('014', 'VollyBall', 'l', '003'),
('015', 'Renang', 'i', '003'),
('016', 'Lintas Alam', 'l', '005'),
('017', 'Menyanyi', 'n', '001'),
('018', 'Scrabel', 'l', '005'),
('019', 'Memancing', 'i', '005'),
('020', 'Hacking', 'i', '005'),
('021', 'Web Design', 'n', '005'),
('022', 'Photografi', 'n', '005'),
('023', 'Videografi', 'n', '005'),
('025', 'Olimpiade Akuntansi', 'i', '004'),
('026', 'Olimpiade FIsika', 'n', '004'),
('027', 'Ceramah', 'l', '002'),
('028', 'Tarqil', 'n', '002'),
('029', 'animasi', 'l', '001'),
('030', 'menulis', 'n', '001'),
('031', 'web programing', 'i', '005'),
('032', 'qori', 'n', '002'),
('033', 'lari maraton', 'l', '003'),
('034', 'lari 100 M', 'n', '001'),
('035', 'tinju', 'i', '003'),
('036', 'voly pantai', 'n', '003'),
('037', 'robotik', 'i', '004'),
('038', 'vidio gram', 'n', '001'),
('039', 'desain', 'n', '001'),
('040', 'dota', 'i', '005'),
('041', 'mobile legend', 'i', '005');

-- --------------------------------------------------------

--
-- Table structure for table `mmhs`
--

CREATE TABLE `mmhs` (
  `cnim` varchar(10) NOT NULL,
  `cnama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mmhs`
--

INSERT INTO `mmhs` (`cnim`, `cnama`) VALUES
('1111', 'satu satu satu '),
('1234', 'nama a'),
('1235', 'nama b'),
('1236', 'nama c'),
('1237', 'nama d'),
('1238', 'nama e'),
('1239', 'nama f'),
('1241', 'nama f'),
('1242', 'nama g'),
('1243', 'nama h'),
('1244', 'nama h'),
('1245', 'nama i'),
('1246', 'nama k'),
('1247', 'nama i'),
('1248', 'jon'),
('1249', 'dani'),
('1250', 'heru'),
('157230 ayu', 'tri'),
('15723001', 'saipul'),
('15723002', 'nama x'),
('15723003', 'heru'),
('15723004', 'heni'),
('15723005', 'dodok'),
('15723006', 'kasinok'),
('15723007', 'indrok'),
('15723008', 'jemi'),
('15723009', 'dion'),
('15723010', 'heri'),
('15723011', 'irfan '),
('15723012', 'yendi'),
('15723013', 'doli'),
('15723014', 'mesi'),
('15723015', 'ronaldo'),
('15723016', 'marcelo'),
('15723017', 'ibrahim m'),
('15723018', 'ozil'),
('15723019', 'ruben'),
('15723020', 'casilas'),
('15723021', 'vidal'),
('15723022', 'vila'),
('15723023', 'david'),
('15723024', 'ramos'),
('15723025', 'mesi'),
('15723026', 'dodit'),
('15723027', 'g pamungkas'),
('15723028', 'melati'),
('15723029', 'kamboja'),
('15723030', 'mawar'),
('15723031', 'raflessia'),
('15723032', 'miya'),
('15723033', 'layla'),
('15723034', 'zilong'),
('15723035', 'gatot kaca'),
('15723036', 'lancelot'),
('15723037', 'lord'),
('15723038', 'natalia'),
('15723040', 'sark'),
('15723041', 'sun'),
('15723042', 'alucard'),
('15723043', 'fani'),
('15723044', 'caiclop'),
('15723045', 'ana'),
('15723046', 'ani'),
('15723047', 'ano'),
('15723048', 'anu'),
('15723049', 'nalamba'),
('15723051', 'tri ayu'),
('15723052', 'johan'),
('15723053', 'david becham'),
('15723054', 'bambang pamungkas'),
('15723055', 'budi sudarsono'),
('15723056', 'aji santoso'),
('15723057', 'egi melgiansyah'),
('15723058', 'kim jefri kurniawan'),
('15723059', 'kristian gonzales'),
('15723060', 'bio paulin'),
('15723061', 'mak lampir'),
('15723062', 'gerandong'),
('15723063', 'ismed sofian'),
('15723064', 'lili pali'),
('15723065', 'pak lie'),
('15723066', 'ramos'),
('15723067', 'ronaldino'),
('15723068', 'jupe'),
('15723069', 'nikita mirzani'),
('15723070', 'riska'),
('15723071', 'rahmatul'),
('15723072', 'jannah'),
('15723073', 'vani'),
('15723074', 'hp opo'),
('15723075', 'chelsea olivia'),
('15723076', 'indah '),
('15723077', 'permata'),
('15723078', 'sari'),
('15723079', 'maul uhuy'),
('15723080', 'kristian bejo'),
('15723081', 'cak lontong'),
('15723082', 'cak lemper'),
('15723083', 'cak choy'),
('15723084', 'cak imin'),
('15723085', 'yongki'),
('15723086', 'mungki'),
('15723087', 'muki muki'),
('15723088', 'pujianto'),
('15723089', 'dani s'),
('15723090', 'diah'),
('15723091', 'santika'),
('15723092', 'dewa'),
('15723093', 'gede'),
('15723094', 'ketut'),
('15723095', 'nyoman'),
('15723096', 'nyai kai'),
('15723097', 'kaing kaing'),
('15723099', 'nabila'),
('15753001', 'Ade Irma'),
('15753002', 'Adrian Reza'),
('15753003', 'Agung Sapto'),
('15753004', 'Aida A'),
('15753005', 'Denny Adam'),
('15753006', 'CRISTIANSON SIHOMBING'),
('15753007', 'Deby'),
('15753008', 'Diah A'),
('15753009', 'Diah Santika'),
('15753010', 'Ima'),
('15753011', 'Gilda'),
('15753012', 'Arta W'),
('15753013', 'Chandra'),
('15753014', 'Anita Safitri'),
('15753015', 'Febri Ambika'),
('15753016', 'Heri'),
('15753017', 'Zayn Malik'),
('15753019', 'Mikha'),
('15753020', 'Yenni'),
('15753021', 'Hadi Saputra'),
('15753022', 'Jantika Ayu'),
('15753023', 'Lala Karmela'),
('15753024', 'Tika Yesi'),
('15753025', 'Dewa Gede'),
('15753026', 'Bintang A'),
('15753027', 'Mario'),
('15753028', 'Aman Natur'),
('15753029', 'Egi Maulana FIkri'),
('15753031', 'Kevin De Bruyne'),
('15753032', 'Yosi'),
('15753033', 'Jess No Limit'),
('15753034', 'Evos Oura'),
('15753035', 'Evos Galaxy'),
('15753036', 'Swolen Left Thumb'),
('15753037', 'Roy Khiosi'),
('15753038', 'Tri Rahmad'),
('15753039', 'Bob Marley'),
('15753040', 'Radja Naiggollan'),
('15753041', 'Nella Kharisma'),
('15753042', 'Via Vallen'),
('15753043', 'Bayu Skak'),
('15753045', 'Loli'),
('15753046', 'Joko Susilo'),
('15753047', 'Joko Widodo'),
('15753048', 'Yori'),
('15753049', 'Betty'),
('15753050', 'Harry Style'),
('15753051', 'Patrick Star'),
('15753052', 'Mark Marquez'),
('15753053', 'Dani'),
('15753054', 'Malik'),
('15753055', 'Yesi'),
('15753056', 'Rani'),
('15753057', 'Natalia'),
('15753058', 'Karina'),
('15753059', 'Fasha'),
('15753060', 'Bruno'),
('15753061', 'Franco'),
('15753062', 'Didik Sulistyanto'),
('15753063', 'Mawar'),
('15753064', 'Sri'),
('15753065', 'Diana'),
('15753066', 'Gosen'),
('15753067', 'Haylos'),
('15753068', 'Sasuke'),
('15753069', 'Karim Benzema'),
('15753070', 'Hayabusa'),
('15753071', 'Alice'),
('15753072', 'Neymar'),
('15753073', 'Ge Pamungkas'),
('15753074', 'Marsha'),
('15753075', 'Yonada'),
('15753076', 'Yohana A.'),
('15753077', 'Leonardo'),
('15753078', 'John Cena'),
('15753079', 'Rey Misteryo'),
('15753080', 'Arie Keriting'),
('15753081', 'Ibrahimovic'),
('15753082', 'Michael Carrick'),
('15753083', 'Hariono'),
('15753084', 'Bimasakti'),
('15753085', 'Andik Firmansyah'),
('15753086', 'Raul Gonzales'),
('15753087', 'Johnson'),
('15753088', 'Charles Puyol'),
('15753089', 'Fernando Torres'),
('15753090', 'Ronaldo'),
('15753091', 'Hernandez'),
('15753092', 'Cristiano Ronaldo'),
('15753093', 'Boss Jono'),
('15753094', 'Jeremi Teti'),
('15753095', 'Luna Maya'),
('15753096', 'Cut Tari'),
('15753097', 'Cinta Laura'),
('15753098', 'Aura Kasih'),
('15753099', 'Dewi Sandra'),
('15753100', 'Ariel Peterpan'),
('1575378', 'Bautista'),
('23', '3234');

-- --------------------------------------------------------

--
-- Table structure for table `mteammhs`
--

CREATE TABLE `mteammhs` (
  `cnoteam` varchar(5) NOT NULL,
  `cnmteam` varchar(100) NOT NULL,
  `cjmlagt` int(11) NOT NULL,
  `csmt` enum('e','o') NOT NULL,
  `cthnajar` varchar(8) NOT NULL,
  `ctglawallomba` date NOT NULL,
  `ctglakhirlomba` date NOT NULL,
  `ctempatlomba` varchar(100) NOT NULL,
  `cprestasi` varchar(100) NOT NULL,
  `cbukti` varchar(100) NOT NULL,
  `cfoto` varchar(100) NOT NULL,
  `cuserentri` int(11) NOT NULL,
  `ctglentri` int(11) NOT NULL,
  `cnokegiatan` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mteammhs`
--

INSERT INTO `mteammhs` (`cnoteam`, `cnmteam`, `cjmlagt`, `csmt`, `cthnajar`, `ctglawallomba`, `ctglakhirlomba`, `ctempatlomba`, `cprestasi`, `cbukti`, `cfoto`, `cuserentri`, `ctglentri`, `cnokegiatan`) VALUES
('00021', 'super hero', 5, 'e', '20162017', '2018-03-09', '2018-03-17', 'kemiling', 'juara 2', 'kskn.png', 'hdb.png', 1, 2018, '001'),
('00042', 'hagi', 5, 'o', '20162017', '2018-03-17', '2018-03-23', 'jijf ', 'jura 1', 'psd-logo-5.jpg', 'UHD.png', 1, 2018, '041'),
('001', 'UBL A', 12, 'o', '20172018', '2017-12-01', '2017-12-01', 'Gelora Bung Karno', 'Juara Keempat', 'banner.jpg', 'deadmau5_concert_el-paso.jpg', 1, 2018, '002'),
('002', 'UBL B', 12, 'e', '20162017', '2016-09-09', '2016-05-10', 'Gelora Bung Karno', 'Posisi Ke-7', 'zayn.png', 'wolf.jpg', 1, 2018, '002'),
('003', 'Kings UBL', 6, 'o', '20152016', '2015-05-04', '2015-12-04', 'Istora Senayan', 'Juara 1', 'banner.jpg', 'zayn.png', 1, 2018, '001'),
('0041', 'yoku', 5, 'o', '20172018', '2018-03-01', '2018-03-02', 'kedaton', 'juaran 2', 'eco_label_brown.png', 'download.jpg', 1, 2018, '041');

-- --------------------------------------------------------

--
-- Table structure for table `tagtteam`
--

CREATE TABLE `tagtteam` (
  `cnoteam` varchar(5) NOT NULL,
  `cnim` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `cuserentri` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`cuserentri`, `username`, `password`) VALUES
(1, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mkategori`
--
ALTER TABLE `mkategori`
  ADD PRIMARY KEY (`cnokategori`);

--
-- Indexes for table `mkegiatan`
--
ALTER TABLE `mkegiatan`
  ADD PRIMARY KEY (`cnokegiatan`),
  ADD KEY `cnokategori` (`cnokategori`);

--
-- Indexes for table `mmhs`
--
ALTER TABLE `mmhs`
  ADD PRIMARY KEY (`cnim`);

--
-- Indexes for table `mteammhs`
--
ALTER TABLE `mteammhs`
  ADD PRIMARY KEY (`cnoteam`),
  ADD KEY `cnokegiatan` (`cnokegiatan`);

--
-- Indexes for table `tagtteam`
--
ALTER TABLE `tagtteam`
  ADD PRIMARY KEY (`cnoteam`,`cnim`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`cuserentri`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `cuserentri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mkegiatan`
--
ALTER TABLE `mkegiatan`
  ADD CONSTRAINT `mkegiatan_ibfk_1` FOREIGN KEY (`cnokategori`) REFERENCES `mkategori` (`cnokategori`);

--
-- Constraints for table `mteammhs`
--
ALTER TABLE `mteammhs`
  ADD CONSTRAINT `mteammhs_ibfk_1` FOREIGN KEY (`cnokegiatan`) REFERENCES `mkegiatan` (`cnokegiatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
