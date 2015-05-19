<?php
    // function view laporan
    function ViewReport()
    {
        HeaderTitle("View Report");
        
        ?>
            <script>
               $(function(){
                    
                    // hide report bulanan button
                    $("#ReportBulanan").hide();
                    $("#ToTenOrganizer").hide();
                    $("#LaporanPerBulanRange").hide();
                    
                    var options = {
                        startYear: 2014,
                        finalYear: 2025,
                        monthNames: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sep', 'Okt', 'Nop', 'Des']
                    };
                    
                    $('#BulanTahun').monthpicker(options);
                    $('#BulanTahunTopTen').monthpicker(options);
                    
                    
                        
                        // datepicker untuk start date
                    $( "#StartDate" ).datepicker({
                                      changeMonth: true,
                                      changeYear: true,
                                      dateFormat: "dd/mm/yy",
                                      yearRange: '2014:2025',
                                      onClose: function( selectedDate ) {
                                                $( "#EndDate" ).datepicker( "option", "minDate", selectedDate );
                                              }
                    });
                        
                        // end datepicker untuk end date
                    $( "#EndDate" ).datepicker({
                                  changeMonth: true,
                                  changeYear: true,
                                  dateFormat: "dd/mm/yy",
                                  yearRange: '2014:2025',
                                  onClose: function( selectedDate ) {
                                            $( "#StartDate" ).datepicker( "option", "maxDate", selectedDate );
                                          }
                    });
                });
                
                // function show report bulanan
                function ShowReportBulanan()
                {
                    $("#btn_reports").hide();
                    $("#ReportBulanan").fadeIn("slow");
                    $("#ShowReport").fadeOut("slow");
                    ClearValue();
                }
                
                // function hide report bulanan
                function HideReportBulanan()
                {
                    $("#BulanTahun").val("");
                    $("#ReportBulanan").hide();
                    $("#btn_reports").fadeIn("slow");
                }
                // END function hide report bulanan
                
                // function show to 10 organizer
                function ShowTopTenOrganizer()
                {
                    $("#btn_reports").hide();
                    $("#ToTenOrganizer").fadeIn("slow");
                    $("#ShowReport").fadeOut("slow");
                    ClearValue();
                }
                // END function show top 10 organizer
                
                // function hide top 10 organizer
                function HideTopTenOrganizer()
                {
                    $("#ToTenOrganizer").hide();
                    $("#btn_reports").fadeIn("slow");
                    ClearValue();
                }
                // END function hide top 10 organizer
                
                // function show report per bulan
                function ShowLaporanPerBulan()
                {
                    $("#LaporanPerBulanRange").hide();
                    $("#LaporanPerBulan").fadeIn("fast");
                    ClearValue();
                }
                // END function show report per bulan
                
                // function show laporan range
                function ShowLaporanPerBulanRange()
                {
                    $("#LaporanPerBulan").hide();
                    $("#LaporanPerBulanRange").fadeIn("fast");
                    ClearValue();
                }
                // END function show laporan range
                
                // function clear value
                function ClearValue()
                {
                    $('#BulanTahun').val("")
                    $('#BulanTahunTopTen').val("");
                    $('#StartDate').val("");
                    $('#EndDate').val("");
                }
                // END function clear value 
                
            </script>
            <div class="full_w" style="margin: 10px; text-align: center; padding: 5px;">
                <div id="btn_reports" style="margin: 0 auto;">
                    <button class="add" style="margin-right: 15px;" onclick="ShowReportBulanan()">Laporan Bulanan</button> 
                    <button class="new_user" onclick="ShowTopTenOrganizer()" >Top 10 Organizer</button>
                </div>
                <div id="ReportBulanan" style="text-align: center;">
                    <button class="btn_report" onclick="ShowLaporanPerBulan()" >View Laporan/Bulan</button>
                    <button class="export_excel" onclick="ShowLaporanPerBulanRange()" >View Laporan by Range</button>
                    <div class="sep"></div>
                    <div id="LaporanPerBulan">
                        <form id="FormReportBulanan" style="margin: 0px;">
                            <table>
                                <tr>
                                    <td>
                                        <label for="BulanTahun" style="font-weight: normal;"><b>View Laporan/Bulan</b> (mm/yy)</label>
                                    </td>
                                    <td>
                                        <input id="BulanTahun" name="BulanTahun" class="text datepicker" style="width: 150px; margin-left: 10px;" />
                                    </td>
                                     <td style="padding-left: 25px;">
                                        <label for="RentangWaktu">Waktu Kunjungan</label>
                                    </td>
                                    <td style="padding-left: 10px;">
                                        <select style="width: 160px;" id="RentangWaktu" name="RentangWaktu">
                                            <option value="0">All</option>
                                            <option value="1">Pagi</option>
                                            <option value="2">Siang</option>
                                            <option value="3">Sore</option>
                                            <option value="4">Malam</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a onclick="TampilkanLaporanBulanan($('#BulanTahun').val())" class="btn_blue" style="text-decoration: none;margin-left: 20px;" href="javascript:void(0);"><span>Tampilkan</span></a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="HideReportBulanan()" title="Hide" style="padding-left: 20px;"><img src="../images/arrowicon.png" /></a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div id="LaporanPerBulanRange">
                        <form id="FormReportBulananRange" style="margin: 0px;">
                            <table>
                                <tr>
                                    <td>
                                        <label for="StartDate" style="font-weight: normal;"><b>View Laporan :</b> Tanggal (dd/mm/yy)</label>
                                    </td>
                                    <td>
                                        <input id="StartDate" name="StartDate" class="text datepicker" style="width: 150px; margin-left: 10px;" />
                                    </td>
                                    <td>
                                        <label for="EndDate" style="font-weight: normal;"><b>Sampai</b> (dd/mm/yy)</label>
                                    </td>
                                    <td>
                                        <input id="EndDate" name="EndDate" class="text datepicker" style="width: 150px; margin-left: 10px;" />
                                    </td>
                                     <td style="padding-left: 25px;">
                                        <label for="RentangWaktu">Waktu Kunjungan</label>
                                    </td>
                                    <td style="padding-left: 10px;">
                                        <select style="width: 160px;" id="RentangWaktuRange" name="RentangWaktuRange">
                                            <option value="0">All</option>
                                            <option value="1">Pagi</option>
                                            <option value="2">Siang</option>
                                            <option value="3">Sore</option>
                                            <option value="4">Malam</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a onclick="TampilkanLaporanBulananRange()" class="btn_blue" style="text-decoration: none;margin-left: 20px;" href="javascript:void(0);"><span>Tampilkan</span></a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="HideReportBulanan()" title="Hide" style="padding-left: 20px;"><img src="../images/arrowicon.png" /></a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div id="ToTenOrganizer" style="text-align: center;">
                    <label style="font-size: 13px; font-weight: bold;">Laporan Top 10 Organizer</label>
                    <div class="sep"></div>
                    <form id="FormReportBulanan" style="margin: 0px;">
                        <table>
                            <tr>
                                <td>
                                    <label for="BulanTahunTopTen">Bulan / Tahun</label>
                                </td>
                                <td>
                                    <input id="BulanTahunTopTen" name="BulanTahunTopTen" class="text datepicker" style="width: 150px; margin-left: 10px;" />
                                </td>
                                <td>
                                    <a onclick="TampilkanTop10()" class="btn_blue" style="text-decoration: none;margin-left: 20px;" href="javascript:void(0);"><span>Tampilkan</span></a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" onclick="HideTopTenOrganizer()" title="Hide" style="padding-left: 20px;"><img src="../images/arrowicon.png" /></a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div id="ShowReport">
                    
            </div>
        <?php
    }
    // END function view laporan
    
    // function tampilkan laporan bulanan
    function TampilkanLaporanBulanan()
    {
        $BulanTahunTemp = $_GET["BulanTahun"];
        $RentangWaktu = $_GET["RentangWaktu"];
        //$BulanTahun = date("yy-mm", strtotime($BulanTahun));
        $parts = explode('/',$BulanTahunTemp);
        
        $BulanTahun = $parts[1]."-".$parts[0];
        $Condition = ConditionRentangWaktu($RentangWaktu);
        include "../../globalfunction/ajax_include.php";
        ?>
            <div style="text-align: center;">
                <h2>DATA KUNJUNGAN TAMU ( <?php echo KonversiTanggal("M Y", $BulanTahun) ?> )</h2>
            </div>
            <div class="sep"></div>
            <div style="overflow-x: scroll;">
            <a id="ReportBulananToExcel" href="" style="margin: 10px 10px 0px 10px; font-size: 12px;">Export To Excel</a>
            <a target="_blank" href="?m=print&a=PrintLaporanBulanan&BulanTahun=<?php echo $BulanTahun; ?>&RentangWaktu=<?php echo $RentangWaktu; ?>&page=trans" style="margin: 10px 10px 0px 10px; font-size: 12px;">Print Report</a>
            <div class="datagrid" style="margin: 5px 10px 10px 10px; width: 120%;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
    				        <th style="width: 70px; text-align: center;">Tanggal</th>
                            <th style="width: 30px; text-align: center;">Jam</th>
                            <th style="width: 50px; text-align: center;">Waktu</th>
                            <th style="width: 100px; text-align: center;">Organizer</th>
                            <th style="width: 80px; text-align: center;">Tipe Cutomer</th>
                            <th style="width: 90px; text-align: center;">Kota</th>
                            <th style="width: 40px; text-align: center;">Peserta</th>
                            <th style="width: 90px; text-align: center;">Tot. Harga(gross)</th>
                            <th style="width: 90px; text-align: center;">Discount</th>
                            <th style="width: 90px; text-align: center;">Tot. Harga(net)</th>
                            <th style="width: 50px; text-align: center;">No. Bill</th>
                            <th style="width: 90px; text-align: center;">Person</th>
                            <th style="width: 70px; text-align: center;">No. Hp</th>
                            <th style="width: 30px; text-align: center;" title="Jumlah Kendaraan">Bus</th>
                            <th style="width: 130px; text-align: center;">Notes</th>
                            <th style="width: 30px; text-align: center;" title="Option">Opt</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT a.IdReservasi, a.TanggalReservasi, a.JamReservasi, c.Organizer, d.TipeCustomer, e.Kota,
                                    	a.JumlahPeserta, bb.TotalHarga, a.NoBill, b.Nama, b.NoHandphone,
                                    	a.JumlahKendaraan, a.Discount, a.Notes,
                                        bb.TotalHarga-a.Discount AS 'HargaNet'
                                    	FROM tb_reservasi a
                                    	INNER JOIN 
                                    		(SELECT IdReservasi, SUM(Harga*JumlahItem) AS 'TotalHarga' 
                                    			FROM tb_detailreservasi GROUP BY IdReservasi) bb ON a.IdReservasi = bb.IdReservasi
                                    	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                    	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                    	LEFT JOIN tb_tipecustomer d ON c.IdTipeCustomer = d.IdTipeCustomer
                                    	LEFT JOIN tb_kota e ON c.IdKota = e.IdKota
                                    WHERE a.TanggalReservasi LIKE '$BulanTahun%' AND a.IdStatusReservasi = '4' ".$Condition." ORDER BY a.TanggalReservasi, a.JamReservasi";
                            
                            $dataReport = ReadDataManyRow($sql);
                            if(count($dataReport)>0)
                            {
                                $i = 1;
                                $TotalPerson = 0;
                                $TotalHargaGross = 0;
                                $TotalHargaNet = 0;
                                $TotalKendaraan = 0;
                                foreach($dataReport as $data)
                                {
                                    ?>
                                        <tr>
                                            <td class="align_top"><?php echo $i; ?></td>
                                            <td class="align_top"><?php echo KonversiTanggal("d-m-Y", $data["TanggalReservasi"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo date('H:i', strtotime($data["JamReservasi"])); ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo RentangWaktu( date('H:i', strtotime( $data["JamReservasi"]) ) ); ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["TipeCustomer"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["Kota"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["JumlahPeserta"]; ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["TotalHarga"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["Discount"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["HargaNet"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo $data["NoBill"]; ?></td>
                                            <td class="align_top"><?php echo $data["Nama"]; ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo $data["NoHandphone"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["JumlahKendaraan"]; ?></td>
                                            <td class="align_top" style="text-align: left;"><?php echo $data["Notes"]; ?></td>
                                            <td class="align_top" style="text-align: center;">
                                                <a href="javascript:void(0);" title="Detail Reservasi" onclick="ViewDetailReservasi('<?php echo $data["IdReservasi"]; ?>')"><img src="../images/next.png" /></a>
                                            </td>
                                        </tr>
                                    <?php
                                    $i++;
                                    $TotalPerson +=$data["JumlahPeserta"];
                                    $TotalHargaGross +=$data["TotalHarga"];
                                    $TotalHargaNet +=$data["HargaNet"];
                                    $TotalKendaraan +=$data["JumlahKendaraan"];
                                }
                                ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;"><label class="sumtotaltable">TOTAL</label></td>
                                        <td class="align_top" style="text-align: center;"><label class="sumtotaltable"><?php echo $TotalPerson; ?></label></td>
                                        <td class="align_top" style="text-align: right;"><label class="sumtotaltable"><?php echo "Rp. ".FormatRupiah($TotalHargaGross); ?></label></td>
                                        <td class="align_top" style="text-align: right;">-</td>
                                        <td class="align_top" style="text-align: right;"><label class="sumtotaltable"><?php echo "Rp. ".FormatRupiah($TotalHargaNet); ?></label></td>
                                        <td colspan="3" class="align_top" style="text-align: center;"></td>
                                        <td class="align_top" style="text-align: center;"><label class="sumtotaltable"><?php echo $TotalKendaraan; ?></label></td>
                                        <td colspan="2" class="align_top" style="text-align: center;"></td>
                                    </tr>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td colspan="14" style="text-align: center;">Data Tidak Ditemukan</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php
                $url = "export/excel.php?type=LaporanBulanan&BulanTahun=$BulanTahun&RentangWaktu=$RentangWaktu&TotalPerson=$TotalPerson&TotalHargaGross=$TotalHargaGross&TotalHargaNet=$TotalHargaNet&TotalKendaraan=$TotalKendaraan";
            ?>
            <script>
                $(function()
                {
                    var url = "<?php echo $url; ?>";
                    $("#ReportBulananToExcel").attr("href", url)
                });
            </script>
        <?php
    }
    // END function tampilkan laporan bulanan
    
    
    // function tampilkan report bulanan range
    function TampilkanLaporanBulananRange()
    {
        include "../../globalfunction/ajax_include.php";
        $StartDateTemp = $_GET["StartDate"];
        $EndDateTemp = $_GET["EndDate"];
        
        $StartDate = ConvertDate_YMD($StartDateTemp);
        $EndDate = ConvertDate_YMD($EndDateTemp);
        
        $RentangWaktu = $_GET["RentangWaktu"];
        
        $Condition = ConditionRentangWaktu($RentangWaktu);
        ?>
            <div style="text-align: center; color: #400000;">
                <h2>DATA KUNJUNGAN TAMU</h2>
                <label style="font-size: 13px; color: #2C2C2C; font-weight: normal;">
                    <b><?php echo KonversiTanggal("d M Y", $StartDate); ?></b> 
                    &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; 
                    <b><?php echo KonversiTanggal("d M Y", $EndDate); ?></b>
                </label>
            </div>
            <div class="sep"></div>
            <div style="overflow-x: scroll;">
            <a id="ReportBulananRangeToExcel" href="export/excel.php?type=LaporanBulananRange&StartDate=<?php echo $StartDate; ?>&EndDate=<?php echo $EndDate; ?>&RentangWaktu=<?php echo $RentangWaktu; ?>" style="margin: 10px 10px 0px 10px; font-size: 12px;">Export To Excel</a>
            <a target="_blank" href="?m=print&a=PrintLaporanBulananRange&StartDate=<?php echo $StartDate; ?>&EndDate=<?php echo $EndDate; ?>&RentangWaktu=<?php echo $RentangWaktu; ?>&page=trans" style="margin: 10px 10px 0px 10px; font-size: 12px;">Print Report</a>
            <div class="datagrid" style="margin: 5px 10px 10px 10px; width: 120%;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
    				        <th style="width: 70px; text-align: center;">Tanggal</th>
                            <th style="width: 30px; text-align: center;">Jam</th>
                            <th style="width: 50px; text-align: center;">Waktu</th>
                            <th style="width: 100px; text-align: center;">Organizer</th>
                            <th style="width: 80px; text-align: center;">Tipe Cutomer</th>
                            <th style="width: 90px; text-align: center;">Kota</th>
                            <th style="width: 40px; text-align: center;">Peserta</th>
                            <th style="width: 90px; text-align: center;">Tot. Harga(gross)</th>
                            <th style="width: 90px; text-align: center;">Discount</th>
                            <th style="width: 90px; text-align: center;">Tot. Harga(net)</th>
                            <th style="width: 50px; text-align: center;">No. Bill</th>
                            <th style="width: 90px; text-align: center;">Person</th>
                            <th style="width: 70px; text-align: center;">No. Hp</th>
                            <th style="width: 30px; text-align: center;" title="Jumlah Kendaraan">Bus</th>
                            <th style="width: 130px; text-align: center;">Notes</th>
                            <th style="width: 30px; text-align: center;" title="Option">Opt</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT a.IdReservasi, a.TanggalReservasi, a.JamReservasi, c.Organizer, d.TipeCustomer, e.Kota,
                                    	a.JumlahPeserta, bb.TotalHarga, a.NoBill, b.Nama, b.NoHandphone,
                                    	a.JumlahKendaraan, a.Discount, a.Notes,
                                        bb.TotalHarga-a.Discount AS 'HargaNet'
                                    	FROM tb_reservasi a
                                    	INNER JOIN 
                                    		(SELECT IdReservasi, SUM(Harga*JumlahItem) AS 'TotalHarga' 
                                    			FROM tb_detailreservasi GROUP BY IdReservasi) bb ON a.IdReservasi = bb.IdReservasi
                                    	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                    	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                    	LEFT JOIN tb_tipecustomer d ON c.IdTipeCustomer = d.IdTipeCustomer
                                    	LEFT JOIN tb_kota e ON c.IdKota = e.IdKota
                                    WHERE a.TanggalReservasi BETWEEN '$StartDate%' AND '$EndDate' AND a.IdStatusReservasi = '4' ".$Condition."ORDER BY a.TanggalReservasi, a.JamReservasi";
                            
                            $dataReport = ReadDataManyRow($sql);
                            if(count($dataReport)>0)
                            {
                                $i = 1;
                                $TotalPerson = 0;
                                $TotalHargaGross = 0;
                                $TotalHargaNet = 0;
                                $TotalKendaraan = 0;
                                foreach($dataReport as $data)
                                {
                                    ?>
                                        <tr>
                                            <td class="align_top"><?php echo $i; ?></td>
                                            <td class="align_top"><?php echo KonversiTanggal("d-m-Y", $data["TanggalReservasi"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo date('H:i', strtotime($data["JamReservasi"])); ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo RentangWaktu( date('H:i', strtotime( $data["JamReservasi"]) ) ); ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["TipeCustomer"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["Kota"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["JumlahPeserta"]; ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["TotalHarga"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["Discount"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["HargaNet"]); ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo $data["NoBill"]; ?></td>
                                            <td class="align_top"><?php echo $data["Nama"]; ?></td>
                                            <td class="align_top" style="text-align: right;"><?php echo $data["NoHandphone"]; ?></td>
                                            <td class="align_top" style="text-align: center;"><?php echo $data["JumlahKendaraan"]; ?></td>
                                            <td class="align_top" style="text-align: left;"><?php echo $data["Notes"]; ?></td>
                                            <td class="align_top" style="text-align: center;">
                                                <a href="javascript:void(0);" title="Detail Reservasi" onclick="ViewDetailReservasi('<?php echo $data["IdReservasi"]; ?>')"><img src="../images/next.png" /></a>
                                            </td>
                                        </tr>
                                    <?php
                                    $i++;
                                    $TotalPerson +=$data["JumlahPeserta"];
                                    $TotalHargaGross +=$data["TotalHarga"];
                                    $TotalHargaNet +=$data["HargaNet"];
                                    $TotalKendaraan +=$data["JumlahKendaraan"];
                                }
                                ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center;"><label class="sumtotaltable">TOTAL</label></td>
                                        <td class="align_top" style="text-align: center;"><label class="sumtotaltable"><?php echo $TotalPerson; ?></label></td>
                                        <td class="align_top" style="text-align: right;"><label class="sumtotaltable"><?php echo "Rp. ".FormatRupiah($TotalHargaGross); ?></label></td>
                                        <td class="align_top" style="text-align: right;">-</td>
                                        <td class="align_top" style="text-align: right;"><label class="sumtotaltable"><?php echo "Rp. ".FormatRupiah($TotalHargaNet); ?></label></td>
                                        <td colspan="3" class="align_top" style="text-align: center;"></td>
                                        <td class="align_top" style="text-align: center;"><label class="sumtotaltable"><?php echo $TotalKendaraan; ?></label></td>
                                        <td colspan="2" class="align_top" style="text-align: center;"></td>
                                    </tr>
                                <?php
                            }
                            else
                            {
                                ?>
                                    <tr>
                                        <td colspan="14" style="text-align: center;">Data Tidak Ditemukan</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
            <?php
                $url = "export/excel.php?type=LaporanBulananRange&StartDate=$StartDate&EndDate=$EndDate&RentangWaktu=$RentangWaktu&TotalPerson=$TotalPerson&TotalHargaGross=$TotalHargaGross&TotalHargaNet=$TotalHargaNet&TotalKendaraan=$TotalKendaraan";
            ?>
            <script>
                $(function()
                {
                    var url = "<?php echo $url; ?>";
                    $("#ReportBulananRangeToExcel").attr("href", url)
                });
            </script>
        <?php
    }
    // END function tampilkan report bulanan range
    
    // function convert date
    function ConvertDate_YMD($date)
    {
        $parts = explode('/',$date);
        
        $newformat = $parts[2]."-".$parts[1]."-".$parts[0];
        return $newformat;
    }
    function TampilkanTop10()
    {
        $BulanTahunTemp = $_GET["BulanTahun"];
        $parts = explode('/',$BulanTahunTemp);
        
        $BulanTahun = $parts[1]."-".$parts[0];
        include "../../globalfunction/ajax_include.php";
        ?>
            <div style="padding: 10px; margin: 0 auto;">
                <div style="display: table-cell;">
                    <div class="full_w" style="padding: 10px; margin-right: 20px;">
                         <div style="text-align: center; font-size: 15px; font-weight: bold;" class="closed">
                            TOP 10 Organizer : Kunjungan Terbanyak ( <?php echo KonversiTanggal("M Y", $BulanTahun) ?> )
                        </div>
                        <div class="sep"></div>
                        <a href="export/excel.php?type=TopTenKunjungan&BulanTahun=<?php echo $BulanTahun; ?>" style="margin: 10px 10px 0px 0px; font-size: 12px;">Export To Excel</a>
                        <a target="_blank" href="?m=print&a=PrintTopTenOrganizerKunjungan&BulanTahun=<?php echo $BulanTahun; ?>&page=trans" style="margin: 10px 10px 0px 10px; font-size: 12px;">Print Report</a>
                        <div class="datagrid">
                            <table>
                                <thead>
                                    <th style="width: 15px;">No</th>
    				                <th style="width: 120px; text-align: center;">Travel/Organizer</th>
                                    <th style="width: 100px; text-align: center;">Kota</th>
                                    <th style="width: 90px; text-align: center;">No. Telp</th>
                                    <th style="width: 70px; text-align: center;">Kunjungan</th>
                                    <th style="width: 100px; text-align: center;">Owner</th>
                                    <th style="width: 90px; text-align: center;">Kontak</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sql = "SELECT c.Organizer, d.Kota, COUNT(c.IdOrganizer) AS 'JumlahKunjungan', c.Telepon, c.Owner, c.KontakOwner
                                                	FROM tb_reservasi a
                                                	INNER JOIN tb_person b ON a.IdPerson = b.IdPerson
                                                	INNER JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                                	INNER JOIN tb_kota d ON c.IdKota = d.IdKota
                                                WHERE a.TanggalReservasi LIKE '$BulanTahun%' AND a.IdStatusReservasi = '4'
                                                GROUP BY c.IdOrganizer ORDER BY JumlahKunjungan DESC LIMIT 10
                                                ";
                                        $dataTopKunjungan = ReadDataManyRow($sql);
                                        $i = 1;
                                        foreach($dataTopKunjungan as $data)
                                        {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $data["Kota"]; ?></td>
                                                    <td style="text-align: left;"><?php echo $data["Telepon"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $data["JumlahKunjungan"]." x"; ?></td>
                                                    <td><?php echo $data["Owner"]; ?></td>
                                                    <td><?php echo $data["KontakOwner"]; ?></td>
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
                <div style="display: table-cell;">
                    <div class="full_w" style="padding: 10px;" >
                        <div style="text-align: center; font-size: 15px; font-weight: bold;" class="confirmed">
                            TOP 10 Organizer : Omzet Terbanyak ( <?php echo KonversiTanggal("M Y", $BulanTahun) ?> )
                        </div>
                        <div class="sep"></div>
                        <a href="export/excel.php?type=TopTenOmzet&BulanTahun=<?php echo $BulanTahun; ?>" style="margin: 10px 10px 0px 0px; font-size: 12px;">Export To Excel</a>
                        <a target="_blank" href="?m=print&a=PrintTopTenOrganizerOmzet&BulanTahun=<?php echo $BulanTahun; ?>&page=trans" style="margin: 10px 10px 0px 10px; font-size: 12px;">Print Report</a>
                        <div class="datagrid">
                            <table>
                                <thead>
                                    <th style="width: 15px;">No</th>
    				                <th style="width: 100px; text-align: center;">Travel/Organizer</th>
                                    <th style="width: 100px; text-align: center;">Kota</th>
                                    <th style="width: 90px; text-align: center;">No. Telp</th>
                                    <th style="width: 100px; text-align: center;">Total Omzet</th>
                                    <th style="width: 120px; text-align: center;">Owner</th>
                                    <th style="width: 90px; text-align: center;">Kontak</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT c.Organizer, d.Kota, SUM(aa.TotalOmzet-a.Discount) AS 'Omzet', c.Telepon, c.Owner, c.KontakOwner
                                                	FROM tb_reservasi a 
                                                	INNER JOIN 
                                                		(SELECT IdReservasi, SUM(JumlahItem*Harga) AS 'TotalOmzet' FROM tb_detailreservasi
                                                			GROUP BY IdReservasi) aa ON a.IdReservasi = aa.IdReservasi
                                                	INNER JOIN tb_person b ON a.IdPerson = b.IdPerson
                                                	INNER JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                                	LEFT JOIN tb_kota d ON c.IdKota = d.IdKota
                                                WHERE a.TanggalReservasi LIKE '$BulanTahun%' AND a.IdStatusReservasi = '4'
                                                GROUP BY c.IdOrganizer ORDER BY Omzet DESC";
                                        $dataTopOmzet = ReadDataManyRow($sql);
                                        $i = 1;
                                        foreach($dataTopOmzet as $data)
                                        {
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                                    <td style="text-align: center;"><?php echo $data["Kota"]; ?></td>
                                                    <td style="text-align: left;"><?php echo $data["Telepon"]; ?></td>
                                                    <td style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["Omzet"]); ?></td>
                                                    <td><?php echo $data["Owner"]; ?></td>
                                                    <td><?php echo $data["KontakOwner"]; ?></td>
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
            </div>
        <?php
    }
    
    // function condition rentang waktu
    function ConditionRentangWaktu($RentangWaktu)
    {
        $Condition = "";
        switch($RentangWaktu)
        {
            case "0" :
                $Condition = "";
            break;
            
            case "1" :
                $Condition = " AND a.JamReservasi BETWEEN '06:00' AND '10:00' ";
            break;
            
            case "2" :
                $Condition = " AND a.JamReservasi BETWEEN '10:01' AND '14:00' ";
            break;
            
            case "3" :
                $Condition = " AND a.JamReservasi BETWEEN '14:01' AND '18:00' ";
            break;
            
            case "4" :
                $Condition = " AND a.JamReservasi BETWEEN '18:01' AND '24:00' ";
            break;
        }
        
        return $Condition;
    }
    // END function condition rentang waktu
    
    
    
?>