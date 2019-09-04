<table class="table">
    <tbody>
        <?php
        if (!empty($intents->intents)) {
            $fixIntent = array();
            foreach ($intents->intents as $row) {
                $name = explode('/', $row->name);
                $isFallback = !empty($row->isFallback) ? 1 : 0;
                $isWelcome = !empty($row->events) ? 1 : 0;
                if ($isFallback == 0 && $isWelcome == 0) {
                    ?>
                    <tr id="intent_id_<?php echo $name[4]; ?>" class="tr-intent" onclick="editIntent('<?php echo $agent_id; ?>', '<?php echo $name[4]; ?>')">
                        <td><i class="fa fa-angle-right"></i> <?php echo $row->displayName; ?></td>
                    </tr>
                    <?php
                } else {
                    $fixIntent[] = $row;
                }
            }
            foreach ($fixIntent as $row) {
                $name = explode('/', $row->name);
                ?>
                <tr id="intent_id_<?php echo $name[4]; ?>" class="tr-intent" onclick="editIntent('<?php echo $agent_id; ?>', '<?php echo $name[4]; ?>')">
                    <td class="text-info"><i class="fa fa-angle-right"></i> <?php echo $row->displayName; ?></td>
                </tr>
                <?php
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
    <button type="button" class="btn btn-sm btn-outline-info" onclick="addIntent()"><i class="fa fa-plus"></i> เพิ่มการสนทนา</button>
</span>
