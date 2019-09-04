<div class="table-responsive" style="min-height: 30vh;">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="10%">#</th>
                <th width="15%">Facebook Name</th>
                <th class="text-center" width="15%">Facebook App ID</th>                    
                <th class="text-center" width="10%">สถานะ</th>
                <th width="20%">ChatBot ใช้งาน</th>     
                <th class="text-center" width="10%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count_data = $data->num_rows();
            if ($count_data > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $row) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $row->app_facebook_name; ?></td>
                        <td class="text-center"><?php echo $row->app_facebook_id; ?></td>                   
                        <td class="text-center">
                            <?php if ($row->app_facebook_use == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check"></i> ใช้งาน</span>
                            <?php } else { ?>
                                <span class="badge badge-secondary"><i class="fa fa-info-circle"></i> ว่าง</span>
                            <?php } ?>
                        </td>
                        <td><?php echo ($row->agent_fb_app != '' ? $row->agent_name : '-'); ?></td>     
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ตัวเลือก</button>
                                <div class="dropdown-menu">
                                    <button type="button" class="dropdown-item small" onclick="modal_edit('<?php echo $row->app_facebook_id_pri; ?>')"><i class="fa fa-edit"></i> แก้ไข</button>                                    
                                    <button type="button" class="dropdown-item small" onclick="modal_edit_status('<?php echo $row->app_facebook_id_pri; ?>')"><i class="fa fa-refresh"></i> เปลี่ยนสถานะ</button>
                                    <!--<button type="button" class="dropdown-item small" onclick="modal_edit_status('<?php echo $row->app_facebook_id_pri; ?>', '3')"><i class="fa fa-trash-o"></i> ลบ</button>                                        -->
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="10"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="row m-t-20">
    <?php
    if ($count != 0) {
        ?>
        <div class="col-lg-6">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-lg-6">
            <?php echo $links; ?>
        </div>
        <?php
    }
    ?>
</div>