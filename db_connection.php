<?php

/**
* database connection class
*/
class db_connection
{
    private $db_con;

    public function connect()
    {
        try{
            $server   = "localhost";
            $user     = "root";
            $password = '';
            $db_name  = "cd_svn";
            $this->db_con = mysqli_connect($server, $user, $password, $db_name);
            if( !$this->db_con ) {
                throw new Exception("Error Processing Request", 1);
            }
            return $this->db_con;
        }
        catch(Exception $ex){
            echo "failure in database connection " , $ex , "<br>";
        }
    }
    public function disconnect(){
        mysqli_close($this->db_con);
    }
}

?>