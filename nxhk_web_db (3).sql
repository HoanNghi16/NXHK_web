-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 18, 2026 lúc 08:26 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nxhk_web_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Laptop'),
(2, 'Phone'),
(3, 'Gaming'),
(4, 'Accessories');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `order_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `product_name`, `amount`, `quantity`, `status`, `created_at`, `payment_method`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `order_note`) VALUES
(1, 'ORD1773727536', 'Thanh toan: Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 20190000.00, 1, 1, '2026-03-17 06:05:36', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'ORD1773727612', 'Thanh toan: Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 40380000.00, 2, 1, '2026-03-17 06:06:52', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'ORD1773727628', 'Thanh toan: Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 40380000.00, 2, 1, '2026-03-17 06:07:08', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'ORD1773727916', 'Thanh toan: Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 06:11:56', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'ORD1773727939', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:12:19', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'ORD1773728054', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:14:14', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'ORD1773728073', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:14:33', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'ORD1773728080', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:14:40', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'ORD1773728114', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:15:14', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'ORD1773728211', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:16:51', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'ORD1773728247', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:17:27', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'ORD1773728302', 'Thanh toan: iPhone 17 Pro 256GB | Chính hãng', 34890000.00, 1, 1, '2026-03-17 06:18:22', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'ORD1773728320', 'Thanh toan: Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 20190000.00, 1, 1, '2026-03-17 06:18:40', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'ORD1773728860', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 06:27:40', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'ORD1773729276', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 06:34:36', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'ORD1773729328', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 06:35:28', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'ORD1773729594', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 06:39:54', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'ORD1773729647', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 06:40:47', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'ORD1773729662', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 06:41:02', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'ORD1773729793', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 06:43:13', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'ORD1773730023', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 39980000.00, 2, 1, '2026-03-17 06:47:03', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'ORD1773730765', 'Thanh toan: Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 06:59:25', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'ORD1773733302', 'Thanh toan: Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 07:41:42', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'ORD1773733372', 'Thanh toan: Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 07:42:52', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'ORD1773733521', 'Thanh toan: Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 07:45:21', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'ORD1773733958', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 07:52:38', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'ORD1773734059', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 07:54:19', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'ORD1773734172', 'Thanh toan: Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 07:56:12', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'ORD1773734346', 'Thanh toan: Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 07:59:06', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'ORD1773734709', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 08:05:09', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'ORD1773734903', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 08:08:23', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'ORD1773735282', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 08:14:42', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'ORD1773735762', NULL, NULL, 1, 0, '2026-03-17 08:22:42', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'ORD1773735763', NULL, NULL, 1, 0, '2026-03-17 08:22:43', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'ORD1773735764', NULL, NULL, 1, 0, '2026-03-17 08:22:44', NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'ORD1773735765', NULL, NULL, 1, 0, '2026-03-17 08:22:45', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'ORD1773735800', NULL, NULL, 1, 0, '2026-03-17 08:23:20', NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'ORD1773736122', NULL, NULL, 1, 0, '2026-03-17 08:28:42', NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'ORD1773736185', 'Thanh toan: Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 20190000.00, 1, 1, '2026-03-17 08:29:45', NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'ORD1773736220', NULL, NULL, 1, 0, '2026-03-17 08:30:20', NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'ORD1773736334', NULL, NULL, 1, 0, '2026-03-17 08:32:14', NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'ORD1773736337', NULL, NULL, 1, 0, '2026-03-17 08:32:17', NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'ORD1773736342', NULL, NULL, 1, 0, '2026-03-17 08:32:22', NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'ORD1773736368', NULL, NULL, 1, 0, '2026-03-17 08:32:48', NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'ORD1773736388', NULL, NULL, 1, 0, '2026-03-17 08:33:08', NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'ORD1773736392', NULL, NULL, 1, 0, '2026-03-17 08:33:12', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'ORD1773736405', NULL, NULL, 1, 0, '2026-03-17 08:33:25', NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'ORD1773736543', NULL, NULL, 1, 0, '2026-03-17 08:35:43', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'ORD1773736546', NULL, NULL, 1, 0, '2026-03-17 08:35:46', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'ORD1773737236', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 08:47:16', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'ORD1773737989', 'Thanh toan: Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 08:59:49', NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'ORD1773738059', 'Sản phẩm', 0.00, 1, 0, '2026-03-17 09:00:59', 'vnpay', NULL, NULL, NULL, NULL, NULL),
(57, 'ORD1773738914999', 'Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 09:15:14', NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'ORD1773739249369', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:20:49', NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'ORD1773739615936', 'iPhone Air 256GB | Chính hãng', 24990000.00, 1, 1, '2026-03-17 09:26:55', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'ORD1773739979546', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:32:59', NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'ORD1773740044620', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:34:04', NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'ORD1773740376621', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:39:36', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'ORD1773740458502', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:40:58', NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'ORD1773740786168', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:46:26', 'cod', '0', 'tqkhanh662005@gmai.com', '0344251858', 'a', 'b'),
(65, 'ORD1773740850272', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:47:30', 'cod', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', 'b'),
(66, 'ORD202603171656323344', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:56:32', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', 'b'),
(67, 'ORD202603171656437001', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:56:43', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', ''),
(68, 'ORD202603171658182241', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:58:18', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', 'b'),
(69, 'ORD202603171658398898', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 09:58:39', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', 'b'),
(70, 'ORD1773742068384', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 10:07:48', 'cod', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'KTX, trường đại học Công nghiệp TPHCM', 'Không có'),
(71, 'ORD202603171708074276', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 2, '2026-03-17 10:08:07', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'KTX, trường đại học Công nghiệp TPHCM', ''),
(72, 'ORD202603171713426415', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 2, '2026-03-17 10:13:42', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'dhcn', 'a'),
(73, 'ORD1773742492533', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 10:14:52', 'cod', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', ''),
(74, 'ORD202603171715094638', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 2, '2026-03-17 10:15:09', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', ''),
(75, 'ORD1773743176624', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 10:26:16', 'cod', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'dhcn', 'a'),
(76, 'ORD202603171726324527', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 2, '2026-03-17 10:26:32', 'vnpay', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'dhcn', 'a'),
(77, 'ORD1773744105450', 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000.00, 1, 1, '2026-03-17 10:41:45', 'cod', 'Trần Quốc Khánh', 'tqkhanh662005@gmai.com', '0344251858', 'a', 'b'),
(78, 'ORD1773744485166', 'Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000.00, 1, 1, '2026-03-17 10:48:05', 'cod', 'Nguyễn Dương Hoàng Nghi', 'hoangnghinguyen17@gmail.com', '0938481656', '46/9, Nguyễn Ngọc Nhựt', 'âcscasc'),
(79, 'ORD1773744504824', 'Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 20190000.00, 1, 1, '2026-03-17 10:48:24', 'cod', 'Nguyễn dương hoàng nghi', 'hoangnghinguyen17@gmail.com', '0938481656', 'âcscas', 'âcsc'),
(80, 'ORD202603171748346726', 'Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 40380000.00, 2, 1, '2026-03-17 10:48:34', 'vnpay', 'Nguyễn dương hoàng nghi', 'hoangnghinguyen17@gmail.com', '0938481656', 'âcscas', 'âcsc'),
(81, 'ORD202603171749078926', 'Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 20190000.00, 1, 2, '2026-03-17 10:49:07', 'vnpay', 'CacSCASCA', 'hoangnghinguyen17@gmail.com', '0938481656', 'ÂCSCASC', 'ÂCSCASC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) NOT NULL,
  `product_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,0) UNSIGNED NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `specifications` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `price`, `description`, `specifications`, `quantity`) VALUES
