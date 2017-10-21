-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2017 lúc 06:43 SA
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cilearn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `address`, `name`, `email`, `phone`, `password`, `level`) VALUES
(17, 'bonnguyen01', 'Quảng Điền 123', 'Nguyễn Tấn Thoại', 'bng22061996@gmail.com', '01263673379', '25f9e794323b453885f5181f1b624d0b', 0),
(18, 'dangki01', 'HUE HUE', 'bon nguyen', 'dangki01@gmail.com', '01263673379', '25f9e794323b453885f5181f1b624d0b', 1),
(19, 'admin1', 'Huế 123456', 'Nguyễn Tấn Thoại', 'bng220@gmail.com', '01263673379', '25f9e794323b453885f5181f1b624d0b', 1),
(27, 'bonnguyen1', 'Huế 123', 'Nguyễn Tấn Thoại', 'bng2210615996@gmail.com', '1263673379', '7aa8be5a55b8d60bba58c21cb27db8aa', 1),
(28, 'bonnguyen2', '', '', 'bng22061dd996@gmail.com', '', '25f9e794323b453885f5181f1b624d0b', 1),
(29, 'bonnguyen3', 'Huế 34234', 'Nguyễn Tấn Thoại', 'bn12g22061996@gmail.com', '01263673379', '25f9e794323b453885f5181f1b624d0b', 1),
(30, 'bonnguyen4', '', '', 'bng22061q996@gmail.com', '', '25f9e794323b453885f5181f1b624d0b', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
