-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 19, 2023 at 04:57 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sam`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE `allocations` (
  `allocation_id` varchar(200) NOT NULL,
  `allocation_asset_id` varchar(200) NOT NULL,
  `allocation_staff_id` varchar(200) NOT NULL,
  `allocation_department_staff_id` varchar(200) DEFAULT NULL,
  `allocation_request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `allocation_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `allocation_status` varchar(200) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allocations`
--

INSERT INTO `allocations` (`allocation_id`, `allocation_asset_id`, `allocation_staff_id`, `allocation_department_staff_id`, `allocation_request_date`, `allocation_date`, `allocation_status`) VALUES
('98453e23653567def9858b4bcbda5fb6d26d7c4c9165d7', 'c3f86a7f493226f5a28d2846a036ac00b5d53f507569a7', '6d3620e8b862a1802a9311187307fa4285455b9eaca695', 'bf990720395873a2d3fc6107a621aa68f7a3319b179ce7', '2023-08-19 07:10:26', '2023-08-19 07:11:57', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `assetdisposes`
--

CREATE TABLE `assetdisposes` (
  `assetdispose_id` int(200) NOT NULL,
  `assetdispose_asset_id` varchar(200) NOT NULL,
  `assetdispose_staff_id` varchar(200) NOT NULL,
  `assetdispose_method` varchar(200) NOT NULL,
  `assetdispose_reason` varchar(200) NOT NULL,
  `assetdispose_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assetdisposes`
--

INSERT INTO `assetdisposes` (`assetdispose_id`, `assetdispose_asset_id`, `assetdispose_staff_id`, `assetdispose_method`, `assetdispose_reason`, `assetdispose_date`) VALUES
(2, '3558af84145fa576b12735df915e4791743580a2097e4f', 'y54', 'Recycle', 'Null', '2023-08-19 06:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `asset_id` varchar(200) NOT NULL,
  `asset_allocation_id` varchar(200) DEFAULT NULL,
  `assetdispose_id` varchar(200) DEFAULT NULL,
  `asset_type_id` varchar(200) NOT NULL,
  `asset_name` varchar(200) NOT NULL,
  `asset_tag` varchar(200) NOT NULL,
  `asset_date_of_purchase` timestamp NOT NULL DEFAULT current_timestamp(),
  `asset_price` varchar(200) NOT NULL,
  `asset_details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_id`, `asset_allocation_id`, `assetdispose_id`, `asset_type_id`, `asset_name`, `asset_tag`, `asset_date_of_purchase`, `asset_price`, `asset_details`) VALUES
('3513b274fc7de4eb6d50bf914a70178f013248fd7e37e0', '', NULL, 'a222d68fc878ff8d89f251c49d6610fe7ced7f50d7b194', 'English Course form3', 'asset/9612/2023', '2023-06-30 14:11:33', '234', 'SGA'),
('3558af84145fa576b12735df915e4791743580a2097e4f', NULL, '2', 'a222d68fc878ff8d89f251c49d6610fe7ced7f50d7b194', 'Exercise book', 'asset/6721/2023', '2023-08-19 06:06:30', '20', 'Null'),
('c3f86a7f493226f5a28d2846a036ac00b5d53f507569a7', '98453e23653567def9858b4bcbda5fb6d26d7c4c9165d7', NULL, 'a222d68fc878ff8d89f251c49d6610fe7ced7f50d7b194', 'English Course form2', 'asset/3724/2023', '2023-06-30 13:44:08', '1500', 'DDDHGD'),
('c6ebc9042e1c1022d50bc0faa3e7f6a93ebd7ee4a85f1e', NULL, 'NULL', 'a222d68fc878ff8d89f251c49d6610fe7ced7f50d7b194', 'Form 3 Computer text book', 'asset/7391/2023', '2023-06-30 11:41:26', '233', 'dgds'),
('edd53ab103b5ed59c2124cd4a8845191db60c7b356a1f7', 'NULL', NULL, 'df4870b88536651902cda8e9eb941cba9daadc639f9f2b', 'School Bus ', 'asset/9260/2023', '2023-06-30 11:40:08', '2000', 'Scania Bus');

-- --------------------------------------------------------

--
-- Table structure for table `asset_types`
--

CREATE TABLE `asset_types` (
  `asset_type_id` varchar(200) NOT NULL,
  `asset_type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset_types`
--

INSERT INTO `asset_types` (`asset_type_id`, `asset_type_name`) VALUES
('a222d68fc878ff8d89f251c49d6610fe7ced7f50d7b194', 'Book'),
('df4870b88536651902cda8e9eb941cba9daadc639f9f2b', 'Vehicle');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` varchar(200) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `department_staff_id` varchar(200) NOT NULL,
  `department_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `department_staff_id`, `department_created_on`) VALUES
('4b6f66f75c2e0714640322218b5b22a018e993ada82b9d', 'Administration', 'y54', '2023-06-30 11:52:18'),
('531da79da24de232535f942878b29ee00301a1b03d9cb2', 'Mathematics', 'bf990720395873a2d3fc6107a621aa68f7a3319b179ce7', '2023-07-13 06:08:36'),
('80a126e5a23d3de5fa1ddcb2d94f82d59e96841842d185', 'English department', '6d3620e8b862a1802a9311187307fa4285455b9eaca695', '2023-08-03 07:49:00'),
('d24630e47fc26930197d9b45328770613069e3d04e0d24', 'Test', 'bf990720395873a2d3fc6107a621aa68f7a3319b179ce7', '2023-08-19 06:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_id` int(11) NOT NULL,
  `maintenance_asset_id` varchar(200) NOT NULL,
  `maintenance_type` varchar(200) NOT NULL,
  `maintenance_date` varchar(200) NOT NULL,
  `maintenance_status` varchar(200) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintenance_id`, `maintenance_asset_id`, `maintenance_type`, `maintenance_date`, `maintenance_status`) VALUES
(1, 'edd53ab103b5ed59c2124cd4a8845191db60c7b356a1f7', 'Repair', '2024-08-20', 'Cancelled'),
(2, 'edd53ab103b5ed59c2124cd4a8845191db60c7b356a1f7', 'Servicing', '2023-07-18', 'Active'),
(3, '3513b274fc7de4eb6d50bf914a70178f013248fd7e37e0', 'Servicing', '2023-08-20', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` varchar(200) NOT NULL,
  `staff_no` varchar(200) NOT NULL,
  `staff_first_name` varchar(200) NOT NULL,
  `staff_last_name` varchar(200) NOT NULL,
  `staff_email` varchar(200) NOT NULL,
  `staff_phone_no` varchar(13) DEFAULT NULL,
  `staff_password` varchar(200) NOT NULL,
  `staff_department_id` varchar(200) NOT NULL,
  `staff_status` varchar(200) NOT NULL DEFAULT 'Active',
  `staff_created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_no`, `staff_first_name`, `staff_last_name`, `staff_email`, `staff_phone_no`, `staff_password`, `staff_department_id`, `staff_status`, `staff_created_on`) VALUES
('0764015b8153cf0d1d1e6b83097ffb1fc2c2f0eec2f820', 'STF-3529', 'Staff', 'Two', 'stafftwo@mail.com', '0787766565', '$2y$10$4BMenBNhMZKZ5caXGkPji.VSfe7PjU86.MSP3P/0TLCB0lvGxKan6', '4b6f66f75c2e0714640322218b5b22a018e993ada82b9d', 'Active', '2023-06-30 11:54:45'),
('6d3620e8b862a1802a9311187307fa4285455b9eaca695', 'STF-9401', 'staff', 'five', 'stafffive@mail.com', '0798989834', '$2y$10$HNN5YB0dufpn/nIAvyUIbe.zFpuX5l/UvJHu4r1Vz/fCeUioNBlLC', '531da79da24de232535f942878b29ee00301a1b03d9cb2', 'Active', '2023-08-03 07:48:20'),
('80e002900484aa9947a8fdc3d37401b68b4a495020282b', 'STF-5713', 'Staff', 'four', 'stafffour@mail.com', '07897654234', '$2y$10$B.vJjGH1dRcvtZFxP7wKLu5aDt2X85ZPqSxCgtSjHYSnBbDF102x2', '531da79da24de232535f942878b29ee00301a1b03d9cb2', 'Active', '2023-07-17 03:02:10'),
('bf990720395873a2d3fc6107a621aa68f7a3319b179ce7', 'STF-0814', 'Staff ', '3', 'staffhod@mail.com', '023353333', '$2y$10$SX1xq/42baeah1FV6N0CTeOpdI1vfvZ/g8MPJhe81OrYOOgw90h.e', '531da79da24de232535f942878b29ee00301a1b03d9cb2', 'Active', '2023-07-13 06:10:26'),
('y54', '254', 'Admin', ' hod', 'staffone@mail.com', '07989898', '$2y$10$dv8yvl.Y3ZefzPtFIrDJ5.V5oOerOhULdlV/H4YYqHDawPUJ6Lgda', '4b6f66f75c2e0714640322218b5b22a018e993ada82b9d', 'Active', '2023-06-30 11:31:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocations`
--
ALTER TABLE `allocations`
  ADD PRIMARY KEY (`allocation_id`),
  ADD KEY `Staff` (`allocation_staff_id`),
  ADD KEY `DepartmentHeads` (`allocation_department_staff_id`),
  ADD KEY `Asset` (`allocation_asset_id`) USING BTREE;

--
-- Indexes for table `assetdisposes`
--
ALTER TABLE `assetdisposes`
  ADD PRIMARY KEY (`assetdispose_id`),
  ADD KEY `assetstaff` (`assetdispose_staff_id`),
  ADD KEY `Assetdisposes` (`assetdispose_asset_id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`asset_id`),
  ADD KEY `Allocation` (`asset_allocation_id`),
  ADD KEY `Assettype` (`asset_type_id`),
  ADD KEY `AssetDispose` (`assetdispose_id`);

--
-- Indexes for table `asset_types`
--
ALTER TABLE `asset_types`
  ADD PRIMARY KEY (`asset_type_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `DepartmentHead` (`department_staff_id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`),
  ADD KEY `AssetToMaintenance` (`maintenance_asset_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `Department` (`staff_department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assetdisposes`
--
ALTER TABLE `assetdisposes`
  MODIFY `assetdispose_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `maintenance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocations`
--
ALTER TABLE `allocations`
  ADD CONSTRAINT `Asset` FOREIGN KEY (`allocation_asset_id`) REFERENCES `assets` (`asset_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DepartmentHeads` FOREIGN KEY (`allocation_department_staff_id`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Staff` FOREIGN KEY (`allocation_staff_id`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assetdisposes`
--
ALTER TABLE `assetdisposes`
  ADD CONSTRAINT `assetstaff` FOREIGN KEY (`assetdispose_staff_id`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `Assettype` FOREIGN KEY (`asset_type_id`) REFERENCES `asset_types` (`asset_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `DepartmentHead` FOREIGN KEY (`department_staff_id`) REFERENCES `staffs` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `AssetToMaintenance` FOREIGN KEY (`maintenance_asset_id`) REFERENCES `assets` (`asset_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `Department` FOREIGN KEY (`staff_department_id`) REFERENCES `departments` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
