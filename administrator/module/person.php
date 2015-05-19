<?php
    // function person shortcut menu
    function PersonShortcutMenu()
    {
        ?>
            <script>
                
                // function search person
                function SearchPerson()
                {
                    var KeyWord = $("#KeyWord").val();
                    
                    if(KeyWord!="")
                    {
                        url = "module/content.php?m=person&a=SearchPerson&KeyWord="+KeyWord;
                        $("#PersonTable").hide();
                        $("#PersonTable").load(url);
                        $("#PersonTable").fadeIn("slow");
                    }
                    else
                    {
                        new Messi('Keyword harus diisi!', {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Close', val: 'X', class: 'btn-danger'}]});
                        return false;
                    }
                }
                
                // end function search person
                
                // function sort person
                function SortPerson()
                {
                    var IdOrganizer = $("#IdOrganizer").val();
                    
                    if(IdOrganizer=="0")
                    {
                        parent.window.location ='?m=person'
                    }
                    else
                    {
                        url = "module/content.php?m=person&a=SortPerson&IdOrganizer="+IdOrganizer;
                        $("#PersonTable").hide();
                        $("#PersonTable").load(url);
                        $("#PersonTable").fadeIn("slow");
                    }
                }
                // END function sort person
            </script>
            <div class="full_w" style="padding: 10px; margin: 10px;">
                <table>
                    <tr>
                        <td>
                            <button class="export_excel" onclick="ExportOrganizer()">Export Excel</button>
                        </td>
                        <td>
                            <form style="margin: 0px; display: table;" id="formID2">
                                <b>Group by</b>
                                <select name="IdOrganizer" id="IdOrganizer" class="text validate[required]" style="width: 130px; margin-left: 15px; margin-right: 10px;">
                                    <option value="0">All</option>
                                    <?php
                                        $sql = "SELECT IdOrganizer, Organizer FROM tb_organizer ORDER BY Organizer ASC";
                                        $dataOrganizer = ReadDataManyRow($sql);
                                        foreach($dataOrganizer as $data)
                                        {
                                            ?>
                                                <option value="<?php echo $data["IdOrganizer"]; ?>"><?php echo $data["Organizer"]; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <a style="text-decoration: none;" class="btn_blue" onclick="SortPerson()"><span>Filter</span></a>
                            </form>
                        </td>
                        <td style="padding-left: 20px;">
                            <form style="margin: 0px; display: table;" id="formID3">
                                <b style="font-size: 14;">Search</b>
                                <input type="text" name="KeyWord" id="KeyWord" class="text validate[required]" style="width: 150px; margin-left: 15px; margin-right: 10px;" />
                                <a style="text-decoration: none;" class="btn_green" onclick="SearchPerson()"><span>Search</span></a>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
    }
    // END function person shortcut menu
    
    // function view person
    function ViewPerson()
    {
        // header title
        $text = "View Person";
        HeaderTitle($text);
        PersonShortcutMenu();
        ?>
            <div id="PersonTable">
                <?php
                    ViewPersonTableInit();
                ?>
            </div>
        <?php
    }
    
    
    // function ViewOrganizerTable Init
    function ViewPersonTableInit()
    {
        $sql = "SELECT COUNT(IdPerson) AS 'NumRow' FROM tb_person";
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
                        var url = "module/content.php?m=person&a=ViewPersonTablePage&PageIndex="+pageIndex+"&DataPerPage=<?php echo $DataPerPage; ?>";
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
    // END funciton ViewOrganizerTable Init
    
    // table
    function ViewPersonTablePage()
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
    				        <th style="width: 130px; text-align: center;">Nama</th>
                            <th style="width: 90px; text-align: center;">Email</th>
                            <th style="width: 90px; text-align: center;">No. Hanphone</th>
                            <th style="width: 90px; text-align: center;">Organizer</th>
                            <th style="width: 70px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT a.IdPerson, a.Nama, a.Email, a.NoHandphone, b.Organizer
                                    	FROM tb_person a
                                    	INNER JOIN tb_organizer b ON a.IdOrganizer=b.IdOrganizer 
                                    ORDER BY b.Organizer, a.Nama LIMIT $Offset, $DataPerPage";
                            $dataPerson = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataPerson as $data)
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['Nama'] ?></td>
                                        <td><?php echo $data['Email'] ?></td>
                                        <td><?php echo $data['NoHandphone'] ?></td>
                                        <td><?php echo $data['Organizer'] ?></td>
                                        <td style="text-align: center;">
                                            <a href="#" class="table-icon archive" title="Detail" onclick="DetailPerson('<?php echo $data["IdPerson"]; ?>')"></a>
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
    // END function view person
    
    // function view detail person
    function DetailPerson()
    {
        include "../../globalfunction/ajax_include.php";
        $IdPerson = $_GET['IdPerson'];
        
        $sql = "SELECT a.IdOrganizer, a.Nama, a.Alamat, a.JenisKelamin, a.Email, a.NoTelp, a.NoHandphone, b.Organizer 
                        FROM  tb_person a
                LEFT JOIN tb_organizer b ON a.IdOrganizer = b.IdOrganizer WHERE a.IdPerson='$IdPerson'";
        $data = ReadDataOneRow($sql);
        
        ?>
            <div style="border: 1px solid #C5C5C5; padding: 10px; color: #1B1B1B; font-size: 13px;">
                <table>
                    <tr>
                        <td style="width: 100px;">Nama</td>
                        <td style="width: 10px;">:</td>
                        <td><?php echo $data["Nama"]; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $data["Alamat"]; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo $data["JenisKelamin"]; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $data["Email"]; ?></td>
                    </tr>
                    <tr>
                        <td>No. Telp</td>
                        <td>:</td>
                        <td><?php echo $data["NoTelp"]; ?></td>
                    </tr>
                    <tr>
                        <td>No. Hanphone</td>
                        <td>:</td>
                        <td><?php echo $data["NoHandphone"]; ?></td>
                    </tr>
                    <tr>
                        <td>Organizer</td>
                        <td>:</td>
                        <td><?php echo $data["Organizer"]; ?></td>
                    </tr>
                </table>
            </div>
        <?php
        
    }
    // END function view detail person
    
    // function SearchPerson
    function SearchPerson()
    {
        include "../../globalfunction/ajax_include.php";
        $Keyword = $_GET["KeyWord"];
        ?>
            <div style="text-align: center; font-size: 12px; color: #171717;">
                <a href="?m=person" title="Kembali"><img src="../images/arrowicon.png" /></a><br />
                Hasil pencarian keyword : <b><?php echo $Keyword; ?></b>
            </div>
            <div class="sep"></div>
            <div class="datagrid" style="margin: 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
    				        <th style="width: 130px; text-align: center;">Nama</th>
                            <th style="width: 90px; text-align: center;">Email</th>
                            <th style="width: 90px; text-align: center;">No. Hanphone</th>
                            <th style="width: 90px; text-align: center;">Organizer</th>
                            <th style="width: 70px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT a.IdPerson, a.Nama, a.Email, a.NoHandphone, b.Organizer
                                    	FROM tb_person a
                                    	INNER JOIN tb_organizer b ON a.IdOrganizer=b.IdOrganizer
                                    	WHERE a.Nama LIKE '%$Keyword%' OR a.Email LIKE '%$Keyword%' OR b.Organizer LIKE '%$Keyword%'
                                    ORDER BY b.Organizer, a.Nama";
                            $dataPerson = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataPerson as $data)
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['Nama'] ?></td>
                                        <td><?php echo $data['Email'] ?></td>
                                        <td><?php echo $data['NoHandphone'] ?></td>
                                        <td><?php echo $data['Organizer'] ?></td>
                                        <td style="text-align: center;">
                                            <a href="#" class="table-icon archive" title="Detail" onclick="DetailPerson('<?php echo $data["IdPerson"]; ?>')"></a>
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
    // END function SearchPerson
    
    // function SortPerson
    function SortPerson()
    {
        include "../../globalfunction/ajax_include.php";
        $IdOrganizer = $_GET["IdOrganizer"];
        $sql = "SELECT Organizer FROM tb_organizer WHERE IdOrganizer='$IdOrganizer'";
        $dataOrganizer = ReadDataOneRow($sql);
        ?>
            <div style="text-align: center; font-size: 12px; color: #171717;">
                <a href="?m=person" title="Kembali"><img src="../images/arrowicon.png" /></a><br />
                Filter : <b><?php echo $dataOrganizer['Organizer']; ?></b>
            </div>
            <div class="datagrid" style="margin: 10px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
    				        <th style="width: 130px; text-align: center;">Nama</th>
                            <th style="width: 90px; text-align: center;">Email</th>
                            <th style="width: 90px; text-align: center;">No. Hanphone</th>
                            <th style="width: 90px; text-align: center;">Organizer</th>
                            <th style="width: 70px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT a.IdPerson, a.Nama, a.Email, a.NoHandphone, b.Organizer
                                    	FROM tb_person a
                                    	INNER JOIN tb_organizer b ON a.IdOrganizer=b.IdOrganizer 
                                    WHERE a.IdOrganizer='$IdOrganizer'                                    
                                    ORDER BY a.Nama";
                            $dataPerson = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataPerson as $data)
                            {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['Nama'] ?></td>
                                        <td><?php echo $data['Email'] ?></td>
                                        <td><?php echo $data['NoHandphone'] ?></td>
                                        <td><?php echo $data['Organizer'] ?></td>
                                        <td style="text-align: center;">
                                            <a href="#" class="table-icon archive" title="Detail" onclick="DetailPerson('<?php echo $data["IdPerson"]; ?>')"></a>
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
    // END function SortPerson
?>