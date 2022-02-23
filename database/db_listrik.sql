-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Feb 2022 pada 12.47
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_listrik`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `selectDaya` ()  BEGIN
	SELECT * FROM v_penggunaan WHERE daya = "900W";
END$$

--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `totalMeter` (`awal` INT(11), `akhir` INT(11)) RETURNS INT(11) BEGIN
	DECLARE total INT(11);
	SET total = akhir - awal;
	RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nomor_kwh` char(40) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `image` varchar(120) NOT NULL,
  `id_tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `alamat`, `nama_pelanggan`, `image`, `id_tarif`) VALUES
(1, 'ekaskitz', '$2y$10$zN4u//v0W1GHTlTjb3Z/ZeiSn.I9xZfMblthfj24ZEO0y1IVsLnNC', '2022020201', 'Bogor, Jawa Barat', 'Eka W', 'default.jpg', 3),
(2, 'shenny', '$2y$10$qyJ6jJDTRZwWfvZJ.ZEmBu/4waTafINXbP2U0nWRb.mxcElpGNWOa', '2022020202', 'Tangerang, Banten', 'Shenny', 'default.jpg', 1),
(3, 'ahmad', '$2y$10$pYp4mOlwMf5bzBpYsjj3SuC.FQv7OOc47hTc.jiRkn7/MonmuU37e', '2022020203', 'Bogor, Jawa Barat', 'Ahmad Maulana', 'default.jpg', 3),
(4, 'surya', '$2y$10$RDPJsg5hUzB3u94MMeWbW.pN1uTM.5D95CKpjLXpk/g9OTnIZ9lFy', '2022020804', 'Bogor, Jawa Barat', 'Surya Intan', 'default.jpg', 3),
(10, 'pelanggan', '$2y$10$4RG5ci3MZrkOZ2LrmzqDDuPDkN02c0P8WoAOKAK3nQhTRz5W4jrjm', '2022021205', 'Bogor, Jawa Barat', 'Pelanggan', 'default.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
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
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_pelanggan`, `tgl_bayar`, `bulan`, `biaya_admin`, `total_bayar`, `id_user`) VALUES
(2, 2, 1, 1644666297, 1644666297, 3000, 39000, 2);

--
-- Trigger `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `trigger_insert_pembayaran` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN 
UPDATE tagihan SET tagihan.status = 'dibayar' WHERE tagihan.id_tagihan = NEW.id_tagihan;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan`
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
-- Dumping data untuk tabel `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
(1, 1, 2, 2022, 0, 40);

--
-- Trigger `penggunaan`
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
-- Stand-in struktur untuk tampilan `qw_admin`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `qw_admin` (
`id_user` int(11)
,`username` varchar(100)
,`password` varchar(100)
,`nama_admin` varchar(100)
,`id_level` int(11)
,`image` varchar(120)
,`nama_level` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
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
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
(2, 1, 1, '2', 2022, 40, 'Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `daya` varchar(100) DEFAULT NULL,
  `tarif_perkwh` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarif_perkwh`) VALUES
