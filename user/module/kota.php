<?php
    /*
    Master: Kota
    - Add
    - View
    - Delete
    - Edit
    */
    
    // shotcut menu
    function KotaShorcutMenu()
    {
        ?>
            <div class="full_w" style="padding: 10px; margin: 10px;">
                <div style="text-align: center; display: table;" id="div">
                    <div id="div" style="display: table-cell;">
                        <button class="add" style="margin-right: 15px;" onclick="window.location.href='?m=kota&a=TambahKota'">Tambah Kota</button> <button class="new_user" onclick="window.location.href='?m=kota&a=ViewKota'">Tampilkan Kota</button>
                    </div>
                </div>
            </div>
        <?php
    }
    //
    // function View data kota
    function ViewKota()
    {
        // header title
        $text = "View Kota";
        HeaderTitle($text);
        
        // shortcut menu
        KotaShorcutMenu();
        
        // table
        ViewKotaTable();
    }
    
    // function view kota table
    function ViewKotaTable()
    {
        ?>
            <div class="datagrid" style="margin: 10px; width: 450px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 20px;">No</th>
    				        <th style="text-align: center;">Nama Kota</th>
    				        <th style="width: 120px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM tb_kota ORDER BY Kota ASC;";
                            $dataKota = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataKota as $data)
                            {
                                ?> 
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['Kota']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="?m=kota&a=Edit&IdKota=<?php echo $data['IdKota'];?>" class="table-icon edit" title="Edit Kota" style="margin-right: 15px;"></a>
        								    <a href="#" class="table-icon delete" title="Delete" onclick="DeleteKotaConfirm('<?php echo $data["IdKota"]; ?>', '<?php echo $data["Kota"]; ?>')"></a>
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
    // END function view kota table
    
    
    // function tambah kota
    function TambahKota()
    {
        // header title
        $text = "Tambah Kota";
        HeaderTitle($text);
        
        // form
        TambahKotaForm();
    }
    
    function TambahKotaForm()
    {
        ?>
            <div style="padding: 10px">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=kota&a=SimpanKota">
                        <div class="element">
    						<label for="Kota">Nama Kota<span class="red">*</span></label>
    						<input id="kota" name="kota" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="entry">
						      <button class="btn_black" onclick="window.location.href='?m=kota'">Cancel</button>
                              <button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
    // END function tambah kota
    
    // function simpan kota
    function SimpanKota()
    {
        $kota = $_POST['kota'];
        $sql = "INSERT INTO tb_kota (Kota) VALUE ('$kota');";
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=kota'";
            exec_js($js);
        }
    }
    // function simpan kota
    
    // function edit kota
    function EditKota()
    {
        // header title
        $text = "Edit Kota";
        HeaderTitle($text);
        
        // shortcut menu
        KotaShorcutMenu();
        
        // form
        EditKotaForm();
    }
    // END function edit kota
    
    // function edit kota form
    function EditKotaForm()
    {
        $idKota = $_GET['IdKota'];
        if(isset($idKota))
        {
            $sql = "SELECT * FROM tb_kota WHERE IdKota='$idKota'";
            $data = ReadDataOneRow($sql);
            ?>
                <div style="padding: 10px">
                    <div class="full_w">
                        <form id="formID" method="post" action="?m=kota&a=UpdateKota">
                            <input type="hidden" name="IdKota" value="<?php echo $data['IdKota'];?>" />
                            <div class="element">
        						<label for="Kota">Nama Kota<span class="red">*</span></label>
        						<input id="Kota" name="Kota" class="text validate[required]" style="width: 300px;" value="<?php echo $data["Kota"]; ?>" />
        					</div>
                            <div class="entry">
    						      <button class="btn_black" onclick="window.location.href='?m=kota'">Cancel</button>
                                  <button type="submit" class="btn_blue">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
        }
    }
    // END function edit kota form
    
    
    // function update kota
    function UpdateKota()
    {
        $idKota = $_POST["IdKota"];
        $kota = $_POST["Kota"];
        
        $sql = "UPDATE tb_kota SET Kota='$kota' WHERE IdKota='$idKota'";
        if(ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=kota'";
            exec_js($js);
        }
    }
    // END function update kota
    
    function DeleteKota()
    {
        $idKota = $_GET["IdKota"];
        $sql = "DELETE FROM tb_kota WHERE IdKota='$idKota'";
        if(ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=kota'";
            exec_js($js);
        }
    }
?>