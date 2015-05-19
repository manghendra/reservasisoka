<?php
    /*
    Master: Organizer
    - Add
    - View
    - Delete
    - Edit
    */
    
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
                        <button class="add" style="margin-right: 15px;" onclick="window.location.href='?m=organizer&a=TambahOrganizer'">Tambah</button> 
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
                                        <a href="?m=organizer&a=Edit&IdOrganizer=<?php echo $data['IdOrganizer'];?>" class="table-icon edit" title="Edit Organizer" style="margin-right: 15px;"></a>
				                        <a href="#" class="table-icon delete" title="Delete" onclick="DeleteOrganizerConfirm('<?php echo $data["IdOrganizer"]; ?>', '<?php echo $data["Organizer"]; ?>')" style="margin-right: 15px;"></a>
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
                                    WHERE a.Organizer LIKE '%$Keyword%' OR b.Kota LIKE '%$Keyword%' OR a.Email LIKE '%$Keyword% OR a.Owner LIKE '%$Keyword%'
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
                                                <a href="?m=organizer&a=Edit&IdOrganizer=<?php echo $data['IdOrganizer'];?>" class="table-icon edit" title="Edit Organizer" style="margin-right: 15px;"></a>
        				                        <a href="#" class="table-icon delete" title="Delete" onclick="DeleteOrganizerConfirm('<?php echo $data["IdOrganizer"]; ?>', '<?php echo $data["Organizer"]; ?>')" style="margin-right: 15px;"></a>
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
    // END function view organizer table seacrh
    // function tambah grganizer
    function TambahOrganizer()
    {
        // header title
        $text = "Tambah Organizer";
        HeaderTitle($text);
        
        // form
        TambahOrganizerForm();
    }
    
    // form
    function TambahOrganizerForm()
    {
        ?>
            <div style="padding: 10px">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=organizer&a=SimpanOrganizer">
                        <div class="element">
    						<label for="Organizer">Nama Organizer<span class="red">*</span></label>
    						<input id="Organizer" name="Organizer" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="IdTipeCustomer">Tipe Customer<span class="red">*</span></label>
                            <select id="IdTipeCustomer" name="IdTipeCustomer" class="text validate[required]" style="width: 310px;">
                                <option value="">-</option>
                                <?php
                                    $sqlTipeCustomer = "SELECT * FROM tb_tipecustomer ORDER BY TipeCustomer ASC";
                                    $dataCustomer = ReadDataManyRow($sqlTipeCustomer);
                                    foreach($dataCustomer as $data)
                                    {
                                        ?>
                                            <option value="<?php echo $data["IdTipeCustomer"]; ?>"><?php echo $data["TipeCustomer"]; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
    					</div>
                        <div class="element">
    						<label for="Email">Email<span class="red"></span></label>
    						<input id="Email" name="Email" class="text validate[custom[email]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="NoTelp">No. Telephone<span class="red">*</span></label>
    						<input id="Telepon" name="Telepon" class="text validate[required, custom[integer]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="IdKota">Kota<span class="red">*</span></label>
                            <select id="IdKota" name="IdKota" class="text validate[required]" style="width: 310px;">
                                <option value="">-</option>
                                <?php
                                    $sqlKota = "SELECT * FROM tb_kota ORDER BY Kota ASC";
                                    $dataKota = ReadDataManyRow($sqlKota);
                                    foreach($dataKota as $data)
                                    {
                                        ?>
                                            <option value="<?php echo $data["IdKota"]; ?>"><?php echo $data["Kota"]; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
    					</div>
                        <div class="element">
    						<label for="Alamat">Alamat</label>
    						<input id="Alamat" name="Alamat" class="text" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Owner">Owner</label>
    						<input id="Owner" name="Owner" class="text" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Owner">Kontak Owner</label>
    						<input id="KontakOwner" name="KontakOwner" class="text validate[custom[integer]]" style="width: 300px;" />
    					</div>
                        <div class="element">
    						<label for="Notes">Notes</label>
                            <textarea name="Note" id="Note" style="width: 300px; height: 25px;"></textarea>
    					</div>
                        <div class="entry">
						      <button class="btn_black" onclick="window.location.href='?m=organizer'">Cancel</button>
                              <button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
    // END function tambah organizer
    
    // function simpan organizer
    function SimpanOrganizer()
    {
        $Organizer = $_POST["Organizer"];
        $IdTipeCustomer= $_POST["IdTipeCustomer"];
        $IdKota = $_POST["IdKota"];
        $Email = $_POST["Email"];
        $Telepon = $_POST["Telepon"];
        $Alamat = $_POST["Alamat"];
        $Owner = $_POST["Owner"];
        $KontakOwner = $_POST["KontakOwner"];
        $Note = $_POST["Note"];
        
        $sql = "INSERT INTO tb_organizer (Organizer, IdTipeCustomer, Email, Telepon, IdKota, Alamat, Owner, KontakOwner, Note)
                VALUE ('$Organizer', '$IdTipeCustomer', '$Email', '$Telepon', '$IdKota', '$Alamat', '$Owner', '$KontakOwner', '$Note')";
        
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=organizer'";
            exec_js($js);
        }
    }
    // END function simpan organizer
    
    // function simpan organizer popup
    function SimpanOrganizerPopup()
    {
        $Organizer = $_POST["Organizer"];
        $IdTipeCustomer= $_POST["IdTipeCustomer"];
        $IdKota = $_POST["IdKota"];
        $Email = $_POST["Email"];
        $Telepon = $_POST["Telepon"];
        $Alamat = $_POST["Alamat"];
        $Owner = $_POST["Owner"];
        $KontakOwner = $_POST["KontakOwner"];
        $Note = $_POST["Note"];
        
        $sql = "INSERT INTO tb_organizer (Organizer, IdTipeCustomer, Email, Telepon, IdKota, Alamat, Owner, KontakOwner, Note)
                VALUE ('$Organizer', '$IdTipeCustomer', '$Email', '$Telepon', '$IdKota', '$Alamat', '$Owner', '$KontakOwner', '$Note')";
        
        ExecuteQuery($sql);
    }
    // 
    // function edit organizer
    function EditOrganizer()
    {
        // header title
        $text = "Edit Organizer";
        HeaderTitle($text);
        
        // form
        EditOrganizerForm();
    }
    
    // form
    function EditOrganizerForm()
    {
        $IdOrganizer = $_GET["IdOrganizer"];
        if(isset($IdOrganizer))
        {
            $sql = "SELECT * FROM tb_organizer WHERE IdOrganizer='$IdOrganizer'";
            $dataOrganizer = ReadDataOneRow($sql);
            ?>
                <div style="padding: 10px">
                    <div class="full_w">
                        <form id="formID" method="post" action="?m=organizer&a=UpdateOrganizer">
                            <input type="hidden" name="IdOrganizer" id="IdOrganizer" value="<?php echo $dataOrganizer["IdOrganizer"]; ?>" />
                            <div class="element">
        						<label for="Organizer">Nama Organizer<span class="red">*</span></label>
        						<input id="Organizer" name="Organizer" class="text validate[required]" style="width: 300px;" value="<?php echo $dataOrganizer["Organizer"]; ?>" />
        					</div>
                            <div class="element">
        						<label for="IdTipeCustomer">Tipe Customer<span class="red">*</span></label>
                                <select id="IdTipeCustomer" name="IdTipeCustomer" class="text validate[required]" style="width: 310px;">
                                    <option value="">-</option>
                                    <?php
                                        $sqlTipeCustomer = "SELECT * FROM tb_tipecustomer ORDER BY TipeCustomer ASC";
                                        $dataCustomer = ReadDataManyRow($sqlTipeCustomer);
                                        foreach($dataCustomer as $data)
                                        {
                                            if($dataOrganizer["IdTipeCustomer"]==$data["IdTipeCustomer"])
                                            {
                                                ?>
                                                    <option value="<?php echo $data["IdTipeCustomer"]; ?>" selected="selected"><?php echo $data["TipeCustomer"]; ?></option>
                                                <?php   
                                            }
                                            else
                                            {
                                                ?>
                                                    <option value="<?php echo $data["IdTipeCustomer"]; ?>"><?php echo $data["TipeCustomer"]; ?></option>
                                                <?php 
                                            }
                                        }
                                    ?>
                                </select>
        					</div>
                            <div class="element">
        						<label for="Email">Email<span class="red"></span></label>
        						<input id="Email" name="Email" value="<?php echo $dataOrganizer["Email"]; ?>" class="text validate[custom[email]]" style="width: 300px;" />
        					</div>
                            <div class="element">
        						<label for="NoTelp">No. Telephone</label>
        						<input id="Telepon" name="Telepon" value="<?php echo $dataOrganizer["Telepon"]; ?>" class="text validate[required, custom[integer]]" style="width: 300px;" />
        					</div>
                            <div class="element">
        						<label for="IdKota">Kota<span class="red">*</span></label>
                                <select id="IdKota" name="IdKota" class="text validate[required]" style="width: 310px;">
                                    <option value="">-</option>
                                    <?php
                                        $sqlKota = "SELECT * FROM tb_kota ORDER BY Kota ASC";
                                        $dataKota = ReadDataManyRow($sqlKota);
                                        foreach($dataKota as $data)
                                        {
                                            if($dataOrganizer["IdKota"]==$data["IdKota"])
                                            {
                                                ?>
                                                    <option value="<?php echo $data["IdKota"]; ?>" selected="selected"><?php echo $data["Kota"]; ?></option>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <option value="<?php echo $data["IdKota"]; ?>"><?php echo $data["Kota"]; ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
        					</div>
                             <div class="element">
        						<label for="Alamat">Alamat</label>
        						<input id="Alamat" name="Alamat" value="<?php echo $dataOrganizer["Alamat"]; ?>" class="text" style="width: 300px;" />
        					</div>
                            <div class="element">
        						<label for="Owner">Owner</label>
        						<input id="Owner" name="Owner" value="<?php echo $dataOrganizer["Owner"]; ?>" class="text" style="width: 300px;" />
        					</div>
                            <div class="element">
        						<label for="KontakOwner">Kontak Owner</label>
        						<input id="KontakOwner" name="KontakOwner" value="<?php echo $dataOrganizer["KontakOwner"]; ?>" class="text" style="width: 300px;" />
        					</div>
                            <div class="element">
        						<label for="Notes">Notes</label>
                                <textarea name="Note" id="Note" style="width: 300px; height: 25px;"><?php echo $dataOrganizer["Note"]; ?></textarea>
        					</div>
                            <div class="entry">
                                  <a style="text-decoration: none;" class="btn_black" href="?m=organizer"><span>Cancel</span></a>
                                  <button type="submit" class="btn_blue" style="margin-left: 20px;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
        }
    }
    // END function edit organizer
    
    // Function update organizer
    function UpdateOrganizer()
    {
        $IdOrganizer= $_POST["IdOrganizer"];
        $Organizer = $_POST["Organizer"];
        $IdTipeCustomer= $_POST["IdTipeCustomer"];
        $IdKota = $_POST["IdKota"];
        $Email = $_POST["Email"];
        $Telepon = $_POST["Telepon"];
        $Alamat = $_POST["Alamat"];
        $Owner = $_POST["Owner"];
        $KontakOwner = $_POST["KontakOwner"];
        $Note = $_POST["Note"];
        
        $sql = "UPDATE tb_organizer SET
                	Organizer='$Organizer',
                	IdTipeCustomer='$IdTipeCustomer',
                	IdKota='$IdKota',
                    Email='$Email',
                    Telepon='$Telepon',
                    Alamat='$Alamat', 
                    Owner='$Owner',
                    KontakOwner='$KontakOwner',
                    Note='$Note'
                WHERE IdOrganizer='$IdOrganizer'";
        
        if(ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=organizer'";
            exec_js($js);
        }
    }
    // END function update organizer
    
    // function delete organizer
    function DeleteOrganizer()
    {
        $IdOrganizer = $_GET["IdOrganizer"];
        $sql = "DELETE FROM tb_organizer WHERE IdOrganizer='$IdOrganizer'";
        if(ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=organizer'";
            exec_js($js);
        }
    }
    // END function delete organizer
    
    // function tambah organizer pop-up
    function TambahOrganizerPopUp()
    {
        include "../../globalfunction/ajax_include.php";
        ?>
                <div style="height: 400px; overflow-y: scroll;">
                <div class="full_w" style="margin: 5px;">
                    <form id="formID2" method="post" action="?m=organizer&a=SimpanOrganizerPopup" style="margin: 5px;">
                        <div class="element">
    						<label for="Organizer">Nama Organizer<span class="red">*</span></label>
    						<input id="Organizer" name="Organizer" class="text validate[required]" style="width: 250px;" />
    					</div>
                        <div class="element">
    						<label for="IdTipeCustomer">Tipe Customer<span class="red">*</span></label>
                            <select id="IdTipeCustomer" name="IdTipeCustomer" class="text validate[required]" style="width: 260px;">
                                <option value="">-</option>
                                <?php
                                    $sqlTipeCustomer = "SELECT * FROM tb_tipecustomer ORDER BY TipeCustomer ASC";
                                    $dataCustomer = ReadDataManyRow($sqlTipeCustomer);
                                    foreach($dataCustomer as $data)
                                    {
                                        ?>
                                            <option value="<?php echo $data["IdTipeCustomer"]; ?>"><?php echo $data["TipeCustomer"]; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
    					</div>
                        <div class="element" >
    						<label for="Email" >Email<span class="red">*</span></label>
    						<input id="Email" name="Email" class="text validate[required, custom[email]]" style="width: 250px;" />
    					</div>
                        <div class="element">
    						<label for="Telepon">Telepon<span class="red">*</span></label>
    						<input id="Telepon" name="Telepon" class="text validate[required, custom[integer]]" style="width: 250px;" />
    					</div>
                        <div class="element">
    						<label for="IdKota">Kota<span class="red">*</span></label>
                            <select id="IdKota" name="IdKota" class="text validate[required]" style="width: 250px;">
                                <option value="">-</option>
                                <?php
                                    $sqlKota = "SELECT * FROM tb_kota ORDER BY Kota ASC";
                                    $dataKota = ReadDataManyRow($sqlKota);
                                    foreach($dataKota as $data)
                                    {
                                        ?>
                                            <option value="<?php echo $data["IdKota"]; ?>"><?php echo $data["Kota"]; ?></option>
                                        <?php
                                    }
                                ?>
                            </select>
    					</div>
						<div class="element">
    						<label for="Alamat">Alamat<span class="red">*</span></label>
    						<input id="Alamat" name="Alamat" class="text validate[required]" style="width: 250px;" />
    					</div>
                        <div class="element">
    						<label for="Owner">Owner</label>
    						<input id="Owner" name="Owner" class="text" style="width: 250px;" />
    					</div>
                        <div class="element">
    						<label for="Owner">Kontak Owner</label>
    						<input id="KontakOwner" name="KontakOwner" class="text validate[custom[integer]]" style="width: 250px;" />
    					</div>
                        <div class="element">
    						<label for="Notes">Notes</label>
                            <textarea name="Note" id="Note" style="width: 250px; height: 30px;"></textarea>
    					</div>
                        <div class="entry">
                               <a href="#" onclick="CloseMessi()" class="btn_black" style="text-decoration: none;"><span>Cancel</span></a>
                               <button type="submit" class="btn_blue" style="margin-left: 20px;" onclick="SimpanOrganizerPopUp()">Save</button>
                        </div>
                    </form>
                </div>
                </div>
        <?php
    }
    // END function tambah organizer popup
    
    // function load organizer
    function LoadOrganizer()
    {
        ?>
            <option>-</option>
        <?php
        include "../../globalfunction/ajax_include.php";
        $sqlOrganizer = "SELECT IdOrganizer, Organizer FROM tb_organizer ORDER BY Organizer ASC";
        $dataOrganizer = ReadDataManyRow($sqlOrganizer);
        foreach($dataOrganizer as $data)
        {
            ?>
                <option value="<?php echo $data["IdOrganizer"]; ?>"><?php echo $data["Organizer"]; ?></option>
            <?php
        }
    }
    // END function load organizer
    
    
    // function detail organizer
    function DetailOrganizer()
    {
        // header title
        HeaderTitle("Detail Organizer");
        $IdOrganizer = $_GET["IdOrganizer"];
        $sql = "SELECT a.IdOrganizer, a.Organizer, b.Kota, c.TipeCustomer, a.Email, a.Telepon, a.Alamat, a.Owner, a.KontakOwner, a.Note
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
                        <tr>
                            <td>Owner</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["Owner"]; ?></td>
                        </tr>
                        <tr>
                            <td>Kontak Owner</td>
                            <td>:</td>
                            <td style="font-weight: bold;"><?php echo $dataOrganizer["KontakOwner"]; ?></td>
                        </tr>
                        <tr>
                            <td>Notes</td>
                            <td>:</td>
                            <td><?php echo $dataOrganizer["Note"]; ?></td>
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
    
    // function show notf organizer
    function ShowNotifOrganizer()
    {
        include "../../globalfunction/ajax_include.php";
        $IdOrganizer = $_GET["IdOrganizer"];
        $sql = "SELECT Note FROM tb_organizer WHERE IdOrganizer='$IdOrganizer'";
        $data = ReadDataOneRow($sql);
        if(count($data)>0)
        {
            ?>
                <label style="font-size: 12px;" class="closed">Note :</label><br />
            <?php
            echo $data["Note"];   
        }
    }
    // END function show notif organizer
?>