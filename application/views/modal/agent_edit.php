<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form_modal" method="post"action="<?php echo base_url() . 'main/edit'; ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไข ChatBot</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="agent_id" value="<?php echo $data->agent_id; ?>">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label col-form-label" style="font-weight: bold;"> ชื่อ ChatBot : <span class="text-danger">*</span></label>
                                <input type="text" name="agent_name" value="<?php echo $data->agent_name; ?>" class="form-control form-control-sm" readonly="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label col-form-label" style="font-weight: bold;"> รายละเอียด ( Description ) : </label>
                                <textarea type="text" name="agent_description" class="form-control form-control-sm" rows="3"><?php echo $data->agent_description; ?></textarea>
                            </div>
                        </div>
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
    $(document).ready(function () {
        $('#form_modal').parsley();
    });
</script>