(1, 1, 'Laptop Dell 15 DC15255 DC5R5802W1', 16290000, 'Laptop Dell 15 DC15255 DC5R5802W1 mang đến sức mạnh xử lý đột phá nhờ trang bị CPU Ryzen 5 7530U kết hợp với card đồ hoạ AMD Radeon Graphics tân tiến. RAM 16GB và SSD dung lượng 512GB chuẩn giao tiếp PCIe cho phép chạy đa tác vụ mượt, hiệu quả. Màn hình IPS lớn 15.6 inch 120Hz phục vụ chất lượng hình ảnh bắt mắt, đầy sống động. ', '{\"Loại card đồ họa\":\"AMD Radeon Graphics\",\"Dung lượng RAM\":\"16GB\",\"Loại RAM\":\"DDR4 3200MHz\",\"Ổ cứng\":\"512GB M.2 PCIe NVMe (nâng cấp tối đa 1TB)\",\"Kích thước màn hình\":\"15.6 inches\",\"Công nghệ màn hình\":\"IPS, Độ phủ màu 45% NTSC, Độ sáng 250 nits, Chống chói\",\"Độ phân giải\":\"1920 x 1080 pixels (FullHD) 120Hz\",\"Loại CPU\":\"Ryzen 5 7530U (Up to 4.5 GHz, 12 MB Cache)\",\"Pin\":\"3-Cell Battery, 41WHr\",\"Hệ điều hành\":\"Windows 11 Home + Office Home & Student 2024\",\"Cổng giao tiếp\":\"1x USB-C, 1x USB 3.2, 1x USB 2.0, 1x HDMI 1.4, Jack 3.5mm, SD Card\"}', 100),
(2, 1, 'Laptop ASUS Vivobook S 14 FLIP TP3402VA-LZ632W', 19990000, 'Laptop ASUS Vivobook S 14 Flip TP3402VA-LZ632W sở hữu bộ CPU Intel Core i5-13420H đi cùng RAM 16GB chuẩn DDR4, cộng thêm ổ cứng 512GB M.2 PCIe 4.0. Mẫu laptop ASUS Vivobook này được trang bị màn hình có độ phân giải WUXGA với kích thước 14 inch. Bên cạnh đó, thiết kế Flip còn cho phép người dùng chuyển đổi laptop và tablet theo nhu cầu. ', '{\"Loại card đồ họa\":\"Intel UHD Graphics\",\"Dung lượng RAM\":\"16GB DDR4 (8GB onboard + 8GB SO-DIMM)\",\"Ổ cứng\":\"512GB M.2 NVMe PCIe 4.0 SSD\",\"Kích thước màn hình\":\"14 inches (Cảm ứng, hỗ trợ bút Stylus)\",\"Công nghệ màn hình\":\"Độ sáng 300nits, 45% NTSC, TÜV Rheinland-certified\",\"Độ phân giải\":\"1920 x 1200 pixels (WUXGA)\",\"Loại CPU\":\"Intel Core i5-13420H (Up to 4.6 GHz, 8 lõi, 12 luồng)\",\"Pin\":\"3-cell Li-ion, 50WHrs\",\"Hệ điều hành\":\"Windows 11 Home\",\"Cổng giao tiếp\":\"1x USB-C (DisplayPort\\/Power), 1x USB 3.2, 1x USB 2.0, 1x HDMI 2.1, Jack 3.5mm, DC-in\"}', 100),
(3, 1, 'Apple MacBook Air M2 2024 8CPU 8GPU 16GB 256GB I Chính hãng Apple Việt Nam', 20190000, 'Apple Macbook Air M2 2024 16GB 256GB không chỉ sở hữu ngoại hình siêu mỏng trong thiết kế đẳng cấp và lịch lãm mà còn sở hữu nguồn sức mạnh vượt trội khi được trang bị con chip Apple M2. Đây chính là một thiết bị tuyệt hảo đồng hành cùng bạn trong công việc cũng như giải trí.', '{\"Loại card đồ họa\":\"8 nhân GPU, 16 nhân Neural Engine\",\"Dung lượng RAM\":\"16GB\",\"Ổ cứng\":\"256GB SSD\",\"Kích thước màn hình\":\"13.6 inches\",\"Công nghệ màn hình\":\"Liquid Retina Display, độ sáng 500 nits\",\"Độ phân giải\":\"2560 x 1664 pixels\",\"Loại CPU\":\"Apple M2 8 nhân\",\"Pin\":\"52.6 Wh (lên đến 18 giờ sử dụng)\",\"Hệ điều hành\":\"macOS\",\"Cổng giao tiếp\":\"2x Thunderbolt 3 (USB-C), Jack 3.5mm, Cổng sạc MagSafe 3\"}', 100),
(4, 2, 'iPhone Air 256GB | Chính hãng', 24990000, 'iPhone Air 256GB được Apple ra mắt với thiết kế siêu mỏng 5,64mm, khung titanium bền bỉ và màn hình Super Retina XDR 6,5 inch hỗ trợ ProMotion 120Hz. Máy trang bị chip A19 Pro kết hợp N1, mang lại hiệu suất mạnh mẽ. Camera Fusion 48MP cùng camera trước 18MP Center Stage giúp người dùng ghi lại hình ảnh sắc nét, quay video 4K ổn định.', '{\"Màn hình\":\"6.5 inches, Super Retina XDR, 2736 x 1260 pixels, 460 ppi\",\"Tính năng màn hình\":\"Dynamic Island, Always-on, HDR, True Tone, Độ sáng đỉnh 3000 nits\",\"Camera sau\":\"48MP Fusion Main f\\/1.6\",\"Camera trước\":\"18MP Center Stage f\\/1.6\",\"Chipset\":\"Apple A19 Pro (6 lõi CPU)\",\"Bộ nhớ trong\":\"256 GB\",\"Pin\":\"Xem video lên đến 27 giờ\",\"Hệ điều hành\":\"iOS 26\",\"SIM\":\"2 eSIM\",\"Công nghệ khác\":\"NFC, Lớp phủ chống vân tay & phản chiếu, Haptic Touch\"}', 100),
(5, 2, 'iPhone 17 Pro 256GB | Chính hãng', 34890000, 'iPhone 17 Pro định nghĩa lại nhiếp ảnh di động với hệ thống camera 48MP toàn diện và chip A19 Pro siêu mạnh mẽ.', '{\"Màn hình\":\"6.3 inches, Super Retina XDR, 2622 x 1206 pixels\",\"Công nghệ màn hình\":\"ProMotion 120Hz, Always-on, Độ sáng đỉnh 3000 nits, Kháng dầu & Chống phản chiếu\",\"Camera sau\":\"Chính 48MP (ƒ\\/1.6) OIS | Siêu rộng 48MP (ƒ\\/2.2) 120° | Tele 48MP (ƒ\\/2.8) Zoom 8x\",\"Camera trước\":\"18MP Center Stage (ƒ\\/1.9)\",\"Chipset\":\"Apple A19 Pro (6 lõi CPU: 2 hiệu năng + 4 tiết kiệm)\",\"Bộ nhớ trong\":\"256 GB\",\"SIM\":\"Sim kép (Nano-SIM & eSIM) hoặc 2 eSIM\",\"Hệ điều hành\":\"iOS 26\",\"Tính năng khác\":\"NFC, Dynamic Island, Haptic Touch, P3 Color\"}', 100),
(6, 2, 'iPhone 17 128GB | Chính hãng', 20299000, 'iPhone 17 mang đến trải nghiệm đỉnh cao với màn hình Super Retina XDR siêu sáng, chip A19 thế hệ mới và thời lượng pin ấn tượng lên đến 30 giờ xem video.', '{\"Màn hình\":\"6.3 inches, Super Retina XDR OLED, 2622 x 1206 pixels\",\"Tính năng màn hình\":\"Dynamic Island, Always-on, HDR, Độ sáng đỉnh 3000 nits, Chống phản chiếu\",\"Camera sau\":\"Chính 48MP (ƒ\\/1.6) OIS | Tele 12MP (ƒ\\/1.6) | Siêu rộng 48MP (ƒ\\/2.2)\",\"Camera trước\":\"18MP Center Stage (ƒ\\/1.9) PDAF\",\"Chipset\":\"Apple A19 (6 lõi CPU: 2 hiệu năng + 4 tiết kiệm)\",\"Bộ nhớ trong\":\"256 GB\",\"Thời lượng pin\":\"Xem video lên đến 30 giờ (Trực tuyến 27 giờ)\",\"Hệ điều hành\":\"iOS 26\",\"SIM\":\"Nano-SIM & eSIM hoặc 2 eSIM\",\"Công nghệ khác\":\"NFC, Haptic Touch, True Tone, P3 Color\"}', 100),
(7, 3, 'Máy chơi game cầm tay ROG Ally X (Z2 Edition)', 18990000, 'Máy chơi game cầm tay mạnh mẽ nhất với chip Ryzen Z2, màn hình 120Hz mượt mà và hệ điều hành Windows 11 hỗ trợ mọi tựa game AAA.', '{\"Màn hình\":\"7.0 inches, IPS, Cảm ứng, 100% sRGB\",\"Tần số quét\":\"120Hz (Thời gian phản hồi 7ms), FreeSync Premium\",\"Độ phân giải\":\"1920 x 1080 pixels (FullHD), 500 nits\",\"Chipset\":\"AMD Ryzen™ Z2 A Processor\",\"Loại CPU\":\"4 cores, 8 threads (Up to 3.8GHz)\",\"RAM\\/ROM\":\"16 GB RAM | 512 GB SSD PCIe\",\"Pin\":\"60Wh\",\"Hệ điều hành\":\"Windows 11 Home\",\"Tiện ích\":\"Armoury Crate, Xbox Game Pass, Tương thích đa nền tảng\"}', 100),
(8, 3, 'Chuột Gaming Logitech G502 HERO ', 990000, 'Chuột chơi game hiệu suất cao với cảm biến HERO thế hệ mới, mang lại độ chính xác cực cao và hệ thống đèn LED RGB LIGHTSYNC rực rỡ.', '{\"Hãng sản xuất\":\"Logitech\",\"Độ phân giải\":\"100 – 25.600 DPI\",\"Kết nối\":\"Dây USB (Dài 2.1 m)\",\"Đèn LED\":\"LIGHTSYNC RGB\",\"Tương thích\":\"Windows 7+, macOS 10.11+, ChromeOS\",\"Cảm biến\":\"HERO 25K\",\"Số nút bấm\":\"6 - 11 nút (tùy phiên bản)\"}', 100),
(9, 3, 'Bàn phím Gaming ASUS TUF K1', 780000, 'Bàn phím chơi game bền bỉ với núm vặn âm lượng chuyên dụng, khả năng chống tràn nước và hệ thống đèn LED 5 vùng rực rỡ.', '{\"Hãng sản xuất\":\"ASUS\",\"Loại bàn phím\":\"Full size (104 phím)\",\"Phím đặc biệt\":\"Núm âm lượng chuyên dụng\",\"Đèn LED\":\"LED RGB với 5 vùng tùy chỉnh\",\"Kết nối\":\"Dây cáp cao su 1.8m (USB)\",\"Tương thích\":\"Windows 10, Windows 11\",\"Tính năng khác\":\"Chống tràn nước, đệm kê tay đi kèm\"}', 100),
(10, 4, 'Ốp lưng iPhone 17 Silicone Case with MagSafe', 1490000, 'Ốp lưng Silicone chính hãng Apple với thiết kế ôm sát, lớp lót sợi mềm mại và hỗ trợ sạc MagSafe tiện lợi.', '{\"Hãng sản xuất\":\"Apple Chính hãng\",\"Dòng sản phẩm\":\"iPhone 17\",\"Phân loại ốp\":\"Chống sốc, thời trang\",\"Tính năng\":\"Hỗ trợ sạc MagSafe, Sạc không dây, Chống trầy xước & va đập\",\"Chất liệu\":\"Silicone cao cấp, lót nỉ bên trong\",\"Dùng được cho\":\"iPhone 17\"}', 100),
(11, 4, 'Đế sạc không dây StarGO 3-in-1 Magnetic Wireless Charger', 1250000, 'Trạm sạc đa năng hỗ trợ công nghệ Qi2.0, sạc đồng thời iPhone, Apple Watch và AirPods với thiết kế sạc ẩn và hệ thống làm mát thông minh.', '{\"Hãng sản xuất\":\"StarGO\",\"Công suất sạc\":\"iPhone: 15W | Apple Watch: 5W | AirPods: 5W\",\"Sử dụng tối đa\":\"3 thiết bị cùng lúc\",\"Công nghệ sạc\":\"Qi2.0 (Hiệu suất tối đa 80%)\",\"Tính năng\":\"Kết nối từ tính MagSafe, Tự động quay ngang\\/dọc, Sạc ẩn\",\"Hệ thống\":\"Làm mát mạnh mẽ, Tần số 110-205kHz\",\"Tương thích\":\"iPhone 12 trở lên, Apple Watch, Tai nghe chuẩn Qi\"}', 100),
(12, 4, 'Tai nghe Samsung Galaxy Buds 3 Chính hãng', 3990000, 'Tai nghe không dây thế hệ mới từ Samsung với thiết kế công thái học, chống ồn chủ động ANC thông minh và thời lượng pin lên đến 30 giờ.', '{\"Hãng sản xuất\":\"Samsung Chính hãng\",\"Kích thước\":\"Tai nghe: 18.3x19.3x30.5mm | Hộp sạc: 51x51x28.3mm\",\"Trọng lượng\":\"Tai nghe: 4.6g | Hộp sạc: 45.1g\",\"Thời lượng Pin (Bật ANC)\":\"Tai nghe: 5h | Tổng cộng: 24h\",\"Thời lượng Pin (Tắt ANC)\":\"Tai nghe: 6h | Tổng cộng: 30h\",\"Tính năng khác\":\"Chống ồn ANC, Bộ khuếch đại đơn, Kháng nước IP57\",\"Kết nối\":\"Bluetooth 5.4, Tự động chuyển đổi thiết bị\"}', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(11) NOT NULL,
  `path` text NOT NULL,
  `is_thumbnail` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`product_id`, `image_id`, `path`, `is_thumbnail`) VALUES
