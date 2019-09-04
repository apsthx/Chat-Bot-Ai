<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $result = $this->main_model->check_package();
            if ($result->num_rows() == 1) {
                $row = $result->row();
                if ($row->package_agent > $this->main_model->check_agent() && $row->teams_package_expire >= date('Y-m-d')) {
                    ?>
                    <form class="form-horizontal" id="form_modal" method="post"action="<?php echo base_url() . 'main/add'; ?>" autocomplete="off">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-commenting-o"></i>&nbsp;สร้าง ChatBot</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label col-form-label" style="font-weight: bold;"> ชื่อ ChatBot : <span class="text-danger">*</span></label>
                                        <input type="text" name="agent_name" class="form-control form-control-sm" required="">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label col-form-label" style="font-weight: bold;"> รายละเอียด ( Description ) : </label>
                                        <textarea type="text" name="agent_description" class="form-control form-control-sm" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label col-form-label"> เลือกประเภท : <span class="text-danger">*</span></label>
                                        <select name="agent_type_id" class="form-control form-control-sm" required="">
                                            <?php
                                            $types = $this->main_model->get_ref_agent_types();
                                            if ($types->num_rows() > 0) {
                                                foreach ($types->result() as $type) {
                                                    ?>
                                                    <option value="<?php echo $type->agent_type_id; ?>" ><?php echo $type->agent_type_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>                                   
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i> ยกเลิก</button>
                        </div>
                    </form>
                    <?php
                } else {
                    ?>
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-minus-circle"></i>&nbsp;ไม่สามารถสร้าง ChatBot ได้</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-rounded btn-inverse" href="<?php echo base_url() . 'package' ?>" style=""><i class="fa fa-ban"></i> อัพเดทแพ็กเกจ</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>                    
    </div>
</div>            
<script>
    $(document).ready(function () {
        $('#form_modal').parsley();
    });
</script>