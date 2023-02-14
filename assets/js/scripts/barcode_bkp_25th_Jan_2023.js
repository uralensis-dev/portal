$(function(){
    $(document).on('change', '#noOfLable',function(e){
        var repeatValue = $(this).val();
        if(repeatValue === ''){
            repeatValue = 1;
        }
        if(parseInt(repeatValue) === 0){
            repeatValue = 1;
        }
        $('.checboxTextBox').attr('data-repeat', repeatValue);
    });
    setInterval(function(){
        if($('.testsCheckbox:checked').length <= 0){
            $('.checboxTextBox').addClass("inactiveLink");
        }else{
            $('.checboxTextBox').removeClass("inactiveLink");
        }
    },100)
})



function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function barcode_type(data, atype){
    console.log(data,"sdfdfdsfdsfdsf");
    $('#btn_barcode').attr("data-value", data);
    $('#btn_sp_pot').attr("data-value", data);
    $('#patientName').val(data['patientName']);
    $('#specimCount').val(data['specimentCounts']);
    $('#specimBlockId').val(data['spBlockId']);
    $('#tetsIds').val(data['test']);
    $('#btn_download_request_cassete, #btn_download_request_slide').attr("data-values", data['lab_no']+"-"+data['blockNo']+" "+data['patientName']+" " + data['pathologistName']);

    var digi_number = $('#digi_number').html();
    var lab_number = data['lab_no'];
    var test = data['test'];
    $('.checboxTextBox').attr('data-blocks',data['blockNo']);
    var dropdownSelector = data['dropdownSelector'];
    var patient_name = $('#pt_first_name').html()+' '+$('#pt_last_name').html();
    var br_html = '';
    var checkbox_html = '';

    $('#br_box').html('');
    $('#checkboxXontainer').html();
    var total_test = data['test'].split(",");
    var tests_txt = '';
    $('#'+dropdownSelector +' > option:selected').each(function() {
    //for(i = 0; i< total_test.length; i++){
        tests_txt += $(this).text() + ',';
        var disabled = '';
        if(data['page'] && data['page'] === 'further_work'){
            disabled = 'disabled';
            $('#lab_number').val(data['lab_no']);
        }
        checkbox_html +='<div id="checkbox_row'+$(this).val()+'"><input class="testsCheckbox" type="checkbox" value="'+$(this).val()+'" id="'+$(this).val()+'" data-label="'+$(this).text()+'"  checked '+disabled+'/><label for="'+$(this).val()+'" style="vertical-align: middle;margin-left: 10px;">'+$(this).text()+'</label></div>';

        br_html += '<br/><div class="main" style="margin: 0 auto; text-align: left; min-height: 117px !important; width: 155px !important; overflow:hidden;">\
        <center class="center_class" style="text-align: left;min-height: 125px !important;width: 155px !important;overflow: hidden !important;">\
            <div class="barcode_wrap" style="padding: 2px;border-radius: 5px;">\
        <center>\
        <div class="d-flex" style="display: flex;align-items: center;justify-content: space-around;">\
        <img src="#" class="b_img" alt="Barcode" style="max-width: 55px !important;">\
                                    <img src="../../../assets/img/qrLogo.jpeg" class="qrlogo" alt="Barcode" style="max-width: 60px !important;max-height: 60px !important;object-fit: cover;">\
                                </div>\
        <input type="hidden" id="download_value" data-channel="'+data['channel_no']+'" data-rflno="'+data['ref_lab_number']+'" data-pname="'+data['patientName']+'" data-test="'+$(this).text()+'" data-block="'+data['blockNo']+'" data-labno="'+lab_number+'" data-path="'+data['pathlogositName']+'"/>\
        <table class="br_table" style="font-size:10px !important;">\
        <tbody>\
        <tr class="hide" style="line-height: 13px;"><td class="text-center"><center>'+digi_number+'</center></td></tr>\
        <tr class="barcodeData hide" style="line-height: 13px;"><td class="text-center"><center>'+lab_number+'</center></td></tr>\
        <tr class= "requestData hide" style="line-height: 13px;"><td class="text-center"><center>'+lab_number+'-'+data['blockNo']+'</center></td></tr>\
        <tr class= "patientData hide" style="line-height: 13px;"><td class="text-center"><center>'+data['patientName']+'</center></td></tr>\
        <tr class="testData hide" style="line-height: 13px;"><td class="text-center"><center>'+$(this).text()+'</center></td></tr>\
        <tr class="pathologistData hide" style="line-height: 13px;"><td class="text-center"><center>'+data['pathlogositName']+'</center></td></tr>\
        <tr class="hide" style="line-height: 13px;"><td class="text-center" ><center>'+$('#patientDOB').val()+'</center></td></tr>\
        <tr class="specimen_print hide" style="line-height: 13px;"><td class="text-center" ><center>Specimen 1</center></td></tr>\
        </tbody></table>\
    </center>\
    </div>\
    </center>\
    <div class="col-md-12 text-center hide" id="br_error_box">\
    </div>\
    </div>'
    // }
});
    tests_txt = tests_txt.replace(/,\s*$/, "");
    $('.checboxTextBox').attr('data-tests',tests_txt);
    $('#br_box').html(br_html);
    $('#checkboxXontainer').html(checkbox_html);
    
    $('#br_digi_number').html(digi_number)
    $('#br_lab_number').html(lab_number)
    $('#br_patient').html(patient_name)
    $('#br_test').html(test);

    $('#checkboxXontainer').show();
    $('#btn_download_request_cassete').hide();
        $('#btn_download_request_slide').show();
    if(atype === 2){
        $('#checkboxXontainer').hide();
        $('#btn_download_request_cassete').show();
        $('#btn_download_request_slide').hide();
    }

    $('#noOfLable').val("1");
    $('#barcode_action').modal('show');
}

