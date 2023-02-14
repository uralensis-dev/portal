<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
	
</body>

<!--Full Calendar JS Files-->

<!-- Fancy box-->

<!-- new theme javascript jquery -->
	<!-- jQuery -->
      <script src="<?php echo base_url('/assets/newtheme/js/jquery-3.2.1.min.js'); ?>"></script>
      <script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
		
		<!-- Bootstrap Core JS -->
       <script src="<?php echo base_url('/assets/newtheme/js/popper.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/newtheme/js/bootstrap.min.js'); ?>"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?php echo base_url('/assets/newtheme/js/jquery.slimscroll.min.js'); ?>"></script>
		
		
		

<!-- Select2 JS -->
            <script src="<?php echo base_url('/assets/newtheme/js/select2.min.js'); ?>"></script>
		
		<!-- Datetimepicker JS -->
		<script src="<?php echo base_url('/assets/newtheme/js/moment.min.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/newtheme/js/bootstrap-datetimepicker.min.js'); ?>"></script>
		

        
		<!-- Datatable JS -->
		<script src="<?php echo base_url('/assets/newtheme/js/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/newtheme/js/dataTables.bootstrap4.min.js'); ?>"></script>
        <?php $this->load->view("session");?>
        <!-- Slimscroll JS -->
        <script src="<?php echo base_url('/assets/newtheme/js/jquery.slimscroll.min.js'); ?>"></script>
<!-- Datetimepicker JS -->
        <script src="<?php echo base_url('/assets/newtheme/js/moment.min.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/newtheme/js/bootstrap-datetimepicker.min.js'); ?>"></script>
		
		<!-- Tagsinput JS -->
		<script src="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>
        
<!-- Task JS -->
<script src="<?php echo base_url('/assets/newtheme/js/task.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>

<script src="<?php echo base_url('/assets/js/moment-with-locales.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="<?php echo base_url('/assets/js/underscore.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/plupload.full.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.idle.min.js'); ?>"></script>
<!--Full Calendar JS Files-->
<script src="<?php echo base_url('/assets/fullcalendar/core/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/fullcalendar/daygrid/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/fullcalendar/interaction/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.blockUI.js'); ?>"></script>

<script src="<?php echo base_url('/assets/newtheme/plugins/sticky-kit-master/dist/sticky-kit.min.js'); ?>"></script>
<!-- Custom JS -->
<script src="<?php echo base_url('/assets/newtheme/js/app.js'); ?>"></script>

<?php
if(!empty($javascripts)){
    foreach ($javascripts as $value) {
        ?>
        <script src="<?php echo base_url();?>assets/<?php echo $value;?>"></script>
        <?php
    }
}
?>


<script>
 function creatgroup()
 {
   $.ajax({
   url:"<?php echo base_url(); ?>chat/creatgroup",
   method:"POST",
   dataType: "json",
   data:{"groupname":$("#group_name").val()},
   dataType:"json",
   success:function(data)
   {
     alert(data.msg);
     window.setTimeout(function () {
                            location.reload()
                        }, 2000);
    
   }
  })
 }

 



		$(".header").stick_in_parent({
			
		});
		// This is for the sticky sidebar    
		$(".stickyside").stick_in_parent({
			offset_top: 60
		});
		$('.stickyside a').click(function() {
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 60
			}, 500);
			return false;
		});
		// This is auto select left sidebar
		// Cache selectors
		// Cache selectors
		var lastId,
			topMenu = $(".stickyside"),
			topMenuHeight = topMenu.outerHeight(),
			// All list items
			menuItems = topMenu.find("a"),
			// Anchors corresponding to menu items
			scrollItems = menuItems.map(function() {
				var item = $($(this).attr("href"));
				if (item.length) {
					return item;
				}
			});

		// Bind click handler to menu items


		// Bind to scroll
		$(window).scroll(function() {
			// Get container scroll position
			var fromTop = $(this).scrollTop() + topMenuHeight - 250;

			// Get id of current scroll item
			var cur = scrollItems.map(function() {
				if ($(this).offset().top < fromTop)
					return this;
			});
			// Get the id of the current element
			cur = cur[cur.length - 1];
			var id = cur && cur.length ? cur[0].id : "";

			if (lastId !== id) {
				lastId = id;
				// Set/remove active class
				menuItems
					.removeClass("active")
					.filter("[href='#" + id + "']").addClass("active");
			}
		});
		

