<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-envelope-o"></i> ตั้งค่าอีเมล</h4>  
                <form class="form-horizontal" id="formedit1" method="post" action="<?php echo base_url() . 'setting/editemail'; ?>" autocomplete="off">
                    <?php $data = $this->setting_model->get_setting(); ?>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label> อีเมลที่ส่งจากที่อยู่ : <span class="text-danger">*</span></label>
                            <input type="text" name="from_email" value="<?php echo $data->from_email; ?>" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>
                        <div class="form-group col-sm-4">
                            <label> ชื่อแสดง : <span class="text-danger">*</span></label>
                            <input type="text" name="from_name" value="<?php echo $data->from_name; ?>" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 

                        <div class="form-group col-sm-4">
                            <label> SMTP Host : <span class="text-danger">*</span></label>
                            <input type="text" name="smtp_host" value="<?php echo $data->smtp_host; ?>" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label> SMTP Port : <span class="text-danger">*</span></label>
                            <input type="text" name="smtp_port" value="<?php echo $data->smtp_port; ?>" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                        <div class="form-group col-sm-4">
                            <label> SMTP User : <span class="text-danger">*</span></label>
                            <input type="text" name="smtp_user" value="<?php echo $data->smtp_user; ?>" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>

                        <div class="form-group col-sm-4">
                            <label> SMPT Password : <span class="text-danger">*</span></label>
                            <input type="password" name="smtp_password" value="<?php echo $data->smtp_password; ?>" autocomplete="new-password" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                    </div> 
                    <br/>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                            <button type="reset" class="btn btn-sm btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </form>

                <hr class="m-t-40">

                <h4 class="card-title"><i class="fa fa-comment-o"></i> ตั้งค่า SMS</h4>  
                <form class="form-horizontal" id="formedit2" method="post" action="<?php echo base_url() . 'setting/editsms'; ?>" autocomplete="off">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label> เบอร์ที่ใช้ส่ง : <span class="text-danger">*</span></label>
                            <input type="text" name="sms_tel" value="<?php echo $data->sms_tel; ?>" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                        <div class="form-group col-sm-4">
                            <label> SMS User : <span class="text-danger">*</span></label>
                            <input type="text" name="sms_username" value="<?php echo $data->sms_username; ?>" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div>

                        <div class="form-group col-sm-4">
                            <label> SMS Password : <span class="text-danger">*</span></label>
                            <input type="password" name="sms_password" value="<?php echo $data->sms_password; ?>" autocomplete="new-password" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required="">
                        </div> 
                    </div> 
                    <br/>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                            <button type="reset" class="btn btn-sm btn-outline-danger" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                        </div>
                    </div>
                </form>

                <hr class="m-t-40">

                <div class="row">
                    <div class="col-md-4 m-t-20 m-b-40">
                        <?php if (($data->line_token != "") || ($data->line_token != null)) { ?>
                            <button type="button"  onclick="cancel_line();" class="btn btn-block text-white" style="font-size: 12pt;">
                                <img src="<?php echo base_url() . "assets/img/line.png"; ?>" width="40" height="40"/>
                                ยกเลิกการเชื่อมต่อ LINE
                            </button>
                        <?php } else { ?>
                            <button type="button"  onclick="regis_line();" class="btn btn-block text-white" style="background-color:#00C200;font-size: 12pt;">
                                <img src="<?php echo base_url() . "assets/img/line.png"; ?>" width="40" height="40"/> 
                                การเชื่อมต่อ LINE
                            </button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#formedit1').parsley();
        $('#formedit2').parsley();
    });

    function regis_line() {
        window.location = 'https://notify-bot.line.me/oauth/authorize?response_type=code&client_id=<?php echo $this->config->item('line_id'); ?>&redirect_uri=<?php echo base_url() . 'setting/line&scope=notify&state=1&bot_prompt=aggressive'; ?>';
    }

    function cancel_line() {
        swal({
            title: "ยืนยันยกเลิกการเชื่อมต่อ LINE",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "ตกลง",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        url: service_base_url + 'setting/cancel',
                        type: 'POST',
                        data: {},
                        success: function (response) {
                            if (response == 1) {
                                location.reload();
                            }
                        }
                    });
                });
    }

</script>