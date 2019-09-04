<?php
//echo '<pre>';
//print_r($intent);
//echo '</pre>';
$isFallback = !empty($intent->isFallback) ? 1 : 0;
$isWelcome = !empty($intent->events) ? 1 : 0;
?>
<form id="edit-form" class="intent-form" method="post" action="#" autocomplete="off">
    <input type="hidden" id="agent_id" name="agent_id" value="<?php echo $agent_id; ?>">
    <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id; ?>">
    <input type="hidden" id="intent_id" name="intent_id" value="<?php echo $intent_id; ?>">
    <input type="hidden" name="isFallback" value="<?php echo $isFallback; ?>">
    <input type="hidden" name="isWelcome" value="<?php echo $isWelcome; ?>">
    <div class="card">
        <div class="card-body p-b-0">
            <h4 class="card-title">
                แก้ไขการสนทนา
                <span style="float: right">
                    <button type="button" id="btn-edit-form" class="btn btn-sm btn-outline-info"><i id="fa-edit-form" class="fa fa-save"></i> บันทึก</button>
                    <?php if ($isFallback == 0 && $isWelcome == 0) { ?>
                        <button type="button" id="btn-confirm-delete-form" class="btn btn-sm btn-outline-danger"><i id="fa-edit-form" class="fa fa-trash"></i> ลบ</button>
                    <?php } else { ?>
                        <button type="button" class="btn btn-sm btn-outline-inverse"><i id="fa-edit-form" class="fa fa-trash"></i> ลบ</button>
                    <?php } ?>
                </span>
            </h4>
            <h6 class="card-subtitle">การสนทนา : <?php echo!empty($intent->displayName) ? $intent->displayName : ''; ?> ( <?php echo $intent_id; ?> )</h6>
        </div>
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">ตั้งค่าเบื้องต้น</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" role="tab">กลุ่มคำถาม</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab3" role="tab">ตัวแปล</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab4" role="tab">การตอบกลับ</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane p-20 active" id="tab1" role="tabpanel">
                <?php
                $inputContext = array();
                $outputContext = array();
                if (!empty($intent->inputContextNames)) {
                    foreach ($intent->inputContextNames as $row) {
                        $foo = explode('/', $row);
                        $inputContext[] = $foo[6];
                    }
                }
                if (!empty($intent->outputContexts)) {
                    foreach ($intent->outputContexts as $row) {
                        $foo = explode('/', $row->name);
                        $outputContext[] = $foo[6];
                    }
                }
                ?>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h4 class="card-title">ชื่อการสนทนา</h4>
                        <div class="form-group">
                            <input type="text" name="displayName" value="<?php echo!empty($intent->displayName) ? $intent->displayName : ''; ?>" class="form-control form-control-sm" placeholder="ระบุชื่อการสนทนา" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="endInteraction" class="js-switch" data-color="#009efb" data-size="small" <?php echo!empty($intent->endInteraction) ? 'checked' : ''; ?>> ตั้งเป็นการสนทนาสุดท้าย
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h4 class="card-title">ตัวแปลนำเข้า</h4>
                        <div id="div-input-context" class="form-group">
                            <?php
                            if (!empty($inputContext)) {
                                foreach ($inputContext as $key => $row) {
                                    ?>
                                    <div id="dic-<?php echo $key; ?>" class="input-group m-b-5">
                                        <input type="text" name="inputContext[]" class="form-control form-control-sm" value="<?php echo $row; ?>" placeholder="ระบุตัวแปลนำเข้า">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger btn-sm" type="button" onclick="$('#dic-<?php echo $key; ?>').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="dot-box" onclick="addInputContext()">
                            <div class="dot-box-message">
                                <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มตัวแปลนำเข้า</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h4 class="card-title">ตัวแปลส่งออก</h4>
                        <div id="div-output-context" class="form-group">
                            <?php
                            if (!empty($outputContext)) {
                                foreach ($outputContext as $key => $row) {
                                    ?>
                                    <div id="doc-<?php echo $key; ?>" class="input-group m-b-5">
                                        <input type="text" name="outputContext[]" class="form-control form-control-sm" value="<?php echo $row; ?>" placeholder="ระบุตัวแปลส่งออก">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger btn-sm" type="button" onclick="$('#doc-<?php echo $key; ?>').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="dot-box" onclick="addOutputContext()">
                            <div class="dot-box-message">
                                <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มตัวแปลส่งออก</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-20 " id="tab2" role="tabpanel">
                <div id="div-training-phrase" class="form-group">
                    <?php
                    if (!empty($intent->trainingPhrases)) {
                        foreach ($intent->trainingPhrases as $row) {
                            ?>
                            <div id="dtp-<?php echo $row->name ?>" class="input-group m-b-5">
                                <input type="text" name="trainingPhrase[<?php echo $row->name ?>]" class="form-control form-control-sm" value="<?php echo $row->parts[0]->text; ?>" placeholder="ระบุกลุ่มคำถาม">
                                <div class="input-group-append">
                                    <button class="btn btn-danger btn-sm" type="button" onclick="$('#dtp-<?php echo $row->name ?>').remove()"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="dot-box" onclick="addTrainingPhrase()">
                    <div class="dot-box-message">
                        <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มกลุ่มคำถาม</span>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-20 " id="tab3" role="tabpanel">
                <div class="table-responsive">
                    <table class="table-bordered table-hover table">
                        <thead>
                            <tr class="th-normal">
                                <th class="th-w-30">ชื่อตัวแปล</th>
                                <th class="th-w-20">ประเภท</th>
                                <th class="th-w-30">คำสั่ง</th>
                                <th class="th-w-20">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody id="div-parameter">
                            <?php
                            if (!empty($intent->parameters)) {
                                foreach ($intent->parameters as $row) {
                                    if (!empty($row->entityTypeDisplayName)) {
                                        ?>
                                        <tr id="ktr-<?php echo $row->name; ?>" class="ktr-check">
                                            <td><?php echo $row->displayName; ?></td>
                                            <td><?php echo $row->entityTypeDisplayName; ?></td>
                                            <td><?php echo!empty($row->prompts[0]) ? $row->prompts[0] : ''; ?></td>
                                            <td class="text-nowrap">
                                                <a href="javascript:void(0)" class="btn btn-xs btn-outline-info m-r-1" onclick="editParameterModal('<?php echo $row->name; ?>')"><i class="fa fa-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-xs btn-outline-danger" onclick="deleteParameter('<?php echo $row->name; ?>')"><i class="fa fa-close"></i></a>
                                                <input type="hidden" name="parameterID[<?php echo $row->name; ?>]" value="<?php echo $row->name; ?>">
                                                <input type="hidden" name="parameterName[<?php echo $row->name; ?>]" value="<?php echo $row->displayName; ?>">
                                                <input type="hidden" name="parameterEntity[<?php echo $row->name; ?>]" value="<?php echo $row->entityTypeDisplayName; ?>">
                                                <input type="hidden" name="parameterPrompt[<?php echo $row->name; ?>]" value="<?php echo!empty($row->prompts[0]) ? $row->prompts[0] : ''; ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot id="div-parameter-empty" >
                            <tr><td colspan="4" class="text-center"><span class="text-danger">ไม่มีตัวแปล</span></td></tr>
                        </tfoot>
                    </table>
                </div>
                <div class="dot-box" onclick="addParameterModal()">
                    <div class="dot-box-message">
                        <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มตัวแปล</span>
                    </div>
                </div>
            </div>
            <div class="tab-pane p-20 " id="tab4" role="tabpanel">
                <?php
                $response = array();
                if (!empty($intent->messages)) {
                    foreach ($intent->messages as $row) {
                        if (empty($row->platform) && !empty($row->text)) {
                            $response['text'][] = $row;
                        }
                        if (!empty($row->platform) && $row->platform == 'FACEBOOK') {
                            if (!empty($row->image)) {
                                $response['image'][] = $row;
                            } else if (!empty($row->card)) {
                                $response['card'][] = $row;
                            } else if (!empty($row->quickReplies)) {
                                $response['quickReplies'] = $row;
                            } else {
                                // not found
                            }
                        }
                    }
                }
                ?>
                <div class="row form-group">
                    <div class="col-md-12" id="scroll-response" style="height: 600px;">
                        <div id="div-response" class="row">
                            <div class="col-md-3">
                                <div class="dot-box p-t-50 p-b-50" onclick="addResponseModal()">
                                    <div class="dot-box-message">
                                        <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มการตอบกลับ</span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!empty($response['text'])) {
                                foreach ($response['text'] as $key_1 => $row_1) {
                                    ?>
                                    <div id="drt-<?php echo $key_1; ?>" class="col-md-3">
                                        <div class="card card-box">
                                            <div class="card-body p-2">
                                                <div class="d-flex no-block">
                                                    <h4 class="card-title">ข้อความ</h4>
                                                    <div class="ml-auto">
                                                        <i class="fa fa-trash cursor-pointer" onclick="$('#drt-<?php echo $key_1; ?>').remove()"></i>
                                                    </div>
                                                </div>
                                                <div id="drt-f-<?php echo $key_1; ?>" class="form-group">
                                                    <?php
                                                    if (!empty($row_1->text->text)) {
                                                        foreach ($row_1->text->text as $key_2 => $row_2) {
                                                            ?>
                                                            <div id="drt-i-<?php echo $key_2; ?>" class="input-group m-b-5">
                                                                <input type="text" name="responseText[drt-<?php echo $key_1; ?>][]" class="form-control form-control-sm" value="<?php echo $row_2; ?>" placeholder="ระบุข้อความ">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-danger btn-sm" type="button" onclick="$('#drt-i-<?php echo $key_2; ?>').remove()"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="dot-box" onclick="addResponseTextInput('drt-f-<?php echo $key_1; ?>')">
                                                    <div class="dot-box-message">
                                                        <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มข้อความ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            if (!empty($response['image'])) {
                                foreach ($response['image'] as $key => $row) {
                                    ?>
                                    <div id="dri-<?php echo $key; ?>" class="col-md-3">
                                        <div class="card card-box">
                                            <div class="card-body p-2">
                                                <div class="d-flex no-block">
                                                    <h4 class="card-title">รูปภาพ</h4>
                                                    <div class="ml-auto"><i class="fa fa-trash cursor-pointer" onclick="$('#dri-<?php echo $key; ?>').remove()"></i></div>
                                                </div>
                                                <div class="intent-image-div">
                                                    <img class="img-responsive" id="pri-<?php echo $key; ?>" src="<?php echo!empty($row->image->imageUri) ? $row->image->imageUri : ''; ?>" onerror="this.src='<?php echo base_url('assets/img/default.jpg'); ?>'">
                                                </div>
                                                <div class="m-t-5">
                                                    <div class="input-group">
                                                        <input type="text" id="iri-<?php echo $key; ?>" name="responseImage[]" class="form-control form-control-sm" value="<?php echo!empty($row->image->imageUri) ? $row->image->imageUri : ''; ?>" placeholder="ระบุที่อยู่ หรืออัพโหลดรูปภาพ" onchange="previewImage('pri-<?php echo $key; ?>', this.value)">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info btn-sm" type="button" onclick="uploadImageModal('iri-<?php echo $key; ?>')"><i class="fa fa-upload"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            if (!empty($response['card'])) {
                                foreach ($response['card'] as $key => $row) {
                                    ?>
                                    <div id="drc-<?php echo $key; ?>" class="col-md-3">
                                        <div class="card card-box">
                                            <div class="card-body p-2">
                                                <div class="d-flex no-block">
                                                    <h4 class="card-title">การ์ด</h4>
                                                    <div class="ml-auto"><i class="fa fa-trash cursor-pointer" onclick="$('#drc-<?php echo $key; ?>').remove()"></i></div>
                                                </div>
                                                <div class="intent-image-div">
                                                    <img class="img-responsive" id="prc-i-<?php echo $key; ?>" src="<?php echo!empty($row->card->imageUri) ? $row->card->imageUri : ''; ?>" onerror="this.src='<?php echo base_url('assets/img/default.jpg'); ?>'">
                                                </div>
                                                <div class="m-t-5">
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-i-<?php echo $key; ?>" name="responseCard[imageUri][<?php echo $key; ?>]" class="form-control form-control-sm" value="<?php echo!empty($row->card->imageUri) ? $row->card->imageUri : ''; ?>" placeholder="ระบุที่อยู่ หรืออัพโหลดรูปภาพ" onchange="previewImage('prc-i-<?php echo $key; ?>', this.value)">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-info btn-sm" type="button" onclick="uploadImageModal('irc-i-<?php echo $key; ?>')"><i class="fa fa-upload"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-t-3 m-b-0">
                                                        <input type="text" id="irc-t-<?php echo $key; ?>" name="responseCard[title][<?php echo $key; ?>]" class="form-control form-control-sm" value="<?php echo!empty($row->card->title) ? $row->card->title : ''; ?>" placeholder="ระบุหัวข้อ" required>
                                                    </div>
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-st-<?php echo $key; ?>" name="responseCard[subtitle][<?php echo $key; ?>]" class="form-control form-control-sm" value="<?php echo!empty($row->card->subtitle) ? $row->card->subtitle : ''; ?>" placeholder="ระบุหัวข้อย่อย">
                                                    </div>
                                                    <div class="input-group m-t-3">ปุ่มที่ 1</div>
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-b1-<?php echo $key; ?>" name="responseCard[text][<?php echo $key; ?>][0]" class="form-control form-control-sm" value="<?php echo!empty($row->card->buttons[0]->text) ? $row->card->buttons[0]->text : ''; ?>" placeholder="ระบุชื่อลิงค์">
                                                    </div>
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-p1-<?php echo $key; ?>" name="responseCard[postback][<?php echo $key; ?>][0]" class="form-control form-control-sm" value="<?php echo!empty($row->card->buttons[0]->postback) ? $row->card->buttons[0]->postback : ''; ?>" placeholder="ระบุลิงค์">
                                                    </div>
                                                    <div class="input-group m-t-3">ปุ่มที่ 2</div>
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-b2-<?php echo $key; ?>" name="responseCard[text][<?php echo $key; ?>][1]" class="form-control form-control-sm" value="<?php echo!empty($row->card->buttons[1]->text) ? $row->card->buttons[1]->text : ''; ?>" placeholder="ระบุชื่อลิงค์">
                                                    </div>
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-p2-<?php echo $key; ?>" name="responseCard[postback][<?php echo $key; ?>][1]" class="form-control form-control-sm" value="<?php echo!empty($row->card->buttons[1]->postback) ? $row->card->buttons[1]->postback : ''; ?>" placeholder="ระบุลิงค์">
                                                    </div>
                                                    <div class="input-group m-t-3">ปุ่มที่ 3</div>
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-b3-<?php echo $key; ?>" name="responseCard[text][<?php echo $key; ?>][2]" class="form-control form-control-sm" value="<?php echo!empty($row->card->buttons[2]->text) ? $row->card->buttons[2]->text : ''; ?>" placeholder="ระบุชื่อลิงค์">
                                                    </div>
                                                    <div class="input-group m-t-3">
                                                        <input type="text" id="irc-p3-<?php echo $key; ?>" name="responseCard[postback][<?php echo $key; ?>][2]" class="form-control form-control-sm" value="<?php echo!empty($row->card->buttons[2]->postback) ? $row->card->buttons[2]->postback : ''; ?>" placeholder="ระบุลิงค์">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            if (!empty($response['quickReplies']->quickReplies->title)) {
                                ?>
                                <div id="drqr-0" class="col-md-3">
                                    <div class="card card-box">
                                        <div class="card-body p-2">
                                            <div class="d-flex no-block">
                                                <h4 class="card-title">ทางเลือก</h4>
                                                <div class="ml-auto">
                                                    <i class="fa fa-trash cursor-pointer" onclick="$('#drqr-0').remove()"></i>
                                                </div>
                                            </div>
                                            <div class="input-group m-t-3">
                                                <input type="text" name="responseQuickReplie[title]" class="form-control form-control-sm" value="<?php echo!empty($response['quickReplies']->quickReplies->title) ? $response['quickReplies']->quickReplies->title : ''; ?>" placeholder="ระบุหัวข้อทางเลือก">
                                            </div>
                                            <div id="drqr-f-0" class="form-group">
                                                <?php
                                                if (!empty($response['quickReplies']->quickReplies->quickReplies)) {
                                                    foreach ($response['quickReplies']->quickReplies->quickReplies as $key => $row) {
                                                        ?>
                                                        <div id="drqr-i-<?php echo $key; ?>" class="input-group m-t-3">
                                                            <input type="text" name="responseQuickReplie[quickReplies][]" class="form-control form-control-sm" value="<?php echo $row; ?>" placeholder="ระบุทางเลือก">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-danger btn-sm" type="button" onclick="$('#drqr-i-<?php echo $key; ?>').remove()"><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="dot-box" onclick="addResponseQuickReplieInput()">
                                                <div class="dot-box-message">
                                                    <span><i class="mdi mdi-comment-plus-outline"></i> เพิ่มทางเลือก</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>

    $(document).ready(function () {
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
        $('#scroll-response').perfectScrollbar();
        if ($('.ktr-check').length) {
            $('#div-parameter-empty').hide()
        } else {
            $('#div-parameter-empty').show()
        }
    })

    $('#edit-form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which
        if (keyCode === 13) {
            e.preventDefault()
            return false
        }
    })

    $('#btn-edit-form').click(function () {
        if ($('#edit-form').parsley().validate() === true) {
            $('#fa-edit-form').removeClass('fa-save').addClass('fa-spinner fa-spin')
            $('#btn-edit-form').prop('disabled', true)
            $.ajax({
                url: service_base_url + 'intents/editintentprocess',
                type: 'POST',
                data: $('#edit-form').serialize(),
                dataType: 'JSON',
                success: function (response) {
                    setTimeout(function () {
                        $('#fa-edit-form').removeClass('fa-spinner fa-spin').addClass('fa-save')
                        $('#btn-edit-form').prop('disabled', false)
                        getIntent()
                        notification(response.status, response.title, response.message)
                    }, 200)
                }
            })
        }
    })

    $('#btn-confirm-delete-form').click(function () {
        $('#result-modal .modal-content').html('')
        $.ajax({
            url: service_base_url + 'intents/deleteintentmodal',
            type: 'POST',
            data: {
                agent_id: $('#agent_id').val(),
                intent_id: $('#intent_id').val()
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response)
                $('#result-modal').modal('show', {backdrop: 'true'})
            }
        })
    })

</script>