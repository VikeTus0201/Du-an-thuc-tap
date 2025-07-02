-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2024 at 12:22 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `du_an_1.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` int NOT NULL,
  `gio_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chuc_vus`
--

CREATE TABLE `chuc_vus` (
  `id` int NOT NULL,
  `ten_chuc_vu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chuc_vus`
--

INSERT INTO `chuc_vus` (`id`, `ten_chuc_vu`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `mo_ta` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `trang_thai`, `mo_ta`) VALUES
(1, 'Nike', 1, 'Danh mục giày Nike'),
(2, 'Adidas', 1, 'Danh mục giày Adidas'),
(3, 'Puma', 1, 'Danh mục giày Puma'),
(4, 'Reebok', 1, 'Danh mục giày Reebok'),
(5, 'Vans', 1, 'Danh mục giày Vans'),
(6, 'Converse', 1, 'Danh mục giày Converse'),
(7, 'New Balance', 1, 'Danh mục giày New Balance');

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `trang_thai_id` int NOT NULL,
  `ngay_tao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int NOT NULL,
  `nguoi_dung_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_san_phams`
--

CREATE TABLE `hinh_anh_san_phams` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `link_hinh_anh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mais`
--

CREATE TABLE `khuyen_mais` (
  `id` int NOT NULL,
  `ma_khuyen_mai` varchar(256) DEFAULT NULL,
  `ten_khuyen_mai` varchar(256) DEFAULT NULL,
  `muc_giam` varchar(20) DEFAULT NULL,
  `so_luong` int DEFAULT NULL,
  `ngay_bat_dau` date DEFAULT NULL,
  `ngay_ket_thuc` date DEFAULT NULL,
  `mo_ta` varchar(256) NOT NULL,
  `trang_thai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `khuyen_mais`
--

INSERT INTO `khuyen_mais` (`id`, `ma_khuyen_mai`, `ten_khuyen_mai`, `muc_giam`, `so_luong`, `ngay_bat_dau`, `ngay_ket_thuc`, `mo_ta`, `trang_thai`) VALUES
(3, 'hugds', 'khuyen mai ngay dac biet666', '30%', 76, '2024-11-21', '2024-11-14', 'hbdsjfg', 1),
(7, 'hugds', 'khuyen mai ngay dac biett', '20%', 5099, '2024-11-21', '2024-11-27', 'giày nike chất lượng cao mới nhất', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kich_thuoc`
--

CREATE TABLE `kich_thuoc` (
  `id` int NOT NULL,
  `so_size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lien_hes`
--

CREATE TABLE `lien_hes` (
  `id` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `noi_dung` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `ngay_tao` date NOT NULL,
  `trang_thai_lh` tinyint NOT NULL,
  `ten_lien_he` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mau_sac`
--

CREATE TABLE `mau_sac` (
  `id` int NOT NULL,
  `ten_mau` varchar(50) NOT NULL,
  `ma_mau_hex` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quan_li_tin_tuc`
--

CREATE TABLE `quan_li_tin_tuc` (
  `id` int NOT NULL,
  `ten_tin_tuc` varchar(225) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quan_li_tin_tuc`
--

INSERT INTO `quan_li_tin_tuc` (`id`, `ten_tin_tuc`, `trang_thai`) VALUES
(4, 'ưerfwefre', 2),
(5, 'mizunoâs', 1),
(6, 'mizunoâsâsassa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(256) NOT NULL,
  `gia_nhap` int NOT NULL,
  `gia_ban` int NOT NULL,
  `gia_khuyen_mai` int NOT NULL,
  `ngay_nhap` date NOT NULL,
  `luot_xem` int NOT NULL,
  `mo_ta` varchar(256) NOT NULL,
  `danh_muc_id` int DEFAULT NULL,
  `trang_thai` int DEFAULT NULL,
  `hinh_anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Bảng chi tiết sản phẩm
CREATE TABLE `san_pham_chi_tiet` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `mau_sac_id` int DEFAULT NULL,
  `kich_thuoc_id` int DEFAULT NULL,
  `so_luong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoans`
--

CREATE TABLE `tai_khoans` (
  `ho_ten` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `so_dien_thoai` varchar(10) NOT NULL,
  `mat_khau` varchar(256) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  `chuc_vu_id` int NOT NULL,
  `dia_chi` varchar(256) NOT NULL,
  `avata` varchar(256) NOT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tai_khoans`
--

INSERT INTO `tai_khoans` (`ho_ten`, `email`, `so_dien_thoai`, `mat_khau`, `trang_thai`, `chuc_vu_id`, `dia_chi`, `avata`, `ngay_sinh`, `id`) VALUES
('Lý Nam Phong', 'phonglnph51412@gmail.com', '000000000', '123456', 1, 1, 'Hà Nội', '', '2024-11-16', 1),
('Lý Nam Phong', 'phongln@gmail.com', '97987768', '12345', 1, 2, 'ha noi', 'Hà Nội', '2024-11-16', 2);

-- --------------------------------------------------------

--
-- Table structure for table `trang_thais`
--

CREATE TABLE `trang_thais` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL,
  `trang_thai_tb` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Dumping data for table `trang_thais`
--

INSERT INTO `trang_thais` (`id`, `ten_trang_thai`, `trang_thai_tb`) VALUES
(4, 'giày mizino', '2'),
(7, 'giày mizinommmm', '3'),
(8, 'giay nam cao cap ', '3'),
(9, 'giày', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tt_don_hangs`
--

CREATE TABLE `tt_don_hangs` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_vietnamese_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gio_hang_id` (`gio_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `chuc_vus`
--
ALTER TABLE `chuc_vus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_trang_thai` (`trang_thai_id`),
  ADD KEY `fk_tai_khoan` (`tai_khoan_id`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nguoi_dung_id` (`nguoi_dung_id`);

--
-- Indexes for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`san_pham_id`);

--
-- Indexes for table `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kich_thuoc`
--
ALTER TABLE `kich_thuoc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lien_hes`
--
ALTER TABLE `lien_hes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mau_sac`
--
ALTER TABLE `mau_sac`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quan_li_tin_tuc`
--
ALTER TABLE `quan_li_tin_tuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_danhMuc_sanPham` (`danh_muc_id`),
  ADD KEY `fk_trang_thai_san_pham` (`trang_thai`);

--
-- Indexes for table `san_pham_chi_tiet`
--
ALTER TABLE `san_pham_chi_tiet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_san_pham_chi_tiet_san_pham` (`san_pham_id`),
  ADD KEY `fk_san_pham_chi_tiet_mau_sac` (`mau_sac_id`),
  ADD KEY `fk_san_pham_chi_tiet_kich_thuoc` (`kich_thuoc_id`);

--
-- Indexes for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_chucVu_taiKhoan` (`chuc_vu_id`);

--
-- Indexes for table `trang_thais`
--
ALTER TABLE `trang_thais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tt_don_hangs`
--
ALTER TABLE `tt_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `khuyen_mais`
--
ALTER TABLE `khuyen_mais`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kich_thuoc`
--
ALTER TABLE `kich_thuoc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lien_hes`
--
ALTER TABLE `lien_hes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mau_sac`
--
ALTER TABLE `mau_sac`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quan_li_tin_tuc`
--
ALTER TABLE `quan_li_tin_tuc`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `san_pham_chi_tiet`
--
ALTER TABLE `san_pham_chi_tiet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `trang_thais`
--
ALTER TABLE `trang_thais`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD CONSTRAINT `chi_tiet_gio_hangs_ibfk_1` FOREIGN KEY (`gio_hang_id`) REFERENCES `gio_hangs` (`id`),
  ADD CONSTRAINT `chi_tiet_gio_hangs_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);

--
-- Constraints for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `fk_tai_khoan` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_trang_thai` FOREIGN KEY (`trang_thai_id`) REFERENCES `tt_don_hangs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD CONSTRAINT `fk_gio_hang` FOREIGN KEY (`nguoi_dung_id`) REFERENCES `tai_khoans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD CONSTRAINT `fk` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `fk_danhMuc_sanPham` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_mucs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_trang_thai_san_pham` FOREIGN KEY (`trang_thai`) REFERENCES `trang_thais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `san_pham_chi_tiet`
--
ALTER TABLE `san_pham_chi_tiet`
  ADD CONSTRAINT `fk_san_pham_chi_tiet_kich_thuoc` FOREIGN KEY (`kich_thuoc_id`) REFERENCES `kich_thuoc` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_san_pham_chi_tiet_mau_sac` FOREIGN KEY (`mau_sac_id`) REFERENCES `mau_sac` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_san_pham_chi_tiet_san_pham` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD CONSTRAINT `fk_chucVu_taiKhoan` FOREIGN KEY (`chuc_vu_id`) REFERENCES `chuc_vus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
