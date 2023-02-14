<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
<footer class="footer haslayout">
    <p>&copy; <?php echo date('Y'); ?> | All Rights Reserved</p>
</footer>
</div>
</body>
<script src="<?php echo base_url('/assets/js/jquery.countTo.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/plupload.full.min.js'); ?>"></script>
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
    jQuery(function () {

        $('ul.nav li.dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
        });

        jQuery('#pop').click(function () {
            jQuery('#popup').bPopup({
                easing: 'easeOutBack',
                speed: 450
            });
        });
    });
</script>
<script>

    jQuery(document).ready(function () {
        jQuery('#dob, #datetaken, #date_received_bylab, #data_processed_bylab, #date_sent_touralensis').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });
    });
</script>
<script>
    $(document).ready(function () {

        $('#advance_search_table').hide();
        $('#doctor_advance_search').on('click', function (e) {
            e.preventDefault();
            $('#advance_search_table').toggle('slow');
        });

        $('#further_work_table_hospital, #mdt_table_pending, #mdt_table_post').DataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $('div.dataTables_filter input').focus();

        $('#display_submitted_records, #display_new_records').on('mouseover', function () {
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
        $('.dashboard-total-reports').on('mouseover', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
    });

    $(document).ready(function () {
        datatables_render_table = false;
        oTable = $('#display_submitted_records').dataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            fnDrawCallback: function () {
                if (datatables_render_table === false) {
                    show_flags_on_hover_submitted_records();
                    display_comment_box_hover();
                    add_flag_comments_box();
                    change_flag_status_submitted_records();
                    delete_flag_comments();
                    datatables_render_table = true;
                }
            }
        });

        $(document).on("click", ".flag_status", function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {

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
    });
</script>
<script>
    jQuery(document).ready(function () {
        jQuery('.timer').countTo();
    });

    $(document).ready(function () {
        $("#show_mem").click(function (e) {
            e.preventDefault();
            if ($(".memorable").attr("type") == "password") {
                $(".memorable").attr("type", "text");
            }
            else {
                $(".memorable").attr("type", "password");
            }

        });

        jQuery('#date_to, #date_from').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });
        jQuery('.tat_rec_from, .tat_rec_to').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>',
            minDate: '01-01-2015', maxDate: '<?php echo date('d-m-Y'); ?>'
        });
    });

    jQuery(document).ready(function () {
        jQuery('#change_password_form').on('click', '#save_pass_btn', function (e) {
            e.preventDefault();
            var password_data = jQuery('#change_password_form').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/institute/change_password_institute'); ?>",
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
    });

    $(document).ready(function () {
        var timer;
        $('#nhs_number').on('keyup', function (e) {
            e.preventDefault();
            var nhs_number = $('#nhs_number').val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/institute/find_matching_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'nhs_number': nhs_number},
                    success: function (data) {
                        console.log(data);
                        if (data.type === 'error') {
                        } else {
                            console.log(data);
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
    });

    $(document).ready(function () {
        $('#pm_message_form').on('click', '#send_message', function (e) {
            e.preventDefault();
            var msg_form = $('#pm_message_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/insert_pm_by_institute'); ?>',
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

        $('.trash_inbox').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent("span").parent("div.list-group-item");
            var trash_item_id = jQuery(this).data('trashinboxid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/msg_trashinbox_institute'); ?>',
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

        $('.trash_sent').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent("span").parent("div.list-group-item");
            var trash_item_id = jQuery(this).data('trashsentid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/msg_trashsent_institute'); ?>',
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

        $('.trash_permanent').on('click', function (e) {
            e.preventDefault();
            var parent = $(this).parent("span").parent("div.list-group-item");
            var delete_item_id = jQuery(this).data('deleteid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/delete_trash_institute'); ?>',
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

    });

    function show_flags_on_hover_submitted_records() {

        $('#display_submitted_records tbody .flag_column .hover_flags').hover(function () {
            _this = $(this);
            _this.find('ul.report_flags').fadeIn('fast');
        }, function () {
            _this.find('ul.report_flags').fadeOut('fast');
            return false;
        }
        );
    }
    function display_comment_box_hover() {

        $(document).on('click', '.show_comments_list', function (event) {
            var _this = $(this);
            var record_id = _this.data('recordid');
            dynamic_id = _this.data('modalid');
            $('#display_comments_list-' + dynamic_id).modal('show');

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/show_comments_box'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'record_id': record_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
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

        $(document).on('click', '#display_comment_box', function (e) {
            e.preventDefault();
            var _this = $(this);
            dynamic_id = _this.data('modalid');
            $('#flag_comment_model-' + dynamic_id).modal('show');
            $(document).one('click', '#flag_comments_save', function (e) {
                e.preventDefault();
                var _this = $(this);
                var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
                $.ajax({
                    url: '<?php echo base_url('/index.php/institute/save_flag_comments'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: form_data,
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                });
            });
        });
    }
    function change_flag_status_submitted_records() {
        $(document).on('click', '.flag_change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/set_flag_status'); ?>',
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
                url: '<?php echo base_url('/index.php/institute/delete_flag_comments'); ?>',
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
        $(document).on('click', '.hospital_flag_change_detail', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/set_flag_status'); ?>',
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
    });

    $(document).ready(function () {
        $(document).on('change', '#mdt_dates', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.data('hospital-id');
            var mdt_date = $('#mdt_dates').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/find_mdt_cases'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'mdt_date': mdt_date},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_mdt_data').html('');
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.records_found').slideUp('slow');
                        }, 1500);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_mdt_data').html(data.mdt_data);
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.records_found').slideUp('slow');
                        }, 1500);
                    }
                }
            });
        });

        $(document).on('change', '#mdt_dates_new', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.data('hospital-id');
            var mdt_date = $('#mdt_dates_new').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/find_mdt_cases_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'mdt_date': mdt_date},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_mdt_data').html('');
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.records_found').slideUp('slow');
                        }, 1500);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_mdt_data').html(data.mdt_data);
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.records_found').slideUp('slow');
                        }, 1500);
                    }
                }
            });
        });

        $(document).on('change', '#prev_mdt_dates', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.data('hospital-id');
            var mdt_date = $('#prev_mdt_dates').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/find_prev_mdt_cases'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'prev_mdt_date': mdt_date},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_prev_mdt_data').html('');
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.prev_records_found').slideUp('slow');
                        }, 1500);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_prev_mdt_data').html(data.mdt_prev_data);
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.prev_records_found').slideUp('slow');
                        }, 1500);
                    }
                }
            });
        });

        $(document).on('change', '#prev_mdt_dates_new', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.data('hospital-id');
            var mdt_date = $('#prev_mdt_dates_new').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/find_prev_mdt_cases_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'prev_mdt_date': mdt_date},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_prev_mdt_data').html('');
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.prev_records_found').slideUp('slow');
                        }, 1500);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').next('.row').find('.dynamic_prev_mdt_data').html(data.mdt_prev_data);
                        window.setTimeout(function () {
                            _this.parents('.mdt_dates_content').find('.prev_records_found').slideUp('slow');
                        }, 1500);
                    }
                }
            });
        });
    });
