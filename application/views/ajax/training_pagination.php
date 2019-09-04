<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="5%">#</th>
                <th width="15%">Agent</th>
                <th width="5%">from</th>
                <th >User say</th>
                <th class="text-center" width="10%">Requests</th>
                <th width="15%">วันที่ล่าสุด</th>
                <th width="5%">Training</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count_data = $datas->num_rows();
            if ($count_data > 0) {
                $i = $segment + 1;
                foreach ($datas->result() as $row) {
                    $data = json_decode($row->hook_text);
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $row->agent_name; ?></td>
                        <td>
                            <?php if ($row->hook_platforms == 'line') { ?>
                                <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" style="width: 25px;">
                            <?php } else if ($row->hook_platforms == 'facebook') { ?>
                                <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" style="width: 25px;">
                            <?php } else { ?>
                                <img src="<?php echo base_url() . 'assets/img/logo-icon.png'; ?>" style="width: 25px;">
                            <?php }
                            ?>
                        </td>
                        <td><?php echo $row->training_text; ?></td>
                        <td class="text-center"><?php echo number_format($this->training_model->count_training($row->training_text,$row->training_status)->requests, 0); ?></td>
                        <td ><?php echo $this->misc->date2thai($row->hook_modify, '%d %m %y %h:%i', 1); ?></td>
                        <td class="text-center">
                            <?php if ($row->training_status == 1) { ?>
                                <button class="btn btn-outline-success btn-sm" onclick="modal_training('<?php echo $row->training_id; ?>');"><i class="fa fa-plus-circle"></i></button>
                            <?php } else { ?>
                                <button class="btn btn-success btn-sm" disabled=""><i class="fa fa-check"></i></button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="8"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
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