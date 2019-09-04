<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form_modal" method="post"action="<?php echo base_url() . 'main/delete'; ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-trash"></i>&nbsp;แจ้งลบ ChatBot</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="agent_id" value="<?php echo $data->agent_id; ?>">
                    <div class="bootbox-body">
                        <h4 class="text-center m-t-5">ต้องการแจ้งลบ ChatBot : <?php echo $data->agent_name; ?> ใช่หรือไม่ ?</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-delete-form" class="btn btn-outline-info"><i id="fa-delete-form" class="fa fa-check"></i> ยืนยัน</button>
                    <button type="button" class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
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