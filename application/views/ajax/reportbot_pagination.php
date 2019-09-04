<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="5%">#</th>
                <th width="12%">Agent</th>
                <th width="5%">from</th>
                <th width="32%">User say</th>
                <th width="32%">Bot</th>
                <th width="14%">วันที่</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count_data = $datas->num_rows();
            if ($count_data > 0) {
                $i = $segment + 1;
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
                                                        $responses .= '<div ><img src="' . $value->image->imageUri . '" style="width: 180px; height: 180px;" class="img-responsive"></div><br>';
                                                    }
                                                }
                                                // card
                                                if (!empty($value->card)) {
                                                    if (!empty($value->card->title)) {
                                                        $responses .= '<div style="width: 180px;"><div class="card" style="background: whitesmoke;"><div class="el-card-item">';
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
//                            echo '<pre>';
//                            print_r($row->hook_text);
//                            echo'</pre>';
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
<div class="row m-t-20">
    <?php
    if ($count != 0) {
        ?>
        <div class="col-lg-6">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-lg-6">
            <?php echo $links; ?>
        </div>
        <?php
    }
    ?>
</div>