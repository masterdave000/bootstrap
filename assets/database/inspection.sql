-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 12:33 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inspection`
--

-- --------------------------------------------------------

--
-- Table structure for table `annual_inspection_certificate`
--

CREATE TABLE `annual_inspection_certificate` (
  `certificate_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `application_type` varchar(50) NOT NULL,
  `bin` varchar(100) DEFAULT NULL,
  `occupancy_no` varchar(50) NOT NULL,
  `date_complied` date NOT NULL,
  `issued_on` date DEFAULT NULL,
  `date_inspected` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `annual_inspection_certificate`
--

INSERT INTO `annual_inspection_certificate` (`certificate_id`, `bus_id`, `owner_id`, `application_type`, `bin`, `occupancy_no`, `date_complied`, `issued_on`, `date_inspected`) VALUES
(1, 2, 2, 'ANNUAL', 'N/A', 'N/A', '2024-05-09', '2024-05-04', '2024-05-10 13:58:22'),
(2, 8, 2, 'ANNUAL', 'N/A', 'N/A', '2024-05-08', '2024-05-10', '2024-05-12 19:33:00'),
(3, 8, 2, 'ANNUAL', 'N/A', 'N/A', '2024-05-07', '2024-05-11', '2024-05-12 19:35:11'),
(4, 8, 2, 'ANNUAL', 'N/A', 'N/A', '2024-05-08', '2024-05-11', '2024-05-12 19:37:15'),
(5, 8, 2, 'ANNUAL', 'N/A', 'N/A', '2024-05-09', '2024-05-10', '2024-05-12 19:43:56'),
(6, 8, 2, 'ANNUAL', 'N/A', 'N/A', '2024-05-08', '2024-05-10', '2024-05-12 19:51:06'),
(7, 8, 2, 'ANNUAL', 'N/A', 'N/A', '2020-02-23', '2020-02-23', '2024-05-12 20:04:22'),
(8, 8, 2, 'ANNUAL', 'N/A', 'N/A', '2020-02-23', '2020-02-23', '2024-05-12 20:09:20'),
(9, 9, 5, 'ANNUAL', 'N/A', 'N/A', '2022-02-20', '2002-02-20', '2024-05-12 22:15:32'),
(10, 9, 5, 'ANNUAL', 'N/A', 'N/A', '2024-05-08', '2024-05-09', '2024-05-13 16:32:32'),
(11, 8, 2, 'ANNUAL', '123', '12323', '2023-03-12', '2023-03-12', '2024-05-15 11:05:22'),
(12, 8, 2, 'ANNUAL', '123', '123', '0123-03-12', '0123-03-12', '2024-05-15 11:12:13'),
(13, 9, 5, 'ANNUAL', 'N/A', 'N/A', '2024-05-10', '2024-05-10', '2024-05-16 17:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `annual_inspection_certificate_inspector`
--

CREATE TABLE `annual_inspection_certificate_inspector` (
  `certificate_id` int(11) NOT NULL,
  `inspector_id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `date_signed` date NOT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `annual_inspection_certificate_inspector`
--

INSERT INTO `annual_inspection_certificate_inspector` (`certificate_id`, `inspector_id`, `category`, `date_signed`, `time_in`, `time_out`) VALUES
(1, 1, 'FIRE', '2024-05-10', '01:57:00', '01:57:00'),
(2, 2, 'ARCHITECTURAL', '2024-05-02', '07:33:00', '07:34:00'),
(3, 3, 'LINE AND GRADE (GEODETIC)', '2024-05-08', '07:40:00', '07:39:00'),
(4, 3, 'LINE AND GRADE (GEODETIC)', '2024-05-09', '07:41:00', '07:42:00'),
(5, 1, 'ARCHITECTURAL', '2024-05-10', '07:48:00', '07:49:00'),
(6, 1, 'LINE AND GRADE (GEODETIC)', '2024-05-09', '07:54:00', '07:56:00'),
(7, 5, 'LINE AND GRADE (GEODETIC)', '2024-05-08', '08:03:00', '08:09:00'),
(8, 5, 'LOCATIONAL/ZONING OF LAND USE', '2024-05-10', '08:13:00', '08:14:00'),
(9, 1, 'INTERIOR', '2002-02-23', '10:21:00', '10:15:00'),
(10, 2, 'ARCHITECTURAL', '2024-05-08', '04:35:00', '04:35:00'),
(11, 2, 'LOCATIONAL/ZONING OF LAND USE', '2024-05-02', '10:57:00', '10:59:00'),
(12, 2, 'LINE AND GRADE (GEODETIC)', '0123-03-12', '11:11:00', '11:13:00'),
(13, 3, 'ELECTRICAL', '2024-05-10', '04:20:00', '04:38:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `annual_inspection_certificate_view`
-- (See below for the actual view)
--
CREATE TABLE `annual_inspection_certificate_view` (
`certificate_id` int(11)
,`application_type` varchar(50)
,`bin` varchar(100)
,`bus_name` varchar(100)
,`bus_address` varchar(100)
,`character_of_occupancy` varchar(100)
,`occupancy_group` varchar(50)
,`bus_img_url` varchar(50)
,`occupancy_no` varchar(50)
,`issued_on` date
,`owner_firstname` varchar(100)
,`owner_midname` varchar(100)
,`owner_lastname` varchar(100)
,`owner_suffix` varchar(10)
,`inspector_firstname` varchar(100)
,`inspector_midname` varchar(100)
,`inspector_lastname` varchar(100)
,`inspector_suffix` varchar(100)
,`category` varchar(100)
,`date_signed` date
,`time_in` time
,`time_out` time
,`date_complied` date
,`date_inspected` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `building_billing`
--

CREATE TABLE `building_billing` (
  `bldg_billing_id` int(11) NOT NULL,
  `bldg_section` varchar(100) NOT NULL,
  `bldg_property_attribute` varchar(100) NOT NULL,
  `bldg_fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `building_billing`
--

INSERT INTO `building_billing` (`bldg_billing_id`, `bldg_section`, `bldg_property_attribute`, `bldg_fee`) VALUES
(1, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Appendage of up to 3.00 cu. meters/unit', '150.00'),
(2, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Floor area to 100.00 sq. meters', '120.00'),
(3, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Above 100.00 sq. meters up to 200.00 sq. meters', '240.00'),
(4, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Above 200.00 sq. meters up to 350.00 sq. meters', '80.00'),
(5, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Above 350.00 sq. meters up to 500.00 sq. meters', '720.00'),
(6, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Above 500.00 sq. meters up to 700.00 sq. meters', '960.00'),
(7, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Above 700.00 sq. meters up to 1,000.00 sq. meters', '1200.00'),
(8, 'Division B-1/D-1, 2, 3/E-1, 2, 3/F-1/G-1, 2, 3, 4, 5/H-1, 2, 3, 4/ and I-1, Commercial, Industrial I', 'Every 1,000.00 sq. meters or 1,000.00 sq. meters', '1200.00'),
(9, 'Divisions C-1, 2, Amusement Houses, and Gymnasia', 'First class cinematographs or theaters', '1200.00'),
(10, 'Divisions C-1, 2, Amusement Houses, and Gymnasia', 'Second class cinematographs or theaters', '720.00'),
(11, 'Divisions C-1, 2, Amusement Houses, and Gymnasia', 'Third class cinematographs or theaters', '520.00'),
(12, 'Divisions C-1, 2, Amusement Houses, and Gymnasia', 'Grandstands/Bleachers, Gymnasia and the like', '720.00');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `bus_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `occupancy_classification_id` int(11) NOT NULL,
  `bus_name` varchar(100) NOT NULL,
  `bus_address` varchar(100) NOT NULL,
  `bus_type` varchar(50) DEFAULT NULL,
  `bus_contact_number` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `floor_area` double DEFAULT NULL,
  `signage_area` double DEFAULT NULL,
  `bus_img_url` varchar(50) DEFAULT 'no-image.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`bus_id`, `owner_id`, `occupancy_classification_id`, `bus_name`, `bus_address`, `bus_type`, `bus_contact_number`, `email`, `floor_area`, `signage_area`, `bus_img_url`) VALUES
(8, 2, 3, 'Healthcare', 'Esperanza Sultan Kudarat', 'Food And Beverage', '09345345345', 'dasdasdas@fsdf.com', 500, 50, 'no-image.png'),
(9, 5, 5, 'Diyata Pares Overload', 'Lagao National High School', 'Food And Beverage', '09511704535', 'johnpaul.borja@msugensan.edu.ph', 500, 30, 'Diyata Pares Overload(05-12-2024).png'),
(11, 1, 5, 'Chicken Hauz', 'Esperanza Sultan Kudarat', 'Food And Beverage', '09123123123', 'davepanizal@gmail.com', 500, 50, 'no-image.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `business_view`
-- (See below for the actual view)
--
CREATE TABLE `business_view` (
`bus_id` int(11)
,`owner_id` int(11)
,`occupancy_classification_id` int(11)
,`bus_name` varchar(100)
,`bus_address` varchar(100)
,`bus_type` varchar(50)
,`bus_contact_number` varchar(11)
,`character_of_occupancy` varchar(100)
,`occupancy_group` varchar(50)
,`email` varchar(50)
,`floor_area` double
,`signage_area` double
,`bus_img_url` varchar(50)
,`owner_firstname` varchar(100)
,`owner_midname` varchar(100)
,`owner_lastname` varchar(100)
,`owner_suffix` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_img_url` varchar(50) NOT NULL DEFAULT 'default-img.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`category_id`, `category_name`, `category_img_url`) VALUES
(1, 'Mechanical', 'default-img.png'),
(2, 'Electronics', 'default-img.png'),
(3, 'Electrical', 'default-img.png');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_billing`
--

CREATE TABLE `equipment_billing` (
  `billing_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `capacity` varchar(100) DEFAULT NULL,
  `fee` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_billing`
--

INSERT INTO `equipment_billing` (`billing_id`, `category_id`, `section`, `capacity`, `fee`) VALUES
(1, 1, 'Mechanical Ventilation', '5 kVA or less', '50.00'),
(2, 2, 'Central Office switching equipment, remote switching units, etc.', NULL, '2.40'),
(3, 1, 'Refrigeration and Ice Plant', 'Up to 100 tons capacity', '25.00'),
(4, 1, 'Refrigeration and Ice Plant', 'Above 100 tons up to 150 tons', '20.00'),
(5, 1, 'Refrigeration and Ice Plant', 'Above 150 tons up to 300 tons', '15.00'),
(6, 1, 'Refrigeration and Ice Plant', 'Every ton or fraction thereof above 500 tons', '5.00'),
(7, 1, 'Air Conditioning Systems', 'Window type air conditions, per unit', '40.00'),
(8, 1, 'Packaged or Centralized Air Conditioning Systems', 'First 100 tons, per ton capacity', '25.00'),
(9, 1, 'Packaged or Centralized Air Conditioning Systems', 'Above 100 tons, up to 150 tons per ton capacity', '20.00'),
(10, 1, 'Packaged or Centralized Air Conditioning Systems', 'Every ton or fraction thereof above 500 tons', '8.00'),
(11, 1, 'Escalators and Moving Walks', 'Escalator and Moving Walks, per unit', '120.00'),
(12, 1, 'Escalators and Moving Walks', 'Funiculars, per kW or fraction thereof', '50.00'),
(13, 1, 'Escalators and Moving Walks', 'Per lineal meter or fraction thereof', '10.00'),
(14, 1, 'Escalators and Moving Walks', 'Cable Car, per kW or fraction thereof', '25.00'),
(15, 1, 'Escalators and Moving Walks', 'Per lineal meter of travel', '2.00'),
(16, 1, 'Elevators', 'Passenger elevators', '500.00'),
(17, 1, 'Elevators', 'Freight elevators', '400.00'),
(18, 1, 'Elevators', 'Motor driven dumbwaiters', '50.00'),
(19, 1, 'Elevators', 'Construction elevators for materials', '400.00'),
(20, 1, 'Elevators', 'Car elevators', '500.00'),
(21, 1, 'Elevators', 'Every landing above first five (5) landing for all the above elevators', '50.00'),
(22, 1, 'Boilers', 'Up to 7.5 kW', '400.00'),
(23, 1, 'Boilers', '7.5 kW up to 22 kW', '550.00'),
(24, 1, 'Boilers', '22 kW up to 37 kW', '600.00'),
(25, 1, 'Boilers', '37 kW up to 52 kW', '650.00'),
(26, 1, 'Boilers', '52 kW up to 67 kW', '800.00'),
(27, 1, 'Boilers', '67 kW up to 74 kW', '900.00'),
(28, 1, 'Boilers', 'Every kW or fraction thereof above 74 kW', '4.00'),
(29, 1, 'Mechanical Ventilation', 'Up to 1 kW', '10.00'),
(30, 1, 'Mechanical Ventilation', 'Above 1kW to 7.5kW', '50.00'),
(31, 1, 'Mechanical Ventilation', 'Every kW above 7.5kW', '20.00'),
(32, 1, 'Pressurized Water Heaters', 'Pressurized Water Heaters, per unit', '120.00'),
(33, 1, 'Automatic Fire Extinguishers', 'per sprinkler head', '2.00'),
(34, 1, 'Water, Sump, and Sewage Pumps', 'Up to 5 kW', '55.00'),
(35, 1, 'Water, Sump, and Sewage Pumps', 'Above 5 kW to 10 kW', '90.00'),
(36, 1, 'Water, Sump, and Sewage Pumps', 'Every kW or fraction thereof above 10 kW', '2.00'),
(37, 1, 'Diesel/Gasoline Internal Combustion Engine', 'Per kW, up to 50 kW', '15.00'),
(38, 1, 'Diesel/Gasoline Internal Combustion Engine', 'Above 50 kW up to 100 kW', '10.00'),
(39, 1, 'Diesel/Gasoline Internal Combustion Engine', 'Every kW or fraction thereof above 100 kW', '2.40'),
(40, 1, 'Compressed Air, Vacuum', 'per outlet', '10.00'),
(41, 1, 'Power Piping', 'Per lineal meter or fraction thereof or per cu. meter or fraction thereof, whichever is higher', '2.00'),
(42, 1, 'Other Internal Combustion Engines', 'per unit, up to 10 kW', '100.00'),
(43, 1, 'Other Internal Combustion Engines', 'Every kW above 10 kW', '3.00'),
(44, 1, 'Other Machineries and/or Equipment', 'Up to ½ kW', '8.00'),
(45, 1, 'Other Machineries and/or Equipment', 'Above ½ kW up to 1 kW', '23.00'),
(46, 1, 'Other Machineries and/or Equipment', 'Above 1 kW up to 3 kW', '39.00'),
(47, 1, 'Other Machineries and/or Equipment', 'above 3 kW up to 5 kW', '55.00'),
(48, 1, 'Other Machineries and/or Equipment', 'Above 5 kW to 10 kW', '80.00'),
(49, 1, 'Other Machineries and/or Equipment', 'Every kW above 10 kW or fraction thereof', '4.00'),
(50, 1, 'Pressure Vessels', 'per cu. meter or fraction thereof', '40.00'),
(51, 1, 'Pnuematic Tubes, Conveyors, Monorails', 'per lineal meter or fraction thereof', '2.40'),
(52, 1, 'Weighing Scale Structure', 'per ton or fraction thereof', '30.00'),
(53, 1, 'Testing of Pressure Gauge', 'Testing/Calibration of pressure gauge, per unit', '24.00'),
(54, 1, 'Testing of Pressure Gauge', 'Each Gas Meter, tested, proved and sealed, per gas meter', '30.00'),
(55, 1, 'Every Mechanical Rider Inspection', 'per unit', '30.00'),
(56, 2, 'Broadcast Station for Radion and TV', NULL, '1000.00'),
(57, 2, 'Automated Teller Machines, Ticketing,Vending, etc.', NULL, '10.00'),
(58, 2, 'ELectronics and Communications Outlets, etc.', NULL, '2.40'),
(59, 2, 'Station/Terminal/Control, etc.', NULL, '2.40'),
(60, 2, 'Studios, Auditoriums, Theaters, etc.', NULL, '1000.00'),
(61, 2, 'Antenna Towers/Masts or Other Structures for Installation', NULL, '1000.00'),
(62, 2, 'Electronic or Electronically-COntrolled Indoors and Outdoor Signages', NULL, '50.00'),
(64, 3, 'Total Transformer / Uninterrupted Power Supply', '5 kVA or less', '40.00'),
(65, 3, 'Pole/Attachment Location Plan Permit', 'Power Supply Pole Location', '30.00'),
(66, 3, 'Pole/Attachment Location Plan Permit', 'Guying Attachment', '30.00'),
(67, 3, 'Miscellaneous Fees', 'Residential Electric Meter', '15.00'),
(68, 3, 'Total Connected Load', '5 kVA or less', '200.00'),
(69, 3, 'Total Connected Load', 'Over 5 kVa to 50kVa', '200.00'),
(70, 3, 'Total Connected Load', 'Over 50 kVA to 300 kVA', '1100.00'),
(71, 3, 'Total Connected Load', 'Over 300 kVA to 1,500 kVA', '3600.00'),
(72, 3, 'Total Connected Load', 'Over 1,500 kVA to 6,000 kVA', '9600.00'),
(73, 3, 'Total Connected Load', 'Over 6,000 kVA', '20850.00'),
(74, 3, 'Total Transformer / Uninterrupted Power Supply', 'Over 5 kVa to 50kVa', '40.00'),
(75, 3, 'Total Transformer / Uninterrupted Power Supply', 'Over 50 kVA to 300 kVA', '220.00'),
(76, 3, 'Total Transformer / Uninterrupted Power Supply', 'Over 300 kVA to 1,500 kVA', '720.00'),
(77, 3, 'Total Transformer / Uninterrupted Power Supply', 'Over 1,500 kVA to 6,000 kVA', '1920.00'),
(78, 3, 'Total Transformer / Uninterrupted Power Supply', 'Over 6,000 kVA', '4170.00'),
(79, 3, 'Miscellaneous Fees', 'Residential Wiring Permit Issuance', '15.00'),
(80, 3, 'Miscellaneous Fees', 'Commercial/Industrial Electrical Meter', '60.00'),
(81, 3, 'Miscellaneous Fees', 'Commercial/Industrial Wiring Permit Issuance', '36.00'),
(82, 3, 'Miscellaneous Fees', 'Institutional Electric Meter', '30.00'),
(83, 3, 'Miscellaneous Fees', 'Institutional Wiring Permit Issuance', '12.00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `equipment_billing_view`
-- (See below for the actual view)
--
CREATE TABLE `equipment_billing_view` (
`billing_id` int(11)
,`category_id` int(11)
,`category_name` varchar(100)
,`section` varchar(100)
,`capacity` varchar(100)
,`fee` decimal(11,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `inspection_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `signage_id` int(11) NOT NULL,
  `bldg_billing_id` int(11) NOT NULL,
  `application_type` varchar(50) NOT NULL DEFAULT 'Annual',
  `remarks` varchar(50) NOT NULL,
  `date_inspected` datetime NOT NULL DEFAULT current_timestamp(),
  `date_signed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspection`
--

INSERT INTO `inspection` (`inspection_id`, `owner_id`, `bus_id`, `signage_id`, `bldg_billing_id`, `application_type`, `remarks`, `date_inspected`, `date_signed`) VALUES
(1, 1, 1, 1, 1, 'Annual', 'No Violation', '2024-05-09 22:07:56', '0000-00-00 00:00:00'),
(2, 1, 1, 1, 1, 'New', 'No Violation', '2024-05-09 22:09:56', '0000-00-00 00:00:00'),
(3, 1, 1, 3, 6, 'Annual', 'With Violation', '2024-05-10 13:24:30', '0000-00-00 00:00:00'),
(4, 3, 3, 3, 8, 'Annual', 'With Violation', '2024-05-10 14:15:49', '0000-00-00 00:00:00'),
(5, 3, 3, 7, 5, 'Annual', 'With Violation', '2024-05-10 20:26:17', '0000-00-00 00:00:00'),
(7, 2, 8, 2, 7, 'Annual', 'With Violation', '2024-05-12 19:26:52', '0000-00-00 00:00:00'),
(8, 5, 9, 2, 5, 'Annual', 'With Violation', '2024-05-12 22:12:08', '0000-00-00 00:00:00'),
(9, 5, 9, 3, 5, 'Annual', 'With Violation', '2024-05-12 22:29:52', '0000-00-00 00:00:00'),
(10, 5, 9, 4, 4, 'Annual', 'With Violation', '2024-05-12 22:59:56', '0000-00-00 00:00:00'),
(11, 2, 8, 3, 2, 'Annual', 'With Violation', '2024-05-13 12:22:12', '0000-00-00 00:00:00'),
(12, 5, 9, 2, 4, 'Annual', 'No Violation', '2024-05-16 00:34:15', '0000-00-00 00:00:00'),
(13, 5, 9, 2, 6, 'Annual', 'With Violation', '2024-05-16 17:36:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_inspector`
--

CREATE TABLE `inspection_inspector` (
  `inspector_id` int(11) NOT NULL,
  `inspection_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspection_inspector`
--

INSERT INTO `inspection_inspector` (`inspector_id`, `inspection_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(1, 3),
(2, 3),
(5, 4),
(4, 4),
(3, 4),
(4, 5),
(3, 5),
(1, 7),
(3, 8),
(2, 8),
(4, 8),
(4, 9),
(3, 9),
(5, 9),
(3, 10),
(5, 10),
(2, 11),
(1, 11),
(4, 12),
(3, 13),
(4, 13),
(1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_item`
--

CREATE TABLE `inspection_item` (
  `inspection_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `power_rating` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `fee` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspection_item`
--

INSERT INTO `inspection_item` (`inspection_id`, `item_id`, `billing_id`, `power_rating`, `quantity`, `fee`) VALUES
(1, 1, 1, '4.00', 1, '50.00'),
(2, 2, 2, '2.00', 1, '2.40'),
(3, 14, 33, '0.00', 6, '12.00'),
(3, 7, 2, '0.00', 4, '9.60'),
(3, 9, 6, '501', 4, '20.00'),
(4, 7, 2, '0.00', 1, '2.40'),
(4, 4, 1, '0.00', 5, '250.00'),
(5, 14, 33, '0.00', 1, '2.00'),
(7, 5, 30, '6.00', 2, '100.00'),
(8, 14, 33, '1.04', 6, '12.00'),
(8, 5, 31, '8.00', 5, '100.00'),
(9, 1, 29, '3', 1, '10.00'),
(10, 14, 33, '0.00', 2, '4.00'),
(10, 11, 5, '0.00', 1, '15.00'),
(11, 14, 33, '10.00', 1, '2.00'),
(12, 10, 4, '100.00', 1, '20.00'),
(13, 10, 5, '160', 2, '30.00'),
(13, 5, 30, '2.00', 1, '50.00'),
(13, 7, 2, '0.00', 1, '2.40');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_sanitary_billing`
--

CREATE TABLE `inspection_sanitary_billing` (
  `inspection_id` int(11) NOT NULL,
  `sanitary_id` int(11) NOT NULL,
  `sanitary_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspection_sanitary_billing`
--

INSERT INTO `inspection_sanitary_billing` (`inspection_id`, `sanitary_id`, `sanitary_quantity`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 3),
(4, 1, 1),
(5, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `inspection_view`
-- (See below for the actual view)
--
CREATE TABLE `inspection_view` (
`inspection_id` int(11)
,`bus_id` int(11)
,`inspector_id` int(11)
,`owner_firstname` varchar(100)
,`owner_midname` varchar(100)
,`owner_lastname` varchar(100)
,`owner_suffix` varchar(10)
,`bus_name` varchar(100)
,`bus_type` varchar(50)
,`bus_address` varchar(100)
,`bus_contact_number` varchar(11)
,`floor_area` double
,`signage_area` double
,`bldg_section` varchar(100)
,`bldg_property_attribute` varchar(100)
,`bldg_fee` decimal(10,2)
,`display_type` varchar(100)
,`sign_type` varchar(100)
,`signage_fee` decimal(10,2)
,`sanitary_section` varchar(100)
,`sanitary_quantity` int(11)
,`sanitary_fee` decimal(11,2)
,`application_type` varchar(50)
,`power_rating` varchar(100)
,`item_name` varchar(100)
,`category_name` varchar(100)
,`section` varchar(100)
,`capacity` varchar(100)
,`quantity` int(11)
,`fee` decimal(11,2)
,`inspector_firstname` varchar(100)
,`inspector_midname` varchar(100)
,`inspector_lastname` varchar(100)
,`inspector_suffix` varchar(100)
,`description` varchar(100)
,`remarks` varchar(50)
,`bus_img_url` varchar(50)
,`date_inspected` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `inspection_violation`
--

CREATE TABLE `inspection_violation` (
  `inspection_id` int(11) NOT NULL,
  `violation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspection_violation`
--

INSERT INTO `inspection_violation` (`inspection_id`, `violation_id`) VALUES
(3, 10),
(4, 3),
(4, 10),
(5, 3),
(7, 12),
(8, 15),
(8, 7),
(8, 26),
(9, 15),
(10, 12),
(11, 15),
(13, 26);

-- --------------------------------------------------------

--
-- Table structure for table `inspector`
--

CREATE TABLE `inspector` (
  `inspector_id` int(11) NOT NULL,
  `inspector_firstname` varchar(100) NOT NULL,
  `inspector_midname` varchar(100) DEFAULT NULL,
  `inspector_lastname` varchar(100) NOT NULL,
  `inspector_suffix` varchar(100) DEFAULT NULL,
  `contact_number` varchar(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `inspector_img_url` varchar(100) DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inspector`
--

INSERT INTO `inspector` (`inspector_id`, `inspector_firstname`, `inspector_midname`, `inspector_lastname`, `inspector_suffix`, `contact_number`, `email`, `inspector_img_url`) VALUES
(1, 'Dave', 'F', 'Panizal', 'Jr', '09345345345', 'davepanizal@gmail.com', 'default.png'),
(2, 'Blessie', 'B', 'Hernandez', 'Jr', '09345345345', 'dasdasdas@fsdf.com', 'default.png'),
(3, 'Ja', '', 'Morant', '', '09111111111', 'jamorant@bibiana.com', 'default.png'),
(4, 'Lexi', '', 'Lore', '', '09222222222', 'lexilore@caap.com', 'default.png'),
(5, 'Emmanuel', 'T.', 'Awayan', '', '09444444444', 'eta@obo.com', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL,
  `img_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`item_id`, `category_id`, `item_name`, `section`, `img_url`) VALUES
(1, 1, 'Electric Fan', 'Mechanical Ventilation', 'default-img.png'),
(2, 2, 'Telephone', 'Central Office switching equipment, remote switching units, etc.', 'default-img.png'),
(3, 1, 'Fan', 'Mechanical Ventilation', 'default-img.png'),
(4, 1, 'Wall Fan', 'Mechanical Ventilation', 'default-img.png'),
(5, 1, 'Ceiling Fan', 'Mechanical Ventilation', 'default-img.png'),
(6, 1, 'Stand Fan', 'Mechanical Ventilation', 'default-img.png'),
(7, 2, 'Intercom', 'Central Office switching equipment, remote switching units, etc.', 'default-img.png'),
(8, 2, 'Telefax', 'Central Office switching equipment, remote switching units, etc.', 'default-img.png'),
(9, 1, 'Refrigerator', 'Refrigeration and Ice Plant', 'default-img.png'),
(10, 1, 'Freezer', 'Refrigeration and Ice Plant', 'default-img.png'),
(11, 1, 'Chiller', 'Refrigeration and Ice Plant', 'default-img.png'),
(12, 1, 'Water Dispenser', 'Refrigeration and Ice Plant', 'default-img.png'),
(13, 1, 'Pressurized Water Heaters', 'Pressurized Water Heaters', 'default-img.png'),
(14, 1, 'Automatic Fire Sprinkler System', 'Automatic Fire Extinguishers', 'default-img.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `item_view`
-- (See below for the actual view)
--
CREATE TABLE `item_view` (
`item_id` int(11)
,`item_name` varchar(100)
,`category_name` varchar(100)
,`section` varchar(100)
,`img_url` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `occupancy_classification`
--

CREATE TABLE `occupancy_classification` (
  `occupancy_classification_id` int(11) NOT NULL,
  `character_of_occupancy` varchar(100) NOT NULL,
  `occupancy_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `occupancy_classification`
--

INSERT INTO `occupancy_classification` (`occupancy_classification_id`, `character_of_occupancy`, `occupancy_group`) VALUES
(1, 'Residential Dwellings', 'Group A'),
(2, 'Residentials, Hotels, and Apartments', 'Group B'),
(3, 'Education and Recreation', 'Group C'),
(4, 'Institutional', 'Group D'),
(5, 'Business and Mercantile', 'Group E'),
(6, 'Industrial', 'Group F'),
(7, 'Storage and Hazardous', 'Group G'),
(8, 'Assembly Other Than Group I', 'Group H'),
(9, 'Assembly Occupant Load 1000 or More', 'Group I');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `owner_firstname` varchar(100) NOT NULL,
  `owner_midname` varchar(100) DEFAULT NULL,
  `owner_lastname` varchar(100) NOT NULL,
  `owner_suffix` varchar(10) DEFAULT NULL,
  `contact_number` varchar(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `owner_img_url` varchar(45) NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `owner_firstname`, `owner_midname`, `owner_lastname`, `owner_suffix`, `contact_number`, `email`, `owner_img_url`) VALUES
(1, 'Mateo', 'C', 'Panizal', '', '09345345345', 'davepanizal@gmail.com', 'default.png'),
(2, 'Salome', 'F.', 'Salve', '', '09345345345', 'dasdasdas@fsdf.com', 'default.png'),
(3, 'Nick', '', 'Brown', '', '09333333333', 'nickbrown@hunghong.com', 'default.png'),
(4, 'Lkdfijglfkrg', 'Erty', '1rtyy', 'Ryet', 'tryurt', 'dslkfjskdfjskj@yahoo.com', 'default.png'),
(5, 'John Paul', 'Pares', 'Overload', 'Jr', '09511704535', 'johnpaul.borja@msugensan.edu.ph', 'default.png'),
(6, 'Noelyn', 'Kadalum', 'Pananggilan', '', '09319744374', 'noelynpananggilan23@gmail.com', 'Pananggilan-Noelyn(05-14-2024).png');

-- --------------------------------------------------------

--
-- Table structure for table `sanitary_billing`
--

CREATE TABLE `sanitary_billing` (
  `sanitary_id` int(11) NOT NULL,
  `sanitary_section` varchar(100) NOT NULL,
  `sanitary_fee` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanitary_billing`
--

INSERT INTO `sanitary_billing` (`sanitary_id`, `sanitary_section`, `sanitary_fee`) VALUES
(1, 'Plumbing', '60.00');

-- --------------------------------------------------------

--
-- Table structure for table `signage_billing`
--

CREATE TABLE `signage_billing` (
  `signage_id` int(11) NOT NULL,
  `display_type` varchar(100) NOT NULL,
  `sign_type` varchar(100) NOT NULL,
  `signage_fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signage_billing`
--

INSERT INTO `signage_billing` (`signage_id`, `display_type`, `sign_type`, `signage_fee`) VALUES
(1, 'Neon', 'Business Signs', '124.00'),
(2, 'Neon', 'Advertising Signs', '200.00'),
(3, 'Illuminated', 'Business Signs', '72.00'),
(4, 'Illuminated', 'Advertising Signs', '150.00'),
(5, 'Painted-on', 'Business Signs', '30.00'),
(6, 'Painted-on', 'Advertising Signs', '100.00'),
(7, 'Others', 'Business Signs', '40.00'),
(8, 'Others', 'Advertising Signs', '110.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `inspector_id`, `username`, `password`, `role`) VALUES
(1, NULL, 'administrator', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator'),
(2, 1, 'inspector', '81dc9bdb52d04dc20036dbd8313ed055', 'Inspector'),
(3, 3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Inspector');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_view`
-- (See below for the actual view)
--
CREATE TABLE `user_view` (
`user_id` int(11)
,`inspector_id` int(11)
,`inspector_firstname` varchar(100)
,`inspector_midname` varchar(100)
,`inspector_lastname` varchar(100)
,`inspector_suffix` varchar(100)
,`username` varchar(100)
,`role` varchar(20)
,`password` varchar(255)
,`inspector_img_url` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `violation`
--

CREATE TABLE `violation` (
  `violation_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `violation`
--

INSERT INTO `violation` (`violation_id`, `description`) VALUES
(1, 'Occupying Arcade'),
(2, 'Occupying RROW'),
(3, 'No Certificate of Occupancy'),
(4, 'No Renovation Permit'),
(5, 'Non-display of Certificate of Occupancy'),
(6, 'No facilities for PWD ( □ Ramp □ Grab Bar- CR/Main Entrance □ Door □ Railings)'),
(7, 'GAD Code Compliance (□ Separate CR for Man & Woman □ Common CR w/ Urinal □ Common CR w/o Urinal □ No'),
(8, 'Non-renewal of Sign Permit (Billboard/Signboard)'),
(9, 'No Sign Permit'),
(10, 'No Building Permit'),
(11, 'Required Structural Stability Report & Certificate'),
(12, 'Dilapidated building components (specify) ( □ Truss □ Column □ Beam □ Roof □ Wall □ Ceiling □ Floori'),
(13, 'Earthquake Recording Instrumentation (ERI)'),
(14, 'No Electrical Permit'),
(15, 'Abnormal temperature of circuit breaker'),
(16, 'Using sub-standard wires'),
(17, 'Unsafe Electrical Installation'),
(18, 'Submit As-Built Electrical Plan with Design Analysis including Voltage Drop & Short Circuit calculat'),
(19, 'Certificate of Electrical Safety'),
(20, 'No Mechanical Permit'),
(21, 'No safety belts of exposed LPG tanks'),
(22, 'Moving parts of mechanical machineries not enclosed'),
(23, 'Standard Height for Window- Type ACU (2.10m from the FL) not observed'),
(24, 'No Sanitary/Plumbing Permit'),
(25, 'Clogged Drains/Water Closets'),
(26, 'Leaking Pipes & Fixtures'),
(27, 'Out of Order CR/No CR'),
(28, 'Fire Exit (Obstructed/Inaccessible/Non-Existent/Not Illuminated)'),
(29, 'Fire Exit Ladder (Sub-standard/Dilapidated)'),
(30, 'No/Sub-standard Fire Exit Signs'),
(31, 'No Electronics Permit (□ Computers □ Printers □ CCTV □ Telephone)');

-- --------------------------------------------------------

--
-- Structure for view `annual_inspection_certificate_view`
--
DROP TABLE IF EXISTS `annual_inspection_certificate_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `annual_inspection_certificate_view`  AS SELECT `aic`.`certificate_id` AS `certificate_id`, `aic`.`application_type` AS `application_type`, `aic`.`bin` AS `bin`, `b`.`bus_name` AS `bus_name`, `b`.`bus_address` AS `bus_address`, `oc`.`character_of_occupancy` AS `character_of_occupancy`, `oc`.`occupancy_group` AS `occupancy_group`, `b`.`bus_img_url` AS `bus_img_url`, `aic`.`occupancy_no` AS `occupancy_no`, `aic`.`issued_on` AS `issued_on`, `o`.`owner_firstname` AS `owner_firstname`, `o`.`owner_midname` AS `owner_midname`, `o`.`owner_lastname` AS `owner_lastname`, `o`.`owner_suffix` AS `owner_suffix`, `i`.`inspector_firstname` AS `inspector_firstname`, `i`.`inspector_midname` AS `inspector_midname`, `i`.`inspector_lastname` AS `inspector_lastname`, `i`.`inspector_suffix` AS `inspector_suffix`, `aici`.`category` AS `category`, `aici`.`date_signed` AS `date_signed`, `aici`.`time_in` AS `time_in`, `aici`.`time_out` AS `time_out`, `aic`.`date_complied` AS `date_complied`, `aic`.`date_inspected` AS `date_inspected` FROM (((((`annual_inspection_certificate` `aic` left join `business` `b` on(`aic`.`bus_id` = `b`.`bus_id`)) left join `occupancy_classification` `oc` on(`b`.`occupancy_classification_id` = `oc`.`occupancy_classification_id`)) left join `owner` `o` on(`aic`.`owner_id` = `o`.`owner_id`)) left join `annual_inspection_certificate_inspector` `aici` on(`aic`.`certificate_id` = `aici`.`certificate_id`)) left join `inspector` `i` on(`aici`.`inspector_id` = `i`.`inspector_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `business_view`
--
DROP TABLE IF EXISTS `business_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `business_view`  AS SELECT `bus`.`bus_id` AS `bus_id`, `o`.`owner_id` AS `owner_id`, `oc`.`occupancy_classification_id` AS `occupancy_classification_id`, `bus`.`bus_name` AS `bus_name`, `bus`.`bus_address` AS `bus_address`, `bus`.`bus_type` AS `bus_type`, `bus`.`bus_contact_number` AS `bus_contact_number`, `oc`.`character_of_occupancy` AS `character_of_occupancy`, `oc`.`occupancy_group` AS `occupancy_group`, `bus`.`email` AS `email`, `bus`.`floor_area` AS `floor_area`, `bus`.`signage_area` AS `signage_area`, `bus`.`bus_img_url` AS `bus_img_url`, `o`.`owner_firstname` AS `owner_firstname`, `o`.`owner_midname` AS `owner_midname`, `o`.`owner_lastname` AS `owner_lastname`, `o`.`owner_suffix` AS `owner_suffix` FROM ((`business` `bus` left join `owner` `o` on(`bus`.`owner_id` = `o`.`owner_id`)) left join `occupancy_classification` `oc` on(`bus`.`occupancy_classification_id` = `oc`.`occupancy_classification_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `equipment_billing_view`
--
DROP TABLE IF EXISTS `equipment_billing_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `equipment_billing_view`  AS SELECT `b`.`billing_id` AS `billing_id`, `c`.`category_id` AS `category_id`, `c`.`category_name` AS `category_name`, `b`.`section` AS `section`, `b`.`capacity` AS `capacity`, `b`.`fee` AS `fee` FROM (`equipment_billing` `b` left join `category_list` `c` on(`b`.`category_id` = `c`.`category_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `inspection_view`
--
DROP TABLE IF EXISTS `inspection_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inspection_view`  AS SELECT `i`.`inspection_id` AS `inspection_id`, `b`.`bus_id` AS `bus_id`, `iins`.`inspector_id` AS `inspector_id`, `o`.`owner_firstname` AS `owner_firstname`, `o`.`owner_midname` AS `owner_midname`, `o`.`owner_lastname` AS `owner_lastname`, `o`.`owner_suffix` AS `owner_suffix`, `b`.`bus_name` AS `bus_name`, `b`.`bus_type` AS `bus_type`, `b`.`bus_address` AS `bus_address`, `b`.`bus_contact_number` AS `bus_contact_number`, `b`.`floor_area` AS `floor_area`, `b`.`signage_area` AS `signage_area`, `bb`.`bldg_section` AS `bldg_section`, `bb`.`bldg_property_attribute` AS `bldg_property_attribute`, `bb`.`bldg_fee` AS `bldg_fee`, `sb`.`display_type` AS `display_type`, `sb`.`sign_type` AS `sign_type`, `sb`.`signage_fee` AS `signage_fee`, `sanb`.`sanitary_section` AS `sanitary_section`, `isb`.`sanitary_quantity` AS `sanitary_quantity`, `sanb`.`sanitary_fee` AS `sanitary_fee`, `i`.`application_type` AS `application_type`, `ii`.`power_rating` AS `power_rating`, `il`.`item_name` AS `item_name`, `cl`.`category_name` AS `category_name`, `eb`.`section` AS `section`, `eb`.`capacity` AS `capacity`, `ii`.`quantity` AS `quantity`, `ii`.`fee` AS `fee`, `ins`.`inspector_firstname` AS `inspector_firstname`, `ins`.`inspector_midname` AS `inspector_midname`, `ins`.`inspector_lastname` AS `inspector_lastname`, `ins`.`inspector_suffix` AS `inspector_suffix`, `v`.`description` AS `description`, `i`.`remarks` AS `remarks`, `b`.`bus_img_url` AS `bus_img_url`, `i`.`date_inspected` AS `date_inspected` FROM ((((((((((((((`inspection` `i` left join `business` `b` on(`i`.`bus_id` = `b`.`bus_id`)) left join `owner` `o` on(`i`.`owner_id` = `o`.`owner_id`)) left join `inspection_item` `ii` on(`i`.`inspection_id` = `ii`.`inspection_id`)) left join `item_list` `il` on(`ii`.`item_id` = `il`.`item_id`)) left join `category_list` `cl` on(`il`.`category_id` = `cl`.`category_id`)) left join `building_billing` `bb` on(`i`.`bldg_billing_id` = `bb`.`bldg_billing_id`)) left join `signage_billing` `sb` on(`i`.`signage_id` = `sb`.`signage_id`)) left join `inspection_sanitary_billing` `isb` on(`i`.`inspection_id` = `isb`.`inspection_id`)) left join `sanitary_billing` `sanb` on(`isb`.`sanitary_id` = `sanb`.`sanitary_id`)) left join `equipment_billing` `eb` on(`ii`.`billing_id` = `eb`.`billing_id`)) left join `inspection_inspector` `iins` on(`i`.`inspection_id` = `iins`.`inspection_id`)) left join `inspector` `ins` on(`iins`.`inspector_id` = `ins`.`inspector_id`)) left join `inspection_violation` `iv` on(`i`.`inspection_id` = `iv`.`inspection_id`)) left join `violation` `v` on(`iv`.`violation_id` = `v`.`violation_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `item_view`
--
DROP TABLE IF EXISTS `item_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `item_view`  AS SELECT `i`.`item_id` AS `item_id`, `i`.`item_name` AS `item_name`, `c`.`category_name` AS `category_name`, `i`.`section` AS `section`, `i`.`img_url` AS `img_url` FROM (`item_list` `i` left join `category_list` `c` on(`i`.`category_id` = `c`.`category_id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `user_view`
--
DROP TABLE IF EXISTS `user_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_view`  AS SELECT `u`.`user_id` AS `user_id`, `i`.`inspector_id` AS `inspector_id`, `i`.`inspector_firstname` AS `inspector_firstname`, `i`.`inspector_midname` AS `inspector_midname`, `i`.`inspector_lastname` AS `inspector_lastname`, `i`.`inspector_suffix` AS `inspector_suffix`, `u`.`username` AS `username`, `u`.`role` AS `role`, `u`.`password` AS `password`, `i`.`inspector_img_url` AS `inspector_img_url` FROM (`users` `u` left join `inspector` `i` on(`u`.`inspector_id` = `i`.`inspector_id`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annual_inspection_certificate`
--
ALTER TABLE `annual_inspection_certificate`
  ADD PRIMARY KEY (`certificate_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `annual_inspection_certificate_inspector`
--
ALTER TABLE `annual_inspection_certificate_inspector`
  ADD KEY `certificate_id` (`certificate_id`),
  ADD KEY `inspector_id` (`inspector_id`);

--
-- Indexes for table `building_billing`
--
ALTER TABLE `building_billing`
  ADD PRIMARY KEY (`bldg_billing_id`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`bus_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `occupancy_classification_id` (`occupancy_classification_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `equipment_billing`
--
ALTER TABLE `equipment_billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`inspection_id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `signage_id` (`signage_id`),
  ADD KEY `bldg_billing_id` (`bldg_billing_id`);

--
-- Indexes for table `inspection_inspector`
--
ALTER TABLE `inspection_inspector`
  ADD KEY `inspector_id` (`inspector_id`),
  ADD KEY `inspection_id` (`inspection_id`);

--
-- Indexes for table `inspection_item`
--
ALTER TABLE `inspection_item`
  ADD KEY `inspection_id` (`inspection_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `billing_id` (`billing_id`);

--
-- Indexes for table `inspection_sanitary_billing`
--
ALTER TABLE `inspection_sanitary_billing`
  ADD KEY `inspection_id` (`inspection_id`),
  ADD KEY `sanitary_id` (`sanitary_id`);

--
-- Indexes for table `inspection_violation`
--
ALTER TABLE `inspection_violation`
  ADD KEY `inspection_id` (`inspection_id`),
  ADD KEY `violation_id` (`violation_id`);

--
-- Indexes for table `inspector`
--
ALTER TABLE `inspector`
  ADD PRIMARY KEY (`inspector_id`);

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `occupancy_classification`
--
ALTER TABLE `occupancy_classification`
  ADD PRIMARY KEY (`occupancy_classification_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `sanitary_billing`
--
ALTER TABLE `sanitary_billing`
  ADD PRIMARY KEY (`sanitary_id`);

--
-- Indexes for table `signage_billing`
--
ALTER TABLE `signage_billing`
  ADD PRIMARY KEY (`signage_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `inspector_id` (`inspector_id`);

--
-- Indexes for table `violation`
--
ALTER TABLE `violation`
  ADD PRIMARY KEY (`violation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `annual_inspection_certificate`
--
ALTER TABLE `annual_inspection_certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `building_billing`
--
ALTER TABLE `building_billing`
  MODIFY `bldg_billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `equipment_billing`
--
ALTER TABLE `equipment_billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `inspection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inspector`
--
ALTER TABLE `inspector`
  MODIFY `inspector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `occupancy_classification`
--
ALTER TABLE `occupancy_classification`
  MODIFY `occupancy_classification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sanitary_billing`
--
ALTER TABLE `sanitary_billing`
  MODIFY `sanitary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signage_billing`
--
ALTER TABLE `signage_billing`
  MODIFY `signage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `violation`
--
ALTER TABLE `violation`
  MODIFY `violation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `annual_inspection_certificate`
--
ALTER TABLE `annual_inspection_certificate`
  ADD CONSTRAINT `annual_inspection_certificate_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `business` (`bus_id`),
  ADD CONSTRAINT `annual_inspection_certificate_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`);

--
-- Constraints for table `annual_inspection_certificate_inspector`
--
ALTER TABLE `annual_inspection_certificate_inspector`
  ADD CONSTRAINT `annual_inspection_certificate_inspector_ibfk_1` FOREIGN KEY (`certificate_id`) REFERENCES `annual_inspection_certificate` (`certificate_id`),
  ADD CONSTRAINT `annual_inspection_certificate_inspector_ibfk_2` FOREIGN KEY (`inspector_id`) REFERENCES `inspector` (`inspector_id`);

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`),
  ADD CONSTRAINT `business_ibfk_2` FOREIGN KEY (`occupancy_classification_id`) REFERENCES `occupancy_classification` (`occupancy_classification_id`);

--
-- Constraints for table `equipment_billing`
--
ALTER TABLE `equipment_billing`
  ADD CONSTRAINT `equipment_billing_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`category_id`);

--
-- Constraints for table `inspection`
--
ALTER TABLE `inspection`
  ADD CONSTRAINT `inspection_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`),
  ADD CONSTRAINT `inspection_ibfk_2` FOREIGN KEY (`bus_id`) REFERENCES `business` (`bus_id`),
  ADD CONSTRAINT `inspection_ibfk_3` FOREIGN KEY (`signage_id`) REFERENCES `signage_billing` (`signage_id`),
  ADD CONSTRAINT `inspection_ibfk_4` FOREIGN KEY (`bldg_billing_id`) REFERENCES `building_billing` (`bldg_billing_id`);

--
-- Constraints for table `inspection_inspector`
--
ALTER TABLE `inspection_inspector`
  ADD CONSTRAINT `inspection_inspector_ibfk_1` FOREIGN KEY (`inspector_id`) REFERENCES `inspector` (`inspector_id`),
  ADD CONSTRAINT `inspection_inspector_ibfk_2` FOREIGN KEY (`inspection_id`) REFERENCES `inspection` (`inspection_id`);

--
-- Constraints for table `inspection_item`
--
ALTER TABLE `inspection_item`
  ADD CONSTRAINT `inspection_item_ibfk_1` FOREIGN KEY (`inspection_id`) REFERENCES `inspection` (`inspection_id`),
  ADD CONSTRAINT `inspection_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item_list` (`item_id`),
  ADD CONSTRAINT `inspection_item_ibfk_3` FOREIGN KEY (`billing_id`) REFERENCES `equipment_billing` (`billing_id`);

--
-- Constraints for table `inspection_sanitary_billing`
--
ALTER TABLE `inspection_sanitary_billing`
  ADD CONSTRAINT `inspection_sanitary_billing_ibfk_1` FOREIGN KEY (`inspection_id`) REFERENCES `inspection` (`inspection_id`),
  ADD CONSTRAINT `inspection_sanitary_billing_ibfk_2` FOREIGN KEY (`sanitary_id`) REFERENCES `sanitary_billing` (`sanitary_id`);

--
-- Constraints for table `inspection_violation`
--
ALTER TABLE `inspection_violation`
  ADD CONSTRAINT `inspection_violation_ibfk_1` FOREIGN KEY (`inspection_id`) REFERENCES `inspection` (`inspection_id`),
  ADD CONSTRAINT `inspection_violation_ibfk_2` FOREIGN KEY (`violation_id`) REFERENCES `violation` (`violation_id`);

--
-- Constraints for table `item_list`
--
ALTER TABLE `item_list`
  ADD CONSTRAINT `item_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`category_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`inspector_id`) REFERENCES `inspector` (`inspector_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
