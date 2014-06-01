-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 30 Mei 2014 pada 18.25
-- Versi Server: 5.6.11
-- Versi PHP: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `erp`
--
CREATE DATABASE IF NOT EXISTS `erp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `erp`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `status` enum('dibuka','dikerjakan','selesai','') NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `catatan` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `id_project`, `id_pelanggan`, `nama`, `status`, `harga`, `tanggal`, `catatan`) VALUES
(1, 0, 0, 'jamput', 'dibuka', 10000, '2014-05-30 00:00:00', 'deadline 10000'),
(2, 0, 1, 'tes', 'dibuka', 12312, '2014-05-20 00:00:00', 'asdasda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `no_telp` text NOT NULL,
  `website` text NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `project_manager` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `anggota_tim` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `id_order`, `project_manager`, `nama`, `tanggal_mulai`, `tanggal_selesai`, `anggota_tim`) VALUES
(1, 1, 2, 'Kiosk', '2014-05-01', '2014-05-31', '4-3'),
(3, 2, 2, 'POS Indomaret', '2014-05-27', '2014-05-27', '4'),
(4, 2, 2, 'Ghost Battle 2', '2014-05-28', '2014-08-26', '6-4-3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_project` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `prioritas` enum('rendah','sedang','tinggi','mendesak') NOT NULL,
  `progress` tinyint(4) NOT NULL DEFAULT '0',
  `deadline` date NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `task`
--

INSERT INTO `task` (`id`, `id_project`, `assigned_to`, `nama`, `prioritas`, `progress`, `deadline`, `deskripsi`) VALUES
(5, 4, 6, 'juamput', 'rendah', 49, '2014-05-28', 'kau <span style="color:rgb(224,102,102);">garap ini i</span>tu<p><blockquote style="margin: 0 0 0 40px; border: none; padding: 0px;"><p style="margin: 0 0 0 40px; border: none; padding: 0px;">fuck</p><p style="margin: 0 0 0 40px; border: none; padding: 0px;"><ul><li>111</li><li>111</li></ul></p></blockquote></p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `auth` tinyint(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `email`, `password`, `auth`) VALUES
(1, 'putuyoga', 'I Putu Yoga Permana', 'putuyoga@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 255),
(2, 'subakri', '', 'sample@sample.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(3, 'rinoadi', '', 'root@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(4, 'dwihardy', '', 'chris@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(5, 'nanassubakri', '', 'nanas@mail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2),
(6, 'fendygp', '', 'albilaga.lp@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(7, 'jebulanea', '', 'arikarik.ae@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 255);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
