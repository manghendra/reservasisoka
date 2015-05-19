<?php
    /*
    Master: Organizer
    - Add
    - View
    - Delete
    - Edit
    */
    
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
                            <button class="add" style="padding-right: 10px;" onclick="window.location.href='?m=person&a=TambahPerson'">Tambah</button> 
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
                                            <a href="?m=person&a=Edit&IdPerson=<?php echo $data['IdPerson'];?>" class="table-icon edit" title="Edit Person" style="margin-right: 15px;"></a>
    				                        <a href="#" class="table-icon delete" title="Delete" onclick="DeletePersonConfirm('<?php echo $data["IdPerson"]; ?>', '<?php echo $data["Nama"]; ?>')" style="margin-right: 15px;"></a>
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
    
    // function add person
    function TambahPerson()
    {
        // header title
        $text = "Tambah Person";
        HeaderTitle($text);
        
        TambahPersonForm();
    }
    
    // form
    function TambahPersonForm()
    {
        ?>
            <div style="padding: 10px">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=person&a=SimpanPerson">
                        <div class="element">
    						<label for="Nama">Nama<span class="red">*</span></label>
    						<input id="Nama" name="Nama" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="name">Jenis Kelamin<span class="red">*</span></label>
                            <select id="JenisKelamin" name="JenisKelamin" class="text validate[required]" style="width: 310px;">
                                <option value="">-</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
    					</div>
                        <div class="element">
    						<label for="IdOrganizer">Organizer<span class="red">*</span></label>
                            <select id="IdOrganizer" name="IdOrganizer" class="text validate[required]" style="width: 310px;">
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
                            </select>
    					</div>
                        <div class="element">
    						<label for="NoHandphone">No. Hanphone<span class="red">*</span></label>
    						<input id="NoHandphone" name="NoHandphone" class="text validate[required, custom[integer]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Email">Email</label>
    						<input id="Email" name="Email" class="text validate[custom[email]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Alamat">Alamat</label>
    						<input id="Alamat" name="Alamat" class="text" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Notes">Notes</label>
                            <textarea name="Note" id="Note" style="width: 300px; height: 30px;"></textarea>
    					</div>
                        <div class="entry">
						      <button class="btn_black" onclick="window.location.href='?m=person'">Cancel</button>
                              <button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>          
        <?php
    }
    // END function add person
    
    // function simpan person
    function SimpanPerson()
    {
        $Nama = $_POST["Nama"];
        $Alamat = $_POST["Alamat"];
        $JenisKelamin= $_POST["JenisKelamin"];
        $NoTelp = $_POST["NoTelp"];
        $NoHandphone = $_POST["NoHandphone"];
        $Email = $_POST["Email"];
        $IdOrganizer = $_POST["IdOrganizer"];
        $Note = $_POST["Note"];
        
        // sql save person
        $sql = "INSERT INTO tb_person (Nama, Alamat, JenisKelamin, Email, NoHandphone, IdOrganizer, Note) 
                VALUE ('$Nama', '$Alamat', '$JenisKelamin', '$Email', '$NoHandphone', '$IdOrganizer', '$Note')";
        
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=person'";
            exec_js($js);
        }
    }
    
    // END function simpan person
    
    // function edit person
    function EditPerson()
    {
        // header title
        $text = "Edit Person";
        HeaderTitle($text);
        
        // form
        EditPersonForm();
    }
    
    // edit form
    function EditPersonForm()
    {
        $IdPerson = $_GET["IdPerson"];
        $sql = "SELECT * FROM tb_person WHERE IdPerson='$IdPerson'";
        $data = ReadDataOneRow($sql);
        ?>
            <div style="padding: 10px">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=person&a=UpdatePerson">
                        <input type="hidden" name="IdPerson" value="<?php echo $data['IdPerson'] ?>" />
                        <div class="element">
    						<label for="Nama">Nama<span class="red">*</span></label>
    						<input id="Nama" name="Nama" class="text validate[required]" style="width: 300px;" value="<?php echo $data['Nama'] ?>" />
    					</div>
                        <div class="element">
    						<label for="name">Jenis Kelamin<span class="red">*</span></label>
                            <select id="JenisKelamin" name="JenisKelamin" class="text validate[required]" style="width: 310px;">
                                <?php
                                    if($data["JenisKelamin"]=="Laki-laki")
                                    {
                                        ?>
                                            <option value="Laki-laki" selected="selected">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan" selected="selected">Perempuan</option>
                                        <?php
                                    }
                                ?>
                            </select>
    					</div>
                        <div class="element">
    						<label for="IdOrganizer">Organizer<span class="red">*</span></label>
                            <select id="IdOrganizer" name="IdOrganizer" class="text validate[required]" style="width: 310px;">
                                <?php
                                    $sqlOrganizer = "SELECT IdOrganizer, Organizer FROM tb_organizer ORDER BY Organizer ASC";
                                    $dataOrganizer = ReadDataManyRow($sqlOrganizer);
                                    foreach($dataOrganizer as $dataOrg)
                                    {
                                        if($dataOrg["IdOrganizer"]==$data["IdOrganizer"])
                                        {
                                            ?>
                                                <option value="<?php echo $dataOrg["IdOrganizer"]; ?>" selected="selected"><?php echo $dataOrg["Organizer"]; ?></option>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                                <option value="<?php echo $dataOrg["IdOrganizer"]; ?>"><?php echo $dataOrg["Organizer"]; ?></option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
    					</div>
                        <div class="element">
    						<label for="NoHandphone">No. Hanphone<span class="red">*</span></label>
    						<input id="NoHandphone" name="NoHandphone" class="text validate[required, custom[integer]]" style="width: 300px;" value="<?php echo $data['NoHandphone'] ?>" />
    					</div>
                        <div class="element">
    						<label for="Email">Email<span class="red">*</span></label>
    						<input id="Email" name="Email" class="text validate[required, custom[email]]" style="width: 300px;" value="<?php echo $data['Email'] ?>" />
    					</div>
                        <div class="element">
    						<label for="Alamat">Alamat</label>
    						<input id="Alamat" name="Alamat" class="text" style="width: 300px;" value="<?php echo $data['Alamat'] ?>" />
    					</div>
                        <div class="element">
    						<label for="Notes">Notes</label>
                            <textarea name="Note" id="Note" style="width: 300px; height: 30px;"><?php echo $data['Note'] ?></textarea>
    					</div>
                        <div class="entry">
						      <button class="btn_black" onclick="window.location.href='?m=person'">Cancel</button>
                              <button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>          
        <?php
    }
    
    // END function edit person
    
    // function update person
    function UpdatePerson()
    {
        $IdPerson = $_POST["IdPerson"];
        $Nama = $_POST["Nama"];
        $Alamat = $_POST["Alamat"];
        $JenisKelamin= $_POST["JenisKelamin"];
        $NoTelp = $_POST["NoTelp"];
        $NoHandphone = $_POST["NoHandphone"];
        $Email = $_POST["Email"];
        $IdOrganizer = $_POST["IdOrganizer"];
        $Note = $_POST["Note"];
        
        // sql update
        $sql = "UPDATE tb_person SET
                	Nama = '$Nama',
                	Alamat = '$Alamat',
                	JenisKelamin = '$JenisKelamin',
                	Email = '$Email',
                	NoHandphone = '$NoHandphone',
                	IdOrganizer = '$IdOrganizer',
                    Note = '$Note'
                WHERE IdPerson = '$IdPerson'";
        
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=person'";
            exec_js($js);
        }
    }
    // END function edit person
    
    
    // function view detail person
    function DetailPerson()
    {
        include "../../globalfunction/ajax_include.php";
        $IdPerson = $_GET['IdPerson'];
        
        $sql = "SELECT a.IdOrganizer, a.Nama, a.Alamat, a.JenisKelamin, a.Email, a.NoTelp, a.NoHandphone, b.Organizer, a.Note
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
                    <tr>
                        <td>Note</td>
                        <td>:</td>
                        <td><?php echo $data["Note"]; ?></td>
                    </tr>
                </table>
            </div>
        <?php
        
    }
    // END function view detail person
    
    // function delete person
    function DeletePerson()
    {
        $IdPerson = $_GET["IdPerson"];
        $sql = "DELETE FROM tb_person WHERE IdPerson = '$IdPerson'";
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=person'";
            exec_js($js);
        }
    }
    // END function delete person
    
    // function tambah person popup
    function TambahPersonPopUp()
    {
        $IdOrganizer = $_GET["IdOrganizer"];
        include "../../globalfunction/ajax_include.php";
        ?>
            <div style="padding: 5px">
                <div class="full_w">
                    <form id="formID2" method="post" action="?m=person&a=SimpanPerson">
                        <input type="hidden" name="IdOrganizer" value="<?php echo $IdOrganizer; ?>" />
                        <div class="element">
    						<label for="Organizer">Organizer<span class="red">*</span></label>
    						<?php 
                                $sql = "SELECT Organizer FROM tb_organizer WHERE IdOrganizer='$IdOrganizer'";
                                $data = ReadDataOneRow($sql);
                            ?>
                            <input id="Organizer" name="Organizer" disabled="disabled" value="<?php echo $data["Organizer"]; ?>" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Nama">Nama<span class="red">*</span></label>
    						<input id="Nama" name="Nama" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="name">Jenis Kelamin<span class="red">*</span></label>
                            <select id="JenisKelamin" name="JenisKelamin" class="text validate[required]" style="width: 310px;">
                                <option value="">-</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
    					</div>
                        <div class="element">
    						<label for="NoHandphone">No. Hanphone<span class="red">*</span></label>
    						<input id="NoHandphone" name="NoHandphone" class="text validate[required, custom[integer]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Email">Email</label>
    						<input id="Email" name="Email" class="text validate[custom[email]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Alamat">Alamat</label>
    						<input id="Alamat" name="Alamat" class="text" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Notes">Notes</label>
                            <textarea name="Note" id="Note" style="width: 300px; height: 30px;"></textarea>
    					</div>
                        <div class="entry">
			                 <a href="#" onclick="CloseMessi()" class="btn_black" style="text-decoration: none;"><span>Cancel</span></a>
                             <button type="submit" class="btn_blue" onclick="SimpanPersonPopUp('<?php echo $IdOrganizer; ?>')" style="margin-left: 20px;">Save</button>
                        </div>
                    </form>
                </div>
            </div>          
        <?php
    }
    // END function tambah person popup
    
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
                                            <a href="?m=person&a=Edit&IdPerson=<?php echo $data['IdPerson'];?>" class="table-icon edit" title="Edit Person" style="margin-right: 15px;"></a>
    				                        <a href="#" class="table-icon delete" title="Delete" onclick="DeletePersonConfirm('<?php echo $data["IdPerson"]; ?>', '<?php echo $data["Nama"]; ?>')" style="margin-right: 15px;"></a>
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
                                            <a href="?m=person&a=Edit&IdPerson=<?php echo $data['IdPerson'];?>" class="table-icon edit" title="Edit Person" style="margin-right: 15px;"></a>
    				                        <a href="#" class="table-icon delete" title="Delete" onclick="DeletePersonConfirm('<?php echo $data["IdPerson"]; ?>', '<?php echo $data["Nama"]; ?>')" style="margin-right: 15px;"></a>
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
    
    // function show notif person
    function ShowNotifPerson()
    {
        include "../../globalfunction/ajax_include.php";
        $IdPerson = $_GET["IdPerson"];
        $sql = "SELECT Note FROM tb_person WHERE IdPerson='$IdPerson'";
        $data = ReadDataOneRow($sql);
        if(count($data)>0)
        {
            ?>
                <label style="font-size: 12px;" class="closed">Note :</label><br />
            <?php
            echo $data["Note"];   
        }
    }
    // END function show notif person
?>