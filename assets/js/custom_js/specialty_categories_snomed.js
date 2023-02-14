function hideAllRows() {
   $(".code_row").hide();
   $("#hid_cat_id").val("").trigger('change');
   $("#hid_sub_cat_id").val("").trigger('change');
   $("#hid_is_sub_cat").val("").trigger('change');
   $("#id_code").prop('disabled', false);
   $(".schedule_type").prop('disabled', false);
   $("#week_name").prop('disabled', false);
   $("#days").prop('disabled', false);
   $("#btn_add_code").prop('disabled', false);
}

function setSnomedCodes(identifier, sub_cat){   
   hideAllRows();
   $('#categories_list').find('li').removeClass('active');
   $(identifier).parent('li').addClass('active');
   var cat_id = $(identifier).data('cat-id');
   var sub_cat_id = $(identifier).data('subcat-id');
   $("#hid_cat_id").val(cat_id).trigger('change');
   $("#hid_sub_cat_id").val(sub_cat_id).trigger('change');
   $("#hid_is_sub_cat").val(sub_cat).trigger('change');
   localStorage.setItem('cid', cat_id);

   //
   // $(`[data-lscat-id="${cat_id_get}"]`).show();
   if(cat_id==0){
      $('.code_row').filter('[data-lscatall="'+cat_id+'"]').show();
      $("#id_code").prop('disabled', true);
      $(".schedule_type").prop('disabled', true);
      $("#week_name").prop('disabled', true);
      $("#days").prop('disabled', true);
      $("#btn_add_code").prop('disabled', true);
   }else{
      $('.code_row').filter('[data-lscat-id="'+cat_id+'"][data-lssubcat-id="'+sub_cat_id+'"]').show();
   }
}

$("#add_codes_form").on('submit', function(event) {
   event.preventDefault();
   document.getElementById('id_code').style.borderColor = "green";
   var form_data = $("#add_codes_form").serialize();
   var _base_url = $("#base_url").val();
   var code_value = $("#id_code").val();
   var error = false;
   if (code_value.trim().length === 0) {
      error = true;
      document.getElementById('id_code').style.borderColor = "red";
   }
   if (error) {
      return;
   }

   $.ajax({
      url: _base_url+'Department/add_lab_snomed_codes',
      method: 'POST',
      data: form_data,
      dataType: "json",
      success: function (data) {
         if(data['status']=='success'){
            message(data['msg'], "success");
            console.log(data['msg']);
            window.setTimeout(function() {
               location.reload()
            }, 2000);
         }else{
            console.log('Something not right');
         }

      },
      error: function (req, status, err) {
         if (req.status === 400) {
            message(req.responseJSON.errors, "warning");
         } else {
            message("Some error occurred, Try again later", "important");
         }
         console.log(req.responseJSON);
         console.log(status);
         console.log(err);
      }
   });
});

$("#id_code").keyup(function() {
   var input = $(this);

   if( input.val() == "" ) {
      input.css( "border", "1px solid red");
      $("#btn_add_code").prop('disabled', true);
   }else{
      input.css( "border", "1px solid green");
      $("#btn_add_code").prop('disabled', false);
   }
});


$(document).on('click', '.schedule_type', function (){
   if($(this).val() == 'weekly'){
      $(document).find('#weekly_option').show();
      $(document).find('#day_option').hide();
      $(document).find('#edit_weekly_option').show();
      $(document).find('#edit_day_option').hide();
   }
   if($(this).val() == 'days'){
      $(document).find('#day_option').show();
      $(document).find('#weekly_option').hide();
      $(document).find('#edit_day_option').show();
      $(document).find('#edit_weekly_option').hide();
   }
});


$(document).find('.numberonly').keypress(function (e) {
   var charCode = (e.which) ? e.which : event.keyCode
   if (String.fromCharCode(charCode).match(/[^0-9]/g))
      return false;
});