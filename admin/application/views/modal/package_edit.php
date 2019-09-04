<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form_modal" method="post" action="<?php echo base_url() . 'package/editpackage'; ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขแพ็กแกจ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="package_id" value="<?php echo $data->package_id; ?>">
                    <div class="form-group">
                        <label class="control-label col-form-label"> ชื่อแพ็กเกจ : <span class="text-danger">*</span></label>
                        <input type="text" name="package_name" id="package_name" class="form-control form-control-sm" value="<?php echo $data->package_name; ?>" required="">
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-form-label"> ราคา : <span class="text-danger">*</span></label>
                        <input type="number" min="0" name="package_cost" id="package_cost" value="<?php echo $data->package_cost; ?>" class="form-control form-control-sm"  required="">
                    </div> 
                    <div class="form-group ">
                        <label class="control-label col-form-label"> จำนวน Agent : <span class="text-danger">*</span></label>
                        <input type="number" min="1" name="package_agent" id="package_agent" value="<?php echo $data->package_agent; ?>" class="form-control form-control-sm"  required="">
                    </div> 
                    <div class="form-group ">
                        <label class="control-label col-form-label"> จำนวนผู้ใช้งาน : <span class="text-danger">*</span></label>
                        <input type="number" min="0" name="package_user" id="package_user" value="<?php echo $data->package_user; ?>" class="form-control form-control-sm"  required="">
                    </div>                  
                    <div class="form-group ">
                        <label class="control-label col-form-label"> จำกัดวัน : <span class="text-danger">*</span></label>
                        <input type="number" min="0" name="package_date" id="package_date" value="<?php echo $data->package_date; ?>" class="form-control form-control-sm"  required="">
                    </div>   
                    <p></p>
                </div>
                <div class="modal-footer" >
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i> ยกเลิก</button>
                </div>
            </form>  
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#form_modal').parsley();
    });
</script>
