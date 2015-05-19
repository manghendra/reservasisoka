<?php
	// funtion untuk membaca data satu row
    function ReadDataOneRow($sql)
    {
        $cnn = new koneksi();
        $cnn->select($sql);
        if ($cnn->status=='1')
        {
            $data = $cnn->baris[0];
            return $data;
        }
        else
        {
            return false;
        }
    }
    
    //  fuction untuk membaca data multi row
    function ReadDataManyRow($sql)
    {
        $cnn = new koneksi();
        $cnn->select($sql);
        if ($cnn->status=='1')
        {
            $data = $cnn->baris;
            return $data;
        }
        else
        {
            return false;
        }
    }
    
    // function untuk mengeksekusi query
    function ExecuteQuery($sql)
    {
        $status = false;
        $cnn = new koneksi();
        $cnn->exec_query($sql);
        if ($cnn->status=="1")
        {
            $status=true;
        }
        return $status;
    }
    
    // function execute javascript
    function exec_js($js)
    {
        echo "
        <script type='text/javascript'>";
		echo $js;
    	echo "
    	</script>";
    }
    // END function execute javascript
    
    function FormatRupiah($angka)
    {
        return number_format($angka,0,'','.');
    }
    
    // function untuk header title
    function HeaderTitle($text)
    {
        ?>
            <div class="h_title"><?php echo $text; ?></div>
        <?php
    }
    // END function untuk header title
    
    
    // function konveri tanggal
    function KonversiTanggal($format,$nilai="now"){
        $en=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Jan","Feb",
        "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        
        $id=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
        "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September",
        "Oktober","November","Desember");
        
        return str_replace($en,$id,date($format,strtotime($nilai)));
    }
        // END function konversi tanggal
        
    // function get status class
    function GetStatusClass($IdStatusReservasi)
    {
        $class = "";
        switch($IdStatusReservasi)
        {
            case "1"    :
                $class = "waiting";
            break;
            
            case "2"    :
                $class = "confirmed";
            break;
            
            case "3"    :
                $class = "canceled";
            break;
            
            case "4"    : 
                $class = "closed";
            break;
            
        }
        
        return $class;
    }
    // END function get status class
    
    // function rentang waktu
    function RentangWaktu($Jam)
    {
        $Waktu = "";
        $StartPagi = "06:00";
        $StartSiang = "10:00";
        $StartSore = "14:00";
        $StartMalam = "18:00";
        
        if($Jam>=$StartPagi & $Jam<=$StartSiang)
        {
            $Waktu = "Pagi";
        }
        else if ($Jam>$StartSiang & $Jam<=$StartSore)
        {
            $Waktu = "Siang";
        }
        else if ($Jam>$StartSore & $Jam<=$StartMalam)
        {
            $Waktu = "Sore";
        }
        else if ($Jam>$StartMalam)
        {
            $Waktu = "Malam";
        }
        
        return $Waktu;
    }
    // END function rentang waktu
    
  ?>