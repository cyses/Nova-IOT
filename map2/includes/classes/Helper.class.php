<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

class Helper {

    /**
     *
     * Add necessary items to config
     *
     * @param array $config_marker_types
     * @param array $map_settings
     */

    private static $_map_languages = array(
        'ar' => 'ARABIC',
        'eu' => 'BASQUE',
        'bg' => 'BULGARIAN',
        'bn' => 'BENGALI',
        'ca' => 'CATALAN',
        'cs' => 'CZECH',
        'da' => 'DANISH',
        'de' => 'GERMAN',
        'el' => 'GREEK',
        'en' => 'ENGLISH',
        'en-AU' => 'ENGLISH (AUSTRALIAN)',
        'en-GB' => 'ENGLISH (GREAT BRITAIN)',
        'es' => 'SPANISH',
        'eu' => 'BASQUE',
        'fa' => 'FARSI',
        'fi' => 'FINNISH',
        'fil' => 'FILIPINO',
        'fr' => 'FRENCH',
        'gl' => 'GALICIAN',
        'gu' => 'GUJARATI',
        'hi' => 'HINDI',
        'hr' => 'CROATIAN',
        'hu' => 'HUNGARIAN',
        'id' => 'INDONESIAN',
        'it' => 'ITALIAN',
        'iw' => 'HEBREW',
        'ja' => 'JAPANESE',
        'kn' => 'KANNADA',
        'ko' => 'KOREAN',
        'lt' => 'LITHUANIAN',
        'lv' => 'LATVIAN',
        'ml' => 'MALAYALAM',
        'mr' => 'MARATHI',
        'nl' => 'DUTCH',
        'no' => 'NORWEGIAN',
        'pl' => 'POLISH',
        'pt' => 'PORTUGUESE',
        'pt-BR' => 'PORTUGUESE (BRAZIL)',
        'pt-PT' => 'PORTUGUESE (PORTUGAL)',
        'ro' => 'ROMANIAN',
        'ru' => 'RUSSIAN',
        'sk' => 'SLOVAK',
        'sl' => 'SLOVENIAN',
        'sr' => 'SERBIAN',
        'sv' => 'SWEDISH',
        'tl' => 'TAGALOG',
        'ta' => 'TAMIL',
        'te' => 'TELUGU',
        'th' => 'THAI',
        'tr' => 'TURKISH',
        'uk' => 'UKRAINIAN',
        'vi' => 'VIETNAMESE',
        'zh-CN' => 'CHINESE (SIMPLIFIED)',
        'zh-TW' => 'CHINESE (TRADITIONAL)'
    );

    public static function prepare_config_marker_types(&$config_marker_types, $map_settings) {
        $config_marker_types["mapCenterLat"] = (float)$map_settings['config_map_center_latitude'];
        $config_marker_types["mapCenterLon"] = (float)$map_settings['config_map_center_longitude'];
        $config_marker_types["zoomLevel"] = (int)$map_settings['config_zoom'];
        $config_marker_types["min_zoomLevel"] = (int)$map_settings['config_min_zoom'];
        $config_marker_types["max_zoomLevel"] = (int)$map_settings['config_max_zoom'];
        $config_marker_types["alwaysClusteringEnabledWhenZoomLevelLess"] = (int)$map_settings['config_alwaysClusteringEnabledWhenZoomLevelLess'];
        $config_marker_types["map_type_id"] = $map_settings['config_map_type_id'];
    }

    /**
     * compare settings keys with default
     *
     * @param array $default_map_settings
     * @param array $map_settings
     * @return boolean
     */

    public static function check_settings($default_map_settings, $map_settings) {
        foreach($default_map_settings as $key => $val) {
            if(!isset($map_settings[$key])) {
                return false;
            }
        }
        return true;
    }

    /**
     *
     * @param integer $min
     * @param integer $max
     * @return float
     */
    public static function random_float ($min, $max) {
        return ($min + lcg_value() * (abs($max - $min)));
    }

    /**
     * check if table exists
     *
     * @param $dbh
     * @param $table_name
     * @return bool
     */

    public static function tableExists($dbh, $table_name) {
        $results = $dbh->query("SHOW TABLES LIKE '$table_name'");
        if($results->rowCount() > 0){
            return true;
        }
        else {
            return false;
        }
    }

    public static function getMapLanguages() {
        return self::$_map_languages;
    }

    public static function getNameFromNumber($num) {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return self::getNameFromNumber($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }

    public static function isDateValid($str) {

        if (!is_string($str)) {
            return false;
        }

        $stamp = strtotime($str);

        if (!is_numeric($stamp)) {
            return false;
        }

        if ( checkdate(date('m', $stamp), date('d', $stamp), date('Y', $stamp)) ) {
            return true;
        }
        return false;
    }

    public static function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}
