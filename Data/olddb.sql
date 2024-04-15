-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2024 at 01:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_rounds`
--

CREATE TABLE `active_rounds` (
  `ApplicationID` int(10) UNSIGNED NOT NULL,
  `RoundID` int(10) UNSIGNED NOT NULL,
  `Status` varchar(45) NOT NULL,
  `StartTime` datetime NOT NULL,
  `Deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `active_rounds`
--

INSERT INTO `active_rounds` (`ApplicationID`, `RoundID`, `Status`, `StartTime`, `Deadline`) VALUES
(4001, 7002, 'Ongoing', '2023-11-25 00:00:00', '2023-02-12 23:59:00'),
(4002, 7001, 'Pending', '2023-10-15 00:00:00', '2023-10-22 23:59:00'),
(4005, 7004, 'Ongoing', '2023-10-20 00:00:00', '2023-10-27 23:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(10) UNSIGNED NOT NULL,
  `Password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Password`) VALUES
(10001, 'Charani@2'),
(10002, 'Mugdha$8'),
(10003, 'Shweta#6'),
(10004, 'VeenaP*9');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ApplicationID` int(10) UNSIGNED NOT NULL,
  `JobID` int(10) UNSIGNED NOT NULL,
  `CandidateID` int(10) UNSIGNED NOT NULL,
  `ApplicationDate` date NOT NULL,
  `Status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`ApplicationID`, `JobID`, `CandidateID`, `ApplicationDate`, `Status`) VALUES
