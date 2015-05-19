// function delete kota confirm
function DeleteKotaConfirm(IdKota, Kota)
{
    new Messi('Apakah anda yakin menghapus kota :' + Kota , {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-success'}], 
    callback: function(val) 
                {
                    if (val=="Y")
                    {
                        parent.window.location = '?m=kota&a=Delete&IdKota='+IdKota;
                    }
                }
    });
}
// END function delete kota confirm

// function delete tipe customer
function DeleteTipeCustConfirm(IdTipeCustomer, TipeCustomer)
{
    new Messi('Apakah anda yakin menghapus tipe customer :' + TipeCustomer , {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-success'}], 
    callback: function(val) 
                {
                    if (val=="Y")
                    {
                        parent.window.location = '?m=tipecustomer&a=Delete&IdTipeCustomer='+IdTipeCustomer;
                    }
                }
    });
}
// END function delete tipe customer confirm


// function delete organizer confirm
function DeleteOrganizerConfirm(IdOrganizer, Organizer)
{
    new Messi('Apakah anda yakin menghapus organizer : <b>' + Organizer + '<b>', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-success'}], 
    callback: function(val) 
                {
                    if (val=="Y")
                    {
                        parent.window.location = '?m=organizer&a=Delete&IdOrganizer='+IdOrganizer;
                    }
                }
    });
}
// END function delete organizer confirm

// function delete person confirm
function DeletePersonConfirm(IdPerson, Nama)
{
    new Messi('Apakah anda yakin menghapus person : <b>' + Nama + '</b>', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-success'}], 
    callback: function(val) 
                {
                    if (val=="Y")
                    {
                        parent.window.location = '?m=person&a=Delete&IdPerson='+IdPerson;
                    }
                }
    });
}
// END function delete person confirm

// function detail person
function DetailPerson(IdPerson)
{
    Messi.load("module/content.php?m=person&a=Detail&IdPerson="+IdPerson, 
    {title: 'Detail Person', titleClass: 'info', modal: true, width: '450px', buttons: [{id: 0, label: 'Close', val: 'X', btnClass: 'btn-success'}]});
}
// END function deteil person


// function load person
function LoadPerson(IdOrganizer, FromSave)
{
    if(IdOrganizer!="")
    {
        $("#IdPerson").prop('disabled', false);
        $("#IdPerson").load('module/content.php?m=reservasi&a=LoadPerson&IdOrganizer='+IdOrganizer);
        $("#TambahPersonAnchor").attr('onclick', 'TambahPersonPopUp('+IdOrganizer+')');
        if(FromSave=="0")
        {
            ShowNotifOrganizer(IdOrganizer);
        }
    }
    else
    {
        $("#IdPerson").empty();
        $("#IdPerson").prop('disabled', true);
        $("#TambahPersonAnchor").attr('onclick', '');
    }
}
// END function load person

// function show notit organizer
function ShowNotifOrganizer(IdOrganizer)
{
    CloseMessi();
    $.ajax({
        url:"module/content.php?m=organizer&a=ShowNotifOrganizer&IdOrganizer="+IdOrganizer,
        success:function(result)
                {
                    if(result!=null)
                    {
                        new Messi(result, {center: false, autoclose:1000, viewport: {top: '230px', left: '725px'}, width: '350px'});   
                    }
                }
    });
}
// END function show notif organizer
function ShowNotifPerson()
{
    IdPerson = $("#IdPerson").val();
    CloseMessi();
    $.ajax({
        url:"module/content.php?m=person&a=ShowNotifPerson&IdPerson="+IdPerson,
        success:function(result)
                {
                    if(result!=null)
                    {
                        new Messi(result, {center: false, autoclose:1000, viewport: {top: '300px', left: '725px'}, width: '350px'});   
                    }
                }
    });
}
// function show notif person

// END function show notif person

// function tambah organizer popup
function TambahOrganizerPopUp()
{
    Messi.load("module/content.php?m=organizer&a=TambahOrganizerPopUp", 
    {title: 'Tambah Organizer', titleClass: 'info', modal: true, width: '450px'});
}
// END function tambah organizer popup

