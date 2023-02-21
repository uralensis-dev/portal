<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
</div>
<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->
</body>


<!-- Jquery UI -->
<!-- Bootstrap Core JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="<?php echo base_url('/assets/newtheme/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
<!-- Slimscroll JS -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery.slimscroll.min.js'); ?>"></script>
<!-- Select2 JS -->
<script src="<?php echo base_url('/assets/newtheme/js/select2.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('/assets/newtheme/plugins/summernote/dist/summernote.js'); ?>"></script>
<!-- Datetimepicker JS -->
<script src="<?php echo base_url('/assets/newtheme/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/bootstrap-datetimepicker.min.js'); ?>"></script>
<!-- Datatable JS -->
<script src="<?php echo base_url('/assets/newtheme/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/buttons.print.min.js'); ?>"></script>
<!--<script src="--><?php //echo base_url('/assets/js/session.js');   ?><!--"></script>-->
<?php $this->load->view("session"); ?>
<!-- Tagsinput JS -->
<script src="<?php echo base_url('/assets/newtheme/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'); ?>"></script>
<!-- Task JS -->
<script src="<?php echo base_url('/assets/newtheme/js/task.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Chart JS -->
<script src="<?php echo base_url('/assets/subassets/plugins/morris/morris.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/subassets/plugins/raphael/raphael.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/chart.js') ?>"></script>

<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/moment-with-locales.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/underscore.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/plupload.full.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.steps.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.idle.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.blockUI.js'); ?>"></script>
<!--Full Calendar JS Files-->
<script src="<?php echo base_url('/assets/newtheme/js/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.fullcalendar.js'); ?>"></script>

<!-- Canvas js -->
<script src="<?php echo base_url('assets/js/canvasjs.min.js'); ?>"></script>

<script>
    // Base url as javascript variable
    const _base_url = `<?php echo base_url() ?>`
    const default_profile_pic = `<?php echo base_url() . DEFAULT_PROFILE_PIC ?>`;
</script>
<script>
    // CSRF Token
    var csrf_cookie = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
    var csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
    // Type
    // success, info, important, warning
    function message(msg = "", type = "success", duration = 7000) {
        jQuery.sticky(msg, {classList: type, speed: 200, autoclose: duration});
    }
</script>


<!-- Custom JS -->
<script src="<?php echo base_url('/assets/newtheme/js/app.js'); ?>"></script>
<script type="text/javascript">

    $(document).ready(function(){
        
        $('.list-view').click(function(){
           $("#list_view").addClass("show"); 
           $("#grid_view").removeClass("show"); 
           $(".grid-view").removeClass("active"); 
           $(this).addClass("active");
        });
         $('.grid-view').click(function(){
           $("#grid_view").addClass("show"); 
           $("#list_view").removeClass("show") ;
           $(".list-view").removeClass("active"); 
           $(this).addClass("active");
        });
    })
</script>
<?php
if (!empty($javascripts)) {
    foreach ($javascripts as $value) {
        ?>
        <script src="<?php echo base_url(); ?>assets/<?php echo $value; ?>"></script>
        <?php
    }
}
?>
<script>
    $(document).ready(function(){
        $(".courier_user_dp").select2({
            placeholder: 'Nothing Selected',
            width: '100%',
            templateResult: formatUsersList,
            templateSelection: formatUsersList
        });
        function formatUsersList(user) {
            console.log(user);
            if (!user.id) {
                return user.text;
            }
            var picture_path = user.element.title;
            var base_url = "<?php echo base_url(); ?>";
            var full_picture_path = base_url + "/" + picture_path;


            var $user_option = $(
                '<span ><img style="display: inline-block;" width="30" height="30" src="' + full_picture_path + '" /> ' + user.text + '</span>'
            );
            return $user_option;
        }
    });
