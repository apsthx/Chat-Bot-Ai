<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <div>
                        <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                    </div>
                </h4>  
                <form class="form-horizontal" id="formedit" method="post" action="<?php echo base_url() . 'profile/edit'; ?>" autocomplete="off">
                    <input type="hidden" name="admin_id" id="admin_id"  value="<?php echo $data->admin_id; ?>">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a  id="image_a" href="<?php echo base_url() . 'assets/upload/admin/' . $data->admin_image; ?>" class="fancybox">
                                <img id="image_show" src="<?php echo base_url() . 'assets/upload/admin/' . $data->admin_image; ?>" width="150" height="150" style="cursor:pointer;">
                            </a>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            แนะนำขนาดรูป 400x400px 
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <label  for="upload-image" class="btn btn-sm btn-info btn-xl">
                                <i class="fa fa-image"></i> อัพโหลดรูป
                                <input type="file" accept="image/*" name="image" onchange="upload_image();" id="upload-image" style="display: none">
                            </label>
                        </div>
                    </div>
                    <p></p>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <label class="col-md-3 col-form-label"> Username : </label>
                        <div class="col-md-4">
                            <input type="text" value="<?php echo $data->admin_username; ?>"  id="admin_username" class="form-control form-control-sm" required readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <label class="col-md-3 col-form-label"> ชื่อผู้ใช้งาน : </label>
                        <div class="col-md-4">
                            <input type="text" name="admin_fullname" value="<?php echo $data->admin_fullname; ?>"  class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <p></p>
                    <br/>
                    <div class="form-group">
                        <div class="col-md-12 text-center">                            
                            <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button> 
                            <button type="reset" class="btn btn-sm btn-outline-default" ><i class="fa fa-refresh"></i>&nbsp;ยกเลิก</button> 
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="modaleditpassword();"><i class="fa fa-lock"></i>&nbsp;เปลี่ยนรหัสผ่าน</button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> เลือกสีเมนู <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
            <ul id="themecolors" class="m-t-20">
                <li><b>แถบด้านข้างโทนสว่าง</b></li>
                <li><a href="javascript:void(0)" data-theme="default" class="default-theme<?php echo ($data->admin_style == 'default' ? ' working' : ''); ?>">1</a></li>
                <li><a href="javascript:void(0)" data-theme="green" class="green-theme<?php echo ($data->admin_style == 'green' ? ' working' : ''); ?>">2</a></li>
                <li><a href="javascript:void(0)" data-theme="red" class="red-theme<?php echo ($data->admin_style == 'red' ? ' working' : ''); ?>">3</a></li>
                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme<?php echo ($data->admin_style == 'blue' ? ' working' : ''); ?>">4</a></li>
                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme<?php echo ($data->admin_style == 'purple' ? ' working' : ''); ?>">5</a></li>
                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme<?php echo ($data->admin_style == 'megna' ? ' working' : ''); ?>">6</a></li>
                <li class="d-block m-t-20"><b>แถบด้านข้างโทนเข็ม</b></li>
                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme<?php echo ($data->admin_style == 'default-dark' ? ' working' : ''); ?>">7</a></li>
                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme<?php echo ($data->admin_style == 'green-dark' ? ' working' : ''); ?>">8</a></li>
                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme<?php echo ($data->admin_style == 'red-dark' ? ' working' : ''); ?>">9</a></li>
                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme<?php echo ($data->admin_style == 'blue-dark' ? ' working' : ''); ?>">10</a></li>
                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme<?php echo ($data->admin_style == 'purple-dark' ? ' working' : ''); ?>">11</a></li>
                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme<?php echo ($data->admin_style == 'megna-dark' ? ' working' : ''); ?> ">12</a></li>
            </ul>      
            <hr>
            <input type="hidden" id="style_theme" value="<?php echo ($data->admin_style != '' ? $data->admin_style : 'default'); ?>" />
            <button type="button" class="btn btn-sm btn-block btn-info waves-effect waves-light" onclick="save_theme();"><i class="fa fa-save"></i> บันทึก</button>
        </div>
    </div>
</div>  

<div id="for_modal"></div>
<script>
    $(document).ready(function () {
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
                $('#upload-error').show();
            } else {
                $('#upload-error').hide();
                image_link = service_base_url + 'assets/upload/admin/' + res.file_name;
                $('#image_a').attr("href", image_link);
                $('#image_show').attr("src", image_link);
                $('#image_h1').attr("src", image_link);
                $('#image_h2').attr("src", image_link);
                notification('success', 'Success', 'บันทึกเรียบร้อยเเล้ว');
            }
        });
    }

    function modaleditpassword() {
        $.ajax({
            url: service_base_url + 'profile/profileeditpassword',
            method: "POST",
            data: {
                admin_username: $('#admin_username').val()
            },
            success: function (response)
            {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function editpassword() {
        if ($("#oldpassword").val() != '') {
            if ($("#newpassword").val() != '') {
                if ($("#confirmpassword").val() != '') {
                    $.ajax({
                        url: service_base_url + 'profile/editpassword',
                        method: "POST",
                        data: {
                            admin_username: $('#admin_username_password').val(),
                            oldpassword: $('#oldpassword').val(),
                            newpassword: $('#newpassword').val(),
                            confirmpassword: $('#confirmpassword').val()
                        },
                        success: function (res)
                        {
                            if (res == 1) {
                                $('#on_modal').modal('hide');
                                notification('success', 'Success', 'บันทึกการเปลี่ยนรหัสผ่านแล้ว');
                            } else if (res == 2) {
                                $('#statuspassword').html('Password เดิม ไม่ถูกต้อง');
                                $('#statusconfirmpassword').html('');
                                $("#newpassword").val('');
                                $("#confirmpassword").val('');
                            } else {
                                $('#statusconfirmpassword').html('ยืนยัน Password ไม่ตรง');
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
                    notification('success', 'Success', 'บันทึกเรียบร้อยเเล้ว');
                }
            }
        });
    }
</script>