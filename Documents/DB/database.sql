/*07-06-2018*/


/*tbl_loan_stage_master*/
ALTER TABLE `mymudra`.`tbl_loan_stage_master` CHANGE `description` `loan_stage_name` VARCHAR(255) CHARSET latin1 COLLATE latin1_swedish_ci NULL, ADD COLUMN `status` TINYINT(1) NULL AFTER `stage_name`;

/*tbl_inv_stage_master*/
ALTER TABLE `mymudra`.`tbl_inv_stage_master` CHANGE `description` `inv_stage_name` VARCHAR(255) CHARSET latin1 COLLATE latin1_swedish_ci NULL, ADD COLUMN `status` TINYINT(1) NULL AFTER `stage_name`;

/*tbl_property_stage_master*/
ALTER TABLE `mymudra`.`tbl_property_stage_master` CHANGE `description` `prop_stage_name` VARCHAR(255) CHARSET latin1 COLLATE latin1_swedish_ci NULL, ADD COLUMN `status` TINYINT(1) NULL AFTER `prop_stage_name`;


INSERT INTO `mymudra`.`tbl_loan_stage_master` (`loan_stage_name`, `status`, `created_at`) VALUES ('Inquiry With Customer DOne', '1', '2018-06-07 10:30:21');
INSERT INTO `mymudra`.`tbl_loan_stage_master` (`loan_stage_name`, `status`, `created_at`) VALUES ('File Login', '1', '2018-06-07 10:30:32');
INSERT INTO `mymudra`.`tbl_loan_stage_master` (`loan_stage_name`, `status`, `created_at`) VALUES ('File Sanction', '1', '2018-06-07 10:30:44');
INSERT INTO `mymudra`.`tbl_loan_stage_master` (`loan_stage_name`, `status`, `created_at`) VALUES ('File Disclosed', '1', '2018-06-07 10:32:07');
INSERT INTO `mymudra`.`tbl_loan_stage_master` (`loan_stage_name`, `status`, `created_at`) VALUES ('File Rejected', '1', '2018-06-07 10:32:23');


INSERT INTO `mymudra`.`tbl_inv_stage_master` (`inv_stage_name`, `status`, `created_at`) VALUES ('Inquiry with customer done', '1', '2018-06-07 10:34:34');
INSERT INTO `mymudra`.`tbl_inv_stage_master` (`inv_stage_name`, `status`) VALUES ('Personal meeting', '1');
UPDATE `mymudra`.`tbl_inv_stage_master` SET `created_at` = '2018-06-07 10:34:51' WHERE `inv_stage_id` = '2';
INSERT INTO `mymudra`.`tbl_inv_stage_master` (`inv_stage_name`, `status`, `created_at`) VALUES ('Deal Finalised', '1', '2018-06-07 10:35:07');


INSERT INTO `mymudra`.`tbl_property_stage_master` (`prop_stage_name`, `status`, `created_at`) VALUES ('Inquiry with customer done', '1', '2018-06-07 10:36:27');
INSERT INTO `mymudra`.`tbl_property_stage_master` (`prop_stage_name`, `status`, `created_at`) VALUES ('Personal meeting', '1', '2018-06-07 10:36:42');
INSERT INTO `mymudra`.`tbl_property_stage_master` (`prop_stage_name`, `status`, `created_at`) VALUES ('Property Visit', '1', '2018-06-07 10:36:58');
INSERT INTO `mymudra`.`tbl_property_stage_master` (`prop_stage_name`, `status`, `created_at`) VALUES ('Deal Finalised', '1', '2018-06-07 10:37:10');



/*08-06-2018*/

CREATE TABLE `mymudra`.`tbl_property_size_type`( `property_size_type_id` BIGINT(22) NOT NULL AUTO_INCREMENT, `size_type_name` VARCHAR(255), `status` TINYINT(1), `created_at` DATETIME, `modified_at` DATETIME, PRIMARY KEY (`property_size_type_id`) );

INSERT INTO `mymudra`.`tbl_property_size_type` (`size_type_name`, `status`, `created_at`) VALUES ('sq mt', '1', '2018-06-08 15:36:23');
INSERT INTO `mymudra`.`tbl_property_size_type` (`size_type_name`, `status`, `created_at`) VALUES ('sq yad', '1', '2018-06-08 15:36:30');
INSERT INTO `mymudra`.`tbl_property_size_type` (`size_type_name`, `status`, `created_at`) VALUES ('sq ft', '1', '2018-06-08 15:36:38');

