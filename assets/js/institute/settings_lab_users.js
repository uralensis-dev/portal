function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-pic-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}


function openGroupModal(group_type) {
    if (group_type === 'L') {
        $("#group-modal").find('.modal-title').html('Laboratories');
        $("#list-group-title").html('All Labs');
        $("#group-list-container").empty();
        $("#add-group-btn").attr('data-type', 'L').find('span').html('Lab');
        $.get(_base_url + 'institute/fetch_all_groups?type=L', function(data) {
            for (let i = 0; i < data.length; i++) {
                var lab = data[i];
                var users = lab.users;
                var template = '<li class="list-group-item">\n' +
                    '               <div class="row">\n' +
                    '                   <div class="col-md-6" style="cursor: pointer;" data-toggle="collapse" data-target="#lab-users-${lab.id}">\n' +
                    '                       ${lab.description}\n' +
                    '                   </div>\n' +
                    '                   <div class="col-md-6 text-right" style="width:2rem">\n' +
                    '                       <a href="javascript:void(0)" onclick="RemoveLab(${lab.id},${lab.id})" class="btn btn-success add-user-btn">X</a>\n' +
                    '                   </div>\n' +
                    '               </div>\n' +
                    '               <div class="collapse" id="lab-users-${lab.id}">\n' +
                    '                   <ul class="list-group"></ul>\n' +
                    '               </div>\n' +
                    '           </li>';
                var lab_row = $(template);
                for (let j = 0; j < users.length; j++) {
                    var user = users[j];
                    var img_src = _base_url + 'assets/img/user.jpg';
                    if (user['profile_picture']) {
                        img_src = _base_url + user['profile_picture'];
                    }
                    var user_template = `<li class="list-group-item"> <img src="${img_src}" class="user_image"/> ${user.first_name} ${user.last_name}</li>`;
                    lab_row.find('.list-group').append($(user_template));
                }
                $("#group-list-container").append(lab_row);
            }
            $("#group-modal").modal('show');
        });
    }
    if (group_type === 'CS') {
        $("#group-modal").find('.modal-title').html('Cancer Services');
        $("#list-group-title").html('All Cancer Services');
        $("#group-list-container").empty();
        $("#add-group-btn").attr('data-type', 'CS').find('span').html('Cancer Service');
        $.get(_base_url + 'institute/fetch_all_groups?type=CS', function(data) {
            for (let i = 0; i < data.length; i++) {
                var lab = data[i];
                var users = lab.users;
                var template = `
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6" style="cursor: pointer;" data-toggle="collapse" data-target="#lab-users-${lab.id}">
                                ${lab.description}
                            </div>
                            <div class="col-md-6 text-right" style="width: 2rem">
                                <a style="cursor: pointer;" onclick="add_user(${lab.id}, 'CS')" class="btn btn-success add-user-btn"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="collapse" id="lab-users-${lab.id}">
                            <ul class="list-group">
                                
                            </ul>
                        </div>
                    </li>`;
                var lab_row = $(template);
                for (let j = 0; j < users.length; j++) {
                    var user = users[j];
                    var img_src = _base_url + 'assets/img/user.jpg';
                    if (user['profile_picture']) {
                        img_src = _base_url + user['profile_picture'];
                    }
                    var user_template = `<li class="list-group-item"> <img src="${img_src}" class="user_image"/> ${user.first_name} ${user.last_name}</li>`;
                    lab_row.find('.list-group').append($(user_template));
                }
                $("#group-list-container").append(lab_row);
            }
            $("#group-modal").modal('show');
        });
    }
	
	
	
	
}