(4001, 2004, 1, '2023-11-24', 'Active'),
(4002, 2008, 7, '2023-12-10', 'Active'),
(4003, 2012, 6, '2023-07-01', 'Inactive'),
(4004, 2013, 3, '2023-10-07', 'Inactive'),
(4005, 2019, 8, '2023-10-14', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `CandidateID` int(10) UNSIGNED NOT NULL,
  `CFirstName` varchar(255) NOT NULL,
  `CLastName` varchar(255) NOT NULL,
  `EmailAddress` varchar(45) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `EducationLevel` varchar(45) NOT NULL,
  `DesiredPosition` varchar(45) NOT NULL,
  `RecentUniversityName` varchar(255) NOT NULL,
  `Nationality` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `MajorID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`CandidateID`, `CFirstName`, `CLastName`, `EmailAddress`, `PhoneNumber`, `EducationLevel`, `DesiredPosition`, `RecentUniversityName`, `Nationality`, `Password`, `MajorID`) VALUES
(1, 'Noah', 'Jackson', 'NoahJackson@fakeemail.com', '+78113382608', 'Professional Certificate ', 'Testing Engineer', 'us_uni_3', 'United states', '4W2gudavqjk>', 5004),
(2, 'Paul', 'Patterson', 'PaulPatterson@fakeemail.com', '+63029418206', 'Professional Certificate', 'Clinical Psychologist', 'mex_uni_2', 'Mexico', 'x%2evvwlhcU6', 5006),
(3, 'Elizabeth', 'Fox', 'ElizabethFox@fakeemail.com', '+11927680729', 'Bachelor', 'Crime Scene Investigator', 'au_uni_3', 'UAE', 'cr;vrqfjn68L', 5010),
(4, 'Daniel', 'Dixon', 'DanielDixon@fakeemail.com', '+23659949357', 'PhD', 'Psychotherapist', 'eng_uni_3', 'Thailand', 'g6nEza0_ezch', 5006),
(5, 'Joseph', 'Hudson', 'JosephHudson@fakeemail.com', '+87688996335', 'Bachelor', 'Custom Circuit Engineer', 'uae_uni_5', 'Australia', '1$uqnsNe7ynl', 5002),
(6, 'Joshua', 'Giles', 'JoshuaGiles@fakeemail.com', '+84705583568', 'Bachelor', 'Mechanical Engineer', 'g_uni_2', 'India', 'o3ebd7mbEvg`', 5001),
(7, 'Ryan', 'Maxwell', 'RyanMaxwell@fakeemail.com', '+37204079921', 'PhD', 'Design Engineer Land Development', 'us_uni_1', 'United states', 'id0auGn4[ntv', 5003),
(8, 'Tristan', 'Vaughan', 'TristanVaughan@fakeemail.com', '+87749631758', 'Bachelor', 'Museum Curator', 'mex_uni_5', 'UAE', 'v2p(a0exnrpK', 5009),
(9, 'Alicia', 'Young', 'AliciaYoung@fakeemail.com', '+67223608831', 'Bachelor', 'Product Mechanical Engineer', 'g_uni_5', 'South Korea', '4qrimlc,dMj8', 5001),
(10, 'Jordan', 'Williamson', 'JordanWilliamson@fakeemail.com', '+16122501927', 'Bachelor', 'Color Technologist', 'ind_uni_4', 'India', 'cIlini1b1te', 5010),
(11, 'Sandra', 'Guerrero', 'SandraGuerrero@fakeemail.com', '+25477909738', 'Bachelor', 'Equipment Engineer', 'mal_uni_2', 'France', 'qjDlm5g7l\"bo', 5002),
(12, 'Tracy', 'Scott', 'TracyScott@fakeemail.com', '+63220942581', 'Bachelor', 'Home Infusion', 'g_uni_5', 'Malaysia', 'o2xlv\"7xoXwx', 5007),
(13, 'Tina', 'Mcgee', 'TinaMcgee@fakeemail.com', '+67743894633', 'High School', 'Marketing Executive', 'uae_uni_5', 'Germany', 'ygaqGq4b^5gc', 5009),
(14, 'Daniel', 'Kim', 'DanielKim@fakeemail.com', '+48996259142', 'Professional Certificate', 'Data Scientist', 'us_uni_5', 'Mexico', 'q8vg>ba0ueOw', 5004),
(15, 'Kimberly', 'Morales', 'KimberlyMorales@fakeemail.com', '+56797584377', 'High School', 'Battery Design Engineer', 'thai_uni_3', 'Mexico', 'rC6tgdxmxo?2', 5001),
(16, 'Michael', 'Vasquez', 'MichaelVasquez@fakeemail.com', '+39973917829', 'High School', 'Private Duty Nurse', 'g_uni_1', 'Germany', 'e$drjc0hhr3Z', 5007),
(17, 'Marcus', 'Young', 'MarcusYoung@fakeemail.com', '+12660008630', 'High School', 'Design Engineer Land Development', 'j_uni_4', 'Germany', '0Lbvp6iqgff!', 5003),
(18, 'Donna', 'Wilson', 'DonnaWilson@fakeemail.com', '+79819974123', 'Professional Certificate', 'Finance Manager', 'kor_uni_3', 'UAE', 'gj58j\"gpevnT', 5005),
(19, 'Wendy', 'Gonzales', 'WendyGonzales@fakeemail.com', '+29219046621', 'Master', 'Assistant Professor Counseling Psychologist', 'g_uni_2', 'South Korea', 'ac6a@guC7lls', 5006),
(20, 'Megan', 'Hutchinson', 'MeganHutchinson@fakeemail.com', '+99168567759', 'PhD', 'Battery Design Engineer', 'mex_uni_1', 'UAE', 'ue7qhWzmta@9', 5001);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `CityID` int(10) UNSIGNED NOT NULL,
  `CityName` varchar(45) NOT NULL,
  `StateName` varchar(45) NOT NULL,
  `CountryName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`CityID`, `CityName`, `StateName`, `CountryName`) VALUES
(6001, 'South Jason', 'Indiana', 'Mexico'),
(6002, 'Manningborough', 'Delaware', 'England'),
(6003, 'Susanchester', 'Washington', 'Thailand'),
(6004, 'New Miguelmouth', 'Washington', 'Thailand'),
(6005, 'New Charles', 'Montana', 'India'),
(6006, 'South Bradleychester', 'Nevada', 'UAE'),
(6007, 'Port Timothy', 'North Carolina', 'Mexico'),
(6008, 'South Carolville', 'North Dakota', 'Thailand'),
(6009, 'Allenport', 'Kansas', 'Germany'),
(6010, 'Ryanborough', 'Colorado', 'Japan'),
(6011, 'Brownview', 'Arizona', 'United states'),
(6012, 'Lindsayborough', 'North Carolina', 'France'),
(6013, 'Jeffreytown', 'Wyoming', 'United states'),
(6014, 'Natalieport', 'Nevada', 'India'),
(6015, 'Ashleyfurt', 'Rhode Island', 'India'),
(6016, 'Port Jonathanhaven', 'Missouri', 'Malaysia'),
(6017, 'West Paul', 'Minnesota', 'UAE'),
(6018, 'West Robertbury', 'South Carolina', 'UAE'),
(6019, 'Lewismouth', 'South Carolina', 'Germany'),
(6020, 'Sharifurt', 'Arizona', 'UAE');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `JobID` int(10) UNSIGNED NOT NULL,
  `JobTitle` varchar(45) NOT NULL,
  `PayRate` float NOT NULL,
  `PayPeriod` varchar(45) NOT NULL,
  `JobDomain` varchar(45) NOT NULL,
  `PostingDate` date DEFAULT NULL,
  `Deadline` date DEFAULT NULL,
  `Information` text NOT NULL,
  `OrganizationID` int(10) UNSIGNED NOT NULL,
  `RecruiterID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`JobID`, `JobTitle`, `PayRate`, `PayPeriod`, `JobDomain`, `PostingDate`, `Deadline`, `Information`, `OrganizationID`, `RecruiterID`) VALUES
