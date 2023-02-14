function add_qr_code(data) {
    var typeNumber = 4;
    var errorCorrectionLevel = 'L';
    var qr = qrcode(typeNumber, errorCorrectionLevel);
    qr.addData(data);
    qr.make();
    $("#qrcode-container").html(qr.createImgTag());
    $("#qrcode-container").find('img').addClass('img-fluid');
    $("#qrcode-container").find('img').attr('width', '178');
    $("#qrcode-container").show();
    $("#qr-code-input").focus();
}

function add_table_data(data) {
    if($("#ref_id"+data['ref']).length == 0){

        var row = $("<tr id=ref_id"+data['ref']+"></tr>");
        row.append('<td>'+data['ref']+'</td>');
        row.append('<td>'+data['date']+'</td>');
        //row.append('<td>'+data['time']+'</td>');
        row.append('<td>'+data['status']+'</td>');
        row.append('<td><img class="img-fluid avatar" src='+data['user_id']+'></td>');
        $("#record-history-table").find('tbody').append(row);
        $("#qr-code-input").focus();
    }
}

function clear_table_data() {
    $("#record-history-table").find('tbody').html('');
    $("#qr-code-input").focus();
}


function message(msg, success) {
    var color = success?'success' : 'important';
    $.sticky(msg, {
        classList: color,
        speed: 200,
        autoclose: 7000
    });
}

var current_status = null;
function barcodePrint(div_name){
    var printContents = $('#'+div_name).html();
    $('body').html(printContents);
    window.print();
    setTimeout(function(){
        location.reload();
    },400)
}

