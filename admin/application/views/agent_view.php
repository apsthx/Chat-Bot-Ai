<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <a href="javascript:void()" onclick="modalAdd();" class="btn btn-xs btn-outline-success"><i class="fa fa-plus"></i> เพิ่ม ChatBot</a>
                    </span>                    
                </h4>
                <div class="row m-t-20">  
                    <div class="col-sm-2">
                        <select id="agent_status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <?php
                            $get_agent_status = $this->agent_model->get_ref_agent_status();
                            if ($get_agent_status->num_rows() > 0) {
                                foreach ($get_agent_status->result() as $agent_status) {
                                    ?>
                                    <option value="<?php echo $agent_status->agent_status_id; ?>" <?php echo ($agent_status->agent_status_id == $status ? 'selected="selected"' : ''); ?>><?php echo $agent_status->agent_status_name; ?></option>
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
                            $teams = $this->agent_model->get_teams();
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
                        <select id="agent_type_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ประเภททั้งหมด</option>
                            <?php
                            $types = $this->agent_model->get_ref_agent_types();
                            if ($types->num_rows() > 0) {
                                foreach ($types->result() as $type) {
                                    ?>
                                    <option value="<?php echo $type->agent_type_id; ?>"><?php echo $type->agent_type_name; ?></option>
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
                                <button type="button" class="btn btn-xs btn-info" onclick="ajax_pagination()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
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
                <div id="result-pagination" class="m-t-20" style="min-height: 40vh;">
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
            url: service_base_url + 'agent/ajax_pagination',
            type: 'POST',
            data: {
                agent_status_id: $('#agent_status_id').val(),
                agent_type_id: $('#agent_type_id').val(),
                teams_id: $('#teams_id').val(),
                searchtext: $('#searchtext').val(),
                per_page: $('#per_page').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modalAdd() {
        $.ajax({
            url: service_base_url + 'agent/modaladd',
            type: 'post',
            data: {
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modalEdit(agent_id) {
        $.ajax({
            url: service_base_url + 'agent/modaledit',
            type: 'post',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    //edit status
    function modalEditstatus(agent_id) {
        $.ajax({
            url: service_base_url + 'agent/modaleditstatus',
            type: 'post',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function modalEditchangestatus(agent_id) {
        $.ajax({
            url: service_base_url + 'agent/editchangestatus',
            type: 'post',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }


    function checkactive(agent_id) {
        //console.log(agent_id);
        $.ajax({
            url: service_base_url + 'agent/checkactive',
            type: 'post',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                if (response == 1) {
                    notification('success', 'Success', 'ตรวจสอบสำเร็จ');
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else if (response == 2) {
                    notification('error', 'Error', 'เกิดข้อผิดพลาด');
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else if (response == 0) {
                    notification('error', 'Error', 'เกิดข้อผิดพลาด');
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else {
                    notification('error', 'Error webhookState', 'เปิด webhookState ไม่ได้');
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            },
            error: function (xhr, status, error) {
                notification('error', 'Error', 'เกิดข้อผิดพลาด');
                setTimeout(function () {
                    location.reload();
                }, 3000);
            }
        });
    }

    function switchfb(agent_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'agent/fb/1';
            $.post(url, {agent_id: agent_id}, function (response) {
                notification('success', 'Success', 'เปิดใช้งานสำเร็จ');
            });
        } else {
            var url = service_base_url + 'agent/fb/0';
            $.post(url, {agent_id: agent_id}, function (response) {
                notification('success', 'Success', 'ปิดใช้งานสำเร็จ');
            });
        }
    }

    function switchline(agent_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'agent/line/1';
            $.post(url, {agent_id: agent_id}, function (response) {
                notification('success', 'Success', 'เปิดใช้งานสำเร็จ');
            });
        } else {
            var url = service_base_url + 'agent/line/0';
            $.post(url, {agent_id: agent_id}, function (response) {
                notification('success', 'Success', 'ปิดใช้งานสำเร็จ');
            });
        }
    }

</script>