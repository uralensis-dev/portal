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
        
     setTimeout(function() {
        $.get(_base_url + 'institute/get_active_directory_users_lab?type=M', function(data) {
            $("#active-directory-select-container").empty();
            var template = $(`<select id="active-directory-select" name="active-directory-select" class="select"></select>`);
            if (data.length === 0) {
                template = $('<p>Active directory empty for this group</p>');
            }
//            if(data.length !=0)){
//                 template.append(`<option value="">Select Active Directory User</option>`);
//            }
            for (let i = 0; i < data.length; i++) {
                var user = data[i];
                template.append(`<option value="${user.id}">${user.first_name} ${user.last_name}</option>`);
            }
           // console.log(template);
            $("#active-directory-select-container").append(template);
            $("#active-directory-select").select2({width: '100%'});
            $("#active-directory-select").on('select2:select', function() {
                var user_id = $(this).val();
                $('input[name="active_directory_user"]').val(user_id);
                $.get(_base_url + 'institute/get_user_details_lab?id='+user_id, function(data) {
                    //$("#password-row").hide();
                    //$("#memo-row").hide();
                  //console.log(data); return false; 
                    $("#email").prop('readonly', true);
                    $("#admin_first_name").val(data['first_name']);
                    $("#admin_last_name").val(data['last_name']);
                    $("#admin_company").val(data['company']);
                    $("#admin_phone").val(data['phone']);
                    $("#admin_email").val(data['email']);
                    $("#admin_password").val('');
                    $("#admin_password").prop('disabled', true);
                    $("#admin_password_confirm").prop('disabled', true);
                    $("#is_active_directory").val('1');
                    
                    $("#admin_first_name").prop('readonly', true);
                    $("#admin_last_name").prop('readonly', true);
                    $("#admin_company").prop('readonly', true);
                    $("#admin_phone").prop('readonly', true);
                    $("#admin_email").prop('readonly', true);
                    $("#admin_memorable").prop('readonly', true);
                    
                    if (!(data['profile_picture'] === null || data['profile_picture'].length === 0)) {
                        $("#profile-pic").val('');
                        $("#profile-pic-preview").attr('src', _base_url+data['profile_picture']);
                    }
                });
            });
            //$("#user_group_type").val(group_type);
           // $("#add-user-modal").modal('show');
        });
    }, 500);
    
    
    $("input").on('keydown', function(e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if (keycode == '13') {
            e.preventDefault();
        }
    });

    $("#ac_checkbox").on('change', function() {
        if ($(this).is(":checked")) {
            $("#ac_form").show();
        }else{
            $("#ac_form").hide();
        }
    });

    $("#dac_checkbox").on('change', function() {
        if ($(this).is(":checked")) {
            $("#dac_form").show();
        }else{
            $("#dac_form").hide();
        }
    });

    $("#hospital_logo").on('change', function () {
        readURL(this, '.hospital-logo-preview');
    });

    $("#profile-pic").on('change', function () {
        readURL(this, '#profile-pic-preview');
    })
    $("#ac-profile-pic").on('change', function () {
        readURL(this, '#ac-profile-pic-preview');
    })
    $("#dac-profile-pic").on('change', function () {
        readURL(this, '#dac-profile-pic-preview');
    })

    // $("#hospital_name").on('change', function() {
    //     var val = $(this).val();
    //     val = val.trim();
    //     if (val.length === 0) {
    //         markInputInvalid(this, 'Please enter hospital name');
    //     } else {
    //         $.get(_base_url+`auth/validation_is_unique_hospital_name?name=${encodeURIComponent(val)}`, function(is_unique) {
    //             if (is_unique) {
    //                 markInputValid($("#hospital_name").get(0));
    //                 var hospital_name = val;
    //                var first_initials = hospital_name.charAt(0);
    //                 $("#hospital_initials_1").val(first_initials);
                    
    //                var matches = hospital_name.match(/\b(\w)/g); // ['J','S','O','N']
    //                var acronym = matches.join(''); // JSON
    //                 var last_initials = acronym.charAt(1);
    //                $("#hospital_initials_2").val(last_initials);
                   
    //             } else {
    //                 markInputInvalid($("#hospital_name").get(0), "Hospital already exists");
    //             }
    //         }).fail(function(err) {
    //             console.log(err);
    //             markInputInvalid($("#hospital_name").get(0), 'Server error try again later');
    //         });
    //     }
    //     $("#table-institute-name").html(`<b>${val}</b>`);
    // });

    $("#hospital_initials_1, #hospital_initials_2").on('change', function() {
        var val = $(this).val();
        if (val.trim().length === 0) {
            markInputInvalid(this, 'Please provide hospital initial');
        } else {
            markInputValid(this);
        }
    })

    $("#hospital_address").on('change', function() {
        var val = $(this).val();
        $("#table-address-line-1").html(val);
    });

    $("#hospital_city").on('change', function() {
        var val = $(this).val();
        $("#table-address-line-2").html(val);
    });

    $("#hospital_state").on('change', function() {
        var val = $(this).val();
        $("#table-address-line-3").html(val);
    });

    $("#hospital_country").on('change', function() {
        var val = $(this).val();
        $("#table-address-line-3").html(val);
    });

    $("#hospital_post_code").on('change', function() {
        var val = $(this).val();
        $("#table-address-line-4").html(val);
    });

    $("#hospital_phone").on('change', function() {
        var val = $(this).val();
        $("#table-phone").html(val);
    });

    $("#hospital_website").on('change', function() {
        var val = $(this).val();
        $("#table-website-url").html(val).attr('href', val);
    });

    $("#admin_email, #ac_email, #dac_email").on('change', function() {
        $('.has_error').val(0);
        var val = $(this).val().trim();
        var _this = this;
        if (val.length === 0) {
            $(this).addClass('is-invalid');
            $(this).siblings('.invalid-feedback').html("Please provide an email");
        } else {
            $.get(_base_url + `auth/validation_is_unique_user_email?email=${encodeURIComponent(val)}`, function(is_unique) {
                console.log("is unique provided");
                if (is_unique) {
                    $('.has_error').val(0);
                    $(_this).addClass('is-valid');
                    $(_this).removeClass('is-invalid');
                } else {
                    $('.has_error').val(1);
                    $(_this).addClass('is-invalid');
                    $(_this).siblings('.invalid-feedback').html("User already exists");
                    $(_this).removeClass('is-valid');
                }
            });
        }
    });

    $("#hospital_name").on('change', function() {
        $('.has_error').val(0);
        var val = $(this).val().trim();
        var _this = this;
        if (val.length === 0) {
            $(this).addClass('is-invalid');
            $(this).siblings('.invalid-feedback').html("Please enter hospital name");
            $('.has_error').val(1);
        } else {
            $.get(_base_url+`auth/validation_is_unique_user_name?name=${val}`, function(is_unique) {
                if (is_unique) {
                    $('.has_error').val(0);
                    markInputValid($("#hospital_name").get(0));
                    var hospital_name = val;
                   var first_initials = hospital_name.charAt(0);
                    $("#hospital_initials_1").val(first_initials);
                    
                   var matches = hospital_name.match(/\b(\w)/g); // ['J','S','O','N']
                   var acronym = matches.join(''); // JSON
                    var last_initials = acronym.charAt(1);
                   $("#hospital_initials_2").val(last_initials);
                   
                } else {
                    $('.has_error').val(1);
                    markInputInvalid($("#hospital_name").get(0), "Hospital already exists");
                }
            }).fail(function(err) {
                console.log(err);
                markInputInvalid($("#hospital_name").get(0), 'Server error try again later');
            });
        }
    });
    
    $("#hospital_email").on('change', function() {
        var val = $(this).val();
        $("#table-email").html(val).attr('href', `mailto:${val}`);
    });

    $("#admin_first_name, #admin_last_name, #ac_first_name, #ac_last_name, #dac_first_name, #dac_last_name").on('change', function() {
        var val = $(this).val().trim();
        if (val.length === 0) {
            markInputInvalid(this, 'Please provide a name');
        } else {
            markInputValid(this);
        }
    });

    $("#admin_password, #admin_memorable, #ac_password, #dac_password, #ac_memorable, #dac_memorable").on('change', function() {
        var val = $(this).val().trim();
        if (val.length === 0) {
            markInputInvalid(this, 'Please provide a value');
        } else {
            markInputValid(this);
        }
    });

    

    $("#admin_password_confirm").on('change', function() {
        var val = $(this).val().trim();
        var password = $("#admin_password").val().trim();
        if (val === password) {
            markInputValid(this);
        } else {
            markInputInvalid(this, 'Password does not match');
        }
    });

    $("#ac_password_confirm").on('change', function() {
        var val = $(this).val().trim();
        var password = $("#ac_password").val().trim();
        if (val === password) {
            markInputValid(this);
        } else {
            markInputInvalid(this, 'Password does not match');
        }
    });

    $("#dac_password_confirm").on('change', function() {
        var val = $(this).val().trim();
        var password = $("#dac_password").val().trim();
        if (val === password) {
            markInputValid(this);
        } else {
            markInputInvalid(this, 'Password does not match');
        }
    });
    $("#hospital_form").validate({
        rules: {
            hospital_name: {
                required: true,
            },
            hospital_initials_1: {
                required: true,
            },
            hospital_initials_2: {
                required: true,
            },
            hospital_email: {
                required: true,
                email: true,
            },
            hospital_email_confirm: {
                required: true,
                equalTo: "#hospital_email"
            },
            hospital_website: {
                required: true,
            },
            admin_first_name: {
                required: true,
            },
            admin_last_name: {
                required: true,
            },
            admin_email: {
                required: true,
            },
            admin_password: {
                required: true,
            },
            admin_password_confirm: {
                required: true,
            },
            admin_memorable: {
                required: true,
            },

            memorable: {
                required: true,
                rangelength: [10, 10]
            },
            "group_id[]": {
                required: true,
            },
            child_user_group: {
                required: true,
                // required: function(element){
                //     var grp_types = $("#member_of_select2 :selected").map((_, e) => e.attributes[1].value).get();
                //     if($("#member_of_select2").val().length > 0 && (jQuery.inArray( "A", grp_types)!==-1 || jQuery.inArray( "NA", grp_types) !==-1)){
                //        // return false;
                //     }else{
                //         //return true;
                //     }
                // }
            },
            // child_pathologist_user_group: {
            //     required: function(element){
            //         var is_hidden = $("#child_pathologist_user_group").parent().hasClass('p_hidden');
            //         // console.log("Validate Group Type: "+is_hidden);
            //         if(is_hidden===false){
            //            // return true;
            //         }else{
            //         //return false;
            //         }
            //     }
            // }

        },
        submitHandler: function (form) {
            // e.preventDefault();
            // console.log("VALIDATION PASSED!!!");
            form.submit();
        },
    });
    $( "#hospital_form" ).submit(function( event ) {
        var is_error = $('.has_error').val();
        if(is_error === '1'){
            event.preventDefault();
        }
      });

    

