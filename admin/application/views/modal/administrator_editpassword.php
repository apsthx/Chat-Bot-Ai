<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-material m-t-10" method="post" action="<?php echo base_url() . 'administrator/editpassword'; ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ลืมรหัสผ่าน</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="admin_id" id='admin_id' value="<?php echo $admin_id; ?>">
                    <input type="hidden" name="admin_username" id='admin_username' value="<?php echo $admin_username; ?>">
                    <br/>
                    <h4 class="text-center"><i class='fa fa-refresh'></i> ต้องการเปลี่ยนรหัสผ่านเป็น 1234</h4>
                    <br/>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i> ยกเลิก</button>
                </div>
            </form>  
        </div>                    
    </div>
</div>    