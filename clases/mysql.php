<?php

# Class for create the conexion with MySQL

class MySQL {
    # Definition os the attributes

    private $conexion;         # Conexion with DataBase
    private $total_querys;           # Total of executed querys 

    # Set the conexion with arguments

    public function MySQL($server="localhost", $user="root", $pwd="root", $db="prensara") {
        # Check if the conexion exist  
        if (!isset($this->conexion)) {
            $this->conexion = (mysql_connect($server, $user, $pwd)) or die(mysql_error());
            mysql_select_db($db, $this->conexion) or die(mysql_error());
        }
    }

    # Execute the query
    public function query($query) {
        # Increment the number of querys
        $this->total_querys++;
        # Execute the query
        $result = mysql_query($query, $this->conexion);
        # Check the result  
        if (!$result) {
            echo 'MySQL Error: ' . mysql_error();
        }
        return $result;
    }

    # Return the collection result of the query

    public function fetch_array($query) {
        return mysql_fetch_array($query);
    }

    # Return the number of the rows of the query 

    public function num_rows($query) {
        return mysql_num_rows($query);
    }

    # Return the total of the executed querys 

    public function getTotalQuerys() {
        return $this->total_querys;
    }

}

?>  