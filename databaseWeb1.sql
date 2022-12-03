-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for nhoma_web1
CREATE DATABASE IF NOT EXISTS `nhoma_web1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `nhoma_web1`;

-- Dumping structure for table nhoma_web1.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.admins: ~1 rows (approximately)
DELETE FROM `admins`;
INSERT INTO `admins` (`id`, `name`, `email`, `password`, `last_login`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Hữu Cường', 'adminJob@gmail.com', '$2y$10$YmIfv9sloxf2eGI1Nw.zJOtQUVXsWneqMCL98QnU46hVmtB21NCHC', '2022-11-04 01:07:17', NULL, '2022-11-04 01:07:20', '2022-11-04 01:07:21');

-- Dumping structure for table nhoma_web1.applie_job
CREATE TABLE IF NOT EXISTS `applie_job` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `job_id` int NOT NULL,
  `upload_cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.applie_job: ~0 rows (approximately)
DELETE FROM `applie_job`;

-- Dumping structure for table nhoma_web1.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `customer_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_job_id` int NOT NULL,
  `comment_content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.comment: ~0 rows (approximately)
DELETE FROM `comment`;

-- Dumping structure for table nhoma_web1.company
CREATE TABLE IF NOT EXISTS `company` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.company: ~2 rows (approximately)
DELETE FROM `company`;
INSERT INTO `company` (`id`, `user_id`, `company_name`, `company_address`, `company_contact`, `company_website`, `description`, `image`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Travala', 'Tòa nhà Udic Complex, N04, Hoàng Đạo Thúy, Trung Hòa Cau Giay Ha Noi', '09083432431', 'https://travala.com', '<div class="panel-heading" style="padding: 10px 20px; background: rgb(255, 255, 255); border: 0px; border-top-right-radius: 3px; border-top-left-radius: 3px; color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 15px;"></div><div class="panel-body" style="padding: 20px; color: rgb(33, 37, 41); font-family: Roboto, sans-serif; font-size: 15px;"><p class="panel-sub-title" style="margin: -5px 0px 0px; font-size: 18px;"><font style="vertical-align: inherit;">Nền tảng đặt phòng du lịch dựa trên blockchain hàng đầu thế giới</font></p><div class="panel-paragraph" style="font-size: 16px; line-height: 1.7em;"><p style="margin-right: 0px; margin-left: 0px;"><font style="vertical-align: inherit;">Được thành lập vào năm 2017, Travala.com đã phát triển từ một công ty khởi nghiệp nhỏ thành nền tảng đặt phòng du lịch dựa trên chuỗi khối hàng đầu thế giới được hàng nghìn khách hàng trên toàn thế giới tin tưởng là đại lý du lịch trực tuyến ưa thích của họ.</font></p><p style="margin-right: 0px; margin-left: 0px;"><font style="vertical-align: inherit;">Tại </font><span style="font-weight: bolder;">Travala.com</span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> , chúng tôi kết nối khách du lịch với một trong những nơi lưu trú tuyệt vời nhất thế giới, bao gồm mọi thứ từ khách sạn, căn hộ, biệt thự và nhà trọ cho đến khu nghỉ dưỡng sang trọng 5 sao. </font><font style="vertical-align: inherit;">Nền tảng Travala.com hiện cung cấp hơn 2.200.000 chỗ nghỉ tại 90.124 điểm đến tại 230 quốc gia và vùng lãnh thổ với mức giá rẻ hơn tới 40% so với các nền tảng đặt phòng du lịch thông thường.</font></font></p></div></div>', '/storage/uploads/2022/12/02/46937175_254973108505798_8154454633654255616_n.webp', '2022-12-02 14:44:22', '2022-12-02 19:21:11'),
	(2, 2, 'Công ty Cổ phần viễn thông FPT', 'Tầng 2, tòa nhà FPT, Phố Duy Tân, Cầu Giấy, Hà Nội', '0908179750', 'https://fptjobs.com', '<p style="margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">Là thành viên thuộc Tập đoàn công nghệ hàng đầu Việt Nam FPT, Công ty Cổ phần Viễn thông FPT (tên gọi tắt là FPT Telecom) hiện là một trong những nhà cung cấp dịch vụ viễn thông và Internet có uy tín và được khách hàng yêu mến tại Việt Nam và khu vực.</p><p style="margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);"><br></p><p style="margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">Thành lập ngày 31/01/1997, khởi nguồn từ Trung tâm Dịch vụ Trực tuyến do 4 thành viên sáng lập cùng sản phẩm mạng Intranet đầu tiên của Việt Nam mang tên “Trí tuệ Việt Nam – TTVN”, sản phẩm được coi là đặt nền móng cho sự phát triển của Internet tại Việt Nam. Sau 20 năm hoạt động, FPT Telecom đã lớn mạnh vượt bậc với hơn 7,000 nhân viên chính thức, gần 200 văn phòng điểm giao dịch thuộc hơn 80 chi nhánh tại 59 tỉnh thành trên toàn quốc. Bên cạnh đó, Công ty đã và đang đặt dấu ấn trên trường quốc tế bằng 8 chi nhánh trải dài khắp Campuchia, cũng như việc được cấp giấy phép kinh doanh dịch vụ tại Myanmar.</p><p style="margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);"><br></p><p style="margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(255, 255, 255);">Với sứ mệnh tiên phong đưa Internet đến với người dân Việt Nam và mong muốn mỗi gia đình Việt Nam đều sử dụng ít nhất một dịch vụ của FPT Telecom, đồng hành cùng phương châm “Khách hàng là trọng tâm”, chúng tôi không ngừng nỗ lực đầu tư hạ tầng, nâng cấp chất lượng sản phẩm – dịch vụ, tăng cường ứng dụng công nghệ mới để mang đến cho khách hàng những trải nghiệm sản phẩm dịch vụ vượt trội.</p>', '/storage/uploads/2022/12/02/cong-ty-co-phan-vien-thong-fpt-5d5f5980e317c.webp', '2022-12-02 14:47:33', '2022-12-02 14:47:33');

-- Dumping structure for table nhoma_web1.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.customer: ~0 rows (approximately)
DELETE FROM `customer`;

-- Dumping structure for table nhoma_web1.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping structure for table nhoma_web1.location
CREATE TABLE IF NOT EXISTS `location` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.location: ~63 rows (approximately)
DELETE FROM `location`;
INSERT INTO `location` (`id`, `location_name`, `created_at`, `updated_at`) VALUES
	(1, 'Thành phố Hà Nội', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(2, 'Tỉnh Hà Giang', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(3, 'Tỉnh Cao Bằng', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(4, 'Tỉnh Bắc Kạn', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(5, 'Tỉnh Tuyên Quang', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(6, 'Tỉnh Lào Cai', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(7, 'Tỉnh Điện Biên', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(8, 'Tỉnh Lai Châu', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(9, 'Tỉnh Sơn La', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(10, 'Tỉnh Yên Bái', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(11, 'Tỉnh Hoà Bình', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(12, 'Tỉnh Thái Nguyên', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(13, 'Tỉnh Lạng Sơn', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(14, 'Tỉnh Quảng Ninh', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(15, 'Tỉnh Bắc Giang', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(16, 'Tỉnh Phú Thọ', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(17, 'Tỉnh Vĩnh Phúc', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(18, 'Tỉnh Bắc Ninh', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(19, 'Tỉnh Hải Dương', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(20, 'Thành phố Hải Phòng', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(21, 'Tỉnh Hưng Yên', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(22, 'Tỉnh Thái Bình', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(23, 'Tỉnh Hà Nam', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(24, 'Tỉnh Nam Định', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(25, 'Tỉnh Ninh Bình', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(26, 'Tỉnh Thanh Hóa', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(27, 'Tỉnh Nghệ An', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(28, 'Tỉnh Hà Tĩnh', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(29, 'Tỉnh Quảng Bình', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(30, 'Tỉnh Quảng Trị', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(31, 'Tỉnh Thừa Thiên Huế', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(32, 'Thành phố Đà Nẵng', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(33, 'Tỉnh Quảng Nam', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(34, 'Tỉnh Quảng Ngãi', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(35, 'Tỉnh Bình Định', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(36, 'Tỉnh Phú Yên', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(37, 'Tỉnh Khánh Hòa', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(38, 'Tỉnh Ninh Thuận', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(39, 'Tỉnh Bình Thuận', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(40, 'Tỉnh Kon Tum', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(41, 'Tỉnh Gia Lai', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(42, 'Tỉnh Đắk Lắk', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(43, 'Tỉnh Đắk Nông', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(44, 'Tỉnh Lâm Đồng', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(45, 'Tỉnh Bình Phước', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(46, 'Tỉnh Tây Ninh', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(47, 'Tỉnh Bình Dương', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(48, 'Tỉnh Đồng Nai', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(49, 'Tỉnh Bà Rịa - Vũng Tàu', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(50, 'Thành phố Hồ Chí Minh', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(51, 'Tỉnh Long An', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(52, 'Tỉnh Tiền Giang', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(53, 'Tỉnh Bến Tre', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(54, 'Tỉnh Trà Vinh', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(55, 'Tỉnh Vĩnh Long', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(56, 'Tỉnh Đồng Tháp', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(57, 'Tỉnh An Giang', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(58, 'Tỉnh Kiên Giang', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(59, 'Thành phố Cần Thơ', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(60, 'Tỉnh Hậu Giang', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(61, 'Tỉnh Sóc Trăng', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(62, 'Tỉnh Bạc Liêu', '2022-12-02 16:25:52', '2022-12-02 16:25:52'),
	(63, 'Tỉnh Cà Mau', '2022-12-02 16:25:52', '2022-12-02 16:25:52');

-- Dumping structure for table nhoma_web1.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.migrations: ~14 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2022_10_23_003742_create_user_type_table', 1),
	(6, '2022_10_23_003855_create_applie_job_table', 1),
	(7, '2022_10_23_004115_create_post_job_table', 1),
	(8, '2022_10_23_005006_create_company_table', 1),
	(9, '2022_10_23_005930_create_location_table', 1),
	(10, '2022_10_23_010822_create_skill_post_job_table', 1),
	(11, '2022_11_03_152037_create_admins_table', 2),
	(12, '2022_10_23_003129_create_user_detail_table', 3),
	(13, '2022_04_17_082523_create_wishList_table', 4),
	(14, '2022_04_17_082748_create_customer_table', 4),
	(15, '2022_12_02_082325_create_comment_table', 4);

-- Dumping structure for table nhoma_web1.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping structure for table nhoma_web1.post_job
CREATE TABLE IF NOT EXISTS `post_job` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int NOT NULL,
  `job_type_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_location_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_salary_min` int NOT NULL,
  `job_salary_max` int NOT NULL,
  `job_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_expired_at` date NOT NULL,
  `job_status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.post_job: ~0 rows (approximately)
