<div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 align-self-center">
        <h3 class="text-themecolor">ChatBot</h3>
    </div> 
    <div class="col-lg-2 col-md-2 align-self-center"></div> 
    <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 align-self-center">     
        <input type="text" id="searchtext" class="form-control" placeholder="คำค้นหา">
    </div>
    <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 align-self-center text-right m-t-3">        
        <?php
        $result = $this->main_model->check_package();
        if ($result->num_rows() == 1) {
            $row = $result->row();
            if ($row->package_agent > $this->main_model->check_agent() && $row->teams_package_expire >= date('Y-m-d')) {
                ?>
                <button class="btn btn-rounded btn-info" onclick="modalAdd();"><i class="fa fa-commenting-o"></i> สร้าง ChatBot</button>
                <?php
            } else {
                ?>
                <a class="btn btn-rounded btn-inverse" href="<?php echo base_url() . 'package' ?>"><i class="fa fa-ban"></i> อัพเดทแพ็กเกจ</a>
                <?php
            }
        }
        ?>
    </div> 
</div>
<div class="row" id="result-pagination"></div>
<div id="for_modal"></div>

<script>
    $(function () {
        ajax_pagination();

        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'main/ajax_pagination',
            type: 'POST',
            data: {
                searchtext: $('#searchtext').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

    function modalAdd() {
        $.ajax({
            url: service_base_url + 'main/modaladd',
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
            url: service_base_url + 'main/modaledit',
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
    
    function modalDelete(agent_id) {
        $.ajax({
            url: service_base_url + 'main/modaldelete',
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
//    function modalEditstatus(agent_id) {
//        $.ajax({
//            url: service_base_url + 'main/modaleditstatus',
//            type: 'post',
//            data: {
//                agent_id: agent_id
//            },
//            success: function (response) {
//                $('#for_modal').html(response);
//                $("#on_modal").modal('show', {backdrop: 'static'});
//            }
//        });
//    }
//
//    function modalEditchangestatus(agent_id) {
//        $.ajax({
//            url: service_base_url + 'main/editchangestatus',
//            type: 'post',
//            data: {
//                agent_id: agent_id
//            },
//            success: function (response) {
//                if (response == 1) {
//                    location.reload();
//                }
//            }
//        });
//    }

    //edit status
//    function modalEditstatusfb(agent_id) {
//        $.ajax({
//            url: service_base_url + 'main/modaleditstatusfb',
//            type: 'post',
//            data: {
//                agent_id: agent_id
//            },
//            success: function (response) {
//                $('#for_modal').html(response);
//                $("#on_modal").modal('show', {backdrop: 'static'});
//            }
//        });
//    }
//
//    function modalEditchangestatusfb(agent_id) {
//        $.ajax({
//            url: service_base_url + 'main/editchangestatusfb',
//            type: 'post',
//            data: {
//                agent_id: agent_id
//            },
//            success: function (response) {
//                if (response == 1) {
//                    location.reload();
//                }
//            }
//        });
//    }

    //edit status
//    function modalEditstatusline(agent_id) {
//        $.ajax({
//            url: service_base_url + 'main/modaleditstatusline',
//            type: 'post',
//            data: {
//                agent_id: agent_id
//            },
//            success: function (response) {
//                $('#for_modal').html(response);
//                $("#on_modal").modal('show', {backdrop: 'static'});
//            }
//        });
//    }
//
//    function modalEditchangestatusline(agent_id) {
//        $.ajax({
//            url: service_base_url + 'main/editchangestatusline',
//            type: 'post',
//            data: {
//                agent_id: agent_id
//            },
//            success: function (response) {
//                if (response == 1) {
//                    location.reload();
//                }
//            }
//        });
//    }
//
//    function checkactive(agent_id) {
//        console.log(agent_id);
//        $.ajax({
//            url: service_base_url + 'main/checkactive',
//            type: 'post',
//            data: {
//                agent_id: agent_id
//            },
//            success: function (response) {
//                if (response == 1) {
//                    notification('success', 'Success', 'ตรวจสอบสำเร็จ');
//                    setTimeout(function () {
//                        location.reload();
//                    }, 3000);
//                } else if (response == 2) {
//                    notification('error', 'Error', 'เกิดข้อผิดพลาด');
//                    setTimeout(function () {
//                        location.reload();
//                    }, 3000);
//                }
//            },
//            error: function (xhr, status, error) {
//                notification('error', 'Error', 'เกิดข้อผิดพลาด');
//                setTimeout(function () {
//                    location.reload();
//                }, 3000);
//            }
//        });
//    }
//
//    function switchfb(agent_id, checkbox) {
//        if (checkbox.checked) {
//            var url = service_base_url + 'main/fb/1';
//            $.post(url, {agent_id: agent_id}, function (response) {
//                notification('success', 'Success', 'เปิดใช้งานสำเร็จ');
//            });
//        } else {
//            var url = service_base_url + 'main/fb/0';
//            $.post(url, {agent_id: agent_id}, function (response) {
//                notification('success', 'Success', 'ปิดใช้งานสำเร็จ');
//            });
//        }
//    }
//
//    function switchline(agent_id, checkbox) {
//        if (checkbox.checked) {
//            var url = service_base_url + 'main/line/1';
//            $.post(url, {agent_id: agent_id}, function (response) {
//                notification('success', 'Success', 'เปิดใช้งานสำเร็จ');
//            });
//        } else {
//            var url = service_base_url + 'main/line/0';
//            $.post(url, {agent_id: agent_id}, function (response) {
//                notification('success', 'Success', 'ปิดใช้งานสำเร็จ');
//            });
//        }
//    }

//    $('#chattext').keypress(function (e) {
//        if (e.which == 13) {
//            chatbot();
//        }
//    });
//
//    $('#agent_id').on('change', function () {
//        sessions();
//        //chatbot();
//    });
//
//    function chatbot() {
//        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
//        $.ajax({
//            url: service_base_url + 'main/chattest',
//            type: 'POST',
//            data: {
//                chattext: $('#chattext').val(),
//                agent_id: $('#agent_id').val(),
//                sessions_id: $('#sessions_id').val()
//            },
//            success: function (response) {
//                $('#chattext').val('');
//                $('#result-page').html(response);
//            }
//        });
//    }
//
//    function sessions() {
//        $('#sessions_id').val('');
//        var d = new Date();
//        var n = d.getTime();
//        $('#sessions_id').val($('#agent_id').val() + '-' + n);
//    }
//
//    $(function () {
//        sessions();
//        //chatbot();
//    });
//
//    function quickreplies(text) {
//        $('#chattext').val(text);
//        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
//        $.ajax({
//            url: service_base_url + 'main/chattest',
//            type: 'POST',
//            data: {
//                chattext: text,
//                agent_id: $('#agent_id').val(),
//                sessions_id: $('#sessions_id').val(),
//            },
//            success: function (response) {
//                $('#chattext').val('');
//                //console.log(response);
//                $('#result-page').html(response);
//            }
//        });
//    }


</script>
