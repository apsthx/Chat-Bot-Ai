<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> <?php echo " - " . $group_menu->group_menu_name; ?> (<?php echo $group_menu->group_menu_id; ?>)
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modaladd();"><i class="fa fa-plus"></i> เพิ่มเมนู</button>
                        <a href="<?php echo base_url('acgroupmenu/sortmenu/' . $group_menu_id); ?>" class="btn btn-sm btn-rounded btn-outline-info"><i class="fa fa-sort"></i> จัดเรียงเมนู</a>
                        <a href="<?php echo base_url('acgroupmenu'); ?>" class="btn btn-sm btn-rounded btn-outline-inverse"><i class="fa fa-close"></i> ยกเลิก</a>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>เมนู</th>
                                <th>ลิ้งค์</th>
                                <th class="text-center">จัดเรียง</th>
                                <th class="text-center">สถานะ</th>
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
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php echo $data->menu_name . ' ( ' . $data->menu_id . ' )'; ?></td>
                                        <td><?php echo $data->menu_link; ?></td>
                                        <td class="text-center"><?php echo $data->menu_sort; ?></td>
                                        <td class="text-center">
                                            <?php if ($data->menu_status_id == 1) { ?>
                                                <span class="badge badge-success"><i class="fa fa-check"></i> เปิด</span>
                                            <?php } else if ($data->menu_status_id == 2) { ?>
                                                <span class="badge badge-danger"><i class="fa fa-times"></i> ปิด</span>
                                            <?php } else { ?>
                                                <span class="badge badge-info"><i class="fa fa-minus-circle"></i> แสดงไม่ให้คลิก</span>
                                            <?php } ?>                                           
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="modaledit(<?php echo $data->menu_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="modaldelete(<?php echo $data->group_menu_id; ?>,<?php echo $data->menu_id; ?>);"><i class="fa fa-trash"></i> ลบ</button>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="6"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
            <form id="add-form" method="post" action="<?php echo base_url('acgroupmenu/addmenu'); ?>" autocomplete="off">
                <input type="hidden" name="group_menu_id" value="<?php echo $group_menu_id; ?>">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> เพิ่มเมนู</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">เมนู<span class="text-danger">*</span></label>
                        <input type="text" name="menu_name" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ลิงค์</label>
                        <input type="text" name="menu_link" class="form-control form-control-line">
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
            <form id="edit-form" method="post" action="<?php echo base_url('acgroupmenu/editmenu'); ?>" autocomplete="off">
                <input type="hidden" id="group_menu_id" name="group_menu_id" value="">
                <input type="hidden" id="menu_id" name="menu_id" value="">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> แก้ไขเมนู</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">เมนู<span class="text-danger">*</span></label>
                        <input type="text" id="menu_name" name="menu_name" class="form-control form-control-line" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">ลิงค์</label>
                        <input type="text" id="menu_link" name="menu_link" class="form-control form-control-line">
                    </div>
                    <div class="form-group">
                        <label class="control-label">สถานะ</label>
                        <input name="menu_status_id" type="radio" id="status_1" value="1">
                        <label for="status_1">เปิดเมนู</label>
                        <input name="menu_status_id" type="radio" id="status_2" value="2">
                        <label for="status_2">ปิดเมนู</label>
                        <input name="menu_status_id" type="radio" id="status_3" value="3">
                        <label for="status_3">แสดง คลิกไม่ได้</label>
                    </div>
                    <div class="form-group">
                        <label class="control-label">เปิดลิงค์ใหม่</label>
                        <input name="menu_openlink" type="radio" id="menu_openlink_0" value="0">
                        <label for="menu_openlink_0">หน้าเดิม</label>
                        <input name="menu_openlink" type="radio" id="menu_openlink_1" value="1">
                        <label for="menu_openlink_1">หน้าใหม่</label>                        
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

    $(function () {
        //
    });

    function modaladd() {
        $('#add-form').parsley().reset();
        $('#add-modal').modal('show', {backdrop: 'true'});
    }

    function modaledit(menu_id) {
        $('#group_menu_id').val('');
        $('#menu_id').val('');
        $('#menu_name').val('');
        $('#menu_link').val('');
        let url = service_base_url + 'acgroupmenu/getmenu';
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: {
                menu_id: menu_id
            },
            success: function (response) {
                $('#group_menu_id').val(response.group_menu_id);
                $('#menu_id').val(response.menu_id);
                $('#menu_name').val(response.menu_name);
                $('#menu_link').val(response.menu_link);
                $('#status_' + response.menu_status_id).prop('checked', true);
                $('#menu_openlink_' + response.menu_openlink).prop('checked', true);
                $('#edit-form').parsley().reset();
                $('#edit-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modaldelete(group_menu_id, menu_id) {
        let url = service_base_url + 'acgroupmenu/deletemenu/' + group_menu_id + '/' + menu_id;
        $('#delete_id').attr('href', url);
        $('#delete-modal').modal('show', {backdrop: 'true'});
    }
</script>