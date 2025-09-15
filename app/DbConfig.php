<?php

class DbConfig{

    public function connection() { 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "idev_sosmedio";
        
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: "
            . mysqli_connect_error());
        }

        return $conn;
    }


    public function getRows($sql) 
    {
        $arrDatas = [];

        $conn = $this->connection();

        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, $sql);

            while($row = $result->fetch_assoc()) {                
                $arrDatas[] = $row;
            }
        } 
        
        mysqli_close($conn);

        return $arrDatas;
    }


    public function setStatement($sql)
    {
        $conn = $this->connection();

        mysqli_query($conn, $sql);
        
        mysqli_close($conn);
    }

}