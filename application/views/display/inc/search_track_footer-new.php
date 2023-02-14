<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
</div>
<!-- /Page Content -->

</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

</body>

<!--Full Calendar JS Files-->

<!-- Fancy box-->

<!-- new theme javascript jquery -->
<!-- jQuery -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery-3.2.1.min.js'); ?>"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url('/assets/newtheme/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/bootstrap.min.js'); ?>"></script>

<!-- Slimscroll JS -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery.slimscroll.min.js'); ?>"></script>


<!-- Select2 JS -->
<script src="<?php echo base_url('/assets/newtheme/js/select2.min.js'); ?>"></script>

<!-- Datetimepicker JS -->
<script src="<?php echo base_url('/assets/newtheme/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/bootstrap-datetimepicker.min.js'); ?>"></script>

<!-- Datatable JS -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/dataTables.bootstrap4.min.js'); ?>"></script>
<?php $this->load->view("session");?>
<!-- Slimscroll JS -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery.slimscroll.min.js'); ?>"></script>
<!-- Datetimepicker JS -->
<script src="<?php echo base_url('/assets/newtheme/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/bootstrap-datetimepicker.min.js'); ?>"></script>

<!-- Tagsinput JS -->
<script src="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>
<!-- Summernote JS -->
<script src="<?php echo base_url('/assets/newtheme/plugins/summernote/dist/summernote-bs4.min.js'); ?>"></script>

