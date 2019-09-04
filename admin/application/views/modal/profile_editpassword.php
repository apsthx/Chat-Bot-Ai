<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form_modal" method="post" onsubmit="return editpassword();" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-lock"></i>&nbsp;เปลี่ยนรหัสผ่าน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-form-label"> username : <span class="text-danger">*</span></label>
                        <input type="text" name="admin_username_password" id="admin_username_password" value="<?php echo $admin_username; ?>" class="form-control form-control-sm" readonly="">
                    </div>  
                    <p class="text-center text-danger" id="statuspassword"></p>
                    <div class="form-group">
                        <label class="control-label col-form-label"> password เดิม : <span class="text-danger">*</span></label>
                        <input type="password" autocomplete="new-password" name="oldpassword" id="oldpassword" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล" required>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-form-label"> password ใหม่ : <span class="text-danger">*</span></label>

                        <input type="password" name="newpassword" id="newpassword" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล"  required >

                    </div>   
                    <p class="text-center text-danger" id="statusconfirmpassword"></p>
                    <div class="form-group">
                        <label class="control-label col-form-label"> ยืนยัน password : <span class="text-danger">*</span></label>
                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล" required >

                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i> ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function () {
//        $('#form_modal').parsley();
    });
</script>
