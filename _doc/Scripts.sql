-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 23, 2013 at 09:39 AM
-- Server version: 5.1.66
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sundaydogs_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `Brand`
--

CREATE TABLE IF NOT EXISTS `Brand` (
  `brand_no` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`brand_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Catagory`
--

CREATE TABLE IF NOT EXISTS `Catagory` (
  `catagory_no` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`catagory_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10004 ;

--
-- Dumping data for table `Catagory`
--

INSERT INTO `Catagory` (`catagory_no`, `name`) VALUES
(10000, 'Food'),
(10001, 'Toy'),
(10002, 'Shirt'),
(10003, 'Skirt');

-- --------------------------------------------------------

--
-- Table structure for table `Config`
--

CREATE TABLE IF NOT EXISTS `Config` (
  `configName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `configValue` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`configName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Config`
--

INSERT INTO `Config` (`configName`, `configValue`) VALUES
('contentUrl', 'http://uat.sundaydogshop.com'),
('payment_accountNo', '1234567890'),
('payment_bank', 'SCB'),
('payment_branch', 'Central World'),
('payment_email', 'test@sundaydogshop.com'),
('payment_accountName', 'Sunday Dog'),
('contact_email', 'p.saravudecha@gmail.com'),
('contact_phone', '660817446554'),
('FAQ_question-1', 'Nulla sit amet nunc fermentum, ullamcorper dolor ut, aliquet arcu?'),
('FAQ_answer-1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec magna nunc, pellentesque ac orci at, laoreet iaculis felis. Mauris fermentum interdum dolor nec placerat. Sed eget tortor tempor, mattis quam ut, euismod ante. Sed consequat interdum elit. Aenean iaculis tempus nunc ac interdum. Sed in magna ut lectus lobortis pretium non id nibh. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer auctor lacus elementum, tincidunt nisi et, molestie nunc. Class aptent taciti sociosq. Mauris fermentum interdum dolor nec placerat.'),
('FAQ_question-2', 'What is this web site url?'),
('FAQ_answer-2', 'www.sundaydogshop.com'),
('paypal_account', 'p.saravudecha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `item_no` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `brands` int(5) NOT NULL,
  `catagories` int(5) NOT NULL,
  `size` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `extra_label` char(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`item_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10004 ;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`item_no`, `name`, `price`, `brands`, `catagories`, `size`, `extra_label`) VALUES
(10000, 'Dog', 1000, 0, 10000, '', ''),
(10001, 'Skirt', 200, 0, 10000, '', ''),
(10002, 'Shirt', 150, 0, 10000, '', ''),
(10003, 'bone', 50, 0, 10000, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `Transaction`
--

CREATE TABLE IF NOT EXISTS `Transaction` (
  `ref_no` varchar(8) CHARACTER SET latin1 NOT NULL,
  `customer_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `total_cost` float NOT NULL,
  `method` int(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ref_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