(1, '900VA', 500),
(2, '1300VA', 700),
(3, '1500VA', 900),
(4, '1700VA', 1200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_admin` varchar(100) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_admin`, `id_level`, `image`) VALUES
(2, 'ekawardana', '$2y$10$czTfisg3ve2J3IM6ma12J.hS0cwBBhQ01WY32AG/Et57BXyre/EVW', 'Eka Wardana', 1, 'default.jpg'),
(3, 'ekaskitz', '$2y$10$yvbblikCaqMOHbVweSEfK.cllWxBm9kOT60N40w6cxbhN1cy7QFQC', 'Ekawardana', 1, 'profile.jpg'),
(4, 'admin', '$2y$10$D4yGjDxsPKcf/9u6QNn1pebZuwwK55JACxPR1YjQhJ301MOCbdk0W', 'Admin Listrik', 1, 'default.jpg');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_pelanggan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_pelanggan` (
`id_pelanggan` int(11)
,`username` varchar(100)
,`password` varchar(100)
,`nomor_kwh` char(40)
,`alamat` varchar(100)
,`nama_pelanggan` varchar(100)
,`image` varchar(120)
,`id_tarif` int(11)
,`daya` varchar(100)
,`tarif_perkwh` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_penggunaan`
-- (Lihat di bawah untuk tampilan aktual)
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
-- Stand-in struktur untuk tampilan `v_tagihan`
-- (Lihat di bawah untuk tampilan aktual)
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
-- Struktur untuk view `qw_admin`
--
DROP TABLE IF EXISTS `qw_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `qw_admin`  AS SELECT `user`.`id_user` AS `id_user`, `user`.`username` AS `username`, `user`.`password` AS `password`, `user`.`nama_admin` AS `nama_admin`, `user`.`id_level` AS `id_level`, `user`.`image` AS `image`, `level`.`nama_level` AS `nama_level` FROM (`user` join `level` on(`user`.`id_level` = `level`.`id_level`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pelanggan`
--
DROP TABLE IF EXISTS `v_pelanggan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pelanggan`  AS SELECT `pelanggan`.`id_pelanggan` AS `id_pelanggan`, `pelanggan`.`username` AS `username`, `pelanggan`.`password` AS `password`, `pelanggan`.`nomor_kwh` AS `nomor_kwh`, `pelanggan`.`alamat` AS `alamat`, `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`, `pelanggan`.`image` AS `image`, `pelanggan`.`id_tarif` AS `id_tarif`, `tarif`.`daya` AS `daya`, `tarif`.`tarif_perkwh` AS `tarif_perkwh` FROM (`pelanggan` join `tarif` on(`pelanggan`.`id_tarif` = `tarif`.`id_tarif`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_penggunaan`
--
DROP TABLE IF EXISTS `v_penggunaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penggunaan`  AS SELECT `pelanggan`.`nomor_kwh` AS `nomor_kwh`, `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`, `penggunaan`.`id_penggunaan` AS `id_penggunaan`, `penggunaan`.`id_pelanggan` AS `id_pelanggan`, `penggunaan`.`bulan` AS `bulan`, `penggunaan`.`tahun` AS `tahun`, `penggunaan`.`meter_awal` AS `meter_awal`, `penggunaan`.`meter_akhir` AS `meter_akhir`, `tarif`.`daya` AS `daya` FROM ((`pelanggan` join `penggunaan` on(`pelanggan`.`id_pelanggan` = `penggunaan`.`id_pelanggan`)) join `tarif` on(`pelanggan`.`id_tarif` = `tarif`.`id_tarif`)) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_tagihan`
--
DROP TABLE IF EXISTS `v_tagihan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tagihan`  AS SELECT `tagihan`.`id_tagihan` AS `id_tagihan`, `tagihan`.`id_penggunaan` AS `id_penggunaan`, `tagihan`.`id_pelanggan` AS `id_pelanggan`, `tagihan`.`bulan` AS `bulan`, `tagihan`.`tahun` AS `tahun`, `tagihan`.`jumlah_meter` AS `jumlah_meter`, `tagihan`.`status` AS `status`, `pelanggan`.`nomor_kwh` AS `nomor_kwh`, `pelanggan`.`nama_pelanggan` AS `nama_pelanggan`, `penggunaan`.`meter_awal` AS `meter_awal`, `penggunaan`.`meter_akhir` AS `meter_akhir`, `tarif`.`daya` AS `daya`, `tarif`.`tarif_perkwh` AS `tarif_perkwh` FROM (((`tagihan` join `penggunaan` on(`tagihan`.`id_penggunaan` = `penggunaan`.`id_penggunaan`)) join `pelanggan` on(`tagihan`.`id_pelanggan` = `pelanggan`.`id_pelanggan`)) join `tarif` on(`pelanggan`.`id_tarif` = `tarif`.`id_tarif`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `idx_pelanggan` (`id_tarif`) USING BTREE;

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_tagihan` (`id_tagihan`);

--
-- Indeks untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `idx_tagihan` (`id_penggunaan`,`id_pelanggan`) USING BTREE,
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `idx_user` (`id_level`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_5` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_6` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_ibfk_2` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