function openRecordsModal(type) {
    console.log(type); return false;
    var name = '';
    switch (type) {
        case 'LC':
            name = 'Lab Accounts';
            break;
        case 'DE':
            name = 'Lab Data Entry';
            break;
        case 'LS':
            name = 'Lab Scientist';
            break;
     
    }
    if (name.length === 0) return;
    $("#category-modal").find('.modal-title').html(name);
    $.get(_base_url + 'institute/get_group_users?type='+type, function(data) {
        $("#category-list-container").empty();
        for (var i = 0; i < data.length; i++) {
            var user = data[i];
            var img_src = _base_url + 'assets/img/user.jpg';
            if (user['profile_picture']) {
                img_src = _base_url + user['profile_picture'];
            }
            var user_template = `<li class="list-group-item"> <img src="${img_src}" class="user_image"/> ${user.first_name} ${user.last_name}</li>`;
            $("#category-list-container").append($(user_template));
        }
        $.get(_base_url + 'institute/get_group_id?type='+type, function(data) {
            $("#category-modal").modal('show');
            $("#add-category-btn").off();
            $("#add-category-btn").on('click', function() {
                add_user(data['id'], data['group_type']);
            });
        });
    });
}



function openCategoryModal(group_type ="", group_id="") {
    var name = '';
    
   add_user(group_id, group_type)
}

function add_user(group_id, group_type) {
    reset_form();
    $('input[name="group_id"]').val(group_id);
    $(".modal").modal('hide');
    
   setTimeout(function() {
        $.get(_base_url + 'institute/get_active_directory_users_lab?type='+group_type, function(data) {
            $("#active-directory-select-container").empty();
            var template = $(`<select id="active-directory-select" class="select">
            </select>`);
            if (data.length === 0) {
                template = $('<p>Active directory empty for this group</p>');
            }
            for (let i = 0; i < data.length; i++) {
                var user = data[i];
                template.append(`<option value="${user.id}">${user.first_name} ${user.last_name}</option>`);
            }
            console.log(template);
            $("#active-directory-select-container").append(template);
            $("#active-directory-select").select2({width: '100%'});
            $("#active-directory-select").on('select2:select', function() {
                var user_id = $(this).val();
                $('input[name="active_directory_user"]').val(user_id);
                $.get(_base_url + 'institute/get_user_details_lab?id='+user_id, function(data) {
                    //$("#password-row").hide();
                    //$("#memo-row").hide();
                    $("#email").prop('readonly', true);
                    $("#first_name").val(data['first_name']);
                    $("#last_name").val(data['last_name']);
                    $("#company").val(data['company']);
                    $("#phone").val(data['phone']);
                    $("#email").val(data['email']);
                    if (!(data['profile_picture'] === null || data['profile_picture'].length === 0)) {
                        $("#profile-pic").val('');
                        $("#profile-pic-preview").attr('src', _base_url+data['profile_picture']);
                    }
                });
            });
            $("#user_group_type").val(group_type);
            $("#add-user-modal").modal('show');
        });
    }, 500);
}

function add_group() {
    var type = $("#add-group-btn").attr('data-type');
    $("#add-group-modal").find('input').val('');
    $("#add-group-modal").find('input').removeClass('is-invalid');
    $("#new-group-csrf").val(csrf_hash);
    if (type != 'CS' && type != 'L') {
        return;
    }
    if (type === 'L') {
        $("#new-group-type").val('L');
        $("#add-group-modal").find('.modal-title').html("New Laboratory");
        $("#lab-mask-container").hide();
    } else if (type === 'CS') {
        $("#new-group-type").val('CS');
        $("#add-group-modal").find('.modal-title').html("New Cancer Service");
        $("#lab-mask-container").hide();
    }
    $(".modal").modal('hide');
    setTimeout(function() {
        $("#add-group-modal").modal('show');
    }, 500);
}


function reset_form() {
    $('input[name="active_directory_user"]').val(0);
    $("#email").prop('readonly', false);
    $("#password-row").show();
    $("#memo-row").show();
    $("#password").val('');
    $("#password_confirm").val('');
    $("#memorable").val('');
    $("#first_name").val('');
    $("#last_name").val('');
    $("#company").val('');
    $("#phone").val('');
    $("#email").val('');
    $("#profile-pic").val('');
    $("#profile-pic-preview").attr('src', _base_url+'assets/newtheme/img/profiles/avatar-02.jpg');
    $("#user-create-btn").prop('disabled', false);
    $("#password_confirm").removeClass('is-invalid');
}

