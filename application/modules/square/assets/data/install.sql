-- Insert language table
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`) VALUES (NULL, 'sq', 'sq', NULL, NULL, NULL);


-- Insert payment method table
INSERT INTO `payment_method_tbl` (`id`, `title`, `value`, `marchant_id`, `password`, `email`, `currency`, `is_live`, `created_by`, `created_at`, `status`) VALUES(7, 'Square Payment', 7, 'sandbox-sq0idb-ShIOgPUIHSXxsjCPG4oh_A', '', '5SNY8GNKAZM00', 'USD', 0, '1', '2021-04-11 13:28:00', 1);