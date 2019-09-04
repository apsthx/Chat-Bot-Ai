<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>
                <div class="row m-t-20">
                    <div class="col-lg-2">
                        <input type="text" id="searchdate_input" class="form-control form-control-sm" onchange="date_convert('searchdate_input', 'searchdate')" placeholder="เลือกวันที่" value="">
                        <input type="hidden" id="searchdate" value="" onchange="ajax_pagination()">
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
                <div id="result-pagination" class="m-t-20"></div>
            </div>
        </div>
    </div>
</div>


<script>
    var service_base_url = $('#service_base_url').val();

    $(document).ready(function () {
        $('#searchdate_input').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
        ajax_pagination();

        $('#searchtext').keypress(function (e) {
            if (e.which == 13) {
                ajax_pagination();
            }
        });
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'logagent/ajax_pagination',
            type: 'POST',
            data: {
                searchdate: $('#searchdate').val(),
                searchtext: $('#searchtext').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

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
    }

</script>