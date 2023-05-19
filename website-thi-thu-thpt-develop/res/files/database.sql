-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 01:48 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phamhuy_misa_thithu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` int(1) DEFAULT 1,
  `last_login` datetime NOT NULL,
  `gender_id` int(1) NOT NULL DEFAULT 1,
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `email`, `password`, `name`, `permission`, `last_login`, `gender_id`, `avatar`, `birthday`) VALUES
(1, 'admin', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'ADMIN', 1, '2021-11-09 21:55:03', 1, 'avatar-default.jpg', '1997-01-01'),
(2, 'admin001', 'admin001@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'Phạm Quang Huy', 1, '0000-00-00 00:00:00', 1, 'avatar-default.jpg', '1997-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `grade_id` int(10) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `grade_id`, `class_name`, `teacher_id`) VALUES
(1, 1, 'Khối Toán 001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `gender_id` int(1) NOT NULL,
  `gender_detail` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`gender_id`, `gender_detail`) VALUES
(1, 'Chưa Xác Định'),
(2, 'Nam'),
(3, 'Nữ');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` int(11) NOT NULL,
  `detail` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `detail`) VALUES
(1, 'Khối 1'),
(2, 'Khối 2'),
(3, 'Khối 3'),
(4, 'Khối 4'),
(5, 'Khối 5'),
(6, 'Khối 6'),
(7, 'Khối 7'),
(8, 'Khối 8'),
(9, 'Khối 9'),
(10, 'Khối 10'),
(11, 'Khối 11'),
(12, 'Khối 12');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `level_id` int(11) NOT NULL,
  `level_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`level_id`, `level_detail`) VALUES
(1, 'Dễ'),
(2, 'Trung Bình'),
(3, 'Khó');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission` int(11) NOT NULL,
  `permission_detail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission`, `permission_detail`) VALUES
(1, 'Admin'),
(2, 'Giáo Viên'),
(3, 'Học Sinh');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `grade_id` int(10) NOT NULL,
  `unit` int(2) NOT NULL,
  `level_id` int(11) NOT NULL,
  `question_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_a` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_b` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_c` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `answer_d` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correct_answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT 1,
  `sent_by` varchar(255) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`grade_id`, `unit`, `level_id`, `question_content`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `correct_answer`, `question_id`, `subject_id`, `sent_by`, `status_id`) VALUES
