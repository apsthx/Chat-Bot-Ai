<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-hook-o"></i> <?php echo " Training"; ?>
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
                    <div class="col-lg-2">
                        <select id="hook_project_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">Chatbot ทั้งหมด</option>
                            <?php foreach ($this->training_model->get_agent()->result() as $agent) { ?>
                                <option value="<?php echo $agent->agent_id; ?>"><?php echo $agent->agent_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select id="hook_platforms" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">From ทั้งหมด</option>
                            <option value="ai-aps">ai-aps</option>
                            <option value="facebook">facebook</option>
                            <option value="line">line</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select id="training_status" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <option value="1" selected="">รอ Training</option>
                            <option value="2">Training</option>
                        </select>
                    </div>
                </div>
                <div id="result-pagination" class="m-t-20">

                </div>
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
    $(function () {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');
    });

    var service_base_url = $('#service_base_url').val();

    $(document).ready(function () {
        $('#start_date_input').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        $('#end_date_input').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        ajax_pagination();
    });
    
    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function date_convert(input_id, output_id) {
        let get_date = $('#' + input_id).val();
        if (get_date != '') {
            let split_date = get_date.split('/');
            let date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0];
            $('#' + output_id).val(date);
        } else {
            $('#' + output_id).val('');
        }
        $('#' + output_id).change();
        ajax_pagination();
    }

    function ajax_pagination() {
        //console.log($('#date_start_report').val()),
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'training/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val(),
                hook_project_id: $('#hook_project_id').val(),
                hook_platforms: $('#hook_platforms').val(),
                date_start_report: $('#date_start_report').val(),
                date_end_report: $('#date_end_report').val(),
                training_status: $('#training_status').val(),
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function dateall_report() {
        $('#start_date_input').val('');
        $('#end_date_input').val('');
        $('#date_start_report').val('');
        $('#date_end_report').val('');
        ajax_pagination();
    }
    
    function modal_training(training_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'training/training_modal',
            type: 'POST',
            data: {
                training_id: training_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#form-modal').parsley().reset();
                $('#btn-submit').prop('disabled', true);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }
</script>