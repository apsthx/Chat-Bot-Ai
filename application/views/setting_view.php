<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title; ?>
                </h4>
                <hr>
                <form class="form-horizontal" id="form-setting" method="post" action="<?php echo base_url() . 'setting/edit'; ?>" autocomplete="off">
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> รหัสทีม</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $data->teams_code; ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> ชื่อทีม</label>
                        <div class="col-sm-4">
                            <input type="text" name="teams_name" value="<?php echo $data->teams_name; ?>" class="form-control form-control-sm" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> สถานะ</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo ($data->teams_status_id == 1 ? 'ปกติ' : 'ระงับ'); ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> แพ็กเกจปัจจุบัน</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $data->package_name; ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> จำนวน Agent</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $data->package_agent; ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> จำนวน User</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $data->package_user; ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> เวลาแพ็กเกจ</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $this->misc->date2thai($data->teams_package_date, '%d %m %y'); ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> วันที่สิ้นสุดแพ็กเกจ</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo $this->misc->date2thai($data->teams_package_expire, '%d %m %y'); ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <label class="col-sm-2 col-form-label"> ใช้งานได้อีก</label>
                        <div class="col-sm-4">
                            <input type="text" value="<?php echo ($data->teams_package_expire >= date('Y-m-d') ? ((date_diff(date_create(date('Y-m-d')), date_create($data->teams_package_expire))->days) + 1) . ' วัน' : 'หมดอายุเเล้ว'); ?>" class="form-control form-control-sm" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">   
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button> 
                            <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-refresh"></i>&nbsp;ยกเลิก</button>
                        </div>                       
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#form-setting').parsley();
    });
</script>