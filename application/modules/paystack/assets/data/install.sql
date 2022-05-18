-- Insert language table

INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`) VALUES (NULL, 'paystack', 'Paystack', NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`) VALUES (NULL, 'paystack_configuration', 'Paystack Configuration', NULL, NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `bangla`, `arabic`, `urdhu`) VALUES (NULL, 'paystack_config', 'Paystack Config', NULL, NULL, NULL);


-- Insert payment method table
INSERT INTO `payment_method_tbl` (`id`, `title`, `value`, `marchant_id`, `password`, `email`, `currency`, `is_live`, `created_by`, `created_at`, `status`) VALUES(9, 'Paystack', 9, 'sk_test_71353c2613675acb967ea532f4c4c8105ea175b8', 'pk_test_328da55755b88b1aaed96c5cda215b2fd887edb9', 'ainalcse@gmail.com', 'NGN', 0, '1', '2021-04-12 06:28:43', 1);