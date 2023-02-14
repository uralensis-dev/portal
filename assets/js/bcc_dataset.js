    $(".edit_btn").click(function () {

        $('#edit_dataset').find('#hospital_id').val($(this).attr("data-hospital_id"));
        $('#edit_dataset').find('#hospital_id').trigger('change');

        $('#edit_dataset').find('#specialty_id').val($(this).attr("data-speciality_id"));
        $('#edit_dataset').find('#specialty_id').trigger('change');

        $('#edit_dataset').find('#edit_dataset_id').val($(this).attr("data-dataset_id"));
        
        $('#edit_dataset').find('#dataset_name').val($(this).attr("data-dataset_name"));
        
        $('#edit_dataset').find('#parent_dataset_id').val($(this).attr("data-parent_dataset_id"));
        $('#edit_dataset').find('#parent_dataset_id').trigger('change');


        $("#edit_dataset").modal();
    });