var update_checkbox = function(field){    
    $("input[name="+field+"]").prop('checked', true)
    $('#'+field).removeClass('hide');
}
var br_template_modal = function(hospital_id){    
    $.get(site_url+'Barcode/get_template', { 'hospital_id':hospital_id },function(data) {        
        if(data == null){ 
            $('.br_label').addClass('hide');
            $("input[name=ex_patient_name]").prop('checked', true)
            $('#ex_patient_name').removeClass('hide');
            $("input[name=ex_lab_no]").prop('checked', true)
            $('#ex_lab_no').removeClass('hide');            
        }
        else
        {            
            if(data.patient_name == 1){ update_checkbox('ex_patient_name'); }
            if(data.lab_no == 1){ update_checkbox('ex_lab_no'); }            
            if(data.nhs_no == 1){ update_checkbox('ex_nhs_no'); }
            if(data.dob == 1){ update_checkbox('ex_dob'); }
            if(data.age == 1){ update_checkbox('ex_age'); }
            if(data.gender == 1){ update_checkbox('ex_gender'); }
            if(data.lab_no2 == 1){ update_checkbox('ex_lab_no2'); }                
            if(data.contact_no == 1){ update_checkbox('ex_contact_no'); }
        }
    }, 'JSON');
    $('#tmp_hospital_id').val(hospital_id);
    $('#template_form').trigger("reset");
    $('#br_template_modal').modal('show');
}
var save_template = function(){
    if($('#template_form input[type=checkbox]:checked').length == 0){
        message('You must have to select atlest one label to print on Barcode.', 'info');
    }else if(isNaN($('#template_form #tmp_hospital_id').val())){
        message('Invalid request made', 'info');
        setTimeout(function(){
            location.reload();
        },800)
    }else{
        var datastring = $('#template_form').serialize();
        $.ajax({
            type: "POST",
            url: site_url+'Barcode/save_template',
            data: datastring,            
            success: function(data) {                
                if(data){
                    message('Template saved successfully!', 'success'); 
                    setTimeout(function(){
                        $('#br_template_modal').modal('hide');
                    },800)
                }
            },
            error: function() {
                message('Something went wrong', 'error'); 
            }
        });
    }
}
$(document).ready(function(){    
    $('.template_field').on('click', function(){
        var element_id = $(this).attr('name')
        if($(this).prop('checked')){            
            $('#'+element_id).fadeIn('slow').removeClass('hide')
        }else{
            $('#'+element_id).fadeOut('slow').addClass('hide')
        }
    })
})