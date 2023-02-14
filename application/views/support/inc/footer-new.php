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
<!-- Jquery UI -->
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
<!-- Tagsinput JS -->
<script src="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>
<!-- Task JS -->
<script src="<?php echo base_url('/assets/newtheme/js/html2pdf.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/task.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<!-- <script src="https://docraptor.com/docraptor-1.0.0.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->
<!-- <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script> -->
  <!-- Multiselect JS -->
<!-- Custom JS -->
<script src="<?php echo base_url('/assets/newtheme/js/app.js'); ?>"></script>
<script type="text/javascript">
    var further_request_base_url = '<?php echo base_url() ?>';
</script>
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
	$(document).ready(function() {
	    $('#specimen_selector').change(function(){
	        $('.colors').hide();
	        $('#' + $(this).val()).show();
	    });

	    $("#basic_screen_tests").hide();
		$("#bs_info").click(function() {
		    if($(this).is(":checked")) {
		        $("#basic_screen_tests").show(300);
		    } else {
		        $("#basic_screen_tests").hide(200);
		    }
		});
	});
</script>
<script>
  $(document).ready(function() {
        $("#sidebar-menu").find("a").click(function(event) {
            var loc = $(this).attr('href');
            if (loc != '#') {
                window.location.href = loc;
            }
        });

        // $("#qucikSearch li").hide();
    
        $('.qucikSearch li').each(function(i) {
		    $(this).attr('data-text', function() {
		      return $(this).text().toLowerCase();
		    });
		  });

		  $('#quickBox').on('input', function() {
		    $(".qucikSearch li").hide();
		    $('.qucikSearch li[data-text*="' + $.trim($(this).val().toLowerCase()) + '"]').show();

		  });

		  $('#quickBox').blur(function()
			{
			    if( $(this).val().length === 0 ) {
			        $(".qucikSearch li").show();
			    }
			});
		  $(".qucikSearch li a").click(function(){
		  	$(this).toggleClass("active");
		  });

		  $(".qucikSearch li a").on("click",function(){
				var textAnchor = $(this).parent().attr("data-text");
				var testCost = $(this).attr("data-sale");
				var testId = $(this).attr("data-test-id");
				strId = textAnchor.replace(/\s/g, '');


		  		if($(this).hasClass("active")){

		      // alert(textAnchor);
				var html = "<tr id="+strId+">";
				html +="<td>"+testId+"</td>";
				html +="<td>"+textAnchor+"</td>";
				html +="<td>4</td>";
				html +="<td>3</td>";
				html +="<td class='text-right'>"+testCost+"</td>";
				html +="</t>";
				$(".custom-table-search tbody").append(html);
		  		}
		  		else{
		  			$("#"+strId).remove();
		  		}

		  });
    });

</script>
<script type="text/javascript">
	$( "#myInput" )
	  .keyup(function() {
	    var value = $( this ).val();
	    $( "#divID" ).text( value );
	  })
	  .keyup();
	  $( "#myInput2" )
	  .keyup(function() {
	    var value = $( this ).val();
	    $( "#divID2" ).text( value );
	  })
	  .keyup();

	  // $(".specimen_list li a").click(function(){
	  // 	$(".specimen_list li a").removeClass("active");
	  // 	$(this).addClass("active");
	  // });
</script>

<!-- <script type="text/javascript">
	$(document).ready(function(){
		var doc = new jsPDF();
		var specialElementHandlers = {
		    '#editor': function (element, renderer) {
		        return true;
		    }
		};

		$('#save_as_pdf').click(function () {
		    doc.fromHTML($('#print_section').html(),5,5,{
		        // 'width': 700,
		        'elementHandlers': specialElementHandlers
		    });
		    doc.save('sample-file.pdf');
		});
		
	})
	
</script> -->

<script>
      function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("print_section");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save('further_request');
      }
      function generatePDF2() {
      	
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("print_section_new");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save('further_request_nnh');
      }

      $(document).ready(function(){
	       // $('#myInput').select2({ tags: [<?php echo $lab_number;?>] });
	        $('#myInput').select2({
			  multiple: true,
			  placeholder: 'Select Lab ID'		  
			  //templateResult: show
			});
	    })
		 $("#myInput").on('select2:select', function () {
        var hid = $(this).val();
        
		//alert(hid);
		show();
		
		//hideUserCard();
        $(".myInput").each(function () {/*
            let hosp_data_arr = $(this).data('hospital');
            if ($.inArray(hid, hosp_data_arr) != -1) {
                $(this).val(hid).trigger('change');
                $(this).show();
            }
        */});
    });
		
function show()
{
	$("#div0").show();
	$("#div1").show();
	$("#div2").show();
	$("#div3").show();
} 
    </script>

</html>