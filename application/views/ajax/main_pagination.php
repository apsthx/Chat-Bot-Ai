<?php
if ($data->num_rows() > 0) {
    $i = $segment + 1;
    foreach ($data->result() as $row) {
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-12 m-t-10">
            <div class="card" style="min-height: 180px;">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title">
                            <?php
                            if ($row->agent_status_id == 1 && $row->agent_active_id == 1 && $row->agent_file != "") {
                                ?>
                                <a href="<?php echo base_url('intents/lists/' . $row->agent_id); ?>" target="_blank">
                                    <i class="fa fa-commenting"></i> <?php echo $row->agent_name; ?>
                                </a>
                                <?php
                            } else {
                                ?>
                                <i class="fa fa-commenting"></i> <?php echo $row->agent_name; ?>
                                <?php
                            }
                            ?>

                        </h4>
                        <div class="ml-auto">
                            <ul class="list-inline text-right">
                                <li>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-menu"></i> ตัวเลือก</button>
                                        <div class="dropdown-menu">
                                            <?php
                                            if ($row->agent_status_id == 1 && $row->agent_active_id == 1 && $row->agent_file != "") {
                                                ?>                                            
                                                <a class="dropdown-item" href="<?php echo base_url() . 'intents/lists/' . $row->agent_id; ?>"><i class="icon-speech"></i> จัดการ</a> 
                                                <a class="dropdown-item" href="<?php echo base_url() . 'main/setting/' . $row->agent_id; ?>"><i class="icon-settings"></i> ตั้งค่า</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="dropdown-item" onclick="notification('error', 'Error', 'เกิดข้อผิดพลาด')"><i class="icon-ban"></i> <?php echo $row->agent_status_name; ?></a>
                                                <a class="dropdown-item" onclick="notification('error', 'Error', 'เกิดข้อผิดพลาด')"><i class="icon-ban"></i> ตั้งค่า</a>
                                                <?php
                                            }
                                            if ($row->agent_status_id == 2) {
                                                ?>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="notification('error', 'Error', 'เกิดข้อผิดพลาด')"><i class="icon-ban"></i> แจ้งลบแล้ว</a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="dropdown-item" href="javascript:void(0)" onclick="modalDelete('<?php echo $row->agent_id; ?>')"><i class="icon-trash"></i> แจ้งลบ</a>
                                                <?php
                                            }
                                            ?>                                                                                       
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="card-subtitle text-muted"><?php echo $row->agent_description; ?></p>
                    <hr>
                    <?php if ($row->agent_fb_status_id == 1) { ?>
                        <?php if ($row->agent_fb_active_id == 1) { ?>
                            <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/> Facebook &nbsp;
                        <?php } else { ?>
                            <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-warning"><i class="fa fa-warning"></i> <?php echo 'รอเชื่อมต่อ'; ?></span> &nbsp;
                        <?php } ?>
                    <?php } else if ($row->agent_fb_status_id == 2) { ?>
                        <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-danger"><i class="fa fa-ban"></i> <?php echo 'ไม่เปิดใช้'; ?></span> &nbsp;
                    <?php } ?>

                    <?php if ($row->agent_line_status_id == 1) { ?>
                        <?php if ($row->agent_line_active_id == 1) { ?>
                            <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/> Line &nbsp;
                        <?php } else { ?>
                            <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-warning"><i class="fa fa-warning"></i> <?php echo 'รอเชื่อมต่อ'; ?></span> &nbsp;
                        <?php } ?>
                    <?php } else if ($row->agent_line_status_id == 2) { ?>
                        <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-danger"><i class="fa fa-ban"></i> <?php echo 'ไม่เปิดใช้'; ?></span> &nbsp;
                    <?php } ?>
                    | &nbsp;
                    <?php if ($row->agent_status_id == 1) { ?>
                        <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo $row->agent_status_name; ?></span>
                    <?php } else if ($row->agent_status_id == 2) { ?>
                        <span class="badge badge-danger"><i class="fa fa-times-circle-o"></i> <?php echo $row->agent_status_name; ?></span>
                    <?php } else { ?>
                        <span class="badge badge-info"><i class="fa fa-minus-circle"></i> <?php echo $row->agent_status_name; ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>        
        <?php
        $i++;
    }
}
?>