function barcode_p(row, action_type) {
    $('.barcodeData, .requestData, .patientData, .testData, .pathologistData').addClass('hide');
    if(action_type == 1){
        $('.barcodeData, .testData').removeClass('hide');
    }else if(action_type == 2){
        $('.requestData, .patientData, .pathologistData').removeClass('hide');
    }else{
        $('.requestData').removeClass('hide');
    }
    var digi_number = $('#digi_number').html();
    generate_barcode(digi_number, $(row).attr("data-value"), action_type);
}

function request_download_barcode(a_type) {
    var ajaxUrl = "../../../GenerateBarcode/download_barcode";
    var action = '';
    if(a_type === 4){
        action = 'downloadBarcode';  
    }
    if(a_type === 5){
        action = 'downloadSpecimenBarcode';  
    }
    if(a_type === 6){
        action = 'downloadRequest';  
    }
    if(a_type === 7){
        action = 'downloadCassette';  
    }
    $.ajax({
        type: "POST",
        url: ajaxUrl,
        data: {[csrf_name]: csrf_hash, 'page' : 'request','request_action' : action, 'blockNo' : $('#download_value').attr('data-block'), 'patientName' : $('#download_value').attr('data-pname'), 'labNo' : $('#download_value').attr('data-labno'), 'pathologist' : $('#download_value').attr('data-path'), 'tests' : $('#download_value').attr('data-test'), 'channel' : $('#download_value').attr('data-channel'), 'ref_lab_number' : $('#download_value').attr('data-rflno')}, 
        dataType: 'JSON',           
        success: function(response) { 
            alert("Label file exported to the root directory.");
        }
    });
}

function barcode_modal(data){
    //console.log(data);
    var digi_number = $('#digi_number').html();
    var lab_number = data['lab_no'];
    var test = data['test'];
    var patient_name = $('#pt_first_name').html()+' '+$('#pt_last_name').html();
    $('#br_digi_number').html(digi_number)
    $('#br_lab_number').html(lab_number)
    $('#br_patient').html(patient_name)
    $('#br_test').html(test);
    //$('#barcode_modal').modal('show');

    generate_barcode(digi_number, data);
}
function print_barcode(div_name){
    var printContents = $('#'+div_name).html();
    $('body').html(printContents);
    window.print();
    setTimeout(function(){
        location.reload();
    },400)
}
function generate_barcode(code, br_data, action_type = 1){
    if(code != ''){
        $('#br_box').removeClass('hide');
        $('#br_error_box').addClass('hide');
        var br_data = JSON.stringify(br_data);

        var patient_id = $('#ptnt_id').html();
        var testString = "";
        $('.SpecimenData'+$('#specimBlockId').val()+' :selected').each(function(){
            if(testString === "") {
                testString = $(this).text();
            }else{
                testString += "," + $(this).text();
            }
        });
        $.ajax({
            url: '../../../GenerateBarcode',
            type: "post",
            data: {[csrf_name]: csrf_hash, 'code' : code, save_it: 1, 'br_data': br_data, 'patient_id' : patient_id, 'action_type' : action_type, patientName : $('#patientName').val(), tetsIds : $('#tetsIds').val(), specimCount : $('#specimCount').val(), tests : testString},
            success: function (response) {
                $('.b_img').attr('src', response);
                setTimeout(function(){
                   print_barcode('br_box');
                },500);
            },
            error: function(){
                alert('Something went wrong.')
            }
        });
    }else{
        $('#br_box').addClass('hide');
        $('#br_error_box').removeClass('hide');
        $('#br_error_box').html('<center>No Digi Number Found.</center>');
        alert('No Digi Number Found.')
    }
  
}
// $(document).ready(function(){

// });