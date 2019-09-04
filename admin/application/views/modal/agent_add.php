<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" id="form_modal" method="post"action="<?php echo base_url() . 'agent/add'; ?>" enctype="multipart/form-data" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-gift"></i>&nbsp;เพิ่ม ChatBot</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12"><p style="font-weight: bold;">ChatBot</p></div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> ชื่อ ChatBot : <span class="text-danger">*</span></label>
                                <input type="text" name="agent_name" class="form-control form-control-sm" required="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label col-form-label"> รายละเอียด ( DESCRIPTION ) : </label>
                                <textarea type="text" name="agent_description" class="form-control form-control-sm" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> เลือกทีม : <span class="text-danger">*</span></label>
                                <select name="teams_id" class="form-control form-control-sm">
                                    <?php
                                    $teams = $this->agent_model->get_teams();
                                    if ($teams->num_rows() > 0) {
                                        foreach ($teams->result() as $team) {
                                            ?>
                                            <option value="<?php echo $team->teams_id; ?>" ><?php echo $team->teams_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> เลือกประเภท : <span class="text-danger">*</span></label>
                                <select name="agent_type_id" class="form-control form-control-sm">
                                    <?php
                                    $types = $this->agent_model->get_ref_agent_types();
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

                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Project ID : </label>
                                <input type="text" name="agent_project_id" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Service Account : </label>
                                <input type="text" name="agent_service_account" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Client access token : </label>
                                <input type="text" name="agent_client_access_token" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Developer access token : </label>
                                <input type="text" name="agent_developer_access_token" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label col-form-label"> อัพโหลดไฟล์ JSON : </label>
                                <input type="file" name="json_file" id="json_file" accept=".json" class="form-control form-control-sm"/>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12"><p style="font-weight: bold;">Facebook Messenger</p></div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Facebook Name : </label>
                                <input type="text" name="agent_fb_name" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Facebook AppID : </label>
                                <input type="text" name="agent_fb_app" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Callback URL : </label>
                                <input type="text" name="agent_fb_callback_url" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Verify Token : </label>
                                <input type="text" name="agent_fb_verify_token" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Page Access Token : </label>
                                <input type="text" name="agent_fb_access_token" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12"><p style="font-weight: bold;">LINE</p></div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="control-label col-form-label"> LINE Name : </label>
                                <input type="text" name="agent_line_name" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Channel ID : </label>
                                <input type="text" name="agent_line_channel_id" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Channel Secret : </label>
                                <input type="text" name="agent_line_channel_secret" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Channel Access Token : </label>
                                <input type="text" name="agent_line_access_token" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label"> Webhook URL : </label>
                                <input type="text" name="agent_line_webhook_url" class="form-control form-control-sm">
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