/*11-06-2018*/
INSERT INTO `mymudra`.`tbl_bank_master` (`bank_name`, `status`, `created_at`) VALUES ('SBI Bank', '1', '2018-06-11 18:04:58');
INSERT INTO `mymudra`.`tbl_bank_master` (`bank_name`, `status`, `created_at`) VALUES ('SBI Bank', '1', '2018-06-11 18:04:58');

INSERT INTO `mymudra`.`tbl_loan_type_master` (`description`, `loan_type_parent_id`, `status`, `created_at`) VALUES ('Term Loan', '3', '1', '2018-06-11 18:08:17');
INSERT INTO `mymudra`.`tbl_loan_type_master` (`description`, `loan_type_parent_id`, `status`, `created_at`) VALUES ('Working Capital', '3', '1', '2018-06-11 18:08:33');
INSERT INTO `mymudra`.`tbl_loan_type_master` (`description`, `loan_type_parent_id`, `status`, `created_at`) VALUES ('Bank Overdraft', '3', '1', '2018-06-11 18:08:46');
INSERT INTO `mymudra`.`tbl_loan_type_master` (`description`, `loan_type_parent_id`, `status`, `created_at`) VALUES ('Credit Card', '4', '1', '2018-06-11 18:09:02');
INSERT INTO `mymudra`.`tbl_loan_type_master` (`description`, `loan_type_parent_id`, `status`, `created_at`) VALUES ('Car Loan', '4', '1', '2018-06-11 18:09:13');
INSERT INTO `mymudra`.`tbl_loan_type_master` (`description`, `loan_type_parent_id`, `status`, `created_at`) VALUES ('Personnel Loan', '4', '1', '2018-06-11 18:09:25');

INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Residential', '1', '1', '2018-06-11 18:15:00');
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Commercial', '1', '1', '2018-06-11 18:15:11');
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Industrial', '1', '1', '2018-06-11 18:15:21');

INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Other', '1', '1', '2018-06-11 18:30:04');
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Residential ', '2', '1', '2018-06-11 18:30:20');
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`) VALUES ('Commercial', '2');
UPDATE `mymudra`.`tbl_property_type_master` SET `status` = '1' , `created_at` = '2018-06-11 18:30:34' WHERE `property_type_id` = '9';
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Industrial', '2', '1', '2018-06-11 18:30:44');
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Other', '2', '1', '2018-06-11 18:30:53');
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Residential ', '3', '1', '2018-06-11 18:31:10');
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`) VALUES ('Commercial  ', '3', '1');
UPDATE `mymudra`.`tbl_property_type_master` SET `created_at` = '2018-06-11 18:31:22' WHERE `property_type_id` = '13';
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`) VALUES ('Industrial', '3');
UPDATE `mymudra`.`tbl_property_type_master` SET `status` = '1' , `created_at` = '2018-06-11 18:31:31' WHERE `property_type_id` = '14';
INSERT INTO `mymudra`.`tbl_property_type_master` (`description`, `prop_type_parent_id`, `status`, `created_at`) VALUES ('Other', '3', '1', '2018-06-11 18:31:40');


ALTER TABLE `mymudra`.`tbl_loan_transaction` ADD COLUMN `loan_sub_type` BIGINT(22) NULL AFTER `modified_at`;


/*12-06-2018*/

ALTER TABLE `mymudra`.`tbl_property_transaction` ADD COLUMN `property_sub_type` BIGINT(22) NULL AFTER `description`;
ALTER TABLE `mymudra`.`tbl_loan_transaction` ADD COLUMN `bank_name` VARCHAR(255) NULL AFTER `loan_sub_type`;


/*14-06-2018*/
ALTER TABLE `mymudra`.`tbl_loan_trans_reference` ADD COLUMN `comment` TEXT NULL AFTER `stage_transaction_date`;

ALTER TABLE `mymudra`.`tbl_inv_trans_reference` ADD COLUMN `comment` TEXT NULL AFTER `stage_transaction_date`;

ALTER TABLE `mymudra`.`tbl_prop_trans_reference` ADD COLUMN `status` TINYINT(1) NULL AFTER `prop_stage_transaction_date`, ADD COLUMN `comment` TEXT NULL AFTER `status`;

CREATE TABLE `mymudra`.`tbl_admin`( `admin_id` BIGINT(22) NOT NULL AUTO_INCREMENT, `full_name` VARCHAR(255), `phone_number` VARCHAR(20), `email` VARCHAR(255), `password` VARCHAR(350), `avatar` VARCHAR(255), `is_verified` VARCHAR(300), `fConfirmPasscode` VARCHAR(150), `status` TINYINT(1), `created_at` DATETIME, `modified_at` DATETIME, PRIMARY KEY (`admin_id`) );
