function embed_document(file_name){
    var embed_div = document.getElementById('doc_embed');
    embed_div.innerHTML="";
    embed_div.innerHTML = "<embed src='"+file_name+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";

}

function add_req_from_to_detail(title, ident_type) {

    var identifier_type = ident_type;
    var modal_title = title;

    document.getElementById('add_req_from_title').innerText = modal_title;
    document.getElementById('add_ident_type').value = identifier_type;

}

function edit_req_from_to_detail(id) {
    var baseurl = '<?php echo base_url(); ?>';
    var edit_id = id;
    var identifier_type = document.getElementById('edit_ident_type' + id).value;
    var modal_title = (identifier_type==="from"?'Edit Request From Detail':'Edit Request To Detail')
    var ident_name = document.getElementById('edit_ident_name' + id).value;
    var ident_contact = document.getElementById('edit_ident_contact' + id).value;
    var ident_email = document.getElementById('edit_ident_email' + id).value;
    var ident_logo = document.getElementById('edit_ident_logo' + id).value;
    var ident_address = document.getElementById('edit_ident_address' + id).value;
    var ident_type = document.getElementById('edit_ident_type' + id).value;
    var ident_post_code = document.getElementById('edit_ident_post_code' + id).value;
    var ident_city = document.getElementById('edit_ident_city' + id).value;
    var ident_country = document.getElementById('edit_ident_country' + id).value;
    var ident_logo_path = baseurl+ident_logo;

    document.getElementById('ed_req_title').innerText = modal_title;
    document.getElementById('ed_id').value = edit_id;
    document.getElementById('ed_ident_type').value = ident_type;
    document.getElementById('ed_identifier_name').value = ident_name;
    document.getElementById('ed_identifier_contact').value = ident_contact;
    document.getElementById('ed_identifier_email').value = ident_email;
    document.getElementById('ed_identifier_address').value = ident_address;
    document.getElementById('ed_identifier_post_code').value = ident_post_code;
    document.getElementById('ed_identifier_city').value = ident_city;
    document.getElementById('ed_identifier_country').value = ident_country;
    document.getElementById('ed_existing_logo').value = ident_logo_path;
    var img=document.createElement("img");
    img.src=ident_logo_path;
    img.id='ed_img';
    img.width=50;
    var elem_exists = document.getElementById('ed_img');
    if (typeof(elem_exists) != 'undefined' && elem_exists != null){
        removeImage('ed_img');
    }
    document.getElementById('logo_img_container').appendChild(img);
}

function removeImage(imageId) {
    var elementToBeRemoved = document.getElementById(imageId);
    elementToBeRemoved.parentNode.removeChild(elementToBeRemoved);
}


$(document).ready(function(){
    $("#doctor_advance_search").click(function(){
        $("#advance_search_table").slideToggle(500);
    })
});

$(() => {
    $("#search-specimen").on('keyup', function(event) {
        if (event.keyCode === 13) {
           let val = event.target.value;
           window.location.href = `${_base_url}tracking/laboratory_track?search=${encodeURI(val)}`;
        }
    });
});