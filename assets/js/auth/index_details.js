function hideUserCard() {
    $(".user-card").hide();
    $("#select-hospital").val("").trigger('change');
    $("#select-name").val("").trigger('change');
    $("#select-organization").val("").trigger('change');
    $("#group-select").val("").trigger('change');
}

function showAllUserCard() {
    $(".user-card").show();
    $("#select-hospital").val("").trigger('change');
    $("#select-name").val("").trigger('change');
    $("#select-organization").val("").trigger('change');
    $("#group-select").val("").trigger('change');
}

function populateNameSelect() {
    let select = $("#select-name");
    select.empty();
    let option = $(`<option value=""></option>`);
    select.append(option);
    for (user of user_data) {
        select.append($(`<option value="${user.user_id}">${user.first_name} ${user.last_name}</option>`));
    }
    select.select2({width: '100%'});
    $('.name-select-container').show();
}

function populateByGroupSelected() {
    let group_id_get = $("#user_role_get").val();
    if (group_id_get !== "") {
        hideUserCard();
        $(this).val(group_id_get).trigger('change');
        $(`[data-group="${group_id_get}"]`).show();
    }
}

$(() => {
    populateNameSelect();
    populateByGroupSelected();
    $("#user_status").select2({width: '100%'});
    $.get(_base_url + 'auth/get_all_hospitals', function (data) {
        let select = $("#select-hospital");
        select.empty();
        let option = $(`<option value="">Select Clinic</option>`);
        select.append(option);
        for (hospital of data) {
            select.append($(`<option value="${hospital.id}">${hospital.description}</option>`));
        }
        select.select2({width: '100%'});
        $('.hospital-select-container').show();
    }).fail(function (err) {
        console.log(err);
        console.log("Get Hospital Errors");
        $("#select-hospital").select2({width: '100%'});
        $('.hospital-select-container').show();
    });

    $.get(_base_url + 'auth/get_all_organizations', function (data) {
        let select = $("#select-organization");
        select.empty();
        let option = $(`<option value="">Select Organization</option>`);
        let labGroup = $(`<optgroup label="Laboratory"></optgroup>`);
        let netGroup = $(`<optgroup label="Network"></optgroup>`);
        let csGroup = $(`<optgroup label="Cancer Service"></optgroup>`);
        select.append(option);
        for (org of data) {
            if (org.group_type === 'L') {
                labGroup.append($(`<option value="${org.id}">${org.description}</option>`));
            }
            if (org.group_type === 'N') {
                netGroup.append($(`<option value="${org.id}">${org.description}</option>`));
            }
            if (org.group_type === 'CS') {
                csGroup.append($(`<option value="${org.id}">${org.description}</option>`));
            }
        }
        select.append(labGroup);
        select.append(netGroup);
        select.append(csGroup);
        select.select2({width: '100%'});
        $('.org-select-container').show();
    }).fail(function (err) {
        console.log(err);
        console.log("Get Organization error");
        $("#select-organization").select2({width: '100%'});
        $('.org-select-container').show();
    });

    $.get(_base_url + 'auth/get_all_roles', function (data) {
        let select = $("#group-select");
        let group_id_get = $("#user_role_get").val();
//        console.log(group_id_get); return false; 
        let selected_opt = "";
        if (group_id_get == "") {
            selected_opt = "selected";
        }
       // console.log(selected_opt); return false; 
        select.empty();
        let option = $(`<option value="">Select Roles</option>`);
        let all_option = $(`<option value="0" ${selected_opt}>All</option>`);
        select.append(option);
        select.append(all_option);
        for (role of data) {
            let selected = (group_id_get == role.id ? 'selected' : '');
            select.append($(`<option value="${role.id}" ${selected}>${role.description}</option>`))
        }
        select.select2({width: '100%'});
        $('.role-select-container').show();
    }).fail(function (err) {
        console.log(err);
        console.log("Get Role error");
        $("#group-select").select2({width: '100%'});
        $('.role-select-container').show();
    });

    $("#select-hospital").on('select2:select', function () {
        var hid = $(this).val();
        hideUserCard();
        $(".user-card").each(function () {
            let hosp_data_arr = $(this).data('hospital');
            if ($.inArray(hid, hosp_data_arr) != -1) {
                $(this).val(hid).trigger('change');
                $(this).show();
            }
        });
    });

    $("#select-name").on('select2:select', function () {
        var uid = $(this).val();
        hideUserCard();
        $(this).val(uid).trigger('change');
        $(`#user-card-${uid}`).show();
    });


    $("#group-select").on('select2:select', function () {
        var gid = $(this).val();
        hideUserCard();
        $(this).val(gid).trigger('change');
        if (gid == 0) {
            showAllUserCard();
        } else {
            $(`[data-group="${gid}"]`).show();
        }
    })

    $("#select-organization").on("select2:select", function () {
        var gid = $(this).val();
        hideUserCard();
        $(this).val(gid).trigger('change');
        $(`[data-group="${gid}"]`).show();
    });

    $(".user_status").on("click", function () {
        var gid = $(this).attr("data-id");
        hideUserCard();
        $(this).val(gid).trigger('change');
        if (gid == "all") {
            showAllUserCard();
        } else {
            $(`[data-status="${gid}"]`).show();
        }
    });

    $("#clear-filter").on('click', function () {
        $("#search-user").val("");
        showAllUserCard();
    });

    $("#search-user").on("keydown", function () {
        let term = $(this).val().trim().toLowerCase();
        if (term.length === 0) {
            showAllUserCard();
            return;
        }
        hideUserCard();
        for (let i = 0; i < user_data.length; i++) {
            let user = user_data[i];
            if (
                user['first_name'].toLowerCase().indexOf(term) !== -1 ||
                user['last_name'].toLowerCase().indexOf(term) !== -1 ||
                user['description'].toLowerCase().indexOf(term) !== -1) {

                $("#user-card-" + user['user_id']).show();

            }
        }
    });

    $(".btn-temp-pass").on('click', function () {
        var dataId = $(this).attr("data-id");
        $("#user_id").val(dataId);
    });

    $(".password-submit-btn").on("click", function () {
        var passStatus = $("#password").val();
        if (passStatus != "") {
            $.ajax({
                type: "POST",
                url: _base_url + '/auth/update_password',
                data: $("#update_password_form").serialize(),
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
        } else {
            $.sticky("Password field is required", {
                classList: 'important',
                speed: 200,
                autoclose: 7000
            });
        }
    });

    $(".btn-delete").on("click", function () {
        var userId = $(this).attr("data-id");
        $("#delete_user_id").val(userId);
    });

    $(".btn-user-delete").on("click", function () {
        $.ajax({
            type: "POST",
            url: _base_url + '/auth/delete_user_ajax',
            data: $("#delete_user_form").serialize(),
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_leave_modal').modal('hide');
                    // $("#specimen_" + specimenId + " .block_table").append(response.data);
                    $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                    location.reload();
                } else {
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });
    });
});
