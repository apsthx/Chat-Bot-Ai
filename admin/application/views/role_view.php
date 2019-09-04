<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <!--<button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มสิทธิ์การใช้งาน</button>-->
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ชื่อสิทธิ์การใช้งาน</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datas->num_rows() > 0) {
                                foreach ($datas->result() as $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data->role_name; ?></td>
                                        <td class="text-center"><button type="button" onclick="modalset(<?php echo $data->role_id; ?>);" class="btn btn-sm btn-outline-info"><i class="fa fa-tags"></i> กำหนดสิทธิ์การใช้เมนู</button></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo 'ไม่มีข้อมูล'; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="set-role-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div id="set-role-form" class="modal-content">
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();

    function modalset(role_id) {
        url = service_base_url + 'role/setrole';
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                role_id: role_id
            },
            success: function (response) {
                $('#set-role-form').html(response);
                $('#set-role-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function switchrole(role_id, menu_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'role/add';
            $.post(url, {role_id: role_id, menu_id: menu_id}, function (response) {
                $('#role_show_checkbock' + menu_id).html('<span class="badge badge-success"><i class="fa fa-check-circle"></i>&nbsp;อนุญาต</span>');
            });
        } else {
            var url = service_base_url + 'role/delete';
            $.post(url, {role_id: role_id, menu_id: menu_id}, function (response) {
                $('#role_show_checkbock' + menu_id).html('<span class="badge badge-warning"><i class="fa fa-times-circle"></i>&nbsp;ไม่อนุญาต</span>');
            });
        }
    }

</script>