(1, 1, '/NXHK_web/img/product/Laptop/1/laptopdell_thumbnail.webp', 1),
(2, 3, '/NXHK_web/img/product/Laptop/2/laptopasus_thumbnail.webp', 1),
(3, 4, '/NXHK_web/img/product/Laptop/3/macbook_thumbnail.webp', 1),
(4, 5, '/NXHK_web/img/product/Phone/4/iphoneair_thumbnail.webp', 1),
(5, 6, '/NXHK_web/img/product/Phone/5/iphone17pro_thumbnail.webp', 1),
(6, 7, '/NXHK_web/img/product/Phone/6/iphone17_thumbnail.webp', 1),
(7, 8, '/NXHK_web/img/product/Gaming/7/rogxbox_thumbnail.webp', 1),
(8, 9, '/NXHK_web/img/product/Gaming/8/g502_thumbnail.webp', 1),
(9, 10, '/NXHK_web/img/product/Gaming/9/asustuf_thumbnail.webp', 1),
(10, 11, '/NXHK_web/img/product/Accessories/10/siliconecase_thumbnail.webp', 1),
(11, 12, '/NXHK_web/img/product/Accessories/11/stargo_thumbnail.webp', 1),
(12, 16, '/NXHK_web/img/product/Accessories/12/samsungbuds4_thumbnail.webp', 1),
(1, 17, '/NXHK_web/img/product/Laptop/1/laptopdell_1.webp', 0),
(1, 18, '/NXHK_web/img/product/Laptop/1/laptopdell_2.webp', 0),
(1, 19, '/NXHK_web/img/product/Laptop/1/laptopdell_3.webp', 0),
(2, 20, '/NXHK_web/img/product/Laptop/2/laptopasus_1.webp', 0),
(2, 21, '/NXHK_web/img/product/Laptop/2/laptopasus_2.webp', 0),
(2, 22, '/NXHK_web/img/product/Laptop/2/laptopasus_3.webp', 0),
(2, 23, '/NXHK_web/img/product/Laptop/2/laptopasus_4.webp', 0),
(3, 24, '/NXHK_web/img/product/Laptop/3/macbook_1.webp', 0),
(3, 25, '/NXHK_web/img/product/Laptop/3/macbook_2.webp', 0),
(3, 26, '/NXHK_web/img/product/Laptop/3/macbook_3.webp', 0),
(4, 27, '/NXHK_web/img/product/Phone/4/iphoneair_1.webp', 0),
(4, 28, '/NXHK_web/img/product/Phone/4/iphoneair_2.webp', 0),
(4, 29, '/NXHK_web/img/product/Phone/4/iphoneair_3.webp', 0),
(5, 30, '/NXHK_web/img/product/Phone/4/iphone17pro_1.webp', 0),
(5, 31, '/NXHK_web/img/product/Phone/4/iphone17pro_2.webp', 0),
(5, 32, '/NXHK_web/img/product/Phone/4/iphone17pro_3.webp', 0),
(6, 33, '/NXHK_web/img/product/Phone/4/iphone17_1.webp', 0),
(6, 34, '/NXHK_web/img/product/Phone/4/iphone17_2.webp', 0),
(7, 35, '/NXHK_web/img/product/Gaming/7/rogxbox_1.webp', 0),
(7, 36, '/NXHK_web/img/product/Gaming/7/rogxbox_2.webp', 0),
(7, 37, '/NXHK_web/img/product/Gaming/7/rogxbox_3.webp', 0),
(8, 38, '/NXHK_web/img/product/Gaming/8/g502_1.webp', 0),
(8, 39, '/NXHK_web/img/product/Gaming/8/g502_2.webp', 0),
(9, 40, '/NXHK_web/img/product/Gaming/9/asustuf_1.webp', 0),
(9, 41, '/NXHK_web/img/product/Gaming/9/asustuf_2.webp', 0),
(10, 42, '/NXHK_web/img/product/Accessories/10/siliconecase_1.webp', 0),
(10, 43, '/NXHK_web/img/product/Accessories/10/siliconecase_2.webp', 0),
(10, 44, '/NXHK_web/img/product/Accessories/10/siliconecase_3.webp', 0),
(11, 45, '/NXHK_web/img/product/Accessories/11/stargo_1.webp', 0),
(11, 46, '/NXHK_web/img/product/Accessories/11/stargo_2.webp', 0),
(11, 47, '/NXHK_web/img/product/Accessories/11/stargo_3.webp', 0),
(12, 48, '/NXHK_web/img/product/Accessories/12/samsungbuds4_1.webp', 0),
(12, 49, '/NXHK_web/img/product/Accessories/12/samsungbuds4_2.webp', 0),
(12, 50, '/NXHK_web/img/product/Accessories/12/samsungbuds4_3.webp', 0),
(12, 51, '/NXHK_web/img/product/Accessories/12/samsungbuds4_4.webp', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `role`, `email`, `password`) VALUES
('69b3d82dc044d', 'Nguyen Thi Hong', 'customer', 'hazelpnk55@gmail.com', '$2y$10$Rgv4/tv35QBNF/9bAzIskO0jS4QPLgtRmgPIlfWpvAfMOVF/ooW1.'),
('69b53e65375f40.67426392', 'Nguyễn Dương Hoàng Nghi', 'customer', 'hoangnghinguyen17@gmail.com', '$2y$10$Y2pa930PJavrXGOnHm2R3elwzhlKeZ.qaTkwmVKOkkVJQ897.Urta'),
('69b919cb447c14.85231263', 'Nguyễn Dương Hoàng Nghi', 'customer', 'hoangnghinguyenduong@gmail.com', '$2y$10$FdoS4oW46WSPqQOmdghxFOQWliqbCwU4AqEizQufZWeoSJO9/a6QO');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD KEY `FK_CART_USER` (`user_id`),
  ADD KEY `fk_product_cart` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`,`product_id`),
  ADD KEY `FK_product_image` (`product_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `FK_CART_USER` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_product_cart` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `FK_product_image` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
