<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_modal" class="form-horizontal" method="post" action="<?php echo base_url() . 'bank/editbank'; ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;แก้ไขบัญชีธนาคาร</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="bank_id" value="<?php echo $data->bank_id; ?>">
                    <div class="form-group">
                        <label class="control-label col-form-label col-sm-12"> โลโก้ธนาคาร: <span class="text-danger">*</span></label>
                        <select class="form-control col-sm-10" name="bank_icon_id" id="bank_icon_id" onchange="changeBank()">
                            <?php
                            $bank_icons = $this->bank_model->getBankIcon();
                            if ($bank_icons->num_rows() > 0) {
                                foreach ($bank_icons->result() as $icon) {
                                    ?>
                                    <option <?php echo ($icon->bank_icon_id == $data->bank_icon_id ? 'selected="selected"' : ''); ?> value="<?php echo $icon->bank_icon_id ?>"><?php echo $icon->bank_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="col-sm-1"><i class="<?php echo $data->bank_icon; ?>" id="bank_icon"></i></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> ธนาคาร: <span class="text-danger">*</span></label>
                        <input type="text" name="bank_name" id="bank_name" value="<?php echo $data->bank_name; ?>" class="form-control"  required="">
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-form-label"> สาขา </label>
                        <input type="text" name="bank_branch" id="bank_branch" value="<?php echo $data->bank_branch; ?>" class="form-control">
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-form-label"> เลขที่บัญชี <span class="text-danger">*</span></label>
                        <input type="text" name="bank_account_number" id="bank_account_number" value="<?php echo $data->bank_account_number; ?>" class="form-control"  required="">
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-form-label"> ชื่อบัญชี <span class="text-danger">*</span></label>
                        <input type="text" name="bank_account_name" id="bank_account_name" value="<?php echo $data->bank_account_name; ?>" class="form-control"  required="">
                    </div> 
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
    $(document).ready(function () {
        $('#form_modal').parsley();
    });
    
    function changeBank() {
        let url = service_base_url + 'bank/bankicon/' + $('#bank_icon_id').val();
        $('#bank_icon').removeClass();
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON',
            success: function (response) {
                $('#bank_name').val(response.bank_name);
                $('#bank_icon').addClass(response.bank_icon);
            }
        });
    }

</script>