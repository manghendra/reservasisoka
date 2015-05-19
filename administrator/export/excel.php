<?php
    session_start();
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    include "../../globalfunction/function.php";
    include "../../globalfunction/koneksi.php";
    include "php-excel.class.php";
    include "report.php";
    // cek login administrator
    if ((isset($_SESSION['LoginUser'])) & ($_SESSION['UserLevel']=="1"))
    {
        $type = $_GET["type"];
        if(isset($type))
        {
            switch($type)
            {
                case "LaporanBulanan" :
                    LaporanBulanan();
                break;
                
                case "LaporanBulananRange" :
                    LaporanBulananRange();
                break;
                
                case "TopTenKunjungan" :
                    TopTenKunjungan();
                break;
                
                case "TopTenOmzet" :
                    TopTenOmzet();
                break;
                
                case "ExportMenuMakanan" :
                    ExportMenuMakanan();
                break;
                
                case "ExportOrganizer" :
                    ExportOrganizer();
                break;
            }
        }
    }
?>