<?php
    /*
    Master: Kota
    - Add
    - View
    - Delete
    - Edit
    */
    // shotcut menu
    function TipeCustomerShorcutMenu()
    {
        ?>
            <div class="full_w" style="padding: 10px; margin: 10px;">
                <div style="text-align: center; display: table;" id="div">
                    <div id="div" style="display: table-cell;">
                        <button class="add" style="margin-right: 15px;" onclick="window.location.href='?m=tipecustomer&a=TambahCusType'">Tambah Tipe Cust.</button> 
                    </div>
                </div>
            </div>
        <?php
    }
    //
    
    // function View data tipe customer
    function ViewTipeCustomer()
    {
        // header title
        $text = "View Tipe Customer";
        HeaderTitle($text);
        
        // shortcut menu
        TipeCustomerShorcutMenu();
        
        // table
        ViewTipeCustomerTable();
    }
    
    function ViewTipeCustomerTable()
    {
        ?>
            <div class="datagrid" style="margin: 10px; width: 450px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 20px;">No</th>
    				        <th style="text-align: center;">Tipe Customer</th>
    				        <th style="width: 120px; text-align: center;">Option</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM tb_tipecustomer ORDER BY TipeCustomer ASC;";
                            $dataKota = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataKota as $data)
                            {
                                ?> 
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['TipeCustomer']; ?></td>
                                        <td style="text-align: center;">
                                            <a href="?m=tipecustomer&a=Edit&IdTipeCustomer=<?php echo $data['IdTipeCustomer'];?>" class="table-icon edit" title="Edit Tipe Customer" style="margin-right: 15px;"></a>
        								    <a href="#" class="table-icon delete" title="Delete" onclick="DeleteTipeCustConfirm('<?php echo $data["IdTipeCustomer"]; ?>', '<?php echo $data["TipeCustomer"]; ?>')"></a>
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
    // END view tipe customer
    
    // function tambah tipe customer
    function TambahTipeCustomer()
    {
        // header title
        $text = "Tambah Tipe Customer";
        HeaderTitle($text);
        
        // form
        TambahTipeCustomerForm();
    }
    
    function TambahTipeCustomerForm()
    {
        ?>
            <div style="padding: 10px">
                <div class="full_w">
                    <form id="formID" method="post" action="?m=tipecustomer&a=SimpanTipeCustomer">
                        <div class="element">
    						<label for="TipeCustomer">Tipe Customer<span class="red">*</span></label>
    						<input id="TipeCustomer" name="TipeCustomer" class="text validate[required]" style="width: 300px;" />
    					</div>
                        <div class="entry">
						      <button class="btn_black" onclick="window.location.href='?m=tipecustomer'">Cancel</button>
                              <button type="submit" class="btn_blue">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
    }
    // END function tambah tipe customer
    
    // function simpan tipe customer
    function SimpanTipeCustomer()
    {
        $tipeCustomer = $_POST['TipeCustomer'];
        $sql = "INSERT INTO tb_tipecustomer (TipeCustomer) VALUE ('$tipeCustomer')";
        if (ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=tipecustomer'";
            exec_js($js);
        }
    }
    // END function tipe customer
    
    // function edit tipe customer
    function EditTipeCustomer()
    {
        // header title
        $text = "Edit Tipe Customer";
        HeaderTitle($text);
        
        EditTipeCustomerForm();
    }
    
    function EditTipeCustomerForm()
    {
        $idTipeCustomer = $_GET["IdTipeCustomer"];
        
        if(isset($idTipeCustomer))
        {
            $sql = "SELECT * FROM tb_tipecustomer WHERE IdTipeCustomer='$idTipeCustomer'";
            $data = ReadDataOneRow($sql);
            ?>
                <div style="padding: 10px">
                    <div class="full_w">
                        <form id="formID" method="post" action="?m=tipecustomer&a=UpdateTipeCustomer">
                            <input type="hidden" name="IdTipeCustomer" value="<?php echo $data['IdTipeCustomer'];?>" />
                            <div class="element">
        						<label for="TipeCustomer">Tipe Customer<span class="red">*</span></label>
        						<input id="TipeCustomer" name="TipeCustomer" class="text validate[required]" style="width: 300px;" value="<?php echo $data["TipeCustomer"]; ?>" />
        					</div>
                            <div class="entry">
    						      <button class="btn_black" onclick="window.location.href='?m=tipecustomer'">Cancel</button>
                                  <button type="submit" class="btn_blue">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
        }
    }
    // END function edit tipe customer
    
    // function UpdateTipeCustomer
    function UpdateTipeCustomer()
    {
        $IdTipeCustomer = $_POST["IdTipeCustomer"];
        $TipeCustomer = $_POST["TipeCustomer"];
        
        $sql = "UPDATE tb_tipecustomer SET TipeCustomer='$TipeCustomer' WHERE IdTipeCustomer='$IdTipeCustomer'";
        
        if(ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=tipecustomer'";
            exec_js($js);
        }
     }
    // END function UpdateTipeCustomer
    
    // function delete tipe customer
    function DeleteTipeCustomer()
    {
        $IdTipeCustomer = $_GET["IdTipeCustomer"];
        
        $sql = "DELETE FROM tb_tipecustomer WHERE IdTipeCustomer='$IdTipeCustomer'";
        if(ExecuteQuery($sql))
        {
            $js = "parent.window.location ='?m=tipecustomer'";
            exec_js($js);
        }
    }
    // END function delete tipe customer
?>