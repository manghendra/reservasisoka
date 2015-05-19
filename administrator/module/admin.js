// function to set user inactive
function SetUserNonactive(Username, Nama, IsUsername)
{
    if(IsUsername=="1")
    {
        new Messi('Anda tidak dapat menonaktifkan diri anda sendiri!', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 1, label: 'Close', val: 'N', btnClass: 'btn-success'}]
        });   
    }
    else
    {
        new Messi('Apakah anda ingin menon-aktifkan user : <b>' + Username + '</b>( '+ Nama + ')', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-success'}], 
        callback: function(val) 
                    {
                        if (val=="Y")
                        {
                            parent.window.location = '?m=user&a=SetUserNonactive&Username='+Username;
                        }
                    }
        });   
    }
}
// END function to user inactive

// function set user active
function SetUserActive(Username, Nama)
{
    new Messi('Apakah anda ingin mengaktifkan user : <b>' + Username + '</b>( '+ Nama + ')', {title: 'Info', modal: true, titleClass: 'info', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-success'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-danger'}], 
        callback: function(val) 
                    {
                        if (val=="Y")
                        {
                            parent.window.location = '?m=user&a=SetUserActive&Username='+Username;
                        }
                    }
        });   
}
// END set user active

// function detail user
function DetailUser(Username)
{
    Messi.load('module/content.php?m=user&a=DetailUser&Username='+Username, {title: 'Detail User', modal: true, titleClass: 'info', width: '450px', buttons: [{id: 0, label: 'Reset Password', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'Close', val: 'N', btnClass: 'btn-success'}], 
    callback: function(val) 
                {
                    if (val=="Y")
                    {
                        parent.window.location = '?m=user&a=ResetPassword&Username='+Username;
                    }
                }
    });
}
// END function detail user

// function delete menu makanan confirm
function DeleteMenuMakananConfirm(IdMenuMakanan, MenuMakanan)
{
    new Messi('Apakah anda yakin menghapus menu :<b>' + MenuMakanan + '</b>' , {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-success'}], 
    callback: function(val) 
                {
                    if (val=="Y")
                    {
                        parent.window.location = '?m=menumakanan&a=Delete&IdMenuMakanan='+IdMenuMakanan;
                    }
                }
    });
}
// END function delete menu makanan confirm


// function tampilkan search reservasi
function TampilkanReservasi()
{
    StartDate = $("#StartDate").val();
    EndDate = $("#EndDate").val();
    StatusReservasi = $("#StatusReservasi").val();
    if((StartDate=="") & (EndDate==""))
    {
        new Messi('Rentang tanggal harus diisi!', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Close', val: 'X', class: 'btn-danger'}]});
        return false;
    }
    else
    {
        url = "module/content.php?m=reservasi&a=SearchReservasi&StartDate="+StartDate+"&EndDate="+EndDate+"&StatusReservasi="+StatusReservasi;
        $("#ReservasiTabel").hide();
        $("#ReservasiTabel").load(url);
        $("#ReservasiTabel").fadeIn("slow");
    }
}
// END function tampilkan search reservasi

// function cari reservasi
function SearchReservasi()
{
    KeyWord = $("#KeyWord").val();
    
    if(KeyWord!="")
    {
        url = "module/content.php?m=reservasi&a=CariReservasi&KeyWord="+KeyWord;
        $("#ReservasiTabel").hide();
        $("#ReservasiTabel").load(url);
        $("#ReservasiTabel").fadeIn("slow");
    }
    else
    {
        new Messi('Keyword harus diisi!', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Close', val: 'X', class: 'btn-danger'}]});
        return false;
    }
}
// END function cari reservasi

// function view detail reservasi
function ViewDetailReservasi(IdReservasi)
{
    parent.window.location ='?m=reservasi&a=DetailReservasi&IdReservasi='+IdReservasi;
}
// END function view detail reservasi

// end function
function TampilkanLaporanBulanan(BulanTahun) 
{
    BulanTahun = $("#BulanTahun").val();
    RentangWaktu = $("#RentangWaktu").val();
    if(BulanTahun!="")
    {
        url = "module/content.php?m=report&a=TampilkanLaporanBulanan&BulanTahun="+BulanTahun+"&RentangWaktu="+RentangWaktu;
        $("#ShowReport").hide();
        $("#ShowReport").load(url);
        $("#ShowReport").fadeIn("slow");
    }
}
// end function 

// function tampilkan report bulanan reange
function TampilkanLaporanBulananRange()
{
    StartDate = $("#StartDate").val();
    EndDate = $("#EndDate").val();
    RentangWaktu = $("#RentangWaktuRange").val();
    
    // cek if empty
    if((StartDate!="") & (EndDate!=""))
    {
        url = "module/content.php?m=report&a=TampilkanLaporanBulananRange&StartDate="+StartDate+"&EndDate="+EndDate+"&RentangWaktu="+RentangWaktu;
        $("#ShowReport").hide();
        $("#ShowReport").load(url);
        $("#ShowReport").fadeIn("slow");
    }
    else
    {
        new Messi('Rentang tanggal harus diisi!', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Close', val: 'X', class: 'btn-danger'}]});
    }
    // END cek if empty
}
// END function tampilkan report bulanan range


// function tampilkan top 10
function TampilkanTop10()
{
    var BulanTahun = $("#BulanTahunTopTen").val();
    
    if(BulanTahun!="")
    {
        url = "module/content.php?m=report&a=TampilkanTop10&BulanTahun="+BulanTahun;
        $("#ShowReport").hide();
        $("#ShowReport").load(url);
        $("#ShowReport").fadeIn("slow");
    }
}
// END function tampilkan top 10


// function view menu makanan sorting
function ViewMenuMakananTableSorting()
{
    var IdJenisMakanan = $("#SortingMakanan").val();
    
    if(IdJenisMakanan!="")
    {
        if(IdJenisMakanan=="0")
        {
            parent.window.location ='?m=menumakanan';
        }
        else
        {
            url = "module/content.php?m=menumakanan&a=ViewMenuMakananTableSorting&IdJenisMakanan="+IdJenisMakanan;
            $("#MenuTable").hide();
            $("#MenuTable").load(url);
            $("#MenuTable").fadeIn("slow");
        }
    }
}
// END funciton view menu makanan sorting

// function detail menu makanan
function DetailMenuMakanan(IdMenuMakanan)
{
    Messi.load("module/content.php?m=menumakanan&a=DetailMenuMakanan&IdMenuMakanan="+IdMenuMakanan, 
    {title: 'Detail Menu Makanan', titleClass: 'info', modal: true, width: '500px', buttons: [{id: 0, label: 'Close', val: 'X', btnClass: 'btn-success'}]});
}
// END function detail menu makanan

// function export menu makanan
function ExportMenuMakanan()
{
    parent.window.location ="export/excel.php?type=ExportMenuMakanan";
}
// END function export menu makanan

// function export menu makanan
function ExportOrganizer()
{
    parent.window.location ="export/excel.php?type=ExportOrganizer";
}
// END function export menu makanan

// function detail person
function DetailPerson(IdPerson)
{
    Messi.load("module/content.php?m=person&a=Detail&IdPerson="+IdPerson, 
    {title: 'Detail Person', titleClass: 'info', modal: true, width: '450px', buttons: [{id: 0, label: 'Close', val: 'X', btnClass: 'btn-success'}]});
}
// END function deteil person