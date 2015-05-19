<?php
// function view reservasi
    function ViewReservasiToday()
    {
        // header title
        $text = "Reservasi Hari Ini";
        HeaderTitle($text);
        ReservasiTodayHeader();
        ReservasiTodayQuickMenu();
        ?>
            <div id="ReservasiTabel">
                <?php
                     ReservasiTodayTable();       
                ?>
            </div>
        <?php
    }
    // END function view reservasi
    
    
    // function view reservasi header date
    function ReservasiTodayHeader()
    {
        ?>
            <div style="text-align: center; margin-top: 10px;">
                <label style="font-size: 15px; color: olive; font-weight: bold; margin-bottom: 5px;">RESERVASI SOKA INDAH RESTAURANT</label> <br />
                <label style="font-size: 14px; color: olive; font-weight: bold;"><?php echo KonversiTanggal("l, d M Y", date("Y-M-d"));?></label> <br />
            </div>
            <div class="sep"></div>
        <?php
    }
    // END function reservasi header date
    
    // function reservasi today quick menu
    function ReservasiTodayQuickMenu()
    {
        ?>
            <script>
                $(function(){
                    
                    $("#TampilkanReservasi").hide();
                    $("#SearchReservasi").hide();
                    
                    $( "#StartDateShow" ).datepicker({
                      changeMonth: true,
                      changeYear: true,
                      dateFormat: "yy-mm-dd",
                      yearRange: '2014:2025',
                      onSelect: function( selectedDate ) {
                                //$( "#EndDateShow" ).datepicker( "option", "minDate", selectedDate );
                                $( "#StartDate" ).val(selectedDate);
            	                $( "#StartDateShow" ).val(formatDate(selectedDate));
                              }
                    });
                    
                    $( "#EndDateShow" ).datepicker({
                      changeMonth: true,
                      changeYear: true,
                      dateFormat: "yy-mm-dd",
                      yearRange: '2014:2025',
                      onSelect: function( selectedDate ) {
                                //$( "#StartDateShow" ).datepicker( "option", "maxDate", selectedDate );
                                $( "#EndDate" ).val(selectedDate);
            	                $( "#EndDateShow" ).val(formatDate(selectedDate));
                              }
                    });
                });
                
                function ShowTampilkanReservasi()
                {
                    $("#TampilkanReservasi").fadeIn("slow");
                    $("#btnTampil").hide();
                }
                
                function HideTampilkanReservasi()
                {
                    $("#TampilkanReservasi").hide();
                    $("#btnTampil").fadeIn("slow");
                }
                
                function ShowSearchReservasi()
                {
                    $("#SearchReservasi").fadeIn("slow");
                    $("#btnTampil").hide();
                }
                
                function HideSearchReservasi()
                {
                    $("#SearchReservasi").hide();
                    $("#btnTampil").fadeIn("slow");
                }
            </script>
            <div class="full_w" style="padding: 5px; margin: 10px; text-align: center;">
                <div id="btnTampil">
                    <button class="new_user" onclick="ShowTampilkanReservasi()" >Tampilkan Reservasi</button>
                    <button class="search" onclick="ShowSearchReservasi()">Cari Reservasi</button>
                </div>
                <div id="TampilkanReservasi" class="full_w" style="margin: 5px 0px 0px 0px; padding: 10px; text-align: left;">
                    <form id="FormTampilkanReservasi" style="margin: 0px;">
                        <table>
                            <tr>
                                <td>
                                    <label for="StartDate">Tanggal</label>
                                </td>
                                <td>
                                    <input id="StartDateShow" name="StartDateShow" class="text datepicker" style="width: 100px; margin: 0px 10px 0px 10px;" />
                                    <input type="hidden" id="StartDate" name="StartDate" class="text datepicker"  />
                                </td>
                                <td>
                                    <label for="EndDate">Sampai</label>
                                </td>
                                <td>
                                    <input id="EndDateShow" name="EndDateShow" class="text datepicker" style="width: 100px; margin-left: 10px;" />
                                    <input type="hidden" id="EndDate" name="EndDate" />
                                </td>
                                <td>
                                    <label for="StausReservasi" style="margin: 0px 10px 0px 30px;">Status</label>
                                </td>
                                <td>
                                    <select id="StatusReservasi" name="StatusReservasi" style="width: 150px;">
                                          <option value="0">All</option>
                                          <?php
                                            $sql = "SELECT * FROM tb_statusreservasi ORDER BY IdStatusReservasi";
                                            $dataStatus = ReadDataManyRow($sql);
                                            foreach($dataStatus as $data)
                                            {
                                                ?>
                                                    <option value="<?php echo $data["IdStatusReservasi"]; ?>"><?php echo $data["StatusReservasi"]; ?></option>
                                                <?php
                                            }
                                          ?>
                                    </select>
                                </td>
                                <td>
                                    <a onclick="TampilkanReservasi()" class="btn_green" style="text-decoration: none;margin-left: 20px;" href="javascript:void(0);"><span>Tampilkan</span></a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" onclick="HideTampilkanReservasi()" title="Hide"><img src="../images/arrowicon.png" /></a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="SearchReservasi" class="full_w" style="margin: 5px 0px 0px 0px; padding: 10px;">
                    <form id="FormSearchReservasi" style="margin: 0px;">
                        <table>
                            <tr>
                                <td>
                                    <label for="KeyWord">Masukan Keyword : </label>
                                </td>
                                <td>
                                    <input id="KeyWord" name="KeyWord" style="width: 200px; margin: 0px 15px 0px 10px;" />
                                </td>
                                <td>
                                    <a onclick="SearchReservasi()" class="btn_green" style="text-decoration: none;margin-right: 10px;" href="javascript:void(0);"><span>Search</span></a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" onclick="HideSearchReservasi()" title="Hide"><img src="../images/arrowicon.png" /></a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        <?php
    }
    // END function reservasi today quick menu
    
    // function reservasi today table
    function  ReservasiTodayTable()
    {
        $StartDate = date('Y-m-d', strtotime('-3 days'));
        $EndDate = date('Y-m-d', strtotime('+5 days'));
        $Start = KonversiTanggal("d M Y", $StartDate);
        $End = KonversiTanggal("d M Y", $EndDate);
        ?>
            <div class="sep" style="margin-bottom: 7px;"></div>
            <div style="margin: 0px 10px 5px 10px; padding: 5px;">
                <div style="text-align: center;">
                    <label style="font-size: 15px; color: #1E1E1E ; margin-bottom: 3px;">Reservasi Dalam 1 Minggu</label><br />
                    <label style="font-size: 12px; color: #1E1E1E ;">Tanggal : <b><?php echo $Start; ?></b></label> 
                    <label style="font-size: 12px; color: #1E1E1E ;">Sampai : <b><?php echo $End; ?></b></label>
                </div>
            </div>
            <div class="datagrid" style="margin: 10px 10px 5px 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
                            <th style="width: 90px; text-align: center;">Organizer</th>
                            <th style="width: 120px; text-align: center;">Person</th>
                            <th style="width: 60px; text-align: center;">Jml. Orang</th>
                            <th style="width: 90px; text-align: center;">Tgl. Reservasi</th>
                            <th style="width: 70px; text-align: center;">Status</th>
                            <th style="width: 50px; text-align: center;">No. Bill</th>
                            <th style="width: 40px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT a.IdReservasi, a.IdStatusReservasi, b.Nama, b.NoHandphone, c.Organizer, a.JumlahPeserta, a.TanggalReservasi, d.StatusReservasi, a.NoBill
                                    	FROM tb_reservasi a
                                    	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                    	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                    	INNER JOIN tb_statusreservasi d ON a.IdStatusReservasi = d.IdStatusReservasi
                                    WHERE a.TanggalReservasi BETWEEN '$StartDate' AND '$EndDate' AND a.IdStatusReservasi BETWEEN '1' AND '3' 
                                    ORDER BY a.IdStatusReservasi ASC, a.TanggalReservasi ASC";
                            
                            // data reservasi
                            $dataReservasi = ReadDataManyRow($sql);
                            if(count($dataReservasi>0))
                            {
                                $i = 1;
                                foreach($dataReservasi as $data)
                                {
                                    $LabelClass = GetStatusClass($data["IdStatusReservasi"]);
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                            <td><?php echo $data["Nama"]; ?></td>
                                            <td style="text-align: right;"><?php echo $data["JumlahPeserta"]; ?></td>
                                            <td style="text-align: right;"><?php echo KonversiTanggal("d M Y", $data["TanggalReservasi"]); ?></td>
                                            <td style="text-align: center;"><label class="<?php echo $LabelClass; ?>"><?php echo $data["StatusReservasi"]; ?></label></td>
                                            <td style="text-align: center;"><?php echo $data["NoBill"]; ?></td>
                                            <td style="text-align: center;">
                                                <a href="javascript:void(0);" title="Detail Reservasi" onclick="ViewDetailReservasi('<?php echo $data["IdReservasi"]; ?>')"><img src="../images/next.png" /></a>
                                            </td>
                                        </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Tidak ada data!</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
    // END function reservasi today table
    
    // function search reservasi
    function SearchReservasi()
    {
        include "../../globalfunction/ajax_include.php";
        $StartDate = $_GET["StartDate"];
        $EndDate = $_GET["EndDate"];
        
        $StatusReservasi = $_GET["StatusReservasi"];
        
        // string conditional
        $Conditional = "WHERE a.TanggalReservasi BETWEEN '$StartDate' AND '$EndDate' AND a.IdStatusReservasi='$StatusReservasi' ORDER BY a.TanggalReservasi DESC";
        
        $Start = KonversiTanggal("d M Y", $StartDate);
        $End = KonversiTanggal("d M Y", $EndDate);
        
        // get status
        $sql = "SELECT StatusReservasi FROM tb_statusreservasi WHERE IdStatusReservasi='$StatusReservasi'";
        $data = ReadDataOneRow($sql);
        $Status = $data["StatusReservasi"];
        
        if($StatusReservasi=="0")
        {
            $Conditional = "WHERE a.TanggalReservasi BETWEEN '$StartDate' AND '$EndDate' ORDER BY a.TanggalReservasi";
            $Status = "All";
        }
        
        ?>
            <div class="sep" style="margin-bottom: 7px;"></div>
            <div style="margin: 0px 10px 5px 10px; padding: 5px;">
                <div style="text-align: center;">
                    <label style="font-size: 15px; color: #1E1E1E ; margin-bottom: 3px;">Hasil Pencarian</label><br />
                    <label style="font-size: 12px; color: #1E1E1E ;">Tanggal : <?php echo $Start; ?> </label> 
                    <label style="font-size: 12px; color: #1E1E1E ;">Sampai : <?php echo $End; ?> </label> |
                    <label style="font-size: 12px; color: #1E1E1E ;">Status : <?php echo $Status; ?></label>
                </div>
            </div>
            <div class="datagrid" style="margin: 0px 10px 5px 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
                            <th style="width: 90px; text-align: center;">Organizer</th>
                            <th style="width: 120px; text-align: center;">Person</th>
                            <th style="width: 60px; text-align: center;">Jml. Orang</th>
                            <th style="width: 90px; text-align: center;">Tgl. Reservasi</th>
                            <th style="width: 70px; text-align: center;">Status</th>
                            <th style="width: 50px; text-align: center;">No. Bill</th>
                            <th style="width: 40px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT a.IdReservasi, a.IdStatusReservasi, b.Nama, b.NoHandphone, c.Organizer, a.JumlahPeserta, a.TanggalReservasi, d.StatusReservasi, a.NoBill
                                    	FROM tb_reservasi a
                                    	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                    	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                    	INNER JOIN tb_statusreservasi d ON a.IdStatusReservasi = d.IdStatusReservasi ";
                            $sql .= $Conditional;
                            
                            $dataReservasi = ReadDataManyRow($sql);
                            if(count($dataReservasi)>0)
                            {
                                $i = 1;
                                foreach($dataReservasi as $data)
                                {
                                    $LabelClass = GetStatusClass($data["IdStatusReservasi"]);
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                            <td><?php echo $data["Nama"]; ?></td>
                                            <td style="text-align: right;"><?php echo $data["JumlahPeserta"]; ?></td>
                                            <td style="text-align: right;"><?php echo KonversiTanggal("d M Y", $data["TanggalReservasi"]); ?></td>
                                            <td style="text-align: center;"><label class="<?php echo $LabelClass; ?>"><?php echo $data["StatusReservasi"]; ?></label></td>
                                            <td style="text-align: center;"><?php echo $data["NoBill"]; ?></td>
                                            <td style="text-align: center;">
                                                <a href="javascript:void(0);" title="Detail Reservasi" onclick="ViewDetailReservasi('<?php echo $data["IdReservasi"]; ?>')"><img src="../images/next.png" /></a>
                                            </td>
                                        </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Tidak ada data!</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
    // END function search reservasi
    
    // function cari reservasi
    function CariReservasi()
    {
        include "../../globalfunction/ajax_include.php";
        $Keyword = $_GET["KeyWord"];
        $Conditional = "WHERE b.Nama LIKE '%$Keyword%' OR c.Organizer LIKE '%$Keyword%' OR a.TanggalReservasi LIKE '%$Keyword%' OR a.NoBill LIKE '%$Keyword%' ORDER BY a.TanggalReservasi DESC";
        ?>
            <div class="sep" style="margin-bottom: 7px;"></div>
            <div style="margin: 0px 10px 5px 10px; padding: 5px;">
                <div style="text-align: center;">
                    <label style="font-size: 15px; color: #1E1E1E ; margin-bottom: 3px;">Hasil Pencarian</label><br />
                    <label style="font-size: 12px; color: #1E1E1E ;">Keyword : <?php echo $Keyword; ?> </label> 
                </div>
            </div>
            <div class="datagrid" style="margin: 0px 10px 5px 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
                            <th style="width: 90px; text-align: center;">Organizer</th>
                            <th style="width: 120px; text-align: center;">Person</th>
                            <th style="width: 60px; text-align: center;">Jml. Orang</th>
                            <th style="width: 90px; text-align: center;">Tgl. Reservasi</th>
                            <th style="width: 70px; text-align: center;">Status</th>
                            <th style="width: 50px; text-align: center;">No. Bill</th>
                            <th style="width: 40px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT a.IdReservasi, a.IdStatusReservasi, b.Nama, b.NoHandphone, c.Organizer, a.JumlahPeserta, a.TanggalReservasi, d.StatusReservasi, a.NoBill
                                    	FROM tb_reservasi a
                                    	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                    	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                    	INNER JOIN tb_statusreservasi d ON a.IdStatusReservasi = d.IdStatusReservasi ";
                            $sql .= $Conditional;
                            
                            $dataReservasi = ReadDataManyRow($sql);
                            if(count($dataReservasi)>0)
                            {
                                $i = 1;
                                foreach($dataReservasi as $data)
                                {
                                    $LabelClass = GetStatusClass($data["IdStatusReservasi"]);
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data["Nama"]; ?></td>
                                            <td style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                            <td style="text-align: right;"><?php echo $data["JumlahPeserta"]; ?></td>
                                            <td style="text-align: right;"><?php echo KonversiTanggal("d M Y", $data["TanggalReservasi"]); ?></td>
                                            <td style="text-align: center;"><label class="<?php echo $LabelClass; ?>"><?php echo $data["StatusReservasi"]; ?></label></td>
                                            <td style="text-align: center;"><?php echo $data["NoBill"]; ?></td>
                                            <td style="text-align: center;">
                                                <a href="javascript:void(0);" title="Detail Reservasi" onclick="ViewDetailReservasi('<?php echo $data["IdReservasi"]; ?>')"><img src="../images/next.png" /></a>
                                            </td>
                                        </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;">Tidak ada data!</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
    // END function cari reservasi
    
    // function detail reservasi
    function DetailReservasi()
    {
        $IdReservasi = $_GET["IdReservasi"];
        $text = "Detail Reservasi";
        HeaderTitle($text);
        $sql = "SELECT a.IdReservasi, b.Nama, b.NoHandphone, c.Organizer, d.TipeCustomer, a.IdStatusReservasi, a.NoBill, a.Notes, a.Discount,
                	a.TanggalReservasi, a.JamReservasi, a.JumlahPeserta, a.JumlahKendaraan, e.StatusReservasi, f.NamaLengkap
                	FROM tb_reservasi a
                	LEFT JOIN tb_person b ON a.IdPerson=b.IdPerson
                	LEFT JOIN tb_organizer c ON b.IdOrganizer=c.IdOrganizer
                	LEFT JOIN tb_tipecustomer d ON c.IdTipeCustomer = d.IdTipeCustomer
                	LEFT JOIN tb_statusreservasi e ON a.IdStatusReservasi = e.IdStatusReservasi
                    LEFT JOIN tb_user f ON a.Username = f.Username
                WHERE a.IdReservasi='$IdReservasi'";
        $dataReservasi = ReadDataOneRow($sql);
        ?>
            <div class="full_w" style="margin: 5px; padding: 5px;">
                <div style="text-align: center;">
                    <h2 style="color: #400000; margin: 0px;">DETAIL RESERVASI</h2>
                    <div class="sep"></div>
                </div>
                <div class="full_w detailreservasi" style="padding: 5px;">
                    <table class="tbclear">
                        <tr>
                            <td style="width: 120px;">Organizer/Travel</td>
                            <td style="width: 10px;">:</td>
                            <td style="font-weight: bold;"><?php echo $dataReservasi["Organizer"]; ?></td>
                        </tr>
                        <tr>
                            <td>Tipe Customer</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataReservasi["TipeCustomer"]; ?></td>
                        </tr>
                        <tr>
                            <td>Person</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataReservasi["Nama"]; ?></td>
                        </tr>
                        <tr>
                            <td>No. Handphone</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataReservasi["NoHandphone"]; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Reservasi</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo KonversiTanggal("l, d M Y", $dataReservasi["TanggalReservasi"]) ?></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo date('H:i', strtotime($dataReservasi["JamReservasi"])); ?></td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo RentangWaktu( date( 'H:i', strtotime($dataReservasi["JamReservasi"]) ) ); ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Peserta</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataReservasi["JumlahPeserta"]; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Kendaraan</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataReservasi["JumlahKendaraan"]; ?></td>
                        </tr>
                        <tr>
                            <td>Status Reservasi</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><label class="<?php echo GetStatusClass($dataReservasi["IdStatusReservasi"]); ?>"><?php echo $dataReservasi["StatusReservasi"]; ?></label></td>
                        </tr>
                        <tr>
                            <td>No Bill</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><label><?php echo $dataReservasi["NoBill"]; ?></label></td>
                        </tr>
                        <tr>
                            <td>Notes</td>
                            <td>:</td>
                            <td><label><?php echo nl2br($dataReservasi["Notes"]); ?></label></td>
                        </tr>
                         <tr>
                            <td>Diinputkan Oleh</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataReservasi["NamaLengkap"]; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="sep"></div>
                <div style="margin-top: 10px;">
                    <div class="datagrid">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 25px;">No</th>
                                    <th style="text-align:center; width: 200px;">Menu Makanan</th>
                                    <th style="text-align:center; width: 100px;">Harga (Rp.)</th>
                                    <th style="text-align:center; width: 80px;">Jml. Item</th>
                                    <th style="text-align:center; width: 100px;">Sub Total (Rp.)</th>
                                    <th style="text-align:left;">Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT c.MenuMakanan, a.Harga, a.JumlahItem, a.Harga*a.JumlahItem AS 'TotalHarga', a.NotesMenu
                                            	FROM tb_detailreservasi a
                                            	INNER JOIN tb_reservasi b ON a.IdReservasi = b.IdReservasi
                                            	LEFT JOIN tb_menumakanan c ON a.IdMenuMakanan = c.IdMenuMakanan
                                            WHERE a.IdReservasi='$IdReservasi' ORDER BY a.IdDetailReservasi ASC";
                                    $dataMenu = ReadDataManyRow($sql);
                                    $i = 1;
                                    $TotalItem = 0;
                                    $TotalHarga = 0;
                                    foreach($dataMenu as $data)
                                    {
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $data["MenuMakanan"]; ?></td>
                                                <td style="text-align: right;"><?php echo FormatRupiah($data["Harga"]); ?></td>
                                                <td style="text-align: center;"><?php echo $data["JumlahItem"]; ?></td>
                                                <td style="text-align: right;"><?php echo FormatRupiah($data["TotalHarga"]); ?></td>
                                                <td style="text-align: left;"><?php echo $data["NotesMenu"]; ?></td>
                                            </tr>
                                        <?php
                                        $i++;
                                        $TotalItem += $data["JumlahItem"];
                                        $TotalHarga += $data["TotalHarga"];
                                    }
                                    $TotalDiscount = $dataReservasi["Discount"];
                                    $TotalHargaDiscount = $TotalHarga-$TotalDiscount;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="sep"></div>
                    <div class="datagrid summarytotal" style="margin: 10px 10px 0px 320px; width: 450px;">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 70px; text-align: center;">Tot. Item</th>
                                    <th style="width: 120px; text-align: center;">Tot. Harga (gross)</th>
                                    <th style="width: 120px; text-align: center;">Discount</th>
                                    <th style="width: 120px; text-align: center;">Tot. Harga (net)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;" class="align_top"><label id="SumJumlahItem"><?php echo $TotalItem; ?></label></td>
                                    <td style="text-align: right;" class="align_top"><label id="SumTotalHarga"><?php echo FormatRupiah($TotalHarga); ?></label></td>
                                    <td style="text-align: center;" class="align_top"><label id="SumJumlahItem"><?php echo $dataReservasi["Discount"]; ?></label></td>
                                    <td style="text-align: right;" class="align_top">
                                        <label><?php echo FormatRupiah($TotalHarga); ?></label><br />
                                        <label><?php echo FormatRupiah($TotalDiscount); ?></label><br />
                                        <label>-</label><br />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="align-center"><label>Total Harga (net)</label></td>
                                    <td style="text-align: right;">
                                        <label><?php echo FormatRupiah($TotalHargaDiscount); ?></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="full_w" style="margin-top: 10px; padding: 7px; text-align: right;">
                    <button class="btn_black" onclick="window.location.href='?m=reservasi'">Kembali</button>
                    <a target="_blank" href="?m=print&a=PrintDetailReservasi&IdReservasi=<?php echo $IdReservasi; ?>&page=trans" class="btn_blue" style="text-decoration: none;"><span>Print</span></a>
                </div>
            </div>
        <?php
    }
    
?>