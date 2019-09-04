<form id="form-modal" method="post" action="<?php echo base_url('user/password_user'); ?>" autocomplete="off">
    <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>">
    <input type="hidden" name="username" value="<?php echo $data->username; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-refresh"></i> เปลี่ยนรหัสผ่านผู้ใช้ระบบ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Username</label>
            <input type="text" class="form-control form-control-sm" value="<?php echo $data->username; ?>" readonly="">
        </div>
        <div class="form-group">
            <label class="control-label">Password ( ใหม่ ) <span class="text-danger">*</span></label>
            <input type="password" id="password_new" name="password_new" class="form-control form-control-sm" onblur="check_password()" required="">
        </div>
        <div class="form-group">
            <label class="control-label">Password ( ยืนยัน ) <span class="text-danger">*</span></label>
            <input type="password" id="password_confirm" name="password_confirm" class="form-control form-control-sm" onblur="check_password()" required="">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-password-submit" class="btn btn-info" disabled=""><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>
<script>
    function check_password() {
        let password_new = $('#password_new').val();
        let password_confirm = $('#password_confirm').val();
        if (password_new != '' && password_confirm != '') {
            if (password_new != password_confirm) {
                $('#btn-password-submit').prop('disabled', true);
                notification('error', 'เกิดข้อผิดพลาด', 'ระบุ Password ( ยืนยัน ) ไม่ถูกต้อง ลองใหม่อีกครั้ง');
            } else {
                $('#btn-password-submit').prop('disabled', false);
            }
        } else {
            $('#btn-add-submit').prop('disabled', true);
        }
    }
</script>