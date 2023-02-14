function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(selector).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function markInputInvalid(ele, msg="Please enter a valid input") {
    $(ele).addClass('is-invalid').removeClass('is-valid');
    if ($(ele).siblings('.invalid-feedback').length === 0) {
        $(ele).insertAfter($(`<div class="invalid-feedback">${msg}</div>`))
    } else {
        $(ele).siblings('.invalid-feedback').html(msg);
    }
}

function markInputValid(ele) {
    $(ele).addClass('is-valid').removeClass('is-invalid');
}


$(() => {
    
    $("input").on('keydown', function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {
            e.preventDefault();
        }
    });
    

    $("#hospital_logo").on('change', function () {
        readURL(this, '.hospital-logo-preview');
    });
    
    $("#hospital_name").on('change', function() {
        var val = $(this).val();
        val = val.trim();
        if (val.length === 0) {
            markInputInvalid(this, 'Please enter hospital name');
        } else {
            $.get(_base_url+`auth/validation_is_unique_hospital_name?name=${encodeURIComponent(val)}`, function(is_unique) {
                if (is_unique) {
                    markInputValid($("#hospital_name").get(0));
                    var hospital_name = val;
                   var first_initials = hospital_name.charAt(0);
                    $("#hospital_initials_1").val(first_initials);
                    
                   var matches = hospital_name.match(/\b(\w)/g); // ['J','S','O','N']
                   var acronym = matches.join(''); // JSON
                    var last_initials = acronym.charAt(1);
                   $("#hospital_initials_2").val(last_initials);
                   
                } else {
                    markInputInvalid($("#hospital_name").get(0), "Hospital already exists");
                }
            }).fail(function(err) {
                console.log(err);
                markInputInvalid($("#hospital_name").get(0), 'Server error try again later');
            });
        }
        $("#table-institute-name").html(`<b>${val}</b>`);
    });

    $("#hospital_initials_1, #hospital_initials_2").on('change', function() {
        var val = $(this).val();
        if (val.trim().length === 0) {
            markInputInvalid(this, 'Please provide hospital initial');
        } else {
            markInputValid(this);
        }
    })

    $(document).on('click','#changeBilling', function(e){
        e.preventDefault();
        var billinType = $('input[name="billing_type"]:checked').val();
        if(typeof billinType != 'undefined'){
            $.ajax({
                type: "POST",
                url: _base_url + '/laboratory/updateBillingType/',
                data:  {[csrf_name]: csrf_hash,hid: $('#hospital_info_id').val(), btype : billinType},
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $.sticky(response.message, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });

                        $('#billing_setting_modal').modal("hide");
                        // thisSel.find("span").text("Liked");
                    }else{
                        $.sticky(response.message, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        }
    });
});

$(document).ready (function () {  
  $("#hospital_form").validate();
}); 