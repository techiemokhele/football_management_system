-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 07:25 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `comp_id` int(255) NOT NULL,
  `comp_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Holds information about  upcoming fixtures';

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`comp_id`, `comp_name`) VALUES
(21, 'Premier Soccer League (PSL)'),
(23, 'UEFA Champions League'),
(24, 'UEFA Europa League'),
(25, 'Primera División'),
(26, 'Serie A'),
(27, 'Bundesliga'),
(28, 'Ligue 1'),
(29, 'FIFA Club World Cup'),
(30, 'World Cup'),
(31, 'Womens World Cup'),
(32, 'International Champions Cup');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `fixture_id` int(255) NOT NULL,
  `fixture_date` date NOT NULL,
  `fixture_time` time NOT NULL,
  `home_teamID` int(255) NOT NULL,
  `away_teamID` int(255) NOT NULL,
  `comp_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Holds information about  fixtures';

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`fixture_id`, `fixture_date`, `fixture_time`, `home_teamID`, `away_teamID`, `comp_id`) VALUES
(3, '2021-05-21', '11:47:24', 1, 2, 21),
(4, '2021-05-27', '11:47:24', 4, 3, 23),
(6, '2021-05-21', '15:00:00', 3, 12, 21),
(10, '2021-04-01', '12:00:00', 9, 12, 25),
(11, '1996-03-23', '21:00:00', 11, 2, 24),
(17, '2021-05-27', '20:30:00', 12, 5, 24),
(18, '2021-05-12', '20:41:00', 12, 10, 23),
(19, '2021-06-11', '02:02:00', 11, 12, 21),
(20, '2021-06-03', '15:34:00', 23, 8, 28),
(21, '2021-06-30', '21:59:00', 8, 1, 26),
(22, '2021-06-17', '04:54:00', 1, 7, 30);

-- --------------------------------------------------------

--
-- Table structure for table `playerfixtures`
--

CREATE TABLE `playerfixtures` (
  `fixture_id` int(255) NOT NULL,
  `player_id` int(255) NOT NULL,
  `goals_scored` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Holds information players fixtures';

--
-- Dumping data for table `playerfixtures`
--

INSERT INTO `playerfixtures` (`fixture_id`, `player_id`, `goals_scored`) VALUES
(3, 1, 21),
(4, 2, 1),
(10, 3, 12),
(17, 8, 222),
(18, 9, 342),
(18, 10, 3),
(18, 10, 3),
(19, 11, 18),
(20, 12, 23);

-- --------------------------------------------------------

--
-- Table structure for table `playerposition`
--

CREATE TABLE `playerposition` (
  `position_id` int(14) NOT NULL,
  `position_descr` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT=' Holds the positions/s a player  can play';

--
-- Dumping data for table `playerposition`
--

INSERT INTO `playerposition` (`position_id`, `position_descr`) VALUES
(1, 'GK'),
(2, 'CB'),
(3, 'LB'),
(4, 'FB'),
(5, 'LWB'),
(6, 'RWB'),
(7, 'SW'),
(8, 'DM'),
(9, 'CM'),
(10, 'AM'),
(11, 'LW'),
(12, 'RW'),
(13, 'CF'),
(14, 'WF');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(255) NOT NULL,
  `team_id` int(255) NOT NULL,
  `player_name` varchar(255) NOT NULL,
  `player_sqd_num` int(255) NOT NULL,
  `position_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Holds player information';

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `team_id`, `player_name`, `player_sqd_num`, `position_id`) VALUES
(1, 8, 'Mokhele Neo', 12, 1),
(2, 6, 'Mahlangu Sbubsiso', 13, 2),
(3, 7, 'Tshabalala Simphiwe', 12, 13),
(4, 9, 'Ngwenya Edwin', 13, 14),
(8, 7, 'Mgudlwa Mandisa', 21, 8),
(9, 3, 'Siyanda Khumalo', 10, 3),
(10, 2, 'Motaung Andile', 10, 13),
(11, 1, 'Mokwane Patience', 15, 4),
(12, 23, 'Amohelang Mokhele', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(255) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Holds team information';

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_email`) VALUES
(1, 'Golden Arrows', 'g.arrows@gmail.com'),
(2, 'Orlando Pirates ', 'op@gmail.com'),
(3, 'Kaizer Chiefs', 'kc@gmail.com'),
(4, 'Black Leopards', 'bl@gmail.com'),
(5, 'Super Sport United FC', 'ssufc@gmail.com'),
(6, 'Baroka FC', 'bfc@gmail.com'),
(7, 'Bafana Bafana', 'bb@gmail.com'),
(8, 'Amazulu FC', 'afc@gmail.com'),
(9, 'Santos FC', 'sfc@gmail.com'),
(10, 'Cape Town City FC', 'ctcfc@gmail.com'),
(11, 'Bidvest Wits FC', 'bwfc@gmail.com'),
(12, 'TS Galaxy FC', 'tsgfc@gmail.com'),
(13, 'Polokwane City FC', 'pcfc@gmail.com'),
(23, 'Barcelona FC', 'bfc@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`fixture_id`),
  ADD KEY `home_teamID` (`home_teamID`),
  ADD KEY `away_teamID` (`away_teamID`),
  ADD KEY `comp_id` (`comp_id`);

--
-- Indexes for table `playerfixtures`
--
ALTER TABLE `playerfixtures`
  ADD KEY `fixture_id` (`fixture_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `playerposition`
--
ALTER TABLE `playerposition`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `comp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `fixture_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD CONSTRAINT `fixtures_ibfk_1` FOREIGN KEY (`home_teamID`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `fixtures_ibfk_2` FOREIGN KEY (`away_teamID`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `fixtures_ibfk_3` FOREIGN KEY (`comp_id`) REFERENCES `competitions` (`comp_id`);

--
-- Constraints for table `playerfixtures`
--
ALTER TABLE `playerfixtures`
  ADD CONSTRAINT `playerfixtures_ibfk_1` FOREIGN KEY (`fixture_id`) REFERENCES `fixtures` (`fixture_id`),
  ADD CONSTRAINT `playerfixtures_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `playerposition` (`position_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
