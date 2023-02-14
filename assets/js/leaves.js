$(document).ready(function () {

    var currentYear = Number(new Date().getFullYear());

    // $('.range2Picker').datepick({
    //     dateFormat: 'dd-mm-yyyy',
    //     rangeSelect: true,
    //     monthsToShow: 2,
    //     yearRange: currentYear+':'+currentYear,
    //     showTrigger: '#calImg'
    // });

    $('.range2Picker').daterangepicker({
        showDropdowns: true,
        autoUpdateInput: false,
        // startDate: moment().startOf('day'),
        // endDate: moment().startOf('day').add(5, 'days'),
        minDate: $("#min_date").val(),
        maxDate: $("#max_date").val(),
        locale: {
            format: 'DD-MM-YYYY'
        }
    });

    $('.range2Picker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
    });

    $('.range2Picker').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });

    $(".select-add-leave").select2({width: '100%'});

    $('#leaves_datatable').DataTable({
        order: [[8, 'desc']],
        stateSave: true,
        "lengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ]
    });
});
$(document).ready(function () {
    // $('#start_date,#end_date').datepick({
    //     dateFormat: 'dd-mm-yyyy',
    //     yearRange: currentYear+':'+currentYear
    //
    //
    // });

    // $('#start_date').datepick('option',{
    //     onSelect: function(dates) {
    //         dates = new Date(dates);
    //         var getDate = ((dates.getMonth() > 8) ? (dates.getMonth() + 1) : ('0' + (dates.getMonth() + 1))) + '/' + ((dates.getDate() > 9) ? dates.getDate() : ('0' + dates.getDate())) + '/' + dates.getFullYear();
    //         $('#end_date').datepick('destroy');
    //         $('#end_date').datepick({dateFormat: 'dd-mm-yyyy',minDate: getDate, showTrigger: '#calImg'});
    //         },
    //     }
    // );

    $.get(_base_url + 'auth/get_all_hospitals', function (data) {
        let select = $("#select-hospital");
        select.empty();
        let option = $(`<option value="">Select Hospital</option>`);
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

    // $.get(_base_url + 'auth/get_all_organizations', function (data) {
    //     let select = $("#select-organization");
    //     select.empty();
    //     let option = $(`<option value="">Select Organization</option>`);
    //     let labGroup = $(`<optgroup label="Laboratory"></optgroup>`);
    //     let netGroup = $(`<optgroup label="Network"></optgroup>`);
    //     let csGroup = $(`<optgroup label="Cancer Service"></optgroup>`);
    //     select.append(option);
    //     for (org of data) {
    //         if (org.group_type === 'L') {
    //             labGroup.append($(`<option value="${org.id}">${org.description}</option>`));
    //         }
    //         if (org.group_type === 'N') {
    //             netGroup.append($(`<option value="${org.id}">${org.description}</option>`));
    //         }
    //         if (org.group_type === 'CS') {
    //             csGroup.append($(`<option value="${org.id}">${org.description}</option>`));
    //         }
    //     }
    //     select.append(labGroup);
    //     select.append(netGroup);
    //     select.append(csGroup);
    //     select.select2({width: '100%'});
    //     $('.org-select-container').show();
    // }).fail(function (err) {
    //     console.log(err);
    //     console.log("Get Organization error");
    //     $("#select-organization").select2({width: '100%'});
    //     $('.org-select-container').show();
    // });

    $.get(_base_url + 'auth/get_all_roles_hospital', function (data) {
        let select = $("#group-select");
        let group_id_get = $("#user_role_get").val();
        let selected_opt = "";
        if (group_id_get == "") {
            selected_opt = "selected";
        }
        select.empty();
        let option = $(`<option value="">Select Role</option>`);
        let all_option = $(`<option value="1" ${selected_opt}>System Admin</option>`);
        let all_option1 = $(`<option value="0" ${selected_opt}>Hospital Admin</option>`);

        select.append(option);
        select.append(all_option);
        select.append(all_option1);
        for (role of data) {
            if (role.id != 1) {
                let selected = (group_id_get == role.id ? 'selected' : '');
                select.append($(`<option value="${role.id}" ${selected}>${role.description}</option>`))
            }
        }
        select.select2({width: '100%'});
        $('.role-select-container').show();
    }).fail(function (err) {
        console.log(err);
        console.log("Get Role error");
        $("#group-select").select2({width: '100%'});
        $('.role-select-container').show();
    });

    // var blocks_wrapper   		    = $(".blocks_wrapper"); //Fields wrapper
    // var blocks_wrapper_add_btn      = $(".add_blocks_btn"); //Add button ID
    //
    // $(blocks_wrapper_add_btn).click(function(e){ //on add input button click
    //     e.preventDefault();
    //
    //     var block_lab_no = $('#block_lab_no').val();
    //     var block_inner_tab = $('#block_inner_tab').val();
    //
    //     $(blocks_wrapper).append('' +
    //         '<div class="add_block_div padding-bottom col-md-12"><div class="row"><div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_lab_no[]" value="'+block_lab_no+'" readonly>  <label class="focus-label">Lab No.</label> </div> </div>' +
    //         '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_specimen_no[]" value="Sp-'+block_inner_tab+'" readonly>  <label class="focus-label" >Specimen No.</label> </div> </div>' +
    //         '<div class="col-md-2"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_no_of_blocks[]" value="'+block_inner_tab+'" readonly>  <label class="focus-label" >Block No.</label> </div> </div>' +
    //         '<div class="col-md-5"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_comments[]">  <label class="focus-label">Block Description</label> </div> </div>' +
    //         '<div class="col-md-1"> <a href="javascript:void(0)" class="blocks_remove_row btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </div>' +
    //         '</div> </div>'); //add inputs box
    //     x++; //text box increment
    //     // }
    // });
    // $(blocks_wrapper).on("click",".blocks_remove_row", function(e){ //user click on remove text
    //     e.preventDefault(); $(this).closest("div.add_block_div").remove(); x--;
    // });

    var leaveTypeForm = $("#addLeaveTypeForm");
    var leaveTypeValidator = leaveTypeForm.validate({
        // ignore: ":hidden",
        rules: {
            leave_hospital: {
                required: true
            },
            leave_code: {
                required: true
            },
            start_end_date: {
                required: true
            },
            // end_date: {
            //     required: true
            // },
            leave_remarks: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/leaveManagement/applyLeave',
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // console.log(response);return;
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#leave_modal').modal('hide');
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

    var editLeaveTypeForm = $("#editLeaveTypeForm");
    var editLeaveTypeValidator = editLeaveTypeForm.validate({
        // ignore: ":hidden",
        rules: {
            leave_hospital: {
                required: true
            },
            leave_code: {
                required: true
            },
            start_end_date: {
                required: true
            },
            // end_date: {
            //     required: true
            // },
            leave_remarks: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/leaveManagement/editAppliedLeave',
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // console.log(response);return;
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#leave_modal').modal('hide');
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

    var leaveGroupForm = $("#addLeaveGroupForm");
    var leaveGroupValidator = leaveGroupForm.validate({
        // ignore: ":hidden",
        rules: {
            leave_group: {
                required: true
            },
            user_group_id: {
                required: true
            },
            remarks: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/leaveManagement/leaveGroups',
                data: $(form).serialize(),
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
            return false; // required to block normal submit since you used ajax
        }
    });


    var workingWeekForm = $("#addWorkingWeekForm");
    var workingWeekValidator = workingWeekForm.validate({
        // ignore: ":hidden",
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/leaveManagement/workingWeek',
                data: $(form).serialize(),
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
            return false; // required to block normal submit since you used ajax
        }
    });

    var assignGroupForm = $("#assignGroupForm");
    var assignGroupFormValidator = assignGroupForm.validate({
        // ignore: ":hidden",
        rules: {
            group_id: {
                required: true
            },
            leave_group_id: {
                required: true
            }
            // working_week_id: {
            //     required: true
            // }
        },
        submitHandler: function (form) {

            // console.log(form);return false;

            $.ajax({
                type: "POST",
                url: _base_url + '/leaveManagement/assignGroup',
                data: $(form).serialize(),
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
            return false; // required to block normal submit since you used ajax
        }
    });
    // validator.resetForm();
    // blockForm.find(".error").removeClass("error");


    $(document).on('click', '.editBtn', function (e) {
        var dataId = $(this).attr("data-id");
        $("#form_status").val('edit');
        $("#edit_id").val(dataId);

        var retRes = $.parseJSON($("#edit_" + dataId).val());
        // console.log(retRes);
        $("#leave_name").val(retRes.name);
        $("#leave_code").val(retRes.code).trigger("change");
        $("#total_leaves").val(retRes.no_of_leaves);
        $("#min_leaves").val(retRes.min_leave);
        $("#leave_stretch").val(retRes.leave_stretch);
        // $("#leave_gender").val(retRes.leave_for).trigger("change");
        $("#leave_remarks").val(retRes.remarks);
        $('#add_leave_modal').modal('show');
    });
    $(document).on('click', '.deleteBtn', function (e) {
        var dataId = $(this).attr("data-id");
        var get_csrf_token_name = $("#get_csrf_token_name").val();
        var get_csrf_hash = $("#get_csrf_hash").val();
        $.ajax({
            type: "POST",
            url: _base_url + '/leaveManagement/deleteLeaveType',
            data: {
                'dataId': dataId,
                [get_csrf_token_name]: get_csrf_hash,
            },
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
        return false; // required to block normal submit since you used ajax
    });
    $(document).on('click', '.deleteApplyLeave', function (e) {
        var dataId = $(this).attr("data-id");
        $(".btn-delete-leave").attr("data-id", dataId);
    });
    $(document).on('click', '.delete-group', function (e) {
        var dataId = $("#leave_group").val();
        $.ajax({
            type: "POST",
            url: _base_url + '/leaveManagement/deleteLeaveGroup',
            data: {dataId: dataId, [csrf_name]: csrf_hash},
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
        return false; // required to block normal submit since you used ajax
    });
    $(document).on('click', '.editBtnLeaveGroup', function (e) {
        var dataId = $(this).attr("data-id");
        $("#form_status").val('edit');
        $("#edit_id").val(dataId);

        var retRes = $.parseJSON($("#edit_" + dataId).val());
        // console.log(retRes);
        $("#leave_group").val(retRes.name);
        $("#remarks").val(retRes.remarks);
        var leaveTypes = retRes.leave_type_ids.split(',');
        $("#leave_types").val(leaveTypes).trigger("change");
        $('#add_leave_modal').modal('show');
    });
    $(document).on('click', '.editWorkingWeekBtn', function (e) {
        var dataId = $(this).attr("data-id");
        $("#form_status").val('edit');
        $("#edit_id").val(dataId);

        var retRes = $.parseJSON($("#edit_" + dataId).val());
        $(".onoffswitch-checkbox").prop("checked", false);
        // console.log(retRes);
        $("#name").val(retRes.name);
        var mon = Number(retRes.mon);
        var tue = Number(retRes.tue);
        var wed = Number(retRes.wed);
        var thu = Number(retRes.thu);
        var fri = Number(retRes.fri);
        var sat = Number(retRes.sat);
        var sun = Number(retRes.sun);
        if (mon == 1)
            $("#monday").prop("checked", true);
        if (tue == 1)
            $("#tuesday").prop("checked", true);
        if (wed == 1)
            $("#wednesday").prop("checked", true);
        if (thu == 1)
            $("#thursday").prop("checked", true);
        if (fri == 1)
            $("#friday").prop("checked", true);
        if (sat == 1)
            $("#saturday").prop("checked", true);
        if (sun == 1)
            $("#sunday").prop("checked", true);

        $('#add_leave_modal').modal('show');
    });
    $(document).on('click', '.editAssignGroupFormBtn', function (e) {
        var dataId = $(this).attr("data-id");
        $("#form_status").val('edit');
        $("#edit_id").val(dataId);

        var retRes = $.parseJSON($("#edit_" + dataId).val());
        // console.log(retRes);
        $("#group_id").val(retRes.group_id).trigger("change");
        $("#leave_group_id").val("").trigger("change");
        $("#leave_group_id").select2("val", retRes.leave_group_id);

        $('#add_leave_modal').modal('show');
    });

    $(document).on('change', '.select-hospital,#group-select', function () {
        $('.leave_div').show();
        // var checkAdmin = Number($("#is_check_admin").val());

        var hospitalId = $(".select-hospital").val();
        var groupId = $("#group-select option:selected").val();
        $.ajax({
            type: "POST",
            // url: _base_url + '/leaveManagement/getGroupData',
            // data: $("#leaveGroupForm").serialize(),

            url: _base_url + '/leaveManagement/getGroupData',
            data: {
                [csrf_name]: csrf_hash,
                hospital_id: hospitalId,
                role_id: groupId
            },

            dataType: "json",
            success: function (response) {
                var leave_array = response.leave_group_types;
                // console.log(response.leave_group_types);

                for (var leave_type_id = 1; leave_type_id <= 6; leave_type_id++) {
                    $("." + leave_type_id + "_leave").find("[name='days']").val("");
                    $("." + leave_type_id + "_leave").find("[name='max']").val("");
                    $("." + leave_type_id + "_leave").find("#carry_no").prop("checked", false);
                    $("." + leave_type_id + "_leave").find("#carry_yes").prop("checked", false);
                    $("." + leave_type_id + "_leave").find("#earned_no").prop("checked", false);
                    $("." + leave_type_id + "_leave").find("#earned_yes").prop("checked", false);
                    $("." + leave_type_id + "_leave").find("[name='onoffswitch']").prop("checked", true).trigger("change");
                    $(".leave-cancel-btn").trigger("click");
                }

                $.each(leave_array, function (key, value) {
                    var leave_type_id = value.leave_type_id;
                    $("." + leave_type_id + "_leave").find("[name='days']").val(value.days);
                    $("." + leave_type_id + "_leave").find("[name='max']").val(value.max);
                    if (value.carry_forward == 0) {
                        $("." + leave_type_id + "_leave").find("#carry_no").prop("checked", true);
                    } else if (value.carry_forward == 1) {
                        $("." + leave_type_id + "_leave").find("#carry_yes").prop("checked", true);
                    }

                    if (value.earned_leave == 0) {
                        $("." + leave_type_id + "_leave").find("#earned_no").prop("checked", true);
                    } else if (value.earned_leave == 1) {
                        $("." + leave_type_id + "_leave").find("#earned_yes").prop("checked", true);
                    }

                    if (value.status == 0) {
                        $("." + leave_type_id + "_leave").find("[name='onoffswitch']").prop("checked", false).trigger("change");
                    } else if (value.earned_leave == 1) {
                        $("." + leave_type_id + "_leave").find("[name='onoffswitch']").prop("checked", true).trigger("change");
                    }
                    // $("."+leave_type_id+"_leave").find("[name='max']").val(value.max);
                });
            }
        });
        return false; // required to block normal submit since you used ajax
    });

    $(document).on('click', '.leave-save-btn', function () {
        var thisEvent = $(this);
        var formId = $(this).closest("form").attr("id");
        // var groupId = $("#leave_group option:selected").val();
        var hospitalId = $(".select-hospital").val();
        var groupId = $("#group-select option:selected").val();
        $.ajax({
            type: "POST",
            url: _base_url + '/leaveManagement/leaveSettings',
            data: $("#" + formId).serialize() + '&hospital_id=' + hospitalId + '&role_id=' + groupId,
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
                    $("#" + formId).find(".leave-cancel-btn").trigger("click");
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
    });

    $(document).on('click', '.onoffswitch-checkbox', function () {
        var formId = $(this).closest("form").attr("id");
        var hospitalId = $(".select-hospital").val();
        var groupId = $("#group-select option:selected").val();
        var status = 0;

        if ($(this).is(":checked")) {
            status = 1;
        }

        $.ajax({
            type: "POST",
            url: _base_url + '/leaveManagement/leaveStatus',
            data: $("#" + formId).serialize() + '&hospital_id=' + hospitalId + '&role_id=' + groupId + '&leave_status=' + status,
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    // $('#add_leave_modal').modal('hide');
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
                return;
            }
        });
        return; // required to block normal submit since you used ajax
    });

    $(document).on('click', '#edit_group,#add_group', function (e) {
        if (e.target.id == "add_group") {
            $("#edit_mod").val("add");
        } else {
            var groupId = $("#leave_group").val();
            if (groupId != null && groupId != "" && groupId != 0) {
                $("#add_temp").modal("show");
                $("#edit_mod").val("edit");
                var groupName = $("#leave_group option:selected").text();
                var groupRemarks = $("#leave_group option:selected").attr("data-remarks");
                var userGroupId = $("#leave_group option:selected").attr("data-group");
                $(".leave_group_name").val(groupName);
                $(".leave_group_id").val(groupId);
                $("#user_group_id").val(userGroupId).trigger("change");
                $("#remarks").val(groupRemarks);
            } else {
                $("#add_temp").modal("hide");
            }
        }
    });

    $(document).on('click', '.hos_open', function (e) {
        $(".all_leave_show").hide();
        var hospId = $(this).attr("data-id");
        $(document).find("#hospital_" + hospId).show();
    });

    $(document).on('change', '.leave_hospital', function (e) {
        var thisId = $(this).attr("id");
        if(thisId=="edit_leave_hospital"){
            $("#edit_leave_code").html("");
        } else {
            $("#leave_code").html("");
        }

        var hospitalId = $(this).val();
        $.ajax({
            type: "POST",
            // url: _base_url + '/leaveManagement/getGroupData',
            // data: $("#leaveGroupForm").serialize(),

            url: _base_url + '/leaveManagement/userHospitalLeaves',
            data: {
                [csrf_name]: csrf_hash,
                hospital_id: hospitalId
            },

            dataType: "json",
            success: function (response) {
                console.log(response.leaves);
                var leave_array = response.leaves;
                var html = '<option>Select Leave</option>';
                $.each(leave_array, function (key, value) {
                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                });

                if(thisId=="edit_leave_hospital"){
                    $("#edit_leave_code").html(html);
                } else {
                    $("#leave_code").html(html);

                }
            }
        });
        return false; // required to block normal submit since you used ajax
    });

    $(document).on('change', '#leave_code_filter,#leave_hospital_filter', function (e) {
        var leave_hospital = $("#leave_hospital_filter").val();
        var leave_type = $(this).val();
        // if(leave_hospital!="" && leave_type!=""){
        $("#leaveTypeFilterForm").submit();
        // }

    });

    $(document).on('click', '.leave_type_filter', function (e) {
        var leave_type = $(this).attr("data-id");
        $("#leave_code_filter").val(leave_type);
        // var leave_hospital = $("#leave_hospital_filter").val();

        // if(leave_hospital!="" && leave_type!=""){
        $("#leaveTypeFilterForm").submit();
        // }

    });

    $(document).on('click', '.btn-approve,.btn-reject', function (e) {
        var thisSel = $(this);
        var leaveData = $(this).attr("data-leave");
        var leaveId = $(this).attr("data-id");
        var leaveStatus = $(this).attr("data-status");
        $.ajax({
            type: "POST",
            // url: _base_url + '/leaveManagement/getGroupData',
            // data: $("#leaveGroupForm").serialize(),

            url: _base_url + '/leaveManagement/leaveAction',
            data: {
                [csrf_name]: csrf_hash,
                leaveData: leaveData,
                dataId: leaveId,
                dataStatus: leaveStatus,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    $("#approve_leave,#delete_approve").modal("hide");
                    $.sticky(response.message, {
                        classList: 'success',
                        speed: 200,
                        autoclose: 7000
                    });
                    // $("#leave_tr_"+leaveId).find(".status-badge").removeClass("badge-warning");
                    // if(leaveStatus=="reject"){
                    //     $("#leave_tr_"+leaveId).find(".status-badge").addClass("badge-danger");
                    //     $("#leave_tr_"+leaveId).find(".status-badge").text("Rejected");
                    // } else {
                    //     $("#leave_tr_"+leaveId).find(".status-badge").addClass("badge-success");
                    //     $("#leave_tr_"+leaveId).find(".status-badge").text("Approved");
                    // }


                    $("#leave_tr_" + leaveId).find(".status-badge").removeClass("text-warning");
                    if (leaveStatus == "reject") {
                        $("#leave_tr_" + leaveId).find(".status-badge").addClass("text-danger");
                        $("#leave_tr_" + leaveId).find(".status-text").text("Rejected");
                    } else {
                        $("#leave_tr_" + leaveId).find(".status-badge").addClass("text-success");
                        $("#leave_tr_" + leaveId).find(".status-text").text("Approved");
                    }

                    $("#leave_tr_" + leaveId).find(".action-btns").hide();

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
    });

    $(document).on('click', '.btn-delete-leave', function (e) {
        var dataId = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: _base_url + '/leaveManagement/deleteApplyLeave',
            data: {
                [csrf_name]: csrf_hash,
                dataId: dataId
            },
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_leave_modal').modal('hide');
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
    });

    $(document).on('click', '.pending-status', function (e) {
        var thisSel = $(this);
        var leaveData = $(this).attr("data-leave");
        var leaveId = $(this).attr("data-id");
        var leaveStatus = $(this).attr("data-status");
        $('.btn-approve,.btn-reject').attr("data-leave", leaveData);
        $('.btn-approve,.btn-reject').attr("data-id", leaveId);
        $('.btn-approve,.btn-reject').attr("data-status", leaveStatus);
    });

    $(document).on('click', '.edit_leave', function (e) {

        var dataId = $(this).attr("data-id");
        var dataHospital = $(this).attr("data-hospital");
        var dataLeave = $(this).attr("data-leave");
        var dataDates = $(this).attr("data-dates");
        var dataNotes = $(this).attr("data-notes");
        var dataDates1 = dataDates.split(" - ");


        $("#edit_leave_id").val(dataId);
        $("#edit_leave_hospital").val(dataHospital).trigger("change");

        $('#edit_start_end_date').data('daterangepicker').setStartDate(dataDates1[0]);
        $('#edit_start_end_date').data('daterangepicker').setEndDate(dataDates1[1]);
        $("#edit_start_end_date").val(dataDates).trigger("change");
        $("#edit_leave_remarks").val(dataNotes);
        window.setTimeout(function() {
            $("#edit_leave_code").val(dataLeave).trigger("change");
        }, 500);
    });


    $('#add_temp').on('hidden.bs.modal', function (e) {
        $("#form_status").val("");

        var formId = $(this).find("form").attr("id");
        formSelector = $("#" + formId);

        validator = formSelector.validate();
        validator.resetForm();
        formSelector.find(".error").removeClass("error");
        formSelector.trigger("reset");

        $(".onoffswitch-checkbox").prop("checked", true);

        $("select.select").val('').trigger('change');
    });

});