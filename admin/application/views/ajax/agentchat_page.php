<form class="form-material m-t-40">
    <div class="form-group">
        <label style="margin-left: 3px;">USER SAYS</label>
        <p class="text-danger"><?php echo $chattext; ?></p>
        <hr style="margin-top: -5px;">
    </div>
    <div class="form-group">
        <select id="response" class="form-control form-control-line form-control-sm">
            <option value="default">DEFAULT RESPONSE</option>
            <option value="facebook">Facebook Messenger</option>
            <option value="line">Line</option>
        </select>
        <?php
        $text_default = '';
        $title_facebook = 'ไม่มีข้อมูล platform นี้';
        $title_line = 'ไม่มีข้อมูล platform นี้';
        $length = sizeof($data->queryResult->fulfillmentMessages);
        foreach ($data->queryResult->fulfillmentMessages as $key => $value) {
            if (!empty($value->text)) {
                if (!empty($value->text->text)) {
                    $length_default = sizeof($value->text->text);
                    foreach ($value->text->text as $key_default => $value_default) {
                        $text_default = '<p>' . $value_default . '</p> ';
                    }
                }
            }
            if (!empty($value->platform)) {
                if ($value->platform == 'FACEBOOK') {
                    if (!empty($value->quickReplies)) {
                        if (!empty($value->quickReplies->title)) {
                            $title_facebook = '<p>' . $value->quickReplies->title . '</p> ';
                        }
//                        if (!empty($value->quickReplies->quickReplies)) {
//                            foreach ($value->quickReplies->quickReplies as $key_quickReplies => $value_quickReplies) {
//                                $quickReplies = "<button value='$value_quickReplies' class='btn btn-sm btn-rounded btn-outline-info'>$value_quickReplies</button> ";
//                                $title_facebook .= $quickReplies;
//                            }
//                        }
                    }
                } else if ($value->platform == 'LINE') {
                    if (!empty($value->quickReplies)) {
                        if (!empty($value->quickReplies->title)) {
                            $title_line = '<p>' . $value->quickReplies->title . '</p> ';
                        }
//                        if (!empty($value->quickReplies->quickReplies)) {
//                            foreach ($value->quickReplies->quickReplies as $key_quickReplies => $value_quickReplies) {
//                                $quickReplies = "<button value='$value_quickReplies' class='btn btn-sm btn-rounded btn-outline-info'>$value_quickReplies</button> ";
//                                $title_line .= $value_quickReplies;
//                            }
//                        }
                    }
                }
            }
        }
        ?>
        <label></label>
        <div id="text_default" class="text-info" style="display: block; margin-bottom: 10px;"><?php echo $text_default; ?></div>
        <div id="text_facebook" class="text-info" style="display: none; margin-bottom: 10px;"><?php echo $title_facebook; ?></div>
        <div id="text_line" class="text-info" style="display: none; margin-bottom: 10px;"><?php echo $title_line; ?></div>
        <hr style="margin-top: -5px;">
    </div>
    <div class="form-group">
        <label style="margin-left: 3px;">INTENT</label>
        <p class="text-primary"><?php echo $data->queryResult->intent->displayName; ?></p>
        <hr style="margin-top: -5px;">
    </div>
    <div class="form-group">
        <label style="margin-left: 3px;">ACTION</label>
        <p class="text-primary"><?php //echo $data->queryResult->intent->displayName; ?></p>
        <hr style="margin-top: -5px;">
    </div>
</form>

<?php
echo '<br>';
echo '<hr>';
echo '<br>';
echo '<pre>';
print_r($data);
echo '</pre>';
?>

<script>
    $('#response').on('change', function () {
        if (this.value === 'default') {
            console.log('1');
            $('#text_default').show();
            $('#text_facebook').hide();
            $('#text_line').hide();
        } else if (this.value === 'facebook') {
            console.log('2');
            $('#text_default').hide();
            $('#text_facebook').show();
            $('#text_line').hide();
        } else if (this.value === 'line') {
            console.log('3');
            $('#text_default').hide();
            $('#text_facebook').hide();
            $('#text_line').show();
        }
    });
</script>