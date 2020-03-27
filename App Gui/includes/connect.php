<?php
/**
 * @package Google Map server side Markers clustering
 * @author Igor Karpov <i@karpov.cc>
 * 
 */

$dsn = "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";charset=UTF8";


try {
    $dbh = new PDO($dsn, DB_USER, DB_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    echo "Can't connect: " . $e->getMessage();
    exit;
}
