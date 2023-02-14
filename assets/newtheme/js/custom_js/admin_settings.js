// *************** Search Hospital Box ***********
// ***********************************************
var base_url = document.getElementById('base_url').value;
base_url = base_url.toString();
var hospital_suggest = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: base_url+'index.php/settings/hospital_autosuggest?query=%QUERY',
    wildcard: '%QUERY',
    transform: function (hospital_suggest) {
        return $.map(hospital_suggest, function (items) {
            return {
                hsp_id: items.hsp_id,
                hsp_name: items.hsp_name,
                hsp_desc: items.hsp_desc
            };
        });
    }
}
});

var timer;
$('.sr_hospital_name').typeahead({
        minLength: 1,
        highlight: true
    },
    {
        name: 'sr_hospital_name',
        source: hospital_suggest,
        display: function (item) {
            return item.hsp_desc;
        },
        limit: 30,
        templates: {
            suggestion: function (item) {
                return '<div class="'+item.hsp_desc+'">' + item.hsp_desc + '</div>';
            },
            notFound: function (query) {
                return 'No Result Found...';
            },
            pending: function (query) {
                return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
            },
        }
    }).on('typeahead:selected', function (event, selection) {
    var _this = $(this);
    var form_id = _this.data('formid');
    var hsp_id = selection.hsp_id;
    $("#ajax_loading_effect").fadeIn();
    _this.attr('data-microcodeid', selection.umc_id);
    clearInterval(timer);
    timer = setTimeout(function (e) {
        jQuery.ajax({
            url: base_url+'index.php/settings/set_populate_hospital_data',
            type: 'POST',
            dataType: 'json',
            data: {'hsp_id': hsp_id},
            beforeSend: function () {
                // $("#ajax_loading_effect").fadeIn();
            },
            success: function (data) {
                if (data.type === 'error') {
                    $("#ajax_loading_effect").fadeOut();
                } else {
                    window.setTimeout(function () {
                        // console.log(data); return false;
                        $('#hospital_name').val(data['description']);
                        $('#hospital_initials').val(data['first_initial']+' '+data['last_initial']);
                        $('#group_name').val(data['name']);
                        $('#hospital_address').val(data['hosp_address']);
                        $('#hospital_country').val(data['hosp_country']);
                        $('#hospital_city').val(data['hosp_city']);
                        $('#hospital_province').val(data['hosp_state']);
                        $('#hospital_post_code').val(data['hosp_post_code']);
                        $('#hospital_email').val(data['hosp_email']);
                        $('#hospital_number').val(data['hosp_phone']);
                        $('#hospital_mobile_num').val(data['hosp_mobile']);
                        $('#hospital_fax').val(data['hosp_fax']);
                        $('#hospital_website').val(data['hosp_website']);

                        $('#role_id').val(data['id']);
                        $('#btn_edit_hosp').removeClass('hidden');

                        $('#hosp_name').val(data['description']);
                        $('#hosp_initials').val(data['first_initial']+' '+data['last_initial']);
                        $('#h_group_name').val(data['name']);
                        $('#hosp_address').val(data['hosp_address']);
                        $('#hosp_country').val(data['hosp_country']);
                        $('#hosp_city').val(data['hosp_city']);
                        $('#hosp_state').val(data['hosp_state']);
                        $('#hosp_post_code').val(data['hosp_post_code']);
                        $('#hosp_email').val(data['hosp_email']);
                        $('#hosp_phone').val(data['hosp_phone']);
                        $('#hosp_mobile').val(data['hosp_mobile']);
                        $('#hosp_fax').val(data['hosp_fax']);
                        $('#hosp_website').val(data['hosp_website']);

                        $("#ajax_loading_effect").fadeOut();
                    }, 500);
                }
            }
        });
    }, 1000);
});
// ***********************************************
// *************** Search Hospital Box ***********

// ***********************************************
// *************** Update/Add Hospital Info ******

