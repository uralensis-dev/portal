<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
<footer class="footer">
    <div class="container">

    </div>
</footer>
</div>
</body>
<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js'); ?>"></script>
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
<script>
    jQuery(document).ready(function () {

        /*Navigation Code */
        $('ul.nav li.dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
        });
        /*Navigation Code */

        jQuery('#selectall').click(function (event) {  //on click 
            if (this.checked) { // check select status
                jQuery('.check_selected').each(function () { //loop through each checkbox
                    this.checked = true; //select all checkboxes with class "checkbox1"               
                });
            } else {
                jQuery('.check_selected').each(function () { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"                       
                });
            }
        });

        /**
         * Datatables Code
         */
        $('#admin_display_tracking, #user_tracking_table, #failed_login_attempts_table').DataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $('div.dataTables_filter input').focus();
        /**********************************/

        $('#admin_display_records').on('mouseover', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
        $('.flag_column').on('mouseover', 'li', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
        $('.flag_sorting').on('mouseover', 'label', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
        jQuery('#update_personal_record').on('click', function (e) {
            e.preventDefault();
            var update_persoanl_record = jQuery('#personal_record_form').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url() . '/index.php/Admin/update_personal_report'; ?>",
                data: update_persoanl_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $('#display_track_addded_records').dataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            fnDrawCallback: function () {
                show_flags_on_hover();
                show_comment_box_hover();
                display_comment_box();
                change_flag_status();
                delete_flag_comment();
            }
        });

        jQuery('#dob, #date_taken, #date_received_bylab, #data_processed_bylab, #date_sent_touralensis').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });
        jQuery('#date_to, #date_from, #case_cost_date_from, #case_cost_date_to').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });

        jQuery("#add_record_form").validate({
            errorElement: "span",
            wrapper: "span", // a wrapper around the error message
            errorPlacement: function (error, element) {
                offset = element.offset();
                error.insertBefore(element);
                error.addClass('label label-danger'); // add a class to the wrapper

            }
        });
        jQuery('#finish_specimen').bind('click', function (e) {
            e.preventDefault();
            if (!confirm('Are You Sure You Want To Exit.')) {
                return false;
            } else {
                window.location.href = "<?php echo base_url('/index.php/admin/home'); ?>";
            }
        });

        jQuery('#admin_display_records, #display_track_addded_records').on('click', '.record_id_unpublish', function () {
            var record_url = jQuery(this).data('unpublishrecordid');
            var record_serial = jQuery(this).data('recordserial');
            if (confirm("Are You Sure You Want To Un Publish This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });
        jQuery('#admin_display_records, #display_track_addded_records').on('click', '.record_id_delete', function () {
            var record_url = jQuery(this).data('delrecordid');
            var record_serial = jQuery(this).data('recordserial');
            if (confirm("Are You Sure You Want To Delete This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

        jQuery('#assign_doc_form').on('click', '#doc_assign_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.prop('disabled', true);
            var doc_assign_data = jQuery('#assign_doc_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/save_assign_doctor'); ?>',
                type: 'POST',
                dataType: 'json',
                data: doc_assign_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        jQuery('#assign_doc_form').on('click', '#assign_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            $("#ajax_loading_effect").fadeIn();
            var batch_assign_data = jQuery('#assign_doc_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/save_batch_assign'); ?>',
                type: 'POST',
                dataType: 'json',
                data: batch_assign_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $("#ajax_loading_effect").fadeOut();
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        _this.prop('disabled', true);
                        window.setTimeout(function () {
                            $("#ajax_loading_effect").fadeOut('fast');
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            location.reload();
                        }, 4000);
                    }
                }
            });
        });

        jQuery('#save_cost_codes').on('click', '#save_cost_codes_btn', function (e) {
            e.preventDefault();
            var form_data = jQuery('#save_cost_codes').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/save_cost_codes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery('.cost_code_msg').html(data.msg);
                    } else {
                        jQuery('.cost_code_msg').html(data.msg);
                        window.setTimeout(function () {
                            location.reload()
                        }, 3000);
                    }
                }
            });
        });

        jQuery('#update_cost_codes').on('click', '#update_cost_codes_btn', function (e) {
            e.preventDefault();
            var form_data = jQuery('#update_cost_codes').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/update_cose_codes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery('.cost_code_msg').html(data.msg);
                    } else {
                        jQuery('.cost_code_msg').html(data.msg);
                        window.setTimeout(function () {
                            window.location.href = '<?php echo base_url('/index.php/admin/manage_cost_codes'); ?>';
                        }, 3000);
                    }
                }
            });
        });

        jQuery('.hospital_list').on('change', function (e) {
            e.preventDefault();
            var hospital_group_id = $("option:selected", this).val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/display_cost_codes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_group_id': hospital_group_id},
                success: function (data) {

                    if (data.type === 'error') {
                        jQuery('.display_cost_code_msg').html(data.msg);
                    } else {
                        if (data.type === 'not_found') {
                            jQuery('#display_cost_table').hide();
                            jQuery('.display_cost_code_msg').html(data.msg);
                        } else {
                            jQuery('#display_cost_table').show();
                            jQuery('#display_cost_table').html(data.cost_data);
                            jQuery('.display_cost_code_msg').html(data.msg);
                            jQuery('.display_cost_code_msg').hide(3000);
                            jQuery('.delete_cost_code').on('click', function (e) {
                                e.preventDefault();
                                var cost_id = jQuery(this).data('cost_id');
                                var parent = $(this).parent("td").parent("tr");
                                jQuery.ajax({
                                    url: '<?php echo base_url('/index.php/admin/delete_cost_code'); ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {'cost_id': cost_id},
                                    success: function (data) {
                                        if (data.type === 'success') {
                                            parent.fadeOut('slow', function () {
                                                parent.remove();
                                            });
                                            jQuery('.display_cost_code_msg').html(data.msg);
                                            jQuery('.display_cost_code_msg').show();
                                        } else {
                                            jQuery('.display_cost_code_msg').html(data.msg);
                                        }
                                    }
                                });
                            });
                        }
                    }
                }
            });
        });

        $('.cost_type_btn').click(function () {
            $('#add_cost_code_type').modal('toggle');
        });

        var timer;
        $('#nhs_number').on('keyup', function (e) {
            e.preventDefault();
            var nhs_number = $('#nhs_number').val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/admin/find_matching_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'nhs_number': nhs_number},
                    success: function (data) {
                        console.log(data);
                        if (data.type === 'error') {
                            //jQuery('.cost_code_msg').html(data.msg);
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

        var timer;
        $('#add_record_form').on('keyup', '#lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_number = _this.val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/admin/find_lab_number_records'); ?>',
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

        $('#personal_record_form').on('keyup keypress blur change changeData focus', '#lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_number = _this.val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/admin/find_lab_number_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'lab_number': lab_number},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            _this.parents('#personal_record_form').find('#update_personal_record').hide();
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            _this.parents('#personal_record_form').find('#update_personal_record').show();
                        }
                    }
                });
            }, 1200);
        });

        $('#teach_and_mdt_cats').on('click', '#add_tech_mdt_parent', function (e) {
            e.preventDefault();
            var teach_and_mdt_cats = $('#teach_and_mdt_cats').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/add_teach_mdt_cats'); ?>',
                type: 'POST',
                dataType: 'json',
                data: teach_and_mdt_cats,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.parent_cat_msg').html(data.msg);
                        $('.parent_cat_msg').fadeOut(2000);
                    } else {
                        $('.parent_cat_msg').html(data.msg);
                        $('.parent_cat_msg').show();
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        $('#teach_and_mdt_cats_child').on('click', '#add_tech_mdt_child', function (e) {
            e.preventDefault();
            var teach_and_mdt_cats_child = $('#teach_and_mdt_cats_child').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/add_teach_mdt_cats'); ?>',
                type: 'POST',
                dataType: 'json',
                data: teach_and_mdt_cats_child,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.child_cat_msg').show();
                        $('.child_cat_msg').html(data.msg);
                        $('.child_cat_msg').fadeOut(3000);
                    } else {
                        $('.child_cat_msg').show();
                        $('.child_cat_msg').html(data.msg);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        /****************************************
         * Initialize Date Time Picker Object
         **************************************/

        $(function () {
            $('#mdt_dates').datetimepicker({
                format: 'DD-MM-YYYY LT',
                ignoreReadonly: true
            });
        });

        /*****************************************
         * Delete MDT, CPC And Teach Categories.
         *****************************************/

        $('#mdt_teach_cpc_list .delete_mdt_tec_cpc').on('click', function (e) {
            e.preventDefault();
            var teachcpcid = $(this).data('mdtcpcteach');
            var parent = $(this).parent("li");
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_teach_cpc_teach'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'teachcpcid': teachcpcid},
                success: function (data) {
                    if (data.type === 'error') {
                        $('.mdt_del_msg').html(data.msg);
                    } else {
                        $('.mdt_del_msg').html(data.msg);
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                    }
                }
            });
        });

        /**---------------------------------------
         * Add MDT lists
         *------------------------------------*/
        $(document).on('click', '.add_mdt_list_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#add_mdt_list').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/add_mdt_lists'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('#add_mdt_list').next('.display_mdt_list_table').append(data.encode_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**********************
         * Add MDT Dates
         **********************/
        $('#add_mdt_date_btn').on('click', function (e) {
            e.preventDefault();
            var form_data = $('#mdt_dates_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/add_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /***********************************
         * Find MDT Dates By Hospital
         **********************************/
        $('#find_hospital_id').on('change', function (e) {
            e.preventDefault();
            var hospital_id = $('#find_hospital_id').val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/find_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'find_hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        $('#display_mdt_dates').html(data.mdt_data);
                    }
                }
            });
        });

        /************************************
         * Delete MDT Dates
         ************************************/
        $(document).on('click', 'a.mdt_date_delete', function (e) {
            e.preventDefault();
            var mdtid = $(this).data('mdtdate');
            var parent = $(this).parent("li");
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'mdt_date': mdtid},
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
        });

        $(function () {
            $("#search_users").autocomplete({
                source: '<?php echo base_url('index.php/admin/get_users_list'); ?>',
                select: function (event, ui) {
                    $('#get_user_id').val(ui.item.id);
                }
            });
        });

        $('#pm_message_form').on('click', '#send_message', function (e) {
            e.preventDefault();
            var msg_form = $('#pm_message_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/insert_pm_by_admin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: msg_form,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.compose_msg').show();
                        $('.compose_msg').html(data.msg);
                    } else {
                        $('.compose_msg').html(data.msg);
                        $('.compose_msg').fadeOut(2000);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        /*Trash Inbox*/
        $('.trash_inbox').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent("span").parent("div.list-group-item");
            var trash_item_id = jQuery(this).data('trashinboxid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/msg_trashinbox_admin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'trash_id': trash_item_id},
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

        /*Trash Items*/
        $('.trash_sent').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent("span").parent("div.list-group-item");
            var trash_item_id = jQuery(this).data('trashsentid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/msg_trashsent_admin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'trash_id': trash_item_id},
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

        /*Delete Items*/
        $('.trash_permanent').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent("span").parent("div.list-group-item");
            var delete_item_id = jQuery(this).data('deleteid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_trash_admin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'delete_id': delete_item_id},
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

        /*Tracking Code*/
        $(function () {
            $('#sent_to_lab_date, #pickup_date, #to_doc_date, #batch_clinic, #edit_batch_clinic').datetimepicker();
        });

        /*Assign Roles Code*/
        $('#roles_name').on('change', function (e) {
            e.preventDefault();
            var roles_form_data = $('#assign_roles_form').serialize();
            var role_name = $('#roles_name').text();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/auth/assign_users_roles'); ?>',
                type: 'POST',
                dataType: 'json',
                data: roles_form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /*Check Phone Verification*/
        $('#phone_verify').on('click', function (e) {
            e.preventDefault();
            var get_phone = $('#verify_phone').val();
            var get_url = $(this).data('setvarifypath');
            jQuery.ajax({
                url: get_url,
                type: 'POST',
                dataType: 'json',
                data: {phone_no: get_phone},
                beforeSend: function () {
                    $('#loader').show();
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $('.auth_message').html(data.msg);
                    } else {
                        $('.auth_message').html(data.msg);
                        window.setTimeout(function () {
                            window.location.href = "<?php echo base_url('index.php/auth/check_auth'); ?>";
                        }, 3000);
                    }
                },
                complete: function () {
                    $('#loader').hide();
                }
            });
        });

        /*Check Access Token*/
        $('#access_token').on('click', function (e) {
            e.preventDefault();
            var token = $('#verify_auth').val();
            var remember_device = $('#remember_this_access').prop('checked');
            if (remember_device === true) {
                var remember = 'true';
            } else {
                var remember = 'false';
            }

            var acces_url = $(this).data('setaccesspath');
            jQuery.ajax({
                url: acces_url,
                type: 'POST',
                dataType: 'json',
                data: {user_token: token, remember_for: remember},
                beforeSend: function () {
                    $('#loader').show();
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $('.auth_message').html(data.msg);
                    } else {
                        $('.auth_message').html(data.msg);
                        window.setTimeout(function () {
                            window.location.href = "<?php echo base_url('index.php/auth/'); ?>";
                        }, 3000);
                    }
                },
                complete: function () {
                    $('#loader').hide();
                }
            });
        });

        /*Resend Access Token*/
        $('#resend_access_token').on('click', function (e) {
            e.preventDefault();
            var resend_access_url = $(this).data('resendaccessurl');
            jQuery.ajax({
                url: resend_access_url,
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {
                    $('#loader').show();
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $('.auth_message').html(data.msg);
                    } else {
                        $('.auth_message').html(data.msg);
                    }
                },
                complete: function () {
                    $('#loader').hide();
                }
            });
        });

        /*Change Batch Status*/
        $('.admin_display_tracking').on('change', '.change_status', function (e) {
            e.preventDefault();
            //var form_data = $('#update_batch_status').serialize();
            var status_data = $(this).val();
            var batch_id = $(this).data('batchid');
            jQuery.ajax({
                url: '<?php echo base_url('index.php/admin_tracking/tracking/change_batch_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {status: status_data, batch_id: batch_id},
                success: function (data) {
                    if (data.type === 'error') {
                        $('.batch_status').html(data.msg);
                    } else {
                        $('.batch_status').html(data.msg);
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    }
                }
            });
        });

        /*Add Hospital Clinicians*/
        $(document).on('click', '.assign-clinician-btn', function (e) {
            e.preventDefault();
            var form_data = $('.assign_hospital_clinician').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('index.php/admin/assign_clinician'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Search Clinicians on Hospital Base
        $(document).on('change', '.search-hospital-clinician', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('index.php/admin/search_clinician'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hosiptal_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.hospital_clinician').find('.hospital_clinician_result').html('');
                    } else {
                        _this.parents('.hospital_clinician').find('.hospital_clinician_result').html(data.encode_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Delete hospital clinican
        $(document).on('click', '.delete-hospital-clinican', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('id');
            var parent = _this.parent("li");
            jQuery.ajax({
                url: '<?php echo base_url('index.php/admin/delete_clinician'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id},
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
        });


        /*Assign Dermatologcal Surgeon*/
        $('#assign_dermatological_surgeon').on('click', '#assign_dermatological', function (e) {
            e.preventDefault();
            var form_data = $('#assign_dermatological_surgeon').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('index.php/admin/assign_dermatological_surgeon'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.dermatological_msg').html(data.msg);
                    } else {
                        $('.dermatological_msg').html(data.msg);
                    }
                }
            });
        });

        jQuery("#admin_choose_hospital").change(function () {
            $("#clrk").load("<?php echo base_url('index.php/admin/get_clinician_auto_populated'); ?>?hospital_user_id=" + $("#admin_choose_hospital").val());
            $("#dermatological_surgeon").load("<?php echo base_url('index.php/admin/get_dermatological_surgeon_auto_populated'); ?>?hospital_user_id=" + $("#admin_choose_hospital").val());
        }).trigger("change");
        $(document).on('change', '#admin_choose_hospital', function () {
            var _this = $(this);
            var hospital_id = _this.val();
            _this.parents('#add_record_form').find('#check_form').hide();
            _this.parents('#add_record_form').find('.dynamic_data').show();
            _this.parents('#add_record_form').find('.hospital_id').val(hospital_id);
        });

        /******************************
         * Secretary Assigning Code
         ******************************/
        var t = $('#doc_sec_assign_table').DataTable({
            ordering: false
        });

        $('#assign_secretary').on('click', function (e) {
            e.preventDefault();
            var form_data = $('#assign_secretary_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('index.php/admin/assign_secretary'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.sec_assign_msg').html(data.msg);
                    } else {
                        $('.sec_assign_msg').html(data.msg);
                        $(data.dynamic_data).each(function (index, element) {
                            t.row.add([
                                element[0],
                                element[1],
                                element[2]
                            ]).draw(false);
                        });
                    }
                }
            });
        });

        /************************
         * Delete Secretary Code
         ************************/
        $('#doc_sec_assign_table .delete_sec').bind('click', function (e) {
            e.preventDefault();
            var row_id = $(this).data('rowid');
            var doc_id = $(this).data('docid');
            var parent = $(this).parent("td").parent("tr");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_secretary'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'delete_row_id': row_id, 'doctor_id': doc_id},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.fadeOut('slow', function () {
                            parent.remove();
                        });
                        $('.sec_del_msg').html(data.msg);
                    } else {
                        $('.sec_del_msg').html(data.msg);
                    }
                }
            });
        });

        /***********************************************
         * Add Microscopic Codes
         **********************************************/
        $('#add_microscopic_codes_form').on('click', '#save_micro', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('#add_micro_codes').find('#add_microscopic_codes_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/add_microscopic_codes'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    _this.parents('#add_micro_codes').find('.display_msg').removeClass('alert alert-danger');
                    _this.parents('#add_micro_codes').find('.display_msg').removeClass('alert alert-success');
                    if (data.type === 'error') {
                        _this.parents('#add_micro_codes').find('.display_msg').addClass('alert alert-danger');
                        _this.parents('#add_micro_codes').find('.display_msg').html(data.msg);
                    } else {
                        _this.parents('#add_micro_codes').find('.display_msg').addClass('alert alert-success');
                        _this.parents('#add_micro_codes').find('.display_msg').html(data.msg);
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    }
                }
            });
        });

        /*******************************************
         * Create Microscopic Datatable Object
         *****************************************/
        $('#microscopic_code_table').DataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });

        /*********************************************
         * Delete Microscopic Code.
         *******************************************/
        $('#microscopic_code_table').on('click', '.delete_micro_code', function (e) {
            e.preventDefault();
            var _this = $(this);
            var micro_code = _this.data('microid');
            var parent = _this.parent('td').parent('tr');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_microscopic_codes'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'micro_code': micro_code},
                success: function (data) {
                    _this.parents('#add_micro_codes').find('.micro_msg').removeClass('alert alert-danger');
                    _this.parents('#add_micro_codes').find('.micro_msg').removeClass('alert alert-success');
                    if (data.type === 'error') {
                        _this.parents('.microscopic').find('.micro_msg').addClass('alert alert-danger');
                        _this.parents('.microscopic').find('.micro_msg').html(data.msg);
                        _this.parents('.microscopic').find('.micro_msg').fadeOut(2000);
                    } else {
                        _this.parents('.microscopic').find('.micro_msg').addClass('alert alert-success');
                        _this.parents('.microscopic').find('.micro_msg').html(data.msg);
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                    }
                }
            });
        });

        $('.flag_column').on('click', '.flag_change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_flag_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'flag_status': _flag, 'record_id': _recordid},
                success: function (data) {
                    if (data.type == 'error') {
                        _this.parents('.report_listing').find('.flag_message').addClass('alert alert-danger').show();
                        _this.parents('.report_listing').find('.flag_message').html(data.msg);
                    } else {
                        _this.parents('.report_listing').find('.flag_message').addClass('alert alert-success').show();
                        _this.parents('.report_listing').find('.flag_message').html(data.msg);
                        _this.parents('.flag_column').find('.flag_images').html(data.flag_data);
                        $(_this.parents('.report_flags').find('li')).each(function () {
                            $(this).removeClass('flag_active');
                        });
                        _this.parent('li').addClass('flag_active');
                        _this.parents('.report_listing').find('.flag_message').fadeOut(2000);
                    }
                }
            });
        });

        $(document).on('click', '#add_sec_permissions', function (e) {
            var _this = $(this);
            var form_data = $('#sec_record_permissions').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/assign_report_option'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

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
                url: '<?php echo base_url('/index.php/admin/delete_clinic_upload_files'); ?>',
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
                url: '<?php echo base_url('index.php/admin/clinic_reference_autosuggest?query=%QUERY'); ?>',
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
                    url: '<?php echo base_url('/index.php/admin/set_populate_request_form'); ?>',
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
                url: '<?php echo base_url('/index.php/admin/add_courier'); ?>',
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
                url: '<?php echo base_url('/index.php/admin/display_courier_records'); ?>',
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
//                        _this.parents('.row').find('.courier_records_data #courier_records_table');
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
                                    url: '<?php echo base_url('/index.php/admin/delete_courier'); ?>',
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
                url: '<?php echo base_url('/index.php/admin/generate_batch_key'); ?>',
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
                url: '<?php echo base_url('/index.php/admin/generate_courier_list'); ?>',
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
                url: '<?php echo base_url('/index.php/admin/display_courier_cost_code'); ?>',
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
                url: '<?php echo base_url('/index.php/admin/save_batch_data'); ?>',
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
                url: '<?php echo base_url('/index.php/admin/display_batch_courier_records'); ?>',
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
//                        _this.parents('.row').find('.courier_records_data #courier_records_table');
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
                                    url: '<?php echo base_url('/index.php/admin/delete_batch_courier'); ?>',
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

        /****************************************
         * Add Request Form modal box code
         ****************************************/
        $(document).on('click', '#add_request_form', function (e) {
            e.preventDefault();
            var _this = $(this);
            var count_value = _this.data('countvalue');
            _this.parents('#clinic_date_records').next('#request_form_modal').attr('id', 'request_form_modal_' + count_value);
        });

        /*********************************************************
         * @Profile Awards Images Uploader
         * @Profile Awards images update code
         ********************************************************/
        /* initialize uploader */

        var ProfileUploader = new plupload.Uploader({
            browse_button: 'profile_image_uplaod', // this can be an id of a DOM element or the DOM element itself
            file_data_name: 'aleatha_image_uploader',
            container: 'plupload-profile-container',
            multi_selection: false,
            multipart_params: {
                "type": "profile_photo",
                "edit_user_id": "<?php echo $edit_user_id = $this->uri->segment(3); ?>"
            },
            url: '<?php echo base_url('index.php/admin/aleatha_image_uploader'); ?>',
            filters: {
                mime_types: [
                    {title: 'Profile Photo', extensions: "jpg,jpeg,gif,png"}
                ],
                max_file_size: '10mb',
                prevent_duplicates: true
            }
        });
        ProfileUploader.init();
        /* Run after adding file */
        ProfileUploader.bind('FilesAdded', function (up, files) {
            var html = '';
            var profileThumb = "";
            plupload.each(files, function (file) {
                profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
            });
            jQuery('.profile-img-wrap').html(profileThumb);
            up.refresh();
            ProfileUploader.start();

        });
        /* Run during upload */
        ProfileUploader.bind('UploadProgress', function (up, file) {
//            jQuery("#thumb-" + file.id).append('<figure class="user-avatar"><span class="tg-loader"><i class="fa fa-spinner"></i></span><span class="tg-uploadingbar"><span class="tg-uploadingbar-percentage" style="width:' + file.percent + ';"></span></span></figure>');
        });
        /* In case of error */
        ProfileUploader.bind('Error', function (up, err) {
            jQuery.sticky(err.message, {classList: 'important', speed: 200, autoclose: 5000});
        });
        /* If files are uploaded successfully */
        ProfileUploader.bind('FileUploaded', function (up, file, ajax_response) {

            var response = $.parseJSON(ajax_response.response);
            if (response.success) {
                var img_html = '';
                var img_html = img_html.concat('<div class="profile_pic">');
                var img_html = img_html.concat('<i class="glyphicon glyphicon-remove-circle delete_profile_pic"></i>');
                var img_html = img_html.concat('<img id="profile_image" src="' + response.full_path + '">');
                var img_html = img_html.concat('</div>');
                jQuery("#thumb-" + file.id).html(img_html);
                $('.profile-image-form').find('#profile_image_name').val(response.file_name);
                $('.profile-image-form').find('#profile_image_path').val(response.full_path);

            } else {
                jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
            }
        });

        //Delete Award Image
        jQuery(document).on('click', '.profile-img-wrap .delete_profile_pic', function (e) {
            e.preventDefault();
            var _this = jQuery(this);
            _this.parents('.profile-image-form').find('#profile_image_name').val('');
            _this.parents('.profile-image-form').find('#profile_image_path').val('');
            _this.parents('.gallery-thumb-item').remove();
        });

        $(document).on('click', '.generate_invoice_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#invoice_case_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/search_doctor_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });

        });

        $(document).on('change', '#search_inv_by_doc', function (e) {
            e.preventDefault();
            var _this = $(this);
            var doctor_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/search_generated_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'doctor_id': doctor_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.invoice_records').find('.display_invoice_data').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.invoice_records').find('.display_invoice_data').html(data.encode_data);
                    }
                }
            });
        });

        $(document).on('click', '.delete_mdt_list', function (e) {
            e.preventDefault();
            var _this = $(this);
            var list_id = _this.data('mdtlistid');
            var parent = _this.parent('td').parent('tr');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_mdt_list'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'mdt_list_id': list_id},
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
        });

        /************************************
         * Ajax Request For Add Lab Names
         ************************************/
        $(document).on('click', '.add_lab_names_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.add_lab_name_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/add_lab_names'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.edit_lab_names_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.lab_name_modal_edit').find('.update_lab_name_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/update_lab_names'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $('.lab_number_mask').hide();
        $(document).on('change', '.lab_number_format', function (e) {
            e.preventDefault();
            var _this = $(this);
            var format = _this.val();
            $('.lab_number_mask').show();
            _this.parents('.add_lab_name_form, .update_lab_name_form').find('.lab_number_mask').val(format);
        });

        $(document).on('click', '.lab_name_delete', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_id = _this.data('labname');
            var parent = _this.parent('.list-group-item');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_lab_name'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'lab_id': lab_id},
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
        });

        //Lab name edit
        $(document).on('click', '.lab_name_edit', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_id = _this.data('labname');
            $('.lab_name_modal_edit').modal('show');
        });

        /*Choose lab name and get the lab number format.*/
        $('.hide_lab_name').hide();
        $(document).on('change', '.lab_name', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_value = _this.find(':selected').val();

            if (lab_value === 'U') {

                $('.hide_lab_name').show();
                $('#lab_number').inputmask('remove');
            } else {
                var lab_id = _this.find(':selected').data('labnameid');
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/admin/search_lab_number_mask'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'lab_id': lab_id},
                    success: function (data) {
                        if (data.type === 'error') {
                            $('.hide_lab_name').hide();
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        } else {
                            $('.hide_lab_name').show();
                            /*Making lab number as a mask input.*/
                            var selector = document.getElementById("lab_number");
                            var labmask = new Inputmask(data.lab_mask);
                            labmask.mask(selector);
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            $('#lab_number').trigger("keyup");
                        }
                    }
                });
            }
        });
    });

    /*Flag Codes Functions*/
    function show_flags_on_hover() {
        $('#display_track_addded_records tbody .flag_column ul.report_flags').hide();
        $('#display_track_addded_records .flag_column .hover_flags').hover(function () {
            _this = $(this);
            _this.find('ul.report_flags').slideDown('fast');
        }, function () {
            _this.find('ul.report_flags').slideUp('fast');
            return false;
        }
        );
    }

    function show_comment_box_hover() {
        $('#display_track_addded_records .flag_column .comments_icon').on('click', '.show_comments_list', function (event) {
            var _this = $(this);
            var record_id = _this.data('recordid');
            dynamic_id = _this.data('modalid');
            $('#display_comments_list-' + dynamic_id).modal('show');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/show_comments_box'); ?>',
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

    function display_comment_box() {
        $('#display_track_addded_records .flag_column .comments_icon').on('click', '#display_comment_box', function (e) {
            e.preventDefault();
            var _this = $(this);
            dynamic_id = _this.data('modalid');
            $('#flag_comment_model-' + dynamic_id).modal('show');
            $(document).on('click', '#flag_comments_save', function (e) {
                e.preventDefault();
                var _this = $(this);
                var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/save_flag_comments'); ?>',
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
        $('#display_track_addded_records .flag_column').on('click', '.flag_change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_flag_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'flag_status': _flag, 'record_id': _recordid},
                success: function (data) {
                    if (data.type == 'error') {
                        _this.parents('.report_listing').find('.flag_message').addClass('alert alert-danger').show();
                        _this.parents('.report_listing').find('.flag_message').html(data.msg);
                    } else {
                        _this.parents('.report_listing').find('.flag_message').addClass('alert alert-success').show();
                        _this.parents('.report_listing').find('.flag_message').html(data.msg);
                        _this.parents('.flag_column').find('.flag_images').html(data.flag_data);
                        $(_this.parents('.report_flags').find('li')).each(function () {
                            $(this).removeClass('flag_active');
                        });
                        _this.parent('li').addClass('flag_active');
                        _this.parents('.report_listing').find('.flag_message').fadeOut(2000);
                    }
                }
            });
        });
    }

    function delete_flag_comment() {
        $(document).on('click', '#delete_flag_comment', function (e) {
            e.preventDefault();
            var _this = $(this);
            var flag_id = _this.data('flagid');
            var parent = _this.parent("li");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_flag_comments'); ?>',
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
</script>

<script>
    jQuery(document).ready(function () {
        $(document).on('click', '.save_dataset', function (e) {
            e.preventDefault();
            var _this = $(this);
            var get_dataset_name = $('input[name=dataset_name]').val();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_dataset_name'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'dataset_name': get_dataset_name},
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.save_dataset_cat', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.dataset_cat_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_dataset_cat_name'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.refresh_dataset_data', function (e) {
            e.preventDefault();

            var _this = $(this);
            var dataset_id = _this.data('datasetid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/refresh_dataset_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'dataset_id': dataset_id},
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('#datacollase-' + dataset_id).find('.refresh_dataset_response').html(data.response_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.delete_dataset_cat', function (e) {
            e.preventDefault();
            var _this = $(this);
            if (!confirm('Are you sure you want to delete this dataset category.')) {
                return false;
            } else {
                var dataset_cat_id = _this.data('datasetcat');
                var parent = _this.parent("li");
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/delete_dataset_cat'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'datasetcat_id': dataset_cat_id},
                    success: function (data) {
                        if (data.type === 'success') {
                            parent.css("background-color", "#ffe6e6");
                            parent.fadeOut(1700, function () {
                                parent.remove();
                            });
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        } else {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        }
                    }
                });
            }
        });

        $(document).on('change', '.dataset_parent_name', function (e) {
            e.preventDefault();

            var _this = $(this);
            var dataset_id = _this.val();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_dataset_cats'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'dataset_id': dataset_id},
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html(data.response_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('change', '.dataset_cat_name', function (e) {
            e.preventDefault();
            var _this = $(this);
            var dataset_cat_id = _this.val();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_dataset_cats'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'dataset_id': dataset_cat_id},
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html(data.response_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.refresh_question_data', function (e) {
            e.preventDefault();
            var _this = $(this);
            var dataset_cat_id = _this.data('datasetcatid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_dataset_cats_questions'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'dataset_cat_id': dataset_cat_id},
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html(data.response_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.delete_dataset_question', function (e) {
            e.preventDefault();
            var _this = $(this);
            var question_id = _this.data('datasetquesid');
            console.log(question_id);
            var parent = _this.parent("li");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_dataset_question_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'question_id': question_id},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });

        });

        $('.lab_status').hide();
        $('.doctor_status').hide();
        $(document).on('change', '.select_location', function (e) {
            e.preventDefault();

            var _this = $(this);
            var location_val = _this.val();
            if (location_val == 'lab') {
                $('.lab_status').show();
                $('.doctor_status').hide();
            } else {
                $('.lab_status').hide();
                $('.doctor_status').show();
            }
        });

        $(document).on('change', 'input[name="hospital_user"]', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_hospital_group_users'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                        _this.parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                        show_clinic_users();
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-topic').next('.tg-topic').hide();
                        _this.parents('.tg-topic').next('.tg-topic').html('');
                        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-users').html('');
                    }
                }
            });
        });

        $('input[name=barcode_no]').focus();
        $(document).on('click', '.scan-barcode-btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            if ($('input[name=hospital_user]').is(':checked') === false) {
                jQuery.sticky('Please select the clinic first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            if ($('input[name=clinic_users]').is(':checked') === false) {
                jQuery.sticky('Please select the clinic user first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            if ($('input[name=pathologist]').is(':checked') === false) {
                jQuery.sticky('Please select the pathologist first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            if ($('input[name=tracking_no]').val() === '') {
                jQuery.sticky('Please enter the tracking no.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            var form_data = $('.specimen_tracking_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/process_specimen_tracking'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success' && data.record_found === 'true') {
                        $('#record_found_modal').modal('show');
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                    } else if (data.type === 'success') {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                        $('#record_not_found_modal').modal('show');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.specimen_tracking_form').find('.admin_book_out_to_lab_data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.add-specimen-admin-btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.record_specimen_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/process_record_specimen'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.finish_specimen_edit_report', function (e) {
            e.preventDefault();
            if (!confirm('Are you sure that you do not want to add specimen?')) {
                return false;
            } else {
                $('#add_specimen_model').modal('hide');
                window.location.reload();
            }

        });

        var interval = 2000; // 1000 = 1 second, 3000 = 3 seconds
        var url = window.location.href;
        var url_split = url.split('/');
        xhr = new window.XMLHttpRequest();

        var record_id = url_split[7];
        function doAjaxRequest() {
            if (url_split[6] === 'edit_report') {
                xhr = $.ajax({
                    url: '<?php echo base_url('/index.php/admin/save_user_view_status'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'user_status': 'view'},
                    success: function (response) {
                        console.log(response);
                    },
                    complete: function (response) {
                        setTimeout(doAjaxRequest, interval);
                    }
                });
            }
            else {
                var url_path = document.referrer.split('://')[1].split('/');
                var record_id = url_path[5];
                if (url_path[4] === 'edit_report') {
                    xhr.abort();
                    $.ajax({
                        url: '<?php echo base_url('/index.php/admin/save_user_view_status'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {'user_status': 'view', 'record_id': record_id},
                        success: function (response) {
                            console.log(response);
                        }
                    });
                }
            }
        }
        setTimeout(doAjaxRequest, interval);

        /**-------------------------------------------------
         * Edit Micro
         -------------------------------------------------*/
        $(document).on('click', '.edit_micro_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var micro_data = $('.edit_microscopic_form').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/admin/edit_microscopic_code'); ?>',
                type: 'POST',
                dataType: 'json',
                data: micro_data,
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });


        /**------------------------------------------------
         * Seacrh Tacking no using barcode scanner.
         -----------------------------------------------*/
        $(document).on('change', 'input[name=barcode_no]', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var search_type = 'ura_barcode_no';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'barcode': barcode, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                        _this.parents('.track_search_record').find('.admin_book_in_from_clinic_data').html(response.status_data_1);
                        _this.parents('.track_search_record').find('.admin_received_from_lab_data').html(response.status_data_2);
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    } else {
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=tracking_no_ul]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_ul = _this.val();
            var search_type = 'serial_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_ul': track_no_ul, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    } else {
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=tracking_no_lab]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_lab = _this.val();
            var search_type = 'lab_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_lab': track_no_lab, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    } else {
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Show boxes data on hover state
        $(document).on('click', '.show_clinic_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_lab_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_pathologists_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });
        $(document).on('click', '.show_report_urgency_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_specimen_type_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        //Close hover panel on click
        $(document).on('click', '.close_showpanel', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        });

        $("input[name='hospital_user']").click(function () {
            var _this = $(this);
            var hospital_name = $("input[name='hospital_user']:checked").data('hospitalname');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Clinic: <em>" + hospital_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(hospital_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-clinic').html(tag_html);
        });

        $("input[name='lab_name']").click(function () {
            var _this = $(this);
            var lab_name = $("input[name='lab_name']:checked").data('labname');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Lab: <em>" + lab_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(lab_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-labs').html(tag_html);
        });
        
        $("input[name='pathologist']").click(function () {
            var _this = $(this);
            var pathologist_name = $("input[name='pathologist']:checked").data('pathologist');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Pathologist: <em>" + pathologist_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(pathologist_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-pathologist').html(tag_html);
        });

        $("input[name='report_urgency']").click(function () {
            var _this = $(this);
            var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Urgency: <em>" + urgency_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(urgency_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-urgency').html(tag_html);
        });

        $("input[name='specimen_type']").click(function () {
            var _this = $(this);
            var specimentype_name = $("input[name='specimen_type']:checked").data('specimentype');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Specimen Type: <em>" + specimentype_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(specimentype_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-specimen').html(tag_html);
        });

        jQuery(document).on('click', '.delete_track_record', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_url = _this.data('delrecordurl');

            if (confirm("Are You Sure You Want To Delete This Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

        //Custom Scrollbar Initialize Code Start
        $('.ura-custom-scrollbar').mCustomScrollbar({
            axis: "y",
        });

        //Search Track Record
        //Tags on click record updation
        $(document).on('click', '.show_tag_clinic', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-clinic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_tag_clinic_user', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-users').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_tag_labs', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-labs').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_tag_pathologist', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-pathologist').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_tag_urgency', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-urgency').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_tag_specimen', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-specimen').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', "input[name='tag_hospital_user']", function () {
            var _this = $(this);
            var hospital_user = $("input[name='tag_hospital_user']:checked").data('hospitalname');
            var record_id = _this.parents('.tg-clinic').data('recordid');
            var hospital_id = _this.val();
            _this.parents('.tg-clinic').find('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-clinic').find('.tg-tag span em').text(hospital_user);
            //Send ajax request and update this existing record.
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/get_track_tag_hospital_user'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'hospital_id': hospital_id},
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.tg-clinic').next('.tg-users').find('.show-data-holder').remove();
                        _this.parents('.tg-clinic').next('.tg-users').find('.tg-tag span em').text('');
                        _this.parents('.tg-clinic').next('.tg-users').append(response.tags_data);
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.tg-clinic').next('.tg-users').find('.tg-tag span em').text('');
                        _this.parents('.tg-clinic').next('.tg-users').find('.show-data-holder').remove();
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});

                    }
                }
            });
        });

        $(document).on('click', ".tag_clinic_users", function () {
            var _this = $(this);
            var clinic_user = $("input[name='clinic_users']:checked").data('clinicuser');
            var record_id = _this.parents('.tg-users').data('recordid');
            var hospital_id = _this.data('hospitalid');
            var clinic_user_id = _this.val();
            _this.parents('.tg-users').find('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-users').find('.tg-tag span em').text(clinic_user);

            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'clinic_user': clinic_user_id, 'hospital_id': hospital_id, 'tag_type': 'hospital_user'},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });

        });

        $(document).on('click', ".tag_lab_name", function () {
            var _this = $(this);
            var labname = $("input[name='lab_name']:checked").data('labname');
            var record_id = _this.parents('.tg-labs').data('recordid');
            var lab_id = _this.val();
            _this.parents('.tg-labs').find('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-labs').find('.tg-tag span em').text(labname);

            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'lab_id': lab_id, 'tag_type': 'lab_name'},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', ".tag_pathology_users", function () {
            var _this = $(this);
            var doctor_name = $("input[name='pathologist']:checked").data('pathologist');
            var record_id = _this.parents('.tg-pathologist').data('recordid');
            var doctor_id = _this.val();
            _this.parents('.tg-pathologist').find('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-pathologist').find('.tg-tag span em').text(doctor_name);

            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'doctor_id': doctor_id, 'tag_type': 'pathologist'},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', ".tag_urgency", function () {
            var _this = $(this);
            var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
            var record_id = _this.parents('.tg-urgency').data('recordid');
            var urgency_val = _this.val();
            _this.parents('.tg-urgency').find('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-urgency').find('.tg-tag span em').text(urgency_name);

            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'urgency_val': urgency_val, 'tag_type': 'urgency'},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', ".tag_specimen_type", function () {
            var _this = $(this);
            var specimen_type = $("input[name='specimen_type']:checked").data('specimentype');
            var record_id = _this.parents('.tg-specimen').data('recordid');
            var specimen_val = _this.val();
            _this.parents('.tg-specimen').find('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-specimen').find('.tg-tag span em').text(specimen_type);

            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'specimen_val': specimen_val, 'tag_type': 'specimen'},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Close all tags on click data holders.
        $(document).on('click', '.tag_close_showpanel', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        });

        //Save Track Template Code
        $(document).on('click', '.save_track_template', function (e) {
            e.preventDefault();
            var _this = $(this);
            if ($('input[name=hospital_user]').is(':checked') === false ||
                    $('input[name=clinic_users]').is(':checked') === false ||
                    $('input[name=pathologist]').is(':checked') === false) {
                jQuery.sticky('Clinic name, clinic user and pathologist must be selected.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            if ($('#track_template_input').hasClass('in')) {
                if ($('input[name=track_template_name]').val() === '') {
                    jQuery.sticky('Please provide the template name.', {classList: 'important', speed: 200, autoclose: 7000});
                    return false;
                }

                var lab_name = '';
                var report_urgency = '';
                var specimen_type = '';
                var hospital_user = $('input[name=hospital_user]:checked').val();
                var clinic_users = $('input[name=clinic_users]:checked').val();
                var pathologist = $('input[name=pathologist]:checked').val();
                if ($('input[name=lab_name]').is(':checked') !== false) {
                    lab_name = $('input[name=lab_name]:checked').val();
                }
                if ($('input[name=report_urgency]').is(':checked') !== false) {
                    report_urgency = $('input[name=report_urgency]:checked').val();
                }
                if ($('input[name=specimen_type]').is(':checked') !== false) {
                    specimen_type = $('input[name=specimen_type]:checked').val();
                }
                var input_name = _this.prev('#track_template_input').find('input').val();

                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/save_admin_track_template'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'hospital_user': hospital_user, 'clinic_users': clinic_users, 'pathologist': pathologist, 'lab_name': lab_name, 'report_urgency': report_urgency, 'specimen_type': specimen_type, 'input_name': input_name},
                    success: function (response) {
                        if (response.type === 'success') {
                            _this.prev('#track_template_input').find('input').val('');
                            _this.prev('#track_template_input').collapse("hide");
                            jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        } else {
                            jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        }
                    }
                });
            } else {
                $('#track_template_input').collapse("show");
            }
        });

        //Load track Template
        $(document).on('click', '.load_track_temp_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var temp_id = _this.prev('.load_track_template').val();
            var hospital_id = _this.prev('.load_track_template').find(':selected').attr('data-hospitalid');
            var clinic_user_id = _this.prev('.load_track_template').find(':selected').attr('data-clinicid');
            var pathologist_id = _this.prev('.load_track_template').find(':selected').attr('data-pathologist');
            var lab_name = _this.prev('.load_track_template').find(':selected').attr('data-labname');
            var report_urgency = _this.prev('.load_track_template').find(':selected').attr('data-urgency');
            var specimen_type = _this.prev('.load_track_template').find(':selected').attr('data-speci');

            if (temp_id === '') {
                jQuery.sticky('Please choose the track template.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            $(_this.parents('.tg-trackrecords').find('.show_clinic .hospital_user')).each(function (index) {
                if ($(this).val() == hospital_id) {
                    var hospital_name = $(this).attr('data-hospitalname');
                    $(this).parents('.tg-catagoryholder').find('.tg-clinic .display_selected_option').text(hospital_name);
                    $(this).prop("checked", true);
                    $.ajax({
                        url: '<?php echo base_url('/index.php/admin/search_hospital_group_users'); ?>',
                        type: 'POST',
                        global: false,
                        dataType: 'json',
                        data: {'hospital_id': hospital_id, 'clinic_user_id': clinic_user_id},
                        success: function (data) {
                            if (data.type === 'success') {
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                $('.tg-clinic').parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                                $('.tg-clinic').parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                                show_clinic_users();
                            } else {
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                $('.tg-clinic').parents('.tg-topic').next('.tg-topic').hide();
                                $('.tg-clinic').parents('.tg-topic').next('.tg-topic').html('');
                                $('.tg-clinic').parents('.tg-trackrecords').find('.tg-tagsarea .tg-users').html('');
                            }
                        }
                    });
                }
            });

            $(_this.parents('.tg-trackrecords').find('.show_pathologists .pathologist')).each(function (index) {
                if ($(this).val() == pathologist_id) {
                    var pathologist = $(this).attr('data-pathologist');
                    $(this).parents('.tg-catagoryholder').find('.tg-pathologist .display_selected_option').text(pathologist);
                    $(this).prop("checked", true);
                }
            });

            $(_this.parents('.tg-trackrecords').find('.show_labs .track_lab_name')).each(function (index) {
                if ($(this).val() == lab_name) {
                    var labname = $(this).attr('data-labname');
                    $(this).parents('.tg-catagoryholder').find('.tg-heartpuls .display_selected_option').text(labname);
                    $(this).prop("checked", true);
                }
            });

            $(_this.parents('.tg-trackrecords').find('.show_report_urgency .report_urgency')).each(function (index) {
                if ($(this).val() == report_urgency) {
                    var urgency = $(this).attr('data-urgency');
                    $(this).parents('.tg-catagoryholder').find('.tg-urgency .display_selected_option').text(urgency);
                    $(this).prop("checked", true);
                }
            });

            $(_this.parents('.tg-trackrecords').find('.show_specimen_type .specimen_type')).each(function (index) {
                if ($(this).val() == specimen_type) {
                    var speci_type = $(this).attr('data-specimentype');
                    $(this).parents('.tg-catagoryholder').find('.tg-specimentype .display_selected_option').text(speci_type);
                    $(this).prop("checked", true);
                }
            });

        });
    });

    $(document).ready(function () {

        /**===========================================
         * Save central admin form data.
         * Book out to lab data.
         ==========================================*/
        $(document).on('click', '.central_admin_form_btn', function (e) {
            e.preventDefault();

            var _this = $(this);
            var form_data = $('.admin_central_reporting_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**===========================================
         * Save booked in from clinic data
         ==========================================*/
        $(document).on('click', '.admin_book_in_from_clinic', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var barcode = _this.data('barcode');
            var status_key = _this.data('statuskey');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode},
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.record_track_data);
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        /**===========================================
         * Save booked in from clinic data
         ==========================================*/
        $(document).on('click', '.admin_received_from_lab', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        /**===========================================
         * Save booked in data from laboratory
         ==========================================*/
        $(document).on('click', '.admin_laboratory_booked_in', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**===========================================
         * Save booked in data from laboratory
         ==========================================*/
        $(document).on('click', '.admin_laboratory_released', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**===========================================
         * Save booked in data from laboratory
         ==========================================*/
        $(document).on('click', '.admin_report_slide_booked_in', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**===========================================
         * Save booked in data from laboratory
         ==========================================*/
        $(document).on('click', '.admin_report_released_slide_back_to_lab', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**=====================================================
         * Set Doctor can add record permission status in DB
         ====================================================**/
        $("input[name='doctor_add_record']").click(function () {
            var _this = $(this);
            var perm_status = 'off';
            if ($("input[name='doctor_add_record']").is(':checked')) {
                perm_status = 'on';
            }
            var user_id = _this.data('userid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_add_record_perm'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'perm_status': perm_status, 'user_id': user_id},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**=======================================================
         * Save hospital lab tracking permission
         ======================================================**/
        $("input[name='hospital_lab_track']").click(function () {
            var _this = $(this);
            var perm_status = 'off';
            if ($("input[name='hospital_lab_track']").is(':checked')) {
                perm_status = 'on';
            }
            var user_id = _this.data('userid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_hospiatl_lab_track_perm'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'perm_status': perm_status, 'user_id': user_id},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });
    });

    function show_clinic_users() {
        $(document).on('click', '.show_clinic_users_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $("input[name='clinic_users']").click(function () {
            var _this = $(this);
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            var hospital_user_name = $("input[name='clinic_users']:checked").data('clinicuser');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Users: <em>" + hospital_user_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(hospital_user_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-users').html(tag_html);
        });

        $('.ura-custom-scrollbar').mCustomScrollbar({
            axis: "y",
        });
    }

    show_clinic_users();

    /**===================================================
     * Record Tracking For Lab From Admin Side
     ===================================================*/
    $(document).ready(function () {

        /**------------------------------------------------
         * Seacrh Tacking no using barcode scanner.
         -----------------------------------------------*/
        $('input[name=lab_barcode_no]').focus();
        $('input[name=lab_barcode_no]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var search_type = 'ura_barcode_no';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'barcode': barcode, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.specimen_track_search').find('.add_specimen_wrap').html('');
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html(response.encode_status_data_2);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html(response.encode_status_data_3);
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});

                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=lab_tracking_no_ul]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_ul = _this.val();
            var search_type = 'serial_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_ul': track_no_ul, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.specimen_track_search').find('.add_specimen_wrap').html('');
                        $('input[name=lab_tracking_no_ul]').val('');
                        $('input[name=lab_tracking_no_ul]').focus();
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html(response.encode_status_data_2);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html(response.encode_status_data_3);
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=lab_tracking_no_lab]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_lab = _this.val();
            var search_type = 'lab_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_lab': track_no_lab, 'search_type': search_type},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.specimen_track_search').find('.add_specimen_wrap').html('');
                        $('input[name=lab_tracking_no_lab]').val('');
                        $('input[name=lab_tracking_no_lab]').focus();
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html(response.encode_status_data_2);
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html(response.encode_status_data_3);
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.specimen_tracking_form').find('.book_in_from_clinic').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_primary_release').html('');
                        _this.parents('.specimen_tracking_form').find('.book_out_to_lab_fw_completed').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**===========================================
         * Save Book In From Clinic
         ==========================================*/
        $(document).on('click', '.institute_book_in_from_clinic', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        /**===========================================
         * Save Book Out To Lab Primary Release
         ==========================================*/
        $(document).on('click', '.institute_book_out_to_lab_primary_release', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        /**===========================================
         * Save Book Out To Lab FW Completed
         ==========================================*/
        $(document).on('click', '.institute_book_out_to_lab_fw_completed', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

    });

    /**===================================================
     * Record Tracking For Doctor From Admin Side
     ===================================================*/
    $(document).ready(function () {

        /**------------------------------------------------
         * Seacrh Tacking no using barcode scanner.
         -----------------------------------------------*/
        $('input[name=doc_barcode_no]').focus();
        $('input[name=doc_barcode_no]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var search_type = 'ura_barcode_no';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'barcode': barcode, 'search_type': search_type},
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                        $('input[name=doc_barcode_no]').val('');
                        $('input[name=doc_barcode_no]').focus();
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=doc_tracking_no_ul]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_ul = _this.val();
            var search_type = 'serial_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_ul': track_no_ul, 'search_type': search_type},
                success: function (response) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                        $('input[name=doc_barcode_no]').val('');
                        $('input[name=doc_barcode_no]').focus();
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**------------------------------------------------
         * Seacrh Tacking no using tracking no ul number scanner.
         -----------------------------------------------*/
        $('input[name=doc_tracking_no_lab]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var track_no_lab = _this.val();
            var search_type = 'lab_number';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'track_no_lab': track_no_lab, 'search_type': search_type},
                success: function (response) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                        $('input[name=doc_barcode_no]').val('');
                        $('input[name=doc_barcode_no]').focus();
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /**===========================================
         * Save slides booked in
         ==========================================*/
        $(document).on('click', '.doctor_slides_booked_in', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });
        /**===========================================
         * Save released slides back to lab
         ==========================================*/
        $(document).on('click', '.doctor_released_slides_back_to_lab', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_received_from_lab', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_draft_report', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_fw_request_ss', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_booked_out_to_lab_fw_completed', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_mdt', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_authorised', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_fw_request_immuno', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_supplementary', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no},
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });
    });

    //Display admin records
    $(document).ready(function () {

        load_ajax_data('');
        $(document).on("click", ".flag_status", function (e) {
            var flag_green = $('#flag_green').is(':checked');
            var flag_red = $('#flag_red').is(':checked');
            var flag_yellow = $('#flag_yellow').is(':checked');
            var flag_blue = $('#flag_blue').is(':checked');
            var flag_black = $('#flag_black').is(':checked');
            var flag_all = $('#flag_all').is(':checked');
            if (flag_green) {
                load_ajax_data('flag_green');
            } else if (flag_red) {
                load_ajax_data('flag_red');
            } else if (flag_yellow) {
                load_ajax_data('flag_yellow');
            } else if (flag_blue) {
                load_ajax_data('flag_blue');
            } else if (flag_black) {
                load_ajax_data('flag_black');
            } else if (flag_all) {
                load_ajax_data('');
            }
        });

    });

    function load_ajax_data(flag_type) {
        var url = window.location.href;
        var url_year = url.split('/').reverse()[1];
        var url_type = url.split('/').reverse()[0];
        var ajax_url = "<?php echo base_url('index.php/admin/display_all_ajax_processing/'); ?>";

        var oTable = $('#admin_display_records').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            stateSave: true,
            "order": [],
            "ajax": {
                url: ajax_url,
                type: "POST",
                data: {'year': url_year, 'type': url_type, 'flag_type': flag_type}
            },
            "columnDefs": [
                {
                    "targets": '', //first column / numbering column
                    "orderable": false, //set not orderable
                },
            ],
            fnDrawCallback: function () {
                ajax_show_flags_on_hover();
                ajax_show_comment_box_hover();
                ajax_display_comment_box();
                ajax_change_flag_status();
                ajax_delete_flag_comment();
            },
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var rowClass = aData[14];
                rowClass = rowClass.replace(/<(.|\n)*?>/g, '');
                $('td', nRow).eq(13).addClass('flag_column');
                $(nRow).addClass(rowClass);
            }
        });
    }

    function ajax_show_flags_on_hover() {
        $('#admin_display_records tbody .flag_column ul.report_flags').hide();
        $('#admin_display_records .flag_column .hover_flags').hover(function () {
            _this = $(this);
            _this.find('ul.report_flags').fadeIn('fast');
        }, function () {
            _this.find('ul.report_flags').fadeOut('fast');
            return false;
        }
        );
    }

    function ajax_show_comment_box_hover() {
        $('#admin_display_records .flag_column .comments_icon').on('click', '.show_comments_list', function (event) {
            var _this = $(this);
            var record_id = _this.data('recordid');
            dynamic_id = _this.data('modalid');
            $('#display_comments_list-' + dynamic_id).modal('show');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/show_comments_box'); ?>',
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

    function ajax_display_comment_box() {
        $('#admin_display_records .flag_column .comments_icon').on('click', '#display_comment_box', function (e) {
            e.preventDefault();
            var _this = $(this);
            dynamic_id = _this.data('modalid');
            $('#flag_comment_model-' + dynamic_id).modal('show');
            $(document).on('click', '#flag_comments_save', function (e) {
                e.preventDefault();
                var _this = $(this);
                var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/save_flag_comments'); ?>',
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

    function ajax_change_flag_status() {
        $('#admin_display_records .flag_column').on('click', '.flag_change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_flag_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'flag_status': _flag, 'record_id': _recordid},
                success: function (data) {
                    if (data.type == 'error') {
                        _this.parents('.report_listing').find('.flag_message').addClass('alert alert-danger').show();
                        _this.parents('.report_listing').find('.flag_message').html(data.msg);
                    } else {
                        _this.parents('.report_listing').find('.flag_message').addClass('alert alert-success').show();
                        _this.parents('.report_listing').find('.flag_message').html(data.msg);
                        _this.parents('.flag_column').find('.flag_images').html(data.flag_data);
                        $(_this.parents('.report_flags').find('li')).each(function () {
                            $(this).removeClass('flag_active');
                        });
                        _this.parent('li').addClass('flag_active');
                        _this.parents('.report_listing').find('.flag_message').fadeOut(2000);
                    }
                }
            });
        });
    }

    function ajax_delete_flag_comment() {
        $(document).on('click', '#delete_flag_comment', function (e) {
            e.preventDefault();
            var _this = $(this);
            var flag_id = _this.data('flagid');
            var parent = _this.parent("li");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_flag_comments'); ?>',
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
</script>
</html>