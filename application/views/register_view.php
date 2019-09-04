
<div class="login-box card" style="margin-top: 20px;overflow-y:visible;">
    <div class="card-body">
        <form class="form-horizontal form-material" id="form-register" method="post" action="<?php echo base_url() . 'register/add'; ?>" autocomplete="off">
            <div class="text-center m-b-15" style="font-size: 40px;"><i class="fa fa-user-circle-o"></i></div>
            <h3 class="box-title text-center">สมัครสมาชิก</h3>
            <h3 class="box-title text-center"><?php echo $this->config->item('app_name'); ?></h3>

            <div class="text-center" id="flash_message">
                <?php
                if ($this->session->flashdata('flash_message') != '') {
                    ?>
                    <?php
                    echo $this->session->flashdata('flash_message');
                    ?>
                    <br>
                    <?php
                }
                ?>                                 
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="username" id="username" required="" placeholder="Username" > 
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="password" name="password" id="password"  required="" placeholder="Password" autocomplete="new-password"> 
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="password" name="password_confirm" id="password_confirm"   required="" placeholder="Confirm Password"> 
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="team" id="team" required="" placeholder="ชื่อทีม" > 
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="fullname" id="fullname" required=""  placeholder="ชื่อ นามสกุล"> 
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="email" name="email" id="email" required=""  placeholder="Email"> 
                </div>
            </div>
            <div class="form-group m-b-15">
                <div class="col-xs-12">
                    <input type="text" name="telcheck" id="telcheck" class="form-control" onkeypress="return isNumberKey(event)" placeholder="เบอร์โทร" required onblur="check_phone_format(this);">
                    <input type="hidden" id="refotp" class="form-control form-control-sm">
                    <input type="hidden" name="otp" id="otp" class="form-control form-control-sm">
                </div>
            </div>
            <div class="form-group m-b-15">
                <div class="col-xs-12">
                    <div class="checkbox checkbox-primary p-t-0">
                        <input type="checkbox" name="accept" id="accept" class="filled-in chk-col-blue" disabled="" onchange="
                                if ($(this).is(':checked')) {
                                    $('#bt-submit').prop('disabled', false);
                                } else {
                                    $('#bt-submit').prop('disabled', true);
                                }
                               " data-parsley-multiple="accept" data-parsley-id="18">
                        <label for="accept"> &nbsp;ยอมรับเงื่อนไขการสมัคร <a href="javascript:void(0);" onclick="modal_accept();">อ่านข้อตกลง</a></label>
                    </div>
                </div>
            </div>
            <div class="form-group text-center m-t-10">
                <div class="col-xs-12">
                    <button type="button" id="bt-submit" disabled="" onclick="check();" class="btn btn-primary btn-rounded"><i class="fa fa-user-circle-o"></i> สมัครสมาชิก</button>
                    <button type="reset" class="btn btn-default btn-rounded"><i class="fa fa-refresh"></i> ล้างข้อมูล</button>
                </div>
            </div>
        </form>
        <hr>
        <div class="col-xs-12 text-center">
            <a style="margin-top: 10px;font-weight: bold;" href="<?php echo base_url() . 'login'; ?>"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</a>              
        </div>
    </div>
    <div class="card-footer">                
        <p class="text-center"><?php echo $this->config->item('app_footer'); ?></p>                       
    </div>    
</div>
</div>
</section>

<div id="for_modal"></div>