function print_barcode(a_type) {
    $('#action_type').val('');
    if(a_type != 1){
        $('#action_type').val('sp_pot');
    }
    if(a_type === 3){
        $('#action_type').val('request');
        $('#request_action').val('request');
    }

    if(a_type === 1){
        $('#action_type').val('barcode');
    }


    var ajaxUrl = "GenerateBarcode/bulk_barcode";
    if(a_type === 4){
        $('#request_action').val('downloadBarcode');
        var ajaxUrl = "GenerateBarcode/download_barcode";
    }
    if(a_type === 5){
        $('#request_action').val('downloadSpecimenBarcode');
        var ajaxUrl = "GenerateBarcode/download_barcode";
    }
    if(a_type === 6){
        $('#request_action').val('downloadRequest');
        var ajaxUrl = "GenerateBarcode/download_barcode";
    }
    if(a_type === 7){
        $('#request_action').val('downloadCassette');
        var ajaxUrl = "GenerateBarcode/download_barcode";
    }
    var datastring = $('#trackbarcode_frm').serialize();
    $.ajax({
        type: "POST",
        url: _base_url+ajaxUrl,
        data: datastring, 
        dataType: 'JSON',           
        success: function(response) { 
            var top_pos = 0;
            var left_pos = 0;
            // if(response.length > 0 ){
                if(a_type === 4 || a_type === 5 || a_type === 6 || a_type === 7){
                    //Download code - start
                    // var newwindow = window.open(response.fileURL);
                    // newwindow.focus();
                    // newwindow.onblur = function() {newwindow.close(); };
                    //Download code - end
                    alert("Label file exported to the root directory.");
                    // jQuery.sticky("Excel file has been generated successfully!!!", {classList: "success", speed: 200, autoclose: 7000}); 
                }else{
                // $.each(response, function(i, item){
                    $('#br_box_request').html(response);
                // });  
                    setTimeout(function(){
                        barcodePrint('br_box_request');
                    },2000);
                }
            // }
            
        }
    });
}
function update_record_history_table(qr_code) {
    $('#requestWrap').hide();
    $('#requestWrap').html("");
    $.get(_base_url+`tracking/get_record_history?lab_number=${encodeURIComponent(qr_code)}`, function(data) {
        var request_html = '<form id="trackbarcode_frm" method="post"><div class="hd_data"><input type="hidden" name="trackPage" value="1" class="br_data_input"/><input type="hidden" name="lab_id[]" value="'+data.requestData.lab_id+'" class="br_data_input"/>'+
            '<input type="hidden" name="lab_number[]" value="'+data.requestData.lab_no+'" class="br_data_input" />'+
            '<input type="hidden" name="digi_number[]" value="'+data.requestData.lims_no+'" class="br_data_input"/>'+
            '<input type="hidden" name="test_id[]" value="'+data.requestData.all_test_id+'" class="br_data_input"/>'+
            '<input type="hidden" name="test[]" value="'+data.requestData.test+'" class="br_data_input"/>'+
            '<input type="hidden" name="patient_id[]" value="'+data.requestData.patient_id+'" class="br_data_input"/>'+
            '<input type="hidden" name="hospital_id[]" value="'+data.requestData.hospital_id+'" class="br_data_input" disabled="disabled"/>'+
            '<input type="hidden" name="patient_name[]" value="'+data.requestData.patient+'" class="br_data_input"/>'+
            '<input type="hidden" name="specimen_id[]" value="'+data.requestData.sp_id+'" class="br_data_input"/>' +
            '<input type="hidden" name="ctest[]" value="'+data.requestData.ctest+'" class="br_data_input"/>'+
            '<input type="hidden" name="pathologist[]" value="'+data.requestData.pathologist+'" class="br_data_input"/>'+
            '<input type="hidden" name="ref_lab_number[]" value="'+data.requestData.ref_lab_number+'" class="br_data_input"/>'+
            '<input type="hidden" name="hospital_group_id[]" value="'+data.requestData.req_hospital_group_id+'" class="br_data_input"/>'+
            '<input type="hidden" name="request_id[]" value="'+data.requestData.rq_id+'">'+
            '<input type="hidden" name="'+csrf_token_name+'" value="'+csrf_cookie+'"/></div>'+
            '<input type="hidden" value="" id="request_action" name="request_action"/>'+
            '<input type="hidden" value="" id="action_type" name="action_type"/>'+
            '<a href="javascript:print_barcode(1);" id="btn_barcode" class="downloadBtn btn btn-primary">Generate Barcode</a>'+
            '<a href="javascript:print_barcode(3);" id="btn_sp_pot" class="downloadBtn btn btn-success">Specimen Pot</a>'+
            '<a href="javascript:print_barcode(2);" id="btn_sp_request" class="downloadBtn btn btn-info">Request</a>'+
            '<a href="javascript:print_barcode(4);" id="" class="downloadBtn btn btn-info hide">Download Barcode</a>'+
            '<a href="javascript:print_barcode(5);" id="" class="downloadBtn btn btn-info hide">Download Specimen Barcode</a>'+
            '<a href="javascript:print_barcode(6);" id="" class="downloadBtn btn btn-info hide">Download Request Barcode</a>'+
            '<a href="javascript:print_barcode(7);" id="" class="downloadBtn btn btn-info">Download Cassette</a></form>';
            $('#requestWrap').html(request_html).show();
        if (data.status == 'success') {
            message('Record found', true);
            add_qr_code(qr_code);
            

            if (data.history.length == 0) {
                 $("#dv_add_remove_class").removeClass('col-lg-8');
                    $("#dv_add_remove_class").addClass('col-lg-12');
                    $("#dv_lab_rec_history").hide();
                    $('#record-history-table').hide();
                
                $("#record-history-table-heading").html('No Recorded History');
            }else{
                $('#record-history-table').show();
               $("#dv_add_remove_class").removeClass('col-lg-12');
                    $("#dv_add_remove_class").addClass('col-lg-8');
                    $("#dv_lab_rec_history").show();

                if (current_status ===  null && data.track_status.length > 0) {
                    var track_status = data.track_status;
                    track_status = track_status.toLowerCase();
                    track_status = track_status.replaceAll(/[^a-zA-Z ]/g, "");
                    track_status = track_status.replaceAll(/\s\s+/g, ' ');
                    track_status = track_status.replaceAll(' ', '-');
                    console.log(track_status);
                    var btn = $("#"+track_status);
                    select_circle(btn);
                }
                data.history.forEach(function(history) {
                    var user_id = history['rec_history_user_id'];
                    var u_id = '';
                    jQuery.ajaxSetup({async:false});
                    $.get(_base_url+'tracking/get_userid/'+user_id, function(data){
                        if (data.status == 'success') {
                            u_id = data['userid'];
                        }
                    }).always(function() {
                        var status = '';
                        if (history['rec_history_status'] == 'publish') {
                            status = 'Published'
                        }
                        
                        if (history['rec_history_status'] == 'edit') {
                            status = 'Edited'
                        }
                        
                        if (history['rec_history_status'] == 'fw_add') {
                            status = 'Further word requested'
                        }
                        if (history['rec_history_status'] == 'unpublish') {
                            status = 'Unpublished'
                        }
                        
                        if (history['rec_history_status'] == 'track_status') {
                            status = 'Track Status changed to '+ history['rec_history_data'];
                        }
                        
                        var ts = history['timestamp'];
                        var d = moment(new Date(parseInt(ts) * 1000));
                        //var dt = d.calendar();
                        // var tm = d.format("mm:hh a");
                        var dt = d.format('DD-MM-YYYY');
                        add_table_data({
                            ref: history['ura_rec_history_id'],
                            date: ts,
                            // time: tm,
                            status: status,
                            user_id: u_id
                        });
                    });
                    jQuery.ajaxSetup({async:true});
                });
            }
            $('#qrcode-container').hide();
            $("#dv_add_remove_class").removeClass('col-lg-12');
            $("#dv_add_remove_class").addClass('col-lg-8');
            $("#dv_lab_rec_history").show();
        }
        else
            message('Record does not exists with this lab number', false);
    }).fail(function(err) {
        console.log("Error loading data");
        console.log(err);
        message('Something went wrong', false);
    });
}


