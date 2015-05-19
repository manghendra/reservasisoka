<?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
    $m = $_GET['m'];
    $a = $_GET['a'];
    if( isset( $m ) )
    {
        switch( $m )
        {
            default :
                //Home();
                include "reservasi.php";
                ViewReservasiToday();
            break;
            
            case "kota" :
                include "kota.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default : 
                            ViewKota();
                        break;
                        
                        case "TambahKota" :
                            TambahKota();
                        break;
                        
                        case "SimpanKota" :
                            SimpanKota();
                        break;
                        
                        case 'Edit' :
                            EditKota();
                        break;
                        
                        case 'UpdateKota' :
                            UpdateKota();
                        break;
                        
                        case "Delete" :
                            DeleteKota();
                        break;
                    }
                }
                else
                {
                    ViewKota();
                }
            break;
            
            case "tipecustomer" :
                include "customertype.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default :
                            ViewTipeCustomer();
                        break;
                        
                        case "TambahCusType" :
                            TambahTipeCustomer();
                        break;
                        
                        case "SimpanTipeCustomer" :
                            SimpanTipeCustomer();
                        break;
                        
                        case "Edit" :
                            EditTipeCustomer();
                        break;
                        
                        case "UpdateTipeCustomer" :
                            UpdateTipeCustomer();
                        break;
                        
                        case "Delete" :
                            DeleteTipeCustomer();
                        break;
                    }
                }
                else
                {
                    ViewTipeCustomer();
                }
            break;
            
            case "waktukunjungan" :
                include "waktukunjungan.php";
                ViewWaktuKunjungan();
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
                        
                        case "TambahOrganizer" :
                            TambahOrganizer();
                        break;
                        
                        case "SimpanOrganizer" :
                            SimpanOrganizer();
                        break;
                        
                        case "Edit" :
                            EditOrganizer();
                        break;
                        
                        case "UpdateOrganizer" :
                            UpdateOrganizer();
                        break;
                        
                        case "Delete" :
                            DeleteOrganizer();
                        break;
                        
                        case "TambahOrganizerPopUp" :
                            TambahOrganizerPopUp();
                        break;
                    
                        case "LoadOrganizer" :
                            LoadOrganizer();
                        break;
                    
                        case "SimpanOrganizerPopup" :
                            SimpanOrganizerPopup();
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
                        
                        case "ShowNotifOrganizer" :
                            ShowNotifOrganizer();
                        break;
                    }
                }
                else
                {
                    ViewOrganizer();
                }
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
                        
                        case "TambahPerson" :
                            TambahPerson();
                        break;
                        
                        case "SimpanPerson" :
                            SimpanPerson();
                        break;
                        
                        case "Edit" :
                            EditPerson();
                        break;
                        
                        case "UpdatePerson" :
                            UpdatePerson();
                        break;
                        
                        case "Detail" :
                            DetailPerson();
                        break;
                        
                        case "Delete" :
                            DeletePerson();
                        break;
                        
                        case "TambahPersonPopUp" :
                            TambahPersonPopUp();
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
                        
                        case "ShowNotifPerson" :
                            ShowNotifPerson();
                        break;
                    }
                }
                else
                {
                    ViewPerson();
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
                        
                        case "TambahReservasi" :
                            TambahReservasi();
                        break;
                        
                        case "LoadPerson" :
                            LoadPerson();
                        break;
                        
                        case "ReservasiStep2" :
                            ReservasiStep2();
                        break;
                        
                        case "TambahMenuRow" :
                            TambahMenuRow();
                        break;
                        
                        case "EditMenuRow" :
                            EditMenuRow();
                        break;
                        
                        case "SimpanReservasi" :
                            SimpanReservasi();
                        break;
                        
                        case "DetailReservasi" :
                            DetailReservasi();
                        break;
                        
                        case "EditStatusReservasi" :
                            EditStatusReservasi();
                        break;
                        
                        case "UpdateStatusReservasi" :
                            UpdateStatusReservasi();
                        break;
                        
                        case "EditMenuReservasi" :
                            EditMenuReservasi();
                        break;
                        
                        case "UpdateMenuReservasi" :
                            UpdateMenuReservasi();
                        break;
                        
                        case "SearchReservasi" :
                            SearchReservasi();
                        break;
                        
                        case "CariReservasi" :
                            CariReservasi();
                        break;
                        
                        case "ListMenuByJenis" :
                            ListMenuByJenis();
                        break;
                    }
                }
                else
                {
                    ViewReservasiToday();
                }
            break;
            
            case "menumakanan" :
                include "menumakanan.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        default :
                            ViewMenuMakanan();
                        break;
                        
                        case "DetailMenuMakanan" :
                            DetailMenuMakanan();
                        break;
                        
                        case "ViewMenuMakananTableSorting" :
                            ViewMenuMakananTableSorting();
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
            
            case "print" :
                include "print.php";
                if(isset($a))
                {
                    switch($a)
                    {
                        case "PrintDetailReservasi" :
                            PrintDetailReservasi();
                        break;
                        
                        case "" :
                        
                        break;
                    }
                }
            break;
        }   
    }
?>