</script>
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
            eventClick: function (info) {
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
            data: {
                'hospital_id': hospital_id,
                '<?php echo $this->security->get_csrf_token_name(); ?>': cct
            },
            dataType: "json",
            success: function (response) {
                if (response.type === 'success') {
                    $.sticky(response.msg, {
                        classList: 'success',
                        speed: 200,
                        autoclose: 7000
                    });
                    mdtFullCalendar(response.mdt_json);
                } else {
                    $.sticky(response.msg, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 7000
                    });
                    mdtFullCalendar([]);
                }
            }
        });

    }

    function AssignDoctor() 
	{
        $("#ajax_loading_effect").fadeIn();
        var batch_assign_data = $('#assign_doc_form').serialize();
		alert(batch_assign_data);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/save_batch_assign'); ?>',
            type: 'POST',
            dataType: 'json',
            data: batch_assign_data,
            success: function (data) 
			{
                if (data.type === 'error') {
                    $("#ajax_loading_effect").fadeOut();
                    alert(data.msg);
                    // $.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                } else {
                    _this.prop('disabled', true);
                    window.setTimeout(function () {
                        $("#ajax_loading_effect").fadeOut('fast');
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        location.reload();
                    }, 4000);
                }
            }
        });
    }
	
	 function AssignInDoctor() 
	{
        $("#ajax_loading_effect").fadeIn();
        var batch_assign_data = $('#assign_doc_form').serialize();
		//alert(batch_assign_data);
        $.ajax({
            url: '<?php echo base_url('/index.php/admin/assign_doctor'); ?>',
            type: 'POST',
            dataType: 'json',
            data: batch_assign_data,
            success: function (data) 
			{
				$("#ajax_loading_effect").fadeOut('fast');
                 window.location = '<?php echo base_url('admin/display_all/2020'); ?>';
            }
        });
		location.reload();
		$("#ajax_loading_effect").fadeOut('fast');
    }

    $(document).ready(function () {
        /*--------------------------------------
         Create Object For Admin Users Table
         --------------------------------------*/
        $('#admin_users_datatable').DataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
        });
        $('#document-table').DataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
        });
        

        $('#assign_doc_form').on('click', '#assign_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            $("#ajax_loading_effect").fadeIn();
            var batch_assign_data = $('#assign_doc_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_batch_assign'); ?>',
                type: 'POST',
                dataType: 'json',
                data: batch_assign_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $("#ajax_loading_effect").fadeOut();
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.prop('disabled', true);
                        window.setTimeout(function () {
                            $("#ajax_loading_effect").fadeOut('fast');
                            $.sticky(data.msg, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                            location.reload();
                        }, 4000);
                    }
                }
            });
        });

        //This code is for admin general settings
        $('.collapse_item').click(function (e) {
            var _this = $(this);
            var collapse_id = _this.attr('href');
            $('.collapse.in').collapse('hide');

            setTimeout(function () {
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
        $(document).on('change', '.display_mdt_list_on_hospital', function () {
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

        $(document).on('click', '.save_mdt_category', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.mdt_category_form').serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Admin/saveMdtCategory'); ?>",
                data: form_data,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.mdt_category_form').find('input[name=mdt_category_name]').val('');
                        _this.parents('.mdt_category_area').find('.mdt_category_list').html(response.mdt_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.mdt_category_area').find('.mdt_category_list').html('');
                    }
                }
            });
        });

        $(document).on('click', '.refresh_mdt_category_data', function (e) {
            e.preventDefault();
            var _this = $(this);
            var refresh_type = _this.data('refreshtype');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Admin/getMdtCategories'); ?>",
                dataType: "json",
                data: {
                    'refresh_type': refresh_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.mdt_category_area').find('.mdt_category_list').html(response.mdt_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.mdt_category_area').find('.mdt_category_list').html('');
                    }
                }
            });
        });

        $(document).on('click', '.mdt_cat_delete', function (e) {
            e.preventDefault();
            var _this = $(this);
            var mdt_cat_id = _this.data('mdtcategoryid');
            var parent = _this.parent("li");
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Admin/deleteMdtCategories'); ?>",
                dataType: "json",
                data: {
                    'mdt_cat_id': mdt_cat_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        parent.fadeOut('slow', function () {
                            parent.remove();
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.mdt_category_area').find('.mdt_category_list').html('');
                    }
                }
            });
        });

        /*--------------------------------------
         Hide/Display Hospital Groups.
         --------------------------------------*/
        $(document).on('click', 'input[name=user_groups]', function (e) {
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
                $(".open-hospital-group-list .tg-formradiohold .tg-radio").each(function (index) {
                    $(this).find('input[type=radio]').prop("checked", false);
                });
            }
        });
        /*--------------------------------------
         Check Create User Form
         --------------------------------------*/
        $(document).on('click', '.create_user_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            if ($('input[name=first_name]').val() === '') {
                $.sticky('First name must not empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=last_name]').val() === '') {
                $.sticky('Last name must not empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=phone]').val() === '') {
                $.sticky('Phone field must not empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=password]').val() === '') {
                $.sticky('Password field must not empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=password_confirm]').val() === '') {
                $.sticky('Password Confirm field must not empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=password]').val() !== $('input[name=password_confirm]').val()) {
                $.sticky('Your Confirm Password Did Not Match', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=email]').val() === '') {
                $.sticky('Email field must not empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=memorable]').val() === '') {
                $.sticky('Memorable field must not empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            _this.parents('.create_user_form').submit();
        });

        /*--------------------------------------
         Collapse Menu Function
         --------------------------------------*/
        function collapseMenu() {
            $('.tg-navigation ul li.menu-item-has-children, .tg-navigation ul li.page_item_has_children, .tg-dashboardnav ul li.menu-item-has-children, .tg-dashboardnav ul li.page_item_has_children, .tg-navigation ul li.menu-item-has-mega-menu').prepend('<span class="tg-dropdowarrow"><i class="fa fa-angle-down"></i></span>');
            $('.tg-navigation ul li.menu-item-has-children span, .tg-navigation ul li.page_item_has_children span, .tg-dashboardnav ul li.menu-item-has-children span, .tg-dashboardnav ul li.page_item_has_children span, .tg-navigation ul li.menu-item-has-mega-menu span').on('click', function () {
                $(this).parent('li').toggleClass('tg-open');
                $(this).next().next().slideToggle(300);
            });
        }

        collapseMenu();

        $('ul.hospital_groups_cats li.menu-item-has-children').on('click', function () {
            $(this).toggleClass('tg-open');
            $(this).find('ul.hospital_groups_sub_menu').slideToggle(300);
        });
        /*--------------------------------------
         DASHBOARD MENU
         --------------------------------------*/
        if ($('#tg-btnmenutoggle').length > 0) {
            $("#tg-btnmenutoggle").on('click', function (event) {
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
                advanced: {
                    autoExpandHorizontalScroll: true
                },
            });
        }
        /* -------------------------------------
         OPEN CLOSE
         -------------------------------------- */
        $('#tg-languagesbutton').on('click', function (event) {
            event.preventDefault();
            $('.tg-langnotification li ul').slideToggle();
        });

        $('ul.nav li.dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
        });

        $('#selectall').click(function (event) { //on click
            if (this.checked) { // check select status
                $('.check_selected').each(function () { //loop through each checkbox
                    this.checked = true; //select all checkboxes with class "checkbox1"
                });
            } else {
                $('.check_selected').each(function () { //loop through each checkbox
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
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
        });
        $('div.dataTables_filter input').focus();

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

        $('#update_personal_record').on('click', function (e) {
            e.preventDefault();
            var update_persoanl_record = $('#personal_record_form').serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/Admin/update_personal_report'); ?>",
                data: update_persoanl_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            errorPlacement: function (error, element) {
                offset = element.offset();
                error.insertBefore(element);
                error.addClass('label label-danger'); // add a class to the wrapper

            }
        });

        $('#finish_specimen').bind('click', function (e) {
            e.preventDefault();
            if (!confirm('Are You Sure You Want To Exit.')) {
                return false;
            } else {
                window.location.href = "<?php echo base_url('/index.php/admin/home'); ?>";
            }
        });

        $('#admin_display_records').on('click', '.record_id_unpublish', function () {
            var record_url = $(this).data('unpublishrecordid');
            var record_serial = $(this).data('recordserial');
            if (confirm("Are You Sure You Want To Un Publish This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

        $('#admin_display_records').on('click', '.record_id_delete', function () {
            var record_url = $(this).data('delrecordid');
            var record_serial = $(this).data('recordserial');
            if (confirm("Are You Sure You Want To Delete This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

        $('#assign_doc_form').on('click', '#doc_assign_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.prop('disabled', true);
            var doc_assign_data = $('#assign_doc_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_assign_doctor'); ?>',
                type: 'POST',
                dataType: 'json',
                data: doc_assign_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        window.setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });


        $('#save_cost_codes').on('click', '#save_cost_codes_btn', function (e) {
            e.preventDefault();
            var form_data = $('#save_cost_codes').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_cost_codes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.cost_code_msg').html(data.msg);
                    } else {
                        $('.cost_code_msg').html(data.msg);
                        window.setTimeout(function () {
                            location.reload()
                        }, 3000);
                    }
                }
            });
        });

        $('#update_cost_codes').on('click', '#update_cost_codes_btn', function (e) {
            e.preventDefault();
            var form_data = $('#update_cost_codes').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/update_cose_codes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.cost_code_msg').html(data.msg);
                    } else {
                        $('.cost_code_msg').html(data.msg);
                        window.setTimeout(function () {
                            window.location.href = '<?php echo base_url('/index.php/admin/manage_cost_codes'); ?>';
                        }, 3000);
                    }
                }
            });
        });

        $('.hospital_list').on('change', function (e) {
            e.preventDefault();
            var hospital_group_id = $("option:selected", this).val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/display_cost_codes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_group_id': hospital_group_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {

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
                            $('.delete_cost_code').on('click', function (e) {
                                e.preventDefault();
                                var cost_id = $(this).data('cost_id');
                                var parent = $(this).parent("td").parent("tr");
                                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                                $.ajax({
                                    url: '<?php echo base_url('/index.php/admin/delete_cost_code'); ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {
                                        'cost_id': cost_id,
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                                    },
                                    success: function (data) {
                                        if (data.type === 'success') {
                                            parent.fadeOut('slow', function () {
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

        $('.cost_type_btn').click(function () {
            $('#add_cost_code_type').modal('toggle');
        });

        var timer;
        $('#nhs_number').on('keyup', function (e) {
            e.preventDefault();
            var nhs_number = $('#nhs_number').val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            clearInterval(timer);
            timer = setTimeout(function (e) {
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/find_matching_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'nhs_number': nhs_number,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
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

        var timer;
        $('#add_record_form').on('keyup', '#lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_number = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            clearInterval(timer);
            timer = setTimeout(function (e) {
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/find_lab_number_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'lab_number': lab_number,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    success: function (data) {
                        if (data.type === 'error') {
                            $.sticky(data.msg, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 5000
                            });
                            _this.parents('#add_record_form').find('.check_form').hide();
                        } else {
                            $.sticky(data.msg, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 5000
                            });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            clearInterval(timer);
            timer = setTimeout(function (e) {
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/find_lab_number_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'lab_number': lab_number,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    success: function (data) {
                        if (data.type === 'error') {
                            $.sticky(data.msg, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 5000
                            });
                            _this.parents('#personal_record_form').find('#update_personal_record').hide();
                        } else {
                            $.sticky(data.msg, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 5000
                            });
                            _this.parents('#personal_record_form').find('#update_personal_record').show();
                        }
                    }
                });
            }, 1200);
        });

        $('#teach_and_mdt_cats').on('click', '#add_tech_mdt_parent', function (e) {
            e.preventDefault();
            var teach_and_mdt_cats = $('#teach_and_mdt_cats').serialize();
            $.ajax({
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
            $.ajax({
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
            }).on('dp.change', function (ev) {
                var _this = $(this);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('index.php/Admin/getMdtCategories'); ?>",
                    dataType: "json",
                    success: function (response) {
                        if (response.type === 'success') {
                            $.sticky(response.msg, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                            _this.parents('.mdt_dates_form').find('.show_mdt_categories_inputs').html(response.mdt_data);
                        } else {
                            $.sticky(response.msg, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
                            _this.parents('.mdt_dates_form').find('.show_mdt_categories_inputs').html(response.mdt_data);
                        }
                    }
                });
            });
        });

        /*****************************************
         * Delete MDT, CPC And Teach Categories.
         *****************************************/
        $('#mdt_teach_cpc_list .delete_mdt_tec_cpc').on('click', function (e) {
            e.preventDefault();
            var teachcpcid = $(this).data('mdtcpcteach');
            var parent = $(this).parent("li");
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_teach_cpc_teach'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'teachcpcid': teachcpcid,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/add_mdt_lists'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.parents('#add_mdt_list').next('.display_mdt_list_table').append(data.encode_data);
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/add_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'mdt_date': mdtid,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            $.ajax({
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
            var trash_item_id = $(this).data('trashinboxid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/msg_trashinbox_admin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'trash_id': trash_item_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            var trash_item_id = $(this).data('trashsentid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/msg_trashsent_admin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'trash_id': trash_item_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            var delete_item_id = $(this).data('deleteid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_trash_admin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'delete_id': delete_item_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            $.ajax({
                url: '<?php echo base_url('/index.php/auth/assign_users_roles'); ?>',
                type: 'POST',
                dataType: 'json',
                data: roles_form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /*Check Phone Verification*/
        $('#phone_verify').on('click', function (e) {
            e.preventDefault();
            var get_phone = $('#verify_phone').val();
            var get_url = $(this).data('setvarifypath');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: get_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    phone_no: get_phone,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: acces_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    user_token: token,
                    remember_for: remember,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
        $(document).on('click', '#resend_access_token', function (e) {
            e.preventDefault();
            var resend_access_url = $(this).data('resendaccessurl');
            $.ajax({
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('index.php/admin_tracking/tracking/change_batch_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    status: status_data,
                    batch_id: batch_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            $.ajax({
                url: '<?php echo base_url('index.php/admin/assign_clinician'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Search Clinicians on Hospital Base
        $(document).on('change', '.search-hospital-clinician', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('index.php/admin/search_clinician'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hosiptal_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.hospital_clinician').find('.hospital_clinician_result').html('');
                    } else {
                        _this.parents('.hospital_clinician').find('.hospital_clinician_result').html(data.encode_data);
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('index.php/admin/delete_clinician'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            $.ajax({
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

        //Search Clinicians on Hospital Base
        $(document).on('change', '.search-hospital-dermatological', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('index.php/admin/searchDermatologicalSurgeon'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hosiptal_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.dermatological_surgeon').find('.hospital_dermatological_result').html('');
                    } else {
                        _this.parents('.dermatological_surgeon').find('.hospital_dermatological_result').html(data.encode_data);
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Delete hospital clinican
        $(document).on('click', '.delete-hospital-dermatological', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('id');
            var parent = _this.parent("li");
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('index.php/admin/deleteDermatologicalSurgeo'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                    }
                }
            });
        });

        $("#admin_choose_hospital").change(function () {
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
            $.ajax({
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_secretary'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'delete_row_id': row_id,
                    'doctor_id': doc_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
                        //                        _this.parents('#add_micro_codes').find('.display_msg').fadeOut(2000);
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
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
        });

        $('#snomed_t1_code_table, #snomed_t2_code_table, #snomed_p_code_table, #snomed_m_code_table').DataTable({
            ordering: false,
            stateSave: true,
            lengthChange: false,
            autoWidth: true,
            "processing": true,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
        });

        $('#snomed_t1_code_table_wrapper').find('#snomed_t1_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
        $('#snomed_t2_code_table_wrapper').find('#snomed_t2_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
        $('#snomed_p_code_table_wrapper').find('#snomed_p_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
        $('#snomed_m_code_table_wrapper').find('#snomed_m_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');

        /*********************************************
         * Delete Microscopic Code.
         *******************************************/
        $('#microscopic_code_table').on('click', '.delete_micro_code', function (e) {
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
                data: {
                    'micro_code': micro_code,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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

        /*********************************************
         * Delete Snomed Code.
         *******************************************/
        $('#snomed_t1_code_table, #snomed_t2_code_table').on('click', '.delete_snomed_code', function (e) {
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
                data: {
                    'snomed_id': snomed_id,
                    'snomed_type': snomed_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_flag_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'flag_status': _flag,
                    'record_id': _recordid,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_clinic_upload_files'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'file_type': file_type,
                    'file_id': file_id,
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            clearInterval(timer);
            timer = setTimeout(function (e) {
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/set_populate_request_form'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'clinic_record_id': clinic_record_id,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    beforeSend: function () {
                        $("#ajax_loading_effect").fadeIn();
                    },
                    success: function (data) {
                        if (data.type === 'error') {
                            $("#ajax_loading_effect").fadeOut('fast');
                            $.sticky(data.msg, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
                            _this.parents('#add_record_form').find('.check_form').hide();
                            _this.parents('#add_record_form').find('.request_form_dynamic').html('');
                        } else {
                            window.setTimeout(function () {
                                _this.parents('#add_record_form').find('#check_form').show();
                                _this.parents('#add_record_form').find('.request_form_dynamic').show();
                                _this.parents('#add_record_form').find('.request_form_dynamic').append(data.encode_data);
                                $("#ajax_loading_effect").fadeOut();
                                _this.parents('#add_record_form').find('.check_form').show();
                                $.sticky(data.msg, {
                                    classList: 'success',
                                    speed: 200,
                                    autoclose: 7000
                                });
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
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/add_courier'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 2000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/display_courier_records'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.row').find('.courier_records_data').html('');
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.row').find('.courier_records_data').html(data.encode_data);
                        _this.parents('.row').find('.courier_records_data #courier_records_table').DataTable({
                            ordering: false,
                            "processing": true,
                            stateSave: true,
                            "lengthMenu": [
                                [10, 25, 50, 100, -1],
                                [10, 25, 50, 100, "All"]
                            ]
                        });
                        /***********************************************
                         * Delete Courier Records
                         *********************************************/
                        _this.parents('.row').find('.courier_records_data #courier_records_table').on('click', '.delete_courier_id', function (e) {
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
                                    data: {
                                        'courier_id': courier_id,
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                                    },
                                    success: function (data) {
                                        if (data.type === 'error') {
                                            $.sticky(data.msg, {
                                                classList: 'important',
                                                speed: 200,
                                                autoclose: 7000
                                            });
                                        } else {
                                            $.sticky(data.msg, {
                                                classList: 'success',
                                                speed: 200,
                                                autoclose: 7000
                                            });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/generate_batch_key'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('#add_batch_form').find('.batch_ref_key').html('');
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/generate_courier_list'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('#add_batch_form').find('.batch_courier_data').html('');
                        _this.parents('#add_batch_form').find('.batch_add_btn').hide();
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/display_courier_cost_code'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'courier_id': courier_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('#add_batch_form').find('.batch_courier_cost_code_price').html('');
                        _this.parents('#add_batch_form').find('.batch_add_btn').hide();
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_batch_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 2000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/display_batch_courier_records'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.row').find('.courier_batch_records_data').html('');
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.row').find('.courier_batch_records_data').html(data.encode_data);
                        //                        _this.parents('.row').find('.courier_records_data #courier_records_table');
                        _this.parents('.row').find('.courier_batch_records_data #batch_courier_records_table').DataTable({
                            ordering: false,
                            "processing": true,
                            stateSave: true,
                            "lengthMenu": [
                                [10, 25, 50, 100, -1],
                                [10, 25, 50, 100, "All"]
                            ]
                        });
                        /***********************************************
                         * Delete Courier Records
                         *********************************************/
                        _this.parents('.row').find('.courier_batch_records_data #batch_courier_records_table').on('click', '.delete_batch_courier_id', function (e) {
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
                                    data: {
                                        'batch_courier_id': batch_courier_id,
                                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                                    },
                                    success: function (data) {
                                        if (data.type === 'error') {
                                            $.sticky(data.msg, {
                                                classList: 'important',
                                                speed: 200,
                                                autoclose: 7000
                                            });
                                        } else {
                                            $.sticky(data.msg, {
                                                classList: 'success',
                                                speed: 200,
                                                autoclose: 7000
                                            });
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
        if ($('#profile_image_upload').lenght) {

            var ProfileUploader = new plupload.Uploader({
                browse_button: 'profile_image_uplaod', // this can be an id of a DOM element or the DOM element itself
                file_data_name: 'aleatha_image_uploader',
                container: 'plupload-profile-container',
                multi_selection: false,
                multipart_params: {
                    "type": "profile_photo",
                    "user_id": $("#user_id").val(),
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                url: '<?php echo base_url('index.php/admin/aleatha_image_uploader'); ?>',
                filters: {
                    mime_types: [{
                            title: 'Profile Photo',
                            extensions: "jpg,jpeg,gif,png"
                        }],
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
                    profileThumb += '<div id="thumb-' + file.id + '" class="tg-thumboption">' + '' + '</div>';
                });
                $('.tg-useruploadimg').html(profileThumb);
                $('.tg-useruploadimg-pop').html(profileThumb);
                up.refresh();
                ProfileUploader.start();
            });
            /* Run during upload */
            ProfileUploader.bind('UploadProgress', function (up, file) {});
            /* In case of error */
            ProfileUploader.bind('Error', function (up, err) {
                $.sticky(err.message, {
                    classList: 'important',
                    speed: 200,
                    autoclose: 5000
                });
            });
            /* If files are uploaded successfully */
            ProfileUploader.bind('FileUploaded', function (up, file, ajax_response) {
                var response = $.parseJSON(ajax_response.response);
                if (response.success) {
                    var spinner_html = '';
                    spinner_html = spinner_html.concat('<span><i class="fa fa-spinner fa-spin"></i></span>');
                    $("#thumb-" + file.id).html(spinner_html);
                    setTimeout(function () {
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
                    $.sticky(response.message, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 5000
                    });
                }
            });
        }

        //Delete Award Image
        $(document).on('click', '.delete_profile_pic', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-useruploadimg').html('<i class="lnr lnr-user"></i>');
            var user_initial = $('.tg-userinfo-holder').data('userinitial');
            $('.tg-userinfo-holder').find('.tg-user-img').html('<h2>' + user_initial + '</h2>');
            $('input[name=profile_image_name]').val('');
            $('input[name=profile_image_path]').val('');
        });

        //Generate Invoice Code
        $(document).on('click', '.generate_invoice_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#invoice_case_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_doctor_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });
        });

        //Search Doctor Invoice
        $(document).on('change', '#search_inv_by_doc', function (e) {
            e.preventDefault();
            var _this = $(this);
            var doctor_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_generated_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'doctor_id': doctor_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.invoice_records').find('.display_invoice_data').html('');
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.invoice_records').find('.display_invoice_data').html(data.encode_data);
                    }
                }
            });
        });

        $(document).on('click', '.generate_admin_invoice_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#admin_invoice_case_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_hospital_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });
        });

        //Search Doctor Invoice
        $(document).on('change', '#search_hos_inv', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_hospital_generated_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.invoice_records').find('.display_invoice_data').html('');
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.invoice_records').find('.display_invoice_data').html(data.encode_data);
                    }
                }
            });
        });

        //Delete Invoice
        $(document).on('click', '.delete_doc_inv', function (e) {
            e.preventDefault();
            var _this = $(this);
            var inv_id = _this.data('invid');
            var parent = _this.parent('td').parent('tr');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_admin_doctor_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'inv_id': inv_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Delete Hopsital Invoice
        $(document).on('click', '.delete_hos_inv', function (e) {
            e.preventDefault();
            var _this = $(this);
            var inv_id = _this.data('invid');
            var parent = _this.parent('td').parent('tr');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_admin_hospital_invoice'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'inv_id': inv_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', '.delete_mdt_list', function (e) {
            e.preventDefault();
            var _this = $(this);
            var list_id = _this.data('mdtlistid');
            var parent = _this.parent('td').parent('tr');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_mdt_list'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'mdt_list_id': list_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/add_lab_names'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', '.edit_lab_names_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.lab_name_modal_edit').find('.update_lab_name_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/update_lab_names'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_lab_name'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'lab_id': lab_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'error') {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/search_lab_number_mask'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'lab_id': lab_id,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    success: function (data) {
                        if (data.type === 'error') {
                            $('.hide_lab_name').hide();
                            $.sticky(data.msg, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
                        } else {
                            $('.hide_lab_name').show();
                            /*Making lab number as a mask input.*/
                            var selector = document.getElementById("lab_number");
                            var labmask = new Inputmask(data.lab_mask);
                            labmask.mask(selector);
                            $.sticky(data.msg, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                            $('#lab_number').trigger("keyup");
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function () {

        start = new Date().getTime();
        //Add Datasets Code Start
        $(document).on('click', '.save_dataset', function (e) {
            e.preventDefault();
            var _this = $(this);
            var get_dataset_name = $('input[name=dataset_name]').val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_dataset_name'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'dataset_name': get_dataset_name,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
                    window.location.reload();
                    if (data.type === 'success') {


                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', '.refresh_dataset_data', function (e) {
            e.preventDefault();
            var _this = $(this);
            var dataset_id = _this.data('datasetid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/refresh_dataset_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'dataset_id': dataset_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('#datacollase-' + dataset_id).find('.refresh_dataset_response').html(data.response_data);
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
                var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                $.ajax({
                    url: '<?php echo base_url('/index.php/admin/delete_dataset_cat'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {
                        'datasetcat_id': dataset_cat_id,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    success: function (data) {
                        if (data.type === 'success') {
                            parent.css("background-color", "#ffe6e6");
                            parent.fadeOut(1700, function () {
                                parent.remove();
                            });
                            $.sticky(data.msg, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                        } else {
                            $.sticky(data.msg, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
                        }
                    }
                });
            }
        });

        $(document).on('change', '.dataset_parent_name', function (e) {
            e.preventDefault();
            var _this = $(this);
            var dataset_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_dataset_cats'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'dataset_id': dataset_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html(data.response_data);
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html('');
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('change', '.dataset_cat_name', function (e) {
            e.preventDefault();
            var _this = $(this);
            var dataset_cat_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_dataset_cats'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'dataset_id': dataset_cat_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html(data.response_data);
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.parents('.dataset_data').find('.dataset_cat_response').html('');
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', '.refresh_question_data', function (e) {
            e.preventDefault();
            var _this = $(this);
            var dataset_cat_id = _this.data('datasetcatid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_dataset_cats_questions'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'dataset_cat_id': dataset_cat_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html(data.response_data);
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html('');
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_dataset_question_data'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'question_id': question_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.parents('.add_datasets_question_data').find('.datasets_cat_question_data').html('');
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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

        //Search Hospital Specific Users Based on hospital id.
        $(document).on('change', 'input[name="hospital_user"]', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_hospital_group_users'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                        _this.parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                        show_clinic_users();
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
                $.sticky('Please select the clinic first.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            if ($('input[name=clinic_users]').is(':checked') === false) {
                $.sticky('Please select the clinic user first.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            if ($('input[name=pathologist]').is(':checked') === false) {
                $.sticky('Please select the pathologist first.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            if ($('input[name=tracking_no]').val() === '') {
                $.sticky('Please enter the tracking no.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
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
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.specimen_tracking_form').find('.admin_book_out_to_lab_data').html('');
                    }
                }
            });
        });

        /**---------------------------------------
         * Add Specimen via AJAX
         ---------------------------------------*/
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
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
                    data: {
                        'user_status': 'view',
                        '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    complete: function (response) {
                        setTimeout(doAjaxRequest, interval);
                    }
                });
            } else {
                var url_path = window.location.href.split('://')[1].split('/');

                var record_id = url_path[5];
                if (url_path[4] === 'edit_report') {
                    var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
                    xhr.abort();
                    $.ajax({
                        url: '<?php echo base_url('/index.php/admin/save_user_view_status'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'user_status': 'view',
                            'record_id': record_id,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                        },
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
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /**---------------------------------------------------------
         * Delete Snomed Codes
         --------------------------------------------------------*/
        $(document).on('click', '.delete_snomed_code', function (e) {
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
        $(document).on('change', 'input[name=barcode_no]', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var search_type = 'ura_barcode_no';
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'barcode': barcode,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                        _this.parents('.track_search_record').find('.admin_book_in_from_clinic_data').html(response.status_data_1);
                        _this.parents('.track_search_record').find('.admin_received_from_lab_data').html(response.status_data_2);
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    } else {
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'track_no_ul': track_no_ul,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    } else {
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'track_no_lab': track_no_lab,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.encode_data);
                        _this.parents('.track_search_record').find('.tg-tagsarea').html(response.tags_data);
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    } else {
                        _this.parents('.track_search_record').find('.load-track-record-data').html('');
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Show boxes data on hover state
        $(document).on('click', '.show_clinic_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_lab_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_pathologists_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_report_urgency_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_specimen_type_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        //Close hover panel on click
        $(document).on('click', '.close_showpanel', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        });

        $("input[name='hospital_user']").click(function () {
            var _this = $(this);
            var hospital_name = $("input[name='hospital_user']:checked").data('hospitalname');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Clinic: <em>" + hospital_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(hospital_name);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-clinic').html(tag_html);
        });

        $("input[name='lab_name']").click(function () {
            var _this = $(this);
            var lab_name = $("input[name='lab_name']:checked").data('labname');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Lab: <em>" + lab_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(lab_name);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-labs').html(tag_html);
        });

        $("input[name='pathologist']").click(function () {
            var _this = $(this);
            var pathologist_name = $("input[name='pathologist']:checked").data('pathologist');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Pathologist: <em>" + pathologist_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(pathologist_name);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-pathologist').html(tag_html);
        });

        $("input[name='report_urgency']").click(function () {
            var _this = $(this);
            var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Urgency: <em>" + urgency_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(urgency_name);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-urgency').html(tag_html);
        });

        $("input[name='specimen_type']").click(function () {
            var _this = $(this);
            var specimentype_name = $("input[name='specimen_type']:checked").data('specimentype');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Specimen Type: <em>" + specimentype_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(specimentype_name);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-specimen').html(tag_html);
        });

        $(document).on('click', '.delete_track_record', function (e) {
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

        $(document).on('click', '.show_tag_clinic', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-clinic').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_tag_clinic_user', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-users').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_tag_labs', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-labs').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_tag_pathologist', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-pathologist').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_tag_urgency', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-urgency').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', '.show_tag_specimen', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-tagsarea').append('<div class="content-overlay"></div>');
            _this.parents('.tg-specimen').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });

        $(document).on('click', "input[name='tag_hospital_user']", function () {
            var _this = $(this);
            var hospital_user = $("input[name='tag_hospital_user']:checked").data('hospitalname');
            var record_id = _this.parents('.tg-clinic').data('recordid');
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            _this.parents('.tg-clinic').find('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-clinic').find('.tg-tag span em').text(hospital_user);
            //Send ajax request and update this existing record.
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/get_track_tag_hospital_user'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.tg-clinic').next('.tg-users').find('.show-data-holder').remove();
                        _this.parents('.tg-clinic').next('.tg-users').find('.tg-tag span em').text('');
                        _this.parents('.tg-clinic').next('.tg-users').append(response.tags_data);
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.parents('.tg-clinic').next('.tg-users').find('.tg-tag span em').text('');
                        _this.parents('.tg-clinic').next('.tg-users').find('.show-data-holder').remove();
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', ".tag_clinic_users", function () {
            var _this = $(this);
            var clinic_user = $("input[name='clinic_users']:checked").data('clinicuser');
            var record_id = _this.parents('.tg-users').data('recordid');
            var hospital_id = _this.data('hospitalid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            var clinic_user_id = _this.val();
            _this.parents('.tg-users').find('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-users').find('.tg-tag span em').text(clinic_user);
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'clinic_user': clinic_user_id,
                    'hospital_id': hospital_id,
                    'tag_type': 'hospital_user',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', ".tag_lab_name", function () {
            var _this = $(this);
            var labname = $("input[name='lab_name']:checked").data('labname');
            var record_id = _this.parents('.tg-labs').data('recordid');
            var lab_id = _this.val();
            _this.parents('.tg-labs').find('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-labs').find('.tg-tag span em').text(labname);
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'lab_id': lab_id,
                    'tag_type': 'lab_name',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', ".tag_pathology_users", function () {
            var _this = $(this);
            var doctor_name = $("input[name='pathologist']:checked").data('pathologist');
            var record_id = _this.parents('.tg-pathologist').data('recordid');
            var doctor_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            _this.parents('.tg-pathologist').find('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-pathologist').find('.tg-tag span em').text(doctor_name);
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'doctor_id': doctor_id,
                    'tag_type': 'pathologist',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', ".tag_urgency", function () {
            var _this = $(this);
            var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
            var record_id = _this.parents('.tg-urgency').data('recordid');
            var urgency_val = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            _this.parents('.tg-urgency').find('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-urgency').find('.tg-tag span em').text(urgency_name);
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'urgency_val': urgency_val,
                    'tag_type': 'urgency',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $(document).on('click', ".tag_specimen_type", function () {
            var _this = $(this);
            var specimen_type = $("input[name='specimen_type']:checked").data('specimentype');
            var record_id = _this.parents('.tg-specimen').data('recordid');
            var specimen_val = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            _this.parents('.tg-specimen').find('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
            _this.parents('.tg-specimen').find('.tg-tag span em').text(specimen_type);
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_track_record_tag_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'specimen_val': specimen_val,
                    'tag_type': 'specimen',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Close all tags on click data holders.
        $(document).on('click', '.tag_close_showpanel', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-tagsarea').find('.content-overlay').remove();
        });

        //Save Track Template Code
        $(document).on('click', '.save_track_template', function (e) {
            e.preventDefault();
            var _this = $(this);
            if ($('input[name=hospital_user]').is(':checked') === false ||
                    $('input[name=clinic_users]').is(':checked') === false ||
                    $('input[name=pathologist]').is(':checked') === false) {
                $.sticky('Clinic name, clinic user and pathologist must be selected.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            if ($('#track_template_input').hasClass('in')) {
                if ($('input[name=track_template_name]').val() === '') {
                    $.sticky('Please provide the template name.', {
                        classList: 'important',
                        speed: 200,
                        autoclose: 7000
                    });
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
                    success: function (response) {
                        if (response.type === 'success') {
                            _this.prev('#track_template_input').find('input').val('');
                            _this.prev('#track_template_input').collapse("hide");
                            $.sticky(response.msg, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        } else {
                            $.sticky(response.msg, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
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
                $.sticky('Please choose the track template.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            $(_this.parents('.tg-trackrecords').find('.show_clinic .hospital_user')).each(function (index) {
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
                        data: {
                            'hospital_id': hospital_id,
                            'clinic_user_id': clinic_user_id,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                        },
                        success: function (data) {
                            if (data.type === 'success') {
                                $.sticky(data.msg, {
                                    classList: 'success',
                                    speed: 200,
                                    autoclose: 7000
                                });
                                $('.tg-clinic').parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                                $('.tg-clinic').parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                                show_clinic_users();
                            } else {
                                $.sticky(data.msg, {
                                    classList: 'important',
                                    speed: 200,
                                    autoclose: 7000
                                });
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
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.record_track_data);
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.track_search_record').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_admin_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_add_record_perm'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'perm_status': perm_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /**============================================================
         * Set Doctor can change micro codes permission status in DB
         ==========================================================**/
        $("input[name='doctor_manage_codes']").click(function () {
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
                data: {
                    'perm_status': perm_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /**============================================================
         * Set permission for doctor to view other doctors record.
         ==========================================================**/
        $("input[name='view_other_doctor_records']").click(function () {
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
                data: {
                    'perm_status': perm_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });
        /**============================================================
         * Set Dermatological Surgeon and Clinican Permissions into DB
         ==========================================================**/
        $("input[name='can_view_other_records']").click(function () {
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
                data: {
                    'perm_status': perm_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_hospiatl_lab_track_perm'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'perm_status': perm_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /**=======================================================
         * Save Exclude User From Request Viewed For Hospitals
         ======================================================**/
        $("input[name='exclude_user_from_request_viewed']").click(function () {
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
                data: {
                    'perm_status': perm_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /**=======================================================
         * Save hospital user specimen seen permission
         ======================================================**/
        $(document).on('click', 'input[name="hide_specimen_data"]', function () {
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
                data: {
                    'perm_status': perm_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        $("input[name='surgeon_clinician_group']").click(function () {
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
                data: {
                    'group_status': group_status,
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        // Show clinic Users
        $(document).on('click', '.show_clinic_users_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('.tg-catagoryholder').append('<div class="content-overlay"></div>');
            _this.parents('.tg-topic').find('.show-data-holder').css({
                "opacity": "1",
                "visibility": "visible"
            });
        });
        $("input[name='clinic_users']").click(function () {
            var _this = $(this);
            _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
            var hospital_user_name = $("input[name='clinic_users']:checked").data('clinicuser');
            var tag_html = "<a class='tg-tag' href='javascript:;'><i class='lnr lnr-cross'></i><span>Users: <em>" + hospital_user_name + "</em></span></a>";
            _this.parents('.tg-topic').find('.display_selected_option').text(hospital_user_name);
            _this.parents('.show-data-holder').css({
                "opacity": "0",
                "visibility": "hidden"
            });
            _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-users').html(tag_html);
        });
        $('.ura-custom-scrollbar').mCustomScrollbar({
            axis: "y",
        });

    });



    /**===================================================
     * Record Tracking For Lab From Admin Side
     ===================================================*/
    $(document).ready(function () {
        $(".tg-cancel label").click(function () {
            $(this).parent("span").find("input").prop("checked", true);
            $(this).parent("span").find("input").trigger("click");
        });


        start = new Date().getTime();

        /**------------------------------------------------
         * Seacrh Tacking no using barcode scanner.
         -----------------------------------------------*/
        $('input[name=lab_barcode_no]').focus();
        $('input[name=lab_barcode_no]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var search_type = 'ura_barcode_no';
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'barcode': barcode,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'track_no_ul': track_no_ul,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/lab_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'track_no_lab': track_no_lab,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
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
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_laboratory_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
        $('.tg-radio').click(function () {
            $(this).parent().children('.tg-cancel').show();
        });
        $('.tg-cancel').click(function () {
            $(this).hide();
        });


        start = new Date().getTime();
        /**------------------------------------------------
         * Seacrh Tacking no using barcode scanner.
         -----------------------------------------------*/
        $('input[name=doc_barcode_no]').focus();
        $('input[name=doc_barcode_no]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            var search_type = 'ura_barcode_no';
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'barcode': barcode,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                        $('input[name=doc_barcode_no]').val('');
                        $('input[name=doc_barcode_no]').focus();
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'track_no_ul': track_no_ul,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                        $('input[name=doc_barcode_no]').val('');
                        $('input[name=doc_barcode_no]').focus();
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/doctor_search_barcode_record'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'track_no_lab': track_no_lab,
                    'search_type': search_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(data.track_data);
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html(data.btn_data);
                        $('input[name=doc_barcode_no]').val('');
                        $('input[name=doc_barcode_no]').focus();
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.tg-trackrecords').find('.find_barcode_result').html('');
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_doctor_record_history_track_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'record_id': record_id,
                    'track_status_key': status_key,
                    'barcode_no': barcode_no,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html(response.record_track_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                    }
                }
            });
        });

    });


    //Display admin records
    $(document).ready(function () {

        start = new Date().getTime();
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

        //Save Hopital TAT Date Option
        $(document).on('click', '.tat_assign_date', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.tat_assign_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_hospital_tat_dates_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Hide the costing option if tat checkbox select
        var tat_chbx = $('input[name=hos_inv_tat]');
        $('input[name=hos_inv_tat]').on('click', function () {
            if (tat_chbx.is(':checked')) {
                $('.hos_inv_form .hide_if_tat_select').hide();
                $('.hos_inv_form .show_tat_opt').show();
            } else {
                $('.hos_inv_form .hide_if_tat_select').show();
                $('.hos_inv_form .show_tat_opt').hide();
            }
        });

        //Save the hospital invoice costing option
        $(document).on('click', '.hos_inv_btn', function (e) {
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
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.hos_inv_form').find('input[name=hos_cost_code_name]').val('');
                        _this.parents('.hos_inv_form').find('input[name=hos_cost_code_name_without_tat]').val('');
                        _this.parents('.hos_inv_form').find('input[name=hos_cost_code_price]').val('');
                        _this.parents('.hos_inv_form').find('textarea[name=hos_cost_code_desc]').val('');
                        _this.parents('.hos_inv_form').find('input[name=hos_cost_code_price_1_to_6]').val('');
                        _this.parents('.hos_inv_form').find('textarea[name=hos_cost_code_desc_1_to_6]').val('');
                        _this.parents('.hos_inv_form').find('input[name=hos_cost_code_price_7_to_abv]').val('');
                        _this.parents('.hos_inv_form').find('textarea[name=hos_cost_code_desc_7_to_abv]').val('');
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Load Hospital Invoice Option Ajax Data.
        $(document).on('change', '.refresh_hos_inv_opt_data', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/load_hospital_invoice_opt_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.hospital_invoice_data').find('.load_hos_inv_opt_data').html(response.encode_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.hospital_invoice_data').find('.load_hos_inv_opt_data').html('');
                    }
                }
            });
        });

        //Make the cost code default.
        $(document).on('change', 'input[name=make_default]', function (e) {
            e.preventDefault();
            var _this = $(this);
            var make_default = _this.val();
            var tat_id = _this.data('tatid');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_code_name_default'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'make_default': make_default,
                    'tat_id': tat_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Delete Hospital Invoice Option Data
        $(document).on('click', '.delete_tat_inv_opt', function (e) {
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
                data: {
                    'tat_id': tat_id,
                    'code_name': code_name,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Update Tat Option Data
        $(document).on('click', '.update_tat_opt_data_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.update_tat_opt_data_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/update_hospital_invoice_opt_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /**==========================================
         * Doctor TAT Invoice Options Code Start
         ===========================================*/
        var doc_tat_chbx = $('input[name=doc_inv_tat]');
        $('input[name=doc_inv_tat]').on('click', function () {
            if (doc_tat_chbx.is(':checked')) {
                $('.doc_inv_form .show_invoice_opt').hide();
                $('.doc_inv_form .show_tat_opt').show();
            } else {
                $('.doc_inv_form .show_invoice_opt').show();
                $('.doc_inv_form .show_tat_opt').hide();
            }
        });

        //Save the doctor invoice costing option
        $(document).on('click', '.doc_inv_btn', function (e) {
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
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.doc_inv_form').find('input[name=hos_inv_routine_rate]').val('');
                        _this.parents('.doc_inv_form').find('input[name=hos_inv_alopecia_rate]').val('');
                        _this.parents('.doc_inv_form').find('input[name=hos_inv_imf_rate]').val('');
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Load Hospital Invoice Option Ajax Data.
        $(document).on('change', '.refresh_doc_inv_opt_data', function (e) {
            e.preventDefault();
            var _this = $(this);
            var doctor_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/load_doctor_invoice_opt_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'doctor_id': doctor_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.doctor_invoice_data').find('.load_doc_inv_opt_data').html(response.encode_data);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.doctor_invoice_data').find('.load_doc_inv_opt_data').html('');
                    }
                }
            });
        });

        //Delete Hospital Invoice Option Data
        $(document).on('click', '.delete_doc_tat_inv_opt', function (e) {
            e.preventDefault();
            var _this = $(this);
            var tat_id = _this.data('tatid');
            var parent = _this.parent('td').parent('tr');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_doctor_invoice_opt_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'tat_id': tat_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Update Tat Option Data
        $(document).on('click', '.update_tat_doc_opt_data_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.update_tat_doc_opt_data_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/update_doctor_invoice_opt_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Save doctor invoice template
        $(document).on('click', '.save_doc_inv_temp', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.doctor_invoice_temp_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_doctor_invoice_template_settings'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Find Doctor Invoice Template Data
        $(document).on('change', '.find_doctor_inv_temp', function () {
            var _this = $(this);
            var doctor_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_doctor_invoice_template_settings'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'doctor_id': doctor_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.doctor_invoice_temp_form').find('.inv_left_settings').html(response.to_section_data);
                        _this.parents('.doctor_invoice_temp_form').find('.inv_right_settings').html(response.from_section_data);
                        _this.parents('.doctor_invoice_temp_form').find('.inv_comments_settings').html(response.comment_data);
                        _this.parents('.doctor_invoice_temp_form').find('.inv_footer_settings').html(response.footer_data);
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Save doctor invoice template
        $(document).on('click', '.save_hos_inv_temp', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('.hospital_invoice_temp_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/save_hospital_invoice_template_settings'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Find Doctor Invoice Template Data
        $(document).on('change', '.find_hospital_inv_temp', function () {
            var _this = $(this);
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/search_hospital_invoice_template_settings'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.hospital_invoice_temp_form').find('.inv_left_settings').html(response.to_section_data);
                        _this.parents('.hospital_invoice_temp_form').find('.inv_right_settings').html(response.from_section_data);
                        _this.parents('.hospital_invoice_temp_form').find('.inv_comments_settings').html(response.comment_data);
                        _this.parents('.hospital_invoice_temp_form').find('.inv_footer_settings').html(response.footer_data);
                        _this.parents('.hospital_invoice_temp_form').find('input[name=invoice_to_sec_logo]').val(response.to_logo);
                        _this.parents('.hospital_invoice_temp_form').find('input[name=invoice_from_sec_logo]').val(response.from_logo);
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        /*********************************************************
         * @Upload Area Documents
         ********************************************************/
        /* initialize uploader */
        if ($('#upload_to_sec_logo').length) {
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
                    mime_types: [{
                            title: 'Upload Document',
                            extensions: "jpg,jpeg,png"
                        }],
                    max_file_size: '5mb',
                    prevent_duplicates: true
                }
            });
            InvToSecUploader.init();
            /* Run after adding file */
            InvToSecUploader.bind('FilesAdded', function (up, files) {
                var html = '';
                var profileThumb = "";
                plupload.each(files, function (file) {
                    profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
                });
                $('.profile-to-sec-img-wrap').html(profileThumb);
                up.refresh();
                InvToSecUploader.start();
            });
            InvToSecUploader.bind('Error', function (up, err) {
                $.sticky(err.message, {
                    classList: 'important',
                    speed: 200,
                    autoclose: 5000
                });
            });
            InvToSecUploader.bind('FileUploaded', function (up, file, ajax_response) {
                var response = $.parseJSON(ajax_response.response);
                if (response.success) {
                    $('.invoice_to_section_logo').text(response.file_path);
                    $('input[name=invoice_to_sec_logo]').val(response.full_path);
                } else {
                    $.sticky(response.message, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 5000
                    });
                }
            });

        }

        if ($('#upload_from_sec_logo').length) {
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
                    mime_types: [{
                            title: 'Upload Document',
                            extensions: "jpg,jpeg,png"
                        }],
                    max_file_size: '5mb',
                    prevent_duplicates: true
                }
            });
            InvFromSecUploader.init();
            /* Run after adding file */
            InvFromSecUploader.bind('FilesAdded', function (up, files) {
                var html = '';
                var profileThumb = "";
                plupload.each(files, function (file) {
                    profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
                });
                $('.profile-from-sec-img-wrap').html(profileThumb);
                up.refresh();
                InvFromSecUploader.start();
            });
            InvFromSecUploader.bind('Error', function (up, err) {
                $.sticky(err.message, {
                    classList: 'important',
                    speed: 200,
                    autoclose: 5000
                });
            });
            InvFromSecUploader.bind('FileUploaded', function (up, file, ajax_response) {
                var response = $.parseJSON(ajax_response.response);
                if (response.success) {
                    $('.invoice_from_section_logo').text(response.file_path);
                    $('input[name=invoice_from_sec_logo]').val(response.full_path);
                } else {
                    $.sticky(response.message, {
                        classList: 'important',
                        speed: 200,
                        autoclose: 5000
                    });
                }
            });
        }

        //Show TAT Settings
        $(document).on('change', '.show_tat_settings', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/display_hospital_tat_settings'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'hospital_id': hospital_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.display_tat').find('.display_tat_settings').html(response.encode_data);
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        _this.parents('.display_tat').find('.display_tat_settings').html('');
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Delete TAT Setting
        $(document).on('click', '.delete_tat_setting', function (e) {
            e.preventDefault();
            var _this = $(this);
            var tat_id = _this.data('tatid');
            var parent = _this.parent('td').parent('tr');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_hospital_tat_settings'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'tat_id': tat_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Unlock Account if locked out due to failed login attempts.
        $(document).on('click', '.unlock_account', function (e) {
            e.preventDefault();
            var _this = $(this);
            var user_email = _this.data('useremail');
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/unlock_user_account'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'user_email': user_email,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        setTimeout(function () {
                            document.location.reload();
                        }, 1500);
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Specimen Data Code
        $(document).on('click', '.save_speci_data_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('.speci_data_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/specimen_data_save'); ?>',
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Delete Specimen Data Code
        $(document).on('click', '.item_delete', function (e) {
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
                data: {
                    'item_id': item_id,
                    'item_type': item_type,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (response) {
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        parent.css("background-color", "#ffe6e6");
                        parent.fadeOut(1700, function () {
                            parent.remove();
                        });
                    } else {
                        $.sticky(response.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });
    });

    
	function load_ajax_data(flag_type) 
	{
        var url = window.location.href;
        var req_type = url.split('/').reverse()[2];
        var url_year = url.split('/').reverse()[1];
        var url_type = url.split('/').reverse()[0];
        // $.blockUI({ message: null });
        var ajax_url = "<?php echo base_url('index.php/admin/display_all_ajax_processing/'); ?>";
        var oTable = $('#admin_display_records').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
			"searching": true,
            stateSave: true,
            "language": {
                "infoFiltered": ""
            },
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "order": [],
            "ajax": {
                url: ajax_url,
                type: "POST",
                complete: function () {
                    $.unblockUI();
                },
                data: {
                    'year': url_year,
                    'type': url_type,
                    'flag_type': flag_type,
                    'req_type' : req_type				
                }
            },
            "columnDefs": [{
                    "targets": '', //first column / numbering column
                    "orderable": false, //set not orderable
                }, ],
            fnDrawCallback: function () {
                ajax_show_flags_on_hover();
                ajax_show_comment_box_hover();
                ajax_display_comment_box();
                ajax_change_flag_status();
                ajax_delete_flag_comment();
            },
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var rowClass = aData[20];
                var rowCodeClass = aData[19];
                rowClass = rowClass.replace(/<(.|\n)*?>/g, '');
                rowCodeClass = rowCodeClass.replace(/<(.|\n)*?>/g, '');
                $('td', nRow).eq(11).addClass('flag_column');
                $('td', nRow).eq(19).addClass('hide_content');
                $('td', nRow).eq(20).addClass('hide_content');
                $(nRow).addClass(rowClass);
                $('td', nRow).eq(0).addClass(rowCodeClass);
                $(nRow).addClass(rowCodeClass);
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
        });
    }
	
	

    function ajax_show_comment_box_hover() {
        $(document).on('click', '.show_comments_list', function (event) {
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
                data: {
                    'record_id': record_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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

        $(document).on('click', '#display_comment_box', function (e) {
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/set_flag_status'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'flag_status': _flag,
                    'record_id': _recordid,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/delete_flag_comments'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'flag_id': flag_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
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

        start = new Date().getTime();
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
            onStepChanging: function (event, currentIndex, newIndex) {
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
                        data: {
                            'user_identity': identity,
                            'user_password': password,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                        },
                        success: function (data) {
                            if (data.type === 'success') {
                                $.sticky(data.msg, {
                                    classList: 'success',
                                    speed: 200,
                                    autoclose: 7000
                                });

                                move = true;
                            } else {
                                $.sticky(data.msg, {
                                    classList: 'important',
                                    speed: 200,
                                    autoclose: 7000
                                });
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
                        success: function (data) {

                            if (data.type === 'success') {
                                $.sticky(data.msg, {
                                    classList: 'success',
                                    speed: 200,
                                    autoclose: 7000
                                });
                                move = true;
                            } else {
                                $.sticky(data.msg, {
                                    classList: 'important',
                                    speed: 200,
                                    autoclose: 7000
                                });

                                setTimeout(function () {
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

                return move;
            },
            onFinishing: function (event, currentIndex) {
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
                        data: {
                            'verify_auth': verify_auth,
                            'user_identity': identity,
                            'user_password': password,
                            'remember_pc': remember_pc,
                            '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                        },
                        success: function (data) {
                            if (data.type === 'success') {
                                $.sticky(data.msg, {
                                    classList: 'success',
                                    speed: 200,
                                    autoclose: 7000
                                });


                                move = true;
                            } else {
                                $.sticky(data.msg, {
                                    classList: 'important',
                                    speed: 200,
                                    autoclose: 7000
                                });
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
                        success: function (data) {
                            if (data.type === 'success') {
                                $.sticky(data.msg, {
                                    classList: 'success',
                                    speed: 200,
                                    autoclose: 7000
                                });

                                move = true;
                            } else {
                                $.sticky(data.msg, {
                                    classList: 'important',
                                    speed: 200,
                                    autoclose: 7000
                                });
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
            },
            onFinished: function (event, currentIndex) {


                $("form#wizard").submit();
            }
        });

        //LogOut All Users
        $(document).on('click', '.logout-all-users', function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/logoutAllUsers'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        });

        //Login As Admin Functionality
        $(document).on('click', '.login-as-admin', function (e) {
            e.preventDefault();
            var _this = $(this);
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            var user_id = _this.data('userid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/loginAsAdmin'); ?>',
                type: 'POST',
                global: false,
                beforeSend: function () {
                    $.sticky('Please wait we are redirecting......', {
                        classList: 'success',
                        speed: 'slow'
                    });
                    // Handle the beforeSend event
                },
                complete: function () {

                    // Handle the complete event
                },

                dataType: 'json',
                data: {
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        setTimeout(function () {
                            window.location.href = data.redirect_url;
                        }, 500);
                    }
                }
            });
        });


        //Generate Pins for users to get login

        $(document).on('click', '.generate-pin', function (e) {
            e.preventDefault();
            var _this = $(this);
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            var user_id = _this.data('userid');
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/generatepins'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        alert("Pin generated!!Please Wait.....")

                        setTimeout(function () {
                            window.location.href = data.redirect_url;
                        }, 5000);
                    }
                }
            });
        });

    });

    //Request To Check If User is Still Logged In
    $(document).ready(function () {

        start = new Date().getTime();
        $(document).idle({
            onIdle: function () {
                $.sticky('Session has timedout, Please wait while the page refresh.', {
                    classList: 'success',
                    speed: 200,
                    autoclose: 7000
                });
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            },
            onShow: function () {

            },
            idle: 7210000,
            events: 'mousemove keydown mousedown touchstart'
        });

        /*Update Hospital Clinician*/
        $(document).on('keyup', 'input[name=update_clinician]', delay(function (e) {
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
                data: {
                    'clinician_id': clinician_id,
                    'clinician_text': clinician_text,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        }, 500));

        /*Update Dermatological Surgeon*/
        $(document).on('keyup', 'input[name=update_dermatological_surgeon]', delay(function (e) {
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
                data: {
                    'dermatological_id': dermatological_id,
                    'dermatological_text': dermatological_text,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        }, 500));

        //Delete Admin User Functionality.
        $(document).on('click', '.delete_user', function (e) {
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
        $(document).on('change', '.group_lab_number_format', function (e) {
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
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ]
        });

        var receipent_suggestions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/admin/searchReceipentUsers?query=%QUERY'); ?>',
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
        }, {
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
            var previousVal = $("#recipients").val();
            //alert(previousVal);
            _this.typeahead('val', selection.username);
        });

        $(document).on('change', '.incident_hopsital_group_id', function () {
            var _this = $(this);
            var group_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/searchHospitalUsers'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'group_id': group_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-dashboardbox').find('.hospital_users_incident').html(data.users_data);
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-dashboardbox').find('.hospital_users_incident').html('');
                    }
                }
            });
        });

        $(document).on('change', '.incident_report_user_id', function () {
            var _this = $(this);
            var user_id = _this.val();
            var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
            $.ajax({
                url: '<?php echo base_url('/index.php/admin/searchIncidentReports'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {
                    'user_id': user_id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': cct
                },
                success: function (data) {
                    if (data.type === 'success') {
                        $.sticky(data.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-dashboardbox').find('.hospital_incident_reports').html(data.incident_reports);
                    } else {
                        $.sticky(data.msg, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                        _this.parents('.tg-dashboardbox').find('.hospital_incident_reports').html('');
                    }
                }
            });
        });

        /**
         *
         */
        $(document).on('click', '.surgeon_and_clinician', function () {
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


    function openAllocateModal(id, specialty) {

        $("#specialty-heading").html(specialty);
        url_base = '<?php echo site_url('/allocator/allocate_specialty_api/'); ?>'
        url = url_base + '' + id[0] + '/' + id[1];
        $.get(url, function (data) {
            var template = $("#allocate-table-row-template").html();
            $("#allocate-table").find('tbody').find('tr').remove();
            for (var index = 0; index < data.length; index++) {
                var request = data[index];
                var arr = request.date_requested.split("-")
                var dt1 = new Date(arr[2], arr[1] - 1, arr[0]);
                var dt2 = new Date();
                var diff_in_days = Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
                var day_message = '' + diff_in_days + ' days ago';
                if (diff_in_days == 0) {
                    day_message = 'Today';
                } else if (diff_in_days == 1) {
                    day_message = '1 day ago';
                }
                var tableRow = $(template).clone();
                request.tableRow = tableRow;
                tableRow.find('.row-index').html(index + 1);
                tableRow.find('.row-serial-number').html(request.serial_number);
                tableRow.find('.row-date-requested').find('.row-date-requested-date').html(request.date_requested);
                tableRow.find('.row-days-ago').html(day_message);
                tableRow.find('.row-specimen-count').html(request.specimen_count);

                var tCodeButton = tableRow.find('.row-t-codes').find('button').clone();
                tableRow.find('.row-t-codes').empty();
                request.t_codes.forEach(t_code => {
                    var tCodeClone = tCodeButton.clone();
                    if (!(t_code.t_code == null && t_code.desc == null)) {
                        if (t_code.t_code == null) {
                            tCodeClone.html(t_code.desc);
                            tCodeClone.attr('title', '');
                        } else {
                            tCodeClone.html(t_code.t_code);
                            tCodeClone.attr('title', t_code.desc);
                            tCodeClone.tooltip();
                        }
                        tableRow.find('.row-t-codes').append(tCodeClone);
                    }
                });
                tableRow.find('.row-rc-path-points').html(request.rc_path_points);
                if (request.date_found == null) {
                    tableRow.find('.row-assign-doctors').find('.assign-doctor-header').empty();
                    tableRow.find('.row-assign-doctors').find('.assign-doctor-footer').empty();
                    tableRow.find('.row-assign-doctors').find('ul').hide();
                    tableRow.find('.row-assigned').find('ul').empty();
                } else {
                    tableRow.find('.row-assign-doctors').find('p').hide();
                    tableRow.find('.row-assign-doctors').find('.assign-doctor-header').find('.date-found').html(request.date_found);
                    var doctorImage = tableRow.find('.row-assign-doctors').find('ul').find('li').clone();
                    tableRow.find('.row-assign-doctors').find('ul').empty();
                    var selectedDoctor = request.doctors[0];

                    for (let i = 0; i < request.doctors.length; i++) {
                        var doctor = request.doctors[i];
                        var doctorClone = doctorImage.clone();
                        doctorClone.find('a').attr('title', doctor.name);
                        doctorClone.find('img').attr('src', doctor.picture);
                        doctorClone.find('strike').html(doctor.points);
                        doctorClone.find('.text-green').html(doctor.points - request.rc_path_points);
                        doctorClone.find('a').tooltip();
                        if (i == 0) {
                            doctorClone.find('a').addClass('selected-doctor');
                        }

                        tableRow.find('.row-assign-doctors').find('ul').append(doctorClone);
                    }

                    updateSelectedAllocateDoctor(tableRow, selectedDoctor, request.rc_path_points);
                }
                tableRow.find('.row-rc-path-points').html(request.rc_path_points);
                $("#allocate-table").find('tbody').append(tableRow);
            }

            var requests = data;
            requests.forEach(function (request) {

            });
        });
    }

    function updateSelectedAllocateDoctor(tableRow, doctor, rc_path_points) {
        var assignDoctorPic = tableRow.find('.row-assigned').find('ul').find('li').clone();
        tableRow.find('.row-assigned').find('ul').empty();
        assignDoctorPic.find('a').attr('title', doctor.name);
        assignDoctorPic.find('img').attr('src', doctor.picture);
        assignDoctorPic.find('.text-green').html(doctor.points - rc_path_points);
        assignDoctorPic.find('a').tooltip();
        tableRow.find('.row-assigned').find('ul').append(assignDoctorPic);
    }

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    function loadasAdmin(user_id) {


        var cct = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");


        $.ajax({
            url: '<?php echo base_url('/index.php/admin/loginAsAdmin'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            beforeSend: function () {
                $.sticky('Please wait we are redirecting......', {
                    classList: 'success',
                    speed: 'slow'
                });
                // Handle the beforeSend event
            },
            complete: function () {

                // Handle the complete event
            },
            data: {
                'user_id': user_id,
                '<?php echo $this->security->get_csrf_token_name(); ?>': cct
            },
            success: function (data) {
                if (data.type === 'success') {
                    $.sticky(data.msg, {
                        classList: 'success',
                        speed: 200,
                        autoclose: 7000
                    });
                    setTimeout(function () {
                        window.location.href = data.redirect_url;
                    }, 500);
                }
            }
        });
    }

    function delay(callback, ms) {
        var timer = 0;
        return function () {
            var context = this,
                    args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }
</script>


<script type="text/javascript">
    $(function () {
        $('#time_from').datetimepicker({
            format: 'LT'
        });
        $('#time_to').datetimepicker({
            format: 'LT'
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        // $(".datetimepicker").datepic();

        var badgeVal = Number($('.count_badge').text());
        // console.log(badgeVal);
        if (badgeVal == 0) {
            $(".hide_if_no_email").addClass('hidden');
            $(".show_if_no_email").removeClass('hidden');
        }

        $('.select2_tags').select2();

        var record_suggestions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/doctor/search_record_detail_suggestion?query=%QUERY'); ?>',
                wildcard: '%QUERY',
                transform: function (record_suggestions) {
                    return $.map(record_suggestions, function (items) {
                        return {
                            record_id: items.record_id,
                            serial_number: items.serial_number,
                            first_name: items.f_name,
                            surname: items.sur_name,
                            lab: items.lab
                        };
                    });
                }
            }
        });
        $('.tg-searchrecord input.typeahead').typeahead({
                minLength: 2,
                highlight: true
            },
            {
                name: 'record_search',
                source: record_suggestions,
                display: function (item) {
                    return item.first_name + ' ' + item.surname;
                },
                limit: 300,
                templates: {
                    suggestion: function (item) {
                        return '<div><a href="<?= base_url(SEARCH_RECORD_LINK_PATH); ?>' + item.record_id + '">' + item.serial_number + ' --- ' + item.first_name + ' ' + item.surname + ' --- ' + item.lab + '</a></div>';
                    },
                    notFound: function (query) {
                        return 'No Result Found...';
                    },
                    pending: function (query) {
                        return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                    },
                }
            });
            $('.tg-searchrecord input.typeahead').on('typeahead:selected', function(evt, item) {
                window.location.href = "<?= base_url(SEARCH_RECORD_LINK_PATH); ?>" + item.record_id;
            })
    });
</script>


<script type="text/javascript">
    window.onload = function () {
        if ($("#chartContainer").length) {
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    // text: "Work Load Actvities"

                },
                exportEnabled: true,
                data: [{
                        type: "column",
                        color: "#0253cc",
                        dataPoints: [{
                                x: 10,
                                y: 171
                            },
                            {
                                x: 20,
                                y: 155
                            },
                            {
                                x: 30,
                                y: 150
                            },
                            {
                                x: 40,
                                y: 165
                            },
                            {
                                x: 50,
                                y: 195
                            },
                            {
                                x: 60,
                                y: 168
                            },
                            {
                                x: 70,
                                y: 128
                            },
                            {
                                x: 80,
                                y: 134
                            },
                            {
                                x: 90,
                                y: 114
                            }
                        ]
                    }, {
                        type: "column",
                        color: "#00c5fb",
                        dataPoints: [{
                                x: 10,
                                y: 101
                            },
                            {
                                x: 20,
                                y: 105
                            },
                            {
                                x: 30,
                                y: 100
                            },
                            {
                                x: 40,
                                y: 105
                            },
                            {
                                x: 50,
                                y: 105
                            },
                            {
                                x: 60,
                                y: 108
                            },
                            {
                                x: 70,
                                y: 108
                            },
                            {
                                x: 80,
                                y: 104
                            },
                            {
                                x: 90,
                                y: 104
                            }
                        ]
                    },
                    {
                        type: "line",
                        color: "#000000",
                        dataPoints: [{
                                x: 30,
                                y: 71
                            },
                            {
                                x: 35,
                                y: 55
                            },
                            {
                                x: 40,
                                y: 50
                            },
                            {
                                x: 45,
                                y: 65
                            },
                            {
                                x: 50,
                                y: 95
                            },
                            {
                                x: 55,
                                y: 68
                            },
                            {
                                x: 60,
                                y: 28
                            },
                            {
                                x: 65,
                                y: 34
                            },
                            {
                                x: 70,
                                y: 14
                            }
                        ]
                    },
                    {
                        type: "line",
                        color: "#55ce63",
                        dataPoints: [{
                                x: 5,
                                y: 171
                            },
                            {
                                x: 15,
                                y: 105
                            },
                            {
                                x: 25,
                                y: 90
                            },
                            {
                                x: 45,
                                y: 65
                            },
                            {
                                x: 55,
                                y: 75
                            },
                            {
                                x: 65,
                                y: 68
                            },
                            {
                                x: 75,
                                y: 28
                            },
                            {
                                x: 85,
                                y: 34
                            },
                            {
                                x: 95,
                                y: 84
                            }
                        ]
                    }
                ]
            });

            chart.render();
        }
    }
</script>
<script type="text/javascript">
    $(".process-step .btn-trans").click(function () {
        $(".process-step .btn-circle").removeClass("border_orange");
        $(".process-step svg").removeClass("orange_fill");
        $(".process-step .process_label").removeClass("bg_orange");
        $(this).parent().parent().children(".btn-circle").addClass("border_orange");
        $(this).children("svg").addClass("orange_fill");
        $(this).parent().parent().children(".process_label").addClass("bg_orange");
    });
</script>

<?php if ($this->uri->segment(2) == 'job_plan') { ?>
    <script>
        !function ($) {
            "use strict";

            var CalendarApp = function () {
                this.$body = $("body")
                this.$modal = $('#job-plan-event-modal'),
                        this.$event = ('#job-plan-external-events div.external-event'),
                        this.$calendar = $('#job-plan-calendar'),
                        this.$saveCategoryBtn = $('.save-category'),
                        this.$categoryForm = $('#add-job-plan-category form'),
                        this.$extEvents = $('#job-plan-external-events'),
                        this.$calendarObj = null
            };


            /* on drop */
            CalendarApp.prototype.onDrop = function (eventObj, date) {
                var $this = this;
                // retrieve the dropped element's stored Event Object
                var originalEventObject = eventObj.data('eventObject');
                var $categoryClass = eventObj.attr('data-class');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                if ($categoryClass)
                    copiedEventObject['className'] = [$categoryClass];
                // render the event on the calendar
                $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    eventObj.remove();
                }
            },
                    /* on click on event */
                    CalendarApp.prototype.onEventClick = function (calEvent, jsEvent, view) {
                        var $this = this;
                        var title = calEvent.title;
                        if (calEvent.extendedProps.specialty_id != null) {
                            var temp = title.split('-');
                            temp.pop();
                            title = temp.join('-');
                        }

                        $('#edit-job-plan').find('input').val('');
                        $('#edit-job-plan').find('select').val('');

                        $('#edit-job-plan-title').val(title);
                        $('#edit-job-plan-specialty').val(calEvent.extendedProps.specialty_id == null ? '' : calEvent.extendedProps.specialty_id);
                        $('#edit-job-plan-dayOfWeek').val(calEvent.extendedProps.dayOfWeek);
                        $('#edit-job-plan-color').val(calEvent.className[0]);
                        $('#edit-job-plan-from-time').val(calEvent.start.format('h:mm A'));
                        $('#edit-job-plan-to-time').val(calEvent.end.format('h:mm A'));
                        $('#edit_job_plan').modal('show');

                        $('#edit-job-plan-save-button').click(function () {
                            var data = {
                                event: $('#edit-job-plan-title').val(),
                                specialty_id: $('#edit-job-plan-specialty').val(),
                                dayOfWeek: $('#edit-job-plan-dayOfWeek').val(),
                                color: $('#edit-job-plan-color').val(),
                                from_time: $('#edit-job-plan-from-time').val(),
                                to_time: $('#edit-job-plan-to-time').val(),
                                event_id: calEvent.extendedProps.event_id,
                            }

                            $.post('<?php echo base_url() ?>auth/update_job_plan/<?php echo $this->uri->segment(3); ?>', data, function () {
                                                        location.reload();
                                                    });
                                                });

                                                $('#job-plan-delete-button').click(function () {
                                                    $.post('<?php echo base_url() ?>auth/delete_job_plan/<?php echo $this->uri->segment(3); ?>', {
                                                                                event_id: calEvent.extendedProps.event_id
                                                                            }, function () {
                                                                                location.reload();
                                                                            });
                                                                        });
                                                                    },
                                                                    /* on select */
                                                                    CalendarApp.prototype.onSelect = function (start, end, allDay) {
                                                                        // job-plan-dayOfWeek
                                                                        // add_job_plan_to_time
                                                                        var day_of_week = start.day();
                                                                        var days = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
                                                                        var starttime = start.format('hh:mm a');
                                                                        $("#add_job_plan_from_time").val(starttime);
                                                                        $("#job-plan-dayOfWeek").val(days[day_of_week]);
                                                                        $('#add_job_plan').modal('show');
                                                                    },
                                                                    CalendarApp.prototype.enableDrag = function () {
                                                                        //init events
                                                                        $(this.$event).each(function () {
                                                                            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                                                                            // it doesn't need to have a start or end
                                                                            var eventObject = {
                                                                                title: $.trim($(this).text()) // use the element's text as the event title
                                                                            };
                                                                            // store the Event Object in the DOM element so we can get to it later
                                                                            $(this).data('eventObject', eventObject);
                                                                            // make the event draggable using jQuery UI
                                                                            $(this).draggable({
                                                                                zIndex: 999,
                                                                                revert: true, // will cause the event to go back to its
                                                                                revertDuration: 0 //  original position after the drag
                                                                            });
                                                                        });
                                                                    }
                                                            /* Initializing */
                                                            CalendarApp.prototype.init = function () {
                                                                this.enableDrag();
                                                                /*  Initialize the calendar  */
                                                                var date = new Date();
                                                                var d = date.getDate();
                                                                var m = date.getMonth();
                                                                var y = date.getFullYear();
                                                                var form = '';
                                                                var today = new Date($.now());


                                                                // Fetch calendar events
                                                                var request_url = '<?php echo base_url(); ?>auth/get_user_events/<?php echo $this->uri->segment(3); ?>';
                                                                            var rawRes = $.ajax({
                                                                                type: "GET",
                                                                                url: request_url,
                                                                                async: false
                                                                            }).responseText;
                                                                            var events = JSON.parse(rawRes);

                                                                            var formated_events = [];
                                                                            events.forEach(event => {
                                                                                var title = event.event;
                                                                                if (event.specialty != null) {
                                                                                    title = title + ' - ' + event.specialty;
                                                                                }
                                                                                var curr = new Date;
                                                                                var firstday = new Date(curr.setDate(curr.getDate() - curr.getDay()));
                                                                                var lastday = new Date(curr.setDate(curr.getDate() - curr.getDay() + 6));
                                                                                var d = firstday;
                                                                                var week = [
                                                                                    'sun',
                                                                                    'mon',
                                                                                    'tue',
                                                                                    'wed',
                                                                                    'thu',
                                                                                    'fri',
                                                                                    'sat',
                                                                                ]
                                                                                var today = new Date();
                                                                                while (d.getTime() <= lastday.getTime()) {
                                                                                    if (week[d.getDay()] == event.dayOfWeek) {
                                                                                        today = d;
                                                                                        break;
                                                                                    }
                                                                                    d.setDate(d.getDate() + 1);
                                                                                }


                                                                                var today_str = '' + today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
                                                                                var from_date = moment(today_str + ' ' + event.from_time, 'YYYY/MM/DD HH:mm:ss').toDate();
                                                                                var to_date = moment(today_str + ' ' + event.to_time, 'YYYY/MM/DD HH:mm:ss').toDate();
                                                                                formated_events.push({
                                                                                    id: event.id,
                                                                                    title: title,
                                                                                    start: from_date,
                                                                                    end: to_date,
                                                                                    className: event.color,
                                                                                    extendedProps: {
                                                                                        event_id: event.id,
                                                                                        specialty_id: event.specialty_id,
                                                                                        specialty: event.specialty,
                                                                                        dayOfWeek: event.dayOfWeek
                                                                                    }
                                                                                });
                                                                            });

                                                                            var $this = this;
                                                                            $this.$calendarObj = $this.$calendar.fullCalendar({
                                                                                slotDuration: '00:30:00',
                                                                                /* If we want to split day time each 15minutes */
                                                                                minTime: '08:00:00',
                                                                                maxTime: '22:00:00',
                                                                                defaultView: 'agendaWeek',
                                                                                handleWindowResize: true,
                                                                                height: $(window).height() - 200,
                                                                                header: {
                                                                                    center: '',
                                                                                    right: 'agendaWeek,agendaDay',
                                                                                    left: ''
                                                                                },
                                                                                events: formated_events,
                                                                                editable: true,
                                                                                droppable: true, // this allows things to be dropped onto the calendar !!!
                                                                                eventLimit: true, // allow "more" link when too many events
                                                                                selectable: true,
                                                                                drop: function (date) {
                                                                                    $this.onDrop($(this), date);
                                                                                },
                                                                                select: function (start, end, allDay) {
                                                                                    $this.onSelect(start, end, allDay);
                                                                                },
                                                                                eventClick: function (calEvent, jsEvent, view) {
                                                                                    $this.onEventClick(calEvent, jsEvent, view);
                                                                                },
                                                                                eventDrop: function (calEvent, dayDelta, minuteDelta, allDay, revertFunc) {
                                                                                    var title = calEvent.title;
                                                                                    if (calEvent.extendedProps.specialty_id != null) {
                                                                                        var temp = title.split('-');
                                                                                        temp.pop();
                                                                                        title = temp.join('-');
                                                                                    }

                                                                                    var data = {
                                                                                        event: title,
                                                                                        specialty_id: calEvent.extendedProps.specialty_id == null ? '' : calEvent.extendedProps.specialty_id,
                                                                                        dayOfWeek: calEvent.start.format("ddd").toLowerCase(),
                                                                                        color: calEvent.className[0],
                                                                                        from_time: calEvent.start.format('h:mm A'),
                                                                                        to_time: calEvent.end.format('h:mm A'),
                                                                                        event_id: calEvent.extendedProps.event_id,
                                                                                    }

                                                                                    $.post('<?php echo base_url() ?>auth/update_job_plan/<?php echo $this->uri->segment(3); ?>', data, function () {

                                                                                                        });
                                                                                                    }

                                                                                                });

                                                                                                //on new event
                                                                                                this.$saveCategoryBtn.on('click', function () {
                                                                                                    var categoryName = $this.$categoryForm.find("input[name='category-name']").val();
                                                                                                    var categoryColor = $this.$categoryForm.find("select[name='category-color']").val();
                                                                                                    if (categoryName !== null && categoryName.length != 0) {
                                                                                                        $this.$extEvents.append('<div class="external-event bg-' + categoryColor + '" data-class="bg-' + categoryColor + '" style="position: relative;"><i class="mdi mdi-checkbox-blank-circle m-r-10 vertical-middle"></i>' + categoryName + '</div>')
                                                                                                        $this.enableDrag();
                                                                                                    }

                                                                                                });
                                                                                            },
                                                                                                    //init CalendarApp
                                                                                                    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
                                                                                        }(window.jQuery),
                                                                                                function ($) {
                                                                                                    "use strict";
                                                                                                    $.CalendarApp.init()
                                                                                                    if (typeof job_plan_modal_open !== 'undefined') {
                                                                                                        $("#add_job_plan").modal('show');
                                                                                                    }
                                                                                                }(window.jQuery);
    </script>

<?php } ?>

<?php if ($this->uri->segment(1) == 'auth' && $this->uri->segment(2) == 'edit_user') : ?>
    <script>
        $(document).ready(function () {
            $(".remove-secretary").click(function () {
                var user_id = <?php echo $this->uri->segment(3); ?>;
                var sec_id = $(this).val();
                var parent = $(this).parents(".list-group-item");
                var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
                var dataJson = {
                    [csrfName]: csrfHash,
                    'user_id': user_id,
                    'sec_id': sec_id
                };
                $.ajax({
                    url: "<?php echo base_url('auth/unassign_secretary'); ?>",
                    type: 'post',
                    data: dataJson,
                    success: function (data) {
                        if (data.status == 'success') {
                            parent.hide();
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            $("#add-secretary-id").click(function () {
                $.get("<?php echo base_url('auth/get_avaialable_secretary/' . $this->uri->segment(3)) ?>", function (data) {

                    $("#available-secretary-list").find("li").remove();
                    if (data.status == 'success') {
                        $("#no_secretary").hide();
                        var li_template = $("#secretary-list-template").html();
                        if (data.secretaries.length == 0) {
                            $("#available-secretary-list").hide();
                            $("#no-secretary").show();
                            $(".assign-secretary-btn").hide();
                        } else {
                            $(".assign-secretary-btn").show();
                            $("#available-secretary-list").show();
                            $("#no-secretary").hide();
                            data.secretaries.forEach(function (sec) {
                                var li = $(li_template).clone();
                                li.find("img").attr('src', base_url + sec.profile_picture);
                                li.find(".working_for").html("Working for " + sec.working_for + " doctors");
                                li.find(".secretary_name").html(sec.first_name + " " + sec.last_name);
                                li.find("input").attr("id", "check" + sec.id);
                                li.find("label").attr("for", "check" + sec.id);
                                li.find(".add-secretary-check-button").val(sec.id);
                                $("#available-secretary-list").append(li);
                            });
                        }
                    } else {
                        $("#available-secretary-list").hide();
                        $("#no-secretary").show();
                        $(".assign-secretary-btn").hide();
                    }
                    $("#add-secretary-modal").modal('show');
                });
            });

            $(".assign-secretary-btn").click(function () {
                var all_btns = [];
                $(".add-secretary-check-button:checked").each(function () {
                    all_btns.push($(this).val());
                });
                if (all_btns.length > 0) {
                    var user_id = <?php echo $this->uri->segment(3); ?>;
                    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
                            csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
                    var dataJson = {
                        [csrfName]: csrfHash,
                        'user_id': user_id,
                        'sec_ids': all_btns
                    };
                    $.ajax({
                        url: "<?php echo base_url('auth/assign_secretary'); ?>",
                        type: 'post',
                        data: dataJson,
                        success: function (data) {
                            location.reload();
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                }
            });
        });
    </script>
<?php endif; ?>

<?php if ($this->uri->segment(1) == 'allocator' && $this->uri->segment(2) == 'allocator') : ?>

    <script>
        function get_day_of_week() {
            var week_days = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
            //TODO: change date to today
            // var today = new Date('2020-08-05').getDay();
            var today = new Date().getDay();
            var day_week = week_days[today];
            return day_week;
        }
        $(document).ready(function () {

            if (typeof allocator_tab !== 'undefined') {
                switch (allocator_tab) {
                    case 'all':
                        $('#all').tab('show');
                        $("#allocator-tab-switch-all").addClass('active');
                        break;
                    case 'speciality':
                        $("#allocator-tab-switch-speciality").addClass('active');
                        $('#speciality').tab('show');
                        break;
                    case 'pathologist':
                        $("#allocator-tab-switch-pathologist").addClass('active');
                        $('#pathologist').tab('show');
                        break;
                    default:

                        $('#all').tab('show');
                }
            }

            $('.specialty-row').hide();
            var specialty = $("#specialty_report_list").val();
            $('.specialty-row[data-value="' + specialty + '"]').show();
            $("#specialty_report_list").change(function (event) {
                $('.specialty-row').hide();
                var specialty = $(this).val();
                $('.specialty-row[data-value="' + specialty + '"]').show();
                $('[data-toggle="tooltip"]').tooltip();
            });

            $('.doctor-row').hide();
            var curr_doctor = $("#doctor_report_list").val();
            $('.doctor-row[data-value="' + curr_doctor + '"]').show();
            $('#doctor_report_list').change(function (event) {
                $('.doctor-row').hide();
                var doctor = $(this).val();
                $('.doctor-row[data-value="' + doctor + '"]').show();
                $('[data-toggle="tooltip"]').tooltip();
            });

            $(".allocator-percent-alloc").click(function (event) {
                $("#allocatorPercentModal").modal('show');
                var id_split = event.target.id.split('-');
                var specialty_id = parseInt(id_split[3]);
                var doctor_id = parseInt(id_split[4]);
                var day_week = get_day_of_week();
                var unalloc = allocator_data[specialty_id][0][day_week]['rcpath'];
                $("#allocator-unallocated").val(unalloc);
                $(".allocator-percent-doctor-container").remove();

                var allocator_percent_template = $("#allocator-percent-doctor-template").html();
                var docs = allocator_data[specialty_id];
                var docs_percent_rel = {};
                for (var doc in docs) {
                    if (docs.hasOwnProperty(doc)) {
                        if (doc == 0) {
                            continue;
                        }
                        var container = $(allocator_percent_template).clone();
                        if (docs[doc][day_week].length == 0) {
                            continue;
                        }
                        var doc_data = docs[doc][day_week][0];
                        container.find("label").html(allocator_doctors[doc] + " (" + doc_data['remaining'] + ")");
                        var percent = doc_data['percent_alloc'];
                        percent = percent * 100;
                        percent = Math.round(percent);
                        container.find(".allocator-percent-doctor").val(percent);
                        docs_percent_rel[doc] = container.find(".allocator-percent-doctor");
                        $("#allocatorPercentModal").find(".modal-body").append(container);
                    }
                }

                // Cache the specialty data in an object
                var doc_spec_data = {};
                for (var doc in allocator_data[specialty_id]) {
                    if (allocator_data[specialty_id].hasOwnProperty(doc)) {
                        if (doc == 0) {
                            continue;
                        }
                        doc_spec_data[doc] = Object.assign({}, Object.keys(allocator_data[specialty_id][doc][day_week]).length == 0 ? {} : allocator_data[specialty_id][doc][day_week][0]);
                    }
                }

                Object.keys(docs_percent_rel).forEach(function (doc) {
                    docs_percent_rel[doc].change(function (event) {
                        if (Object.keys(docs_percent_rel).length != 1) {
                            // Original Value
                            var orig_val = Math.round(doc_spec_data[doc]['percent_alloc'] * 100);
                            var new_val = event.target.value;
                            if (new_val < 100 || new_val > 0) {
                                var change = new_val - orig_val;
                                if (change > 0) {
                                    var found = true;
                                    // If the change increases the value then find lowest remaing point
                                    while (change > 0 && found) {
                                        var lowest_doc = 0;
                                        var loweest_point = Number.MAX_SAFE_INTEGER;
                                        for (var d in doc_spec_data) {
                                            if (doc_spec_data.hasOwnProperty(d)) {
                                                if (d == doc || Math.round(doc_spec_data[d]['percent_alloc'] * 100) <= 0) {
                                                    continue;
                                                }
                                                if (doc_spec_data[d]['remaining'] <= loweest_point) {
                                                    loweest_point = doc_spec_data[d]['remaining'];
                                                    lowest_doc = d;
                                                }
                                            }
                                        }
                                        if (lowest_doc == 0) {
                                            found = false;
                                        } else {
                                            var percent = Math.round(doc_spec_data[lowest_doc]['percent_alloc'] * 100);
                                            if (percent < change) {
                                                percent = 0;
                                                change = change - percent;
                                            } else {
                                                percent = percent - change;
                                                change = 0;
                                            }
                                            doc_spec_data[lowest_doc]['percent_alloc'] = percent / 100;
                                            docs_percent_rel[lowest_doc].val(percent);
                                            doc_spec_data[doc]['percent_alloc'] = new_val / 100;
                                        }
                                    }
                                } else if (change < 0) {
                                    // If the change decreases find the doc with lowest remaing point
                                    change = change * -1;

                                    var highest_doc = 0;
                                    var highest_point = Number.MIN_SAFE_INTEGER;
                                    for (var d in doc_spec_data) {
                                        if (doc_spec_data.hasOwnProperty(d)) {
                                            if (d == doc || Math.round(doc_spec_data[d]['percent_alloc'] * 100) <= 0) {
                                                continue;
                                            }
                                            if (doc_spec_data[d]['remaining'] >= highest_point) {
                                                highest_point = doc_spec_data[d]['remaining'];
                                                highest_doc = d;
                                            }
                                        }
                                    }

                                    var percent = Math.round(doc_spec_data[highest_doc]['percent_alloc'] * 100);
                                    percent = percent + change;
                                    doc_spec_data[highest_doc]['percent_alloc'] = percent / 100;
                                    docs_percent_rel[highest_doc].val(percent);
                                    doc_spec_data[doc]['percent_alloc'] = new_val / 100;
                                }
                            } else {
                                if (new_val < 0) {
                                    docs_percent_rel[doc].val(0);
                                } else if (new_val > 100) {
                                    docs_percent_rel[doc].val(100);
                                }
                            }

                        }
                    });
                });
                $("#allocator-percent-modal-save").off();
                $("#allocator-percent-modal-save").click(function (event) {
                    Object.keys(doc_spec_data).forEach(function (doc) {
                        allocator_data[specialty_id][doc][day_week][0]['percent_alloc'] = doc_spec_data[doc]['percent_alloc'];
                        $("#allocator-percent-alloc-" + specialty_id + "-" + doc).html(Math.round((allocator_data[specialty_id][doc][day_week][0]['percent_alloc'] * 100)) + "%");
                    });
                    $("#allocatorPercentModal").modal('hide');
                });
                $("#allocatorPercentModalHeading").html(allocator_specialties[specialty_id]);
            });

            $("#allocate-confirm-button").click(function (event) {
                var specialty = $("#specialty_report_list").val();
                var specialty_id = -1;
                for (var spec_id in allocator_specialties) {
                    if (allocator_specialties.hasOwnProperty(spec_id)) {
                        if (allocator_specialties[spec_id] == specialty) {
                            specialty_id = spec_id;
                        }
                    }
                }
                if (specialty_id == -1) {
                    console.log("No spec found");
                    return;
                }
                var day_week = get_day_of_week();
                // Cache the specialty data in an object
                var doc_spec_data = {};
                for (var doc in allocator_data[specialty_id]) {
                    if (allocator_data[specialty_id].hasOwnProperty(doc)) {
                        if (doc == 0) {
                            continue;
                        }
                        doc_spec_data[doc] = Object.assign({}, Object.keys(allocator_data[specialty_id][doc][day_week]).length == 0 ? {} : allocator_data[specialty_id][doc][day_week][0]);
                    }
                }
                // console.log(doc_spec_data);
                $.post('<?php echo (base_url()); ?>allocator/allocate_specialty_requests', {
                    specialty_id: specialty_id,
                    data: doc_spec_data,
                    hospital_id: allocator_hospital_id
                }).done(function (res) {

                    var url = window.location;
                    var urlObject = new URL(url);

                    urlObject.searchParams.delete('tab');
                    urlObject.searchParams.delete('specialty');
                    urlObject.searchParams.append('tab', 'speciality');
                    urlObject.searchParams.append('specialty', res.specialty);
                    window.location.href = urlObject.href;
                }).fail(function (error) {
                    alert("Error: Try again Later.");
                    console.log(error);
                });
            });


        });

        function goBackWeek() {
            var url = window.location;
            var urlObject = new URL(url);
            if (urlObject.searchParams.has('week')) {
                var week = urlObject.searchParams.get('week');
                urlObject.searchParams.delete('week');
                if (!isNaN(week)) {
                    week = parseInt(week);
                    urlObject.searchParams.append('week', week + 1);
                } else {
                    urlObject.searchParams.append('week', 1);
                }

            } else {
                urlObject.searchParams.append('week', 1);
            }
            window.location.href = urlObject.href;
        }

        function goForwardWeek() {
            var url = window.location;
            var urlObject = new URL(url);
            if (urlObject.searchParams.has('week')) {
                var week = urlObject.searchParams.get('week');
                urlObject.searchParams.delete('week');
                if (!isNaN(week)) {
                    week = parseInt(week);
                    urlObject.searchParams.append('week', week - 1);
                } else {
                    week = 0;
                    urlObject.searchParams.append('week', 0);
                }
            } else {
                urlObject.searchParams.append('week', 0);
            }
            window.location.href = urlObject.href;
        }

        function goToWeek(selectedObj) {
            var url = window.location;
            var urlObject = new URL(url);
            urlObject.searchParams.delete('week');
            urlObject.searchParams.append('week', selectedObj.value);
            window.location.href = urlObject.href;
        }
    </script>

<?php endif; ?>
<script>
    $(document).ready(function () {
        $("#sidebar-menu").find("a").click(function (event) {
            var loc = $(this).attr('href');
            if (loc != '#') {
                window.location.href = loc;
            }
        });
    });

    var touchtime = 0;
    $(".input_cell").on("click", function () {
        if (touchtime == 0) {
            // set first click
            touchtime = new Date().getTime();
        } else {
            // compare first click to this click and see if they occurred within double click threshold
            if (((new Date().getTime()) - touchtime) < 800) {
                // double click occurred
                $(this).children().removeClass("hidden");
                touchtime = 0;
            } else {
                // not a double click so set as a new first click
                touchtime = new Date().getTime();
            }
        }
    });
</script>

<?php if ($this->uri->segment(1) == 'menu') { ?>
    <script>
        $("#menu-edit-button").on('click', function () {
            $.post(_base_url + "menu/confirmEdit", {}, function (data) {
                window.location.href = data.url;
            });
        })
    </script>
<?php } ?>


<?php if ($this->uri->segment(2) == 'breast_cancer_dataset') { ?>

    <script>

        $("input[name='specimen_sides']").click(function () {
            $('#1st_spec1').html('- Surgical Specimen');
            show_answer('slide1', $("input[name='specimen_sides']:checked").val(), 'slide_02', 'Slide');
        });
        $("input[name='specimen_type_select']").click(function () {
            show_answer('slide2', $("input[name='specimen_type_select']:checked").val(), 'slide_03', 'Specimen Type');
        });
        $("input[name='specimen_radio_seen']").click(function () {
            show_answer('slide3', $("input[name='specimen_radio_seen']:checked").val(), 'slide_04', 'Specimen Radiograph Seen');
        });
        $("input[name='memo_absormality']").click(function () {
            show_answer('slide4', $("input[name='memo_absormality']:checked").val(), 'slide_05', 'Mammographic Abnormality');
        });
        $("input[name='core_biopsy_seen']").click(function () {
            show_answer('slide5', $("input[name='core_biopsy_seen']:checked").val(), 'slide_06', 'Site of Previous Core Biopsy Seen');
        });
        $("input[name='histological_calcification']").click(function () {
            show_answer('slide6', $("input[name='histological_calcification']:checked").val(), 'slide_07', 'Histological Calcification');
        });
        $("input[name='Benign_lesions']").click(function () {
            $('#1st_spec2').html('- Benign lesions');
            show_answer('slide7', $("input[name='Benign_lesions']:checked").val(), 'slide_08', 'Benign lesions');
        });
        $("input[name='Epithelial_proliferation']").click(function () {
            $('#1st_spec3').html('- Epithelial Proliferation');
            show_answer('slide8', $("input[name='Epithelial_proliferation']:checked").val(), 'slide_09', 'Epithelial Proliferation');
        });
        $("input[name='Invasive_carcinoma']").click(function () {
            $('#1st_spec4').html('- Malignant lesions');
            show_answer('slide9', $("input[name='Invasive_carcinoma']:checked").val(), 'slide_11', 'Invasive carcinoma');
        });
        $("input[name='Size_and_extent']").click(function () {
            show_answer('slide11', $("input[name='Size_and_extent']:checked").val(), 'slide_12', 'Size and extent');
        });
        $("input[name='Invasive_tumour_type']").click(function () {
            show_answer('slide12', $("input[name='Invasive_tumour_type']:checked").val(), 'slide_13', 'Invasive tumour type');
        });
        $("input[name='Histological_grade']").click(function () {
            show_answer('slide13', $("input[name='Histological_grade']:checked").val(), 'slide_14', 'Histological grade');
        });
        $("input[name='Lymphovascular_invasion']").click(function () {
            show_answer('slide14', $("input[name='Lymphovascular_invasion']:checked").val(), 'slide_15', 'Lymphovascular invasion');
        });
        $("input[name='Residual_tumour_size_and_extent']").click(function () {
            $('#1st_spec5').html('- Modifications for post neoadjuvant therapy cases');
            show_answer('slide15', $("input[name='Residual_tumour_size_and_extent']:checked").val(), 'slide_16', 'Residual tumour size and extent');
        });
        $("input[name='Residual_invasive_tumour_type']").click(function () {
            show_answer('slide16', $("input[name='Residual_invasive_tumour_type']:checked").val(), 'slide_17', 'Residual invasive tumour type');
        });
        $("input[name='Residual_tumour_histological_grade']").click(function () {
            show_answer('slide17', $("input[name='Residual_tumour_histological_grade']:checked").val(), '', 'Residual tumour histological grade');
        });
        $(".circle_carousel").click(function () {
            $(".circle_carousel").removeClass("active");
            $(this).addClass("active");
        });




        function show_answer(slide, slide_ans, slide_id, slide_question) {
            $('.' + slide + '_stat').show();
            $('.' + slide + '_ans').html("<div class='sidebar_subtitle'>" + slide_question + " : <span>" + slide_ans + "</span></div>");
            window.location = $('#' + slide_id).attr('href');
        }
        function changeTitle() {
            $('#dataset_title_view').html($('#dataset_title').val());
        }
        var scroll = $.cookie('scroll');
        if (scroll) {
            scrollToID(scroll, 1000);
            $.removeCookie('scroll');
        }
        $(".circle_carousel").click(function () {
            $(".circle_carousel").removeClass("active");
            $(this).addClass("active");
        });
        $(".next_2").click(function () {
            $(".radio_links.list-inline.step1").addClass("hidden");
            $(".radio_links.list-inline.step2").removeClass("hidden");
        });
        $(".next_3").click(function () {
            $(".radio_links.list-inline.step2").addClass("hidden");
            $(".radio_links.list-inline.step3").removeClass("hidden");
        });
        $(".next_4").click(function () {
            $(".radio_links.list-inline.step3").addClass("hidden");
            $(".radio_links.list-inline.step4").removeClass("hidden");
        });
        $(".next_5").click(function () {
            $(".radio_links.list-inline.step4").addClass("hidden");
            $(".radio_links.list-inline.step5").removeClass("hidden");
        });
        $(".back_1").click(function () {
            $(".radio_links.list-inline.step2").addClass("hidden");
            $(".radio_links.list-inline.step1").removeClass("hidden");
        });
        $(".back_2").click(function () {
            $(".radio_links.list-inline.step3").addClass("hidden");
            $(".radio_links.list-inline.step2").removeClass("hidden");
        });
        $(".back_3").click(function () {
            $(".radio_links.list-inline.step4").addClass("hidden");
            $(".radio_links.list-inline.step3").removeClass("hidden");
        });
        $(".back_4").click(function () {
            $(".radio_links.list-inline.step5").addClass("hidden");
            $(".radio_links.list-inline.step4").removeClass("hidden");
        });
        // $('.radio-toolbar input[type="radio"]').click(function(){
        //     cons list = $(".radio-toolbar input[type='radio']:checked").val();
        //     console.log($list);

        // });

        $("#breast_cancer_submit").click(function () {
            $("#breast_cancer_response_html").val($("#breast_cancer_answers").html());
            $("#breast_cancer_form").submit();
            return false;
        });



        jQuery(function () {
            // remove the below comment in case you need chnage on document ready
            // location.href=jQuery("#selectbox").val(); 
            jQuery("#dataset_title").change(function () {
                if (jQuery("#dataset_title").val() == 'Breast Cancer') {
                    location.href = '<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)) ?>';
                } else {
                    location.href = '<?php echo site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)) ?>';
                }
            })
        })




        jQuery(function () {
            // remove the below comment in case you need chnage on document ready
            // location.href=jQuery("#selectbox").val(); 
            jQuery(".patient_specimen").click(function () {
                var sq = $("input[type='radio'][name='patient_specimen']:checked").val();
                //           alert(sq);
                location.href = '<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9) . '/' . $this->uri->segment(10) . '/' . $this->uri->segment(11) . '/' . $this->uri->segment(12) . '/') ?>' + sq;

            });
        });


    </script>

<?php } ?>
<?php if ($this->uri->segment(2) == 'basal_cell_dataset') { ?>

    <script>

        jQuery(function () {
            // remove the below comment in case you need chnage on document ready
            // location.href=jQuery("#selectbox").val(); 
            jQuery("#dataset_title").change(function () {
                if (jQuery("#dataset_title").val() == 'Breast Cancer') {
                    location.href = '<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)) ?>';
                } else {
                    location.href = '<?php echo site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)) ?>';
                }
            });


            $('#dataset_title').select2();
        });

        jQuery(function () {
            // remove the below comment in case you need chnage on document ready
            // location.href=jQuery("#selectbox").val(); 
            jQuery(".patient_specimen").click(function () {
                var sq = $("input[type='radio'][name='patient_specimen']:checked").val();
                //           alert(sq);
                location.href = '<?php echo site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9) . '/' . $this->uri->segment(10) . '/' . $this->uri->segment(11) . '/' . $this->uri->segment(12) . '/') ?>' + sq;

            });
        });


        $("input[name='Specimen_type']").click(function () {
            $('#1st_spec1').html('- Specimen type');
            var Specimen_type = $("input[name='Specimen_type']:checked").val();
            if (Specimen_type == 'Not stated') {
                show_answer('slide1', Specimen_type, 'slide_007', 'Specimen type');
            }
            if (Specimen_type == 'Incision') {
                show_answer('slide2', $("input[name='Incision']:checked").val(), 'slide_007', 'Incision');
            }
            if (Specimen_type == 'Excision') {
                show_answer('slide1', Specimen_type, 'slide_03', 'Excision');
            }
            if (Specimen_type == 'Punch') {
                show_answer('slide1', Specimen_type, 'slide_04', 'Punch');
            }
            if (Specimen_type == 'Curettings') {
                show_answer('slide1', Specimen_type, 'slide_05', 'Curettings');
            }
            if (Specimen_type == 'Shave') {
                show_answer('slide1', Specimen_type, 'slide_06', 'Shave');
            }
            if (Specimen_type == 'Other') {
                show_answer('slide1', Specimen_type, 'slide_006', 'Other');
            }
        });

        $("#clinicalsite_btn").click(function () {
            show_answer('slide012', $("input[name='clinicalsite']").val(), 'slide_1202', 'Clinical Site');
        });
        $("#clinicaldimention_btn").click(function () {
            show_answer('slide022', $("input[name='clinicaldimention']").val(), 'slide_01', 'Clinical Dimention');
        });
        $("#CDOther_btn").click(function () {
            show_answer('slide006', $("input[name='CDOther']").val(), 'slide_07', 'Specify Other');
        });
        $("#specimendimention_btn").click(function () {
            $('#1st_spec2').html('- Macroscopic Description');
            show_answer('slide007', 'Legnth: ' + $("input[name='specimendimention1']").val() + ' Breadth: ' + $("input[name='specimendimention2']").val() + ' Depth: ' + $("input[name='specimendimention3']").val() + ' Lenght ' + $("input[name='MDMacroscopic_description']").val() + ' (mm) and ' + $("input[name='Macroscopic']:checked").val(), 'slide_08', 'Dimension of specimen');
        });


        $("input[name='Incision']").click(function () {
            show_answer('slide2', $("input[name='Incision']:checked").val(), 'slide_007', 'Incision');
        });
        $("input[name='Excision']").click(function () {
            show_answer('slide3', $("input[name='Excision']:checked").val(), 'slide_007', 'Excision');
        });
        $("input[name='Punch']").click(function () {
            show_answer('slide4', $("input[name='Punch']:checked").val(), 'slide_007', 'Punch');
        });
        $("input[name='Curettings']").click(function () {
            show_answer('slide5', $("input[name='Curettings']:checked").val(), 'slide_007', 'Curettings');
        });
        $("input[name='Shave']").click(function () {
            show_answer('slide6', $("input[name='Shave']:checked").val(), 'slide_007', 'Shave');
        });
        $("input[name='Histological_low']").click(function () {
            $('#1st_spec3').html('- Histological data');
            var low_type = $("input[name='Histological_low']:checked").val();
            if (low_type == 'Superficial') {
                show_answer('slide8', $("input[name='Histological_low']:checked").val(), 'slide_17', 'Low Risk');
            } else {
                show_answer('slide8', $("input[name='Histological_low']:checked").val(), 'slide_11', 'Histological data');
            }
        });
        $("input[name='Histological_high']").click(function () {
            show_answer('slide8', $("input[name='Histological_high']:checked").val(), 'slide_11', 'High Risk');
        });

        $("input[name='n_Histological_Present']").click(function () {
            $('#1st_spec3').html('- Histological data');
            var deepIn = $("input[name='n_Histological_Present']:checked").val();
            if (deepIn == 'Not Identified') {
                show_answer('slide11', $("input[name='n_Histological_Present']:checked").val(), 'slide_17', 'Deep invasion');
            } else {
                show_answer('slide11', $("input[name='n_Histological_Present']:checked").val(), 'slide_12', 'Deep invasion');
            }
        });
        $("input[name='n_Histological_thickness_Present']").click(function () {
            var thickness = $("input[name='n_Histological_thickness_Present']:checked").val();
            if (thickness == 'Not Identified') {
                show_answer('slide12', thickness, 'slide_17', 'For pure superficial basal cell carcinoma, invasive entries can be omitted');
            } else {
                show_answer('slide12', thickness, 'slide_0012', 'For pure superficial basal cell carcinoma, invasive entries can be omitted');
            }
        });
        $("input[name='n_Histological_fat_Present']").click(function () {
            var fat = $("input[name='n_Histological_fat_Present']:checked").val();
            if (fat == 'Not Identified') {
                show_answer('slide0012', fat, 'slide_17', 'Level of invasion beyond subcutaneous fat');
            } else {
                show_answer('slide0012', fat, 'slide_1112', 'Level of invasion beyond subcutaneous fat');
            }
        });
        $("input[name='n_Histological_Specify_tissue']").click(function () {
            var bone = $("input[name='n_Histological_Specify_tissue']:checked").val();
            if (bone == 'Bone') {
                show_answer('slide1112', bone, 'slide_2212', 'Specify tissue');
            } else {
                show_answer('slide1112', bone, 'slide_17', 'Specify tissue');
            }
        });
        $("input[name='n_invasion']").click(function () {
            var invasion = $("input[name='n_invasion']:checked").val();
            if (invasion != 'Present') {
                show_answer('slide17', invasion, 'slide_18', 'Perineural invasion');
            } else {
                show_answer('slide17', invasion, 'slide_0017', 'Perineural invasion');
            }
        });
        $("input[name='n_invasion_present']").click(function () {
            var invasion_p = $("input[name='n_invasion_present']:checked").val();
            if (invasion_p == 'No') {
                show_answer('slide0017', invasion_p, 'slide_18', 'If present: Meets criteria to upstage pT1/pT2 to pT3?');
            } else {
                show_answer('slide0017', invasion_p, 'slide_1117', 'If present: Meets criteria to upstage pT1/pT2 to pT3?');
            }
        });
        $("input[name='n_invasion_yes_m']").click(function () {
            var invasion_p_m = $("input[name='n_invasion_yes_m']:checked").val();
            show_answer('slide1117', invasion_p_m, 'slide_18', 'Named nerve');

        });

        $("input[name='n_bone_minor']").click(function () {
            show_answer('slide2212', $("input[name='n_bone_minor']:checked").val(), 'slide_3312', 'Minor bone erosion');
        });
        $("input[name='n_bone_gross']").click(function () {
            show_answer('slide3312', $("input[name='n_bone_gross']:checked").val(), 'slide_4412', 'Gross cortical/marrow invasion');
        });
        $("input[name='n_bone_foraminal']").click(function () {
            show_answer('slide4412', $("input[name='n_bone_foraminal']:checked").val(), 'slide_17', 'xial/skull base/foraminal invasion');
        });

        $("#his_btn").click(function () {
            show_answer('slide12', $("input[name='n_Histological_thickness_Present']").val(), 'slide_17', 'For pure superficial basal cell carcinoma, invasive entries can be omitted');
        });
        $("#inva_btn").click(function () {
            show_answer('slide17', $("input[name='n_invasion_present']").val(), 'slide_18', 'If present: Meets criteria to upstage pT1/pT2 to pT3?**');
        });
        $("input[name='n_carcinoma']").click(function () {
            show_answer('slide18', $("input[name='n_carcinoma']:checked").val(), 'slide_018', 'Indicate which used:');
        });
        $("input[name='n_Peripheral']").click(function () {
            show_answer('slide018', $("input[name='n_Peripheral']:checked").val(), 'slide_118', 'Margins: Peripheral');
        });
        $("input[name='n_Deep']").click(function () {
            show_answer('slide118', $("input[name='n_Deep']:checked").val(), 'slide_019', 'Margins: Deep');
        });
        $("input[name='Maximum_Indicate']").click(function () {
            $('#1st_spec4').html('- Maximum dimension/diameter of lesion');
            show_answer('slide019', $("input[name='Maximum_Indicate']:checked").val(), 'slide_20', 'Indicate which used:');
        });
        $("input[name='Maximum_Dimention']").click(function () {
            show_answer('slide20', $("input[name='Maximum_Dimention']:checked").val(), 'slide_21', 'Dimension');
        });
        $("#ptnm_comments").click(function () {
            show_answer('slide21', 'pTNM pt: ' + $("input[name='ptnm']").val() + 'pTNM pN: ' + $("input[name='ptnm_N']").val() + 'Distant metastasis M: ' + $("input[name='ptnm_M']").val() + ' & Comments: ' + $("#bcc_comments").val(), '', 'PTNM & Comments');
        });


        /**
         * Show Answer
         * @param {*} slide 
         * @param {*} slide_id 
         * @param {*} slide_question 
         */

        function show_answer(slide, slide_ans, slide_id, slide_question) {
            $('.' + slide + '_stat').show();
            $('.' + slide + '_ans').html("<div class='sidebar_subtitle'>" + slide_question + " : <span>" + slide_ans + "</span></div>");
            window.location = $('#' + slide_id).attr('href');
        }


        /**
         * Change Title
         */

        function changeTitle() {
            $('#dataset_title_view').html($('#dataset_title').val());
        }
        var scroll = $.cookie('scroll');
        if (scroll) {
            scrollToID(scroll, 1000);
            $.removeCookie('scroll');
        }
        $(".circle_carousel").click(function () {
            $(".circle_carousel").removeClass("active");
            $(this).addClass("active");
        });
        $(".next_2").click(function () {
            $(".radio_links.list-inline.step1").addClass("hidden");
            $(".radio_links.list-inline.step2").removeClass("hidden");
        });
        $(".next_3").click(function () {
            $(".radio_links.list-inline.step2").addClass("hidden");
            $(".radio_links.list-inline.step3").removeClass("hidden");
        });
        $(".next_4").click(function () {
            $(".radio_links.list-inline.step3").addClass("hidden");
            $(".radio_links.list-inline.step4").removeClass("hidden");
        });
        $(".next_5").click(function () {
            $(".radio_links.list-inline.step4").addClass("hidden");
            $(".radio_links.list-inline.step5").removeClass("hidden");
        });
        $(".back_1").click(function () {
            $(".radio_links.list-inline.step2").addClass("hidden");
            $(".radio_links.list-inline.step1").removeClass("hidden");
        });
        $(".back_2").click(function () {
            $(".radio_links.list-inline.step3").addClass("hidden");
            $(".radio_links.list-inline.step2").removeClass("hidden");
        });
        $(".back_3").click(function () {
            $(".radio_links.list-inline.step4").addClass("hidden");
            $(".radio_links.list-inline.step3").removeClass("hidden");
        });
        $(".back_4").click(function () {
            $(".radio_links.list-inline.step5").addClass("hidden");
            $(".radio_links.list-inline.step4").removeClass("hidden");
        });

        $("#bcc_submit").click(function () {
            $("#bcc_respons_html").val($("#bcc_answers").html());
            $("#bcc_form").submit();
            return false;
        });

        function confirm_delete() {
            var delete_con = confirm('are you sure to delete this dataset? you will not able to undo this.');
            if (delete_con) {
                return true;
            } else {
                return false;
            }
        }

    </script>
<?php } ?>
<?php if ($this->uri->segment(2) == 'squamous_cell_dataset') { ?>

    <script>


        jQuery(function () {
            // remove the below comment in case you need chnage on document ready
            // location.href=jQuery("#selectbox").val(); 
            jQuery(".patient_specimen").click(function () {
                var sq = $("input[type='radio'][name='patient_specimen']:checked").val();
                //           alert(sq);
                location.href = '<?php echo site_url('_dataset/squamous_cell_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9) . '/' . $this->uri->segment(10) . '/' . $this->uri->segment(11) . '/' . $this->uri->segment(12) . '/') ?>' + sq;

            });
        });

        $("#site_btn").click(function () {
            show_answer('slide1', $("#site").val(), 'slide_02', 'Site');
        });

        $("input[name='specimen_type']").click(function () {
            show_answer('slide2', $("input[name='specimen_type']:checked").val(), 'slide_013', 'Specimen Type');
        });

        $("input[name='subtype']").click(function () {
            show_answer('slide13', $("input[name='subtype']:checked").val(), 'slide_03', 'Subtype');
        });

        $("input[name='differentiation']").click(function () {
            show_answer('slide3', $("input[name='subtype']:checked").val(), 'slide_04', 'Differentiation');
        });

        $("input[name='perineurialInvasion']").click(function () {
            show_answer('slide4', $("input[name='subtype']:checked").val(), 'slide_05', 'Perineurial Invasion');
        });

        $("input[name='lymphovascularInvasion']").click(function () {
            show_answer('slide5', $("input[name='subtype']:checked").val(), 'slide_06', 'Lymphovascular Invasion');
        });

        $("#max_diameter_btn").click(function () {
            show_answer('slide6', $("#max_diameter").val()+' mm', 'slide_07', 'Maximum tumour diameter');
        });

        $("#depth_btn").click(function () {
            show_answer('slide7', $("#depth").val()+' mm', 'slide_08', 'Depth');
        });

        $("#clark_level_btn").click(function () {
            show_answer('slide8', $("#clark_level").val(), 'slide_09', 'Clark level of invasion');
        });

        $("#margin_btn").click(function () {
            show_answer('slide9', 'epidermal: '+$("#epidermal").val() +' mm - deep: '+ $("#deep").val()+' mm', 'slide_010', 'Distance from margins');
        });

        $("#additionalComments_btn").click(function () {
            show_answer('slide10', $("#additionalComments").val(), 'slide_011', 'Additional comments');
        });

        $("input[name='risk']").click(function () {
            show_answer('slide11', $("input[name='risk']:checked").val(), 'slide_012', 'Pathological risk status of skin cancer MDT');
        });

        $("input[name='tnm']").click(function () {
            show_answer('slide12', $("input[name='tnm']:checked").val(), 'slide_014', 'TNM pathological (p) stage (AJCC8)');
        });




        /**
         * Show Answer
         * @param {*} slide 
         * @param {*} slide_id 
         * @param {*} slide_question 
         */

        function show_answer(slide, slide_ans, slide_id, slide_question) {
            $('.' + slide + '_stat').show();
            $('.' + slide + '_ans').html("<div class='sidebar_subtitle'>" + slide_question + " : <span>" + slide_ans + "</span></div>");
            window.location = $('#' + slide_id).attr('href');
        }


        /**
         * Change Title
         */

        function changeTitle() {
            $('#dataset_title_view').html($('#dataset_title').val());
        }
        var scroll = $.cookie('scroll');
        if (scroll) {
            scrollToID(scroll, 1000);
            $.removeCookie('scroll');
        }
        $(".circle_carousel").click(function () {
            $(".circle_carousel").removeClass("active");
            $(this).addClass("active");
        });

        $("#ssc_submit").click(function () {
            $("#ssc_respons_html").val($("#ssc_answers").html());
            $("#ssc_form").submit();
            return false;
        });

        function confirm_delete() {
            var delete_con = confirm('are you sure to delete this dataset? you will not able to undo this.');
            if (delete_con) {
                return true;
            } else {
                return false;
            }
        }

    </script>
<?php } ?>
<?php if ($this->uri->segment(2) == 'cutaneous_malignant_melanoma_dataset') { ?>

    <script>



        jQuery(function () {
            // remove the below comment in case you need chnage on document ready
            // location.href=jQuery("#selectbox").val(); 
            jQuery(".patient_specimen").click(function () {
                var sq = $("input[type='radio'][name='patient_specimen']:checked").val();
                //           alert(sq);
                location.href = '<?php echo site_url('_dataset/cutaneous_malignant_melanoma_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8) . '/' . $this->uri->segment(9) . '/' . $this->uri->segment(10) . '/' . $this->uri->segment(11) . '/' . $this->uri->segment(12) . '/') ?>' + sq;

            });
        });

        $("#site_btn").click(function () {
            show_answer('slide1', $("#site").val(), 'slide_02', 'Site');
        });

        $("input[name='specimen_type']").click(function () {
            show_answer('slide2', $("input[name='specimen_type']:checked").val(), 'slide_03', 'Specimen Type');
        });

        $("input[name='macroscopic_ulceration']").click(function () {
            show_answer('slide3', $("input[name='macroscopic_ulceration']:checked").val(), 'slide_04', 'Macroscopic ulceration');
        });

        $("input[name='Photo_taken']").click(function () {
            show_answer('slide4', $("input[name='Photo_taken']:checked").val(), 'slide_05', 'Photo taken');
        });

        $("input[name='Histological_type']").click(function () {
            show_answer('slide5', $("input[name='Histological_type']:checked").val(), 'slide_06', 'Histological type');
        });

        $("input[name='Growth_phase']").click(function () {
            show_answer('slide6', $("input[name='Growth_phase']:checked").val(), 'slide_07', 'Growth phase (invasion)');
        });

         $("#invasive_btn").click(function () {
            show_answer('slide7', '<br>Breslow depth : '+$("#breslow_depth").val()+' mm; <br>Breslow depth of scar :  '+$("#breslow_depth_scar").val()+' mm <br>Clark level : '+$("input[name='clark_level']:checked").val()+'Ulceration : '+$("input[name='Ulceration']:checked").val()+'Mitoses : '+$("#Mitoses").val()+' /mm<sup>2</sup> <br>', 'slide_08', 'Invasive only');
        });
        
        $("input[name='Solar_damage']").click(function () {
            show_answer('slide8', $("input[name='Solar_damage']:checked").val(), 'slide_09', 'Solar damage');
        });
        
       $("#host_btn").click(function () {
            show_answer('slide9', '<br> tumour inflitrating lymphocytes : '+$("input[name='tumour_infiltrating_']:checked").val()+'<br> regression : '+$("input[name='regression']:checked").val(), 'slide_010', 'Host response');
        });
        
       $("#locoregional_btn").click(function () {
            show_answer('slide10', '<br> neurotropism : '+$("input[name='neurotropism']:checked").val()+'<br> lymphatic vessel invasion : '+$("input[name='lymphatic_vessel_invasion']:checked").val()+'<br> blood vessel invasion : '+$("input[name='blood_vessel_invasion']:checked").val()+'<br> microsatellite : '+$("input[name='miscrosetellite']:checked").val()+'<br> satellite : '+$("input[name='setellite']:checked").val()+'<br> in transit metastasis  : '+$("input[name='in_transit_metastasis']:checked").val(), 'slide_011', 'Locoregional spread');
        });
        
       $("#excision_btn").click(function () {
            show_answer('slide11', '<br> epdermal in situ components : '+$("#epi_insitu").val()+' mm<br> epdermal in invasive components : '+$("#epi_invasive").val()+' mm<br> deep : '+$("#deep").val()+' mm', 'slide_012', 'Excision margins');
        });
        
        $("input[name='lesion']").click(function () {
            show_answer('slide12', $("input[name='lesion']:checked").val(), 'slide_013', 'Co-existing lesion');
        });
        
        $("input[name='special_techniques']").click(function () {
            show_answer('slide13', $("input[name='special_techniques']:checked").val(), 'slide_014', 'Special techniques');
        });
        
        $("input[name='biomarkers']").click(function () {
            show_answer('slide14', $("input[name='biomarkers']:checked").val(), 'slide_015', 'Biomarkers');
        });
        
        $("#additional_comments_btn").click(function () {
            show_answer('slide15', $("#additional_comments").val(), 'slide_016', 'Additional comments');
        });
        
        $("input[name='tnm']").click(function () {
            show_answer('slide16', $("input[name='tnm']:checked").val(), 'slide_017', 'TNM staging (AJCC7)');
        });
        
        $("input[name='snomed']").click(function () {
            show_answer('slide17', $("input[name='snomed']:checked").val(), 'slide_018', 'SNOMED code');
        });
        
        $("input[name='insitu']").click(function () {
            show_answer('slide18', $("input[name='insitu']:checked").val(), 'slide_019', 'In-situ');
        });
        
        $("input[name='_invasive']").click(function () {
            show_answer('slide19', $("input[name='_invasive']:checked").val(), '', 'Invasive');
        });



  

        




        /**
         * Show Answer
         * @param {*} slide 
         * @param {*} slide_id 
         * @param {*} slide_question 
         */

        function show_answer(slide, slide_ans, slide_id, slide_question) {
            $('.' + slide + '_stat').show();
            $('.' + slide + '_ans').html("<div class='sidebar_subtitle'>" + slide_question + " : <span>" + slide_ans + "</span></div>");
            window.location = $('#' + slide_id).attr('href');
        }


        /**
         * Change Title
         */

        function changeTitle() {
            $('#dataset_title_view').html($('#dataset_title').val());
        }
        var scroll = $.cookie('scroll');
        if (scroll) {
            scrollToID(scroll, 1000);
            $.removeCookie('scroll');
        }
        $(".circle_carousel").click(function () {
            $(".circle_carousel").removeClass("active");
            $(this).addClass("active");
        });

        $("#cmm_submit").click(function () {
            $("#cmm_respons_html").val($("#cmm_answers").html());
            $("#cmm_form").submit();
            return false;
        });


        function confirm_delete() {
            var delete_con = confirm('are you sure to delete this dataset? you will not able to undo this.');
            if (delete_con) {
                return true;
            } else {
                return false;
            }
        }

    </script>

<?php } ?>
<script>
    var site_url = "<?php echo site_url() ?>"; 
    var user_id = "<?php echo $this->ion_auth->user()->row()->id; ?>";    
</script>
<script src="<?php echo base_url('/assets/js/scripts/counter.js'); ?>"></script>
</html>