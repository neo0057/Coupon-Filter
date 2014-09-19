<?php

/**
* Class that retrieve data from database
*/

include_once("db_connection.php");

class retrieve_data
{
    private $con;
    private $db;
    private $query;

    function __construct()
    {
        $this->con = new db_connection();
        $this->db  = $this->con->connect();
    }

    public function disconnect() {
        $this->con->disconnect();
    }
    
    public function get_all_coupons($predicate = "") {    
        $this->query = "select * from 'Coupon'" . ' ' . $predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }
    public function get_data_by_store($predicate = "") {        
        $this->query = "select * from 'Website'" . ' ' .$predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }
    public function get_data_by_categories($predicate = "") {
        $this->query = "select * from 'CouponCategories' " . $predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }

    public function get_all_data($table, $predicate = "") {
        $this->query = "select * from '" . $table . "' " . $predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }

    public function get_WebsiteName($WebsiteID) {
        $this->query = "select 'WebsiteName' from 'Website' WHERE 'WebsiteID' = '" . $WebsiteID . "'";
        $results = mysqli_query($this->db, $this->query);
        $row = mysqli_fetch_array($results);
        return $row;
    }

    public function get_CategoryName($CategoryID) {
        $this->query = "select 'Name' from 'CouponCategories' WHERE 'CategoryID' = '" . $CategoryID . "'";
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }

    public function get_count($table, $predicate = "") {
        $this->query = 'select count(*) from ' . $table . ' ' .$predicate;
        $results = mysqli_query($this->db, $this->query);
        while( $row = mysqli_fetch_array($results, MYSQL_NUM) ) {
            return $row[0];
        }
    }
}

?>