--update to v 2.0

ALTER TABLE `markers` CHANGE `lat` `lat` DECIMAL( 9, 6 ) NOT NULL ;
ALTER TABLE `markers` CHANGE `lng` `lng` DECIMAL( 9, 6 ) NOT NULL ;

CREATE TABLE IF NOT EXISTS `marker_type` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(1024) COLLATE utf8_bin NOT NULL,
  `image_type` varchar(5) COLLATE utf8_bin NOT NULL,
  `image_width` smallint(6) unsigned NOT NULL,
  `image_height` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
