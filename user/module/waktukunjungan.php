<?php
    /*
    Master: Waktu Kunjungan
    - View
    */
    // function View Waktu kunjungan
    function ViewWaktuKunjungan()
    {
        // header title
        $text = "View Waktu Kunjungan";
        HeaderTitle($text);
        ?>
            <div class="datagrid" style="margin: 10px; width: 300px;">
                <table>
                    <thead>
    				    <tr>
    				        <th style="width: 20px;">No</th>
    				        <th style="text-align: center;">Waktu Kunjungan</th>
    				    </tr>
    				</thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM tb_waktu_kunjungan ORDER BY IdWktKunjungan ASC";
                            $dataKota = ReadDataManyRow($sql);
                            $i = 1;
                            foreach($dataKota as $data)
                            {
                                ?> 
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['WaktuKunjungan']; ?></td>
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
?>