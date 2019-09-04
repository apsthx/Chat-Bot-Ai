<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_modal" method="post" action="<?php echo base_url() . 'administrator/edit'; ?>" autocomplete="off">
            <input type="hidden" name="admin_id" value="<?php echo $data->admin_id ?>" required="" />
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;แก้ไขผู้ดูแลระบบ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">สิทธิ์ผู้ใช้งาน <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-control form-control-sm">
                            <?php
                            foreach ($this->administrator_model->get_role()->result() as $row) {
                                ?>                    
                                <option value="<?php echo $row->role_id; ?>" <?php echo $data->role_id == $row->role_id ? 'selected' : ''; ?>><?php echo $row->role_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> Username : <span class="text-danger">*</span></label>
                        <input type="text" name="admin_username" id="admin_username" class="form-control form-control-sm" value="<?php echo $data->admin_username; ?>" required="" readonly="" >
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> Password ใหม่ <span class="text-danger">** ไม่แก้ไขให้เว้นไว้ **</span>  : </label>
                        <input autocomplete="new-password" type="password" name="admin_password" id="admin_password" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> ชื่อผู้ดูแลระบบ : <span class="text-danger">*</span></label>
                        <input type="text" name="admin_fullname" id="admin_fullname" class="form-control form-control-sm" value="<?php echo $data->admin_fullname; ?>" required="">
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