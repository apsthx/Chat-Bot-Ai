<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title . ' - ' . $agent_name; ?>
                    <button style="float: right" onclick="location.reload();" class="btn btn-xs btn-rounded btn-outline-warning"><i class="fa fa-refresh"></i></button>
                </h4>
                <div class="row m-t-20">  
                    <div class="col-sm-12">
                        <div class="input-group">
                            <input type="text" id="chattext" class="form-control form-control-sm" value="" placeholder="Try it now">
                            <input type="hidden" id="agent_id" value="<?php echo $agent_id; ?>" class="form-control form-control-sm">
                            <input type="hidden" id="sessions_id" value="<?php echo $agent_id . date('ymdhis'); ?>" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div id="result-page" class="m-t-20">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#chattext').keypress(function (e) {
        if (e.which == 13) {
            chatbot();

        }
    });

    $(function () {
        chatbot();
    });

    function chatbot() {
        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'intents/chatbot',
            type: 'POST',
            data: {
                chattext: $('#chattext').val(),
                agent_id: $('#agent_id').val(),
                sessions_id: $('#sessions_id').val(),
            },
            success: function (response) {
                $('#chattext').val('');
                //console.log(response);
                $('#result-page').html(response);
            }
        });
    }

</script>