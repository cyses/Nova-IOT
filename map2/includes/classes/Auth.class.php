<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

class Auth {

    public static function check_access($allowed_pages) {
        if(!in_array(basename($_SERVER['SCRIPT_NAME']), $allowed_pages) && !self::is_loggedin()) {
            $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
            header('Location: ' . HTTP_APP_PATH . "login.php");
            exit;
        }
    }

    public static function is_loggedin() {
        if(isset($_SESSION['nxik_gmc_allowed_access']) && $_SESSION['nxik_gmc_allowed_access']) {
            return true;
        }
        else {
            return false;
        }
    }


}