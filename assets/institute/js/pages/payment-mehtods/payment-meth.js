$(document).ready(function() {
    $('#action_dd').on("change",function(){
        console.log($(this).val());

        if($(this).val()=='add_payment_meth'){
            window.location=SITE_URL+'\add-payment-method'
        }
    });

});