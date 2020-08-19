<?php
/**
 * Description of NotificationsModel 
 *
 * @author Mukesh Yadav
 */
class NotificationsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->db->reconnect();
    }
    
    
}