<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
<!-- Jquery UI -->
<script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
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
<!-- Tagsinput JS -->
<script src="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>
<!-- Task JS -->
<script src="<?php echo base_url('/assets/newtheme/js/task.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Chart JS -->
<script src="<?php echo base_url('/assets/subassets/plugins/morris/morris.min.js')?>"></script>
<script src="<?php echo base_url('/assets/subassets/plugins/raphael/raphael.min.js')?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/chart.js')?>"></script>
        
<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/moment-with-locales.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.js"></script>
<script src="//cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script src="<?php echo base_url('/assets/js/underscore.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/plupload.full.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.idle.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.blockUI.js'); ?>"></script>
<!--Full Calendar JS Files-->
<script src="<?php echo base_url('/assets/newtheme/js/jquery-ui.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.fullcalendar.js'); ?>"></script>
<!-- <script src="<?php //echo base_url('/assets/fullcalendar/core/main.js'); ?>"></script>
<script src="<?php //echo base_url('/assets/fullcalendar/daygrid/main.js'); ?>"></script>
<script src="<?php //echo base_url('/assets/fullcalendar/interaction/main.js'); ?>"></script> -->
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
//Full Calendar Script

function mdtFullCalendar(mdt_event_json) {
    document.getElementById('mdt_dates_calendar').innerHTML = '';
    var calendarEl = document.getElementById('mdt_dates_calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['interaction', 'dayGrid'],
        defaultView: 'dayGridMonth',
        header: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },
        events: mdt_event_json,
        eventClick: function(info) {
            var custom_props = info.event.extendedProps;
            $('#modalTitle').html(custom_props.mdt_hospital_title);
            $('#modalBody').find('#mdt_date').html(info.event.start);
            $('#modalBody').find('#mdt_cat_names').html(custom_props.mdt_cats_names);
            $('#fullCalModal').modal();
        }
    });
    calendar.render();
}

function mdtDatesAjaxRequest(hospital_id) {
    var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('index.php/Admin/find_mdt_dates'); ?>",
        data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
        dataType: "json",
        success: function(response) {
            if (response.type === 'success') {
                $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                mdtFullCalendar(response.mdt_json);
            } else {
                $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                mdtFullCalendar([]);
            }
        }
    });

}

