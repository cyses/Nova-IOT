<?php

/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 * 
 */
if ( ! session_id() ) @ session_start();
header('Content-type: text/html; charset=utf-8');
include_once("includes/config.php");
include_once(APP_PATH . "/includes/language/en_GB.php");
include_once(APP_PATH . "/includes/connect.php");
include_once(APP_PATH . "/includes/classes/Marker_type.class.php");
include_once(APP_PATH . "/includes/classes/Marker.class.php");
include_once(APP_PATH . "/includes/classes/Cluster.class.php");
include_once(APP_PATH . "/includes/classes/Storage.class.php");
include_once(APP_PATH . "/includes/classes/Cache.class.php");
include_once(APP_PATH . "/includes/classes/Auth.class.php");
include_once(APP_PATH . "/includes/classes/Helper.class.php");
require_once APP_PATH . '/includes/classes/PhpSpreadsheet/src/Bootstrap.php';

Auth::check_access($allowed_pages);
$marker_type = new Marker_type($dbh);
$marker = new Marker($dbh);
$storage = new Storage($dbh);
$cache = new Cache($dbh);
$cluster = new Cluster();
//prepare settings and config
$map_settings = array();
$map_settings = $storage->get_settings();
if(isset($map_settings['config_autodetect_map_center']) && $map_settings['config_autodetect_map_center'] == 1) {
    if(!isset($_SESSION['nxik_map_center_latitude']) && !isset($_SESSION['nxik_map_center_longitude'])) {
        include_once(APP_PATH . "vendor/autoload.php");
        $curl = new Curl\Curl();
        $curl->setOpt(CURLOPT_ENCODING , '');
        $user_ip = Helper::getRealIpAddr();
        $ipstack_url = NXIK_API_IPSTACK_URL . $user_ip;
        $curl->get($ipstack_url, array('access_key' => (NXIK_API_IPSTACK_KEY != ''?NXIK_API_IPSTACK_KEY:$map_settings['config_api_key_ipstack'])));
        if (!$curl->error) {
            if(!is_null($curl->response->latitude) && !is_null($curl->response->longitude)) {
                $_SESSION['nxik_map_center_latitude'] = $map_settings['config_map_center_latitude'] = $curl->response->latitude;
                $_SESSION['nxik_map_center_longitude'] = $map_settings['config_map_center_longitude'] = $curl->response->longitude;
            }
        }
    }
    else {
        $map_settings['config_map_center_latitude'] = $_SESSION['nxik_map_center_latitude'];
        $map_settings['config_map_center_longitude'] = $_SESSION['nxik_map_center_longitude'];
    }
}

