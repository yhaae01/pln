-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2022 at 04:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pln`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectDaya` ()  BEGIN
	SELECT * FROM v_penggunaan WHERE daya = "900W";
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `totalMeter` (`awal` INT(11), `akhir` INT(11)) RETURNS INT(11) BEGIN
	DECLARE total INT(11);
	SET total = akhir - awal;
	RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nomor_kwh` char(40) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `id_tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `alamat`, `nama_pelanggan`, `id_tarif`) VALUES
(1, 'aldi99', '$2y$10$uD.nPOYqNV91SoFjhvPsFekNEpHAELLSVhG3ToPXrJaBQ3BHunKeK', '2022020201', 'Bogor, Jawa Barat', 'Aldi Tegar Prakoso', 1),
(3, 'ahmad10', '$2y$10$uD.nPOYqNV91SoFjhvPsFekNEpHAELLSVhG3ToPXrJaBQ3BHunKeK', '2022020203', 'Bogor, Jawa Barat', 'Ahmad Maulana', 2),
(4, 'eka123', '$2y$10$uD.nPOYqNV91SoFjhvPsFekNEpHAELLSVhG3ToPXrJaBQ3BHunKeK', '2022020804', 'Bogor, Jawa Barat', 'Eka Wardana', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_tagihan` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `tgl_bayar` int(20) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `biaya_admin` int(11) DEFAULT 2000,
  `total_bayar` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_pelanggan`, `tgl_bayar`, `bulan`, `biaya_admin`, `total_bayar`, `id_user`) VALUES
(5, 5, 3, 1645458502, 1645458502, 3000, 52000, 2);

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `trigger_insert_pembayaran` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN 
UPDATE tagihan SET tagihan.status = 'dibayar' WHERE tagihan.id_tagihan = NEW.id_tagihan;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `meter_awal` int(11) DEFAULT NULL,
  `meter_akhir` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
(3, 1, 2, 2022, 0, 100),
(4, 3, 2, 2022, 0, 70),
(5, 4, 2, 2022, 0, 50);

--
-- Triggers `penggunaan`
--
DELIMITER $$
CREATE TRIGGER `trigger_insert_penggunaan` AFTER INSERT ON `penggunaan` FOR EACH ROW BEGIN 
INSERT INTO tagihan (
id_tagihan,
id_penggunaan,
id_pelanggan,
bulan,
tahun,
jumlah_meter,
status
)

VALUES (
null,
NEW.id_penggunaan,
NEW.id_pelanggan,
NEW.bulan,
NEW.tahun,
(SELECT totalMeter(meter_awal, meter_akhir) FROM penggunaan WHERE penggunaan.id_pelanggan = NEW.id_pelanggan),
'belum dibayar'
);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_penggunaan` AFTER UPDATE ON `penggunaan` FOR EACH ROW BEGIN 

UPDATE tagihan SET tagihan.jumlah_meter = (SELECT totalMeter(meter_awal, meter_akhir) FROM penggunaan WHERE penggunaan.id_pelanggan = NEW.id_pelanggan), tagihan.status = 'belum dibayar' WHERE tagihan.id_penggunaan = old.id_penggunaan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_penggunaan` int(11) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `bulan` varchar(11) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `jumlah_meter` int(11) DEFAULT NULL,
  `status` enum('Dibayar','Belum Dibayar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
(4, 3, 1, '2', 2022, 100, 'Dibayar'),
(5, 4, 3, '2', 2022, 70, 'Belum Dibayar'),
(6, 5, 4, '2', 2022, 50, 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `daya` varchar(100) DEFAULT NULL,
  `tarif_perkwh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarif_perkwh`) VALUES
(1, '900VA', 500),
(2, '1300VA', 700),
(3, '1500VA', 900),
(4, '1700VA', 1200);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_admin`, `id_level`) VALUES
(2, 'yhaae01', '$2y$10$uD.nPOYqNV91SoFjhvPsFekNEpHAELLSVhG3ToPXrJaBQ3BHunKeK', 'Surya Intan Permana', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penggunaan`
-- (See below for the actual view)
--
CREATE TABLE `v_penggunaan` (
`nomor_kwh` char(40)
,`nama_pelanggan` varchar(100)
,`id_penggunaan` int(11)
,`id_pelanggan` int(11)
,`bulan` int(11)
,`tahun` year(4)
,`meter_awal` int(11)
,`meter_akhir` int(11)
,`daya` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tagihan`
-- (See below for the actual view)
--
CREATE TABLE `v_tagihan` (
`id_tagihan` int(11)
,`id_penggunaan` int(11)
,`id_pelanggan` int(11)
,`bulan` varchar(11)
,`tahun` year(4)
,`jumlah_meter` int(11)
,`status` enum('Dibayar','Belum Dibayar')
,`nomor_kwh` char(40)
,`nama_pelanggan` varchar(100)
,`meter_awal` int(11)
,`meter_akhir` int(11)
,`daya` varchar(100)
,`tarif_perkwh` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_penggunaan`
--
DROP TABLE IF EXISTS `v_penggunaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penggunaan`  AS SELECT `pelanggan`.`nomor_kwh` AS `nomor_kwh`, `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`, `penggunaan`.`id_penggunaan` AS `id_penggunaan`, `penggunaan`.`id_pelanggan` AS `id_pelanggan`, `penggunaan`.`bulan` AS `bulan`, `penggunaan`.`tahun` AS `tahun`, `penggunaan`.`meter_awal` AS `meter_awal`, `penggunaan`.`meter_akhir` AS `meter_akhir`, `tarif`.`daya` AS `daya` FROM ((`pelanggan` join `penggunaan` on(`pelanggan`.`id_pelanggan` = `penggunaan`.`id_pelanggan`)) join `tarif` on(`pelanggan`.`id_tarif` = `tarif`.`id_tarif`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_tagihan`
--
DROP TABLE IF EXISTS `v_tagihan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tagihan`  AS SELECT `tagihan`.`id_tagihan` AS `id_tagihan`, `tagihan`.`id_penggunaan` AS `id_penggunaan`, `tagihan`.`id_pelanggan` AS `id_pelanggan`, `tagihan`.`bulan` AS `bulan`, `tagihan`.`tahun` AS `tahun`, `tagihan`.`jumlah_meter` AS `jumlah_meter`, `tagihan`.`status` AS `status`, `pelanggan`.`nomor_kwh` AS `nomor_kwh`, `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`, `penggunaan`.`meter_awal` AS `meter_awal`, `penggunaan`.`meter_akhir` AS `meter_akhir`, `tarif`.`daya` AS `daya`, `tarif`.`tarif_perkwh` AS `tarif_perkwh` FROM (((`tagihan` join `penggunaan` on(`tagihan`.`id_penggunaan` = `penggunaan`.`id_penggunaan`)) join `pelanggan` on(`tagihan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) join `tarif` on(`pelanggan`.`id_tarif` = `tarif`.`id_tarif`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `idx_pelanggan` (`id_tarif`) USING BTREE;

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_tagihan` (`id_tagihan`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `idx_tagihan` (`id_penggunaan`,`id_pelanggan`) USING BTREE,
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `idx_user` (`id_level`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
