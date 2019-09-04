<form id="form-modal" method="post" action="<?php echo base_url('training/intents'); ?>" autocomplete="off">
    <input type="hidden" name="agent_id" id="agent_id" value="<?php echo $agent_id; ?>">
    <input type="hidden" name="training_id" id="training_id" value="<?php echo $training_id; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Training</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">User say <span class="text-danger">*</span></label>
                <input type="text" name="training_text" id="training_text" class="form-control form-control-sm" value="<?php echo $data->training_text; ?>" readonly="">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">Intents <span class="text-danger">*</span></label>
                <select name="intent_id" id="intent_id" class="form-control form-control-sm" required="">
                    <?php
                    if (!empty($intents->intents)) {
                        $fixIntent = array();
                        foreach ($intents->intents as $row) {
                            $name = explode('/', $row->name);
                            $isFallback = !empty($row->isFallback) ? 1 : 0;
                            if ($isFallback == 0) {
                                ?>
                                <option value="<?php echo $name[4]; ?>"><?php echo $row->displayName; ?></option>
                                <?php
                            } else {
                                $fixIntent[] = $row;
                            }
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btn-modal-submit" class="btn btn-info" onclick="submit_form()"><span id="btn-modal-submit-loading" style="display: none;"><i class="fa fa-spinner fa-spin"></i> </span> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>
<script>
    function submit_form() {
        if ($('#form-modal').parsley().validate() === true) {
            $('#btn-modal-submit').prop('disabled', true);
            $('#btn-modal-submit-loading').show();
            $('#form-modal').submit();
        }
    }
</script>
