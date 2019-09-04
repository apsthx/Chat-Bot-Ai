<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="6%">#</th>
                <th >Agent / Intents</th>
                <th class="text-center"><img src="<?php echo base_url() . 'assets/img/fbm_btn.png'; ?>" style="width: 25px;"></th>
                <th class="text-center"><img src="<?php echo base_url() . 'assets/img/line_btn.png'; ?>" style="width: 25px;"></th>        
                <th class="text-center"><img src="<?php echo base_url() . 'assets/img/logo-icon.png'; ?>" style="width: 25px;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count_agents = $agents->num_rows();
            if ($count_agents > 0) {
                $i = 1;
                foreach ($agents->result() as $agent) {
                    ?>
                    <tr>
                        <td class="text-center" style="font-weight: bold; background-color: whitesmoke;"><?php echo $i; ?></td>
                        <td style="font-weight: bold; background-color: whitesmoke;"><?php echo $agent->agent_name; ?></td>
                        <td class="text-center" style="font-weight: bold; background-color: whitesmoke;"><?php echo number_format($this->reportstatistic_model->count_hook('facebook', $agent->hook_project_id, null, $date_start_report, $date_end_report), 0); ?></td>
                        <td class="text-center" style="font-weight: bold; background-color: whitesmoke;"><?php echo number_format($this->reportstatistic_model->count_hook('line', $agent->hook_project_id, null, $date_start_report, $date_end_report), 0); ?></td>
                        <td class="text-center" style="font-weight: bold; background-color: whitesmoke;"><?php echo number_format($this->reportstatistic_model->count_hook('ai-aps', $agent->hook_project_id, null, $date_start_report, $date_end_report), 0); ?></td>
                    </tr>
                    <?php
                    $intents = $this->reportstatistic_model->get_hook_intents($agent->hook_project_id, $date_start_report, $date_end_report);
                    if ($intents->num_rows() > 0) {
                        foreach ($intents->result() as $intent) {
                            ?>
                            <tr>
                                <td class="text-center"></td>
                                <td>&nbsp;&nbsp;&nbsp;<?php echo $intent->hook_intents_name; ?></td>
                                <td class="text-center"><?php echo number_format($this->reportstatistic_model->count_hook('facebook', $agent->hook_project_id, $intent->hook_intents_id, $date_start_report, $date_end_report), 0); ?></td>
                                <td class="text-center"><?php echo number_format($this->reportstatistic_model->count_hook('line', $agent->hook_project_id, $intent->hook_intents_id, $date_start_report, $date_end_report), 0); ?></td>
                                <td class="text-center"><?php echo number_format($this->reportstatistic_model->count_hook('ai-aps', $agent->hook_project_id, $intent->hook_intents_id, $date_start_report, $date_end_report), 0); ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
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