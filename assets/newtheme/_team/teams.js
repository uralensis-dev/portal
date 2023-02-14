$(document).ready(function () {
    $('#edit_team').on('hide.bs.modal', function (e) {
        $('#projLoader').show();
        $('#projData').hide();
    });
//    $('#edit_team').on('shown.bs.modal', function (e) {
//        var source = e.relatedTarget;
//        var teamID = $(source).data('team');
//    
//    $.ajax({
//        type: "POST",
//        url: BASE_URL+"/Team/getTeamData",
//        data: {
//                teamID:teamID
//        },
//        success: function (response) {
//            response = JSON.parse(response);
//            $('#edit_team').find('input[name="team_name"]').val(response.team_data[0].team_name);
//            $('#edit_team').find('#client_id_etd').val(response.team_data[0].client_id);
//            $('#edit_team').find('#client_id_etd').trigger('change');
//            $('#edit_team').find('input[name="team_end_date"]').val(response.team_data[0].team_end_date);
//            $('#edit_team').find('input[name="team_start_date"]').val(response.team_data[0].team_start_date);
//            $('#edit_team').find('input[name="team_rate"]').val(response.team_data[0].team_rate);
//            $('#edit_team').find('#team_rate_type').val(response.team_data[0].team_rate_type);
//            $('#edit_team').find('#team_rate_type').trigger('change');
//            $('#edit_team').find('#team_piority_edt').val(response.team_data[0].team_piority);
//            $('#edit_team').find('#team_piority_edt').trigger('change');
//            $('#edit_team').find('input[name="team_id"]').val(response.team_data[0].team_id);
//            $('#edit_team').find('textarea[name="team_desc"]').text(response.team_data[0].team_desc);
//            $('#edit_team').find('#edt_team_lead').val(response.team_data[0].team_lead);
//            var selVal = response.team_data[0].team_team.split(',');
//            $('#edit_team').find('#edt_team_teams').val(selVal);
//            $('#edit_team').find('#edt_team_lead').trigger('change');
//            $('#edit_team').find('#edt_team_teams').trigger('change');
//            if(response.team_attach_data.length > 0){
//                $('#edit_team').find('#fileList').html('');
//                $('#edit_team').find('#fileList').append('<tr><td width="80%"><strong>File Name</strong></td><td><strong>Action</strong></td></tr>');
//                $.each(response.team_attach_data,function(index,val){
//                    $('#edit_team').find('#fileList').append(
//                        "<tr class='prnt-cls'>"
//                        +"<td>"+val.attachment_name+"</td>"
//                        +"<td><a href='javascript:void(0);' data-fld-id='"+val.attachment_id+"' class='rmvElem'><i class='fa fa-times text-danger'></i></a></td>"
//                        +"</tr>"
//                    );
//                });
//            }else{
//                $('#edit_team').find('#fileList').html("<tr class='text-center'><td>No Files Attached</td></tr>");
//            }
//            $('#projLoader').hide();
//            $('#projData').show();
//        }
//    });
//    })
//    $(document).on('click', '.rmvElem', function () {
//        var fileID = $(this).data('fld-id');
//        var elem = $(this);
//        $.ajax({
//            type: "POST",
//            url: BASE_URL + "/Team/removeAttachment",
//            data: {
//                attachmentID: fileID
//            },
//            success: function (response) {
//                response = JSON.parse(response);
//                if (response.sts == "success") {
//                    elem.parent().parent().remove();
//                } else {
//                    alert("File Not Removed.");
//                }
//            }
//        });
//    });
    $(document).on('click', '#cnfrmDelete', function () {
        $('#deleteTeam').submit();
    })
//    $('#client_id').on('change', function () {
//        $.ajax({
//            type: "POST",
//            url: BASE_URL+"/Team/getUsers",
//            data: {
//                group_id:$('#client_id').val()
//            },
//            success: function (response) {
//                response = JSON.parse(response);
//                if(response.length>0){
//                    $('#team_lead').html('').val('').trigger('change');
//                    var data = {
//                        id: '',
//                        text:"Select Team Leader"
//                    };
//                    var newOption = new Option(data.text, data.id, false, false);
//                    $('#team_lead').append(newOption);
//                    $.each(response, function (indexInArray, valueOfElement) { 
//                        var data = {
//                            id: valueOfElement.user_id,
//                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
//                        };
//                        
//                        var newOption = new Option(data.text, data.id, false, false);
//                        $('#team_lead').append(newOption).trigger('change');
//                    });
//                    $('#team_team').html('').val('').trigger('change');
//                    var data = {
//                        id: '',
//                        text:"Select Team Leader"
//                    };
//                    var newOption = new Option(data.text, data.id, false, false);
//                    $('#team_team').append(newOption);
//                    $.each(response, function (indexInArray, valueOfElement) { 
//                        var data = {
//                            id: valueOfElement.user_id,
//                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
//                        };
//                        
//                        var newOption = new Option(data.text, data.id, false, false);
//                        $('#team_team').append(newOption).trigger('change');
//                    });
//                }
//            }
//        });
//    });
//    $('#client_id_etd').on('change', function () {
//        $.ajax({
//            type: "POST",
//            url: BASE_URL+"/Team/getUsers",
//            data: {
//                group_id:$('#client_id_etd').val()
//            },
//            success: function (response) {
//                response = JSON.parse(response);
//                if(response.length>0){
//                    var teamLeadVal = $('#edt_team_lead').val();
//                    $('#edt_team_lead').html('').val('').trigger('change');
//                    var data = {
//                        id: '',
//                        text:"Select Team Leader"
//                    };
//                    var newOption = new Option(data.text, data.id, false, false);
//                    $('#edt_team_lead').append(newOption);
//                    $.each(response, function (indexInArray, valueOfElement) { 
//                        var data = {
//                            id: valueOfElement.user_id,
//                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
//                        };
//                        
//                        var newOption = new Option(data.text, data.id, false, false);
//                        $('#edt_team_lead').append(newOption).trigger('change');
//                    });
//                    $('#edt_team_lead').val(teamLeadVal).trigger('change');
//                    var teamTeamVal = $('#edt_team_teams').val();
//                    $('#edt_team_teams').html('').val('').trigger('change');
//                    var data = {
//                        id: '',
//                        text:"Select Team Leader"
//                    };
//                    var newOption = new Option(data.text, data.id, false, false);
//                    $('#edt_team_teams').append(newOption);
//                    $.each(response, function (indexInArray, valueOfElement) { 
//                        var data = {
//                            id: valueOfElement.user_id,
//                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
//                        };
//                        var newOption = new Option(data.text, data.id, false, false);
//                        $('#edt_team_teams').append(newOption).trigger('change');
//                    });
//                    $.each(teamTeamVal, function (indexInArray, elem) { 
//                        $("#edt_team_teams option[value='" + elem + "']").prop("selected", true);
//                    });
//                    $('#edt_team_teams').trigger('change');
//                }
//            }
//        });
//    });
});

function strartDelete(elem) {
    var teamID = $(elem).data('team');
    $('#delete_team').find('#team_id').val(teamID);
}