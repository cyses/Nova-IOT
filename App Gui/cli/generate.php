<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 * 
 */
$document_root = dirname(__FILE__) . "/";
include_once($document_root . "includes/config.php");
include_once($document_root . "includes/connect.php");
include_once($document_root . "includes/classes/Loremipsum.calss.php");
include_once($document_root . "includes/classes/Marker_type.class.php");
include_once($document_root . "includes/classes/Helper.class.php");

$lorem = new LoremIpsumGenerator();
$marker_type = new Marker_type($dbh);
$marker_types = $marker_type->get();

for($i = 0; $i < 400; $i++) {
    $stmt = $dbh->prepare("INSERT INTO " . DB_MARKERS_TABLE . " (title, description, lat, lng, marker_type) VALUES (:title, :description, :lat, :lng, :marker_type)");
    $rand_title = $lorem->getContent(10, 'text');
    $stmt->bindParam(':title', $rand_title);
    $rand_description = $lorem->getContent(100, 'text');
    $stmt->bindParam(':description', $rand_description);
    $rand_lat = Helper::random_float(28, 48);
    $stmt->bindParam(':lat', $rand_lat);
    $rand_lng = Helper::random_float(-117, -162);
    $stmt->bindParam(':lng', $rand_lng);
    $stmt->bindParam(':marker_type', $marker_types[array_rand($marker_types)]['id']);

    $stmt->execute();
}
echo PHP_EOL . "done" . PHP_EOL;
