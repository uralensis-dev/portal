function delete_document(url){
    $('#delete_document_modal').modal('show');    
    $('.document-delete-btn').attr('href', url);
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

function embed_document2(file_name){
    console.log(file_name)
    var embed_div = document.getElementById('doc_embed');
    embed_div.innerHTML="";
    embed_div.innerHTML = "<embed src='"+file_name+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";
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
    $("#add-patient-form").validate({
        rules: {
            first_name: {
                required: true,
            },
            nhs_number: {
                required: true,
                rangelength: [10, 10],
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
                email: true,
                required: true,
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
            first_name: "Please enter a name",
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
                    console.log(data);
                    $("#add_patient").modal('hide');
					location.reload();
                    console.log("Form submitted");
                    //TODO: Update dataTable
                },
                error: function (req, status, err) {
                    console.log(status);
                    console.log(err);
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
                    required: true,
                    rangelength: [10, 10],
                    remote: {
                        url: _base_url + "patient/unique_nhs/"+patient_id,
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
                    email: true,
                    required: true,
                    remote: {
                        url: _base_url + "patient/unique_email/"+patient_id,
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
                first_name: "Please enter a name",
                nhs_number: {
                    required: "Please enter the NHS Number",
                    rangelength: "Please enter a valid NHS Number",
                    remote: "Patient already exists"
                },
                dob: "Please enter date of birth",
                email: {
                    email: "Please provide a valid email",
                    required: "Please provide an email",
                    remote: "Patient already exists"
                }
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
            "url": _base_url + "documents/get_documents",
            "dataSrc": 'data'
        },
        "processing": false,
        "ordering": false,
        "columns": [{
                data: 'nhs'
            },
            {
                data: 'name'
            },
            {
                data: 'owner_name'
            },
            {
                data: 'species'
            },
			{
                data: 'hospital'
            },
            {
                data: 'dob'
            },
            {
                data: ''
            },
            {
                data: 'id',
                render: function (data, type, row, meta) {
                    return `
                    <div class="dropdown dropdown-action text-right" style="width=100%">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="${_base_url}patient/view/${data}/delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>
                    `
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
            success: function (data) {
                console.log("Form submitted");
            },
            error: function (req, status, err) {
                var msg = req.responseText;
                console.log(msg);
            }
        });
    });

});