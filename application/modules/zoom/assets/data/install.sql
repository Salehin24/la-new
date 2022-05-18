-- Insert language table
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`) VALUES (NULL, 'join_zoom_meeting', 'Join Zoom Meeting', NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`) VALUES (NULL, 'zoom_config', 'Zoom Config', NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`) VALUES (NULL, 'zoom_configuration', 'Zoom Configuration', NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`) VALUES (NULL, 'zoom_api_key', 'Zoom API Key', NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`) VALUES (NULL, 'zoom_api_secret', 'Zoom API Secret', NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`) VALUES (NULL, 'zoom_meeting', 'Zoom Meeting', NULL, NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`, `spanish`) VALUES (NULL, 'add_live_course', 'Add Live Course', NULL, NULL, NULL, NULL);



-- Insert sec menu item table 
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `ordering`, `parent_menu`, `icon`, `is_report`, `status`, `createby`, `createdate`) VALUES (NULL, 'zoom_meeting', 'zoom-meeting', 'zoom_meeting', '', '0', 'fas fa-search-plus', '0', '1', '1', '2021-04-10 17:26:55');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `ordering`, `parent_menu`, `icon`, `is_report`, `is_frontend`, `status`, `createby`, `createdate`) VALUES(NULL, 'join_zoom_meeting', 'join-zoom-meeting', 'student_dashboard', 6, 0, '', 0, 1, 1, 1, '2021-04-10 18:54:07');
INSERT INTO `sec_menu_item` (`menu_id`, `menu_title`, `page_url`, `module`, `ordering`, `parent_menu`, `icon`, `is_report`, `is_frontend`, `status`, `createby`, `createdate`) VALUES (NULL, 'add_live_course', 'add-live-course', 'course', '2', '8', '', '0', '0', '1', '1', '2021-04-12 17:31:46');