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
                    <button class="add" style="margin-right: 15px;" onclick="window.location.href='?m=reservasi&a=TambahReservasi'">Reservasi Baru</button> 
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
    
    
    // function tambah reservasi
    function TambahReservasi()
    {
        // header title
        $text = "Tambah Reservasi";
        HeaderTitle($text);
        ReservasiTodayHeader();
        TambahReservasiForm();
    }
    
    // function tambah reservasi form
    function TambahReservasiForm()
    {
        ?>
            <script>
                $(function(){
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
                    
                    $( "#JamReservasi" ).datetimepicker({
                          datepicker:false,
                          format:'H:i'
                    });
                });
            </script>
            <div style="padding: 10px">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=reservasi&a=ReservasiStep2&page=trans">
                        <div class="element">
    						<label for="IdOrganizer">Pilih Organizer/Travel<span class="red">*</span></label>
                            <select id="IdOrganizer" name="IdOrganizer" class="text validate[required]" style="width: 310px;" onchange="LoadPerson($('#IdOrganizer').val(), '0')" title="My Title">
                                <option value="">-</option>
                                <?php
                                    $sqlOrganizer = "SELECT IdOrganizer, Organizer FROM tb_organizer ORDER BY Organizer ASC";
                                    $dataOrganizer = ReadDataManyRow($sqlOrganizer);
                                    foreach($dataOrganizer as $data)
                                    {
                                        ?>
                                            <option value="<?php echo $data["IdOrganizer"]; ?>"><?php echo $data["Organizer"]; ?></option>
                                        <?php
                                    }
                                ?>
                            </select><span id="tooltip" title="My Tooltip"></span>
                            <a href="#" onclick="TambahOrganizerPopUp()">Tambah Organizer</a>
    					</div>
                        <div class="element" id="PersonData">
    						<label for="Person">Pilih Person<span class="red">*</span></label>
                            <select id="IdPerson" name="IdPerson" class="text validate[required]" style="width: 310px;" disabled="disabled" onchange="ShowNotifPerson()">
                                
                            </select>
                            <a id="TambahPersonAnchor" href="#" style="margin-right: 20px;">Tambah Person</a>
    					</div>
                        <div class="element">
    						<label for="TanggalReservasiShow">Tanggal Reservasi<span class="red">*</span></label>
    						<input id="TanggalReservasiShow" name="TanggalReservasiShow" class="text validate[required] datepicker" style="width: 120px;" onkeydown="CloseMessi()" />
    						<input type="hidden" id="TanggalReservasi" name="TanggalReservasi" />
    					</div>
                        <div class="element">
    						<label for="JamReservasi">Jam<span class="red">*</span></label>
    						<input id="JamReservasi" name="JamReservasi" class="text validate[required]" style="width: 120px;" />
    					</div>
                        <div class="element">
    						<label for="JumlahPeserta">Jumlah Peserta<span class="red">*</span></label>
    						<input id="JumlahPeserta" name="JumlahPeserta" class="text validate[required, custom[integer]]" style="width: 120px;" />
    					</div>
                        <div class="element">
    						<label for="JumlahKendaraan">Jumlah Kendarraan</label>
    						<input id="JumlahKendaraan" name="JumlahKendaraan" class="text validate[custom[integer]]" style="width: 120px;" />
    					</div>
                        <div class="element">
    						<label for="Notes">Notes</label>
    						<textarea style="width: 300px; height: 40px;" name="Notes" id="Notes" class="text"></textarea>
    					</div>
                        <div class="entry">
						      <a href="?m=reservasi" style="text-decoration: none; margin-right: 20px;" class="btn_black"><span>Cancel</span></a>
                              <button type="submit" class="btn_blue">Lanjut</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
    // END form
    // END function tambah reservasi
    
    // function load person
    function LoadPerson()
    {
        ?>
            <option>-</option>
        <?php
        include "../../globalfunction/ajax_include.php";
        $IdOrganizer = $_GET["IdOrganizer"];
        $sql = "SELECT IdPerson, Nama FROM tb_person 
                WHERE IdOrganizer = '$IdOrganizer' ORDER BY Nama ASC";
        
        $dataPerson = ReadDataManyRow($sql);
        if( count($dataPerson)!=0 )
        {
            foreach($dataPerson as $data)
            {
                ?>
                    <option value="<?php echo $data["IdPerson"]; ?>"><?php echo $data["Nama"]; ?></option>
                <?php
            }
        }
    }
    // END function load person
    
    // function reservasi step 2
    function ReservasiStep2()
    {
        // header title
        $text = "Reservasi Menu";
        HeaderTitle($text);
        ReservasiStep2Form();
    }
    // END function reservasi step 2
    
    // function list menu
    function ListMenuItem()
    {
        ?>
            <div class="full_w" style="min-height: 100px; padding: 5px;">
                <div style="text-align: center;">
                    <h2 style="color: #400000; margin: 0px;">LIST MENU</h2>
                    <div class="sep"></div>
                </div>
                <div class="full_w" id="JenisMenuDiv" style="padding: 5px;">
                    <form style="margin: 0px;">
                        <table>
                            <tr>
                                <td><label>Jenis Menu</label></td>
                                <td style="padding-left: 15px;">
                                    <select id="IdJenisMenu" style="width: 150px;" onchange="LoadMenuMakanan($('#IdJenisMenu').val())">
                                        <?php
                                            $sql = "SELECT * FROM tb_jenismakanan ORDER BY IdJenisMakanan ASC";
                                            $dataJenisMenu = ReadDataManyRow($sql);
                                            foreach($dataJenisMenu as $data)
                                            {
                                                ?>
                                                    <option value="<?php echo $data["IdJenisMakanan"]; ?>"><?php echo $data["JenisMakanan"]; ?></option>
                                                <?php
                                            }
                                        ?>
                                        <option value="0">All</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="ViewMenu">
                    <div class="datagrid">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 10px; text-align: center;">No.</th>
                                    <th style="width: 100px; text-align: center;">Menu</th>
                                    <th style="width: 70px; text-align: center;">Harga (Rp.)</th>
                                    <th style="width: 50px; text-align: center;">Tambah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM tb_menumakanan WHERE IdJenisMakanan='1' ORDER BY MenuMakanan ASC";
                                    $dataMakanan = ReadDataManyRow($sql);
                                    $i = 1;
                                    foreach($dataMakanan as $dataMenu)
                                    {
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $dataMenu["MenuMakanan"]; ?></td>
                                                <td style="text-align: right;"><?php echo FormatRupiah($dataMenu["Harga"])?></td>
                                                <td style="text-align: center;">
                                                    <a href="javascript:void(0)" onclick="TambahRowMenu('<?php echo $dataMenu["IdMenuMakanan"]; ?>')"><img src="../images/i_add.png" /></a>
                                                </td>
                                            </tr>
                                        <?php
                                        $i++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
    }
    // END function list menu
    
    // function liste menu by jenis
    function ListMenuByJenis()
    {
        include "../../globalfunction/ajax_include.php";
        $IdJenisMenu = $_GET["IdJenisMenu"];
        
        if($IdJenisMenu=="0")
        {
            $sql = "SELECT * FROM tb_menumakanan ORDER BY IdJenisMakanan ASC, MenuMakanan ASC";
        }
        else
        {
            $sql = "SELECT * FROM tb_menumakanan WHERE IdJenisMakanan='$IdJenisMenu' ORDER BY MenuMakanan ASC";   
        }
        
        ?>
            <div class="datagrid">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 10px; text-align: center;">No.</th>
                            <th style="width: 100px; text-align: center;">Menu</th>
                            <th style="width: 70px; text-align: center;">Harga (Rp.)</th>
                            <th style="width: 50px; text-align: center;">Tambah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dataMakanan = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataMakanan as $dataMenu)
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $dataMenu["MenuMakanan"]; ?></td>
                                        <td style="text-align: right;"><?php echo FormatRupiah($dataMenu["Harga"])?></td>
                                        <td style="text-align: center;">
                                            <a href="javascript:void(0)" onclick="TambahRowMenu('<?php echo $dataMenu["IdMenuMakanan"]; ?>')"><img src="../images/i_add.png" /></a>
                                        </td>
                                    </tr>
                                <?php
                                $i++;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
    // function list menu by jenis
    
    // function reservasistep 2 form
    function ReservasiStep2Form()
    {
        $IdOrganizer = $_POST["IdOrganizer"];
        $IdPerson = $_POST["IdPerson"];
        $TanggalReservasi = $_POST["TanggalReservasi"];
        $JamReservasi = $_POST["JamReservasi"];
        $JumlahPeserta = $_POST["JumlahPeserta"];
        $JumlahKendaraan = $_POST["JumlahKendaraan"];
        $Notes = $_POST["Notes"];
        
        // get data person
        $sql = "SELECT a.IdPerson, a.Nama, b.Organizer
                	FROM tb_person a
                	INNER JOIN tb_organizer b ON a.IdOrganizer = b.IdOrganizer
                WHERE a.IdPerson='$IdPerson'";
        $dataPerson = ReadDataOneRow($sql);
        // END get data person
        ?>
            <div style="margin: 10px 20px 10px 20px;">
                <div style="display: table;">
                    <table>
                        <tr>
                            <td style="vertical-align: top;">
                                <div style="width: 480px; min-height: 100px; margin-right: 10px; display: table-cell;">
                                    <?php ListMenuItem(); ?>
                                </div>
                            </td>
                            <td style="padding-left: 25px;">
                                <div style="width: 800px; display: table-cell; margin-left: 10px;">
                                    <div class="full_w" style="min-height: 100px; padding: 5px;">
                                        <div style="text-align: center;">
                                            <h2 style="color: #400000; margin: 0px;">DETAIL RESERVASI</h2>
                                            <div class="sep"></div>
                                        </div>
                                        <div class="full_w detailreservasi" style="padding: 5px;">
                                            <table class="tbclear">
                                                <tr>
                                                    <td style="width: 120px;">Organizer/Travel</td>
                                                    <td style="width: 10px;">:</td>
                                                    <td style="font-weight: bold;"><?php echo $dataPerson["Organizer"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Person</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo $dataPerson["Nama"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Reservasi</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo KonversiTanggal("l, d M Y", $TanggalReservasi) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jam</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo $JamReservasi; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu Kunjungan</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo RentangWaktu($JamReservasi); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Peserta</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo $JumlahPeserta; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Kendaraan</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo $JumlahKendaraan; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Notes</td>
                                                    <td>:</td>
                                                    <td><?php echo nl2br($Notes); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <form style="margin: 0px;" method="POST" action="?m=reservasi&a=SimpanReservasi">
                                        <input type="hidden" name="IdPerson" value="<?php echo $IdPerson; ?>" />
                                        <input type="hidden" name="TanggalReservasi" value="<?php echo $TanggalReservasi; ?>" />
                                        <input type="hidden" name="JamReservasi" value="<?php echo $JamReservasi; ?>" />
                                        <input type="hidden" name="JumlahPeserta" value="<?php echo $JumlahPeserta; ?>" />
                                        <input type="hidden" name="JumlahKendaraan" value="<?php echo $JumlahKendaraan; ?>" />
                                        <input type="hidden" name="Notes" value="<?php echo $Notes; ?>" />
                                        <div class="datagrid">
                                            <table id="table_trans">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 120px; text-align: center;">Nama Menu</th>
                                                        <th style="width: 90px; text-align: center;">Harga</th>
                                                        <th style="width: 70px; text-align: center;">Jumlah</th>
                                                        <th style="width: 90px; text-align: center;">Sub Total</th>
                                                        <th style="width: 150px; text-align: center;">Note</th>
                                                        <th style="width: 60px; text-align: center;">Option</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="sep"></div>
                                        <div class="datagrid summarytotal" style="margin: 10px 0px 0px 480px; width: 300px;">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th style="width: 150px; text-align: center;">Jumlah Item</th>
                                                        <th style="width: 150px; text-align: center;">Total Harga (Rp.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;"><label id="SumJumlahItem">-</label></td>
                                                        <td style="text-align: right;"><label id="SumTotalHarga">-</label></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="margin-top: 5px; text-align: right; padding: 10px;">
                                            <a href="?m=reservasi" class="btn_red" style="color: white; text-decoration: none;"><span>CANCEL</span></a>
                                            <button type="submit" class="btn_green" onclick="" style="margin-left: 15px;">SIMPAN</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php
    }
    // END function reservasi step 2 form
    
    // function tambah menu row
    function TambahMenuRow()
    {
        $IdMenuMakanan = $_GET["IdMenuMakanan"];
        include "../../globalfunction/ajax_include.php";
        $sql = "SELECT * FROM tb_menumakanan WHERE IdMenuMakanan='$IdMenuMakanan'";
        $data = ReadDataOneRow($sql);
        ?>
            <div class="full_w">
                <form id="formID2">
                    <input type="hidden" name="IdMenuMakanan" id="IdMenuMakanan" value="<?php echo $data["IdMenuMakanan"]; ?>" />
                    <input type="hidden" name="Harga" id="Harga" value="<?php echo $data["Harga"]; ?>" />
                    <div class="element">
  						<label for="MenuMakanan">Menu Makanan<span class="red">*</span></label>
  						<input id="MenuMakanan" name="MenuMakanan" style="width: 200px;" value="<?php echo $data["MenuMakanan"]; ?>" disabled="disabled" />
                    </div>
                    <div class="element">
  						<label for="Harga">Harga<span class="red">*</span></label>
  						<input id="HargaTemp" name="HargaTemp" style="width: 200px;" value="<?php echo FormatRupiah($data["Harga"]); ?>" disabled="disabled" />
   					</div>
                    <div class="element">
  						<label for="JumlahItem">Jumlah Item<span class="red">*</span></label>
  						<input id="JumlahItem" name="JumlahItem" class="text validate[required, custom[integer]]" style="width: 80px;" />
   					</div>
                    <div class="element">
  						<label for="JumlahItem">Notes</label>
                        <textarea style="width: 200px; height: 30px;" id="Notes" name="Notes"></textarea>
   					</div>
                    <div class="entry" style="text-align: center;">
                        <a href="#" onclick="CloseMessi()" class="btn_black" style="text-decoration: none;"><span>Cancel</span></a>
                        <button type="submit" class="btn_blue" style="margin-left: 10px;" onclick="AppendRow()">Tambah</button>
                    </div>
                </form>
            </div>
        <?php
    }
    // END function tambah menu row
    
    // function edit menu row
    function EditMenuRow()
    {
        include "../../globalfunction/ajax_include.php";
        $IdMenuMakanan = $_GET["IdMenuMakanan"];
        $JumlahItem = $_GET["JumlahItem"];
        $RowIndex = $_GET["RowIndex"];
        $Notes = $_GET["Notes"];
        $sql = "SELECT * FROM tb_menumakanan WHERE IdMenuMakanan='$IdMenuMakanan'";
        $data = ReadDataOneRow($sql);
        ?>
            <div class="full_w">
                <form id="formID2">
                    <input type="hidden" name="IdMenuMakanan" id="IdMenuMakanan" value="<?php echo $data["IdMenuMakanan"]; ?>" />
                    <input type="hidden" name="Harga" id="Harga" value="<?php echo $data["Harga"]; ?>" />
                    <input type="hidden" name="RowIndex" id="RowIndex" value="<?php echo $RowIndex; ?>" />
                    <div class="element">
  						<label for="MenuMakanan">Menu Makanan<span class="red">*</span></label>
  						<input id="MenuMakanan" name="MenuMakanan" style="width: 200px;" value="<?php echo $data["MenuMakanan"]; ?>" disabled="disabled" />
                    </div>
                    <div class="element">
  						<label for="Harga">Harga<span class="red">*</span></label>
  						<input id="HargaTemp" name="HargaTemp" style="width: 200px;" value="<?php echo FormatRupiah($data["Harga"]); ?>" disabled="disabled" />
   					</div>
                    <div class="element">
  						<label for="JumlahItem">Jumlah Item<span class="red">*</span></label>
  						<input id="JumlahItem" name="JumlahItem" class="text validate[required, custom[integer]]" style="width: 80px;" value="<?php echo $JumlahItem; ?>" />
   					</div>
                    <div class="element">
  						<label for="JumlahItem">Notes</label>
                        <textarea style="width: 200px; height: 30px;" id="Notes" name="Notes"><?php echo $Notes; ?></textarea>
   					</div>
                    <div class="entry" style="text-align: center;">
                        <a href="#" onclick="CloseMessi()" class="btn_black" style="text-decoration: none;"><span>Cancel</span></a>
                        <button type="submit" class="btn_blue" style="margin-left: 10px;" onclick="UpdateRow()">Update</button>
                    </div>
                </form>
            </div>
        <?php
    }
    // END function edit menu row
    
    
    // function simpan reservasi
    function SimpanReservasi()
    {
        $IdOrganizer = $_POST["IdOrganizer"];
        $IdPerson = $_POST["IdPerson"];
        $TanggalReservasi = $_POST["TanggalReservasi"];
        $JamReservasi = $_POST["JamReservasi"];
        $JumlahPeserta = $_POST["JumlahPeserta"];
        $JumlahKendaraan = $_POST["JumlahKendaraan"];
        $IdMenuMakanan = $_POST["IdMenuMakanan"];
        $JumlahItem = $_POST["JumlahItem"];
        $Harga = $_POST["Harga"];
        $NotesMenu = $_POST["NotesMenu"];
        $Username = $_SESSION['LoginUser'];
        $Notes = $_POST["Notes"];
        // save reservasi
        $cnn = new koneksi();
        $sql = "INSERT INTO tb_reservasi 
                (IdPerson, JumlahPeserta, TanggalReservasi, JamReservasi, JumlahKendaraan, Username, Notes)
                VALUE ('$IdPerson', '$JumlahPeserta', '$TanggalReservasi', '$JamReservasi', '$JumlahKendaraan', '$Username', '$Notes')";
        $cnn->exec_query($sql);
        // insert detail reservasi
        if($cnn->status=="1")
        {
            // get last id reservasi
            $IdReservasi = GetLastReservasi();
            
            // get length pesanan
            $Length = count($IdMenuMakanan);
            for($i=0; $i<$Length; $i++)
            {
                $sql = "INSERT INTO tb_detailreservasi (IdReservasi, IdMenuMakanan, JumlahItem, Harga, NotesMenu) 
                VALUE ('$IdReservasi', '".$IdMenuMakanan[$i]."', '".$JumlahItem[$i]."', '".$Harga[$i]."', '".$NotesMenu[$i]."')";
                
                $cnn->exec_query($sql);
            }
            $js = "parent.window.location ='?m=reservasi&a=DetailReservasi&IdReservasi=".$IdReservasi."'";
            exec_js($js);
        }
    }
    // END function simpan reservasi
    
    // function get last reservasi
    function GetLastReservasi()
    {
        $sql = "SELECT MAX(IdReservasi) AS 'IdReservasi' FROM tb_reservasi;";
        $data = ReadDataOneRow($sql);
        return $data["IdReservasi"];
    }
    // END function get last reservasi
    
    // function detail reservasi
    function DetailReservasi()
    {
        $IdReservasi = $_GET["IdReservasi"];
        $text = "Detail Reservasi";
        HeaderTitle($text);
        $sql = "SELECT a.IdReservasi, b.Nama, b.NoHandphone, c.Organizer, d.TipeCustomer, a.IdStatusReservasi, a.NoBill, a.Notes, a.Discount,
                	a.TanggalReservasi, a.JamReservasi, a.JumlahPeserta, a.JumlahKendaraan, e.StatusReservasi
                	FROM tb_reservasi a
                	LEFT JOIN tb_person b ON a.IdPerson=b.IdPerson
                	LEFT JOIN tb_organizer c ON b.IdOrganizer=c.IdOrganizer
                	LEFT JOIN tb_tipecustomer d ON c.IdTipeCustomer = d.IdTipeCustomer
                	LEFT JOIN tb_statusreservasi e ON a.IdStatusReservasi = e.IdStatusReservasi
                WHERE a.IdReservasi='$IdReservasi'";
        $dataReservasi = ReadDataOneRow($sql);
        ?>
             <script>
                $(document).ready(function(){
                    $( "#DivNoBill" ).hide();
                });
            </script>
            <div class="full_w" style="margin: 5px; padding: 5px; color: black;">
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
                                    <td colspan="3" class="align-center"><label>Total</label></td>
                                    <td style="text-align: right;">
                                        <label><?php echo FormatRupiah($TotalHargaDiscount); ?></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php 
                    DetailReservasiBtn($IdReservasi, $dataReservasi['IdStatusReservasi'], $dataReservasi['TanggalReservasi'], $TotalHarga);
                ?>
            </div>
        <?php
    }
    // END function detail reservasi
    
    // function detail reservasi button
    function DetailReservasiBtn($IdReservasi, $IdStatusReservasi, $TanggalReservasi, $TotalHarga)
    {
        ?>
            <div class="full_w" style="margin-top: 10px; padding: 7px; text-align: center;">
                <?php
                    if($IdStatusReservasi=="4")
                    {
                        ?>
                            <button class="btn_black" onclick="window.location.href='?m=reservasi'">Kembali</button>
                            <button class="btn_blue" onclick="EditStatusReservasi('<?php echo $IdReservasi; ?>', '<?php echo $TotalHarga; ?>')">Edit Status</button>
                            <a href="?m=print&a=PrintDetailReservasi&IdReservasi=<?php echo $IdReservasi; ?>&page=trans" class="btn_black" style="text-decoration: none;"><span>Print</span></a>
                        <?php
                    }
                    else if ($IdStatusReservasi=="3")
                    {
                        if($TanggalReservasi<date("Y-m-d"))
                        {
                            ?>
                                <button class="btn_black" onclick="window.location.href='?m=reservasi'">Kembali</button>
                                <button class="btn_red" onclick="DeleteReservasi('<?php echo $IdReservasi; ?>')">Hapus</button>
                            <?php
                        }
                        else
                        {
                            ?>
                                <button class="btn_black" onclick="window.location.href='?m=reservasi'">Kembali</button>
                                <button class="btn_blue" onclick="EditStatusReservasi('<?php echo $IdReservasi; ?>', '<?php echo $TotalHarga; ?>')">Edit Status</button>
                                <a href="?m=print&a=PrintDetailReservasi&IdReservasi=<?php echo $IdReservasi; ?>&page=trans" class="btn_black" style="text-decoration: none;"><span>Print</span></a>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <button class="btn_black" onclick="window.location.href='?m=reservasi'">Kembali</button>
                            <button class="btn_blue" onclick="EditStatusReservasi('<?php echo $IdReservasi; ?>', '<?php echo $TotalHarga; ?>')">Edit Status</button>
                            <button class="btn_green" onclick="window.location.href='?m=reservasi&a=EditMenuReservasi&IdReservasi=<?php echo $IdReservasi; ?>&page=trans'">Edit Menu</button>
                            <a target="_blank" href="?m=print&a=PrintDetailReservasi&IdReservasi=<?php echo $IdReservasi; ?>&page=trans" class="btn_black" style="text-decoration: none;"><span>Print</span></a>
                        <?php
                    }
                ?>
            </div>
        <?php
    }
    // END function deteil reservasi button
    // function edit status reservasi
    function EditStatusReservasi()
    {
        include "../../globalfunction/ajax_include.php";
        $IdReservasi = $_GET["IdReservasi"];
        $TotalHarga = $_GET["TotalHarga"];
        $sql = "SELECT a.IdReservasi, b.Nama, c.Organizer, 
                	a.TanggalReservasi, a.JamReservasi, a.JumlahPeserta, a.JumlahKendaraan, a.IdStatusReservasi, a.NoBill, a.Discount, a.Notes
                	FROM tb_reservasi a
                	LEFT JOIN tb_person b ON a.IdPerson=b.IdPerson
                	LEFT JOIN tb_organizer c ON b.IdOrganizer=c.IdOrganizer
                WHERE a.IdReservasi='$IdReservasi'";
        $dataReservasi = ReadDataOneRow($sql);
        
        $CekStatusToday = false;
        if($dataReservasi["TanggalReservasi"] > date("Y-m-d"))
        {
            $CekStatusToday = false;
        }
        else
        {
            $CekStatusToday = true;
        }
        ?>
           
            <div style="padding: 2px">
                <div style="overflow-y: scroll; height: 450px;">
                
                <div class="full_w">
                    <form id="formID2" method="post" action="?m=reservasi&a=UpdateStatusReservasi">
                        <input type="hidden" name="IdReservasi" value="<?php echo $IdReservasi ?>" />
                        <input type="hidden" name="Today" id="Today" value="<?php echo date("Y-m-d") ?>" />
                        <input type="hidden" name="NoBillTemp" id="NoBillTemp" value="<?php echo $dataReservasi["NoBill"]; ?>" />
                        <input type="hidden" name="DiscountTemp" id="DiscountTemp" value="<?php echo $dataReservasi["Discount"]; ?>" />
                        <div class="element">
    						<label for="Organizer">Organizer/Travel</label>
    						<input id="Organizer" style="width: 300px;" disabled="disabled" value="<?php echo $dataReservasi["Organizer"]; ?>" />
    					</div>
                        <div class="element">
    						<label for="TanggalReservasiShow">Tanggal Reservasi</label>
    						<input id="TanggalReservasiShow" name="TanggalReservasiShow" value="<?php echo KonversiTanggal("d M Y", $dataReservasi["TanggalReservasi"]); ?>" class="text validate[required] datepicker" style="width: 120px;" onmousedown="SetDatePicker()" />
                            <input id="TanggalReservasi" type="hidden" name="TanggalReservasi" value="<?php echo $dataReservasi["TanggalReservasi"]; ?>"/>
    					</div>
                        <div class="element">
    						<label for="JamReservasi">Jam</label>
    						<input id="JamReservasi" name="JamReservasi" value="<?php echo date('H:i', strtotime($dataReservasi["JamReservasi"])); ?>" class="text validate[required]" style="width: 120px;" onmousedown="SetTimePicker()" />
    					</div>
                        <div class="element">
    						<label for="JumlahPeserta">Jumlah Peserta</label>
    						<input id="JumlahPeserta" name="JumlahPeserta" value="<?php echo $dataReservasi["JumlahPeserta"]; ?>" class="text validate[required, custom[integer]]" style="width: 120px;" />
    					</div>
                        <div class="element">
    						<label for="JumlahKendaraan">Jumlah Kendaraan</label>
    						<input id="JumlahKendaraan" name="JumlahKendaraan" value="<?php echo $dataReservasi["JumlahKendaraan"]; ?>" class="text validate[required, custom[integer]]" style="width: 120px;" />
    					</div>
                        <div class="element">
    						<label for="IdStatusReservasi">Status Reservasi</label>
    						<select id="IdStatusReservasi" style="width: 130px;" name="IdStatusReservasi" onchange="EnableNoBill()">
                                <?php
                                    if(!$CekStatusToday)
                                    {
                                        $sql = "SELECT * FROM tb_statusreservasi WHERE IdStatusReservasi!='4' ORDER BY IdStatusReservasi ";   
                                    }
                                    else
                                    {
                                        $sql = "SELECT * FROM tb_statusreservasi ORDER BY IdStatusReservasi"; 
                                    }
                                    $dataStatus = ReadDataManyRow($sql);
                                    foreach($dataStatus as $data)
                                    {
                                        if($dataReservasi["IdStatusReservasi"]==$data["IdStatusReservasi"])
                                        {
                                            ?>
                                                <option value="<?php echo $data["IdStatusReservasi"]; ?>" selected="selected"><?php echo $data["StatusReservasi"]; ?></option>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <option value="<?php echo $data["IdStatusReservasi"]; ?>"><?php echo $data["StatusReservasi"]; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
    					</div>
                        <?php
                            if($CekStatusToday)
                            {
                                ?>
                                    <div class="element" id="DivNoBill">
                						<label for="NoBill">No. Bill<span class="red">*</span></label>
                						<input id="NoBill" name="NoBill" value="<?php echo $dataReservasi["NoBill"]; ?>" class="text validate[required, custom[integer]]" style="width: 120px;" disabled="disabled" />
                					</div>
                                    <div class="element">
                						<label for="Discount">Discount</label>
                						<input id="Discount" name="Discount" value="<?php echo $dataReservasi["Discount"]; ?>" class="text validate[custom[integer], max[<?php echo $TotalHarga; ?>], min[0]" style="width: 120px;" disabled="disabled" />
                					</div>
                                <?php
                            } 
                        ?>
                        <div class="element">
    						<label for="Notes">Notes</label>
    						<textarea id="Notes" name="Notes" style="width: 300px; height: 25px;"><?php echo $dataReservasi["Notes"]; ?></textarea>
    					</div>
                        <div class="entry" style="text-align: right;">
			                 <a href="#" onclick="CloseMessi()" class="btn_black" style="text-decoration: none;"><span>Cancel</span></a>
                             <button type="submit" class="btn_blue" onclick="UpdateStatusReservasi(<?php echo $IdReservasi;  ?>)" style="margin-left: 20px;">Save</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        <?php
    }
    // END function edit status reservasi
    
    // function update status reservasi
    function UpdateStatusReservasi()
    {
        $TanggalReservasi = $_POST["TanggalReservasi"];
        $JamReservasi = $_POST["JamReservasi"];
        $JumlahPeserta = $_POST["JumlahPeserta"];
        $IdReservasi = $_POST["IdReservasi"];
        $IdStatusReservasi = $_POST["IdStatusReservasi"];
        $JumlahKendaraan = $_POST["JumlahKendaraan"];
        $NoBill = $_POST["NoBill"];
        $Discount = $_POST["Discount"];
        $Notes = $_POST["Notes"];
        
        if($IdStatusReservasi!='4')
        {
            $sql = "UPDATE tb_reservasi SET
                	JumlahPeserta='$JumlahPeserta',
                	TanggalReservasi='$TanggalReservasi',
                	JamReservasi='$JamReservasi',
                    JumlahKendaraan='$JumlahKendaraan',
                	IdStatusReservasi='$IdStatusReservasi',
                    Notes='$Notes',
                    NoBill='',
                    Discount='0'
                WHERE IdReservasi='$IdReservasi'";
        }
        else
        {
            $sql = "UPDATE tb_reservasi SET
                	JumlahPeserta='$JumlahPeserta',
                	TanggalReservasi='$TanggalReservasi',
                	JamReservasi='$JamReservasi',
                    JumlahKendaraan='$JumlahKendaraan',
                	IdStatusReservasi='$IdStatusReservasi',
                    Notes='$Notes',
                    NoBill='$NoBill',
                    Discount='$Discount'
                WHERE IdReservasi='$IdReservasi'";
        }
        
        // esecute query
        ExecuteQuery($sql);
        
    }
    // END function update status reservasi
    
    // function edit menu reservasi
    function EditMenuReservasi()
    {
        $IdReservasi = $_GET["IdReservasi"];
        HeaderTitle("Edit Menu Reservasi");
        
        // data detail reservasi
        $sql = "SELECT a.IdReservasi, b.Nama, b.NoHandphone, c.Organizer,
                	a.TanggalReservasi, a.JamReservasi, a.JumlahPeserta, a.JumlahKendaraan, e.StatusReservasi, a.IdStatusReservasi
                	FROM tb_reservasi a
                	LEFT JOIN tb_person b ON a.IdPerson=b.IdPerson
                	LEFT JOIN tb_organizer c ON b.IdOrganizer=c.IdOrganizer
                	LEFT JOIN tb_statusreservasi e ON a.IdStatusReservasi = e.IdStatusReservasi
                WHERE a.IdReservasi='$IdReservasi'";
                
        $dataDetailReservasi = ReadDataOneRow($sql);
        ?>
           <div style="margin: 10px 20px 10px 20px;">
                <div style="display: table;">
                    <table>
                        <tr>
                            <td style="vertical-align: top;">
                                <div style="width: 480px; min-height: 100px; margin-right: 10px; display: table-cell;">
                                    <?php ListMenuItem(); ?>
                                </div>
                            </td>
                            <td style="padding-left: 25px;">
                                <div style="width: 800px; display: table-cell; margin-left: 10px;">
                                    <div class="full_w" style="min-height: 100px; padding: 5px;">
                                        <div style="text-align: center;">
                                            <h2 style="color: #400000; margin: 0px;">DETAIL RESERVASI</h2>
                                            <div class="sep"></div>
                                        </div>
                                        <div class="full_w detailreservasi" style="padding: 5px;">
                                            <table class="tbclear">
                                                <tr>
                                                    <td style="width: 120px;">Organizer/Travel</td>
                                                    <td style="width: 10px;">:</td>
                                                    <td style="font-weight: bold;"><?php echo $dataDetailReservasi["Organizer"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Person</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo $dataDetailReservasi["Nama"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Reservasi</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo KonversiTanggal("l, d M Y", $dataDetailReservasi["TanggalReservasi"]) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jam</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo date('H:i', strtotime($dataDetailReservasi["JamReservasi"])); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo RentangWaktu( date( 'H:i', strtotime($dataDetailReservasi["JamReservasi"]) ) ); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Peserta</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo $dataDetailReservasi["JumlahPeserta"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Kendaraan</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><?php echo $dataDetailReservasi["JumlahKendaraan"]; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status Reservasi</td>
                                                    <td>:</td>
                                                    <td style="font-weight: bold;"><label class="<?php echo GetStatusClass($dataDetailReservasi["IdStatusReservasi"]); ?>"><?php echo $dataDetailReservasi["StatusReservasi"]; ?></label></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <form style="margin: 0px;" method="POST" action="?m=reservasi&a=UpdateMenuReservasi">
                                        <input type="hidden" name="IdReservasi" value="<?php echo $IdReservasi; ?>" />
                                        <div class="datagrid">
                                            <table id="table_trans">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 120px; text-align: center;">Nama Menu</th>
                                                        <th style="width: 90px; text-align: center;">Harga</th>
                                                        <th style="width: 70px; text-align: center;">Jumlah</th>
                                                        <th style="width: 90px; text-align: center;">Sub Total</th>
                                                        <th style="width: 150px; text-align: center;">Note</th>
                                                        <th style="width: 60px; text-align: center;">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $sql = "SELECT a.IdReservasi, a.IdMenuMakanan, c.MenuMakanan, c.Harga, a.JumlahItem, c.Harga*a.JumlahItem AS 'TotalHarga', a.NotesMenu
                                                                	FROM tb_detailreservasi a
                                                                	INNER JOIN tb_reservasi b ON a.IdReservasi = b.IdReservasi
                                                                	LEFT JOIN tb_menumakanan c ON a.IdMenuMakanan = c.IdMenuMakanan
                                                                WHERE a.IdReservasi = '$IdReservasi' ORDER BY a.IdDetailReservasi ASC";
                                                        
                                                        $dataDetailMenu = ReadDataManyRow($sql);
                                                        $TotalItem = 0;
                                                        $TotalHarga = 0;
                                                        foreach($dataDetailMenu as $data)
                                                        {
                                                            ?>
                                                                <tr>
                                                                    <input type='hidden' name='IdMenuMakanan[]' value='<?php echo $data["IdMenuMakanan"]; ?>' />
                                                                    <input type='hidden' name='Harga[]' value='<?php echo $data["Harga"]; ?>' />
                                                                    <input type='hidden' name='JumlahItem[]' value='<?php echo $data["JumlahItem"]; ?>' />
                                                                    <input type='hidden' name='TotalHarga[]' value='<?php echo $data["TotalHarga"]; ?>' />
                                                                    <input type='hidden' name='NotesMenu[]' value='<?php echo $data["NotesMenu"]; ?>' />
                                                                    <td class="align_top"><?php echo $data["MenuMakanan"]; ?></td>
                                                                    <td class='align-right align_top'><?php echo $data["Harga"]; ?></td>
                                                                    <td class='align-right align_top'><?php echo $data["JumlahItem"]; ?></td>
                                                                    <td class='align-right align_top'><?php echo $data["TotalHarga"]; ?></td>
                                                                    <td class='align-left align_top'><?php echo $data["NotesMenu"]; ?></td>
                                                                    <td class='align-center align_top'>
                                                                        <a href='javascript:void(0)' onclick='DeleteRow(this)'><img src='../images/denided.png' title='Hapus'/></a>
                                                                        <a href='javascript:void(0)' onclick="EditRowMenu(this, '<?php echo $data["IdMenuMakanan"]; ?>', '<?php echo $data["JumlahItem"]; ?>', '<?php echo $data["NotesMenu"]; ?>')" style='margin-left: 20px;'><img src='../images/i_edit.png' title='Edit'/>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                            $TotalItem += $data["JumlahItem"];
                                                            $TotalHarga += $data["TotalHarga"];
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="sep"></div>
                                        <div class="datagrid summarytotal" style="margin: 10px 0px 0px 480px; width: 300px;">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th style="width: 150px; text-align: center;">Jumlah Item</th>
                                                        <th style="width: 150px; text-align: center;">Total Harga (Rp.)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;"><label id="SumJumlahItem"><?php echo $TotalItem; ?></label></td>
                                                        <td style="text-align: right;"><label id="SumTotalHarga"><?php echo $TotalHarga; ?></label></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="margin-top: 5px; text-align: right; padding: 10px;">
                                            <a href="?m=reservasi&a=DetailReservasi&IdReservasi=<?php echo $IdReservasi; ?>" class="btn_red" style="color: white; text-decoration: none;"><span>CANCEL</span></a>
                                            <button type="submit" class="btn_green" onclick="" style="margin-left: 15px;">SIMPAN</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php
    }
    // END function edit menu reservasi
    
    
    // function update menu reservasi
    function UpdateMenuReservasi()
    {
        $IdReservasi = $_POST["IdReservasi"];
        $IdMenuMakanan = $_POST["IdMenuMakanan"];
        $JumlahItem = $_POST["JumlahItem"];
        $Harga = $_POST["Harga"];
        $NotesMenu = $_POST["NotesMenu"];
        $cnn = new koneksi();
        
        // delete detail transaksi firs
        $sql = "DELETE FROM tb_detailreservasi WHERE IdReservasi='$IdReservasi'";
        
        $cnn->exec_query($sql);
        if($cnn->status=="1")
        {
            // get length pesanan
            $Length = count($IdMenuMakanan);
            for($i=0; $i<$Length; $i++)
            {
                $sql = "INSERT INTO tb_detailreservasi (IdReservasi, IdMenuMakanan, JumlahItem, Harga, NotesMenu) 
                VALUE ('$IdReservasi', '".$IdMenuMakanan[$i]."', '".$JumlahItem[$i]."', '".$Harga[$i]."', '".$NotesMenu[$i]."')";
                
                $cnn->exec_query($sql);
            }
            $js = "parent.window.location ='?m=reservasi&a=DetailReservasi&IdReservasi=".$IdReservasi."'";
            exec_js($js);
        }
        
    }
    // function update menu resevasi
    
    // function search reservasi
    function SearchReservasi()
    {
        include "../../globalfunction/ajax_include.php";
        $StartDate = $_GET["StartDate"];
        $EndDate = $_GET["EndDate"];
        
        $StatusReservasi = $_GET["StatusReservasi"];
        
        // string conditional
        $Conditional = "WHERE a.TanggalReservasi BETWEEN '$StartDate' AND '$EndDate' AND a.IdStatusReservasi='$StatusReservasi' ORDER BY a.TanggalReservasi";
        
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
        $Conditional = "WHERE b.Nama LIKE '%$Keyword%' OR c.Organizer LIKE '%$Keyword%' OR a.TanggalReservasi LIKE '%$Keyword%' OR a.NoBill LIKE '%$Keyword%'  ORDER BY a.TanggalReservasi DESC";
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
    // END function cari reservasi
    
?>