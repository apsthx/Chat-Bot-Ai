<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-gift"></i> <?php echo " อัตราค่าแพ็กเกจ"; ?>
                    <button type="button" style="float: right" class="btn btn-xs btn-rounded btn-outline-success" onclick="modalAdd();"><i class="fa fa-plus"></i> เพิ่มแพ็กเกจ</button>
                </h4>
                <table class="table">                
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อแพ็กเกจ</th>
                            <th class="text-right">ราคา</th>
                            <th class="text-right">Agent</th>
                            <th class="text-right">ผู้ใช้งาน</th>
                            <th class="text-right">จำกัดวัน</th>
                            <th class="text-right">จำนวนที่ใช้งาน</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">ตัวเลือก</th>                               
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $s = 1;
                        if ($datas->num_rows() > 0) {
                            foreach ($datas->result() as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $s; ?></td>
                                    <td><?php echo $data->package_name; ?></td>
                                    <td class="text-right"><?php echo number_format($data->package_cost, 0); ?></td>
                                    <td class="text-right"><?php echo number_format($data->package_agent, 0); ?></td>
                                    <td class="text-right"><?php echo number_format($data->package_user, 0); ?></td>                                  
                                    <td class="text-right"><?php echo number_format($data->package_date, 0); ?></td>
                                    <td class="text-right"><a href="javascript:void(0);" onclick="modalView(<?php echo $data->package_id; ?>)" ><?php echo number_format($this->package_model->getTeamsPackage($data->package_id)->num_rows(), 0); ?></a></td>
                                    <td class="text-center">
                                        <?php echo ($data->package_check == 1 ? '<span class="label label-success"><i class="fa fa-check-circle"></i> ปกติ</span>' : '<span class="label label-danger"><i class="fa fa-times-circle"></i> ระงับ</span>'); ?>                             
                                    </td>
                                    <td class="text-center"> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ตัวเลือก</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item small"  href="javascript:void(0)" onclick="modalLimit(<?php echo $data->package_id; ?>)"><i class="fa fa-key"></i> จำกัดเมนู</a>
                                                <a class="dropdown-item small"  href="javascript:void(0)" onclick="modalEdit(<?php echo $data->package_id; ?>)"><i class="fa fa-edit"></i> แก้ไข</a>                                             
                                                <?php if ($data->package_check == 1) { ?>
                                                    <a  class="dropdown-item small"  href="javascript:void(0)" onclick="modalEditstatus(<?php echo $data->package_id; ?>)"><i class="fa fa-close"></i> ระงับ</a>
                                                <?php } else { ?>
                                                    <a class="dropdown-item small"  href="javascript:void(0)" onclick="modalEditchangestatus(<?php echo $data->package_id; ?>)"><i class="fa fa-check"></i> ปกติ</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $s++;
                            }
                        } else {
                            ?>
                            <tr>
                                <td class="text-center" colspan="13"><?php echo 'ไม่มีข้อมูล'; ?></td>
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
<div id="for_modal"></div>
<div id="set-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div id="set-menu" class="modal-content">
        </div>
    </div>
</div>
<script>
    //add
    function modalAdd() {
        $.ajax({
            url: service_base_url + 'package/modalPackageAdd',
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEdit(package_id) {
        $.ajax({
            url: service_base_url + 'package/modalPackageEdit',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditstatus(package_id) {
        $.ajax({
            url: service_base_url + 'package/modalEditStatus',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }
    //edit
    function modalEditchangestatus(package_id) {
        $.ajax({
            url: service_base_url + 'package/editchangestatus',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                }
            }
        });
    }

    function modalView(package_id) {
        $.ajax({
            url: service_base_url + 'package/packageView',
            type: 'post',
            data: {
                package_id: package_id
            },
            success: function (response) {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    //limit
    function modalLimit(package_id) {
        $.ajax({
            url: service_base_url + 'package/limitmenu',
            method: "POST",
            data: {
                package_id: package_id
            },
            success: function (response)
            {
                $('#for_modal').html(response);
                $("#on_modal").modal('show', {backdrop: 'static'});
            }
        });
    }

    function switchRole(package_id, menu_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'package/addlimit';
            $.post(url, {package_id: package_id, menu_id: menu_id}, function (response) {
                notification('success', 'Success', 'จำกัดสำเร็จ');
                $('#package_show_checkbock' + menu_id).html('<span class="badge badge-success"><i class="fa fa-check-circle"></i>&nbsp;จำกัด</span>');
            });
        } else {
            var url = service_base_url + 'package/deletelimit';
            $.post(url, {package_id: package_id, menu_id: menu_id}, function (response) {
                notification('warning', 'Warning', 'ไม่จำกัดสำเร็จ');
                $('#package_show_checkbock' + menu_id).html('<span class="badge badge-warning"><i class="fa fa-times-circle"></i>&nbsp;ไม่จำกัด</span>');
            });
        }
    }
</script>