<!-- Custom JS -->
<script src="<?php echo base_url('/assets/newtheme/js/app.js'); ?>"></script>

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

        if ($('li a.tracking_template_button').length > 3) {
            $('li a.tracking_template_button:gt(3)').hide();
            $('.show-more').show();
        }

        $('.show-more').on('click', function () {
            $('li a.tracking_template_button:gt(3)').toggle();
            if ($(this).text() === 'More') {
                $(this).find('i').removeClass('fa fa-angle-down');
                $(this).html('<span>Less</span><i class="fa fa-angle-up"></i>');
            } else {
                $(this).find('i').removeClass('fa fa-angle-up');
                $(this).html('<span>More</span><i class="fa fa-angle-down"></i>');
            }
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
                flag_tooltip();
            }
        });

        $('#display_track_addded_records').on('click', '.record_id_unpublish', function () {
            var record_url = $(this).data('unpublishrecordid');
            var record_serial = $(this).data('recordserial');
            if (confirm("Are You Sure You Want To Un Publish This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

        $('#display_track_addded_records').on('click', '.record_id_delete', function () {
            var record_url = $(this).data('delrecordid');
            var record_serial = $(this).data('recordserial');
            if (confirm("Are You Sure You Want To Delete This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

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
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/get_load_template_data_tags'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'templateid': templateid,
                    'hospitalid': hospitalid,
                    'clinicid': clinicid,
                    'pathologist': pathologist,
                    'labname': labname,
                    'urgency': urgency,
                    'speci': speci
                },
                success: function (data) {
                    _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html('');
                    if (data.type === 'error') {
                        _this.parents('.tg-trackrecords').find('.track_temp_tags').html('');
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.tg-trackrecords').find('.track_temp_tags').html(data.tags_data);
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

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
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/load_track_edit_template_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'template_id': template_id,
                    'hospital_id': hospital_id,
                    'clinic_userid': clinic_userid,
                    'pathologist': pathologist,
                    'labname': labname,
                    'urgency': urgency,
                    'specitype': specitype
                },
                success: function (data) {
                    if (data.type === 'error') {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html('');
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html(data.tmpl_edit_data);
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').find('.track_temp_edit_form .temp_id').val(template_id);
                        set_templates_scrollbar();
                    }
                }
            });
        });

        $(document).on('click', '.show_clinic_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({"opacity": "1", "visibility": "visible"});
        });

        $(document).on('click', '.show_clinic_users_btn', function (e) {
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

        $(document).on('click', '.close_showpanel', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        });

        $(document).on('click', "input[name='hospital_user']", function () {
            var _this = $(this);
            var hospital_id = _this.val();
            var hospital_name = $("input[name='hospital_user']:checked").data('hospitalname');
            var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic: <em>' + hospital_name + '</em><i>+</i></span></a>';
            _this.parents('.tg-topic').find('.display_selected_option').text(hospital_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-clinic').html(tag_html);
            $.ajax({
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/search_hospital_group_users'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                        _this.parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-users .tg-tag span').html('');
                        set_templates_scrollbar();
                    } else {
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.tg-topic').next('.tg-topic').hide();
                        _this.parents('.tg-topic').next('.tg-topic').html('');
                    }
                }
            });
        });

        $(document).on('click', "input[name='clinic_users']", function () {
            var _this = $(this);
            var hospital_user_name = $("input[name='clinic_users']:checked").data('clinicuser');
            var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Clinic User: <em>' + hospital_user_name + '</em><i>+</i></span></a>';
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-topic').find('.display_selected_option').text(hospital_user_name);
            _this.parents('.show-data-holder').css({"opacity": "0", "visibility": "hidden"});
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-users').html(tag_html);
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

        $(document).on('click', '.collapse_temp_data_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            if (_this.parents('.tg-catagoryhead').next().is(':hidden')) {
                _this.parents('.tg-catagoryhead').next().slideDown('slow');
                _this.find('.fa').addClass('fa-angle-up');
                _this.find('.fa').removeClass('fa-angle-down');
            } else {
                _this.parents('.tg-catagoryhead').next().slideUp('slow');
                _this.find('.fa').removeClass('fa-angle-up');
                _this.find('.fa').addClass('fa-angle-down');
            }
        });

        $(document).on('click', '.update-track-template', function (e) {
            e.preventDefault();
            var form_data = $('.track_temp_edit_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/update_track_edit_temp_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.add_new_track_template', function (e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/load_track_new_template'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-new-template-data').html(data.tmpl_new_data);
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                    } else {
                        _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-new-template-data').html('');
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $(document).on('click', '.save-track-template', function (e) {
            e.preventDefault();

            if ($('input[name=hospital_user]').is(':checked') === false) {
                $.sticky('Please select the clinic first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            if ($('input[name=clinic_users]').is(':checked') === false) {
                $.sticky('Please select the clinic user first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            if ($('input[name=pathologist]').is(':checked') === false) {
                $.sticky('Please select the pathologist first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            if ($('input[name=tracking_no]').val() === '') {
                $.sticky('Please enter the tracking no.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            $('.show_template_name_input').show();

            if ($('input[name=track_template_name]').val() === '') {
                $.sticky("Please enter the template name first.", {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            var form_data = $('.track_temp_edit_form').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/save_new_track_temp_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        document.location.reload();
                    } else {
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });

        $('input[name=barcode_no]').focus();
        $(document).on('change', 'input[name=barcode_no]', function () {
            $(".barcode_no_search").trigger("click");
        });
        $(document).on('click', '.barcode_no_search', function (e) {
            e.preventDefault();

            var _this = $(this);
            var barcode = _this.next('input[name=barcode_no]').val();
            var search_type = 'ura_barcode_no';

            var is_template_select = false;
            var is_status_select = false;
            var template_id = '';
            var status_code = '';

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
                    url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'only_search', 'barcode': barcode},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                set_templates_scrollbar();
                                $('input[name=barcode_no]').val('');
                                $('input[name=barcode_no]').focus();
                            }, 500);

                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                    }
                });
            } else if (is_template_select === true && is_status_select === true) {
                _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {
                        'search_type': 'add_record',
                        'barcode': barcode,
                        'template_id': template_id,
                        'status_code': status_code
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                _this.parents('.tg-searchspecimen').find('.tg-recordfound').hide();
                                _this.parents('.tg-searchspecimen').find('.tg-recordfound p').text('');
                                $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').next('.row').find('.record_add_result').html(data.track_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                set_templates_scrollbar();
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
                                $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                set_templates_scrollbar();
                            }, 500);
                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
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
                    url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'only_search', 'barcode': barcode},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                set_templates_scrollbar();
                                $('input[name=barcode_no]').val('');
                                $('input[name=barcode_no]').focus();
                            }, 500);
                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                    }
                });
            } else if (is_template_select === true && is_status_select === false) {
                _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/search_and_add_barcode_record'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'search_type': 'only_search', 'barcode': barcode},
                    success: function (data) {
                        if (data.type === 'success') {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                                show_flags_on_hover();
                                change_flag_status();
                                flag_tooltip();
                                set_templates_scrollbar();
                                $('input[name=barcode_no]').val('');
                                $('input[name=barcode_no]').focus();
                            }, 500);
                        } else {
                            setTimeout(function () {
                                _this.parents('.tg-inputicon').find('i').remove();
                                $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                                _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                            }, 500);
                        }
                    }
                });
            }
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

        //Search Template Session Batch Record Data.
        $(document).on('change', '.track_template_id', function () {
            var _this = $(this);
            var tempalte_id = _this.val();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/search_template_session_record_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'template_id': tempalte_id},
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.row').find('.display_session_batch_data').html(data.session_batch_data);
                    } else {
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.row').find('.display_session_batch_data').html('');
                    }
                }
            });
        });

        //Create New Session List
        $(document).on('click', '.create_sess_list_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: '<?php echo base_url('/index.php/admin_tracking/SearchTracking/create_new_session_track_record_list'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-trackrecords').next('.row').find('.record_add_result').html('');
                    } else {
                        $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    }
                }
            });
        });
    });

    /*Flag Codes Functions*/
    function show_flags_on_hover() {
        $('#display_track_addded_records tbody .flag_column ul.report_flags, .track_search_table .flag_column ul.report_flags').hide();
        $('#display_track_addded_records .flag_column .hover_flags, .track_search_table .flag_column .hover_flags').hover(function () {
                _this = $(this);
                _this.find('ul.report_flags').slideDown('fast');
            }, function () {
                _this.find('ul.report_flags').slideUp('fast');
                return false;
            }
        );
    }

    function show_comment_box_hover() {
        /*Display Comments Popup Box When Hover over on i*/
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
        /*Display Comment box When Click on i Icon*/
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
        $('#display_track_addded_records .flag_column, .track_search_table .flag_column').on('click', '.flag_change', function (e) {
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

    function flag_tooltip() {
        $('.flag_column').on('mouseover', 'li', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
    }

    function set_templates_scrollbar() {
        $('.ura-custom-scrollbar').mCustomScrollbar({
            axis: "y",
        });
    }

    show_flags_on_hover();
    change_flag_status();
    flag_tooltip();
    set_templates_scrollbar();
</script>
</html>