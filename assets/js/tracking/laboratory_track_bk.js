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
    var row = $("<tr></tr>");
    row.append('<td>'+data['ref']+'</td>');
    row.append('<td>'+data['date']+'</td>');
    row.append('<td>'+data['time']+'</td>');
    row.append('<td>'+data['status']+'</td>');
    row.append('<td>'+data['user_id']+'</td>');
    $("#record-history-table").find('tbody').append(row);
    $("#qr-code-input").focus();
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


function update_record_history_table(qr_code) {
    $.get(_base_url+`tracking/get_record_history?lab_number=${encodeURIComponent(qr_code)}`, function(data) {
        if (data.status == 'success') {
            
            
            message('Record found', true);
            add_qr_code(qr_code);
            if (data.history.length == 0) {
                 $("#dv_add_remove_class").removeClass('col-lg-8');
                    $("#dv_add_remove_class").addClass('col-lg-12');
                    $("#dv_lab_rec_history").hide();
                
                $("#record-history-table-heading").html('No Recorded History');
            }else{
                console.log(data.track_status);
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
                        var dt = d.calendar();
                        var tm = d.format("mm:hh a");
                        add_table_data({
                            ref: history['ura_rec_history_id'],
                            date: dt,
                            time: tm,
                            status: status,
                            user_id: u_id
                        });
                    });
                });
            }
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
    $("#qr-code-input").focus();
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
    });


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