<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> รายการ Intents
                </h4>
                <div id="result-intent" class="table-responsive"></div>
            </div>
        </div>
    </div>
    <div id="result-form" class="col-md-9"></div>
</div>
<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<script>

    const agent_id = '<?php echo $agent_id; ?>'

    $(document).ready(function () {
        getIntent()
    })

    function getIntent() {
        $('#result-intent').html('<div style="text-align:center;padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/getintent',
            type: 'POST',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                $('#result-intent').html(response);
            }
        });
    }

    function addIntent() {
        $('#result-form').html('<div style="text-align:center;padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/addintent',
            type: 'POST',
            data: {
                agent_id: agent_id
            },
            success: function (response) {
                $('#result-form').html(response);
            }
        });
    }

    function editIntent(agent_id, intent_id) {
        $('#result-form').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/editintent',
            type: 'POST',
            data: {
                agent_id: agent_id,
                intent_id: intent_id
            },
            success: function (response) {
                $('#result-form').html(response);
            }
        });
    }

</script>