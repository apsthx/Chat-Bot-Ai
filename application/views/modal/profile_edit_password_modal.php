<div class="modal-header">
    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;เปลี่ยนรหัสผ่าน</h4>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
    <div class="bootbox-body">
        <form class="form-horizontal" id="formeditpassword" method="post" onsubmit="return editpassword();" autocomplete="off">            
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label"> Username : <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" name="usernamepassword" id="usernamepassword" value="<?php echo $username; ?>" class="form-control form-control-sm" readonly="">
                </div>
            </div>  
            <p class="text-center text-danger col-sm-11" id="statuspassword"></p>
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label"> Password เดิม : <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="password" autocomplete="new-password" name="oldpassword" id="oldpassword" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล" required>
                </div>
            </div>  
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label"> Password ใหม่ : <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="password" name="newpassword" id="newpassword" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล" required >
                </div>
            </div>   
            <p class="text-center text-danger col-sm-11" id="statusconfirmpassword"></p>
            <div class="form-group row">
                <label class="col-sm-4 text-right control-label col-form-label"> ยืนยัน Password : <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control form-control-sm" data-parsley-error-message="กรุณากรอกข้อมูล" required >
                </div>
            </div>  
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" value="bt-submit" id="bt-submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                    &nbsp;
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>                    
</div>

<script>
    $(function () {
        $('#formeditpassword').parsley();
    });
</script>
