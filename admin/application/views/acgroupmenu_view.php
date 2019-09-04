<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มกลุ่มเมนู</button>
                        <a href="<?php echo base_url('acgroupmenu/sortgroupmenu'); ?>" class="btn btn-sm btn-rounded btn-outline-info"><i class="fa fa-sort"></i> จัดเรียงกลุ่มเมนู</a>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>กลุ่มเมนู</th>
                                <th>ไอคอน</th>
                                <th>จัดเรียง</th>
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
                                        <td><?php echo $data->group_menu_name; ?> (<?php echo $data->group_menu_id; ?>)</td>
                                        <td><i class="<?php echo $data->group_menu_icon; ?>"></i></td>
                                        <td><?php echo $data->group_menu_sort; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('acgroupmenu/menu/' . $data->group_menu_id); ?>" class="btn btn-sm btn-outline-warning"><i class="fa fa-list"></i> จัดการเมนู</a>
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->group_menu_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <?php if ($this->acgroupmenu_model->checkgroupmenu($data->group_menu_id) > 0) { ?>
                                                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php } else {
                                                ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->group_menu_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
                                            <?php }
                                            ?>
                                        </td>
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

<div id="add-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add-form" method="post" action="<?php echo base_url('acgroupmenu/addgroupmenu'); ?>" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มกลุ่มเมนู</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">กลุ่มเมนู<span class="text-danger">*</span></label>
                        <input type="text" name="group_menu_name" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ไอคอน</label>
                        <input type="text" name="group_menu_icon" class="form-control form-control-line">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>                   
                </div>
            </form>
        </div>
    </div>
</div>

<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit-form" method="post" action="<?php echo base_url('acgroupmenu/editgroupmenu'); ?>" autocomplete="off">
                <input type="hidden" id="group_menu_id" name="group_menu_id" value="">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขกลุ่มเมนู</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">กลุ่มเมนู<span class="text-danger">*</span></label>
                        <input type="text" id="group_menu_name" name="group_menu_name" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ไอคอน</label>
                        <input type="text" id="group_menu_icon" name="group_menu_icon" class="form-control form-control-line">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info waves-effect waves-light"><i class="fa fa-save"></i> บันทึก</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>                    
                </div>
            </form>
        </div>
    </div>
</div>

<div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash"></i> ยืนยันการลบข้อมูล</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="bootbox-body text-center text-danger">
                    <b>ยืนยันการลบข้อมูลนี้ ใช่หรือไม่  <i class="fa fa-question-circle"></i></b>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger waves-effect waves-light" id="delete_id"><i class="fa fa-trash"></i> ตกลง</a>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>               
            </div>
        </div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();

    function modaladd() {
        $('#add-form').parsley().reset();
        $('#add-modal').modal('show', {backdrop: 'true'});
    }

    function modaledit(group_menu_id) {
        $('#group_menu_id').val('');
        $('#group_menu_name').val('');
        $('#group_menu_icon').val('');
        let url = service_base_url + 'acgroupmenu/getgroupmenu';
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: {
                group_menu_id: group_menu_id
            },
            success: function (response) {
                $('#group_menu_id').val(response.group_menu_id);
                $('#group_menu_name').val(response.group_menu_name);
                $('#group_menu_icon').val(response.group_menu_icon);
                $('#edit-form').parsley().reset();
                $('#edit-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modaldelete(group_menu_id) {
        let url = service_base_url + 'acgroupmenu/deletegroupmenu/' + group_menu_id;
        $('#delete_id').attr('href', url);
        $('#delete-modal').modal('show', {backdrop: 'true'});
    }

</script>