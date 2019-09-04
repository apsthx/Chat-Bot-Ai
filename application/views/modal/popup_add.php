<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_modal" class="form-horizontal" method="post" action="<?php echo base_url() . 'popup/add'; ?>" autocomplete="off" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i>&nbsp;เพิ่ม PopUp</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group m-b-0">
                        <label class="control-label col-form-label"> ชื่อ PopUp: <span class="text-danger">*</span></label>
                        <input type="text" name="popup_title" id="popup_title" class="form-control"  required="">
                    </div>  
                    <div class="form-group m-b-0">
                        <label class="control-label col-form-label"> ข้อความ PopUp </label>
                        <textarea name="popup_text" id="popup_text" class="form-control" rows="3"></textarea>
                    </div> 
                    <div class="form-group m-b-0">
                        <div class="m-b-5">
                            <i class="fa fa-image"></i>
                            <span>รูปภาพ 1000x450</span>
                        </div>
                        <div>
                            <img src="<?php echo base_url() . 'assets/upload/popup/none.png'; ?>" width="500px" class="img-responsive"/>
                            <div style="margin-top: 10px" class="text-center">
                                <label for="upload-image" class="btn btn-sm btn-inverse">
                                    <i class="fa fa-image"></i> อัพรูปรูปภาพ
                                    <input type="file" accept="image/*" name="popup_image" onchange="$('#text_image').html($('#upload-image').val());" id="upload-image" style="display: none" required="">
                                </label>
                            </div>
                            <div>
                                <p id="text_image"></p>
                            </div>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="control-label col-form-label col-sm-12"> สถานะ: <span class="text-danger">*</span></label>
                        <select name="content_status_id" id="modal_content_status_id" class="form-control form-control-sm" onchange="show_input_time()">
                            <?php foreach ($this->popup_model->get_content_status()->result() as $status) { ?>
                                <option value="<?php echo $status->content_status_id; ?>"><?php echo $status->content_status_name; ?></option>
                            <?php } ?>
                        </select>  
                    </div>
                    <div class="row" id="show_popup_date" class="row" style="margin-top:20px; display: none;">
                        <div class="col-md-12" style="margin-top:10px;">
                            <input type="text" name="popup_start" id="popup_start" placeholder="เริ่มแสดง" class="form-control form-control-sm"/>
                        </div>
                        <div class="col-md-12" style="margin-top:10px;">
                            <input type="text" name="popup_end" id="popup_end" placeholder="สิ้นสุดการแสดง" class="form-control form-control-sm"/>
                        </div>
                        <div class="col-md-12 text-center" style="margin-top:2px;">
                            <span class="text-danger" style="font-size:12px;"><i class="fa fa-info-circle"></i> เว้นว่าง หากไม่กำหนดวันสิ้นสุด</span>
                        </div>
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

        $('#popup_start').datetimepicker({
            lang: 'th',
            format: 'Y-m-d H:00',
            scrollMonth: false,
            scrollTime: false,
            scrollInput: false,
            closeOnTimeSelect: true
        });

        $('#popup_end').datetimepicker({
            lang: 'th',
            format: 'Y-m-d H:00',
            scrollMonth: false,
            scrollTime: false,
            scrollInput: false,
            closeOnTimeSelect: true
        });

    });

    function show_input_time() {        
        if ($('#modal_content_status_id').val() === '3') {
            $('#show_popup_date').css('display', 'block');
            $('#popup_start').prop('required', true);
        } else {
            $('#show_popup_date').css('display', 'none');
            $('#popup_start').prop('required', false);
            $('#popup_start').val('');
            $('#popup_end').val('');
        }
    }

</script>