DELETE FROM `post_job`;

-- Dumping structure for table nhoma_web1.skill_post_job
CREATE TABLE IF NOT EXISTS `skill_post_job` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_skill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_post_id` int NOT NULL,
  `skill_level` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.skill_post_job: ~0 rows (approximately)
DELETE FROM `skill_post_job`;

-- Dumping structure for table nhoma_web1.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT 'Status: 1 = Active, 2 = Deactivate',
  `user_type_id` int NOT NULL COMMENT 'Type: 1 = JobSeeker, 2 = Company',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.users: ~6 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `email`, `password`, `status`, `user_type_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'travala@gmail.com', 'eyJpdiI6ImVJQ09taCtldWZFTmlJNi9zMGJ2OVE9PSIsInZhbHVlIjoic0p5RnV4VkJGSk9TejlsVHI3cUNqNmIrdXhJYjlLZ1d1dGxuSmpTUkVLTT0iLCJtYWMiOiI4MmFlNTk0MDc3ZTZlMWIxMDkzNDQ5MmM4MzdhNGNlNTllZDA0YWM2OWQ3ODlhNGI4NDVlNDZjOTBiNzc4OTJjIiwidGFnIjoiIn0=', 2, 2, NULL, '2022-12-02 14:44:22', '2022-12-02 19:21:17'),
	(2, 'fpt@gmail.com', 'eyJpdiI6InFiQlFXUC9mWDV2UWpCdGZzSXJwWmc9PSIsInZhbHVlIjoid0dyaWtvSE54UERLcmE4clRCWmw1aHJmem9paG1TMjRmdDJkcEJEUFloQT0iLCJtYWMiOiIyN2RhYmEzOWFmYzk4NWRhZDMwZTgxYWE3YTczYWJiNzEzZTU4MGM0MTlhNWRlNDAyYTYzYmMyZGEwMjAwYzJlIiwidGFnIjoiIn0=', 1, 2, NULL, '2022-12-02 14:47:33', '2022-12-02 14:47:33'),
	(5, 'tuyengoc@mail.tdc.edu.vn', 'eyJpdiI6IjV4Rnl0RHE2WUxJQ25ocmQzZ0NlcGc9PSIsInZhbHVlIjoiSGJVazVvRXJ4dGpvL0ZnWnZHT3Rwdz09IiwibWFjIjoiNzlmMjZiMmJkMDdiZjUyNTY2NDA0OTY1N2M3ZGU4NzM0ZmRkY2M3YjMxMzBhZWJjMjMyNTAxZWEwYjBkZjE4OSIsInRhZyI6IiJ9', 1, 1, NULL, '2022-12-02 16:27:06', '2022-12-03 04:01:05'),
	(6, 'kimanhlagi13@gmail.com', 'eyJpdiI6IlV1NWE4c3N6alhROU5XMmJ2UWlJWkE9PSIsInZhbHVlIjoiK2cwUXdMNWk0Zzd2UzRsR08zT00rdz09IiwibWFjIjoiNzdjYjZkZDAyZDY5ZmMwNWNlNTA1ZGZjNzdjYjM0NmE0YWI5NjUwODQ5OTY0NjhiOWRkYjliZGFjZjI2NThhOCIsInRhZyI6IiJ9', 1, 1, NULL, '2022-12-02 16:37:46', '2022-12-02 16:37:46'),
	(7, 'nguyenthile@gmail.com', 'eyJpdiI6IitwWVY0M291UlE4ZDlhaS9oS0RJNlE9PSIsInZhbHVlIjoiRmlsdjlvS0FhSlQ5cmh5ZFJOdWNVWHQ1bXk1SVdjR0ZvclYyZXgrVUNiUT0iLCJtYWMiOiJkNGYxYmM2MjhiNDIxMDBmZjliMjQ4MzJlZmRiYzM0NWI4ODI4ZWQwNzNkNDlkMzI0Njk4N2Q3YTBhYmM4M2M2IiwidGFnIjoiIn0=', 1, 1, NULL, '2022-12-02 16:53:23', '2022-12-02 16:53:23');

-- Dumping structure for table nhoma_web1.user_detail
CREATE TABLE IF NOT EXISTS `user_detail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.user_detail: ~2 rows (approximately)
DELETE FROM `user_detail`;
INSERT INTO `user_detail` (`id`, `full_name`, `gender`, `address`, `phone`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'Trần Thị Mỹ Ngọc', 0, 'Khu phố 10, phường Bình Tân, thị xã Lagi, tỉnh Bình Thuận', '0908179753', 5, '2022-12-02 16:27:06', '2022-12-02 16:51:49'),
	(2, 'Trần Hà Kim Anh', 0, 'Phường Linh Đông, Quận Thủ Đức', '0908179750', 6, '2022-12-02 16:37:46', '2022-12-02 16:37:46'),
	(3, 'Nguyễn Thị Lệ', 0, 'Phường Cà Thơi, Quận Thủ Đức', '0908179750', 7, '2022-12-02 16:53:23', '2022-12-02 16:53:23');

-- Dumping structure for table nhoma_web1.wishlist
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `post_job_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table nhoma_web1.wishlist: ~0 rows (approximately)
DELETE FROM `wishlist`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
