<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">                        
                        <button class="btn btn-sm btn-rounded btn-outline-inverse" onclick="window.close();"><i class="fa fa-close"></i> ปิด</button>
                    </span>
                </h4>
                <div class="row">
                    <div class="col-12">
                        <br/>
                        <form class="form-horizontal" method="post" id="form-teams" action="<?php echo base_url() . 'teams/add'; ?>" autocomplete="off">
                            <div class="row">
                                <div class="col-md-1">   

                                </div>
                                <div class="col-md-5"> 
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ชื่อทีม : <span class="text-danger">*</span></label>
                                        <div class="col-md-7">                              
                                            <input type="text" name="teams_name" class="form-control form-control-sm" required="">
                                        </div>                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Username : <span class="text-danger">*</span></label>
                                        <div class="col-md-7">                              
                                            <input type="text" name="username" id="username" onblur="checkUsername();" onkeypress="if (event.keyCode === 13) {
                                                        checkUsername();
                                                    }" class="form-control form-control-sm" required="">
                                        </div>                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">เบอร์โทร : <span class="text-danger">*</span></label>
                                        <div class="col-md-7">                              
                                            <input type="text" name="user_tel" class="form-control form-control-sm" required="">
                                        </div>                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">แพ็กเกจเริ่มต้น : <span class="text-danger">*</span></label>
                                        <div class="col-md-7">              
                                            <select name="package_id" class="form-control form-control-sm">
                                                <?php
                                                $packages = $this->teams_model->getpackage();
                                                if ($packages->num_rows() > 0) {
                                                    foreach ($packages->result() as $package) {
                                                        ?>
                                                        <option value="<?php echo $package->package_id; ?>" ><?php echo $package->package_name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>                                   
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">   
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">ชื่อผู้ใช้งานหลัก : <span class="text-danger">*</span></label>
                                        <div class="col-md-7">                              
                                            <input type="text" name="user_fullname" class="form-control form-control-sm" required="">
                                        </div>                        
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Password : <span class="text-danger">*</span></label>
                                        <div class="col-md-7">                              
                                            <input type="password" autocomplete="new-password"  name="password" class="form-control form-control-sm" required="">
                                        </div>                        
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email : <span class="text-danger">*</span></label>
                                        <div class="col-md-7">                              
                                            <input type="email" name="user_email" class="form-control form-control-sm" required="">
                                        </div>                        
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="bt-submit" disabled="" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button>
                                    <button type="reset" class="btn btn-sm btn-outline-danger " ><i class="fa fa-close"></i>&nbsp;ยกเลิก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="for_modal"></div>

<script>
    $(function () {
        $('#form-teams').parsley();
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });

    function checkUsername() {
        $('#bt-submit').prop('disabled', true);
        if ($('#username').val() != '') {
            $.ajax({
                url: service_base_url + 'teams/checkUsername',
                method: "POST",
                data: {
                    username: $('#username').val(),
                },
                success: function (res)
                {
                    if (res == 1) {
                        notification('error', 'Error', 'username นี้มีการใช้งานแล้ว');
                        $('#username').val("")
                    } else {
                        notification('success', 'Success', 'username นี้สามารถใช้งานได้');
                        $('#bt-submit').prop('disabled', false);
                    }
                }
            });
        }
    }
</script>