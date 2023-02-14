$(() => {

    $(".add-test-category-button").on('click', function() {
        let spec_id = $(this).attr('data-id');
        $("#test-category-specialty-id").val(spec_id);
        $("#add-test-category").modal('show');
    });



    $(".department-title .collapse-button, .specialty-title .collapse-button").on('click', function() {
        var icon = $(this).find("i");
        if (icon.hasClass("fa-caret-right")) {
            $(this).find("i").removeClass("fa-caret-right");
            $(this).find("i").addClass("fa-caret-down");
        } else {
            $(this).find("i").removeClass("fa-caret-down");
            $(this).find("i").addClass("fa-caret-right");
        }
    });

    setTimeout(function() {
        var current_url = new URL(window.location.href);
        if (current_url.searchParams.has('department')) {
            var dep_id = current_url.searchParams.get('department');
            $("#department-title-"+dep_id).trigger('click');
            if (current_url.searchParams.has('speciality')) {
                var spec_id = current_url.searchParams.get('speciality');
                $("#specialty-title-"+spec_id).trigger('click');
            }
        }
    }, 200);



    $(".edit-department").on('click', function() {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        
        let modal = $("#edit-field");
        modal.find(".modal-title").html("Edit Department Name");
        modal.find("#field-pa-container").hide();

        modal.find("#field-name").val(name);
        modal.find("#field-name").removeClass("is-invalid");
        modal.find("#field-name").siblings(".invalid-feedback").html("");
        modal.find("#field-id").val(id);
        modal.find("#field-type").val("department");
        
        modal.modal("show");
    });

    $(".edit-specialty").on('click', function() {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        
        let modal = $("#edit-field");
        modal.find(".modal-title").html("Edit Specialty Name");
        modal.find("#field-pa-container").hide();

        modal.find("#field-name").val(name);
        modal.find("#field-name").removeClass("is-invalid");
        modal.find("#field-name").siblings(".invalid-feedback").html("");
        modal.find("#field-id").val(id);
        modal.find("#field-type").val("speciality");
        
        modal.modal("show");
    });

    $(".edit-specimen").on('click', function() {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        
        let modal = $("#edit-field");
        modal.find(".modal-title").html("Edit Specimen Type Name");
        modal.find("#field-pa-container").hide();

        modal.find("#field-name").val(name);
        modal.find("#field-name").removeClass("is-invalid");
        modal.find("#field-name").siblings(".invalid-feedback").html("");
        modal.find("#field-id").val(id);
        modal.find("#field-type").val("specimen");
        
        modal.modal("show");
    });

    $(".edit-category").on('click', function() {
        let name = $(this).attr("data-name");
        let id = $(this).attr("data-id");
        let pa = $(this).attr("data-pa");
        
        let modal = $("#edit-field");
        modal.find(".modal-title").html("Edit Category Name");
        modal.find("#field-pa-container").show();

        modal.find("#field-name").val(name);
        modal.find("#field-name").removeClass("is-invalid");
        modal.find("#field-name").siblings(".invalid-feedback").html("");
        modal.find("#field-id").val(id);
        modal.find("#field-pa").val(pa);
        modal.find("#field-type").val("category");
        
        modal.modal("show");
    });
    
    
    $("#field-save-button").on('click', function() {
        let name = $("#field-name").val();
        let id = $("#field-id").val();
        let type = $("#field-type").val();
        let pa = $("#field-pa").val();
        $.ajax({
            type: "POST",
            url: _base_url+"department/admin/update",
            data: {name, id, type, pa, [csrf_name]: csrf_hash},
            success: function() {
                $("#edit-field").modal("hide");
                $("#"+type+"-text-"+id).html(name);
                if (type == "category") {
                    $("#category-text-pa-"+id).html("("+pa+")");
                }
            },
            error: function(xhr, status, err) {
                console.log(xhr);
                console.log(xhr.getAllResponseHeaders());
                
                $("#field-name").addClass("is-invalid");
                let msg = xhr.responseText;
                if (typeof msg === 'undefined' || msg === null || msg.length == 0) {
                    msg = "Something went wrong, Please try again later.";
                }
                $("#field-name").siblings(".invalid-feedback").html(msg);
            }
        })
    });


    $(".add-department-button").on('click', function() {

        let modal = $("#add-field");
        modal.find(".modal-title").html("Add Department");
        modal.find("#field-pa-add-container").hide();

        modal.find("#field-add-name").val('');
        modal.find("#field-add-name").removeClass("is-invalid");
        modal.find("#field-add-name").siblings(".invalid-feedback").html("");
        modal.find("#field-add-id").val('');
        modal.find("#field-add-pa").val(0);
        modal.find("#field-add-type").val("department");
        
        modal.modal("show");
    });

    $(".add-specialty-button").on('click', function() {

        let modal = $("#add-field");
        let id = $(this).attr("data-id");
        let name = $(this).attr("data-name");

        modal.find(".modal-title").html("Add "+name+" speciality");
        modal.find("#field-pa-add-container").hide();

        modal.find("#field-add-name").val('');
        modal.find("#field-add-name").removeClass("is-invalid");
        modal.find("#field-add-name").siblings(".invalid-feedback").html("");
        modal.find("#field-add-id").val(id);
        modal.find("#field-add-pa").val(0);
        modal.find("#field-add-type").val("speciality");
        
        modal.modal("show");
    });

    $(".add-category-button").on('click', function() {

        let modal = $("#add-field");
        let id = $(this).attr("data-id");
        let name = $(this).attr("data-name");

        modal.find(".modal-title").html("Add "+name+" category");
        modal.find("#field-pa-add-container").show();

        modal.find("#field-add-name").val('');
        modal.find("#field-add-name").removeClass("is-invalid");
        modal.find("#field-add-name").siblings(".invalid-feedback").html("");
        modal.find("#field-add-id").val(id);
        modal.find("#field-add-pa").val(0);
        modal.find("#field-add-type").val("category");
        
        modal.modal("show");
    });

    $(".add-specimen-button").on('click', function() {

        let modal = $("#add-field");
        let id = $(this).attr("data-id");
        let name = $(this).attr("data-name");

        modal.find(".modal-title").html("Add "+name+" specimen type");
        modal.find("#field-pa-add-container").hide();

        modal.find("#field-add-name").val('');
        modal.find("#field-add-name").removeClass("is-invalid");
        modal.find("#field-add-name").siblings(".invalid-feedback").html("");
        modal.find("#field-add-id").val(id);
        modal.find("#field-add-pa").val(0);
        modal.find("#field-add-type").val("specimen");
        
        modal.modal("show");
    });


    $("#field-add-button").on('click', function(event) {
        let name = $("#field-add-name").val();
        let id = $("#field-add-id").val();
        let type = $("#field-add-type").val();
        let pa = $("#field-add-pa").val();
        $.ajax({
            type: "POST",
            url: _base_url+"department/admin/add",
            data: {name, id, type, pa, [csrf_name]: csrf_hash},
            success: function(new_id) {
                $("#add-field").modal("hide");
                let current_url = new URL(_base_url + 'department/admin');
                if (current_url.searchParams.has('department')) {
                    current_url.searchParams.delete('department');
                }
                if (current_url.searchParams.has('speciality')) {
                    current_url.searchParams.delete('speciality');
                }
                if (type == 'speciality') {
                    current_url.searchParams.append('department', id);
                }

                if (type == 'category' || type == 'specimen') {
                    current_url.searchParams.append('speciality', id);
                    var dep_id = $("#category-"+id).parents(".department-specialties").attr("data-id");
                    current_url.searchParams.append('department', dep_id);
                }
                
                setTimeout(function() {
                    location.href = current_url.href;
                }, 500);
            },
            error: function(xhr, status, err) {
                console.log("Error occurred while adding");
                console.log(xhr);

                $("#field-add-name").addClass("is-invalid");
                let msg = xhr.responseText;
                if (typeof msg === 'undefined' || msg === null || msg.length == 0) {
                    msg = "Something went wrong, Please try again later.";
                }
                $("#field-add-name").siblings(".invalid-feedback").html(msg);
            }
        });
    });

    $(".delete-department").on("click", function() {
        let id = $(this).attr("data-id");
        $("#field-delete-id").val(id);
        $("#field-delete-type").val("department");
        $("#delete-field").modal('show');
    });

    $(".delete-speciality").on("click", function() {
        let id = $(this).attr("data-id");
        $("#field-delete-id").val(id);
        $("#field-delete-type").val("speciality");
        $("#delete-field").modal('show');
    });


    $(".delete-category").on("click", function() {
        let id = $(this).attr("data-id");
        $("#field-delete-id").val(id);
        $("#field-delete-type").val("category");
        $("#delete-field").modal('show');
    });

    $(".delete-specimen").on("click", function() {
        let id = $(this).attr("data-id");
        $("#field-delete-id").val(id);
        $("#field-delete-type").val("specimen");
        $("#delete-field").modal('show');
    });

    $("#field-delete-button").on("click", function() {
        let id = $("#field-delete-id").val();
        let type = $("#field-delete-type").val();
        $.ajax({
            type: "POST",
            url: _base_url+"department/admin/delete",
            data: {id, type, [csrf_name]: csrf_hash},
            success: function() {
                $("#delete-field").modal("hide");
                setTimeout(function() {
                    window.location.href = _base_url + 'department/admin';
                }, 500);
            },
            error: function(xhr, status, err) {
                console.log(xhr);
                console.log(xhr.getAllResponseHeaders());
                if (typeof msg === 'undefined' || msg === null || msg.length == 0) {
                    $("#delete-error-message").html("Something went wrong, Please try again later.");
                } else {
                    $("#delete-error-message").html(xhr.responseText);
                }
            }
        });
    });

});