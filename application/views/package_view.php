<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-dropbox"></i> <?php echo " อัตราค่าแพ็กเกจ"; ?></h4>

                <div class="row pricing-plan">
                    <?php
                    if ($datas->num_rows() > 0) {
                        $i = 1;
                        foreach ($datas->result() as $row) {
                            ?>
                            <div class="col-sm-2 no-padding">
                                <div class="pricing-box">
                                    <div class="pricing-body b-l">
                                        <div class="pricing-header">
                                            <?php
                                            if ($i == 3) {
                                                ?>
                                                <h5 class="price-lable text-white bg-warning"><i class="fa fa-fire"></i> ขายดี</h5>
                                                <?php
                                            }
                                            ?>
                                            <h5 class="text-center"><?php echo $row->package_name; ?></h5>
                                            <h3 class="text-center" style="font-size:24px;"><span class="price-sign">฿</span><?php echo number_format($row->package_cost, 0); ?></h3>
                                            <p class="uppercase">ราคา (บาท)</p>
                                        </div>
                                        <div class="price-table-content">
                                            <div class="price-row"><i class="fa fa-android"></i> จำนวน <?php echo $row->package_agent; ?> Agent</div>
                                            <div class="price-row"><i class="fa fa-user-o"></i> ผู้ใช้งาน <?php echo $row->package_user; ?> User</div>
                                            <div class="price-row"><i class="fa fa-calendar"></i> เวลา <?php echo $row->package_date; ?> วัน</div>
                                            <div class="price-row">
                                                <?php if ($i == 1) { ?>
                                                    <a class="btn btn-light btn-rounded m-t-20" href="javascript:void(0)">Free</a>
                                                <?php } else { ?>
                                                    <a class="btn btn-info btn-rounded m-t-20" href="<?php echo base_url() . 'package/payment/' . $row->package_id; ?>">สั่งซื้อ</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>                   
                </div>

            </div>
        </div>
    </div>
</div>