</script>
<script>
    jQuery(document).ready(function () {
        jQuery('#clinic_date').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });

        $('#clinic_upcoming, #clinic_previous, #clinic_date_records').DataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });

        $('#edit_clinic_date_form .delete_clinic_files').on('click', function (e) {
            e.preventDefault();
            var _this = $(this);
            var file_type = _this.data('filetype');
            var file_id = _this.data('fileid');
            var hospital_id = _this.data('hospitalid');
            var parent = $(this).parent("li");
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/delete_clinic_upload_files'); ?>',
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

        var timer;
        $('#add_request_form input.clinic_reference').typeahead({
            name: 'clinic_reference',
            remote: '<?php echo base_url('index.php/institute/clinic_reference_autosuggest?query=%QUERY'); ?>',
            limit: 100
        }).on('typeahead:selected', function (event, selection) {
            var _this = $(this);
            _this.parents('#add_request_form').find('.clinic_reference_id').attr('value', selection.key);
            var clinic_record_id = selection.key;
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/institute/set_populate_request_form'); ?>',
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
                            _this.parents('#add_request_form').find('.check_form').hide();
                            _this.parents('#add_request_form').find('.request_form_dynamic').html('');
                        } else {
                            window.setTimeout(function () {
                                _this.parents('#add_request_form').find('.request_form_dynamic').show();
                                _this.parents('#add_request_form').find('.request_form_dynamic').append(data.encode_data);
                                $("#ajax_loading_effect").fadeOut();
                                _this.parents('#add_request_form').find('.check_form').show();
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            }, 2000);
                        }
                    }
                });
            }, 150);
        });

        var timer;
        $('#add_request_form').on('keyup', '#lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_number = _this.val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/institute/find_lab_number_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'lab_number': lab_number},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            _this.parents('#add_request_form').find('.check_form').hide();
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            _this.parents('#add_request_form').find('.check_form').show();
                        }
                    }
                });
            }, 1200);
        });

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
    });

    $(document).ready(function () {
        $(document).on('click', '#mark_as_read_btn', function (e) {
            e.preventDefault();
            var record_ids = [];
            $(record_data).each(function (index, value) {
                record_ids.push(value);
            });
            if (confirm("Are You Sure You Want To Mark These Records As Viewed.")) {
                $.ajax({
                    url: '<?php echo base_url('/index.php/institute/mark_read_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'record_ids': record_ids.toString()},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 4000);
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });

    $(document).ready(function () {

        $('#future_mdt_dates').hide();
        $('.hide_report_option').hide();
        $('.mdt_specimen_hide').hide();
        $(document).on('change', '.mdt_radio', function (e) {
            e.preventDefault();
            if ($('#for_mdt').is(':checked')) {
                $('.hide_report_option').hide();
                $('#future_mdt_dates').show();
                $('.mdt_specimen_hide').show();
            } else {
                $('#future_mdt_dates').hide();
                $('.hide_report_option').show();
                $('.mdt_specimen_hide').hide();
            }
        });

        $('#assign_mdt').on('click', function (e) {
            e.preventDefault();
            if (!$('.mdt_radio').is(':checked')) {
                alert('Please Select One Of The MDT Option');
            } else if ($('input[name=mdt_dates_radio]:checked').val() === 'for_mdt' && $('#mdt_dates').val() === 'false') {
                alert('Please Select MDT Date');
            } else if ($('input[name=mdt_dates_radio]:checked').val() === 'not_for_mdt' && !$('.report_option').is(':checked')) {
                alert('Please Select Add To Report OR Not To Add To Report');
            } else {
                if (!confirm('Do you want to add message for MDT.')) {
                    var form_data = $('#mdt_from_data').serialize();
                    jQuery.ajax({
                        url: '<?php echo base_url('/index.php/institute/assign_mdt_record'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: form_data,
                        success: function (data) {
                            if (data.type === 'error') {
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});

                            } else {
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                                window.setTimeout(function () {
                                    location.reload();
                                }, 2500);
                            }
                        }
                    });
                } else {
                    $('#mdt_message_modal').modal('show');
                    var form_data = $('#mdt_from_data').serialize();
                    jQuery.ajax({
                        url: '<?php echo base_url('/index.php/institute/assign_mdt_record'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: form_data,
                        success: function (data) {
                            if (data.type === 'error') {
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            } else {
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});

                            }
                        }
                    });
                }

            }
        });

        $(document).on('click', '#add_mdt_msg_btn', function (e) {
            e.preventDefault();
            var form_data = $('#mdt_message_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/add_mdt_message'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        $('#mdt_message_modal').modal('hide');
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload();
                        }, 2500);
                    }
                }
            });

        });

        $('#show_mdt_notes').on('click', '.delete_mdt_note', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/delete_mdt_record_note'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('tr').remove();
                    }
                }
            });
        });

        $('#show_mdt_notes').on('click', '.add_mdt_to_report', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var mdt_status = _this.data('mdtstatus');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/institute/add_mdt_record_note_on_report'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'record_id': record_id, 'mdt_status': mdt_status},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 1500);
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        var url = window.location.href;
        var url_year = url.split('/').reverse()[0];

        $('#display_new_records').DataTable({
            "processing": true,
            "serverSide": true,
            // stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "order": [],
            "language": {
                "infoFiltered": ""
            },
            "ajax": {
                url: "<?php echo base_url('index.php/Institute/published_reports_ajax_load/'); ?>",
                type: "POST",
            },
            "columnDefs": [
                {
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                    "orderable": false
                }
            ]
        });

        $('#display_viewed_records').DataTable({
            "processing": true,
            "serverSide": true,
            stateSave: true,
            "order": [],
            "language": {
                "infoFiltered": ""
            },
            "ajax": {
                url: "<?php echo base_url('index.php/Institute/viewed_reports_ajax_load/'); ?>",
                type: "POST",
                data: {'year': url_year}
            },
            "columnDefs": [
                {
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                    "orderable": false
                }
            ]
        });

        $(document).on('click', '.generate-bulk-reports', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_ids = [];
            $(_this.parents('#display_new_records').find('tbody .bulk_report_generate')).each(function (index) {
                if (this.checked) {
                    record_ids.push($(this).val());
                }
            });
            _this.parents('#display_new_records').find('input[name=bulk_report_ids]').val(record_ids);

            var url = _this.data('bulkurl');
            $(record_ids).each(function (index, obj) {
                window.open(url + '?id=' + obj, '_blank');
            });
        });

        $(document).on('click', '.generate-bulk-reports-viewed', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_ids = [];
            $(_this.parents('#display_viewed_records').find('tbody .bulk_report_generate')).each(function (index) {
                if (this.checked) {
                    record_ids.push($(this).val());
                }
            });
            _this.parents('#display_viewed_records').find('input[name=bulk_report_ids]').val(record_ids);

            var url = _this.data('bulkurl');
            $(record_ids).each(function (index, obj) {
                window.open(url + '?id=' + obj, '_blank');
            });
        });

        $("input[name=check_all]").click(function () {
            $('.bulk_report_generate').not(this).prop('checked', this.checked);
        });
    });
