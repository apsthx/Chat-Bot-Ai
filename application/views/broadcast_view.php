<div class="row">
    <div class="col-md-6 align-self-center">
        <h3 class="text-themecolor">Broadcast</h3>
    </div>    
</div>

<div class="error-box">
    <div class="error-body text-center">
        <h1>Coming Soon</h1>
        <h3 class="text-uppercase">เร็ว ๆ นี้</h3>    
        <hr>
        <a href="<?php echo base_url(); ?>" class="btn btn-info btn-rounded">กลับหน้าหลัก</a> 
    </div>
</div>

<script>
    $(function () {
        var url = window.location;
        var element = $('ul#sidebarnav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active');
    });
</script>