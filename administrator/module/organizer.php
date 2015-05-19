<?php
    // function organizer shortcut menu
    function OrganizerShortcutMenu()
    {
        ?>
            <script>
                function SearchOrganizer()
                {
                    var KeyWord = $("#KeyWord").val();
                    
                    if(KeyWord!="")
                    {
                        url = "module/content.php?m=organizer&a=SearchOrganizer&KeyWord="+KeyWord;
                        $("#OrganizerTable").hide();
                        $("#OrganizerTable").load(url);
                        $("#OrganizerTable").fadeIn("slow");
                    }
                    else
                    {
                        new Messi('Keyword harus diisi!', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Close', val: 'X', class: 'btn-danger'}]});
                        return false;
                    }
                }
            </script>
            <div class="full_w" style="padding: 10px; margin: 10px;">
                <div style="text-align: center; display: table;" id="div">
                    <div id="div" style="display: table-cell;">
                        <button class="export_excel" onclick="ExportOrganizer()">Export Excel</button>
                    </div>
                     <div style="display: table-cell; padding-left: 300px;">
                        <form style="margin: 0px; display: table;" id="formID2">
                            <b style="font-size: 14;">Search</b>
                            <input type="text" name="KeyWord" id="KeyWord" class="text validate[required]" style="width: 150px; margin-left: 15px; margin-right: 10px;" />
                            <a style="text-decoration: none;" class="btn_green" onclick="SearchOrganizer()"><span>Search</span></a>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }
    // END function organizer shortcut menu
    
    // function view organizer
    function ViewOrganizer()
    {
        // header title
        $text = "View Organizer/Travel";
        HeaderTitle($text);
        
        // shortcut menu
        OrganizerShortcutMenu();
        
        // table
        ?>
        <div id="OrganizerTable">
            <?php
                ViewOrganizerTableInit();
            ?>
        </div>
        <?php
    }
    // END function view organizer
    
    // function ViewOrganizerTable Init
    function ViewOrganizerTableInit()
    {
        $sql = "SELECT COUNT(IdOrganizer) AS 'NumberRow' FROM tb_organizer";
        $data = ReadDataOneRow($sql);
        ?>
             <script>
                // When document has loaded, initialize pagination and form
                    // function get options
                    function GetOptions()
                    {
                         var opt = {callback: PageSelectCallback, items_per_page: 20};
                         return opt;
                    }
                    
                    // function page select call back
                    function PageSelectCallback(pageIndex, jq)
                    {
                        var url = "module/content.php?m=organizer&a=ViewOrganizerTablePage&PageIndex="+pageIndex;
                        $("#TableView").hide();
                        $("#TableView").load(url);
                        $("#TableView").fadeIn("fast");
                        return false;
                    }
                    // END function page select callback
                    $(document).ready(function(){
                        // Create pagination element with options from form
                        var optInit = GetOptions();
                        $("#Pagination").pagination(<?php echo $data["NumberRow"]; ?>, optInit);
                    });
                    
            </script>
            <div id="TableView"></div>
            <div id="Pagination" class="pagination" style="margin: 10px;">
            </div>
        <?php
    }
    // END funciton ViewOrganizerTable Init
    
    // function view organizer table
    function ViewOrganizerTablePage()
    {
        include "../../globalfunction/ajax_include.php";
        
        $PageIndex = $_GET["PageIndex"];
        $DataPerPage = 20;
        $Offset = $DataPerPage * $PageIndex;
        $sql = "SELECT a.IdOrganizer, a.Organizer, b.Kota, c.TipeCustomer, a.Email, a.Telepon
                	FROM tb_organizer a
                	INNER JOIN tb_kota b ON a.IdKota=b.IdKota
                	INNER JOIN tb_tipecustomer c ON a.IdTipeCustomer = c.IdTipeCustomer
                ORDER BY a.Organizer ASC LIMIT $Offset, $DataPerPage";
        ?>
            <div class="datagrid" style="margin: 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 20px;">No</th>
    				        <th style="width: 150px; text-align: center;">Organizer/Travel</th>
    				        <th style="width: 80px; text-align: center;">Tipe Customer</th>
                            <th style="width: 80px; text-align: center;">No. Telp</th>
                            <th style="width: 80px; text-align: center;">Email</th>
                            <th style="width: 90px; text-align: center;">Kota</th>
                            <th style="width: 70px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                          $dataOrganizer = ReadDataManyRow($sql);
                          
                          $i = 1;
                          foreach($dataOrganizer as $data)
                          {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data["Organizer"]; ?></td>
                                    <td><?php echo $data["TipeCustomer"]; ?></td>
                                    <td><?php echo $data["Telepon"]; ?></td>
                                    <td><?php echo $data["Email"]; ?></td>
                                    <td><?php echo $data["Kota"]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="?m=organizer&a=DetailOrganizer&IdOrganizer=<?php echo $data['IdOrganizer'];?>" class="table-icon archive" title="Detail"></a>
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
    // END function view organizer table
    
    // function detail organizer
    function DetailOrganizer()
    {
        // header title
        HeaderTitle("Detail Organizer");
        $IdOrganizer = $_GET["IdOrganizer"];
        $sql = "SELECT a.IdOrganizer, a.Organizer, b.Kota, c.TipeCustomer, a.Email, a.Telepon, a.Alamat
                	FROM tb_organizer a
                	INNER JOIN tb_kota b ON a.IdKota=b.IdKota
                	INNER JOIN tb_tipecustomer c ON a.IdTipeCustomer = c.IdTipeCustomer
                WHERE IdOrganizer='$IdOrganizer'";
                
        $dataOrganizer = ReadDataOneRow($sql);
        ?>
            <div class="full_w" style="margin: 5px; padding: 5px;">
                <div style="text-align: center;">
                    <h2 style="color: #400000; margin: 0px;">DETAIL ORGANIZER/TRAVEL</h2>
                    <div class="sep"></div>
                </div>
                <div class="full_w detailreservasi" style="padding: 5px;">
                    <table class="tbclear">
                        <tr>
                            <td style="width: 120px;">Organizer/Travel</td>
                            <td style="width: 10px;">:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["Organizer"]; ?></td>
                        </tr>
                        <tr>
                            <td>Tipe Customer</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["TipeCustomer"]; ?></td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["Telepon"]; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["Email"]; ?></td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["Kota"]; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["Alamat"]; ?></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <label class="closed" style="font-size: 12px; font-weight: bold;">Person</label>
                    <div class="datagrid">
                        <table>
                            <thead>
            				    <tr>
            				        <th style="width: 15px;">No</th>
            				        <th style="width: 130px; text-align: center;">Nama</th>
                                    <th style="width: 80px; text-align: center;">Jen. Kelamin</th>
                                    <th style="width: 90px; text-align: center;">Email</th>
                                    <th style="width: 80px; text-align: center;">No. Hanphone</th>
                                    <th style="width: 130px; text-align: center;">Alamat</th>
            				    </tr>
            				</thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM tb_person WHERE IdOrganizer='$IdOrganizer' ORDER BY Nama ASC";
                                    $dataPerson = ReadDataManyRow($sql);
                                    $i=1;
                                    foreach($dataPerson as $data)
                                    {
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $data["Nama"]; ?></td>
                                                <td style="text-align: center;"><?php echo $data["JenisKelamin"]; ?></td>
                                                <td style="text-align: center;"><?php echo $data["Email"]; ?></td>
                                                <td style="text-align: right;"><?php echo $data["NoHandphone"]; ?></td>
                                                <td><?php echo $data["Alamat"]; ?></td>
                                            </tr>
                                        <?php
                                        $i++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="full_w" style="padding: 10px; text-align: right; margin: 10px 0px 10px 0px;">
                    <a href="?m=organizer" class="btn_black" style="text-decoration: none;"><span>Back</span></a>
                </div>
            </div>
        <?php
    }
    // END function detail organizer
    
    // function view organizer table search
    function SearchOrganizer()
    {
        include "../../globalfunction/ajax_include.php";
        $Keyword = $_GET["KeyWord"];
        ?>
            <div style="text-align: center; font-size: 12px; color: #171717;">
                <a href="?m=organizer" title="Kembali"><img src="../images/arrowicon.png" /></a><br />
                Hasil pencarian keyword : <b><?php echo $Keyword; ?></b>
            </div>
            <div class="sep"></div>
            <div class="datagrid" style="margin: 0px 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 20px;">No</th>
    				        <th style="width: 150px; text-align: center;">Organizer/Travel</th>
    				        <th style="width: 80px; text-align: center;">Tipe Customer</th>
                            <th style="width: 80px; text-align: center;">No. Telp</th>
                            <th style="width: 80px; text-align: center;">Email</th>
                            <th style="width: 90px; text-align: center;">Kota</th>
                            <th style="width: 70px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT a.IdOrganizer, a.Organizer, b.Kota, c.TipeCustomer, a.Email, a.Telepon
                                    	FROM tb_organizer a
                                    	INNER JOIN tb_kota b ON a.IdKota=b.IdKota
                                    	INNER JOIN tb_tipecustomer c ON a.IdTipeCustomer = c.IdTipeCustomer
                                    WHERE a.Organizer LIKE '%$Keyword%' OR b.Kota LIKE '%$Keyword%' OR a.Email LIKE '%$Keyword%'
                                    ORDER BY a.Organizer ASC";
                            
                            $dataOrganizer = ReadDataManyRow($sql);
                            if(count($dataOrganizer)>0)
                            {
                                 $i = 1;
                                  foreach($dataOrganizer as $data)
                                  {
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data["Organizer"]; ?></td>
                                            <td><?php echo $data["TipeCustomer"]; ?></td>
                                            <td><?php echo $data["Telepon"]; ?></td>
                                            <td><?php echo $data["Email"]; ?></td>
                                            <td><?php echo $data["Kota"]; ?></td>
                                            <td style="text-align: center;">
                                                <a href="?m=organizer&a=DetailOrganizer&IdOrganizer=<?php echo $data['IdOrganizer'];?>" class="table-icon archive" title="Detail" onclick="DetailPerson('<?php echo $data["IdPerson"]; ?>')"></a>
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
?>