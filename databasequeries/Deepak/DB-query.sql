
ALTER TABLE `lab_templates` ADD `category_id` INT(11) NOT NULL AFTER `logo_path`, ADD `hospital_id` INT(11) NOT NULL AFTER `category_id`;

ALTER TABLE `lab_templates` ADD `updated_by` INT(11) NOT NULL AFTER `created_by`;

ALTER TABLE `lab_templates` ADD `is_default` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `group_id`;

CREATE TABLE `extra_work_category` ( `id` INT(11) NOT NULL , `title` VARCHAR(255) NOT NULL , `created_by` INT(11) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;
ALTER TABLE `extra_work_category` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);
ALTER TABLE `extra_work_category` ADD `updated_by` INT(11) NOT NULL AFTER `created_by`;
ALTER TABLE `lab_enquiries` ADD `category_id` INT(11) NULL DEFAULT NULL AFTER `record_type`;


ALTER TABLE `patients` CHANGE `updated_at` `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `patients` ADD `profile_picture_path` VARCHAR(255) NOT NULL AFTER `hospital_id`, ADD `picture_name` VARCHAR(255) NOT NULL AFTER `profile_picture_path`;


CREATE TABLE `billing_data` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `clinic_id` INT(11) NOT NULL , `request_id` INT(11) NOT NULL , `type` ENUM('by_request','by_specimen') NOT NULL DEFAULT 'by_request' , `bill_code` VARCHAR(255) NOT NULL , `bill_description` TEXT NOT NULL , `specimen_type` VARCHAR(255) NOT NULL , `price` INT(11) NOT NULL , `created_by` INT(11) NOT NULL , `updated_by` INT(11) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `billing_data` CHANGE `specimen_type` `specimen_type_id` INT(11) NOT NULL;
ALTER TABLE `billing_data` ADD `category` VARCHAR(255) NOT NULL AFTER `type`;

CREATE TABLE `request_billing_code` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `request_id` INT(11) NOT NULL , `specimen_id` INT(11) NOT NULL , `billing_type` ENUM('by_request','by_specimen') NOT NULL , `bill_code` INT(11) NOT NULL , `bill_description` TEXT NOT NULL , `bill_price` INT(11) NOT NULL , `created_by` INT(11) NOT NULL , `updated_by` INT(11) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `request_billing_code` ADD `bill_code_text` VARCHAR(255) NOT NULL AFTER `bill_code`;

ALTER TABLE `uralensis_record_track_template` ADD `request_name` VARCHAR(255) NOT NULL AFTER `lab_no`, ADD `category_name` VARCHAR(255) NOT NULL AFTER `request_name`;

ALTER TABLE `users` ADD `fee_per_case` INT(11) NOT NULL DEFAULT '0' AFTER `deleted`, ADD `fee_per_specimen` INT(11) NOT NULL DEFAULT '0' AFTER `fee_per_case`;
ALTER TABLE `request_billing_code` CHANGE `billing_type` `billing_type` ENUM('by_request','by_specimen','not_billed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `patients` ADD `hl7` VARCHAR(255) NULL AFTER `p_id_2`;
ALTER TABLE `patients` CHANGE `updated_at` `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `hospital_finance_details` CHANGE `bill_due_date` `bill_due_date` DATE NOT NULL;

ALTER TABLE `billing_data` ADD `tissue_type` VARCHAR(255) NOT NULL AFTER `price`;
ALTER TABLE `uralensis_record_track_template` ADD `billing_type` ENUM('by_request','by_specimen','not_billed') NOT NULL AFTER `category_name`;

CREATE TABLE `tissue_type` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `hospital_id` INT(11) NOT NULL , `department_id` INT(11) NOT NULL , `speciality_id` INT(11) NOT NULL , `name` VARCHAR(255) NOT NULL , `created_by` INT(11) NOT NULL , `updated_by` INT(11) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `uralensis_record_track_template` ADD `specimen_id` INT(11) NOT NULL AFTER `billing_type`, ADD `tissue_type_id` INT(11) NOT NULL AFTER `specimen_id`;
ALTER TABLE `uralensis_record_track_template` CHANGE `specimen_id` `specimen_id_val` INT(11) NOT NULL;
ALTER TABLE `users` ADD `clinic_id` INT(11) NOT NULL AFTER `fee_per_specimen`;

CREATE TABLE `invoice` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `clinic_id` INT(11) NOT NULL , `invoice_number` BIGINT NOT NULL , `billing_id` INT(11) NOT NULL , `status` ENUM('Invoiced','Paid','Processing','Unpaid') NOT NULL DEFAULT 'Unpaid' , `created_by` INT(11) NOT NULL , `updated_by` INT(11) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `invoice` ADD `due_date` DATE NULL DEFAULT NULL AFTER `status`;
ALTER TABLE `invoice` ADD `file_path` VARCHAR(255) NOT NULL AFTER `status`;

ALTER TABLE `invoice` CHANGE `billing_id` `amount` DOUBLE NOT NULL;
ALTER TABLE `invoice` CHANGE `amount` `amount` VARCHAR NOT NULL;
ALTER TABLE `invoice` DROP `amount`;
ALTER TABLE `invoice` ADD `amount` VARCHAR(255) NOT NULL AFTER `invoice_number`;
ALTER TABLE `invoice` ADD `quantity` INT(11) NOT NULL AFTER `invoice_number`;

ALTER TABLE `request` ADD `lab_report` INT(11) NULL DEFAULT NULL AFTER `speciman_no`;
/* ALTER TABLE `users` CHANGE `sub_role` `sub_role` INT(11) NULL DEFAULT NULL; */

ALTER TABLE `patients` ADD `msg_patient_id` INT(11) NULL DEFAULT NULL AFTER `id`;
ALTER TABLE `billing_data` ADD `group_id` INT(11) NOT NULL AFTER `id`;
CREATE TABLE `payment_info` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `detail` TEXT NOT NULL , `created_by` INT(11) NOT NULL , `updated_by` INT(11) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
INSERT INTO `payment_info` (`id`, `detail`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES ('1', 'HSBC, 15 Cornhill, Dorchester DT1 1BJ.\r\nAccount number 31 54 92 94\r\nSort code: 40-19-21\r\nIBAN: GB 50 MIDL 401921 31549294\r\nBIC: MIDL GB 2129F', '1', '1', current_timestamp(), current_timestamp());

ALTER TABLE `request_billing_code` ADD `invoice_path` VARCHAR(255) NULL DEFAULT NULL AFTER `bill_price`;
CREATE TABLE `pathologist_data` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `lab_id` INT(11) NOT NULL , `pathologist_id` INT(11) NOT NULL , `type` ENUM('by_request','by_specimen') NOT NULL DEFAULT 'by_request' , `price` INT(11) NOT NULL , `description` TEXT NOT NULL , `created_by` INT(11) NOT NULL , `updated_by` INT(11) NOT NULL , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
