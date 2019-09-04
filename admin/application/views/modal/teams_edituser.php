<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_modal" method="post" action="<?php echo base_url() . 'teams/edituser'; ?>" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขผู้ใช้งาน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-form-label"> Username : <span class="text-danger">*</span></label>
                        <input type="hidden" name="teams_id" id="teams_id" class="form-control form-control-sm" value="<?php echo $data->teams_id; ?>" >
                        <input type="hidden" name="user_id" id="user_id" class="form-control form-control-sm" value="<?php echo $data->user_id; ?>" >
                        <input type="text" name="username" id="username" class="form-control form-control-sm" value="<?php echo $data->username; ?>" required="" readonly="" >
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> Password ใหม่ <span class="text-danger">** ไม่แก้ไขให้เว้นไว้ **</span>  : </label>
                        <input autocomplete="new-password" type="password" name="password" id="password" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> ชื่อผู้ใช้งาน : <span class="text-danger">*</span></label>
                        <input type="text" name="user_fullname" id="user_fullname" class="form-control form-control-sm" value="<?php echo $data->user_fullname; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> เบอร์โทร : <span class="text-danger">*</span></label>
                        <input type="text" name="user_tel" id="user_tel" class="form-control form-control-sm" value="<?php echo $data->user_tel; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> อีเมล : <span class="text-danger">*</span></label>
                        <input type="text" name="user_email" id="user_email" class="form-control form-control-sm" value="<?php echo $data->user_email; ?>" required="">
                    </div>
                </div>
                <div class="modal-footer" >
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i> ยกเลิก</button>
                </div>
            </div>
        </form>                  
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#form_modal').parsley();
    });
</script>