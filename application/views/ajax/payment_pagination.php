<div class="table-responsive" style="min-height: 50vh;">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="5%">#</th>
                <th width="8%">แพ็กเกจ</th>
                <th width="10%">โอนเข้าธนาคาร</th>
                <th width="15%">โอนโดย ร้าน/ชื่อ(โทร)</th>
                <th class="text-right" width="8%">จำนวนเงิน</th>
                <th class="text-center" width="20%">วันที่/เวลาโอน</th>
                <th class="text-center" width="8%">เลขที่อ้างอิง</th>
                <th class="text-center" width="8%">หลักฐาน</th>               
                <th class="text-center" width="6%">สถานะ</th>
                <th class="text-center" width="12%">วันที่แจ้งโอน</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($datas->num_rows() > 0) {
                $i = $segment + 1;
                foreach ($datas->result() AS $data) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $data->package_name; ?></td>
                        <td><i class="<?php echo $data->bank_icon; ?>"></i>&nbsp;<?php echo $data->bank_name; ?></td>
                        <td><?php echo $data->payment_by; ?></td>
                        <td class="text-right"><?php echo number_format($data->payment_cost, 2); ?></td>
                        <td class="text-center"><?php echo $this->misc->date2thai($data->payment_date, '%d %m %y', 1); ?> <?php echo $this->misc->date2thai($data->payment_time, '%h:%i'); ?></td>
                        <td class="text-center"><?php echo $data->payment_number; ?></td><td  class="text-center">
                            <?php
                            if ($data->payment_evidence != '') {
                                ?>
                                <a href="<?php echo base_url() . 'store/evidence/' . $data->payment_evidence; ?>" class="fancybox">
                                    <image src="<?php echo base_url() . 'store/evidence/' . $data->payment_evidence; ?>" class="img-responsive" style="width: 40px; height: 40px;"/>
                                </a>
                                <?php
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>                        
                        <?php if ($data->payment_status_id == 2) { ?>
                            <td class="text-center" id="status-<?php echo $data->payment_id; ?>">
                                <span class="label label-success">ผ่าน</span>
                            </td>

                        <?php } else if ($data->payment_status_id == 1) { ?>
                            <td  class="text-center" id="status-<?php echo $data->payment_id; ?>">
                                <span class="label label-inverse">รอตรวจ</span>
                            </td>

                        <?php } else { ?>
                            <td  class="text-center" id="status-<?php echo $data->payment_id; ?>">
                                <span class="label label-danger">ไม่ผ่าน</span>
                            </td>
                        <?php } ?>
                        <td class="text-center"><?php echo $this->misc->date2thai($data->payment_create, '%d %m %y %h:%i', 1); ?></td>
                    </tr> 
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="11"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
    $(document).ready(function () {
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });
</script>