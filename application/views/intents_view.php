<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="mdi mdi-comment-processing-outline"></i> รายการสนทนา
                    <span style="float: right">
                        <a href="<?php echo base_url() . 'main/setting/' . $agent_id ?>"><i class="icon-settings"></i> ตั้งค่า</a>
                    </span>
                </h4>
                <div id="result-intent" class="table-responsive"></div>
            </div>
        </div>
    </div>
    <div id="result-form" class="col-md-9"></div>
</div>

<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<div class="col-md-7 col-4 align-self-center">
    <div class="d-flex m-t-10 justify-content-end">
        <div class="">
            <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10 btn-chat"><i style="font-size: 28px;top: 10px;left: 12px" class="fa fa-comments-o text-white"></i></button>
        </div>
    </div>
</div>

<div id="parameter-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="parameter-form" method="post" action="#" autocomplete="off">
                <input type="hidden" id="input-parameter-id" value="">
                <div class="modal-header">
                    <h4 class="modal-title">จัดการตัวแปล</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">ชื่อตัวแปล <span class="text-danger">*</span></label>
                        <input type="text" id="input-parameter-name" class="form-control form-control-sm" pattern="[0-9a-zA-z]+" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ประเภท <span class="text-danger">*</span></label>
                        <select id="input-parameter-entity" class="form-control form-control-sm" required>
                            <option value="@sys.date-time">@sys.date-time</option>
                            <option value="@sys.date">@sys.date</option>
                            <option value="@sys.date-period">@sys.date-period</option>
                            <option value="@sys.time">@sys.time</option>
                            <option value="@sys.time-period">@sys.time-period</option>
                            <option value="@sys.number">@sys.number</option>
                            <option value="@sys.cardinal">@sys.cardinal</option>
                            <option value="@sys.ordinal">@sys.ordinal</option>
                            <option value="@sys.number-integer">@sys.number-integer</option>
                            <option value="@sys.unit-area">@sys.unit-area</option>
                            <option value="@sys.unit-currency">@sys.unit-currency</option>
                            <option value="@sys.unit-length">@sys.unit-length</option>
                            <option value="@sys.unit-speed">@sys.unit-speed</option>
                            <option value="@sys.unit-volume">@sys.unit-volume</option>
                            <option value="@sys.unit-weight">@sys.unit-weight</option>
                            <option value="@sys.unit-information">@sys.unit-information</option>
                            <option value="@sys.temperature">@sys.temperature</option>
                            <option value="@sys.currency-name">@sys.currency-name</option>
                            <option value="@sys.unit-area-name">@sys.unit-area-name</option>
                            <option value="@sys.unit-length-name">@sys.unit-length-name</option>
                            <option value="@sys.unit-speed-name">@sys.unit-speed-name</option>
                            <option value="@sys.unit-volume-name">@sys.unit-volume-name</option>
                            <option value="@sys.unit-weight-name">@sys.unit-weight-name</option>
                            <option value="@sys.unit-information-name">@sys.unit-information-name</option>
                            <option value="@sys.zip-code">@sys.zip-code</option>
                            <option value="@sys.geo-capital">@sys.geo-capital</option>
                            <option value="@sys.geo-country">@sys.geo-country</option>
                            <option value="@sys.geo-city">@sys.geo-city</option>
                            <option value="@sys.geo-state">@sys.geo-state</option>
                            <option value="@sys.given-name">@sys.given-name</option>
                            <option value="@sys.last-name">@sys.last-name</option>
                            <option value="@sys.music-artist">@sys.music-artist</option>
                            <option value="@sys.music-genre">@sys.music-genre</option>
                            <option value="@sys.color">@sys.color</option>
                            <option value="@sys.language">@sys.language</option>
                            <option value="@sys.any">@sys.any</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">คำสั่ง <span class="text-danger">*</span></label>
                        <input type="text" id="input-parameter-prompt" class="form-control form-control-sm" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-parameter-form" class="btn btn-outline-info" onclick="processParameter()"><i id="fa-parameter-form" class="fa fa-save"></i> บันทึก</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-inverse"><i class="fa fa-close"></i> ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="response-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มการตอบกลับ</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="dot-box" onclick="addResponseText()">
                            <div class="dot-box-message">
                                <div class="icon">
                                    <img src="<?php echo base_url('assets/css/icons/linea-svg-icons/basic_message.svg'); ?>" class="icon-all">
                                </div>
                                <span>ข้อความ</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dot-box" onclick="addResponseImage()">
                            <div class="dot-box-message">
                                <div class="icon">
                                    <img src="<?php echo base_url('assets/css/icons/linea-svg-icons/basic_picture_multiple.svg'); ?>" class="icon-all">
                                </div>
                                <span>รูปภาพ</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-t-20">
                    <div class="col-md-6">
                        <div class="dot-box" onclick="addResponseCard()">
                            <div class="dot-box-message">
                                <div class="icon">
                                    <img src="<?php echo base_url('assets/css/icons/linea-svg-icons/basic_postcard.svg'); ?>" class="icon-all">
                                </div>
                                <span>การ์ด</span>
                            </div>
                        </div>
                    </div>
                    <div id="show-quick-replie" class="col-md-6">
                        <div class="dot-box" onclick="addResponseQuickReplie()">
                            <div class="dot-box-message">
                                <div class="icon">
                                    <img src="<?php echo base_url('assets/css/icons/linea-svg-icons/basic_share.svg'); ?>" class="icon-all">
                                </div>
                                <span>ทางเลือก</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-outline-inverse"><i class="fa fa-close"></i> ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<div id="upload-image-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="upload-image-form" method="post" action="#" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>">
                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                <input type="hidden" id="for-id" value="">
                <div class="modal-header">
                    <h4 class="modal-title">จัดการรูปภาพ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <!--
                    <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabmodal1" role="tab">อัพโหลดรูปภาพ</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabmodal2" role="tab">ค้นหารูปภาพ</a></li>
                    </ul>
                    -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabmodal1" role="tabpanel">
                            <div class="form-group">
                                <label class="control-label col-form-label" style="font-weight: bold;"> รูปภาพ : <span class="text-danger">*</span></label>
                                <div class="text-center">
                                    <img id="file_image_preview" src="<?php echo base_url('assets/img/default.jpg'); ?>" class="img-responsive m-b-5">
                                    <input type="file" name="file_image" id="file_image" style="display: none;" required>
                                    <label for="file_image" class="btn btn-block btn-sm btn-outline-info"><i class="fa fa-image"></i> เลือกรูปภาพ</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="tabmodal2" role="tabpanel">
                            <div class="form-group">
                                <label class="control-label col-form-label" style="font-weight: bold;"> ค้นหารูปภาพ</label>
                                <div class="input-group">
                                    <input type="text" id="search-image-text" class="form-control form-control-sm" value="" placeholder="ระบุคำค้นหารูปภาพ">
                                    <div class="input-group-append">
                                        <button class="btn btn-info btn-sm" type="button" onclick="searchImage()"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-form-label" style="font-weight: bold;"> รายการรูปภาพ</label>
                                <div class="row">
                                    <div class="col-md-12"  id="scroll-image" style="height: 300px;">
                                        <div id="result-image" class="row p-10">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="upload-image-btn" class="btn btn-outline-info" onclick="uploadImageProcess()"><i id="upload-image-fa" class="fa fa-save"></i> บันทึก</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-inverse"><i class="fa fa-close"></i> ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> ChatBot Test<span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
            <div class="row m-t-20">
                <div class="col-sm-12">
                    <div class="input-group">
                        <input type="text" id="chattext" class="form-control form-control-sm" value="" placeholder="Try it now">
                        <input type="hidden" id="agent_id" value="<?php echo $agent_id; ?>" class="form-control form-control-sm">
                        <input type="hidden" id="sessions_id" value="" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div id="result-page" class="m-t-20">
                <form class="form-material m-t-40">
                    <div class="form-group">
                        <label style="margin-left: 3px;">USER SAYS</label>
                        <p class="text-danger"><?php //echo $chattext;        ?></p>
                        <hr style="margin-top: 5px;">
                    </div>
                    <div class="form-group">
                        <label>Responses</label>
                        <div id="responses" class="text-info" style="display: block; margin-bottom: 10px;"><?php //echo $responses;        ?></div>
                        <hr style="margin-top: 5px;">
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 3px;">INTENT</label>
                        <p class="text-primary"><?php //echo $intent;        ?></p>
                        <hr style="margin-top: 5px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-circle.right-side-toggle{
        z-index: 999999;
    }
    .right-side-toggle i{
        top: 8px;
        -webkit-animation-name: none !important;
        animation-name: none !important;
    }
