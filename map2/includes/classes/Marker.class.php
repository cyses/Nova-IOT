<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

class Marker {
    private $_dbh;

    /**
     * properties
     */

    private $_marker_id;
    private $_title;
    private $_description;
    private $_lat;
    private $_lng;
    private $_marker_type;
    private $_image_type;

    function __construct($dbh) {
        $this->_dbh = $dbh;
    }

    public function add() {
        $stmt = $this->_dbh->prepare("INSERT INTO " . DB_MARKERS_TABLE . " (title, description, lat, lng, marker_type, image_type) VALUES (:title, :description, :lat, :lng, :marker_type, '')");
//var_dump($this);
//        if (!$stmt) {
//            echo "\nPDO::errorInfo():\n";
//            print_r($this->_dbh->errorInfo());
//        }exit;
        $stmt->bindParam(':title', $this->_title);
        $stmt->bindParam(':description', $this->_description);
        $stmt->bindParam(':lat', $this->_lat);
        $stmt->bindParam(':lng', $this->_lng);
        $stmt->bindParam(':marker_type', $this->_marker_type);
        $stmt->execute();
        $this->_marker_id = $this->_dbh->lastInsertId();
        return $this->_marker_id;
    }

    public function update() {
        $stmt = $this->_dbh->prepare("UPDATE " . DB_MARKERS_TABLE . " SET title = :title, description = :description, "
            . "lat = :lat, lng = :lng, marker_type = :marker_type WHERE id = :marker_id");
        $stmt->bindParam(':title', $this->_title);
        $stmt->bindParam(':description', $this->_description);
        $stmt->bindParam(':lat', $this->_lat);
        $stmt->bindParam(':lng', $this->_lng);
        $stmt->bindParam(':marker_type', $this->_marker_type);
        $stmt->bindParam(':marker_id', $this->_marker_id);
        $stmt->execute();
    }

    public function updateImageType() {
        $stmt = $this->_dbh->prepare("UPDATE " . DB_MARKERS_TABLE . " SET image_type = :image_type WHERE id = :marker_id");
        $stmt->bindParam(':image_type', $this->_image_type);
        $stmt->bindParam(':marker_id', $this->_marker_id);
        $stmt->execute();
    }
    public function updateDescription() {
        $stmt = $this->_dbh->prepare("UPDATE " . DB_MARKERS_TABLE . " SET description = :description WHERE id = :marker_id");
        $stmt->bindParam(':description', $this->_description);
        $stmt->bindParam(':marker_id', $this->_marker_id);
        $stmt->execute();
    }

    public function getById() {
        $sql = "SELECT * FROM " . DB_MARKERS_TABLE . " WHERE id = :markerid";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute(array(':markerid' => $this->_marker_id));
        return $sth->fetch();
    }

