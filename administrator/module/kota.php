<?php
    // function View data kota
    function ViewKota()
    {
        // header title
        $text = "View Kota";
        HeaderTitle($text);
        
        // table
        ViewKotaTable();
    }
    
    // function view kota table
    function ViewKotaTable()
    {
        ?>
            <div class="datagrid" style="margin: 10px; width: 300px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 20px;">No</th>
    				        <th style="text-align: center;">Nama Kota</th>
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
?>