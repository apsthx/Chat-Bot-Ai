<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-facebook-official"></i> <?php echo " " . $title; ?>
                    <span class="pull-right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modal_add();"><i class="fa fa-plus"></i> เพิ่ม Facebook App</button>
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-2">
                        <select id="app_facebook_use" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <option value="0">ว่าง</option>
                            <option value="1">ใช้เเล้ว</option>
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
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'facebookapp/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val(),
                app_facebook_use: $('#app_facebook_use').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modal_add() {
        $.ajax({
            url: service_base_url + 'facebookapp/modaladd',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modal_edit(app_facebook_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'facebookapp/modaledit',
            type: 'POST',
            data: {
                app_facebook_id: app_facebook_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modal_edit_status(app_facebook_id_pri) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'facebookapp/status_facebookapp_modal',
            type: 'POST',
            data: {
                app_facebook_id_pri: app_facebook_id_pri
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

</script>