</script>

<script>
    $(document).ready(function () {

        //Show templates boxes data on click
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

        $(document).on('click', "input[name='lab_name']", function () {
            var _this = $(this);
            var lab_name = $("input[name='lab_name']:checked").data('labname');
            var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Lab: <em>' + lab_name + '</em><i>+</i></span></a>';
            _this.parents('.tg-topic').find('.display_selected_option').text(lab_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-labs').html(tag_html);
        });
        $(document).on('click', "input[name='pathologist']", function () {
            var _this = $(this);
            var pathologist_name = $("input[name='pathologist']:checked").data('pathologist');
            var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Pathologist: <em>' + pathologist_name + '</em><i>+</i></span></a>';
            _this.parents('.tg-topic').find('.display_selected_option').text(pathologist_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-pathologist').html(tag_html);
        });
        $(document).on('click', "input[name='report_urgency']", function () {
            var _this = $(this);
            var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
            var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Urgency: <em>' + urgency_name + '</em><i>+</i></span></a>';
            _this.parents('.tg-topic').find('.display_selected_option').text(urgency_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-urgency').html(tag_html);
        });
        $(document).on('click', "input[name='specimen_type']", function () {
            var _this = $(this);
            var specimentype_name = $("input[name='specimen_type']:checked").data('specimentype');
            var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Specimen Type: <em>' + specimentype_name + '</em><i>+</i></span></a>';
            _this.parents('.tg-topic').find('.display_selected_option').text(specimentype_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-specimen').html(tag_html);
        });

        //Close Template Tags Data
        $(document).on('click', '.collapse_temp_data_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            if (_this.parents('.tg-catagoryhead').next().is(':hidden')) {
                _this.parents('.tg-catagoryhead').next().slideDown('slow');
                _this.find('.fa').addClass('fa-angle-up');
                _this.find('.fa').removeClass('fa-angle-down');
            }
            else {
                _this.parents('.tg-catagoryhead').next().slideUp('slow');
                _this.find('.fa').removeClass('fa-angle-up');
                _this.find('.fa').addClass('fa-angle-down');
            }
        });

        //Update Pre-added template using ajax
        $(document).on('click', '.update-track-template', function (e) {
            e.preventDefault();

            var form_data = $('.track_temp_edit_form').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/update_track_edit_temp_data'); ?>',
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

        //Add New Track Teamplate
        $(document).on('click', '.add_new_track_template', function (e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/load_track_new_template'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-new-template-data').html(data.tmpl_new_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        set_templates_scrollbar();
                    } else {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-new-template-data').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Save new track template
        $(document).on('click', '.save-track-template', function (e) {
            e.preventDefault();

            if ($('input[name=pathologist]').is(':checked') === false) {
                jQuery.sticky('Please select the pathologist first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            if ($('input[name=tracking_no]').val() === '') {
                jQuery.sticky('Please enter the tracking no.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }


            $('.show_template_name_input').show();

            if ($('input[name=track_template_name]').val() === '') {
                jQuery.sticky("Please enter the template name first.", {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            var form_data = $('.track_temp_edit_form').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/save_new_track_temp_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        document.location.reload();
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Search Track Template Ajax Request.
        $(document).on('click', '.tracking_template_button', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('li').addClass('active').siblings().removeClass('active');
            var hospitalid = _this.data('hospitalid');
            var clinicid = _this.data('clinicid');
            var pathologist = _this.data('pathologist');
            var labname = _this.data('labname');
            var urgency = _this.data('urgency');
            var speci = _this.data('speci');
            var templateid = _this.data('templateid');

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/get_load_template_data_tags'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'templateid': templateid, 'hospitalid': hospitalid, 'clinicid': clinicid, 'pathologist': pathologist, 'labname': labname, 'urgency': urgency, 'speci': speci},
                success: function (data) {
                    _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html('');
                    if (data.type === 'error') {
                        _this.parents('.tg-trackrecords').find('.track_temp_tags').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.tg-trackrecords').find('.track_temp_tags').html(data.tags_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Track Template edit button ajax request
        $(document).on('click', '.track_edit_template', function (e) {
            e.preventDefault();
            var _this = $(this);
            var template_id = _this.data('templateid');
            var hospital_id = _this.data('hospitalid');
            var clinic_userid = _this.data('clinicuserid');
            var pathologist = _this.data('pathologist');
            var labname = _this.data('labname');
            var urgency = _this.data('urgency');
            var specitype = _this.data('specitype');

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/load_track_edit_template_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'template_id': template_id, 'hospital_id': hospital_id, 'clinic_userid': clinic_userid, 'pathologist': pathologist, 'labname': labname, 'urgency': urgency, 'specitype': specitype},
                success: function (data) {
                    if (data.type === 'error') {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html(data.tmpl_edit_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').find('.track_temp_edit_form .temp_id').val(template_id);
                        set_templates_scrollbar();
                    }
                }
            });
        });

        //On Click get the data attribute
        //and embed it on list parent
        $(document).on('click', '.check_status_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var status_code = _this.data('statuscode');
            _this.parent('li').addClass('active').siblings().removeClass('active');
            _this.parents('.statuses_tab').find('.change_status_text').text(status_code);
            $('<input>').attr({
                type: 'hidden',
                name: 'status_code_input',
                value: status_code
            }).appendTo(_this.parents('ul')).siblings().remove('input');
            _this.parents('.statuses_tab').find('input[name="barcode_no"]').attr('placeholder', 'Enter Specimen Track No.');
        });

        //Barcode Searching Functionality
        $('input[name=barcode_no]').focus();

        $(document).on('change', 'input[name=barcode_no]', function () {
            $(".barcode_no_search").trigger("click");
        });
        $(document).on('click', '.barcode_no_search', function (e) {
            e.preventDefault();

            var _this = $(this);
            var barcode = _this.next('input[name=barcode_no]').val();
            console.log(barcode);
            var search_type = 'ura_barcode_no';

            var is_template_select = false;
            var is_status_select = false;
            var template_id = '';
            var status_code = '';

            //First Check if there is any template select.
            $('.load-temp-data-list li').each(function (index) {
                if ($(this).hasClass('active')) {
                    template_id = $(this).parents('.tg-trackrecords').find('.template-tags-container').data('templateid');
                    is_template_select = true;
                    return false;
                }
            });

            $('.statuses_tab .tab_status_content div').each(function (index) {
                if ($(this).hasClass('active')) {
                    status_code = $(this).find('.track_status_list input[name=status_code_input]').val();
                    if (status_code && !status_code == '') {
                        is_status_select = true;
                    }
                    return false;
                }
            });

            if (is_template_select === false && is_status_select === false) {
                _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                    url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'only_search', 'barcode': barcode},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                $('input[name=barcode_no]').val('');
                                $('input[name=barcode_no]').focus();
                            }, 500);

                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                    }
                });
            } else if (is_template_select === true && is_status_select === true) {

                _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                    url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'add_record', 'barcode': barcode, 'template_id': template_id, 'status_code': status_code},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                _this.parents('.tg-searchspecimen').find('.tg-recordfound').hide();
                                _this.parents('.tg-searchspecimen').find('.tg-recordfound p').text('');
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').next('.row').find('.record_add_result').html(data.track_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                            }, 500);
                        } else if (data.type === 'update_statuses') {
                            setTimeout(function () {
                                $(_this.parents('.tg-trackrecords').next('.row').find('.track_search_table .track_session_row')).each(function (index) {
                                    if ($(this).data('trackno') == barcode) {
                                        $(this).find('.tg-liststatuses').html(data.encode_status);
                                    }
                                });
                                _this.parents('.tg-inputicon').find('i').remove();
                                _this.parents('.tg-searchspecimen').find('.tg-recordfound').show();
                                _this.parents('.tg-searchspecimen').find('.tg-recordfound p').text(data.status_msg);
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                set_templates_scrollbar();
                            }, 500);
                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                        setTimeout(function () {
                            $('input[name=barcode_no]').val('');
                            $('input[name=barcode_no]').focus();
                        }, 500);
                    }
                });
            } else if (is_template_select === false && is_status_select === true) {
                _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                    url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'only_search', 'barcode': barcode},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                $('input[name=barcode_no]').val('');
                                $('input[name=barcode_no]').focus();
                            }, 500);
                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                    }
                });
            } else if (is_template_select === true && is_status_select === false) {
                _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                    url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'only_search', 'barcode': barcode},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                $('input[name=barcode_no]').val('');
                                $('input[name=barcode_no]').focus();
                            }, 500);
                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                    }
                });
            }
        });


        //Load More Script
        if ($('li a.tracking_template_button').length > 3) {
            $('li a.tracking_template_button:gt(3)').hide();
            $('.show-more').show();
        }

        $('.show-more').on('click', function() {
            $('li a.tracking_template_button:gt(3)').toggle();
            if($(this).text() === 'More'){
                $(this).find('i').removeClass('fa fa-angle-down');
                $(this).html('<span>Less</span><i class="fa fa-angle-up"></i>');
            }else{
                $(this).find('i').removeClass('fa fa-angle-up');
                $(this).html('<span>More</span><i class="fa fa-angle-down"></i>');
            }
        });

        $(document).on('change', 'input[name=searchspecimen]', function () {
            var _this = $(this);
            var search_val = _this.val();
            _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
            var redirect_url = '<?php echo base_url('index.php/institute/record_tracking'); ?>' + '/' + search_val;

            setTimeout(function () {
                _this.parents('.tg-inputicon').find('i').remove();
                window.location.href = redirect_url;
            }, 1500);
        });

        $(document).on('click', '.barcode_no_search_dashboard', function () {
            var _this = $(this);
            var search_val = _this.next('input[name=searchspecimen]').val();
            _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
            var redirect_url = '<?php echo base_url('index.php/institute/record_tracking'); ?>' + '/' + search_val;

            setTimeout(function () {
                _this.parents('.tg-inputicon').find('i').remove();
                window.location.href = redirect_url;
            }, 1500);
        });


        //Toggle fw print options.
        $(document).on('click', '.display_fw_print_opt', function (e) {
            e.preventDefault();
            $('.fw_print_option').fadeToggle();
        });

        $(document).on('click', '.delete_hospital_doc', function (e) {
            e.preventDefault();
            var _this = $(this);
            var files_id = _this.data('filesid');
            var parent = _this.parent("td").parent("tr");
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/delete_institute_document_file'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'files_id': files_id},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(2500, function () {
                            parent.remove();
                        });
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        /* initialize uploader */

        var ProfileUploader = new plupload.Uploader({
            browse_button: 'upload_area_docs', // this can be an id of a DOM element or the DOM element itself
            file_data_name: 'aleatha_image_uploader',
            container: 'plupload-profile-container',
            multi_selection: false,
            multipart_params: {
                "type": "upload_doc",
                "upload_user_id": "<?php echo $user_id = $this->ion_auth->user()->row()->id; ?>"
            },
            url: '<?php echo base_url('index.php/institute/aleatha_image_uploader'); ?>',
            filters: {
                mime_types: [
                    {title: 'Upload Document', extensions: "doc,docx,xls,xlsx,ppt,pptx,csv,pdf,jpg,jpeg,gif,png"}
                ],
                max_file_size: '50mb',
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
                var doc_html = '';
                var img_html = img_html.concat('<div class="profile_pic">');
                var img_html = img_html.concat('<i class="glyphicon glyphicon-remove-circle delete_profile_pic"></i>');
                var img_html = img_html.concat('<img id="profile_image" src="' + response.file_path + '">');
                var img_html = img_html.concat('</div>');

                var doc_html = doc_html.concat('<div class="profile_docs">');
                var doc_html = doc_html.concat('<i class="glyphicon glyphicon-remove-circle delete_profile_pic"></i>');
                var doc_html = doc_html.concat('<iframe id="profile_image" src="' + response.file_path + '"></iframe>');
                var doc_html = doc_html.concat('</div>');


                if (file.type === 'image/png' || file.type === 'image/jpeg') {
                    jQuery("#thumb-" + file.id).html(img_html);
                } else {
                    jQuery("#thumb-" + file.id).html(doc_html);
                }

                $('.upload_area_form').find('input[name=upload_area_file_name]').val(response.file_name);
                $('.upload_area_form').find('input[name=upload_area_full_path]').val(response.full_path);
                $('.upload_area_form').find('input[name=upload_area_file_path]').val(response.file_path);
                $('.upload_area_form').find('input[name=upload_area_file_ext]').val(response.file_ext);

            } else {
                jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
            }
        });
        //Delete Award Image
        jQuery(document).on('click', '.profile-img-wrap .delete_profile_pic', function (e) {
            e.preventDefault();
            var _this = jQuery(this);
            var file_path = _this.parents('.upload_area_form').find('input[name=upload_area_full_path]').val();
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/delete_upload_area_document'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'file_path': file_path},
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.upload_area_form').find('input[name=upload_area_file_name]').val('');
                        _this.parents('.upload_area_form').find('input[name=upload_area_file_path]').val('');
                        _this.parents('.upload_area_form').find('input[name=upload_area_full_path]').val('');
                        _this.parents('.upload_area_form').find('input[name=upload_area_file_ext]').val('');
                        _this.parents('.gallery-thumb-item').remove();
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Save Upload Area Document
        $(document).on('click', '.upload_area_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.upload_area_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/save_upload_area_document'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        window.location.reload();
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Upload Area Delete File
        $(document).on('click', '.upload_area_delete_file', function (e) {
            e.preventDefault();
            var _this = $(this);
            var file_id = _this.data('fileid');
            var full_path = _this.data('fullpath');
            var parent = _this.parent("td").parent("tr");
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/delete_upload_area_document_db'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'file_id': file_id, 'full_path': full_path},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(2500, function () {
                            parent.remove();
                        });
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        //Update Upload Area Document Permissions.
        $(document).on('click', '.update_file_perms', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.update_upload_area_perm').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/update_upload_area_document_perms'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.modal').modal('hide');
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });


        //Login Tab Accrodian Script
        jQuery('.tg-panelcontent').hide();
        jQuery('.tg-accordion h4:first').addClass('active').next().slideDown('slow');
        jQuery('.tg-accordion h4').on('click', function () {
            if (jQuery(this).next().is(':hidden')) {
                jQuery('.tg-accordion h4').removeClass('active').next().slideUp('slow');
                jQuery(this).toggleClass('active').next().slideDown('slow');
            }
        });

        jQuery('#tg-btntoggle').on('click', function (event) {
            event.preventDefault();
            var _this = jQuery(this);
            _this.parents('li').toggleClass('tg-openmenu');
            _this.parents('li').find('.tg-emailmenu').slideToggle('slow');
        });

        /*********************************************************
         * @Upload Area Client Documents
         ********************************************************/
        /* initialize uploader */

        var Cl_Doc_Uploader = new plupload.Uploader({
            browse_button: 'cl_doc_upload_area_docs', // this can be an id of a DOM element or the DOM element itself
            file_data_name: 'aleatha_image_uploader',
            container: 'plupload-profile-container',
            multi_selection: false,
            multipart_params: {
                "type": "upload_doc",
                "upload_user_id": "<?php echo $user_id = $this->ion_auth->user()->row()->id; ?>"
            },
            url: '<?php echo base_url('index.php/institute/aleatha_image_uploader'); ?>',
            filters: {
                mime_types: [
                    {title: 'Upload Document', extensions: "doc,docx,xls,xlsx,ppt,pptx,csv,pdf,jpg,jpeg,gif,png"}
                ],
                max_file_size: '50mb',
                prevent_duplicates: true
            }
        });
        Cl_Doc_Uploader.init();
        /* Run after adding file */
        Cl_Doc_Uploader.bind('FilesAdded', function (up, files) {
            var html = '';
            var profileThumb = "";
            plupload.each(files, function (file) {
                profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
            });
            jQuery('.cl-doc-profile-img-wrap').html(profileThumb);
            up.refresh();
            Cl_Doc_Uploader.start();

        });

        Cl_Doc_Uploader.bind('UploadProgress', function (up, file) {
        });

        Cl_Doc_Uploader.bind('Error', function (up, err) {
            jQuery.sticky(err.message, {classList: 'important', speed: 200, autoclose: 5000});
        });

        Cl_Doc_Uploader.bind('FileUploaded', function (up, file, ajax_response) {

            var response = $.parseJSON(ajax_response.response);
            if (response.success) {

                var img_html = '';
                var doc_html = '';
                var img_html = img_html.concat('<div class="profile_pic">');
                var img_html = img_html.concat('<i class="glyphicon glyphicon-remove-circle delete_profile_pic"></i>');
                var img_html = img_html.concat('<img id="profile_image" src="' + response.file_path + '">');
                var img_html = img_html.concat('</div>');

                var doc_html = doc_html.concat('<div class="profile_docs">');
                var doc_html = doc_html.concat('<i class="glyphicon glyphicon-remove-circle delete_profile_pic"></i>');
                var doc_html = doc_html.concat('<iframe id="profile_image" src="' + response.file_path + '"></iframe>');
                var doc_html = doc_html.concat('</div>');


                if (file.type === 'image/png' || file.type === 'image/jpeg') {
                    jQuery("#thumb-" + file.id).html(img_html);
                } else {
                    jQuery("#thumb-" + file.id).html(doc_html);
                }

                $('.cl_doc_upload_area_form').find('input[name=upload_area_file_name]').val(response.file_name);
                $('.cl_doc_upload_area_form').find('input[name=upload_area_full_path]').val(response.full_path);
                $('.cl_doc_upload_area_form').find('input[name=upload_area_file_path]').val(response.file_path);
                $('.cl_doc_upload_area_form').find('input[name=upload_area_file_ext]').val(response.file_ext);

            } else {
                jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
            }
        });

        jQuery(document).on('click', '.cl-doc-profile-img-wrap .delete_profile_pic', function (e) {
            e.preventDefault();
            var _this = jQuery(this);
            var file_path = _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_full_path]').val();
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/delete_upload_area_document'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'file_path': file_path},
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_file_name]').val('');
                        _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_file_path]').val('');
                        _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_full_path]').val('');
                        _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_file_ext]').val('');
                        _this.parents('.gallery-thumb-item').remove();
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.cl_doc_upload_area_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.cl_doc_upload_area_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/cl_doc_save_upload_area_document'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        window.location.reload();
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.cl_doc_upload_area_delete_file', function (e) {
            e.preventDefault();
            var _this = $(this);
            var file_id = _this.data('fileid');
            var full_path = _this.data('fullpath');
            var parent = _this.parent("td").parent("tr");
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/cl_doc_delete_upload_area_document_db'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'file_id': file_id, 'full_path': full_path},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(2500, function () {
                            parent.remove();
                        });
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.cl_doc_update_file_perms', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.cl_doc_update_upload_area_perm').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/cl_doc_update_upload_area_document_perms'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.modal').modal('hide');
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.create_sess_list_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/create_new_session_track_record_list'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.record_add_result').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        jQuery(document).on('click', '.record_id_delete', function () {
            var record_url = jQuery(this).data('delrecordid');
            var record_serial = jQuery(this).data('recordserial');
            if (confirm("Are You Sure You Want To Delete This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

        $(document).on('change', '.search_yearly_invoice', function (e) {
            e.preventDefault();

            var _this = $(this);
            var year = _this.val();
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/load_accumulative_yearly_invoices'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'year': year},
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.row').next('.row').find('.load_hospital_accumulative_invoice').html(data.encode_data);
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.row').next('.row').find('.load_hospital_accumulative_invoice').html('');
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.download_request_form', function (e) {
            e.preventDefault();
            var _this = $(this);
            var file_id = _this.data('fileid');
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/download_document_file'); ?>',
                type: 'GET',
                global: false,
                dataType: 'json',
                data: {'file_id': file_id},
                success: function (data) {
                    if (data.type === 'success') {
                        var file_path = data.file_path;
                        var file_name = data.file_name;
                        var a = document.createElement('a');
                        a.href = file_path;
                        a.download = file_name;
                        a.click();
                        window.URL.revokeObjectURL(file_path);
                    }
                }
            });
        });
    });

    //When page load auto popuate the result
    //based on attach track number in urls

    $(window).on('load', function () {
        var url = window.location.href;
        var url_split = url.split('/');

        if (url_split[6] === 'record_tracking') {
            if (typeof (url_split[7]) === "undefined" || url_split[7] === '') {
                return;
            } else {
                var track_no = url_split[7];
                $.ajax({
                    url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'only_search', 'barcode': track_no},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                $('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                $('input[name=barcode_no]').val('');
                                $('input[name=barcode_no]').focus();
                            }, 500);

                        } else {
                            setTimeout(function () {
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                $('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                    }
                });
            }
        }
    });


    /*Flag Codes Functions*/
    function show_flags_on_hover() {
        $('#display_track_addded_records tbody .flag_column ul.report_flags, .track_search_table .flag_column ul.report_flags').hide();
        $('#display_track_addded_records .flag_column .hover_flags, .track_search_table .flag_column .hover_flags').hover(function () {
            _this = $(this);
            _this.find('ul.report_flags').fadeIn('fast');
        }, function () {
            _this.find('ul.report_flags').fadeOut('fast');
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
                url: '<?php echo base_url('/index.php/institute/show_comments_box'); ?>',
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
                    url: '<?php echo base_url('/index.php/institute/save_flag_comments'); ?>',
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
        $('#display_track_addded_records .flag_column, .track_search_table .flag_column').on('click', '.flag_change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/set_flag_status'); ?>',
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
                url: '<?php echo base_url('/index.php/institute/delete_flag_comments'); ?>',
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

    function flag_tooltip() {
        $('.flag_column').on('mouseover', 'li', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
    }

    function set_templates_scrollbar() {
        //Scoll Script
        $('.ura-custom-scrollbar').mCustomScrollbar({
            axis: "y",
        });
    }

    $('.ura-custom-scrollbar').mCustomScrollbar({
            axis: "y",
        });

    show_flags_on_hover();
    change_flag_status();
    flag_tooltip();
    set_templates_scrollbar();


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

        //Search Record Suggestion Code
        var receipent_suggestions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/institute/searchReceipentUsers?query=%QUERY'); ?>',
                wildcard: '%QUERY',
                transform: function (receipent_suggestions) {
                    return $.map(receipent_suggestions, function (items) {
                        return {
                            user_id: items.user_id,
                            username: items.username,
                            first_name: items.first_name,
                            last_name: items.last_name
                        };
                    });
                }
            }
        });

        $('.tg-pm-receipent input.typeahead').typeahead({
            minLength: 2,
            highlight: true
        },
        {
            name: 'user_search',
            source: receipent_suggestions,
            display: function (item) {
                return item.first_name + ' ' + item.last_name;
            },
            limit: 30,
            templates: {
                suggestion: function (item) {
                    return '<div><a href="javascript:;">' + item.first_name + ' ' + item.last_name + '</a></div>';
                },
                notFound: function (query) {
                    return 'No Result Found...';
                },
                pending: function (query) {
                    return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                },
            }
        }).on('typeahead:selected', function (event, selection) {
            var _this = $(this);
            _this.typeahead('val', selection.username);
        });

        /*********************************************
         * Add Incident Report From Ajax Request
         ********************************************/
         $(document).on('click', '.save_incident_report_btn', function(e){
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.incident_report_modal').find('.save_incident_report_form').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/saveIncidentReport'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.incident_report_modal').modal('hide');
                    }else{
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
         });
         
         $(document).on('click', '.edit_incident_reprot', function(e){
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.save_incident_report_form').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/updateIncidentReport'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }else{
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
         });

         //Upload Area Delete File
        $(document).on('click', '.delete_incident_report', function (e) {
            e.preventDefault();
            var _this = $(this);
            var recordid = _this.data('recordid');
            var parent = _this.parent("td").parent("tr");
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/deleteIncidentReport'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'recordid': recordid},
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(2500, function () {
                            parent.remove();
                        });
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });
    });
</script>
</html>