-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2018 at 08:32 PM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `swap`
--

CREATE TABLE IF NOT EXISTS `swap` (
  `srcdate` date NOT NULL,
  `srcbegining` time NOT NULL,
  `srcroomno` varchar(10) NOT NULL,
  `srcfno` int(11) NOT NULL,
  `srcsno` int(11) NOT NULL,
  `desfno` int(11) NOT NULL,
  `dessno` int(11) NOT NULL,
  `desroomno` varchar(10) NOT NULL,
  `desbegining` time NOT NULL,
  `desdate` date NOT NULL,
  `app` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swap`
--

