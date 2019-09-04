<table class="table">
    <tbody>
        <?php
        if (!empty($intents->intents)) {
            $i = 1;
            foreach ($intents->intents as $key => $row) {
                $name = explode('/', $row->name);
                ?>
                <tr id="intent_id_<?php echo $name[4]; ?>" class="tr-intent ba" onclick="editIntent('<?php echo $agent_id; ?>', '<?php echo $name[4]; ?>')">
                    <td><?php echo $row->displayName; ?></td>
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
<span style="float: right">
    <button type="button" class="btn btn-sm btn-outline-info" onclick="getIntent()"><i class="fa fa-refresh"></i> รีเฟรช</button>
    <button type="button" class="btn btn-sm btn-outline-info" onclick="addIntent()"><i class="fa fa-plus"></i> เพิ่ม Intent</button>
</span>
