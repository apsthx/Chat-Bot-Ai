<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-user"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-2">
                        <select id="user_status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <?php
                            $get_user_status = $this->user_model->get_ref_user_status();
                            if ($get_user_status->num_rows() > 0) {
                                foreach ($get_user_status->result() as $user_status) {
                                    ?>
                                    <option value="<?php echo $user_status->user_status_id; ?>" <?php echo ($user_status->user_status_id == $status ? 'selected="selected"' : ''); ?>><?php echo $user_status->user_status_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select id="teams_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ทีมทั้งหมด</option>
                            <?php
                            $teams = $this->user_model->get_teams();
                            if ($teams->num_rows() > 0) {
                                foreach ($teams->result() as $team) {
                                    ?>
                                    <option value="<?php echo $team->teams_id; ?>"><?php echo $team->teams_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select id="role_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สิทธิ์ทั้งหมด</option>
                            <?php
                            $get_roles = $this->user_model->get_role();
                            if ($get_roles->num_rows() > 0) {
                                foreach ($get_roles->result() as $get_role) {
                                    ?>
                                    <option value="<?php echo $get_role->role_id; ?>"><?php echo $get_role->role_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
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
                searchtext: $('#searchtext').val(),
                user_status_id: $('#user_status_id').val(),
                role_id: $('#role_id').val(),
                teams_id: $('#teams_id').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
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