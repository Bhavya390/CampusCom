<?php
 
class DB_Functions {
 
    private $db;
 
    function __construct() {
        include_once './db_connect.php';
        // Connect to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
    // destructor
    function __destruct() {
 
    }
    /**
     * Insert new user
     * 
     */
    public function insertUser($emailId, $gcmRegId) {
        // Insert user into database
        $result = mysql_query("INSERT INTO gcmusers (name,gcmregid) VALUES('$emailId','$gcmRegId')");        
        if ($result) {
            return true;
        } else {             
            return false;                      
        }
    }
    /**
     * Select all user
     * 
     */
     public function getAllUsers() {
        $result = mysql_query("select * FROM gcmusers");
        return $result;
    }
    /**
     * Get GCMRegId
     * 
     */
    public function getGCMRegID($emailID){
         $result = mysql_query("SELECT gcmregid FROM gcmusers WHERE name = "."'$emailID'");
         return $result;
    }
}
?>
