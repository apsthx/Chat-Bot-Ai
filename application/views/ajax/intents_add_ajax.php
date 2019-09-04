<form id="add-form" class="intent-form" method="post" action="#" autocomplete="off">
    <input type="hidden" id="agent_id" name="agent_id" value="<?php echo $agent_id; ?>">
    <input type="hidden" id="project_id" name="project_id" value="<?php echo $project_id; ?>">
    <div class="card">
        <div class="card-body p-b-0">
            <h4 class="card-title">
                เพิ่มการสนทนา
                <span style="float: right">
                    <button type="button" id="btn-add-form" class="btn btn-sm btn-outline-info"><i id="fa-add-form" class="fa fa-save"></i> บันทึก</button>
                </span>
            </h4>
        </div>
        <ul class="nav nav-tabs customtab" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">ตั้งค่าเบื้องต้น</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" role="tab">กลุ่มคำถาม</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab3" role="tab">ตัวแปล</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab4" role="tab">การตอบกลับ</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane p-20 active" id="tab1" role="tabpanel">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h4 class="card-title">ชื่อการสนทนา</h4>
                        <div class="form-group">
                            <input type="text" name="displayName" value="" class="form-control form-control-sm" placeholder="ระบุชื่อการสนทนา" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="endInteraction" class="js-switch" data-color="#009efb" data-size="small"> ตั้งเป็นการสนทนาสุดท้าย
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h4 class="card-title">ตัวแปลนำเข้า</h4>
                        <div id="div-input-context" class="form-group">
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
                        </tbody>
                        <tfoot id="div-parameter-empty">
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
    })

    $('#add-form').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which
        if (keyCode === 13) {
            e.preventDefault()
            return false
        }
    })

    $('#btn-add-form').click(function () {
        if ($('#add-form').parsley().validate() === true) {
            $('#fa-add-form').removeClass('fa-save').addClass('fa-spinner fa-spin')
            $('#btn-add-form').prop('disabled', true)
            $.ajax({
                url: service_base_url + 'intents/addintentprocess',
                type: 'POST',
                data: $('#add-form').serialize(),
                dataType: 'JSON',
                success: function (response) {
                    setTimeout(function () {
                        $('#fa-add-form').removeClass('fa-spinner fa-spin').addClass('fa-save')
                        $('#btn-add-form').prop('disabled', false)
                        getIntent()
                        editIntent($('#agent_id').val(), response.intent_id)
                        notification(response.status, response.title, response.message)
                    }, 200)
                }
            })
        }
    })

</script>