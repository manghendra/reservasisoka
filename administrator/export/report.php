<?php
    
    // function generate excel
    function GenerateExcel($ArrayData, $DocumentTitle, $FileName, $AdditionalData )
    {
        $data = array();
        $baris = $ArrayData;
        
        $coll = array_keys($baris[0]);
		$newColl = array();
		$newColl[] = "No.";
		$i = 0;
		foreach ($coll as $c){
			if ($i%2 == 1){
				$newColl[] = $coll[$i];
			}
			$i++;
		}
        
        $data[] = array($DocumentTitle);
        
        $data[] = array("");
		
		$data[] = $newColl;
		$dt = array();
		for ($i=0;$i<count($baris);$i++){
			$dt = "";
			$dt[] = ($i+1);
			for ($j=0;$j<count($newColl)-1;$j++){
				$dt[] = $baris[$i][$j];
			}
			$data[] = $dt;
		}
        
        $data[] = array("");
        $data[] = array("");
        for($i=0; $i<count($AdditionalData); $i++)
        {
            $data[] = $AdditionalData[$i];
        }
        
        $xls = new Excel_XML('UTF-8', false, $FileName);
        $xls->addArray($data);
        $xls->generateXML($FileName);
    }
    // END function generate excel
    function LaporanBulanan()
    {
        $AddtionalData = array();
        $BulanTahun = $_GET["BulanTahun"];
        $RentangWaktu = $_GET["RentangWaktu"];
        $TotalPerson = $_GET["TotalPerson"];
        $TotalHargaGross = $_GET["TotalHargaGross"];
        $TotalHargaNet = $_GET["TotalHargaNet"];
        $TotalKendaraan =$_GET["TotalKendaraan"];
        
        $AddtionalData[] = array("Jumlah Peserta : $TotalPerson");
        $AddtionalData[] = array("Total Harga Gross : $TotalHargaGross");
        $AddtionalData[] = array("Total Harga Net : $TotalHargaNet");
        $AddtionalData[] = array("Total Kendaraan : $TotalKendaraan");
        
        $Condition = ConditionRentangWaktu($RentangWaktu);
        $sql = "SELECT DATE_FORMAT(a.TanggalReservasi, '%d-%l-%Y') AS `Tanggal Reservasi`, DATE_FORMAT(a.JamReservasi, '%h:%i') AS `Jam Reservasi`, c.Organizer, d.TipeCustomer AS `Tipe Customer`, 
					e.Kota,
                                    	a.JumlahPeserta AS `Jumlah Peserta`, bb.JumlahItem AS `Jumlah Item`, bb.TotalHarga AS `Total Harga(gross)`,
                                    	a.Discount, bb.TotalHarga-a.Discount AS `Total Harga(net)`,
                                    	a.NoBill AS `No Bill`, b.Nama, b.NoHandphone AS `No Handphone`,
                                    	a.JumlahKendaraan AS `Jumlah Kendaraan`, a.Notes
                                    	FROM tb_reservasi a
                                    	INNER JOIN 
                                    		(SELECT SUM(JumlahItem) AS 'JumlahItem', IdReservasi, SUM(Harga*JumlahItem) AS 'TotalHarga' 
                                    			FROM tb_detailreservasi GROUP BY IdReservasi) bb ON a.IdReservasi = bb.IdReservasi
                                    	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                    	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                    	LEFT JOIN tb_tipecustomer d ON c.IdTipeCustomer = d.IdTipeCustomer
                                    	LEFT JOIN tb_kota e ON c.IdKota = e.IdKota
                                    WHERE a.TanggalReservasi LIKE '$BulanTahun%' AND a.IdStatusReservasi = '4'".$Condition."ORDER BY a.TanggalReservasi";
        
        
        
        $data = ReadDataManyRow($sql);
        
        $DocumentTitle = "Data Kunjungan Tamu Restaurant Soka Indah ".KonversiTanggal("M Y", $BulanTahun);
        $FileName = 'Data Kunjungan Tamu '.$BulanTahun;
        
        GenerateExcel($data, $DocumentTitle, $FileName, $AddtionalData);
    }
    
    // function report bulanan range
    function LaporanBulananRange()
    {
        $AddtionalData = array();
        $StartDate = $_GET["StartDate"];
        $EndDate = $_GET["EndDate"];
        
        $RentangWaktu = $_GET["RentangWaktu"];
        $TotalPerson = $_GET["TotalPerson"];
        $TotalHargaGross = $_GET["TotalHargaGross"];
        $TotalHargaNet = $_GET["TotalHargaNet"];
        $TotalKendaraan =$_GET["TotalKendaraan"];
        
        $AddtionalData[] = array("Jumlah Peserta : $TotalPerson");
        $AddtionalData[] = array("Total Harga Gross : $TotalHargaGross");
        $AddtionalData[] = array("Total Harga Net : $TotalHargaNet");
        $AddtionalData[] = array("Total Kendaraan : $TotalKendaraan");
        
        $Condition = ConditionRentangWaktu($RentangWaktu);
        $sql = "SELECT DATE_FORMAT(a.TanggalReservasi, '%d-%l-%Y') AS `Tanggal Reservasi`, DATE_FORMAT(a.JamReservasi, '%h:%i') AS `Jam Reservasi`, c.Organizer, d.TipeCustomer AS `Tipe Customer`, 
					e.Kota,
                                    	a.JumlahPeserta AS `Jumlah Peserta`, bb.JumlahItem AS `Jumlah Item`, bb.TotalHarga AS `Total Harga(gross)`,
                                    	a.Discount, bb.TotalHarga-a.Discount AS `Total Harga(net)`,
                                    	a.NoBill AS `No Bill`, b.Nama, b.NoHandphone AS `No Handphone`,
                                    	a.JumlahKendaraan AS `Jumlah Kendaraan`, a.Notes
                                    	FROM tb_reservasi a
                                    	INNER JOIN 
                                    		(SELECT SUM(JumlahItem) AS 'JumlahItem', IdReservasi, SUM(Harga*JumlahItem) AS 'TotalHarga' 
                                    			FROM tb_detailreservasi GROUP BY IdReservasi) bb ON a.IdReservasi = bb.IdReservasi
                                    	LEFT JOIN tb_person b ON a.IdPerson = b.IdPerson
                                    	LEFT JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                                    	LEFT JOIN tb_tipecustomer d ON c.IdTipeCustomer = d.IdTipeCustomer
                                    	LEFT JOIN tb_kota e ON c.IdKota = e.IdKota
                                    WHERE a.TanggalReservasi BETWEEN '$StartDate%' AND '$EndDate' AND a.IdStatusReservasi = '4'".$Condition."ORDER BY a.TanggalReservasi";
     
        $data = ReadDataManyRow($sql);
        
        $DocumentTitle = "Data Kunjungan Tamu Restaurant Soka Indah ".KonversiTanggal("d M Y", $StartDate). " sampai ".KonversiTanggal("d M Y", $EndDate);
        $FileName = 'Data Kunjungan Tamu '.$StartDate." sampai ".$EndDate;
        
        GenerateExcel($data, $DocumentTitle, $FileName, $AddtionalData);
        
    }
    // END function report bulanan range
    
    // function laporan top 10 kunjungan
    function TopTenKunjungan()
    {
        $AddtionalData = array("");
        
        $BulanTahun = $_GET["BulanTahun"];
        $sql = "SELECT c.Organizer AS `Organizer/Travel`, d.Kota AS `Kota Asal`, COUNT(c.IdOrganizer) AS `Jumlah Kunjungan`, c.Telepon, 
                    c.Owner, c.KontakOwner AS `Kontak Owner`
       	            FROM tb_reservasi a
       	        INNER JOIN tb_person b ON a.IdPerson = b.IdPerson
               	INNER JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
               	INNER JOIN tb_kota d ON c.IdKota = d.IdKota
                WHERE a.TanggalReservasi LIKE '$BulanTahun%' AND a.IdStatusReservasi = '4'
                GROUP BY c.IdOrganizer ORDER BY `Jumlah Kunjungan` DESC LIMIT 10";
        
        $data = ReadDataManyRow($sql);
        $DocumentTitle = "TOP 10 Organizer : Kunjungan Terbanyak ( ".KonversiTanggal("M Y", $BulanTahun)." )";
        $FileName = 'TOP10Kunjungan_Organizer'.$BulanTahun;
        
        // generate excel
        GenerateExcel($data, $DocumentTitle, $FileName, $AddtionalData);
    }
    // END function top 10 kunjungan
    
    
    // function laporan top 10 omzet
    function TopTenOmzet()
    {
        $AddtionalData = array("");
        
        $BulanTahun = $_GET["BulanTahun"];
        
        $sql = "SELECT c.Organizer AS `Organizer/Travel`, d.Kota AS `Kota Asal`, SUM(aa.TotalOmzet-a.Discount) AS `Total Omzet`, 
                        c.Telepon, c.Owner, c.KontakOwner AS `Kontak Owner`
       	        FROM tb_reservasi a 
               	    INNER JOIN 
                  		(SELECT IdReservasi, SUM(JumlahItem*Harga) AS 'TotalOmzet' FROM tb_detailreservasi
                 			GROUP BY IdReservasi) aa ON a.IdReservasi = aa.IdReservasi
                   	INNER JOIN tb_person b ON a.IdPerson = b.IdPerson
                   	INNER JOIN tb_organizer c ON b.IdOrganizer = c.IdOrganizer
                   	LEFT JOIN tb_kota d ON c.IdKota = d.IdKota
                WHERE a.TanggalReservasi LIKE '$BulanTahun%' AND a.IdStatusReservasi = '4'
                GROUP BY c.IdOrganizer ORDER BY `Total Omzet` DESC";
        
        $data = ReadDataManyRow($sql);
        $DocumentTitle = "TOP 10 Organizer : Total Omzet Terbanyak ( ".KonversiTanggal("M Y", $BulanTahun)." )";
        $FileName = 'TOP10Omzet_Organizer'.$BulanTahun;
        
        // generate excel
        GenerateExcel($data, $DocumentTitle, $FileName, $AddtionalData);
    }
    // END function laporan top 10 omzet
    
    
    // function export menu makanan
    function ExportMenuMakanan()
    {
        $AddtionalData = array("");
        
        $sql = "SELECT a.MenuMakanan AS `Menu Makanan`, a.Harga, b.JenisMakanan AS `Jenis Menu`, a.InfoMenu AS `Info Menu`
       	            FROM tb_menumakanan a
                   	LEFT JOIN tb_jenismakanan b ON a.IdJenisMakanan = b.IdJenisMakanan
                ORDER BY b.JenisMakanan, a.MenuMakanan";
        $data = ReadDataManyRow($sql);
        $DocumentTitle = "Data Menu Makanan Soka Indah Restaurant";
        $FileName = "Data Menu Makanan";
        
        // generate excel
        GenerateExcel($data, $DocumentTitle, $FileName, $AddtionalData);
    }
    // END function export menu makanan
    
    // function export organizer
    function ExportOrganizer()
    {
        $AddtionalData = array("");
        
        $sql = "SELECT a.Organizer AS `Organizer/Travel`, b.Kota AS `Kota Asal`, c.TipeCustomer AS `Tipe Customer`, 
	a.Email, a.Telepon, a.Alamat
                	FROM tb_organizer a
                	INNER JOIN tb_kota b ON a.IdKota=b.IdKota
                	INNER JOIN tb_tipecustomer c ON a.IdTipeCustomer = c.IdTipeCustomer
                ORDER BY a.Organizer ASC";
        
        $data = ReadDataManyRow($sql);
        $DocumentTitle = "Data Organizer/Travel Agent Soka Indah Restaurant";
        $FileName = "DataOrganizer";
        
        // generate excel
        GenerateExcel($data, $DocumentTitle, $FileName, $AddtionalData);
    }
    // END function export organizer
    
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