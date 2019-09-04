<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span class="pull-right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modalAdd();"><i class="fa fa-plus"></i> เพิ่มผู้ดูแลระบบ</button>
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-2">
                        <select id="user_status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะ</option>
                            <?php
                            $status = $this->administrator_model->getAdminStatus();
                            if ($status->num_rows() > 0) {
                                foreach ($status->result() as $s_row) {
                                    ?>
                                    <option value="<?php echo $s_row->user_status_id; ?>"><?php echo $s_row->user_status_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>  
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_pagination();">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="result_pagination" class="m-t-20" style="min-height: 400px;">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="for_modal"></div>
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
        $('#result_pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'administrator/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val(),
                user_status_id: $('#user_status_id').val()
            },
            success: function (response) {
                $('#result_pagination').html(response);
            }
        });
    }
    function modalEditpassword(admin_id, admin_username) {
        $.ajax({
            url: service_base_url + 'administrator/modaleditpassword',
            type: 'post',
            data: {
                admin_id: admin_id,
                admin_username: admin_username
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modalEditModal(admin_id) {
        $.ajax({
            url: service_base_url + 'administrator/modaledit/' + admin_id,
            type: 'post',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modalAdd() {
        $.ajax({
            url: service_base_url + 'administrator/modaladd',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function checkAdminUsername() {
        $('#bt-submit').prop('disabled', true);
        url = service_base_url + 'administrator/checkadminusername';
        if ($('#admin_username').val() != '') {
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    admin_username: $('#admin_username').val(),
                },
                success: function (res)
                {
                    if (res == 1) {
                        $('#username_massage').html('username นี้มีการใช้งานแล้ว');
                        $('#admin_username').val("")
                    } else {
                        $('#username_massage').html('');
                    }
                    $('#bt-submit').prop('disabled', false);
                }
            });
        }
    }

    //edit
    function modalEditstatus(admin_id) {
        $.ajax({
            url: service_base_url + 'administrator/modaleditstatus',
            type: 'post',
            data: {
                admin_id: admin_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditchangestatus(admin_id) {
        $.ajax({
            url: service_base_url + 'administrator/editchangestatus',
            type: 'post',
            data: {
                admin_id: admin_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
</script>