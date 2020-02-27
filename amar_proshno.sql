-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2020 at 10:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amar_proshno`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `ans` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `users_id`, `ans`) VALUES
(26, 46, 3, 'Why shouud'),
(22, 42, 3, '<p>Yes you can do it</p>'),
(20, 30, 13, 'à¦§à¦¨à§à¦¯à¦¬à¦¾à¦¦ à¦­à¦¾à¦‡ #rony'),
(21, 31, 16, 'jolil vai apni kono chinta koiren na..osomvob somvob hoye jabe'),
(19, 30, 3, 'à¦†à¦ªà¦¨à¦¿ à¦ªà§à¦°à¦¥à¦®à§‡ à¦•à¦¿à¦›à§ à¦¶à§à¦•à¦¨à§‹ à¦—à§‹à¦¬à¦° à¦¸à¦‚à¦—à§à¦°à¦¹ à¦•à¦°à§à¦¨à¥¤ à¦¤à¦¾à¦°à¦ªà¦° à¦ à¦—à§‹à¦¬à¦° à¦®à¦¾à¦Ÿà¦¿à¦° à¦¸à¦¾à¦¥à§‡ à¦®à¦¿à¦¶à¦¿à¦¯à¦¼à§‡ à¦ªà¦¾à¦¨à¦¿ à¦¦à¦¿à¦¯à¦¼à§‡ à¦­à¦¾à¦²à§‹ à¦•à¦°à§‡ à¦®à§‡à¦–à§‡ à¦•à¦¾à¦¦à¦¾ à¦•à¦¾à¦¦à¦¾ à¦•à¦°à§‡ à¦¨à¦¿à¦¨à¥¤ à¦¤à¦¾à¦° à¦¯à§‡à¦‡ à¦¡à¦¾à¦²à§‡ à¦•à¦²à¦® à¦•à¦°à¦¬à§‡à¦¨ à¦ à¦¡à¦¾à¦²à§‡à¦° à¦¸à¦¾à¦®à¦¨à§à¦¯ à¦à¦•à¦Ÿà§ à¦¬à¦¾à¦•à¦² à¦¤à§à¦²à§‡ à¦®à¦¾à¦Ÿà¦¿à¦—à§à¦²à§‹ à¦²à¦¾à¦—à¦¿à¦¯à¦¼à§‡ à¦ªà¦²à¦¿à¦¥à¦¿à¦¨ à¦¦à¦¿à¦¯à¦¼à§‡ à¦¬à§‡à¦§à§‡ à¦¦à¦¿à¦¨à¥¤'),
(12, 10, 3, 'Not valid!'),
(13, 14, 8, 'ans'),
(25, 49, 3, 'hgfqmjhd'),
(23, 42, 3, 'Yes i use composer'),
(24, 49, 1, 'manything'),
(27, 49, 19, '<p>nothing</p>');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Technology', '2017-04-16 05:41:31', '2017-04-16 05:41:31', '2017-04-16 05:41:31'),
(2, 'Agriculture', '2017-04-16 05:41:31', '2017-04-16 05:41:31', '2017-04-16 05:41:31'),
(3, 'Software', '2017-04-16 05:42:37', '2017-04-16 05:42:37', '2017-04-16 05:42:37'),
(4, 'Hardware', '2017-04-16 05:42:37', '2017-04-16 05:42:37', '2017-04-16 05:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `username` varchar(60) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `uapdated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `cat_id`, `title`, `body`, `username`, `user_id`, `date`, `created_at`, `uapdated_at`, `deleted_at`) VALUES
(3, 3, 'How to make software??', '<p><span style=\"font-family: \'Source Sans Pro\', sans-serif; font-size: 16px; text-align: justify; background-color: #fef4e5;\">pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus </span></p>', NULL, 3, '2017-04-16 12:20:41', '2017-04-16 18:20:41', '2017-04-16 18:20:41', '2017-04-16 12:20:41'),
(18, 1, 'Who profits from the online learning?', '<p><span style=\"box-sizing: border-box; color: #545454; font-family: Roboto, arial, sans-serif; font-size: small;\">How will that new classroom&nbsp;</span><span style=\"box-sizing: border-box; font-weight: bold; color: #6a6a6a; font-family: Roboto, arial, sans-serif; font-size: small;\">technology</span><span style=\"box-sizing: border-box; color: #545454; font-family: Roboto, arial, sans-serif; font-size: small;\">&nbsp;integrate with the student learning experience - instead of interfering with the&nbsp;</span><span style=\"box-sizing: border-box; font-weight: bold; color: #6a6a6a; font-family: Roboto, arial, sans-serif; font-size: small;\">educational</span><span style=\"box-sizing: border-box; color: #545454; font-family: Roboto, arial, sans-serif; font-size: small;\">&nbsp;environment?</span></p>', 'sadek', 12, '2017-04-20 07:40:19', '2017-04-20 13:40:19', '2017-04-20 13:40:19', '2017-04-20 07:40:19'),
(36, 1, 'For Everybody', '<p><strong style=\"font-size: medium;\">What is mean by an associative array?</strong></p>', 'rony', 3, '2017-04-22 05:16:51', '2017-04-21 23:16:51', '2017-04-21 23:16:51', '2017-04-22 05:16:51'),
(37, 1, 'Valid', '<p><strong style=\"font-size: medium;\">What is the importance of \"method\" attribute in a html form?</strong></p>', 'rony', 3, '2017-04-22 05:18:16', '2017-04-21 23:18:16', '2017-04-21 23:18:16', '2017-04-22 05:18:16'),
(38, 3, 'Everybody', '<p><strong style=\"font-size: medium;\">How send email using php?</strong></p>', 'rony', 3, '2017-04-22 05:19:23', '2017-04-21 23:19:23', '2017-04-21 23:19:23', '2017-04-22 05:19:23'),
(30, 2, 'à¦œà¦¾à¦®à¦°à§à¦² à¦—à¦¾à¦›à§‡ à¦•à¦²à¦® à¦¦à¦¿à¦¤à§‡ à¦šà¦¾à¦‡...à¦•à¦¿à¦›à§ à¦ªà¦°à¦¾à¦®à¦°à§à¦¶ à¦†à¦¶à¦¾ à¦•à¦°à¦›à¦¿ :) ', '<p>à¦œà¦¾à¦®à¦°à§à¦² à¦—à¦¾à¦›à§‡ à¦•à¦²à¦® à¦¦à¦¿à¦¤à§‡ à¦šà¦¾à¦‡...à¦•à¦¿à¦›à§ à¦ªà¦°à¦¾à¦®à¦°à§à¦¶ à¦†à¦¶à¦¾ à¦•à¦°à¦›à¦¿ :)&nbsp;</p>', 'Ia', 13, '2017-04-21 23:37:50', '2017-04-21 17:37:50', '2017-04-21 17:37:50', '2017-04-21 23:37:50'),
(31, 4, 'à¦—à¦¾à¦œà§€ à¦ªà¦¾à¦¨à¦¿à¦° à¦ªà¦¾à¦®à§à¦ª à¦•à¦¿à¦­à¦¾à¦¬à§‡ à¦ à¦¿à¦• à¦•à¦°à¦¤à§‡ à¦ªà¦¾à¦°à¦¿?', '<p>à¦—à¦¤à¦•à¦¾à¦²&nbsp;à¦¥à§‡à¦•à§‡&nbsp;à¦ªà¦¾à¦¨à¦¿à¦°&nbsp;à¦ªà¦¾à¦®à§à¦ª&nbsp;à¦¨à¦·à§à¦Ÿà¥¤&nbsp;à¦–à¦¾à¦“à¦¯à¦¼à¦¾,&nbsp;à¦…à¦œà§,&nbsp;à¦—à§‹à¦¸à¦²,&nbsp;à¦Ÿà¦¯à¦¼à¦²à§‡à¦Ÿ&nbsp;à¦¸à¦¬&nbsp;à¦¬à¦¨à§à¦§à¥¤&nbsp;à¦ªà§à¦²à¦¿à¦œ&nbsp;à¦•à§‡à¦‰&nbsp;à¦à¦•à¦Ÿà§&nbsp;à¦¹à§‡à¦²à§à¦ª&nbsp;à¦•à¦°à§‡à¦¨à¥¤</p>', 'à¦œà¦²à¦¿à¦²', 14, '2017-04-22 00:34:16', '2017-04-21 18:34:16', '2017-04-21 18:34:16', '2017-04-22 00:34:16'),
(7, 2, 'Definition of  Agriculture ', '<p><span style=\"font-size: small;\"><strong><span style=\"color: #222222; font-family: Roboto, arial, sans-serif;\">the science or practice of farming, including cultivation of the soil for the growing of crops and the rearing of animals to provide food, wool, and other products.</span></strong></span></p>', NULL, 3, '2017-04-16 13:04:47', '2017-04-16 19:04:47', '2017-04-16 19:04:47', '2017-04-16 13:04:47'),
(32, 3, 'c programming', '<p>how i learn c language with basics</p>', 'mh_suhag', 16, '2017-04-22 04:06:45', '2017-04-21 22:06:45', '2017-04-21 22:06:45', '2017-04-22 04:06:45'),
(33, 1, '42\"', '<p>42\" sony TV\'r dam koto?</p>', 'nayla_nayem', 17, '2017-04-22 04:21:07', '2017-04-21 22:21:07', '2017-04-21 22:21:07', '2017-04-22 04:21:07'),
(34, 3, 'Write down the code for save an uploaded file in php. ', '<p><strong style=\"font-size: medium;\">Write down the code for save an uploaded file in php.</strong></p>\r\n<p style=\"line-height: 1.5; font-size: medium;\">if ($_FILES[\"file\"][\"error\"] == 0)<br />{<br />move_uploaded_file($_FILES[\"file\"][\"tmp_name\"],<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\"upload/\" . $_FILES[\"file\"][\"name\"]);<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo \"Stored in: \" . \"upload/\" . $_FILES[\"file\"][\"name\"];&nbsp;<br />}</p>', 'rony', 3, '2017-04-22 05:12:01', '2017-04-21 23:12:01', '2017-04-21 23:12:01', '2017-04-22 05:12:01'),
(35, 3, 'How to create a text file in php?', '<p><span style=\"font-size: medium; line-height: 24px;\">$filename = \"/home/user/guest/newfile.txt\";</span><br style=\"font-size: medium; line-height: 24px;\" /><span style=\"font-size: medium; line-height: 24px;\">$file = fopen( $filename, \"w\" );</span><br style=\"font-size: medium; line-height: 24px;\" /><span style=\"font-size: medium; line-height: 24px;\">if( $file == false )</span><br style=\"font-size: medium; line-height: 24px;\" /><span style=\"font-size: medium; line-height: 24px;\">{</span><br style=\"font-size: medium; line-height: 24px;\" /><span style=\"font-size: medium; line-height: 24px;\">echo ( \"Error in opening new file\" ); exit();</span><br style=\"font-size: medium; line-height: 24px;\" /><span style=\"font-size: medium; line-height: 24px;\">}</span><br style=\"font-size: medium; line-height: 24px;\" /><span style=\"font-size: medium; line-height: 24px;\">fwrite( $file, \"This is a simple test\\n\" );</span><br style=\"font-size: medium; line-height: 24px;\" /><span style=\"font-size: medium; line-height: 24px;\">fclose( $file );</span></p>', 'rony', 3, '2017-04-22 05:13:52', '2017-04-21 23:13:52', '2017-04-21 23:13:52', '2017-04-22 05:13:52'),
(21, 3, 'What is Python?', '<p><span style=\"color: #666666; font-family: SourceSansProRegular, Arial, sans-serif; font-size: 16.875px; background-color: #f9f9f9;\">Python is an interpreted, object-oriented, high-level programming language with dynamic semantics. Its high-level built in data structures, combined with dynamic typing and dynamic binding, make it very attractive for Rapid Application Development, as well as for use as a scripting or glue language to connect existing components together. Python\'s simple, easy to learn syntax emphasizes readability and therefore reduces the cost of program maintenance. Python supports modules and packages, which encourages program modularity and code reuse. The Python interpreter and the extensive standard library are available in source or binary form without charge for all major platforms, and can be freely distributed.</span></p>', 'tasnif', 1, '2017-04-21 08:26:16', '2017-04-21 14:26:16', '2017-04-21 14:26:16', '2017-04-21 08:26:16'),
(42, 1, 'For Everybody', '<p><span style=\"font-weight: bold; border: 0px; font-family: Helvetica, Arial, sans-serif; font-size: 18px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 30px; color: #333333;\">Do you use Composer? If yes, what benefits have you found in it?</span></p>', 'rony', 3, '2017-04-22 05:25:09', '2017-04-21 23:25:09', '2017-04-21 23:25:09', '2017-04-22 05:25:09'),
(43, 1, 'PHP', '<p><strong style=\"font-size: medium;\">What are the encryption techniques in PHP</strong></p>', 'rony', 3, '2017-04-22 05:33:32', '2017-04-21 23:33:32', '2017-04-21 23:33:32', '2017-04-22 05:33:32'),
(44, 3, 'PHP Laravel', '<p>Is php laravel is able to perform object oriented large software?&nbsp;</p>', 'rony', 3, '2017-04-22 05:41:17', '2017-04-21 23:41:17', '2017-04-21 23:41:17', '2017-04-22 05:41:17'),
(40, 1, 'Everybody', '<p><span style=\"font-weight: bold; border: 0px; font-family: Helvetica, Arial, sans-serif; font-size: 18px; margin: 0px; outline: 0px; padding: 0px; vertical-align: baseline; line-height: 30px; color: #333333;\">How can you enable error reporting in PHP?</span></p>', 'rony', 3, '2017-04-22 05:21:40', '2017-04-21 23:21:40', '2017-04-21 23:21:40', '2017-04-22 05:21:40'),
(46, 3, 'What is PHP?', '<p>&nbsp;My insert no database?</p>', 'tasnif', 1, '2017-04-22 08:01:02', '2017-04-22 02:01:02', '2017-04-22 02:01:02', '2017-04-22 08:01:02'),
(47, 2, 'Agriculture', '<p>What is Agriculture?</p>\r\n<p>&nbsp;</p>', 'rayhanislam', 18, '2017-04-22 08:41:59', '2017-04-22 02:41:59', '2017-04-22 02:41:59', '2017-04-22 08:41:59'),
(48, 1, 'Technology', '<p>I can use Technology ?</p>', 'rayhanislam', 18, '2017-04-22 08:53:28', '2017-04-22 02:53:28', '2017-04-22 02:53:28', '2017-04-22 08:53:28'),
(49, 3, 'what is ASP?', '<p>Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing Somthing&nbsp;</p>', 'rony', 3, '2017-04-22 09:34:04', '2017-04-22 03:34:04', '2017-04-22 03:34:04', '2017-04-22 09:34:04'),
(50, 3, 'php storm', '<p>i need php storm license key</p>', 'mhs93', 19, '2020-02-27 09:40:20', '2020-02-27 15:40:20', '2020-02-27 15:40:20', '2020-02-27 09:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT 'assets/uploads/default.png',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `image`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mominul', 'Hasan', 'mhs', 'mhs@gmail.com', '97ba520937250ef70e5957d14dfaf171', 'assets/uploads/fd78f387e3.jpg', 1, '2017-04-17 23:01:09', '2017-04-17 23:01:09', '2017-04-17 23:01:09'),
(2, 'Ayesha Siddika', 'Eimu', 'eimu', 'ayeshaeimu28@gmail.com', '224dcc613a4774b160d4966bce8cb15e', 'assets/uploads/default.png', 0, '2017-04-18 01:21:55', '2017-04-18 01:21:55', '2017-04-18 01:21:55'),
(3, 'Abu Hanifa', 'Rony', 'rony', 'rony@gmail.com', '202cb962ac59075b964b07152d234b70', 'assets/uploads/rony.jpg', 0, '2017-04-18 23:22:45', '2017-04-18 23:22:45', '2017-04-18 23:22:45'),
(5, 'Muminul Haque', 'Suhag', 'suhag', 'suhag@gmail.com', '202cb962ac59075b964b07152d234b70', 'assets/uploads/suhag.jpg', 0, '2017-04-18 23:32:31', '2017-04-18 23:32:31', '2017-04-18 23:32:31'),
(7, 'Rayhan', 'Islam', 'rayhan', 'rayhan@gmail.com', '202cb962ac59075b964b07152d234b70', 'assets/uploads/rayhan.jpg', 0, '2017-04-19 14:24:08', '2017-04-19 14:24:08', '2017-04-19 14:24:08'),
(8, 'sumon ', 'mahmud', 'sumonmhd', 'info@sumonmhd.com', '202cb962ac59075b964b07152d234b70', 'assets/uploads/default.png', 0, '2017-04-19 14:41:26', '2017-04-19 14:41:26', '2017-04-19 14:41:26'),
(12, 'Mohiuddin', 'Sadek', 'sadek', 'sadek@gmail.com', '97ba520937250ef70e5957d14dfaf171', 'assets/uploads/138cf039ff.jpg', 0, '2017-04-20 00:41:52', '2017-04-20 00:41:52', '2017-04-20 00:41:52'),
(13, 'Imran', 'Anjum', 'Ia', 'aadanjum@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'assets/uploads/4c4fde98b8.jpg', 0, '2017-04-21 17:35:51', '2017-04-21 17:35:51', '2017-04-21 17:35:51'),
(15, 'sanim', 'islam', 'sani', 'mhmahmud15@yahoo.com', 'e2fc714c4727ee9395f324cd2e7f331f', 'assets/uploads/default.png', 0, '2017-04-21 18:29:44', '2017-04-21 18:29:44', '2017-04-21 18:29:44'),
(16, 'Mominul', 'Hasan', 'mh_suhag', 'mominul93hasan@gmail.com', '202cb962ac59075b964b07152d234b70', 'assets/uploads/be96616faa.jpg', 0, '2017-04-21 21:43:30', '2017-04-21 21:43:30', '2017-04-21 21:43:30'),
(17, 'nayla ', 'nayem', 'nayla_nayem', 'nayla_nayem@gmail.com', '202cb962ac59075b964b07152d234b70', 'assets/uploads/e9f1323882.png', 0, '2017-04-21 22:14:24', '2017-04-21 22:14:24', '2017-04-21 22:14:24'),
(18, 'Rayhan', 'Islam', 'rayhanislam', 'rayhanislam0017@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'assets/uploads/default.png', 0, '2017-04-22 02:12:51', '2017-04-22 02:12:51', '2017-04-22 02:12:51'),
(19, 'Mominul', 'Hasan', 'mhs93', 'mhs93@gmail.com', '43496ac9fead7dbc6f1f34e5a4896499', 'assets/uploads/default.png', 0, '2020-02-27 15:37:13', '2020-02-27 15:37:13', '2020-02-27 15:37:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