(2001, 'Museum Curator', 51, 'Per hour', 'English', '2023-06-23', '2023-12-18', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1008, 3009),
(2002, 'Color Technologist', 58, 'Per hour', 'Chemistry', '2023-10-03', '2023-12-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1003, 3015),
(2003, 'Biotechnologist', 25, 'Per hour', 'Chemistry', '2023-06-27', '2023-11-07', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1003, 3003),
(2004, 'Private Duty Nurse', 10706, 'Per month', 'Nursing', '2023-06-07', '2023-10-22', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1011, 3016),
(2005, 'Analytical Chemist', 32, 'Per hour', 'Chemistry', '2024-12-26', '2025-05-12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1003, 3003),
(2006, 'Clinical Psychologist', 68, 'Per hour', 'Psychology', '2024-02-24', '2024-03-14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1011, 3001),
(2007, 'Equipment Engineer', 66, 'Per hour', 'Electrical Engineering', '2024-11-28', '2025-05-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1001, 3015),
(2008, 'Biological Science Technician', 8273, 'Per month', 'Biology', '2024-05-30', '2024-06-20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1003, 3018),
(2009, 'Assistant City Engineer', 127375, 'Per year', 'Civil Engineering', '2024-07-02', '2024-11-26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1012, 3003),
(2010, 'Loan Administration Analyst', 63769, 'Per year', 'Finance', '2023-11-30', '2023-12-15', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1001, 3015),
(2011, 'Nurse', 25889, 'Per year', 'Nursing', '2023-07-06', '2023-09-04', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1011, 3015),
(2012, 'Crime Scene Investigator', 33, 'Per hour', 'Chemistry', '2024-06-05', '2024-08-06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1011, 3009),
(2013, 'Structural Engineer', 59, 'Per hour', 'Civil Engineering', '2023-11-22', '2023-12-29', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1012, 3015),
(2014, 'Custom Circuit Engineer', 5333, 'Per month', 'Electrical Engineering', '2023-05-15', '2023-10-02', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1001, 3018),
(2015, 'Data Scientist', 56, 'Per hour', 'Computer Science', '2023-10-25', '2024-01-29', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1009, 3001),
(2016, 'Software Engineer', 31959, 'Per year', 'Computer Science', '2023-07-19', '2023-09-13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1001, 3017),
(2017, 'Home Infusion', 46020, 'Per year', 'Nursing', '2023-03-20', '2023-07-15', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1011, 3009),
(2018, 'Finance Manager', 4948, 'Per month', 'Finance', '2024-08-23', '2024-11-06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1001, 3003),
(2019, 'Design Engineer', 7606, 'Per month', 'Mechanical Engineering', '2024-01-04', '2024-02-08', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1001, 3010),
(2020, 'Product Mechanical Engineer', 35, 'Per hour', 'Mechanical Engineering', '2023-11-08', '2023-12-13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1001, 3008),
(2974, 'Design Engineer', 50, 'Per hour', 'Mechanical Engineering', '2023-12-06', '2023-12-06', 'dkhmgfk', 1007, 3002);

-- --------------------------------------------------------

--
-- Table structure for table `job_locations`
--

CREATE TABLE `job_locations` (
  `JobID` int(10) UNSIGNED NOT NULL,
  `CityID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_locations`
--

INSERT INTO `job_locations` (`JobID`, `CityID`) VALUES
(2001, 6001),
(2002, 6002),
(2003, 6003),
(2004, 6004),
(2005, 6005),
(2006, 6006),
(2007, 6007),
(2008, 6008),
(2009, 6009),
(2010, 6010),
(2011, 6011),
(2012, 6012),
(2013, 6013),
(2014, 6014),
(2015, 6015),
(2016, 6016),
(2017, 6017),
(2018, 6018),
(2019, 6019),
(2020, 6020);

-- --------------------------------------------------------

--
-- Table structure for table `job_round`
--

CREATE TABLE `job_round` (
  `JobID` int(10) UNSIGNED NOT NULL,
  `RoundID` int(10) UNSIGNED NOT NULL,
  `RoundLink` varchar(255) NOT NULL,
  `Duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_round`
--

INSERT INTO `job_round` (`JobID`, `RoundID`, `RoundLink`, `Duration`) VALUES
(2001, 7006, 'https://GEFECXQCmrTdnpcLEDlV', '01:00:00'),
(2002, 7002, 'https://rjSsTckPgTdUYXLLgVfw', '01:30:00'),
(2003, 7006, 'https://vZtPnxvxCWxIyQyxTCXg', '00:30:00'),
(2004, 7006, 'https://jBwMANchMtGSTnmUFWxu', '01:30:00'),
(2005, 7001, 'https://IBeafyWTRjgdgGewUraJ', '01:30:00'),
(2006, 7002, 'https://RXKqSIAPdIRrHEnJBuBz', '01:00:00'),
(2007, 7004, 'https://lKatUsEmZtLMzDLpghbM', '01:30:00'),
(2008, 7002, 'https://XHxmjxzcVFBKiQwiISrD', '00:30:00'),
(2009, 7004, 'https://mRIuMXTkJtQtwLfDOlXL', '02:00:00'),
(2010, 7005, 'https://rZxsWUNisaXYmXDiUXyw', '01:30:00'),
(2011, 7006, 'https://nKncakUesTMFrPXQSXcG', '02:00:00'),
(2012, 7001, 'https://vIChjlyAXYJHEEoqmdrH', '02:00:00'),
(2013, 7004, 'https://JeVyGRByhnwjUxUDOnSQ', '02:00:00'),
(2014, 7006, 'https://VWdMTRECjyxVFvYORaBW', '00:30:00'),
(2015, 7004, 'https://MRJjcZOQakxiQBPtxWXU', '01:00:00'),
(2016, 7005, 'https://kJnoruTZYxRQYyutpADe', '02:00:00'),
(2017, 7004, 'https://CjFLTRLgfBHReZKBOMYB', '00:30:00'),
(2018, 7006, 'https://rAkIkKszsdqnqPSNtJis', '01:00:00'),
(2019, 7006, 'https://jHdXCpuEzEaZjKlhoeLj', '02:00:00'),
(2020, 7006, 'https://bPQeTCsNWpugPVkAQNpR', '01:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `MajorID` int(10) UNSIGNED NOT NULL,
  `MajorName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`MajorID`, `MajorName`) VALUES
(5008, 'Biology'),
(5010, 'Chemistry'),
(5003, 'Civil Engineering'),
(5004, 'Computer Science'),
(5002, 'Electrical Engineering'),
(5009, 'English'),
(5005, 'Finance'),
(5001, 'Mechanical Engineering'),
(5007, 'Nursing'),
(5006, 'Psyschology');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(10) UNSIGNED NOT NULL,
  `ApplicationID` int(10) UNSIGNED NOT NULL,
  `AcceptanceStatus` varchar(45) NOT NULL,
  `Venue` varchar(45) NOT NULL,
  `RoundID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `OrganizationID` int(10) UNSIGNED NOT NULL,
  `OrganizationName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`OrganizationID`, `OrganizationName`) VALUES
(1012, 'Aecom'),
(1002, 'Amazon'),
(1008, 'Baker Publishing'),
(1009, 'Chanel'),
(1011, 'Covenant Hospital'),
(1010, 'Dior'),
(1003, 'Dr.Reddy\'s'),
(1007, 'Google'),
(1004, 'Netflix'),
(1005, 'Samsung'),
(1006, 'SpaceX'),
(1001, 'Tesla');

-- --------------------------------------------------------

--
-- Table structure for table `recruiter`
--

CREATE TABLE `recruiter` (
  `RecruiterID` int(10) UNSIGNED NOT NULL,
  `RFirstName` varchar(255) NOT NULL,
  `RLastName` varchar(255) NOT NULL,
  `PositionName` varchar(255) NOT NULL,
  `EmailAddress` varchar(45) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `OrganizationID` int(10) UNSIGNED NOT NULL,
  `Password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recruiter`
--

INSERT INTO `recruiter` (`RecruiterID`, `RFirstName`, `RLastName`, `PositionName`, `EmailAddress`, `PhoneNumber`, `OrganizationID`, `Password`) VALUES
(3001, 'John', 'Wallace', 'Hiring Manager', 'JohnWallace@Dr.Reddy\'s.com', '+47416337167', 1003, '18Btqenpcui-'),
(3002, 'Robert', 'Long', 'HR Lead', 'RobertLong@Google.com', '+96974536182', 1007, 'b3{fBvlyv0sl'),
(3003, 'Ellen', 'Bullock', 'CEO', 'EllenBullock@Tesla.com', '+66940321945', 1001, 'swvj?1Kyzn0h'),
(3004, 'Courtney', 'Butler', 'Owner', 'CourtneyButler@Amazon.com', '+94795423270', 1002, 'w1Oa\'zb3gdpu'),
(3005, 'Karen', 'Rubio', 'HR Lead', 'KarenRubio@Amazon.com', '+14230666913', 1002, 'zacj7pi<9dYi'),
(3006, 'Kelly', 'Kelley', 'Supervisor', 'KellyKelley@Samsung.com', '+29208284476', 1005, 'v&mo8tEs5nkw'),
(3007, 'Richard', 'Burke', 'HR Lead', 'RichardBurke@Baker_Publishing.com', '+72630812526', 1008, 'Z5bmwt-goj9f'),
(3008, 'Daniel', 'Welch', 'HR Lead', 'DanielWelch@Dr.Reddy\'s.com', '+41265941018', 1003, 'fsYyyio2bb|4'),
(3009, 'Amy', 'Bradley', 'Supervisor', 'AmyBradley@Tesla.com', '+47907119291', 1001, '85Zratomuh_v'),
(3010, 'Jennifer', 'Poole', 'CEO', 'JenniferPoole@Baker_Publishing.com', '+88832065507', 1008, 'qgd7j9oLbo;f'),
(3011, 'Mary', 'Blankenship', 'Owner', 'MaryBlankenship@Google.com', '+48513500415', 1007, 'iun7_ngAqyx3'),
(3012, 'Jose', 'Yates', 'Hiring Manager', 'JoseYates@Baker_Publishing.com', '+26314872987', 1008, ')r7oaHidqo7q'),
(3013, 'William', 'Coleman', 'Owner', 'WilliamColeman@Dior.com', '+92493836738', 1010, '!9bqjzoNhkt4'),
(3014, 'Gary', 'Knight', 'Owner', 'GaryKnight@SpaceX.com', '+21191920918', 1006, 'ww9Fwdbfni$0'),
(3015, 'Brian', 'Davidson', 'Supervisor', 'BrianDavidson@Covenant_Hospital.com', '+38119986948', 1011, 'ou`64lemYtld'),
(3016, 'David', 'Cook', 'HR Lead', 'DavidCook@Chanel.com', '+67771463559', 1009, '_s0oIdtlpjq4'),
(3017, 'Gregg', 'Tucker', 'Owner', 'GreggTucker@Dr.Reddy\'s.com', '+97764970075', 1003, 'argkwPc5d&5y'),
(3018, 'Abigail', 'Gardner', 'Core Team Member', 'AbigailGardner@Aecom.com', '+29836363189', 1012, 'onyxay9nFe]0'),
(3019, 'Courtney', 'Hogan', 'Supervisor', 'CourtneyHogan@Netflix.com', '+59976922667', 1004, 'opfj8v0wn!yN'),
(3020, 'Emily', 'Williams', 'Owner', 'EmilyWilliams@Google.com', '+19571123246', 1007, 'coz64q*Emusi');

-- --------------------------------------------------------

--
-- Table structure for table `round_results`
--

CREATE TABLE `round_results` (
  `ApplicationID` int(10) UNSIGNED NOT NULL,
  `RoundID` int(10) UNSIGNED NOT NULL,
  `Result` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `round_types`
--

CREATE TABLE `round_types` (
  `RoundID` int(10) UNSIGNED NOT NULL,
  `RoundName` varchar(45) NOT NULL,
  `Description` longtext NOT NULL,
  `Location` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `round_types`
--

INSERT INTO `round_types` (`RoundID`, `RoundName`, `Description`, `Location`) VALUES
(7001, 'Technical round', '[\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\']', 'offline'),
(7002, 'Written exam', '[\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\']', 'offline'),
(7003, 'Coding round', '[\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\']', 'offline'),
(7004, 'Phone interview', '[\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\']', 'offline'),
(7005, 'Behavioral interview', '[\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\']', 'online'),
(7006, 'Final round', '[\'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\']', 'online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_rounds`
--
ALTER TABLE `active_rounds`
  ADD PRIMARY KEY (`ApplicationID`,`RoundID`),
  ADD KEY `fk_Active Rounds_Applications1_idx` (`ApplicationID`),
  ADD KEY `fk_Active Rounds_Round Types1_idx` (`RoundID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `AdminID_UNIQUE` (`AdminID`),
  ADD UNIQUE KEY `Password_UNIQUE` (`Password`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD UNIQUE KEY `ApplicationID_UNIQUE` (`ApplicationID`),
  ADD KEY `fk_Applications_Jobs1_idx` (`JobID`),
  ADD KEY `fk_Candidate_MajorID_idx` (`CandidateID`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`CandidateID`),
  ADD UNIQUE KEY `CandidateID_UNIQUE` (`CandidateID`),
  ADD UNIQUE KEY `EmailAddress_UNIQUE` (`EmailAddress`),
  ADD UNIQUE KEY `PhoneNumber_UNIQUE` (`PhoneNumber`),
  ADD UNIQUE KEY `Password_UNIQUE` (`Password`),
  ADD KEY `fk_Candidate_Majors1_idx` (`MajorID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`CityID`),
  ADD UNIQUE KEY `CityID_UNIQUE` (`CityID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`JobID`),
  ADD UNIQUE KEY `JobID_UNIQUE` (`JobID`),
  ADD KEY `fk_Jobs_Organization1_idx` (`OrganizationID`),
  ADD KEY `fk_Jobs_Recruiter1_idx` (`RecruiterID`);

--
-- Indexes for table `job_locations`
--
ALTER TABLE `job_locations`
  ADD PRIMARY KEY (`JobID`,`CityID`),
  ADD KEY `fk_Job Locations_Jobs1_idx` (`JobID`),
  ADD KEY `fk_Job Locations_City1_idx` (`CityID`);

--
-- Indexes for table `job_round`
--
ALTER TABLE `job_round`
  ADD PRIMARY KEY (`JobID`,`RoundID`),
  ADD KEY `fk_Job Round_Jobs1_idx` (`JobID`),
  ADD KEY `fk_Job Round_Round Types1_idx` (`RoundID`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`MajorID`),
  ADD UNIQUE KEY `MajorID_UNIQUE` (`MajorID`),
  ADD UNIQUE KEY `MajorName_UNIQUE` (`MajorName`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`),
  ADD UNIQUE KEY `notificationID_UNIQUE` (`NotificationID`),
  ADD KEY `applicationID_idx` (`ApplicationID`),
  ADD KEY `roundID_idx` (`RoundID`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`OrganizationID`),
  ADD UNIQUE KEY `OrganizationID_UNIQUE` (`OrganizationID`),
  ADD UNIQUE KEY `OrganizationName_UNIQUE` (`OrganizationName`);

--
-- Indexes for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD PRIMARY KEY (`RecruiterID`),
  ADD UNIQUE KEY `RecruitedID_UNIQUE` (`RecruiterID`),
  ADD UNIQUE KEY `EmailAddress_UNIQUE` (`EmailAddress`),
  ADD UNIQUE KEY `PhoneNumber_UNIQUE` (`PhoneNumber`),
  ADD UNIQUE KEY `Password_UNIQUE` (`Password`),
  ADD KEY `fk_Recruiter_Organization1_idx` (`OrganizationID`);

--
-- Indexes for table `round_results`
--
ALTER TABLE `round_results`
  ADD PRIMARY KEY (`ApplicationID`,`RoundID`),
  ADD KEY `fk_Round Results_Applications1_idx` (`ApplicationID`),
  ADD KEY `fk_Round Results_Round Types1_idx` (`RoundID`);

--
-- Indexes for table `round_types`
--
ALTER TABLE `round_types`
  ADD PRIMARY KEY (`RoundID`),
  ADD UNIQUE KEY `RoundID_UNIQUE` (`RoundID`),
  ADD UNIQUE KEY `RoundName_UNIQUE` (`RoundName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `ApplicationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4006;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `CandidateID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=966;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `CityID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6987;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `JobID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2975;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `MajorID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5011;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `OrganizationID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- AUTO_INCREMENT for table `recruiter`
--
ALTER TABLE `recruiter`
  MODIFY `RecruiterID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3878;

--
-- AUTO_INCREMENT for table `round_types`
--
ALTER TABLE `round_types`
  MODIFY `RoundID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7007;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `active_rounds`
--
ALTER TABLE `active_rounds`
  ADD CONSTRAINT `fk_Active_Rounds_Applications1` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`),
  ADD CONSTRAINT `fk_Active_Rounds_Round Types1` FOREIGN KEY (`RoundID`) REFERENCES `round_types` (`RoundID`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `fk_Applications_Jobs1` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`),
  ADD CONSTRAINT `fk_Candidate_MajorID` FOREIGN KEY (`CandidateID`) REFERENCES `candidate` (`CandidateID`);

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `fk_Candidate_Majors1` FOREIGN KEY (`MajorID`) REFERENCES `majors` (`MajorID`);

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `fk_Jobs_Organization1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`),
  ADD CONSTRAINT `fk_Jobs_Recruiter1` FOREIGN KEY (`RecruiterID`) REFERENCES `recruiter` (`RecruiterID`);

--
-- Constraints for table `job_locations`
--
ALTER TABLE `job_locations`
  ADD CONSTRAINT `fk_Job Locations_City1` FOREIGN KEY (`CityID`) REFERENCES `city` (`CityID`),
  ADD CONSTRAINT `fk_Job Locations_Jobs1` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`);

--
-- Constraints for table `job_round`
--
ALTER TABLE `job_round`
  ADD CONSTRAINT `fk_Job_Round_Jobs1` FOREIGN KEY (`JobID`) REFERENCES `jobs` (`JobID`),
  ADD CONSTRAINT `fk_Job_Round_Round Types1` FOREIGN KEY (`RoundID`) REFERENCES `round_types` (`RoundID`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `applicationID` FOREIGN KEY (`applicationID`) REFERENCES `applications` (`ApplicationID`),
  ADD CONSTRAINT `roundID` FOREIGN KEY (`roundID`) REFERENCES `round_types` (`RoundID`);

--
-- Constraints for table `recruiter`
--
ALTER TABLE `recruiter`
  ADD CONSTRAINT `fk_Recruiter_Organization1` FOREIGN KEY (`OrganizationID`) REFERENCES `organization` (`OrganizationID`);

--
-- Constraints for table `round_results`
--
ALTER TABLE `round_results`
  ADD CONSTRAINT `fk_Round_Results_Applications1` FOREIGN KEY (`ApplicationID`) REFERENCES `applications` (`ApplicationID`),
  ADD CONSTRAINT `fk_Round_Results_Round Types1` FOREIGN KEY (`RoundID`) REFERENCES `round_types` (`RoundID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