//    $("#hospital_form").on('submit', function(event) {
//        event.preventDefault();
//        var frm = $(this);
//        var form_data = new FormData(this);
//        var html = $("#hospital_info_table").html();
//        form_data.set('hospital_information', html);
//        // Perform form validations.
//        // Hospital detail validations
//        var hospital_name = form_data.get('hospital_name');
//        var error = false;
//        if (hospital_name.trim().length === 0) {
//            error = true;
//            markInputInvalid($("#hospital_name").get(0), "Please provide hospital name");
//        }
//        var hospital_initials_1 = form_data.get('hospital_initials_1').trim();
//        var hospital_initials_2 = form_data.get('hospital_initials_2').trim();
//        if (hospital_initials_1.trim().length === 0) {
//            error = true;
//            markInputInvalid($("#hospital_initials_1").get(0), "Please provide hospital initials");
//        }
//        if (hospital_initials_2.trim().length === 0) {
//            error = true;
//            markInputInvalid($("#hospital_initials_2").get(0), "Please provide hospital initials");
//        }
//        var ac_checkbox = form_data.get('ac_checkbox');
//        var dac_checkbox = form_data.get('dac_checkbox');
//        
//        // Admin details validation
//        let admin_first_name = form_data.get('admin_first_name');
//        let admin_last_name = form_data.get('admin_last_name');
//        let admin_email = form_data.get("admin_email");
//        let admin_password = form_data.get("admin_password");
//        let admin_password_confirm = form_data.get("admin_password_confirm");
//        let admin_memorable = form_data.get("admin_memorable");
//        if (admin_first_name.trim().length === 0) {
//            error = true;
//            markInputInvalid($("#admin_first_name").get(0), "Please provide Admin Name");
//        }
//        if (admin_last_name.trim().length === 0) {
//            error = true;
//            markInputInvalid($("#admin_last_name").get(0), "Please provide Admin Name");
//        }
//        if (admin_email.trim().length === 0) {
//            error = true;
//            markInputInvalid($("#admin_email").get(0), "Please provide Admin email");
//        }
////        if (admin_memorable.trim().length === 0) {
////            error = true;
////            markInputInvalid($("#admin_memorable").get(0), "Please provide Admin memorable");
////        }
//        
//        if($("#active-directory-select").val() == ''){
//            if (admin_password.trim().length === 0) {
//            error = true;
//            markInputInvalid($("#admin_password").get(0), "Please provide Admin password");
//        }
//        if (admin_password_confirm.trim() !== admin_password) {
//            error = true;
//            markInputInvalid($("#admin_password_confirm").get(0), "Password does not match");
//        }
//        }
//        
//
//        if (ac_checkbox !== null) {
//            let ac_first_name = form_data.get('ac_first_name');
//            let ac_last_name = form_data.get('ac_last_name');
//            let ac_email = form_data.get("ac_email");
//            let ac_password = form_data.get("ac_password");
//            let ac_password_confirm = form_data.get("ac_password_confirm");
//            let ac_memorable = form_data.get("ac_memorable");
//            if (ac_first_name.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#ac_first_name").get(0), "Please provide Account Holder Name");
//            }
//            if (ac_last_name.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#ac_last_name").get(0), "Please provide Account Holder Name");
//            }
//            if (ac_email.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#ac_email").get(0), "Please provide Account Holder email");
//            }
//            if (ac_memorable.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#ac_memorable").get(0), "Please provide Account Holder memorable");
//            }
//            if (ac_password.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#ac_password").get(0), "Please provide Account Holder password");
//            }
//            if (ac_password_confirm.trim() !== ac_password) {
//                error = true;
//                markInputInvalid($("#ac_password_confirm").get(0), "Password does not match");
//            }
//        }
//
//        if (dac_checkbox !== null) {
//            let dac_first_name = form_data.get('dac_first_name');
//            let dac_last_name = form_data.get('dac_last_name');
//            let dac_email = form_data.get("dac_email");
//            let dac_password = form_data.get("dac_password");
//            let dac_password_confirm = form_data.get("dac_password_confirm");
//            let dac_memorable = form_data.get("dac_memorable");
//            if (dac_first_name.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#dac_first_name").get(0), "Please provide Deputy Account Holder Name");
//            }
//            if (dac_last_name.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#dac_last_name").get(0), "Please provide Deputy Account Holder Name");
//            }
//            if (dac_email.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#dac_email").get(0), "Please provide Deputy Account Holder email");
//            }
//            if (dac_memorable.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#dac_memorable").get(0), "Please provide Deputy Account Holder memorable");
//            }
//            if (dac_password.trim().length === 0) {
//                error = true;
//                markInputInvalid($("#dac_password").get(0), "Please provide Deputy Account Holder password");
//            }
//            if (dac_password_confirm.trim() !== dac_password) {
//                error = true;
//                markInputInvalid($("#dac_password_confirm").get(0), "Password does not match");
//            }
//        }
//        if (error) {
//            return;
//        }
//
//        $.ajax({
//            type: 'POST',
//            url: frm.attr('action'),
//            data: form_data,
//            enctype: 'multipart/form-data',
//            cache: false,
//            processData: false,
//            contentType: false,
//            success: function (data) {
//                window.location.href = _base_url+'auth';
//            }, 
//            error: function (req, status, err) {
//                if (req.status === 400) {
//                    message(req.responseJSON.errors, "warning");
//                } else {
//                    message("Some error occurred, Try again later", "important");
//                }
//                console.log(req.responseJSON);
//                console.log(status);
//                console.log(err);
//            }
//        });
//    });
});