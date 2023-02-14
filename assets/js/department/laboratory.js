function ReloadPage(){
    var selectedDepartment = $('#selectedDepartment').val();
    var selectedSpeciality = $('#selectedSpeciality').val();
    var origin = window.location.origin;
    if (origin == 'http://localhost') {
        url = origin + '/pci/department/laboratory/'+$('#rId').val()+'?department='+ selectedDepartment+"&speciality="+selectedSpeciality;
    } else {
        url = origin + '/department/laboratory/'+$('#rId').val()+'?department='+ selectedDepartment+"&speciality="+selectedSpeciality;
    }
    window.location.href = url;
}

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
            url: _base_url + "department/add_laboratory_department",
            data: {
                hospital_id,
                template: true,
                departments: dep_ids,
                [csrf_name]: csrf_hash,
            },
            success: function (data) {
                ReloadPage();
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

    $("#custom-dep-add-button").on("click", function () {
        let dep = $("#field-add-name").val();
        if (dep.trim().length === 0) {
            $("#custom-department-error-message").html(
                "Please enter a department name"
            );
            $("#custom-department-error-message").show();
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_laboratory_department",
            data: {
                hospital_id,
                template: false,
                departments: dep,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                ReloadPage();
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
            url: _base_url + "department/add_laboratory_specialty",
            data: {
                hospital_id,
                department_id: d_id,
                template: true,
                template_id: dep_id,
                specialties: spec_ids,
                [csrf_name]: csrf_hash,
            },
            success: function (data) {
                ReloadPage();
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
            url: _base_url + "department/add_laboratory_specialty",
            data: {
                hospital_id,
                department_id: d_id,
                template: false,
                specialties: spec,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                ReloadPage();
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
            url: _base_url + "department/add_laboratory_category",
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
                ReloadPage();
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
            url: _base_url + "department/add_laboratory_category",
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
                ReloadPage();
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

    $(".add-tissue-button").on("click", function () {
        let d_id = $(this).attr("data-did");
        let s_id = $(this).attr("data-sid");
        $("#custom-tt-add-button").attr("data-did", d_id);
        $("#custom-tt-add-button").attr("data-sid", s_id);
        $("#add-tissue-type").modal("show");
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
            url: _base_url + "department/add_laboratory_specimen",
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
                ReloadPage();
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
            url: _base_url + "department/add_laboratory_specimen",
            data: {
                hospital_id,
                department_id: d_id,
                specialty_id: s_id,
                template: false,
                specimens: category,
                [csrf_name]: csrf_hash,
            },
            success: function () {
                ReloadPage();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("Request failed");
                console.log(jqXHR);
                $("#custom-specimen-error-message").html(jqXHR.responseText);
                $("#custom-specimen-error-message").show();
            },
        });
    });

    $("#tissue-add-name").on("focusout", function () {
        let tissueType = $(this).val();
        if (tissueType.trim().length > 0) {
            $("#custom-tissue-error-message").hide();
        }else{
            $("#custom-tissue-error-message").html("Please enter a tissue type");
            $("#custom-tissue-error-message").show();
        }
    });

    $("#custom-tt-add-button").on("click", function () {
        let d_id = $(this).attr("data-did");
        let s_id = $(this).attr("data-sid");
        let tissueType = $("#tissue-add-name").val();
        if (tissueType.trim().length === 0) {
            $("#custom-tissue-error-message").html("Please enter a tissue type");
            $("#custom-tissue-error-message").show();
        }
        let dataArr = {
            hospital_id,
            department_id: d_id,
            speciality_id: s_id,
            template: false,
            tissue_type: tissueType,
            [csrf_name]: csrf_hash
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/add_laboratory_tissue",
            data: dataArr,
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    $("#add-tissue-type").modal("hide");
                    $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                    ReloadPage();
                } else {
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
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

    $(".add-test-sub-category-button").on("click", function () {
        var t_id = $(this).attr("data-tid");

        $("#test-category-add-id").val(t_id);
        $("#add-test-sub-category").modal("show");
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
            url: _base_url + "department/add_laboratory_test_category",
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
            url: _base_url + "department/add_laboratory_test_category",
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

    $("#custom-tsc-add-button").on("click", function () {
        var t_id = $("#test-category-add-id").val();
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
            url: _base_url + "department/edit_laboratory_department",
            data: { hospital_id, department_id: id, name, [csrf_name]: csrf_hash },
            success: function () { ReloadPage() },
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
            url: _base_url + "department/edit_laboratory_specialty",
            data: { hospital_id, department_id: did, specialty_id: id, name, [csrf_name]: csrf_hash },
            success: function () { ReloadPage(); },
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

    $(".edit-sub-category").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        let d_id = $(this).attr("data-did");
        let s_id = $(this).attr("data-sid");
        let c_id = $(this).attr("data-cid");
        let pa = $(this).attr("data-pa");


        $("#sc-department-id").val(d_id);
        $("#sc-specialty-id").val(s_id);
        $("#sc-category-id").val(id);
        $("#sc-sub-category-id").val(id);
        $("#edit-category-name").val(name).removeClass("is-invalid");
        $("#edit-category-pa").val(pa);

        $("#edit-sub-category").modal('show');
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
            url: _base_url + "department/edit_laboratory_specialty",
            data: { hospital_id, department_id: did, specialty_id: sid, category_id: id, pa, name, [csrf_name]: csrf_hash },
            success: function () { ReloadPage(); },
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

    $(".edit-tissue").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");

        $("#t-specimen-id").val(id);
        $("#edit-tissue-name").val(name).removeClass("is-invalid");

        $("#edit-tissue").modal('show');
    });

    $(".edit-test-category").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");


        $("#s-test-category-id").val(id);
        // $("#s-test-category-name").val(name);
        $("#s-test-category-name").val(name).removeClass("is-invalid");

        $("#edit-test-category-modal").modal('show');
    });

    $(".edit-test-sub-category").on("click", function () {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");


        $("#s-test-sub-category-id").val(id);
        // $("#s-test-category-name").val(name);
        $("#s-test-sub-category-name").val(name).removeClass("is-invalid");

        $("#edit-test-sub-category-modal").modal('show');
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
            url: _base_url + "department/edit_laboratory_specimen",
            data: { hospital_id, department_id: did, specimen_id: id, specialty_id: sid, name, [csrf_name]: csrf_hash },
            success: function () { ReloadPage() },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#edit-specimen-name").addClass("is-invalid");
                $("#edit-specimen-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });

    $("#edit-tissue-name").on("focusout", function () {
        let tissueType = $(this).val();
        if (tissueType.trim().length > 0) {
            $("#edit-tissue-error-message").hide();
        }else{
            $("#edit-tissue-error-message").html("Please enter a tissue type value");
            $("#edit-tissue-error-message").show();
        }
    });

    $("#tissue-save-button").on("click", function () {
        let id = $("#t-specimen-id").val();
        let did = $("#t-department-id").val();
        let sid = $("#t-specialty-id").val();
        let name = $("#edit-tissue-name").val();

        if (name.trim().length === 0) {
            $("#edit-tissue-error-message").html("Please enter a tissue type value");
            $("#edit-tissue-error-message").show();
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/edit_laboratory_tissue",
            data: { hospital_id, id, name, [csrf_name]: csrf_hash },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    $("#edit-tissue").modal("hide");
                    $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                    location.reload();
                } else {
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });
    });

    $("#test-category-save-button").on("click", function () {
        let id = $("#s-test-category-id").val();
        let name = $("#s-test-category-name").val();


        if (name.trim().length === 0) {
            $("#s-test-category-name").addClass("is-invalid");
            $("#s-test-category-name").siblings(".invalid-feedback").html("Please provide a Test Category name");
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/edit_test_category",
            data: { id: id,name: name, [csrf_name]: csrf_hash },
            success: function () { ReloadPage(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#s-test-category-name").addClass("is-invalid");
                $("#s-test-category-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });

    $("#test-sub-category-save-button").on("click", function () {
        let id = $("#s-test-sub-category-id").val();
        let name = $("#s-test-sub-category-name").val();


        if (name.trim().length === 0) {
            $("#s-test-sub-category-name").addClass("is-invalid");
            $("#s-test-sub-category-name").siblings(".invalid-feedback").html("Please provide a Test Sub Category name");
            return;
        }

        $.ajax({
            type: "POST",
            url: _base_url + "department/edit_test_sub_category",
            data: { id: id,name: name, [csrf_name]: csrf_hash },
            success: function () { ReloadPage(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#s-test-sub-category-name").addClass("is-invalid");
                $("#s-test-sub-category-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });

    $(".delete-test-category").on("click", function () {
        let id = $(this).attr("data-id");

        $.ajax({
            type: "POST",
            url: _base_url + "department/delete_test_category",
            data: { id: id, [csrf_name]: csrf_hash },
            success: function () { location.reload(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#s-test-category-name").addClass("is-invalid");
                $("#s-test-category-name").siblings(".invalid-feedback").html(jqXHR.responseText);
            }
        });
    });

    $(".delete-test-sub-category").on("click", function () {
        let id = $(this).attr("data-id");

        $.ajax({
            type: "POST",
            url: _base_url + "department/delete_test_sub_category",
            data: { id: id, [csrf_name]: csrf_hash },
            success: function () { ReloadPage(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#s-test-sub-category-name").addClass("is-invalid");
                $("#s-test-sub-category-name").siblings(".invalid-feedback").html(jqXHR.responseText);
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

    $(".delete-tissue").on("click", function() {
        let did = $(this).attr('data-did');
        let sid = $(this).attr('data-sid');
        let id = $(this).attr('data-id');
        $("#delete-department-id").val(did);
        $("#delete-specialty-id").val(sid);
        $("#delete-tissue-id").val(id);
        $("#delete-error-message").hide();
        $("#delete-type").val('tissue_type');
        $("#delete-field-modal").modal('show');
    });

    $("#delete-field-button").on('click', function() {
        let type = $("#delete-type").val();
        let department_id = $("#delete-department-id").val();
        let specialty_id = $("#delete-specialty-id").val();
        let category_id = $("#delete-category-id").val();
        let specimen_id = $("#delete-specimen-id").val();
        let tissue_type_id = $("#delete-tissue-id").val();

        switch (type) {
            case "department":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_laboratory_department',
                    data: {hospital_id, department_id, [csrf_name]: csrf_hash},
                    success: function() { ReloadPage(); },
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
                break;
            case "specialty":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_laboratory_specialty',
                    data: {hospital_id, department_id, specialty_id, [csrf_name]: csrf_hash},
                    success: function() { ReloadPage(); },
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
                break;
            case "category":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_laboratory_category',
                    data: {hospital_id, department_id, specialty_id, category_id, [csrf_name]: csrf_hash},
                    success: function() { ReloadPage(); },
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
                break;
            case "specimen_type":
                $.ajax({
                    type: "POST",
                    url: _base_url + 'department/delete_laboratory_specimen',
                    data: {hospital_id, department_id, specialty_id, category_id, specimen_id, [csrf_name]: csrf_hash},
                    success: function() { ReloadPage(); },
                    error: function (jqXHR, textStatus, errorThrown) {$("#delete-error-message").html(jqXHR.responseText).show();}
                });
                break;
            case "tissue_type":
                $.ajax({
                    type: "POST",
                    url: _base_url + "department/delete_laboratory_tissue",
                    data: {hospital_id, department_id, specialty_id, tissue_type_id, [csrf_name]: csrf_hash},
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            $("#delete-field-modal").modal("hide");
                            $.sticky(response.message, {classList: 'success', speed: 200, autoclose: 7000});
                            ReloadPage();
                        } else {
                            $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                        }
                    }
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
        window.location.href = _base_url + "department/laboratory/" + h_id;
    });

});
