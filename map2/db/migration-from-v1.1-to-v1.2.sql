ALTER TABLE `markers` ADD `marker_type` SMALLINT UNSIGNED NOT NULL DEFAULT '0',
ADD INDEX ( `marker_type` ) ;

ALTER TABLE `storage` CHANGE `data_key` `data_key` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ;
