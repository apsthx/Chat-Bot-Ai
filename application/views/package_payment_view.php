<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-dropbox"></i>&nbsp;แจ้งโอนสั่งซื้อแพ็กเกจ
                    <span class="pull-right">
                        <a href="<?php echo base_url() . 'package'; ?>" class="btn btn-sm btn-rounded btn-info"><i class="fa fa-dropbox"></i> แพ็กเกจ</a>
                    </span>
                </h4>
                <br>

                <form class="form-horizontal" id="form_payment" method="post" action="<?php echo base_url() . 'package/addpayment'; ?>" autocomplete="off" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3"></div> 
                        <div class="col-sm-6">
                            <div class="form-group m-b-5">
                                <label class="control-label col-form-label"> โอนเข้าธนาคาร : <span class="text-danger">*</span></label>
                                <div class="demo-radio-button">
                                    <?php
                                    $banks = $this->package_model->getBank();
                                    if ($banks->num_rows() > 0) {
                                        $b = 1;
                                        foreach ($banks->result() as $bank) {
                                            ?>
                                            <input name="bank_id" type="radio" id="radio_<?php echo $b; ?>" value="<?php echo $bank->bank_id; ?>" class="with-gap radio-col-cyan" required="" />
                                            <label for="radio_<?php echo $b; ?>" class="m-b-10"><i class="<?php echo $bank->bank_icon; ?>"></i>&nbsp;<?php echo $bank->bank_name . ' ' . $bank->bank_branch . ' เลขที่บัญชี ' . $bank->bank_account_number . ' ชื่อบัญชี ' . $bank->bank_account_name; ?></label><br>
                                            <?php
                                            $b++;
                                        }
                                    }
                                    ?>

                                </div> 
                            </div> 
                            <div class="form-group m-b-5">
                                <label class="control-label col-form-label"> เลือกค่าบริการ : <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" value="<?php echo $package->package_name . ' / ' . number_format($package->package_cost, 0) . ' บาท ( ' . $package->package_agent . ' Agent, ' . $package->package_user . ' User )'; ?>" readonly="">
                                <input type="hidden" name="package_id" value="<?php echo $package_id; ?>" required="">                                
                            </div>
                            <div class="form-group m-b-5">
                                <?php
                                $user = $this->accesscontrol->getUserFull($this->session->userdata('user_id'));
                                ?>
                            </div>
                            <div class="form-group m-b-5">
                                <label class="control-label col-form-label"> โอนโดย ชื่อ(เบอร์โทร) : <span class="text-danger">*</span></label>
                                <input type="text" name="payment_by" id="payment_by" class="form-control form-control-sm" value="<?php echo $user->user_fullname . ' (' . $user->user_tel . ')'; ?>" required="">
                            </div> 
                            <div class="form-group m-b-5">
                                <label class="control-label col-form-label"> จำนวนเงิน : <span class="text-danger">*</span></label>
                                <input type="text" step="0.01" name="payment_cost" id="payment_cost" class="form-control form-control-sm" required="">
                            </div> 
                            <div class="form-group m-b-5">
                                <label class="control-label col-form-label"> วันที่โอน : <span class="text-danger">*</span></label>
                                <input type="text" id="payment_date" name="payment_date" class="form-control form-control-sm" placeholder="เลือกวันที่" value="" required="">
                            </div> 
                            <div class="form-group m-b-5">
                                <label class="control-label col-form-label"> เวลาที่โอน : <span class="text-danger">*</span></label>
                                <input type="text" name="payment_time" id="payment_time" class="form-control form-control-sm" placeholder="HH:mm" required=""  >
                            </div>                             
                            <div class="form-group">
                                <label class="control-label col-form-label"> หลักฐานการโอน : <span class="text-danger">*</span></label>
                                <label for="upload-image" class="btn btn-sm btn-inverse">
                                    <i class="fa fa-image"></i> อัฟโหลดหลักฐาน
                                    <input type="file" accept="image/*" name="payment_evidence" onchange="$('#text-image').html($('#upload-image').val());" id="upload-image" style="display: none" data-parsley-id="4" required="">
                                </label>
                                <div>
                                    <label class="col-md-3 control-label" id="text-image"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="btn-add-submit" class="btn btn-info btn-sm"><i class="fa fa-save"></i> บันทึกการแจ้งโอน</button>
                                <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> ยกเลิก</button>
                            </div>
                        </div>
                    </div>                    
                </form> 

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#form_payment').parsley();
        $('#payment_date').datepicker({
            language: 'th-th',
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

</script>