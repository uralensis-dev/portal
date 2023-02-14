$(document).ready(function () {
    $("#timereport_users").select2({
        placeholder: 'Nothing Selected',
        width: '100%',
        templateResult: formatUsersList,
        templateSelection: formatUsersList
    });

    function formatUsersList(user) {
        console.log(user);
        if (!user.id) {
            return user.text;
        }
        var picture_path = user.element.title;
        var base_url = base_url;
        var full_picture_path = base_url + "/" + picture_path;


        var $user_option = $(
            '<span ><img style="display: inline-block;" width="30" height="30" src="' + full_picture_path + '" /> ' + user.text + '</span>'
        );
        return $user_option;
    }
});
$(document).ready(function () {
    $("#addTaskDetailForm").validate({
        // ignore: ":hidden",
        rules: {
            task_detail: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/timesheet/updateTaskDetail',
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#add_todaywork').modal('hide');
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
            return false; // required to block normal submit since you used ajax
        }
    });
    $("#addTaskCommentForm").validate({
        // ignore: ":hidden",
        rules: {
            flag_comment: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/timesheet/updateTaskComment',
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        // $('#add_todaywork').modal('hide');
                        // $("#specimen_" + specimenId + " .block_table").append(response.data);
                        $.sticky(response.message, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        $(".comments_detail_html").html(response.html);
                        $("#flag_comment").val("");
                        $("#edit_status").val(0);
                        $("#edit_com_id").val(0);
                        $(".cancel-com-btn").hide();
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
            return false; // required to block normal submit since you used ajax
        }
    });


    $("#start_time_btn").on("click", function () {
        $.ajax({
            type: "POST",
            url: _base_url + '/timesheet/startTime',
            data: {[csrf_name]: csrf_hash},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_todaywork').modal('hide');
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

    $("#end_time_btn").on("click", function () {
        $.ajax({
            type: "POST",
            url: _base_url + '/timesheet/stopTime',
            data: {[csrf_name]: csrf_hash},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_todaywork').modal('hide');
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

    $(document).on("click", ".add_task_detail", function () {
        var dataId = $(this).attr("data-id");
        var detailObject = $("#timedetail_" + dataId).val();
        detailObject = $.parseJSON(detailObject);
        $("#timesheet_id").val(dataId);
        $("#task_detail").val(detailObject.description);
        $("#add_task_detail").modal("show");
    });
    $(document).on("click", ".display_comment_box", function () {
        var dataId = $(this).attr("data-id");
        $("#task_comment_id").val(dataId);

        $.ajax({
            type: "POST",
            url: _base_url + '/timesheet/getCommentDetails/'+dataId,
            data:  {[csrf_name]: csrf_hash,dataId: dataId,dataSection: 3},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    // $('#add_todaywork').modal('hide');
                    $(".comments_detail_html").html(response.html);
                }
            }
        });
        return false; // required to block normal submit since you used ajax
    });
    $(document).on("click", ".comment_like", function () {
        var thisSel = $(this);
        var dataId = $(this).attr("data-id");
        var dataSection = $(this).attr("data-section");
        var dataStatus = $(this).attr("data-status");
        var datarecord_id = $(this).attr("data-recordid");

        $.ajax({
            type: "POST",
            url: _base_url + '/timesheet/likeComment/',
            data:  {[csrf_name]: csrf_hash,dataId: dataId,dataSection: dataSection,dataStatus: dataStatus,dataRecordId: datarecord_id},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    // $(document).find(".cursor").css("color", "#1F1F1F");
                    // thisSel.css("color", "#00c5fb");
                    // thisSel.find("span").text("Liked");
                    $(".comments_detail_html").html(response.html);
                }
            }
        });
        return false; // required to block normal submit since you used ajax
    });
    $(document).on("click",".delete-comment-btn",function () {
        var dataId = $(this).attr("data-id");
        var datarecord_id = $(this).attr("data-recordid");

        $.ajax({
            type: "POST",
            url: _base_url + '/doctor/delete_comment_flg/',
            data:  {[csrf_name]: csrf_hash,dataId: dataId,dataRecordId: datarecord_id,dataSection: 3},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $(".comments_detail_html").html(response.html);
                }
            }
        });
        return false; // required to block normal submit since you used ajax
    });
    $(document).on("click",".edit-comment-btn",function () {
        var dataId = $(this).attr("data-id");
        var comment_text = $(this).closest(".main-com-div").find(".comment-text-cl").text();
        $("#edit_status").val(1);
        $("#edit_com_id").val(dataId);
        $("#flag_comment").val(comment_text);
        $(".cancel-com-btn").show();
    });
    $(document).on("click",".cancel-com-btn",function () {
        $("#flag_comment").val("");
        $("#edit_status").val(0);
        $("#edit_com_id").val(0);
        $(".cancel-com-btn").hide();
    });

});