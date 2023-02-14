$(document).ready(function () {
   
    
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
  
   $('#myInput').select2({
			  multiple: true,
			  tags: "true"
			});
                        
   $('#myInputBlock').select2({
			  multiple: true,
			  tags: "true"
			});
    
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

		  /*$(".qucikSearch li a").on("click",function(){
				var textAnchor = $(this).parent().attr("data-text");
				strId = textAnchor.replace(/\s/g, '');
                var reasonsOfRequest = $("#request_reasons").val();

		  		if($(this).hasClass("active")){

		      // alert(textAnchor);
				var html = "<tr id="+strId+">";
				html +="<td>NPOOO1</td>";
				html +="<td></td>";
				html +="<td>"+textAnchor+"</td>";
				html +="<td>Specimen"+strId+"</td>";
				html +="<td>1</td>";
				html +="<td class='text-right'>20</td>";
				html +="</t>";
                                
				$(".custom-table-search tbody").append(html);
		  		}
		  		else{
		  			$("#"+strId).remove();
		  		}

		  });*/


    
    var modal_select_spcimen = $('#modal-select-spcimen').select2({
        placeholder: 'Select Specimen',
        width: '100%'
    });
    var modal_select_block = $('#modal-select-block').select2({
        placeholder: 'Select Block',
        width: '100%'
    });


    //Toggle Checkboxes
    $('input.check-all-childrens').click(function () {
        // && is_block_selected()
        if (is_specimen_selected()) {
            let checkboxes = $(this).closest('div.panel-default').find('input.test-record');
            if (checkboxes.length > 0) {
                $.each(checkboxes, function (index, checkbox) {
                    $(checkbox).trigger('click');
                });
            }
        } else {
            $(this).prop("checked", false);
           // alert('Please select Specimen and Block first!');
        }
    });


    $('li.speci-list > ul > li.list-inline-item').click(function () {
        if (selected_tests.length > 0) {
            reset_selected_tests();
            selected_tests = [];
        }
        $(this).closest('li.speci-list').find(".inner_specimen").addClass('active');
        $(this).siblings('li.list-inline-item ').children('a').removeClass('active');
        $(this).closest('li.speci-list').siblings('li.list-inline-item ').children('a').removeClass('active');
        $(this).children('a').addClass('active');
        $(this).children('a').html($(this).children('a').html()).addClass('active');
    });

    function is_specimen_selected() {
        let selected_specimen = $('li.speci-list > ul > li.list-inline-item a.active');
        if (selected_specimen.length > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_selected_specimen() {
        let selected_specimen = $('li.speci-list > ul > li.list-inline-item a.active');
        if (selected_specimen.length > 0) {
            return selected_specimen;
        } else {
            return null;
        }
    }
    
    $('li#block-list > ul > li.list-inline-item').click(function () {
        // if(selected_tests.length > 0){
        //     if(confirm('Did you want to Select all the selected tests for this Block too?')){
        //         $(get_all_selected_tests()).trigger('click');
        //         $(this).children('a').addClass('active');
        //         $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
        //     }else{
        //         reset_selected_tests();
        //         $(this).children('a').addClass('active');
        //         $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
        //     }
        //
        // }else{
        //     $(this).siblings('li.list-inline-item').children('a').removeClass('active');
        //     $(this).children('a').addClass('active');
        //     $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
        // }
        if (selected_tests.length > 0) {
            reset_selected_tests();
        }
        $(this).siblings('li.list-inline-item').children('a').removeClass('active');
        $(this).children('a').addClass('active');
        $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
    });

    function is_block_selected() {
        let selected_block = $('li#block-list > ul > li.list-inline-item a.active');
        if (selected_block.length > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_selected_block() {
        let selected_block = $('li#block-list > ul > li.list-inline-item a.active');
        if (selected_block.length > 0) {
            return selected_block;
        } else {
            return null;
        }
    }


    var selected_tests = [];
    $('input.test-record, a.test-record').on('click', function (e) {
        // e.preventDefault();
        // && is_block_selected()
        if (is_specimen_selected()) {
            let specimen = get_selected_specimen();
            let block = get_selected_block();
            let test_record = {
                'specimen_id': $(specimen).data('specimen-id'),
                'specimen_text': $(specimen).data('specimen-text'),
                // 'block_id': $(block).data('block-id'),
                'block_text': $(specimen).data('block-text'),
                'test_id': $(this).data('test-id'),
                'test_name': $(this).data('test-name'),
                'test_cost': $(this).data('cost'),
                'test_sale': $(this).data('sale'),

            };

            let search_result = search_test(test_record, selected_tests);

            if (search_result > -1) {
                selected_tests.splice(search_result, 1);
                remove_record(test_record);
                if ($(this).is('input')) {
                    $(this).prop("checked", false);
                } else if ($(this).is('a')) {
                    $(this).removeClass('active');
                }
            } else {
                selected_tests.push(test_record);
                insert_record(test_record);
                if ($(this).is('input')) {
                    $(this).prop("checked", true);
                } else if ($(this).is('a')) {
                    $(this).addClass('active');
                }
            }

            // console.log(selected_tests, search_result);


        } else {
            $(this).prop("checked", false);
           // alert('Please select Specimen and Block first!');
        }
    });

    function insert_record(record) {
        let record_id = generate_record_id(record);
        var lab_number = $("#lab_number").val();
        var html = "<tr id=" + record_id + ">";
        html += "<td>" + lab_number + "</td>";
        html += "<td>Patient</td>";
        html += "<td>" + record.test_name + "</td>";
        html += "<td>" + record.specimen_text + "</td>";
        html += "<td>" + record.block_text + "</td>";
       // html += "<td class='text-right'>" + record.test_cost + "</td>";
        html += "</tr>";
        $(".custom-table-search tbody").append(html);
    }

    function remove_record(record) {
        let record_id = generate_record_id(record);
        $(".custom-table-search tbody tr[id='" + record_id + "']").remove();
    }

    function generate_record_id(record) {
        return record.specimen_id + '-' + record.test_id;
    }

    function search_test(test_object, array_selected_tests) {
        for (var i = 0; i < array_selected_tests.length; i++) {
            if (array_selected_tests[i].specimen_id == test_object.specimen_id && array_selected_tests[i].block_id == test_object.block_id && array_selected_tests[i].test_id == test_object.test_id) {
                return i;
            }
        }
    }

    function get_all_selected_tests() {
        return $('input.test-record:checked, a.test-record.active');
    }

    function reset_selected_tests() {
        var specimenId = $(".list-inline-item ul > li.list-inline-item a.active").data('specimen-id');
        let selected_tests = get_all_selected_tests();
        $.each(selected_tests, function (index, test) {
            var testId = $(test).data('test-id');
            var tableId = specimenId + '-' + testId;
            $("#" + tableId).remove();
            if ($(test).is('input')) {
                $(test).prop("checked", false);
            } else if ($(test).is('a')) {
                $(test).removeClass('active');
            }
        });
    }

    $('#myModal').on('show.bs.modal', function (e) {
        if (selected_tests.length > 0) {
            let specimen_options = $('li#speci-list > ul > li.list-inline-item a');
            let block_options = $('li#block-list > ul > li.list-inline-item a');

            if (specimen_options.length > 0) {
                $.each(specimen_options, function (index, option) {
                    if (!$(option).hasClass('active')) {
                        let data = {
                            id: $(option).data('specimen-id'),
                            text: $(option).data('specimen-text')
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        modal_select_spcimen.append(newOption);
                    }
                });
                modal_select_spcimen.trigger('change');
            }

            if (block_options.length > 0) {
                $.each(block_options, function (index, option) {
                    if (!$(option).hasClass('active')) {
                        let data = {
                            id: $(option).data('block-id'),
                            text: $(option).data('block-text')
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        modal_select_block.append(newOption);
                    }
                });
                modal_select_block.trigger('change');
            }
        } else {
            e.preventDefault();
            alert("First Select Test");
        }

    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        modal_select_spcimen.empty();
        modal_select_spcimen.trigger('change');
        modal_select_block.empty();
        modal_select_block.trigger('change');
    });

    $('#auto-repeat').click(function () {
        let modal_selected_specimen = $(modal_select_spcimen).select2('data');
        let modal_selected_block = $(modal_select_block).select2('data');
        console.log('hi', modal_selected_specimen, modal_selected_block);

        if (selected_tests.length > 0) {
            $.each(selected_tests, function (index, test) {
                let test_record = {
                    'specimen_id': modal_selected_specimen[0].id,
                    'specimen_text': modal_selected_specimen[0].text,
                    'block_id': modal_selected_block[0].id,
                    'block_text': modal_selected_block[0].text,
                    'test_id': test.test_id,
                    'test_name': test.test_name,
                    'test_cost': test.test_cost,
                    'test_sale': test.test_sale,
                };

                let search_result = search_test(test_record, selected_tests);

                if (typeof search_result == 'undefined') {
                    selected_tests.push(test_record);
                    insert_record(test_record);
                }

            })
        }
    });

    $("#myInput").on("keyup", function () {
        $("#divID").text($(this).val());
    });
    
    $("#myInput2").on("keyup", function () {
        $("#divID2").text($(this).val());
    });

    function processFormData(formData, selected_tests) {
        var data = formData;
        $.each(selected_tests, function (index, test) {
            formData.push(
                {name: 'specimen_id[]', value: test.specimen_id},
                {name: 'specimen_text[]', value: test.specimen_text},
                {name: 'block_text[]', value: test.block_text},
                {name: 'test_id[]', value: test.test_id},
                {name: 'test_name[]', value: test.test_name},
                {name: 'test_cost[]', value: test.test_cost},
                {name: 'test_sale[]', value: test.test_sale}
            );
        });

        return formData;
    }

    $(".save-btn-furtherwork").on("click", function () {
        // var baseUrl = $("#baseUrl").val();
        // alert(baseUrl);
        // return false;
        var formData = $("#saveFurtherRequest").serializeArray();
        formData = processFormData(formData, selected_tests);
        $.ajax({
            url: `${_base_url}/doctor/save_further_request`,
            // url: baseUrl + "/doctor/save_further_request",
            type: "POST",
            dataType: 'json',
            async: false,
            data: formData,
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status === 'success') {
                    $('#add_leave_modal').modal('hide');
                    // $("#specimen_" + specimenId + " .block_table").append(response.data);
                    $.sticky(response.message, {
                        classList: 'success',
                        speed: 200,
                        autoclose: 7000
                    });
                    window.location.href = `${_base_url}/doctor/doctor_record_detail_old/${response.redirectId}`;
                    // window.location.href = baseUrl+'doctor/doctor_record_detail_old/'+response.redirectId;
                } else {
                    $.sticky(response.message, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 7000
                    });
                }
            }
        });
    });

    $('#myInput3').on('change', function (){
        var baseUrl = $("#baseUrl").val();
        let labID = $(this).val();
        if(labID > 0){
            getFurtherWorkTabView(labID); return false;
        }
    });

    function getFurtherWorkTabView(labID){
        $.ajax({
            url: `${_base_url}doctor/getFurtherWorkTabView`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { "lab_id": labID },
            success: function (response) {
                if (response.status === 'success') {
                    $('#setFurtherWorkTabData').html(response.html);
                    setTabDataLowerCase();
                } else {
                    $('#batch_no_pre').val('');
                    $('#setFurtherWorkTabData').html('');
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });
    }

    function setTabDataLowerCase() {
        $(document).find('.qucikSearch li').each(function(i) {
            $(this).attr('data-text', function() {
                return $(this).text().toLowerCase();
            });
        });
    }

    $("body").on("keyup", "#quickBox", function() {
        let seachValue = $(this).val();
        if(seachValue.length > 0){
            $(".qucikSearch li").hide();
            $('.qucikSearch li[data-text*="' + $.trim(seachValue.toLowerCase()) + '"]').show();
        }else{
            $(".qucikSearch li").show();
        }
    });

    $('#quickBox').blur(function(){
        if( $(this).val().length === 0 ) {
            $(".qucikSearch li").show();
        }
    });

    $("body").on("change", "#blockSelections", function() {
        $('.commomstest a').removeClass('disable_anchor');
        var currentVal = $(this).val();
        console.log(currentVal, "Here I am ")
        var selectedValues = currentVal.join("_");
        $('.stests'+selectedValues+' a').addClass('disable_anchor');
        for (var i = 0; i < currentVal.length; i++) {
            $('.stests'+currentVal[i]+' a').addClass('disable_anchor');
        }
    });

    $("#blockSelections").trigger('change');

    $("body").on("click", ".qucikSearch li a", function() 
	{
        $(this).addClass("active");
        var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
		
        var textAnchor = $(this).parent().attr("data-text");
        var textID = $(this).attr("data-id");
        var strId = textAnchor.replace(/\s/g, '') + "+";
        var reasonsOfRequest = $("#request_reasons").val();
        $(this).addClass("active");
        var lab_number = $("#lab_no").val();
        var totalCost = $('.totalCost').html();
        //var spe = $("#speciman").val();
		//inc =+1;
		var blocks_count = $('#blockcount').val();
        var spe = $('#myInput4 option:selected').text()+ alphabet[blocks_count-1];
        var specimen_id = $('#myInput4').val();
        var blocks = spe;
        //var blocks = $('#blockSelections').val();
        //alert(strId);
		var NCount = +$('#blockcount').val()+1
		$('#blockcount').val(NCount);
        if($(this).hasClass("active"))
        {

            $('#blockSelections  > option:selected').each(function(){
                if($(this).val() != ''){
                    var html='';
                    var cost = parseFloat(totalCost) + 20;
                    html += "<tr id="+textID+">";
                    html +="<td>"+lab_number+"</td>";
                    html +="<td>"+textAnchor+"</td>";
                    html +="<td>"+$(this).text()+"</td>";
                    html +="<td class='remove_test' data-row-id='"+textID+"'><i class='fa fa-trash' title='delete'></i></td>";
                   // html +="<td>"+blocks+"</td>";
                   // html +="<td class='text-right'>20</td>";
                    html +="</tr>";
        
                    $(".custom-table-search tbody").append(html);
                   // $('.totalCost').html(cost);
        
                    var test_ids='';
                    test_ids += '<div id="test_hidden_'+textID+'"><input type="hidden" id="test_id[]" name="test_id[]" value="'+textID+'" /><input type="hidden" id="test_name[]" name="test_name[]" value="'+textAnchor+'" /><input type="hidden" id="specimen_id[]" name="specimen_id[]" value="'+$(this).attr('data-speciment')+'" /><input type="hidden" id="block_no[]" name="block_no[]" value="'+$(this).text()+'" /></div>';
                    $("#test_date").append(test_ids);
                }
            });
        }
        else
        {
            $("#"+strId).remove();
        }

    });

    $("body").on("click", ".remove_test", function() {
        let rowId = $(this).attr("data-row-id");
        $(document).find('.qucikSearch li a[data-id="'+rowId+'"]').removeClass('active');
        $(document).find('#test_date #test_hidden_'+rowId).remove();
        $(this).closest('tr').remove();
    });

    $("body").on("click", ".remove_test_data", function() {
        let rowId = $(this).attr("data-id");
        let url = $(this).attr("data-url");
        $('#delete_test_modal').modal('show');
        $('.test-delete-btn').attr('href', url);
    });

});