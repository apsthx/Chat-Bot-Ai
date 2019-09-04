<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <a href="<?php echo base_url('groupmenu'); ?>" style="float: right" class="btn btn-sm btn-rounded btn-outline-inverse"><i class="fa fa-close"></i>&nbsp;ยกเลิก</a>
                </h4>
                <div class="row m-t-30">
                    <div class="col-md-6" style="margin-left: auto; margin-right: auto;">
                        <div class="myadmin-dd-empty dd" id="sort_groupmenu">
                            <ol class="dd-list">
                                <?php foreach ($this->groupmenu_model->get_groupmenu()->result() as $row) { ?>
                                    <li class="dd-item dd3-item" data-id="<?php echo $row->group_menu_id; ?>">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"><i class="<?php echo $row->group_menu_icon; ?>">&nbsp;</i><?php echo $row->group_menu_name; ?></div>
                                    </li>
                                <?php } ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    var service_base_url = $('#service_base_url').val();

    $(document).ready(function () {

        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target), output = list.data('output');
            $.ajax({
                url: service_base_url + 'groupmenu/editsortgroupmenu',
                method: 'POST',
                data: {
                    list: list.nestable('serialize')
                },
                success: function (response) {
                    //console.log(response);
                }
            });

        };

        $('#sort_groupmenu').nestable({
            group: 1,
            maxDepth: 1
        }).on('change', updateOutput);

    });

</script>