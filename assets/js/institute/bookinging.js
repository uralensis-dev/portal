var current_url = new URL(window.location);
var lab_id = '';
var speciality_id = '11';
var lab_name = '';
var speciality = '21';
if (current_url.searchParams.has('lab')) {
    lab_id = current_url.searchParams.get('lab');
}

if (current_url.searchParams.has('speciality')) {
    speciality_id = current_url.searchParams.get('speciality');
}

var lab_specialty_text = '';
if (typeof labs !== 'undefined') 
{
    for (let lab of labs) {
        if (lab.id == lab_id) 
		{
            lab_name = lab.description;
            lab_specialty_text += 'Lab: ' + lab.description+ '<br/>';
        }
    }
}


/*function search_input() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("patient-table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}*/

/*function search_input() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("patient-table2");
  tr = table.getElementsByTagName("tr");
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}*/

$("#lab_name_pre").val(lab_id);
$("#lab_name_pre_show").val(lab_name);

$("#request_type_pre").val(speciality_id);
$("#request_type_pre_show").val(speciality);

$("#specialty_pre").val(speciality_id);
$("#specialty_pre_show").val(speciality);



$("#lab-specialty").html(lab_specialty_text);

tinymce.init({
    menubar: false,
    selector: '.tg-tinymceeditor',

    toolbar: 'undo redo ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    font_formats: "CircularStd=CircularStd;",
    content_style: "@import url('https://db.onlinewebfonts.com/c/860c3ec7bbc5da3e97233ccecafe512e?family=CircularStd'); body { font-family: CircularStd !important; }"
});
tinymce.init({
    selector: '.tinyTextarea',
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_css: '//www.tiny.cloud/css/codepen.min.css'
});

