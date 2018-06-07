-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 07, 2018 at 05:34 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `bar`
--

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` varchar(255) NOT NULL COMMENT 'Should be a partial channel name such that all channel names starting with this attribute correspond to this particular photodiode.',
  `description` text COMMENT 'A brief description of this particular photodiode and its purpose (try to avoid information stored in other columns).',
  `qpd` tinyint(1) DEFAULT NULL COMMENT 'Whether this is a QPD (Quad Photodiode).',
  `pd_type` varchar(255) DEFAULT NULL COMMENT 'The chemical composition of this photodiode, e.g. Si, InGAs...',
  `efficiency` decimal(2,0) UNSIGNED DEFAULT NULL COMMENT 'The rough efficiency of the photodiode.',
  `rf` tinyint(1) DEFAULT NULL COMMENT 'Whether this is a photodiode with RF (radio frequency) output.',
  `wfs` tinyint(1) DEFAULT NULL COMMENT 'Whether this is a wavefront sensor.',
  `subsys_0` varchar(63) DEFAULT NULL COMMENT 'Short name of the subsystem, e.g. ASC',
  `subsys_0_name` varchar(255) DEFAULT NULL COMMENT 'Full name of the subsystem, e.g. Alignment Sensing and Control',
  `subsys_0_desc` text COMMENT 'A description of this subsystem',
  `subsys_0_href` text COMMENT 'A link to documentation on this subsystem.',
  `subsys_1` varchar(63) DEFAULT NULL COMMENT 'Short name of the sub-subsystem, e.g. AS',
  `subsys_1_name` varchar(255) DEFAULT NULL COMMENT 'Full name of the sub-subsystem, e.g. Antisymmetric port.',
  `subsys_1_desc` text NOT NULL COMMENT 'A description of this sub-subsystem.',
  `subsys_1_href` text NOT NULL COMMENT 'A link to documentation on this sub-subsystem.',
  `subsys_2` varchar(63) DEFAULT NULL COMMENT 'Short name of the sub-sub-subsystem, e.g. A',
  `subsys_2_name` varchar(255) DEFAULT NULL COMMENT 'Full name of the sub-sub-subsystem, e.g. Photodiode A.',
  `subsys_3` varchar(63) DEFAULT NULL COMMENT 'Short name of the sub-sub-sub-subsystem, e.g. A',
  `subsys_3_name` varchar(255) DEFAULT NULL COMMENT 'Full name of the sub-sub-sub-subsystem, e.g. Photodiode A.',
  `subsys_4` varchar(63) DEFAULT NULL COMMENT 'Short name of the sub-sub-sub-sub-subsystem, e.g. A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PHOTODIODE_TYPE` (`pd_type`);
