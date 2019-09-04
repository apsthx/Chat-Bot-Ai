<form class="form-material m-t-40">
    <div class="form-group">
        <label style="margin-left: 3px;">USER SAYS</label>
        <p class="text-danger"><?php echo $chattext; ?></p>
        <hr style="margin-top: -5px;">
    </div>
    <div class="form-group">
        <?php
        $responses = '';
        $intent = 'error';
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
                                        $quickRepliesbutton = '<button type="button" onclick="quickreplies(' . "'" . $value_quickReplies . "'" . ');" class="btn btn-sm btn-rounded btn-outline-info">' . $value_quickReplies . '</button>';
                                        $responses .= $quickRepliesbutton;
                                    }
                                }
                            }
                            // image
                            if (!empty($value->image)) {
                                if (!empty($value->image->imageUri)) {
                                    $responses .= '<div class="text-center"><img src="' . $value->image->imageUri . '" style="width: 180px; height: 180px;" class="img-responsive"></div><br>';
                                }
                            }
                            // card
                            if (!empty($value->card)) {
                                if (!empty($value->card->title)) {
                                    $responses .= '<div class="text-center"><div class="card" style="background: whitesmoke;"><div class="el-card-item">';
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
                                                    $responses .= '<div class="text-center"><button type="button" onclick="quickreplies(' . "'" . $value_cardbuttons->postback . "'" . ');" class="btn btn-sm btn-block btn-outline-info">' . $value_cardbuttons->text . '</button></div>';
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
                $intent = $data->queryResult->intent->displayName;
            }
        }
        ?>
        <label>Responses</label>
        <div id="responses" class="text-info" style="display: block; margin-bottom: 10px;"><?php echo $responses; ?></div>     
        <hr style="margin-top: -5px;">
    </div>
    <div class="form-group">
        <label style="margin-left: 3px;">INTENT</label>
        <p class="text-primary"><?php echo $intent; ?></p>
        <hr style="margin-top: -5px;">
    </div>
    <!--    <div class="form-group">
            <label style="margin-left: 3px;">ACTION</label>
            <p class="text-primary"><?php //echo $data->queryResult->intent->displayName;    ?>                                                    ?></p>
            <hr style="margin-top: -5px;">
        </div>-->
    <!--    <div class="form-group">
            <button type="button" class="btn btn-sm btn-block btn-warning" onclick="modal_chat();"><i class="fa fa-commenting"></i> Chat Default</button>
        </div>-->
</form>
<?php
//echo '<br>';
//echo '<hr>';
//echo '<br>';
//echo '<pre>';
//print_r($data);
//echo '</pre>';
?>
<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-commenting"></i>&nbsp;Chat Default</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center" style="">
                <div style="">
<!--                    <iframe style="" width="450" height="500" src="https://console.dialogflow.com/api-client/demo/embedded/3dce0abc-3ac9-4b81-8d43-fa92f268ad41"<?php //echo $data->responseId;                                       ?>>
                    </iframe>-->
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true" ><i class="fa fa-close"></i> ปิด</button>
            </div>
        </div>                    
    </div>
</div>       
<script>
    function modal_chat() {
        $('#on_modal').modal('show', {backdrop: 'true'});
    }

    function close_dialogflow() {
        $('.b-agent-demo_powered_by').hide();
    }

</script>