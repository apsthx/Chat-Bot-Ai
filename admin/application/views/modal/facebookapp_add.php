<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <form class="form-horizontal" id="form_modal" method="post" action="<?php echo base_url() . 'facebookapp/add'; ?>" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่ม Facebook App</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-form-label"> Facebook App Name : <span class="text-danger">*</span></label>
                        <input type="text" name="app_facebook_name" class="form-control form-control-sm" required="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> Facebook AppID : <span class="text-danger">*</span></label>
                        <input type="text" name="app_facebook_id" class="form-control form-control-sm" required="">
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