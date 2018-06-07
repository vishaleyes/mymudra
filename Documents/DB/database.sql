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

