$(document).ready(function () {
    $('#edit_project').on('hide.bs.modal', function (e) {
        $('#projLoader').show();
        $('#projData').hide();
    });
    $('#edit_project').on('shown.bs.modal', function (e) {
        var source = e.relatedTarget;
        var projectID = $(source).data('project');
    
    $.ajax({
        type: "POST",
        url: BASE_URL+"/Project/getProjectData",
        data: {
                projectID:projectID
        },
        success: function (response) {
            response = JSON.parse(response);
            $('#edit_project').find('input[name="project_name"]').val(response.project_data[0].project_name);
            $('#edit_project').find('#client_id_etd').val(response.project_data[0].client_id);
            $('#edit_project').find('#client_id_etd').trigger('change');
            $('#edit_project').find('input[name="project_end_date"]').val(response.project_data[0].project_end_date);
            $('#edit_project').find('input[name="project_start_date"]').val(response.project_data[0].project_start_date);
            $('#edit_project').find('input[name="project_rate"]').val(response.project_data[0].project_rate);
            $('#edit_project').find('#project_rate_type').val(response.project_data[0].project_rate_type);
            $('#edit_project').find('#project_rate_type').trigger('change');
            $('#edit_project').find('#project_piority_edt').val(response.project_data[0].project_piority);
            $('#edit_project').find('#project_piority_edt').trigger('change');
            $('#edit_project').find('input[name="project_id"]').val(response.project_data[0].project_id);
            $('#edit_project').find('textarea[name="project_desc"]').text(response.project_data[0].project_desc);
            $('#edit_project').find('#edt_project_lead').val(response.project_data[0].project_lead);
            var selVal = response.project_data[0].project_team.split(',');
            $('#edit_project').find('#edt_project_teams').val(selVal);
            $('#edit_project').find('#edt_project_lead').trigger('change');
            $('#edit_project').find('#edt_project_teams').trigger('change');
            if(response.project_attach_data.length > 0){
                $('#edit_project').find('#fileList').html('');
                $('#edit_project').find('#fileList').append('<tr><td width="80%"><strong>File Name</strong></td><td><strong>Action</strong></td></tr>');
                $.each(response.project_attach_data,function(index,val){
                    $('#edit_project').find('#fileList').append(
                        "<tr class='prnt-cls'>"
                        +"<td>"+val.attachment_name+"</td>"
                        +"<td><a href='javascript:void(0);' data-fld-id='"+val.attachment_id+"' class='rmvElem'><i class='fa fa-times text-danger'></i></a></td>"
                        +"</tr>"
                    );
                });
            }else{
                $('#edit_project').find('#fileList').html("<tr class='text-center'><td>No Files Attached</td></tr>");
            }
            $('#projLoader').hide();
            $('#projData').show();
        }
    });
    })
    $(document).on('click','.rmvElem',function(){
        var fileID = $(this).data('fld-id');
        var elem = $(this);
        $.ajax({
            type: "POST",
            url: BASE_URL+"/Project/removeAttachment",
            data: {
                attachmentID:fileID
            },
            success: function (response) {
                response = JSON.parse(response);
                if(response.sts == "success"){
                    elem.parent().parent().remove();
                }else{
                    alert("File Not Removed.");
                }
            }
        });
    });
    $(document).on('click','#cnfrmDelete',function(){
        $('#deleteProject').submit();
    })
    $('#client_id').on('change', function () {
        $.ajax({
            type: "POST",
            url: BASE_URL+"/Project/getUsers",
            data: {
                group_id:$('#client_id').val()
            },
            success: function (response) {
                response = JSON.parse(response);
                if(response.length>0){
                    $('#project_lead').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text:"Select Project Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#project_lead').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) { 
                        var data = {
                            id: valueOfElement.user_id,
                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
                        };
                        
                        var newOption = new Option(data.text, data.id, false, false);
                        $('#project_lead').append(newOption).trigger('change');
                    });
                    $('#project_team').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text:"Select Project Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#project_team').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) { 
                        var data = {
                            id: valueOfElement.user_id,
                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
                        };
                        
                        var newOption = new Option(data.text, data.id, false, false);
                        $('#project_team').append(newOption).trigger('change');
                    });
                }
            }
        });
    });
    $('#client_id_etd').on('change', function () {
        $.ajax({
            type: "POST",
            url: BASE_URL+"/Project/getUsers",
            data: {
                group_id:$('#client_id_etd').val()
            },
            success: function (response) {
                response = JSON.parse(response);
                if(response.length>0){
                    var projectLeadVal = $('#edt_project_lead').val();
                    $('#edt_project_lead').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text:"Select Project Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#edt_project_lead').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) { 
                        var data = {
                            id: valueOfElement.user_id,
                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
                        };
                        
                        var newOption = new Option(data.text, data.id, false, false);
                        $('#edt_project_lead').append(newOption).trigger('change');
                    });
                    $('#edt_project_lead').val(projectLeadVal).trigger('change');
                    var projectTeamVal = $('#edt_project_teams').val();
                    $('#edt_project_teams').html('').val('').trigger('change');
                    var data = {
                        id: '',
                        text:"Select Project Leader"
                    };
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#edt_project_teams').append(newOption);
                    $.each(response, function (indexInArray, valueOfElement) { 
                        var data = {
                            id: valueOfElement.user_id,
                            text:valueOfElement.enc_first_name+' '+valueOfElement.enc_last_name
                        };
                        var newOption = new Option(data.text, data.id, false, false);
                        $('#edt_project_teams').append(newOption).trigger('change');
                    });
                    $.each(projectTeamVal, function (indexInArray, elem) { 
                        $("#edt_project_teams option[value='" + elem + "']").prop("selected", true);
                    });
                    $('#edt_project_teams').trigger('change');
                }
            }
        });
    });
});
         
function strartDelete(elem){
    var projectID = $(elem).data('project');
    $('#delete_project').find('#project_id').val(projectID);
}