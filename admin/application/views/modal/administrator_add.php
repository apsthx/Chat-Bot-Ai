<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_modal" method="post" action="<?php echo base_url() . 'administrator/add'; ?>" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่มผู้ดูแลระบบ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">สิทธิ์ผู้ใช้งาน <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-control form-control-sm">
                            <?php
                            foreach ($this->administrator_model->get_role()->result() as $row) {
                                ?>                    
                                <option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> Username : <span class="text-danger">*</span></label>
                        <input type="text" name="admin_username" id="admin_username" onblur="checkAdminUsername();" onkeypress="if (event.keyCode === 13) {
                                    checkAdminUsername();
                                }" class="form-control form-control-sm"  required="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> password : <span class="text-danger">*</span></label>
                        <input autocomplete="new-password" type="password" name="admin_password" id="admin_password" class="form-control form-control-sm" required="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> ชื่อผู้ดูแลระบบ : <span class="text-danger">*</span></label>
                        <input type="text" name="admin_fullname" id="admin_fullname" class="form-control form-control-sm" required="">
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