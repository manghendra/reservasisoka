<?php
    
    // function print organizer to 10 kunjungan
    function PrintTopTenOrganizerOmzet()
    {
        $BulanTahun = $_GET["BulanTahun"];
        HeaderTitle("Print Top 10 Organizer/Travel Omzet Terbanyak");
        ?>
            <script>
                function PrintTopTenOrganizerOmzet()
                {
                    $("#print_report").printThis({
                        importCSS: true,
                        pageTitle: "Top 10 Organizer Omzet",
                    });
                }
            </script>
            <div class="print_wrap">
            <div style="margin-bottom: 5px; text-align: right;">
                <a href="javascript:void(0)" onclick="PrintTopTenOrganizerOmzet()"><img src="../images/printer.png" /></a>
            </div>
            <div class="print_area" style="min-height: 300px;">
                <div id="print_report">
                    <?php 
                        include "module/styleprint.php";
                    ?>
                    <div class="area">
                    <h1>SOKA INDAH RESTAURANT</h1>
                    <h2>TOP 10 ORGANIZER/TRAVEL OMZET TERBANYAK</h2>
                    <h3>Bulan : <b><?php echo KonversiTanggal("M Y", $BulanTahun)?></b></h3>
                    <hr style="margin-top: 10px;" />
                    <div style="margin-top: 30px;">
                        <table class="new_grid">
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
            </div>
        <?php
    }
    
    // END function print organizer top 10 omzet
    
    // funciton print organizer top 10 kunjungan
    function PrintTopTenOrganizerKunjungan()
    {
        $BulanTahun = $_GET["BulanTahun"];
        HeaderTitle("Print Top 10 Organizer/Travel Kunjungan Terbanyak");
        ?>
            <script>
                function PrintTopTenOrganizerKunjungan()
                {
                    $("#print_report").printThis({
                        importCSS: true,
                        pageTitle: "Top 10 Organizer Kunjungan",
                    });
                }
            </script>
            <div class="print_wrap">
            <div style="margin-bottom: 5px; text-align: right;">
                <a href="javascript:void(0)" onclick="PrintTopTenOrganizerKunjungan()"><img src="../images/printer.png" /></a>
            </div>
            <div class="print_area" style="min-height: 300px;">
                <div id="print_report">
                    <?php 
                        include "module/styleprint.php";
                    ?>
                    <div class="area">
                    <h1>SOKA INDAH RESTAURANT</h1>
                    <h2>TOP 10 ORGANIZER/TRAVEL KUNJUNGAN TERBANYAK</h2>
                    <h3>Bulan : <b><?php echo KonversiTanggal("M Y", $BulanTahun)?></b></h3>
                    <hr style="margin-top: 10px;" />
                    <div style="margin-top: 30px;">
                        <table class="new_grid">
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
            </div>
            </div>
        <?php
    }
    // END funciton print organizer top 10 kunjungan
    
    // function print laporan bulanan
    function PrintLaporanBulanan()
    {
        $BulanTahun = $_GET["BulanTahun"];
        $RentangWaktu = $_GET["RentangWaktu"];
        $Condition = ConditionRentangWaktu($RentangWaktu);
        
        HeaderTitle("Print Laporan Bulanan");
        ?>
            <script>
                function PrintLaporanBulanan()
                {
                    $("#print_report").printThis({
                        importCSS: true,
                        pageTitle: "Laporan Bulanan",
                    });
                }
            </script>
            <div class="print_wrap" style="width: 1040px;">
            <div style="margin-bottom: 5px; text-align: right;">
                <a href="javascript:void(0)" onclick="PrintLaporanBulanan()"><img src="../images/printer.png" /></a>
            </div>
            <div class="print_area" style="min-height: 300px;">
                <div id="print_report">
                    <?php 
                        include "module/styleprint.php";
                    ?>
                    <div class="area">
                        <h1>SOKA INDAH RESTAURANT</h1>
                        <h2>LAPORAN KUNJUNGAN TAMU</h2>
                        <h3>Bulan : <b><?php echo KonversiTanggal("M Y", $BulanTahun)?></b></h3>
                        <hr style="margin-top: 10px;" />
                        <div style="margin-top: 30px;">
                            <table class="new_grid">
                                <thead>
                				    <tr>
                				        <th style="width: 15px;">No</th>
                				        <th style="width: 70px; text-align: center;">Tanggal</th>
                                        <th style="width: 50px; text-align: center;">Waktu</th>
                                        <th style="width: 90px; text-align: center;">Organizer</th>
                                        <th style="width: 60px; text-align: center;">Tipe Cust.</th>
                                        <th style="width: 40px; text-align: center;">Peserta</th>
                                        <th style="width: 80px; text-align: center;">Total (gross)</th>
                                        <th style="width: 80px; text-align: center;">Discount</th>
                                        <th style="width: 80px; text-align: center;">Total (net)</th>
                                        <th style="width: 50px; text-align: center;">No. Bill</th>
                                        <th style="width: 85px; text-align: center;">Person</th>
                                        <th style="width: 60px; text-align: center;">No. Hp</th>
                                        <th style="width: 30px; text-align: center;">Bus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT a.TanggalReservasi, a.JamReservasi, c.Organizer, d.TipeCustomer, e.Kota,
                                                	a.JumlahPeserta, bb.TotalHarga, a.NoBill, b.Nama, b.NoHandphone,
                                                	a.JumlahKendaraan, a.Discount,
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
                                                        <td class="align_top" style="text-align: center;"><?php echo RentangWaktu( date('H:i', strtotime( $data["JamReservasi"]) ) ); ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["TipeCustomer"]; ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["JumlahPeserta"]; ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["TotalHarga"]); ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["Discount"]); ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["HargaNet"]); ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo $data["NoBill"]; ?></td>
                                                        <td class="align_top"><?php echo $data["Nama"]; ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo $data["NoHandphone"]; ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["JumlahKendaraan"]; ?></td>
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
                                                    <td colspan="5" style="text-align: center;"><label class="label_summary">TOTAL</label></td>
                                                    <td class="align_top" style="text-align: center;"><label class="label_summary"><?php echo $TotalPerson; ?></label></td>
                                                    <td class="align_top" style="text-align: right;"><label class="label_summary"><?php echo "Rp. ".FormatRupiah($TotalHargaGross); ?></label></td>
                                                    <td class="align_top" style="text-align: right;"></td>
                                                    <td class="align_top" style="text-align: right;"><label class="label_summary"><?php echo "Rp. ".FormatRupiah($TotalHargaNet); ?></label></td>
                                                    <td colspan="3"></td>
                                                    <td class="align_top" style="text-align: center;"><label class="label_summary"><?php echo $TotalKendaraan; ?></label></td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php
    }
    // END function print laporan bulanan
    
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
    
    // function print laporan by rang
    function PrintLaporanBulananRange()
    {
        HeaderTitle("Print Laporan Bulanan");
        $StartDate = $_GET["StartDate"];
        $EndDate = $_GET["EndDate"];
        
        $RentangWaktu = $_GET["RentangWaktu"];
        
        $Condition = ConditionRentangWaktu($RentangWaktu);
        ?>
            <script>
                function PrintLaporanBulananRange()
                {
                    $("#print_report").printThis({
                        importCSS: true,
                        pageTitle: "Laporan Bulanan",
                    });
                }
            </script>
            <div class="print_wrap" style="width: 1040px;">
            <div style="margin-bottom: 5px; text-align: right;">
                <a href="javascript:void(0)" onclick="PrintLaporanBulananRange()"><img src="../images/printer.png" /></a>
            </div>
            <div class="print_area" style="min-height: 300px;">
                <div id="print_report">
                    <?php 
                        include "module/styleprint.php";
                    ?>
                    <div class="area">
                        <h1>SOKA INDAH RESTAURANT</h1>
                        <h2>LAPORAN KUNJUNGAN TAMU</h2>
                        <h3><b><?php echo KonversiTanggal("d M Y", $StartDate)?></b> sampai <b><?php echo KonversiTanggal("d M Y", $EndDate)?></b></h3>
                        <hr style="margin-top: 10px;" />
                        <div style="margin-top: 30px;">
                            <table class="new_grid">
                                <thead>
                				    <tr>
                				        <th style="width: 15px;">No</th>
                				        <th style="width: 70px; text-align: center;">Tanggal</th>
                                        <th style="width: 50px; text-align: center;">Waktu</th>
                                        <th style="width: 90px; text-align: center;">Organizer</th>
                                        <th style="width: 60px; text-align: center;">Tipe Cust.</th>
                                        <th style="width: 40px; text-align: center;">Peserta</th>
                                        <th style="width: 80px; text-align: center;">Total (gross)</th>
                                        <th style="width: 80px; text-align: center;">Discount</th>
                                        <th style="width: 80px; text-align: center;">Total (net)</th>
                                        <th style="width: 50px; text-align: center;">No. Bill</th>
                                        <th style="width: 85px; text-align: center;">Person</th>
                                        <th style="width: 60px; text-align: center;">No. Hp</th>
                                        <th style="width: 30px; text-align: center;">Bus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT a.TanggalReservasi, a.JamReservasi, c.Organizer, d.TipeCustomer, e.Kota,
                                                	a.JumlahPeserta, bb.TotalHarga, a.NoBill, b.Nama, b.NoHandphone,
                                                	a.JumlahKendaraan, a.Discount,
                                                    bb.TotalHarga-a.Discount 'HargaNet'
                                                	FROM tb_reservasi a
                                                	INNER JOIN 
                                                		(SELECT IdReservasi, SUM(Harga*JumlahItem) AS 'TotalHarga' 
                                                			FROM tb_detailreservasi GROUP BY IdReservasi) bb ON a.IdReservasi = bb.IdReservasi
                                                	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                                	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                                	LEFT JOIN tb_tipecustomer d ON c.IdTipeCustomer = d.IdTipeCustomer
                                                	LEFT JOIN tb_kota e ON c.IdKota = e.IdKota
                                                WHERE a.TanggalReservasi BETWEEN '$StartDate%' AND '$EndDate' AND a.IdStatusReservasi = '4' ".$Condition." ORDER BY a.TanggalReservasi, a.JamReservasi";
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
                                                        <td class="align_top" style="text-align: center;"><?php echo RentangWaktu( date('H:i', strtotime( $data["JamReservasi"]) ) ); ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["Organizer"]; ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["TipeCustomer"]; ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["JumlahPeserta"]; ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["TotalHarga"]); ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["Discount"]); ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo "Rp. ".FormatRupiah($data["HargaNet"]); ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo $data["NoBill"]; ?></td>
                                                        <td class="align_top"><?php echo $data["Nama"]; ?></td>
                                                        <td class="align_top" style="text-align: right;"><?php echo $data["NoHandphone"]; ?></td>
                                                        <td class="align_top" style="text-align: center;"><?php echo $data["JumlahKendaraan"]; ?></td>
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
                                                    <td colspan="5" style="text-align: center;"><label class="label_summary">TOTAL</label></td>
                                                    <td class="align_top" style="text-align: center;"><label class="label_summary"><?php echo $TotalPerson; ?></label></td>
                                                    <td class="align_top" style="text-align: right;"><label class="label_summary"><?php echo "Rp. ".FormatRupiah($TotalHargaGross); ?></label></td>
                                                    <td class="align_top" style="text-align: right;"></td>
                                                    <td class="align_top" style="text-align: right;"><label class="label_summary"><?php echo "Rp. ".FormatRupiah($TotalHargaNet); ?></label></td>
                                                    <td colspan="3"></td>
                                                    <td class="align_top" style="text-align: center;"><label class="label_summary"><?php echo $TotalKendaraan; ?></label></td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php
    }
    // function
    
    // function print detail reservasi
    function PrintDetailReservasi()
    {
        $IdReservasi = $_GET["IdReservasi"];
        HeaderTitle("Print Detail Reservasi");
        ?>
            <script>
                function PrintDetailReservasi()
                {
                    $("#print_report").printThis({
                        importCSS: true,
                        pageTitle: "Top 10 Organizer Kunjungan",
                    });
                }
            </script>
            <div class="print_wrap">
            <div style="margin-bottom: 5px; text-align: right;">
                <a href="javascript:void(0)" onclick="PrintDetailReservasi()"><img src="../images/printer.png" /></a>
            </div>
            <div class="print_area" style="min-height: 300px;">
                <div id="print_report">
                    <?php 
                        include "module/styleprint.php";
                    ?>
                     <div class="area" style="overflow: hidden;">
                        <h1>SOKA INDAH RESTAURANT</h1>
                        <h2>DETAIL RESERVASI</h2>
                        <hr style="margin-top: 10px;" />
                        <div style="margin-top: 30px; border: 1px solid black; padding: 10px;">
                            <?php
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
                            <table class="tb_view">
                                <tr>
                                    <td style="width: 120px;">Organizer/Travel</td>
                                    <td style="width: 10px;">:</td>
                                    <td style="font-weight: bold; width: 250px;"><?php echo $dataReservasi["Organizer"]; ?></td>
                                    <!-- side row -->
                                    <td style="width: 120px;" >Jumlah Peserta</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo $dataReservasi["JumlahPeserta"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Tipe Customer</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo $dataReservasi["TipeCustomer"]; ?></td>
                                   <!-- side row -->
                                   <td>Jumlah Kendaraan</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo $dataReservasi["JumlahKendaraan"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Person</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo $dataReservasi["Nama"]; ?></td>
                                    <!-- side row -->
                                    <td>Status Reservasi</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><label class=""><?php echo $dataReservasi["StatusReservasi"]; ?></label></td>
                                </tr>
                                <tr>
                                    <td>No. Handphone</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo $dataReservasi["NoHandphone"]; ?></td>
                                    <!-- side row -->
                                    <td>No Bill</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><label><?php echo $dataReservasi["NoBill"]; ?></label></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Reservasi</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo KonversiTanggal("l, d M Y", $dataReservasi["TanggalReservasi"]) ?></td>
                                    <td>Notes</td>
                                    <td>:</td>
                                    <td><label><?php echo nl2br($dataReservasi["Notes"]); ?></label></td>
                                </tr>
                                <tr>
                                    <td>Jam</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo date('H:i', strtotime($dataReservasi["JamReservasi"])); ?></td>
                                    <!-- side row -->
                                    <td>Diinputkan Oleh</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo $dataReservasi["NamaLengkap"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td>:</td>
                                    <td style="font-weight: bold;"><?php echo RentangWaktu( date( 'H:i', strtotime($dataReservasi["JamReservasi"]) ) ); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div style="margin-top: 10px;">
                            <table class="new_grid">
                                <thead>
                                    <th style="width: 25px;">No</th>
                                    <th style="text-align:center; width: 200px;">Menu Makanan</th>
                                    <th style="text-align:center; width: 100px;">Harga (Rp.)</th>
                                    <th style="text-align:center; width: 80px;">Jml. Item</th>
                                    <th style="text-align:center; width: 100px;">Sub Total (Rp.)</th>
                                    <th style="text-align:center; width: 200px;">Notes</th>
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
                                    $TotalDisount = $dataReservasi["Discount"];
                                    $TotalHargaDiscount = $TotalHarga-$TotalDisount;
                                ?>
                            </tbody>
                            </table>
                        </div>
                        <div style="width: 400px; margin-top: 10px; float: right;">
                            <table class="new_grid">
                                <thead>
                                    <tr>
                                         <th style="width: 70px; text-align: center;">Total Item</th>
                                        <th style="width: 110px; text-align: center;">Total (gross)</th>
                                        <th style="width: 110px; text-align: center;">Discount</th>
                                        <th style="width: 110px; text-align: center;">Total (net)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="text-align: center; vertical-align: top;"><label class="label_summary"><?php echo $TotalItem; ?></label></td>
                                        <td style="text-align: right; vertical-align: top;"><label class="label_summary"><?php echo "Rp. ".FormatRupiah($TotalHarga); ?></label></td>
                                        <td style="text-align: center; vertical-align: top;"><label class="label_summary"><?php echo "Rp. ".FormatRupiah($TotalDisount); ?></label></td>
                                        <td style="text-align: right; vertical-align: top;">
                                            <label class="label_summary">
                                            <?php echo FormatRupiah($TotalHarga)."</br>"; ?>
                                            <?php echo FormatRupiah($TotalDisount)."</br>-"; ?>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: center;"><label class="label_summary">TOTAL</label></td>
                                        <td style="text-align: right;">
                                            <label class="label_summary"><?php echo "Rp. ".FormatRupiah($TotalHargaDiscount); ?></label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                     <div class="area">
                </div>
            </div>
            </div>
        <?php
    }
    // END function print detail reservasi
?>