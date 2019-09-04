<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-hook-o"></i> <?php echo " " . $title; ?>
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
                            <?php foreach ($this->reportbot_model->get_agent()->result() as $agent) { ?>
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
                    <div class="col-lg-5">
                        <div class="text-right">
                            <span> วันที่ </span>
                            <input type="text" id="start_date_input" class="form-control form-control-sm col-sm-3" value="<?php echo date('d/m') . '/' . (date('Y') + 543); ?>" onchange="date_convert('start_date_input', 'date_start_report')" required="">
                            <input type="hidden" id="date_start_report" name="date_start_report" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm">
                            <span> ถึง </span>
                            <input type="text" id="end_date_input" class="form-control form-control-sm col-sm-3" value="<?php echo date('d/m') . '/' . (date('Y') + 543); ?>" onchange="date_convert('end_date_input', 'date_end_report')" required="">
                            <input type="hidden" id="date_end_report" name="date_end_report" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm" required="">
                            &nbsp;
                            <button class="btn btn-sm btn-outline-primary"  onclick="dateall_report();"><i class="fa fa-calendar"></i> วันที่ทั้งหมด</button>
                            <!--<button class="btn btn-sm btn-outline-success"  onclick="excel();"><i class="fa fa-file-excel-o"></i> ออกรายงาน</button>-->
                        </div>
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
            url: service_base_url + 'reportbot/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val(),
                hook_project_id: $('#hook_project_id').val(),
                hook_platforms: $('#hook_platforms').val(),
                date_start_report: $('#date_start_report').val(),
                date_end_report: $('#date_end_report').val(),
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

</script>