<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

include_once("Cluster.class.php");
include_once("Storage.class.php");

class Cache extends Storage {

    /**
     * Check if cache not empty
     *
     * @return integer
     */

    public function is_not_empty() {
        $sql = "SELECT count(*) as num_rows FROM " . DB_STORAGE_TABLE . " WHERE data_key like :data_key";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute(array(':data_key' => INDEX_CLUSTER_MAP_KEY . '%'));
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    /**
     *
     * generation cache
     *
     * @param boolean $ignore_last_update
     */

    function generate($markers_data, $ignore_last_update = false) {
        $cluster = new Cluster();
        $sql = "SELECT max(date_add) - max(last_update) FROM " . DB_MARKERS_TABLE . ", " . DB_STORAGE_TABLE . " limit 1";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();
        $time_shift_result = $sth->fetchColumn();
        if ($time_shift_result >= 0 || is_null($time_shift_result) || $ignore_last_update) {
            //$data = get_markers();
            $this->setKey("config_distance");
            $distance = $this->get_data_by_key();
            $this->setKey("config_zoom");
            $config_zoom = $this->get_data_by_key();
            for ($zoom = 1; $zoom <= $config_zoom; $zoom++) {
                if (sizeof($markers_data['rows'])) {
                    $data_rows = $cluster->clusterer($markers_data['rows'], $distance, $zoom);
                    $clustered["EMsg"] = "";
                    $clustered["Msec"] = 185;
                    $clustered["Ok"] = 1;
                    $clustered["Rid"] = 1;
                    $clustered["Count"] = sizeof($data_rows);
                    $clustered["Mia"] = 0;
                    $clustered["Polylines"] = array();
                    $clustered["Markers"] = array();
                    foreach ($data_rows as $key => $marker) {
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
                    $this->setKey(INDEX_CLUSTER_MAP_KEY . $zoom . "_filter");
                    $this->setValue($json_clustered);
                    $this->set_data_by_key();
                }
            }
        }
    }

    public function isEnabled() {
        $this->setKey("config_enable_cache");
        return $this->get_data_by_key();
    }

    public function getCacheLevel() {
        $this->setKey("config_cache_level");
        return $this->get_data_by_key();
    }

}