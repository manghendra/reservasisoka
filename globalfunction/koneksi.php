<?php

//class untuk koneksi ke internal host
class koneksi
{
    var $status = 0; // 0 > eror ; 1 > sukses
    var $baris = array();
    var $err ="";
    var $qty = 0;
    var $insert_id = 0;
    
    // function query sql
    function dbquery($sql)
    {
        $this->sql = $sql;
        // konfigurasi koneksi internal
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "db_reservasi";

        $conn = mysql_connect($dbhost, $dbuser, $dbpass);
        mysql_select_db($dbname);
        $hasil = mysql_query($sql);
        
        $this->insert_id = mysql_insert_id();
        // error yang terjadi
        $this->err = "#Error ".mysql_errno($conn)." : ".mysql_error($conn);
        mysql_close($conn);
        return $hasil;

    }
    // function 
    
    function exec_query($sql)
    {
        if ($this->dbquery($sql))
        {
            $this->status=1;
        }
        else
        {
            $this->status=0;
        }
    }
    function select($sql)
    {
        $this->baris = array();
        $this->qty = 0;
        if ($hasil = $this->dbquery($sql))
        {
            while ($br=  mysql_fetch_array($hasil))
            {
                $this->baris[] = $br;
            }
            $this->qty =count($this->baris);
            $this->status=1;
        }
        else
        {
            $this->status=0;
        }
    }
}
// END class untuk koneksi ke internal host
?>