$(document).ready(function(){

   setInterval(function(){
    
 var group_id = $("#group_ids").val().split(",");

  $.each(group_id,function(i){
    if(group_id[i]!=""){
       load_chat_data_group(group_id[i]);

    }
});
 }, 5000);

  

 function loading()
 {
  var output = '<div align="center"><br /><br /><br />';
  output += '<img src="<?php echo base_url(); ?>asset/loading.gif" /> Please wait...</div>';
  return output;
 }

 $(document).on('click', '#search_button', function(){
  var search_query = $.trim($('#search_user').val());
  $('#search_user_area').html('');
  if(search_query != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>chat/search_user",
    method:"POST",
    data:{search_query:search_query},
    dataType:"json",
    beforeSend:function()
    {
    // $('#search_user_area').html(loading());
     $('#search_button').attr('disabled', 'disabled');
    },
    success:function(data)
    {
     $('#search_button').attr('disabled', false);
     var output = '<hr />';
     var send_userid = "<?php echo $this->session->userdata('user_id'); ?>";
     if(data.length > 0)
     {
      for(var count = 0; count < data.length; count++)
      {
       output += '<div class="row">';
       output += '<div class="col-md-7"><img src="'+data[count].profile_picture+'" class="img-circle" width="40" /> <small>'+data[count].first_name+' '+data[count].last_name+'</small></div>';
       if(data[count].is_request_send == 'yes')
       {
        output += '<div class="col-md-5"><button type="button" name="request_button" class="btn btn-warning btn-xs">Request Sended</button></div>';
       }
       else
       {
        output += '<div class="col-md-5"><button type="button" name="request_button" class="btn btn-success btn-xs request_button" id="request_button'+data[count].user_id+'" data-receiver_userid="'+data[count].user_id+'" data-send_userid="'+send_userid+'">Send Request</button></div>';
       }
       output += '</div><hr />';
      }
     }
     else
     {
      output += '<div align="center"><b>No Data Found</b></div>';
     }
     output += '</div>';
     $('#search_user_area').html(output);
    }
   })
  }
 });

 $(document).on('click', '.request_button', function(){
  var id = $(this).attr('id');
  var receiver_userid = $(this).data('receiver_userid');
  var send_userid = $(this).data('send_userid');
  $.ajax({
   url:"<?php echo base_url(); ?>chat/send_request",
   method:"POST",
   data:{receiver_userid:receiver_userid, send_userid:send_userid},
   beforeSend:function()
   {
    $('#'+id).attr('disabled', 'disabled');
   },
   success:function(data)
   {
    $('#'+id).attr('disabled', false);
    $('#'+id).removeClass('btn-success');
    $('#'+id).addClass('btn-warning');
    $('#'+id).text('Request Sended');
   }
  })
 })

 load_notification();

 function load_notification()
 {
  $.ajax({
   url:"<?php echo base_url(); ?>chat/load_notification",
   method:"POST",
   data:{action:'load_notification'},
   dataType:"json",
   beforeSend:function()
   {
    //$('#notification_area').html(loading());
   },
   success:function(data)
   {
    var output = '<hr />';
    //console.log(data.length);
    if(data.length > 0)
    {
     for(var count = 0; count < data.length; count++)
     {
      output += '<div class="row"><div class="col-md-7"><img src="'+data[count].profile_picture+'" class="img-circle" width="35" /> ' + data[count].first_name + ' ' +data[count].last_name + '</div>';

      output += '<div class="col-md-5"><button type="button" name="accept_button" class="btn btn-success btn-xs accept_button" id="accept_button'+data[count].user_id+'" data-chat_request_id="'+data[count].chat_request_id+'">Accept</button></div><hr />';
     }
    }
    else
    {
     output += '<div align="center"><b>No Data Found</b></div>';
    }
    //output += '</div><hr />';
    $('#notification_area').html(output);
   }
  }) 
 }

 $(document).on('click', '.accept_button', function(){
  var id = $(this).attr('id');
  var chat_request_id = $(this).data('chat_request_id');
  $.ajax({
   url:"<?php echo base_url(); ?>chat/accept_request",
   method:"POST",
   data:{chat_request_id:chat_request_id},
   beforeSend:function()
   {
    $('#'+id).attr('disabled','disabled');
   },
   success:function(data)
   {
    $('#'+id).attr('disabled', false);
    $('#'+id).removeClass('btn-success');
    $('#'+id).addClass('btn-warning');
    $('#'+id).text('Accepted');
   }
  })
 });

 load_chat_user();



 function load_chat_user()
 {
  $.ajax({
   url:"<?php echo base_url(); ?>chat/load_chat_user",
   method:"POST",
   data:{action:'load_chat_user'},
   dataType:'json',
   beforeSend:function()
   {
    //$('#chat_user_area').html(loading());
   },
   success:function(data)
   {
    var output = '';
    if(data.length > 0)
    {
     var receiver_id_array = '';
     for(var count = 0; count < data.length; count++)
     {
        // var username =   data[count].first_name + ' ' + data[count].last_name;

         output +='<li><a href="javascript:void(0)" class="list-group-item user_chat_list" data-receiver_id="'+data[count].receiver_id+'"><span class="chat-avatar-sm user-img"><img class="rounded-circle" alt="" src="'+data[count].profile_picture+'"><span id="onlinestat_'+data[count].receiver_id+'" class="status online"></span></span><span class="chat-user">' + data[count].first_name + ' ' + data[count].last_name+'</span> <span id="badge_'+data[count].receiver_id+'" class="badge badge-pill bg-danger"></span></a><span id="chat_notification_'+data[count].receiver_id + '"></span><span id="type_notifitcation_'+data[count].receiver_id+'"></span></li>';
    

     // output += ' <i class="offline" id="online_status_'+data[count].receiver_id+'" style="float:right;">&nbsp;</i></a>';

      receiver_id_array += data[count].receiver_id + ',';
     }
     $('#hidden_receiver_id_array').val(receiver_id_array);
    }
   
   // output += '</div>';
    $('#chat_user_area').append(output);
   }
  })
 }

 var receiver_id;

 $(document).on('click', '.user_chat_list', function(){
  $('#send_chat').attr('disabled', false);
  receiver_id = $(this).data('receiver_id');
  var receiver_name = $(this).text();
  var html = '<a href=javascript:" title="'+receiver_name+'"><span>'+receiver_name+'</span> <i class="typing-text" id="notification_typing"></i></a>';
  $('#dynamic_title').html(html);
  load_chat_data(receiver_id, 'yes');
 });
