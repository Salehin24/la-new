-- Insert language table
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`) VALUES (NULL, 'one', 'One', NULL, NULL, NULL);


-- Insert payment method table
INSERT INTO `payment_method_tbl` (`id`, `title`, `value`, `marchant_id`, `password`, `email`, `currency`, `is_live`, `created_by`, `created_at`, `status`) VALUES(1, 'SSLCOMMERZ', 1, 'style5c246d140fefc', 'style5c246d140fefc@ssl', 'style@gmail.com', 'BDT', 0, '1', '2021-04-12 05:40:54', 1);