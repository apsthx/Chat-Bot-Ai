<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-users"></i> <?php echo " " . $title; ?>
                    <a style="float: right" href="<?php echo base_url() . 'teams/addteams'; ?>" class="btn btn-xs btn-rounded btn-outline-success"><i class="fa fa-plus"></i> เพิ่มทีม</a>
                </h4>
                <div class="row m-t-20">  
                    <div class="col-sm-2">
                        <select id="package_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">แพ็กเกจทั้งหมด</option>
                            <?php
                            $packages = $this->teams_model->getpackage();
                            if ($packages->num_rows() > 0) {
                                foreach ($packages->result() as $package) {
                                    ?>
                                    <option value="<?php echo $package->package_id; ?>" ><?php echo $package->package_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>  
                    <div class="col-sm-2">
                        <select id="teams_status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ทั้งหมด</option>
                            <option value="1" selected="">ปกติ</option>
                            <option value="2">ระงับ</option>
                        </select>
                    </div> 
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-xs btn-info" onclick="ajax_pagination()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">

                    </div>
                    <div class="col-sm-1 text-right">
                        <select id="per_page" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="10" selected>10</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                        </select>
                    </div> 
                </div>
                <div id="result-pagination" class="m-t-20">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="for_modal"></div>

<script>
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
            url: service_base_url + 'teams/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val(),
                package_id: $('#package_id').val(),
                teams_status_id: $('#teams_status_id').val(),
                per_page: $('#per_page').val(),
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modalEdit(teams_id) {
        $.ajax({
            url: service_base_url + 'teams/modaledit',
            type: 'post',
            data: {
                teams_id: teams_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    //edit status
    function modalEditstatus(teams_id) {
        console.log('55')
        $.ajax({
            url: service_base_url + 'teams/modaleditstatus',
            type: 'post',
            data: {
                teams_id: teams_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modalEditchangestatus(teams_id) {
        $.ajax({
            url: service_base_url + 'teams/editchangestatus',
            type: 'post',
            data: {
                teams_id: teams_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }

</script>