var input = document.getElementById("chat_message_area");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
var chat_message = $.trim($('#chat_message_area').val());
  //alert(chat_message);
  if(chat_message != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>chat/send_chat",
    method:"POST",
    data:{receiver_id:receiver_id, chat_message:chat_message},
    beforeSend:function()
    {
        $('#chat_message_area').val("");
     $('#send_chat').attr('disabled','disabled');
    },
    success:function(data)
    {

     $('#send_chat').attr('disabled', false);
     $('#chat_message_area').val('');
   //  var html = '<div class="col-md-10 alert alert-warning">';
     html += chat_message;
    // html += '</div>';
     $('#chat_body').append(html);
     $('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
    }
   });
  }
  else
  {
   alert('Type Something in chat box');
  }
  }
});


//group chat
$(document).on('click', '.group_chat_btn', function(){


 var id = $(this).attr('id');

 var chat_message = $.trim($('#chat_message_area_group_'+id).val());
 load_chat_data_group(id);
  //alert(chat_message);
  if(chat_message != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>chat/send_chat_group",
    method:"POST",
    data:{"group_id":id, chat_message:chat_message},
    dataType:"json",
    beforeSend:function()
    {
        $('#chat_message_area_group_'+id).val("");
     $('#send_chat_group_'+id).attr('disabled','disabled');
    },
    success:function(data)
    {
     


       var html = '';
   
          html+='<div class="chat chat-left"><div class="chat-body"><div class="chat-bubble"><div class="chat-content"><p>'+data[0].message+'</p><span class="chat-time">'+data[count].timedate+'</span>';
         html+='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         html+='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>';
     
     
    // html += data[count].chat_messages_text + '</div></div>';
     $('#group_chat_body_'+data[0].group_id).append(html);
    
    
   

   
        /* html='<div class="chat chat-left"><div class="chat-body"><div class="chat-bubble"><div class="chat-content"><p>'+chat_message+'</p><span class="chat-time"></span>';
         html+='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         html+='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>';
   

       $('#group_chat_body_'+data).append(html);
     $('#group_chat_body_'+data).scrollTop($('#group_chat_body_'+data)[0].scrollHeight);

     $('#send_chat_group_'+data).attr('disabled', false);
     $('#chat_message_area_group_'+data).val('');*/
   
   
    }
   });
  }
  else
  {
   alert('Type Something in chat box');
  }
})


