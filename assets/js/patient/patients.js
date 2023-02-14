function submit_delete_form(){
    $('#delete_pt_frm').submit();
}

function delete_patient(url){ 
    $('#delete_patient_modal').modal('show');        
    if(url=='bulk_delete'){
        //multiple record delete
        $('.patient-delete-btn').attr('href', 'javascript:submit_delete_form()');        
    } else{
        //single record delete
        $('.patient-delete-btn').attr('href', url);
    }
    
}
function showImage(src, target) {
    var fr = new FileReader();
    // when image is loaded, set the src of the image where you want to display it
    fr.onload = function (e) {
        target.src = this.result;
    };
    src.addEventListener("change", function () {
        // fill fr with image data    
        fr.readAsDataURL(src.files[0]);
    });
}

$(() => {
    var countries_suggestions = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: 'https://raw.githubusercontent.com/twitter/typeahead.js/gh-pages/data/countries.json',
            transform: function (data) { // we modify the prefetch response
                var newData = []; // here to match the response format 
                data.forEach(function (item) { // of the remote endpoint
                    newData.push({
                        'name': item
                    });
                });
                return newData;
            }
        },
        identify: function (response) {
            if (response == null) return '';
            return response.name;
        }
    });

    $('#country-input').typeahead({
        minLength: 2,
        highlight: true
    }, {
        name: 'countries',
        source: countries_suggestions, // suggestion engine is passed as the source
        display: function (item) { // display: 'name' will also work
            return item.name;
        },
        limit: 5,
        templates: {
            suggestion: function (item) {
                return '<div class="country-suggestion">' + item.name + '</div>';
            }
        }
    });


    /* START CROP */
    $uploadCrop = $('#upload-demo').croppie({
        enableExif: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $('#upload').on('change', function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                console.log('jQuery bind complete');
            });
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.upload-result').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            //console.log(resp);
            $.ajax({
                type: "POST",
                url: "patient/upload_profile_pic",
                data: {
                    imgBase64: resp,
                    profile_image_name: 'patient.png'
                },
                dataType: "json",
                success: function (res){
                    let html = '<img src="' + resp + '" />';
                    $("#upload-demo-i").html(html);
                    if(res.status == 'success'){
                        $(document).find('#add_patient').find("#picture_name").val(res.name);
                        $(document).find('#add_patient').find("#profile_picture_path").val(res.path);
                    }
                }
            });
        });
    });

    function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;
        var byteCharacters = atob(b64Data);
        var byteArrays = [];
        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);
            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            byteArrays.push(byteArray);
        }
        var blob = new Blob(byteArrays, {type: contentType});
        return blob;
    }
    /* END CROP */

    $(document).on('click', '#save-patient-btn', function(){
        $('#add-patient-form').validate({
            rules: {
                first_name: {required: true},
                last_name: {required: true},
                dob: {required: true, date: true},
                email: {required: true, email: true},
                nhs_number: {required: true, number: true, minlength:10, maxlength:10},
            },
            messages: {
                first_name: {required: 'First name is required'},
                last_name: {required: 'Last name is required'},
                dob: {required: 'Date of birth is required'},
                email: {required: 'Email address is required'},
                nhs_number: {required: 'Please enter the NHS Number', matches: "Please enter a valid NHS Number"},
            }
        });
    });

    $("#add-patient-form").validate({
        rules: {
            first_name: { required: true },
            last_name: { required: true },
            nhs_number: {
                required: true,
                number: true,
                minlength:10,
                maxlength:10,
                remote: {
                    url: "patient/unique_nhs",
                    type: "get",
                    data: {
                        nhs_number: function () {
                            return $("#nhs-number-input").val();
                        },
                        group_id: function () {
                            return $(`#group-input`).val();
                        }
                    }
                }
            },
            dob: {
                required: true,
                date: true
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "patient/unique_email",
                    type: "get",
                    data: {
                        email: function () {
                            return $("#email-input").val();
                        },
                        group_id: function () {
                            return $(`#group-input`).val();
                        }
                    }
                }
            },

        },
        messages: {
            first_name: "Please enter a first name",
            last_name: "Please enter a last name",
            nhs_number: {
                required: "Please enter the NHS Number",
                rangelength: "Please enter a valid NHS Number"
            },
            dob: "Please enter date of birth",
            email: {
                email: "Please provide a valid email",
                required: "Please provide an email",
                remote: "Patient already exists"
            }
        },
        ignore: ".cr-slider",
        submitHandler: function (form) {
            var form_data = new FormData(form);
            console.log("Submitting form");
            $.ajax({
                async: true,
                type: 'POST',
                url: _base_url + "patient/add_patient",
                data: form_data,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    $("#add_patient").modal('hide');
                    if (data.type === 'error') {
                        $.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    } else {
                        $.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    }
					//location.reload();
                    //TODO: Update dataTable
                },
                error: function (req, status, err) {
                    $("#add_patient").modal('hide');
                }
            })
        }
    });

    if ($("#edit-patient-form").length) {
        $("#edit-patient-form").validate({
            rules: {
                first_name: {
                    required: true,
                },
                nhs_number: {
                    required: false,
                    rangelength: [10, 10],
                    remote: {
                        url: _base_url + "patient/unique_nhs/"+patient_id,
                        type: "get",
                        data: {
                            nhs_number: function () {
                               // return $("#nhs-number-input").val();
                            },
                            group_id: function () {
                                return $(`#group-input`).val();
                            }
                        }
                    }
                },
                dob: {
                    required: true,
                    date: true
                }
    
            },
            messages: {
                first_name: "Please enter a name",
                nhs_number: {
                    required: "Please enter the NHS Number",
                    rangelength: "Please enter a valid NHS Number",
                    remote: "Patient already exists"
                },
                dob: "Please enter date of birth"
                
            }
        });
    }
    

    $("select#group-input").select2({
        width: "100%"
    });


    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var hospital = data[3];
            var current_hospital = $(".hospital-info-active").attr('data-original-title');

            if (typeof current_hospital === 'undefined' || current_hospital === null || current_hospital.length === 0) {
                return true;
            } else {
                if (current_hospital == hospital) {
                    return true;
                }
                return false;
            }
        }

    );

    var pt = $("#patient-table").DataTable({
        "ajax": {
            "url": _base_url + "patient/get_patients",
            "dataSrc": 'data'
        },
        "processing": true,
        "autoWidth": false,
        "ordering": false,        
        "columns": [
            {
                data: '',
                render: function (data, type, row, meta) {                                        
                    var check_box = '-';
                    if(row.Rcount == 0){                        
                        var check_box = '<input type="checkbox" name="patient_id[]" class="pt_check_box" value="'+row.id+'" >';
                    }
                    return check_box;
                }
            },
            {
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'nhs'
            },
            {
                data: 'hospital'
            },
            {
                data: 'dob'
            },
            {
                data: 'gender'
            },
			{
                data: 'Rcount'
            },
            {
                data: 'id',
                render: function (data, type, row, meta) {
                    let view_icon = `<a class="dropdown-item" href="${_base_url}patient/view/${data}"><i class="fa fa-eye m-r-5"></i> View</a>`;
                    let delete_icon = '';
                    if(row.Rcount == 0){
                        delete_icon = `<a class="dropdown-item" href="javascript:delete_patient(\'${_base_url}patient/view/${data}/delete\')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>`;
                    }
                    let actionHtml = '<div class="dropdown dropdown-action">\n' +
                                         '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>\n' +
                                         '<div class="dropdown-menu dropdown-menu-right">\n' +
                                             view_icon +
                                             delete_icon +
                                         '</div>\n' +
                                     '</div>';
                    return actionHtml;
                }
            }
        ],
    });

    $("#patient-records-table").DataTable({
        "columnDefs": [{
            "orderable": false,
            "targets": "_all"
        }]
    });

    $(".hospital-info").on('click', function () {
        $(".hospital-info").removeClass('hospital-info-active');
        $(this).addClass('hospital-info-active');
        pt.draw();
    });

    $("#clear-hospital").on('click', function () {
        $(".hospital-info").removeClass('hospital-info-active');
        pt.draw();
    });

    $("#profile-picture-picker").on("click", function () {
        $("#txt_profile_pic").click();
    });

    if ($("#txt_profile_pic").length && $("#patient-profile-pic").length) {
        showImage($("#txt_profile_pic").get(0), $("#patient-profile-pic").get(0));
    }

    $("#txt_profile_pic").on("change", function() {
        $("#update_profile_picture").show();
    });


    // Fix icon position with label
    if ($(".tg-inputwithicon").length) {
        $(".tg-inputwithicon").each(function() {
            if ($(this).find("label").length) {
                $(this).find("i").css({"top": "44px"});
            }
        });
    }


    $("#edit_profile_picture").on("submit", function(e) {
        e.preventDefault();
        var form_data = new FormData(this);
        $.ajax({
            async: true,
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data: form_data,
            cache: false,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            success: function (data) 
			{
                console.log("Form submitted");
            },
            error: function (req, status, err) 
			{
                var msg = req.responseText;
                console.log(msg);
            }
        });
    });

});

$(document).ready(function(){
    $('#all_patient').change(function(){        
        var all_br = $(this).prop('checked');
        $(".pt_check_box").prop('checked', all_br);        
        if(all_br)
        {
            if($(".pt_check_box:checked").length == 0)
            {
                $('#btn_pt_delete').css('display', 'none');
                message('You can\'t select record to delete.', 'error');
                $('#all_patient').prop('checked', false);
            }else{
                $('#btn_pt_delete').css('display', 'block');
                $('#btn_pt_delete').parent('td').css('display', 'block');
            }
        }else{
            $('#btn_pt_delete').css('display', 'none');
        }
    });

    $(document).change('pt_check_box', function(){
        if($(".pt_check_box:checked").length > 0){
            $('#btn_pt_delete').css('display', 'block');
            $('#btn_pt_delete').parent('td').css('display', 'block');
        }else{
            $('#btn_pt_delete').css('display', 'none');
        }
    });
    
    
})