<div class="modal fade" id="modal_accept">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: whitesmoke;">
                <h4 class="modal-title" style="font-weight: bold;">
                    <i class="fa fa-handshake-o"></i> ข้อตกลงและเงื่อนไขการใช้งาน
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body">
                    <p>
                        <span style="font-weight: bold;">การสมัครใช้งาน / การใช้งาน</span><br/>
                        &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่จะใช้บริการต้องมีอายุ 18 ปี บริบูรณ์ขึ้นไป<br/>
                        &nbsp;&nbsp;&nbsp;• ผู้ใช้งานจะต้องไม่ทำการคัดลอกเนื้อหา, ดัดแปลงแก้ไข หรือนำไปจำหน่ายต่อบุคคลอื่น<br/>
                        &nbsp;&nbsp;&nbsp;• ผู้ใช้งานจะต้องรับผิดชอบดูแล username และรหัสผ่าน เพื่อความปลอดภัยของระบบ<br/>
                        &nbsp;&nbsp;&nbsp;• ผู้ใช้งานยอมรับให้บริษัทฯ สามารถแก้ไขรายการข้อมูลที่ส่งเข้าระบบได้<br/>
                        &nbsp;&nbsp;&nbsp;• ผู้ใช้งานจะไม่ทำการหรือพยายามเจาะระบบข้อมูล หรือเขียนรหัสที่เป็นภัยต่อระบบการทำงานของคอมพิวเตอร์<br/>
                        &nbsp;&nbsp;&nbsp;• หจก. เอพีเอส ทีเอช ไม่รับประกันว่าระบบ AI-APS Chatbot Manager จะไม่ขาดช่วง, หยุดซ่อมบำรุง, หรือปราศจากข้อผิดพลาด<br/>
                        &nbsp;&nbsp;&nbsp;• บริษัทฯ จะไม่รับผิดชอบต่อการสูญหายของข้อมูล ไม่ว่าในกรณีใดๆ ก็ตาม<br/>
                        &nbsp;&nbsp;&nbsp;• บริษัทฯ สงวนสิทธิ์ในการลบ Account ของผู้ใช้งานบางรายที่ทำผิดกฎ หรือละเมิดสิทธิ์ทางปัญญา หรือทำให้เสียชื่อเสียง โดยไม่ต้องแจ้งล่วงหน้าให้ทราบ<p></p>
                    <span style="font-weight: bold;">นโยบายความเป็นส่วนตัว</span><br/>
                    &nbsp;&nbsp;&nbsp;• AI-APS Chatbot Manager มีการปรับปรุงเนื้อหา, และทำการพัฒนาระบบอย่างต่อเนื่อง โดยทางบริษัทฯ จะมีการเก็บข้อมูล IP Address เวลา และสถานที่ในการเข้าใช้งาน รวมถึงข้อมูลอื่นๆ รวมถึงการเก็บข้อมูลผ่านระบบ Google Analytic.<br/>
                    &nbsp;&nbsp;&nbsp;• หจก. เอพีเอส ทีเอช จะมีการใช้ Cookie เพื่อเก็บข้อมูลและแลกเปลี่ยนข้อมูล เพื่อให้สามารถใช้งาน AI-APS Chatbot Manager ได้<br/>
                    &nbsp;&nbsp;&nbsp;• ผู้ใช้งานยอมรับที่จะได้การแจ้งเตือนต่าง ผ่านทางโทรศัพท์, อีเมล์ หรือ sms และทางจดหมาย<br/>
                    &nbsp;&nbsp;&nbsp;• ในการกรณี บริษัทฯได้ทำการส่งข่าวสารถึงผู้ใช้งาน ไม่ว่าจะผ่านช่องทางใดก็ตาม หากไม่ได้รับการตอบกลับจากผู้ใช้งาน หรือ ต่อต่อกลับมาภายใน 5 วัน ทางเราจะถือว่าผู้ใช้งานได้รับทราบและยอมรับข่าวสารนั้น<p></p>
                    <span style="font-weight: bold;">การซื้อแพ็คเกจ</span><br/>
                    &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่สมัครใหม่จะได้ทดลองใช้งานฟรี ตามจำนวนวันที่บริษัทฯกำหนดให้ ก่อนการตัดสินใจใช้งานจริง โดยไม่สามารถเพื่มจำนวนวันได้อีก<br/>
                    &nbsp;&nbsp;&nbsp;• การชำระเงินจะเป็นการชำระเงินก่อนใช้งาน และเมื่อผู้ประกอบการชำระเงินตามจำนวนที่ต้องการแล้ว บริษัทฯ จะเพิ่มวันตามจำนวนเงินที่โอนโดยทาง บริษัทฯ จะไม่เปลี่ยนแปลงภายหลังจนกว่าจะหมดอายุ<br/>
                    &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่เคยสมัครแล้วจะไม่ได้รับโปรโมชั่นใหม่ที่ออกมาหลังจากวันที่สมัคร<br/>
                    &nbsp;&nbsp;&nbsp;• ผู้ใช้งานที่เคยสมัครแล้วจะไม่สามารถสมัครซํ้าได้อีก หรือ ไม่สามารถเปลี่ยนชื่อ username เพื่อรับการทดลองฟรี-โปรโมชั่นอื่นๆ<p></p>
                    <span style="font-weight: bold;">การคืนเงิน/การเปลี่ยนแปลงบริการ</span><br/>
                    &nbsp;&nbsp;&nbsp;• บริษัทฯ ไม่มีนโยบายในการคืนเงิน สำหรับค่าแพ็คเก็จที่ไดซื้อไปแล้ว<br/>
                    &nbsp;&nbsp;&nbsp;• บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงราคาโดยไม่ต้องแจ้งให้ทราบล่วงหน้า<br/>
                    &nbsp;&nbsp;&nbsp;• ในกรณีเปลี่ยนแปลงค่าบริการ จะมีการแจ้งเตือนให้ผู้ใช้งาน (ลูกค้าเก่า) ทราบล่วงหน้า 30 วันทุกครั้ง และ สำหรับผู้ใช้งานที่ซื้อแพ็คเก็จระยะยาวจะไม่มีผลกระทบกับจำนวนวันที่ได้ซื้อก่อนหน้านี้
                    </p>                           
                </div>                    
            </div>
            <div class="modal-footer" style="background: whitesmoke;">
                <div class="col-sm-12 text-center">
                    <button type="button" onclick="accept_confirm();" class="btn btn-info btn-rounded"><i class="fa fa-check"></i>&nbsp;ยอมรับข้อตกลง</button>
                    <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ปิด</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var otp = '';
    $(function () {
        $(".preloader").fadeOut();
        $('#form-register').parsley();
    });

    $('#flash_message').delay(7000).fadeOut(3000);

    function accept_confirm() {
        $('#accept').prop('checked', true);
        $('#bt-submit').prop('disabled', false);
        $("#modal_accept").modal('hide');
    }

    function check() {
        var form = $("#form-register");
        form.parsley().validate();
        if (form.parsley().isValid() == true) {
            var telcheck = $('#telcheck').val();
            var refotp = makerefotp();
            $('#refotp').val(refotp);
            $.ajax({
                url: service_base_url + 'register/modalsendsms',
                type: 'post',
                data: {
                    telcheck: telcheck,
                    refotp: refotp,
                    username: $('#username').val(),
                    password: $('#password').val(),
                    password_confirm: $('#password_confirm').val(),
                    email: $('#email').val()
                },
                success: function (response) {
                    if (response == 0) {
                        $('#flash_message').delay(5000).fadeOut(1000);
                        location.reload();
                    } else if (response == 1) {
                        swal({
                            title: "เบอร์โทรนี้ถูกใช้ไปแล้ว",
                            text: "กรุณาระบุเบอร์โทรใหม่",
                            type: "warning",
                            confirmButtonColor: "#efbf87",
                            confirmButtonText: "ตกลง",
                            closeOnConfirm: false
                        });
                        $('#telcheck').val('');
                        setTimeout(function () {
                            $('#telcheck').focus();
                        }, 2000);
                    } else {
                        $('#for_modal').html(response);
                        $("#on_modal").modal('show', {backdrop: 'static'});
                        $.ajax({
                            url: service_base_url + 'sms/sendsmsotp',
                            type: 'post',
                            data: {
                                refotp: refotp
                            },
                            success: function (res) {
                                if (res == 0) {
                                    swal({
                                        title: "เกิดข้อผิดผลาดในการส่ง SMS",
                                        type: "error",
                                        confirmButtonColor: "#e98382",
                                        confirmButtonText: "ตกลง",
                                        closeOnConfirm: false
                                    }, function (isConfirm) {
                                        if (isConfirm) {
                                            $('#on_modal').modal('hide');
                                            swal({
                                                title: "อาจไม่มีเบอร์โทรที่ระบุ ",
                                                text: "หรือ ระบบการส่งผิดผลาด",
                                                type: "warning",
                                                timer: 2000,
                                                showConfirmButton: false
                                            });
                                        }
                                    });
                                }
                            }
                        });
                    }
                }
            });
        }
        return false;
    }

    function makerefotp() {
        var text = "";
        var possible = "123456789";
        for (var i = 0; i < 4; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));
        return text;
    }

    function againOTP() {
        $('#on_modal').modal('toggle');
        check();
    }

    function confirmOTP() {
        $('#on_modal').modal('toggle');
        $.ajax({
            url: service_base_url + 'register/checkconfirm',
            type: 'post',
            data: {
                telcheck: $('#telcheck').val(),
                checkotp: $('#checkotp').val()
            },
            success: function (res) {
                console.log(res);
                if (res === '1') {
                    $('#otp').val($('#checkotp').val());
                    $('#form-register').submit();
                } else if (res === '2') {
                    swal({
                        title: "เกิดข้อผิดพลาด",
                        text: "เบอร์โทรถูกแก้ไข!",
                        type: "warning",
                        confirmButtonColor: "#efbf87",
                        confirmButtonText: "ตกลง",
                        closeOnConfirm: false
                    });
                } else {
                    swal({
                        title: "รหัส OTP ไม่ผ่าน",
                        text: "กรุณากดบันทึกเพื่อยืนยัน รหัส OTP ใหม่",
                        type: "warning",
                        confirmButtonColor: "#efbf87",
                        confirmButtonText: "ตกลง",
                        closeOnConfirm: false
                    });
                }
            }
        });
    }

    function modal_accept() {
        $("#modal_accept").modal('show', {backdrop: 'static'});
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 48 || charCode > 57) && charCode != 43) {
            return false;
        }
        return true;
    }

</script>