function select_circle(element) {
    $('.btn-circle').removeClass('border_orange');
    $('.btn-circle').siblings('.process_label').removeClass('bg_orange');
    $('.btn-circle').find('svg').css({
        'fill': '#56c0ef'
    });
    
    $(element).addClass('border_orange');
    $(element).siblings('.process_label').addClass('bg_orange');
    $(element).find('svg').css({
        'fill': '#fbbc34'
    });
}

function select_status(val, element) {
    select_circle(element);
    current_status = val;
    var qr_code = $("#qr-code-input").val();
    if (qr_code.trim().length != 0) {
        $.post(_base_url+'tracking/update_track_status', {
            lab_number: qr_code,
            status: current_status,
            [csrf_token_name]: csrf_cookie
        }, function(data) {
            console.log(data);
            if (data.status == 'success') {
                message('Track Status Updated', true);
                update_record_history_table(qr_code);
            }else{
                message('Record with this lab number does not exists', false);
            }
        }).fail(function(err) {
            console.log(err);
            message('Track Status Cannot be updated at the moment', false);
        });
    }
    else{
        message('Enter QR code', true);
    }
}

$(() => {

    const params = new URLSearchParams(window.location.search);
    if (params.has('search')) {
        let term = params.get('search');
        update_record_history_table(term);
    }

    // Laboratory Track script
    /*$("#qr-code-input").focus();
    $("#qr-code-input").on('change', function() {
        var qr_code = $(this).val();
        update_record_history_table(qr_code);
        

        console.log("current_status", current_status);
        if (current_status != null) {
            
            console.log("Reached this line");
            $.post(_base_url+'tracking/update_track_status', {
                lab_number: qr_code,
                status: current_status,
                [csrf_token_name]: csrf_cookie
            }, function(data) {
                console.log(data);
                
                if (data.status == 'success') {
                     
                    message('Track Status Updated', true);
                }else{
                    message('Record with this lab number does not exists', false);
                }
            }).fail(function(err) {
                console.log(err);
                message('Track Status Cannot be updated at the moment', false);
            });
        }
        $(this).focus();
    });*/


    var lab_suggestion = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.whitespace,
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: _base_url + 'tracking/get_lab_numbers',
    });

    // init Typeahead
    $('#qr-code-input').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        name: 'lab_numbers',
        source: lab_suggestion // suggestion engine is passed as the source
    });

    $.ajax({
        url: _base_url + 'tracking/get_lab_numbers',
        success: function(data) {
            $("#qr-code-input").on('keyup', function() {
                let val = $(this).val();
                $(".not-found-qr").html("");
                $("#qr-code-input").removeClass('is-invalid');
                if (typeof val !== 'string') {return}
                if (val.trim().length === 0) return;
                val = val.trim();
                let found = false;
                for (let d of data) {
                    if (d.startsWith(val)) {
                        found = true;
                        break;
                    }
                }
                if (!found) {
                    $("#qr-code-input").addClass('is-invalid');
                    $(".not-found-qr").html("Record not found");
                } 
            })     
        },
    });
	
});

$("#qr-code-input").focus();
$(document).on('click', '.tt-suggestion', function(){ 
       var qr_code = $("#qr-code-input").val();
        update_record_history_table(qr_code);
        
        if (current_status != null) {
            
            console.log("Reached this line");
            $.post(_base_url+'tracking/update_track_status', {
                lab_number: qr_code,
                status: current_status,
                [csrf_token_name]: csrf_cookie
            }, function(data) {
                console.log(data);
                
                if (data.status == 'success') {
                     
                    message('Track Status Updated', true);
                }else{
                    message('Record with this lab number does not exists', false);
                }
            }).fail(function(err) {
                console.log(err);
                message('Track Status Cannot be updated at the moment', false);
            });
        }
        $(this).focus();
});