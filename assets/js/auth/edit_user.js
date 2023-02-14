var baseUrl = $("#base_url").val();
$(() => {
    $.validator.addMethod("pwcheck", function (value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
    });

    $("#edit-form").validate({
        rules: {
            first_name: {
                required: true,
            },
            email: {
                required: true,
                email: true,
                remote: _base_url + `/auth/unique_email?id=${user_id}`,
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
        messages: {
            first_name: "Please provide a name",
            email: {
                remote: "Email already exists",
            },

            memorable: {
                required: "Please provide a memorable",
                rangelength: "Memorable must be 10 characters long"
            },
            "group_id[]": "Member of is required",
            child_user_group: "User group is required",
            child_pathologist_user_group: "Pathologist group is required",
        },
        submitHandler: function (form) {
            // e.preventDefault();
            // console.log("VALIDATION PASSED!!!");
            form.submit();
        },
    });
});
// if($("#member_of_select2").val().length > 0 && ($("#member_of_select2").find('selected').attr('data-grouptype')!='A' || $("#member_of_select2").val()!='61')){
// if($("#member_of_select2").val().length > 0 && ($("#member_of_select2").val()!='1' || $("#member_of_select2").val()!='61')){
$(document).ready(function () {
    $(".datetimepicker").datetimepicker({
        timepicker: false,
        format: 'Y-m-d',
        todayButton:true,
    });
    $('.select_member_of').select2();

    $(".btn-user-status").on("click", function (e) {
        var dataId = $(this).attr("data-id");
        var user_id = $("#user_id").val();
        $.ajax({
            type: "POST",
            url: _base_url + '/auth/updateUserStatus',
            data: {dataId: dataId, user_id: user_id, [csrf_name]: csrf_hash},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_leave_modal').modal('hide');
                    // $("#specimen_" + specimenId + " .block_table").append(response.data);
                    $.sticky(response.message, {
                        classList: 'success',
                        speed: 200,
                        autoclose: 7000
                    });
                    location.reload();
                } else {
                    $.sticky(response.message, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 7000
                    });
                }
            }
        });
    });
});