    public function getByTitle($title) {
        $sql = "SELECT * FROM " . DB_MARKERS_TABLE . " WHERE title = :title LIMIT 1";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute(array(':title' => $title));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteById() {
        $sql = "DELETE FROM " . DB_MARKERS_TABLE . " WHERE id = :markerid";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute(array(':markerid' => $this->_marker_id));
    }

    public function deleteAll() {
        $sql = "DELETE FROM " . DB_MARKERS_TABLE;
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute();
    }

    /**
     *
     * return array('count_num_rows', 'rows') by limit, offset, search string
     *
     * count_num_rows - numbr rows without limits
     * rows - array markers info
     *
     * @param integer $limit
     * @param integer $offset
     * @param string $search_text
     * @return array
     */

    public function get_markers($limit = 0, $offset = 0, $search_text = "", $marker_type = array(), $order_by = 'id DESC') {
        $sql_where = "";
        if (strlen($search_text) > 3) {
            $search_text = "%$search_text%";
            $sql_where .= " AND (title LIKE :search_text OR description LIKE :search_text)";
        }
        if (is_array($marker_type) && sizeof($marker_type)) {
            $sql_where .= " AND marker_type IN (" . implode(",", $marker_type) . ")";
        }
        if(strlen($sql_where)) {
            $sql_where = " WHERE 1" . $sql_where;
        }
        $sql = "SELECT count(*) FROM " . DB_MARKERS_TABLE . $sql_where;

        $sth = $this->_dbh->prepare($sql);
        if (strlen($search_text) > 3) {
            $sth->bindParam(":search_text", $search_text, PDO::PARAM_STR);
        }
        $sth->execute();
        $data['count_num_rows'] = $sth->fetchColumn();

        $sql = "SELECT * FROM " . DB_MARKERS_TABLE . $sql_where . " ORDER BY " . $order_by . " LIMIT :offset_markers, :markers_per_page";
        $sth = $this->_dbh->prepare($sql);
        if($limit == 0) {
            $limit = $data['count_num_rows'];
        }
        $offset = intval($offset);
        $limit = intval($limit);
        $sth->bindParam(":offset_markers", $offset, PDO::PARAM_INT);
        $sth->bindParam(":markers_per_page", $limit, PDO::PARAM_INT);

        if (strlen($search_text) > 3) {
            $sth->bindParam(":search_text", $search_text, PDO::PARAM_STR);
        }
        $sth->execute();

        $data['rows'] = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     *
     * get markers by lon and lat
     *
     * @param float $swlat
     * @param float $nelat
     * @param float $swlon
     * @param float $nelon
     * @return array
     */

    public function get_map_markers($swlat, $nelat, $swlon, $nelon, array $filter) {
        $sql = "SELECT id, lat, lng, marker_type
                                FROM " . DB_MARKERS_TABLE . "
                                WHERE lat BETWEEN :LAT1 AND :LAT2";
                                    //AND (lon BETWEEN LON1 AND -180 OR lon BETWEEN LON2 AND 180)";
                                //where (lat between :swlat AND :nelat) and (lng between :swlon and :nelon)";
        if($nelon < 0 && $swlon > 0) {
            $sql .= " AND (lng BETWEEN -180 AND :LON1 OR lng BETWEEN :LON2 AND 180)";
        }
        else {
            $sql .= " AND lng BETWEEN :LON1 AND :LON2";
        }
        if(sizeof($filter)) {
            $sql .= " AND marker_type IN (" . implode(", ", $filter) . ")";
        }

        $LAT1 = min($nelat, $swlat);
        $LAT2 = max($nelat, $swlat);
        $LON1 = min($nelon, $swlon);
        $LON2 = max($nelon, $swlon);

        $stmt = $this->_dbh->prepare($sql);
        $stmt->bindParam(':LAT1', $LAT1);
        $stmt->bindParam(':LAT2', $LAT2);
        $stmt->bindParam(':LON1', $LON1);
        $stmt->bindParam(':LON2', $LON2);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     *
     * count all markes in the system
     *
     * @global $dbh
     * @return integer
     *
     */

    public function count_markers() {
        $sql = "SELECT count(*) FROM " . DB_MARKERS_TABLE;
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchColumn();
    }

    public function setId($marker_id) {

        if (!is_int($marker_id)) {
            throw new \InvalidArgumentException('The Marker ID has wrong format');
        }
        $this->_marker_id = $marker_id;
    }

    public function setTitle($title) {
        if (strlen($title) == 0) {
            throw new \InvalidArgumentException('The title is too short');
        }
        $this->_title = $title;
    }

    public function setImageType($image_type) {
        $this->_image_type = $image_type;
    }

    public function setDescription($description) {
        $this->_description = $description;
    }

    public function setLat($lat) {
        if (!is_float($lat)) {
            throw new \InvalidArgumentException('The latitude has wrong format');
        }
        $this->_lat = $lat;
    }

    public function setLng($lng) {
        if (!is_float($lng)) {
            throw new \InvalidArgumentException('The longitude has wrong format');
        }
        $this->_lng = $lng;
    }

    public function setMarkerType($marker_type) {
        if (!is_int($marker_type)) {
            throw new \InvalidArgumentException('The Marker Type has wrong format');
        }
        $this->_marker_type = $marker_type;
    }

}