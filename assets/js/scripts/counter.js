var get_counter = function(){
    $.get(site_url+'laboratory/get_counter', {'user_id' : user_id },function(data){
        $('#unreported_counter').html(data['unreported']);
        $('#reported_counter').html(data['reported']);
        $('#further_work_counter').html(data['further_work']);        
        $('#notification_counter').html(data['notification']);
    }, 'JSON');    
    
}

var get_enquiry_counter = function(){
    $.get(site_url+'labEnquiries', {'return_type' : 'counts', 'status': 'open' },function(data){        
        $('#enquiry_count').html(data['enquiry_count']);        
    }, 'JSON');    
    
}
$(document).ready(function(){ 
    $('img').each(function() {        
        if ( !this.complete || typeof this.naturalWidth == "undefined" ||  this.naturalWidth == 0) {                    
            this.src = site_url+'assets/img/default.jpg';
        }
    });

    setTimeout(function(){
        get_counter();        
        get_enquiry_counter();
    },200);    

    setInterval(function () {
        get_counter(); 
        get_enquiry_counter();
    }, 7000);
})