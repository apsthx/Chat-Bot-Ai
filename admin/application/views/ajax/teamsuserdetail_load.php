<input type="hidden" name="teams_id" id="teams_id" value="<?php echo $teams_id; ?>"/>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="4%">#</th>
                <th width="10%">Username</th>
                <th width="15%">ชื่อผู้ใช้งาน</th>
                <th width="10%">เบอร์โทรศัพท์</th>
                <th width="15%">อีเมล</th>
                <th width="15%">สิทธิ์ผู้ใช้งาน</th>
                <th class="text-center" width="7%">สถานะ</th>
                <th class="text-center" width="20%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $data = $this->teams_model->getuser($teams_id);
            if ($data->num_rows() > 0) {
                $i = 1;
                foreach ($data->result() as $row) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $row->username; ?></td>
                        <td><?php echo $row->user_fullname; ?></td>
                        <td><?php echo $row->user_tel; ?></td>
                        <td><?php echo $row->user_email; ?></td>
                        <td><?php echo $row->role_name; ?></td>
                        <td class="text-center">
                            <?php if ($row->user_status_id == 1) { ?>
                                <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo 'ปกติ'; ?></span>
                            <?php } else { ?>
                                <span class="badge badge-danger"><i class="fa fa-close"></i> <?php echo 'ถูกระงับ'; ?></span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-xs btn-outline-info" onclick="modalEditModal('<?php echo $row->user_id; ?>')"><i class="fa fa-edit"></i> แก้ไข</button>   
                            <?php if ($row->user_status_id == 1) { ?>
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="modalEditstatus(<?php echo $row->user_id; ?>)"><i class="fa fa-close"></i> ระงับการใช้งาน</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-xs btn-outline-success" onclick="modalEditchangestatus(<?php echo $row->user_id; ?>)"><i class="fa fa-check"></i> เปิดใช้งานปกติ</button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="10"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div id="for_modal"></div>
<script>
    //edit
    function modalEdit(user_id) {
        $.ajax({
            url: service_base_url + 'teams/modaluseredit',
            type: 'post',
            data: {
                teams_id: $('#teams_id').val(),
                user_id: user_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditstatus(user_id) {
        $.ajax({
            url: service_base_url + 'teams/modalusereditstatus',
            type: 'post',
            data: {
                teams_id: $('#teams_id').val(),
                user_id: user_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditchangestatus(user_id) {
        $.ajax({
            url: service_base_url + 'teams/edituserchangestatus',
            type: 'post',
            data: {
                user_id: user_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }
    
    function modalEditModal(user_id) {
        $.ajax({
            url: service_base_url + 'teams/modaledituser/' + user_id,
            type: 'post',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

</script>
