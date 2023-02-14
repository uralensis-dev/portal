var base_url = document.getElementById('base_url').value;
base_url = base_url.toString();
function clearSearch() {
    $('#courier_listing_table tr').show();
}

function searchTable(word) {
    clearSearch();
    if(word!="all"){
        $('#courier_listing_table tr > td:first-child').each(function () {
            if ($(this).html() != word) {
                $(this).parent().hide();
            }
        });
    }
}

function formatUsersList(user) {
    if (!user.id) {
        return user.text;
    }
    var picture_path = user.element.title;
    var base_url = "https://pci.pathhub.uk/";
    var full_picture_path = base_url + "/" + picture_path;


    var $user_option = $(
        '<span ><img style="display: inline-block;" width="30" height="30" src="' + full_picture_path + '" /> ' + user.text + '</span>'
    );
    return $user_option;
}

function delete_courierCompany(cId){ 
    $('#delete_company_modal').modal('show');
    if(cId && cId != ''){
        $('.companty-delete-btn').attr('data-id', cId);   
    }        
}

function update_courierCompany(row){ 
    $('#cid').val($(row).attr('data-id'));
    $('#edit_courier_company_name').val($(row).attr('data-name'));
    // $('#cimage').attr("src", $(row).attr('data-logo')).show();

    var cPrefix = $(row).attr('data-prefix');
    $('#cedit_ourier_company_prefix').prop('checked', false);
    if(cPrefix === '1'){
        $('#edit_courier_company_prefix').prop('checked', true);
    }
    $('#edit_company_setup_modal').modal('show');    
}


