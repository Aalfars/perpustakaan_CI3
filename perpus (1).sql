-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 09:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `buku_id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `sinopsis` text NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `stok` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`buku_id`, `judul`, `penulis`, `penerbit`, `sinopsis`, `tahun_terbit`, `stok`, `foto`) VALUES
(1, 'Akasha Who Is To Blame The Bully, Or The Bullied 01', 'Chikara Kimizuka - Yen Hioka', 'm&c!', 'Aizawa Yuuichi datang ke acara reuni SMP meski tak diundang. Dia korban perundungan teman-temannya selama bertahun-tahun, dan kini dia datang untuk membalas…', 2021, 7, '20240917063519.jpg'),
(2, 'Funiculi Funicula (Toshikazu Kawaguchi)', 'Toshikazu Kawaguchi', 'Gramedia Pustaka Utama', 'Di sebuah gang kecil di Tokyo, ada kafe tua yang bisa membawa pengunjungnya menjelajahi waktu. Keajaiban kafe itu menarik seorang wanita yang ingin memutar waktu untuk berbaikan dengan kekasihnya, seorang perawat yang ingin membaca surat yang tak sempat diberikan suaminya yang sakit, seorang kakak yang ingin menemui adiknya untuk terakhir kali, dan seorang ibu yang ingin bertemu dengan anak yang mungkin takkan pernah dikenalnya.   Namun ada banyak peraturan yang harus diingat. Satu, mereka harus tetap duduk di kursi yang telah ditentukan. Dua, apa pun yang mereka lakukan di masa yang didatangi takkan mengubah kenyataan di masa kini. Tiga, mereka harus menghabiskan kopi khusus yang disajikan sebelum kopi itu dingin.   Rentetan peraturan lainnya tak menghentikan orang-orang itu untuk menjelajahi waktu. Akan tetapi, jika kepergian mereka tak mengubah satu hal pun di masa kini, layakkah semua itu dijalani?', 2020, 5, '20240917063938.jpg'),
(4, 'Komik Yotsuba& 02 ', 'Kiyohiko Azuma', 'Elex Media Komputindo', 'Terpengaruh acara televisi, Yotsuba pun menenteng pistol airnya dan berlagak akan membalaskan dendam ayahnya. Kakak-kakak cantik tetangga adalah sasarannya. Dimulai dari ibu yang membukakan pintu. Lalu Ena, Fuuka, kemudian yang terakhir Asagi. Namun, Asagi tidak mau mengikuti permainan ala Yotsuba. Dia menangkis serangan dan berhasil merebut pistol dari tangan Yotsuba. Apa yang selanjutnya terjadi pada Yotsuba?', 2023, 12, '20240918081424.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori`) VALUES
(1, 'Novel'),
(3, 'Komik'),
(4, 'Sejarah');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi`
--

CREATE TABLE `koleksi` (
  `koleksi_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksi`
--

INSERT INTO `koleksi` (`koleksi_id`, `user_id`, `buku_id`) VALUES
(2, 1, 3),
(6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjaman_id` int(11) NOT NULL,
  `peminjam_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `tanggal_peminjaman` date DEFAULT NULL,
  `batas_waktu` date DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `status_peminjaman` enum('dipinjam','dipesan','dikembalikan','ditolak') NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`peminjaman_id`, `peminjam_id`, `buku_id`, `petugas_id`, `tanggal_peminjaman`, `batas_waktu`, `tanggal_pengembalian`, `status_peminjaman`, `denda`) VALUES
(1, 1, 1, 3, '2024-09-18', '0000-00-00', '2024-09-18', 'dikembalikan', 0),
(7, 1, 2, 3, '2024-09-01', '2024-09-02', '2024-09-18', 'dikembalikan', 8000),
(8, 1, 1, 3, '2024-09-18', '2024-09-25', NULL, 'dipinjam', 0),
(9, 7, 1, 3, '2024-09-19', '2024-09-26', NULL, 'dipinjam', 0),
(10, 1, 2, 3, '2024-09-19', '2024-09-26', '2024-09-19', 'dikembalikan', 0),
(11, 1, 2, 3, '2024-09-19', '2024-09-26', '2024-09-19', 'dikembalikan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `relasi`
--

CREATE TABLE `relasi` (
  `relasi_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relasi`
--

INSERT INTO `relasi` (`relasi_id`, `kategori_id`, `buku_id`) VALUES
(1, 3, 1),
(5, 1, 0),
(6, 3, 0),
(13, 1, 0),
(14, 3, 0),
(50, 1, 2),
(51, 3, 2),
(70, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `ulasan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`ulasan_id`, `user_id`, `buku_id`, `ulasan`, `rating`, `tanggal`) VALUES
(6, 1, 1, 'adsasda', 2, '2024-09-19'),
(7, 1, 1, 'dsadasd', 5, '2024-09-19'),
(9, 1, 2, 'test aja nih', 4, '2024-09-19'),
(10, 1, 4, 'test aja sih bang', 1, '2024-09-19'),
(11, 7, 1, 'test', 1, '2024-09-19'),
(13, 1, 1, 'hahah', 1, '2024-09-19'),
(14, 1, 1, 'etyfday', 1, '2024-09-19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('peminjam','admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `nama`, `password`, `alamat`, `email`, `role`) VALUES
(1, 'peminjam', 'Peminjam Nihhh', '$2y$10$9K8yYj.si8WbWzwjiZIm/.7JzZBJw98XoSSaTFnV.aFZ7GVVmn4ga', 'Lorem Ipsum Rt 02 Rw 09 Dolot Sit Amet', 'peminjam@gmail.com', 'peminjam'),
(2, 'Admin', 'Admin Bangg', '$2y$10$9K8yYj.si8WbWzwjiZIm/.7JzZBJw98XoSSaTFnV.aFZ7GVVmn4ga', 'Lorem Ipsum Rt 02 Rw 09 Dolot Sit Amet', 'admin@gmail.com', 'admin'),
(3, 'petugas', 'Petugas Geloo', '$2y$10$zks2TjMB4rCpuXXPeyBFl.hRHo5HM2x2NN3flw8qemH.nPZyPv2wu', 'Lorem Ipsum Rt 02 Rw 09 Dolot Sit Amet', 'petugas@gmail.com', 'petugas'),
(5, 'umar', 'Ibnu Umar', '$2y$10$.s3ZNsS.LX0/HLH18cdoUuZGL03OqdOa/Rty470RoQ6S3rQ/xNSJ6', 'ffdagusiahsduiwqahdauwihduiashsduihaduihawuidbaubdsuasbduibawu', 'umar@gmail.com', 'peminjam'),
(7, 'apa', 'daj', '$2y$10$3XDs5YyBIhzJAaF12krwTe0Hbw69QWYJISkvuy2zAWlhG0rl91AlS', 'uihfarufgau', 'apa@gmail.com', 'peminjam'),
(8, 'testt', 'test nih', '$2y$10$nLFhdjUBG8KRC7u8IJ2iQes4Ax8EM0V/J0I0uMGuJMVnmYSiY/riK', 'rjdhasuidgfhuiaehfuiaegf', 'test@gmail.com', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`buku_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `koleksi`
--
ALTER TABLE `koleksi`
  ADD PRIMARY KEY (`koleksi_id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjaman_id`);

--
-- Indexes for table `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`relasi_id`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`ulasan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `buku_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `koleksi`
--
ALTER TABLE `koleksi`
  MODIFY `koleksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `peminjaman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `relasi`
--
ALTER TABLE `relasi`
  MODIFY `relasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `ulasan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
