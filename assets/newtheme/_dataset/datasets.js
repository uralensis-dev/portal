$(document).ready(function () {

    $('#edit_dataset').on('hide.bs.modal', function (e) {
        $('#projLoader').show();
        $('#projData').hide();
    });
    $('#edit_dataset').on('shown.bs.modal', function (e) {
        var source = e.relatedTarget;
        var datasetID = $(source).data('dataset');

        $.ajax({
            type: "POST",
            url: BASE_URL + "/Dataset/getDatasetData",
            data: {
                datasetID: datasetID
            },
            success: function (response) {
                response = JSON.parse(response);
                $('#edit_dataset').find('input[name="dataset_name"]').val(response.dataset_data[0].dataset_name);
                $('#edit_dataset').find('#client_id_etd').val(response.dataset_data[0].client_id);
                $('#edit_dataset').find('#client_id_etd').trigger('change');
                $('#edit_dataset').find('input[name="dataset_end_date"]').val(response.dataset_data[0].dataset_end_date);
                $('#edit_dataset').find('input[name="dataset_start_date"]').val(response.dataset_data[0].dataset_start_date);
                $('#edit_dataset').find('input[name="dataset_rate"]').val(response.dataset_data[0].dataset_rate);
                $('#edit_dataset').find('#dataset_rate_type').val(response.dataset_data[0].dataset_rate_type);
                $('#edit_dataset').find('#dataset_rate_type').trigger('change');
                $('#edit_dataset').find('#dataset_piority_edt').val(response.dataset_data[0].dataset_piority);
                $('#edit_dataset').find('#dataset_piority_edt').trigger('change');
                $('#edit_dataset').find('input[name="dataset_id"]').val(response.dataset_data[0].dataset_id);
                $('#edit_dataset').find('textarea[name="dataset_desc"]').text(response.dataset_data[0].dataset_desc);
                $('#edit_dataset').find('#edt_dataset_lead').val(response.dataset_data[0].dataset_lead);
                var selVal = response.dataset_data[0].dataset_dataset.split(',');
                $('#edit_dataset').find('#edt_dataset_datasets').val(selVal);
                $('#edit_dataset').find('#edt_dataset_lead').trigger('change');
                $('#edit_dataset').find('#edt_dataset_datasets').trigger('change');
                if (response.dataset_attach_data.length > 0) {
                    $('#edit_dataset').find('#fileList').html('');
                    $('#edit_dataset').find('#fileList').append('<tr><td width="80%"><strong>File Name</strong></td><td><strong>Action</strong></td></tr>');
                    $.each(response.dataset_attach_data, function (index, val) {
                        $('#edit_dataset').find('#fileList').append(
                                "<tr class='prnt-cls'>"
                                + "<td>" + val.attachment_name + "</td>"
                                + "<td><a href='javascript:void(0);' data-fld-id='" + val.attachment_id + "' class='rmvElem'><i class='fa fa-times text-danger'></i></a></td>"
                                + "</tr>"
                                );
                    });
                } else {
                    $('#edit_dataset').find('#fileList').html("<tr class='text-center'><td>No Files Attached</td></tr>");
                }
                $('#projLoader').hide();
                $('#projData').show();
            }
        });
    })
    $(document).on('click', '.rmvElem', function () {
        var fileID = $(this).data('fld-id');
        var elem = $(this);
        $.ajax({
            type: "POST",
            url: BASE_URL + "/Dataset/removeAttachment",
            data: {
                attachmentID: fileID
            },
            success: function (response) {
                response = JSON.parse(response);
                if (response.sts == "success") {
                    elem.parent().parent().remove();
                } else {
                    alert("File Not Removed.");
                }
            }
        });
    });
    $(document).on('click', '#cnfrmDelete', function () {
        $('#deleteDataset').submit();
    })
    $('#client_id').on('change', function () {
        $.ajax({
            type: "POST",
            url: BASE_URL + "/Dataset/getUsers",
            data: {
                group_id: $('#client_id').val()
            },
            success: function (response) {
                response = JSON.parse(response);
                if (response.length > 0) {
                    $('#dataset_lead').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text: "Select Dataset Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#dataset_lead').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) {
                        var data = {
                            id: valueOfElement.user_id,
                            text: valueOfElement.enc_first_name + ' ' + valueOfElement.enc_last_name
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        $('#dataset_lead').append(newOption).trigger('change');
                    });
                    $('#dataset_dataset').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text: "Select Dataset Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#dataset_dataset').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) {
                        var data = {
                            id: valueOfElement.user_id,
                            text: valueOfElement.enc_first_name + ' ' + valueOfElement.enc_last_name
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        $('#dataset_dataset').append(newOption).trigger('change');
                    });
                }
            }
        });
    });
    $('#client_id_etd').on('change', function () {
        $.ajax({
            type: "POST",
            url: BASE_URL + "/Dataset/getUsers",
            data: {
                group_id: $('#client_id_etd').val()
            },
            success: function (response) {
                response = JSON.parse(response);
                if (response.length > 0) {
                    var datasetLeadVal = $('#edt_dataset_lead').val();
                    $('#edt_dataset_lead').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text: "Select Dataset Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#edt_dataset_lead').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) {
                        var data = {
                            id: valueOfElement.user_id,
                            text: valueOfElement.enc_first_name + ' ' + valueOfElement.enc_last_name
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        $('#edt_dataset_lead').append(newOption).trigger('change');
                    });
                    $('#edt_dataset_lead').val(datasetLeadVal).trigger('change');
                    var datasetDatasetVal = $('#edt_dataset_datasets').val();
                    $('#edt_dataset_datasets').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text: "Select Dataset Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#edt_dataset_datasets').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) {
                        var data = {
                            id: valueOfElement.user_id,
                            text: valueOfElement.enc_first_name + ' ' + valueOfElement.enc_last_name
                        };
                        var newOption = new Option(data.text, data.id, false, false);
                        $('#edt_dataset_datasets').append(newOption).trigger('change');
                    });
                    $.each(datasetDatasetVal, function (indexInArray, elem) {
                        $("#edt_dataset_datasets option[value='" + elem + "']").prop("selected", true);
                    });
                    $('#edt_dataset_datasets').trigger('change');
                }
            }
        });
    });
});

function strartDelete(elem) {
    var datasetID = $(elem).data('dataset');
    $('#delete_dataset').find('#dataset_id').val(datasetID);
}



function mdtFullCalendar(mdt_event_json) {

    document.getElementById('mdt_dates_calendar').innerHTML = '';

    var calendarEl = document.getElementById('mdt_dates_calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        plugins: ['interaction', 'dayGrid'],

        defaultView: 'dayGridMonth',

        header: {

            left: 'prev,next',

            center: 'title',

            right: ''

        },

        events: mdt_event_json,

        eventClick: function(info) {

            var custom_props = info.event.extendedProps;

            $('#modalTitle').html(custom_props.mdt_hospital_title);

            $('#modalBody').find('#mdt_date').html(info.event.start);

            $('#modalBody').find('#mdt_cat_names').html(custom_props.mdt_cats_names);

            $('#fullCalModal').modal();

        }

    });

    calendar.render();

}



$(document).ready(function(){

    $('.datatable').dataTable( {

      "ordering": false

    } );



    $('.select-adv').select2({

        width: '100%'

    });

})
