<div class="row">
    <div class="col-md-6 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
    </div>    
</div>

<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card bg-info">
            <div class="card-body">
                <a href="<?php echo base_url() . 'main'; ?>">
                    <div class="d-flex no-block">
                        <div class="round round-lg align-self-center round-info"><i class="mdi mdi-comment-processing-outline"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">Total ChatBot</h6>
                            <h2 class="m-t-0 text-white"><?php echo $this->dashboard_model->countAgent(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card bg-success">
            <div class="card-body">
                <a href="<?php echo base_url() . 'user'; ?>">
                    <div class="d-flex no-block">
                        <div class="round round-lg align-self-center round-success"><i class="fa fa-user-o"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">Total User</h6>
                            <h2 class="m-t-0 text-white"><?php echo $this->dashboard_model->countUser(); ?></h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card bg-danger">
            <div class="card-body">
                <a href="<?php echo base_url() . 'package'; ?>">
                    <div class="d-flex no-block">
                        <div class="round round-lg align-self-center round-danger"><i class="fa fa-dropbox"></i></div>
                        <div class="align-self-center">
                            <h6 class="text-white m-t-10 m-b-0">Upgrade Packages</h6>
                            <?php
                            $team_result = $this->dashboard_model->getTeamPackage();
                            if ($team_result->num_rows() == 1) {
                                $team = $team_result->row();
                                ?>
                                <h2 class="m-t-0 text-white"><?php echo $team->package_name; ?></h2>
                                <?php
                            } else {
                                ?>
                                <h2 class="m-t-0 text-white">-</h2>
                                <?php
                            }
                            ?>
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
                    <a href="<?php echo base_url() . 'reportbot'; ?>"><i class="fa fa-comments-o"></i> รายงานการใช้งาน</a>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">#</th>
                                <th width="15%">Agent</th>
                                <th width="5%">from</th>
                                <th width="28%">User say</th>
                                <th width="28%">Bot</th>
                                <th width="20%">วันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $datas = $this->dashboard_model->reportbot();
                            $count_data = $datas->num_rows();
                            if ($count_data > 0) {
                                $i = 1;
                                foreach ($datas->result() as $row) {
                                    $data = json_decode($row->hook_text);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php echo $row->agent_name; ?></td>
                                        <td>
                                            <?php if ($row->hook_platforms == 'line') { ?>
                                                <img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" style="width: 25px;">
                                            <?php } else if ($row->hook_platforms == 'facebook') { ?>
                                                <img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" style="width: 25px;">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url() . 'assets/img/logo-icon.png'; ?>" style="width: 25px;">
                                            <?php }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (empty($data->error)) {
                                                if (!empty($data->queryResult->queryText)) {
                                                    echo $data->queryResult->queryText;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?php
                                            $responses = '';
                                            $check = 0;
                                            if (empty($data->error)) {
                                                if (!empty($data->queryResult->fulfillmentMessages)) {
                                                    $length = sizeof($data->queryResult->fulfillmentMessages);
                                                    // เช็ค FACEBOOK
                                                    foreach ($data->queryResult->fulfillmentMessages as $key => $value) {
                                                        if (!empty($value->platform)) {
                                                            if ($value->platform == 'FACEBOOK') {
                                                                // text
                                                                if (!empty($value->text)) {
                                                                    if (!empty($value->text->text)) {
                                                                        foreach ($value->text->text as $key_text => $value_text) {
                                                                            $responses .= '<p>' . $value_text . '</p> ';
                                                                        }
                                                                    }
                                                                }
                                                                // quickreplies
                                                                if (!empty($value->quickReplies)) {
                                                                    if (!empty($value->quickReplies->title)) {
                                                                        $responses .= '<p>' . $value->quickReplies->title . '</p> ';
                                                                    }
                                                                    if (!empty($value->quickReplies->quickReplies)) {
                                                                        foreach ($value->quickReplies->quickReplies as $key_quickReplies => $value_quickReplies) {
                                                                            $quickRepliesbutton = '<button type="button" class="btn btn-sm btn-rounded btn-outline-info">' . $value_quickReplies . '</button> ';
                                                                            $responses .= $quickRepliesbutton;
                                                                        }
                                                                    }
                                                                }
                                                                // image
                                                                if (!empty($value->image)) {
                                                                    if (!empty($value->image->imageUri)) {
                                                                        $responses .= '<div ><img src="' . $value->image->imageUri . '" style="width: 100px; height: 100px;" class="img-responsive"></div><br>';
                                                                    }
                                                                }
                                                                // card
                                                                if (!empty($value->card)) {
                                                                    if (!empty($value->card->title)) {
                                                                        $responses .= '<div style="width: 100px;"><div class="card" style="background: whitesmoke;"><div class="el-card-item">';
                                                                    }
                                                                    if (!empty($value->card->imageUri)) {
                                                                        $responses .= '<div class="el-card-avatar el-overlay-1"><img class="card-img-top img-responsive" src="' . $value->card->imageUri . '" class="card-img-top img-responsive"></div>';
                                                                    }
                                                                    if (!empty($value->card->title)) {
                                                                        $responses .= '<div class="el-card-content">';
                                                                        $responses .= '<h4 class="box-title text-left" style="font-weight: bold;">' . $value->card->title . '</h4>';
                                                                    }
                                                                    if (!empty($value->card->subtitle)) {
                                                                        $responses .= '<h6 class="box-title text-left">' . $value->card->subtitle . '</h6>';
                                                                    }
                                                                    if (!empty($value->card->buttons)) {
                                                                        foreach ($value->card->buttons as $key_cardbuttons => $value_cardbuttons) {
                                                                            if (!empty($value_cardbuttons->text)) {
                                                                                if (!empty($value_cardbuttons->postback)) {
                                                                                    if (filter_var($value_cardbuttons->postback, FILTER_VALIDATE_URL) === FALSE) {
                                                                                        $responses .= '<div class="text-center"><button type="button" class="btn btn-sm btn-block btn-outline-info">' . $value_cardbuttons->text . '</button></div>';
                                                                                    } else {
                                                                                        $responses .= "<div class='text-center'><a href='$value_cardbuttons->postback' class='btn btn-sm btn-block btn-outline-info' target='_blank'>$value_cardbuttons->text</a></div>";
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    if (!empty($value->card->title)) {
                                                                        $responses .= '<br/></div></div></div></div>';
                                                                    }
                                                                }
                                                                $check = 1;
                                                            }
                                                        }
                                                    }
                                                    // เช็คธรรมดา
                                                    if ($check == 0) {
                                                        foreach ($data->queryResult->fulfillmentMessages as $key => $value) {
                                                            if (!empty($value->text)) {
                                                                if (!empty($value->text->text)) {
                                                                    $length_default = sizeof($value->text->text);
                                                                    foreach ($value->text->text as $key_default => $value_default) {
                                                                        $responses .= '<p>' . $value_default . '</p> ';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                            echo $responses;
                                            ?>
                                        </td>
                                        <td><?php echo $this->misc->date2thai($row->hook_modify, '%d %m %y %h:%i', 1); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
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
                    <a href="<?php echo base_url() . 'reportstatistic'; ?>"><i class="fa fa-comments-o"></i> รายงานสถิติ 10 อันดับ Intents</a>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" width="6%">#</th>
                                <th >Agent / Intents</th>
                                <th class="text-center"><img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" style="width: 25px;"></th>
                                <th class="text-center"><img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" style="width: 25px;"></th>        
                                <th class="text-center"><img src="<?php echo base_url() . 'assets/img/logo-icon.png'; ?>" style="width: 25px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $intents = $this->dashboard_model->get_hook_intents();
                            $i = 1;
                            if ($intents->num_rows() > 0) {
                                foreach ($intents->result() as $intent) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php echo $intent->agent_name . ' / ' . $intent->hook_intents_name; ?></td>
                                        <td class="text-center"><?php echo number_format($this->dashboard_model->count_hook('facebook', $intent->hook_project_id, $intent->hook_intents_id), 0); ?></td>
                                        <td class="text-center"><?php echo number_format($this->dashboard_model->count_hook('line', $intent->hook_project_id, $intent->hook_intents_id), 0); ?></td>
                                        <td class="text-center"><?php echo number_format($this->dashboard_model->count_hook('ai-aps', $intent->hook_project_id, $intent->hook_intents_id), 0); ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');
    });
</script>