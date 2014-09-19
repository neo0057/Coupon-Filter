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
    
    public function get_all_coupons($predicate = 'WHERE 1') {
        $this->query = 'select * from Coupon' . ' ' . $predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }
    public function get_data_by_store($predicate = "WHERE 1") {
        $this->query = 'select * from Website' . ' ' .$predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }
    public function get_data_by_categories($predicate = "WHERE 1") {
        $this->query = 'select * from CouponCategories ' . $predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }

    public function get_all_data($table, $predicate = "WHERE 1") {
        $this->query = 'select * from ' . $table . ' ' . $predicate;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }

    public function get_WebsiteName($WebsiteID) {
        $this->query = 'select WebsiteName from Website WHERE WebsiteID = ' . $WebsiteID . '';
        $results = mysqli_query($this->db, $this->query);
        while( $row = mysqli_fetch_array($results, MYSQL_NUM) ) {
            return $row[0];
        }
    }

    public function get_SubCategoryName($SubCategoryID) {
        $this->query = 'select Name from CouponSubCategories WHERE SubCategoryID = ' . $SubCategoryID . '';
        $results = mysqli_query($this->db, $this->query);
        while( $row = mysqli_fetch_array($results, MYSQL_NUM) ) {
            return $row[0];
        }
    }

    public function get_CategoryName($categoryID)
    {
        $this->query = 'select Name from CouponCategories WHERE CategoryID = ' . $categoryID . '';
        $results = mysqli_query($this->db, $this->query);
        while( $row = mysqli_fetch_array($results) ) {
            return $row['Name'];
        }
    }

    public function get_count($table, $predicate = "WHERE 1") {
        $this->query = 'select count(*) from ' . $table . ' ' .$predicate;
        $results = mysqli_query($this->db, $this->query);
        while( $row = mysqli_fetch_array($results, MYSQL_NUM) ) {
            if (is_null($row[0])) {
                return 0;
            }
            return $row[0];
        }
    }

    public function execute_query($query)
    {
        $this->query = $query;
        $results = mysqli_query($this->db, $this->query);
        return $results;
    }
}

?>