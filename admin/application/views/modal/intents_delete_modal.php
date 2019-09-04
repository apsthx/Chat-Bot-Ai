<form id="delete-form" method="post" action="#" autocomplete="off">
    <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>" required>
    <input type="hidden" name="intent_id" value="<?php echo $intent_id; ?>" required>
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-warning"></i> ยืนยันทำรายการ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="bootbox-body">
            <h4 class="text-center m-t-5">ต้องการลบข้อมูลใช่หรือไม่ ?</h4>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btn-delete-form" class="btn btn-outline-info"><i id="fa-delete-form" class="fa fa-check"></i> ยืนยัน</button>
        <button type="button" class="btn btn-outline-inverse" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>

    $('#delete-form').parsley()

    $('#btn-delete-form').click(function () {
        if ($('#delete-form').parsley().validate() === true) {
            $('#fa-delete-form').removeClass('fa-check').addClass('fa-spinner fa-spin')
            $('#btn-delete-form').prop('disabled', true)
            $.ajax({
                url: service_base_url + 'intents/deleteintentprocess',
                type: 'POST',
                data: $('#delete-form').serialize(),
                dataType: 'JSON',
                success: function (response) {
                    setTimeout(function () {
                        getIntent()
                        addIntent()
                        $('#result-modal').modal('hide')
                        notification(response.status, response.title, response.message)
                    }, 200)
                }
            })
        }
    })

</script>