// close messi box
function CloseMessi()
{
    $('.messi').remove();
    $('.messi-modal').remove();
    //$(this.messi).hide();
    
}
// END close messi box

// function load organizer
function LoadOrganizer()
{
    $("#IdOrganizer").load('module/content.php?m=organizer&a=LoadOrganizer');
}
// END function load oranizer

// function simpan organizer pop-up
function SimpanOrganizerPopUp()
{
    $('#formID2').submit(function() {
        if (jQuery("#formID2").validationEngine('validate'))
        {
            $.ajax
                ({
         			type: 'POST',
         			url: $(this).attr('action'),
         			data: $(this).serialize(),
         			success: function(data) 
                    {
        				CloseMessi();
                        LoadOrganizer();
         			}
                });   
        }
  		return false;
    });
}


// function tambah person popup
function TambahPersonPopUp(IdOrganizer)
{
    Messi.load("module/content.php?m=person&a=TambahPersonPopUp&IdOrganizer="+IdOrganizer, 
    {title: 'Tambah Person', titleClass: 'info', modal: true, width: '470px'});
}
// END tambah personpopup


// function simpan user popup
function SimpanPersonPopUp(IdOrganizer)
{
    $('#formID2').submit(function() {
        if (jQuery("#formID2").validationEngine('validate'))
        {
            $.ajax
                ({
         			type: 'POST',
         			url: $(this).attr('action'),
         			data: $(this).serialize(),
         			success: function(data) 
                    {
        				CloseMessi();
                        LoadPerson(IdOrganizer, '1');
         			}
                });   
        }
  		return false;
    });
}
// END function simpan user popup

