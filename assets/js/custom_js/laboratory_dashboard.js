function message(msg = "", type = "success", duration = 7000) {
    jQuery.sticky(msg, {classList: type, speed: 200, autoclose: duration});
}

$('#specimen_block_prefix_form').on('submit', function(e){
    e.preventDefault();
    var base_url = $("#base_url").val();

    $.ajax({
        url:base_url+'Laboratory/update_prefixes',
        method:"POST",
        data:$("#specimen_block_prefix_form").serialize(),
        dataType: "json",
        success:function(response)
        {
            if (response.type === 'success') {
                window.setTimeout(function () {
                    message(response.msg, response.type, 1000);
                    window.location.reload();
                }, 1000);
            } else {
                message(response.msg, response.type, 3000);
            }
        }
    });
});