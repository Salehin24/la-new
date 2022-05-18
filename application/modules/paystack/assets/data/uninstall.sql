-- Delete payment method table data
DELETE FROM `payment_method_tbl` WHERE id = 9;

-- Delete language table data
DELETE FROM `language` WHERE phrase = 'paystack';
DELETE FROM `language` WHERE phrase = 'paystack_configuration';
DELETE FROM `language` WHERE phrase = 'paystack_config';