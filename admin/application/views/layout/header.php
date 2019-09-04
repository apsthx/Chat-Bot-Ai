<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset($title) ? $title . ' | ' . $this->config->item('app_title') : $this->config->item('app_title'); ?></title>
        <meta name="description" content="<?php echo $this->config->item('app_description'); ?>" />
        <meta name="keywords" content="<?php echo $this->config->item('app_keyward'); ?>" />
        <meta name="author" content="<?php echo $this->config->item('app_author'); ?>" />
        <meta name="robots" content="noindex, nofollow">

        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>">

        <?php
        $admin = $this->accesscontrol->getAdmin($this->session->userdata('admin_id'));

        echo $this->assets->css_full('plugin/bootstrap/css/bootstrap.min.css');
        echo "\t" . $this->assets->css_full('plugin/toast-master/css/jquery.toast.css');
        echo "\t" . $this->assets->css('style.css');
        echo "\t" . $this->assets->css_full('css/colors/' . $admin->admin_style . '.css', array('id' => 'theme'));
        echo "\t" . $this->assets->css_full('plugin/sweetalert/sweetalert.css');
        echo "\t" . $this->assets->css('parsley.min.css');
        echo "\n\t";

        if (isset($css_full)) {
            foreach ($css_full as $row) {
                echo $this->assets->css_full($row);
            }
        }
        if (isset($css)) {
            foreach ($css as $row) {
                echo $this->assets->css($row);
            }
        }

        echo "\n";
        echo "\t\t" . $this->assets->js_full('plugin/jquery/jquery.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/popper.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/bootstrap.min.js');
        echo "\t" . $this->assets->js('perfect-scrollbar.jquery.min.js');
        echo "\t" . $this->assets->js('waves.js');
        echo "\t" . $this->assets->js('sidebarmenu.js');
        echo "\t" . $this->assets->js_full('plugin/sticky-kit-master/dist/sticky-kit.min.js');
        echo "\t" . $this->assets->js_full('plugin/sparkline/jquery.sparkline.min.js');
        echo "\t" . $this->assets->js('custom.js');
        echo "\t" . $this->assets->js('totop.js');
        echo "\t" . $this->assets->js('parsley.min.js');
        echo "\t" . $this->assets->js_full('plugin/toast-master/js/jquery.toast.js');
        echo "\t" . $this->assets->js_full('plugin/sweetalert/sweetalert.min.js');
        echo "\t" . $this->assets->js_full('plugin/sweetalert/jquery.sweet-alert.custom.js');
        echo "\n\t";

        if (isset($js_full)) {
            foreach ($js_full as $row) {
                echo $this->assets->js_full($row);
            }
        }
        if (isset($js)) {
            foreach ($js as $row) {
                echo $this->assets->js($row);
            }
        }
        echo "\n\t";
        $this->load->view('layout/tag');
        ?>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="fix-header card-no-border fix-sidebar">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Loading...</p>
            </div>
        </div>
        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" />
        <script>
            var service_base_url = $('#service_base_url').val();
        </script>
        <div id="main-wrapper">
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">
                            <b>
                                <img src="<?php echo base_url(); ?>assets/img/logo-icon.png" alt="logo" class="dark-logo" />
                                <img src="<?php echo base_url(); ?>assets/img/logo-light-icon.png" alt="logo" class="light-logo" />
                            </b>
                            <span>
                                <img src="<?php echo base_url(); ?>assets/img/logo-text.png" alt="logo" class="dark-logo" />  
                                <img src="<?php echo base_url(); ?>assets/img/logo-light-text.png" class="light-logo" alt="logo" />
                            </span> 
                        </a>
                    </div>

                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item hidden-sm-down"></li>
                        </ul>
                        <ul class="navbar-nav my-lg-0">

                            <?php
                            $agents = $this->accesscontrol->getAgent('0');
                            if ($agents->num_rows() > 0) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-comments-o"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                        <ul>
                                            <li>
                                                <div class="drop-title">รายการสร้าง ChatBot : <?php echo $agents->num_rows(); ?></div>
                                            </li>
                                            <li>
                                                <div class="message-center">                                                    
                                                    <?php
                                                    foreach ($agents->result() as $a) {
                                                        ?>
                                                        <a href="<?php echo base_url() . 'agent/index/0'; ?>">
                                                            <div class="btn btn-danger btn-circle"><i class="fa fa-comments-o"></i></div>
                                                            <div class="mail-contnet">
                                                                <h5><?php echo $a->agent_name; ?></h5> 
                                                                <span class="mail-desc">Team : <?php echo $a->teams_name; ?></span> 
                                                                <span class="time"><?php echo $a->agent_create; ?></span> 
                                                            </div>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>                                                    
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="<?php echo base_url() . 'agent/index/0'; ?>"> <strong>รายการสร้าง ChatBot ทั้งหมด</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }

                            $agents2 = $this->accesscontrol->getAgent(2);
                            if ($agents2->num_rows() > 0) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-trash-o"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                        <ul>
                                            <li>
                                                <div class="drop-title">รายการแจ้งลบ : <?php echo $agents2->num_rows(); ?></div>
                                            </li>
                                            <li>
                                                <div class="message-center">                                                    
                                                    <?php
                                                    foreach ($agents2->result() as $a2) {
                                                        ?>
                                                        <a href="<?php echo base_url() . 'agent/index/2'; ?>">
                                                            <div class="btn btn-danger btn-circle"><i class="fa fa-comments-o"></i></div>
                                                            <div class="mail-contnet">
                                                                <h5><?php echo $a2->agent_name; ?></h5> 
                                                                <span class="mail-desc">Team : <?php echo $a2->teams_name; ?></span> 
                                                                <span class="time"><?php echo $a2->agent_create; ?></span> 
                                                            </div>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>                                                    
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="<?php echo base_url() . 'agent/index/2'; ?>"> <strong>รายการแจ้งลบทั้งหมด</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }

                            $payments = $this->accesscontrol->getPayment();
                            if ($payments->num_rows() > 0) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-money"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                        <ul>
                                            <li>
                                                <div class="drop-title">รายการแจ้งโอน <?php echo $payments->num_rows(); ?></div>
                                            </li>
                                            <li>
                                                <div class="message-center">                                                    
                                                    <?php
                                                    foreach ($payments->result() as $p) {
                                                        ?>
                                                        <a href="<?php echo base_url() . 'payment'; ?>">
                                                            <div class="btn btn-danger btn-circle"><i class="fa fa-money"></i></div>
                                                            <div class="mail-contnet">
                                                                <h5><?php echo $p->user_fullname; ?></h5> 
                                                                <span class="mail-desc">แจ้งโอนเงิน : <?php echo $p->payment_cost; ?> บาท</span> 
                                                                <span class="time"><?php echo $p->payment_date . ' ' . $p->payment_time; ?></span> 
                                                            </div>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>                                                    
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="<?php echo base_url('payment'); ?>"> <strong>รายการแจ้งโอนทั้งหมด</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>

                            <li class="nav-item hidden-sm-down hidden-xs">
                                <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo ($admin->admin_fullname != '' ? $admin->admin_fullname : ''); ?>
                                </a>                                                                
                            </li>
                            <?php
                            $admin_image = base_url() . 'assets/upload/admin/' . ($admin->admin_image != '' ? $admin->admin_image : 'none.png');
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img id="image_h1" src="<?php echo $admin_image; ?>" alt="User" class="profile-pic" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <ul class="dropdown-user">
                                        <li class="hidden-sm">
                                            <div class="dw-user-box">
                                                <div class="u-text m-t-5">
                                                    <h4><?php echo ($admin->admin_fullname != '' ? $admin->admin_fullname : '-'); ?></h4>
                                                    <a href="<?php echo base_url() . 'profile'; ?>" class="btn btn-rounded btn-info btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>                                        
                                        <li><a href="<?php echo base_url() . 'profile'; ?>"><i class="fa fa-user-circle"></i> ประวัติส่วนตัว</a></li>       
                                        <li role="separator" class="divider"></li>  
                                        <li><a href="<?php echo base_url() . 'login/logout'; ?>"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