function getTemplates(template_name) {
    var template_name = template_name;
    $(".list_view_show").children("i").toggleClass("fa-th");
    $(".list_view").toggleClass("show");
    $.ajax({
        url: `${_base_url}institute/getTemplates`,
        type: 'POST',
        global: false,
        dataType: 'json',
        data: { 'track_template_name': template_name },
        success: function (data) {
            if (data.type === 'success') {
                var urgency = data.data['urgency'];
                var specimen_type = data.data['specimen_type'];
                var pathologist = data.data['pathologist'];
                var hospitalId = data.data['hospitalId'];

                var clinicId = data.data['clinicId'];
				var courierNo = data.data['courier_no'];
                var departmentId = data.data['department_id'];
                var specimenId = data.data['specimen_id'];
                var tissueTypeId = data.data['tissue_type_id'];
                var specialityId = data.data['speciality'];
                var subSpecialistId = data.data['sub_specialist'];
                var snomedCodeId = data.data['snomed_code_id'];
                var temp_labId = data.data['temp_labId'];
                $("#template_name_pre").val(data.data['temp_input_name']);
                if ((data.data['temp_input_name']).length > 0) {
                    $("#template_name_pre").addClass('blue-border');
                }

$("#delete_temp_id").attr("href", `${_base_url}institute/delete_new_track_temp_data/`+ data.data['templateid']);
$("#template_ename_pop").val(data.data['temp_input_name']);
$("#temp_eauthor").val(data.data['temp_author']);
$("#edateandtime").val(data.data['dateandtime']);
$("#temp_ereff_no_add").val(data.data['temp_reff_no_add']);
$("#epathologist").val(data.data['pathologist']);
$("#eclinicId").val(data.data['clinicId']);
$("#labId").val(data.data['temp_labId']);
$("#ehospitalId").val(data.data['hospitalId']);
$("#template_id").val(data.data['templateid']);



                $("#temp_reff_pre").val("TM000" + data.data['templateid']);
                if ((data.data['templateid']).length > 0) {
                    $("#temp_reff_pre").addClass('blue-border');
                }

                $("#temp_author_pre").val(data.data['authorname']);
                if ((data.data['authorname']).length > 0) {
                    $("#temp_author_pre").addClass('blue-border');
                }

                $("#report_schedule").val(data.data['report_schedule']);
                if ((data.data['report_schedule']).length > 0) {
                    $("#report_schedule").addClass('blue-border');
                }

                $("#stamp_date_pre").val(data.data['stamp_date']);
                if ((data.data['stamp_date']).length > 0) {
                    $("#stamp_date_pre").addClass('blue-border');
                }

                $("#stamp_date_pre").val(data.data['stamp_date']);
                if ((data.data['stamp_date']).length > 0) {
                    $("#stamp_date_pre").addClass('blue-border');
                }

if (typeof hospitalId !== 'undefined' && hospitalId !== null && hospitalId.length > 0) {
                    $('#clinician_data_pre2 option').removeAttr('selected').filter('[value=' + hospitalId + ']').attr('selected', true).parents('select').trigger('change');
                }
				
				
				if (typeof courierNo !== 'undefined' && courierNo !== null && courierNo.length > 0) {
                    $('#courier_no_pre option').removeAttr('selected').filter('[value=' + courierNo + ']').attr('selected', true).parents('select').trigger('change');
                }

                if (typeof urgency !== 'undefined' && urgency !== null && urgency.length > 0) {
                    $('#report_urgency_pre option').removeAttr('selected').filter('[value=' + urgency + ']').attr('selected', true).parents('select').trigger('change');
                    $('#report_urgency_pop option').removeAttr('selected').filter('[value=' + urgency + ']').attr('selected', true).parents('select').trigger('change');
                }

                if (typeof specimen_type !== 'undefined' && specimen_type !== null && specimen_type.length > 0) {
                    $('#specimen_type_pre option').removeAttr('selected').filter('[value=' + specimen_type + ']').attr('selected', true).parents('select').trigger('change');
                    $('#specimen_type_pop option').removeAttr('selected').filter('[value=' + specimen_type + ']').attr('selected', true).parents('select').trigger('change');
                }

                if (typeof pathologist !== 'undefined' && pathologist !== null && pathologist.length > 0) {
                    $('#pathologist_pre option').removeAttr('selected').filter('[value=' + pathologist + ']').attr('selected', true).parents('select').trigger('change');
                    $('#pathologist_pop option').removeAttr('selected').filter('[value=' + pathologist + ']').attr('selected', true).parents('select').trigger('change');
                }

                if (typeof temp_labId !== 'undefined' && temp_labId !== null && temp_labId.length > 0) {
                    if(temp_labId === '0'){
                        $("#labId").val($("#labId option:first").val());
                        $('#labId option').removeAttr('selected').trigger("change");
                        $('#labId>option:eq(0)').attr('selected', true).trigger("change");
                    }else{
                        $('#labId option').removeAttr('selected').filter('[value=' + temp_labId + ']').attr('selected', true).parents('select').trigger('change');
                        $('#labId option').removeAttr('selected').filter('[value=' + temp_labId + ']').attr('selected', true).parents('select').trigger('change');
                    }
                    
                }

                if (typeof clinicId !== 'undefined' && clinicId !== null && clinicId.length > 0) {
                    $('#clinician_data_pre option').removeAttr('selected').filter('[value=' + clinicId + ']').attr('selected', true).parents('select').trigger('change');
                    $('#clinician_no option').removeAttr('selected').filter('[value=' + clinicId + ']').attr('selected', true).parents('select').trigger('change');
                    $('.clinician_pop option').removeAttr('selected').filter('[value=' + clinicId + ']').attr('selected', true).parents('select').trigger('change');
                }

                if (typeof departmentId !== 'undefined' && departmentId !== null && departmentId.length > 0) {
                    setSpecimenAndTissueList(departmentId, specimenId, tissueTypeId);
                    $('#department_pre_show option').removeAttr('selected').filter('[value=' + departmentId + ']').attr('selected', true).parents('select').trigger('change');
                }
                if (typeof specialityId !== 'undefined' && specialityId !== null && specialityId.length > 0) {
                    $('#specialty_pre_show option').removeAttr('selected').filter('[value=' + specialityId + ']').attr('selected', true).parents('select').trigger('change');
                }
                if (typeof subSpecialistId !== 'undefined' && subSpecialistId !== null && subSpecialistId.length > 0) {
                    $('#sub_specialty_pre_show option').removeAttr('selected').filter('[value=' + subSpecialistId + ']').attr('selected', true).parents('select').trigger('change');
                }
				
				
				
                if (typeof snomedCodeId !== 'undefined' && snomedCodeId !== null && snomedCodeId.length > 0) {
                    $('#snomed_code_pre_show option').removeAttr('selected').filter('[value=' + snomedCodeId + ']').attr('selected', true).parents('select').trigger('change');
                }

                $("#template_name_pop").val(data.data['temp_input_name']);
                $("#dateandtime").val(data.data['timestamp']);
                /****slider*****/
                $('#lab').append($("<option></option>").attr("value", data.data['labname']).attr('selected', 'selected').text(data.data['labdesc']));
                $('#physician').append($("<option></option>").attr("value", data.data['hospitalid']).attr('selected', 'selected').text(data.data['hospital_name']));
                $('#pathologist').append($("<option></option>").attr("value", data.data['pathologist']).attr('selected', 'selected').text(data.data['doctorusername']));
                $('#specimentype').append($("<option></option>").attr("value", data.data['specimen_type']).attr('selected', 'selected').text(data.data['specimen_type']));
                $('#urgency').append($("<option></option>").attr("value", data.data['urgency']).attr('selected', 'selected').text(data.data['urgency']));

                $('#request_name_pre option').removeAttr('selected').filter('[value="'+ data.data['request_name'] +'"]').attr('selected', true).parents('select').trigger('change');
                $('#category_name_pre option').removeAttr('selected').filter('[value="'+ data.data['category_name'] +'"]').attr('selected', true).parents('select').trigger('change');
                //$('#specimen_pre_show option').removeAttr('selected').filter('[value="'+ data.data['specimen_id'] +'"]').attr('selected', true).parents('select').trigger('change');
                //$('#tissue_type_pre_show option').removeAttr('selected').filter('[value="'+ data.data['tissue_type_id'] +'"]').attr('selected', true).parents('select').trigger('change');

                $("#edit_mod").val('edit');
                $("#template_id").val(data.data['templateid']);
                $("#temp_reff_no").val("TM000" + data.data['templateid']);
                $("#temp_author").val(data.data['authorname']);
                $("#specimen_no").val(data.data['specimen_no']);
                $("#speciality").val(speciality_id);
                $("#courier_no_pop").val(data.data['courier_no']);
                $("#courier_no").val(data.data['courier_no']);
                $(".batch_no_pop").val(data.data['batch_no']);
                $("#batch_no").val(data.data['batch_no']);
                $("#assessment_no").val(template_name);
                $(".batch_no_pop").val(data.data['batch_no']);
                $("#temp_author_pre").val(data.data['authorname']);
                $("#specimen_no_pre").val(data.data['specimen_no']);

                $("#courier_no_pre").val(data.data['courier_no']);
                $("#batch_no_pre").val(data.data['batch_no']);
                $("#template_preview").show();
				$("#template_preview_option").show();
				

            } else {
                setTimeout(function () {
                    _this.parents('.tg-inputicon').find('i').remove();
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                }, 500);
            }
            $('input[name=barcode_no]').focus();
        },
        error: function (data) {
            console.log('Error Data: ', data);
            jQuery.sticky('Error loading track template', { classList: 'important', speed: 200, autoclose: 7000 });
        }
    });
    $("#template_preview").show();
}