//group chat
         
 $(document).on('click', '#send_chat', function(){
  var chat_message = $.trim($('#chat_message_area').val());
  //alert(chat_message);
  if(chat_message != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>chat/send_chat",
    method:"POST",
    data:{receiver_id:receiver_id, chat_message:chat_message},
    beforeSend:function()
    {
        $('#chat_message_area').val("");
     $('#send_chat').attr('disabled','disabled');
    },
    success:function(data)
    {

     $('#send_chat').attr('disabled', false);
     $('#chat_message_area').val('');
   //  var html = '<div class="col-md-10 alert alert-warning">';
     html += chat_message;
    // html += '</div>';
     $('#chat_body').append(html);
     $('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
    }
   });
  }
  else
  {
   alert('Type Something in chat box');
  }
 });

 function load_chat_data(receiver_id, update_data)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>chat/load_chat_data",
   method:"POST",
   data:{receiver_id:receiver_id, update_data:update_data},
   dataType:"json",
   success:function(data)
   {
    var html = '';
    for(var count = 0; count < data.length; count++)
    {
    
     if(data[count].message_direction == 'right')
     {
         html+='<div class="chat chat-right"><div class="chat-body"><div class="chat-bubble"><div class="chat-content"><p>'+data[count].chat_messages_text+'</p><span class="chat-time">'+data[count].chat_messages_datetime+'</span>';
         html+='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         html+='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>'
     // html += '<div align="left"><span class="text-muted"><small><b>'+data[count].chat_messages_datetime+'</b></small></span></div>';

     // html += '<div class="col-md-10 alert alert-warning">';
     }
     else
     {
          html+='<div class="chat chat-left"><div class="chat-body"><div class="chat-bubble"><div class="chat-content"><p>'+data[count].chat_messages_text+'</p><span class="chat-time">'+data[count].chat_messages_datetime+'</span>';
         html+='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         html+='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>'
     // html += '<div align="right"><span class="text-muted"><small><b>'+data[count].chat_messages_datetime+'</b></small></span></div>';
     // html += '<div class="col-md-2">&nbsp;</div>';
     // html += '<div class="col-md-10 alert alert-info">';
     }
    // html += data[count].chat_messages_text + '</div></div>';
    }
    $('#chat_body').html(html);
   // $('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
   }
  })
 }

 function load_chat_data_group(group_id)
 {
  $.ajax({
   url:"<?php echo base_url(); ?>chat/load_chat_data_group",
   method:"POST",
   data:{"group_id":group_id, update_data:""},
   dataType:"json",
   success:function(data)
   {
    var html = '';
    for(var count = 0; count < data.length; count++)
    {
    
     if(data[count].message_direction == 'right')
     {
         html+='<div class="chat chat-right"><div class="chat-body"><div class="chat-bubble"><div class="chat-content"><p>'+data[count].chat_messages_text+'</p><span class="chat-time">'+data[count].chat_messages_datetime+'</span>';
         html+='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         html+='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>';
    
     }
     else
     {
          html+='<div class="chat chat-left"><div class="chat-body"><div class="chat-bubble"><div class="chat-content"><p>'+data[count].chat_messages_text+'</p><span class="chat-time">'+data[count].chat_messages_datetime+'</span>';
         html+='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         html+='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>';
    
     }
    // html += data[count].chat_messages_text + '</div></div>';
    var id= data[count].group_id;
    }
     $('#group_chat_body_'+id).html(html);
   
   // $('#chat_body').scrollTop($('#chat_body')[0].scrollHeight);
   }
  })
 }


 setInterval(function(){
    
  if(receiver_id > 0)
  {
   load_chat_data(receiver_id, 'yes');
  }
  check_chat_notification(receiver_id);
 }, 5000);

 function check_chat_notification(receiver_id)
 {
     load_notification();
  var user_id_array = $('#hidden_receiver_id_array').val();

  ///
  var is_type = 'no';
   
  if(receiver_id > 0)
  {
     
   if($('#chat_message_area').val() != '')
   {
     
    is_type = 'yes';
   }
  }
  ///

  $.ajax({
   url:"<?php echo base_url(); ?>chat/check_chat_notification",
   method:"POST",
   data:{user_id_array:user_id_array, is_type:is_type, receiver_id:receiver_id},
   dataType:"json",
   success:function(data)
   {
    if(data.length > 0)
    {
     for(var count = 0; count < data.length; count++)
     {
      var html = '';
      if(data[count].total_notification > 0)
      {
       if(data[count].user_id != receiver_id)
       {
       // html = '<span class="notification_circle">'+data[count].total_notification+'</span>';
        html = data[count].total_notification;

       }
      }
      console.log(data[count].status);

      if(data[count].status == 'online')
      {
       console.log('online_status_'+data[count].user_id);
       $('#onlinestat_'+data[count].user_id).addClass('online');
       $('#onlinestat_'+data[count].user_id).removeClass('offline');
       //
       if(data[count].is_type == 'yes')
       {
        $('#notification_typing').html('<i><small>Typing</small></i>');
       }
       else
       {
        $('#notification_typing').html('');
       }
      }
      else
      {
       $('#onlinestat_'+data[count].user_id).addClass('offline');

       $('#onlinestat_'+data[count].user_id).removeClass('online');

       //
       $('#type_notifitcation_'+data[count].user_id).html('');
      }

      $('#badge_'+data[count].user_id).html(html);
     }
    }
   }
  })
 }

});
</script>
</html>