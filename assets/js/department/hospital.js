$(() => {
    $("#add-department-button").on("click", function () {
        $(".error-message").hide();
        $("#add-hospital-department").modal("show");
    });

    $("#template-dep-add-button").on("click", function () {
        var dep_ids = [];
        $(".template-dep-input").each(function () {
            if ($(this).prop("checked")) {
                dep_ids.push($(this).val());
            }
        });

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_department",
            data: {
                hospital_id,
                template: true,
                departments: dep_ids,
                [csrf_name]: csrf_hash,
            },
            success: function (data) {
                location.reload();
                $("#template-department-error-message").hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#template-department-error-message").html(jqXHR.responseText);
                $("#template-department-error-message").show();
            },
        });
    });

    $("#custom-dep-add-button").on("click", function () 
	{
        let dep = $("#field-add-name").val();
		let divi = $("#field-add-division option:selected").val();		
        if (dep.trim().length === 0) {
            $("#custom-department-error-message").html(
                "Please enter a department name"
            );
            $("#custom-department-error-message").show();
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_department",
            data: {
                hospital_id,
                template: false,
                departments: dep,
				division: divi,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#custom-department-error-message").html(jqXHR.responseText);
                $("#custom-department-error-message").show();
            },
        });
    });

    $(".add-specialty-button").on("click", function () {
        let dep_name = $(this).attr("data-name");
        $(".template-spec-input").prop("checked", false);
        let d_id = $(this).attr("data-id");
        $("#template-spec-add-button").attr("data-id", d_id);
        $("#custom-spec-add-button").attr("data-id", d_id);
        $("#specialty-template-form-container").show();
        $(".specialty-department-block").hide();
        var dep_spec = $(
            '.specialty-department-block[data-name="' + dep_name + '"]'
        );
        if (dep_spec.length === 0) {
            $("#specialty-template-form-container").hide();
            $("#specialty-custom-form").collapse("show");
        } else {
            $("#specialty-template-form").collapse("show");
            var template_id = dep_spec.attr("data-id");
            $("#template-spec-add-button").attr("data-did", template_id);
        }
        dep_spec.show();
        $("#add-specialty-department").modal("show");
    });

    $("#template-spec-add-button").on("click", function () {
        let d_id = $(this).attr("data-id");
        let dep_id = $(this).attr("data-did");
        if (!dep_id) {
            dep_id = null;
        }
        var spec_ids = [];
        $(".template-spec-input").each(function () {
            if ($(this).prop("checked")) {
                spec_ids.push($(this).val());
            }
        });

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_specialty",
            data: {
                hospital_id,
                department_id: d_id,
                template: true,
                template_id: dep_id,
                specialties: spec_ids,
                [csrf_name]: csrf_hash,
            },
            success: function (data) {
                location.reload();
                $("#template-specialty-error-message").hide();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#template-specialty-error-message").html(jqXHR.responseText);
                $("#template-specialty-error-message").show();
            },
        });
    });

    $("#custom-spec-add-button").on("click", function () {
        let d_id = $(this).attr("data-id");
        let spec = $("#specialty-add-name").val();
        if (spec.trim().length === 0) {
            $("#custom-specialty-error-message").html(
                "Please enter a specialty name"
            );
            $("#custom-specialty-error-message").show();
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_specialty",
            data: {
                hospital_id,
                department_id: d_id,
                template: false,
                specialties: spec,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#custom-specialty-error-message").html(jqXHR.responseText);
                $("#custom-specialty-error-message").show();
            },
        });
    });

    $(".add-category-button").on("click", function () {
        let name = $(this).attr("data-name");
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        $(".template-cat-input").prop("checked", false);
        $("#template-category-error-message").hide();
        $("#custom-category-error-message").hide();

        $("#template-cat-add-button").attr("data-did", d_id);
        $("#template-cat-add-button").attr("data-sid", s_id);

        $("#custom-cat-add-button").attr("data-did", d_id);
        $("#custom-cat-add-button").attr("data-sid", s_id);

        console.log(name);
        $(".category-department-block").hide();
        var cat_block = $('.category-department-block[data-name="' + name + '"]');
        if (cat_block.length === 0) {
            $("#category-template-form-container").hide();
            $("#category-custom-form").collapse("show");
        } else {
            $("#category-template-form").collapse("show");
            var t_did = cat_block.attr("data-did");
            var t_sid = cat_block.attr("data-sid");
            $("#template-cat-add-button").attr("data-tdid", t_did);
            $("#template-cat-add-button").attr("data-tsid", t_sid);
            cat_block.show();
        }

        $("#add-specialty-category").modal("show");
    });

    $("#template-cat-add-button").on("click", function () {
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        var t_did = $(this).attr("data-tdid");
        var t_sid = $(this).attr("data-tsid");

        var cat_ids = [];
        $(".template-cat-input").each(function () {
            if ($(this).prop("checked")) {
                cat_ids.push($(this).val());
            }
        });

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_category",
            data: {
                hospital_id,
                department_id: d_id,
                specialty_id: s_id,
                template: true,
                template_did: t_did,
                template_sid: t_sid,
                categories: cat_ids,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#template-category-error-message").html(jqXHR.responseText);
                $("#template-category-error-message").show();
            },
        });
    });

    $("#custom-cat-add-button").on("click", function () {
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        var category = $("#category-add-name").val();
        var pa = $("#category-pa-add-name").val();

        if (category.trim().length === 0) {
            $("#custom-category-error-message").html("Please enter a category");
            $("#custom-category-error-message").show();
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_category",
            data: {
                hospital_id,
                department_id: d_id,
                specialty_id: s_id,
                template: false,
                categories: category,
                pa,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#custom-category-error-message").html(jqXHR.responseText);
                $("#custom-category-error-message").show();
            },
        });
    });

    $(".add-specimen-button").on("click", function () {
        let name = $(this).attr("data-name");
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        $(".template-sp-input").prop("checked", false);
        $("#template-specimen-error-message").hide();
        $("#custom-specimen-error-message").hide();

        $("#template-sp-add-button").attr("data-did", d_id);
        $("#template-sp-add-button").attr("data-sid", s_id);

        $("#custom-sp-add-button").attr("data-did", d_id);
        $("#custom-sp-add-button").attr("data-sid", s_id);

        console.log(name);
        $(".specimen-department-block").hide();
        var cat_block = $('.specimen-department-block[data-name="' + name + '"]');
        if (cat_block.length === 0) {
            $("#specimen-template-form-container").hide();
            $("#specimen-custom-form").collapse("show");
        } else {
            $("#specimen-template-form").collapse("show");
            var t_did = cat_block.attr("data-did");
            var t_sid = cat_block.attr("data-sid");
            $("#template-sp-add-button").attr("data-tdid", t_did);
            $("#template-sp-add-button").attr("data-tsid", t_sid);
            cat_block.show();
        }

        $("#add-specialty-specimen").modal("show");
    });

    $("#template-sp-add-button").on("click", function () {
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        var t_did = $(this).attr("data-tdid");
        var t_sid = $(this).attr("data-tsid");

        var cat_ids = [];
        $(".template-sp-input").each(function () {
            if ($(this).prop("checked")) {
                cat_ids.push($(this).val());
            }
        });

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_specimen",
            data: {
                hospital_id,
                department_id: d_id,
                specialty_id: s_id,
                template: true,
                template_did: t_did,
                template_sid: t_sid,
                specimens: cat_ids,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#template-specimen-error-message").html(jqXHR.responseText);
                $("#template-specimen-error-message").show();
            },
        });
    });

    $("#custom-sp-add-button").on("click", function () {
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        var category = $("#specimen-add-name").val();

        if (category.trim().length === 0) {
            $("#custom-specimen-error-message").html("Please enter a specimen type");
            $("#custom-specimen-error-message").show();
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_specimen",
            data: {
                hospital_id,
                department_id: d_id,
                specialty_id: s_id,
                template: false,
                specimens: category,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#custom-specimen-error-message").html(jqXHR.responseText);
                $("#custom-specimen-error-message").show();
            },
        });
    });

    $(".add-test-category-button").on("click", function () {
        let name = $(this).attr("data-name");
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        $(".template-tc-input").prop("checked", false);
        $("#template-test-category-error-message").hide();
        $("#custom-test-category-error-message").hide();

        $("#template-tc-add-button").attr("data-did", d_id);
        $("#template-tc-add-button").attr("data-sid", s_id);

        $("#custom-tc-add-button").attr("data-did", d_id);
        $("#custom-tc-add-button").attr("data-sid", s_id);

        $(".test-category-department-block").hide();
        var cat_block = $('.test-category-department-block[data-name="' + name + '"]');
        if (cat_block.length === 0) {
            $("#test-category-template-form-container").hide();
            $("#test-category-custom-form").collapse("show");
        } else {
            $("#test-category-template-form").collapse("show");
            var t_did = cat_block.attr("data-did");
            var t_sid = cat_block.attr("data-sid");
            $("#template-tc-add-button").attr("data-tdid", t_did);
            $("#template-tc-add-button").attr("data-tsid", t_sid);
            cat_block.show();
        }

        $("#add-specialty-test-category").modal("show");
    });

    
    $("#template-tc-add-button").on("click", function () {
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        var t_did = $(this).attr("data-tdid");
        var t_sid = $(this).attr("data-tsid");

        var cat_ids = [];
        $(".template-tc-input").each(function () {
            if ($(this).prop("checked")) {
                cat_ids.push($(this).val());
            }
        });

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_test_category",
            data: {
                hospital_id,
                department_id: d_id,
                specialty_id: s_id,
                template: true,
                template_did: t_did,
                template_sid: t_sid,
                category: cat_ids,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#template-test-category-error-message").html(jqXHR.responseText);
                $("#template-test-category-error-message").show();
            },
        });
    });

    
    $("#custom-tc-add-button").on("click", function () {
        var d_id = $(this).attr("data-did");
        var s_id = $(this).attr("data-sid");

        var category = $("#test-category-add-name").val();

        if (category.trim().length === 0) {
            $("#custom-test-category-error-message").html("Please enter a test-category type");
            $("#custom-test-category-error-message").show();
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_hospital_test_category",
            data: {
                hospital_id,
                department_id: d_id,
                specialty_id: s_id,
                template: false,
                category: category,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#custom-test-category-error-message").html(jqXHR.responseText);
                $("#custom-test-category-error-message").show();
            },
        });
    });

    $(".edit-department").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");

        $("#d-department-id").val(id);
        $("#edit-department-name").val(name).removeClass("is-invalid");

        $("#edit-department").modal('show');
    });

    $("#department-save-button").on("click", function () {
        let id = $("#d-department-id").val();
        let name = $("#edit-department-name").val();

        if (name.trim().length === 0) {
            $("#edit-department-name").addClass("is-invalid");
            $("#edit-department-name").siblings(".invalid-feedback").html("Please provide a department name");
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/edit_hospital_department",
            data: { hospital_id, department_id: id, name, [csrf_name]: csrf_hash },
            success: function () { location.reload(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#edit-department-name").addClass("is-invalid");
                $("#edit-department-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });

    $(".edit-specialty").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        let d_id = $(this).attr("data-did");


        $("#sp-department-id").val(d_id);
        $("#sp-specialty-id").val(id);
        $("#edit-specialty-name").val(name).removeClass("is-invalid");

        $("#edit-specialty").modal('show');
    });

    $("#specialty-save-button").on("click", function () {
        let id = $("#sp-specialty-id").val();
        let did = $("#sp-department-id").val();
        let name = $("#edit-specialty-name").val();

        if (name.trim().length === 0) {
            $("#edit-specialty-name").addClass("is-invalid");
            $("#edit-specialty-name").siblings(".invalid-feedback").html("Please provide a specialty name");
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/edit_hospital_specialty",
            data: { hospital_id, department_id: did, specialty_id: id, name, [csrf_name]: csrf_hash },
            success: function () { location.reload(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#edit-specialty-name").addClass("is-invalid");
                $("#edit-specialty-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });


    $(".edit-category").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        let d_id = $(this).attr("data-did");
        let s_id = $(this).attr("data-sid");
        let pa = $(this).attr("data-pa");


        $("#c-department-id").val(d_id);
        $("#c-specialty-id").val(s_id);
        $("#c-category-id").val(id);
        $("#edit-category-name").val(name).removeClass("is-invalid");
        $("#edit-category-pa").val(pa);

        $("#edit-category").modal('show');
    });

    $("#category-save-button").on("click", function () {
        let id = $("#c-category-id").val();
        let did = $("#c-department-id").val();
        let sid = $("#c-specialty-id").val();
        let name = $("#edit-category-name").val();
        let pa = $("#edit-category-pa").val();

        if (name.trim().length === 0) {
            $("#edit-category-name").addClass("is-invalid");
            $("#edit-category-name").siblings(".invalid-feedback").html("Please provide a category name");
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/edit_hospital_specialty",
            data: { hospital_id, department_id: did, specialty_id: sid, category_id: id, pa, name, [csrf_name]: csrf_hash },
            success: function () { location.reload(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#edit-category-name").addClass("is-invalid");
                $("#edit-category-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });


    $(".edit-specimen").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        let d_id = $(this).attr("data-did");
        let s_id = $(this).attr("data-sid");


        $("#s-department-id").val(d_id);
        $("#s-specimen-id").val(id);
        $("#s-specialty-id").val(s_id);
        $("#edit-specimen-name").val(name).removeClass("is-invalid");

        $("#edit-specimen").modal('show');
    });

    $("#specimen-save-button").on("click", function () {
        let id = $("#s-specimen-id").val();
        let did = $("#s-department-id").val();
        let sid = $("#s-specialty-id").val();
        let name = $("#edit-specimen-name").val();

        if (name.trim().length === 0) {
            $("#edit-specimen-name").addClass("is-invalid");
            $("#edit-specimen-name").siblings(".invalid-feedback").html("Please provide a specimen type name");
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/edit_hospital_specimen",
            data: { hospital_id, department_id: did, specimen_id: id, specialty_id: sid, name, [csrf_name]: csrf_hash },
            success: function () { location.reload(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#edit-specimen-name").addClass("is-invalid");
                $("#edit-specimen-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });


    $(".delete-department").on("click", function() {
        let id = $(this).attr('data-id');
        $("#delete-department-id").val(id);
        $("#delete-type").val('department');
        $("#delete-error-message").hide();
        $("#delete-field-modal").modal('show');
    });

    
    $(".delete-specialty").on("click", function() {
        let did = $(this).attr('data-did');
        let id = $(this).attr('data-id');
        $("#delete-department-id").val(did);
        $("#delete-specialty-id").val(id);
        $("#delete-type").val('specialty');
        $("#delete-error-message").hide();
        $("#delete-field-modal").modal('show');
    });

    $(".delete-category").on("click", function() {
        let did = $(this).attr('data-did');
        let sid = $(this).attr('data-sid');
        let id = $(this).attr('data-id');
        $("#delete-department-id").val(did);
        $("#delete-specialty-id").val(sid);
        $("#delete-category-id").val(id);
        $("#delete-type").val('category');
        $("#delete-error-message").hide();
        $("#delete-field-modal").modal('show');
    });

    $(".delete-specimen").on("click", function() {
        let did = $(this).attr('data-did');
        let sid = $(this).attr('data-sid');
        let id = $(this).attr('data-id');
        $("#delete-department-id").val(did);
        $("#delete-specialty-id").val(sid);
        $("#delete-specimen-id").val(id);
        $("#delete-error-message").hide();
        $("#delete-type").val('specimen_type');
        $("#delete-field-modal").modal('show');
    });

    $("#delete-field-button").on('click', function() {
        let type = $("#delete-type").val();
        let department_id = $("#delete-department-id").val();
        let specialty_id = $("#delete-specialty-id").val();
        let category_id = $("#delete-category-id").val();
        let specimen_id = $("#delete-specimen-id").val();

        switch (type) {
            case "department":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_hospital_department',
                    data: {hospital_id, department_id, [csrf_name]: csrf_hash},
                    success: function() { location.reload();},
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
            break;
            case "specialty":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_hospital_specialty',
                    data: {hospital_id, department_id, specialty_id, [csrf_name]: csrf_hash},
                    success: function() { location.reload();},
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
            break;
            case "category":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_hospital_category',
                    data: {hospital_id, department_id, specialty_id, category_id, [csrf_name]: csrf_hash},
                    success: function() { location.reload();},
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
            break;
            case "specimen_type":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_hospital_specimen',
                    data: {hospital_id, department_id, specialty_id, category_id, specimen_id, [csrf_name]: csrf_hash},
                    success: function() { location.reload();},
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
            break;
            default:
                $("#delete-error-message").html("Something went wrong, try again later").show();
                return;
        }
    });

    
    $("#select-hospital").select2({"width": "100%"});

    $("#select-hospital").on("select2:select", function() {
        var h_id = $(this).val();
        window.location.href = _base_url + "department/institute/" + h_id;
    });

});
