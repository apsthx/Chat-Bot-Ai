<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>ชื่อ Agent</th>
                <th>ชื่อทีม ( รหัสทีม )</th>
                <th>ประเภท</th>
                <th class="text-center" width="8%">ตรวจสอบ</th>
                <th class="text-center" width="8%">ขอใช้งาน</th>
                <th class="text-center" width="5%">FB</th>
                <th class="text-center" width="8%">ขอใช้งาน</th>
                <th class="text-center" width="5%">Line</th>
                <th class="text-center" width="8%">สถานะ</th>
                <th class="text-center" width="10%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($data->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->agent_name; ?></td>
                        <td><?php echo $row->teams_name . ' ( ' . $row->teams_code . ' )'; ?></td>
                        <td><?php echo $row->agent_type_name; ?></td>
                        <td class="text-center">
                            <?php if ($row->agent_active_id == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo 'สำเร็จ'; ?></span>
                            <?php } else if ($row->agent_active_id == 2) { ?>
                                <span class="badge badge-danger"><i class="fa fa-times"></i> <?php echo 'ไม่สำเร็จ'; ?></span>
                            <?php } else { ?>
                                <span class="badge badge-warning"><i class="fa fa-warning"></i> <?php echo 'รอตรวจ'; ?></span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if ($row->agent_fb_status_id == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo 'เปิดใช้งาน'; ?></span>
                            <?php } else if ($row->agent_fb_status_id == 2) { ?>
                                <span class="badge badge-danger"><i class="fa fa-ban"></i> <?php echo 'ปิดใช้งาน'; ?></span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <div class="switch text-center">
                                <label>
                                    <input type="checkbox" onchange="switchfb('<?php echo $row->agent_id; ?>', this);" id="checkbox_fb<?php echo $row->agent_id; ?>" <?php echo ($row->agent_fb_active_id == 0 ? '' : 'checked'); ?>><span class="lever switch-col-light-blue"></span>
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php if ($row->agent_line_status_id == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo 'เปิดใช้งาน'; ?></span>
                            <?php } else if ($row->agent_line_status_id == 2) { ?>
                                <span class="badge badge-danger"><i class="fa fa-ban"></i> <?php echo 'ปิดใช้งาน'; ?></span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <div class="switch text-center">
                                <label>
                                    <input type="checkbox" onchange="switchline('<?php echo $row->agent_id; ?>', this);" id="checkbox_line<?php echo $row->agent_id; ?>" <?php echo ($row->agent_line_active_id == 0 ? '' : 'checked'); ?>><span class="lever switch-col-light-green"></span>
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <?php if ($row->agent_status_id == 0) { ?>
                                <span class="badge badge-info"><i class="fa fa-minus-circle"></i> <?php echo $row->agent_status_name; ?></span>
                            <?php } else if ($row->agent_status_id == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo $row->agent_status_name; ?></span>
                            <?php } else if ($row->agent_status_id == 2) { ?>
                                <span class="badge badge-info"><i class="fa fa-minus-circle"></i> <?php echo $row->agent_status_name; ?></span>
                            <?php } else { ?>
                                <span class="badge badge-danger"><i class="fa fa-trash-o"></i> <?php echo $row->agent_status_name; ?></span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-outline-warning" onclick="checkactive('<?php echo $row->agent_id; ?>');" data-toggle="tooltip" title="ตรวจสอบ"><i class="fa fa-refresh"></i></button>
                            <a class="btn btn-xs btn-outline-info" href="javascript:void(0);" onclick="modalEdit('<?php echo $row->agent_id; ?>');" data-toggle="tooltip" title="แก้ไข"><i class="fa fa-edit"></i></a>
                            <?php
                            if ($row->agent_status_id != 3) {
                                ?>
                                <a class="btn btn-xs btn-outline-danger" href="javascript:void(0);" onclick="modalEditstatus(<?php echo $row->agent_id; ?>)" data-toggle="tooltip" title="ลบข้อมูล"><i class="fa fa-close"></i></a>
                                <?php
                            } else {
                                ?>
                                <a class="btn btn-xs btn-outline-secondary" href="javascript:void(0)" data-toggle="tooltip" title="ลบแล้ว"><i class="fa fa-minus-circle"></i></a>
                                <?php
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
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
