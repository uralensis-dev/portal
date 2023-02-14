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
        
        if(group_id_get ==33){
              $(`[data-group="32"]`).show();
        }
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

    $.get(_base_url + 'auth/get_all_roles1', function (data) {
        let select = $("#group-select");
        let group_id_get = $("#user_role_get").val();
        let selected_opt = "";
        if (group_id_get == "") {
            selected_opt = "selected";
        }
     
        select.empty();
        let option = $(`<option value="">Select Role</option>`);
        let all_option = $(`<option value="0" ${selected_opt}>All</option>`);
        let HosGroup = "<optgroup label='Hospital'>";
        let LabGroup = "<optgroup label='Laboratory'>";
        let PathGroup = "<optgroup label='Pathologist'>";
		let SuGroup = "<optgroup label='Surgeon'>";
        let SaGroup = "<optgroup label='System Admin'>";
		
		select.append(option);
        select.append(all_option);
		
		for (role of data['H']) {
            HosGroup += `<option value="${role.id}" >${role.description}</option>`;
        }
        for (role of data['L']) {
            LabGroup += `<option value="${role.id}" >${role.description}</option>`;
        }
        for (role of data['D']) {
            PathGroup += `<option value="${role.id}" >${role.description}</option>`;
        }
		for (role of data['S']) {
            SuGroup += `<option value="${role.id}" >${role.description}</option>`;
        }
        for (role of data['A']) {
            SaGroup += `<option value="${role.id}" >${role.description}</option>`;
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
        //console.log(gid); return false; 
        hideUserCard();
        $(this).val(gid).trigger('change');
        if (gid == 0) {
            showAllUserCard();
        } else {
            if(gid == 33){
               // $(`[data-group="${gid}"]`).show();
                $(`[data-group="32"]`).show();
            }
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
                $('#delete_employee').modal('hide');
                if (response.status === 'success') {
                    $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                    $(document).find('.pagination :nth-child(2)').trigger('click');
                    //location.reload();
                } else {
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });
    });
    
    $(document).on("change", ".checkAll", function(){
        if($(this).prop("checked")) {
            $(".checkSingle").prop("checked", true);
        } else {
            $(".checkSingle").prop("checked", false);
        }
    });

    $(document).on("change", ".checkSingle", function(){
        if($(".checkSingle").length == $(".checkSingle:checked").length) {
            $(".checkAll").prop("checked", true);
        }else {
            $(".checkAll").prop("checked", false);
        }
    });

    $(document).on("click", ".selected_delete", function(){
        let userIds = [];
        $(document).find('.checkSingle').each(function (i, val){
            if (this.checked) {
                userIds.push($(this).val());
            }
        });
        if(userIds.length > 0) {
            if (confirm("Are you sure, You want to delete selected user record ?")) {
                deleteSelectedUsers(userIds);
            } else {
                return false;
            }
        }else {
            jQuery.sticky('Please select any record.', {classList: 'important', speed: 200, autoclose: 5000});
        }
    });

    function deleteSelectedUsers(userIds){
        jQuery.ajax({
            type: "POST",
            url: site_url + "auth/deleteSelectedUsers",
            data: {'crsr_token': jQuery.now(), 'userIds': userIds},
            dataType: "json",
            success: function (data) {
                if (data.status === 'success') {
                    jQuery.sticky(data.message, {classList: 'success', speed: 200, autoclose: 5000});
                    $(document).find('.pagination :nth-child(2)').trigger('click');
                }else{
                    jQuery.sticky(data.message, {classList: 'important', speed: 200, autoclose: 5000});
                }
            }
        });
    }
});
