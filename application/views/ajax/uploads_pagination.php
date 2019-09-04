<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="10%">#</th>
                <th width="10%" class="text-center">ไฟล์ภาพ</th>
                <th width="15%">ชื่อไฟล์</th>
                <th width="30%">URL</th>
                <th width="15%">อัพโหลดเมื่อ</th>
                <th class="text-center" width="10%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count_data = $data->num_rows();
            if ($count_data > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $row) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center">
                            <a href="<?php echo base_url() . 'store/image/' . $row->image_path; ?>" class="fancybox">
                                <image src="<?php echo base_url() . 'store/image/' . $row->image_path; ?>" class="img-responsive" style="width: 80px; height: 80px;"/>
                            </a>
                        </td>
                        <td ><?php echo $row->image_name; ?></td>
                        <td ><?php echo $row->image_url; ?></td>
                        <td ><?php echo $this->misc->date2thai($row->image_modify, '%d %m %y', 1); ?></td>
                        <td class="text-center">
                            <button class="btn btn-xs btn-outline-info" onclick="linkurl('<?php echo $row->image_url; ?>')"><i class="fa fa-link"></i> คัดลอก URL</button>
                            <?php if ($this->session->userdata('role_id') == 1) { ?>
                                <button class="btn btn-xs btn-outline-danger" onclick="modaldelete('<?php echo $row->image_id; ?>')"><i class="fa fa-trash"></i> ลบ</button>
                            <?php } else { ?>
                                <button class="btn btn-xs btn-secondary" onclick="notification('error', 'Error', 'เกิดข้อผิดพลาด')"><i class="fa fa-trash"></i> ลบ</button>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="row m-t-20">
    <?php
    if ($count != 0) {
        ?>
        <div class="col-lg-6">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-lg-6">
            <?php echo $links; ?>
        </div>
        <?php
    }
    ?>
</div>
<script>
    $(function () {
        $('#formedit').parsley();
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });

    function linkurl(image_url) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(image_url).select();
        document.execCommand("copy");
        $temp.remove();
        notification('success', 'สำเร็จ', '<?php echo 'คัดลอก URL เรียบร้อย'; ?>');
    }
</script>