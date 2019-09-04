<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?></h4>  
                <br/>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-left">
                            <span> เลือกวันที่ </span>
                            <input type="text" id="start_date_input" class="form-control form-control-sm col-sm-5" onchange="date_convert('start_date_input', 'start_date')" required="">
                            <input type="hidden" id="start_date" name="start_date" class="form-control form-control-sm">
                            <span> ถึง </span>                            
                            <input type="text" id="end_date_input" class="form-control form-control-sm col-sm-5" onchange="date_convert('end_date_input', 'end_date')" required="">
                            <input type="hidden" id="end_date" name="end_date" class="form-control form-control-sm" required="">
                        </div>
                    </div>     
                    <div class="col-sm-2">
                        <select id="payment_status_id" class="form-control form-control-sm" onchange="load();">
                            <option value="" >สถานะทั้งหมด</option>
                            <?php
                            $payment_status = $this->payment_model->get_payment_status();
                            $ps = 1;
                            if ($payment_status->num_rows() > 0) {
                                foreach ($payment_status->result() as $ps_row) {
                                    ?>
                                    <option value="<?php echo $ps_row->payment_status_id; ?>" <?php echo ($ps == 1 ? 'selected="selected"' : ''); ?>><?php echo $ps_row->payment_status_name; ?></option>
                                    <?php
                                    $ps++;
                                }
                            }
                            ?>
                        </select>
                    </div>      
                    <div class="col-sm-2">
                        <button class="btn btn-sm btn-outline-info" onclick="load();"><i class="fa fa-search"></i> กรองข้อมูล</button> 
                    </div>
                </div>
                <div id="result_pagination" class="m-t-20" style="min-height: 400px;"></div>
            </div>
        </div>
    </div>
</div>
<div id="for_modal"></div>

<script>
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
        load();
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
    }

    function load() {
        $('#result_pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'payment/ajax_pagination',
            type: 'post',
            data: {
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                payment_status_id: $('#payment_status_id').val(),
                package_type_id: $('#package_type_id').val()
            },
            success: function (response) {
                $('#result_pagination').html(response);
            }
        });
    }

    function check(payment_id, active) {
        $.ajax({
            url: service_base_url + 'payment/check',
            type: 'post',
            data: {
                payment_id: payment_id,
                check: active
            },
            success: function (res) {
                notification('success', 'Success', 'บันทึกเรียบร้อยเเล้ว');
                if (res == 2) {
                    $('#status-' + payment_id).html('<span class="label label-success">ผ่าน</span>');
                } else {
                    $('#status-' + payment_id).html('<span class="label label-danger">ไม่ผ่าน</span>');
                }
            }
        });
    }

    function switchCheck(payment_id) {
        if ($('#sw-' + payment_id).is(':checked')) {
            check(payment_id, 2);
            $('#status-' + payment_id).html('<span class="label label-success">ผ่าน</span>');

        } else {
            check(payment_id, 3);
            $('#status-' + payment_id).html('<span class="label label-danger">ไม่ผ่าน</span>');
        }
    }

</script>
