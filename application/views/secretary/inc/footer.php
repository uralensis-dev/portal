<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
</div>
</body>
<script src="<?php echo base_url('/assets/js/jquery.countTo.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/circle-progress.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/moment-with-locales.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.idle.min.js'); ?>"></script>

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
    $(document).ready(function () {

        /*Show Memorabale Word*/
        $("#show_mem").click(function (e) {
            e.preventDefault();
            if ($(".memorable").attr("type") == "password") {
                $(".memorable").attr("type", "text");
            }
            else {
                $(".memorable").attr("type", "password");
            }

        });

        /*********************************
         * Password Change Functionality
         ********************************/
        jQuery('#change_password_form').on('click', '#save_pass_btn', function (e) {
            e.preventDefault();
            var password_data = jQuery('#change_password_form').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/secretary/change_password_secretary'); ?>",
                data: password_data,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.type === 'success') {
                        jQuery('#confirm_pass_msg').html(response.msg);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    } else {
                        jQuery('#confirm_pass_msg').html(response.msg);
                    }
                }
            });
        });

        /**************************
         * Create DataTable Object
         **************************/
        $('#sec_doc_records').DataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $('div.dataTables_filter input').focus();

        oTable = $('#sec_view_records').dataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            fnDrawCallback: function () {
                show_flags_on_hover();
                display_comment_box_hover();
                add_flag_comments_box();
                change_flag_status();
                delete_flag_comments();
            }
        });

        $(document).on("click", ".flag_status", function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                console.log(aData);
                var flag_green = $('#flag_green').is(':checked');
                var flag_red = $('#flag_red').is(':checked');
                var flag_yellow = $('#flag_yellow').is(':checked');
                var flag_blue = $('#flag_blue').is(':checked');
                var flag_black = $('#flag_black').is(':checked');
                var flag_all = $('#flag_all').is(':checked');

                if (flag_green && aData[15] === 'flag_green') {
                    return true;
                } else if (flag_red && aData[15] === 'flag_red') {
                    return true;
                } else if (flag_yellow && aData[15] === 'flag_yellow') {
                    return true;
                } else if (flag_blue && aData[15] === 'flag_blue') {
                    return true;
                } else if (flag_black && aData[15] === 'flag_black') {
                    return true;
                } else if (flag_all) {
                    return true;
                }

                return false;
            });
            oTable.fnDraw();
        });

        /**************************
         * Tooltip Code
         *************************/
        $('#sec_doc_records tbody, #sec_view_records tbody').on('mouseover', 'tr', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });

        /***************************
         * Record Assigning Model
         **************************/
        function assign_records() {
            $(document).on('click', '.assign_record', function (e) {
                e.preventDefault();
                var _this = $(this);

                var form_data = _this.parents('.modal-body').find('#assign_rec_sec_form').serialize();
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/secretary/assign_record_secretary'); ?>",
                    data: form_data,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.type === 'success') {
                            jQuery('.sec_rec_assign').html(response.msg);
                            $('#assign_record').hide();
                            window.setTimeout(function () {
                                location.reload()
                            }, 2000);
                        } else {
                            jQuery('.sec_rec_assign').html(response.msg);
                        }
                    }
                });
            });
        }
        assign_records();
        /********************************
         * Add Special Notes
         ********************************/
        jQuery(document).on('click', '#add_special_notes', function (e) {
            e.preventDefault();
            var special_notes_data = jQuery('#special_notes_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/add_special_notes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: special_notes_data,
                success: function (response) {
                    if (response.type === 'error') {
                        jQuery('#special_notes_msg').show();
                        jQuery('#special_notes_msg').html(response.message);
                    } else {
                        jQuery('#special_notes_msg').show();
                        jQuery('#special_notes_msg').html(response.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });
        /********************************
         * Clear Special Notes
         ********************************/
        jQuery(document).on('click', '#clear_special_notes', function (e) {
            e.preventDefault();
            var special_notes_data = jQuery('#special_notes_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/clear_special_notes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: special_notes_data,
                success: function (response) {
                    if (response.type === 'error') {

                        jQuery('#special_notes_msg').show();
                        jQuery('#special_notes_msg').html(response.message);

                    } else {
                        jQuery('#special_notes_msg').show();
                        jQuery('#special_notes_msg').html(response.message);

                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        /*********************************
         * Add Comments Section
         *********************************/
        jQuery(document).on('click', '#add_comment_section', function (e) {
            e.preventDefault();
            var comment_form_data = jQuery('#comment_section_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/add_comments_section'); ?>',
                type: 'POST',
                dataType: 'json',
                data: comment_form_data,
                success: function (response) {
                    if (response.type === 'error') {

                        jQuery('#comment_section_msg').removeClass('alert alert-success');
                        jQuery('#comment_section_msg').addClass('alert alert-danger');
                        jQuery('#comment_section_msg').show();
                        jQuery('#comment_section_msg').text(response.message);
                    } else {

                        jQuery('#comment_section_msg').removeClass('alert alert-danger');
                        jQuery('#comment_section_msg').addClass('alert alert-success');
                        jQuery('#comment_section_msg').show();
                        jQuery('#comment_section_msg').text(response.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        /****************************************
         * Clear Comment Section
         ****************************************/
        jQuery(document).on('click', '#clear_comment_section', function (e) {
            e.preventDefault();
            var comment_form_data = jQuery('#comment_section_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/clear_comments_section'); ?>',
                type: 'POST',
                dataType: 'json',
                data: comment_form_data,
                success: function (response) {
                    if (response.type === 'error') {

                        jQuery('#comment_clear_section_msg').removeClass('alert alert-success');
                        jQuery('#comment_clear_section_msg').addClass('alert alert-danger');
                        jQuery('#comment_clear_section_msg').show();
                        jQuery('#comment_clear_section_msg').text(response.message);
                    } else {

                        jQuery('#comment_clear_section_msg').removeClass('alert alert-danger');
                        jQuery('#comment_clear_section_msg').addClass('alert alert-success');
                        jQuery('#comment_clear_section_msg').show();
                        jQuery('#comment_clear_section_msg').text(response.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        /******************************
         * Update Record
         ******************************/
        jQuery('#doctor_update_personal_record').on('submit', function (e) {
            e.preventDefault();
            var doctor_update_personal_record = jQuery('#doctor_update_personal_record').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/secretary/update_only_report'); ?>",
                data: doctor_update_personal_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery('#doctor_update_record_message').html(response.msg);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    } else {
                        jQuery('#doctor_update_record_message').html(response.msg);
                    }
                }
            });
        });

        /**************************************
         * Disbale Update Record Fields
         **************************************/
        jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", true).css('background', '#ccc');
        jQuery("#make_editable").on('click', function (e) {
            e.preventDefault();
            if (jQuery("#make_editable").hasClass('disable')) {
                jQuery("#make_editable").removeClass('disable');
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", false);
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").css('background', 'white');
                jQuery("#make_editable").text('Disable Fields');
                jQuery("#make_editable").addClass('enable');
            } else if (jQuery("#make_editable").hasClass('enable')) {
                jQuery("#make_editable").removeClass('enable');
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", true);
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").css('background', '#ccc');
                jQuery("#make_editable").text('Enable Fields');
                jQuery("#make_editable").addClass('disable');
            }

        });

        /***************************
         * Assign Education Cats
         ***************************/
        $('#education_cats').change(function (e) {
            e.preventDefault();
            var edu_cats = $('#education_cats option:selected').val();
            record_id = jQuery('#record_id').val();

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/secretary/set_teach_and_mdt'); ?>",
                data: {'record_id': record_id, 'edu_cats': edu_cats},
                dataType: "json",
                success: function (data) {
                    if (data.type === 'success') {
                        $('.teach_mdt_cpc_msg').html(data.msg);
                        $('.teach_mdt_cpc_msg').slideUp(2500);
                    }
                }
            });
        });

        /**************************
         * Assign MDT Cats
         **************************/
        $('#mdt_dates').change(function (e) {
            e.preventDefault();
            var mdt_dates = $('#mdt_dates option:selected').val();
            record_id = jQuery('#record_id').val();

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/secretary/set_teach_and_mdt'); ?>",
                data: {'record_id': record_id, 'mdt_dates': mdt_dates},
                dataType: "json",
                success: function (data) {
                    if (data.type === 'success') {
                        $('.teach_mdt_cpc_msg').html(data.msg);
                        $('.teach_mdt_cpc_msg').slideUp(2500);
                    }
                }
            });
        });

        /**************************************
         * Add Further Work
         **************************************/
        /*Open Furtherwork modal on click*/
        $(document).on('click', '#further_work_add', function (e) {
            e.preventDefault();
            var _this = $(this);
            var date = new Date();
            var slot_date = moment(date).format('DD-MM-YYYY h:mm:ss A');
            _this.next('#further_work').modal('show');
            _this.next('#further_work').find('#furtherwork_date').val(slot_date);
            _this.next('#further_work').find('#further_work_date_hide').val(slot_date);
        });
        $('#further_work_form').on('click', '#fw_submit_btn', function (e) {
            e.preventDefault();
            var fw_form = $('#further_work_form').serialize();
            if ($('#further_work_form input:checkbox').filter(':checked').length < 1) {
                alert("Check at least one Option!");
                return false;
            }
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/further_work'); ?>',
                type: 'POST',
                dataType: 'json',
                data: fw_form,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery('.fw_msg').html(data.msg);
                        window.setTimeout(function () {
                            location.reload()
                        }, 1800);
                    } else {
                        jQuery('.fw_msg').html(data.msg);
                    }
                }
            });
        });
    });

    /*Flag Comments Code*/
    function show_flags_on_hover() {
        $('#sec_view_records tbody .flag_column .hover_flags').hover(function () {
            _this = $(this);
            _this.find('ul.report_flags').fadeIn('fast');
        }, function () {
            _this.find('ul.report_flags').fadeOut('fast');
            return false;
        }
        );
    }
    function display_comment_box_hover() {

        $('#sec_view_records .flag_column .comments_icon').on('click', '.show_comments_list', function (event) {
            var _this = $(this);
            var record_id = _this.data('recordid');
            dynamic_id = _this.data('modalid');
            $('#display_comments_list-' + dynamic_id).modal('show');

            $.ajax({
                url: '<?php echo base_url('/index.php/secretary/show_comments_box'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'record_id': record_id},
                success: function (data) {
                    if (data.type === 'error') {
                        $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').addClass('alert alert-danger');
                        $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').html(data.msg);
                    } else {
                        $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').addClass('alert alert-success');
                        $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').html(data.msg);
                        $('#display_comments_list-' + dynamic_id).find('.flag_comments_dynamic_data').html(data.flag_data);

                        window.setTimeout(function () {
                            $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').slideUp('slow');
                        }, 1500);
                    }
                }
            });
        });
    }
    function add_flag_comments_box() {
        $('#sec_view_records .flag_column .comments_icon').on('click', '#display_comment_box', function (e) {
            e.preventDefault();
            var _this = $(this);
            dynamic_id = _this.data('modalid');
            $('#flag_comment_model-' + dynamic_id).modal('show');
            $(document).on('click', '#flag_comments_save', function (e) {
                e.preventDefault();
                var _this = $(this);
                var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
                $.ajax({
                    url: '<?php echo base_url('/index.php/secretary/save_flag_comments'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: form_data,
                    success: function (data) {
                        if (data.type === 'error') {
                            _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').addClass('alert alert-danger').show();
                            _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').html(data.msg);
                        } else {
                            _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').addClass('alert alert-success').show();
                            _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').html(data.msg);
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                });
            });
        });
    }
    function change_flag_status() {
        $('#sec_view_records .flag_column').on('click', '.flag_change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');

            $.ajax({
                url: '<?php echo base_url('/index.php/secretary/set_flag_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'flag_status': _flag, 'record_id': _recordid},
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.flag_column').find('.flag_images').html(data.flag_data);
                        $(_this.parents('.report_flags').find('li')).each(function () {
                            $(this).removeClass('flag_active');
                        });
                        _this.parent('li').addClass('flag_active');
                    }
                }
            });
        });
    }
    function delete_flag_comments() {
        $(document).on('click', '#delete_flag_comment', function (e) {
            e.preventDefault();
            var _this = $(this);
            var flag_id = _this.data('flagid');
            var parent = _this.parent("li");
            $.ajax({
                url: '<?php echo base_url('/index.php/secretary/delete_flag_comments'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'flag_id': flag_id},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                    }
                }
            });
        });
    }

    $(document).ready(function () {
        var timer;
        $('.doctor_update_specimen .specimen_microscopic_code').on('keyup', function (e) {
            e.preventDefault();
            var _this = $(this);
            var micro_code = _this.val();
            var form_id = _this.data('formid');

            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/secretary/set_populate_micro_data'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'micro_code': micro_code},
                    beforeSend: function () {
                        $("#ajax_loading_effect").fadeIn();
                    },
                    success: function (data) {
                        if (data.type === 'error') {
                            $("#ajax_loading_effect").fadeOut();
                        } else {
                            window.setTimeout(function () {
                                $.each(data, function (index, value) {
                                    if (index === 'umc_classification') {
                                        var classification = value;
                                        classification_array = classification.split(',');
                                        var specimen_check_val = _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_classification');
                                        $(specimen_check_val).each(function (index, value) {
                                            var _this = $(this);
                                            var classi_value = _this.val();
                                            if ($.inArray(classi_value, classification_array) !== -1) {
                                                _this.prop('checked', true);
                                            }
                                        });
                                    } else if (index === 'umc_snomed_t_code') {
                                        var snomed_t_code = value;
                                        snomed_t_code_array = snomed_t_code.split(',');
                                        var snomed_t_code_val = _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_snomed_t');
                                        $(snomed_t_code_val).selectpicker('val', snomed_t_code_array);
                                    } else if (index === 'umc_snomed_p_code') {
                                        var snomed_p_code = value;
                                        snomed_p_code_array = snomed_p_code.split(',');
                                        var snomed_p_code_val = _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_snomed_p');
                                        $(snomed_p_code_val).selectpicker('val', snomed_p_code_array);
                                    } else if (index === 'umc_snomed_m_code') {
                                        var snomed_m_code = value;
                                        snomed_m_code_array = snomed_m_code.split(',');
                                        var snomed_m_code_val = _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_snomed_m');
                                        $(snomed_m_code_val).selectpicker('val', snomed_m_code_array);
                                    } else {
                                        if (index === 'umc_cancer_register') {
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_cancer').val(value);
                                        }
                                        if (index === 'umc_disgnosis') {
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_dignosis').val(value);
                                        }
                                        if (index === 'umc_micro_desc') {
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_microscopic_description').val(value);
                                        }
                                        if (index === 'umc_rcpath_score') {
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find('.rcpath_code').val(value);
                                        }
                                    }
                                });
                                $("#ajax_loading_effect").fadeOut();
                            }, 2500);
                        }
                    }
                });
            }, 2000);
        });
    });

    /*********************************************
     * Add Record Form Code
     *********************************************/
    jQuery(document).ready(function () {
        jQuery("#admin_choose_hospital").change(function () {
            $("#clrk").load("<?php echo base_url('index.php/secretary/get_clinician_auto_populated'); ?>?hospital_user_id=" + $("#admin_choose_hospital").val());
            $("#dermatological_surgeon").load("<?php echo base_url('index.php/secretary/get_dermatological_surgeon_auto_populated'); ?>?hospital_user_id=" + $("#admin_choose_hospital").val());
        }).trigger("change");

        $(document).on('change', '#admin_choose_hospital', function () {
            var _this = $(this);
            var hospital_id = _this.val();
            _this.parents('#add_record_form').find('#check_form').hide();
            _this.parents('#add_record_form').find('.dynamic_data').show();
            _this.parents('#add_record_form').find('.hospital_id').val(hospital_id);
        });

        /*Find Matching NHS Number*/
        var timer;
        $('#nhs_number').on('keyup', function (e) {
            e.preventDefault();
            var nhs_number = $('#nhs_number').val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/secretary/find_matching_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'nhs_number': nhs_number},
                    success: function (data) {
                        console.log(data);
                        if (data.type === 'error') {
                        } else {
                            $("#ajax_loading_effect").fadeIn();
                            window.setTimeout(function () {
                                for (var i = 0; i < data.find_match_record.length; i++) {
                                    $('#patient_initial').val(data.find_match_record[i].patient_initial);
                                    $('#first_name').val(data.find_match_record[i].f_name);
                                    $('#sur_name').val(data.find_match_record[i].sur_name);
                                    $('#dob').val(data.find_match_record[i].dob);
                                    $('#gender').val(data.find_match_record[i].gender);
                                }
                                $("#ajax_loading_effect").fadeOut();
                            }, 2200);
                        }
                    }
                });
            }, 1000);
        });

        /*Check Lab Number*/
        var timer;
        $('#add_record_form').on('keyup', '#lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_number = _this.val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/secretary/find_lab_number_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'lab_number': lab_number},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            _this.parents('#add_record_form').find('.check_form').hide();
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            _this.parents('#add_record_form').find('.check_form').show();
                        }
                    }
                });
            }, 1200);
        });

        var timer;
        $('#doctor_update_personal_record').on('keyup', '#lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_number = _this.val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/secretary/find_lab_number_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'lab_number': lab_number},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            _this.parents('#doctor_update_personal_record').find('.check_form').hide();
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            _this.parents('#doctor_update_personal_record').find('.check_form').show();
                        }
                    }
                });
            }, 1200);
        });

        jQuery('#dob, #date_taken, #date_received_bylab, #data_processed_bylab, #date_sent_touralensis').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });
        jQuery('#date_to, #date_from').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });

        jQuery("#add_record_form").validate({
            errorElement: "span",
            wrapper: "span", // a wrapper around the error message
            errorPlacement: function (error, element) {
                offset = element.offset();
                error.insertBefore(element);
                error.addClass('label label-danger');  // add a class to the wrapper

            }
        });

        jQuery('#finish_specimen').bind('click', function (e) {
            e.preventDefault();
            if (!confirm('Are You Sure You Want To Exit.')) {
                return false;
            } else {
                window.location.href = "<?php echo base_url('/index.php/secretary/view_reports'); ?>";
            }
        });
    });

    /***************************************
     * Assign MDT Dates
     ***************************************/
    $(document).ready(function () {
        /*Show / Hide MDT Options*/
        $('#mdt_dates').hide();
        $('.hide_report_option').hide();
        $('.mdt_specimen_hide').hide();
        $(document).on('change', '.mdt_radio', function (e) {
            e.preventDefault();
            if ($('#for_mdt').is(':checked')) {
                $('.hide_report_option').hide();
                $('#mdt_dates').show();
                $('.mdt_specimen_hide').show();
            } else {
                $('#mdt_dates').hide();
                $('.hide_report_option').show();
                $('.mdt_specimen_hide').hide();
            }
        });

        /*Send MDT Form Data*/
        $('#assign_mdt_record').on('click', function (e) {
            e.preventDefault();
            if (!$('.mdt_radio').is(':checked')) {
                alert('Please Select One Of The MDT Option');
            } else if ($('input[name=mdt_dates_radio]:checked').val() === 'for_mdt' && $('#mdt_dates').val() === 'false') {
                alert('Please Select MDT Date');
            } else if ($('input[name=mdt_dates_radio]:checked').val() === 'not_for_mdt' && !$('.report_option').is(':checked')) {
                alert('Please Select Add To Report OR Not To Add To Report');
            } else {
                var form_data = $('#mdt_from_data').serialize();
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/secretary/assign_mdt_record'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            $('.mdt_dates_msg').html(data.msg);
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            window.setTimeout(function () {
                                location.reload();
                            }, 2500);
                        }
                    }
                });
            }
        });

        /*Find MDT Records*/
        $(document).on('change', '#mdt_dates', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = $('#mdt_hospital_id').val();
            var mdt_date = $('#mdt_dates').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/find_mdt_cases'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'mdt_date': mdt_date},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_mdt_data').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_mdt_data').html(data.mdt_data);
                    }
                }
            });
        });

        /*Find Previous MDT Dates*/

        $(document).on('change', '#prev_mdt_dates', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = $('#prev_mdt_hospital_id').val();
            var mdt_date = $('#prev_mdt_dates').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/find_prev_mdt_cases'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'prev_mdt_date': mdt_date},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_prev_mdt_data').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_prev_mdt_data').html(data.mdt_prev_data);
                    }
                }
            });
        });


        /*Find MDT Dates Based ON Hospital ID*/
        $('#mdt_hospital_id').on('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/find_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data').html(data.dates_data);
                    }
                }
            });
        });

        /*Find Previous MDT Dates Based ON Hospital ID*/
        $('#prev_mdt_hospital_id').on('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/find_prev_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data_prev').html(data.dates_prev_data);
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        /*********************************************
         * Clinic Date Field
         *******************************************/
        jQuery('#clinic_date, #batch_courier_collec_date').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });
        /************************************************
         * Create the datatables object
         **********************************************/
        $('#clinic_upcoming, #clinic_previous, #clinic_date_records, #clinic_batches_list').DataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        /**************************************************
         * Delete Clinic Upload Files
         *************************************************/
        $('#edit_clinic_date_form .delete_clinic_files').on('click', function (e) {
            e.preventDefault();
            var _this = $(this);
            var file_type = _this.data('filetype');
            var file_id = _this.data('fileid');
            var hospital_id = _this.data('hospitalid');
            var parent = $(this).parent("li");
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/delete_clinic_upload_files'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'file_type': file_type, 'file_id': file_id, 'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                    }
                }
            });
        });
        /**********************************************************
         * Clinic Reference Auto Suggest Code Start
         *********************************************************/
        var timer;
        $('#add_record_form input.clinic_reference').typeahead({
            name: 'clinic_reference',
            remote: {
                url: '<?php echo base_url('index.php/secretary/clinic_reference_autosuggest?query=%QUERY'); ?>',
                replace: function (url, uriEncodedQuery) {
                    var hospital_id = $('.hospital_id').val();
                    if (!hospital_id)
                        return url.replace("%QUERY", uriEncodedQuery);
                    return url.replace("%QUERY", uriEncodedQuery) + '&hospital_id=' + encodeURIComponent(hospital_id);
                }
            },
            limit: 100
        }).on('typeahead:selected', function (event, selection) {
            var _this = $(this);
            _this.parents('#add_record_form').find('.clinic_reference_id').attr('value', selection.key);
            var clinic_record_id = selection.key;
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/secretary/set_populate_request_form'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'clinic_record_id': clinic_record_id},
                    beforeSend: function () {
                        $("#ajax_loading_effect").fadeIn();
                    },
                    success: function (data) {
                        if (data.type === 'error') {
                            $("#ajax_loading_effect").fadeOut('fast');
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                            _this.parents('#add_record_form').find('.check_form').hide();
                            _this.parents('#add_record_form').find('.request_form_dynamic').html('');
                        } else {
                            window.setTimeout(function () {
                                _this.parents('#add_record_form').find('#check_form').show();
                                _this.parents('#add_record_form').find('.request_form_dynamic').show();
                                _this.parents('#add_record_form').find('.request_form_dynamic').append(data.encode_data);
                                $("#ajax_loading_effect").fadeOut();
                                _this.parents('#add_record_form').find('.check_form').show();
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            }, 2000);
                        }
                    }
                });
            }, 150);
        });
        /***************************************************
         * Clinic Documents Hover View
         **************************************************/
        $('#edit_clinic_date_form .hover_image').hover(function (e) {
            e.preventDefault();
            var _this = $(this);
            ext_type = _this.data('exttype');
            image_url = _this.data('imageurl');
            _this.next('.hover_' + ext_type).attr('src', image_url);
            _this.next('.hover_' + ext_type).show();
        });
        $('#edit_clinic_date_form #close_hover_image').on('click', function (e) {
            ext_type = $('.hover_image').data('exttype');
            e.preventDefault();
            $('.hover_image_frame').hide();
        });
        /*********************************************
         * Add Courier Form
         ********************************************/
        $('#add_courier_form').on('click', '.add_courier', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#add_courier_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/add_courier'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 2000});
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2500);
                    }
                }
            });
        });
        /*******************************************
         * Select Hospital TO Display Courier.
         ******************************************/
        $(document).on('change', '.courier_hospital_record', function () {
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/display_courier_records'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.row').find('.courier_records_data').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.row').find('.courier_records_data').html(data.encode_data);
                        _this.parents('.row').find('.courier_records_data #courier_records_table').DataTable({
                            ordering: false,
                            "processing": true,
                            stateSave: true,
                            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                        });
                        /***********************************************
                         * Delete Courier Records
                         *********************************************/
                        _this.parents('.row').find('.courier_records_data #courier_records_table').on('click', '.delete_courier_id', function (e) {
                            e.preventDefault();
                            var _this = $(this);
                            var courier_id = _this.data('courierid');
                            var parent = _this.parent('td').parent('tr');
                            if (confirm("Are You Sure You Want To Delete This Record.")) {
                                jQuery.ajax({
                                    url: '<?php echo base_url('/index.php/secretary/delete_courier'); ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {'courier_id': courier_id},
                                    success: function (data) {
                                        if (data.type === 'error') {
                                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                        } else {
                                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                            parent.css("background-color", "#ffe6e6");
                                            parent.fadeOut(1700, function () {
                                                parent.remove();
                                            });
                                        }
                                    }
                                });
                            } else {
                                return false;
                            }
                        });
                    }
                }
            });
        });
        /*************************************************************
         * Generate Batch Reference Key Based on Hospital Selection
         ************************************************************/
        $(document).on('change', '#batch_hospital_id', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/generate_batch_key'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('#add_batch_form').find('.batch_ref_key').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('#add_batch_form').find('.batch_ref_key').html(data.batch_key_data);
                    }
                }
            });
        });
        /*************************************************************
         * Generate Courier List based on hospital
         ************************************************************/
        $(document).on('change', '#batch_hospital_id', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/generate_courier_list'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('#add_batch_form').find('.batch_courier_data').html('');
                        _this.parents('#add_batch_form').find('.batch_add_btn').hide();
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('#add_batch_form').find('.batch_add_btn').show();
                        _this.parents('#add_batch_form').find('.batch_courier_data').html(data.batch_courier_data);
                    }
                }
            });
        });
        /*************************************************************
         * Display Courier Cost Code Price by selecting the courier.
         ************************************************************/
        $(document).on('change', '#batch_courier', function (e) {
            e.preventDefault();
            var _this = $(this);
            var courier_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/display_courier_cost_code'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'courier_id': courier_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('#add_batch_form').find('.batch_courier_cost_code_price').html('');
                        _this.parents('#add_batch_form').find('.batch_add_btn').hide();
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('#add_batch_form').find('.batch_courier_cost_code_price').html(data.courier_cost_code);
                        _this.parents('#add_batch_form').find('.batch_add_btn').show();
                    }
                }
            });
        });
        /*****************************
         * Submit Batch Form Data
         ***************************/
        $('#add_batch_form').on('click', '.batch_add_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#add_batch_form').serialize();
            $("#ajax_loading_effect").fadeIn();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/save_batch_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 2000});
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });
        });
        /*******************************************
         * Select Hospital TO Display Courier.
         ******************************************/
        $(document).on('change', '.batch_courier_hospital_record', function () {
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/secretary/display_batch_courier_records'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.row').find('.courier_batch_records_data').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.row').find('.courier_batch_records_data').html(data.encode_data);
                        _this.parents('.row').find('.courier_batch_records_data #batch_courier_records_table').DataTable({
                            ordering: false,
                            "processing": true,
                            stateSave: true,
                            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                        });
                        /***********************************************
                         * Delete Courier Records
                         *********************************************/
                        _this.parents('.row').find('.courier_batch_records_data #batch_courier_records_table').on('click', '.delete_batch_courier_id', function (e) {
                            e.preventDefault();
                            var _this = $(this);
                            var batch_courier_id = _this.data('batchcourierid');
                            var parent = _this.parent('td').parent('tr');
                            if (confirm("Are You Sure You Want To Delete This Record.")) {
                                jQuery.ajax({
                                    url: '<?php echo base_url('/index.php/secretary/delete_batch_courier'); ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {'batch_courier_id': batch_courier_id},
                                    success: function (data) {
                                        if (data.type === 'error') {
                                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                        } else {
                                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                            parent.css("background-color", "#ffe6e6");
                                            parent.fadeOut(1700, function () {
                                                parent.remove();
                                            });
                                        }
                                    }
                                });
                            } else {
                                return false;
                            }
                        });
                    }
                }
            });
        });
        /**********************************
         * Print Timestamps for batch buttons
         ********************************/
        $('#edit_batch_form').on('click', '.batch_collection', function (e) {
            e.preventDefault();
            var date = new Date();
            slot_date = moment(date).format('DD-MM-YYYY h:mm:ss A');
            _this = $(this);
            collect_type = _this.data('batchcollection');
            switch (collect_type) {
                case 'collect_courier':
                    _this.parents('#edit_batch_form').find('.col_by_courier_date').html('<label class="label label-success" style="font-size:12px;">' + slot_date + '</labe>');
                    _this.parents('#edit_batch_form').find('#batch_collect_by_courier').val(slot_date);
                    break;
                case 'rec_by_lab':
                    _this.parents('#edit_batch_form').find('.rec_by_lab_date').html('<label class="label label-success" style="font-size:12px;">' + slot_date + '</labe>');
                    _this.parents('#edit_batch_form').find('#batch_rec_by_lab').val(slot_date);
                    _this.parents('#edit_batch_form').find('#rec_by_lab_active').val('rec_by_lab_true');
                    break;
                case 'sent_to_admin':
                    _this.parents('#edit_batch_form').find('.sent_to_admin_date').html('<label class="label label-success" style="font-size:12px;">' + slot_date + '</labe>');
                    _this.parents('#edit_batch_form').find('#batch_sent_to_admin').val(slot_date);
                    break;
                default:
                    _this.parents('#edit_batch_form').find('.rec_by_admin_date').html('<label class="label label-success" style="font-size:12px;">' + slot_date + '</labe>');
                    _this.parents('#edit_batch_form').find('#batch_rec_by_admin').val(slot_date);
            }

        });
    });

    //Request To Check If User is Still Logged In
    $(document).ready(function () {
        $(document).idle({
            onIdle: function () {
                jQuery.sticky('Session has timedout, Please wait while the page refresh.', {classList: 'success', speed: 200, autoclose: 7000});
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            },
            onShow: function () {

            },
            idle: 7210000,
            events: 'mousemove keydown mousedown touchstart'
        });
    });
</script>
</html>