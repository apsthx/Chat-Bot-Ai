<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="10%">#</th>
                <th width="25%">ผู้ใช้งาน</th>
                <th width="50%">รายการ</th>
                <th width="15%">เวลา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($data->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $row) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo ($row->user_fullname != NULL ? $row->user_fullname : '-'); ?></td>
                        <td><?php echo $row->log_text; ?></td>
                        <td><?php echo $this->misc->date2Thai($row->log_time, '%d %m %y, %h:%i:%s', true); ?></td>
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
        <div class="col-sm-4">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-sm-8">
            <?php echo $links; ?>
        </div>
        <?php
    }
    ?>
</div>