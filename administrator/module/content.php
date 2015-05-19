<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    $m = $_GET['m'];
    $a = $_GET['a'];
    if( isset( $m ) )
    {
        switch( $m )
        {
            default :
                include "reservasi.php";
                ViewReservasiToday();
            break;
            
            case "user" :
                include "user.php";
                if(isset($a))
                {
                    switch( $a )
                    {
                        default :
                            ViewUser();
                        break;
                        
                        case "ViewUser" :
                            ViewUser();
                        break;
                        
                        case "NewUser" :
                            NewUser();
                        break;
                        
                        case "SaveUser" :
                            SaveUser();
                        break;
                        
                        case "SetUserNonactive" :
                            SetUserNonactive();
                        break;
                        
                        case "SetUserActive" :
                            SetUserActive();
                        break;
                        
                        case "EditUser" :
                            EditUser();
                        break;
                        
                        case "UpdateUser" :
                            UpdateUser();
                        break;
                        
                        case "DetailUser" :
                            DetailUser();
                        break;
                        
                        case "ResetPassword" :
                            ResetPassword();
                        break;
                        
                        case "UpdateUserPassword" :
                            UpdateUserPassword();
                        break;
                    }
                }
                else
                {
                    ViewUser();
                }
            break;
            
            case "menumakanan" :
                include "menumakanan.php";
                if(isset($a))
                {
                    switch( $a )
                    {
                        default :
                            ViewMenuMakanan();
                        break;
                        
                        case "TambahMenu" :
                            TambahMenuMakanan();
                        break;
                        
                        case "SimpanMenu" :
                            SimpanMenuMakanan();
                        break;
                        
                        case "Edit" :
                            EditMenuMakanan();
                        break;
                        
                        case "UpdateMenu" :
                            UpdateMenuMakanan();
                        break;
                        
                        case "Delete" :
                            DeleteMenuMakanan();
                        break;
                        
                        case "ViewMenuMakananTableSorting" :
                            ViewMenuMakananTableSorting();
                        break;
                        
                        case "DetailMenuMakanan" :
                            DetailMenuMakanan();
                        break;
                        
                        case "ViewMenuMakananTable" :
                            ViewMenuMakananTable();
                        break;
                        
                    }
                }
                else
                {
                    ViewMenuMakanan();
                }
            break;
            
            case "jenismenu" :
                include "jenismenu.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default :
                            ViewJenisMenu();
                        break;
                        
                        case "TambahJenisMenu" :
                            TambahJenisMenu();
                        break;
                        
                        case "SimpanJenisMenu" :
                            SimpanJenisMenu();
                        break;
                        
                        case "EditJenisMenu" :
                            EditJenisMenu();
                        break;
                        
                        case "UpdateJenisMenu" :
                            UpdateJenisMenu();
                        break;
                        
                        case "DeleteJenisMenu" :
                            DeleteJenisMenu();
                        break;
                    }
                }
                else
                {
                    ViewJenisMenu();
                }
            break;
            
            case "reservasi" :
                include "reservasi.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default :
                            ViewReservasiToday();
                        break;
                        
                        case "SearchReservasi" :
                            SearchReservasi();
                        break;
                        
                        case "CariReservasi" :
                            CariReservasi();
                        break;
                        
                        case "DetailReservasi" :
                            DetailReservasi();
                        break;
                        
                        case "" :
                        
                        break;
                        
                        case "" :
                            
                        break;
                    }    
                }
                else
                {
                    ViewReservasiToday();
                }
            break;
            
            case "report" :
                include "report.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default :
                            ViewReport();
                        break;
                        
                        case "TampilkanLaporanBulanan" :
                            TampilkanLaporanBulanan();
                        break;
                        
                        case "TampilkanTop10" :
                            TampilkanTop10();
                        break;
                        
                        case "TampilkanLaporanBulananRange" :
                            TampilkanLaporanBulananRange();
                        break;
                    }
                }
                else
                {
                    ViewReport();
                }
            break;
            
            case "organizer" :
                include "organizer.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default :
                            ViewOrganizer();
                        break;
                        
                        case "DetailOrganizer" :
                            DetailOrganizer();
                        break;
                        
                        case "SearchOrganizer" :
                            SearchOrganizer();
                        break;
                        
                        case "ViewOrganizerTablePage" :
                            ViewOrganizerTablePage();
                        break;
                    }
                }
                else
                {
                    ViewOrganizer();
                }
            break;
            
            case "tipecustomer" :
                include "customertype.php";
                ViewTipeCustomer();
            break;
            
            case "person" :
                include "person.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default : 
                            ViewPerson();
                        break;
                        
                        case "SearchPerson" :
                            SearchPerson();
                        break;
                        
                        case "SortPerson" :
                            SortPerson();
                        break;
                        
                        case "ViewPersonTablePage" :
                            ViewPersonTablePage();
                        break;
                        
                        case "Detail" :
                            DetailPerson();
                        break;
                        
                        case "SearchPerson" :
                            SearchPerson();
                        break;
                        
                        case "SortPerson" :
                            SortPerson();
                        break;
                        
                        case "ViewPersonTablePage" :
                            ViewPersonTablePage();
                        break;
                    }
                }
                else
                {
                    ViewPerson();
                }
            break;
            
            case "kota" :
                include "kota.php";
                ViewKota();
            break;
            
            case "print" :
                include "print.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        case "PrintTopTenOrganizerOmzet" :
                            PrintTopTenOrganizerOmzet();
                        break;
                        
                        case "PrintTopTenOrganizerKunjungan" :
                            PrintTopTenOrganizerKunjungan();
                        break;
                        
                        case "PrintLaporanBulanan" :
                            PrintLaporanBulanan();
                        break;
                        
                        case "PrintLaporanBulananRange" :
                            PrintLaporanBulananRange();
                        break;
                        
                        case "PrintDetailReservasi" :
                            PrintDetailReservasi();
                        break;
                    }
                }
            break;
        }  
    }
?>