function getBatchName(courier_no){
    $.ajax({
        url: `${_base_url}institute/getBatchByCourier`,
        type: 'POST',
        global: false,
        dataType: 'json',
        data: { "courier_no": courier_no },
        success: function (response) {
            if (response.status === 'success') {
                $('#batch_no_pre').val(response.data.receiver_email);
                $('#stamp_date_pre').val(response.data.stamp_date);
                saveBatchData(response.data.receiver_email);
            } else {
                $('#batch_no_pre').val('');
                $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
            }
        }
    });
}

function saveBatchData(batchName){
    if(batchName != ''){
        $.ajax({
            url: `${_base_url}institute/updateTemplateWithId`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {"value": batchName, "column": "batch_no", "template_id": $("#template_id").val()},
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }, 500);
                }
            }
        });
    }
}




function getsearchbarcode() {

    // Value found in Search/Add record field
    // Searches all the requests with given ura_barcode_no
    var barcode = $("#barcode_no").val();
    var template_id = $("#template_id").val();
    var specimen_no_pre = $("#specimen_no_pre").val();
    $.ajax({
        url: `${_base_url}institute/search_and_add_barcode_record_new`,
        beforeSend: function () {
            // Handle the beforeSend event
        },
        complete: function () {
            //  $.unblockUI();
            // Handle the complete event
        },
        type: 'POST',
        global: false,
        dataType: 'json',
        data: {
            'search_type': 'only_search',
            'barcode': barcode,
            'template_id': template_id,
            'specimen_no_pre': specimen_no_pre
        },
        success: function (data) {
            if (data.type === 'success') {
                setTimeout(function () {
                    $("#serial_number").removeClass('blue-border');
                    $("#ura_barcode_no").removeClass('blue-border');
                    $("#request_id").removeClass('blue-border');
                    $("#request_id_addspeciment").removeClass('blue-border');
                    $("#lab_number").removeClass('blue-border');
                    $("#f_name").removeClass('blue-border');
                    $("#sur_name").removeClass('blue-border');
                    $("#dob").removeClass('blue-border');
                    $("#nhs_number").removeClass('blue-border');
                    $("#clinic_desc_val").removeClass('blue-border');
                    $("#specimen_snomed_t").removeClass('blue-border');
                    $("#specimen_snomed_p").removeClass('blue-border');
                    $("#no_of_slides").removeClass('blue-border');
                    $("#no_of_block").removeClass('blue-border');
                    $("#rcpath_score").removeClass('blue-border');
                    $("#specimen_diagnosis_description").removeClass('blue-border');


                    $("#specmen").html(data.specmen);
                    $("#spechtml").html(data.spechtml);

                    $("#track_record").empty();
                    $("#track_record").append(data.mdata);
                    $("#edit_speciment_details").append(data.specimentDetails);

                    $("#serial_number").val(data.data['serial_number']);
                    if (typeof data.data['serial_number'] !== 'undefined' && data.data['serial_number'].length > 0) {
                        $("#serial_number").addClass('blue-border');
                    }
                    $("#ura_barcode_no").val(data.data['ura_barcode_no']);
                    if (typeof data.data['ura_barcode_no'] !== 'undefined' && data.data['ura_barcode_no'].length > 0) {
                        $("#ura_barcode_no").addClass('blue-border');
                    }

                    $("#request_id").val(data.data['request_id']);
                    if (typeof data.data['request_id'] !== 'undefined' && data.data['request_id'].length > 0) {
                        $("#request_id").addClass('blue-border');
                    }
                    $("#request_id_addspeciment").val(data.data['request_id']);
                    if (typeof data.data['request_id'] !== 'undefined' && data.data['request_id'].length > 0) {
                        $("#request_id_addspeciment").addClass('blue-border');
                    }
                    $("#lab_number").val(data.data['lab_number']);
                    if (typeof data.data['lab_number'] !== 'undefined' && data.data['lab_number'].length > 0) {
                        $("#lab_number").addClass('blue-border');
                    }
                    $("#f_name").val(data.data['f_name']);
                    if (typeof data.data['f_name'] !== 'undefined' && data.data['f_name'].length > 0) {
                        $("#f_name").addClass('blue-border');
                    }
                    $("#sur_name").val(data.data['sur_name']);
                    if (typeof data.data['sur_name'] !== 'undefined' && data.data['sur_name'].length > 0) {
                        $("#sur_name").addClass('blue-border');
                    }
                    $("#dob").val(data.data['dob']);
                    if (typeof data.data['dob'] !== 'undefined' && data.data['dob'].length > 0) {
                        $("#dob").addClass('blue-border');
                    }
                    $("#nhs_number").val(data.data['nhs_number']);
                    if (typeof data.data['nhs_number'] !== 'undefined' && data.data['nhs_number'].length > 0) {
                        $("#nhs_number").addClass('blue-border');
                    }
                    if (typeof data.specimen !== 'undefined' && data.specimen.length > 0) {
                        $("#clinic_desc_val").val(data.specimen[0]["specimen_macroscopic_description"]);
                        if (typeof data.specimen[0]["specimen_macroscopic_description"] !== 'undefined' && data.specimen[0]["specimen_macroscopic_description"].length > 0) {
                            $("#clinic_desc_val").addClass('blue-border');
                        }
                        $("#specimen_snomed_t").val(data.specimen[0]["specimen_snomed_t"]);
                        if (typeof data.specimen[0]["specimen_snomed_t"] !== 'undefined' && data.specimen[0]["specimen_snomed_t"].length > 0) {
                            $("#specimen_snomed_t").addClass('blue-border');
                        }
                        $("#specimen_snomed_p").val(data.specimen[0]["specimen_snomed_p"]);
                        if (typeof data.specimen[0]["specimen_snomed_p"] !== 'undefined' && data.specimen[0]["specimen_snomed_p"].length > 0) {
                            $("#specimen_snomed_p").addClass('blue-border');
                        }
                        $("#no_of_slides").val(data.specimen[0]["slides"]);

                        if (typeof data.specimen[0]["slides"] !== 'undefined' && data.specimen[0]["slides"].length > 0) {
                            $("#no_of_slides").addClass('blue-border');
                        }
                        $("#no_of_block").val(data.specimen[0]["numberOfBlocks"]);
                        if (typeof data.specimen[0]["numberOfBlocks"] !== 'undefined' && data.specimen[0]["numberOfBlocks"].length > 0) {
                            $("#no_of_block").addClass('blue-border');
                        }
                        $("#rcpath_score").val(data.specimen[0]["specimen_rcpath_code"]);
                        if (typeof data.specimen[0]["specimen_rcpath_code"] !== 'undefined' && data.specimen[0]["specimen_rcpath_code"].length > 0) {
                            $("#rcpath_score").addClass('blue-border');
                        }
                        $("#specimen_diagnosis_description").val(data.specimen[0]["specimen_diagnosis_description"]);
                        if (typeof data.specimen[0]["specimen_diagnosis_description"] !== 'undefined' && data.specimen[0]["specimen_diagnosis_description"].length > 0) {
                            $("#specimen_diagnosis_description").addClass('blue-border');
                        }
                    } else {
                        $("#clinic_desc_val").val('');
                        $("#specimen_snomed_t").val('');
                        $("#specimen_snomed_p").val('');
                        $("#no_of_slides").val('');
                        $("#no_of_block").val('');
                        $("#rcpath_score").val('');
                        $("#specimen_diagnosis_description").val('');
                    }
                }, 500);
                $("input").each(function () {
                    if ($(this).val() != '') {
                        $(this).closest(".form-focus").addClass('TAQI');
                    }
                });
            } else {
                setTimeout(function () {
                    jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    $('.tracking_search_result').html('');
                }, 500);
            }
        }
    });
    $('.specimen_tabs > li').click(function () {
        $(this).children('div.dropdown-action').removeClass('hide');
        $(this).children('div.dropdown-action').addClass('active');
    });
}


    $('.barcode_no_search').on('click', function () {
        // Record search and create from a template
        // Get Search Barcode
        // Search for the record
        // getsearchbarcode();
        var _this = $(this);
        var barcode = $("#barcode_no").val();
        if (barcode.trim().length === 0){
            return;
        }
        //alert("kj jkl");
        var search_type = 'ura_barcode_no';

        var is_template_select = false;
        var is_status_select = true;
        var template_id = $("#template_id").val();
        var status_code = 'Booked In To Lab';
		
		//var patient_id=$("#patients_pre").val();

        var val = $("#template_id").val();
        is_template_select = val.length > 0;
        
            var speciality_id = $("#bookingin_sepciality_id").val(); 
            var lab_id = $("#bookingin_lab_id").val(); 
           // console.log(speciality_id); return false; 
            
            var template_id = $("#template_id").val();
//            console.log(template_id); return false;
            $.ajax({
                url: '/institute/batch_record',

                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'search_type': 'add_record',
                    'barcode': barcode,
                    'template_id': template_id,
                    'status_code': status_code,
                    'lab_id' : 114, 
                    'speciality_id' : speciality_id
                },
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            $('.record_add_result').html(data.track_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                        }, 500);
                    } else if (data.type === 'update_statuses') {
                        setTimeout(function () {
                            $('.track_search_table .track_session_row').each(function (index) {
                                if ($(this).data('trackno') == barcode) {
                                    $(this).find('.tg-liststatuses').html(data.encode_status);
                                }
                            });
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            set_templates_scrollbar();
                        }, 500);
                    } else 
					{
                        setTimeout(function () 
						{
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                            $('.tracking_search_result').html('');
                        }, 500);
                    }
                    setTimeout(function () {
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    }, 500);
                },
                error: function (err) {
                    jQuery.sticky('Something went wrong.', {classList: 'important', speed: 200, autoclose: 7000});
                    console.log('Error Response: ', err);
                }
            });
        

    });
	
	
	$('.batch_create_records').on('click', function () 
	{
        var _this = $(this);
        var barcode = $("#barcode_no").val();
        var template_id = $("#template_id").val();
        var status_code = 'Booked In To Lab';
		var speciality_id = $("#bookingin_sepciality_id").val(); 
		var lab_id = $("#bookingin_lab_id").val(); 
            $.ajax({
                url: _base_url + '/institute/batch_record',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'template_id': template_id,
                    'lab_id' : $('#labId').val()
					},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            //$('.record_add_result').html(data.track_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
							window.location.href = data.redirect_url;
                        }, 500);
                    } else if (data.type === 'update_statuses') {
						} else 
					{
						}
                    setTimeout(function () {
						}, 500);
                },
                error: function (err) {
                    jQuery.sticky('Something went wrong.', {classList: 'important', speed: 200, autoclose: 7000});
                    console.log('Error Response: ', err);
                }
            });
        

    });

    
    $("#template_preview").find('input').change(function () {
        var val = $(this).val();
        if (val != null && val.length != 0) {
            $(this).addClass('blue-border');
        } else {
            $(this).removeClass('blue-border');
        }
    });

    $("#template_preview").find('select').change(function () {
        var val = $(this).val();
        if (val != null && val.length != 0) {
            $(this).siblings('.select2').find('.select2-selection').addClass('blue-border');
        } else {
            $(this).siblings('.select2').find('.select2-selection').removeClass('blue-border');

        }
    });

    //Save new track template
    $('#save-track-template').on('click', function (e) {
        e.preventDefault();
        var form_data = new FormData($('#track_temp_edit_form'));
        form_data.append(csrf_name, csrf_hash);
        $.ajax({
            url: `${_base_url}institute/save_new_track_temp_data`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function (data) {
                if (data.type === 'success') {
                    document.location.reload();
                    jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                } else {
                    jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });
    });

    

    $('#save-track-template-add').on('click', function (e) {
        e.preventDefault();
        var form_data = new FormData(document.getElementById("track_temp_add_form"));
        //console.log(1); return false; 
        form_data.append(csrf_name, csrf_hash);
        
        $.ajax({
            url: `${_base_url}institute/save_new_track_temp_data`,
            type: 'POST',
            data: form_data, 
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
                if (data.type === 'success') {
                    document.location.reload();
                } else {
                    message("Something went wrong, try again later", "important");
                }
            },
            error: function (err, s, st) {
                console.error(err);
                message("Something went wrong, try again later", "important");
            }
        });
    });
    
    setTimeout(function () {
        $('input[name=barcode_no]').focus();
    }, 200);

    $('input[name=barcode_no]').on('change', function () {
        $(".barcode_no_search").trigger("click");
        $(".barcode_no_search").attr('disabled', true);
        setTimeout(function() {
            $(".barcode_no_search").attr('disabled', false);
        }, 3000);
    });


    $("#template_name").on('change', function () {
        let templateID = $(this).val();
        $(document).find('#track_template_name').val(templateID);
        getTemplates(templateID);
    });

    

    function updateLab(id) {
        if (!id) {
            $("#lab-message").html("");
            $("#speciality-container").hide();
            $("#next-button").hide();
            return;
        }

        lab_id = id;
        
        $.ajax({
            url: _base_url+`laboratory/get_lab_departments`,
            data: {lab_id: id},
            success: function(data) {
                $("#lab-message").removeClass('danger-text');
                $("#lab-message").html('');
                let departments = data.departments;
                let found = false;
                let specialties = {};
                for (let [d_id, department] of Object.entries(departments)) {
                    if (department.name === 'Pathology') {
                        specialties = department.specialties;
                        found = true;
                        break;
                    }
                }
                if (!found) {
                    $("#lab-message").addClass('danger-text');
                    $("#speciality-container").hide();
                    $("#next-button").hide();
                    $("#lab-message").html("Pathology department not available for this lab");
                } else {
                    if (Object.keys(specialties).length === 0) {
                        $("#lab-message").addClass('danger-text');
                        $("#speciality-container").hide();
                        $("#lab-message").html("Pathology department not available for this lab");
                        $("#next-button").hide();
                        
                    } else {
                        $("#speciality-container").find('.speciality-box').remove();
                        $("#lab-message").html("Pathology Department");
                        for (let [s_id, sp] of Object.entries(specialties)) {
                            $("#speciality-container").append(
                                `<div class="speciality-box" data-id="${s_id}">
                                    ${sp.name}
                                </div>`
                            );
                        }
                        
                        $(".speciality-box").on('click', function() {
                            $(".speciality-box").removeClass('selected-speciality');
                            $(this).addClass('selected-speciality');
                            speciality_id = $(this).attr('data-id');
                            let url = new URL(window.location.href);
                            url.searchParams.set('lab', lab_id);
                            url.searchParams.set('speciality', speciality_id);
                            window.location.href = url.href;
                        });

                        $("#speciality-container").css('display', 'flex');
                    }
                }
            },
            error: function(xhr, statusText, status) {
                $("#lab-message").addClass('danger-text');
                $("#speciality-container").hide();
                if (xhr.status === 404) {
                    $("#lab-message").html("Laboratory Not Found");
                } else {
                    $("#lab-message").html("Something went wrong, try again later");
                }
            }
        })
    }

    updateLab(lab_id);

$(document).ready(function () {

    $("#lab-select").on('change', function() {
        updateLab($(this).val());
    });

    

  $('#bookingpatienttbl thead tr').clone(true).appendTo('#bookingpatienttbl thead');
    $('#bookingpatienttbl thead tr:eq(1) th').each( function (i) 
	{
        var title = $(this).text();
        $(this).html( '<input type="text" style="width: 100%; padding: 3px; box-sizing: border-box;" class="form-control" placeholder="Search '+title+'" />' );        
    });
    var l = $("#bookingpatienttbl").DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "bDestroy": true
    });
    $('#bookingpatienttbl thead tr:eq(1) th').each( function (i) {

    $( 'input', this ).on( 'keyup change', function () {
            if ( l.column(i).search() !== this.value ) {
                l
                .column(i)
                .search( this.value )
                .draw();
              
            }
        });
    });



    $("#create-patient-record").on('click', function() 
	{
        //console.log($("#booking_patient_id").val()); return false; 
        let pid = $(this).attr('data-id');
        let courier_no = $(document).find('#courier_no_pre').val();
        let courier_id = $('#courier_no_pre option').filter('[value=' + courier_no + ']').attr('data-id');
		//alert($('#template_name').val());
        $.ajax(
            {
                url: _base_url+'institute/add_patient_record',
                method: 'POST',
                data: {patient_id: $("#booking_patient_id").val(), speciality_id: $('#bookingin_sepciality_id').val(), lab_id: $('#bookingin_lab_id').val(),tem_id:$('#template_name').val(), status_code: 'Booked In To Lab', 'courier_id': courier_id },
                success: function(data) {                    
                    if (data.type === 'success') {
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            $('.patient_record_add_result').html(data.track_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                            window.location.href = data.redirect_url;
                        }, 500);
                    }
                },
                error: function (xhr, st, s) {
                    jQuery.sticky("Error Occurred, Try again later.", { classList: 'important', speed: 200, autoclose: 7000 });
                    console.log(xhr);
                }
            }
        );
    });


    $(".specimen_tabs > li> a").removeClass("active");
        $(".list_view_show").click(function () {
            $(this).children("i").toggleClass("fa-th");
            $(".thumb_view").toggleClass("hide");
            $(".list_view").toggleClass("show");
        });

    $('body').on('click', '#saveHospitalFormBtn', function (){
        $.ajax({
            type: "POST",
            url: _base_url + "institute/saveHospitalData",
            data: $("#addHospitalForm").serialize(),
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    $('#add_new_hospital').hide();
                    addNewHospitalWithSelected(response.dataArr.id, response.dataArr.text)
                    $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                } else {
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //console.log("Request failed");
                //console.log(jqXHR);
                $("#add-new-hospital-error-message").html(jqXHR.responseText);
            },
        });
    });

    function addNewHospitalWithSelected(id, text){
        $('#lab_name').append($('<option>', {
            value: id,
            text: text
        }));
        $("#p_lab").html(text);
        $("#bookingin_lab_id").val(id);
        $("#lab_name").val(id).trigger('change');
        //$('#lab_name[value='+id+']').prop('selected', true)
    }

    $(document).on('change', '#hospital_id', function (){
        let hospital_id = $(this).val();
        if (hospital_id) {
            $.ajax({
                type: "POST",
                url: _base_url + "institute/get_pathologist_and_clinician",
                data: { "hospital_id": hospital_id },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        let modalDiv = $(document).find('#add_temp');
                        modalDiv.find('.pathologist_pop').html('');
                        $.each(response.data.pathology, function (i, item) {
                            modalDiv.find('.pathologist_pop').append($('<option>', {
                                value: item.id,
                                text: item.first_name +' '+ item.last_name
                            }));
                        });
                        modalDiv.find('.pathologist_pop').select2({width: '100%'}).trigger('select2:select');

                        modalDiv.find('.clinician_pop').html('');
                        $.each(response.data.clinician, function (i, item) {
                            modalDiv.find('.clinician_pop').append($('<option>', {
                                value: item.id,
                                text: item.first_name +' '+ item.last_name
                            }));
                        });
                        modalDiv.find('.clinician_pop').select2({width: '100%'}).trigger('select2:select');

                    }else{
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //console.log("Request failed");
                    //console.log(jqXHR);
                    //$("#error-message").html(jqXHR.responseText);
                },
            });
        }
    });

    $(document).on('change', '#request_name', function(){
        let requestName = $(this).val();
        if(requestName == 'Web Specimen'){
            $('#category_name option').removeAttr('selected').filter('[value="Lab Processing"]').attr('selected', true).parents('select').trigger('change');
        }else if(requestName == 'Blocks' || requestName == 'Slides'){
            $('#category_name option').removeAttr('selected').filter('[value="Reporting"]').attr('selected', true).parents('select').trigger('change');
        }else{
            $('#category_name option').removeAttr('selected').filter('[value=""]').attr('selected', true).parents('select').trigger('change');
        }
    });

    $(document).on('change', '#request_name_pre', function(){
        let requestName = $(this).val();
        if(requestName == 'Web Specimen'){
            $('#category_name_pre option').removeAttr('selected').filter('[value="Lab Processing"]').attr('selected', true).parents('select').trigger('change');
        }else if(requestName == 'Blocks' || requestName == 'Slides'){
            $('#category_name_pre option').removeAttr('selected').filter('[value="Reporting"]').attr('selected', true).parents('select').trigger('change');
        }else{
            $('#category_name_pre option').removeAttr('selected').filter('[value=""]').attr('selected', true).parents('select').trigger('change');
        }
    });

    $("#request_name_pre").on('select2:select',function (event) {
        let requestName = this.value;
        let categoryName = $("#category_name_pre").val();
        $.ajax({
            url: `${_base_url}institute/updateTemplateWithId`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {
                "value": requestName,
                "column": "request_name",
                "template_id": $("#template_id").val()
            },
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        //$('#category_name_pre').trigger('select');
                        $('#category_name_pre option').removeAttr('selected').attr('selected', true).parents('select').trigger('change');
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }, 500);
                }
            }
        });
        $.ajax({
            url: `${_base_url}institute/updateTemplateWithId`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {
                "value": categoryName,
                "column": "category_name",
                "template_id": $("#template_id").val()
            },
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }, 500);
                }
            }
        });
    });

    $("#category_name_pre").on('select2:select',function (event) {
        let categoryName = this.value;
        $.ajax({
            url: `${_base_url}institute/updateTemplateWithId`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {
                "value": categoryName,
                "column": "category_name",
                "template_id": $("#template_id").val()
            },
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }, 500);
                }
            }
        });
    });

});
        $(document).on('click', '.create_sess_list_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: `${_base_url}institute/create_new_session_track_record_list`,
                type: 'POST',
                global: false,
                dataType: 'json',
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        $('.record_add_result').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });


        $('#template_name_pre').keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {

                $.ajax({
                    url: `${_base_url}institute/updateTemplateWithId`,
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {
                        "value": $('#template_name_pre').val(),
                        "column": "temp_input_name",
                        "template_id": $("#template_id").val()
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                console.log("template_name_pre keypress event alert message");
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            }, 500);
                        }
                    }
                });
            }
        });
		

        $("#report_urgency_pre").on('select2:select', function () {
            var end = this.value;

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_report_urgency", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("report_urgency_pre change event alert message");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });
        });

        $("#labId").on('select2:select',function (event) {
            var end = this.value;

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_labId", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("pathologist_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });

        });

        $("#pathologist_pre").on('select2:select',function (event) {
            var end = this.value;

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_pathologist", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("pathologist_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });

        });
		
		$("#courier_no_pre").on('select2:select',function (event) {
            var end = this.value;
            getBatchName(end);

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "courier_no", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("pathologist_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });

        });
		
		$("#clinician_data_pre2").on('select2:select',function (event) {
            var end = this.value;
            getBatchName(end);
            getPathologyAndClinic(end);

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "hospital_id", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("pathologist_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });

        });

        function getPathologyAndClinic(hospital_id){
            $.ajax({
                type: "POST",
                url: _base_url + "institute/get_pathologist_and_clinician",
                data: { "hospital_id": hospital_id },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        let pathologist = response.data.pathology;
                        let clinician = response.data.clinician;
                        let modalDiv = $(document).find('#template_preview');

                        $(document).find('.pathologist_pop').html('');
                        $.each(response.data.pathology, function (i, item) {
                            $(document).find('.pathologist_pop').append($('<option>', {value: item.id, text: item.first_name +' '+ item.last_name}));
                        });
                        $(document).find('.pathologist_pop').select2({width: '100%'}).trigger('select2:select');

                        $(document).find('.clinician_pop').html('');
                        $.each(response.data.clinician, function (i, item) {
                            $(document).find('.clinician_pop').append($('<option>', {
                                value: item.id,
                                text: item.first_name +' '+ item.last_name
                            }));
                        });
                        $(document).find('.clinician_pop').select2({width: '100%'}).trigger('select2:select');

                    }else{
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    //console.log("Request failed");
                    //console.log(jqXHR);
                    //$("#error-message").html(jqXHR.responseText);
                },
            });
        }



        /*$('#department_pre_show').select2().on('change', function(){ });*/
        $("#department_pre_show").on('select2:select',function (event) {
            let department_id = this.value;
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { "action": 'get_speciality', "department_id": department_id },
                success: function (data) {
                    if (data.type === 'success') {
                        $("#specialty_pre_show").html('');
                        $.each(data.res, function (i, item) {
                            $('#specialty_pre_show').append($('<option>', {
                                value: item.id,
                                text: item.text
                            }));
                        });
                        $('#specialty_pre_show').select2({width: '100%'}).trigger('select2:select');
                    }
                }
            });
            setSpecimenAndTissueList(department_id);
        });

        function setSpecimenAndTissueList(department_id, specimenId='', tissueTypeId=''){
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { "action": 'get_specimen_and_tissue_type', "department_id": department_id },
                success: function (data) {
                    if (data.type === 'success') {
                        let specimenArr = data.res.specimenArr;
                        let tissueTypeArr = data.res.tissueTypeArr;

                        $("#specimen_pre_show").html('');
                        $("#tissue_type_pre_show").html('');

                        $('#specimen_pre_show').append($('<option>', {value: '', text: 'Select Specimen'}));
                        $('#tissue_type_pre_show').append($('<option>', {value: '', text: 'Select Tissue Type'}));

                        $.each(specimenArr, function (i, specimen) {
                            $('#specimen_pre_show').append($('<option>', {value: specimen.id, text: specimen.name}));
                        });
                        $('#specimen_pre_show').select2({width: '100%'});
                        $('#specimen_pre_show option').removeAttr('selected').filter('[value="'+ specimenId +'"]').attr('selected', true).parents('select').trigger('change');

                        $.each(tissueTypeArr, function (i, tissueType) {
                            $('#tissue_type_pre_show').append($('<option>', {value: tissueType.id, text: tissueType.name}));
                        });
                        $('#tissue_type_pre_show').select2({width: '100%'});
                        $('#tissue_type_pre_show option').removeAttr('selected').filter('[value="'+ tissueTypeId +'"]').attr('selected', true).parents('select').trigger('change');

                    }
                }
            });
        }

        $("#specialty_pre_show").on('select2:select',function (event) {
            let specialty_id = this.value;
            let department_id = $('#department_pre_show').val();
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { "action": 'get_sub_speciality', "department_id": department_id, "specialty_id": specialty_id },
                success: function (data) {
                    if (data.type === 'success') {
                        $("#sub_specialty_pre_show").html('');
                        $.each(data.res, function (i, item) {
                            $('#sub_specialty_pre_show').append($('<option>', {
                                value: item.id,
                                text: item.text
                            }));
                        });
                        $('#sub_specialty_pre_show').select2({width: '100%'}).trigger('select2:select');
                    }
                }
            });
        });

        $("#sub_specialty_pre_show").on('select2:select',function (event) {
            let sub_specialty_id = this.value;
            let department_id = $('#department_pre_show').val();
            let specialty_id = $('#specialty_pre_show').val();
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { "action": 'get_snomed_code', "department_id": department_id, "specialty_id": specialty_id, "sub_specialty_id": sub_specialty_id },
                success: function (data) {
                    if (data.type === 'success') {
                        $("#snomed_code_pre_show").html('');
                        $.each(data.res, function (i, item) {
                            $('#snomed_code_pre_show').append($('<option>', {
                                value: item.id,
                                text: item.text
                            }));
                        });
                        $('#snomed_code_pre_show').select2({width: '100%'}).trigger('select2:select');
                    }
                }
            });
        });

        $("#snomed_code_pre_show").on('select2:select',function (event) {
            let snomed_code_id = this.value;
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { "action": 'get_report_schedule', "snomed_code_id": snomed_code_id },
                success: function (data) {
                    if (data.type === 'success') {
                        $("#report_schedule").val('');
                        $("#report_schedule").val(data.res.report_schedule);
                        update_data(snomed_code_id, data.res.report_schedule);
                    }
                }
            });



        });

        function update_data(snomed_code_id, report_schedule_value){
            let dataArr = {
                "action" : 'update_all',
                "department_id": $('#department_pre_show').val(),
                "specialty_id": $('#specialty_pre_show').val(),
                "sub_specialty_id": $('#sub_specialty_pre_show').val(),
                "snomed_code_id": snomed_code_id,
                "template_id": $("#template_id").val(),
                "report_schedule": report_schedule_value
            };
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: dataArr,
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });
        }

        $("#specimen_pre_show").on('select2:select',function (event) {
            let dataArr = {
                "action" : 'update_specimen',
                "specimen_id": this.value,
                "template_id": $("#template_id").val()
            };
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: dataArr,
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });
        });

        $("#tissue_type_pre_show").on('select2:select',function (event) {
            let dataArr = {
                "action" : 'update_tissue_type',
                "tissue_type_id": this.value,
                "template_id": $("#template_id").val()
            };
            $.ajax({
                url: `${_base_url}institute/getDepartmentSpecialityData`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: dataArr,
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });
        });

		$("#specimen_no_pre").blur(function (event) {
            var end = this.value;

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "specimen_no", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("pathologist_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });

        });
		
		$("#template_name_pre").blur(function (event) {
            var end = this.value;

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_input_name", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("pathologist_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });

        });
		
		
		

        $("#request_type_pre").on('select2:select', function(event) {
            var end = this.value;

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_request_type", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("request_type_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        }, 500);
                    }
                }
            });
        });

        $("#clinician_data_pre").on('select2:select', function () {

            var end = this.value;

            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,                
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_clinic_user", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("clinician_data_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});   
                        }, 500);

                    }
                }
            });

        });

        $("#lab_name_pre").on('select2:select', function () {
            var end = this.value;
            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_lab_name", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("Lab name pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            // alert(data.msg);
                        }, 500);

                    }
                }
            });

        });


        $("#specimen_type_pre").on('select2:select', function () {
            var end = this.value;
            $.ajax({
                url: `${_base_url}institute/updateTemplateWithId`,
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {"value": end, "column": "temp_skin_type", "template_id": $("#template_id").val()},
                success: function (data) {
                    if (data.type === 'success') {
                        setTimeout(function () {
                            console.log("specimen_type_pre change event");
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            // alert(data.msg);
                        }, 500);

                    }
                }
            });

        });

        $('#courier_no_pre').keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {

                $.ajax({
                    url: `${_base_url}institute/updateTemplateWithId`,
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {
                        "value": $('#courier_no_pre').val(),
                        "column": "courier_no",
                        "template_id": $("#template_id").val()
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                console.log("courier_no_pre change event");
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                // alert(data.msg);
                            }, 500);

                        }
                    }
                });

            }
        });
		
		$('#specialty_pre').keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {

                $.ajax({
                    url: `${_base_url}institute/updateTemplateWithId`,
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {
                        "value": $('#specialty_pre').val(),
                        "column": "sub_specialist",
                        "template_id": $("#template_id").val()
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                console.log("courier_no_pre change event");
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                // alert(data.msg);
                            }, 500);

                        }
                    }
                });

            }
        });


        $('#batch_no_pre').keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {

                $.ajax({
                    url: `${_base_url}institute/updateTemplateWithId`,
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {
                        "value": $('#batch_no_pre').val(),
                        "column": "batch_no",
                        "template_id": $("#template_id").val()
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                console.log("batch_no_pre keypress event");
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                // alert(data.msg);
                            }, 500);

                        }
                    }
                });

            }
        });

        $('#department_id').change(function (){
            let department_id = $(this).val();
            if(department_id > 0){
                $.ajax({
                    type: "POST",
                    url: _base_url + "institute/get_specimen_by_department",
                    data: { department_id, [csrf_name]: csrf_hash },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            let specimenArr = response.data.specimenArr;
                            let tissueTypeArr = response.data.tissueTypeArr;

                            $("#specimen_id").html('');
                            $("#tissue_type_id").html('');

                            $('#specimen_id').append($('<option>', {value: '', text: 'Select Specimen'}));
                            $('#tissue_type_id').append($('<option>', {value: '', text: 'Select Tissue Type'}));

                            if(specimenArr.length > 0){
                                $.each(specimenArr, function (i, specimen) {
                                    $('#specimen_id').append($('<option>', {value: specimen.id, text: specimen.name}));
                                });
                            }else{
                                $.sticky('No specimen record found', {classList: 'important', speed: 200, autoclose: 5000});
                            }
                            $('#specimen_id').select2({width: '100%'});

                            if(tissueTypeArr.length > 0){
                                $.each(tissueTypeArr, function (i, tissueType) {
                                    $('#tissue_type_id').append($('<option>', {value: tissueType.id, text: tissueType.name}));
                                });
                                $('#tissue_type_id').select2({width: '100%'});
                            }else{
                                $.sticky('No tissue type found', {classList: 'important', speed: 200, autoclose: 5000});
                            }
                        } else {
                            $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                        }
                    }
                });
            }
        });

        setTimeout(function () {
            $("#top_delay").fadeOut("fast");
        }, 4500);


function showsnowmad($ids)
{
	alert($ids);
	
        $("#specimen_type_pre").html('');
       
        $.ajax({
            type: "GET",
            url: baseUrl + '/auth/get_snomed_code/'+$ids,
            data: data_form,
            dataType: "json",
            success: function (response) {
             
                if (response.status === 'success') {
                    console.log("Response Parent Groups" + response.parent_groups);
                    $("#specimen_type_pre").html('');
                    $.each(response.parent_groups, function (i, item) {
                        $('#Hgroup_id').append($('<option>', {
                            value: item.snomed_code,
                            text: item.snomed_code,
                            'data-grouptype': item.id
                        }));
                    });
                    $('#specimen_type_pre').select2({width: '100%'});
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
       
    
}