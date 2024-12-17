-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 17, 2024 lúc 01:13 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bansach`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) DEFAULT NULL,
  `ward` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `default` tinyint(1) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `Role` varchar(100) DEFAULT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`AdminID`, `UserName`, `Password`, `FullName`, `Role`, `Email`) VALUES
(1, 'admin', '$2y$10$kyCqm0HecxGqQGkJSIEFxuH2yqlGwW/5NYklcn59uuFdWIOR5Z7ES', 'admin', 'admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `avgratingbook`
--

CREATE TABLE `avgratingbook` (
  `bookid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `book`
--

CREATE TABLE `book` (
  `BookID` int(11) NOT NULL,
  `SetID` int(11) DEFAULT NULL,
  `BookTitle` varchar(255) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `CreatedDate` timestamp NULL DEFAULT current_timestamp(),
  `ModifiedDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PublisherID` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `GenreID` int(11) DEFAULT NULL,
  `CostPrice` decimal(10,2) NOT NULL,
  `SellingPrice` decimal(10,2) NOT NULL,
  `PageCount` int(11) NOT NULL,
  `Weight` decimal(10,2) NOT NULL,
  `CoverStyle` varchar(255) NOT NULL,
  `Size` varchar(50) NOT NULL,
  `YearPublished` year(4) NOT NULL,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `Avatar` varchar(255) DEFAULT NULL,
  `ImagePath` varchar(255) DEFAULT NULL,
  `ViewCount` int(11) DEFAULT NULL,
  `ModifiedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `book`
--

INSERT INTO `book` (`BookID`, `SetID`, `BookTitle`, `Author`, `Description`, `CreatedDate`, `ModifiedDate`, `PublisherID`, `CategoryID`, `GenreID`, `CostPrice`, `SellingPrice`, `PageCount`, `Weight`, `CoverStyle`, `Size`, `YearPublished`, `CreatedBy`, `Avatar`, `ImagePath`, `ViewCount`, `ModifiedBy`) VALUES
(29, 1, 'Combo Trọn Bộ CONAN ĐẶC SẮC: Conan và Tổ chức Áo Đen (Tập 1, 2) + Conan Tuyển Tập Đặc Biệt - FBI Selection + Conan Tuyển Tập Fan Bình Chọn (Tập 1, 2) + Conan Những Câu Chuyện Lãng Mạn (Tập 1,2,3) - Bộ 8 Cuốn/ Tặng Kèm Postcard Green Life', 'Aoyama Gosho', 'Thám tử lừng danh Conan (名探偵コナン (Danh thám trinh Conan) Meitantei Konan?) là một series manga trinh thám được sáng tác bởi Aoyama Gōshō. Tác phẩm được đăng tải trên tạp chí Weekly Shōnen Sunday của nhà xuất bản Shogakukan vào năm 1994 và được đóng gói thành 106 tập tankōbon tính đến tháng 10 năm 2024. Truyện xoay quanh một cậu thám tử trung học có tên là Kudo Shinichi trong lúc đang điều tra một Tổ chức Áo đen bí ẩn đã bị ép phải uống một loại thuốc độc có thể gây chết người. May mắn là đã sống sót nhưng cơ thể thì lại bị teo nhỏ như một đứa bé 6-7 tuổi. Kể từ đó để tránh bị lộ thân phận thực sự của mình, Shinichi đã lấy tên là Edogawa Conan và chuyển đến sống ở nhà của cô bạn thời thơ ấu Mori Ran cùng với cha của cô ấy là một thám tử tư tên Mori Kogoro với hy vọng một ngày nào đó cậu có thể hạ gục Tổ chức Áo Đen và lấy lại hình dáng ban đầu.', '2024-10-23 05:17:14', '2024-12-12 12:56:59', 1, 2, 1, 120000.00, 120000.00, 45, 0.12, '0', '11.3 x 17.6', '2003', NULL, '/images/book/1732630072-49291.jpg', NULL, NULL, NULL),
(30, NULL, 'Kỉ Nguyên Kì Lạ', 'Huỳnh Văn Trung', 'Toàn Cầu Quỷ Dị Thời Đại; Thời Đại Kì Lạ Của Toàn Cầu', '2024-10-30 02:41:54', '2024-12-12 12:58:43', 1, 1, 2, 120000.00, 120000.00, 150, 0.20, '0', '12x12', '2020', NULL, '/images/book/1732630316-50263.jpg', NULL, NULL, NULL),
(31, NULL, '7 Viên Ngọc Rồng', 'Toriyama Akira', 'Câu chuyện kể về cuộc phiêu lưu của Son Goku từ thời thơ ấu cho đến khi trưởng thành khi cậu luyện tập võ thuật và khám phá thế giới để tìm kiếm 7 quả cầu được gọi là Ngọc Rồng.', '2024-10-30 04:12:35', '2024-12-12 13:06:12', 1, 4, 4, 120000.00, 120000.00, 1000, 0.20, '0', '12x12', '2015', NULL, '/images/book/1730261555-download.jpg', NULL, NULL, '19'),
(32, NULL, 'Thập Tử Đế Hoàng đều là đệ tử của ta', 'Toriyama Akira', 'Thập Tử Đế Hoàng đều là đệ tử của ta', '2024-10-30 04:16:57', '2024-12-12 13:06:14', 1, 1, 3, 120000.00, 120000.00, 100, 0.20, '0', '12x12', '2020', NULL, '/images/book/1732630417-31339.jpg', NULL, NULL, NULL),
(33, NULL, 'Bắt Đầu Với Chí Tôn Đan Điền', 'Toriyama Akira', 'Bắt Đầu Với Chí Tôn Đan Điền', '2024-10-30 04:18:32', '2024-12-12 13:06:23', 1, 2, 1, 120000.00, 120000.00, 250, 0.20, '0', '12x12', '2021', NULL, '/images/book/1732630448-50041.jpg', NULL, NULL, NULL),
(35, 2, 'Thỏ Bảy Màu', 'Huỳnh Thái Ngọc', 'Thỏ Bảy Màu là một loạt truyện tranh ngắn do họa sĩ Huỳnh Thái Ngọc sáng tác từ năm 2014. Loạt truyện ban đầu thuộc dạng ngắn và được đăng tải chủ yếu trên Facebook & YouTube. Đến năm 2015, tập truyện đầu tiên của Thỏ bảy màu đã được ra mắt với tên Thỏ bảy màu - Timeline của tôi có gì? do nhà xuất bản Thế giới phát hành. Tập truyện thứ hai đã được ra mắt sau đó 7 năm có tên Thỏ bảy màu và những người nghĩ nó là bạn do nhà xuất bản Dân trí phát hành. \"Nghe lời thỏ, coi như bỏ\" được xem là khẩu hiệu xuyên suốt của bộ truyện. Bản quyền nhân vật hiện trực thuộc của Công ty TNHH T7M tại Thành phố Hồ Chí Minh.', '2024-10-30 10:52:54', '2024-12-12 13:06:15', 1, 3, 3, 120000.00, 120000.00, 200, 0.20, '0', '12x12', '2023', NULL, '/images/book/1732621159-50176.jpg', NULL, NULL, NULL),
(36, 2, 'Truyện tranh Doraemon truyện ngắn', 'Fujiko F. Fujio', 'Doraemon là series truyện tranh kể về chú mèo máy Doraemon đến từ thế kỷ 22 để giúp một cậu bé học sinh tiểu học hậu đậu tên là Nobita. Các mẩu truyện Doraemon thường ngắn gọn, dễ hiểu, dí dỏm và mang cái nhìn đầy lạc quan về cuộc sống tương lai cũng như sự phát triển của khoa học – kỹ thuật.', '2024-10-30 10:56:28', '2024-12-12 13:06:19', 1, 1, 2, 120000.00, 120000.00, 200, 0.20, '0', '12x12', '2015', NULL, '/images/book/1732629737-50026.jpg', NULL, NULL, NULL),
(37, 3, 'Sách Tiếng Việt Lớp 1', 'Nguyễn Minh Thuyết', 'Sách Tiếng Việt Lớp 1', '2024-10-30 11:15:05', '2024-12-12 13:06:18', 5, 2, 2, 120000.00, 120000.00, 100, 0.15, '0', '12x12', '2015', NULL, '/images/book/1732630479-45152.jpg', NULL, NULL, NULL),
(38, 3, 'Sách Giáo Khoa Toán lớp 1', 'Huỳnh Thái Ngọc', 'Sách Giáo Khoa Toán lớp 1', '2024-10-30 11:17:25', '2024-12-12 13:06:17', 5, 3, 4, 120000.00, 120000.00, 200, 0.16, '0', '12x12', '2015', NULL, '/images/book/1732630521-44474.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookgenre`
--

CREATE TABLE `bookgenre` (
  `BookID` int(11) DEFAULT NULL,
  `GenreID` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bookgenre`
--

INSERT INTO `bookgenre` (`BookID`, `GenreID`, `CategoryID`) VALUES
(34, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookimage`
--

CREATE TABLE `bookimage` (
  `ImageID` int(11) NOT NULL,
  `BookID` int(11) DEFAULT NULL,
  `ImageUrl` varchar(255) DEFAULT NULL,
  `IsMainImage` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookset`
--

CREATE TABLE `bookset` (
  `SetID` int(11) NOT NULL,
  `SetTitle` varchar(255) NOT NULL,
  `SetAvatar` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `CreatedBy` varchar(100) DEFAULT NULL,
  `ModifiedBy` varchar(100) DEFAULT NULL,
  `CreatedDate` timestamp NULL DEFAULT current_timestamp(),
  `ModifiedDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bookset`
--

INSERT INTO `bookset` (`SetID`, `SetTitle`, `SetAvatar`, `Description`, `CreatedBy`, `ModifiedBy`, `CreatedDate`, `ModifiedDate`) VALUES
(1, 'Conan', '/images/bookset/1730254317-1.png', NULL, 'admin', 'admin', '2024-10-21 08:37:55', '2024-10-30 02:11:57'),
(2, 'Truyện Tranh', '/images/bookset/1730261155-nhat-hot-dao.jpg', NULL, 'admin', NULL, '2024-10-30 04:05:55', '2024-10-30 04:05:55'),
(3, 'Sách cấp 1', '/images/bookset/default.jpg', NULL, 'admin', NULL, '2024-10-30 11:10:36', '2024-10-30 11:10:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `CreatedBy` varchar(255) NOT NULL,
  `CreatedDate` timestamp NULL DEFAULT current_timestamp(),
  `ModifiedDate` timestamp NULL DEFAULT current_timestamp(),
  `ModifiedBy` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `CreatedBy`, `CreatedDate`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 'Tiểu Thuyết', 'admin', '2024-10-21 12:31:03', NULL, NULL),
(2, 'Khoa Học', 'admin', '2024-10-21 12:31:03', NULL, NULL),
(3, 'Truyện Tranh 1', 'admin', '2024-10-30 06:04:42', '2024-10-30 06:05:34', 'admin'),
(4, 'Trinh Thám', 'admin', '2024-10-30 10:49:28', '2024-10-30 10:49:28', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `CouponID` int(11) NOT NULL,
  `CouponCode` varchar(100) DEFAULT NULL,
  `DiscountAmount` decimal(10,2) DEFAULT NULL,
  `CreatedBy` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(100) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genre`
--

CREATE TABLE `genre` (
  `GenreID` int(11) NOT NULL,
  `GenreName` varchar(100) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `CreatedBy` varchar(255) NOT NULL,
  `CreatedDate` timestamp NULL DEFAULT current_timestamp(),
  `ModifiedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `ModifiedBy` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `genre`
--

INSERT INTO `genre` (`GenreID`, `GenreName`, `CategoryID`, `CreatedBy`, `CreatedDate`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 'Trinh Thám 2', 1, 'admin', '2024-10-30 06:06:17', '2024-10-30 06:06:45', 'admin'),
(2, 'khoa học viễn tưởng', 2, 'admin', '2024-10-30 06:06:17', '2024-10-30 06:06:45', 'admin'),
(3, 'truyện hài hước\r\n', 3, 'admin', '2024-10-30 06:06:17', '2024-10-30 06:06:45', 'admin'),
(4, 'Tội phạm', 4, 'admin', '2024-10-30 06:06:17', '2024-10-30 06:06:45', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `publisher`
--

CREATE TABLE `publisher` (
  `PublisherID` int(11) NOT NULL,
  `PublisherName` varchar(255) NOT NULL,
  `CreatedBy` varchar(255) DEFAULT NULL,
  `CreatedDate` timestamp NULL DEFAULT current_timestamp(),
  `IsActive` tinyint(1) NOT NULL,
  `ModifiedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `publisher`
--

INSERT INTO `publisher` (`PublisherID`, `PublisherName`, `CreatedBy`, `CreatedDate`, `IsActive`, `ModifiedDate`) VALUES
(1, 'NXB Kim Đồng', 'admin', '2024-10-21 12:16:09', 1, '2024-10-22 08:31:27'),
(2, 'NXB Giáo Dục', 'admin', '2024-10-21 12:16:09', 1, '2024-10-30 02:13:02'),
(4, 'Trung Quốc', NULL, '2024-10-30 04:06:32', 1, '2024-10-30 04:06:32'),
(5, 'Nhà xuất bản Giáo dục Việt Nam', NULL, '2024-10-30 11:11:09', 1, '2024-10-30 11:11:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `OrderID` int(11) NOT NULL,
  `SupplierID` int(11) DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `OrderStatus` varchar(100) DEFAULT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchaseorderdetail`
--

CREATE TABLE `purchaseorderdetail` (
  `OrderID` int(11) DEFAULT NULL,
  `BookID` int(11) DEFAULT NULL,
  `QuantityReceived` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `RatingID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `RatingValue` decimal(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `ReviewID` int(11) NOT NULL,
  `BookID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `Rating` decimal(2,1) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `review`
--

INSERT INTO `review` (`ReviewID`, `BookID`, `UserID`, `Content`, `Rating`, `CreatedDate`, `ModifiedDate`, `updated_at`, `created_at`) VALUES
(65, 29, 29, 'zxc', 4.0, NULL, NULL, '2024-11-13 04:00:28', '2024-11-13 04:00:28'),
(66, 29, 29, 'zxzzzzzz', 2.0, NULL, NULL, '2024-11-13 04:06:02', '2024-11-13 04:06:02'),
(67, 29, 29, 'z', 2.0, NULL, NULL, '2024-11-13 04:08:16', '2024-11-13 04:08:16'),
(70, 29, 30, 'zxc', 4.0, NULL, NULL, '2024-11-13 06:47:24', '2024-11-13 06:47:24'),
(71, 29, 30, 'z', 4.0, NULL, NULL, '2024-11-13 06:49:36', '2024-11-13 06:49:36'),
(73, 38, 37, 'abc', 5.0, NULL, NULL, '2024-11-13 11:09:26', '2024-11-13 11:09:26'),
(74, 37, 37, 'test', 5.0, NULL, NULL, '2024-11-13 11:53:05', '2024-11-13 11:53:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salesorder`
--

CREATE TABLE `salesorder` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderDate` datetime DEFAULT NULL,
  `ShippingStatus` varchar(100) DEFAULT NULL,
  `ShippingPrice` decimal(10,2) DEFAULT NULL,
  `Discount` decimal(10,2) DEFAULT NULL,
  `TaxRate` decimal(5,2) DEFAULT NULL,
  `OrderStatus` enum('PENDING','COMPLETED','CANCELLED','SHIPPING') NOT NULL DEFAULT 'PENDING',
  `ShippingAddressID` int(11) NOT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `ShippingFee` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `salesorder`
--

INSERT INTO `salesorder` (`OrderID`, `UserID`, `OrderDate`, `ShippingStatus`, `ShippingPrice`, `Discount`, `TaxRate`, `OrderStatus`, `ShippingAddressID`, `TotalPrice`, `ShippingFee`) VALUES
(1, 4, '2024-10-21 22:28:34', NULL, NULL, 0.00, NULL, 'PENDING', 1, 196.00, 5.00),
(2, 4, '2024-10-21 22:42:13', NULL, NULL, 0.00, NULL, 'PENDING', 1, 28.00, 5.00),
(3, 15, '2024-10-29 16:31:36', NULL, NULL, 0.00, NULL, 'PENDING', 1, 120.00, 5.00),
(4, 16, '2024-10-29 16:34:42', NULL, NULL, 0.00, NULL, 'PENDING', 1, 1231.31, 5.00),
(5, 17, '2024-10-29 17:15:56', NULL, NULL, 0.00, NULL, 'PENDING', 3, 120.00, 5.00),
(6, 18, '2024-10-29 17:57:05', NULL, NULL, 0.00, NULL, 'PENDING', 4, 360.00, 5.00),
(7, 18, '2024-10-29 18:05:36', NULL, NULL, 0.00, NULL, 'PENDING', 4, 48.00, 5.00),
(8, 19, '2024-10-30 08:51:58', NULL, NULL, 0.00, NULL, 'SHIPPING', 5, 25.00, 5.00),
(9, 21, '2024-10-30 11:25:08', NULL, NULL, 0.00, NULL, 'COMPLETED', 7, 30.00, 5.00),
(10, 23, '2024-10-30 17:47:20', NULL, NULL, 0.00, NULL, 'SHIPPING', 9, 30.00, 5.00),
(11, 23, '2024-10-30 19:06:11', NULL, NULL, 0.00, NULL, 'SHIPPING', 9, 50.00, 5.00),
(12, 24, '2024-11-12 15:23:14', NULL, NULL, 0.00, NULL, 'COMPLETED', 10, 25.00, 5.00),
(13, 26, '2024-11-13 09:21:06', NULL, NULL, 0.00, NULL, 'SHIPPING', 11, 140.00, 5.00),
(14, 26, '2024-11-13 09:22:55', NULL, NULL, 0.00, NULL, 'SHIPPING', 11, 100.00, 5.00),
(15, 29, '2024-11-13 10:29:08', NULL, NULL, 0.00, NULL, 'COMPLETED', 12, 25.00, 5.00),
(16, 30, '2024-11-13 13:41:47', NULL, NULL, 0.00, NULL, 'COMPLETED', 13, 25.00, 5.00),
(17, 37, '2024-11-13 18:04:30', NULL, NULL, 0.00, NULL, 'COMPLETED', 14, 50.00, 5.00),
(18, 37, '2024-11-13 18:06:07', NULL, NULL, 0.00, NULL, 'COMPLETED', 14, 100.00, 5.00),
(19, 37, '2024-11-13 18:51:50', NULL, NULL, 0.00, NULL, 'COMPLETED', 14, 35.00, 5.00),
(20, 35, '2024-11-26 23:13:13', NULL, NULL, 0.00, NULL, 'SHIPPING', 15, 960000.00, 5.00),
(21, 35, '2024-11-26 23:13:53', NULL, NULL, 0.00, NULL, 'SHIPPING', 15, 960000.00, 5.00),
(30, 38, '2024-12-11 17:18:58', NULL, NULL, 0.00, NULL, 'PENDING', 16, 1080000.00, 5.00),
(32, 38, '2024-12-12 20:32:56', NULL, NULL, 0.00, NULL, 'PENDING', 16, 120000.00, 5.00),
(33, 38, '2024-12-12 20:36:54', NULL, NULL, 0.00, NULL, 'PENDING', 16, 120000.00, 5.00),
(34, 38, '2024-12-12 20:37:35', NULL, NULL, 0.00, NULL, 'PENDING', 16, 120000.00, 5.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salesorderdetail`
--

CREATE TABLE `salesorderdetail` (
  `OrderID` int(11) DEFAULT NULL,
  `BookID` int(11) DEFAULT NULL,
  `QuantitySold` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `SubTotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `salesorderdetail`
--

INSERT INTO `salesorderdetail` (`OrderID`, `BookID`, `QuantitySold`, `Price`, `SubTotal`) VALUES
(1, 1, 7, 2.00, 14.00),
(2, 1, 1, 2.00, 2.00),
(3, 11, 1, 2.00, 2.00),
(4, 23, 1, 21321.32, 21321.32),
(5, 19, 1, 2.00, 2.00),
(6, 20, 3, 2.00, 6.00),
(7, 29, 4, 12.00, 48.00),
(8, 29, 1, 12.00, 12.00),
(9, 33, 1, 25.00, 25.00),
(10, 30, 1, 28.00, 28.00),
(11, 38, 1, 47.00, 47.00),
(12, 29, 1, 12.00, 12.00),
(13, 37, 4, 32.00, 128.00),
(14, 31, 2, 30.00, 60.00),
(15, 29, 1, 12.00, 12.00),
(16, 29, 1, 12.00, 12.00),
(17, 38, 1, 47.00, 47.00),
(18, 38, 2, 47.00, 94.00),
(19, 37, 1, 32.00, 32.00),
(20, 33, 8, 120000.00, 960000.00),
(21, 33, 8, 120000.00, 960000.00),
(30, 36, 8, 120000.00, 960000.00),
(30, 33, 1, 120000.00, 120000.00),
(32, 33, 1, 120000.00, 120000.00),
(33, 33, 1, 120000.00, 120000.00),
(34, 29, 1, 120000.00, 120000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shippingaddress`
--

CREATE TABLE `shippingaddress` (
  `AddressID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `City` varchar(255) NOT NULL,
  `District` varchar(255) NOT NULL,
  `Ward` varchar(255) DEFAULT NULL,
  `Address` text NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `IsDefault` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shippingaddress`
--

INSERT INTO `shippingaddress` (`AddressID`, `UserID`, `FullName`, `City`, `District`, `Ward`, `Address`, `PhoneNumber`, `IsDefault`, `created_at`, `updated_at`) VALUES
(1, 16, 'Nguyễn Văn Mẫn', 'Hà Nội', 'Quận Ba Đình', '12312312', 'Hoàng Mai', '0878442286', 1, '2024-10-21 15:24:20', '2024-10-29 09:34:21'),
(2, 16, NULL, 'Hà Nội', 'Quận Ba Đình', '12312312', 'Hoàng Mai', NULL, 0, '2024-10-29 09:58:04', '2024-10-29 09:58:04'),
(3, 17, NULL, 'Hà Nội', 'Quận Ba Đình', '12312312', 'Hoàng Mai 1', NULL, 0, '2024-10-29 10:15:20', '2024-10-29 10:15:20'),
(4, 18, NULL, 'Đà Nẵng', 'test', 'test', '123 test', NULL, 0, '2024-10-29 10:56:01', '2024-10-29 10:56:01'),
(5, 19, NULL, 'hà nội', 'thanh xuan', 'thanh xuan', '123 test', NULL, 0, '2024-10-30 01:51:37', '2024-10-30 01:51:37'),
(6, 20, NULL, 'Tam Kỳ', 'Tam Kỳ', 'Tam Kỳ', 'Tam Kỳ', NULL, 0, '2024-10-30 04:21:09', '2024-10-30 04:21:09'),
(7, 21, NULL, 'Tam Kỳ', 'Tam Kỳ', 'Tam Kỳ', 'Tam Kỳ', NULL, 0, '2024-10-30 04:22:48', '2024-10-30 04:22:48'),
(8, 22, NULL, 'Đà Nẵng', 'Đà Nẵng', 'Đà Nẵng', 'Đà Nẵng', NULL, 0, '2024-10-30 04:31:22', '2024-10-30 04:31:22'),
(9, 23, NULL, 'Đà Nẵng', 'Đà Nẵng', 'Đà Nẵng', 'Đà Nẵng', NULL, 0, '2024-10-30 10:47:10', '2024-10-30 10:47:10'),
(10, 24, NULL, 'Đà Nẵng', 'Đà Nẵng', 'thanh xuan', '123 test', NULL, 0, '2024-11-12 08:23:02', '2024-11-12 08:23:02'),
(11, 26, NULL, 'Đà Nẵng', 'Đà Nẵng', 'thanh xuan', '123 test', NULL, 0, '2024-11-13 02:20:47', '2024-11-13 02:20:47'),
(12, 29, NULL, 'Đà Nẵng', 'thanh xuan', 'thanh xuan', '123 test', NULL, 0, '2024-11-13 03:28:58', '2024-11-13 03:28:58'),
(13, 30, NULL, 'hà nội', 'thanh xuan', 'test', '123 test', NULL, 0, '2024-11-13 06:41:36', '2024-11-13 06:41:36'),
(14, 37, NULL, 'Đà Nẵng', 'thanh xuan', 'thanh xuan', '123 test', NULL, 0, '2024-11-13 11:03:54', '2024-11-13 11:03:54'),
(15, 35, NULL, '123', '42', '123', '12', NULL, 0, '2024-11-26 16:13:04', '2024-11-26 16:13:04'),
(16, 38, NULL, 'Đà Nẵng', 'thanh xuan', 'thanh xuan', 'tam thanh', NULL, 0, '2024-11-27 11:47:33', '2024-11-27 11:47:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shoppingcart`
--

INSERT INTO `shoppingcart` (`CartID`, `UserID`) VALUES
(1, NULL),
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL),
(6, NULL),
(7, NULL),
(8, NULL),
(9, NULL),
(10, NULL),
(11, NULL),
(12, NULL),
(13, NULL),
(14, NULL),
(15, NULL),
(16, NULL),
(17, NULL),
(18, NULL),
(19, NULL),
(20, NULL),
(21, NULL),
(22, NULL),
(23, NULL),
(24, NULL),
(25, NULL),
(26, NULL),
(27, NULL),
(28, NULL),
(29, NULL),
(30, NULL),
(31, NULL),
(32, NULL),
(33, NULL),
(34, NULL),
(35, NULL),
(36, NULL),
(37, NULL),
(38, NULL),
(39, NULL),
(40, NULL),
(41, NULL),
(42, NULL),
(43, NULL),
(44, NULL),
(45, NULL),
(46, NULL),
(47, NULL),
(48, NULL),
(49, NULL),
(50, NULL),
(51, NULL),
(52, NULL),
(53, NULL),
(54, NULL),
(55, NULL),
(56, NULL),
(57, NULL),
(58, 2),
(59, 3),
(60, 4),
(61, NULL),
(62, NULL),
(63, 5),
(64, NULL),
(65, NULL),
(66, 6),
(67, NULL),
(68, 7),
(69, NULL),
(70, NULL),
(71, NULL),
(72, 8),
(73, NULL),
(74, 9),
(75, NULL),
(76, 10),
(77, NULL),
(78, NULL),
(79, 11),
(80, NULL),
(81, 12),
(82, NULL),
(83, NULL),
(84, 13),
(85, NULL),
(86, NULL),
(87, 14),
(88, NULL),
(89, NULL),
(90, 15),
(91, NULL),
(92, 16),
(93, NULL),
(94, 17),
(95, NULL),
(96, 18),
(97, NULL),
(98, NULL),
(99, 19),
(100, NULL),
(101, 20),
(102, 21),
(103, 22),
(104, NULL),
(105, NULL),
(106, NULL),
(107, 23),
(108, NULL),
(109, NULL),
(110, NULL),
(111, NULL),
(112, NULL),
(113, 24),
(114, NULL),
(115, 25),
(116, NULL),
(117, NULL),
(118, NULL),
(119, 26),
(120, NULL),
(121, NULL),
(122, NULL),
(123, 27),
(124, NULL),
(125, 28),
(126, NULL),
(127, NULL),
(128, 29),
(129, NULL),
(130, 30),
(131, NULL),
(132, 31),
(133, NULL),
(134, NULL),
(135, NULL),
(136, NULL),
(137, 32),
(138, NULL),
(139, 33),
(140, NULL),
(141, NULL),
(142, NULL),
(143, 34),
(144, NULL),
(145, 35),
(146, NULL),
(147, 36),
(148, NULL),
(149, 37),
(150, NULL),
(151, 38),
(152, NULL),
(153, NULL),
(154, NULL),
(155, NULL),
(156, NULL),
(157, NULL),
(158, NULL),
(159, NULL),
(160, NULL),
(161, NULL),
(162, NULL),
(163, 39),
(164, NULL),
(165, NULL),
(166, NULL),
(167, NULL),
(168, NULL),
(169, NULL),
(170, NULL),
(171, NULL),
(172, NULL),
(173, NULL),
(174, NULL),
(175, NULL),
(176, NULL),
(177, NULL),
(178, 40),
(179, NULL),
(180, NULL),
(181, 41),
(182, NULL),
(183, 42),
(184, NULL),
(185, 43),
(186, NULL),
(187, 44),
(188, NULL),
(189, 45),
(190, NULL),
(191, NULL),
(192, 46),
(193, NULL),
(194, NULL),
(195, NULL),
(196, 47),
(197, NULL),
(198, NULL),
(199, 48),
(200, NULL),
(201, 49),
(202, NULL),
(203, 50),
(204, NULL),
(205, 51),
(206, NULL),
(207, 52),
(208, NULL),
(209, NULL),
(210, NULL),
(211, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shoppingcartdetail`
--

CREATE TABLE `shoppingcartdetail` (
  `CartItemID` int(11) NOT NULL,
  `CartID` int(11) DEFAULT NULL,
  `BookID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `shoppingcartdetail`
--

INSERT INTO `shoppingcartdetail` (`CartItemID`, `CartID`, `BookID`, `Quantity`) VALUES
(1, 4, 1, 1),
(6, NULL, 1, 1),
(7, 63, 1, 1),
(8, NULL, NULL, 1),
(9, 65, NULL, 1),
(10, 68, 1, 1),
(11, 68, 2, 1),
(12, 79, 29, 1),
(13, 81, 21, 6),
(19, NULL, 29, 2),
(20, 98, 29, 1),
(22, 99, NULL, 1),
(23, 101, 32, 1),
(24, 101, 33, 2),
(28, 98, 30, 1),
(29, 103, 32, 2),
(38, 103, 29, 1),
(39, NULL, 31, 1),
(43, NULL, 37, 1),
(44, 110, 37, 4),
(46, 113, 38, 1),
(49, NULL, 33, 2),
(50, 127, 33, 2),
(56, 145, 33, 8),
(63, NULL, 38, 1),
(64, 180, 29, 1),
(65, 180, 38, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(100) DEFAULT NULL,
  `Info` text DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `MobileReady` varchar(20) DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `Info`, `CreatedDate`, `ModifiedDate`, `MobileReady`, `IsActive`) VALUES
(1, 'Việt Nam', NULL, '2024-10-21 15:27:33', '2024-10-21 15:27:33', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ConfirmCode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `Email`, `FirstName`, `LastName`, `Gender`, `BirthDate`, `PhoneNumber`, `CreatedDate`, `ModifiedDate`, `ConfirmCode`) VALUES
(35, 'hvt92727', '$2y$10$jgEgj86hBVVmJyndc8RI8OzmpQVkUbpfHOnLnfrVCbXOciSRlYsVq', 'hv123t92727@gmail.com', 'Huỳnh', 'Khoa', NULL, NULL, NULL, NULL, NULL, '0'),
(36, 'hieudeptraI', '$2y$10$Hm2pzRVeXwuuZO8IChwrTODq1NVK3Fg/3Vf92InycZ3ylwYkQLX5K', 'hieu@gmail.com', 'Anh', 'Khoa', NULL, NULL, NULL, NULL, NULL, '0'),
(37, 'trung@gmail.com', '$2y$10$eiaBfte/Hz5TqZZvC9J.Iuhbaj0znaTWYFAFqv7AeayHFsPsq0G9G', 'trung@gmail.com', 'Huỳnh', 'Trung', NULL, NULL, NULL, NULL, NULL, '0'),
(38, 'trung', '$2y$10$FgSvMUpnXwDoG.F4uW7pzej2QcBJFhqzkMTCWVzgupe6VXdZp6pQ6', 'hvt9727@gmail.com', 'giang', 'giang', NULL, NULL, NULL, NULL, NULL, '0'),
(52, '2509roblox@gmail.com', '$2y$10$ar9DfZ6zAvE3kz.i81rk6u15LnHVnmrpEHlDJGoQrLVeYuBGk6s1e', '2509roblox@gmail.com', '2509roblox@gmail.com', '2509roblox@gmail.com', NULL, NULL, NULL, NULL, '2024-12-17 18:57:00', 'mEvgjG');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Chỉ mục cho bảng `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `PublisherID` (`PublisherID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `GenreID` (`GenreID`);

--
-- Chỉ mục cho bảng `bookimage`
--
ALTER TABLE `bookimage`
  ADD PRIMARY KEY (`ImageID`);

--
-- Chỉ mục cho bảng `bookset`
--
ALTER TABLE `bookset`
  ADD PRIMARY KEY (`SetID`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`CouponID`);

--
-- Chỉ mục cho bảng `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`GenreID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`PublisherID`);

--
-- Chỉ mục cho bảng `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`OrderID`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`RatingID`),
  ADD KEY `BookID` (`BookID`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`);

--
-- Chỉ mục cho bảng `salesorder`
--
ALTER TABLE `salesorder`
  ADD PRIMARY KEY (`OrderID`);

--
-- Chỉ mục cho bảng `shippingaddress`
--
ALTER TABLE `shippingaddress`
  ADD PRIMARY KEY (`AddressID`);

--
-- Chỉ mục cho bảng `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`CartID`);

--
-- Chỉ mục cho bảng `shoppingcartdetail`
--
ALTER TABLE `shoppingcartdetail`
  ADD PRIMARY KEY (`CartItemID`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `book`
--
ALTER TABLE `book`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `bookimage`
--
ALTER TABLE `bookimage`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `bookset`
--
ALTER TABLE `bookset`
  MODIFY `SetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `CouponID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `genre`
--
ALTER TABLE `genre`
  MODIFY `GenreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `publisher`
--
ALTER TABLE `publisher`
  MODIFY `PublisherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `purchaseorder`
--
ALTER TABLE `purchaseorder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `salesorder`
--
ALTER TABLE `salesorder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `shippingaddress`
--
ALTER TABLE `shippingaddress`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT cho bảng `shoppingcartdetail`
--
ALTER TABLE `shoppingcartdetail`
  MODIFY `CartItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`UserID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`PublisherID`) REFERENCES `publisher` (`PublisherID`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`);

--
-- Các ràng buộc cho bảng `genre`
--
ALTER TABLE `genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book` (`BookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
