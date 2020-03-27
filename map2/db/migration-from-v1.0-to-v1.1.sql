--update to v 1.1

ALTER TABLE  `markers` CHANGE  `description`  `description` VARCHAR( 2000 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `markers` CHANGE `date_add` `date_add` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `markers` ADD INDEX ( `date_add` );

CREATE TABLE IF NOT EXISTS `storage` (
  `data_key` varchar(32) COLLATE utf8_bin NOT NULL,
  `data_value` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`data_key`),
  KEY `last_update` (`last_update`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
