<?php
    // function menu makanan shortcut menu
    function MenuMakananShortcut()
    {
        ?>
            <div class="full_w" style="padding: 10px; margin: 10px;">
                <div style="text-align: center; display: table;" id="div">
                    <div style="display: table-cell; padding-left: 10px;">
                        <form style="margin: 0px;" id="formID2">
                            <b>Jenis Menu</b>
                            <select id="SortingMakanan" name="SortingMakanan" style="width: 180px; margin: 0px 10px 0px 15px;">
                                <option value="0">All</option>
                                <?php 
                                    $sql = "SELECT * FROM tb_jenismakanan ORDER BY JenisMakanan ASC";
                                    $dataJenisMakanan = ReadDataManyRow($sql);
                                    foreach($dataJenisMakanan as $data)
                                    {
                                        ?>
                                            <option value="<?php echo $data["IdJenisMakanan"]; ?>"><?php echo $data["JenisMakanan"]; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            <a href="javascript:void(0);" style="text-decoration: none;" class="btn_green" onclick="ViewMenuMakananTableSorting()"><span>Sorting</span></a>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }
    // END menu makanan shortcut menu
    
    // function view menu makanan
    function ViewMenuMakanan()
    {
        $text = "View Menu Makanan";
        HeaderTitle($text);
        MenuMakananShortcut();
        ?>
            <div id="MenuTable">
                <?php
                    ViewMenuMakananTableInit();
                ?>
            </div>
        <?php
    }
    
    // function init
    function ViewMenuMakananTableInit()
    {
        $sql = "SELECT COUNT(IdMenuMakanan) AS 'NumRow' FROM tb_menumakanan";
        $data = ReadDataOneRow($sql);
        $DataPerPage = 20;
        ?>
            <script>
                // When document has loaded, initialize pagination and form
                    // function get options
                    function GetOptions()
                    {
                         var opt = {callback: PageSelectCallback, items_per_page: <?php echo $DataPerPage; ?>};
                         return opt;
                    }
                    
                    // function page select call back
                    function PageSelectCallback(pageIndex, jq)
                    {
                        var url = "module/content.php?m=menumakanan&a=ViewMenuMakananTable&PageIndex="+pageIndex+"&DataPerPage=<?php echo $DataPerPage; ?>";
                        $("#TableView").hide();
                        $("#TableView").load(url);
                        $("#TableView").fadeIn("fast");
                        return false;
                    }
                    // END function page select callback
                    $(document).ready(function(){
                        // Create pagination element with options from form
                        var optInit = GetOptions();
                        $("#Pagination").pagination(<?php echo $data["NumRow"]; ?>, optInit);
                    });
                    
            </script>
            <div id="TableView"></div>
            <div id="Pagination" class="pagination" style="margin: 10px;">
            </div>
        <?php
    }
    // END function init
    
    // function view makanan table
    function ViewMenuMakananTable()
    {
        include "../../globalfunction/ajax_include.php";
        
        $PageIndex = $_GET["PageIndex"];
        $DataPerPage = $_GET["DataPerPage"];
        $Offset = $DataPerPage * $PageIndex;
        ?>
            <div class="datagrid" style="margin: 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
    				        <th style="width: 180px; text-align: center;">Menu Makanan</th>
    				        <th style="width: 100px; text-align: center;">Harga (Rp.)</th>
                            <th style="width: 100px; text-align: center;">Jenis Menu</th>
                            <th style="width: 60px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT a.IdMenuMakanan, a.MenuMakanan, a.Harga, b.JenisMakanan
                                    	FROM tb_menumakanan a
                                    	LEFT JOIN tb_jenismakanan b ON a.IdJenisMakanan = b.IdJenisMakanan
                                    ORDER BY b.JenisMakanan, a.MenuMakanan LIMIT $Offset, $DataPerPage";
                            $dataMenu = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataMenu as $data)
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data["MenuMakanan"]; ?></td>
                                        <td style="text-align: right;"><?php echo FormatRupiah($data["Harga"]); ?></td>
                                        <td style="text-align: center;"><?php echo $data["JenisMakanan"]; ?></td>
                                        <td style="text-align: center;">
                                            <a href="#" class="table-icon archive" title="Detail Menu Makanan" onclick="DetailMenuMakanan('<?php echo $data["IdMenuMakanan"]; ?>')"></a>
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
    // END function view menu makanan
    
    // function detail menu makanan
    function DetailMenuMakanan()
    {
        include "../../globalfunction/ajax_include.php";
        $IdMenuMakanan = $_GET["IdMenuMakanan"];
        
        $sql = "SELECT a.IdMenuMakanan, a.MenuMakanan, a.Harga, b.JenisMakanan, a.InfoMenu
       	            FROM tb_menumakanan a
                   	LEFT JOIN tb_jenismakanan b ON a.IdJenisMakanan = b.IdJenisMakanan
       	        WHERE a.IdMenuMakanan='$IdMenuMakanan'";
        $data = ReadDataOneRow($sql);
        
        ?>
            <div style="border: 1px solid #C5C5C5; padding: 10px; color: #1B1B1B; font-size: 13px;">
                <table>
                    <tr>
                        <td style="width: 100px;">Menu Makanan</td>
                        <td style="width: 10px;">:</td>
                        <td><?php echo $data["MenuMakanan"]; ?></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><?php echo "Rp. ".FormatRupiah($data["Harga"]); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Menu</td>
                        <td>:</td>
                        <td><?php echo $data["JenisMakanan"]; ?></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Info Menu</td>
                        <td>:</td>
                        <td><?php echo nl2br($data["InfoMenu"]); ?></td>
                    </tr>
                </table>
            </div>
        <?php
    }
    // END function detail menu makanan
    
    // function menu makanan sorting
    function ViewMenuMakananTableSorting()
    {
        include "../../globalfunction/ajax_include.php";
        $IdJenisMakanan = $_GET["IdJenisMakanan"];
        $Condtion = "";
        if(isset($IdJenisMakanan))
        {
            if($IdJenisMakanan=="0")
            {
                $Condtion = "";
            }
            else
            {
                $Condtion = "WHERE a.IdJenisMakanan='$IdJenisMakanan' ";
            }
            
            $sql = "SELECT a.IdMenuMakanan, a.MenuMakanan, a.Harga, b.JenisMakanan
                                    	FROM tb_menumakanan a
                                    	LEFT JOIN tb_jenismakanan b ON a.IdJenisMakanan = b.IdJenisMakanan
                                    	".$Condtion."
                                    ORDER BY b.JenisMakanan, a.MenuMakanan";
            
            ?>
                <div class="datagrid" style="margin: 10px;">
                    <table>
                        <thead>
        				    <tr>
        				        <th style="width: 15px;">No</th>
        				        <th style="width: 150px; text-align: center;">Menu Makanan</th>
        				        <th style="width: 100px; text-align: center;">Harga (Rp.)</th>
                                <th style="width: 100px; text-align: center;">Jenis Menu</th>
                                <th style="width: 60px; text-align: center;">Option</th>
        				    </tr>
        				</thead>
                        <tbody>
                            <?php
                                $dataMenu = ReadDataManyRow($sql);
                                $i = 1;
                                foreach($dataMenu as $data)
                                {
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data["MenuMakanan"]; ?></td>
                                            <td style="text-align: right;"><?php echo FormatRupiah($data["Harga"]); ?></td>
                                            <td style="text-align: center;"><?php echo $data["JenisMakanan"]; ?></td>
                                            <td style="text-align: center;">
                                                <a href="#" class="table-icon archive" title="Detail Menu Makanan" onclick="DetailMenuMakanan('<?php echo $data["IdMenuMakanan"]; ?>')"></a>
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
    }
    // END function menu makanan sorting
?>