// function tambah row menu
function TambahRowMenu(IdMenuMakanan)
{
    // cek menu makanan
    var status = CekInputMenu(IdMenuMakanan);
    if(status)
    {
        Messi.load("module/content.php?m=reservasi&a=TambahMenuRow&IdMenuMakanan="+IdMenuMakanan, 
        {title: 'Tambah Menu', titleClass: 'info', modal: true, width: '300px'});   
    }
    else
    {
        new Messi('Maaf item sudah diinputkan', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Close', val: 'X', class: 'btn-danger'}]});
    }
}
// END function tambah row menu

// function append row
function AppendRow()
{
    $('#formID2').submit(function() {
        if (jQuery("#formID2").validationEngine('validate'))
        {
            var IdMenuMakanan = $("#IdMenuMakanan").val();
            var MenuMakanan = $("#MenuMakanan").val();
            var Harga = $("#Harga").val();
            var JumlahItem = $("#JumlahItem").val();
            var Notes = $("#Notes").val();
            var TotalHarga = JumlahItem * Harga;
            $('#table_trans').append(
                "<tr>" + 
                    "<input type='hidden' name='IdMenuMakanan[]' value='"+IdMenuMakanan+"' />" +
                    "<input type='hidden' name='MenuMakanan[]' value='"+MenuMakanan+"' />" +
                    "<input type='hidden' name='Harga[]' value='"+Harga+"' />" +
                    "<input type='hidden' name='JumlahItem[]' value='"+JumlahItem+"' />" +
                    "<input type='hidden' name='TotalHarga[]' value='"+TotalHarga+"' />" +
                    "<input type='hidden' name='NotesMenu[]' value='"+Notes+"' />" +
                    "<td class='align_top'>"+ MenuMakanan + "</td>" +
                    "<td class='align-right align_top'>" + Harga + "</td>" +
                    "<td class='align-right align_top'>" + JumlahItem + "</td>" + 
                    "<td class='align-right align_top'>" + TotalHarga + "</td>" +
                    "<td class='align_top'>" + Notes + "</td>" +
                    "<td class='align-center align_top'>"+
                        "<a href='javascript:void(0)' onclick='DeleteRow(this)'><img src='../images/denided.png' title='Hapus'/></a>"+
                        "<a href='javascript:void(0)' onclick='EditRowMenu(this, "+IdMenuMakanan+", "+JumlahItem+", `"+Notes+"`)' style='margin-left: 20px;'><img src='../images/i_edit.png' title='Edit' /></a>"+
                    "</td>" + 
                "</tr>"
                );
            UpdateSummaryHarga();
            CloseMessi();
        }
  		return false;
    });
}
// END function append row

// function delete row
function DeleteRow(row)
{
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('table_trans').deleteRow(i);
    UpdateSummaryHarga();
}
// END function delete roe

// function edit row
function EditRowMenu(row, IdMenuMakanan, JumlahItem, Notes)
{
    var i=row.parentNode.parentNode.rowIndex;
    Messi.load("module/content.php?m=reservasi&a=EditMenuRow&IdMenuMakanan="+IdMenuMakanan+"&JumlahItem="+JumlahItem+"&Notes="+Notes+"&RowIndex="+i, 
    {title: 'Edit Menu', titleClass: 'info', modal: true, width: '300px'});
}
// END function edit row

// function update row
function UpdateRow()
{
    $('#formID2').submit(function() {
        if (jQuery("#formID2").validationEngine('validate'))
        {
            var IdMenuMakanan = $("#IdMenuMakanan").val();
            var MenuMakanan = $("#MenuMakanan").val();
            var Harga = $("#Harga").val();
            var JumlahItem = $("#JumlahItem").val();
            var RowIndex = $("#RowIndex").val();
            var Notes = $("#Notes").val();
            var TotalHarga = JumlahItem * Harga;
            //var TotalHargaRp = ConvertRupiah(TotalHarga);
            document.getElementById('table_trans').deleteRow(RowIndex);
            $('#table_trans').append(
                "<tr>" + 
                    "<input type='hidden' name='IdMenuMakanan[]' value='"+IdMenuMakanan+"' />" +
                    "<input type='hidden' name='MenuMakanan[]' value='"+MenuMakanan+"' />" +
                    "<input type='hidden' name='Harga[]' value='"+Harga+"' />" +
                    "<input type='hidden' name='JumlahItem[]' value='"+JumlahItem+"' />" +
                    "<input type='hidden' name='TotalHarga[]' value='"+TotalHarga+"' />" +
                    "<input type='hidden' name='NotesMenu[]' value='"+Notes+"' />" +
                    "<td>"+ MenuMakanan + "</td>" +
                    "<td class='align-right'>" + Harga + "</td>" +
                    "<td class='align-right'>" + JumlahItem + "</td>" + 
                    "<td class='align-right'>" + TotalHarga + "</td>" +
                    "<td class='align_top'>" + Notes + "</td>" +
                    "<td class='align-center'>"+
                        "<a href='javascript:void(0)' onclick='DeleteRow(this)'><img src='../images/denided.png' title='Hapus'/></a>"+
                        "<a href='javascript:void(0)' onclick='EditRowMenu(this, "+IdMenuMakanan+", "+JumlahItem+", `"+Notes+"`)' style='margin-left: 20px;'><img src='../images/i_edit.png'/ title='Edit'></a>"+
                    "</td>" + 
                "</tr>"
                );
            UpdateSummaryHarga();
            CloseMessi();
        }
  		return false;
    });
}
// END function update row

// function cek input menu
function CekInputMenu(IdMenuMakanan)
{
    var ItemValue=[];
    $('input[name="IdMenuMakanan\\[\\]"]').each(function() {
       ItemValue.push(this.value);
    });
    
    var status = true;
    for(var i=0; i<ItemValue.length; i++)
    {
        if(IdMenuMakanan==ItemValue[i])
        {
            status = false;
            break;
        }
    }
    
    return status;
}
// END function cek input menu

// function update summary harga
function UpdateSummaryHarga()
{
    var SumJumlahItem = 0;
    var SumTotalHarga = 0;
    // jumlah item
    var JumlahItem=[];
    $('input[name="JumlahItem\\[\\]"]').each(function() {
       JumlahItem.push(this.value);
    });
    
    // set total item
    if(JumlahItem.length > 0)
    {
        for(var i=0; i<JumlahItem.length; i++)
        {
            SumJumlahItem += parseInt(JumlahItem[i]);
        }
        $("#SumJumlahItem").text(SumJumlahItem);
    }
    else
    {
        $("#SumJumlahItem").text("-");
    }
    
    // jumlah total harga
    var TotalHarga=[];
    $('input[name="TotalHarga\\[\\]"]').each(function() {
       TotalHarga.push(this.value);
    });
    
    // set total item
    if(TotalHarga.length > 0)
    {
        for(var i=0; i<TotalHarga.length; i++)
        {
            SumTotalHarga += parseInt(TotalHarga[i]);
        }
        //SumTotalHarga = ConvertRupiah(SumTotalHarga);
        $("#SumTotalHarga").text(SumTotalHarga);
    }
    else
    {
        $("#SumTotalHarga").text("-");
    }
}
// END function update summary harga

// function edit status reservasi
function EditStatusReservasi(IdReservasi, TotalHarga)
{
    Messi.load("module/content.php?m=reservasi&a=EditStatusReservasi&IdReservasi="+IdReservasi+"&TotalHarga="+TotalHarga, 
    {title: 'Edit Status Reservasi', titleClass: 'info', modal: true, width: '470px'});
}
// END function edit status reservasi

// set date picker
function SetDatePicker()
{
    $( "#TanggalReservasiShow" ).datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        onSelect: function() {
       	    $( "#TanggalReservasi" ).val($( "#TanggalReservasiShow" ).val());
           	$( "#TanggalReservasiShow" ).val(formatDate($( "#TanggalReservasi" ).val()));
        }	
    });
}
// END set date picker

