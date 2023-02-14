function formatState(state) {
    var stateimage = $(state.element).attr('data-img');
    if (!state.id) {
        return state.text;
    }
    var $state = $(
        '<span ><img class="dd_img" src=" '+_base_url + stateimage + '" /> ' + state.text + '</span>'
    );
    return $state;
}

var site_url = $('#base_url').val();

function strartDelete(elem) {
    var teamID = $(elem).data('team');
    $('#delete_team').find('#team_id').val(teamID);
}

function toggleSubMenu(id) {
    $('#' + id).toggle();
}


function form_submission() {
    var title = $("input[name='title']").val();
    if (title !== null && title.length != 0) {
        $('#event_form').submit();
    } else {
        alert('You have to give a title to your event');
        return false;
    }
}


$(document).ready(function () {
    $('#rota_category').DataTable();
});


function strartDelete(elem) {
    var rota_category_ID = $(elem).data('rota_category_id');
    $('#delete_rota_category').find('#rota_category_id').val(rota_category_ID);
}

$(document).on('click', '#cnfrmDelete', function () {
    $('#deleteRotaCategory').submit();
})

$(document).ready(function () {
    $(".delete_btn").click(function () {
        $("#delete_rota_category_id").val($(this).attr("data-rota_category_id"));
        $("#delete_rota_category").modal();
    });
    $(".add-btn").click(function () {
        $("#add_rota_category").modal();
    });
});

function strartInnerDelete(elem) {
    var rota_category_ID = $(elem).data('rota_category_inner_id');
    $('#delete_rota_inner_category').find('#rota_inner_category_id').val(rota_category_ID);
}

$(document).on('click', '#cnfrmInnerDelete', function () {
    $('#deleteRotaInnerCategory').submit();
})

$(document).ready(function () {
    $(".delete_inner_btn").click(function () {
        $("#delete_rota_inner_category_id").val($(this).attr("data-rota_inner_category_id"));
        $("#delete_rota_inner_category").modal();
    });
    $(".add-inner-btn").click(function () {
        $("#add_rota_inner_category").modal();
    });
});

$(() => {

    $('#rota_inner_category').DataTable();

    $('#edit_team').on('hide.bs.modal', function (e) {
        $('#projLoader').show();
        $('#projData').hide();
    });

    $(document).on('click', '#cnfrmDelete', function () {
        $('#deleteTeam').submit();
    });

    $('.datatable').dataTable({
        "ordering": false
    });

    $('.select-adv').select2({
        width: '100%'
    });

    $('.group_id').select2();
    $('.edit_group_id').select2();

    $("#sidebar-menu").find("a").click(function (event) {
        var loc = $(this).attr('href');
        if (loc != '#') {
            window.location.href = loc;
        }
    });

    $("#group_id").change(function () {
        var groupIDs = $("#group_id").val();
        $.ajax({
            url: _base_url + "_team/team/get_users_by_id", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                IDs: groupIDs
            },
            success: function (result) {
                var obj = result;
                if (obj != '') {
                    var user_options = '<option value="">Select</option>';
                    jQuery.each(obj, function (i, val) {
                        user_options += "<option data-img='" + val.profile_picture_path + "' value='" + val.user_id + "'>" + val.enc_first_name + " " + val.enc_last_name + "</option>";
                    });
                    $('#team_leader').html(user_options);
                    $('#deputy_team_leader').html(user_options);
                    $('#team_member').html(user_options);
                    user_options = '';
                } else {
                    $('#team_leader').html('');
                    $('#deputy_team_leader').html('');
                    $('#team_member').html('');
                }
            }
        });

    });

    $(".edit_btn").click(function () {

        var selVal = $(this).attr("data-group_id").split(',');
        $('#edit_team').find('#edit_group_id').val(selVal);
        $('#edit_team').find('#edit_group_id').trigger('change');

        $('#edit_team').find('#edit_team_leader').val($(this).attr("data-team_leader"));
        $('#edit_team').find('#edit_team_leader').trigger('change');

        var selValDT = $(this).attr("data-deputy_team_leader").split(',');
        $('#edit_team').find('#edit_deputy_team_leader').val(selValDT);
        $('#edit_team').find('#edit_deputy_team_leader').trigger('change');

        $.ajax({
            url: _base_url+"_team/team/get_users_by_id", //the page containing php script
            type: "post", //request type,
            dataType: 'json',
            data: {
                IDs: $(this).attr("data-group_id")
            },
            success: function (result) {
                var obj = result;
                if (obj != '') {
                    jQuery.each(obj, function (i, val) {
                        console.log(val.user_id);
                        $('#edit_team').find('#edit_team_leader option[value!="' + val.user_id + '"]').remove();
                    });
                }
            }
        });


        var selValTM = $(this).attr("data-team_member").split(',');
        $('#edit_team').find('#edit_team_member').val(selValTM);
        $('#edit_team').find('#edit_team_member').trigger('change');


        $("#edit_team_id").val($(this).attr("data-team_id"));
        $("#edit_team_name").val($(this).attr("data-team_name"));
        $("#edit_rota_type").val($(this).attr("data-rota_type"));
        $("#edit_description").val($(this).attr("data-description"));
        if ($(this).attr("data-rota_type") != '') {
            $("#edit_check_rota").prop("checked", true);
        }
        $("#edit_team").modal();
    });

    $("#team_leader").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    $(".edit_team_leader").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    $("#deputy_team_leader").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    $(".edit_deputy_team_leader").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    $("#team_member").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    $(".edit_team_member").select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    $(".delete_btn").click(function () {
        $("#delete_team_id").val($(this).attr("data-team_id"));
        $("#delete_team").modal();
    });

    $(".edit_group_id").click(function () {
        var groupIDs = $("#edit_group_id").val();
        alert(groupIDs);
        $.ajax({
            url: _base_url + "_team/team/get_users_by_id", 
            type: "post", //request type,
            dataType: 'json',
            data: {
                IDs: groupIDs
            },
            success: function (result) {
                var obj = result;
                if (obj != '') {
                    var user_options = '<option value="">Select</option>';
                    jQuery.each(obj, function (i, val) {
                        user_options += "<option data-img='" + val.profile_picture_path + "' value='" + val.user_id + "'>" + val.enc_first_name + " " + val.enc_last_name + "</option>";
                    });
                    $('.edit_team_leader').html(user_options);
                    $('.edit_deputy_team_leader').html(user_options);
                    $('.edit_team_member').html(user_options);
                    user_options = '';
                } else {
                    $('.edit_team_leader').html('');
                    $('.edit_deputy_team_leader').html('');
                    $('.edit_team_member').html('');
                }
            }
        });

    });

});