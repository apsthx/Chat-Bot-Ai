<form id="form-modal" method="post" action="<?php echo base_url('user/edit_user'); ?>" autocomplete="off">
    <input type="hidden" name="user_id" value="<?php echo $data->user_id; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขผู้ใช้งาน</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img id="user_image_preview" src="<?php echo base_url() . 'store/user/' . $data->user_image; ?>" style="max-height: 170px; border-radius: 3px;">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label class="control-label">สิทธิ์ผู้ใช้งานระบบ </label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $data->role_name; ?>" readonly="">               
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">Username </label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $data->username; ?>" readonly="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">ชื่อผู้ใช้งาน <span class="text-danger">*</span></label>
                <input type="text" name="user_fullname" class="form-control form-control-sm" value="<?php echo $data->user_fullname; ?>" required="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">อีเมล <span class="text-danger">*</span></label>
                <input type="email" name="user_email" class="form-control form-control-sm" value="<?php echo $data->user_email; ?>" required="">
            </div>
            <div class="col-lg-6">
                <label class="control-label">เบอร์โทร </label>
                <input type="text" name="user_tel" class="form-control form-control-sm" value="<?php echo $data->user_tel; ?>" onkeypress="return isNumberKey(event)" readonly="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-6">
                <label class="control-label">ที่อยู่</label>
                <textarea name="user_address" class="form-control form-control-sm" rows="2"><?php echo $data->user_address; ?></textarea>
            </div>
            <div class="col-lg-6">
                <label class="control-label">เพิ่มเติม</label>
                <textarea name="user_comment" class="form-control form-control-sm" rows="2"><?php echo $data->user_comment; ?></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" id="btn-edit-submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
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
</script>