$("#member_of_select2").on("select2:select select2:unselect", function (e) {
    e.preventDefault();
    $("#pathologist_role_div").addClass('p_hidden');
    $("#pathologist_manager_div").addClass('p_hidden');
    var error = 0;
    $("#member_of_err_label").text('');
    var base_url = $("#base_url").val();
    var csrf_token_name = $("#csrf_token_name").val();
    var csrf_token_hash = $("#csrf_token_hash").val();
    // var selected_grps_by_db = $("#selected_grps_by_db").val();
    // selected_grps_by_db = JSON.parse(selected_grps_by_db);
    var group_type = $("#member_of_select2 :selected").map((_, e) => e.attributes[1].value).get();
    const allGrpTypeEqual = arr => arr.every(v => v === arr[0]);
    const all_empty = arr2 => arr2.every(function (v) {
        return v === "";
    });

    if (group_type.length === 0) {
        $("#member_of_select2").focus();
        $("#member_of_err_label").text('');
        $("#member_of_err_label").text('Member of is required');
        error++;
    }
    if (all_empty(group_type)) {
        $("#member_of_select2").focus();
        $("#member_of_err_label").text('');
        $("#member_of_err_label").text('Member of is required');
        error++;
    }
    if (!(allGrpTypeEqual(group_type))) {
        $("#member_of_select2").focus();
        $("#member_of_err_label").text('');
        $("#member_of_err_label").text('User can Belong to one Institute/User type only');
        error++;
    }
    var user_group_type = group_type[0];
    // console.log("Group Types are equal"); return false;

    if (error > 0) {
        return false;
    } else {
        // var group_type = obj.options[obj.selectedIndex].getAttribute('data-grouptype');
        if (user_group_type != '') {
            var data_form = {
                [csrf_token_name]: csrf_token_hash,
                'group_type': user_group_type
            };
            console.log("Group Type:" + user_group_type);
            $.ajax({
                type: "POST",
                url: base_url + '/auth/get_child_groups',
                data: data_form,
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        console.log("Response Parent Groups" + response.parent_groups);
                        $("#child_user_groups").html('');
                        $("#manager_pathologist").html('');
                        $("#child_pathologist_user_group").html('');
                        $('#child_user_groups').append($('<option>', {
                            value: '',
                            text: 'Select User Group',
                            'data-grouptype': ''
                        }));
                        $.each(response.parent_groups, function (i, item) {
                            $('#child_user_groups').append($('<option>', {
                                value: item.id,
                                text: item.name,
                                'data-grouptype': item.group_type
                            }));
                        });
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
    }
});

function updateChildUserGroup(user_group_type1){
    $("#child_user_groups").html('');
    $("#organization_group_id").html('');
    var csrf_token_name = $("#csrf_token_name").val();
    var csrf_token_hash = $("#csrf_token_hash").val();
    var user_group_type = Number(user_group_type1);
    if (user_group_type == 1 || user_group_type == 2) 
	{
        $("#child_user_group").prop("disabled", true);
        return;
    } 
	else 
	{
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
            if (response.status === 'success') {
                $("#organization_group_id").html('');
                var pre_selected_members = $("#user_organization_id").val();
                $.each(response.parent_groups, function (i, item) {
                    var selecteds = (item.id == $("#user_organization_id").val()) ? "selected" : "";
                    $('#organization_group_id').append($('<option>', {
                        value: item.id,
                        text: item.description + " (" + item.group_type + ")",
                        'data-grouptype': item.group_type,
                        'selected': selecteds
                    }));
                });
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

    $.ajax({
        type: "POST",
        url: baseUrl + '/auth/get_role_hospitals',
        data: data_form,
        dataType: "json",
        success: function (response) {
            // var specimenId = $('#block_specimen_id').val();
            if (response.status === 'success') {
                console.log("Response Parent Groups" + response.parent_groups);
                $("#child_user_groups").html('');
                $("#manager_pathologist").html('');
                $("#child_pathologist_user_group").html('');
                // $('#child_user_groups').append($('<option>', {
                //     value: '',
                //     text: 'Select User Group',
                //     'data-grouptype': ''
                // }));
                var pre_selected_members = $.parseJSON($("#user_pre_member_groups").val());
                $.each(response.parent_groups, function (i, item) {
                    var selecteds = "";
                    if (jQuery.inArray(item.id, pre_selected_members) !== -1) {
                        selecteds = "selected";
                    }
                    $('#child_user_groups').append($('<option>', {
                        value: item.id,
                        text: item.description + " (" + item.group_type + ")",
                        'data-grouptype': item.group_type,
                        'selected': selecteds
                    }));
                });
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
        $(".user_sub_role").show();
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
                    var user_pre_sub_role = $("#user_pre_sub_role").val();

                    $.each(response.parent_groups, function (i, item) {
                        $('#user_sub_role').append($('<option>', {
                            value: item.id,
                            text: item.description,
                            'data-grouptype': item.group_type,
                            'selected': (user_pre_sub_role==item.id?'selected':'')
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
        // $('#child_user_groups').select2('enable', false);
        // $('#user_group_id').prop('disabled', true);
        // $('#child_user_groups').prop('disabled', true);

        $('#select_roles').attr('disabled','disabled');
        $('#user_sub_role').attr('disabled','disabled');
        $('#child_user_groups').attr('disabled','disabled');
    }

}
$.get(baseUrl + 'auth/get_all_roles1', function (data) {
    console.log(data);
    let select = $("#select_roles");
    let group_id_get = $("#user_group_id").val();
    // let selected_opt = "";
    // if (group_id_get == "") {
    //     selected_opt = "selected";
    // }

    select.empty();
    let option = $(`<option value="">Select Role</option>`);
    let HosGroup = "<optgroup label='Hospital'>";
    let LabGroup = "<optgroup label='Laboratory'>";
    let PathGroup = "<optgroup label='Pathologist'>";
    let SaGroup = "<optgroup label='System Admin'>";


    //       let LabGroup = $(`<optgroup label="Laboratory"><option value="68" >Lab Accounts</option>
    // <option value="66">Lab Data Entry</option>
    // <option value="67" >Lab Scientist</option>
    // <option value="65" >Lab System Admin</option></optgroup>`);
    //       let PathGroup = $(`<optgroup label="Pathologist"><option value="6" >Pathologist </option>
    // <option value="64" >Pathology Secretary</option>
    // <option value="47" >Trainee</option></optgroup>`);
    //       let NaGroup = $(`<optgroup label="Network Admin"><option value="61" >Network Admin</option></optgroup>`);
    //       let SaGroup = $(`<optgroup label="System Admin"><option value="2" >General User</option>
    // <option value="1" >System Admin</option></optgroup>`);

    //let all_option = $(`<option value="0" ${selected_opt}>All</option>`);
    select.append(option);


    // select.append(all_option);
    for (role of data['H']) {
        HosGroup += `<option value="${role.id}" >${role.description}</option>`;
    }
    for (role of data['L']) {
        LabGroup += `<option value="${role.id}" >${role.description}</option>`;
    }
    for (role of data['D']) {
        PathGroup += `<option value="${role.id}" >${role.description}</option>`;
    }
    for (role of data['A']) {
        SaGroup += `<option value="${role.id}" >${role.description}</option>`;
    }

    HosGroup += "</optgroup>";
    LabGroup += "</optgroup>";
    PathGroup += "</optgroup>";
    SaGroup += "</optgroup>";

    select.append(HosGroup);
    select.append(LabGroup);
    select.append(PathGroup);
    // select.append(NaGroup);
    select.append(SaGroup);


    select.select2({width: '100%'});

    select.val(group_id_get).trigger("change");
    updateChildUserGroup(group_id_get);
    // $("#select_roles").trigger("change");
    // ${role.id==group_id_get?"selected":""}
    $('.role-select-container').show();
}).fail(function (err) {
    console.log(err);
    console.log("Get Role error");
    $("#select_roles").select2({width: '100%'});
    $('.role-select-container').show();
});

setTimeout(function (){
    let role_id = $('#select_roles').attr('data-selected-role-id');
    $("#select_roles").select2("val", role_id);
},500);

$("#select_roles").on("change", function (e) {
    e.preventDefault();
    var user_group_type = Number($(this).val());
    updateChildUserGroup(user_group_type);
});

// function checkchildgroup(obj) {
//     var base_url = $("#base_url").val();
//     var csrf_token_name = $("#csrf_token_name").val();
//     var csrf_token_hash = $("#csrf_token_hash").val();
//     var group_type = $("#member_of_select2").select2().find(":selected").data("grouptype");
//     console.log("Group Type: ",group_type); return false;
//     // var group_type = obj.options[obj.selectedIndex].getAttribute('data-grouptype');
//     if(group_type !=''){
//     var data_form = {
//         [csrf_token_name]: csrf_token_hash,
//         'group_type': group_type
//     };
//     console.log("Group Type:" + group_type);
//     $.ajax({
//         type: "POST",
//         url: base_url + '/auth/get_child_groups',
//         data: data_form,
//         dataType: "json",
//         success: function (response) {
//             // var specimenId = $('#block_specimen_id').val();
//             if (response.status === 'success') {
//                 console.log(response.parent_groups);
//                 $("#child_user_groups").html('');
//                 $('#child_user_groups').append($('<option>', {
//                     value: '0',
//                     text: 'Select User Group'
//                 }));
//                 $.each(response.parent_groups, function (i, item) {
//                     $('#child_user_groups').append($('<option>', {
//                         value: item.id,
//                         text: item.name,
//                     }));
//                 });
//                 // location.reload();
//             } else {
//                 $.sticky(response.message, {
//                     classList: 'important',
//                     speed: 200,
//                     autoclose: 7000
//                 });
//             }
//         }
//     });
//     }
// }

function checkchildpathologistgroup(obj) {
    var base_url = $("#base_url").val();
    var error = 0;
    $("#pathologist_role_div").addClass('p_hidden');
    $("#pathologist_manager_div").addClass('p_hidden');

    var csrf_token_name = $("#csrf_token_name").val();
    var csrf_token_hash = $("#csrf_token_hash").val();
    var membr_group_type = $("#member_of_select2 :selected").map((_, e) => e.attributes[1].value).get();
    var group_type = obj.options[obj.selectedIndex].getAttribute('data-grouptype');
    var group_id = obj.options[obj.selectedIndex].getAttribute('value');
    var group_name = obj.options[obj.selectedIndex].innerText;

    if ((group_type == 'LA' || group_type == 'HA') && membr_group_type.length > 1) {
        $("#member_of_select2").focus();
        $("#member_of_err_label").text('');
        $("#member_of_err_label").text('This User group can belong to one Institute only');
        error++;
    }

    if (error > 0) {
        return false;
    } else {

        if (group_type !== '' && group_type == 'D' ) 
		{
            var data_form = {
                [csrf_token_name]: csrf_token_hash,
                'group_type': group_type
            };
            console.log("Group Type:" + group_type);
            $.ajax({
                type: "POST",
                url: base_url + '/auth/get_child_groups',
                data: data_form,
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        console.log(response.parent_groups);
                        $("#pathologist_role_div").removeClass('p_hidden');
                        // $("#pathologist_manager_div").removeClass('p_hidden');
                        $("#child_pathologist_user_group").html('');
                        $("#manager_pathologist").html('');
                        $('#child_pathologist_user_group').append($('<option>', {
                            value: '',
                            text: 'Select Role'
                        }));
                        $('#child_pathologist_user_group').append($('<option>', {
                            value: group_id,
                            text: group_name,
                            'data-grouptype': group_type
                        }));
                        $.each(response.parent_groups, function (i, item) {
                            $('#child_pathologist_user_group').append($('<option>', {
                                value: item.id,
                                text: item.name,
                                'data-grouptype': item.group_type
                            }));
                        });
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
    }
}

function checkPathologistManager(obj) {
    var base_url = $("#base_url").val();
    $("#pathologist_manager_div").addClass('p_hidden');
    var csrf_token_name = $("#csrf_token_name").val();
    var csrf_token_hash = $("#csrf_token_hash").val();
    var group_type = obj.options[obj.selectedIndex].getAttribute('data-grouptype');
    var group_id = obj.options[obj.selectedIndex].getAttribute('value');
    var group_name = obj.options[obj.selectedIndex].innerText;
    if (group_type !== '' && group_type != 'D') {
        var data_form = {
            [csrf_token_name]: csrf_token_hash,
            'group_type': group_type
        };
        // console.log("Pathologist Group Type:"+group_type); return false;
        $.ajax({
            type: "POST",
            url: base_url + '/auth/get_all_pathologists',
            data: data_form,
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $("#pathologist_manager_div").removeClass('p_hidden');
                    $("#manager_pathologist").html('');
                    $('#manager_pathologist').append($('<option>', {
                        value: '',
                        text: 'Select Pathologist'
                    }));
                    $.each(response.pathologists, function (i, item) {
                        $('#manager_pathologist').append($('<option>', {
                            value: item.id,
                            text: item.pathologist_name
                        }));
                    });
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
}