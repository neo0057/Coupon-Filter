
<?php
require_once("db_connection.php");

/**
* Database Interaction class
*/
class DBInteraction
{
    public function fetch_table($table)
    {
        $query = "select * from $table";
        $obj = new db_connection();
        $db = $obj->connect();
        $results = mysqli_query($db, $query) or die(mysqli_error());
        while ($row = mysqli_fetch_array($results))
        { 
            echo $row['CouponCode'] , "\t" , $row['CountSuccess'], "<br>";
        }
        $obj->disconnect();
    }
}

    $db_interaction_object = new DBInteraction();
    $db_interaction_object->fetch_table('Coupon');

?>