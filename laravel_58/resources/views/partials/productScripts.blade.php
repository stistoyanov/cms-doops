<script>
    $('#type').on('change', function (e) {
        var magento2Env = $('#magento2-env');
        magento2Env.addClass('hidden');
        if ($(this).val() < 2) {
            magento2Env.removeClass('hidden');
        }
    }).trigger('change');
</script>