(12, 2, 2, '<p>Câu hỏi test 01</p>', '<p>h</p>', '<p>j</p>', '<p>k</p>', '<p>l</p>', '<p>k</p>', 3, 1, 'admin', 4),
(1, 1, 1, '<p>jl</p>', '<p>k</p>', '<p>j</p>', '<p>j</p>', '<p>j</p>', '<p>k</p>', 4, 1, 'admin', 4),
(1, 2, 1, '<p>l</p>', '<p>l</p>', '<p>l</p>', '<p>l</p>', '<p>ll</p>', '<p>l</p>', 5, 1, 'admin', 4),
(1, 1, 1, '<p>k</p>', '<p>k</p>', '<p>k</p>', '<p>k</p>', '<p>k</p>', '<p>k</p>', 6, 1, 'admin', 4),
(12, 9, 1, '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>v</p>', '<p>f</p>', '<p>b</p>', 7, 1, '', 4),
(3, 4, 1, '<p>lll</p>', '<p>m</p>', '<p>j</p>', '<p>h</p>', '<p>g</p>', '<p>m</p>', 8, 1, '', 4),
(12, 12, 1, '<p>l</p>', '<p>kn</p>', '<p>lkn</p>', '<p>kl</p>', '<p>nkjn</p>', '<p>kn</p>', 9, 1, '', 4),
(12, 12, 1, '<p>j</p>', '<p>j</p>', '<p>j</p>', '<p>j</p>', '<p>jj</p>', '<p>j</p>', 10, 1, '', 4),
(1, 33, 1, '<p>hhhhhhhhh</p>', '<p>h</p>', '<p>h</p>', '<p>h</p>', '<p>h</p>', '<p>h</p>', 11, 1, '', 4),
(12, 12, 3, '<p>NgOninit Trong Angular dùng để làm gì</p>', '<p>Khởi tạo directive / component sau khi Angular hiển thị các thuộc tính ràng buộc dữ liệu và đặt các thuộc tính đầu vào của directive / component. Được gọi một lần, sau ngOnChanges() đầu tiên.</p>', '<p>Phát hiện và hành động theo những thay đổi mà Angular không thể hoặc sẽ không tự mình phát hiện.</p>', '<p>Thự thi sau khi Angular đã kiểm tra nội dung bên ngoài đã được đưa vào view của component. Được gọi sau ngAfterContentInit() và mọi ngDoCheck() tiếp theo.</p>', '<p>Thự thi sau khi Angular khởi tạo các view của component và các view con / view mà directive được đưa vào. Được gọi một lần sau ngAfterContentChecked() đầu tiên.</p>', '<p>Khởi tạo directive / component sau khi Angular hiển thị các thuộc tính ràng buộc dữ liệu và đặt các thuộc tính đầu vào của directive / component. Được gọi một lần, sau ngOnChanges() đầu tiên.</p>', 12, 1, '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `quest_of_test`
--

CREATE TABLE `quest_of_test` (
  `test_code` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `timest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quest_of_test`
--

INSERT INTO `quest_of_test` (`test_code`, `question_id`, `timest`) VALUES
(124158, 4, '2021-11-05 10:07:39'),
(124158, 5, '2021-11-05 10:07:39'),
(124158, 6, '2021-11-05 10:07:39'),
(197949, 3, '2021-11-09 00:45:35'),
(212063, 4, '2021-11-09 00:46:09'),
(258629, 3, '2021-11-08 15:01:25'),
(258629, 7, '2021-11-08 15:01:25'),
(258629, 9, '2021-11-08 15:01:25'),
(258629, 10, '2021-11-08 15:01:25'),
(258629, 12, '2021-11-08 15:01:25'),
(562834, 3, '2021-11-05 09:41:38'),
(977537, 4, '2021-11-12 06:42:05'),
(977537, 5, '2021-11-12 06:42:05'),
(977537, 11, '2021-11-12 06:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `student_id` int(11) NOT NULL,
  `test_code` int(11) NOT NULL,
  `score_number` varchar(10) DEFAULT NULL,
  `score_detail` varchar(50) NOT NULL,
  `completion_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`student_id`, `test_code`, `score_number`, `score_detail`, `completion_time`) VALUES
(2, 197949, '10', '1/1', '2021-11-13 21:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(1) NOT NULL,
  `detail` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`status_id`, `detail`) VALUES
(1, 'Mở'),
(2, 'Đóng'),
(3, 'Chờ Duyệt'),
(4, 'Đã Duyệt'),
(5, 'Cho Phép Xem Đáp Án'),
(6, 'Kết Thúc'),
(7, 'Ẩn');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` int(1) DEFAULT 3,
  `class_id` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `gender_id` int(1) NOT NULL DEFAULT 1,
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date NOT NULL,
  `doing_exam` int(11) DEFAULT NULL,
  `starting_time` datetime DEFAULT NULL,
  `time_remaining` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `username`, `email`, `password`, `name`, `permission`, `class_id`, `last_login`, `gender_id`, `avatar`, `birthday`, `doing_exam`, `starting_time`, `time_remaining`) VALUES
(2, 'student001', 'student001@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'student 001', 3, 1, '2021-11-13 21:59:58', 1, 'avatar-default.jpg', '2021-10-20', NULL, NULL, NULL),
(3, 'student002', 'student002@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'student 002', 3, 1, '0000-00-00 00:00:00', 2, 'avatar-default.jpg', '1997-01-30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_test_detail`
--

CREATE TABLE `student_test_detail` (
  `ID` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `test_code` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_a` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_b` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_c` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_d` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_answer` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `timest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_test_detail`
--

INSERT INTO `student_test_detail` (`ID`, `student_id`, `test_code`, `question_id`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `student_answer`, `timest`) VALUES
(625995385, 2, 197949, 3, '<p>k</p>', '<p>l</p>', '<p>j</p>', '<p>h</p>', '<p>k</p>', '2021-11-13 14:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_detail`) VALUES
(1, 'Toán'),
(2, 'Văn'),
(3, 'Anh'),
(4, 'Sinh'),
(5, 'Sử'),
(6, 'Địa'),
(7, 'Giáo dục công dân');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permission` int(1) DEFAULT 2,
  `last_login` datetime NOT NULL,
  `gender_id` int(1) NOT NULL DEFAULT 1,
  `avatar` varchar(255) DEFAULT 'avatar-default.jpg',
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `username`, `email`, `password`, `name`, `permission`, `last_login`, `gender_id`, `avatar`, `birthday`) VALUES
(1, 'teacher001', 'teacher001@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'teacher 001', 2, '2021-11-08 14:27:32', 1, 'avatar-default.jpg', '2000-12-14'),
(2, 'teacher002', 'teacher002@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'giáo viên 2', 2, '0000-00-00 00:00:00', 3, 'avatar-default.jpg', '1997-01-29'),
(3, 'teacher003', 'teacher003@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thị Phương Anh', 2, '0000-00-00 00:00:00', 2, 'avatar-default.jpg', '2000-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_code` int(11) NOT NULL,
  `test_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `grade_id` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `time_to_do` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `timest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_code`, `test_name`, `password`, `subject_id`, `grade_id`, `total_questions`, `time_to_do`, `note`, `status_id`, `timest`) VALUES
(124158, 'Thi thử Hóa THPT	', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 3, 1, '', 5, '2021-11-05 10:08:47'),
(197949, 'f', '', 1, 12, 1, 1, '', 5, '2021-11-09 00:46:46'),
(212063, 'Đề thi test 001', '', 1, 1, 1, 1, 'không nhé', 5, '2021-11-09 00:46:49'),
(258629, 'teacher001', 'e10adc3949ba59abbe56e057f20f883e', 1, 12, 5, 1, 'Các cháu làm bài nhanh lên nhé', 5, '2021-11-08 15:02:18'),
(562834, 'Thi thử Toán THPT', 'e10adc3949ba59abbe56e057f20f883e', 1, 12, 1, 10, 'KHÔNG', 5, '2021-11-05 09:47:26'),
(977537, 'abc', '', 1, 1, 3, 1, '', 5, '2021-11-12 06:43:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `n4` (`permission`),
  ADD KEY `admins_gender_id` (`gender_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`),
  ADD KEY `n7` (`teacher_id`),
  ADD KEY `k4` (`grade_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `k9` (`grade_id`),
  ADD KEY `unit` (`unit`),
  ADD KEY `subjects_key` (`subject_id`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `quest_of_test`
--
ALTER TABLE `quest_of_test`
  ADD PRIMARY KEY (`test_code`,`question_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `test_code` (`test_code`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`student_id`,`test_code`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `test_code` (`test_code`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `n9` (`class_id`),
  ADD KEY `n11` (`permission`),
  ADD KEY `students_gender_id` (`gender_id`);

--
-- Indexes for table `student_test_detail`
--
ALTER TABLE `student_test_detail`
  ADD PRIMARY KEY (`student_id`,`test_code`,`question_id`),
  ADD KEY `fk4` (`test_code`),
  ADD KEY `fk6` (`question_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `n2` (`permission`),
  ADD KEY `teachers_gender_id` (`gender_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_code`),
  ADD KEY `fk1` (`subject_id`),
  ADD KEY `fk2` (`status_id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- 
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=977538;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_gender_id` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`),
  ADD CONSTRAINT `n4` FOREIGN KEY (`permission`) REFERENCES `permissions` (`permission`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `k9` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`),
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `levels` (`level_id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `subjects_key` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `quest_of_test`
--
ALTER TABLE `quest_of_test`
  ADD CONSTRAINT `quest_of_test_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `quest_of_test_ibfk_2` FOREIGN KEY (`test_code`) REFERENCES `tests` (`test_code`);

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `scores_ibfk_2` FOREIGN KEY (`test_code`) REFERENCES `tests` (`test_code`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `n11` FOREIGN KEY (`permission`) REFERENCES `permissions` (`permission`),
  ADD CONSTRAINT `n9` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `students_gender_id` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`);

--
-- Constraints for table `student_test_detail`
--
ALTER TABLE `student_test_detail`
  ADD CONSTRAINT `fk4` FOREIGN KEY (`test_code`) REFERENCES `tests` (`test_code`),
  ADD CONSTRAINT `fk6` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`),
  ADD CONSTRAINT `fk9` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `n2` FOREIGN KEY (`permission`) REFERENCES `permissions` (`permission`),
  ADD CONSTRAINT `teachers_gender_id` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`gender_id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`),
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grades` (`grade_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
