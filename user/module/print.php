<?php
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
                                        <td style="text-align: center; vertical-align: top;"><label class="label_summary"><?php echo "Rp. ".FormatRupiah($dataReservasi["Discount"]); ?></label></td>
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