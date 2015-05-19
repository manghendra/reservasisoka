<?php
	function Home()
    {
        $text = "Home";
        HeaderTitle($text);
        ?>
            <div style="padding: 20px 10px 20px 10px;">
                <div class="full_w">
                    <div class="n_ok" style="height: 100px;">
                        <p>Selamat Datang Administrator</p>
                    </div>	
                </div>
            </div>
        <?php
    }
    
    function ErrorPage()
    {
        $text = "Error Page";
        ?>
            <div style="padding: 20px 10px 20px 10px;">
                <div class="full_w">
                    <div class="n_error" style="height: 100px;">
                        <p>Maaf Terjadi Kesalahan</p>
                    </div>	
                </div>
            </div>
        <?php
    }
    
    function QuickMenu()
    {
        ?>
            <div class="full_w" style="margin-bottom: 10px;">
                <table>
                    <tr>
                        <td style="width: 400px;">
                            <ul class="shortcut" style="width: 100%; margin-bottom: 5px; padding: 0; text-align: center;">
                                <li> <a href="?m=home" title="Home" class="tipN"> <img src="../images/quickmenu/home.png" alt=""/><strong>Home</strong> </a> </li>
                                <li> <a href="?m=user" title="User" class="tipN"> <img src="../images/quickmenu/user.png" alt=""/><strong>User</strong> </a> </li>
                                <li> <a href="?m=menumakanan" title="Menu Makanan" class="tipN"> <img src="../images/quickmenu/menumakanan.png" alt=""/><strong>Menu</strong> </a> </li>
                                <li> <a href="?m=report&page=trans" title="Laporan" class="tipN"> <img src="../images/quickmenu/report.png" alt=""/><strong>Laporan</strong> </a> </li>
                            </ul>
                        </td>
                        <td style="width: 380px; text-align: right;">
                            <div style="margin: 3px 3px 3px 6px;">
                                <img src="../images/sokaindah_shorcut.png" alt=""/>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
    }
?>