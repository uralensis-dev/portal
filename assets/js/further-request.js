$(document).ready(function () {
    // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    //     var target = e.target; // newly activated tab
    //     var previous = e.relatedTarget; // previous active tab
    //     var csrf_token = $('input[name="csrf_token"]').val();
    //     var parent_id = $(target).data('parent-id');
    //     var level = $(target).data('level');
    //
    //     $.ajax({
    //         url: further_request_base_url + "/support/get_test_data",
    //         type: "POST",
    //         dataType: 'json',
    //         async: false,
    //         data: {
    //             'csrf_token': csrf_token,
    //             'parent_id': parent_id,
    //             'level': level
    //         },
    //         success: function (response) {
    //             console.log(response);
    //         },
    //     });
    // });

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
            alert('Please select Specimen and Block first!');
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
            alert('Please select Specimen and Block first!');
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
        html += "<td class='text-right'>" + record.test_cost + "</td>";
        html += "</t>";
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
        var baseUrl = $("#baseUrl").val();
        var formData = $("#saveFurtherRequest").serializeArray();
        formData = processFormData(formData, selected_tests);
        $.ajax({
            url: baseUrl + "/doctor/save_further_request",
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
                    window.location.href = baseUrl+'doctor/doctor_record_detail_old/'+response.redirectId;
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


    // $('#quickBox').on('input', function() {
    //     $(".qucikSearch li").hide();
    //     $('.qucikSearch li[data-text*="' + $.trim($(this).val().toLowerCase()) + '"]').show();
    //
    // });
    //
    // $('#quickBox').blur(function()
    // { console.log('blur');
    //     if( $(this).val().length === 0 ) {
    //         $(".qucikSearch li").show();
    //     }
    // });
    //
    // $(".qucikSearch li a").click(function(){
    //     $(this).toggleClass("active");
    // });
    //
    // $(".qucikSearch li a").on("click",function(){
    //     var textAnchor = $(this).parent().attr("data-text");
    //     strId = textAnchor.replace(/\s/g, '');
    //
    //
    //     if($(this).hasClass("active")){
    //
    //         // alert(textAnchor);
    //         var html = "<tr id="+strId+">";
    //         html +="<td>22020-20</td>";
    //         html +="<td></td>";
    //         html +="<td>"+textAnchor+"</td>";
    //         html +="<td>Specimen 2</td>";
    //         html +="<td>3</td>";
    //         html +="<td class='text-right'>20</td>";
    //         html +="</t>";
    //         $(".custom-table-search tbody").append(html);
    //     }
    //     else{
    //         $("#"+strId).remove();
    //     }
    //
    // });

    // $(".specimen_list li a").click(function(){
    // 	$(".specimen_list li a").removeClass("active");
    // 	$(this).addClass("active");
    // });


});