<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

class Marker_type {

    private $_dbh;
    function __construct($dbh) {
        $this->_dbh = $dbh;
    }

    public function save(array $data) {
        if(!isset($data['id']) || $data['id'] == 0) {
            try {
                $stmt = $this->_dbh->prepare("INSERT INTO " . DB_MARKER_TYPE_TABLE . " (type_name, image_type, image_width, image_height) VALUES (:type_name, :image_type, :image_width, :image_height)");
                $stmt->bindParam(':type_name', $data['type_name']);
                $stmt->bindParam(':image_type', $data['image_type']);
                $stmt->bindParam(':image_width', $data['image_width']);
                $stmt->bindParam(':image_height', $data['image_height']);
                $stmt->execute();
				
                $data['id'] = $this->_dbh->lastInsertId();
			     //$data['id']  = 1;
            }
            catch(PDOException $e) {
                print "Error!: " . $e->getMessage() . "</br>";
            }
        }
        else {
            try {
                $stmt = $this->_dbh->prepare("UPDATE " . DB_MARKER_TYPE_TABLE . " SET type_name = :type_name, image_type = :image_type, "
                    . "image_width = :image_width, image_height = :image_height WHERE id = :marker_type_id");
                $stmt->bindParam(':type_name', $data['type_name']);
                $stmt->bindParam(':image_type', $data['image_type']);
                $stmt->bindParam(':image_width', $data['image_width']);
                $stmt->bindParam(':image_height', $data['image_height']);
                $stmt->bindParam(':marker_type_id', $data['id']);
                $stmt->execute();
            }
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "</br>";
            }

        }
        return $data['id'];
    }

    public function update_name($name, $id) {
        try {
            $stmt = $this->_dbh->prepare("UPDATE " . DB_MARKER_TYPE_TABLE . " SET type_name = :type_name WHERE id = :marker_type_id");
            $stmt->bindParam(':type_name', $name);
            $stmt->bindParam(':marker_type_id', $id);
            $stmt->execute();
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "</br>";
        }
    }

    public function get() {
        $sql = "SELECT * FROM " . DB_MARKER_TYPE_TABLE . " ORDER BY id asc";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_pin_image() {
        $pinImage = array();
        $marker_types = $this->get();
        foreach($marker_types as $marker_type) {
            $pinImage[$marker_type['id']] = array(
                            "type_name" => $marker_type['type_name'], //marker type
                            "src" => $this->get_image($marker_type['id'], $marker_type['image_type']), //marker image
                            "height" => (int)$marker_type['image_height'], //image height
                            "width" => (int)$marker_type['image_width'], //image width
                            "offsetH" => 0,
                            "offsetW" => 0
            );
        }
        return $pinImage;
    }

    public function getById($id) {
        $sql = "SELECT * FROM " . DB_MARKER_TYPE_TABLE . " WHERE id = :markerid LIMIT 1";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute(array(':markerid' => (int) $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByName($type_name) {
        $sql = "SELECT * FROM " . DB_MARKER_TYPE_TABLE . " WHERE type_name = :type_name LIMIT 1";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute(array(':type_name' => $type_name));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function get_image($id, $image_extension = "", $path_type = "") {
        if($image_extension == "") {
            $marker_type_data = $this->getById($id);
            $image_extension = $marker_type_data["image_type"];
        }
        switch ($path_type) {
            default:
            case "http":
                return HTTP_ICO_PATH . $id . "." . $image_extension;
                break;
            case "dir":
                return APP_ICO_PATH . $id . "." . $image_extension;

        }

    }

    public function deleteById($id) {
        $sql = "DELETE FROM " . DB_MARKER_TYPE_TABLE . " WHERE id = :markerid";
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute(array(':markerid' => (int) $id));
        return $id;
    }

    public function deleteAll() {
        $sql = "DELETE FROM " . DB_MARKER_TYPE_TABLE;
        $stmt = $this->_dbh->prepare($sql);
        $stmt->execute();
    }

}