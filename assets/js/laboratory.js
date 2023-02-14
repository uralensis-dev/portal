function delete_lab(url){
    $('#delete_lab_modal').modal('show');
    $('.lab-delete-btn').attr('href', url);
}
// Start Laboratory Test Screen
$(document).ready(function () {
    var laboratory_test_form = '#laboratory_test_form';
    var edit_laboratory_test_form = '#edit_laboratory_test_form';
    var laboratory_test_form_modal = '#add-laboratory-test-modal';
    var edit_lab_test_modal = '#edit_lab_test_modal';
    var datatable_grid = '#laboratory-test-table';


    var validator = $(laboratory_test_form).validate({
        errorClass: "text-danger",
        errorPlacement: function (error, element) {
            error.appendTo(element.parent("div"));
        },
    });

    var edit_validator = $(edit_laboratory_test_form).validate({
        errorClass: "text-danger",
        errorPlacement: function (error, element) {
            error.appendTo(element.parent("div"));
        },
    });

    $('button.submit-laboratory-test-form').click(function (e) {
        e.preventDefault();

        if ($(laboratory_test_form).valid()) {
            submiForm($(this).data('url'), $(this), laboratory_test_form, laboratory_test_form_modal);
        }
    });

    $('button.edit-submit-laboratory-test-form').click(function (e) {
        e.preventDefault();

        if ($(edit_laboratory_test_form).valid()) {
            editSubmiForm($(this).data('url'), $(this), edit_laboratory_test_form, edit_lab_test_modal);
        }
    });


    $(laboratory_test_form_modal).on('hidden.bs.modal', function (e) {
        resetForm(laboratory_test_form);
    });

    var departments = {};

    function updateSpecialty(selected_department,status) {
        if(status=="add"){
            var specialitySel = $(".specialty_id");
            var specialityConSel = $("#specialty_id_container");
            var testCategoryConSel = $("#test_category_container");
        } else {
            var specialitySel = $("#edit_specialty_id");
            var specialityConSel = $("#edit_specialty_id_container");
            var testCategoryConSel = $("#edit_test_category_container");
        }

        let specialties = departments[selected_department].specialties;
        //console.log(specialties);
        let option = `<option value="">--Select Specialty--</option>`;
        specialitySel.find('option').remove();
        specialitySel.append(option);
        let show = false;
        for (let [s_id, specialty] of Object.entries(specialties)) {
            specialitySel.append(`<option value="${s_id}">${specialty.name}</option>`);
            show = true;
        }
        specialityConSel.show();
        if (!show) {
            testCategoryConSel.hide();
        }
    }

    function updateDepartment(status) {
        // alert("I am updateDepartment");
        if(status=="add"){
            var lab_id_sel = $("#lab_id");
            var lab_class_sel = $('.lab_id');
            var department_id_sel = $(".department_id");
            var department_id_container_sel = $("#department_id_container");
            var specialty_id_container_sel = $("#specialty_id_container");
            var test_category_container_sel = $("#test_category_container");
        }else {
            var lab_id_sel = $("#edit_lab_id");
            var lab_class_sel = $('.edit_lab_id');
            var department_id_sel = $("#edit_department_id");
            var department_id_container_sel = $("#edit_department_id_container");
            var specialty_id_container_sel = $("#edit_specialty_id_container");
            var test_category_container_sel = $("#edit_test_category_container");
        }
        let lab_id = lab_id_sel.val();
        $.ajax({
            url: _base_url + 'laboratory/get_lab_departments',
            data: {lab_id},
            success: function(data) {
                if (data.status === 'success') {
                    //Codes Set
                    if(status=="add"){
                        $("#lab_ref").val(data.lab_test_codes['ref_name']);
                        $("#test_id").val(data.lab_test_codes['test_id']);
                    }

                    //==========//
                    departments = data.departments;
                    lab_class_sel.removeClass('is-invalid');
                    lab_class_sel.siblings('.invalid-feedback').html('');
                    let select_department = department_id_sel;
                    select_department.find('option').remove();
                    let show = false;
                    let selected_department = 0;
                    for(let [d_id, department] of Object.entries(departments)) {
                        if (department.name === 'Pathology') {
                            select_department.append(`<option selected value="${d_id}">${department.name}</option>`);
                            selected_department = d_id;
                        } else {
                            select_department.append(`<option value="${d_id}">${department.name}</option>`);
                        }
                        show = true;
                    }
                    if (show) {
                        department_id_container_sel.show();
                        if (selected_department === 0) {
                            selected_department = Object.keys(departments)[0];
                        }
                        updateSpecialty(selected_department,status);
                    } else {
                        department_id_container_sel.hide();
                        specialty_id_container_sel.hide();
                        test_category_container_sel.hide();
                    }
                } else {
                    lab_class_sel.addClass('is-invalid');
                    lab_class_sel.siblings('.invalid-feedback').html(data.message);
                }
                
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
    }

    updateDepartment("add");
    updateDepartment("edit");

    $("#lab_id").on("change", function () {
        updateDepartment("add");
    });

    $("#edit_lab_id").on("change",function () {
        // alert("I am edit_lab_id");
        updateDepartment("edit");
    });

    /*$("#department_id").on('change', function() {
        let selected_department = $("#department_id").val();
        updateSpecialty(selected_department,"add");
    });*/

    $(".department_id").on('change', function() {
        let selected_department = $(this).val();
        updateSpecialty(selected_department,"add");
    });

    $(".department_id").on('change', function() {
        let selected_department = $(this).val();
        let specialties = departments[selected_department].specialties;
        let option = `<option value="">--Select Specialty--</option>`;
        let specialitySel = $(".specialty_id");
        specialitySel.find('option').remove();
        specialitySel.append(option);
        for (let [s_id, specialty] of Object.entries(specialties)) {
            specialitySel.append(`<option value="${s_id}">${specialty.name}</option>`);
        }
    });

    $("#edit_department_id").on('change', function() {
        let selected_department = $("#edit_department_id").val();
        updateSpecialty(selected_department,"edit");
    });

    $(".specialty_id").on('change', function() {
        let selected_department = $(this).closest('.department_id').val();
        //let specialties = departments[selected_department].specialties;
        let selected_specialty = $(this).val();
        if (!selected_specialty) {
            return
        }
       // let test_categories = specialties[selected_specialty].test_categories;
        $("#test_category_container").show();
        $("#dv_sub_categories").show();
        $("#dv_main_categories").show();
//        if (!test_categories) {
//            test_categories = [];
//        }
//        $("#test_category").find('option').remove();
//        $("#test_category").append(`<option value="">--Select Test Category--</option>`);
//        for (let cat of test_categories) {
//            $("#test_category").append(`<option value="${cat.id}">${cat.name}</option>`);
//        }
        getCategories(selected_department, selected_specialty);
    });

    function getCategories(department_id, specialty_id){
        $.ajax({
            url: _base_url + 'laboratory/get_categories',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val(), department_id:department_id, specialty_id: specialty_id},
            success: function(data) {
                $("#main_category_id").html("");
                let cnt = 0;
                let tbody = '';
                let html = "<option value=''>-- Categories --</option>";
                $.each(data, function (index, element) {
                    cnt++;
                    let actionTd = '';
                    html += "<option value='"+ element.id +"' data-original-id='53'>"+ element.name +"</option>";
                    actionTd += "<a href='javascript:void(0);' data-id='"+ element.id +"' class='update_cat' title='Edit Category'><i class='glyphicon glyphicon-pencil'></i></a> &nbsp;";
                    actionTd += "<a href='javascript:void(0);' data-id='"+ element.id +"' class='delete_cat' title='Delete Category'><i class='glyphicon glyphicon-trash'></i></a>";
                    tbody += "<tr><td>"+ cnt +"</td><td><input type='text' class='update_cat_name' value='"+ element.name +"' disabled/></td><td>"+ actionTd +"</td></tr>";
                });
                $("#main_category_id").html(html);
                tbody = (cnt > 0) ? tbody : '<tr><td colSpan="3" className="text-center">No records found</td></tr>';
                $("#category_list tbody").html(tbody);
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
    }

    $(".main_category_id").on("change", function (){
        let category_id = $(this).val();
        $.ajax({
            url: _base_url + 'laboratory/get_sub_categories_by_main_cat',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val(), 'category_id': category_id},
            success: function(data) {
                $("#sub_category_id").html("");
                let cnt = 0;
                let tbody = '';
                $.each(data, function (index, element) {
                    cnt++;
                    let actionTd = '';
                    actionTd += "<a href='javascript:void(0);' data-id='"+ element.id +"' class='update_sub_cat' title='Edit Sub Category'><i class='glyphicon glyphicon-pencil'></i></a> &nbsp;";
                    actionTd += "<a href='javascript:void(0);' data-id='"+ element.id +"' class='delete_sub_cat' title='Delete Sub Category'><i class='glyphicon glyphicon-trash'></i></a>";
                    tbody += "<tr><td>"+ cnt +"</td><td><input type='text' class='update_sub_cat_name' value='"+ element.name +"' disabled/></td><td> "+ actionTd +" </td></tr>";
                });
                tbody = (cnt > 0) ? tbody : '<tr><td colSpan="3" className="text-center">No records found</td></tr>';
                $("#sub_category_list tbody").html(tbody);
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
    });

    $("#edit_specialty_id").on('change', function() {
        let selected_department = $("#edit_department_id").val();
        let specialties = departments[selected_department].specialties;
        let selected_specialty = $(this).val();
        if (!selected_specialty) {
            return
        }
       // let test_categories = specialties[selected_specialty].test_categories;
        $("#edit_test_category_container").show();
        $("#edit_dv_sub_categories").show();
        $("#edit_dv_main_categories").show();
//        if (!test_categories) {
//            test_categories = [];
//        }
//        $("#test_category").find('option').remove();
//        $("#test_category").append(`<option value="">--Select Test Category--</option>`);
//        for (let cat of test_categories) {
//            $("#test_category").append(`<option value="${cat.id}">${cat.name}</option>`);
//        }

    });

    $(document).on("click", ".update_cat", function (){
        $(this).closest('tr').find('.update_cat_name').prop('disabled', false);
    });

    $(document).on("blur", ".update_cat_name", function (){
        let cat_id = $(this).closest('tr').find('.update_cat').attr('data-id');
        let cat_name = $(this).val();
        $.ajax({
            url: _base_url + 'laboratory/update_category_info',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val(), 'cat_id': cat_id, 'cat_name': cat_name },
            success: function(data) {
                if (data.status === 'success') {
                    $('#add-lab-test-category-modal').modal('hide');
                    jQuery.sticky(data.message, {classList: 'success', speed: 200, autoclose: 7000});
                } else {
                    jQuery.sticky(data.message, {classList: 'important', speed: 200, autoclose: 5000});
                }
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
        $(this).closest('tr').find('.update_cat_name').prop('disabled', true);
    });

    $(document).on("click", ".update_sub_cat", function (){
        $(this).closest('tr').find('.update_sub_cat_name').prop('disabled', false);
    });

    $(document).on("blur", ".update_sub_cat_name", function (){
        let sub_cat_id = $(this).closest('tr').find('.update_sub_cat').attr('data-id');
        let sub_cat_name = $(this).val();
        $.ajax({
            url: _base_url + 'laboratory/update_sub_category_info',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val(), 'sub_cat_id': sub_cat_id, 'sub_cat_name': sub_cat_name },
            success: function(data) {
                if (data.status === 'success') {
                    $('#add-lab-test-sub-category-modal').modal('hide');
                    jQuery.sticky(data.message, {classList: 'success', speed: 200, autoclose: 7000});
                } else {
                    jQuery.sticky(data.message, {classList: 'important', speed: 200, autoclose: 5000});
                }
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
        $(this).closest('tr').find('.update_cat_name').prop('disabled', true);
    });

    $(document).on("click", ".delete_cat", function (){
        let cat_id = $(this).attr('data-id');
        $.ajax({
            url: _base_url + 'laboratory/delete_category',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val(), 'cat_id': cat_id},
            success: function(data) {
                if (data.status === 'success') {
                    $('#add-lab-test-category-modal').modal('hide');
                    jQuery.sticky(data.message, {classList: 'success', speed: 200, autoclose: 7000});
                } else {
                    jQuery.sticky(data.message, {classList: 'important', speed: 200, autoclose: 5000});
                }
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
    });

    $(document).on("click", ".delete_sub_cat", function (){
        let sub_cat_id = $(this).attr('data-id');
        $.ajax({
            url: _base_url + 'laboratory/delete_sub_category',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val(), 'sub_cat_id': sub_cat_id},
            success: function(data) {
                if (data.status === 'success') {
                    $('#add-lab-test-sub-category-modal').modal('hide');
                    jQuery.sticky(data.message, {classList: 'success', speed: 200, autoclose: 7000});
                }else{
                    jQuery.sticky(data.message, {classList: 'important', speed: 200, autoclose: 5000});
                }
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
    });

    $(document).on("click",".edit_btn",function () {
        var dataId = $(this).attr("data-id");
        var getData = $.parseJSON($("#test_data_"+dataId).val());
        console.log(getData);
        var groupType = Number($("#edit_group_type").val());
        if(groupType==1){
            //Admin Case
            $("#edit_lab_id").val(getData.group_id).trigger("change");
        } else {
            $("#edit_lab_id").val(getData.group_id).trigger("change");
            $(".edit_lab_id").val(getData.lab_name);

            // alert("I am edited",$("#edit_lab_id").val());
        }

        window.setTimeout(function() {
            $("#edit_id").val(dataId);
            $("#edit_lab_ref").val(getData.lab_ref_name);
            $("#edit_test_id").val(getData.test_id);
            $("#edit_test_name").val(getData.name);
            $("#edit_created_at").val(getData.formated_date);
            $("#edit_image_src").attr("src",getData.new_profile_pic);
            $("#edit_image_span").text(getData.user_name);
            $("#edit_department_id").val(getData.department_id).trigger("change");
            $("#edit_specialty_id").val(getData.specialty_id).trigger("change");
            $("#edit_test_category_main").val(getData.category_id).trigger("change");

            var cost_code_id = getData.cost_code_id;
            var billing_code_id = getData.billing_code_id;

            cost_code_id = cost_code_id.split(",");
            billing_code_id = billing_code_id.split(",");

            $("#edit_cost_code").val(cost_code_id).trigger("change");
            $("#edit_billing_code").val(billing_code_id).trigger("change");

            // $("#edit_test_category_main").val(getData.test_id);
            window.setTimeout(function() {
                $("#edit_specialty_id").val(getData.speciality_group_id).trigger("change");
            }, 300);
            window.setTimeout(function() {
                $("#edit_test_sub_category_main").val(getData.sub_category_id).trigger("change");
            }, 2000);

            $("#edit_lab_test_modal").modal("show");

        }, 500);

    });


    $("#test_category_main,#edit_test_category_main").on("change",function (e) {
        var thisSel = $(this).attr("data-cat");
        var thisId = Number($(this).val());

        $.ajax({
            url: _base_url + 'laboratory/get_sub_categories',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val(),catId:thisId},
            success: function(data) {
                $("#"+thisSel+"test_sub_category_main").html("");
                var html = "<option value=''>-- Sub Categories--</option>";
                $.each(data, function (index, element) {
                    html += "<option value='"+element.id+"'>"+element.name+"</option>";
                });
                $("#"+thisSel+"test_sub_category_main").html(html);
            },
            error: function(xhr, statusText, status) {
                console.log(xhr);
            }
        });
    });

    var datatable = $(datatable_grid).DataTable({
        "ordering": false,
        "processing": true,
        "serverSide": true,
        "paging": true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "ajax": {
            url: laboratory_base_url + '/get_laboratory_test_data_ajax',
            type: "POST",
            dataType: "json",
            data: {'csrf_token': $('input[name="csrf_token"]').val()}
        },
        columns: [
            {data: 'checkbox'},
            {data: 'name'},
            {data: 'test_id'},
            {data: 'lab_name'},
            {data: 'test_category'},
            {data: 'test_sub_category'},
            {data: 'lab_ref'},
            {data: 'speciality_group'},
            {data: 'cost'},
            {data: 'sale'},
            {data: 'user_id'},
            {data: 'created_at'},
            {data: 'action'}
        ],
    });

    $("#laboratory-test-tabless").dataTable({
        "paging": true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });

    function submiForm(url, button, form, modal) {
        // var selected_categories = $('#laboratory-test-category-tree').treeview('getChecked');
        var selected_categories = $('#test_category_main').val();
        // $(modal).modal('hide');
        // return;
        if(selected_categories.length > 0)
		{
            var selected_categories_ids = [];
            // $.each(selected_categories, function (index, element) {
                // selected_categories_ids.push(element['id']);
            // });
            selected_categories_ids[0] = selected_categories;
        }
		else
		{
            alert('select at least one category');
            return false
        }
        var options = {
            url: url,
            resetForm: true,
            dataType: 'json',
            data: {laboratory_test_category_id: selected_categories_ids},
            beforeSubmit: function () {
            },
            success: function (response) {
                if (response.type === 'success') {
                    alert(response.msg);
                    $(modal).modal('hide');
                    datatable.ajax.reload();
                }else{

                }
            },
            error: function (errors) {
                
            },
            complete: function () {
            }
        };
        $(form).ajaxSubmit(options);
        return false;
    }
    function editSubmiForm(url, button, form, modal) {
        // var selected_categories = $('#laboratory-test-category-tree').treeview('getChecked');
        //var selected_categories = $('#edit_test_category').val();
        var selected_categories = $('#edit_test_category_main').val();
        // $(modal).modal('hide');
        // return;
        if(selected_categories.length > 0){
            var selected_categories_ids = [];
            // $.each(selected_categories, function (index, element) {
                // selected_categories_ids.push(element['id']);
            // });
            selected_categories_ids[0] = selected_categories;
        }else{
            alert('select at least one category');
            return false
        }
        var options = {
            url: url,
            resetForm: true,
            dataType: 'json',
            data: {laboratory_test_category_id: selected_categories_ids},
            beforeSubmit: function () {
            },
            success: function (response) {
                if (response.type === 'success') {
                    alert(response.msg);
                    $(modal).modal('hide');
                    datatable.ajax.reload();
                }else{

                }
            },
            error: function (errors) {

            },
            complete: function () {
            }
        };
        $(form).ajaxSubmit(options);
        return false;
    }

    function resetForm(form) {
        $(form).resetForm();
        $('#laboratory-test-category-tree').treeview('uncheckAll', { silent: true });
        $('.select2').val(null).trigger('change');
        $(form + ' label.text-danger').hide();
        $(form + ' div.text-danger').hide();
        $(form + ' input.text-danger').removeClass('text-danger');
        $(form + '-id').val('');
        $(form + ' button.add-form').removeClass('d-none');
        $(form + ' button.update-form').addClass('d-none');
        $(form + ' button.processing-form').addClass('d-none');
    }

    $("body").on("change", ".checkAll", function(){
        if($(this).prop("checked")) {
            $(".checkSingle").prop("checked", true);
        } else {
            $(".checkSingle").prop("checked", false);
        }
    });

    $("body").on("change", ".checkSingle", function(){
        if($(".checkSingle").length == $(".checkSingle:checked").length) {
            $(".checkAll").prop("checked", true);
        }else {
            $(".checkAll").prop("checked", false);
        }
    });

    $("body").on("click", ".selected_delete", function(){
        let labIds = [];
        $(document).find('.checkSingle').each(function (i, val){
            if (this.checked) {
                labIds.push($(this).val());
            }
        });
        if(labIds.length > 0) {
            if (confirm("Are You Sure You Want To Delete This Record.")) {
                deleteSelectedLabs(labIds);
            } else {
                return false;
            }
        }else {
            jQuery.sticky('Please select any record.', {classList: 'important', speed: 200, autoclose: 5000});
        }
    });

    function deleteSelectedLabs(labIds){
        jQuery.ajax({
            type: "POST",
            url: site_url + "laboratory/deleteSelectedLabTest",
            data: {'crsr_token': jQuery.now(), 'labIds': labIds},
            dataType: "json",
            success: function (data) {
                if (data.type === 'success') {
                    datatable.ajax.reload();
                    jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                }
            }
        });
    }

    $("#custom-tc-add-button").on("click", function () {
        let category = $("#test-category-add-name").val();
        if (category.trim().length === 0) {
            jQuery.sticky('Please enter a test-category name.', {classList: 'important', speed: 200, autoclose: 5000});
            return false;
        }
        $.ajax({
            type: "POST",
            url: _base_url + "department/add_laboratory_test_category",
            data: {
                hospital_id: $('#hospital_id').val(),
                department_id: $('#add-lab-test-category-modal').find('.department_id').val(),
                specialty_id: $('#add-lab-test-category-modal').find('.specialty_id').val(),
                template: false,
                category: category,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                jQuery.sticky('Test-category added successfully.', {classList: 'success', speed: 200, autoclose: 5000});
                $('#add-lab-test-category-modal').modal('hide');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                jQuery.sticky('Request failed.', {classList: 'important', speed: 200, autoclose: 5000});
            },
        });
    });

    $("#custom-tsc-add-button").on("click", function () {
        var t_id = $("#main_category_id").val();
        var ts_name = $("#test-sub-category-add-name").val();

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_laboratory_test_sub_category",
            data: {
                t_id: t_id,
                ts_name: ts_name,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                jQuery.sticky('Sub test-category added successfully.', {classList: 'success', speed: 200, autoclose: 5000});
                $('#add-lab-test-sub-category-modal').modal('hide');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                jQuery.sticky('Request failed.', {classList: 'important', speed: 200, autoclose: 5000});
            },
        });
    });
});
// Start Laboratory Test Screen


$(document).ready(function (){
    $('#jstree').jstree({
        "plugins" : [ "wholerow", "search", "contextmenu"]
    });

    function getTree() {
        var tree;
        $.ajax({
            url: laboratory_base_url + "/get_laboratory_test_hirarchy",
            type: "POST",
            dataType: 'json',
            async: false,
            data: {
                'csrf_token': $('input[name="csrf_token"]').val(),
                'level': 1
            },
            success: function (response) {
                tree = response;

            },
        });
        return tree;
    }

    var searchableTree = $('#laboratory-test-category-tree').treeview({
        data: getTree(),
        showCheckbox: true,
    });

    var laboratory_test_category_tree_search = function(e) {

        var pattern = $('#laboratory-test-category-tree-search').val();
        if(pattern == ''){
            searchableTree.treeview('collapseAll', { silent: true });
        }else{
            var options = {
                ignoreCase: true,     // case insensitive
                exactMatch: false,    // like or equals
                revealResults: true,  // reveal matching nodes
            };
            var results = searchableTree.treeview('search', [ pattern, options ]);
        }

    }

    $('#laboratory-test-category-tree-search').on('keyup', laboratory_test_category_tree_search);

});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

