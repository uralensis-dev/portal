
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