$config_marker_types["pinImage"] = $marker_type->get_pin_image();
Helper::prepare_config_marker_types($config_marker_types, $map_settings);
$action = filter_input(INPUT_GET, "action")?:filter_input(INPUT_POST, "action");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

  $marker_type_data = array();
        $marker_type_data['type_name'] = filter_input(INPUT_POST, "marker_type_name");
        $marker_type_data['image_type'] = '';
        $marker_type_data['image_width'] = 0;
        $marker_type_data['image_height'] = 0;
        $marker_type_id = $marker_type->save($marker_type_data);
        echo $marker_type_id;
        if($marker_type_id > 0) {
            if ($_FILES["marker_icon"]["error"] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["marker_icon"]["tmp_name"];
                $image_info = "info";//getimagesize($tmp_name);
                $image_type = $image_info[2];
                if(in_array($image_type , array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
                    $file_extension = str_replace("image/", "", $image_info['mime']);
                    move_uploaded_file($tmp_name, APP_ICO_PATH . "/" . $marker_type_id . "." . $file_extension);
                    $marker_type_data['image_type'] = $file_extension;
                    $marker_type_data['image_width'] = $image_info[0];
                    $marker_type_data['image_height'] = $image_info[1];
                    $marker_type_data['id'] = $marker_type_id;
                    $marker_type_id = $marker_type->save($marker_type_data);
                    $response_messages = array();

                    $response_messages["msg"]["code"] = 0;
                    $response_messages["msg"]["text"] = "Data saved.";
                    $response_messages["msg"]["post_url"] = HTTP_APP_PATH;
                    print json_encode($response_messages);
                }
            }
        }
        else {/*
            $response_messages["msg"]["code"] = 1;
            $response_messages["msg"]["text"] = "Something went wrong.2";
            $response_messages["msg"]["post_url"] = HTTP_APP_PATH;*/
            print json_encode($response_messages);
        }
/*
switch ($action) {
    case "marker":
        $marker->setId((int) $id);
        $marker_info = $marker->getById();
        if(strlen($marker_info['description']) > 200) {
            $short_description = substr(strip_tags($marker_info['description']), 0, 200);
            $marker_info['short_description'] = substr($short_description, 0, strrpos($short_description, ' ')) . " ...";
        }
        else {
            $marker_info['short_description'] = strip_tags($marker_info['description']);
        }
        break;
    case "save-settings":
        $settings_data['config_autodetect_map_center'] = (int)filter_input(INPUT_POST, 'autodetect_map_center', FILTER_VALIDATE_BOOLEAN);
        $settings_data['config_map_center_latitude'] = filter_input(INPUT_POST, 'map_center_latitude', FILTER_VALIDATE_FLOAT);
        $settings_data['config_map_center_longitude'] = filter_input(INPUT_POST, 'map_center_longitude', FILTER_VALIDATE_FLOAT);
        $settings_data['config_map_width'] = filter_input(INPUT_POST, 'map_width');
        $settings_data['config_map_height'] = filter_input(INPUT_POST, 'map_height');
        $settings_data['config_min_zoom'] = filter_input(INPUT_POST, 'min_zoom', FILTER_VALIDATE_INT);
        $settings_data['config_max_zoom'] = filter_input(INPUT_POST, 'max_zoom');
        $settings_data['config_alwaysClusteringEnabledWhenZoomLevelLess'] = filter_input(INPUT_POST, 'alwaysClusteringEnabledWhenZoomLevelLess');
        $settings_data['config_zoom'] = filter_input(INPUT_POST, 'zoom');
        $settings_data['config_distance'] = filter_input(INPUT_POST, 'distance');
        $settings_data['config_markers_cluster_level_2'] = filter_input(INPUT_POST, 'markers_cluster_level_2');
        $settings_data['config_markers_cluster_level_3'] = filter_input(INPUT_POST, 'markers_cluster_level_3');
        $settings_data['config_markers_cluster_level_4'] = filter_input(INPUT_POST, 'markers_cluster_level_4');
        $settings_data['config_markers_cluster_level_5'] = filter_input(INPUT_POST, 'markers_cluster_level_5');
        $settings_data['config_unclusterise_same_markers'] = (int)filter_input(INPUT_POST, 'unclusterise_same_markers', FILTER_VALIDATE_BOOLEAN);
        $settings_data['config_enable_cache'] = (int)filter_input(INPUT_POST, 'enable_cache', FILTER_VALIDATE_BOOLEAN);
        $settings_data['config_cache_level'] = filter_input(INPUT_POST, 'cache_level');
        $settings_data['config_show_makers_filter'] = (int)filter_input(INPUT_POST, 'show_makers_filter', FILTER_VALIDATE_BOOLEAN);
        $settings_data['config_search_results_per_page'] = filter_input(INPUT_POST, 'search_results_per_page');
        $settings_data['config_show_makers_search'] = (int)filter_input(INPUT_POST, 'show_makers_search', FILTER_VALIDATE_BOOLEAN);
        $settings_data['config_filter_search_place'] = filter_input(INPUT_POST, 'filter_search_place');
        $settings_data['config_map_type_id'] = filter_input(INPUT_POST, 'map_type_id');
        $settings_data['config_map_language'] = filter_input(INPUT_POST, 'map_language');
        $settings_data['config_api_key'] = filter_input(INPUT_POST, 'api_key');
        $settings_data['config_api_key_ipstack'] = filter_input(INPUT_POST, 'api_key_ipstack');
        $settings_data['config_map_style'] = trim(filter_input(INPUT_POST, 'map_style'));
        foreach($settings_data as $key_settings => $value_settings) {
            $storage->setKey($key_settings);
            $storage->setValue($value_settings);
            $storage->set_data_by_key();
        }
        header('Location: ' . HTTP_APP_PATH . "/settings.php?msg=settings_updated");
        exit;
        break;
    case "settings-reset2default":
        if(!Helper::tableExists($dbh, DB_MARKERS_TABLE)) {
            $stmt = $dbh->prepare(sprintf(DB_MARKERS_TABLE_SQL, DB_MARKERS_TABLE));
            $stmt->execute();
        }
        if(!Helper::tableExists($dbh, DB_STORAGE_TABLE)) {
            $stmt = $dbh->prepare(sprintf(DB_STORAGE_TABLE_SQL, DB_STORAGE_TABLE));
            $stmt->execute();
        }
        if(!Helper::tableExists($dbh, DB_MARKER_TYPE_TABLE)) {
            $stmt = $dbh->prepare(sprintf(DB_MARKER_TYPE_TABLE_SQL, DB_MARKER_TYPE_TABLE));
            $stmt->execute();
        }
        foreach($default_map_settings as $key_settings => $value_settings) {
            $storage->setKey($key_settings);
            $storage->setValue($value_settings);
            $storage->set_data_by_key();
        }
        header('Location: ' . HTTP_APP_PATH . "/settings.php?msg=settings_reset2default");
        break;
    case "add-marker":
        $marker->setTitle(filter_input(INPUT_POST, "title"));
        $marker->setDescription(filter_input(INPUT_POST, "description"));
        $marker->setLat((float)filter_input(INPUT_POST, "lat", FILTER_VALIDATE_FLOAT));
        $marker->setLng((float)filter_input(INPUT_POST, "lng", FILTER_VALIDATE_FLOAT));
        $marker->setMarkerType((int)filter_input(INPUT_POST, "marker_type", FILTER_VALIDATE_INT));

        $marker_id = $marker->add();
        if($marker_id > 0) {
            if (isset($_FILES["marker_image"]) && $_FILES["marker_image"]["error"] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["marker_image"]["tmp_name"];
                $image_info = getimagesize($tmp_name);
                $image_type = $image_info[2];
                if(in_array($image_type , array(IMAGETYPE_JPEG))) {
                    $file_extension = str_replace("image/", "", $image_info['mime']);
                    $dir = $marker_id % 10;
                    $upload_dir = APP_IMG_PATH . "/" . $dir;

                    if(!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0755);
                    }
                    move_uploaded_file($tmp_name, $upload_dir . "/" . $marker_id . "." . $file_extension);
                    $marker = new Marker($dbh);
                    $marker->setImageType($file_extension);
                    $marker->setId((int)$marker_id);
                    $marker->updateImageType();
                    $response_messages = array();

                    $response_messages["msg"]["code"] = 0;
                    $response_messages["msg"]["text"] = "Data saved.";
                    $response_messages["msg"]["post_url"] = HTTP_APP_PATH;
                    print json_encode($response_messages);
                    break;
                }
            }
        }
        else {
            $response_messages["msg"]["code"] = 1;
            $response_messages["msg"]["text"] = "Something went wrong.1";
            $response_messages["msg"]["post_url"] = HTTP_APP_PATH;
            print json_encode($response_messages);
            break;
        }



        $response_messages = array();
        $response_messages["msg"]["code"] = 0;
        $response_messages["msg"]["text"] = "Data saved.";
        $response_messages["msg"]["post_url"] = HTTP_APP_PATH;
        print json_encode($response_messages);
        break;
    case "update-marker":
        $marker_id = (int)filter_input(INPUT_POST, "marker_id", FILTER_VALIDATE_INT);


        $marker->setTitle(filter_input(INPUT_POST, "title"));
        $marker->setDescription(nl2br(filter_input(INPUT_POST, "description")));
        $marker->setLat((float)filter_input(INPUT_POST, "lat", FILTER_VALIDATE_FLOAT));
        $marker->setLng((float)filter_input(INPUT_POST, "lng", FILTER_VALIDATE_FLOAT));
        $marker->setMarkerType((int)filter_input(INPUT_POST, "marker_type", FILTER_VALIDATE_INT));
        $marker->setId($marker_id);
        $marker->update();
        if (isset($_FILES["marker_image"]) && $_FILES["marker_image"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["marker_image"]["tmp_name"];
            $image_info = getimagesize($tmp_name);
            $image_type = $image_info[2];
            if(in_array($image_type , array(IMAGETYPE_JPEG))) {
                $file_extension = str_replace("image/", "", $image_info['mime']);
                $dir = $marker_id % 10;
                $upload_dir = APP_IMG_PATH . "/" . $dir;

                if(!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0755);
                }
                move_uploaded_file($tmp_name, $upload_dir . "/" . $marker_id . "." . $file_extension);
                $marker = new Marker($dbh);
                $marker->setImageType($file_extension);
                $marker->setId((int)$marker_id);
                $marker->updateImageType();
                $response_messages = array();

                $response_messages["msg"]["code"] = 0;
                $response_messages["msg"]["text"] = "Data updated.";
                $response_messages["msg"]["post_url"] = HTTP_APP_PATH;
                print json_encode($response_messages);
                break;
            }
        }
        $response_messages["msg"]["code"] = 0;
        $response_messages["msg"]["text"] = "Data updated.";
        print json_encode($response_messages);
        break;
    case "list-markers":
        //header('Content-Type: application/json; charset=utf-8', true, 200);
        $current_page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);
        $search_text = filter_input(INPUT_GET, "search_text");
        $filter = filter_input(INPUT_GET, "filter", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY)?:array();
        if($map_settings['config_show_makers_filter'] && sizeof($filter) == 0) {
            $data = array("count_num_rows" => 0);
        }
        else {
            $order_by = 'date_add DESC';
            $data = $marker->get_markers(
                                $map_settings['config_search_results_per_page'],
                                $current_page * $map_settings['config_search_results_per_page'],
                                $search_text,
                                $filter,
                                $order_by
            );
        }

        print json_encode($data);
        break;
    case "get-markers":
        $sid = filter_input(INPUT_GET, "sid", FILTER_VALIDATE_INT);
        $zoom = filter_input(INPUT_GET, "zoom", FILTER_VALIDATE_INT);
        $filter = filter_input(INPUT_GET, "filter", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY)?:array();
        $cache_filter = "";
        if(sizeof($filter) != sizeof($config_marker_types['pinImage'])) {
            $cache_filter = implode("_", $filter);
        }
        //hide all markers if checkboxes unchecked
        if($map_settings['config_show_makers_filter'] && sizeof($filter) == 0) {
            $clustered["EMsg"] = "";
            $clustered["Msec"] = 0;
            $clustered["Ok"] = 1;
            $clustered["Rid"] = $sid;
            $clustered["Count"] = 0;
            $clustered["Mia"] = 0;
            $clustered["Polylines"] = array();
            $clustered["Markers"] = array();
            print json_encode($clustered);
            break;
        }
        $json_clustered = "";
        //chech cached data
        if($map_settings['config_enable_cache']) {
            $storage->setKey(INDEX_CLUSTER_MAP_KEY . $zoom . "_filter" . $cache_filter);
            $json_clustered = $storage->get_data_by_key();
        }

        if(strlen($json_clustered)) {
            $json_clustered = json_decode($json_clustered, true);
            $json_clustered["Rid"] = $sid;
            $json_clustered = json_encode($json_clustered);
            print $json_clustered;
        }
        else {
            $data = array();
            $nelat = str_replace("_", ".", filter_input(INPUT_GET, 'nelat'));
            $swlat = str_replace("_", ".", filter_input(INPUT_GET, 'swlat'));
            $nelon = str_replace("_", ".", filter_input(INPUT_GET, 'nelon'));
            $swlon = str_replace("_", ".", filter_input(INPUT_GET, 'swlon'));

            if(1 == $map_settings["config_cache_level"] && $map_settings["config_enable_cache"] && $zoom <= $map_settings["config_zoom"]) {
                $data = $marker->get_markers(0, 0, "", $filter);
                $data = $data["rows"];
            }
            else {
                $data = $marker->get_map_markers($swlat, $nelat, $swlon, $nelon, $filter);
                if($map_settings["config_unclusterise_same_markers"] && $map_settings["config_max_zoom"] == $zoom) {
                    $hash = array();
                    array_walk($data, function(&$val, $key) use (&$hash) {
                        $new_hash = serialize(array($val["lat"], $val["lng"]));
                        if(!in_array($new_hash, $hash)) {
                            $hash[] = $new_hash;
                        }
                        else {
                            $val["lng"] +=  (($key % 2)?1:-1) * ($key * 4) / 100000;
                            $hash[] = serialize(array(sprintf('%.6f', $val["lat"]), sprintf('%.6f', $val["lng"])));
                        }
                    });
                }
            }

            if (sizeof($data)) {
                $data = $cluster->clusterer($data, $map_settings["config_distance"], $zoom);
                $clustered["EMsg"] = "";
                $clustered["Msec"] = 185;
                $clustered["Ok"] = 1;
                $clustered["Rid"] = $sid;
                $clustered["Count"] = sizeof($data);
                $clustered["Mia"] = 0;
                $clustered["Polylines"] = array();
                $clustered["Markers"] = array();
                foreach ($data as $key => $marker) {
                    if (isset($marker[0]) && is_array($marker[0])) {
                        $clustered["Markers"][$key] = array(
                            "I" => (sizeof($marker) == 1 ? $marker[0]['id'] : 0),
                            "T" => (int)$marker[0]['marker_type'],
                            "X" => $marker[0]['lng'],
                            "Y" => $marker[0]['lat'],
                            "C" => sizeof($marker)
                        );
                    } else {
                        $clustered["Markers"][$key] = array(
                            "I" => $marker['id'],
                            "T" => (int)$marker['marker_type'],
                            "X" => $marker['lng'],
                            "Y" => $marker['lat'],
                            "C" => 1
                        );
                    }
                }
                $json_clustered = json_encode($clustered);

            }
            else {
                $clustered["EMsg"] = "";
                $clustered["Msec"] = 0;
                $clustered["Ok"] = 1;
                $clustered["Rid"] = $sid;
                $clustered["Count"] = 0;
                $clustered["Mia"] = 0;
                $clustered["Polylines"] = array();
                $clustered["Markers"] = array();
                print json_encode($clustered);
                break;
            }
            if(1 == $map_settings["config_cache_level"] && $map_settings["config_enable_cache"] && $zoom <= $map_settings["config_zoom"]) {
                $storage->setKey(INDEX_CLUSTER_MAP_KEY . $zoom . "_filter" . $cache_filter);
                $storage->setValue($json_clustered);
                $storage->set_data_by_key();
            }
            print $json_clustered;
        }
        break;
    case "get-marker-info":
        if ($id) {

            $marker->setId((int) filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT));
            $row = $marker->getById();
            $clustered["EMsg"] = "";
            $clustered["Msec"] = 0;
            $clustered["Ok"] = 1;
            $clustered["Id"] = $id;
            $clustered["Rid"] = filter_input(INPUT_GET, "sid", FILTER_VALIDATE_INT);
            $clustered["Lat"] = $row['lat'];
            $clustered["Lon"] = $row['lng'];
            $date = new DateTime($row['date_add']);
            $clustered["Type"] = 0;
            $clustered["Content"]['marker_title'] = $row["title"];
            if(isset($row['image_type']) && $row['image_type'] != '') {
                $clustered["Content"]['img_src'] = HTTP_IMG_PATH . ($row['id'] % 10) . '/' . $row['id'] . '.' . $row['image_type'];
            }

            $clustered["Content"]["description"] = $row["description"];
            $clustered["Content"]["date_add"] = $date->format("d F Y");
            print json_encode($clustered);

        }
        break;
    case "get-marker":
        if ($id) {
            $marker->setId((int)$id);
            $row = $marker->getById();
            print json_encode($row);
        }
        break;
    case "delete-marker":
        if ($id) {
            $marker->setId($id);
            $marker->deleteById();
            if($map_settings["config_enable_cache"] && 1 == $map_settings["config_cache_level"]) {
                $cache->generate($marker->get_markers(), true);
            }
        }
        header('Location: ' . HTTP_APP_PATH . "/manage.php?msg=marker_deleted");
        exit;
        break;
    case "delete-marker-type":
        if ($id) {
            $marker_data = $marker_type->getById($id);
            if($marker_type->deleteById($id)) {
                unlink($marker_type->get_image($id, "", "dir"));
            }
            if($map_settings["config_enable_cache"] && 1 == $map_settings["config_cache_level"]) {
                $cache->generate($marker->get_markers(), true);
            }
        }
        header('Location: ' . HTTP_APP_PATH . "/marker_type.php?msg=marker_deleted");
        exit;
        break;
    case "add-marker-type":
        $marker_type_data = array();
        $marker_type_data['type_name'] = filter_input(INPUT_POST, "marker_type_name");
        $marker_type_data['image_type'] = '';
        $marker_type_data['image_width'] = 0;
        $marker_type_data['image_height'] = 0;
        $marker_type_id = $marker_type->save($marker_type_data);
        if($marker_type_id > 0) {
            if ($_FILES["marker_icon"]["error"] == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["marker_icon"]["tmp_name"];
                $image_info = getimagesize($tmp_name);
                $image_type = $image_info[2];
                if(in_array($image_type , array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
                    $file_extension = str_replace("image/", "", $image_info['mime']);
                    move_uploaded_file($tmp_name, APP_ICO_PATH . "/" . $marker_type_id . "." . $file_extension);
                    $marker_type_data['image_type'] = $file_extension;
                    $marker_type_data['image_width'] = $image_info[0];
                    $marker_type_data['image_height'] = $image_info[1];
                    $marker_type_data['id'] = $marker_type_id;
                    $marker_type_id = $marker_type->save($marker_type_data);
                    $response_messages = array();

                    $response_messages["msg"]["code"] = 0;
                    $response_messages["msg"]["text"] = "Data saved.";
                    $response_messages["msg"]["post_url"] = HTTP_APP_PATH;
                    print json_encode($response_messages);
                }
            }
        }
        else {
            $response_messages["msg"]["code"] = 1;
            $response_messages["msg"]["text"] = "Something went wrong.2";
            $response_messages["msg"]["post_url"] = HTTP_APP_PATH;
            print json_encode($response_messages);
        }
        break;
    case "update-marker-type":
        $marker_type_data = array();
        $marker_type_data['id'] = filter_input(INPUT_POST, "marker_id");
        $marker_type_data['type_name'] = filter_input(INPUT_POST, "marker_type_name");

        if (isset($_FILES["marker_icon"]) && $_FILES["marker_icon"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["marker_icon"]["tmp_name"];
            $image_info = getimagesize($tmp_name);
            $image_type = $image_info[2];
            if(in_array($image_type , array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
                $file_extension = str_replace("image/", "", $image_info['mime']);
                move_uploaded_file($tmp_name, APP_ICO_PATH . "/" . $marker_type_data['id'] . "." . $file_extension);
                $marker_type_data['image_type'] = $file_extension;
                $marker_type_data['image_width'] = $image_info[0];
                $marker_type_data['image_height'] = $image_info[1];
                $marker_type->save($marker_type_data);

            }
        }
        else {
            $marker_type->update_name($marker_type_data['type_name'], $marker_type_data['id']);
        }
        $response_messages["msg"]["code"] = 0;
        $response_messages["msg"]["text"] = "Data updated.";
        print json_encode($response_messages);
        break;
    case "clear-cache":
        $sql = "DELETE FROM " . DB_STORAGE_TABLE . " WHERE data_key like :data_key";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':data_key' => INDEX_CLUSTER_MAP_KEY . '%'));
        header('Location: ' . HTTP_APP_PATH . "/settings.php?msg=cache_clear");
        exit;
        break;
    case "generate-cache":
        if($map_settings["config_enable_cache"]) {
            $cache->generate($marker->get_markers(), true);
            if(!filter_input(INPUT_GET, "no_redirect")) {
                header('Location: ' . HTTP_APP_PATH . "/settings.php?msg=cache_generated");
                exit;
            }
        }
        break;
    case "login":
        $login = filter_input(INPUT_POST, "login");
        $password = filter_input(INPUT_POST, "password");
        if($password == NXIK_GMC_USER_PASSWORD && $login == NXIK_GMC_USER_NAME) {
            $_SESSION['nxik_gmc_allowed_access'] = true;
            if(isset($_SESSION['redirect_url'])) {
                header('Location: ' . SITE_DOMAIN . $_SESSION['redirect_url']);
                exit;
            }
            else {
                header('Location: ' . HTTP_APP_PATH);
                exit;
            }
        }
        break;
    case "logout":
        unset($_SESSION['nxik_gmc_allowed_access']);
        unset($_SESSION['redirect_url']);
        header('Location: ' . HTTP_APP_PATH);
        exit;
        break;
    case "download-csv":
        $sql = "SELECT * FROM " . DB_MARKERS_TABLE . " as m left join " . DB_MARKER_TYPE_TABLE . " as mt on m.marker_type = mt.id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $filename = 'markers-'.date('Y-m-d_H-m-i').'.csv';


        $fp = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($fp, $row);
        }
        exit;
    case "import_step_2":
        $current_step = 2;
        if (isset($_FILES["import_file"]) && $_FILES["import_file"]["error"] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["import_file"]["tmp_name"];
            $file_type = mime_content_type($tmp_name);

            if(in_array($file_type , $xls_mime)) {
                $_SESSION['file_type'] = "xls";
                $upload_dir = sys_get_temp_dir();
                $import_file_path = $upload_dir . "/import_file_" . uniqid() . ".xls";
                move_uploaded_file($tmp_name, $import_file_path);
                $_SESSION['import_file_path'] = $import_file_path;
                $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($import_file_path);
                $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
                $xls_sheet_names = $objReader->listWorksheetNames($import_file_path);
            }
            elseif(in_array($file_type, $csv_mime)) {
                $current_step = 3;
                $_SESSION['file_type'] = "csv";
                $upload_dir = sys_get_temp_dir();
                $import_file_path = $upload_dir . "/import_file_" . uniqid() . ".csv";
                move_uploaded_file($tmp_name, $import_file_path);
                $_SESSION['import_file_path'] = $import_file_path;
                ini_set('auto_detect_line_endings',TRUE);
                $file_data = array_map('str_getcsv', file($import_file_path, FILE_SKIP_EMPTY_LINES));
                $row_and_column_range['totalRows'] = sizeof($file_data);
                $drop_down_columns = "";
                $num_columns = sizeof($file_data[0]);
                for($i = 1; $i <= $num_columns; $i++) {
                    $drop_down_columns .= '<option value="' . ($i - 1). '">' . $i . '</option>';
                }
            }
        }
        else {
            print "Something went wrong.3";
            exit;
        }

        break;
    case "import_step_3":
        $import_file_path = $_SESSION['import_file_path'];
        $sheet_number = $_SESSION['sheet_number'] = filter_input(INPUT_POST, 'sheet_number', FILTER_VALIDATE_INT);

        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($import_file_path);
        $objReader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $xls_sheet_names = $objReader->listWorksheetNames($import_file_path);
        if($sheet_number > sizeof($xls_sheet_names)) {
            print "'Sheet number' is out of range [0.." . (sizeof($xls_sheet_names) - 1) . "]";
            exit;
        }
        $current_step = 3;
        $worksheetData = $objReader->listWorksheetInfo($import_file_path);
        $row_and_column_range = $worksheetData[$sheet_number];

        $column_name_array = array();
        $column_index = 0;
        $column_name = "";
        do {
            $column_name = Helper::getNameFromNumber($column_index);
            $column_name_array[$column_index] = $column_name;
            $column_index++;
        }
        while($row_and_column_range['lastColumnLetter'] != $column_name);
        $drop_down_columns = "";

        foreach($column_name_array as $column_index => $column_name) {
            $drop_down_columns .= '<option value="' . $column_index . '">' . $column_name . '</option>';
        }
        break;
    case "import_step_4":
        $current_step = 4;
        $import_file_path = $_SESSION['import_file_path'];
        if($_SESSION['file_type'] == "csv") {
            $sheet_data = array_map('str_getcsv', file($import_file_path, FILE_SKIP_EMPTY_LINES));
        }
        else {
            $sheet_number = $_SESSION['sheet_number'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($import_file_path);
            $worksheet = $spreadsheet->getSheet($sheet_number);
            $sheet_data = $worksheet->toArray();
        }
        $marker_title_column = filter_input(INPUT_POST, "marker_title");
        $marker_description_column = filter_input(INPUT_POST, "marker_description");
        $marker_type_column = filter_input(INPUT_POST, "marker_type");
        $marker_latitude_column = filter_input(INPUT_POST, "marker_latitude");
        $marker_longitude_column = filter_input(INPUT_POST, "marker_longitude");
        $start_import_from = filter_input(INPUT_POST, "start_import_from");
        $start_import_to = filter_input(INPUT_POST, "start_import_to");
        $overwrite_all_data = filter_input(INPUT_POST, 'overwrite_all_data', FILTER_VALIDATE_INT);
        if($overwrite_all_data == 2) {
            $marker->deleteAll();
        }

        for($i = ($start_import_from - 1); $i < $start_import_to; $i++) {
            $marker->setTitle($sheet_data[$i][$marker_title_column]);
            $marker->setDescription(nl2br($sheet_data[$i][$marker_description_column]));
            $marker->setLat(floatval(str_replace(',', '.', $sheet_data[$i][$marker_latitude_column])));
            $marker->setLng(floatval(str_replace(',', '.',$sheet_data[$i][$marker_longitude_column])));
            $marker->setMarkerType((int)$sheet_data[$i][$marker_type_column]);
            $marker_id = $marker->add();
        }
        break;
            case "delete-marker-image":
            if ($id) {
                $marker->setId($id);
                $marker_info = $marker->getById();
                $dir = $id % 10;
                $upload_dir = APP_IMG_PATH . "/" . $dir;
                $delete_file = $upload_dir . "/" . $marker_info['id'] . "." . $marker_info['image_type'];
                if(file_exists($delete_file)) {
                    unlink($delete_file);
                }
                $marker->setImageType('');
                $marker->updateImageType();
            }
        break;
}
*/