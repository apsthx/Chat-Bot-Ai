<div class="table-responsive" style="min-height: 30vh;">
    <table class="table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th class="text-center" width="10%">Avatar</th>
                <th width="15%">Username</th>
                <th width="20%">ชื่อ-สกุล</th>
                <th class="text-center" width="15%">สิทธิ์ผู้ใช้งาน</th>
                <th class="text-center" width="10%">สถานะ</th>
                <th class="text-center" width="15%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($datas->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($datas->result() as $data) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="text-center">
                            <img class="img-circle" src="<?php echo base_url() . 'assets/upload/admin/' . ($data->admin_image != '' ? $data->admin_image : 'none.png') ?>" width="32" height="32" />
                        </td>
                        <td><?php echo $data->admin_username; ?></td>
                        <td><?php echo $data->admin_fullname; ?></td>
                        <td class="text-center"><?php echo $data->role_name; ?></td>
                        <td class="text-center">
                            <?php echo ($data->user_status_id == 1 ? '<span class="label label-success"><i class="fa fa-check-circle"></i> ' . $data->user_status_name . '</span>' : '<span class="label label-danger"><i class="fa fa-times-circle"></i> ' . $data->user_status_name . '</span>'); ?>       
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modalEditModal('<?php echo $data->admin_id; ?>')"><i class="fa fa-edit"></i> แก้ไข</button>                           
                            <?php if ($data->user_status_id == 1) { ?>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modalEditstatus(<?php echo $data->admin_id; ?>)"><i class="fa fa-close"></i> ระงับ</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-sm btn-outline-success" onclick="modalEditchangestatus(<?php echo $data->admin_id; ?>)"><i class="fa fa-check"></i> ปกติ</button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="10"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
        <div class="col-sm-5">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-sm-7">
            <?php echo $links; ?>
        </div>
        <?php
    }
    ?>
</div>