// set time picker
function SetTimePicker()
{
    $("#JamReservasi").datetimepicker({
        datepicker:false,
        format:'H:i'
    });
}
// END set time picker

// function update status reservasi
function UpdateStatusReservasi(IdReservasi)
{
    $('#formID2').submit(function() {
        if (jQuery("#formID2").validationEngine('validate'))
        {
            $.ajax
                ({
         			type: 'POST',
         			url: $(this).attr('action'),
         			data: $(this).serialize(),
         			success: function(data) 
                    {
        				CloseMessi();
                        window.location.href='?m=reservasi&a=DetailReservasi&IdReservasi='+IdReservasi;
         			}
                });   
        }
  		return false;
    });
}
// END function update status reservasi

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


// function load menu makanan
function LoadMenuMakanan(IdJenisMenu)
{
    if(IdJenisMenu!="")
    {
        url = "module/content.php?m=reservasi&a=ListMenuByJenis&IdJenisMenu="+IdJenisMenu;
        $("#ViewMenu").hide();
        $("#ViewMenu").load(url);
        $("#ViewMenu").fadeIn("slow");
    }
    else
    {
        new Messi('Pilih jenis menu!', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Close', val: 'X', class: 'btn-danger'}]});
        return false;
    }
}
// END function load menu makanan

// function enable bill
function EnableNoBill()
{
    IdStatusReservasi = $('#IdStatusReservasi').val();
    DateReservasi = $("#TanggalReservasi").val();
    Today = $("#Today").val();
    if(IdStatusReservasi=="4")
    {
        $("#NoBill").prop("disabled", false);
        $("#Discount").prop("disabled", false);
        $("#NoBill").val($('#NoBillTemp').val());
        $("#Discount").val($('#DiscountTemp').val());
    }
    else
    {
        //$("#NoBill").val() = "";
        $("#NoBill").val("");
        $("#Discount").val("");
        $("#NoBill").prop("disabled", true);
        $("#Discount").prop("disabled", true);
    }
}
// END function enable bill


// function detail menu makanan
function DetailMenuMakanan(IdMenuMakanan)
{
    Messi.load("module/content.php?m=menumakanan&a=DetailMenuMakanan&IdMenuMakanan="+IdMenuMakanan, 
    {title: 'Detail Menu Makanan', titleClass: 'info', modal: true, width: '500px', buttons: [{id: 0, label: 'Close', val: 'X', btnClass: 'btn-success'}]});
}
// END function detail menu makanan


// function view menu makanan sorting
function ViewMenuMakananTableSorting()
{
    var IdJenisMakanan = $("#SortingMakanan").val();
    
    if(IdJenisMakanan!="")
    {
        url = "module/content.php?m=menumakanan&a=ViewMenuMakananTableSorting&IdJenisMakanan="+IdJenisMakanan;
        $("#MenuTable").hide();
        $("#MenuTable").load(url);
        $("#MenuTable").fadeIn("slow");
    }
}
// END funciton view menu makanan sorting