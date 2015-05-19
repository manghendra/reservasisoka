<?php
    // function View data tipe customer
    function ViewTipeCustomer()
    {
        // header title
        $text = "View Tipe Customer";
        HeaderTitle($text);
        
        // table
        ViewTipeCustomerTable();
    }
    
    function ViewTipeCustomerTable()
    {
        ?>
            <div class="datagrid" style="margin: 10px; width: 300px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 15px;">No</th>
    				        <th style="text-align: center; width: 120px;">Tipe Customer</th>
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
?>