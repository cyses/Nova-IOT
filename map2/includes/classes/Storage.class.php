<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

class Storage {

    protected $_dbh;

    /**
     * properties
     */

    private $_key;
    private $_value;

    function __construct($dbh) {
        $this->_dbh = $dbh;
    }


    /**
     *
     * Get map settings from db
     *
     * @return array|boolean
     */


    public function get_settings() {
        $sql = "SELECT * FROM " . DB_STORAGE_TABLE . " WHERE data_key like 'config%'";
        $sth = $this->_dbh->prepare($sql);
        $sth->execute();
        $settings_array = array();

        $data_array = $sth->fetchAll(PDO::FETCH_ASSOC);
        if($data_array) {
            foreach($data_array as $data) {
                $settings_array{$data['data_key']} = $data['data_value'];
            }
            return $settings_array;
        }
        else {
            return false;
        }
    }

    /**
     *
     * save data key => value
     *
     * @param string $data_key
     * @param mixed $data_value
     * @return boolean
     *
     */

    public function set_data_by_key() {
        $sql = "INSERT INTO " . DB_STORAGE_TABLE . " (data_key, data_value) VALUES (:data_key, :data_value) ON DUPLICATE KEY UPDATE data_value = :data_value;";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(":data_key", $this->_key, PDO::PARAM_STR);
        $sth->bindParam(":data_value", $this->_value, PDO::PARAM_STR);
        $sth->execute();
        return true;
    }


    /**
     *
     * get data by key
     *
     * @param tring $data_key
     * @return mixed
     */

    public function get_data_by_key() {
        $sql = "SELECT `data_value` FROM " . DB_STORAGE_TABLE . " WHERE `data_key` = :data_key";
        $sth = $this->_dbh->prepare($sql);
        $sth->bindParam(":data_key", $this->_key, PDO::PARAM_STR);
        $sth->execute();
        return $sth->fetchColumn();
    }

    public function setKey($key) {
        if (strlen($key) == 0) {
            throw new \InvalidArgumentException('The key is too short');
        }
        $this->_key = $key;

    }
    public function setValue($value) {
        $this->_value = $value;
    }
}