$(document).on('click', '.save_hosp_info', function (e) {
    e.preventDefault();
    $("#ajax_loading_effect").fadeIn();
    // if ($('input[name=hospital_user]').is(':checked') === false) {
    //     jQuery.sticky('Please select the clinic first.', {classList: 'important', speed: 200, autoclose: 7000});
    //     return false;
    // }
    //
    // if ($('input[name=clinic_users]').is(':checked') === false) {
    //     jQuery.sticky('Please select the clinic user first.', {classList: 'important', speed: 200, autoclose: 7000});
    //     return false;
    // }

    var form_data = $('.hosp_info_form').serialize();

    $.ajax({
        url: base_url+'index.php/settings/save_hospital_info',
        type: 'POST',
        global: false,
        dataType: 'json',
        data: form_data,
        success: function (data) {
            if (data.type === 'success') {
                $("#ajax_loading_effect").fadeOut();
                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                document.location.reload();
            } else {
                $("#ajax_loading_effect").fadeOut();
                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
            }
        }
    });
});

$(document).ready(function () {
    $('#password_info').on('hidden.bs.modal', function () {
        $('#update_password_form').trigger("reset");

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

    $(document).on('click', '.editBtn', function (e) {
        var dataId = $(this).attr("data-id");
        $("#form_status").val('edit');
        $("#edit_id").val(dataId);

        var retRes = $.parseJSON($("#edit_" + dataId).val());
        // console.log(retRes);
        $("#module").val(retRes.module_id).trigger("change");
        $("#url").val(retRes.url);
        $("#description").val(retRes.description);
        $('#add_url_modal').modal('show');
    });

    $(document).on('click', '.editBtnModule', function (e) {
        var dataId = $(this).attr("data-id");
        $("#form_status").val('edit');
        $("#edit_id").val(dataId);

        var retRes = $.parseJSON($("#edit_" + dataId).val());
        // console.log(retRes);
        $("#name").val(retRes.name);
        $('#add_module_modal').modal('show');
    });

    $(document).on('click', '.btn-delete', function (e) {
        var dataId = $(this).attr("data-id");
        $(".continue-btn-url").attr("data-id",dataId);
    });

    $(document).on('click', '.btn-delete-module', function (e) {
        var dataId = $(this).attr("data-id");
        $(".continue-btn-module").attr("data-id",dataId);
    });

    $(document).on('click', '.continue-btn-url', function (e) {
        var dataId = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: _base_url + '/settings/urlManagement',
            data: {dataId: dataId,form_status: "delete", [csrf_name]: csrf_hash},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_url_modal').modal('hide');
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

    $(document).on('click', '.continue-btn-module', function (e) {
        var dataId = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: _base_url + '/settings/moduleManagement',
            data: {dataId: dataId,form_status: "delete", [csrf_name]: csrf_hash},
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_url_modal').modal('hide');
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

    $('body').on('hidden.bs.modal', function (e) {
        $("#form_status").val("");

        var formId = $(this).find("form").attr("id");
        formSelector = $("#" + formId);

        validator = formSelector.validate();
        validator.resetForm();
        formSelector.find(".error").removeClass("error");
        formSelector.trigger("reset");
        formSelector.find("select").val("0").trigger("change");
    });

    var urlManagementForm = $("#addURLManagementForm");
    urlManagementForm.validate({
        // ignore: ":hidden",
        rules: {
            module: {
                required: true
            },
            url: {
                required: true
            },
            description: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/settings/urlManagement',
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#add_url_modal').modal('hide');
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

    var moduleManagementForm = $("#addModuleManagementForm");
    moduleManagementForm.validate({
        // ignore: ":hidden",
        rules: {
            name: {
                required: true
            }
        },
        submitHandler: function (form) {
            $.ajax({
                type: "POST",
                url: _base_url + '/settings/moduleManagement',
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#add_url_modal').modal('hide');
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

    $('#add_template').validate({ // initialize the plugin
        rules: {
            template_name: {
                required: true
            },
            "files[]": {
                required: true
            },
            header: {
                required: true
            },
            footer: {
                required: true
            }
        }
    });
});
// ***********************************************
// *************** Update/Add Hospital Info ******