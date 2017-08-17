-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2017 at 11:47 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `android`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_users`
--

CREATE TABLE IF NOT EXISTS `new_users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `userid` varchar(23) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `apikey` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `gcmid` varchar(150) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `gendar` varchar(25) DEFAULT NULL,
  `date_of_birth` varchar(25) DEFAULT NULL,
  `city` varchar(250) NOT NULL,
  `zipcode` varchar(25) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `encrypted_password` varchar(256) NOT NULL DEFAULT '',
  `salt` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `new_users`
--

INSERT INTO `new_users` (`id`, `userid`, `first_name`, `mobile_number`, `email`, `apikey`, `status`, `gcmid`, `last_name`, `gendar`, `date_of_birth`, `city`, `zipcode`, `country`, `encrypted_password`, `salt`, `created_at`, `updated_at`) VALUES
(12, '595f0d594a2d91.03065577', 'suresh', '1111111111', 'sharing@gmail.com', 'f9c6118a8d31db0f0545fcc6384c3a65', 0, '', '', 'male', '18-7-1988', 'Chennai', '600032', 'india', '', NULL, '2017-07-07 09:56:01', '2017-07-07 09:57:48');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
