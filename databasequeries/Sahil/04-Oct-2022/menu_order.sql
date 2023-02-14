
ALTER TABLE `menu_items` ADD `menu_order` INT(11) NOT NULL DEFAULT '0' AFTER `is_active`;

ALTER TABLE `group_menu` ADD `menu_order` INT(11) NOT NULL DEFAULT '0' AFTER `default_menu`;