</style>

<script>

    const agent_id = '<?php echo $agent_id; ?>'

    $(document).ready(function () {
        getIntent()
        sessions()
        $('#scroll-image').perfectScrollbar()

        var url = service_base_url + 'main';
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');
    })

    function getIntent() {
        $('#result-intent').html('<div style="text-align:center;padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/getintent',
            type: 'POST',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                $('#result-intent').html(response)
            }
        })
    }

    function addIntent() {
        $('#result-form').html('<div style="text-align:center;padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/addintent',
            type: 'POST',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                $('#result-form').html(response)
            }
        })
    }

    function editIntent(agent_id, intent_id) {
        $('#result-form').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/editintent',
            type: 'POST',
            data: {
                agent_id: agent_id,
                intent_id: intent_id
            },
            success: function (response) {
                $('#result-form').html(response)
            }
        })
    }

    function previewFileImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader()
            reader.onload = function (e) {
                $('#file_image_preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0])
        }
    }

    $('#file_image').change(function () {
        previewFileImage(this)
    })

// 
    $('#chattext').keypress(function (e) {
        if (e.which == 13) {
            chatbot();
        }
    });

    $('#agent_id').on('change', function () {
        sessions();
        //chatbot();
    });

    function chatbot() {
        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/chattest',
            type: 'POST',
            data: {
                chattext: $('#chattext').val(),
                agent_id: $('#agent_id').val(),
                sessions_id: $('#sessions_id').val(),
            },
            success: function (response) {
                $('#chattext').val('');
                //console.log(response);
                $('#result-page').html(response);
            }
        });
    }

    function sessions() {
        $('#sessions_id').val('');
        var d = new Date();
        var n = d.getTime();
        $('#sessions_id').val($('#agent_id').val() + '-' + n);
    }

    function quickreplies(text) {
        $('#chattext').val(text);
        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'agent/chattest',
            type: 'POST',
            data: {
                chattext: text,
                agent_id: $('#agent_id').val(),
                sessions_id: $('#sessions_id').val(),
            },
            success: function (response) {
                $('#chattext').val('');
                //console.log(response);
                $('#result-page').html(response);
            }
        });
    }
</script>