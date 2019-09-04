<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">                        
                        <button class="btn btn-sm btn-rounded btn-outline-inverse" onclick="window.close();"><i class="fa fa-close"></i> ปิด</button>
                    </span>
                </h4>
                <input type="hidden" id="teams_id" value="<?php echo $teams_id; ?>" />
                <div id="teamsuserdetail">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="for_modal"></div>

<script>
    function teamsdetail() {
        $('#teamsdetail').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'teams/teamsdetail',
            type: 'POST',
            data: {
                teams_id: $('#teams_id').val()
            },
            success: function (response) {
                $('#teamsdetail').html(response);
            }
        });
    }

    function teamsuserdetail() {
        $('#teamsuserdetail').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'teams/teamsuserdetail',
            type: 'POST',
            data: {
                teams_id: $('#teams_id').val()
            },
            success: function (response) {
                $('#teamsuserdetail').html(response);
            }
        });
    }

    $(function () {
        teamsdetail();
        teamsuserdetail();
    });

</script>