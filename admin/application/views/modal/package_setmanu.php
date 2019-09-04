<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-tags"></i>&nbsp;กำหนดสิทธิ์การใช้เมนู - <b><?php echo $this->package_model->getShoppackage($package_id)->row()->package_name; ?></b></h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th class="text-center">กลุ่มเมนู</th>  
                    <th class="text-center">เมนู</th> 
                    <th class="text-center" width="20%">สถานะ</th>
                    <th class="text-center" width="20%">จัดการสิทธิ์</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                $datas = $this->package_model->get_menu();
                if ($datas->num_rows() > 0) {
                    $i = 1;
                    foreach ($datas->result() as $data) {
                        ?>
                        <tr>
                            <td class="text-right"><?php echo $i; ?></td>
                            <td><?php echo $data->group_menu_name_th; ?></td>
                            <td><?php echo $data->menu_name_th; ?></td>
                            <?php
                            $check_stetus_package = $this->package_model->check_StetusPackage($package_id, $data->menu_id);
                            if ($check_stetus_package == 0) {
                                ?>
                                <td class="text-center" id="<?php echo 'package_show_checkbock' . $data->menu_id; ?>" >
                                    <span class="badge badge-warning" ><i class="fa fa-times-circle"></i>&nbsp;ไม่จำกัด</span>
                                </td>
                            <?php } else {
                                ?>
                                <td class="text-center" id="<?php echo 'package_show_checkbock' . $data->menu_id; ?>" >
                                    <span class="badge badge-success" ><i class="fa fa-check-circle"></i>&nbsp;จำกัด</span>
                                </td>
                            <?php } ?>
                            <td>
                                <div class="switch text-center">
                                    <label>
                                        <input type="checkbox" onchange="switchRole('<?php echo $package_id; ?>', '<?php echo $data->menu_id; ?>', this);" id="checkbox_<?php echo $data->menu_id; ?>" <?php echo ($check_stetus_package == 0 ? '' : 'checked'); ?>><span class="lever"></span>
                                    </label>
                                </div>
                            </td>
                            <?php
                            $i++;
                        }
                    } else {
                        ?>
                    <tr>
                        <td class="text-center" colspan="10">ไม่มีข้อมูล</td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>                    
</div>
<div class="modal-footer">
    <button class="btn btn-info" onclick="location.reload();"><i class="fa fa-refresh"></i>&nbsp;รีโหลด</button>
    <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;ปิด</button>
</div>
