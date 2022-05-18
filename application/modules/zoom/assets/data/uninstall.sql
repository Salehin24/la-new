
-- Delete language table data
DELETE FROM `language` WHERE phrase = 'join_zoom_meeting';
DELETE FROM `language` WHERE phrase = 'zoom_config';
DELETE FROM `language` WHERE phrase = 'zoom_configuration';
DELETE FROM `language` WHERE phrase = 'zoom_api_key';
DELETE FROM `language` WHERE phrase = 'zoom_api_secret';
DELETE FROM `language` WHERE phrase = 'zoom_meeting';
DELETE FROM `language` WHERE phrase = 'add_live_course';


-- Delete sec menu item 
DELETE FROM `sec_menu_item` WHERE menu_title = 'zoom_meeting';
DELETE FROM `sec_menu_item` WHERE menu_title = 'join_zoom_meeting';
DELETE FROM `sec_menu_item` WHERE menu_title = 'add_live_course';