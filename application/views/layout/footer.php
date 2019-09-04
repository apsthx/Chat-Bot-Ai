<div id="popup_modal"></div>
</div>
<footer class="footer">
    <?php echo $this->config->item('app_footer'); ?> | Page rendered in <strong>{elapsed_time}</strong> seconds.
</footer>        
</div>    
</div>
<input type="hidden" id="alert_message" value="<?php echo $this->session->flashdata('flash_message') != '' ? $this->session->flashdata('flash_message') : ''; ?>">
<script>
    $(function () {
        var alert_message = $('#alert_message').val();
        if (alert_message != '') {
            var foo = alert_message.split(',');
            notification(foo[0], foo[1], foo[2]);
        }
    });
    function notification(type, head, message) {
        $.toast({
            heading: head,
            text: message,
            position: 'top-right',
            loaderBg: '#D8DBDD',
            icon: type,
            hideAfter: 3000,
            stack: 3
        });
    }    
</script>  
</body>
</html>