$(() => {
    $("#profile-pic").on('change', function () {
        readURL(this);
    });
    

    $("#new-group-name").on('change', function() {
        $("#new-group-add-btn").prop('disabled', true);
        var val = $(this).val();
        $.get(_base_url + 'institute/group_exists?name='+encodeURIComponent(val), function(exists) {
            console.log("Returned: ", exists);
            if (exists)  {
                $("#new-group-name").addClass("is-invalid");
            } else {
                $("#new-group-name").removeClass("is-invalid");
                $("#new-group-add-btn").prop('disabled', false);
            }
        }); 
    });

    if (has_user_error) {
        $("#add-user-modal").modal('show');
    }

    // $("#password_confirm").on('change', function() {
    //     var password = $("#password").val();
    //     var password_confirm = $("#password_confirm").val();
    //     if (password !== password_confirm) {
    //         $("#user-create-btn").prop('disabled', true)
    //         $("#password_confirm").addClass('is-invalid');
    //     } else {
    //         $("#user-create-btn").prop('disabled', false);
    //         $("#password_confirm").removeClass('is-invalid');
    //     }
    // });

    $("#user-form-clear-btn").on('click', function() {
        reset_form();
    });

    $.get(_base_url + 'institute/get_hospital_account_holders', function(data) {
        $("#account_holder").val(data.account_holder).trigger('change');
        $("#deputy_account_holder").val(data.deputy_account_holder).trigger('change');
    }).fail(err => {
        console.log(err);
    });
    $("#account_holder").on('select2:select', function() {
        var val = $(this).val();
        $.post(_base_url + 'institute/set_hospital_account_holder', {account_holder: val, [csrf_name]: csrf_hash}, function() {

        }).fail(err => {
            console.log(err);
        });
    });

    $("#deputy_account_holder").on('select2:select', function() {
        var val = $(this).val();
        $.post(_base_url + 'institute/set_hospital_deputy_account_holder', {deputy_account_holder: val, [csrf_name]: csrf_hash}, function() {
            
        }).fail(err => {
            console.log(err);
        });
    });

    $.get(_base_url + 'institute/get_hospital_groups', function(data) {
        var network_name = 'N/A';
        var network_id = null;
        var lab_count = 0;
        var cancer_service_count = 0;
        for (var i = 0; i < data.length; i++) {
            var group = data[i];
            if (group.group_type === 'N') {
                network_name = group.description;
                network_id = group.id;
            }
            if (group.group_type === 'L') lab_count ++;
            if (group.group_type === 'CS') cancer_service_count ++;
        }
        $("#network-name-title").html(network_name);
        $("#current-network").html(network_name);
        if (network_id) {
            $("#network-"+network_id).find(".btn").hide();
        }
        $("#lab-count-title").html(lab_count);
        $("#cs-count-title").html(cancer_service_count);
    });

    $.get(_base_url + 'institute/get_hospital_user_group', function(data) {
        var clinicians = 0;
        var requestors = 0;
        var pathologists = 0;
        var secretary = 0;
        var trainee = 0;
        for (var i = 0; i < data.length; i++) {
            var user_group = data[i];
            
            switch (user_group.group_type) {
                case 'C':
                    clinicians++;
                    break;
                case 'R':
                    requestors++;
                    break;
                case 'D':
                    pathologists++;
                    break;
                case 'S':
                    secretary++;
                    break;
                case 'T':
                    trainee++;
                    break;
            }
        }
        $("#c-count-title").html(clinicians);
        $("#r-count-title").html(requestors);
        $("#d-count-title").html(pathologists);
        $("#s-count-title").html(secretary);
        $("#t-count-title").html(trainee);
    });

    $(".change_time_div").on("click",function () {
        $("#password_info").modal("show");
    });

    $(".updatepwd-submit-btn").on("click",function () {
        $.ajax({
            type: "POST",
            url: _base_url + '/institute/update_password_time',
            data: $("#update_password_form").serialize(),
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#password_info').modal('hide');
                    // $("#specimen_" + specimenId + " .block_table").append(response.data);
                    $.sticky(response.message, {
                        classList: 'success',
                        speed: 200,
                        autoclose: 7000
                    });
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