$(document).ready(function() {
    <?php if($this->router->fetch_class() == "Auth" || $this->router->fetch_class() == "auth"){?>
    // $.fancybox.open('<div class="message"><strong>  Importance announcement from Aleatha Tech Team!</strong><p> Website will be down for scheduled<br/> maintinance on: Monday 29th Feb 2020 from 4:00 to 7:00 GMT. Any enquires contact: dev@oxbridgemedica.com.</p> <span id="demo"></span></div>');
    <?php } ?>
    /*--------------------------------------
     Create Object For Admin Users Table						
     --------------------------------------*/
    $('#admin_users_datatable').DataTable({
        ordering: false,
        "processing": true,
        stateSave: true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });

    //This code is for admin general settings
    $('.collapse_item').click(function(e) {
        var _this = $(this);
        var collapse_id = _this.attr('href');
        $('.collapse.in').collapse('hide');

        setTimeout(function() {
            $('html, body').animate({
                scrollTop: $(collapse_id).offset().top
            }, 'slow');
            if (_this.data('target') == '#add_mdt_dates') {
                //Get MDT Hospiatl ID and send an ajax request to all mdt dates
                var mdt_hospital_id = $('input[name=mdt_date_hospital_id]').val();
                mdtDatesAjaxRequest(mdt_hospital_id);
            }
        }, 250);
    });

    $('.hospitals_options').hide();
    $(document).on('change', '.display_mdt_list_on_hospital', function() {
        var _this = $(this);
        var hospital_id = _this.val();
        if (_this.val() !== '') {
            _this.parents('.tg-tabsholder').find('.hospitals_options').show();
            $('input[name=mdt_date_hospital_id]').val(hospital_id);
            $('input[name=mdt_category_hospital_id]').val(hospital_id);
            mdtDatesAjaxRequest(hospital_id);
        } else {
            _this.parents('.tg-tabsholder').find('.hospitals_options').hide();
            $('input[name=mdt_date_hospital_id]').val('');
            $('input[name=mdt_category_hospital_id]').val('');
            $('.collapse.in').collapse('hide');
            document.getElementById('mdt_dates_calendar').innerHTML = '';
        }
    });

    $(document).on('click', '.save_mdt_category', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.mdt_category_form').serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/Admin/saveMdtCategory'); ?>",
            data: form_data,
            dataType: "json",
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.mdt_category_form').find('input[name=mdt_category_name]').val('');
                    _this.parents('.mdt_category_area').find('.mdt_category_list').html(response.mdt_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.mdt_category_area').find('.mdt_category_list').html('');
                }
            }
        });
    });

    $(document).on('click', '.refresh_mdt_category_data', function(e) {
        e.preventDefault();
        var _this = $(this);
        var refresh_type = _this.data('refreshtype');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/Admin/getMdtCategories'); ?>",
            dataType: "json",
            data: { 'refresh_type': refresh_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.mdt_category_area').find('.mdt_category_list').html(response.mdt_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.mdt_category_area').find('.mdt_category_list').html('');
                }
            }
        });
    });

    $(document).on('click', '.mdt_cat_delete', function(e) {
        e.preventDefault();
        var _this = $(this);
        var mdt_cat_id = _this.data('mdtcategoryid');
        var parent = _this.parent("li");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/Admin/deleteMdtCategories'); ?>",
            dataType: "json",
            data: { 'mdt_cat_id': mdt_cat_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    parent.fadeOut('slow', function() {
                        parent.remove();
                    });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.mdt_category_area').find('.mdt_category_list').html('');
                }
            }
        });
    });

    /*--------------------------------------
     Hide/Display Hospital Groups.						
     --------------------------------------*/
    $(document).on('click', 'input[name=user_groups]', function(e) {
        var _this = $(this);
        var group_type = _this.data('groupinitial');
        if (_this.val() === 'H') {
            $('.open-laboratory-group-list').addClass('hide_content');
            $('.open-hospital-group-list').removeClass('hide_content');
            _this.parents('.create_user_form').find('input[name=user_group_type]').val('H');
        } else if (_this.val() === 'L') {
            $('.open-laboratory-group-list').removeClass('hide_content');
            $('.open-hospital-group-list').addClass('hide_content');
            _this.parents('.create_user_form').find('input[name=user_group_type]').val('H');
        } else {
            $('.open-hospital-group-list').addClass('hide_content');
            $('.open-laboratory-group-list').addClass('hide_content');
            _this.parents('.create_user_form').find('input[name=user_group_type]').val(group_type);
            $(".open-hospital-group-list .tg-formradiohold .tg-radio").each(function(index) {
                $(this).find('input[type=radio]').prop("checked", false);
            });
        }
    });
    /*--------------------------------------
     Check Create User Form						
     --------------------------------------*/
    $(document).on('click', '.create_user_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        if ($('input[name=first_name]').val() === '') {
            $.sticky('First name must not empty.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        if ($('input[name=last_name]').val() === '') {
            $.sticky('Last name must not empty.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        if ($('input[name=phone]').val() === '') {
            $.sticky('Phone field must not empty.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        if ($('input[name=password]').val() === '') {
            $.sticky('Password field must not empty.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        if ($('input[name=password_confirm]').val() === '') {
            $.sticky('Password Confirm field must not empty.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        if ($('input[name=password]').val() !== $('input[name=password_confirm]').val()) {
            $.sticky('Your Confirm Password Did Not Match', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        if ($('input[name=email]').val() === '') {
            $.sticky('Email field must not empty.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        if ($('input[name=memorable]').val() === '') {
            $.sticky('Memorable field must not empty.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }
        _this.parents('.create_user_form').submit();
    });

    /*--------------------------------------
     Collapse Menu Function					
     --------------------------------------*/
    function collapseMenu() {
        $('.tg-navigation ul li.menu-item-has-children, .tg-navigation ul li.page_item_has_children, .tg-dashboardnav ul li.menu-item-has-children, .tg-dashboardnav ul li.page_item_has_children, .tg-navigation ul li.menu-item-has-mega-menu').prepend('<span class="tg-dropdowarrow"><i class="fa fa-angle-down"></i></span>');
        $('.tg-navigation ul li.menu-item-has-children span, .tg-navigation ul li.page_item_has_children span, .tg-dashboardnav ul li.menu-item-has-children span, .tg-dashboardnav ul li.page_item_has_children span, .tg-navigation ul li.menu-item-has-mega-menu span').on('click', function() {
            $(this).parent('li').toggleClass('tg-open');
            $(this).next().next().slideToggle(300);
        });
    }

    collapseMenu();

    $('ul.hospital_groups_cats li.menu-item-has-children').on('click', function() {
        $(this).toggleClass('tg-open');
        $(this).find('ul.hospital_groups_sub_menu').slideToggle(300);
    });
    /*--------------------------------------
     DASHBOARD MENU					
     --------------------------------------*/
    if ($('#tg-btnmenutoggle').length > 0) {
        $("#tg-btnmenutoggle").on('click', function(event) {
            event.preventDefault();
            $('#tg-wrapper').toggleClass('tg-openmenu');
            $('body').toggleClass('tg-noscroll');
            $('.tg-dashboardnav ul.sub-menu').hide();
        });
    }

    /*--------------------------------------
     THEME VERTICAL SCROLLBAR		
     --------------------------------------*/
    if ($('.tg-verticalscrollbar').length > 0) {
        var _tg_verticalscrollbar = $('.tg-verticalscrollbar');
        _tg_verticalscrollbar.mCustomScrollbar({
            axis: "y",
        });
    }
    if ($('.tg-horizontalthemescrollbar').length > 0) {
        var _tg_horizontalthemescrollbar = $('.tg-horizontalthemescrollbar');
        _tg_horizontalthemescrollbar.mCustomScrollbar({
            axis: "x",
            advanced: { autoExpandHorizontalScroll: true },
        });
    }
    /* -------------------------------------
     OPEN CLOSE
     -------------------------------------- */
    $('#tg-languagesbutton').on('click', function(event) {
        event.preventDefault();
        $('.tg-langnotification li ul').slideToggle();
    });

    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
    });

    $('#selectall').click(function(event) {  //on click
        if (this.checked) { // check select status
            $('.check_selected').each(function() { //loop through each checkbox
                this.checked = true; //select all checkboxes with class "checkbox1"               
            });
        } else {
            $('.check_selected').each(function() { //loop through each checkbox
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

    $('#admin_display_records').on('mouseover', function() {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            html: true
        });
    });

    $('.flag_column').on('mouseover', 'li', function() {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            html: true
        });
    });

    $('.flag_sorting').on('mouseover', 'label', function() {
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            html: true
        });
    });

    $('#update_personal_record').on('click', function(e) {
        e.preventDefault();
        var update_persoanl_record = $('#personal_record_form').serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/index.php/Admin/update_personal_report'); ?>",
            data: update_persoanl_record,
            dataType: "json",
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    window.setTimeout(function() {
                        location.reload()
                    }, 2000);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $('#dob, #revalidation_date, #outsource_work_avail_date, #date_taken, #date_received_bylab, #data_processed_bylab, #date_sent_touralensis').datepick({
        dateFormat: 'dd-mm-yyyy',
        yearRange: '1900:<?php echo date('Y'); ?>'
    });

    $('#date_to, #date_from, #case_cost_date_from, #case_cost_date_to').datepick({
        dateFormat: 'dd-mm-yyyy',
        yearRange: '1900:<?php echo date('Y'); ?>'
    });

    $("#add_record_form").validate({
        errorElement: "span",
        wrapper: "span", // a wrapper around the error message
        errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertBefore(element);
            error.addClass('label label-danger'); // add a class to the wrapper

        }
    });

    $('#finish_specimen').bind('click', function(e) {
        e.preventDefault();
        if (!confirm('Are You Sure You Want To Exit.')) {
            return false;
        } else {
            window.location.href = "<?php echo base_url('/index.php/admin/home'); ?>";
        }
    });

    $('#admin_display_records').on('click', '.record_id_unpublish', function() {
        var record_url = $(this).data('unpublishrecordid');
        var record_serial = $(this).data('recordserial');
        if (confirm("Are You Sure You Want To Un Publish This " + record_serial + " Record.")) {
            document.location = record_url;
        } else {
            return false;
        }
    });

    $('#admin_display_records').on('click', '.record_id_delete', function() {
        var record_url = $(this).data('delrecordid');
        var record_serial = $(this).data('recordserial');
        if (confirm("Are You Sure You Want To Delete This " + record_serial + " Record.")) {
            document.location = record_url;
        } else {
            return false;
        }
    });

    $('#assign_doc_form').on('click', '#doc_assign_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.prop('disabled', true);
        var doc_assign_data = $('#assign_doc_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_assign_doctor'); ?>',
            type: 'POST',
            dataType: 'json',
            data: doc_assign_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    window.setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            }
        });
    });

    $('#assign_doc_form').on('click', '#assign_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        $("#ajax_loading_effect").fadeIn();
        var batch_assign_data = $('#assign_doc_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_batch_assign'); ?>',
            type: 'POST',
            dataType: 'json',
            data: batch_assign_data,
            success: function(data) {
                if (data.type === 'error') {
                    $("#ajax_loading_effect").fadeOut();
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    _this.prop('disabled', true);
                    window.setTimeout(function() {
                        $("#ajax_loading_effect").fadeOut('fast');
                        $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                        location.reload();
                    }, 4000);
                }
            }
        });
    });

    $('#save_cost_codes').on('click', '#save_cost_codes_btn', function(e) {
        e.preventDefault();
        var form_data = $('#save_cost_codes').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_cost_codes'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                    $('.cost_code_msg').html(data.msg);
                } else {
                    $('.cost_code_msg').html(data.msg);
                    window.setTimeout(function() {
                        location.reload()
                    }, 3000);
                }
            }
        });
    });

    $('#update_cost_codes').on('click', '#update_cost_codes_btn', function(e) {
        e.preventDefault();
        var form_data = $('#update_cost_codes').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/update_cose_codes'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                    $('.cost_code_msg').html(data.msg);
                } else {
                    $('.cost_code_msg').html(data.msg);
                    window.setTimeout(function() {
                        window.location.href = '<?php echo base_url('/index.php/admin/manage_cost_codes'); ?>';
                    }, 3000);
                }
            }
        });
    });

    $('.hospital_list').on('change', function(e) {
        e.preventDefault();
        var hospital_group_id = $("option:selected", this).val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/display_cost_codes'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_group_id': hospital_group_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {

                if (data.type === 'error') {
                    $('.display_cost_code_msg').html(data.msg);
                } else {
                    if (data.type === 'not_found') {
                        $('#display_cost_table').hide();
                        $('.display_cost_code_msg').html(data.msg);
                    } else {
                        $('#display_cost_table').show();
                        $('#display_cost_table').html(data.cost_data);
                        $('.display_cost_code_msg').html(data.msg);
                        $('.display_cost_code_msg').hide(3000);
                        $('.delete_cost_code').on('click', function(e) {
                            e.preventDefault();
                            var cost_id = $(this).data('cost_id');
                            var parent = $(this).parent("td").parent("tr");
                            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                            $.ajax({
                                url: '<?php echo base_url('/index.php/admin/delete_cost_code'); ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: { 'cost_id': cost_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                                success: function(data) {
                                    if (data.type === 'success') {
                                        parent.fadeOut('slow', function() {
                                            parent.remove();
                                        });
                                        $('.display_cost_code_msg').html(data.msg);
                                        $('.display_cost_code_msg').show();
                                    } else {
                                        $('.display_cost_code_msg').html(data.msg);
                                    }
                                }
                            });
                        });
                    }
                }
            }
        });
    });

    $('.cost_type_btn').click(function() {
        $('#add_cost_code_type').modal('toggle');
    });

    var timer;
    $('#nhs_number').on('keyup', function(e) {
        e.preventDefault();
        var nhs_number = $('#nhs_number').val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        clearInterval(timer);
        timer = setTimeout(function(e) {
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/find_matching_records'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 'nhs_number': nhs_number, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                success: function(data) {
                    console.log(data);
                    if (data.type === 'error') {
                    } else {
                        $("#ajax_loading_effect").fadeIn();
                        window.setTimeout(function() {
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
    $('#add_record_form').on('keyup', '#lab_number', function(e) {
        e.preventDefault();
        var _this = $(this);
        var lab_number = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        clearInterval(timer);
        timer = setTimeout(function(e) {
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/find_lab_number_records'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 'lab_number': lab_number, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                success: function(data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 5000 });
                        _this.parents('#add_record_form').find('.check_form').hide();
                    } else {
                        $.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 5000 });
                        _this.parents('#add_record_form').find('.check_form').show();
                    }
                }
            });
        }, 1200);
    });

    $('#personal_record_form').on('keyup keypress blur change changeData focus', '#lab_number', function(e) {
        e.preventDefault();
        var _this = $(this);
        var lab_number = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        clearInterval(timer);
        timer = setTimeout(function(e) {
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/find_lab_number_records'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 'lab_number': lab_number, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                success: function(data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 5000 });
                        _this.parents('#personal_record_form').find('#update_personal_record').hide();
                    } else {
                        $.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 5000 });
                        _this.parents('#personal_record_form').find('#update_personal_record').show();
                    }
                }
            });
        }, 1200);
    });

    $('#teach_and_mdt_cats').on('click', '#add_tech_mdt_parent', function(e) {
        e.preventDefault();
        var teach_and_mdt_cats = $('#teach_and_mdt_cats').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/add_teach_mdt_cats'); ?>',
            type: 'POST',
            dataType: 'json',
            data: teach_and_mdt_cats,
            success: function(data) {
                if (data.type === 'error') {
                    $('.parent_cat_msg').html(data.msg);
                    $('.parent_cat_msg').fadeOut(2000);
                } else {
                    $('.parent_cat_msg').html(data.msg);
                    $('.parent_cat_msg').show();
                    window.setTimeout(function() {
                        location.reload()
                    }, 1000);
                }
            }
        });
    });

    $('#teach_and_mdt_cats_edit').on('click', '#edit_tech_mdt_parent', function(e) {
        e.preventDefault();
        var teach_and_mdt_cats = $('#teach_and_mdt_cats_edit').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/edit_teach_mdt_cats'); ?>',
            type: 'POST',
            dataType: 'json',
            data: teach_and_mdt_cats,
            success: function(data) {
                if (data.type === 'error') {
                    $('.parent_cat_msg_edit').html(data.msg);
                    $('.parent_cat_msg_edit').fadeOut(2000);
                } else {
                    $('.parent_cat_msg_edit').html(data.msg);
                    $('.parent_cat_msg_edit').show();
                    window.setTimeout(function() {
                        location.reload()
                    }, 1000);
                }
            }
        });
    });

    $('#teach_and_mdt_cats_child').on('click', '#add_tech_mdt_child', function(e) {
        e.preventDefault();
        var teach_and_mdt_cats_child = $('#teach_and_mdt_cats_child').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/add_teach_mdt_cats'); ?>',
            type: 'POST',
            dataType: 'json',
            data: teach_and_mdt_cats_child,
            success: function(data) {
                if (data.type === 'error') {
                    $('.child_cat_msg').show();
                    $('.child_cat_msg').html(data.msg);
                    $('.child_cat_msg').fadeOut(3000);
                } else {
                    $('.child_cat_msg').show();
                    $('.child_cat_msg').html(data.msg);
                    window.setTimeout(function() {
                        location.reload()
                    }, 2000);
                }
            }
        });
    });

    /****************************************
     * Initialize Date Time Picker Object
     **************************************/
    $(function() {
        $('#mdt_dates').datetimepicker({
            format: 'DD-MM-YYYY LT',
            ignoreReadonly: true
        }).on('dp.change', function(ev) {
            console.log($(this));
            var _this = $(this);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Admin/getMdtCategories'); ?>",
                dataType: "json",
                success: function(response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                        _this.parents('.mdt_dates_form').find('.show_mdt_categories_inputs').html(response.mdt_data);
                    } else {
                        $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                        _this.parents('.mdt_dates_form').find('.show_mdt_categories_inputs').html(response.mdt_data);
                    }
                }
            });
        });
    });

    /*****************************************
     * Delete MDT, CPC And Teach Categories.
     *****************************************/
    $('#mdt_teach_cpc_list .delete_mdt_tec_cpc').on('click', function(e) {
        e.preventDefault();
        var teachcpcid = $(this).data('mdtcpcteach');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_teach_cpc_teach'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'teachcpcid': teachcpcid, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                    $('.mdt_del_msg').html(data.msg);
                } else {
                    $('.mdt_del_msg').html(data.msg);
                    window.setTimeout(function() {
                        location.reload()
                    }, 2000);
                }
            }
        });
    });

    /**---------------------------------------
     * Add MDT lists
     *------------------------------------*/
    $(document).on('click', '.add_mdt_list_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('#add_mdt_list').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/add_mdt_lists'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    _this.parents('#add_mdt_list').next('.display_mdt_list_table').append(data.encode_data);
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    /**********************
     * Add MDT Dates
     **********************/
    $('#add_mdt_date_btn').on('click', function(e) {
        e.preventDefault();
        var form_data = $('#mdt_dates_form').serialize();
        alert(form_data);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/add_mdt_dates'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    /************************************
     * Delete MDT Dates
     ************************************/
    $(document).on('click', 'a.mdt_date_delete', function(e) {
        e.preventDefault();
        var mdtid = $(this).data('mdtdate');
        var parent = $(this).parent("li");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_mdt_dates'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'mdt_date': mdtid, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    $(function() {
        $("#search_users").autocomplete({
            source: '<?php echo base_url('index.php/admin/get_users_list'); ?>',
            select: function(event, ui) {
                $('#get_user_id').val(ui.item.id);
            }
        });
    });

    $('#pm_message_form').on('click', '#send_message', function(e) {
        e.preventDefault();
        var msg_form = $('#pm_message_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/insert_pm_by_admin'); ?>',
            type: 'POST',
            dataType: 'json',
            data: msg_form,
            success: function(data) {
                if (data.type === 'error') {
                    $('.compose_msg').show();
                    $('.compose_msg').html(data.msg);
                } else {
                    $('.compose_msg').html(data.msg);
                    $('.compose_msg').fadeOut(2000);
                    window.setTimeout(function() {
                        location.reload()
                    }, 2000);
                }
            }
        });
    });

    /*Trash Inbox*/
    $('.trash_inbox').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent("span").parent("div.list-group-item");
        var trash_item_id = $(this).data('trashinboxid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/msg_trashinbox_admin'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'trash_id': trash_item_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    /*Trash Items*/
    $('.trash_sent').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent("span").parent("div.list-group-item");
        var trash_item_id = $(this).data('trashsentid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/msg_trashsent_admin'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'trash_id': trash_item_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    /*Delete Items*/
    $('.trash_permanent').on('click', function(e) {
        e.preventDefault();
        var parent = $(this).parent("span").parent("div.list-group-item");
        var delete_item_id = $(this).data('deleteid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_trash_admin'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'delete_id': delete_item_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    /*Tracking Code*/
    $(function() {
        $('#sent_to_lab_date, #pickup_date, #to_doc_date, #batch_clinic, #edit_batch_clinic').datetimepicker();
    });

    /*Assign Roles Code*/
    $('#roles_name').on('change', function(e) {
        e.preventDefault();
        var roles_form_data = $('#assign_roles_form').serialize();
        var role_name = $('#roles_name').text();
        $.ajax({
            url: '<?php echo base_url('/index.php/auth/assign_users_roles'); ?>',
            type: 'POST',
            dataType: 'json',
            data: roles_form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    /*Check Phone Verification*/
    $('#phone_verify').on('click', function(e) {
        e.preventDefault();
        var get_phone = $('#verify_phone').val();
        var get_url = $(this).data('setvarifypath');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: get_url,
            type: 'POST',
            dataType: 'json',
            data: { phone_no: get_phone, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(data) {
                if (data.type === 'error') {
                    $('.auth_message').html(data.msg);
                } else {
                    $('.auth_message').html(data.msg);
                    window.setTimeout(function() {
                        window.location.href = "<?php echo base_url('index.php/auth/check_auth'); ?>";
                    }, 3000);
                }
            },
            complete: function() {
                $('#loader').hide();
            }
        });
    });

    /*Check Access Token*/
    $('#access_token').on('click', function(e) {
        e.preventDefault();
        var token = $('#verify_auth').val();
        var remember_device = $('#remember_this_access').prop('checked');
        if (remember_device === true) {
            var remember = 'true';
        } else {
            var remember = 'false';
        }

        var acces_url = $(this).data('setaccesspath');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: acces_url,
            type: 'POST',
            dataType: 'json',
            data: { user_token: token, remember_for: remember, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(data) {
                if (data.type === 'error') {
                    $('.auth_message').html(data.msg);
                } else {
                    $('.auth_message').html(data.msg);
                    window.setTimeout(function() {
                        window.location.href = "<?php echo base_url('index.php/auth/'); ?>";
                    }, 3000);
                }
            },
            complete: function() {
                $('#loader').hide();
            }
        });
    });

    /*Resend Access Token*/
    $(document).on('click', '#resend_access_token', function(e) {
        e.preventDefault();
        var resend_access_url = $(this).data('resendaccessurl');
        $.ajax({
            url: resend_access_url,
            type: 'POST',
            dataType: 'json',
            beforeSend: function() {
                $('#loader').show();
            },
            success: function(data) {
                if (data.type === 'error') {
                    $('.auth_message').html(data.msg);
                } else {
                    $('.auth_message').html(data.msg);
                }
            },
            complete: function() {
                $('#loader').hide();
            }
        });
    });

    /*Change Batch Status*/
    $('.admin_display_tracking').on('change', '.change_status', function(e) {
        e.preventDefault();
        //var form_data = $('#update_batch_status').serialize();
        var status_data = $(this).val();
        var batch_id = $(this).data('batchid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('index.php/admin_tracking/tracking/change_batch_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { status: status_data, batch_id: batch_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                    $('.batch_status').html(data.msg);
                } else {
                    $('.batch_status').html(data.msg);
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                }
            }
        });
    });

    /*Add Hospital Clinicians*/
    $(document).on('click', '.assign-clinician-btn', function(e) {
        e.preventDefault();
        var form_data = $('.assign_hospital_clinician').serialize();
        $.ajax({
            url: '<?php echo base_url('index.php/admin/assign_clinician'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    //Search Clinicians on Hospital Base
    $(document).on('change', '.search-hospital-clinician', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('index.php/admin/search_clinician'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hosiptal_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.hospital_clinician').find('.hospital_clinician_result').html('');
                } else {
                    _this.parents('.hospital_clinician').find('.hospital_clinician_result').html(data.encode_data);
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    //Delete hospital clinican
    $(document).on('click', '.delete-hospital-clinican', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('id');
        var parent = _this.parent("li");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('index.php/admin/delete_clinician'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    /*Assign Dermatologcal Surgeon*/
    $('#assign_dermatological_surgeon').on('click', '#assign_dermatological', function(e) {
        e.preventDefault();
        var form_data = $('#assign_dermatological_surgeon').serialize();
        $.ajax({
            url: '<?php echo base_url('index.php/admin/assign_dermatological_surgeon'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                    $('.dermatological_msg').html(data.msg);
                } else {
                    $('.dermatological_msg').html(data.msg);
                }
            }
        });
    });

    //Search Clinicians on Hospital Base
    $(document).on('change', '.search-hospital-dermatological', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('index.php/admin/searchDermatologicalSurgeon'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hosiptal_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.dermatological_surgeon').find('.hospital_dermatological_result').html('');
                } else {
                    _this.parents('.dermatological_surgeon').find('.hospital_dermatological_result').html(data.encode_data);
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    //Delete hospital clinican
    $(document).on('click', '.delete-hospital-dermatological', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('id');
        var parent = _this.parent("li");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('index.php/admin/deleteDermatologicalSurgeo'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    $("#admin_choose_hospital").change(function() {
        $("#clrk").load("<?php echo base_url('index.php/admin/get_clinician_auto_populated'); ?>?hospital_user_id=" + $("#admin_choose_hospital").val());
        $("#dermatological_surgeon").load("<?php echo base_url('index.php/admin/get_dermatological_surgeon_auto_populated'); ?>?hospital_user_id=" + $("#admin_choose_hospital").val());
    }).trigger("change");

    $(document).on('change', '#admin_choose_hospital', function() {
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

    $('#assign_secretary').on('click', function(e) {
        e.preventDefault();
        var form_data = $('#assign_secretary_form').serialize();
        $.ajax({
            url: '<?php echo base_url('index.php/admin/assign_secretary'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                    $('.sec_assign_msg').html(data.msg);
                } else {
                    $('.sec_assign_msg').html(data.msg);
                    $(data.dynamic_data).each(function(index, element) {
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
    $('#doc_sec_assign_table .delete_sec').bind('click', function(e) {
        e.preventDefault();
        var row_id = $(this).data('rowid');
        var doc_id = $(this).data('docid');
        var parent = $(this).parent("td").parent("tr");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_secretary'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'delete_row_id': row_id, 'doctor_id': doc_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    parent.fadeOut('slow', function() {
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
    $('#add_microscopic_codes_form').on('click', '#save_micro', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('#add_micro_codes').find('#add_microscopic_codes_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/add_microscopic_codes'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                _this.parents('#add_micro_codes').find('.display_msg').removeClass('alert alert-danger');
                _this.parents('#add_micro_codes').find('.display_msg').removeClass('alert alert-success');
                if (data.type === 'error') {
                    _this.parents('#add_micro_codes').find('.display_msg').addClass('alert alert-danger');
                    _this.parents('#add_micro_codes').find('.display_msg').html(data.msg);
//                        _this.parents('#add_micro_codes').find('.display_msg').fadeOut(2000);
                } else {
                    _this.parents('#add_micro_codes').find('.display_msg').addClass('alert alert-success');
                    _this.parents('#add_micro_codes').find('.display_msg').html(data.msg);
                    window.setTimeout(function() {
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

    $('#snomed_t1_code_table, #snomed_t2_code_table, #snomed_p_code_table, #snomed_m_code_table').DataTable({
        ordering: false,
        stateSave: true,
        lengthChange: false,
        autoWidth: true,
        "processing": true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });

    $('#snomed_t1_code_table_wrapper').find('#snomed_t1_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
    $('#snomed_t2_code_table_wrapper').find('#snomed_t2_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
    $('#snomed_p_code_table_wrapper').find('#snomed_p_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
    $('#snomed_m_code_table_wrapper').find('#snomed_m_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');

    /*********************************************
     * Delete Microscopic Code.
     *******************************************/
    $('#microscopic_code_table').on('click', '.delete_micro_code', function(e) {
        e.preventDefault();
        var _this = $(this);
        var micro_code = _this.data('microid');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_microscopic_codes'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'micro_code': micro_code, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
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
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    /*********************************************
     * Delete Snomed Code.
     *******************************************/
    $('#snomed_t1_code_table, #snomed_t2_code_table').on('click', '.delete_snomed_code', function(e) {
        e.preventDefault();
        var _this = $(this);
        var snomed_id = _this.data('snomedid');
        var snomed_type = _this.data('snomedtype');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/deleteSnomedCode'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'snomed_id': snomed_id, 'snomed_type': snomed_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    $('.flag_column').on('click', '.flag_change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var _flag = $(this).data('flag');
        var _serial = $(this).data('serial');
        var _recordid = $(this).data('recordid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_flag_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'flag_status': _flag, 'record_id': _recordid, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type == 'error') {
                    _this.parents('.report_listing').find('.flag_message').addClass('alert alert-danger').show();
                    _this.parents('.report_listing').find('.flag_message').html(data.msg);
                } else {
                    _this.parents('.report_listing').find('.flag_message').addClass('alert alert-success').show();
                    _this.parents('.report_listing').find('.flag_message').html(data.msg);
                    _this.parents('.flag_column').find('.flag_images').html(data.flag_data);
                    $(_this.parents('.report_flags').find('li')).each(function() {
                        $(this).removeClass('flag_active');
                    });
                    _this.parent('li').addClass('flag_active');
                    _this.parents('.report_listing').find('.flag_message').fadeOut(2000);
                }
            }
        });
    });

    $(document).on('click', '#add_sec_permissions', function(e) {
        var _this = $(this);
        var form_data = $('#sec_record_permissions').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/assign_report_option'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    /*********************************************
     * Clinic Date Field
     *******************************************/
    $('#clinic_date, #batch_courier_collec_date').datepick({
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
    $('#edit_clinic_date_form .delete_clinic_files').on('click', function(e) {
        e.preventDefault();
        var _this = $(this);
        var file_type = _this.data('filetype');
        var file_id = _this.data('fileid');
        var hospital_id = _this.data('hospitalid');
        var parent = $(this).parent("li");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_clinic_upload_files'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'file_type': file_type, 'file_id': file_id, 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
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
            replace: function(url, uriEncodedQuery) {
                var hospital_id = $('.hospital_id').val();
                if (!hospital_id)
                    return url.replace("%QUERY", uriEncodedQuery);
                return url.replace("%QUERY", uriEncodedQuery) + '&hospital_id=' + encodeURIComponent(hospital_id);
            }
        },
        limit: 100
    }).on('typeahead:selected', function(event, selection) {
        var _this = $(this);
        _this.parents('#add_record_form').find('.clinic_reference_id').attr('value', selection.key);
        var clinic_record_id = selection.key;
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        clearInterval(timer);
        timer = setTimeout(function(e) {
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_populate_request_form'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 'clinic_record_id': clinic_record_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                beforeSend: function() {
                    $("#ajax_loading_effect").fadeIn();
                },
                success: function(data) {
                    if (data.type === 'error') {
                        $("#ajax_loading_effect").fadeOut('fast');
                       $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                        _this.parents('#add_record_form').find('.check_form').hide();
                        _this.parents('#add_record_form').find('.request_form_dynamic').html('');
                    } else {
                        window.setTimeout(function() {
                            _this.parents('#add_record_form').find('#check_form').show();
                            _this.parents('#add_record_form').find('.request_form_dynamic').show();
                            _this.parents('#add_record_form').find('.request_form_dynamic').append(data.encode_data);
                            $("#ajax_loading_effect").fadeOut();
                            _this.parents('#add_record_form').find('.check_form').show();
                            $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                        }, 2000);
                    }
                }
            });
        }, 150);
    });

    /***************************************************
     * Clinic Documents Hover View
     **************************************************/
    $('#edit_clinic_date_form .hover_image').hover(function(e) {
        e.preventDefault();
        var _this = $(this);
        ext_type = _this.data('exttype');
        image_url = _this.data('imageurl');
        _this.next('.hover_' + ext_type).attr('src', image_url);
        _this.next('.hover_' + ext_type).show();
    });

    $('#edit_clinic_date_form #close_hover_image').on('click', function(e) {
        ext_type = $('.hover_image').data('exttype');
        e.preventDefault();
        $('.hover_image_frame').hide();
    });

    /*********************************************
     * Add Courier Form
     ********************************************/
    $('#add_courier_form').on('click', '.add_courier', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('#add_courier_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/add_courier'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 2000 });
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2500);
                }
            }
        });
    });

    /*******************************************
     * Select Hospital TO Display Courier.
     ******************************************/
    $(document).on('change', '.courier_hospital_record', function() {
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/display_courier_records'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.row').find('.courier_records_data').html('');
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
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
                    _this.parents('.row').find('.courier_records_data #courier_records_table').on('click', '.delete_courier_id', function(e) {
                        e.preventDefault();
                        var _this = $(this);
                        var courier_id = _this.data('courierid');
                        var parent = _this.parent('td').parent('tr');
                        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                        if (confirm("Are You Sure You Want To Delete This Record.")) {
                            $.ajax({
                                url: '<?php echo base_url('/index.php/admin/delete_courier'); ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: { 'courier_id': courier_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                                success: function(data) {
                                    if (data.type === 'error') {
                                       $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                                    } else {
                                        $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                                        parent.css("background-color", "#ffe6e6");
                                        parent.fadeOut(1700, function() {
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
    $(document).on('change', '#batch_hospital_id', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/generate_batch_key'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('#add_batch_form').find('.batch_ref_key').html('');
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('#add_batch_form').find('.batch_ref_key').html(data.batch_key_data);
                }
            }
        });
    });

    /*************************************************************
     * Generate Courier List based on hospital
     ************************************************************/
    $(document).on('change', '#batch_hospital_id', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/generate_courier_list'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('#add_batch_form').find('.batch_courier_data').html('');
                    _this.parents('#add_batch_form').find('.batch_add_btn').hide();
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('#add_batch_form').find('.batch_add_btn').show();
                    _this.parents('#add_batch_form').find('.batch_courier_data').html(data.batch_courier_data);
                }
            }
        });
    });

    /*************************************************************
     * Display Courier Cost Code Price by selecting the courier.
     ************************************************************/
    $(document).on('change', '#batch_courier', function(e) {
        e.preventDefault();
        var _this = $(this);
        var courier_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/display_courier_cost_code'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'courier_id': courier_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('#add_batch_form').find('.batch_courier_cost_code_price').html('');
                    _this.parents('#add_batch_form').find('.batch_add_btn').hide();
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('#add_batch_form').find('.batch_courier_cost_code_price').html(data.courier_cost_code);
                    _this.parents('#add_batch_form').find('.batch_add_btn').show();
                }
            }
        });
    });

    /*****************************
     * Submit Batch Form Data
     ***************************/
    $('#add_batch_form').on('click', '.batch_add_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('#add_batch_form').serialize();
        $("#ajax_loading_effect").fadeIn();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_batch_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 2000 });
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            }
        });
    });

    /*******************************************
     * Select Hospital TO Display Courier.
     ******************************************/
    $(document).on('change', '.batch_courier_hospital_record', function() {
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/display_batch_courier_records'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.row').find('.courier_batch_records_data').html('');
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
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
                    _this.parents('.row').find('.courier_batch_records_data #batch_courier_records_table').on('click', '.delete_batch_courier_id', function(e) {
                        e.preventDefault();
                        var _this = $(this);
                        var batch_courier_id = _this.data('batchcourierid');
                        var parent = _this.parent('td').parent('tr');
                        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                        if (confirm("Are You Sure You Want To Delete This Record.")) {
                            $.ajax({
                                url: '<?php echo base_url('/index.php/admin/delete_batch_courier'); ?>',
                                type: 'POST',
                                dataType: 'json',
                                data: { 'batch_courier_id': batch_courier_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                                success: function(data) {
                                    if (data.type === 'error') {
                                       $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                                    } else {
                                        $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                                        parent.css("background-color", "#ffe6e6");
                                        parent.fadeOut(1700, function() {
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
    $('#edit_batch_form').on('click', '.batch_collection', function(e) {
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
    $(document).on('click', '#add_request_form', function(e) {
        e.preventDefault();
        var _this = $(this);
        var count_value = _this.data('countvalue');
        _this.parents('#clinic_date_records').next('#request_form_modal').attr('id', 'request_form_modal_' + count_value);
    });

    /*********************************************************
     * @Profile Awards Images Uploader
     * @Profile Awards images update code
     ********************************************************/
    var ProfileUploader = new plupload.Uploader({
        browse_button: 'profile_image_uplaod', // this can be an id of a DOM element or the DOM element itself
        file_data_name: 'aleatha_image_uploader',
        container: 'plupload-profile-container',
        multi_selection: false,
        multipart_params: {
            "type": "profile_photo",
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        url: '<?php echo base_url('index.php/admin/aleatha_image_uploader'); ?>',
        filters: {
            mime_types: [
                { title: 'Profile Photo', extensions: "jpg,jpeg,gif,png" }
            ],
            max_file_size: '10mb',
            prevent_duplicates: true
        }
    });

    ProfileUploader.init();
    /* Run after adding file */
    ProfileUploader.bind('FilesAdded', function(up, files) {
        var html = '';
        var profileThumb = "";
        plupload.each(files, function(file) {
            profileThumb += '<div id="thumb-' + file.id + '" class="tg-thumboption">' + '' + '</div>';
        });
        $('.tg-useruploadimg').html(profileThumb);
        up.refresh();
        ProfileUploader.start();
    });
    /* Run during upload */
    ProfileUploader.bind('UploadProgress', function(up, file) {
    });
    /* In case of error */
    ProfileUploader.bind('Error', function(up, err) {
        $.sticky(err.message, { classList: 'important', speed: 200, autoclose: 5000 });
    });
    /* If files are uploaded successfully */
    ProfileUploader.bind('FileUploaded', function(up, file, ajax_response) {
        var response = $.parseJSON(ajax_response.response);
        if (response.success) {
            var spinner_html = '';
            spinner_html = spinner_html.concat('<span><i class="fa fa-spinner fa-spin"></i></span>');
            $("#thumb-" + file.id).html(spinner_html);
            setTimeout(function() {
                var img_html = '';
                var img_html = img_html.concat('<a href="javascript:void(0);"><i class="lnr lnr-cross delete_profile_pic"></i></a>');
                var img_html = img_html.concat('<img src="' + response.full_path + '">');
                var user_img = '<img src="' + response.full_path + '">';
                $('.tg-useruploadimg').find("div#thumb-" + file.id).removeClass('tg-thumboption');
                $("#thumb-" + file.id).html(img_html);
                $('.tg-userinfo-holder').find('.tg-user-img').html(user_img);
                $('input[name=profile_image_name]').val(response.file_name);
                $('input[name=profile_image_path]').val(response.full_path);
            }, 1000);
        } else {
            $.sticky(response.message, { classList: 'important', speed: 200, autoclose: 5000 });
        }
    });

    //Delete Award Image
    $(document).on('click', '.delete_profile_pic', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-useruploadimg').html('<i class="lnr lnr-user"></i>');
        var user_initial = $('.tg-userinfo-holder').data('userinitial');
        $('.tg-userinfo-holder').find('.tg-user-img').html('<h2>' + user_initial + '</h2>');
        $('input[name=profile_image_name]').val('');
        $('input[name=profile_image_path]').val('');
    });

    //Generate Invoice Code
    $(document).on('click', '.generate_invoice_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('#invoice_case_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_doctor_invoice'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            }
        });
    });

    //Search Doctor Invoice
    $(document).on('change', '#search_inv_by_doc', function(e) {
        e.preventDefault();
        var _this = $(this);
        var doctor_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_generated_invoice'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'doctor_id': doctor_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.invoice_records').find('.display_invoice_data').html('');
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.invoice_records').find('.display_invoice_data').html(data.encode_data);
                }
            }
        });
    });

    $(document).on('click', '.generate_admin_invoice_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('#admin_invoice_case_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_hospital_invoice'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            }
        });
    });

    //Search Doctor Invoice
    $(document).on('change', '#search_hos_inv', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_hospital_generated_invoice'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.invoice_records').find('.display_invoice_data').html('');
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.invoice_records').find('.display_invoice_data').html(data.encode_data);
                }
            }
        });
    });

    //Delete Invoice
    $(document).on('click', '.delete_doc_inv', function(e) {
        e.preventDefault();
        var _this = $(this);
        var inv_id = _this.data('invid');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_admin_doctor_invoice'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'inv_id': inv_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    //Delete Hopsital Invoice
    $(document).on('click', '.delete_hos_inv', function(e) {
        e.preventDefault();
        var _this = $(this);
        var inv_id = _this.data('invid');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_admin_hospital_invoice'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'inv_id': inv_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.delete_mdt_list', function(e) {
        e.preventDefault();
        var _this = $(this);
        var list_id = _this.data('mdtlistid');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_mdt_list'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'mdt_list_id': list_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    /************************************
     * Ajax Request For Add Lab Names
     ************************************/
    $(document).on('click', '.add_lab_names_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.add_lab_name_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/add_lab_names'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.edit_lab_names_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('.lab_name_modal_edit').find('.update_lab_name_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/update_lab_names'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $('.lab_number_mask').hide();
    $(document).on('change', '.lab_number_format', function(e) {
        e.preventDefault();
        var _this = $(this);
        var format = _this.val();
        $('.lab_number_mask').show();
        _this.parents('.add_lab_name_form, .update_lab_name_form').find('.lab_number_mask').val(format);
    });

    $(document).on('click', '.lab_name_delete', function(e) {
        e.preventDefault();
        var _this = $(this);
        var lab_id = _this.data('labname');
        var parent = _this.parent('.list-group-item');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_lab_name'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'lab_id': lab_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });

    //Lab name edit
    $(document).on('click', '.lab_name_edit', function(e) {
        e.preventDefault();
        var _this = $(this);
        var lab_id = _this.data('labname');
        $('.lab_name_modal_edit').modal('show');
    });

    /*Choose lab name and get the lab number format.*/
    $('.hide_lab_name').hide();
    $(document).on('change', '.lab_name', function(e) {
        e.preventDefault();
        var _this = $(this);
        var lab_value = _this.find(':selected').val();
        if (lab_value === 'U') {

            $('.hide_lab_name').show();
            $('#lab_number').inputmask('remove');
        } else {
            var lab_id = _this.find(':selected').data('labnameid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_lab_number_mask'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 'lab_id': lab_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                success: function(data) {
                    if (data.type === 'error') {
                        $('.hide_lab_name').hide();
                       $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    } else {
                        $('.hide_lab_name').show();
                        /*Making lab number as a mask input.*/
                        var selector = document.getElementById("lab_number");
                        var labmask = new Inputmask(data.lab_mask);
                        labmask.mask(selector);
                        $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                        $('#lab_number').trigger("keyup");
                    }
                }
            });
        }
    });
});
</script>

<script>
$(document).ready(function() {
    //Add Datasets Code Start
    $(document).on('click', '.save_dataset', function(e) {
        e.preventDefault();
        var _this = $(this);
        var get_dataset_name = $('input[name=dataset_name]').val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_dataset_name'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'dataset_name': get_dataset_name, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    alert(data.msg);
                    // $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                      window.location.reload();
                } else {
                     $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.save_dataset_cat', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('.dataset_cat_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_dataset_cat_name'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                      alert(data.msg);
                    // $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                      window.location.reload();
                   // $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.refresh_dataset_data', function(e) {
        e.preventDefault();
        var _this = $(this);
        var dataset_id = _this.data('datasetid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/refresh_dataset_data'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'dataset_id': dataset_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('#datacollase-' + dataset_id).find('.refresh_dataset_response').html(data.response_data);
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.delete_dataset_cat', function(e) {
        e.preventDefault();
        var _this = $(this);
        if (!confirm('Are you sure you want to delete this dataset category.')) {
            return false;
        } else {
            var dataset_cat_id = _this.data('datasetcat');
            var parent = _this.parent("li");
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_dataset_cat'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { 'datasetcat_id': dataset_cat_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                success: function(data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function() {
                            parent.remove();
                        });
                        $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    } else {
                       $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    }
                }
            });
        }
    });

    $(document).on('change', '.dataset_parent_name', function(e) {
        e.preventDefault();
        var _this = $(this);
        var dataset_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_dataset_cats'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'dataset_id': dataset_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.dataset_data').find('.dataset_cat_response').html(data.response_data);
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    _this.parents('.dataset_data').find('.dataset_cat_response').html('');
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('change', '.dataset_cat_name', function(e) {
        e.preventDefault();
        var _this = $(this);
        var dataset_cat_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_dataset_cats'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'dataset_id': dataset_cat_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.dataset_data').find('.dataset_cat_response').html(data.response_data);
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    _this.parents('.dataset_data').find('.dataset_cat_response').html('');
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.refresh_question_data', function(e) {
        e.preventDefault();
        var _this = $(this);
        var dataset_cat_id = _this.data('datasetcatid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_dataset_cats_questions'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'dataset_cat_id': dataset_cat_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html(data.response_data);
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html('');
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.delete_dataset_question', function(e) {
        e.preventDefault();
        var _this = $(this);
        var question_id = _this.data('datasetquesid');
        console.log(question_id);
        var parent = _this.parent("li");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_dataset_question_data'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'question_id': question_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                    _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html('');
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $('.lab_status').hide();
    $('.doctor_status').hide();
    $(document).on('change', '.select_location', function(e) {
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

    //Search Hospital Specific Users Based on hospital id.
    $(document).on('change', 'input[name="hospital_user"]', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_hospital_group_users'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                    _this.parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                    show_clinic_users();
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-topic').next('.tg-topic').hide();
                    _this.parents('.tg-topic').next('.tg-topic').html('');
                    _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-users').html('');
                }
            }
        });
    });

    $('input[name=barcode_no]').focus();
    $(document).on('click', '.scan-barcode-btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        if ($('input[name=hospital_user]').is(':checked') === false) {
            $.sticky('Please select the clinic first.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }

        if ($('input[name=clinic_users]').is(':checked') === false) {
            $.sticky('Please select the clinic user first.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }

        if ($('input[name=pathologist]').is(':checked') === false) {
            $.sticky('Please select the pathologist first.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }

        if ($('input[name=tracking_no]').val() === '') {
            $.sticky('Please enter the tracking no.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }

        var form_data = $('.specimen_tracking_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/process_specimen_tracking'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success' && data.record_found === 'true') {
                    $('#record_found_modal').modal('show');
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                } else if (data.type === 'success') {
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                    $('#record_not_found_modal').modal('show');
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.specimen_tracking_form').find('.admin_book_out_to_lab_data').html('');
                }
            }
        });
    });

    /**---------------------------------------
     * Add Specimen via AJAX
     ---------------------------------------*/
    $(document).on('click', '.add-specimen-admin-btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.record_specimen_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/process_record_specimen'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    $(document).on('click', '.finish_specimen_edit_report', function(e) {
        e.preventDefault();
        if (!confirm('Are you sure that you do not want to add specimen?')) {
            return false;
        } else {
            $('#add_specimen_model').modal('hide');
            window.location.reload();
        }

    });

    /**-------------------------------------------------
     * Code to check if any field change or not.
     -------------------------------------------------*/
    var interval = 2000; // 1000 = 1 second, 3000 = 3 seconds
    var url = window.location.href;
    var url_split = url.split('/');
    xhr = new window.XMLHttpRequest();
    var record_id = url_split[7];

    function doAjaxRequest() {
        //                var form_data = $('#doctor_update_personal_record').serialize();
        if (url_split[6] === 'edit_report') {
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            xhr = $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_user_view_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: { 'user_status': 'view', '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                success: function(response) {
                    console.log(response);
                },
                complete: function(response) {
                    setTimeout(doAjaxRequest, interval);
                }
            });
        } else {
            var url_path = document.referrer.split('://')[1].split('/');
            var record_id = url_path[5];
            if (url_path[4] === 'edit_report') {
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                xhr.abort();
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/save_user_view_status'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: { 'user_status': 'view', 'record_id': record_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                    success: function(response) {
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
    $(document).on('click', '.edit_micro_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var micro_data = $('.edit_microscopic_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/edit_microscopic_code'); ?>',
            type: 'POST',
            dataType: 'json',
            data: micro_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**---------------------------------------------------------
     * Delete Snomed Codes
     --------------------------------------------------------*/
    $(document).on('click', '.delete_snomed_code', function(e) {
        e.preventDefault();
        var _this = $(this);
        if (confirm("Are You Sure You Want To Delete This Snomed Records.")) {
            document.location = _this.attr('href');
        } else {
            return false;
        }
    });

    /**------------------------------------------------
     * Seacrh Tacking no using barcode scanner.
     -----------------------------------------------*/
    $(document).on('change', 'input[name=barcode_no]', function(e) {
        e.preventDefault();
        var _this = $(this);
        var barcode = _this.val();
        var search_type = 'ura_barcode_no';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'barcode': barcode, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                    _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                    _this.parents('.track_search_record').find('.admin_book_in_from_clinic_data').html(response.status_data_1);
                    _this.parents('.track_search_record').find('.admin_received_from_lab_data').html(response.status_data_2);
                    $('input[name=barcode_no]').val('');
                    $('input[name=barcode_no]').focus();
                } else {
                    _this.parents('.track_search_record').find('.load-track-record-data').html('');
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**------------------------------------------------
     * Seacrh Tacking no using tracking no ul number scanner.
     -----------------------------------------------*/
    $('input[name=tracking_no_ul]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var track_no_ul = _this.val();
        var search_type = 'serial_number';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'track_no_ul': track_no_ul, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                    _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                    $('input[name=barcode_no]').val('');
                    $('input[name=barcode_no]').focus();
                } else {
                    _this.parents('.track_search_record').find('.load-track-record-data').html('');
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**------------------------------------------------
     * Seacrh Tacking no using tracking no ul number scanner.
     -----------------------------------------------*/
    $('input[name=tracking_no_lab]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var track_no_lab = _this.val();
        var search_type = 'lab_number';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'track_no_lab': track_no_lab, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                    _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                    $('input[name=barcode_no]').val('');
                    $('input[name=barcode_no]').focus();
                } else {
                    _this.parents('.track_search_record').find('.load-track-record-data').html('');
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Show boxes data on hover state
    $(document).on('click', '.show_clinic_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
        _this.parents('.tg-topic').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_lab_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
        _this.parents('.tg-topic').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_pathologists_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
        _this.parents('.tg-topic').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_report_urgency_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
        _this.parents('.tg-topic').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_specimen_type_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
        _this.parents('.tg-topic').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    //Close hover panel on click
    $(document).on('click', '.close_showpanel', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
    });

    $("input[name='hospital_user']").click(function() {
        var _this = $(this);
        var hospital_name = $("input[name='hospital_user']:checked").data('hospitalname');
        var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Clinic: <em>" + hospital_name + "</em></span></a>";
        _this.parents('.tg-topic').find('.display_selected_option').text(hospital_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-clinic').html(tag_html);
    });

    $("input[name='lab_name']").click(function() {
        var _this = $(this);
        var lab_name = $("input[name='lab_name']:checked").data('labname');
        var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Lab: <em>" + lab_name + "</em></span></a>";
        _this.parents('.tg-topic').find('.display_selected_option').text(lab_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-labs').html(tag_html);
    });

    $("input[name='pathologist']").click(function() {
        var _this = $(this);
        var pathologist_name = $("input[name='pathologist']:checked").data('pathologist');
        var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Pathologist: <em>" + pathologist_name + "</em></span></a>";
        _this.parents('.tg-topic').find('.display_selected_option').text(pathologist_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-pathologist').html(tag_html);
    });

    $("input[name='report_urgency']").click(function() {
        var _this = $(this);
        var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
        var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Urgency: <em>" + urgency_name + "</em></span></a>";
        _this.parents('.tg-topic').find('.display_selected_option').text(urgency_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-urgency').html(tag_html);
    });

    $("input[name='specimen_type']").click(function() {
        var _this = $(this);
        var specimentype_name = $("input[name='specimen_type']:checked").data('specimentype');
        var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Specimen Type: <em>" + specimentype_name + "</em></span></a>";
        _this.parents('.tg-topic').find('.display_selected_option').text(specimentype_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-specimen').html(tag_html);
    });

    $(document).on('click', '.delete_track_record', function(e) {
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

    $(document).on('click', '.show_tag_clinic', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
        _this.parents('.tg-clinic').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_tag_clinic_user', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
        _this.parents('.tg-users').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_tag_labs', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
        _this.parents('.tg-labs').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_tag_pathologist', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
        _this.parents('.tg-pathologist').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_tag_urgency', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
        _this.parents('.tg-urgency').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', '.show_tag_specimen', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
        _this.parents('.tg-specimen').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });

    $(document).on('click', "input[name='tag_hospital_user']", function() {
        var _this = $(this);
        var hospital_user = $("input[name='tag_hospital_user']:checked").data('hospitalname');
        var record_id = _this.parents('.tg-clinic').data('recordid');
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        _this.parents('.tg-clinic').find('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        _this.parents('.tg-clinic').find('.tg-tag span em').text(hospital_user);
        //Send ajax request and update this existing record.
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/get_track_tag_hospital_user'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    _this.parents('.tg-clinic').next('.tg-users').find('.show-data-holder').remove();
                    _this.parents('.tg-clinic').next('.tg-users').find('.tg-tag span em').text('');
                    _this.parents('.tg-clinic').next('.tg-users').append(response.tags_data);
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    _this.parents('.tg-clinic').next('.tg-users').find('.tg-tag span em').text('');
                    _this.parents('.tg-clinic').next('.tg-users').find('.show-data-holder').remove();
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', ".tag_clinic_users", function() {
        var _this = $(this);
        var clinic_user = $("input[name='clinic_users']:checked").data('clinicuser');
        var record_id = _this.parents('.tg-users').data('recordid');
        var hospital_id = _this.data('hospitalid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        var clinic_user_id = _this.val();
        _this.parents('.tg-users').find('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        _this.parents('.tg-users').find('.tg-tag span em').text(clinic_user);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'clinic_user': clinic_user_id, 'hospital_id': hospital_id, 'tag_type': 'hospital_user', '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', ".tag_lab_name", function() {
        var _this = $(this);
        var labname = $("input[name='lab_name']:checked").data('labname');
        var record_id = _this.parents('.tg-labs').data('recordid');
        var lab_id = _this.val();
        _this.parents('.tg-labs').find('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        _this.parents('.tg-labs').find('.tg-tag span em').text(labname);
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'lab_id': lab_id, 'tag_type': 'lab_name', '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', ".tag_pathology_users", function() {
        var _this = $(this);
        var doctor_name = $("input[name='pathologist']:checked").data('pathologist');
        var record_id = _this.parents('.tg-pathologist').data('recordid');
        var doctor_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        _this.parents('.tg-pathologist').find('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        _this.parents('.tg-pathologist').find('.tg-tag span em').text(doctor_name);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'doctor_id': doctor_id, 'tag_type': 'pathologist', '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', ".tag_urgency", function() {
        var _this = $(this);
        var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
        var record_id = _this.parents('.tg-urgency').data('recordid');
        var urgency_val = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        _this.parents('.tg-urgency').find('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        _this.parents('.tg-urgency').find('.tg-tag span em').text(urgency_name);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'urgency_val': urgency_val, 'tag_type': 'urgency', '<?php echo $this->security->get_csrf_token_name(); ?>': cct }, success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', ".tag_specimen_type", function() {
        var _this = $(this);
        var specimen_type = $("input[name='specimen_type']:checked").data('specimentype');
        var record_id = _this.parents('.tg-specimen').data('recordid');
        var specimen_val = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        _this.parents('.tg-specimen').find('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        _this.parents('.tg-specimen').find('.tg-tag span em').text(specimen_type);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'specimen_val': specimen_val, 'tag_type': 'specimen', '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Close all tags on click data holders.
    $(document).on('click', '.tag_close_showpanel', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-tagsarea').find('.content-overlay').remove();
    });

    //Save Track Template Code
    $(document).on('click', '.save_track_template', function(e) {
        e.preventDefault();
        var _this = $(this);
        if ($('input[name=hospital_user]').is(':checked') === false ||
            $('input[name=clinic_users]').is(':checked') === false ||
            $('input[name=pathologist]').is(':checked') === false) {
            $.sticky('Clinic name, clinic user and pathologist must be selected.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }

        if ($('#track_template_input').hasClass('in')) {
            if ($('input[name=track_template_name]').val() === '') {
                $.sticky('Please provide the template name.', { classList: 'important', speed: 200, autoclose: 7000 });
                return false;
            }

            var lab_name = '';
            var report_urgency = '';
            var specimen_type = '';
            var hospital_user = $('input[name=hospital_user]:checked').val();
            var clinic_users = $('input[name=clinic_users]:checked').val();
            var pathologist = $('input[name=pathologist]:checked').val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
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
                data: {
                    'hospital_user': hospital_user,
                    'clinic_users': clinic_users,
                    'pathologist': pathologist,
                    'lab_name': lab_name,
                    'report_urgency': report_urgency,
                    'specimen_type': specimen_type,
                    'input_name': input_name,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function(response) {
                    if (response.type === 'success') {
                        _this.prev('#track_template_input').find('input').val('');
                        _this.prev('#track_template_input').collapse("hide");
                        $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    } else {
                        $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    }
                }
            });
        } else {
            $('#track_template_input').collapse("show");
        }
    });

    //Load track Template
    $(document).on('click', '.load_track_temp_btn', function(e) {
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
            $.sticky('Please choose the track template.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }

        $(_this.parents('.tg-trackrecords').find('.show_clinic .hospital_user')).each(function(index) {
            if ($(this).val() == hospital_id) {
                var hospital_name = $(this).attr('data-hospitalname');
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                $(this).parents('.tg-catagoryholder').find('.tg-clinic .display_selected_option').text(hospital_name);
                $(this).prop("checked", true);
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/search_hospital_group_users'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: { 'hospital_id': hospital_id, 'clinic_user_id': clinic_user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                    success: function(data) {
                        if (data.type === 'success') {
                            $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                            $('.tg-clinic').parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                            $('.tg-clinic').parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                            show_clinic_users();
                        } else {
                           $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                            $('.tg-clinic').parents('.tg-topic').next('.tg-topic').hide();
                            $('.tg-clinic').parents('.tg-topic').next('.tg-topic').html('');
                            $('.tg-clinic').parents('.tg-trackrecords').find('.tg-tagsarea .tg-users').html('');
                        }
                    }
                });
            }
        });

        $(_this.parents('.tg-trackrecords').find('.show_pathologists .pathologist')).each(function(index) {
            if ($(this).val() == pathologist_id) {
                var pathologist = $(this).attr('data-pathologist');
                $(this).parents('.tg-catagoryholder').find('.tg-pathologist .display_selected_option').text(pathologist);
                $(this).prop("checked", true);
            }
        });

        $(_this.parents('.tg-trackrecords').find('.show_labs .track_lab_name')).each(function(index) {
            if ($(this).val() == lab_name) {
                var labname = $(this).attr('data-labname');
                $(this).parents('.tg-catagoryholder').find('.tg-heartpuls .display_selected_option').text(labname);
                $(this).prop("checked", true);
            }
        });

        $(_this.parents('.tg-trackrecords').find('.show_report_urgency .report_urgency')).each(function(index) {
            if ($(this).val() == report_urgency) {
                var urgency = $(this).attr('data-urgency');
                $(this).parents('.tg-catagoryholder').find('.tg-urgency .display_selected_option').text(urgency);
                $(this).prop("checked", true);
            }
        });

        $(_this.parents('.tg-trackrecords').find('.show_specimen_type .specimen_type')).each(function(index) {
            if ($(this).val() == specimen_type) {
                var speci_type = $(this).attr('data-specimentype');
                $(this).parents('.tg-catagoryholder').find('.tg-specimentype .display_selected_option').text(speci_type);
                $(this).prop("checked", true);
            }
        });

    });
});

$(document).ready(function() {
    $(document).on('click', '.central_admin_form_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.admin_central_reporting_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**===========================================
     * Save booked in from clinic data
     ==========================================*/
    $(document).on('click', '.admin_book_in_from_clinic', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var barcode = _this.data('barcode');
        var status_key = _this.data('statuskey');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    _this.parents('.track_search_record').find('.load-track-record-data').html(response.record_track_data);
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.track_search_record').find('.load-track-record-data').html('');
                }
            }
        });
    });

    /**===========================================
     * Save booked in from clinic data
     ==========================================*/
    $(document).on('click', '.admin_received_from_lab', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.track_search_record').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.track_search_record').find('.load-track-record-data').html('');
                }
            }
        });
    });

    /**===========================================
     * Save booked in data from laboratory
     ==========================================*/
    $(document).on('click', '.admin_laboratory_booked_in', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**===========================================
     * Save booked in data from laboratory
     ==========================================*/
    $(document).on('click', '.admin_laboratory_released', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**===========================================
     * Save booked in data from laboratory
     ==========================================*/
    $(document).on('click', '.admin_report_slide_booked_in', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**===========================================
     * Save booked in data from laboratory
     ==========================================*/
    $(document).on('click', '.admin_report_released_slide_back_to_lab', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**=====================================================
     * Set Doctor can add record permission status in DB
     ====================================================**/
    $("input[name='doctor_add_record']").click(function() {
        var _this = $(this);
        var perm_status = 'off';
        if ($("input[name='doctor_add_record']").is(':checked')) {
            perm_status = 'on';
        }
        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_add_record_perm'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'perm_status': perm_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**============================================================
     * Set Doctor can change micro codes permission status in DB
     ==========================================================**/
    $("input[name='doctor_manage_codes']").click(function() {
        var _this = $(this);
        var perm_status = 'off';
        if ($("input[name='doctor_manage_codes']").is(':checked')) {
            perm_status = 'on';
        }
        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_change_micro_perm'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'perm_status': perm_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**============================================================
     * Set permission for doctor to view other doctors record.
     ==========================================================**/
    $("input[name='view_other_doctor_records']").click(function() {
        var _this = $(this);
        var perm_status = 'off';
        if ($("input[name='view_other_doctor_records']").is(':checked')) {
            perm_status = 'on';
        }
        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_change_view_other_records_perm'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'perm_status': perm_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });
    /**============================================================
     * Set Dermatological Surgeon and Clinican Permissions into DB
     ==========================================================**/
    $("input[name='can_view_other_records']").click(function() {
        var _this = $(this);
        var perm_status = 'off';
        if ($("input[name='can_view_other_records']").is(':checked')) {
            perm_status = 'on';
        }
        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_surgeon_clinican_record_perm'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'perm_status': perm_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**=======================================================
     * Save hospital lab tracking permission
     ======================================================**/
    $("input[name='hospital_lab_track']").click(function() {
        var _this = $(this);
        var perm_status = 'off';
        if ($("input[name='hospital_lab_track']").is(':checked')) {
            perm_status = 'on';
        }
        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_hospiatl_lab_track_perm'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'perm_status': perm_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**=======================================================
     * Save Exclude User From Request Viewed For Hospitals
     ======================================================**/
    $("input[name='exclude_user_from_request_viewed']").click(function() {
        var _this = $(this);
        var perm_status = 'off';
        if ($("input[name='exclude_user_from_request_viewed']").is(':checked')) {
            perm_status = 'on';
        }
        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/setUserExcludeFromRequestViewedPermission'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'perm_status': perm_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**=======================================================
     * Save hospital user specimen seen permission
     ======================================================**/
    $(document).on('click', 'input[name="hide_specimen_data"]', function() {
        var _this = $(this);

        var perm_status = 'off';
        if ($("input[name='hide_specimen_data']").is(':checked')) {
            perm_status = 'on';
        }

        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_hospiatl_user_specimen_permission'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'perm_status': perm_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $("input[name='surgeon_clinician_group']").click(function() {
        var _this = $(this);
        var original_group = _this.data('originalgroup');
        var group_status = original_group;
        if ($("input[name='surgeon_clinician_group']").is(':checked')) {
            group_status = 'GC';
        }
        var user_id = _this.data('userid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_surgeon_clinican_role_assign'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'group_status': group_status, 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });
});

function show_clinic_users() {
    $(document).on('click', '.show_clinic_users_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
        _this.parents('.tg-topic').find('.show-data-holder').css({ "opacity": "1", "visibility": "visible" });
    });
    $("input[name='clinic_users']").click(function() {
        var _this = $(this);
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        var hospital_user_name = $("input[name='clinic_users']:checked").data('clinicuser');
        var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Users: <em>" + hospital_user_name + "</em></span></a>";
        _this.parents('.tg-topic').find('.display_selected_option').text(hospital_user_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
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
$(document).ready(function() {

    /**------------------------------------------------
     * Seacrh Tacking no using barcode scanner.
     -----------------------------------------------*/
    $('input[name=lab_barcode_no]').focus();
    $('input[name=lab_barcode_no]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var barcode = _this.val();
        var search_type = 'ura_barcode_no';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'barcode': barcode, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
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
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**------------------------------------------------
     * Seacrh Tacking no using tracking no ul number scanner.
     -----------------------------------------------*/
    $('input[name=lab_tracking_no_ul]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var track_no_ul = _this.val();
        var search_type = 'serial_number';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'track_no_ul': track_no_ul, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
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
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**------------------------------------------------
     * Seacrh Tacking no using tracking no ul number scanner.
     -----------------------------------------------*/
    $('input[name=lab_tracking_no_lab]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var track_no_lab = _this.val();
        var search_type = 'lab_number';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'track_no_lab': track_no_lab, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
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
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**===========================================
     * Save Book In From Clinic
     ==========================================*/
    $(document).on('click', '.institute_book_in_from_clinic', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    /**===========================================
     * Save Book Out To Lab Primary Release
     ==========================================*/
    $(document).on('click', '.institute_book_out_to_lab_primary_release', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    /**===========================================
     * Save Book Out To Lab FW Completed
     ==========================================*/
    $(document).on('click', '.institute_book_out_to_lab_fw_completed', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });
});

/**===================================================
 * Record Tracking For Doctor From Admin Side
 ===================================================*/
$(document).ready(function() {

    /**------------------------------------------------
     * Seacrh Tacking no using barcode scanner.
     -----------------------------------------------*/
    $('input[name=doc_barcode_no]').focus();
    $('input[name=doc_barcode_no]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var barcode = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        var search_type = 'ura_barcode_no';
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'barcode': barcode, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                    _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                    $('input[name=doc_barcode_no]').val('');
                    $('input[name=doc_barcode_no]').focus();
                } else {
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    /**------------------------------------------------
     * Seacrh Tacking no using tracking no ul number scanner.
     -----------------------------------------------*/
    $('input[name=doc_tracking_no_ul]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var track_no_ul = _this.val();
        var search_type = 'serial_number';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'track_no_ul': track_no_ul, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                    _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                    $('input[name=doc_barcode_no]').val('');
                    $('input[name=doc_barcode_no]').focus();
                } else {
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    /**------------------------------------------------
     * Seacrh Tacking no using tracking no ul number scanner.
     -----------------------------------------------*/
    $('input[name=doc_tracking_no_lab]').bind('change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var track_no_lab = _this.val();
        var search_type = 'lab_number';
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'track_no_lab': track_no_lab, 'search_type': search_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                    _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                    $('input[name=doc_barcode_no]').val('');
                    $('input[name=doc_barcode_no]').focus();
                } else {
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    /**===========================================
     * Save slides booked in
     ==========================================*/
    $(document).on('click', '.doctor_slides_booked_in', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    /**===========================================
     * Save released slides back to lab
     ==========================================*/
    $(document).on('click', '.doctor_released_slides_back_to_lab', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_received_from_lab', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_draft_report', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_fw_request_ss', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_booked_out_to_lab_fw_completed', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_mdt', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_authorised', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_fw_request_immuno', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

    $(document).on('click', '.doctor_supplementary', function(e) {
        e.preventDefault();
        var _this = $(this);
        var record_id = _this.data('recordid');
        var status_key = _this.data('statuskey');
        var barcode_no = _this.data('barcode');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'record_id': record_id, 'track_status_key': status_key, 'barcode_no': barcode_no, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                }
            }
        });
    });

});

//Display admin records
$(document).ready(function() {

    load_ajax_data('');
    $(document).on("click", ".flag_status", function(e) {
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

    //Save Hopital TAT Date Option
    $(document).on('click', '.tat_assign_date', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.tat_assign_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_hospital_tat_dates_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Hide the costing option if tat checkbox select
    var tat_chbx = $('input[name=hos_inv_tat]');
    $('input[name=hos_inv_tat]').on('click', function() {
        if (tat_chbx.is(':checked')) {
            $('.hos_inv_form .hide_if_tat_select').hide();
            $('.hos_inv_form .show_tat_opt').show();
        } else {
            $('.hos_inv_form .hide_if_tat_select').show();
            $('.hos_inv_form .show_tat_opt').hide();
        }
    });

    //Save the hospital invoice costing option
    $(document).on('click', '.hos_inv_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var checkbox_val = 'false';
        if ($('input[name=hos_inv_tat]').is(':checked')) {
            checkbox_val = 'true';
        }
        var form_data = 'checkbox_val=' + checkbox_val + '&' + $('.hos_inv_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_hospital_invoice_cost_opt'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.hos_inv_form').find('input[name=hos_cost_code_name]').val('');
                    _this.parents('.hos_inv_form').find('input[name=hos_cost_code_name_without_tat]').val('');
                    _this.parents('.hos_inv_form').find('input[name=hos_cost_code_price]').val('');
                    _this.parents('.hos_inv_form').find('textarea[name=hos_cost_code_desc]').val('');
                    _this.parents('.hos_inv_form').find('input[name=hos_cost_code_price_1_to_6]').val('');
                    _this.parents('.hos_inv_form').find('textarea[name=hos_cost_code_desc_1_to_6]').val('');
                    _this.parents('.hos_inv_form').find('input[name=hos_cost_code_price_7_to_abv]').val('');
                    _this.parents('.hos_inv_form').find('textarea[name=hos_cost_code_desc_7_to_abv]').val('');
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Load Hospital Invoice Option Ajax Data.
    $(document).on('change', '.refresh_hos_inv_opt_data', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/load_hospital_invoice_opt_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.hospital_invoice_data').find('.load_hos_inv_opt_data').html(response.encode_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.hospital_invoice_data').find('.load_hos_inv_opt_data').html('');
                }
            }
        });
    });

    //Make the cost code default.
    $(document).on('change', 'input[name=make_default]', function(e) {
        e.preventDefault();
        var _this = $(this);
        var make_default = _this.val();
        var tat_id = _this.data('tatid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_code_name_default'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'make_default': make_default, 'tat_id': tat_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Delete Hospital Invoice Option Data
    $(document).on('click', '.delete_tat_inv_opt', function(e) {
        e.preventDefault();
        var _this = $(this);
        var tat_id = _this.data('tatid');
        var code_name = _this.data('codename');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_hospital_invoice_opt_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'tat_id': tat_id, 'code_name': code_name, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Update Tat Option Data
    $(document).on('click', '.update_tat_opt_data_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.update_tat_opt_data_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/update_hospital_invoice_opt_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /**==========================================
     * Doctor TAT Invoice Options Code Start
     ===========================================*/
    var doc_tat_chbx = $('input[name=doc_inv_tat]');
    $('input[name=doc_inv_tat]').on('click', function() {
        if (doc_tat_chbx.is(':checked')) {
            $('.doc_inv_form .show_invoice_opt').hide();
            $('.doc_inv_form .show_tat_opt').show();
        } else {
            $('.doc_inv_form .show_invoice_opt').show();
            $('.doc_inv_form .show_tat_opt').hide();
        }
    });

    //Save the doctor invoice costing option
    $(document).on('click', '.doc_inv_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var checkbox_val = 'false';
        if ($('input[name=doc_inv_tat]').is(':checked')) {
            checkbox_val = 'true';
        }
        var form_data = 'checkbox_val=' + checkbox_val + '&' + $('.doc_inv_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_doctor_invoice_cost_opt'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.doc_inv_form').find('input[name=hos_inv_routine_rate]').val('');
                    _this.parents('.doc_inv_form').find('input[name=hos_inv_alopecia_rate]').val('');
                    _this.parents('.doc_inv_form').find('input[name=hos_inv_imf_rate]').val('');
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Load Hospital Invoice Option Ajax Data.
    $(document).on('change', '.refresh_doc_inv_opt_data', function(e) {
        e.preventDefault();
        var _this = $(this);
        var doctor_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/load_doctor_invoice_opt_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'doctor_id': doctor_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.doctor_invoice_data').find('.load_doc_inv_opt_data').html(response.encode_data);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                    _this.parents('.doctor_invoice_data').find('.load_doc_inv_opt_data').html('');
                }
            }
        });
    });

    //Delete Hospital Invoice Option Data
    $(document).on('click', '.delete_doc_tat_inv_opt', function(e) {
        e.preventDefault();
        var _this = $(this);
        var tat_id = _this.data('tatid');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_doctor_invoice_opt_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'tat_id': tat_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Update Tat Option Data
    $(document).on('click', '.update_tat_doc_opt_data_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.update_tat_doc_opt_data_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/update_doctor_invoice_opt_data'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Save doctor invoice template
    $(document).on('click', '.save_doc_inv_temp', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.doctor_invoice_temp_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_doctor_invoice_template_settings'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Find Doctor Invoice Template Data
    $(document).on('change', '.find_doctor_inv_temp', function() {
        var _this = $(this);
        var doctor_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_doctor_invoice_template_settings'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'doctor_id': doctor_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    _this.parents('.doctor_invoice_temp_form').find('.inv_left_settings').html(response.to_section_data);
                    _this.parents('.doctor_invoice_temp_form').find('.inv_right_settings').html(response.from_section_data);
                    _this.parents('.doctor_invoice_temp_form').find('.inv_comments_settings').html(response.comment_data);
                    _this.parents('.doctor_invoice_temp_form').find('.inv_footer_settings').html(response.footer_data);
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Save doctor invoice template
    $(document).on('click', '.save_hos_inv_temp', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.hospital_invoice_temp_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_hospital_invoice_template_settings'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Find Doctor Invoice Template Data
    $(document).on('change', '.find_hospital_inv_temp', function() {
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/search_hospital_invoice_template_settings'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    _this.parents('.hospital_invoice_temp_form').find('.inv_left_settings').html(response.to_section_data);
                    _this.parents('.hospital_invoice_temp_form').find('.inv_right_settings').html(response.from_section_data);
                    _this.parents('.hospital_invoice_temp_form').find('.inv_comments_settings').html(response.comment_data);
                    _this.parents('.hospital_invoice_temp_form').find('.inv_footer_settings').html(response.footer_data);
                    _this.parents('.hospital_invoice_temp_form').find('input[name=invoice_to_sec_logo]').val(response.to_logo);
                    _this.parents('.hospital_invoice_temp_form').find('input[name=invoice_from_sec_logo]').val(response.from_logo);
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    /*********************************************************
     * @Upload Area Documents
     ********************************************************/
    /* initialize uploader */

    var InvToSecUploader = new plupload.Uploader({
        browse_button: 'upload_to_sec_logo', // this can be an id of a DOM element or the DOM element itself
        file_data_name: 'aleatha_image_uploader',
        container: 'plupload-profile-container',
        multi_selection: false,
        multipart_params: {
            "type": "upload_doc"
        },
        url: '<?php echo base_url('index.php/admin/invoice_logo_aleatha_image_uploader'); ?>',
        filters: {
            mime_types: [
                { title: 'Upload Document', extensions: "jpg,jpeg,png" }
            ],
            max_file_size: '5mb',
            prevent_duplicates: true
        }
    });
    InvToSecUploader.init();
    /* Run after adding file */
    InvToSecUploader.bind('FilesAdded', function(up, files) {
        var html = '';
        var profileThumb = "";
        plupload.each(files, function(file) {
            profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
        });
        $('.profile-to-sec-img-wrap').html(profileThumb);
        up.refresh();
        InvToSecUploader.start();
    });
    InvToSecUploader.bind('Error', function(up, err) {
        $.sticky(err.message, { classList: 'important', speed: 200, autoclose: 5000 });
    });
    InvToSecUploader.bind('FileUploaded', function(up, file, ajax_response) {
        var response = $.parseJSON(ajax_response.response);
        if (response.success) {
            $('.invoice_to_section_logo').text(response.file_path);
            $('input[name=invoice_to_sec_logo]').val(response.full_path);
        } else {
            $.sticky(response.message, { classList: 'important', speed: 200, autoclose: 5000 });
        }
    });
    var InvFromSecUploader = new plupload.Uploader({
        browse_button: 'upload_from_sec_logo', // this can be an id of a DOM element or the DOM element itself
        file_data_name: 'aleatha_image_uploader',
        container: 'plupload-profile-container',
        multi_selection: false,
        multipart_params: {
            "type": "upload_doc"
        },
        url: '<?php echo base_url('index.php/admin/invoice_logo_aleatha_image_uploader'); ?>',
        filters: {
            mime_types: [
                { title: 'Upload Document', extensions: "jpg,jpeg,png" }
            ],
            max_file_size: '5mb',
            prevent_duplicates: true
        }
    });
    InvFromSecUploader.init();
    /* Run after adding file */
    InvFromSecUploader.bind('FilesAdded', function(up, files) {
        var html = '';
        var profileThumb = "";
        plupload.each(files, function(file) {
            profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
        });
        $('.profile-from-sec-img-wrap').html(profileThumb);
        up.refresh();
        InvFromSecUploader.start();
    });
    InvFromSecUploader.bind('Error', function(up, err) {
        $.sticky(err.message, { classList: 'important', speed: 200, autoclose: 5000 });
    });
    InvFromSecUploader.bind('FileUploaded', function(up, file, ajax_response) {
        var response = $.parseJSON(ajax_response.response);
        if (response.success) {
            $('.invoice_from_section_logo').text(response.file_path);
            $('input[name=invoice_from_sec_logo]').val(response.full_path);
        } else {
            $.sticky(response.message, { classList: 'important', speed: 200, autoclose: 5000 });
        }
    });

    //Show TAT Settings
    $(document).on('change', '.show_tat_settings', function(e) {
        e.preventDefault();
        var _this = $(this);
        var hospital_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/display_hospital_tat_settings'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'hospital_id': hospital_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    _this.parents('.display_tat').find('.display_tat_settings').html(response.encode_data);
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    _this.parents('.display_tat').find('.display_tat_settings').html('');
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Delete TAT Setting
    $(document).on('click', '.delete_tat_setting', function(e) {
        e.preventDefault();
        var _this = $(this);
        var tat_id = _this.data('tatid');
        var parent = _this.parent('td').parent('tr');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_hospital_tat_settings'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'tat_id': tat_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Unlock Account if locked out due to failed login attempts.
    $(document).on('click', '.unlock_account', function(e) {
        e.preventDefault();
        var _this = $(this);
        var user_email = _this.data('useremail');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/unlock_user_account'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'user_email': user_email, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    setTimeout(function() {
                        document.location.reload();
                    }, 1500);
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Specimen Data Code
    $(document).on('click', '.save_speci_data_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('.speci_data_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/specimen_data_save'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Delete Specimen Data Code
    $(document).on('click', '.item_delete', function(e) {
        e.preventDefault();
        var _this = $(this);
        var item_type = _this.data('itemtype');
        var item_id = _this.data('itemid');
        var parent = _this.parent('li');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/specimen_data_delete'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'item_id': item_id, 'item_type': item_type, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                } else {
                    $.sticky(response.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
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
        "language": {
            "infoFiltered": ""
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]], "order": [],
        "ajax": {
            url: ajax_url,
            type: "POST",
            data: { 'year': url_year, 'type': url_type, 'flag_type': flag_type }
        },
        "columnDefs": [
            {
                "targets": '', //first column / numbering column
                "orderable": false, //set not orderable
            },
        ],
        fnDrawCallback: function() {
            ajax_show_flags_on_hover();
            ajax_show_comment_box_hover();
            ajax_display_comment_box();
            ajax_change_flag_status();
            ajax_delete_flag_comment();
        },
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            var rowClass = aData[18];
            var rowCodeClass = aData[17];
            rowClass = rowClass.replace(/<(.|\n)*?>/g, '');
            rowCodeClass = rowCodeClass.replace(/<(.|\n)*?>/g, '');
            $('td', nRow).eq(9).addClass('flag_column');
            $('td', nRow).eq(17).addClass('hide_content');
            $('td', nRow).eq(18).addClass('hide_content');
            $(nRow).addClass(rowClass);
            $('td', nRow).eq(0).addClass(rowCodeClass);
            $(nRow).addClass(rowCodeClass);
        }
    });
}

function ajax_show_flags_on_hover() {
    $('#admin_display_records tbody .flag_column ul.report_flags').hide();
    $('#admin_display_records .flag_column .hover_flags').hover(function() {
            _this = $(this);
            _this.find('ul.report_flags').fadeIn('fast');
        }, function() {
            _this.find('ul.report_flags').fadeOut('fast');
            return false;
        }
    );
}

function ajax_show_comment_box_hover() {
    $(document).on('click', '.show_comments_list', function(event) {
        var _this = $(this);
        var record_id = _this.data('recordid');
        dynamic_id = _this.data('modalid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $('#display_comments_list-' + dynamic_id).modal('show');
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/show_comments_box'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'record_id': record_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'error') {
                    $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').addClass('alert alert-danger');
                    $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').html(data.msg);
                } else {
                    $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').addClass('alert alert-success');
                    $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').html(data.msg);
                    $('#display_comments_list-' + dynamic_id).find('.flag_comments_dynamic_data').html(data.flag_data);
                    window.setTimeout(function() {
                        $('#display_comments_list-' + dynamic_id).find('.display_flag_msg').slideUp('slow');
                    }, 1500);
                }
            }
        });
    });
}

function ajax_display_comment_box() {

    $(document).on('click', '#display_comment_box', function(e) {
        e.preventDefault();
        var _this = $(this);
        dynamic_id = _this.data('modalid');
        $('#flag_comment_model-' + dynamic_id).modal('show');
        $(document).on('click', '#flag_comments_save', function(e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_flag_comments'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function(data) {
                    if (data.type === 'error') {
                        _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').addClass('alert alert-danger').show();
                        _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').html(data.msg);
                    } else {
                        _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').addClass('alert alert-success').show();
                        _this.parents('#flag_comment_model-' + dynamic_id).find('.flag_msg').html(data.msg);
                        window.setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                }
            });
        });
    });
}

function ajax_change_flag_status() {
    $('#admin_display_records .flag_column').on('click', '.flag_change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var _flag = $(this).data('flag');
        var _serial = $(this).data('serial');
        var _recordid = $(this).data('recordid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/set_flag_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'flag_status': _flag, 'record_id': _recordid, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type == 'error') {
                    _this.parents('.report_listing').find('.flag_message').addClass('alert alert-danger').show();
                    _this.parents('.report_listing').find('.flag_message').html(data.msg);
                } else {
                    _this.parents('.report_listing').find('.flag_message').addClass('alert alert-success').show();
                    _this.parents('.report_listing').find('.flag_message').html(data.msg);
                    _this.parents('.flag_column').find('.flag_images').html(data.flag_data);
                    $(_this.parents('.report_flags').find('li')).each(function() {
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

    $(document).on('click', '#delete_flag_comment', function(e) {
        e.preventDefault();
        var _this = $(this);
        var flag_id = _this.data('flagid');
        var parent = _this.parent("li");
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/delete_flag_comments'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'flag_id': flag_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(1700, function() {
                        parent.remove();
                    });
                }
            }
        });
    });
}

$(document).ready(function() {
    var form = $(".uralensis_login_form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            confirm: {
                equalTo: "#password"
            }
        }
    });

    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "section",
        saveState: false,
        transitionEffect: "slideLeft",
        transitionEffectSpeed: 200,
        titleTemplate: '<span class="number" style="text-align:center !important;">#index#</span>',
        labels: {
            finish: "Login",
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled";
            var move = false;
            if (currentIndex === 0) {
                move = false;
                var identity = $(form).find('input[name=identity]').val();
                var password = $(form).find('input[name=password]').val();
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                $.ajax({
                    url: '<?php echo base_url('/index.php/withoutlogin/checkUserLoginDetails'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: { 'user_identity': identity, 'user_password': password, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                    success: function(data) {
                        if (data.type === 'success') {
                            $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                            //     var cookieValue = $.cookie("user_id");
                            //     var remembercookieValue = $.cookie("remember_auth_access_"+cookieValue);

                            //    if (typeof cookieValue !== 'undefined') {
                            //        if (typeof remembercookieValue === 'undefined') {
                            //            form.children("div").steps("add", {
                            //                title: "3",
                            //                content: "<section><div class='well text-center'><div class='auth_message'></div><div id='loader'><img src='<?php echo base_url('assets/img/ajax-loader.gif'); ?>'></div><h3>Enter Access Token</h3>       <input type='text' name='verify_auth' id='verify_auth'><hr><p><input id='remember_this_access' value='true' type='checkbox' name='remember_this_access'> Remember this device for 1 month.</p></div></section>"
                            //            });
                            //        }
                            //    }
                            move = true;
                        } else {
                           $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                            if ($('input[name=identity]').val() == '') {
                                $(form).find('input[name=identity]').addClass(data.error_class);
                            }
                            if ($('input[name=password]').val() == '') {
                                $(form).find('input[name=password]').addClass(data.error_class);
                            }
                            move = false;
                        }
                    }
                });
            }

            if (newIndex === 2) {
                move = false;
                var identity = $(form).find('input[name=identity]').val();
                var password = $(form).find('input[name=password]').val();
                var memorable1 = $(form).find('input[name=memorable1]').val();
                var memorable2 = $(form).find('input[name=memorable2]').val();
                var hidden_memorable1 = $(form).find('input[name=mem]').val();
                var hidden_memorable2 = $(form).find('input[name=mem2]').val();
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                $.ajax({
                    url: '<?php echo base_url('/index.php/withoutlogin/checkUserMemorableDetails'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: {
                        'user_identity': identity,
                        'user_password': password,
                        'memorable1': memorable1,
                        'memorable2': memorable2,
                        'hidden_mem1': hidden_memorable1,
                        'hidden_mem2': hidden_memorable2,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    success: function(data) {

                        if (data.type === 'success') {
                            $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                            move = true;
                        } else {
                           $.sticky(data.msg, { classList: 'success', speed: 'slow' });

                            setTimeout(function() {
                                window.location.reload(1);
                            }, 5000);
                            if ($('input[name=memorable1]').val() == '') {
                                $(form).find('input[name=memorable1]').addClass(data.error_class);


                            }
                            if ($('input[name=memorable2]').val() == '') {
                                $(form).find('input[name=memorable2]').addClass(data.error_class);


                            }
                            move = false;
                        }

                    }

                });
            }
            //                else {
//                    move = true;
//                }

            return move;
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            var move = false;
            if (currentIndex === 2) {
                move = false;
                var verify_auth = $(form).find('input[name=auth_token]').val();


                var identity = $(form).find('input[name=identity]').val();
                var password = $(form).find('input[name=password]').val();
                var remember_pc = false;
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                //$("#token").val(cct);

                if ($('input[name=remember_this_access]').is(':checked')) {
                    remember_pc = true;
                }
                $.ajax({
                    url: '<?php echo base_url('/index.php/withoutlogin/CheckEmailTokenValidations'); ?>', //Replaced by checkAccessToken Mehtod which was used for authy
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: { 'verify_auth': verify_auth, 'user_identity': identity, 'user_password': password, 'remember_pc': remember_pc, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
                    success: function(data) {
                        if (data.type === 'success') {
                            $.sticky(data.msg, { classList: 'success', speed: 'slow' });


                            move = true;
                        } else {
                           $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                            if ($('input[name=verify_auth]').val() == '') {
                                $(form).find('input[name=verify_auth]').addClass(data.error_class);
                            }
                            move = false;
                        }
                    }
                });
            } else {
                move = false;
                var identity = $(form).find('input[name=identity]').val();
                var password = $(form).find('input[name=password]').val();
                var memorable1 = $(form).find('input[name=memorable1]').val();
                var memorable2 = $(form).find('input[name=memorable2]').val();
                var hidden_memorable1 = $(form).find('input[name=mem]').val();
                var hidden_memorable2 = $(form).find('input[name=mem2]').val();
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                $.ajax({
                    url: '<?php echo base_url('/index.php/withoutlogin/checkUserMemorableOnly'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: {
                        'user_identity': identity,
                        'user_password': password,
                        'memorable1': memorable1,
                        'memorable2': memorable2,
                        'hidden_mem1': hidden_memorable1,
                        'hidden_mem2': hidden_memorable2,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    success: function(data) {
                        if (data.type === 'success') {
                            $.sticky(data.msg, { classList: 'success', speed: 'slow' });

                            move = true;
                        } else {
                           $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                            if ($('input[name=memorable1]').val() == '') {
                                $(form).find('input[name=memorable1]').addClass(data.error_class);
                                location.reload();

                            }
                            if ($('input[name=memorable2]').val() == '') {
                                $(form).find('input[name=memorable2]').addClass(data.error_class);
                                location.reload();

                            }
                            move = false;
                        }
                    }
                });
            }

            return move;
            return form.valid();
        },
        onFinished: function(event, currentIndex) {


            $("form#wizard").submit();
        }
    });

    //LogOut All Users
    $(document).on('click', '.logout-all-users', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/logoutAllUsers'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    });

    //Login As Admin Functionality
    $(document).on('click', '.login-as-admin', function(e) {
        e.preventDefault();
        var _this = $(this);
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        var user_id = _this.data('userid');
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/loginAsAdmin'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    setTimeout(function() {
                        window.location.href = data.redirect_url;
                    }, 5000);
                }
            }
        });
    });


    //Generate Pins for users to get login

    $(document).on('click', '.generate-pin', function(e) {
        e.preventDefault();
        var _this = $(this);
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        var user_id = _this.data('userid');
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/generatepins'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    setTimeout(function() {
                        window.location.href = data.redirect_url;
                    }, 5000);
                }
            }
        });
    });
});

//Request To Check If User is Still Logged In
$(document).ready(function() {
    $(document).idle({
        onIdle: function() {
            $.sticky('Session has timedout, Please wait while the page refresh.', { classList: 'success', speed: 200, autoclose: 7000 });
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        },
        onShow: function() {

        },
        idle: 7210000,
        events: 'mousemove keydown mousedown touchstart'
    });

    /*Update Hospital Clinician*/
    $(document).on('keyup', 'input[name=update_clinician]', delay(function(e) {
        var _this = $(this);
        var clinician_text = _this.val();
        var clinician_id = _this.data('clinicianid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        _this.parents('#edit_clinician_' + clinician_id).prev('.list-group-item').find('.clinician_text').text(clinician_text);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/updateHospitalClinician'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'clinician_id': clinician_id, 'clinician_text': clinician_text, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    }, 500));

    /*Update Dermatological Surgeon*/
    $(document).on('keyup', 'input[name=update_dermatological_surgeon]', delay(function(e) {
        var _this = $(this);
        var dermatological_text = _this.val();
        var dermatological_id = _this.data('dermatologicalsurgeonid');
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        _this.parents('#edit_dermatological_' + dermatological_id).prev('.list-group-item').find('.dermatological_text').text(dermatological_text);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/updateDermatologicalSurgeon'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'dermatological_id': dermatological_id, 'dermatological_text': dermatological_text, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                }
            }
        });
    }, 500));

    //Delete Admin User Functionality.
    $(document).on('click', '.delete_user', function(e) {
        e.preventDefault();
        var _this = $(this);
        var delete_url = _this.data('deleteurl');
        if (confirm("Are You Sure You Want To Delete This User")) {
            window.location.href = delete_url;
        } else {
            return false;
        }
    });

    //Create Group Lab Masking Formats Code
    $(document).on('change', '.group_lab_number_format', function(e) {
        e.preventDefault();
        var _this = $(this);
        var format = _this.val();
        if (format === "") {
            $('.lab_number_mask').hide();
        } else {
            $('.lab_number_mask').show();
            _this.parents('.create_user_form').find('.lab_number_mask').val(format);
        }

    });

    $('#private_message_table').DataTable({
        ordering: false,
        "processing": true,
        stateSave: true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
    });

    var receipent_suggestions = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '<?php echo base_url('index.php/admin/searchReceipentUsers?query=%QUERY'); ?>',
            wildcard: '%QUERY',
            transform: function(receipent_suggestions) {
                return $.map(receipent_suggestions, function(items) {
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
            display: function(item) {
                return item.first_name + ' ' + item.last_name;
            },
            limit: 30,
            templates: {
                suggestion: function(item) {
                    return '<div><a href="javascript:;">' + item.first_name + ' ' + item.last_name + '</a></div>';
                },
                notFound: function(query) {
                    return 'No Result Found...';
                },
                pending: function(query) {
                    return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                },
            }
        }).on('typeahead:selected', function(event, selection) {
        var _this = $(this);
        var previousVal = $("#recipients").val();
        //alert(previousVal);
        _this.typeahead('val', selection.username);
    });

    $(document).on('change', '.incident_hopsital_group_id', function() {
        var _this = $(this);
        var group_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/searchHospitalUsers'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'group_id': group_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-dashboardbox').find('.hospital_users_incident').html(data.users_data);
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-dashboardbox').find('.hospital_users_incident').html('');
                }
            }
        });
    });

    $(document).on('change', '.incident_report_user_id', function() {
        var _this = $(this);
        var user_id = _this.val();
        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/searchIncidentReports'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'user_id': user_id, '<?php echo $this->security->get_csrf_token_name(); ?>': cct },
            success: function(data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-dashboardbox').find('.hospital_incident_reports').html(data.incident_reports);
                } else {
                   $.sticky(data.msg, { classList: 'success', speed: 'slow' });
                    _this.parents('.tg-dashboardbox').find('.hospital_incident_reports').html('');
                }
            }
        });
    });

    /**
     *
     */
    $(document).on('click', '.surgeon_and_clinician', function() {
        var _this = $(this);
        if ($('.surgeon_and_clinician').is(':checked')) {
            _this.parents('.tg-editformholder').find('.surgeon_and_clinician_hospitals').show();
            _this.parents('.tg-editformholder').find('.surgeon_clinician_group').show();
        } else {
            _this.parents('.tg-editformholder').find('.surgeon_and_clinician_hospitals').css('display', 'none');
            _this.parents('.tg-editformholder').find('.surgeon_clinician_group').css('display', 'none');
        }
    });
});

function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function() {
            callback.apply(context, args);
        }, ms || 0);
    };
}
</script>
<script type="text/javascript">
    $(document).ready(function () {
        var badgeVal= Number($('.count_badge').text());
        if(badgeVal==0){
            $(".hide_if_no_email").addClass('hidden');
            $(".show_if_no_email").removeClass('hidden');
        }

        $('.select2_tags').select2();
    });



</script>
<script>
  $(document).ready(function() {
        $("#sidebar-menu").find("a").click(function(event) {
            var loc = $(this).attr('href');
            if (loc != '#') {
                window.location.href = loc;
            }
        });
    });
    
    function updateForm(id,name){
//        alert(id);
//        alert(name);
        if(id!='' && name!='') {
            $('#ura_tec_mdt_id').val(id);
            $('#ura_tech_mdt_cat_edit').val(name);
            $('#editModal').modal('show');
        }
        return false;
}
    
</script>

</html>