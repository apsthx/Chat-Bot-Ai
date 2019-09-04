<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />       
        <title><?php echo isset($title) ? $title . ' | ' . $this->config->item('app_title') : $this->config->item('app_title'); ?></title>
        <meta name="description" content="<?php echo $this->config->item('app_description'); ?>" />
        <meta name="keywords" content="<?php echo $this->config->item('app_keyward'); ?>" />
        <meta name="author" content="<?php echo $this->config->item('app_author'); ?>" />

        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>">
        <meta name="robots" content="noindex, nofollow">

        <?php
        echo "\t\t" . $this->assets->css_full('plugin/bootstrap/css/bootstrap.min.css');
        echo "\t" . $this->assets->css('pages/login-register-lock.css');
        echo "\t" . $this->assets->css('style.css');
        echo "\t" . $this->assets->css('parsley.min.css');
        echo "\n\t";
        $this->load->view('layout/tag');
        ?>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="card-no-border">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Loading...</p>
            </div>
        </div>
        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" />

        <section id="wrapper">
            <div class="login-register" style="background-image:url(<?php echo base_url(); ?>assets/img/login-bg.jpg);padding: 6vw 0 0 0; position: absolute; overflow:visible;">        
                <div class="login-box card">
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
                    </div>
                    <div class="card-footer">                
                        <p class="text-center"><?php echo $this->config->item('app_footer'); ?></p>                       
                    </div>
                </div>                
            </div>
        </section>

        <?php
        echo "\t\t" . $this->assets->js_full('plugin/jquery/jquery.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/popper.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/bootstrap.min.js');
        echo "\t" . $this->assets->js_full('plugin/sweetalert/sweetalert.min.js');
        echo "\t" . $this->assets->js('parsley.min.js');
        ?>

        <script>
            $(function () {
                $(".preloader").fadeOut();
                $('#loginform').parsley();
                $('#flash_message').delay(5000).fadeOut(1000);
            });
        </script>

    </body>
</html>