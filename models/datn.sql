-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2024 lúc 10:41 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `datn`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`) VALUES
(1, 'Đống Đa'),
(2, 'Hoàn Kiếm'),
(3, 'Ba Đình'),
(4, 'Nam Từ Liêm'),
(5, 'Bắc Từ Liêm'),
(6, 'Long Biên'),
(7, 'Hai Bà Trưng'),
(8, 'Tây Hồ'),
(9, 'Cầu Giấy'),
(10, 'Hoàng Mai'),
(11, 'Thanh Xuân'),
(12, 'Hà Đông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `uuid` varchar(30) NOT NULL,
  `user_id` int(10) NOT NULL,
  `verification_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`uuid`, `user_id`, `verification_code`, `created_at`, `expires_at`) VALUES
('21bc08fc-c7a4-493f-9430-215ab5', 1, '$2y$10$STMwMSZG09GbLKsQVkO4O.sO1Ryp3ukkkOSBImrwdARNcwWDv0puy', '2024-11-15 09:55:04', '2024-11-15 09:56:04'),
('223e4567-e89b-12d3-a456-426614', 4, '188151', '2024-10-18 04:04:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`permission_id`, `role_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('sold','for_rent','available','hide') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`post_id`, `property_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'available', '2024-10-25 09:37:26', '2024-11-21 09:40:39'),
(2, 3, 3, 'available', '2024-10-25 09:37:26', '2024-11-21 09:40:39'),
(3, 41, 1, 'available', '2024-10-30 04:43:17', '2024-11-21 09:40:39'),
(4, 58, 1, 'sold', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(5, 20, 1, 'available', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(6, 21, 2, 'hide', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(7, 22, 3, 'available', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(8, 23, 4, 'available', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(9, 24, 1, 'available', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(10, 25, 2, 'available', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(11, 15, 3, 'available', '2024-10-30 04:43:58', '2024-11-21 09:40:39'),
(12, 90, 6, 'available', '2024-10-31 07:12:38', '2024-11-21 09:40:39'),
(13, 88, 4, 'available', '2024-10-31 08:09:02', '2024-11-21 09:40:39'),
(14, 91, 3, 'available', '2024-11-04 06:10:14', '2024-11-21 09:40:39'),
(15, 96, 1, 'available', '2024-11-08 18:02:55', '2024-11-21 09:40:39'),
(16, 34, 4, 'available', '2024-11-13 06:52:33', '2024-11-21 09:40:39'),
(17, 47, 2, 'available', '2024-11-13 06:53:41', '2024-11-21 09:40:39'),
(18, 97, 3, 'available', '2024-11-13 14:37:12', '2024-11-21 09:40:39'),
(19, 98, 3, 'available', '2024-11-13 15:09:04', '2024-11-21 09:40:39'),
(20, 99, 4, 'available', '2024-11-14 17:04:41', '2024-11-21 09:40:39'),
(21, 33, 6, 'available', '2024-11-20 18:54:23', '2024-11-21 09:40:39'),
(22, 55, 2, 'available', '2024-11-20 18:54:23', '2024-11-21 09:40:39'),
(23, 100, 6, 'available', '2024-11-20 19:17:46', '2024-11-21 09:40:39'),
(24, 16, 6, 'available', '2024-11-21 08:23:35', '2024-11-21 09:40:39'),
(25, 17, 4, 'available', '2024-11-21 08:23:35', '2024-11-21 09:40:39'),
(26, 18, 3, 'available', '2024-11-21 08:26:49', '2024-11-21 09:40:39'),
(27, 19, 2, 'available', '2024-11-21 08:26:49', '2024-11-21 09:40:39'),
(28, 42, 2, 'available', '2024-11-21 08:34:53', '2024-11-21 09:40:39'),
(29, 43, 2, 'available', '2024-11-21 08:34:53', '2024-11-21 09:40:39'),
(30, 44, 4, 'available', '2024-11-21 08:34:53', '2024-11-21 09:40:39'),
(31, 45, 1, 'available', '2024-11-21 08:34:53', '2024-11-21 09:40:39'),
(32, 28, 1, 'available', '2024-11-21 09:00:19', '2024-11-21 09:40:39'),
(33, 29, 6, 'available', '2024-11-21 09:00:19', '2024-11-21 09:40:39'),
(34, 30, 4, 'available', '2024-11-21 09:00:19', '2024-11-21 09:40:39'),
(35, 26, 1, 'available', '2024-11-21 09:10:49', '2024-11-21 09:40:39'),
(36, 27, 2, 'available', '2024-11-21 09:10:49', '2024-11-21 09:40:39'),
(37, 48, 1, 'available', '2024-11-21 09:13:53', '2024-11-21 09:40:39'),
(38, 49, 2, 'available', '2024-11-21 09:13:53', '2024-11-21 09:40:39'),
(39, 50, 6, 'available', '2024-11-21 09:13:53', '2024-11-21 09:40:39'),
(41, 51, 1, 'available', '2024-11-21 09:23:57', '2024-11-21 09:40:39'),
(42, 52, 2, 'available', '2024-11-21 09:23:57', '2024-11-21 09:40:39'),
(43, 53, 4, 'available', '2024-11-21 09:23:57', '2024-11-21 09:40:39'),
(44, 54, 6, 'available', '2024-11-21 09:23:57', '2024-11-21 09:40:39'),
(45, 59, 1, 'available', '2024-11-21 09:33:52', '2024-11-21 09:40:39'),
(46, 60, 2, 'available', '2024-11-21 09:33:52', '2024-11-21 09:40:39'),
(47, 61, 4, 'available', '2024-11-21 09:33:52', '2024-11-21 09:40:39'),
(48, 62, 6, 'available', '2024-11-21 09:33:52', '2024-11-21 09:40:39'),
(49, 63, 6, 'available', '2024-11-21 09:33:52', '2024-11-21 09:40:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_saves`
--

CREATE TABLE `post_saves` (
  `post_save_id` int(11) NOT NULL,
  `user_sid` int(11) NOT NULL,
  `post_sid` int(11) NOT NULL,
  `created_save_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post_saves`
--

INSERT INTO `post_saves` (`post_save_id`, `user_sid`, `post_sid`, `created_save_at`) VALUES
(1, 3, 7, '2024-11-14 17:00:10'),
(4, 1, 5, '2024-11-15 10:30:24'),
(5, 1, 16, '2024-11-15 10:37:01'),
(6, 1, 1, '2024-11-15 10:46:56'),
(7, 1, 3, '2024-11-15 17:05:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `properties`
--

CREATE TABLE `properties` (
  `property_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `area` decimal(10,1) NOT NULL,
  `price_per_m2` decimal(10,1) NOT NULL,
  `type` enum('home','apartment','land') NOT NULL,
  `ward_id` int(11) NOT NULL,
  `contact_info` text NOT NULL,
  `num_bedrooms` int(11) DEFAULT NULL,
  `num_bathrooms` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `properties`
--

INSERT INTO `properties` (`property_id`, `title`, `description`, `price`, `area`, `price_per_m2`, `type`, `ward_id`, `contact_info`, `num_bedrooms`, `num_bathrooms`) VALUES
(1, 'Chính chủ cần bán nhà phố Bạch Mai diện tích 50m2 sổ đỏ chính chủ', 'Căn nhà rộng gồm 2 phòng ngủ 2 phòng vệ sinh diện tích 50m2', 5000, 50.0, 100.0, 'home', 81, '0927513642', 2, 2),
(3, 'Chính chủ cần bán nhà phố Bạch Mai', 'Căn nhà rộng gồm 2 phòng ngủ 2 phòng vệ sinh diện tích 50m2', 5000, 50.0, 100.0, 'home', 81, '0927513642', 2, 2),
(15, 'Bán nhà khu vực Hai Bà Trưng phố Cầu Dền', 'Nhà mới xây, diện tích 45m2, gồm 3 phòng ngủ và 2 phòng tắm', 4500, 45.0, 100.0, 'home', 82, '0936123456', 3, 2),
(16, 'Chính chủ bán căn hộ tại Đống Mác, Hai Bà Trưng', 'Căn hộ chung cư cao cấp, diện tích 60m2 với 2 phòng ngủ và 2 phòng vệ sinh', 4750, 60.0, 79.2, 'apartment', 83, '0987654321', 2, 2),
(17, 'Bán nhà cấp 4 tại Khâm Thiên, Đống Đa', 'Nhà cấp 4 diện tích 35m2, có 1 phòng ngủ và 1 phòng tắm', 3000, 35.0, 86.0, 'home', 11, '0945234789', 1, 1),
(18, 'Chính chủ cần bán biệt thự Long Biên', 'Biệt thự rộng 200m2, 4 phòng ngủ và 3 phòng tắm, khu vực yên tĩnh', 10000, 155.0, 64.5, 'home', 134, '0912345678', 4, 3),
(19, 'Bán đất thổ cư tại Tây Hồ', 'Đất rộng 65m2, vị trí đắc địa, gần khu ngoại giao đoàn', 4000, 65.0, 61.5, 'land', 78, '0978561234', 0, 0),
(20, 'Chính chủ bán nhà riêng Ba Đình', 'Nhà 4 tầng diện tích 70m2 với 3 phòng ngủ và 3 phòng vệ sinh', 7000, 70.0, 100.0, 'home', 43, '0903456789', 3, 3),
(21, 'Bán căn hộ chung cư tại Hoàng Mai', 'Căn hộ chung cư diện tích 50m2, 2 phòng ngủ và 1 phòng vệ sinh', 3000, 50.0, 60.0, 'apartment', 100, '0919876543', 2, 1),
(22, 'Bán nhà mặt phố Láng Hạ', 'Nhà mặt phố rộng 70m2, vị trí đẹp, gồm 5 phòng ngủ và 4 phòng vệ sinh', 6000, 70.0, 85.7, 'home', 14, '0934123456', 3, 2),
(23, 'Bán đất khu đô thị Ciputra Long Biên', 'Đất khu đô thị diện tích 500m2, thích hợp xây biệt thự hoặc chung cư mini', 40000, 500.0, 80.0, 'land', 125, '0908765432', 0, 0),
(24, 'Đất phân lô dự án Vinhomes Cổ Loa rộng 70m2', 'Đất phân lô dự án Vinhomes Cổ Loa rộng 70m2 thuộc dự án của Vingroup đã có sổ đỏ chính chủ dự kiến bàn giao vào tháng 1/2025', 3200, 70.0, 45.7, 'land', 132, '0356879510', 0, 0),
(25, 'Bán chung cư view mặt hồ tại Tây Hồ', 'Diện tích rộng 70m2, vị trí đắc địa, thích hợp cho ai làm việc ở Tây Hồ', 7800, 70.0, 111.4, 'apartment', 74, '0978561234', 3, 2),
(26, 'Bán nhà phố Nghĩa Tân, quận Cầu Giấy khu có an ninh tốt', 'Căn nhà 3 phòng ngủ, 2 phòng vệ sinh diện tích 65m2', 6500, 65.0, 100.0, 'home', 5, '0927513642', 3, 2),
(27, 'Nhà bán gần cầu Nhật Tân Tây Hồ', 'Nhà có 3 phòng ngủ, sổ đỏ chính chủ', 3700, 50.0, 74.0, 'home', 72, '0927513643', 3, 2),
(28, 'Cần bán nhà phố Thụy Khuê', 'Nhà 3 phòng ngủ, 2 phòng vệ sinh, diện tích 45m2', 4150, 58.0, 71.6, 'home', 75, '0927513644', 3, 2),
(29, 'Chính chủ bán nhà ngõ 12 Dịch Vọng Hậu gần trường học bệnh viện', 'Nhà rộng 55m2, 3 phòng ngủ, 2 vệ sinh', 4000, 55.0, 72.7, 'home', 2, '0927513645', 3, 2),
(30, 'Nhà phố Phú Thượng Tây Hồ đã có sổ đỏ lâu dài', 'Căn nhà 65m2, 3 phòng ngủ, 2 vệ sinh', 4500, 65.0, 69.2, 'home', 73, '0927513646', 2, 2),
(31, 'Bán nhà phố Láng Thượng', 'Căn nhà 4 phòng ngủ, 3 phòng vệ sinh diện tích 60m2', 6000, 60.0, 100.0, 'home', 15, '0927513647', 4, 3),
(32, 'Đất dự án đã phân lô ở Hà Đông cần rao bán', 'Đã có đầy đủ giấy tờ pháp lí và có thể giấy phép xây dựng', 1500, 50.0, 30.0, 'land', 168, '0927513648', 0, 0),
(33, 'Cần bán nhà phố Lý Thái Tổ, quận Hoàn Kiếm', 'Nhà 4 phòng ngủ, diện tích 60m2', 6000, 60.0, 100.0, 'home', 65, '0927513649', 4, 3),
(34, 'Chính chủ bán nhà phố Láng Thượng', 'Căn nhà 60m2, 4 phòng ngủ, 3 vệ sinh', 6000, 60.0, 100.0, 'home', 15, '0927513650', 4, 3),
(35, 'Bán đất sau công viên Yên Sở thuận tiện đi lại ra bến xe, công viên', 'Đất đã có sổ đỏ chính chủ cần bán gấp cuối năm nay', 2000, 55.0, 36.4, 'land', 110, '0927513651', 2, 1),
(36, 'Bán căn góc tầng 10 tòa nhà K35 Tân Mai, quận Hoàng Mai', 'Căn nhà 3 phòng ngủ, 2 phòng vệ sinh diện tích 50m2', 4000, 50.0, 80.0, 'apartment', 104, '0927513652', 3, 2),
(37, 'Bán gấp chung cư ở Hoàng Văn Thụ đã có đầy đủ trang thiết bị hiện đại', 'Nhà 50m2, 3 phòng ngủ, sổ đỏ chính chủ', 3500, 50.0, 70.0, 'apartment', 101, '0927513653', 2, 1),
(38, 'Cần bán nhà phố Nam Đồng', 'Căn nhà rộng 50m2, 3 phòng ngủ', 5000, 50.0, 100.0, 'home', 16, '0927513654', 3, 2),
(39, 'Chính chủ bán nhà phố Nam Đồng', 'Nhà 50m2, 3 phòng ngủ, 2 vệ sinh', 5000, 50.0, 100.0, 'home', 16, '0927513655', 3, 2),
(40, 'Nhà phố Nam Đồng giá tốt', 'Căn nhà 50m2, 3 phòng ngủ, 2 vệ sinh', 5000, 50.0, 100.0, 'home', 16, '0927513656', 3, 2),
(41, 'Bán nhà phố Ngã Tư Sở', 'Căn nhà 4 phòng ngủ, 3 phòng vệ sinh diện tích 55m2', 5500, 55.0, 100.0, 'home', 17, '0927513657', 4, 3),
(42, 'Cần bán gấp nhà ngõ 113 Xuân La ngõ rộng ô tô tránh', 'Nhà rộng 55m2, 4 phòng ngủ, sổ đỏ chính chủ', 6000, 65.0, 92.3, 'home', 77, '0927513658', 3, 2),
(43, 'Cần bán chung cư Studio ở Bắc Từ Liêm dùng để quay chụp hoặc ở', 'Căn nhà rộng 55m2, 4 phòng ngủ', 3000, 50.0, 60.0, 'apartment', 141, '0927513659', 1, 1),
(44, 'Chính chủ bán nhà cách 200m ra mặt đường Bưởi', 'Nhà 55m2, 2 phòng ngủ, 2 vệ sinh', 5500, 55.0, 100.0, 'home', 71, '0927513660', 2, 2),
(45, 'Nhà trong ngõ 69 Tứ Liên Tây Hồ cần bán đã có sổ đỏ ', 'Căn nhà 55m2, 4 phòng ngủ, 3 vệ sinh', 5800, 70.0, 82.9, 'home', 76, '0927513661', 3, 2),
(46, 'Bán nhà phố Ô Chợ Dừa', 'Căn nhà 5 phòng ngủ, 4 phòng vệ sinh diện tích 65m2', 6500, 65.0, 100.0, 'home', 18, '0927513662', 5, 4),
(47, 'Nhà Ô Chợ Dừa cần bán', 'Nhà rộng 65m2, 5 phòng ngủ, sổ đỏ chính chủ', 6500, 65.0, 100.0, 'home', 18, '0927513663', 5, 4),
(48, 'Cần bán nhà khu Thanh Trì, Hoàng Mai', 'Căn nhà rộng 65m2, 2 phòng ngủ', 4000, 65.0, 61.5, 'home', 105, '0927513664', 2, 2),
(49, 'Chung cư phố Hàng Bông đang cần bán ', 'Nhà 65m2, 2 phòng ngủ, 2 vệ sinh', 7600, 65.0, 116.9, 'apartment', 59, '0927513665', 2, 2),
(50, 'Bán nhà tại Việt Hưng Long Biên có thiện chí thì giảm thêm', 'Căn nhà 55m2 có sổ đỏ chính chủ thủ tục nhanh gọn', 2500, 55.0, 45.5, 'home', 135, '0927513666', 2, 1),
(51, 'Bán nhà phố tại Cự Khối, Long Biên', 'Nhà đẹp, gần chợ, tiện nghi đầy đủ', 4000, 60.0, 66.7, 'home', 123, '0912345678', 2, 1),
(52, 'Chính chủ cần bán nhà tại hàng Bạc, Hoàn Kiếm', 'Nhà 3 tầng, 65m2, sổ đỏ chính chủ', 7000, 65.0, 107.7, 'apartment', 56, '0912345679', 2, 2),
(53, 'Cần bán gấp nhà tại ngõ 68 Quan Hoa, Cầu Giấy, Hà Nội', 'Nhà có 3 phòng ngủ, diện tích lớn', 4700, 60.0, 78.3, 'home', 6, '0912345680', 3, 2),
(54, 'Nhà đẹp cần bán tại Cầu Giấy', 'Gần trường học, tiện lợi', 4200, 56.0, 75.0, 'home', 7, '0912345681', 2, 1),
(55, 'Bán nhà phố tại Phường Liên', 'Căn nhà 2 phòng ngủ, rộng rãi', 5500, 55.0, 100.0, 'home', 19, '0912345682', 2, 2),
(56, 'Bán nhà phố tại Phường Mai', 'Nhà đẹp 2 phòng ngủ', 7000, 70.0, 100.0, 'home', 20, '0912345683', 2, 2),
(57, 'Chính chủ cần bán nhà tại Phường Mai', 'Nhà 3 tầng, 60m2, sổ đỏ chính chủ', 6000, 60.0, 100.0, 'home', 20, '0912345684', 3, 2),
(58, 'Cần bán gấp nhà tại Quang Trung, Đống Đa đầy đủ nội thất', 'Nhà 2 phòng ngủ, tiện nghi', 4300, 50.0, 86.0, 'home', 21, '0912345685', 2, 1),
(59, 'Nhà đẹp cần bán tại hàng Mã gần phố cổ', 'Gần công viên, không khí trong lành', 7000, 55.0, 127.3, 'home', 63, '0912345686', 2, 2),
(60, 'Bán nhà trên phố gần chợ Đồng Xuân', 'Căn nhà 3 phòng ngủ, rộng rãi', 8000, 65.0, 123.1, 'home', 55, '0912345687', 3, 2),
(61, 'Rao bán nhà ở Chương Dương Hoàn Kiếm', 'Nhà đẹp 2 phòng ngủ, tiện nghi đầy đủ', 4350, 58.0, 75.0, 'home', 53, '0912345688', 2, 2),
(62, 'Chính chủ cần bán nhà gần chợ đồ cũ Vạn Phúc, Hà Đông', 'Nhà 3 tầng, 70m2, sổ đỏ chính chủ', 5300, 70.0, 75.7, 'home', 172, '0912345689', 3, 2),
(63, 'Cần bán gấp chung cư gần trăm tỷ đi hai bước chân là ra mặt hồ Gươm', 'Nhà 3 phòng ngủ, thoáng mát', 65000, 100.0, 650.0, 'apartment', 69, '0912345690', 3, 2),
(64, 'Nhà đẹp cần bán tại Phường Quang Trung', 'Gần trung tâm thương mại', 9000, 90.0, 100.0, 'home', 21, '0912345691', 3, 3),
(65, 'Bán nhà phố tại Phường Quang Trung', 'Căn nhà 2 phòng ngủ, tiện nghi', 6000, 60.0, 100.0, 'home', 21, '0912345692', 2, 2),
(66, 'Bán nhà phố tại Phường Quốc Tử Giám', 'Nhà đẹp 3 phòng ngủ, thoáng mát', 8500, 85.0, 100.0, 'home', 22, '0912345693', 3, 2),
(67, 'Chính chủ cần bán nhà tại Phường Quốc Tử Giám', 'Nhà 4 tầng, 90m2, sổ đỏ chính chủ', 9000, 90.0, 100.0, 'home', 22, '0912345694', 4, 3),
(68, 'Cần bán gấp nhà tại Phường Quốc Tử Giám', 'Nhà 2 phòng ngủ, tiện nghi đầy đủ', 7500, 75.0, 100.0, 'home', 22, '0912345695', 2, 2),
(69, 'Nhà đẹp cần bán tại Phường Quốc Tử Giám', 'Gần trường học, an ninh tốt', 8000, 80.0, 100.0, 'home', 22, '0912345696', 3, 2),
(70, 'Bán nhà phố tại Phường Quốc Tử Giám', 'Căn nhà 3 phòng ngủ, thoáng mát', 9500, 95.0, 100.0, 'home', 22, '0912345697', 3, 3),
(71, 'Bán nhà phố tại Phường Thịnh Quang', 'Nhà đẹp 2 phòng ngủ, tiện nghi', 5000, 50.0, 100.0, 'home', 23, '0912345698', 2, 1),
(72, 'Chính chủ cần bán nhà tại Phường Thịnh Quang', 'Nhà 3 tầng, 60m2, sổ đỏ chính chủ', 6000, 60.0, 100.0, 'home', 23, '0912345699', 3, 2),
(73, 'Cần bán gấp nhà tại Phường Thịnh Quang', 'Nhà 2 phòng ngủ, gần chợ', 5500, 55.0, 100.0, 'home', 23, '0912345700', 2, 1),
(74, 'Nhà đẹp cần bán tại Phường Thịnh Quang', 'Gần công viên, không khí trong lành', 6500, 65.0, 100.0, 'home', 23, '0912345701', 2, 2),
(75, 'Bán nhà phố tại Phường Thịnh Quang', 'Căn nhà 4 phòng ngủ, rộng rãi', 8000, 80.0, 100.0, 'home', 23, '0912345702', 4, 3),
(76, 'Bán nhà cấp 4 tại Khâm Thiên, Đống Đa', 'Nhà cấp 4 diện tích 35m2, có 1 phòng ngủ và 1 phòng tắm', 3000, 35.0, 86.0, 'home', 54, '0945234789', 1, 1),
(77, 'Bán nhà cấp 4 tại Khâm Thiên, Đống Đa', 'Nhà cấp 4 diện tích 35m2, có 1 phòng ngủ và 1 phòng tắm', 3000, 35.0, 86.0, 'home', 44, '0945234789', 1, 1),
(78, 'Bán nhà cấp 4 tại Khâm Thiên, Đống Đa', 'Nhà cấp 4 diện tích 35m2, có 1 phòng ngủ và 1 phòng tắm', 3000, 35.0, 86.0, 'home', 152, '0945234789', 1, 1),
(79, 'Bán nhà cấp 4 tại Khâm Thiên, Đống Đa', 'Nhà cấp 4 diện tích 35m2, có 1 phòng ngủ và 1 phòng tắm', 3000, 35.0, 86.0, 'home', 138, '0945234789', 1, 1),
(80, 'Chính chủ cần bán nhà phố Bạch Mai diện tích 50m2 sổ đỏ chính chủ', 'Căn nhà rộng gồm 2 phòng ngủ 2 phòng vệ sinh diện tích 50m2', 6250, 50.0, 125.0, 'home', 166, '0927513642', 2, 2),
(81, 'Chính chủ cần bán nhà phố Bạch Mai diện tích 50m2 sổ đỏ chính chủ', 'Căn nhà rộng gồm 2 phòng ngủ 2 phòng vệ sinh diện tích 50m2', 9672, 70.5, 137.2, 'home', 37, '0927513642', 2, 2),
(82, 'Chính chủ cần bán nhà phố Bạch Mai diện tích 50m2 sổ đỏ chính chủ', 'Căn nhà rộng gồm 2 phòng ngủ 2 phòng vệ sinh diện tích 50m2', 5000, 50.0, 100.0, 'home', 97, '0927513642', 2, 2),
(83, 'Chính chủ cần bán nhà phố Bạch Mai diện tích 50m2 sổ đỏ chính chủ', 'Căn nhà rộng gồm 2 phòng ngủ 2 phòng vệ sinh diện tích 50m2', 6840, 45.0, 152.0, 'home', 1, '0927513642', 2, 2),
(88, 'Bán nhà khu vực Hạ Đình, nhà trong ngõ cách mặt đường 50m', 'Bán nhà khu vực Hạ Đình, nhà trong ngõ cách mặt đường 50m, ngõ ô tô tránh', 4600, 50.0, 92.0, 'home', 120, '0985741211', 2, 1),
(89, 'Bán nhà tập thể tại khu tập thể Kim Liên rộng 50m2', 'Bán nhà tập thể tại khu tập thể Kim Liên rộng 50m2, có sân chơi dưới khu tập thể, ở tầng thấp. Nhà có 2 phòng ngủ và 1 phòng vệ sinh', 3500, 50.0, 70.0, 'home', 13, '0957642512', 2, 1),
(90, 'Nhà siêu đẹp chỉ hơn 6 tỉ khu vực Thanh Xuân, phường Nhân Chính', 'Nhà siêu đẹp chỉ hơn 6 tỉ khu vực Thanh Xuân', 6400, 50.0, 128.0, 'home', 34, '0961321667', 2, 2),
(91, 'Chính chủ cần bán căn S102 ở Vinhome Smart City', 'Chính chủ cần bán căn S102 ở Vinhome Smart City gồm 2 phòng ngủ, 1 phòng vệ sinh chào bán 3,5 tỉ có thương lượng', 3500, 55.0, 63.6, 'apartment', 156, '0377546320', 2, 1),
(92, 'Bán nhà trong ngõ thuộc phường Mĩ Đình 2', 'Bán nhà trong ngõ thuộc phường Mĩ Đình 2, mặt tiền 3 m, diện tích sử dụng 65 m2, cần bán gấp do chuyển về quê ở', 7700, 65.0, 118.5, 'home', 153, '0924751324', 2, 2),
(96, 'Bán nhà trong ngõ ở phường Mỹ Đình 3, liên hệ 0357811244', 'Bán nhà trong ngõ ở phường Mỹ Đình 3, liên hệ 0357811244, mặt tiền rộng 4 mét ô tô đỗ trước ngõ', 7700, 65.0, 118.5, 'home', 153, '0357811244', 2, 2),
(97, 'Bán căn chung cư ở tòa R2 Royal City', 'Bán căn chung cư ở tòa R2 Royal City', 6000, 65.0, 92.3, 'apartment', 36, '0321985322', 2, 2),
(98, 'Bán đất đã cấp sổ đỏ khu vực Kiều Mai, Phú Diễn', 'Bán đất đã cấp sổ đỏ khu vực Kiều Mai, Phú Diễn', 1200, 50.0, 24.0, 'land', 142, '0975642103', 0, 0),
(99, 'Cần mua nhà mặt tiền 4m để kinh doanh phố Hàng Đào', 'Cần mua nhà mặt tiền 4m để kinh doanh phố Hàng Đào', 8000, 50.0, 160.0, 'home', 61, '0238951203', 2, 2),
(100, 'Bán nhà trong ngõ 68 Phùng Khoang gần trường Bưu Chính, Y Dược cổ truyền', 'Bán nhà trong ngõ 68 Phùng Khoang gần trường Bưu Chính, Y Dược cổ truyền nhà 4 tầng khóa vân tay có sẵn đồ chỉ việc dọn vào ở', 4650, 60.0, 77.5, 'home', 173, '0357951642', 2, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property_images`
--

CREATE TABLE `property_images` (
  `image_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `public_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `property_images`
--

INSERT INTO `property_images` (`image_id`, `property_id`, `image_url`, `public_id`) VALUES
(1, 1, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152432/cld-sample-2.jpg', 'cld-sample-2'),
(2, 3, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152432/cld-sample-2.jpg', 'cld-sample-2'),
(5, 15, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152431/samples/coffee.jpg', 'samples/coffee'),
(6, 16, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731084757/qwizhfozclpn233zyacd.jpg', 'qwizhfozclpn233zyacd'),
(7, 17, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152423/samples/people/jazz.jpg', 'samples/people/jazz'),
(8, 18, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152432/cld-sample-3.jpg', 'cld-sample-3'),
(9, 19, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152432/cld-sample-4.jpg', 'cld-sample-4'),
(10, 20, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152432/cld-sample-5.jpg', 'cld-sample-5'),
(12, 22, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152424/samples/ecommerce/leather-bag-gray.jpg', 'samples/ecommerce/leather-bag-gray'),
(13, 23, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730700647/sgxrer3w6shabbjuhrfz.jpg', 'sgxrer3w6shabbjuhrfz'),
(15, 24, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732100782/eaku9eyj7rqoslu6vwui.jpg', 'eaku9eyj7rqoslu6vwui'),
(16, 25, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732100786/tj8ydjzzh8fsq7q1ixaj.jpg', 'tj8ydjzzh8fsq7q1ixaj'),
(31, 89, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730357156/jirezxagevhlxjilunb3.jpg', 'jirezxagevhlxjilunb3'),
(32, 89, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730791093/pi22gqnh8wvs0lhzj3ok.jpg', 'pi22gqnh8wvs0lhzj3ok'),
(38, 91, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730700636/ijcca4ucwh6giaqootsa.jpg', 'ijcca4ucwh6giaqootsa'),
(39, 91, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730700647/sgxrer3w6shabbjuhrfz.jpg', 'sgxrer3w6shabbjuhrfz'),
(40, 91, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730700653/acx6ovwlrti7fctykwgf.jpg', 'acx6ovwlrti7fctykwgf'),
(70, 90, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730791080/qcsr4eit0rrcldotfcr9.jpg', 'qcsr4eit0rrcldotfcr9'),
(71, 90, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1730791087/rxiomewyujxgql6zxtfo.jpg', 'rxiomewyujxgql6zxtfo'),
(72, 90, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152424/samples/ecommerce/accessories-bag.jpg', 'samples/ecommerce/accessories-bag'),
(78, 96, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731131052/etyx8bkqvkaihhcixthe.jpg', 'etyx8bkqvkaihhcixthe'),
(79, 96, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731131056/skm4ktirwr7nb1q3bag1.jpg', 'skm4ktirwr7nb1q3bag1'),
(80, 96, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731131059/njnxn8ya4yxfj8vb4rxp.jpg', 'njnxn8ya4yxfj8vb4rxp'),
(83, 58, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731311621/mqr8nqvvkq6h7qvlemnw.jpg', 'mqr8nqvvkq6h7qvlemnw'),
(84, 58, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731311627/eaoki86uw0ri6qsvhgxh.jpg', 'eaoki86uw0ri6qsvhgxh'),
(87, 41, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152425/samples/landscapes/nature-mountains.jpg', 'samples/landscapes/nature-mountains'),
(88, 34, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152423/samples/sheep.jpg', 'samples/sheep'),
(89, 47, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1726152424/samples/landscapes/architecture-signs.jpg', 'samples/landscapes/architecture-signs'),
(90, 97, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731508644/tm9mbp1ajry6voond42w.jpg', 'tm9mbp1ajry6voond42w'),
(91, 98, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731510549/emhvjffhqrokcfowjhw8.jpg', 'emhvjffhqrokcfowjhw8'),
(92, 88, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731599283/eddfbaepgqzwhhfhtw4y.jpg', 'eddfbaepgqzwhhfhtw4y'),
(93, 99, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731603889/whb6gqpqd4jhiief5wff.jpg', 'whb6gqpqd4jhiief5wff'),
(94, 33, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732102009/rkvmgf85kbznwezjkbo0.jpg', 'rkvmgf85kbznwezjkbo0'),
(95, 55, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732100096/zpnhvyr1jboqf10jynre.jpg', 'zpnhvyr1jboqf10jynre'),
(96, 100, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732130279/qj0xiapb3s0gin46spe4.jpg', 'qj0xiapb3s0gin46spe4'),
(97, 100, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732130285/cq3ucweucqakflnqivnb.jpg', 'cq3ucweucqakflnqivnb'),
(98, 36, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732176705/yfl14semzamwzorefsho.jpg', 'yfl14semzamwzorefsho'),
(99, 36, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732176724/xsi9icwjwqqkjqnqaf5i.jpg', 'xsi9icwjwqqkjqnqaf5i'),
(100, 35, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732176901/zfsc5xdv94wsje7vbcmk.jpg', 'zfsc5xdv94wsje7vbcmk'),
(101, 35, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732176907/pppzgarlw8kaqb7wczyc.jpg', 'pppzgarlw8kaqb7wczyc'),
(102, 37, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732177113/xh9pjybdl88w07cbee5s.jpg', 'xh9pjybdl88w07cbee5s'),
(103, 37, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732177117/dahcmwnsuzfiij7qocow.jpg', 'dahcmwnsuzfiij7qocow'),
(104, 32, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732177252/la8jrzrrkizz5ziagex7.jpg', 'la8jrzrrkizz5ziagex7'),
(105, 42, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732178193/ezloo8hkffb92chfum2m.jpg', 'ezloo8hkffb92chfum2m'),
(106, 43, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732178292/hs2zt3dkys6n8ghhecmu.jpg', 'hs2zt3dkys6n8ghhecmu'),
(107, 44, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732178388/qz8c0xfox9r4t9kfvvti.jpg', 'qz8c0xfox9r4t9kfvvti'),
(108, 45, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732178496/utuu4zufrhduropveote.jpg', 'utuu4zufrhduropveote'),
(109, 21, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732179324/mnuvtvybjfzwolfw5vcf.jpg', 'mnuvtvybjfzwolfw5vcf'),
(110, 27, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732179711/lw6svadumrvbqmexcb2w.jpg', 'lw6svadumrvbqmexcb2w'),
(111, 28, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732179769/rjqgqitjagwqx73rdtan.jpg', 'rjqgqitjagwqx73rdtan'),
(112, 30, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732179939/mgzd47rykjxmys6zrqi5.jpg', 'mgzd47rykjxmys6zrqi5'),
(113, 29, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732180109/wyf0vd178dx4vgqyuhd5.jpg', 'wyf0vd178dx4vgqyuhd5'),
(114, 26, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732180334/qzlcw9esi28a5dfx6aeg.jpg', 'qzlcw9esi28a5dfx6aeg'),
(115, 48, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732180546/oi5jpwcy2u6bw50h3445.jpg', 'oi5jpwcy2u6bw50h3445'),
(116, 49, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732180627/mn466anqnhfudtposwwo.jpg', 'mn466anqnhfudtposwwo'),
(117, 50, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732180732/x6yhpwkg9c0dioojuwkx.jpg', 'x6yhpwkg9c0dioojuwkx'),
(118, 51, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181083/abnrldyoy0oe6n1cnkny.jpg', 'abnrldyoy0oe6n1cnkny'),
(119, 52, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181220/ykgfbayenv43qu6qto1t.jpg', 'ykgfbayenv43qu6qto1t'),
(120, 53, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181336/qz2kknwxeylw0hvmqbyj.jpg', 'qz2kknwxeylw0hvmqbyj'),
(121, 54, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181383/wmnnpquvcmochhhfo28c.jpg', 'wmnnpquvcmochhhfo28c'),
(122, 59, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181728/t9kvmqzaergj9amqu0wk.jpg', 't9kvmqzaergj9amqu0wk'),
(123, 60, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181801/umykzup1tc5yloluepdj.jpg', 'umykzup1tc5yloluepdj'),
(124, 61, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181883/feluhaw3itri3mhjaeux.jpg', 'feluhaw3itri3mhjaeux'),
(125, 63, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732181964/ox34wl3ln662rwcaojgw.jpg', 'ox34wl3ln662rwcaojgw'),
(126, 62, 'https://res.cloudinary.com/djdf56dfq/image/upload/v1732182047/tueyp8cqao7lcjplinsk.jpg', 'tueyp8cqao7lcjplinsk');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'user'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_user_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `citizen_id` varchar(12) DEFAULT NULL,
  `method` enum('google','local') NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `public_id` varchar(100) DEFAULT NULL,
  `introduce` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `password`, `created_user_at`, `citizen_id`, `method`, `avatar`, `public_id`, `introduce`) VALUES
(1, 'Tăng Xuân Chiến', 'tangxuanchien511@gmail.com', '0911275613', '$2y$10$QAtIImMO9gdk2Y9o42mAweglNfGYD/Ma4c/RRrfgq5yqrD8QRSwES', '2024-09-08 16:07:37', '015320404567', 'local', 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731399478/vvsg5a6d2opw6xl81hgq.jpg', 'vvsg5a6d2opw6xl81hgq', ''),
(2, 'Trần Mạnh Tuấn', 'tuantran@gmail.com', '0911275613', '$2y$10$gOGo9IVtb0kJEStAHcxzNuoyq04fJ/4ZDwexZcNMpm1HwChGYxATC', '2024-09-08 16:08:56', '015203008503', 'local', 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731399272/bqrwgsisgvasxeojgjhc.jpg', 'bqrwgsisgvasxeojgjhc', ''),
(3, 'Trần Minh Chiến', 'tangxuanchien511@gmail.com', '0273765210', '', '2024-10-01 09:32:16', '10000242405', 'google', 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731479263/tnxxwrzpyk3pdab52b6h.jpg', 'tnxxwrzpyk3pdab52b6h', 'Tôi đang làm trong lĩnh vực bất động sản khu vực Long Biên'),
(4, 'HIEUTHUHAI', 'chien0181966@huce.edu.vn', '0967842511', NULL, '2024-10-15 06:49:11', '019684003214', 'google', 'https://lh3.googleusercontent.com/a/ACg8ocK8pqdiX-BAa3i6kVXViz8_n_ftZNWvQCf6JuXEQniNX0Z4Tg=s96-c', NULL, ''),
(6, 'Lê Ngọc Anh', 'lengocanh@gmail.com', '0973206868', '$2y$10$7LYnYF7OmW4x1CluJE4uCezQ.cB8ZAU3tg9uYC56eeJZQyivus42C', '2024-11-14 07:50:53', '015203003695', 'local', 'https://res.cloudinary.com/djdf56dfq/image/upload/v1731571944/z2s8ymcbmk8lopqawsbo.png', 'z2s8ymcbmk8lopqawsbo', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wards`
--

CREATE TABLE `wards` (
  `ward_id` int(11) NOT NULL,
  `ward_name` varchar(20) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `wards`
--

INSERT INTO `wards` (`ward_id`, `ward_name`, `district_id`) VALUES
(1, 'Dịch Vọng', 9),
(2, 'Dịch Vọng Hậu', 9),
(3, 'Mai Dịch', 9),
(4, 'Nghĩa Đô', 9),
(5, 'Nghĩa Tân', 9),
(6, 'Quan Hoa', 9),
(7, 'Trung Hòa', 9),
(8, 'Yên Hòa', 9),
(9, 'Cát Linh', 1),
(10, 'Hàng Bột', 1),
(11, 'Khâm Thiên', 1),
(12, 'Khương Thượng', 1),
(13, 'Kim Liên', 1),
(14, 'Láng Hạ', 1),
(15, 'Láng Thượng', 1),
(16, 'Nam Đồng', 1),
(17, 'Ngã Tư Sở', 1),
(18, 'Ô Chợ Dừa', 1),
(19, 'Phương Liên', 1),
(20, 'Phương Mai', 1),
(21, 'Quang Trung', 1),
(22, 'Quốc Tử Giám', 1),
(23, 'Thịnh Quang', 1),
(24, 'Thổ Quan', 1),
(25, 'Trung Liệt', 1),
(26, 'Trung Phụng', 1),
(27, 'Trung Tự', 1),
(28, 'Văn Chương', 1),
(29, 'Văn Miếu', 1),
(30, 'Khương Đình', 11),
(31, 'Khương Mai', 11),
(32, 'Khương Trung', 11),
(33, 'Kim Giang', 11),
(34, 'Nhân Chính', 11),
(35, 'Phương Liệt', 11),
(36, 'Thanh Xuân Bắc', 11),
(37, 'Thanh Xuân Nam', 11),
(38, 'Thanh Xuân Trung', 11),
(39, 'Cống Vị', 3),
(40, 'Điện Biên', 3),
(41, 'Đội Cấn', 3),
(42, 'Giảng Võ', 3),
(43, 'Kim Mã', 3),
(44, 'Liễu Giai', 3),
(45, 'Ngọc Hà', 3),
(46, 'Ngọc Khánh', 3),
(47, 'Nguyễn Trung Trực', 3),
(48, 'Phúc Xá', 3),
(49, 'Quán Thánh', 3),
(50, 'Thành Công', 3),
(51, 'Trúc Bạch', 3),
(52, 'Vĩnh Phúc', 3),
(53, 'Chương Dương', 2),
(54, 'Cửa Nam', 2),
(55, 'Đồng Xuân', 2),
(56, 'Hàng Bạc', 2),
(57, 'Hàng Bài', 2),
(58, 'Hàng Bồ', 2),
(59, 'Hàng Bông', 2),
(60, 'Hàng Buồm', 2),
(61, 'Hàng Đào', 2),
(62, 'Hàng Gai', 2),
(63, 'Hàng Mã', 2),
(64, 'Hàng Trống', 2),
(65, 'Lý Thái Tổ', 2),
(66, 'Phan Chu Trinh', 2),
(67, 'Phúc Tân', 2),
(68, 'Trần Hưng Đạo', 2),
(69, 'Tràng Tiền', 2),
(70, 'Cửa Đông', 2),
(71, 'Bưởi', 8),
(72, 'Nhật Tân', 8),
(73, 'Phú Thượng', 8),
(74, 'Quảng An', 8),
(75, 'Thụy Khuê', 8),
(76, 'Tứ Liên', 8),
(77, 'Xuân La', 8),
(78, 'Yên Phụ', 8),
(79, 'Bách Khoa', 7),
(80, 'Bạch Đằng', 7),
(81, 'Bạch Mai', 7),
(82, 'Cầu Dền', 7),
(83, 'Đống Mác', 7),
(84, 'Đồng Nhân', 7),
(85, 'Đồng Tâm', 7),
(86, 'Lê Đại Hành', 7),
(87, 'Minh Khai', 7),
(88, 'Nguyễn Du', 7),
(89, 'Phạm Đình Hổ', 7),
(90, 'Phố Huế', 7),
(91, 'Quỳnh Lôi', 7),
(92, 'Quỳnh Mai', 7),
(93, 'Thanh Lương', 7),
(94, 'Thanh Nhàn', 7),
(95, 'Trương Định', 7),
(96, 'Vĩnh Tuy', 7),
(97, 'Đại Kim', 10),
(98, 'Định Công', 10),
(99, 'Giáp Bát', 10),
(100, 'Hoàng Liệt', 10),
(101, 'Hoàng Văn Thụ', 10),
(102, 'Lĩnh Nam', 10),
(103, 'Mai Động', 10),
(104, 'Tân Mai', 10),
(105, 'Thanh Trì', 10),
(106, 'Thịnh Liệt', 10),
(107, 'Trần Phú', 10),
(108, 'Tương Mai', 10),
(109, 'Vĩnh Hưng', 10),
(110, 'Yên Sở', 10),
(120, 'Hạ Đình', 11),
(121, 'Thượng Đình', 11),
(122, 'Bồ Đề', 6),
(123, 'Cự Khối', 6),
(124, 'Đức Giang', 6),
(125, 'Gia Thụy', 6),
(126, 'Giang Biên', 6),
(127, 'Long Biên', 6),
(128, 'Ngọc Lâm', 6),
(129, 'Ngọc Thụy', 6),
(130, 'Phúc Đồng', 6),
(131, 'Phúc Lợi', 6),
(132, 'Sài Đồng', 6),
(133, 'Thạch Bàn', 6),
(134, 'Thượng Thanh', 6),
(135, 'Việt Hưng', 6),
(136, 'Cổ Nhuế 1', 5),
(137, 'Cổ Nhuế 2', 5),
(138, 'Đông Ngạc', 5),
(139, 'Đức Thắng', 5),
(140, 'Liên Mạc', 5),
(141, 'Minh Khai', 5),
(142, 'Phú Diễn', 5),
(143, 'Phúc Diễn', 5),
(144, 'Tây Tựu', 5),
(145, 'Thượng Cát', 5),
(146, 'Thụy Phương', 5),
(147, 'Xuân Đỉnh', 5),
(148, 'Xuân Tảo', 5),
(149, 'Cầu Diễn', 4),
(150, 'Đại Mỗ', 4),
(151, 'Mễ Trì', 4),
(152, 'Mỹ Đình 1', 4),
(153, 'Mỹ Đình 2', 4),
(154, 'Phú Đô', 4),
(155, 'Phương Canh', 4),
(156, 'Tây Mỗ', 4),
(157, 'Trung Văn', 4),
(158, 'Xuân Phương', 4),
(159, 'Biên Giang', 12),
(160, 'Đồng Mai', 12),
(161, 'Dương Nội', 12),
(162, 'Hà Cầu', 12),
(163, 'Kiến Hưng', 12),
(164, 'La Khê', 12),
(165, 'Mộ Lao', 12),
(166, 'Nguyễn Trãi', 12),
(167, 'Phú La', 12),
(168, 'Phú Lãm', 12),
(169, 'Phú Lương', 12),
(170, 'Phúc La', 12),
(171, 'Quang Trung', 12),
(172, 'Vạn Phúc', 12),
(173, 'Văn Quán', 12),
(174, 'Yên Nghĩa', 12),
(175, 'Yết Kiêu', 12);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`uuid`),
  ADD KEY `fk_id` (`user_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `permissions_FK` (`role_id`),
  ADD KEY `permissions_FK_2` (`user_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK` (`user_id`),
  ADD KEY `FK1` (`property_id`);

--
-- Chỉ mục cho bảng `post_saves`
--
ALTER TABLE `post_saves`
  ADD PRIMARY KEY (`post_save_id`),
  ADD KEY `post_id` (`post_sid`),
  ADD KEY `user_id` (`user_sid`);

--
-- Chỉ mục cho bảng `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `fk_foreign_key_name1` (`ward_id`);

--
-- Chỉ mục cho bảng `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `FK2` (`property_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Chỉ mục cho bảng `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`ward_id`),
  ADD KEY `wards_FK` (`district_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `post_saves`
--
ALTER TABLE `post_saves`
  MODIFY `post_save_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `properties`
--
ALTER TABLE `properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `property_images`
--
ALTER TABLE `property_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `wards`
--
ALTER TABLE `wards`
  MODIFY `ward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_FK` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `permissions_FK_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`);

--
-- Các ràng buộc cho bảng `post_saves`
--
ALTER TABLE `post_saves`
  ADD CONSTRAINT `post_saves_ibfk_1` FOREIGN KEY (`post_sid`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `post_saves_ibfk_2` FOREIGN KEY (`user_sid`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `fk_foreign_key_name1` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`ward_id`);

--
-- Các ràng buộc cho bảng `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `FK2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`property_id`);

--
-- Các ràng buộc cho bảng `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `wards_FK` FOREIGN KEY (`district_id`) REFERENCES `districts` (`district_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
