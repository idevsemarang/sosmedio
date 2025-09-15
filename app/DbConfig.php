<?php

class DbConfig
{

    public function connection()
    {
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
        $this->logQuery($sql);

        $arrDatas = [];

        $conn = $this->connection();

        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, $sql);

            while ($row = $result->fetch_assoc()) {
                $arrDatas[] = $row;
            }
        }

        mysqli_close($conn);

        return $arrDatas;
    }


    public function setStatement($sql)
    {
        $this->logQuery($sql);

        $conn = $this->connection();

        mysqli_query($conn, $sql);

        mysqli_close($conn);
    }


    private function logQuery($sql)
    {
        $logFile = __DIR__ . '/queryLog/sql_'.date('Y-m-d').'.log';

        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[$timestamp] $sql\n";

        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
}
