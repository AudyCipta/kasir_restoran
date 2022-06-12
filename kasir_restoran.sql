-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2022 at 05:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(50) DEFAULT NULL,
  `tgl_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_bayar` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `no_pesanan`, `tgl_bayar`, `status_bayar`) VALUES
(8, '202206091HXSM3L6', '2022-06-09 07:21:25', 'Lunas'),
(9, '202206129BQYAUMZ', '2022-06-12 14:38:47', 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `tgl_dibuat`) VALUES
(1, 'Ayam', '2022-05-27 06:09:41'),
(2, 'Sayuran', '2022-05-27 06:11:04'),
(3, 'Ikan', '2022-05-27 06:13:58'),
(4, 'Minuman', '2022-05-27 03:00:15'),
(9, 'Dessert', '2022-06-12 13:38:30'),
(10, 'Snacks', '2022-06-12 13:38:30'),
(11, 'Nasi', '2022-06-12 14:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama`, `tgl_dibuat`) VALUES
(1, 'Admin', '2022-06-06 04:04:43'),
(2, 'Kasir', '2022-06-06 04:04:43'),
(3, 'Pelanggan', '2022-06-06 04:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` double(50,0) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `komposisi` text NOT NULL,
  `deskripsi` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `harga`, `foto`, `komposisi`, `deskripsi`, `status`, `tgl_dibuat`, `kategori_id`) VALUES
(1, 'Ayam Geprek', 15000, '1HCXKE38_Ayam_geprek.png', '1 dada ayam \r\n3 sendok nasi putih\r\n5 sendok makan sambal merah', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-05-28 06:13:09', 1),
(2, 'Gurame Bakar Pedas', 50000, 'A7L3DIWM_gurame bakar.jpg', '2 ekor gurami ukuran sedang \r\n2 sdm minyak untuk menggoreng\r\n1 sdm air perasan lemon\r\n1 sdt merica bubuk\r\n1 sdt garam', 'Lorem ipsum, dolor sit amet consectetur, adipisicing elit. Harum beatae veritatis omnis odit! Ipsam recusandae est incidunt quis, sunt iusto perspiciatis reprehenderit aliquid veniam. Laudantium dolorum maxime cumque repudiandae expedita quis modi recusandae omnis explicabo atque hic, beatae saepe non qui harum nesciunt delectus assumenda totam numquam fugiat officia iusto?', 1, '2022-06-08 07:10:43', 3),
(3, 'Lele Goreng Gurih', 45000, 'JLSEHZ65_lele.jpg', '8 ekor lele segar\r\n4 siung bawang merah\r\n2 siung bawang putih\r\n1 kelingking kunyit\r\n1 sdm ketumbar', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae libero, vel ut soluta harum quas velit voluptates, modi tempore, officiis ullam, quisquam omnis nostrum porro tempora. Ex non minus aspernatur est ea repudiandae voluptates velit asperiores totam maiores veniam expedita, placeat minima ipsa odio deserunt harum illo. Delectus laboriosam, ipsa!', 1, '2022-06-09 14:06:52', 3),
(4, 'Mie Ayam Tek-tek', 25000, '2CPQSBA3_images_mie_Mie_tek-tek_52-mie-tek-tek-jawa.jpg', '100 gr mie telor \r\n1 buah tomat \r\n3 lembar kol \r\n5 lembar sawi hijau \r\nDada ayam fillet suwir \r\n2 butir telur \r\n2 sendok makan kecap manis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-05-28 06:13:09', 1),
(6, 'Banana Split', 20000, 'JE4TC8M1_banana split.jpg', '1 buah pisang\r\n1 scoop es krim coklat\r\n1 scoop es krim stroberi\r\n1 scoop es krim vanilla\r\nSaus coklat\r\nBuah stroberi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 13:40:41', 9),
(7, 'Jus Jeruk', 15000, 'YDRL1SAM_jus jeruk.jpg', '2 Buah Jeruk murni\\r\\n2 sdm gula pasir\\r\\nes batu', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\\r\\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 13:42:44', 4),
(8, 'Jamur Crispy', 15000, 'WY2R1BT3_jamur crispy.jpg', '300 gr jamur tiram\r\n1 sdt lada bubuk\r\n1 sdt garam\r\n1 sdt penyedap rasa\r\n4 sdm tepung bumbu\r\nSaos sambal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 13:45:33', 10),
(9, 'Lumpia Goreng', 15000, '8UZ31ABM_lumpia.jpg', '200 gr daging ayam\r\n100 gr kembang kol\r\n100 gr wortel\r\n3 lembar kulit lumpia\r\nSaos sambal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 13:49:32', 10),
(10, 'Kentang Goreng', 15000, 'J6L1KHS4_kentang goreng.jpg', '300 gr kentang\r\n2 sdt penyedap rasa\r\n2 sdt lada bubuk\r\n2 sdt garam\r\nSaos sambal', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 14:03:22', 10),
(11, 'Es Teh', 10000, 'VNTYALBK_bbe17d0b-34c0-44d3-8373-c53c7a5dee91.jpg', 'Teh hitam\r\n2 sdt gula', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 14:17:53', 4),
(12, 'Es Soda Gembira', 12000, 'M5VTN3K2_soda-gembira.jpg', 'Soda \r\nSirup cocopandan\r\nSKM', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 14:19:55', 4),
(13, 'Kopi Hitam Hangat', 12000, '2DBU7K48_096456700_1645415137-Minum_Kopi_Hitam_Bisa_Kurangi_Sesak_Napas.jpg', '2 sdt kopi hitam\r\n2 sdt gula', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 14:21:14', 4),
(14, 'Air mineral', 5000, 'E1JAVYM8_7925281_9dcc9846-2e6b-4335-9264-179d266b4a3b_1728_1728.jpg', 'Air minum 600 ml.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 14:25:35', 4),
(15, 'Nasi putih', 5000, 'SNY6RPT7_039440500_1486629502-kamar_2.jpg', 'Nasi putih 300 gr.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec tellus dictum, sit amet dictum mi dictum. In ac mauris felis. Donec id sapien mi. Vestibulum laoreet facilisis odio, eget tempor tellus pellentesque id. Integer sed odio erat.', 1, '2022-06-12 14:28:16', 11),
(16, 'Nasi goreng', 20000, 'Y4P3RAND_Screenshot 2022-06-12 223602.png', '3 sdm minyak sayur\r\n4 buah sosis ayam\r\n50 g daging ayam \r\n300 g nasi putih dingin\r\n4 sdm Kecap Manis \r\n1 sdm bubuk perasa ayam\r\n1 batang daun bawang \r\n1 butir telur ayam kocok\r\nTelur mata sapi\r\nKol yang sudah diiris halus\r\nTimun yang sudah dipotong dalam bagian kecil\r\nEmping goreng', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor', 1, '2022-06-12 14:38:24', 11),
(17, 'Kerupuk Udang', 2000, '6ASN432Z_Screenshot 2022-06-12 224435.png', 'Udang segar\\r\\nTepung tapioka \\r\\nBawang putih\\r\\nTelur\\r\\nGaram\\r\\nGula pasir', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla', 1, '2022-06-12 14:44:56', 10),
(18, 'Es Krim', 10000, 'BNL48VXS_es krim.jpg', '1 kaleng susu kental manis\r\n1 butir telur \r\n1/2 sendok teh vanili bubuk\r\n3 sendok makan tepung maizena\r\n2 kaleng air bersih\r\nPasta makanan strawberry, coklat\r\n1 sendok makan SP yang telah dilelehkan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec suscipit, diam quis sodales ornare, nisl quam tincidunt nibh, nec lobortis ex magna et urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas ac augue sed elit pellentesque condimentum et at magna. Integer ut dolor mattis, efficitur nisl nec, tempor nisi. Aliquam at dignissim ex. Morbi sed libero vel velit congue sagittis. Nulla facilisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\nMauris sit amet tortor fringilla, iaculis tortor feugiat, tincidunt massa. Integer et venenatis magna. Mauris rhoncus lobortis turpis vel faucibus. Vestibulum sed elit feugiat, maximus ipsum nec, rutrum dui. Fusce quis massa sed velit rutrum viverra. Proin sollicitudin justo nec', 1, '2022-06-12 14:47:24', 9);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(50) NOT NULL,
  `tgl_bayar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_bayar` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `no_pesanan`, `tgl_bayar`, `status_bayar`) VALUES
(1, '20201212J24YET5V', '2022-05-28 15:58:18', 'Lunas'),
(10, '20220612TQBC3ZJM', '2022-06-12 14:38:59', 'Lunas'),
(11, '20220612CX91BHIT', '2022-06-12 14:57:09', 'Lunas'),
(12, '20220612N6WBYE8H', '2022-06-12 14:57:38', 'Lunas');

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `histori_pesanan` AFTER DELETE ON `pembayaran` FOR EACH ROW BEGIN
INSERT INTO history VALUES
(old.id, old.no_pesanan, old.tgl_bayar, old.status_bayar);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default.svg',
  `level_id` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `foto`, `level_id`) VALUES
(12, 'Puts', 'putrisuariy@gmail.com', '$2y$10$kJGjI6yJRz/F9tnbaNcGuurSlwsKr6CxfTP73NnoeQviSP3dnFUva', 'default.svg', 3),
(13, 'kasheer', 'kasher@gmail.com', '$2y$10$dAkkGLp.CVTyTfqkrwH4hemXYQVJjNNuXzh34u0he/68OQ2RhXUPq', 'default.svg', 2),
(14, 'Admin Utama', 'admin@gmail.com', '$2y$10$oelz1i8nzwnsNmkiOiD0iOANiX81c5pjK3WIa2PZtEKvhjMQ5lBO6', 'default.svg', 1),
(15, 'Oddyy', 'audy@gmail.com', '$2y$10$UfPbH31bSzGOT744Uiph/eOO93PGhlT5FcO6qAaegaUcYp..7DSv2', 'HQW9JETP_JTY52P9L_user.png', 3),
(16, 'Pembeli', 'pembeli@gmail.com', '$2y$10$k/R.gmzeTz/5MXTimA2ATuO3d5nyHuQvmOZCp7T7sbTp/WGvXde96', 'default.svg', 3),
(17, 'Pembeliee', 'pembeliee@gmail.com', '$2y$10$j4Svq2pEwBSj27L1ZuegC.5wFsLWdR0RH.DuCVKqs29vbEWkst7CW', 'default.svg', 3),
(18, 'buyer', 'buyer@gmail.com', '$2y$10$Z1RxQrlpvZAiAAhgpkS/yuax1ESNt64GAluYGU0VCAS2VegFgGhbm', 'default.svg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `no_pesanan` varchar(50) NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `no_meja` varchar(10) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_bayar` double(50,0) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `no_pesanan`, `pengguna_id`, `no_meja`, `menu_id`, `jumlah`, `total_bayar`, `status`) VALUES
(1, '20201212J24YET5V', 3, '1', 3, 2, 90000, 'Lunas'),
(2, '20201212J24YET5V', 3, '1', 2, 1, 50000, 'Lunas'),
(21, '20220612TQBC3ZJM', 15, '1', 10, 1, 15000, 'Lunas'),
(22, '20220612TQBC3ZJM', 15, '1', 7, 2, 30000, 'Lunas'),
(23, '20220612TQBC3ZJM', 15, '1', 2, 1, 50000, 'Lunas'),
(24, '20220612TQBC3ZJM', 15, '1', 4, 1, 25000, 'Lunas'),
(30, '20220612N6WBYE8H', 18, '1', 18, 1, 10000, 'Lunas'),
(31, '20220612N6WBYE8H', 18, '1', 16, 1, 20000, 'Lunas'),
(32, '20220612N6WBYE8H', 18, '1', 17, 1, 2000, 'Lunas'),
(33, '20220612N6WBYE8H', 18, '1', 12, 1, 12000, 'Lunas'),
(34, '20220612N6WBYE8H', 18, '1', 9, 1, 15000, 'Lunas'),
(35, '20220612N6WBYE8H', 18, '1', 8, 1, 15000, 'Lunas'),
(36, '20220612N6WBYE8H', 18, '1', 14, 1, 5000, 'Lunas'),
(37, '20220612CX91BHIT', 17, '2', 13, 1, 12000, 'Lunas'),
(38, '20220612CX91BHIT', 17, '2', 11, 2, 20000, 'Lunas'),
(39, '20220612CX91BHIT', 17, '2', 15, 5, 25000, 'Lunas'),
(40, '20220612CX91BHIT', 17, '2', 7, 1, 15000, 'Lunas'),
(41, '20220612CX91BHIT', 17, '2', 12, 2, 24000, 'Lunas'),
(42, '20220612CX91BHIT', 17, '2', 2, 1, 50000, 'Lunas'),
(43, '20220612CX91BHIT', 17, '2', 3, 1, 45000, 'Lunas'),
(44, '20220612CX91BHIT', 17, '2', 4, 1, 25000, 'Lunas'),
(45, '20220612CX91BHIT', 17, '2', 9, 1, 15000, 'Lunas'),
(46, '20220612CX91BHIT', 17, '2', 18, 3, 30000, 'Lunas'),
(47, '20220612CX91BHIT', 17, '2', 6, 2, 40000, 'Lunas'),
(48, '20220612CX91BHIT', 17, '2', 17, 4, 8000, 'Lunas'),
(49, '20220612CX91BHIT', 17, '2', 10, 2, 30000, 'Lunas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
