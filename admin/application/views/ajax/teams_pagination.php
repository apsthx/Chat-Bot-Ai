<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th width="4%">#</th>
                <th width="6%">รหัสทีม</th>
                <th >ชื่อทีม</th>
                <th >หัวหน้าทีม</th>                
                <th width="10%">เบอร์โทรติดต่อ</th>
                <th >แพ็กเกจ</th>
                <th class="text-right">ใช้งานได้อีก</th>
                <th class="text-center" width="5%">สถานะ</th>
                <th class="text-center" width="27%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($data->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $row) {
                    $users = $this->teams_model->getuser($row->teams_id, 1);
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->teams_code; ?></td>
                        <td><?php echo $row->teams_name; ?></td>   
                        <?php
                        if ($users->num_rows() == 1) {
                            $user = $users->row();
                            ?>
                            <td><?php echo $user->user_fullname; ?></td>
                            <td><?php echo $user->user_tel; ?></td>
                            <?php
                        } else {
                            ?>
                            <td>-</td>
                            <td>-</td>
                            <?php
                        }
                        ?>
                        <td><?php echo ($row->package_id != null || $row->package_id != '') ? $this->teams_model->getpackage($row->package_id)->row()->package_name : ''; ?></td>   
                        <?php
                        if (date('Y-m-d') > $row->teams_package_expire) {
                            $expire = '<span class="text-danger">หมดอายุ</span>';
                        } else {
                            $datediff = date_diff(date_create(date('Y-m-d')), date_create($row->teams_package_expire))->days;
                            $expire = $datediff;
                            if ($expire <= 7) {
                                $expire = '<span class="text-primary">'.$expire.' วัน</span>';
                            } else {
                                $expire = $expire . ' วัน';
                            }
                        }
                        ?>
                        <td class="text-right"><?php echo $expire; ?></td>

                        <td class="text-center">
                            <?php if ($row->teams_status_id == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo 'ปกติ'; ?></span>
                            <?php } else if ($row->teams_status_id == 2) { ?>
                                <span class="badge badge-danger"><i class="fa fa-times-circle-o"></i> <?php echo 'ถูกระงับ'; ?></span>
                            <?php } ?>
                        </td>
                        <td class="text-center">  

                            <a class="btn btn-xs btn-outline-primary" href="<?php echo base_url() . 'teams/detail/' . $row->teams_id; ?>" target="_blank"><i class="fa fa-user-circle"></i> ผู้ใช้งานในทีม</a>
                            <a class="btn btn-xs btn-outline-info" href="javascript:void(0)" onclick="modalEdit('<?php echo $row->teams_id; ?>');"><i class="fa fa-gift"></i>  อัพเดททีม</a>
                            <?php
                            if ($row->teams_id == 1) {
                                ?>
                                <a class="btn btn-xs btn-outline-dark" class="dropdown-item small" href="javascript:void(0)"><i class="fa fa-minus-circle"></i> ระงับใช้งานไม่ได้</a>
                                <?php
                            } else {
                                if ($row->teams_status_id == 1) {
                                    ?>
                                    <a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" onclick="modalEditstatus(<?php echo $row->teams_id; ?>)"><i class="fa fa-close"></i> ระงับการใช้งาน</a>
                                    <?php
                                } else {
                                    ?>
                                    <a class="btn btn-xs btn-outline-success" href="javascript:void(0)" onclick="modalEditchangestatus(<?php echo $row->teams_id; ?>)"><i class="fa fa-check"></i> เปิดใช้งานปกติ</a>
                                    <?php
                                }
                            }
                            ?>

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