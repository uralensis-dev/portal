$(document).ready(function() {
    $(".day").prop('required', true);
    $(".month").prop('required', true);
    $(".year").prop('required', true);
    $("#inputPatientDateOfBirth").dateDropdowns();

    // Fetch patient data
    var userData = null;
    

    $('#personal_info_modal').on("show.bs.modal", function(e) {

        var $inputs = $(this).find(':input');

        $.get(BASE_URL+"profile-data", function(data, status) {
            console.log(status+'status');
            if (status == 'success') {
                userData = JSON.parse(data);
                if (userData.new) {
                    console.log('new');
                }else{
                    console.log(userData);
                    $.each(userData, function(key, val) {
                    $inputs.filter('[name="' + key + '"]').val(val);
                    });
                    
                }
            } 
            });
         
    });


});