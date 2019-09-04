<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form-horizontal" id="form_modal" method="post"action="<?php echo base_url() . 'teams/edit'; ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-gift"></i>&nbsp;อัพเดทแพ็กเกจ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="teams_id" value="<?php echo $data->teams_id; ?>">
                    <input type="hidden" name="package_id" value="<?php echo $data->package_id; ?>">
                    <div class="form-group">
                        <label class="control-label col-form-label"> รหัสทีม : </label>
                        <input type="text" value="<?php echo $data->teams_code; ?>" class="form-control form-control-sm" disabled="">
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-form-label"> ชื่อทีม : <span class="text-danger">*</span></label>
                        <input type="text" name="teams_name" value="<?php echo $data->teams_name; ?>" class="form-control form-control-sm" required="" >
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-form-label"> แพ็กเกจปัจจุบัน :</label>
                        <input type="text" value="<?php echo ($data->package_id != null || $data->package_id != '') ? $this->teams_model->getpackage($data->package_id)->row()->package_name : ''; ?>" class="form-control form-control-sm" disabled="">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> แพ็กเกจอัพเดทล่าสุด : </label>
                                <input type="text" value="<?php echo $this->misc->date2thai($data->teams_package_date, '%d %m %y'); ?>" class="form-control form-control-sm" disabled="">
                            </div>  </div>  
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> แพ็กเกจหมดอายุ : </label>
                                <input type="text" value="<?php echo $this->misc->date2thai($data->teams_package_expire, '%d %m %y'); ?>" class="form-control form-control-sm" disabled="">
                            </div> 
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="control-label col-form-label"> อัพเดทแพ็กเกจหรือต่ออายุแพ็กเกจ : <span class="text-danger">*</span></label>
                        <select name="package_id_update" class="form-control form-control-sm">
                            <?php
                            $packages = $this->teams_model->getpackage();
                            if ($packages->num_rows() > 0) {
                                foreach ($packages->result() as $package) {
                                    ?>
                                    <option value="<?php echo $package->package_id; ?>" <?php echo ($data->package_id == $package->package_id) ? 'selected' : ''; ?>><?php echo $package->package_name . ' (+' . $package->package_date . ' วัน)'; ?></option>
                                    <?php
                                }
                            }
                            ?>                                   
                        </select>
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