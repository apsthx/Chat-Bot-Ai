       
<div class="login-box card" style="margin-top: 7%;">
    <div class="card-body">
        <form class="form-horizontal form-material" id="loginform" method="post" action="<?php echo base_url() . 'login/dologin'; ?>">
            <div class="text-center" style="font-size: 40px;"><i class="mdi mdi-lock"></i></div>
            <h3 class="box-title m-b-10 text-center">เข้าสู่ระบบ</h3>
            <h3 class="box-title m-b-20 text-center"><?php echo $this->config->item('app_name'); ?></h3>

            <div class="text-center" id="flash_message">
                <?php
                if ($this->session->flashdata('flash_message') != '') {
                    ?>
                    <?php
                    echo $this->session->flashdata('flash_message');
                    ?>
                    <br>
                    <?php
                }
                ?>                                
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="username" id="username" required="" placeholder="Username"> 
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" autocomplete="new-password" type="password" name="password" required="" placeholder="Password"> 
                </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button style="padding: 10px 15px 10px 15px;" class="btn btn-primary btn-rounded btn-block" type="submit"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</button>
                </div>
            </div>                          
        </form>
        <hr>
        <div class="col-xs-12 text-center">
            <a style="margin-top: 10px;font-weight: bold;" href="<?php echo base_url() . 'register'; ?>"><i class="fa fa-user-circle"></i> สมัครสมาชิก</a>              
        </div>
    </div>
    <div class="card-footer">                
        <p class="text-center"><?php echo $this->config->item('app_footer'); ?></p>                       
    </div>
</div>                

<script>
    $(function () {
        $(".preloader").fadeOut();
        $('#loginform').parsley();
        $('#flash_message').delay(5000).fadeOut(1000);
    });
</script>