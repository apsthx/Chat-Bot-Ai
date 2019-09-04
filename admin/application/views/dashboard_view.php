<div class="row">
    <div class="col-md-6 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>    
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="card bg-info">
            <div class="card-body">
                <a href="<?php echo base_url() . 'agent'; ?>">
                    <div class="d-flex no-block">
                        <div class="round round-lg align-self-center round-info"><i class="fa fa-comments-o"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">Total ChatBot</h6>
                            <h2 class="m-t-0 text-white"><?php echo $this->dashboard_model->countAgent(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card bg-warning">
            <div class="card-body">
                <a href="<?php echo base_url() . 'teams'; ?>">
                    <div class="d-flex no-block">
                        <div class="round round-lg align-self-center round-warning"><i class="fa fa-users"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">Total Team</h6>
                            <h2 class="m-t-0 text-white"><?php echo $this->dashboard_model->countTeam(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>   

    <div class="col-lg-3 col-md-6">
        <div class="card bg-danger">
            <div class="card-body">
                <a href="<?php echo base_url() . 'user'; ?>">
                    <div class="d-flex no-block">
                        <div class="round round-lg align-self-center round-danger"><i class="fa fa-user-o"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">Total User</h6>
                            <h2 class="m-t-0 text-white"><?php echo $this->dashboard_model->countUser(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="card bg-success">
            <div class="card-body">
                <a href="<?php echo base_url() . 'payment'; ?>">
                    <div class="d-flex no-block">
                        <div class="round round-lg align-self-center round-success"><i class="fa fa-money"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">รอตรวจ Payment</h6>
                            <h2 class="m-t-0 text-white"><?php echo $this->dashboard_model->countPayment(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">            
            <div class="card-body">
                <h4 class="card-title">
                    <a href="<?php echo base_url() . 'agent'; ?>">
                        <i class="fa fa-comments-o"></i> ChatBot 5 รายการล่าสุด
                    </a>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>                                
                                <th class="text-center">#</th>
                                <th>Team</th>
                                <th>Agent</th>                                               
                                <th class="text-center">Facebook</th>
                                <th class="text-center">Line</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">อัพเดทเมื่อ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $agents = $this->dashboard_model->getAgents(5);
                            if ($agents->num_rows() > 0) {
                                $i = 1;
                                foreach ($agents->result() as $a) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $a->teams_name; ?></td>                                                                          
                                        <td><?php echo $a->agent_name; ?></td>   
                                        <td class="text-center">
                                            <?php if ($a->agent_fb_status_id == 1) { ?>
                                                <span class="badge badge-info"><i class="fa fa-check-circle"></i> เปิดใช้งาน</span>
                                            <?php } else { ?>
                                                <span class="badge badge-light"><i class="fa fa-minus-circle"></i> ปิดใช้งาน</span>
                                            <?php } ?>
                                        </td>      
                                        <td class="text-center">
                                            <?php if ($a->agent_line_status_id == 1) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> เปิดใช้งาน</span>
                                            <?php } else { ?>
                                                <span class="badge badge-light"><i class="fa fa-minus-circle"></i> ปิดใช้งาน</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($a->agent_status_id == 0) { ?>
                                                <span class="badge badge-info"><i class="fa fa-search"></i> <?php echo $a->agent_status_name; ?></span>
                                            <?php } else if ($a->agent_status_id == 1) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo $a->agent_status_name; ?></span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger"><i class="fa fa-minus-circle"></i> <?php echo $a->agent_status_name; ?></span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php echo $a->agent_update; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="10"><i class="fa fa-info-circle"></i>&nbsp;ไม่มีรายการข้อมูล</td>
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

    <div class="col-md-6 col-sm-12">
        <div class="card">            
            <div class="card-body">
                <h4 class="card-title">
                    <a href="<?php echo base_url() . 'payment'; ?>">
                        <i class="fa fa-money"></i> Payment 5 รายการล่าสุด
                    </a>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>                                
                                <th class="text-center">#</th>
                                <th>แพ็กเกจ</th>
                                <th>ธนาคาร</th>
                                <th>โอนโดย</th>
                                <th class="text-right">จำนวนเงิน</th>
                                <th class="text-center">วันที่/เวลาโอน</th>
                                <th class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $payments = $this->dashboard_model->getPayments(5);
                            if ($payments->num_rows() > 0) {
                                $i = 1;
                                foreach ($payments->result() as $p) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $p->package_name; ?></td>                                                                          
                                        <td><?php echo $p->bank_name; ?></td>   
                                        <td><?php echo $p->user_fullname; ?></td>   
                                        <td class="text-right"><?php echo $p->payment_cost; ?></td>
                                        <td><?php echo $p->payment_date; ?>/<?php echo $p->payment_time; ?></td>   
                                        <td class="text-center">
                                            <?php if ($p->payment_status_id == 1) { ?>
                                                <span class="badge badge-info"><i class="fa fa-search"></i> <?php echo $p->payment_status_name; ?></span>
                                            <?php } else if ($p->payment_status_id == 2) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo $p->payment_status_name; ?></span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger"><i class="fa fa-minus-circle"></i> <?php echo $p->payment_status_name; ?></span>
                                            <?php } ?>
                                        </td>                                        
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="10"><i class="fa fa-info-circle"></i>&nbsp;ไม่มีรายการข้อมูล</td>
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

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card">            
            <div class="card-body">
                <h4 class="card-title">
                    <a href="<?php echo base_url() . 'teams'; ?>">
                        <i class="fa fa-users"></i> Teams 5 รายการล่าสุด
                    </a>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>                                
                                <th class="text-center">#</th>
                                <th>(รหัส) Team</th>
                                <th>แพคเกจ</th>                                               
                                <th class="text-center">วันหมดอายุ</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">อัพเดทเมื่อ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $teams = $this->dashboard_model->getTeams(5);
                            if ($teams->num_rows() > 0) {
                                $i = 1;
                                foreach ($teams->result() as $t) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>(<?php echo $t->teams_code; ?>) <?php echo $t->teams_name; ?></td>                                                                          
                                        <td><?php echo $t->package_name; ?></td>   
                                        <td class="text-center">
                                            <?php if ($t->teams_package_expire < $this->misc->getDate()) { ?>
                                                <i class="fa fa-check-circle"></i> <?php echo $t->teams_package_expire; ?>
                                            <?php } else { ?>
                                                <span class="badge badge-danger"><i class="fa fa-minus-circle"></i> <?php echo $t->teams_package_expire; ?></span>
                                            <?php } ?>                                            
                                        </td>       
                                        <td class="text-center">
                                            <?php if ($t->teams_status_id == 1) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> ปกติ</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger"><i class="fa fa-minus-circle"></i> ระงับ</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php echo $t->teams_update; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="10"><i class="fa fa-info-circle"></i>&nbsp;ไม่มีรายการข้อมูล</td>
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

    <div class="col-md-6 col-sm-12">
        <div class="card">            
            <div class="card-body">
                <h4 class="card-title">
                    <a href="<?php echo base_url() . 'user'; ?>">
                        <i class="fa fa-user-o"></i> User 5 รายการล่าสุด
                    </a>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>                                
                                <th class="text-center">#</th>
                                <th>Username</th>
                                <th>ชื่อ User</th>                                               
                                <th>Email</th>
                                <th>Team</th>
                                <th class="text-center">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $users = $this->dashboard_model->getUser(5);
                            if ($users->num_rows() > 0) {
                                $i = 1;
                                foreach ($users->result() as $u) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $u->username; ?></td> 
                                        <td><?php echo $u->user_fullname; ?> (<?php echo $u->user_tel; ?>)</td>
                                        <td><?php echo $u->user_email; ?></td>
                                        <td><?php echo $u->teams_name; ?></td>                                        
                                        <td class="text-center">
                                            <?php if ($u->user_status_id == 1) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check-circle"></i> <?php echo $u->user_status_name; ?></span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger"><i class="fa fa-minus-circle"></i> <?php echo $u->user_status_name; ?></span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="10"><i class="fa fa-info-circle"></i>&nbsp;ไม่มีรายการข้อมูล</td>
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