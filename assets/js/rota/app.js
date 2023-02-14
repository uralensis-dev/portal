
var site_url = $('#base_url').val();

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

function findArrayIndex(arr, val) {
    for (let i = 0; i < arr.length; i++) {
        var a = arr[i];
        if (a.toLowerCase() === val.toLowerCase()) {
            return i;
        }
    }
    return -1;
}

$(document).on('click', '#cnfrmDelete', function () {
    $('#deleteRotaCategory').submit();
});

$(document).ready(function () {
    $(".delete_btn").click(function () {
        $("#delete_rota_category_id").val($(this).attr("data-rota_category_id"));
        $("#delete_rota_category").modal();
    });
    $(".add-btn").click(function () {
        $("#add_rota_category").modal();
    });
});



$(document).ready(function () {
    $('#rota_inner_category').DataTable();
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
    $(".myBtn").click(function () {
        $("#rota_team_id").val($(this).attr("data-TeamID"));
        $("#rota_team_name").val($(this).attr("data-TeamNAME"));
        $("#rota_user_id").val($(this).attr("data-UserID"));
        $("#rota_user_name").val($(this).attr("data-UserNAME"));
        $("#rota_date_of_event").val($(this).attr("data-DateOfRota"));
        $("#rota_user_type").val($(this).attr("data-TYPE"));
        $("#myModal").modal();
    });

    $(".edit_btn").click(function () {
        $("#edit_rota_team_id").val($(this).attr("data-TeamID"));
        $("#edit_rota_team_name").val($(this).attr("data-TeamNAME"));
        $("#edit_rota_user_id").val($(this).attr("data-UserID"));
        $("#edit_rota_user_name").val($(this).attr("data-UserNAME"));
        $("#edit_rota_date_of_event").val($(this).attr("data-DateOfRota"));
        $("#edit_rota_user_type").val($(this).attr("data-TYPE"));
        
        $("#edit_event_id").val($(this).attr("data-EventID"));
        
        $('#myEditModal').find('#edit_event_category').val($(this).attr("data-Category"));
        $('#myEditModal').find('#edit_event_category').trigger('change');
        
        $("#edit_end_time_of_rota").val($(this).attr("data-EndTime"));
        $("#edit_start_time_of_rota").val($(this).attr("data-StartTime"));
        
        $("input[name=rota_type][value=" + $(this).attr("data-RotaType") + "]").attr('checked', 'checked');
        
        $("#myEditModal").modal();
    });

    $(".main-list li").click(function() {
        $(".main-list li .children").hide();
        $(".main-list li").css("background","transparent");
        $(this).css("background","#ffffff");
        $(this).children(".children").show();
    });
    $("#team_id").on('change', function () {
        var val = $(this).val();
        var uri_parts = window.location.href.split('/');
        var rota_index = findArrayIndex(uri_parts, '_rota')
        var uri_segment = 'index';
        if (rota_index + 2 <= uri_parts.length) {
            uri_segment = uri_parts[rota_index + 2];
            if (uri_segment.trim().length === 0) {
                uri_segment = 'index';
            }
        }
        window.location.href = _base_url+'_rota/rota/'+uri_segment+'/'+val;
    });
    
    $('.step').timepicker({ 'step': 30 });
});