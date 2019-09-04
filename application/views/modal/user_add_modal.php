<form id="form-modal" method="post" action="<?php echo base_url('user/add_user'); ?>" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> เพิ่มผู้ใช้งาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img id="user_image_preview" src="<?php echo base_url() . 'assets/upload/user/none.png'; ?>" style="max-height: 170px; border-radius: 3px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label class="control-label">สิทธิ์ผู้ใช้งานระบบ </label>
                <input type="text" class="form-control form-control-sm" value="ผู้ร่วมทีม Agent" readonly="">               
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">Username <span class="text-danger">*</span></label>
                <input type="text" name="username" id="username" class="form-control form-control-sm" onblur="check_username()" autocomplete="new-username" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control form-control-sm" value="" autocomplete="new-password" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                <input type="text" name="user_fullname" class="form-control form-control-sm" value="" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">อีเมล <span class="text-danger">*</span></label>
                <input type="email" name="user_email" id="user_email" class="form-control form-control-sm" onblur="check_email()" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">เบอร์โทร <span class="text-danger">*</span></label>
                <input type="text" name="user_tel" id="user_tel" class="form-control form-control-sm" onblur="check_tel()" onkeypress="return isNumberKey(event)" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ที่อยู่</label>
                <textarea name="user_address" class="form-control form-control-sm" rows="2"></textarea>
            </div>
            <div class="col-lg-6">
                <label class="control-label">เพิ่มเติม</label>
                <textarea name="user_comment" class="form-control form-control-sm" rows="2"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-add-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode < 48 || charCode > 57) {
            return false;
        }
        return true;
    }

    function check_username() {
        $.ajax({
            url: service_base_url + 'user/check_username',
            type: 'POST',
            data: {
                username: $('#username').val()
            },
            success: function (response) {
                if (response == '1') {
                    $('#btn-add-submit').prop('disabled', true);
                    notification('error', 'เกิดข้อผิดพลาด', 'Username นี้มีผู้ใช้งานอยู่เเล้ว');
                } else {
                    $('#btn-add-submit').prop('disabled', false);
                }
            }
        });
    }

    function check_email() {
        $.ajax({
            url: service_base_url + 'user/check_email',
            type: 'POST',
            data: {
                email: $('#user_email').val()
            },
            success: function (response) {
                if (response == '1') {
                    $('#btn-add-submit').prop('disabled', true);
                    notification('error', 'เกิดข้อผิดพลาด', 'Email นี้มีผู้ใช้งานอยู่เเล้ว');
                } else {
                    $('#btn-add-submit').prop('disabled', false);
                }
            }
        });
    }

    function check_tel() {
        $.ajax({
            url: service_base_url + 'user/check_tel',
            type: 'POST',
            data: {
                tel: $('#user_tel').val()
            },
            success: function (response) {
                if (response == '1') {
                    $('#btn-add-submit').prop('disabled', true);
                    notification('error', 'เกิดข้อผิดพลาด', 'เบอร์โทรนี้มีผู้ใช้งานอยู่เเล้ว');
                } else {
                    $('#btn-add-submit').prop('disabled', false);
                }
            }
        });
    }
</script>