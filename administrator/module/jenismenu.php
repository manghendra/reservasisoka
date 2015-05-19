<?php
    
    
    // function view jenis menu
    function ViewJenisMenu()
    {
        HeaderTitle("Jenis Menu");
        ?>
            <script>
                // function delete jenis menu confirm
                function DeleteJenisMenuConfirm(IdJenisMenu, JenisMenu)
                {
                    new Messi('Apakah anda yakin menghapus jenis menu :' + JenisMenu , {title: 'Warning', modal: true, titleClass: 'warning', buttons: [{id: 0, label: 'Yes', val: 'Y' , btnClass: 'btn-danger'}, {id: 1, label: 'No', val: 'N', btnClass: 'btn-success'}], 
                    callback: function(val) 
                                {
                                    if (val=="Y")
                                    {
                                        parent.window.location = '?m=jenismenu&a=DeleteJenisMenu&IdJenisMenu='+IdJenisMenu;
                                    }
                                }
                    });
                }
                // END function delete jenis menu confirm
            </script>
            <div class="full_w" style="padding: 10px; margin: 10px;">
                <button class="add" onclick="window.location.href='?m=jenismenu&a=TambahJenisMenu'">Tambah Jenis Menu</button> 
            </div>
            <div class="datagrid" style="margin: 10px; width: 350px;">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 20px; text-align: center;">No.</th>
                            <th style="text-align: center;">Jenis Menu</th>
                            <th style="text-align: center; width: 90px;">Option</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM tb_jenismakanan ORDER BY JenisMakanan";
                        $dataJenisMenu = ReadDataManyRow($sql);
                        $i = 1;
                        foreach($dataJenisMenu as $data)
                        {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data["JenisMakanan"]; ?></td>
                                    <td style="text-align: center;">
                                        <a href="?m=jenismenu&a=EditJenisMenu&IdJenisMenu=<?php echo $data["IdJenisMakanan"]; ?>" class="table-icon edit" title="Edit Jenis Menu" style="margin-right: 15px;"></a>
    								    <a href="javascript:void(0)" onclick="DeleteJenisMenuConfirm('<?php echo $data['IdJenisMakanan']; ?>', '<?php echo $data['JenisMakanan']; ?>')" class="table-icon delete" title="Delete Jenis Menu" ></a>
                                    </td>
                                </tr>
                            <?php
                            $i++;
                        }
                    ?>
                </table>
            </div>
        <?php
    }
    // END function view jenis menu
    
    // function tambah jenis menu
    function TambahJenisMenu()
    {
        HeaderTitle("Jenis Menu");
        ?>
            <div style="padding: 10px">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=jenismenu&a=SimpanJenisMenu">
                        <div class="element">
    						<label for="Kota">Nama Jenis Menu<span class="red">*</span></label>
    						<input id="JenisMenu" name="JenisMenu" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="entry">
						      <button class="btn_black" onclick="window.location.href='?m=jenismenu'">Cancel</button>
                              <button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
    // END function tambah jenis menu
    
    // function simpan jenis menu
    function SimpanJenisMenu()
    {
        $JenisMenu = $_POST['JenisMenu'];
        $sql = "INSERT INTO tb_jenismakanan (JenisMakanan) VALUE ('$JenisMenu')";
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=jenismenu'";
            exec_js($js);
        }
    }
    // END funciton simpan kenis menu
    
    // function edit jenis menu
    function EditJenisMenu()
    {
        HeaderTitle("Edit Jenis Menu");
        $IdJenisMenu = $_GET["IdJenisMenu"];
        if(isset($IdJenisMenu))
        {
            $sql = "SELECT * FROM tb_jenismakanan WHERE IdJenisMakanan='$IdJenisMenu'";
            $data = ReadDataOneRow($sql);
            ?>
                <div style="padding: 10px">
                    <div class="full_w">
                        <form id="formID" method="post" action="?m=jenismenu&a=UpdateJenisMenu">
                            <input type="hidden" name="IdJenisMenu" value="<?php echo $IdJenisMenu; ?>" />
                            <div class="element">
        						<label for="Kota">Nama Jenis Menu<span class="red">*</span></label>
        						<input id="JenisMenu" value="<?php echo $data["JenisMakanan"]; ?>" name="JenisMenu" class="text validate[required]" style="width: 300px;" />
        					</div>
                            <div class="entry">
    						      <a href="?m=jenismenu" style="text-decoration: none;" class="btn_black"><span>Cancel</span></a>
                                  <button type="submit" class="btn_blue" style="margin-left: 20px;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
        }
    }
    // END function edit jenis menu
    
    // function update jenise menu
    function UpdateJenisMenu()
    {
        $IdJenisMenu = $_POST["IdJenisMenu"];
        $JenisMenu = $_POST["JenisMenu"];
        
        $sql = "UPDATE tb_jenismakanan SET JenisMakanan='$JenisMenu' WHERE IdJenisMakanan='$IdJenisMenu'";
        
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=jenismenu'";
            exec_js($js);
        }
    }
    // END function update jenis menu
    
    
    // function delete jenis menu
    function DeleteJenisMenu()
    {
        $IdJenisMenu = $_GET["IdJenisMenu"];
        $sql = "DELETE FROM tb_jenismakanan WHERE IdJenisMakanan='$IdJenisMenu'";
        
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=jenismenu'";
            exec_js($js);
        }
    }
    // END function delete jenis menu
?>