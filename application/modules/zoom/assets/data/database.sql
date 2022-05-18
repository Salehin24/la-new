

--
-- Table structure for table `zoomconfig_tbl`
--

CREATE TABLE IF NOT EXISTS `zoomconfig_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zoom_api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zoom_api_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `meeting_tbl`
--

CREATE TABLE IF NOT EXISTS `meeting_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meeting_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



