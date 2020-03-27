<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 * 
 */

/**
 * switch for dev and prod
 */
define('DEBUG', true);
if(DEBUG) {
    error_reporting(E_ALL & ~E_STRICT);
    ini_set('display_errors', 1);
}
else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

/**
 * database settings
 */
define("DB_USER", "metdecco_cu");
define("DB_PASSWORD", "7y0wU0a:9Cw+DO");
define("DB_NAME", "metdecco_cluster");
define("DB_HOST", "localhost");
define("DB_TABLE_PREFIX", "");
define("DB_MARKERS_TABLE", DB_TABLE_PREFIX . "markers");
define("DB_MARKER_TYPE_TABLE", DB_TABLE_PREFIX . "marker_type");
define("DB_STORAGE_TABLE", DB_TABLE_PREFIX . "storage");
define("INDEX_CLUSTER_MAP_KEY", "index_cluster_map_");

/**
 * site path settings
 */
define("SITE_DOMAIN", "http://www.metdec.com");
define("APP_DIR", "/map2/");
define("APP_PATH", __DIR__ . "/../");
define("HTTP_APP_PATH", SITE_DOMAIN . APP_DIR);
define("HTTP_ICO_PATH", HTTP_APP_PATH . '/static/img/ico/'); //path to marker images
define("APP_ICO_PATH", APP_PATH . 'static/img/ico/'); //path to marker images
define("HTTP_IMG_PATH", HTTP_APP_PATH . '/static/img/upload/'); //path to marker images
define("APP_IMG_PATH", APP_PATH . 'static/img/upload/'); //path to marker images

define("NXIK_GMC_USER_NAME", "admin");
define("NXIK_GMC_USER_PASSWORD", "admin");

define("NXIK_API_IPSTACK_URL", "http://api.ipstack.com/");
define("NXIK_API_IPSTACK_KEY", "");

$xls_mime = array(
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "application/vnd.ms-excel",
    "application/octet-stream"
);
$csv_mime = array(
    "text/plain"
);

$allowed_pages = array("index.php", "login.php", "exec.php");

/**
 * don't change this array
 */

$default_map_settings = array(
    'config_autodetect_map_center' => 0,
    'config_map_center_latitude' => 40.45,
    'config_map_center_longitude' => -98.52,
    'config_map_width' => "100%",
    'config_map_height' => "1000px",
    'config_min_zoom' => 1,
    'config_max_zoom' => 21,
    'config_zoom' => 5,
    'config_distance' => 50,
    'config_markers_cluster_level_2' => 10,
    'config_markers_cluster_level_3' => 50,
    'config_markers_cluster_level_4' => 100,
    'config_markers_cluster_level_5' => 300,
    'config_unclusterise_same_markers' => false,
    'config_enable_cache' => false,
    'config_cache_level' => 1,
    'config_show_makers_filter' => 1,
    'config_search_results_per_page' => 15,
    'config_show_makers_search' => true,
    'config_filter_search_place' => true,
    'config_alwaysClusteringEnabledWhenZoomLevelLess' => 2,
    'config_map_type_id' => 'ROADMAP',
    'config_map_language' => 'en',
    'config_map_style' => '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2e5d4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]}]',

);


/**
 * manage settings
 */

$config_markers_per_page = array(10, 50, 100);


/**
 * marker types
 */

$config_marker_types = array(
    "jsonGetMarkerUrl" => HTTP_APP_PATH . '/exec.php',
    "jsonMarkerUrl" => HTTP_APP_PATH . '/exec.php',
    "jsonGetMarkerInfoUrl" => HTTP_APP_PATH . '/exec.php',
    "jsonMarkerInfoUrl" => HTTP_APP_PATH . '/exec.php',
    "clusterImage" => array(
        "src" => HTTP_APP_PATH . '/static/img/cluster2.png',
        "height" => 60,
        "width" => 60,
        "offsetH" => 30,
        "offsetW" => 30
    ),
/**
  * http://mapicons.nicolasmollet.com/
 * 
 * * marker types
 */    
    "pinImage" => array(),
    "textErrorMessage" => 'An error has occured'
);

define("DB_MARKERS_TABLE_SQL",  <<<EOD
CREATE TABLE IF NOT EXISTS `%s` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` decimal(9,6) NOT NULL,
  `lng` decimal(9,6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `marker_type` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `image_type` char(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_add` (`date_add`),
  KEY `marker_type` (`marker_type`),
  KEY `lat` (`lat`),
  KEY `lng` (`lng`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
EOD
);

define("DB_STORAGE_TABLE_SQL",  <<<EOD
CREATE TABLE IF NOT EXISTS `%s` (
  `data_key` varchar(64) COLLATE utf8_bin NOT NULL,
  `data_value` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`data_key`),
  KEY `last_update` (`last_update`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
EOD
);
define("DB_MARKER_TYPE_TABLE_SQL",  <<<EOD
CREATE TABLE IF NOT EXISTS `%s` (
  `id` smallint(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(1024) COLLATE utf8_bin NOT NULL,
  `image_type` varchar(5) COLLATE utf8_bin NOT NULL,
  `image_width` smallint(6) UNSIGNED NOT NULL,
  `image_height` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
EOD
);
