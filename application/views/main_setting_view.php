<?php
    $getAppFacebook = $this->main_model->getAppFacebook();
?>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="icon-settings"></i> ตั้งค่า ChatBot
                    <span style="float: right">
                        <a href="<?php echo base_url() . 'intents/lists/' . $agent_id ?>"><i class="icon-speech"></i> จัดการ</a>
                    </span>
                </h4>
                <form class="form-horizontal" id="form-setting" method="post" action="<?php echo base_url() . 'main/setting_edit'; ?>" autocomplete="off" style="margin-top: 20px;">   
                    <input type="hidden" name="agent_id" value="<?php echo $data->agent_id; ?>">
                    <div class="col-12">
                        <label class="control-label col-form-label"> ChatBot : <span class="text-danger">*</span></label>
                        <input type="text" name="agent_name" value="<?php echo $data->agent_name; ?>" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-12">
                        <label class="control-label col-form-label"> รายละเอียด : <span class="text-danger">*</span></label>
                        <textarea type="text" name="agent_description" class="form-control form-control-sm" rows="5"><?php echo $data->agent_description; ?></textarea>
                    </div>
                    <div class="col-12">
                        <label class="control-label col-form-label"> เลือกประเภท : <span class="text-danger">*</span></label>
                        <select name="agent_type_id" class="form-control form-control-sm" required="">
                            <?php
                            $types = $this->main_model->get_ref_agent_types();
                            if ($types->num_rows() > 0) {
                                foreach ($types->result() as $type) {
                                    ?>
                                    <option value="<?php echo $type->agent_type_id; ?>" <?php echo $type->agent_type_id == $data->agent_type_id ? 'selected' : ''; ?>><?php echo $type->agent_type_name; ?></option>
                                    <?php
                                }
                            }
                            ?>                                   
                        </select>
                    </div>
                    <div class="form-group m-t-15">
                        <div class="col-md-12 text-right">                                                
                            <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button> 
                            <a href="<?php echo base_url() . 'main'; ?>" class="btn btn-sm btn-outline-secondary" ><i class="fa fa-arrow-left"></i>&nbsp;กลับ</a> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ตั้งค่าการเชื่อมต่อ</h4>
                <h6 class="card-subtitle"></h6>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($tab == 'facebook' ? 'active show' : '') ?>" data-toggle="tab" href="#facebook_tab" role="tab" aria-selected="true">
                            <span class="hidden-sm-up"><img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/></span> <span class="hidden-xs-down"><img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/> Facebook</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($tab == 'line' ? 'active show' : '') ?>" data-toggle="tab" href="#line_tab" role="tab" aria-selected="false">
                            <span class="hidden-sm-up"><img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/> </span> <span class="hidden-xs-down"><img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/> Line</span>
                        </a>
                    </li>                    
                </ul>
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane <?php echo ($tab == 'facebook' ? 'active show' : '') ?>" id="facebook_tab" role="tabpanel">
                        <div class="p-20">
                            <h4 class="m-t-20"><img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/> ตั้งค่าการเชื่อมต่อ </h4>
                            <form class="form-horizontal" id="form-setting" method="post" action="<?php echo base_url() . 'main/setting_facebook'; ?>" autocomplete="off" style="margin-top: 20px;">   
                                <input type="hidden" name="agent_id" value="<?php echo $data->agent_id; ?>">
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> สถานะเชื่อมต่อ : </label>
                                    <?php if ($data->agent_fb_status_id == 1) { ?>
                                        <?php if ($data->agent_fb_active_id == 1) { ?>
                                            <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/> Facebook <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo 'เชื่อมต่อแล้ว'; ?></span>
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-warning"><i class="fa fa-warning"></i> <?php echo 'รอเชื่อมต่อ'; ?></span>
                                        <?php } ?>
                                    <?php } else if ($data->agent_fb_status_id == 2) { ?>
                                        <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-danger"><i class="fa fa-ban"></i> <?php echo 'ไม่เปิดใช้'; ?></span>
                                    <?php } ?>                               
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Facebook Page Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="agent_fb_name" value="<?php echo $data->agent_fb_name; ?>" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Facebook App Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="agent_fb_app" value="<?php echo $data->agent_fb_app; ?>" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Facebook Verify Token: </label>
                                    <input type="text" value="<?php echo $data->agent_fb_verify_token; ?>" class="form-control form-control-sm" readonly="">
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Facebook Access Token : </label>
                                    <textarea type="text" class="form-control form-control-sm" rows="2" readonly=""><?php echo $data->agent_fb_access_token; ?></textarea>
                                </div>
                                <div class="form-group m-t-15">
                                    <div class="col-md-8 text-right">

                                        <?php if ($data->agent_fb_status_id == 1) { ?>
                                            <?php if ($data->agent_fb_active_id == 0) {
                                                    if ($getAppFacebook->num_rows() == 1) {
                                                        ?>
                                                            <button type="button" class="btn  btn-sm text-white" style="background: #375597;" onclick="facebookLogin();"><i class="fa fa-facebook"></i> เชื่อมต่อเฟสบุ๊ค</button>
                                                    <?php }
                                            }
                                        } ?>
                                        <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button> 
                                        <a href="<?php echo base_url() . 'main'; ?>" class="btn btn-sm btn-outline-secondary" ><i class="fa fa-arrow-left"></i>&nbsp;กลับ</a> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane <?php echo ($tab == 'line' ? 'active show' : '') ?>" id="line_tab" role="tabpanel">
                        <div class="p-20">
                            <h4 class="m-t-20"><img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/> ตั้งค่าการเชื่อมต่อ </h4>
                            <form class="form-horizontal" id="form-setting" method="post" action="<?php echo base_url() . 'main/setting_line'; ?>" autocomplete="off" style="margin-top: 20px;">   
                                <input type="hidden" name="agent_id" value="<?php echo $data->agent_id; ?>">
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> สถานะเชื่อมต่อ : </label>
                                    <?php if ($data->agent_line_status_id == 1) { ?>
                                        <?php if ($data->agent_line_active_id == 1) { ?>
                                            <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/> Line <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo 'เชื่อมต่อแล้ว'; ?></span>
                                        <?php } else { ?>
                                            <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-warning"><i class="fa fa-warning"></i> <?php echo 'รอเชื่อมต่อ'; ?></span>
                                        <?php } ?>
                                    <?php } else if ($data->agent_line_status_id == 2) { ?>
                                        <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" width="24" height="24"/>&nbsp;<span class="badge badge-danger"><i class="fa fa-ban"></i> <?php echo 'ไม่เปิดใช้'; ?></span>
                                    <?php } ?>                               
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Line Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="agent_line_name" value="<?php echo $data->agent_line_name; ?>" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Line ID : <span class="text-danger">*</span></label>
                                    <input type="text" name="agent_line_channel_id" value="<?php echo $data->agent_line_channel_id; ?>" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Line Channel Secret: </label>
                                    <input type="text" value="<?php echo $data->agent_line_channel_secret; ?>" class="form-control form-control-sm" readonly="">
                                </div>
                                <div class="col-md-8 col-8">
                                    <label class="control-label col-form-label"> Line Access Token : </label>
                                    <textarea type="text" class="form-control form-control-sm" rows="2" readonly=""><?php echo $data->agent_line_access_token; ?></textarea>
                                </div>
                                <div class="form-group m-t-15">
                                    <div class="col-md-8 text-right">                                                
                                        <button type="submit" class="btn btn-sm btn-outline-info"><i class="fa fa-save"></i>&nbsp;บันทึก</button> 
                                        <a href="<?php echo base_url() . 'main'; ?>" class="btn btn-sm btn-outline-secondary" ><i class="fa fa-arrow-left"></i>&nbsp;กลับ</a> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#form-setting').parsley();

        var url = service_base_url + 'main';
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');
    });

    <?php  if($getAppFacebook->num_rows() == 1){
        $rowAppFacebook = $getAppFacebook->row();
        ?>
    // login facebook
    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?php echo $rowAppFacebook->app_facebook_id; ?>',
            cookie: true,
            xfbml: true,
            version: 'v3.2'
        });
        FB.AppEvents.logPageView();
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    function facebookLogin() {
        FB.getLoginStatus(function (response) {
            // console.log(response);
            statusChangeCallback(response);
        });
    }

    function statusChangeCallback(response) {
        // console.log(response);
        if (response.status === "connected") {
            fetchUserProfile();
        }
        else {
            // Logging the user to Facebook by a Dialog Window
            facebookLoginByDialog();
        }
    }


    function fetchUserProfile() {
        // console.log('Welcome!  Fetching your information.... ');
        FB.api('/me?fields=id,name,email', function (response) {
            $.ajax({
                url: service_base_url + 'main/changeactivefacebook',
                type: 'POST',
                data: {
                    agent_id: '<?php echo $data->agent_id; ?>',
                    app_facebook_id_pri : '<?php echo $rowAppFacebook->app_facebook_id_pri; ?>',
                    app_facebook_id : '<?php echo $rowAppFacebook->app_facebook_id; ?>'
                },
                success: function (response) {
                    location.reload();
                }
            });
        });
    }

    function facebookLoginByDialog() {
        FB.login(function (response) {

            statusChangeCallback(response);

        }, {scope: 'public_profile,email,pages_messaging'});
    }
    <?php } ?>
</script>