<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

$document_root = dirname(__FILE__) . "/";
include_once($document_root . "../includes/config.php");
include_once($document_root . "../includes/connect.php");
include_once($document_root . "../includes/classes/Cache.class.php");
include_once($document_root . "../includes/classes/Marker.class.php");
$cache = new Cache($dbh);
$marker = new Marker($dbh);

if($cache->isEnabled() && 2 == $cache->getCacheLevel()) {
    echo date("[Y-m-d H:m:i]") . " Cache generating started" . PHP_EOL;
    if(!$cache->is_not_empty()) {
        $cache->generate($marker->get_markers(), true); //if cache empty, run with time ignoging
    }
    else {
        $cache->generate($marker->get_markers());
    }
    echo date("[Y-m-d H:m:i]") . " Cache generating finished" . PHP_EOL;
}
else {
    echo "You should enable L2 cache" . PHP_EOL;
}
