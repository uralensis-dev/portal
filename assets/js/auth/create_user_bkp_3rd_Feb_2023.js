function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#profile-pic-preview").attr("src", e.target.result);
        };

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$(() => {
    $('#Hgroup_id').select2({width: '100%'});
    $('#organization_group_id').select2({width: '100%'});
    var baseUrl = $("#base_url_value").val();

    function updateChildUserGroup(user_group_type1)
	{
        $("#Hgroup_id").html('');
        $("#organization_group_id").html('');
        var csrf_token_name = $("#csrf_token_name").val();
        var csrf_token_hash = $("#csrf_token_hash").val();
        var user_group_type = user_group_type1;
        if (user_group_type == 1 || user_group_type == 2) {
            $("#child_user_group").prop("disabled", true);
            return;
        } else {
            $("#child_user_group").prop("disabled", false);
        }

        var data_form = {
            [csrf_token_name]: csrf_token_hash,
            'group_type': user_group_type
        };

        $.ajax({
            type: "POST",
            url: baseUrl + '/auth/get_organization_group',
            data: data_form,
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') 
				{
                    console.log(response.parent_groups);
                    $("#organization_group_id").html('');
                    $.each(response.parent_groups, function (i, item) {
                        $('#organization_group_id').append($('<option>', {
                            value: item.id,
                            text: item.description + " (" + item.group_type + ")",
                            'data-grouptype': item.group_type
                        }));
                    });
                    $('#organization_group_id').select2({width: '100%'});
                } else {
                    $.sticky(response.message, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 7000
                    });
                }
            }
        });

        $.ajax({
            type: "POST",
            url: baseUrl + '/auth/get_role_hospitals',
            data: data_form,
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    console.log("Response Parent Groups" + response.parent_groups);
                    $("#Hgroup_id").html('');
                    // $("#manager_pathologist").html('');
                    // $("#child_pathologist_user_group").html('');
                    // $('#Hgroup_id').append($('<option>', {
                    //     value: '',
                    //     text: 'Select User Group',
                    //     'data-grouptype': ''
                    // }));
                    $.each(response.parent_groups, function (i, item) {
                        $('#Hgroup_id').append($('<option>', {
                            value: item.id,
                            text: item.description + " (" + item.group_type + ")",
                            'data-grouptype': item.group_type
                        }));
                    });
                    $('#Hgroup_id').select2({width: '100%'});
                    // location.reload();
                } else {
                    $.sticky(response.message, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 7000
                    });
                }
            }
        });
        $(".user_sub_role").hide();
        if(user_group_type1=="92"){
           // $(".user_sub_role").show();
            $.ajax({
                type: "POST",
                url: baseUrl + '/auth/get_user_sub_role',
                data: data_form,
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        console.log("Response Parent Groups" + response.parent_groups);
                        $("#user_sub_role").html('');
                        // $("#manager_pathologist").html('');
                        // $("#child_pathologist_user_group").html('');
                        // $('#Hgroup_id').append($('<option>', {
                        //     value: '',
                        //     text: 'Select User Group',
                        //     'data-grouptype': ''
                        // }));
                        $.each(response.parent_groups, function (i, item) {
                            $('#user_sub_role').append($('<option>', {
                                value: item.id,
                                text: item.description,
                                'data-grouptype': item.group_type
                            }));
                        });
                        $('#user_sub_role').select2({width: '100%'});
                        // location.reload();
                    } else {
                        $.sticky(response.message, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        }
        var admin_type = $("#admin_type").val();
        if(admin_type=="no"){
            // alert("");
            // $('#user_group_id').select2('enable', false);
            // $('#Hgroup_id').select2('enable', false);
            // $('#user_group_id').prop('disabled', true);
            // $('#Hgroup_id').prop('disabled', true);

            $('#user_role').attr('disabled','disabled');
            $('#user_sub_role').attr('disabled','disabled');
            //$('#Hgroup_id').attr('disabled','disabled');
        }

    }
    $.get(baseUrl + 'auth/get_all_roles1', function (data) {
        let select = $("#user_role");
        let selectLab = $("#user_role_lab");
        // let group_id_get = $("#user_group_id").val();
        // let selected_opt = "";
        // if (group_id_get == "") {
        //     selected_opt = "selected";
        // }

        select.empty();
        selectLab.empty();
        let option = $(`<option value="">Select Role</option>`);
        let optionLab = $(`<option value="">Select Role</option>`);
        let HosGroup = "<optgroup label='Hospital'>";
        let LabGroup = "<optgroup label='Laboratory'>";
        let PathGroup = "<optgroup label='Pathologist'>";
		let SuGroup = "<optgroup label='Surgeon'>";
        let SaGroup = "<optgroup label='System Admin'>";
		

        select.append(option);
        selectLab.append(optionLab);


        // select.append(all_option);
        for (role of data['H']) {
            HosGroup += `<option value="${role.group_type}" data-group="Hospital">${role.description}</option>`;
        }
        for (role of data['L']) {
            LabGroup += `<option value="${role.group_type}" data-group="Laboratory">${role.description}</option>`;
        }
        for (role of data['D']) {
            PathGroup += `<option value="${role.group_type}" data-group="Pathologist">${role.description}</option>`;
        }
		for (role of data['S']) {
            SuGroup += `<option value="${role.group_type}" data-group="Surgeon">${role.description}</option>`;
        }
        for (role of data['A']) {
            SaGroup += `<option value="${role.group_type}" data-group="System Admin">${role.description}</option>`;
        }

        HosGroup += "</optgroup>";
        LabGroup += "</optgroup>";
        PathGroup += "</optgroup>";
        SuGroup += "</optgroup>";
		SaGroup += "</optgroup>";

        select.append(HosGroup);
        select.append(LabGroup);
        select.append(PathGroup);
        select.append(SuGroup);
        // select.append(NaGroup);
        select.append(SaGroup);

        selectLab.append(HosGroup);
        selectLab.append(LabGroup);
        selectLab.append(PathGroup);
        selectLab.append(SuGroup);
        // selectLab.append(NaGroup);


        select.select2({width: '100%'});
        selectLab.select2({width: '100%'});

        $('.role-select-container').show();
    }).fail(function (err) {
        console.log(err);
        console.log("Get Role error");
        $("#user_role").select2({width: '100%'});
        $("#user_role_lab").select2({width: '100%'});
        $('.role-select-container').show();
    });
    $('#user_role_lab').change(function (){
        var role = $('option:selected', this).attr('data-group');
        if(typeof role === 'undefined'){
            role = "Clinic";
        }
        $('#roleWrap').html(role);
    });
    $("#user_role, #user_role_lab").on("change", function (e) {
        e.preventDefault();
        var user_group_type = $(this).val();
        updateChildUserGroup(user_group_type);
    });

    $('input[name="user_role"]').on("change", function () {
        var val = $(this).val();
        $(".select-container").hide();
        if (val === "ad") {
            $(".role-select-container").show();
        }
    });

    $("#profile-pic").on("change", function () {
        readURL(this);
    });

    $(".pr-password").passwordRequirements({});

    $("#create_user_form").validate({
        rules: {
            first_name: {
                required: true,
            },
            // email: {
            //     required: true,
            //     email: true,
            //     // remote: _base_url + `/auth/unique_email?id=${user_id}`,
            // },

            memorable: {
                required: true,
                rangelength: [10, 10]
            },
            user_role: {
                required: true,
            },
            "Hgroup_id[]": {
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
        messages: {
            first_name: "Please provide a name",
            // email: {
            //     remote: "Email already exists",
            // },

            memorable: {
                required: "Please provide a memorable",
                rangelength: "Memorable must be 10 characters long"
            },
            user_role: "Role is required",
            Hgroup_id: "Member of is required",
            child_pathologist_user_group: "Pathologist group is required",
        },
        submitHandler: function (form) {
            // e.preventDefault();
            // console.log("VALIDATION PASSED!!!");
            form.submit();
        },
    });

    $("#edit_user_form").validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                // remote: _base_url + `/auth/unique_email?id=${user_id}`,
            },
            memorable: {
                required: true,
                rangelength: [10, 10]
            }
        },
        messages: {
            first_name: "Please provide a name",
            email: "Please provide an unique email",
            memorable: {
                required: "Please provide a memorable",
                rangelength: "Memorable must be 10 characters long"
            }
        },
        submitHandler: function (form) {
            // e.preventDefault();
            // console.log("VALIDATION PASSED!!!");
            form.submit();
        },
    });

    $(".toggle_value").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });



    // $("body").on('click', '.view_password', function () {
    //     $(this).children().toggleClass("fa-eye fa-eye-slash");
    //     if ($(this).closest(".tg-inputwithicon").find(".show_pass").attr("type") === "password") {
    //         $(this).closest(".tg-inputwithicon").find(".show_pass").attr("type", "text");
    //     } else {
    //         $(this).closest(".tg-inputwithicon").find(".show_pass").attr("type", "password");
    //     }
    //
    // });
});
