<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-eye"></i>&nbsp;จำนวนที่ใช้แพ็กเกจ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <div class="table-responsive">
                    <table class="table">                
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อทีม</th> 
                                <th>หัวหน้าทีม</th>
                                <th class="text-center">วันที่อัพเดทแพ็กเกจ</th>
                                <th class="text-center">วันที่แพ็กเกจหมดอายุ</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            $i = 1;
                            if ($datas->num_rows() > 0) {
                                foreach ($datas->result() as $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td class=""><?php echo $data->teams_name; ?></td>
                                        <td><?php echo $data->user_fullname; ?></td>
                                        <td class="text-center"><?php echo $this->misc->date2thai($data->teams_package_date, '%d %m %y', 1); ?></td>
                                        <td class="text-center"><?php echo $this->misc->date2thai($data->teams_package_expire, '%d %m %y', 1); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="4"><?php echo 'ไม่มีข้อมูล'; ?></td>
                                </tr>
                                <?php
                            }
                            ?>          
                        </tbody>
                    </table>
                </div>
                </div>                    
            </div>
        </div>                    
    </div>
</div>                    
