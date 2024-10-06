-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 02:47 PM
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
-- Database: `dsams`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activityId` varchar(14) NOT NULL,
  `activityName` varchar(50) NOT NULL,
  `activityTag` varchar(20) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `posterImg` varchar(200) NOT NULL,
  `link` varchar(60) NOT NULL,
  `postDate` date DEFAULT NULL,
  `frontPage` tinyint(1) NOT NULL DEFAULT 0,
  `clubId` varchar(10) NOT NULL,
  `startDate` varchar(250) DEFAULT NULL,
  `Time` varchar(60) DEFAULT '10AM to 3PM',
  `endDate` varchar(250) DEFAULT NULL,
  `venue` varchar(1000) NOT NULL DEFAULT 'HLT1.7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activityId`, `activityName`, `activityTag`, `description`, `posterImg`, `link`, `postDate`, `frontPage`, `clubId`, `startDate`, `endDate`, `venue`) VALUES
('A0001', 'Study Group Every Week', 'EVENT', 'Study Club - Hello students, we\'re hosting a new programme for tutors and students to come together and find help in...', 'A0001.jpg', '', '2022-08-10', 1, '', '', '', 'HLT1.7'),
('A0002', 'New Guidelines for Bus Rides to Kelana Jaya', 'NEWS', '', 'A0002.png', '', '2022-08-11', 0, '', '', '', 'HLT1.7'),
('A0003', 'Graphic Designers Wanted!', 'EVENT', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type aasdfadsfasdfasdfasdfasdfasdfasdfadsfadsfadsf', 'A0003.jpg', '', '2023-08-30', 1, 'C0001', '', '', 'HLT1.7'),
('A0004', 'DSAMS Update Notes', 'NEWS', 'Nothing has changed.', 'A0004.jpg', '', '2023-08-31', 0, 'C0001', '', '', 'HLT1.7'),
('A0005', 'Recruitment', 'NEWS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et mattis purus, quis placerat erat. In suscipit nulla sed quam posuere, eget pretium odio consectetur. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur a lobortis orci, at egestas nulla. Suspendisse consectetur interdum turpis, sed congue velit pretium ac. Vivamus tristique odio ut libero semper sollicitudin. Pellentesque tortor quam, hendrerit eget tincidunt venenatis, consequat eget lectus. Phasellus auctor urna vitae eleifend fringilla. Nullam pretium ac nunc eu porta. Sed id velit in erat finibus elementum.\n\nMorbi tincidunt est sit amet ligula feugiat ornare. Maecenas et volutpat quam, eget mollis risus. Curabitur tortor lacus, viverra sit amet dolor eu, porttitor tincidunt ligula. Nam at orci euismod, mattis diam et, suscipit mauris. Nulla facilisi. Vestibulum sit amet quam turpis. Morbi nisl felis, tempus ut nunc sit amet, pretium fringilla est.\n\nFusce eu efficitur quam. Praesent maximus massa est, tincidunt condimentum est malesuada at. Maecenas ut gravida eros, quis ultrices turpis. In accumsan iaculis iaculis. Quisque fermentum nisl non lectus consectetur luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris varius finibus lectus, non condimentum metus. Maecenas et posuere odio, congue suscipit lectus. Etiam pretium ut nunc maximus finibus. Morbi ante nibh, porta non orci ac, bibendum dictum nisl. Donec ultricies ut eros at fringilla. Donec eget laoreet elit. Aenean euismod ullamcorper turpis, vel vulputate nulla convallis non. Nam sed vehicula ipsum. Nam pharetra leo ac sapien bibendum, at commodo enim venenatis. In ac metus nec urna varius ultricies.\n\nInteger facilisis aliquet mauris, quis blandit lacus viverra non. Praesent posuere elit odio. Sed gravida massa ac arcu bibendum, sit amet rhoncus magna finibus. Praesent interdum id arcu sed elementum. Nunc imperdiet gravida elit id sodales. Praesent egestas vulputate pharetra. Sed placerat leo malesuada eros consequat commodo. Duis tristique libero id nunc sagittis, sit amet semper turpis mollis. Proin eu nunc sed urna efficitur tincidunt. Fusce auctor arcu quis lorem accumsan, vel tincidunt tortor blandit. Suspendisse rhoncus, nibh vel vestibulum vulputate, justo elit tempus purus, eu convallis dolor massa quis velit. Proin blandit auctor sem, sit amet congue metus congue quis. Donec tempus nunc mi, id varius velit sollicitudin nec. Nunc tincidunt commodo sem, eget tristique enim pharetra in. Etiam commodo mattis scelerisque.\n\nSed hendrerit fermentum nisi, a luctus lacus sagittis eget. In vitae laoreet libero. In lacinia augue ac metus porttitor commodo eget at justo. Maecenas sit amet nibh id nisl ultricies cursus vitae ac ipsum. Morbi porttitor et arcu tincidunt laoreet. Nam feugiat dapibus tellus ut laoreet. Ut dolor ligula, scelerisque eu porttitor quis, eleifend vitae tellus. Vestibulum auctor hendrerit pretium. Sed nec turpis pulvinar, lacinia libero quis, auctor nisl. Phasellus sit amet lacinia lectus.\n\nVivamus tincidunt tellus in dui ullamcorper, sit amet fermentum orci lacinia. Morbi pretium ut tellus sit amet dignissim. Suspendisse potenti. Sed viverra sed nisl in pulvinar. Vestibulum efficitur auctor dolor, a suscipit nisl tempor eget. Donec nec sodales libero. Aliquam eu augue eget velit imperdiet posuere pharetra quis felis. Mauris ac lectus quis nunc elementum aliquet in a augue. Aenean ullamcorper orci lacus, vitae lacinia ligula suscipit nec. Pellentesque molestie nisi at tristique posuere. Duis nec cursus diam, vitae malesuada sapien. Sed a metus egestas, efficitur mauris id, porta magna. Morbi vitae nunc erat. Etiam tincidunt dolor et turpis consectetur posuere.\n\nMorbi non ex quis sem semper ultricies. Fusce luctus orci varius posuere tempor. Nullam eleifend diam ex, placerat aliquet tortor condimentum non. In lobortis mi sed commodo auctor. Donec volutpat fermentum nisl, id porttitor sapien vulputate in. Integer sollicitudin nibh vel tincidunt ultrices. Suspendisse quis arcu ultricies, dictum tellus eu, aliquam justo. Donec ac ipsum eget enim consectetur placerat sed eget diam. Maecenas bibendum odio ac turpis hendrerit, id consectetur odio porta. Curabitur non lectus nunc. Sed vel convallis ante. Aliquam cursus neque vitae tortor mattis, sed vulputate elit sollicitudin.', 'A0005.jpg', '', '2023-08-04', 0, 'C0002', '', '', 'HLT1.7'),
('A0006', 'Movie Night!', 'EVENT', 'Come join us at a fun movie night all the movie lovers!!', 'A0006.jpg', '', '2023-08-02', 1, '', '', '', 'HLT1.7'),
('A0007', 'Event Submission', 'NEWS', '', 'A0007.jpg', '', '2023-08-02', 1, '', '', '', 'HLT1.7'),
('A65131897dfe6a', 'C major Club boxing match', NULL, 'Its going to be exciting to see how two amazing fighters with breathtaking abilities fight each other in a never before....', 'A65131897dfe6a.jpg', '', '2023-09-27', 0, '', '2023-09-14', NULL, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `clubId` varchar(10) NOT NULL,
  `clubName` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `clubIcon` varchar(25) NOT NULL,
  `clubBanner` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`clubId`, `clubName`, `description`, `clubIcon`, `clubBanner`) VALUES
('C0001', 'C Major Club', 'Collab: 📧 gmajorclub@gmail.com\r\nhttps://linktr.ee/gmajor\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor mauris eget sodales rutrum. Aliquam nec magna lectus. Praesent justo ante, porta efficitur lorem in, tristique tincidunt justo.', 'C0001Icon.jpg', 'C0001Banner.jpg'),
('C0002', 'Fight Club', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ipsum ipsum, sagittis at laoreet a, efficitur quis purus. Donec ut nibh et felis cursus aliquam nec luctus neque. Etiam ac egestas lectus, ac facilisis turpis. Donec sed nulla eu felis accumsan malesuada. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse facilisis lorem diam, sed fermentum ex sodales sed. Nulla ultrices odio ut eros egestas vestibulum. Aliquam convallis augue urn', 'C0002Icon.jpg', NULL),
('C0003', 'Pokemon Club', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ipsum ipsum, sagittis at laoreet a, efficitur quis purus. Donec ut nibh et felis cursus aliquam nec luctus neque. Etiam ac egestas lectus, ac facilisis turpis. Donec sed nulla eu felis accumsan malesuada. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse facilisis lorem diam, sed fermentum ex sodales sed. Nulla ultrices odio ut eros egestas vestibulum. Aliquam convallis augue urn', 'C0003Icon.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clubroles`
--

CREATE TABLE `clubroles` (
  `clubId` varchar(10) NOT NULL,
  `studentId` varchar(10) NOT NULL,
  `position` varchar(30) DEFAULT NULL,
  `joinDate` date NOT NULL,
  `leaveDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubroles`
--

INSERT INTO `clubroles` (`clubId`, `studentId`, `position`, `joinDate`, `leaveDate`) VALUES
('C0001', 'B0250167', 'Removed', '2023-02-28', '2023-10-04'),
('C0001', 'B1036077', 'Removed', '2023-07-09', '2023-10-04'),
('C0001', 'B1901647', 'Vice President', '2023-08-17', NULL),
('C0001', 'B2137856', 'Removed', '2023-07-16', '2023-10-06'),
('C0001', 'B2211875', 'Removed', '2023-08-28', '2023-10-06'),
('C0001', 'B3610230', 'Vice President', '2023-06-09', NULL),
('C0001', 'B9319207', 'President', '2023-04-14', NULL),
('C0002', 'B0250167', 'President', '2023-01-23', NULL),
('C0002', 'B1036077', 'Admin', '2023-08-01', NULL),
('C0002', 'B1486753', 'Committee', '2023-08-10', NULL),
('C0002', 'B2137856', 'Committee', '2022-11-06', NULL),
('C0002', 'B2211875', 'Committee', '2023-05-10', NULL),
('C0002', 'B3536601', 'Member', '2022-12-30', NULL),
('C0002', 'B4010752', 'Member', '2023-08-23', NULL),
('C0002', 'B4598019', 'Member', '2022-12-16', NULL),
('C0002', 'B7612395', 'Kicked', '2023-01-22', '2025-01-22'),
('C0002', 'B7705370', 'Member', '2022-10-30', NULL),
('C0002', 'B8803879', 'Member', '2023-04-29', NULL),
('C0002', 'B9712899', 'Member', '2022-12-14', NULL),
('C0002', 'B9774434', 'Kicked', '2022-12-09', '2024-12-09'),
('C0002', 'B9930898', 'Kicked', '2022-10-29', '2024-10-29'),
('C0003', 'B1036077', 'Committee', '2023-08-31', NULL),
('C0003', 'B1901647', 'Committee', '2023-02-15', NULL),
('C0003', 'B2137856', 'Kicked', '2023-04-21', '2025-04-21'),
('C0003', 'B3610230', 'Kicked', '2023-04-09', '2025-04-09'),
('C0003', 'B7005906', 'President', '2022-12-18', NULL),
('C0003', 'B7612395', 'Committee', '2023-05-17', NULL),
('C0003', 'B7705370', 'Member', '2022-11-15', NULL),
('C0003', 'B8712985', 'Committee', '2023-06-29', NULL),
('C0003', 'B8803879', 'Member', '2023-02-06', NULL),
('C0003', 'B9211032', 'Committee', '2022-11-24', NULL),
('C0003', 'B9774434', 'Member', '2023-06-05', NULL),
('C0003', 'B9930898', 'Kicked', '2023-06-09', '2025-06-09'),
('C0004', 'B1901647', 'Committee', '2022-10-30', NULL),
('C0004', 'B3536601', 'Committee', '2022-11-08', NULL),
('C0004', 'B3610230', 'Committee', '2023-07-20', NULL),
('C0004', 'B9211032', 'Kicked', '2022-12-08', '2024-12-08'),
('C0004', 'B9319207', 'President', '2023-05-31', NULL),
('C0004', 'B9930898', 'Committee', '2022-11-16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `studentId` varchar(10) NOT NULL,
  `activityId` varchar(10) NOT NULL,
  `attendance` tinyint(1) NOT NULL,
  `role` varchar(30) DEFAULT NULL,
  `registrationStatus` varchar(30) NOT NULL DEFAULT 'Signed Up'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`studentId`, `activityId`, `attendance`, `role`, `registrationStatus`) VALUES
('B0250167', 'A0003', 0, 'participant', 'Signed Up'),
('B1486753', 'A0003', 0, 'participant', 'Signed Up'),
('B1901647', 'A0006', 0, 'participant', 'Signed Up'),
('B2137856', 'A0003', 0, 'participant', 'Signed Up');

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `proposalId` varchar(8) NOT NULL,
  `campus` varchar(30) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `venue` varchar(200) DEFAULT NULL,
  `proposalFile` varchar(100) NOT NULL,
  `title` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `comment` varchar(100) NOT NULL,
  `submitDate` date NOT NULL,
  `description` text NOT NULL,
  `reasoning` varchar(100) DEFAULT NULL,
  `startDate` datetime DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `clubId` varchar(10) DEFAULT NULL,
  `studentId` varchar(8) NOT NULL,
  `className` varchar(60) DEFAULT NULL,
  `personInCharge` varchar(200) NOT NULL,
  `activityId` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`proposalId`, `campus`, `category`, `type`, `venue`, `proposalFile`, `title`, `status`, `comment`, `submitDate`, `description`, `reasoning`, `startDate`, `duration`, `clubId`, `studentId`, `className`, `personInCharge`, `activityId`) VALUES
('P6077273', NULL, NULL, NULL, NULL, '', 'B1901647', 'Pending', '', '2023-10-27', 'test', 'test', NULL, NULL, NULL, 'B1036077', NULL, '', NULL),
('P650e9bc', 'Subang 2', 'Organized', 'Clubs', 'Meeting Room 5 Block F', 'IT January 2023 Timetable (effective from 16 January 2023 onwards) Ver.2.pdf', 'Fight club meetup', 'Approved', 'test', '2023-08-02', '', NULL, '2023-09-08 00:00:00', '00:20:23', 'C0001', 'Test', 'BIT305 Final Year Project 2', 'B1901647, Chin Ze Han, +60123456789<br>B1901647, Chin Ze Han, +60123456789', ''),
('P650e9ca', 'Subang 2', 'Collaboration', 'DIY', 'test', 'Academic Calender FCDT 2023-Undergrad.pdf', 'C major Club boxing match', 'Published', 'test', '2023-08-24', '', NULL, '2023-09-12 00:00:00', '00:20:23', 'C0001', 'B1901647', '', 'test<br>test', 'A65131897dfe6a'),
('P650ea60', 'Subang 2', 'Organized', 'Clubs', 'test', 'BIT301_Tutorial_10.pdf', 'test', 'Pending', '', '2023-09-28', '', NULL, '2023-09-23 00:00:00', '00:20:23', 'C0002', 'B1901647', 'test', 'test<br>test', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` varchar(8) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `profilePicture` blob NOT NULL,
  `phoneNum` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `password`, `name`, `profilePicture`, `phoneNum`) VALUES
('B0250167', 'B0250167', 'Cora Kovelmann', '', '127'),
('B1036077', 'B1036077', 'Dianne Tucker', '', '433'),
('B1486753', 'B1486753', 'Lovell Lanegran', '', '248'),
('B1901647', 'B1901647', 'Chin Ze Han', '', '1234123412'),
('B2137856', 'B2137856', 'Kori Jencey', '', '833'),
('B2211875', 'B2211875', 'Shermie Urridge', '', '+62 558 699 3225'),
('B3536601', 'B3536601', 'Rebeka Christol', '', '996'),
('B3610230', 'B3610230', 'Harry Seven', '', '+48 577 221 6336'),
('B4010752', 'B4010752', 'Rice Sanderson', '', '+32 786 528 0601'),
('B4598019', 'B4598019', 'Carline Garfath', '', '509'),
('B7005906', 'B7005906', 'Letti Gunn', '', '+86 320 826 7248'),
('B7612395', 'B7612395', 'Gilles Keener', '', '+976 452 418 192'),
('B7705370', 'B7705370', 'Emelita Wight', '', '+62 142 184 8149'),
('B8109427', 'B8109427', 'Bobina Kinde', '', '+62 183 227 4719'),
('B8712985', 'B8712985', 'Peyter Odger', '', '+62 903 943 6008'),
('B8803879', 'B8803879', 'Rosamund Normanell', '', '+7 615 792 1402'),
('B9211032', 'B9211032', 'Rorke Wrankmore', '', '145'),
('B9319207', 'B9319207', 'Corrina Agass', '', '235'),
('B9712899', 'B9712899', 'Cheryl Wiffill', '', '+351 794 903 111'),
('B9774434', 'B9774434', 'Albina Fost', '', '405'),
('B9930898', 'B9930898', 'Sandi Scoffins', '', '602');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activityId`),
  ADD UNIQUE KEY `activityId` (`activityId`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`clubId`),
  ADD UNIQUE KEY `clubId` (`clubId`);

--
-- Indexes for table `clubroles`
--
ALTER TABLE `clubroles`
  ADD PRIMARY KEY (`clubId`,`studentId`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`studentId`,`activityId`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`proposalId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
