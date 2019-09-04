
<div>
    <h2 class="text-info"> <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title; ?></h2>
</div>
<div class="row">
    <div class="col-lg-4 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> 
                    <img src="<?php echo base_url() . 'store/user/' . ($data->user_image != '' ? $data->user_image : 'none.png'); ?>" id="image_h2" onerror="<?php echo base_url() . 'assets/upload/user/none.png'; ?>" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10"><?php echo $data->user_fullname; ?></h4>
                    <p class="card-subtitle"><?php echo $data->user_email != "" ? $data->user_email : "-"; ?></p>
                    <p class="card-subtitle"><?php echo $data->role_name; ?></p>
                </center>
            </div>
            <div>
                <hr style="padding: 0px;">
            </div>
            <div class="card-body " style="padding-top: 0px;">
                <b class="text-muted p-t-10">เบอร์โทร</b>
                <p><?php echo $data->user_tel != "" ? $data->user_tel : "-"; ?></p> 
                <b class="text-muted p-t-10">ที่อยู่</b>
                <p><?php echo $data->user_address != "" ? $data->user_address : "-"; ?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-7">
        <div class="card">
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a  class="nav-link active" data-toggle="tab" href="#profile" role="tab">ประวัติส่วนตัว</a></li>
                <li class="nav-item"> <a  class="nav-link" data-toggle="tab" href="#loglogin" role="tab">ประวัติการเข้าระบบ</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <div>
                                            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                                        </div>
                                    </h4>

                                    <form class="form-horizontal" id="formedit" method="post" action="<?php echo base_url() . 'profile/edit'; ?>" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <a  id="image_a" href="<?php echo base_url() . 'store/user/' . ($data->user_image != '' ? $data->user_image : 'none.png'); ?>" class="fancybox">
                                                    <img id="image_show" src="<?php echo base_url() . 'store/user/' . ($data->user_image != '' ? $data->user_image : 'none.png'); ?>" onerror="<?php echo base_url() . 'assets/upload/user/none.png'; ?>" class="img-thumbnail" width="150" height="150" style="cursor:pointer;">
                                                </a>
                                            </div>
                                        </div>
                                        <p/>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                แนะนำขนาดรูป 400x400px
                                            </div>
                                        </div>
                                        <p/>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <label  for="upload-image" class="btn btn-info btn-xl btn-sm">
                                                    <i class="fa fa-image"></i> อัพโหลดรูป
                                                    <input type="file" accept="image/*" name="user_image" onchange="upload_image();" id="upload-image" style="display: none">
                                                </label>
                                            </div>
                                        </div>
                                        <p></p>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-3 col-form-label">Username : </label>
                                            <div class="col-md-6">
                                                <input type="text" value="<?php echo $data->username; ?>" id="username" class="form-control form-control-sm" required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-3 col-form-label">ชื่อ-สกุล : </label>
                                            <div class="col-md-6">
                                                <input type="text" name="user_fullname" value="<?php echo $data->user_fullname; ?>"  class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-3 col-form-label">เบอร์โทร : </label>
                                            <div class="col-md-6">
                                                <input  type="text" value="<?php echo $data->user_tel; ?>"  class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-3 col-form-label">อีเมล : </label>
                                            <div class="col-md-6">
                                                <input type="email" value="<?php echo $data->user_email; ?>" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-3 col-form-label">ที่อยู่ : </label>
                                            <div class="col-md-6">
                                                <textarea name="user_address" class="form-control form-control-sm" rows="2"><?php echo $data->user_address; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-1"></div>
                                            <label class="col-md-3 col-form-label">หมายเหตุเพิ่มเติม : </label>
                                            <div class="col-md-6">
                                                <textarea name="user_comment" class="form-control form-control-sm" rows="2"><?php echo $data->user_comment; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12 text-center">                                                
                                                <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button> 
                                                <button type="reset" class="btn btn-sm btn-outline-secondary" ><i class="fa fa-refresh"></i>&nbsp;ยกเลิก</button> 
                                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="modaleditpassword();"><i class="fa fa-lock"></i>&nbsp;เปลี่ยนรหัสผ่าน</button> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="loglogin" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10%">#</th>
                                        <th width="10%"><?php echo 'status'; ?></th>
                                        <th width="25%">IP</th>
                                        <th width="30%">Browser</th>
                                        <th width="25%"><?php echo 'time'; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data_loglogin->num_rows() > 0) {
                                        $i = 1;
                                        foreach ($data_loglogin->result() as $row) {
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i; ?></td>
                                                <td>
                                                    <?php if ($row->log_text == "Login") { ?>
                                                        <span class="badge badge-info"><?php echo $row->log_text; ?></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-secondary"><?php echo $row->log_text; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $row->log_ip_address; ?></td>
                                                <td><?php echo $row->log_browser; ?></td>
                                                <td><?php echo $row->log_time; ?></td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="5"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger"><?php echo 'no_data_found'; ?></span></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> <?php echo 'select_color'; ?> <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
            <ul id="themecolors" class="m-t-20">
                <li><b><?php echo 'light'; ?></b></li>
                <li><a href="javascript:void(0)" data-theme="default" class="default-theme<?php echo ($data->user_style == 'default' ? ' working' : ''); ?>">1</a></li>
                <li><a href="javascript:void(0)" data-theme="green" class="green-theme<?php echo ($data->user_style == 'green' ? ' working' : ''); ?>">2</a></li>
                <li><a href="javascript:void(0)" data-theme="red" class="red-theme<?php echo ($data->user_style == 'red' ? ' working' : ''); ?>">3</a></li>
                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme<?php echo ($data->user_style == 'blue' ? ' working' : ''); ?>">4</a></li>
                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme<?php echo ($data->user_style == 'purple' ? ' working' : ''); ?>">5</a></li>
                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme<?php echo ($data->user_style == 'megna' ? ' working' : ''); ?>">6</a></li>
                <li class="d-block m-t-20"><b><?php echo 'dark'; ?></b></li>
                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme<?php echo ($data->user_style == 'default-dark' ? ' working' : ''); ?>">7</a></li>
                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme<?php echo ($data->user_style == 'green-dark' ? ' working' : ''); ?>">8</a></li>
                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme<?php echo ($data->user_style == 'red-dark' ? ' working' : ''); ?>">9</a></li>
                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme<?php echo ($data->user_style == 'blue-dark' ? ' working' : ''); ?>">10</a></li>
                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme<?php echo ($data->user_style == 'purple-dark' ? ' working' : ''); ?>">11</a></li>
                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme<?php echo ($data->user_style == 'megna-dark' ? ' working' : ''); ?> ">12</a></li>
            </ul>      
            <hr>
            <input type="hidden" id="style_theme" value="<?php echo ($data->user_style != '' ? $data->user_style : 'default'); ?>" />
            <button type="button" class="btn btn-sm btn-block btn-info waves-effect waves-light" onclick="save_theme();"><i class="fa fa-save"></i> <?php echo 'save'; ?></button>
        </div>
    </div>
</div>  

<div class="modal fade" id="editpassword">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();
    $(function () {
        $('#formedit').parsley();
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });
    function save_theme() {
        url = service_base_url + 'profile/save_theme';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                style_theme: $('#style_theme').val()
            },
            success: function (response)
            {
                if (response == '1') {
                    notification('success', 'Success', '<?php echo 'save_data_success'; ?>');
                }
            }
        });
    }

    function modaleditpassword() {
        url = service_base_url + 'profile/modaleditpassword';
        $('#editpassword').modal('show', {backdrop: 'true'});
        $.ajax({
            url: url,
            method: "POST",
            data: {
                username: $('#username').val()
            },
            success: function (response)
            {
                $('#editpassword .modal-content').html(response);
            }
        });
    }

    function editpassword() {
        if ($("#oldpassword").val() != '') {
            if ($("#newpassword").val() != '') {
                if ($("#confirmpassword").val() != '') {

                    url = service_base_url + 'profile/editpassword';
                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            username: $('#usernamepassword').val(),
                            oldpassword: $('#oldpassword').val(),
                            newpassword: $('#newpassword').val(),
                            confirmpassword: $('#confirmpassword').val()
                        },
                        success: function (res)
                        {
                            if (res == 1) {
                                $('#editpassword').modal('hide');
                                notification('success', 'Success', '<?php echo 'save_data_success'; ?>');
                            } else if (res == 2) {
                                $('#statuspassword').html('<?php echo 'old_password_incorrect'; ?>');
                                $('#statusconfirmpassword').html('');
                                $("#newpassword").val('');
                                $("#confirmpassword").val('');
                            } else {
                                $('#statusconfirmpassword').html('<?php echo 'comfirm_password_mismatch'; ?>');
                                $('#statuspassword').html('');
                                $("#newpassword").val('');
                                $("#confirmpassword").val('');
                            }
                        }
                    });
                }
            }
        }
        return false;
    }

    function upload_image() {
        var myfiles = document.getElementById("upload-image");
        var files = myfiles.files;
        var data = new FormData();
        for (i = 0; i < files.length; i++) {
            data.append('file' + i, files[i]);
        }
        url = service_base_url + 'profile/upload_image';
        $.ajax({
            url: url,
            dataType: "json",
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
        }).done(function (res) {
            if (res.error) {
                notification('error', 'Fail', '<?php echo 'upload_unsuccessful'; ?>');
            } else {
                image_link = service_base_url + 'assets/upload/user/' + res.file_name;
                $('#image_a').attr("href", image_link);
                $('#image_show').attr("src", image_link);
                $('#image_h1').attr("src", image_link);
                $('#image_h2').attr("src", image_link);
                notification('success', 'Uploaded', '<?php echo 'save_data_success'; ?>');
            }
        });
    }

</script>