$(document).ready(function () {
    $('.range2Picker').daterangepicker({
        showDropdowns: true,
        autoUpdateInput: false,
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

});
$(document).ready(function () {
    activaTab($("#tab_id").val());
    function activaTab(tab){
        $('#courier_nav_tabs a[href="#' + tab + '"]').tab('show');
    };


    var checkError = Number($("#is_error").val());
    if(checkError==1){
        $.sticky($("#error_message").val(), {
            classList: 'important',
            speed: 200,
            autoclose: 7000
        });
    }



    $(".select2").select2();
    $(document).find(".duplicate_row .select3").select2();

    $("#sender_organization,#receiver_organization").on("change", function () {
        var getAddress = $(this).find("option:selected").attr("data-address");
        var dataId = $(this).attr("id");
        var p_line = "sender_";
        if (dataId == "receiver_organization") {
            var p_line = "receiver_";
        }
        $("#"+p_line+"address").val(getAddress).trigger("select");
    });

    $("#sender_search,#receiver_search").on("change", function () {

        var getAddress = $(this).find("option:selected").attr("data-address");
        var getPhone = $(this).find("option:selected").attr("data-phone");
        var dataId = $(this).val();

        if(dataId=="add-user"){
            $("#add_courier_modal").modal("hide");
            window.setTimeout(function () {
                // openCategoryModal()
                $("#add_user_modal").modal("show");
            }, 2000);

            return true;
        } else {
            if(dataId!=""){

                var thisId = $(this).attr('id');
                var p_line = "sender_";
                var p_line_change = "receiver_";
                if (thisId == "receiver_search") {
                    var p_line = "receiver_";
                    var p_line_change = "sender_";
                }
                // $("#"+p_line_change+"search option[value='"+ dataId + "']").attr('disabled', "disabled");
                // $("#"+p_line_change+"search").find("option").removeAttr('disabled');
                // $("#"+p_line_change+"search option[value='"+ dataId + "']").attr('disabled', "disabled");
                // $("#"+p_line_change+"search option").each(function() {
                //     var $thisOption = $(this);
                //     // var valueToCompare = "saab";
                //
                //     if($thisOption.val() == dataId) {
                //         console.log("i am in"+$thisOption.val());
                //         // $thisOption.attr("disabled", "disabled");
                //         $thisOption.prop("disabled", "disabled").trigger("change");
                //     } else {
                //         console.log("i am out"+$thisOption.val());
                //         $thisOption.removeAttr("disabled").trigger("change");
                //         // $thisOption.prop("disabled", "");
                //         // $thisOption.prop("disabled", false);
                //     }
                // });

                $("#"+p_line_change+"search option[value='"+ dataId + "']").attr('disabled', "disabled");
                $("#"+p_line_change+"search").find("option").removeAttr('disabled');
                $("#"+p_line_change+"search option[value='"+ dataId + "']").attr('disabled', "disabled");

                $("#"+p_line_change+"search").select2({
                    width: '100%',
                    templateResult: formatUsersList,
                    templateSelection: formatUsersList
                });

                $.ajax({
                    type: "POST",
                    url: _base_url + '/AddCourier/search_emp_data',
                    data: {dataId: dataId, [csrf_name]: csrf_hash},
                    dataType: "json",
                    success: function (response) {

                        $("#" + p_line + "organization").html(response);

                        window.setTimeout(function () {
                            $("#" + p_line + "organization").trigger("change");
                        }, 2000);
                    }
                });
            }
        }



        $("#"+p_line+"phone").val(getPhone);
        // $("#"+p_line+"address").val(getAddress+"shariqqq").trigger("select");

        return;



    });

    $(".show_courier_btn").on("click", function () {

        var status_value = $('input[name="show_courier_status"]:checked').val();
        $.ajax({
            type: "POST",
            url: _base_url + '/AddCourier/update_courier_showing',
            data: {status_value: status_value, [csrf_name]: csrf_hash},
            dataType: "json",
            success: function (response) {

                $("#" + p_line + "organization").html(response);

                window.setTimeout(function () {
                    $("#" + p_line + "organization").trigger("change");
                }, 2000);
            }
        });

        return;



    });

    $(".btn_add_courier").on("click",function () {
        var dataId = $("#active_directory_user option:selected").val();
        if(dataId!==0 && dataId!=""){
            $.ajax({
                type: "POST",
                url: _base_url + '/institute/add_courier_user',
                data: {dataId: dataId,status: "courier", [csrf_name]: csrf_hash},
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#courier_user_modal').modal('hide');
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
        }
    });

    $(".add_user_btn").on("click",function () {
        $('#add_courier_modal').modal('hide');

        window.setTimeout(function () {
            // openCategoryModal()
            $("#add_user_modal").modal("show");
        }, 1000);
    });

    $(document).on("change", ".item_type", function () {
        var rowId = $(this).closest('tr').attr('id');
        var itemType = $(this).val();
        if (itemType == "specimen") {
            $("#" + rowId + " .specimen_div").show();
            $("#" + rowId + " .other_div").hide();
        } else {
            $("#" + rowId + " .other_div").show();
            $("#" + rowId + " .specimen_div").hide();
        }
    });

    $(document).on("change", ".item_department", function () {
        var itemType = $(this).val();
        var rowId = $(this).closest('tr').attr('id');
        let specialties = departments[itemType]['specialties'];
        let options = ``;
        for (const [key, value] of Object.entries(specialties)) {
            options += `<option value="${key}">${value['name']}</option>`
        }
        $("#" + rowId).find(".item_st").html(options);
    });


    $(document).on('click', '.save-courier', function(){
        if ($('input[name=batch_no]').val() === '') {
            jQuery.sticky('Batch No. Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('input[name=courier_no]').val() === '') {
            jQuery.sticky('Courier No. Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('#sender_organization option:selected').val() == '' || $('#receiver_organization option:selected').val() == '') {
            jQuery.sticky('Organization Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('#sender_search option:selected').val() === '') {
            jQuery.sticky('Sender Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('#receiver_search option:selected').val() === '') {
            jQuery.sticky('Receiver Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('input[name=urgency]').val() === '') {
            jQuery.sticky('Urgency Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
    });

    $( "#add_courier_form2" ).submit(function( event ) {
        event.preventDefault();
        // if ($('select[name=origin_country]').val() === '') {
        //     jQuery.sticky('Origin Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('select[name=destination_country]').val() === '') {
        //     jQuery.sticky('Destination Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        if ($('input[name=batch_no]').val() === '') {
            jQuery.sticky('Batch No. Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('input[name=courier_no]').val() === '') {
            jQuery.sticky('Courier No. Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        // if ($('input[name=reference_no]').val() === '') {
        //     jQuery.sticky('Reference No. Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=parcel_weight]').val() === '') {
        //     jQuery.sticky('Parcel Weight Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=collection_date]').val() === '') {
        //     jQuery.sticky('Collection Date Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=collection_time]').val() === '') {
        //     jQuery.sticky('Collection Time Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=sender_address]').val() === '') {
        //     jQuery.sticky('Sender Address Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=sender_post_code]').val() === '') {
        //     jQuery.sticky('Sender Post Code Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=sender_phone]').val() === '') {
        //     jQuery.sticky('Sender Phone Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        if ($('#organization_id option:selected').val() === '') {
            jQuery.sticky('Organization Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('#sender_search option:selected').val() === '') {
            jQuery.sticky('Sender Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        // if ($('input[name=receiver_address]').val() === '') {
        //     jQuery.sticky('Receiver Address Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=receiver_post_code]').val() === '') {
        //     jQuery.sticky('Receiver Post Code Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        // if ($('input[name=receiver_phone]').val() === '') {
        //     jQuery.sticky('Receiver Phone Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
        //     return false;
        // }
        if ($('#receiver_search option:selected').val() === '') {
            jQuery.sticky('Receiver Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }
        if ($('input[name=urgency]').val() === '') {
            jQuery.sticky('Urgency Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
            return false;
        }

        /*return false;
        $.ajax({
            type: "POST",
            url: base_url + "AddCourier/add",
            data: $( "#add_courier_form").serialize(),
            dataType: "json",
            success: function (response) {
                if (response.type === 'success') {
                    jQuery('#publish_button').html(response.message);
                    /!*window.setTimeout(function () {
                        window.location.href = base_url + "AddCourier/";
                    }, 2000);*!/
                } else {
                    jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });*/
    });

    $(".btn-item-add").on("click", function () {
        $clondRow = $(".duplicate_row").clone();
        $(document).find(".duplicate_row .select3").select2();
        $clondRow.removeClass('duplicate_row');
        $clondRow.find(".item_st").html('');
        $(".itembody").append($clondRow);

        var count = 1;
        $(document).find('.item-counter').each(function (index, value) {
            $(this).closest('tr').attr('id', "row_" + count);
            $(this).text(count++);
        })
    });

    $(".choose_courier_comp a").click(function(){
        $(".choose_courier_comp a").removeClass("active");
        $(this).addClass("active");
    });
    $(".choose_urgency a").click(function(){
        $(".choose_urgency a").removeClass("active");
        $(this).addClass("active");
    });
    $(".choose_unit a").click(function(){
        $(".choose_unit a").removeClass("active");
        $(this).addClass("active");
    })

    $('#add_courier_modal').on('shown.bs.modal', function (e) {
        $("#receiver_search").find("option").removeAttr('disabled');
        var sender_id = $('#esender_id').val();
        var receiver_id = $('#ereceiver_id').val();
        if(sender_id != ''){
            $("#receiver_search option[value='"+ sender_id + "']").attr('disabled', "disabled");
        }
        $('#sender_search').trigger('change');
      })

      $('#add_courier_modal').on('hidden.bs.modal', function (e) {
            $('.extrachecklist').addClass('hide');
            $("#edit_id").val('');
            $("#files_names").hide();
            $('.upload-file-box').show();
      })

    $(document).on("click", ".edt-tckt", function (elem) {
        var dataId = $(this).attr("data-id");
        var dataText = $("#text_are"+dataId).text();
        var dataText = JSON.parse(dataText);
        var files_name = $(this).attr("data-request-filenames");
        $('.upload-file-box').hide();

        $("#edit_id").val(dataId);
        $('.extrachecklist').removeClass('hide')
        $("#stamp_date").val($("#stamp_date").attr("data-val"));
        $("#save_type").val("edit").trigger("change");
        if(files_name != ''){
            $("#files_names").html(" - " + files_name.split(",").join(", ")).show();
        }

        var dataprofile = $("#user_edit_id"+dataId).attr("data-profile");
        var dataname = $("#user_edit_id"+dataId).attr("data-name");

        $("#user_image_name").text(dataname);
        $("#user_image_path").attr("src",dataprofile).trigger("select");
        $("#user_image_id").val($("#user_edit_id"+dataId).val()).trigger("select");
        $("#courier_no").val(dataText.initials+"-"+dataText.courier_no).trigger("select");
        $("#requested_date").val(dataText.created_at).trigger("select");
        $("#consignment_no").val(dataText.consignment_no).trigger("select");
        $("#collection_date").val(dataText.collection_date).trigger("select");
        $("#parcel_weight").val(dataText.parcel_weight).trigger("select");
        $("#courier_notes").val(dataText.notes).trigger("select");
        $('#checklist_title').val(dataText.checklist_title);

        //$(".btn_courier_company").removeClass('active')
        $("#courier_company").val(dataText.courier_company_id);
        $("#urgency_type").val(dataText.urgency);
        $("#weight_unit").val(dataText.unit);


        $(".btn_courier_company").removeClass('active').parent('div').find(".btn_courier_company[data-value='"+dataText.courier_company+"']").addClass('active');
        $(".btn_ugency_type").removeClass('active').parent('div').find(".btn_ugency_type[data-value='"+dataText.urgency+"']").addClass('active');
        $(".btn_ugency_type").closest('div').find('.active').trigger('click');

        //$(".btn_courier_company[data-value='"+dataText.courier_company+"']").addClass('active');
        //$(".btn_ugency_type[data-value='"+dataText.urgency+"']").addClass('active');
        $(".btn_weight_unit[data-value='"+dataText.unit+"']").addClass('active');



        $("#sender_search").val(dataText.sender_id).trigger("change");
        $("#receiver_search").val(dataText.receiver_id).trigger("change");
        $('#esender_id').val(dataText.sender_id);
        $('#ereceiver_id').val(dataText.receiver_id);



        window.setTimeout(function () {
            $("#parcel_weight").val(dataText.parcel_weight).trigger("change");
            $("#sender_organization").val(dataText.sender_organization).trigger("change");
            $("#receiver_organization").val(dataText.receiver_organization).trigger("change");

            $("#sender_address").val(dataText.sender_address1).trigger("select");
            $("#receiver_address").val(dataText.receiver_address1).trigger("select");
        }, 2000);

        console.log(dataText);
        return;

        $.ajax({
            url: _base_url + "AddCourier/getCourierData",
            type: "POST",
            global: false,
            data: {
                dataId: dataId,
                [csrf_name]: csrf_hash,
            },
            success: function (data) {

                $("#edt_modal_bdy").html(data.html);
                $("#edt_modal_bdy .select").select2({
                    minimumResultsForSearch: -1,
                    width: "100%",
                });
            },
        });
    });

    $(document).on("click", ".del-tckt", function (elem) {
        var info = $(this).data("info");
        $(document)
            .find(".tckt-del-btn")
            .attr("href", _base_url + "addCourier/delete/" + info);
    });

    $(document).on("click", ".courier_issue", function (elem) {
        var info = $(this).data("id");
        $("#courier_id").val(info);
    });

    $(document).on("click", ".courier_submit", function (elem) {
        var commentValue = $("#courier_comment").val();
        if(commentValue!=""){
            $.ajax({
                type: "POST",
                url: _base_url + '/AddCourier/save_comments',
                data: $("#add_courier_comment_form").serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        location.reload();
                    } else {
                        jQuery.sticky('There might be some issue. Please try again.', {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        } else {
                jQuery.sticky('Comments. Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
        }

    });

    $("#add_courier_company_form").validate({
        // ignore: ":hidden",
        rules: {
            courier_company_name: {
                required: true
            },
            courier_company_logo: {
                required: true
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    $("#edit_courier_company_form").validate({
        // ignore: ":hidden",
        rules: {
            courier_company_name: {
                required: true
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    $("#add_courier_urgency_form").validate({
        // ignore: ":hidden",
        rules: {
            courier_urgency: {
                required: true
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    $(document).on("click", ".companty-delete-btn", function (elem) {
        var cid = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: _base_url + '/AddCourier/delete_courier_company',
            data: {company_id: cid, [csrf_name]: csrf_hash},
            dataType: "json",
            success: function (response) {
                if(response.status == 'success'){
                    $('#row_'+cid).remove();
                    $('#delete_company_modal').modal('hide');
                }
            }
        });
    });
});




$('#courier_listing_table').DataTable({
    ordering: false,
    stateSave: true,
    "processing": true,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
});

function initSelect2() {
    $(document).find(".select2").select2();
    // $(".itembody").find(".select2").select2('destroy');
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }

    return true;
}


function storeValue(value,selector){
    $("#"+selector).val(value);
}

function getCourierFilter(status){
    // document.getElementById('filter_courier_table').submit();
    $("#sender_search_filter").val(status);
    $('#filter_courier_table').submit();
}


$('.datetimepicker').datetimepicker({
    format: 'Y-m-d H:m'
});
// $('.timepicker').datetimepicker({
//     datepicker: false,
//     format: 'H:i a',
//     step: 15
// });
$('.datepicker_new').datetimepicker({
    timepicker: true,
    format: 'd-m-Y H:i a',
    todayButton:true,
    // minDate: '<?php echo date('d-m-Y'); ?>',
});

//############## Slides Checkbox Multiple Fields ##############################
var slides_wrapper = $(".slides_wrapper"); //Fields wrapper
var slides_wrapper_add_btn = $(".add_slides_btn"); //Add button ID

$(slides_wrapper_add_btn).click(function (e) { //on add input button click
    e.preventDefault();
    $(slides_wrapper).append('' +
        '<div class="add_slide_div col-md-12"><div class="row"><div class="col-md-3"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="slide_lab_no[]">  <label class="focus-label">Lab No.</label> </div> </div>' +
        '<div class="col-md-3"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="slide_no_of_slides[]">  <label class="focus-label">No. of Slides</label> </div> </div>' +
        '<div class="col-md-5"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="slide_comments[]">  <label class="focus-label">Comments</label> </div> </div>' +
        '<div class="col-md-1"> <a href="javascript:void(0)" class="slides_remove_row btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </div>' +
        '</div></div>'); //add inputs box
    x++; //text box increment
    // }
});
$(slides_wrapper).on("click", ".slides_remove_row", function (e) { //user click on remove text
    e.preventDefault();
    $(this).closest("div.add_slide_div").remove();
    x--;
});
//############## Slides Checkbox Multiple Fields ##############################

//############## Blocks Checkbox Multiple Fields ##############################
var blocks_wrapper = $(".blocks_wrapper"); //Fields wrapper
var blocks_wrapper_add_btn = $(".add_blocks_btn"); //Add button ID

$(blocks_wrapper_add_btn).click(function (e) { //on add input button click
    e.preventDefault();
    $(blocks_wrapper).append('' +
        '<div class="add_block_div col-md-12"><div class="row"><div class="col-md-3"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_lab_no[]">  <label class="focus-label">Lab No.</label> </div> </div>' +
        '<div class="col-md-3"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_no_of_blocks[]">  <label class="focus-label">No. of Blocks</label> </div> </div>' +
        '<div class="col-md-5"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="block_comments[]">  <label class="focus-label">Comments</label> </div> </div>' +
        '<div class="col-md-1"> <a href="javascript:void(0)" class="blocks_remove_row btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </div>' +
        '</div> </div>'); //add inputs box
    x++; //text box increment
    // }
});
$(blocks_wrapper).on("click", ".blocks_remove_row", function (e) { //user click on remove text
    e.preventDefault();
    $(this).closest("div.add_block_div").remove();
    x--;
});
//############## Blocks Checkbox Multiple Fields ##############################

//############## Others Checkbox Multiple Fields ##############################
var others_wrapper = $(".others_wrapper"); //Fields wrapper
var others_wrapper_add_btn = $(".add_others_btn"); //Add button ID

$(others_wrapper_add_btn).click(function (e) { //on add input button click
    e.preventDefault();
    $(others_wrapper).append('' +
        '<div class="add_others_div col-md-12"><div class="row"> <div class="col-md-11"> <div class="form-group form-focus"> <input type="text" class="form-control floating" name="others_comments[]"> <label class="focus-label">Comments</label> </div> </div>' +
        '<div class="col-md-1"> <a href="javascript:void(0)" class="others_remove_row btn btn-danger btn-sm"><i class="fa fa-minus"></i></a> </div>' +
        '</div></div>'); //add inputs box
    x++; //text box increment
    // }
});
$(others_wrapper).on("click", ".others_remove_row", function (e) { //user click on remove text
    e.preventDefault();
    $(this).closest("div.add_others_div").remove();
    x--;
});
//############## Others Checkbox Multiple Fields ##############################

//################ Add Courier To Database Page ###############################

jQuery('#add_courier_btn').on('click', function (e) {
    e.preventDefault();

});

//################ Add Courier To Database Page ###############################

//#############################################################################
//################ Courier Slide Details in Modal #############################
function set_slide_details(courier_id) {
    jQuery.ajax({
        type: "POST",
        url: base_url + "AddCourier/get_slides_data",
        data: {"courier_id": courier_id},
        dataType: "json",
        success: function (response) {
            if (response.type === 'success') {
                $("#slide_lab").html("");
                $("#slide_no_of_slides").html("");
                $("#slide_comments").html("");

                var slideData = JSON.parse(response.data);
                var sld_lab_no = slideData['slide_lab'];
                var sld_no_of_slides = slideData['slide_no_of_slides'];
                var sld_comments = slideData['slide_comments'];
                $("#slide_lab").html(sld_lab_no);
                $("#slide_no_of_slides").html(sld_no_of_slides);
                $("#slide_comments").html(sld_comments);
            }
        }
    });
}

//################ Courier Slide Details in Modal #############################

//################ Courier Block Details in Modal #############################
function set_block_details(courier_id) {
    jQuery.ajax({
        type: "POST",
        url: base_url + "AddCourier/get_blocks_data",
        data: {"courier_id": courier_id},
        dataType: "json",
        success: function (response) {
            if (response.type === 'success') {
                $("#block_lab").html("");
                $("#block_no_of_slides").html("");
                $("#block_comments").html("");

                var blockData = JSON.parse(response.data);
                var blck_lab_no = blockData['block_lab'];
                var blck_no_of_blocks = blockData['block_no_of_blocks'];
                var blck_comments = blockData['block_comments'];
                $("#block_lab").html(blck_lab_no);
                $("#block_no_of_slides").html(blck_no_of_blocks);
                $("#block_comments").html(blck_comments);
            }
        }
    });
}

//################ Courier Block Details in Modal #############################

//################ Courier Other Details in Modal #############################
function set_other_details(courier_id) {
    jQuery.ajax({
        type: "POST",
        url: base_url + "AddCourier/get_other_data",
        data: {"courier_id": courier_id},
        dataType: "json",
        success: function (response) {
            if (response.type === 'success') {
                $("#other_comments").html("");

                var otherCmntsData = JSON.parse(response.data);
                var other_comments = otherCmntsData['other_comments'];
                $("#other_comments").html(other_comments);
            }
        }
    });
}

//################ Courier Other Details in Modal #############################

//#############################################################################