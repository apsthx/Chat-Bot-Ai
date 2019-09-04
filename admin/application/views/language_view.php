<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                         <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="add_modal();"><i class="fa fa-plus"></i> เพิ่มคำ</button>
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
                <div id="result-pagination" class="m-t-20"></div>
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
            url: service_base_url + 'language/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function add_modal() {
        $.ajax({
            url: service_base_url + 'language/add_modal',
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function edit_modal(word_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'language/edit_modal',
            type: 'POST',
            data: {
                word_id: word_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function delete_modal(word_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'language/delete_modal',
            type: 'POST',
            data: {
                word_id: word_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }
</script>