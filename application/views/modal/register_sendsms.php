<div id="on_modal" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i>&nbsp;ยืนยันเบอร์โทร <?php echo $telcheck; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="background-color: #fff;">      
                <div class="text-center text-primary">กรุณากรอกรหัส OTP</div> 
                <div class="text-center text-dark"><?php echo '( Ref No. ' . $refotp . ' )'; ?> </div> 
                <br>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="text" id="checkotp" class="form-control col-md-4" maxlength="6">
                    </div>
                </div>
            </div> 
            <div class="modal-footer text-center" style="border-color: white;">
                <div class="w-100">
                    <button type="button" class="btn btn-sm btn-outline-info" onclick="confirmOTP();"><i class="fa fa-check-circle-o"></i>&nbsp;ยืนยันรหัส OTP&nbsp;</button>
                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="againOTP();"><i class="fa fa-refresh"></i>&nbsp;ขอรหัส OTP ใหม่</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(function () {
        $('#checkotp').focus();
    }, 1000);
</script>