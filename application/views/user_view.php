<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user-o"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <?php if ($this->user_model->check_package() > $this->user_model->check_user()) { ?>
                            <button onclick="modal_add();" class="btn btn-sm btn-rounded btn-outline-success"><i class="fa fa-plus"></i> เพิ่ม User</button>
                        <?php } else { ?>
                            <a href="<?php echo base_url() . 'package' ?>" target="_blank" class="btn btn-sm btn-rounded btn-outline-danger"><i class="fa fa-ban"></i> อัพเดทแพ็กเกจ ( เพื่อเพิ่ม User ) </a>
                        <?php } ?>
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-lg-3">
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_pagination()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="result-pagination" class="m-t-20" style="min-height: 400px;"></div>
            </div>
        </div>
    </div>
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

<script>

    var service_base_url = $('#service_base_url').val();

    $(function () {
        ajax_pagination();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'user/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modal_add() {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/add_user_modal',
            type: 'POST',
            success: function (response) {
                $('#result-modal-lg .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#btn-submit').prop('disabled', true);
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit(user_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/edit_user_modal',
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#result-modal-lg .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#btn-submit').prop('disabled', true);
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit_password(user_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/password_user_modal',
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit_status(user_id, type) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'user/status_user_modal',
            type: 'POST',
            data: {
                user_id: user_id,
                type: type
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

</script>