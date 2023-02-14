<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script src="https://cdn.tiny.cloud/1/mcnf3z49bi3hvs29al81mrwfygelhkh5ya3vkn0tush8eu9v/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</div>
</div>
    <!-- /Page Wrapper -->

<script>
    <?php if (!isset($flag)) {?>
    tinymce.init({
        menubar: false,
        selector: '.tg-tinymceeditor',
        init_instance_callback: function (editor) {
            editor.on('blur', function (e) {
                save_specimen_data();
            });
        },
        toolbar: 'undo redo ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        font_formats: "CircularStd=CircularStd;",
        content_style: "@import url('https://db.onlinewebfonts.com/c/860c3ec7bbc5da3e97233ccecafe512e?family=CircularStd'); body { font-family: 'CircularStd' , sans-serif !important; font-size:18px; }"
    });
    tinymce.init({
        selector: '.tinyTextarea',
        height: 200,
        menubar: false,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });
    <?php }?>
</script>



<!-- Footer Template -->
<footer>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <p class="text-center">
                    PathHub &reg; Software Systems Inc. 6.0. Uralensis Innov8 Ltd & LLC.
                </p>
            </div>
        </div>

    </div>

</footer>
</body>
        <?php
if (!(strtolower($this->uri->segment(1)) == 'doctor' && (strtolower($this->uri->segment(2)) == 'doctor_record_detail' || strtolower($this->uri->segment(2)) == 'doctor_record_detail_old' || strtolower($this->uri->segment(2)) == 'authorization_queue'))) {
	$src_url = base_url('/assets/subassets/js/jquery-3.2.1.min.js');
	echo "<script src='$src_url'></script>";
}
?>
        <script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>
        <!-- Datetimepicker JS -->
        <script src="<?php echo base_url('/assets/subassets/js/moment.min.js') ?>"></script>

        <!-- Bootstrap Core JS -->
        <script src="<?php echo base_url('/assets/subassets/js/popper.min.js') ?>"></script>
        <script src="<?php echo base_url('/assets/newtheme/js/bootstrap.min.js') ?>"></script>

        <!-- Slimscroll JS -->
        <script src="<?php echo base_url('/assets/subassets/js/jquery.slimscroll.min.js') ?>"></script>

        <!-- Chart JS -->
        <script src="<?php echo base_url('/assets/subassets/plugins/morris/morris.min.js') ?>"></script>
        <script src="<?php echo base_url('/assets/subassets/plugins/raphael/raphael.min.js') ?>"></script>
        <script src="<?php echo base_url('/assets/subassets/js/chart.js') ?>"></script>


        <script src="<?php echo base_url('/assets/subassets/js/jquery.smartWizard.js') ?>"></script>

        <script src="<?php echo base_url('/assets/subassets/js/jquery.date-dropdowns.js') ?>"></script>

        <script src="<?php echo base_url('/assets/js/jquery.countTo.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/circle-progress.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/moment-with-locales.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/bootstrap-select.min.js'); ?>"></script>
        <!-- Select2 JS -->
        <script src="<?php echo base_url('/assets/subassets/js/select2.min.js') ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/newtheme/js/custom_jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/newtheme/js/dataTables.bootstrap4.min.js'); ?>"></script>
<?php $this->load->view("session");?>
        <script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery.inputmask.bundle.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery-te-1.4.0.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/jquery.idle.min.js'); ?>"></script>
        <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <script src="<?php echo base_url('/assets/subassets/js/new_jquery.datetimepicker.js') ?>"></script>
        <script src="<?php echo base_url('assets/institute/plugins/summernote/dist/summernote.js'); ?>"></script>
        <!-- Custom JS -->
        <script src="<?php echo base_url('/assets/subassets/js/app.js') ?>"></script>

        <script src="<?php echo base_url('/assets/js/amcharts/core.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/amcharts/charts.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/js/amcharts/animated.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/daterangepicker.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/daterangepicker.css'); ?>" />


<!--jQuery Form Plugin-->
<script src=" <?php echo base_url('/assets/js/jquery.form.js'); ?> "></script>

<!--jQuery Validation Plugin-->
<script src="<?php echo base_url('/assets/validation/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/validation/additional-methods.min.js'); ?>"></script>

<!--Js Tree-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

<!--Bootstrap Tree-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-treeview.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap-treeview.min.css'); ?>" />

<script type="text/javascript">

    $(document).ready(function(){
        setTimeout(function(){
            update_record_history_table();
            update_block_history_table();
        },1000);
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

         $(document).on("click", '.markedViewed', function(){
            var rid = $(this).attr('data-rid');
            $.ajax({
                type: "post",
                url: "<?php echo base_url(); ?>/institute/MarkedAsViewed",
                data: {
                    changeId: rid,
                    [csrf_name]: csrf_hash,
                },
                success: function (response) {

                },
                error: function () {
                    alert("Something went wrong. Please try again!");
                },
            });
        });
    })
</script>

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

<script type="text/javascript">
    var laboratory_base_url = '<?php echo base_url('laboratory') ?>';
</script>
<script src="<?php echo base_url('/assets/js/laboratory.js'); ?>"></script>

<script type="text/javascript">

        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
                return false;
            }

            return true;
        }

        $(document).ready(function(){
            $("#myCarousel").carousel();


            // ==============================================================
            //tooltip
            // ==============================================================

        });
    </script>

        <script>

        // Tranfer button click to input click
        $(".tg-cancel label").click(function() {
            $(this).parent("span").find("input").prop("checked", true);
            $(this).parent("span").find("input").trigger("click");
        });


        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        event.stopPropagation();
                        form.classList.add('was-validated');
                        if (form.checkValidity()) {
                            form.submit();
                        }
                    }, false);
                });

            }, false);
        })();
        $(document).on('click','.btnRemove',function() {
             $(this).closest("tr").remove();
        });


        $(document).on('click','.btnPlus',function() {
            var table = $('#tblItems');
             table.append('<tr><td></td><td><input class="form-control" name="itemName[]" type="text" style="min-width:150px"></td><td><input class="form-control" name="itemDescription[]" type="text" style="min-width:150px"></td><td><input class="cost form-control" name="itemCost[]" style="width:100px" type="text"></td><td><input class="qty form-control" name="itemQty[]" style="width:80px" type="text"></td><td><input class="form-control amount" name="amount[]" readonly="" style="width:120px" type="text"></td><td><a href="javascript:void(0)" class="btnRemove text-danger font-18" title="Add"><i class="fa fa-trash-o"></i></a></td></tr>');
        });
        $(document).on('input','.cost',function() {

          var qty = $(this).closest("tr").find("input[name='itemQty[]']").val();
          var amount = $(this).closest("tr").find("input[name='amount[]']");

          amount.val($(this).val()*qty);
          updateTotal();
          updateTax();

        });
        $('.selectpicker').selectpicker();

        $(document).on('input','.qty',function() {

          var cost = $(this).closest("tr").find("input[name='itemCost[]']").val();
          var amount = $(this).closest("tr").find("input[name='amount[]']");

          amount.val($(this).val()*cost);
          updateTotal();
          updateTax();

        });
        $(document).on('change','.selectTaxt',function() {
            updateTax();
        });
        function updateTotal() {
            var sum = 0;
            $("input[name='amount[]']").each(function() {
                sum += Number($(this).val());
            });
            $("input[name='invoiceAmount']").val(sum);
        }

        function updateTax() {
            var sum = $("input[name='invoiceAmount']").val();
            var tax = $("select[name='tax']").val()
            $("input[name='invoiceTax']").val(sum*tax/100);
        }

        $('#statusChange a').on('click',function(event) {
              event.preventDefault();
              var upperAnchor =  $(this).closest('.changeStat').find('a.btn');
              var stats = $(this).find("input[name='statusChange']").val();
              var id = $(this).closest("#statusChange").find("input[name='invoiceId']").val();
              $.ajax({
                type: "get",
                url: "<?php echo base_url(); ?>/invoices/changeStatus",
                data: { statusChange : stats,
                       changeId: id
                      },
                success: function(response)
                {
                    var textChange = '<a class=" btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-'+stats+'"></i>'+stats+'</a>'
                  upperAnchor.replaceWith(textChange);
                },
                error: function(){
                  alert("Error");
                },
              });
            });

        $(document).ready(function() {

            $('.date_range').daterangepicker({
                showDropdowns: true,
                startDate: moment().startOf('day'),
                endDate: moment().startOf('day').add(5, 'days'),
                drops: "auto",
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });
            $('.drop_up').daterangepicker({
                drops: "up"
            });

            $(window).resize(function() {
                var prevheight = $('.patient-menu').height();
                $('.sidebar').css('top',prevheight);
                $('.page-wrapper.sidebar-patient').css('padding-top', prevheight);
            }).resize();



            $(".day").prop('required', true);
            $(".month").prop('required', true);
            $(".year").prop('required', true);
            $("#inputPatientDateOfBirth").dateDropdowns();

            // Fetch patient data
            var userData = null;


            $('#personal_info_modal').on("show.bs.modal", function(e) {

                var $inputs = $(this).find(':input');

                $.get("<?php echo base_url(); ?>/patient/fetch", function(data, status) {
                    console.log(status+'status');
                if (status == 'success') {
                    userData = JSON.parse(data);
                    if (userData.new) {
                        console.log('new');
                    }else{
                        console.log(userData);
                        $.each(userData, function(key, val) {
                          $inputs.filter('[id="inputPatient' + key + '"]').val(val);
                        });

                    }
                }
            });

            });


        });
    </script>

<script type="text/javascript">
    jQuery('body').prepend('<button type="button" class="back_to_top btn btn-warning"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></button>');
    var amountScrolled = 300;
    jQuery(window).scroll(function () {
        if (jQuery(window).scrollTop() > amountScrolled) {
            jQuery('.back_to_top').fadeIn('slow');
        } else {
            jQuery('.back_to_top').fadeOut('slow');
        }
    });
    jQuery('.back_to_top').click(function () {
        jQuery('html, body').animate({
            scrollTop: 0}, 700);
        return false;
    });
</script>

<script>
    jQuery(document).ready(function () {

        tinymce.init({
			selector: '.tg-tinymceeditor',
			theme: 'silver',
            menubar: false,
            statusbar: false,
            toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist forecolor undo redo",
			plugins: [
                'advlist autolink lists textcolor',
                'wordcount'
            ],
            toolbar: ' undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat ',
            setup: function (editor) {
                editor.on('change', function (e) {
                    editor.save();
                });
            }
        });

        $('ul.nav li.dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
        });

        // jQuery('.ura-pin-area').hide();
        jQuery('.ura-surname-field').hide();
        var surnameData = jQuery('input[name=surname_data]').val();

        jQuery("#check_auth_pass_form .ura-password-fields input").keyup(function () {
            var _this = jQuery(this);
            if (_this.val().length >= 1) {
                var input_flds = jQuery(this).closest('#check_auth_pass_form').find(':input');
                input_flds.eq(input_flds.index(this) + 1).focus();
            }
        });
        jQuery("#check_auth_pass_form .ura-password-fields input").keydown(function (e) {
            var _this = jQuery(this);
            if ((e.which == 8 || e.which == 46) && _this.val() == '') {
                $(this).prev('input').focus();
            }
        });

        $('.tg-filtercolors').on('mouseover', 'span label', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
        $('.tg-themedetailsicon').on('mouseover', 'li a', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });

        $('#user_auth_pop').on('mouseover', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });

        $('#doctor_record_publish_table tbody, #doctor_record_list_table tbody, #record_list_table_authorization tbody, .doctor_record_detail').on('mouseover', 'tr', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });

        $('.tg-flagcolor, .tg-namelogo').on('mouseover', 'label', function () {
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

        $('#doctor_record_review_cases tbody').on('mouseover', 'tr', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });

        jQuery(function () {
            jQuery('#pop').click(function () {
                jQuery('#popup').bPopup({
                    easing: 'easeOutBack',
                    speed: 450
                });
            });
        });

        jQuery(function () {
            jQuery('#pop1').click(function () {
                jQuery('#popup1').bPopup({
                    easing: 'easeOutBack',
                    speed: 450
                });
            });
        });

        jQuery('#datetaken_doctor, #data_processed_bylab, #date_sent_touralensis, #rec_by_doc_date, #date_received_bylab, #dob').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });
        // $('#dt_date_of_death, #ap_exmination_datetime').datetimepicker({
        //     minDate: new Date()
        // });
        $('.datetimepicker').datetimepicker({
            format:'Y-m-d H:m'
        });
        $('.datepicker_new').datetimepicker({
            timepicker:false,
            format:'d-m-Y',
            minDate: '<?php echo date('d-m-Y'); ?>',
        });

        jQuery('.timer').countTo();

        var testBlockTable =  $('#doctor_record_review_cases, #doctor_opinion_record_list_table, #doctor_opinion_requested_list_table, #teaching_case_table, #further_work_table_completed, #further_work_table_requested, #mdt_table_post, #mdt_table_pending, #doctor_invoice_table').DataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $(document).on('change', '#FilterTests', function(){
            $.fn.dataTable.ext.search.pop();
            testBlockTable.draw();
            var selectedStatus = $(this).val();
            $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                    return ($(testBlockTable.row(dataIndex).node()).attr('data-status').indexOf(selectedStatus) != -1)
                }
            );
            testBlockTable.draw();
        })
        $('.doctors_tat_table').DataTable({
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        });
        $('.doctors_pub_upub_table').DataTable({
            pageLength : 5,
            searching: false,
            ordering: false,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']],
            pagingType: 'full'
        });

        var authorized_cases_table = $('.doctors_pub_table').DataTable({
            pageLength : 5,
            searching: false,
            ordering: false,
            lengthChange: false,
            pagingType: 'full'
        });

        //DataTable Authorized cases period change event
        $('#authorized_case_period').on('change', function(e) {
            e.preventDefault();
            // alert(cc);
            // console.log(doctor_id);
            var doctor_id = <?php echo $this->ion_auth->user()->row()->id; ?>;
            var period = $(this).val();
            if(period == 0){
                period= 7;
            }
            $.ajax({
                url:"<?php echo base_url('/index.php/doctor/get_authorized_cases_by_period'); ?>",
                method:"POST",
                data: { "period":period, "doctor_id":doctor_id},
                dataType: "json",
                success:function(data)
                {
                    // console.log(data); return false;
                    if (data.type === 'error') {
                        alert(data.msg);
                    }else{
                        // console.log(data.data);
                        var final_result = data.data;

                        authorized_cases_table.clear().draw();
                        var i=1;
                            var curr_date = 0;
                            var urgent_sc = 0;
                            var tww_sc = 0;
                            var routine_sc = 0;
                            var spec_total_sc = 0;
                            // Getting data from Data Object
                        Object.keys(final_result).forEach(function (key, property) {
                            curr_date = final_result[key].cur_date;
                            urgent_sc = urgent_sc+final_result[key].urgent_scanned;
                            tww_sc = tww_sc+final_result[key].tww_scanned;
                            routine_sc = routine_sc+final_result[key].routine_scanned;
                            spec_total_sc = spec_total_sc+final_result[key].specialty_sc_total;

                            var cur_date = final_result[key].cur_date;
                            var speciality_id = final_result[key].speciality_id;
                            var specialty = final_result[key].specialty;
                            var hospital = final_result[key].hospital;
                            var urgent_scanned = final_result[key].urgent_scanned;
                            var tww_scanned = final_result[key].tww_scanned;
                            var routine_scanned = final_result[key].routine_scanned;
                            var specialty_sc_total = final_result[key].specialty_sc_total;

                            authorized_cases_table.row.add( [
                                cur_date,
                                specialty,
                                hospital,
                                urgent_scanned,
                                tww_scanned,
                                routine_scanned,
                                specialty_sc_total
                            ] ).draw( false );
                            i++;
                        });
                        authorized_cases_table.row.add( [
                            curr_date,
                            "Total",
                            "All",
                            urgent_sc,
                            tww_sc,
                            routine_sc,
                            spec_total_sc
                        ]).draw( false );

                    }
                }
            });
        });

        $('.pathologists_table').DataTable({
            pageLength : 5,
            searching: false,
            ordering: false,
            info:     false
        });
        $('div.dataTables_filter input').focus();

        oTable = $('#doctor_record_list_table').DataTable({
            ordering: false,
            searching: true,
            processing: true,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        });

        //DataTable custom search field
        $('#unpub_custom_filter').on('keyup', function() {
            oTable.search( $(this).val() ).draw();
        });


        // Search table by column
        $("#adv_search_first_name").on('change', function() {
            var val = $(this).val();
            oTable.column(6).search(val).draw();
        });


        $("#adv_search_sur_name").on('change', function() {
            var val = $(this).val();
            oTable.column(6).search(val).draw();
        });

        $("#adv_search_nhs_no").on('change', function() {
            var val = $(this).val();
            oTable.column(7).search(val).draw();
        });

        $("#adv_search_dob").on('change', function() {
            var val = $(this).val();
            oTable.column(7).search(val).draw();
        });

        $("#adv_search_speciality").on('change', function() {
            var val = $(this).val();

            oTable.column(4).search(val).draw();
        });



        display_comment_box_hover();
        add_flag_comments_box();
        filter_tat_on_record_list(oTable);
        filter_row_status_on_record_list(oTable);
        filter_row_by_hospital_on_record_list(oTable);
        filter_row_by_status_on_record_list(oTable);
        filter_report_urgency_status_on_record_list(oTable);
        filter_flag_status_on_record_list(oTable);
        filter_row_by_data_type_on_record_list(oTable);  //TODO


        jQuery('#check_pass').on('click', function (e) {
            e.preventDefault();
            if ($('input[name=date_sent_touralensis]').val() === '') {
                jQuery.sticky('Released Lab Date Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            if ($('input[name=rec_by_doc_date]').val() === '') {
                jQuery.sticky('Received By Doctor Date Must Not Be Empty.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            if ($('select[name=cost_codes]').val() === '') {
                jQuery.sticky('Please select cost code first in order to publish. If you have not added the cost code yet then add first.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }
            var formvalue = jQuery('#check_auth_pass_form');
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/doctor/check_auth_pass'); ?>",
                data: formvalue.serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        $.ajax({
                            type: "POST",
                            ///*url: "<?//= base_url('patient/generate_hl7_file'); ?>//",*/
                            url: "<?php echo base_url('/index.php/doctor/generate_report/'); ?>" + $(document).find('#record_id').val() + "/published",
                            data: { 'id': $(document).find('#patient_id').val(), 'request_id': $(document).find('#record_id').val(), [csrf_name]: csrf_hash},
                            success: function (response){
                                generateTxt();
                            }
                        });
                    }
                    jQuery('#publish_button').html(response.message);
                }
            });
        });

        function generateTxt(){
            let patientID = $(document).find('#patient_id').val();
            let requestID = $(document).find('#record_id').val();
            $.ajax({
                type: "POST",
                url: "<?=base_url('patient/generate_hl7_file');?>",
                data: { 'id': patientID, 'request_id': requestID },
                dataType: "json",
                success: function (response){
                    if (response.status === 'success') {
                        window.setTimeout(function () {
                            window.location.href = "<?php echo base_url('/index.php/institute/doctor_record_list?msg=success'); ?>";
                        }, 2000);
                    } else {
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
        }

        jQuery('#check_pass_authorization').on('click', function (e) {
            e.preventDefault();
            var formvalue = jQuery('#check_auth_pass_form');
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/doctor/check_auth_pass'); ?>",
                data: formvalue.serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery('#publish_button').html(response.message);
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        jQuery('#publish_button').html(response.message);
                    }
                }
            });
        });

        jQuery(document).on('click', '#update_doctor_personal_report_btn', function (e) {
            e.preventDefault();
            var doctor_update_personal_record = jQuery('#doctor_update_personal_record').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/doctor/update_only_report'); ?>",
                data: doctor_update_personal_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        jQuery(document).on('click', '.update_doctor_autopsy_report_btn', function (e) {
            e.preventDefault();
            var doctor_update_personal_record = jQuery('.doctor_update_autopsy_record').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/doctor/update_report_postmortem'); ?>",
                data: doctor_update_personal_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        console.log(response.affected_rows)
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        jQuery(document).on('click', '.update_doctor_virology_report_btn', function (e) {
            e.preventDefault();
            var doctor_update_personal_record = jQuery('.doctor_update_virology_record').serialize();
            console.log(doctor_update_personal_record);
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/doctor/update_report_virology'); ?>",
                data: doctor_update_personal_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        console.log(response.affected_rows)
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        jQuery(document).on('click', '.update_doctor_virology_report_btn', function (e) {
            e.preventDefault();
            // var doctor_update_personal_record = jQuery('.doctor_update_autopsy_record').serialize();
            //jQuery.ajax({
            //    type: "POST",
            //    url: "<?php //echo base_url('index.php/doctor/update_report_postmortem'); ?>//",
            //    data: doctor_update_personal_record,
            //    dataType: "json",
            //    success: function (response) {
            //        if (response.type === 'success') {
            //            jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
            //            window.setTimeout(function () {
            //                location.reload();
            //            }, 1000);
            //        } else {
            //            console.log(response.affected_rows)
            //            jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
            //        }
            //    },
            //    error: function(err) {
            //        console.log(err);
            //    }
            //});
        });

        $('#ap_feedback_to_lab').on('submit', function(e){
            e.preventDefault();
            if($('#email_to').val() == '')
            {
                $error_html = '<div class="alert alert-danger alert-dismissible">' +
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                    '<span>Email To cannot be empty</span>' +
                    '</div>';
                $('#ed_error_alert').html($error_html);
                $('#email_to').focus();
            }
            else
            {
                $.ajax({
                    url:"<?php echo base_url('index.php/doctor/autopsy_feedback_to_lab'); ?>",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType: "json",
                    success:function(response)
                    {
                        if (response.type === 'success') {
                            $('#ed_error_alert').html('');
                            $success_html = '<div class="alert alert-success alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>'+response.msg+'</span>' +
                                '</div>';
                            $('#ed_success_alert').html($success_html);
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $error_html = '<div class="alert alert-danger alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>'+response.msg+'</span>' +
                                '</div>';
                            $('#ed_error_alert').html($error_html);
                        }
                    }
                });
            }
        });

        $('#ap_feedback_to_mortuary').on('submit', function(e){
            e.preventDefault();
            if($('#mort_email_to').val() == '')
            {
                $error_html = '<div class="alert alert-danger alert-dismissible">' +
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                    '<span>Email To cannot be empty</span>' +
                    '</div>';
                $('#mort_error_alert').html($error_html);
                $('#mort_email_to').focus();
            }
            else
            {
                $.ajax({
                    url:"<?php echo base_url('index.php/doctor/autopsy_feedback_to_mortuary'); ?>",
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType: "json",
                    success:function(response)
                    {
                        if (response.type === 'success') {
                            $('#mort_error_alert').html('');
                            $success_html = '<div class="alert alert-success alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>'+response.msg+'</span>' +
                                '</div>';
                            $('#mort_success_alert').html($success_html);
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $error_html = '<div class="alert alert-danger alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>'+response.msg+'</span>' +
                                '</div>';
                            $('#mort_error_alert').html($error_html);
                        }
                    }
                });
            }
        });

        jQuery(document).on('click', '#btn_bmi_weights_form', function (e) {
            e.preventDefault();
            var doctor_update_ap_bmi_record = jQuery('#ap_bmi_weights_form').serialize();
            // console.log(doctor_update_ap_bmi_record); return false;
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/doctor/update_autopsy_bmi_organs_wt'); ?>",
                data: doctor_update_ap_bmi_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        console.log(response.affected_rows)
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        jQuery(document).on('click', '#btn_update_relevant_doctors', function (e) {
            e.preventDefault();
            var doctor_update_ap_bmi_record = jQuery('#ap_relevant_doctors_form').serialize();
            // console.log(doctor_update_ap_bmi_record); return false;
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/doctor/update_autopsy_related_doctors'); ?>",
                data: doctor_update_ap_bmi_record,
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        console.log(response.affected_rows)
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        jQuery('#publish_supplementary_btn').bind('click', function (e) {
            e.preventDefault();
            if (!confirm('Are You Sure You Want To Publish Supplementary Report.')) {
                return false;
            } else {
                var _this = $(this);
                var record_id = _this.data('recordid');
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/publish_additional_work'); ?>",
                    data: {'request_id': record_id},
                    dataType: "json",
                    success: function (response) {
                        if (response.type === 'success') {
                            jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            window.setTimeout(function () {
                                location.reload()
                            }, 2000);
                        } else {
                            jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        }
                    }
                });
            }
        });

        jQuery('#doctor_record_publish_table').on('click', '.record_id_unpublish', function () {
            var record_url = jQuery(this).data('unpublishrecordid');
            var record_serial = jQuery(this).data('recordserial');
            if (confirm("Are You Sure You Want To Un Publish This " + record_serial + " Record.")) {
                document.location = record_url;
            } else {
                return false;
            }
        });

        jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", false).css('background', '#ccc');
        jQuery(".make_editable").on('click', function (e) {
            e.preventDefault();
            if (jQuery(".make_editable").hasClass('disable')) {
                $("#table-view-patient").hide();
                $("#edit-view-patient").show();
                $("#table-view-request").hide();
                $("#edit-view-request").show();
                $("#table-view-test").hide();
                $("#edit-view-test").show();
                // $(".btn_save_sec").show();
                jQuery(".make_editable").removeClass('disable');
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", false);
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").css('background', 'white');
                jQuery(".make_editable").addClass('enable');
            } else if (jQuery(".make_editable").hasClass('enable')) {
                $("#table-view-patient").show();
                $("#edit-view-patient").hide();
                $("#table-view-request").show();
                $("#edit-view-request").hide();
                $("#table-view-test").show();
                $("#edit-view-test").hide();
                // $(".btn_save_sec").hide();
                jQuery(".make_editable").removeClass('enable');
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", false);
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").css('background', '#ccc');
                jQuery(".make_editable").addClass('disable');
                // jQuery(".make_editable").css('background-color', '#4bd12b');
            }

        });
        jQuery(".make_editable_test").click(function (){
            $(".test_area #table-view-test").toggleClass("hidden");
            $(".test_area #edit-test-request").toggleClass("hidden");
        });

        jQuery(document).on('click', '#add_comment_section', function (e) {
            e.preventDefault();
            var comment_form_data = jQuery('#comment_section_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/add_comments_section'); ?>',
                type: 'POST',
                dataType: 'json',
                data: comment_form_data,
                success: function (response) {
                    if (response.type === 'error') {
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
                        jQuery('#comment_section_msg').text(response.message);
                    } else {
                        jQuery.sticky(response.message, {classList: 'success', speed: 200, autoclose: 5000});
                        jQuery('#comment_section_msg').text(response.message);
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        jQuery(document).on('click', '#clear_comment_section', function (e) {
            e.preventDefault();
            var comment_form_data = jQuery('#comment_section_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/clear_comments_section'); ?>',
                type: 'POST',
                dataType: 'json',
                data: comment_form_data,
                success: function (response) {
                    if (response.type === 'error') {
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(response.message, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        jQuery(document).on('click', '#add_special_notes', function (e) {
            e.preventDefault();
            var special_notes_data = jQuery('#special_notes_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/add_special_notes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: special_notes_data,
                success: function (response) {
                    if (response.type === 'error') {
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(response.message, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        jQuery(document).on('click', '#clear_special_notes', function (e) {
            e.preventDefault();
            var special_notes_data = jQuery('#special_notes_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/clear_special_notes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: special_notes_data,
                success: function (response) {
                    if (response.type === 'error') {
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(response.message, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload()
                        }, 2000);
                    }
                }
            });
        });

        jQuery('#change_pin_form').on('click', '#save_pin_btn', function (e) {
            e.preventDefault();
            var publish_pin_data = jQuery('#change_pin_form').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/doctor/change_pin'); ?>",
                data: publish_pin_data,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.type === 'success') {
                        jQuery('#confirm_pin_msg').html(response.msg);
                    } else {
                        jQuery('#confirm_pin_msg').html(response.msg);
                    }
                }
            });
        });

        jQuery('#change_password_form').on('click', '#save_pass_btn', function (e) {
            e.preventDefault();
            var password_data = jQuery('#change_password_form').serialize();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url() . '/index.php/doctor/change_password_doctor'; ?>",
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

        $('.delete_supple').on('click', function (e) {
            e.preventDefault();
            var supple_id = jQuery(this).data('suppleid');
            var record_id = jQuery(this).data('recordid');
            var parent = $(this).parent("td").parent("tr");
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/manage_supplemenary'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'supple_id': supple_id, 'record_id': record_id},
                success: function (data) {
                    if (data.type === 'success') {

                        parent.fadeOut('slow', function () {
                            parent.remove();
                        });
                        jQuery('.supple_msg').html(data.msg);
                        if (data.supply_val === 'false') {

                            window.setTimeout(function () {
                                window.location.href = data.redirect_url;
                            }, 1800);
                        }

                    } else {
                        jQuery('.supple_msg').html(data.msg);
                    }
                }
            });
        });

        $("#show_mem").click(function (e) {
            e.preventDefault();
            if ($(".memorable").attr("type") == "password") {
                $(".memorable").attr("type", "text");
            }
            else {
                $(".memorable").attr("type", "password");
            }
        });

        $(document).on('click', '#further_work_add', function (e) {
            e.preventDefault();
            var _this = $(this);
            var date = new Date();
            var slot_date = moment(date).format('DD-MM-YYYY h:mm:ss A');
            _this.parents('.uralensis_icons_actions').find('#further_work').modal('show');
            _this.parents('.uralensis_icons_actions').find('#further_work #furtherwork_date').val(slot_date);
            _this.parents('.uralensis_icons_actions').find('#further_work #further_work_date_hide').val(slot_date);
        });

        $('#further_work_form').on('click', '#fw_submit_btn', function (e) {
            e.preventDefault();
            var fw_form = $('#further_work_form').serialize();
            if ($('#further_work_form input:checkbox').filter(':checked').length < 1) {
                jQuery.sticky('Check at least one Option!', {classList: 'important', speed: 200, autoclose: 5000});
                return false;
            }
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/further_work'); ?>',
                type: 'POST',
                dataType: 'json',
                data: fw_form,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload()
                        }, 1800);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
        });

        $('#education_cats').change(function (e) {
            e.preventDefault();
            var edu_cats = $('#education_cats option:selected').val();
            record_id = jQuery('#record_id').val();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/doctor/set_teach_and_mdt'); ?>",
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

        $('#education_cats_data').change(function (e) {
            e.preventDefault();
            var edu_cats = $('#education_cats_data option:selected').val();
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/doctor/display_edu_cases'); ?>",
                data: {'edu_cats': edu_cats},
                dataType: "json",
                success: function (data) {
                    if (data.type === 'error') {
                        $('.edu_msg').show();
                        $('.edu_msg').html(data.msg);
                        $('.display_edu_data').html('');
                        $('.edu_msg').fadeOut(2500);
                    } else {
                        $('.edu_msg').show();
                        $('.display_edu_data').html(data.edu_data);
                        $('.edu_msg').html(data.msg);
                        $('.edu_msg').fadeOut(2500);
                    }
                }
            });
        });

        $(function () {
            // $("#search_users").autocomplete({
            //     source: '<?php echo base_url('index.php/doctor/get_users_list'); ?>',
            //     select: function (event, ui) {
            //         $('#get_user_id').val(ui.item.id);
            //     }
            // });
        });

        $('#pm_message_form').on('click', '#send_message', function (e) {
            e.preventDefault();
            var msg_form = $('#pm_message_form').serialize();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/insert_pm_by_doctor'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/msg_trashinbox_doctor'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/msg_trashsent_doctor'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/delete_trash_doctor'); ?>',
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

        $('#assign_doctor').on('change', function (e) {
            e.preventDefault();
            var doctor_data = $('#doctor_assign_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/assign_doctor'); ?>',
                type: 'POST',
                dataType: 'json',
                data: doctor_data,
                success: function (data) {
                    if (data.type === 'error') {
                        $('.doctor_assign_msg').html(data.msg);
                    } else {
                        $('.doctor_assign_msg').html(data.msg);
                        window.setTimeout(function () {
                            window.location = '<?php echo base_url('/index.php/institute/doctor_record_list/'); ?>';
                        }, 2000);
                    }
                }
            });
        });

        $('#advance_search_table').hide();
        $('#doctor_advance_search').on('click', function (e) {
            e.preventDefault();
            $('#advance_search_table').toggle();
        });

        $('#future_mdt_dates').hide();
        $('.hide_report_option').hide();
        $('.mdt_specimen_hide').hide();
        $('.choose_mdt_list ').hide();
        $(document).on('change', '.mdt_radio', function (e) {
            e.preventDefault();
            if ($('#for_mdt').is(':checked')) {
                $('.hide_report_option').hide();
                $('#future_mdt_dates').show();
                $('.mdt_specimen_hide').show();
                $('.choose_mdt_list ').show();
            } else {
                $('#future_mdt_dates').hide();
                $('.hide_report_option').show();
                $('.mdt_specimen_hide').hide();
                $('.choose_mdt_list ').hide();
            }
        });

        if ($('input[name=mdt_dates_radio]:checked').val() === 'for_mdt'){
            $('#future_mdt_dates').show();
            $('.mdt_specimen_hide').show();
            $('.choose_mdt_list ').show();
        }

        $('#assign_mdt').on('click', function (e) {
            e.preventDefault();
            if (!$('.mdt_radio').is(':checked')) {
                alert('Please Select One Of The MDT Option');
            } else if ($('input[name=mdt_dates_radio]:checked').val() === 'for_mdt' && $('#future_mdt_dates').val() === 'false') {
                alert('Please Select MDT Date');
            } else if ($('input[name=mdt_dates_radio]:checked').val() === 'not_for_mdt' && !$('.report_option').is(':checked')) {
                alert('Please Select Add To Report OR Not To Add To Report');
            } else {
                if (!confirm('Do you want to add message for MDT.')) {
                    var form_data = $('#mdt_from_data').serialize();
                    jQuery.ajax({
                        url: '<?php echo base_url('/index.php/doctor/assign_mdt_record'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: form_data,
                        success: function (data) {
                            if (data.type === 'error') {
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            } else {
                                jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                                window.location.reload();
                            }
                        }
                    });
                } else {

                    var form_data = $('#mdt_from_data').serialize();
                    jQuery.ajax({
                        url: '<?php echo base_url('/index.php/doctor/assign_mdt_record'); ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: form_data,
                        success: function (data) {
                            if (data.type === 'error') {
                                jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            } else {
                                $('#mdt_data_modal').modal('hide');
                                setTimeout(function(){ $('#mdt_message_modal').modal('show'); }, 500);
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
                url: '<?php echo base_url('/index.php/doctor/add_mdt_message'); ?>',
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

        $(document).on('click', '#leave_mdt_notes_msg_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.parents('#mdt_message_modal').modal('hide');
            window.location.reload();
        });

        $(document).on('change', '#mdt_dates', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = $('#mdt_hospital_id').val();
            var mdt_date = _this.val();
            var mdt_list_id = _this.parents('.mdt_dates_content').find('.mdt_list').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_mdt_cases'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'mdt_date': mdt_date, 'list_id': mdt_list_id},
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

        $(document).on('change', '#mdt_dates_new', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = $('#mdt_hospital_id_new').val();

            var mdt_date = _this.val();
            var mdt_list_id = _this.parents('.mdt_dates_content').find('.mdt_list_new').val();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_mdt_cases_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'mdt_date': mdt_date, 'list_id': mdt_list_id},
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

        $(document).on('change', '#prev_mdt_dates', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = $('#prev_mdt_hospital_id').val();
            var mdt_date = $('#prev_mdt_dates').val();
            var mdt_list_id = _this.parents('.mdt_dates_content').find('.mdt_list').val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_prev_mdt_cases'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'prev_mdt_date': mdt_date, 'list_id': mdt_list_id},
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

        $(document).on('change', '#prev_mdt_dates_new', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = $('#prev_mdt_hospital_id_new').val();
            var mdt_date = $('#prev_mdt_dates_new').val();
            var mdt_list_id = _this.parents('.mdt_dates_content').find('.mdt_list').val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_prev_mdt_cases_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id, 'prev_mdt_date': mdt_date, 'list_id': mdt_list_id},
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

        $('#mdt_hospital_id').on('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_list_ajax_data').html(data.dates_data);
                    }
                }
            });
        });

        $('#mdt_hospital_id_new').on('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_mdt_dates_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_list_ajax_data').html(data.dates_data);
                    }
                }
            });
        });

        $(document).on('change', '.mdt_list', function (e) {
            e.preventDefault();
            var _this = $(this);
            var list_id = _this.val();
            var hospital_id = _this.data('hospitalid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_mdt_dates_on_mdt_lists'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'list_id': list_id, 'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data').html(data.dates_data);
                    }
                }
            });
        });

        $(document).on('change', '.mdt_list_new', function (e) {
            e.preventDefault();
            var _this = $(this);
            var list_id = _this.val();
            var hospital_id = _this.data('hospitalid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_mdt_dates_on_mdt_lists_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'list_id': list_id, 'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data').html(data.dates_data);
                    }
                }
            });
        });

        $('#prev_mdt_hospital_id').on('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_prev_mdt_dates'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_list_ajax_data_prev').html(data.dates_prev_data);
                    }
                }
            });
        });

        $('#prev_mdt_hospital_id_new').on('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var hospital_id = _this.val();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_prev_mdt_dates_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_list_ajax_data_prev').html(data.dates_prev_data);
                    }
                }
            });
        });
        $(document).ready(function() {
          $('#media').carousel({
            pause: true,
            interval: false,
          });
        });

        $(document).on('change', '.prev_mdt_list', function (e) {
            e.preventDefault();
            var _this = $(this);
            var list_id = _this.val();

            var hospital_id = _this.data('hospitalid');

            console.log(list_id + hospital_id);
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_prev_mdt_dates_on_mdt_lists'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'list_id': list_id, 'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data_prev').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data_prev').html(data.dates_data);
                    }
                }
            });
        });

        $(document).on('change', '.prev_mdt_list_new', function (e) {
            e.preventDefault();
            var _this = $(this);
            var list_id = _this.val();
            var hospital_id = _this.data('hospitalid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/find_prev_mdt_dates_on_mdt_lists_new'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'list_id': list_id, 'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data_prev').html('');
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        _this.parents('.mdt_dates_content').find('.mdt_dates_ajax_data_prev').html(data.dates_data);
                    }
                }
            });
        });

        $("#close_popups_for_mdt").on('click', function (e) {
            e.preventDefault();
            closeModel();
        });

        function closeModel() {
            $('#display_iframe_pdf, #user_auth_popup').modal('toggle');
        }

        $('.related-doc-collapse-section .hover_image').hover(function (e) {
            e.preventDefault();
            var _this = $(this);
            ext_type = _this.data('exttype');
            image_url = _this.data('imageurl');
            _this.next('.hover_' + ext_type).attr('src', image_url);
            _this.next('.hover_' + ext_type).show();
        });

        $('.related-doc-collapse-section #close_hover_image').on('click', function (e) {
            ext_type = $('.hover_image').data('exttype');
            e.preventDefault();
            $('.hover_image_frame').hide();
        });

        $(document).ready(function () {
            $('#add_to_authorization').on('click', function (e) {
                e.preventDefault();
                var _this = $(this);
                var record_id = _this.data('recordid');
                $.ajax({
                    url: '<?php echo base_url('/index.php/doctor/add_record_to_authorization'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: {'record_id': record_id},
                    success: function (data) {
                        if (data.type === 'success') {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        }
                    }
                });

            });

        //    Pathological Finding add/remove fields
            var pathology_max_fields      = 10; //maximum input boxes allowed
            var pathology_wrapper   		= $(".path_f_fields_wrap"); //Fields wrapper
            var pathology_add_button      = $(".add_path_f_field"); //Add button ID

            var x = 1; //initlal text box count
            $(pathology_add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < pathology_max_fields){ //max input box allowed
                    x++; //text box increment
                    $(pathology_wrapper).append('' +
                        '<tr>' +
                        '<td width="90%"><input type="text" name="ap_pathological_finding[]" placeholder="Pathological Finding" class="form-control" /> </td>' +
                        '<td><a href="javascript:void(0)" class="pathology_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>' +
                        '</tr>'); //add input box
                }
            });

            $(pathology_wrapper).on("click",".pathology_remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).closest("tr").remove(); x--;
            });



            //    Histopathological Finding add/remove fields
            var h_pathology_max_fields      = 10; //maximum input boxes allowed
            var h_pathology_wrapper   		= $(".h_path_f_fields_wrap"); //Fields wrapper
            var h_pathology_add_button      = $(".add_h_path_f_field"); //Add button ID

            var x = 1; //initlal text box count
            $(h_pathology_add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < h_pathology_max_fields){ //max input box allowed
                    x++; //text box increment
                    $(h_pathology_wrapper).append('' +
                        '<tr>' +
                        '<td width="90%"><input type="text" name="ap_histopathological_finding[]" placeholder="Histopathological Finding" class="form-control" /> </td>' +
                        '<td><a href="javascript:void(0)" class="h_pathology_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>' +
                        '</tr>'); //add input box
                }
            });

            $(h_pathology_wrapper).on("click",".h_pathology_remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).closest("tr").remove(); x--;
            });

            //    Cause of Death add/remove fields
            var c_death_max_fields      = 10; //maximum input boxes allowed
            var c_death_wrapper   		= $(".c_death_fields_wrap"); //Fields wrapper
            var c_death_add_button      = $(".add_c_death_field"); //Add button ID

            var x = 1; //initlal text box count
            var count_exitisng_fields = $('#dt_fields_count').val();
            if(count_exitisng_fields>1){
                x = count_exitisng_fields-1;
            }
            $(c_death_add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < c_death_max_fields){ //max input box allowed
                    var label = '1a';
                    if(x==1){
                        label='1b';
                    }else if(x==2){
                        label='1c';
                    }else{
                        label=2;
                    }
                    $(c_death_wrapper).append('' +
                        '<tr>' +
                        '<td width="100%" class="form-inline"><label> '+label+' </label> <input type="text" name="ap_cause_of_death[]" placeholder="'+label+'" class="form-control ml-2" style="width: 92%;" /> </td>' +
                        '<td><a href="javascript:void(0)" class="c_death_remove_field btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></td>' +
                        '</tr>'); //add input box

                    x++; //text box increment
                }
            });

            $(c_death_wrapper).on("click",".c_death_remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).closest("tr").remove(); x--;
            });
        });

        $(document).on('click', '#show_pdf_iframe', function (e) {
            e.preventDefault();
            $('#display_iframe_pdf').modal('show');
        });

        $('#user_auth_popup').on('shown.bs.modal', function () {
            check_surname();
        });

        var specimen_microscopic_suggest = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/doctor/microscopic_autosuggest?query=%QUERY'); ?>',
                wildcard: '%QUERY',
                transform: function (specimen_microscopic_suggest) {
                    return $.map(specimen_microscopic_suggest, function (items) {
                        return {
                            umc_id: items.umc_id,
                            umc_code: items.umc_code,
                            umc_added_by: items.umc_added_by
                        };
                    });
                }
            }
        });

        var timer;
        $('.doctor_update_specimen input.specimen_microscopic_code').typeahead({
            minLength: 1,
            highlight: true
        },
        {
            name: 'specimen_microscopic_code',
            source: specimen_microscopic_suggest,
            display: function (item) {
                return item.umc_code;
            },
            limit: 30,
            templates: {
                suggestion: function (item) {
                    return '<div class="'+item.umc_added_by+'">' + item.umc_code + '</div>';
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
            var form_id = _this.data('formid');
            var micro_code = selection.umc_code;
            $("#ajax_loading_effect").fadeIn();
            _this.attr('data-microcodeid', selection.umc_id);
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/doctor/set_populate_micro_data'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'micro_code': micro_code},
                    beforeSend: function () {
                        // $("#ajax_loading_effect").fadeIn();
                    },
                    success: function (data) {
                        if (data.type === 'error') {
                            $("#ajax_loading_effect").fadeOut();
                        } else {
                            window.setTimeout(function () {
                                // console.log(data); return false;
                                $.each(data, function (index, value) {
                                    if (index === 'umc_classification') {
                                        var classification = value;
                                        classification_array = classification.split(',');
                                        var specimen_check_val = _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_classification');
                                        $(specimen_check_val).each(function (index, value) {
                                            var _this = $(this);
                                            var classification_value = _this.val();

                                            if ($.inArray(classification_value, classification_array) !== -1) {
                                                _this.prop('checked', true);
                                            }
                                        });
                                    }
                                     else if (index === 'umc_snomed_m_code') {
                                        var snomed_m_code = value;
                                        snomed_m_code_array = snomed_m_code.split(',');
                                        var snomed_m_code_val = _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_snomed_m_'+form_id);
                                        $(snomed_m_code_val).selectpicker();
                                        $(snomed_m_code_val).selectpicker('val', snomed_m_code_array);
                                        $('#snomed-values-'+form_id).find('.snomed-m').text(value);

                                        var snome_multi_selected_vals = $('#doctor_update_specimen_record_' + form_id).find(".specimen_snomed_m_"+form_id+" option:selected");
                                        console.log(snome_multi_selected_vals);
                                        var snomedDiagnosesArr = [];
                                        var snomedVals = [];
                                        var rcpathScore = [];
                                        $.each( snome_multi_selected_vals, function( parent_key, parent_value ) {
                                            snomedDiagnosesArr = $(this).data('diagnoses').split(',');
                                            rcpathScore[parent_key] = $(this).data('rcpath');
                                        });
                                        var snomedCheckBox = jQuery('#doctor_update_specimen_record_' + form_id).find('.specimen_classification_'+form_id);
                                        $.each( snomedDiagnosesArr, function( key, value ) {
                                            $.each( snomedCheckBox, function( input_key, input_value ) {
                                                if(typeof value !== 'undefined' && value == $(this).val()){
                                                    $(this).prop('checked', true);
                                                }
                                            });
                                        });

                                        var rcpathMaxVal = Math.max.apply(Math, rcpathScore);
                                        jQuery('#doctor_update_specimen_record_'+form_id).find('.rcpath_codedata_' + form_id).val(rcpathMaxVal);

                                    } else {
                                        if (index === 'umc_micro_desc') {
                                            // console.log("Here in Micro Desc condition"); return false;
                                            tinymce.get("specimen_microscopic_description_"+form_id).setContent(value);
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find("#specimen_microscopic_description_"+form_id).val(value);
                                        }
                                        if (index === 'umc_rcpath_score') {
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find('.rcpath_codedata_' + form_id).val(value);
                                        }
                                    }
                                });
                                $("#ajax_loading_effect").fadeOut();
                            }, 500);

                            window.setTimeout(function(){
                                $('#doctor_update_specimen_record_' + form_id).find('.specimen-micro-area .change-micro-btn').show();
                                var micro_desc = _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_'+form_id).val().match(/\sX\s|\sx\s/g);
                                if(micro_desc != null && micro_desc.length != 0){
                                    _this.parents('#doctor_update_specimen_record_' + form_id).find('#change-micro-x-val-'+form_id).modal('show');
                                }
                            }, 1000);

                            $(document).on('click', '.btn-add-x-val', function(e) {
                                    e.preventDefault();
                                    var _this = $(this);
                                    var inputXVal = _this.parents('#change-micro-x-val-'+form_id).find('input[name=micro_x_val]').val();

                                    var micro_desc = _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_'+form_id).val();
                                    micro_desc = micro_desc.replace(/\sX\s|\sx\s/, ' '+inputXVal+' ');
                                    _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_'+form_id).val(micro_desc);
                                    _this.parents('#change-micro-x-val-'+form_id).modal('hide');
                                    _this.parents('#change-micro-x-val-'+form_id).find('input[name=micro_x_val]').val('');
                            });

                            $('#change-micro-x-val-'+form_id).on('hidden.bs.modal', function(){
                                var micro_desc = _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_'+form_id).val().match(/\sX\s|\sx\s/g);
                                if(micro_desc != null && micro_desc.length != 0){
                                    _this.parents('#doctor_update_specimen_record_' + form_id).find('#change-micro-x-val-'+form_id).modal('show');
                                }
                            });
                        }
                    }
                });
            }, 1000);
        });
        $('#microscopic_code_table').DataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $('#snomed_t1_code_table, #snomed_t2_code_table, #snomed_p_code_table, #snomed_m_code_table, #snomed_s_code_table').DataTable({
            ordering: false,
            stateSave: true,
            lengthChange: true,
            autoWidth: true,
            processing: true,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $('#snomed_t1_code_table_wrapper').find('#snomed_t1_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
        $('#snomed_t2_code_table_wrapper').find('#snomed_t2_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
        $('#snomed_p_code_table_wrapper').find('#snomed_p_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');
        $('#snomed_m_code_table_wrapper').find('#snomed_m_code_table_filter').parent('div').removeClass('col-sm-6').addClass('col-sm-12');

        $(document).on('click', '.btn-spcimen-add', function(e){
            e.preventDefault();
            var _this = jQuery(this);
            _this.parents('#add_specimen_modal').find('.specimen_form').submit();
        });

        var authTable = $('#record_list_table_authorization').dataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });

        $(document).on('click', '#authorization_pdf_iframe', function (e) {
            e.preventDefault();
            var _this = $(this);
            _this.next('#display_iframe_pdf').modal('show');
        });

        $(document).on("click", "#publish_bulk_authorization_reports", function (e) {
            if (!$('#record_list_table_authorization .publish_bulk_authroization').is(':checked')) {
                if (!confirm('Please Checked the records which you want to publish.')) {
                    return false;
                }
            } else {
                $('#bulk_authorization_publish').modal('show');
            }
        });

        $('#check_pass_authorization_bulk').on('click', function (e) {
            e.preventDefault();
            var _this = $(this);
            var password1 = $('#auth_password1').val();
            var password2 = $('#auth_password2').val();
            var password3 = $('#auth_password3').val();
            var password4 = $('#auth_password4').val();
            check_value = [];
            $("#record_list_table_authorization input[type=checkbox]:checked").each(function () {
                check_value.push($(this).val());
            });
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url('/index.php/doctor/publish_bulk_reports_authrization'); ?>",
                data: {password1: password1, password2: password2, password3: password3, password4: password4, record_ids: check_value},
                dataType: "json",
                success: function (response) {
                    if (response.type === 'success') {
                        _this.parents('.user_auth_popup').find('#publish_button').html(response.message);
                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        _this.parents('.user_auth_popup').find('#publish_button').html(response.message);
                    }
                }
            });
        });

        $('.hide_lab_name').hide();
        $(document).on('change', '.lab_name', function (e) {
            e.preventDefault();
            var inputName = $(this).attr('name');
            var _this = $(this);
            var lab_value = _this.find(':selected').val();

            if (lab_value === 'U') {
                $('.hide_lab_name').show();
                $('#lab_number').inputmask('remove');
            } else {
                var lab_id = _this.find(':selected').data('labnameid');
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/doctor/search_lab_number_mask'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'lab_id': lab_id,'inputName' : inputName, 'request_id': $(document).find('#record_id').val()},
                    success: function (data) {
                        if (data.type === 'error') {
                            $('.hide_lab_name').hide();
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        } else {
                            $('.hide_lab_name').show();
                            /*Making lab number as a mask input.*/
                            var selector = document.getElementById("lab_number");
                            Inputmask(data.lab_mask).mask({selector});
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            $('#lab_number').trigger("keyup");
                        }
                        if(inputName === 'lab_report'){
                            setTimeout(function(){
                                location.reload();
                            },1000);
                        }
                    }
                });
            }
        });

        var timer;
        $('#doctor_update_personal_record').on('keyup', '#lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var lab_number = _this.val();
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/doctor/find_lab_number_records'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'lab_number': lab_number, 'request_id': $(document).find('#record_id').val()},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            _this.parents('#doctor_update_personal_record').find('#update_doctor_personal_report_btn').hide();
                        } else {
                            $('.addBlockButton').attr("data-labno", lab_number);
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            _this.parents('#doctor_update_personal_record').find('#update_doctor_personal_report_btn').show();
                        }
                    }
                });
            }, 1200);
        });

        $('#show_mdt_notes').on('click', '.delete_mdt_note', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/delete_mdt_record_note'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/add_mdt_record_note_on_report'); ?>',
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

        var date = new Date();
        var opinion_date = moment(date).format('DD-MM-YYYY h:mm:ss A');
        $('#opinion_reply_date').val(opinion_date);
        $(document).on('click', '.request_for_opinion', function (e) {
            e.preventDefault();
            var _this = $(this);
            var date = new Date();
            var slot_date = moment(date).format('DD-MM-YYYY h:mm:ss A');
            _this.parents('.uralensis_icons_actions').find('#request_for_opinion').modal('show');
            _this.parents('.uralensis_icons_actions').find('#request_for_opinion #opinion_date').val(slot_date);
            _this.parents('.uralensis_icons_actions').find('#request_for_opinion #opinion_date_hide').val(slot_date);
        });
        $(document).on('click', '.lab_email_request', function (e) {
            e.preventDefault();
            var _this = $(this);
            var date = new Date();
            var slot_date = moment(date).format('DD-MM-YYYY h:mm:ss A');
            _this.parents('.uralensis_icons_actions').find('#lab_email_request_modal').modal('show');
            _this.parents('.uralensis_icons_actions').find('#request_for_opinion #opinion_date').val(slot_date);
            _this.parents('.uralensis_icons_actions').find('#request_for_opinion #opinion_date_hide').val(slot_date);
        });

        $('.opinion_cases_form').on('click', '.assign_to_opinion_case', function (e) {
            e.preventDefault();
            var opinion_form = $('.opinion_cases_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/assign_opinion_cases'); ?>',
                type: 'POST',
                dataType: 'json',
                data: opinion_form,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload()
                        }, 1800);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
        });

        $(document).on('click', '.request_send_email', function (e) {
            e.preventDefault();
            var opinion_form = $('#request_email_form').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('doctor/send_request_email'); ?>',
                type: 'POST',
                dataType: 'json',
                data: opinion_form,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            location.reload()
                        }, 1800);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
        });

        $('.opinion_cases_comment').on('click', '.add_opinion_reply', function (e) {
            e.preventDefault();
            var opinion_reply = $('.opinion_cases_comment').serialize();
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/save_opinion_reply'); ?>',
                type: 'POST',
                dataType: 'json',
                data: opinion_reply,
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        window.setTimeout(function () {
                            // location.reload();
                            window.location.href = "<?php echo base_url('doctor/doctor_opinion_cases'); ?>";
                        }, 1800);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
        });
        $('.opinion_cases_comment').on('click', '.btn-commment-delete', function (e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('/index.php/doctor/delete_opinion_reply'); ?>',
                data: {dataId: dataId, [csrf_name]: csrf_hash},
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.type === 'success') {
                        $.sticky(response.msg, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        location.reload();
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
        $('.opinion_cases_comment').on('click', '.btn-commment-like', function (e) {
            e.preventDefault();
            var thisC = $(this);
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('/index.php/doctor/save_opinion_comment_like'); ?>',
                data: {dataId: dataId, [csrf_name]: csrf_hash},
                dataType: "json",
                success: function (response) {
                    thisC.removeClass("btn-primary");
                    thisC.addClass("disabled btn-success");
                    // var specimenId = $('#block_specimen_id').val();
                    // if (response.type === 'success') {
                    //     $.sticky(response.msg, {
                    //         classList: 'success',
                    //         speed: 200,
                    //         autoclose: 7000
                    //     });
                    //     location.reload();
                    // } else {
                    //     $.sticky(response.msg, {
                    //         classList: 'important',
                    //         speed: 200,
                    //         autoclose: 7000
                    //     });
                    // }
                }
            });
        });
        $('.opinion_cases_comment').on('click', '.btn-commment-edit', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $("#opinion_reply_label").offset().top
            }, 2000);
            var opinion_id = $(this).attr("data-id");
            var opinion_comment = $(this).prev(".opinion_commentss").text();
            $("#is_opinion_id").val(opinion_id);
            $("#opinion_reply").val(opinion_comment);
            $("#is_edit_status").val(1);
            $(".btn_reply_cancel").show();
            $(".add_opinion_reply").text("Save");
        });
        $('.opinion_cases_comment').on('click', '.btn_reply_cancel', function (e) {
            e.preventDefault();
            $("#opinion_reply").val("");
            $("#is_edit_status").val(0);
            $(".btn_reply_cancel").hide();
            $(".add_opinion_reply").text("Reply");
        });

        $(document).on('change', '.specimen_snomed_m', function (e) {
            e.preventDefault();
            var _this = $(this);
            var snomed_value = _this.val();
            var snomed_m = '';
            if (snomed_value != '' && snomed_value != null) {
                snomed_m = snomed_value.toString();
            }

            _this.parents('.doctor_update_specimen').find('.snomed_m_value').val(snomed_m);
        });

        var count = 0;
        $(document).on('click', '.change_status_color', function (e) {
            e.preventDefault();
            var _this = $(this);
            var input_key = _this.parents('div').data('key');
            var record_data = '&key=' + input_key + '&' + $('#doctor_update_personal_record').serialize();
            var edit_mode = $("#make_editable").hasClass('enable');
		//alert(record_data);
            // Change color even in lock mode
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_input_change_color'); ?>',
                type: 'POST',
                dataType: 'json',
                data: record_data,
                success: function (data) {
                    if (data.type === 'success') {
                        $(".svg_"+input_key).children('circle').css({'fill': data.color_code, 'stroke': data.color_code});
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                    }
                }
            });
            // if ($("#make_editable").hasClass('enable')) {
            // } else {
            //     jQuery.sticky('Please enable the fields first.', {classList: 'important', speed: 200, autoclose: 5000});
            // }
        });
        $(document).on('change', '#ref_lab_number', function (e) {
            e.preventDefault();
            var _this = $(this);
            var ref_lab_number = _this.val();
            clearInterval(timer);
            // timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/doctor/updateRefLabNumber'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {[csrf_name]: csrf_hash,'ref_lab_number': ref_lab_number, 'request_id': $(document).find('#record_id').val()},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            _this.parents('#doctor_update_personal_record').find('#update_doctor_personal_report_btn').hide();
                        } else {
                            $('.addBlockButton').attr("data-labno", lab_number);
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                            _this.parents('#doctor_update_personal_record').find('#update_doctor_personal_report_btn').show();
                        }
                    }
                });
            // }, 1200);
        });
		 $(document).on('click', '#p_save_area', function (e) {
            e.preventDefault();
            var _this = $(this);
            var input_key = _this.parents('div').data('key');
            var record_data = '&key=' + input_key + '&' + $('#doctor_update_personal_record').serialize();
            var edit_mode = $("#make_editable").hasClass('enable');
		//alert(record_data);
            // Change color even in lock mode
            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_input_change_color'); ?>',
                type: 'POST',
                dataType: 'json',
                data: record_data,
                success: function (data) {
                    if (data.type === 'success') {
                        $(".svg_"+input_key).children('circle').css({'fill': data.color_code, 'stroke': data.color_code});
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                    }
                }
            });
            // if ($("#make_editable").hasClass('enable')) {
            // } else {
            //     jQuery.sticky('Please enable the fields first.', {classList: 'important', speed: 200, autoclose: 5000});
            // }
        });

        jQuery(document).on('change', '.dataset-form-html input[type=checkbox]', function(){
            var _this = $(this);
            if(_this.is(':checked')){
                _this.attr('checked', 'checked');
            }else{
                _this.removeAttr('checked');
            }
        });

        jQuery(document).on('click', '.moveable_text', function (e) {
            e.preventDefault();
            var _this = jQuery(this);
            var specimen_id = _this.data('datasetspecimenid');
            var record_id = _this.data('recordid');
            var form_html = document.querySelector('.dataset-form-html').innerHTML;

            tinymce.get("specimen_microscopic_description_"+specimen_id).setContent('<div class="form">'+form_html+'</div>');
            var form_data = jQuery('.dataset_form').serialize();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_microscopic_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'form_data' : form_html, 'record_id' : record_id},
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                    }
                }
            });
        });

        var interval = 2000; // 1000 = 1 second, 3000 = 3 seconds
        var url = window.location.href;
        var url_split = url.split('/');
        xhr = new window.XMLHttpRequest();

        var record_id = url_split[7];
        function doAjaxRequest() {
            if (url_split[6] === 'doctor_record_detail') {
                xhr = $.ajax({
                    url: '<?php echo base_url('/index.php/doctor/save_user_view_status'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {'user_status': 'view'},
                    success: function (response) {

                    },
                    complete: function (response) {
                        setTimeout(doAjaxRequest, interval);
                    }
                });
            }
        }
        setTimeout(doAjaxRequest, interval);
        jQuery(document).on('change', '.microscopicCode', function(){
            var formId = $(this).attr('data-formid');
            tinymce.get("specimen_microscopic_description_"+formId).setContent('');
            var description = '';
            $('#microscopicCodeId'+formId+' > option:selected').each(function() {
                description += '<p>'+$(this).attr('data-tdesc')+'</p>';
                console.log()
            });
            tinymce.get("specimen_microscopic_description_"+formId).setContent(description);
            $(this).parents('#doctor_update_specimen_record_' + formId).find("#specimen_microscopic_description_1").val(description);
            jQuery('#doctor_update_specimen_record_' + formId).trigger('submit');
            //$('#doctor_update_specimen_record_'+parseInt(formId) - 1).submit();
        });
        jQuery(document).on('change', '.billing_type', function(){
            let typeID = $(this).val();
            let applidDiv = $(this).closest('.tg-tabfieldsettwo');
            if(typeID == 'not_billed'){
                applidDiv.find('.specimen_bill_div').hide();
                applidDiv.find('.add_new_bill').hide();
            }else{
                applidDiv.find('.specimen_bill_div').show();
                applidDiv.find('.add_new_bill').show();
            }
        });

        jQuery(document).on('click', '.delete_billing', function(){
            let delete_url = $(this).attr('data-url');
            $('#delete_billing_modal').modal('show');
            $('.billing-delete-btn').attr('href', delete_url);
        });

        jQuery(document).on('keypress', '.numberonly', function (e){
            var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
        });

        jQuery(document).on('click', '.read_hl7', function () {
            let patientID = $(this).attr('data-pid');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('patient/read_hl7_file'); ?>',
                data: { id: patientID, [csrf_name]: csrf_hash },
                dataType: "json",
                success: function (response){
                    if (response.status === 'success') {
                        let modalDiv = $('#patient_hl7');
                        modalDiv.modal('show');
                        modalDiv.find('.pdata').text('');
                        modalDiv.find('#hl7_title').text(response.title);
                        modalDiv.find('#hl7_content').text(response.data);
                    } else {
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
        });

        jQuery(document).on('click', '.download_hl7', function () {
            let patientID = $(this).attr('data-pid');
            $.ajax({
                type: "POST",
                url: '<?php echo base_url('patient/download_hl7_file'); ?>',
                data: { id: patientID, [csrf_name]: csrf_hash },
                dataType: "json",
                success: function (response){
                    if (response.status === 'success') {
                        window.open(response.download_url, '_blank');
                        //$(document).find('#download_hl7_url').attr('href', response.download_url).trigger('click');
                        //window.location.href = response.download_url;
                    } else {
                        jQuery.sticky(response.message, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
        });
    });

    var site_url = '<?php echo base_url(); ?>';

    $('body').on('change', '.clinic_list', function(){
        let org_site = $(this).find('option:selected').attr('data-org-site');
        let org_identifier = $(this).find('option:selected').attr('data-org-identifier');

        $(document).find('#organisation_site_identifier').val(org_site);
        $(document).find('#organisation_identifier').val(org_identifier);

        $(document).find('#org_site_identifier_text').text(org_site);
        $(document).find('#org_identifier_text').text(org_identifier);

        let clinic_id = Number($(this).val());
        on_clinic_change(clinic_id, false);
    });

    function on_clinic_change(clinic_id, triggerEvent=true){
        let userId = '<?php echo $this->session->userdata('user_id'); ?>';
        $(document).find('#clinic_id').val(clinic_id);
        $.get(site_url + 'doctor/get_bill_codes/' + clinic_id + '/' + userId, function (data) {
            let option = $(`<option value="">Select Request ID</option>`);
            for (res of data) {
                option += `<option data-description="${res.description}" data-price="${res.price}"  value="${res.id}" >${res.code}</option>`;
            }
            $('.bill_code').find('option').remove().end().append(option);
            $(document).find('.bill_code_display1').hide();
            $(document).find('.bill_code_display2').show();
            if(triggerEvent){
                $(document).find('.bill_code_id').each(function(index){
                    let selectedBill = $(this).val();
                    $(this).closest('.form-group').find('.bill_code_display2 option').removeAttr('selected').filter('[value="'+ selectedBill +'"]').attr('selected', true).parents('select').trigger('change');
                });
                // let selectedBill = $(document).find('#bill_code_id').val();
                // $('.bill_code_display2 option').removeAttr('selected').filter('[value="'+ selectedBill +'"]').attr('selected', true).parents('select').trigger('change');
            }else{
                $(document).find('.bill_code_display2').trigger('change');
            }
        });
    }

function save_case_request(id)
{
    setTimeout(function(){
        //var _this = document.getElementById(id);
        //var input_key = _this.parents('div').data('key');
        var input_key =id;
        var record_data = '&key=' + input_key + '&' + $('#doctor_update_personal_record').serialize();
        var edit_mode = $("#make_editable").hasClass('enable');

        // Change color even in lock mode
        jQuery.ajax({
            url: '<?php echo base_url('/index.php/doctor/set_input_change_color'); ?>',
            type: 'POST',
            dataType: 'json',
            data: record_data,
            success: function (data) {
                if (data.type === 'success')
                {
                   // alert(data.msg)
                    //$(".svg_"+input_key).children('circle').css({'fill': data.color_code, 'stroke': data.color_code});
                    jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                    if(id == 'hos_id'){
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                }
            }
        });
    },500);
}

function updateStatus(row)
{
    var r_status = $(row).val();
    // Change color even in lock mode
    jQuery.ajax({
        url: '<?php echo base_url('/index.php/doctor/updateRequestStatus'); ?>',
        type: 'POST',
        dataType: 'json',
        data: {'r_status' : r_status, [csrf_name]: csrf_hash, 'record_id' : $('#record_id').val()},
        success: function (data) {
            if (data.status === 'success')
            {
                $.post(_base_url+'tracking/update_track_status', {
                    lab_number: $('#lab_number').val(),
                    status: r_status,
                    [csrf_token_name]: csrf_cookie
                }, function(data) {
                    console.log(data);
                    if (data.status == 'success') {
                        // message('Track Status Updated', true);
                        // update_record_history_table();
                        jQuery.sticky('Status has been updated successfully!!!', {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else{
                        //message('Record with this lab number does not exists', false);
                    }
                }).fail(function(err) {
                    console.log(err);
                   // message('Track Status Cannot be updated at the moment', false);
                });
                //$(".svg_"+input_key).children('circle').css({'fill': data.color_code, 'stroke': data.color_code});
                jQuery.sticky('Status has been updated successfully!!!', {classList: 'success', speed: 200, autoclose: 5000});
            }
        }
    });
}

function add_table_data(data) {
    var row = $("<tr></tr>");
    row.append('<td>'+data['ref']+'</td>');
    row.append('<td>'+data['date']+'</td>');
    // row.append('<td>'+data['time']+'</td>');
    row.append('<td>'+data['status']+'</td>');
    row.append('<td><img class="img-fluid avatar" src="'+data['user_id']+'"></td>');
    $("#record-history-table").find('tbody').append(row);
    $("#qr-code-input").focus();
}

function add_block_table_data(data) {
    var row = $("<tr></tr>");
    row.append('<td>'+data['ref']+'</td>');
    row.append('<td>'+data['date']+'</td>');
    // row.append('<td>'+data['time']+'</td>');
    row.append('<td>'+data['status']+'</td>');
    row.append('<td><img class="img-fluid avatar" src="'+data['user_id']+'"></td>');
    $("#record-block-table").find('tbody').append(row);
}

var current_status = null;

function update_record_history_table() {
    $("#record-history-table").find('tbody').html('');
    $.get(_base_url+`tracking/get_record_history?lab_number=${encodeURIComponent($('#lab_number').val())}`, function(data) {
        if (data.status == 'success') {

            if (data.history.length == 0) {
                 $("#dv_add_remove_class").removeClass('col-lg-8');
                    $("#dv_add_remove_class").addClass('col-lg-12');
                    $("#dv_lab_rec_history").hide();

                $("#record-history-table-heading").html('No Recorded History');
            }else{
                console.log(data.track_status);
               $("#dv_add_remove_class").removeClass('col-lg-12');
                    $("#dv_add_remove_class").addClass('col-lg-8');
                    $("#dv_lab_rec_history").show();
                if (current_status ===  null && data.track_status.length > 0) {
                    var track_status = data.track_status;
                    track_status = track_status.toLowerCase();
                    track_status = track_status.replaceAll(/[^a-zA-Z ]/g, "");
                    track_status = track_status.replaceAll(/\s\s+/g, ' ');
                    track_status = track_status.replaceAll(' ', '-');
                    console.log(track_status);
                    var btn = $("#"+track_status);
                    // select_circle(btn);
                }
                data.history.forEach(function(history) {
                    var user_id = history['rec_history_user_id'];
                    var u_id = '';
                    jQuery.ajaxSetup({async:false});
                    $.get(_base_url+'tracking/get_userid/'+user_id, function(data){
                        if (data.status == 'success') {
                            u_id = data['userid'];
                        }
                    }).always(function() {
                        var status = '';
                        if (history['rec_history_status'] == 'publish') {
                            status = 'Published'
                        }

                        if (history['rec_history_status'] == 'edit') {
                            status = 'Edited'
                        }

                        if (history['rec_history_status'] == 'fw_add') {
                            status = 'Further word requested'
                        }
                        if (history['rec_history_status'] == 'unpublish') {
                            status = 'Unpublished'
                        }

                        if (history['rec_history_status'] == 'track_status') {
                            status = 'Move to '+ history['rec_history_data'];
                        }

                        var ts = history['timestamp'];
                        var d = moment(new Date(parseInt(ts) * 1000));
                        var dt =  d.calendar("D/M/Y") + " " + d.format("hh:mm a");
                        var tm = d.format("hh:mm a");
                        add_table_data({
                            ref: history['ura_rec_history_id'],
                            date: ts,
                            time: tm,
                            status: status,
                            user_id: u_id
                        });
                    });
                    jQuery.ajaxSetup({async:true});
                });
            }
        }
        else
            message('Record does not exists with this lab number', false);
    }).fail(function(err) {
        console.log("Error loading data");
        console.log(err);
        message('Something went wrong', false);
    });
}


function update_block_history_table() {
    $("#record-block-table").find('tbody').html('');
    $.get(_base_url+`tracking/get_block_history?requestId=${encodeURIComponent($('#requestId').val())}`, function(data) {
        if (data.status == 'success') {
            console.log(data.history.length,"dasda")
            if (data.history.length == 0) {
                 $("#dv_add_remove_class").removeClass('col-lg-8');
                    $("#dv_add_remove_class").addClass('col-lg-12');
                    $("#dv_lab_rec_history").hide();

                $("#record-block-table-heading").html('No Recorded History');
            }else{
                // console.log(data.track_status);
            //    $("#dv_add_remove_class").removeClass('col-lg-12');
            //         $("#dv_add_remove_class").addClass('col-lg-8');
            //         $("#dv_lab_rec_history").show();
                // if (block_status ===  null && data.track_status.length > 0) {
                //     var track_status = data.track_status;
                //     track_status = track_status.toLowerCase();
                //     track_status = track_status.replaceAll(/[^a-zA-Z ]/g, "");
                //     track_status = track_status.replaceAll(/\s\s+/g, ' ');
                //     track_status = track_status.replaceAll(' ', '-');
                //     console.log(track_status);
                //     var btn = $("#"+track_status);
                //     // select_circle(btn);
                // }
                data.history.forEach(function(history) {
                    var user_id = history['rec_history_user_id'];
                    var u_id = '';
                    jQuery.ajaxSetup({async:false});
                    $.get(_base_url+'tracking/get_userid/'+user_id, function(data){
                        if (data.status == 'success') {
                            u_id = data['userid'];
                        }
                    }).always(function() {
                        var status = '';
                        if (history['rec_history_status'] == 'add_block') {
                            status = 'Block - <b>'+history['rec_history_data']+'</b> has been added.'
                        }

                        if (history['rec_history_status'] == 'delete_block') {
                            status = 'Block - <b>'+history['rec_history_data']+'</b> has been deleted.'
                        }

                        if (history['rec_history_status'] == 'add_test') {
                            status = 'Test - <b>'+history['rec_history_data']+'</b> has been added.'
                        }
                        if (history['rec_history_status'] == 'delete_test') {
                            status = 'Test - <b>'+history['rec_history_data']+'</b> has been deleted'
                        }

                        if (history['rec_history_status'] == 'print_slide') {
                            status = 'Block <b>' + history['rec_history_data']+'</b> Slide print requested.';
                        }

                        if (history['rec_history_status'] == 'print_cassete') {
                            status = 'Block <b>'+history['rec_history_data']+'</b> Cassette print requested.';
                        }

                        var ts = history['timestamp'];
                        var d = moment(new Date(parseInt(ts) * 1000));
                        var dt =  d.calendar("D/M/Y") + " " + d.format("hh:mm a");
                        var tm = d.format("hh:mm a");
                        add_block_table_data({
                            ref: history['ura_rec_history_id'],
                            date: ts,
                            time: tm,
                            status: status,
                            user_id: u_id
                        });
                    });
                    jQuery.ajaxSetup({async:true});
                });
            }
        }
        else
            message('Record does not exists with this lab number', false);
    }).fail(function(err) {
        console.log("Error loading data");
        console.log(err);
        message('Something went wrong', false);
    });
}


    function get_authorized_cases_ajax(period, doctor_id){

    }

    $(document).ready(function () {

        $(".select2").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });
        $(".select2_snomed_1").select2({
            placeholder: 'Nothing Selected',
            width: '100%'
        });

        $(".select_multiple_imgs").select2({
            placeholder: 'Nothing Selected',
            width: '100%',
            templateResult: formatUsersList,
            templateSelection: formatUsersList
        });

        function formatUsersList (user) {
            // console.log(user);
            if (!user.id) {
                return user.text;
            }
            var picture_path = user.element.title;
            var base_url = '<?php echo base_url(); ?>';
            var full_picture_path = base_url + "/" + picture_path;


            var $user_option = $(
                '<span ><img style="display: inline-block;" width="30" height="30" src="' + full_picture_path + '" /> ' + user.text + '</span>'
            );
            return $user_option;
        }

        $('input[name=barcode_no]').focus();
        $('input[name=barcode_no]').bind('change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var barcode = _this.val();
            var search_type = 'ura_barcode_no';
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/search_barcode_record'); ?>',
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
                        _this.parents('.specimen_tracking_form').find('.doctor_slides_ajax_data').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.doctor_released_slides_ajax_data').html(response.encode_status_data_2);
                    } else {
                        _this.parents('.tg-trackrecords').next('.row').find('.load-track-record-data').html('');
                        _this.parents('.specimen_tracking_form').find('.doctor_slides_ajax_data').html('');
                        _this.parents('.specimen_tracking_form').find('.doctor_released_slides_ajax_data').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});

                    }
                }
            });
        });

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
                        $('.find_barcode_result').html(response.encode_data);
                        _this.parents('.specimen_track_search').find('.add_specimen_wrap').html('');
                        $('input[name=tracking_no_ul]').val('');
                        $('input[name=tracking_no_ul]').focus();
                        _this.parents('.specimen_tracking_form').find('.doctor_slides_ajax_data').html(response.encode_status_data_1);
                        _this.parents('.specimen_tracking_form').find('.doctor_released_slides_ajax_data').html(response.encode_status_data_2);
                    } else {
                        $('.find_barcode_result').html('');
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        _this.parents('.specimen_tracking_form').find('.doctor_slides_ajax_data').html('');
                        _this.parents('.specimen_tracking_form').find('.doctor_released_slides_ajax_data').html('');
                    }
                }
            });
        });

        $(document).on('click', '.doctor_slides_booked_in', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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

        $(document).on('click', '.doctor_released_slides_back_to_lab', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('recordid');
            var status_key = _this.data('statuskey');
            var barcode_no = _this.data('barcode');
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/set_doctor_record_history_track_status'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/search_hospital_group_users'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'hospital_id': hospital_id},
                success: function (data) {
                    if (data.type === 'success') {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        _this.parents('.tg-topic').next('.tg-topic').css('display', 'inline-block');
                        _this.parents('.tg-topic').next('.tg-topic').html(data.encode_data);
                        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-users .tg-tag span').html('');
                        set_templates_scrollbar();
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
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
            }
            else {
                _this.parents('.tg-catagoryhead').next().slideUp('slow');
                _this.find('.fa').removeClass('fa-angle-up');
                _this.find('.fa').addClass('fa-angle-down');
            }
        });

        $(document).on('click', '.add_new_track_template', function (e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/load_track_new_template'); ?>',
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

        $(document).on('click', '.update-track-template', function (e) {
            e.preventDefault();
            var form_data = $('.track_temp_edit_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/update_track_edit_temp_data'); ?>',
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

        jQuery('#adv_dob').datepick({
            dateFormat: 'dd-mm-yyyy',
            yearRange: '1900:<?php echo date('Y'); ?>'
        });

        $(document).on('click', '.save-track-template', function (e) {
            e.preventDefault();

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

            $('.show_template_name_input').show();

            if ($('input[name=track_template_name]').val() === '') {
                jQuery.sticky("Please enter the template name first.", {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            var form_data = $('.track_temp_edit_form').serialize();

            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/save_new_track_temp_data'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/get_load_template_data_tags'); ?>',
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
                url: '<?php echo base_url('/index.php/doctor/load_track_edit_template_data'); ?>',
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
                    url: '<?php echo base_url('/index.php/doctor/search_and_add_barcode_record'); ?>',
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
                                change_track_flag_status();
                                flag_tooltip();
                                set_templates_scrollbar();
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
                    url: '<?php echo base_url('/index.php/doctor/search_and_add_barcode_record'); ?>',
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
                                change_track_flag_status();
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
                    url: '<?php echo base_url('/index.php/doctor/search_and_add_barcode_record'); ?>',
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
                                change_track_flag_status();
                                flag_tooltip();
                                set_templates_scrollbar();
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
                    url: '<?php echo base_url('/index.php/doctor/search_and_add_barcode_record'); ?>',
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
                                change_track_flag_status();
                                flag_tooltip();
                                set_templates_scrollbar();
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

        $(document).on('click', '.create_sess_list_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/create_new_session_track_record_list'); ?>',
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

        $(document).on('click', '.detail_flag_change', function (e) {
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');

            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_flag_status'); ?>',
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

        $(document).on('click', '.delete_specimen', function (e) {
            e.preventDefault();
            var _this = $(this);

            if (!confirm('Do you want to delete this selected specimen?')) {
                return false;
            } else {
                $(_this.parents('.specimen_content').find('.tg-themenavtabs li')).each(function (index) {
                    if ($(this).hasClass('active')) {


                        var specimen_id = $(this).data('specimenid');
                        var request_id = $(this).data('requestid');
                        $.ajax({
                            url: '<?php echo base_url('/index.php/doctor/delete_specimen'); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {'specimen_id': specimen_id, 'request_id': request_id},
                            success: function (data) {
                                if (data.type == 'error') {
                                    jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                                } else {
                                    jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 3000);
                                }
                            }
                        });
                    }
                });
            }
        });

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
                            surname: items.sur_name
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
            limit: 30,
            templates: {
                suggestion: function (item) {
                    return '<div><a href="<?=base_url(SEARCH_RECORD_LINK_PATH);?>' + item.record_id + '">' + item.serial_number + ' --- ' + item.first_name + ' ' + item.surname + '</a></div>';
                },
                notFound: function (query) {
                    return 'No Result Found...';
                },
                pending: function (query) {
                    return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                },
            }
        });


        var ap_record_suggestions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/doctor/autopsy_search_record_detail_suggestion?query=%QUERY'); ?>',
                wildcard: '%QUERY',
                transform: function (record_suggestions) {
                    return $.map(record_suggestions, function (items) {
                        return {
                            record_id: items.record_id,
                            serial_number: items.serial_number,
                            first_name: items.f_name,
                            surname: items.sur_name
                        };
                    });
                }
            }
        });
        $('.tg-searchrecord input.ap_typeahead').typeahead({
                minLength: 2,
                highlight: true
            },
            {
                name: 'record_search',
                source: ap_record_suggestions,
                display: function (item) {
                    return item.first_name + ' ' + item.surname;
                },
                limit: 30,
                templates: {
                    suggestion: function (item) {
                        return '<div><a href="postmortem">' + item.serial_number + ' --- ' + item.first_name + ' ' + item.surname + '</a></div>';
                    },
                    notFound: function (query) {
                        return 'No Result Found...';
                    },
                    pending: function (query) {
                        return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                    },
                }
            });

        $(document).on('click', '.collapse-related-docs', function (e) {
            e.preventDefault();
            $('.related-doc-collapse-section').collapse('toggle');
        });

        $(document).on('click', '.selected-patient', function (){
            let patientID = $(this).attr('data-id');
            //console.log(patientID);
            if(patientID != ''){
                $.ajax({
                    type: "POST",
                    url: `${_base_url}doctor/getPatientDetail`,
                    data: { 'patient_id': patientID, 'request_id': $(document).find('#record_id').val() },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 'success') {
                            let res = response.data;
                            let pDiv = $(document).find('#edit-view-patient');
                            //console.log(res);
                            pDiv.find('#first_name').val(res.first_name);
                            pDiv.find('.patient_fname').val(res.first_name);
                            pDiv.find('#sur_name').val(res.last_name);
                            pDiv.find('.patient_lname').val(res.last_name);
                            pDiv.find('#gender').val(res.gender);
                            pDiv.find('#dob').val(res.dob);
                            pDiv.find('#nhs_number').val(res.nhs_number);
                            pDiv.find('#patient_usual_address').val(res.address_1);
                            pDiv.find('#patient_city').val(res.city);
                            pDiv.find('#postcode').val(res.post_code);
                        } else {
                            $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                        }
                    }
                });
            }
        });

        var patient_suggestions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/doctor/autopsy_search_patient?query=%QUERY'); ?>',
                wildcard: '%QUERY',
                transform: function (record_suggestions) {
                    return $.map(record_suggestions, function (items) {
                        return {
                            id: items.id,
                            first_name: items.first_name,
                            last_name: items.last_name,
                            dob: items.dob
                        };
                    });
                }
            }
        });

        $('.patient_fname').typeahead({
                minLength: 1,
                highlight: true
            },
            {
                name: 'record_search',
                source: patient_suggestions,
                display: function (item) {
                    return item.first_name;
                },
                limit: 30,
                templates: {
                    suggestion: function (item) {
                        return '<div><a href="javascript:void(0);" class="selected-patient" data-id="'+ item.id +'">' + item.first_name + ' ' + item.last_name + ' ' + item.dob + '</a></div>';
                    },
                    notFound: function (query) {
                        return 'No Result Found...';
                    },
                    pending: function (query) {
                        return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                    },
                }
            });

        $('.patient_lname').typeahead({
                minLength: 1,
                highlight: true
            },
            {
                name: 'record_search',
                source: patient_suggestions,
                display: function (item) {
                    return item.last_name;
                },
                limit: 30,
                templates: {
                    suggestion: function (item) {
                        return '<div><a href="javascript:void(0);" class="selected-patient" data-id="'+ item.id +'">' + item.first_name + ' ' + item.last_name + ' ' + item.dob + '</a></div>';
                    },
                    notFound: function (query) {
                        return 'No Result Found...';
                    },
                    pending: function (query) {
                        return '<div>Loading...<i class="fa fa-circle-o-notch fa-spin pull-right" style="font-size:20px;"></i></div>';
                    },
                }
            });
    });

    $(window).on('load', function () {
        var flag_green = $('#flag_green').is(':checked');
        var flag_red = $('#flag_red').is(':checked');
        var flag_yellow = $('#flag_yellow').is(':checked');
        var flag_blue = $('#flag_blue').is(':checked');
        var flag_black = $('#flag_black').is(':checked');
        var flag_all = $('#flag_all').is(':checked');

        if (flag_green) {
            load_ajax_publish_record_data('flag_green', '', '', '');
        } else if (flag_red) {
            load_ajax_publish_record_data('flag_red', '', '', '');
        } else if (flag_yellow) {
            load_ajax_publish_record_data('flag_yellow', '', '', '');
        } else if (flag_blue) {
            load_ajax_publish_record_data('flag_blue', '', '', '');
        } else if (flag_black) {
            load_ajax_publish_record_data('flag_black', '', '', '');
        } else if (flag_all) {
            load_ajax_publish_record_data('', '', '', '');
        }

        let clinic_id = $(document).find('.clinic_list').val();
        on_clinic_change(clinic_id);
    });



    $(document).ready(function () {
        datatables_render_table = false;
        load_ajax_publish_record_data('', '', '', '');
        load_ajax_unpublish_record_data('', '', '', '');
        $(document).on('click', '.ds_click', function (e) {
            let clinic_id = $(document).find('.clinic_list').val();
            on_clinic_change(clinic_id);
        });

        $(document).on('click', '.report_urgency_status', function (e) {
            var report_urgent = $('#report_urgent').is(':checked');
            var report_routine = $('#report_routine').is(':checked');
            var report_2ww = $('#report_2ww').is(':checked');

            if (report_urgent) {
                load_ajax_publish_record_data('', '', 'Urgent', '');
            } else if (report_routine) {
                load_ajax_publish_record_data('', '', 'Routine', '');
            } else if (report_2ww) {
                load_ajax_publish_record_data('', '', '2WW', '');
            }
        });

        $(document).on("click", ".record-latest-filters .flag_status", function (e) {
            var _this = $(this);
           // alert("sddd");
            if ($('#flag_green').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'green'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_red').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'red'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_yellow').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'yellow'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_blue').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'blue'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_black').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'black'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            }

            var flag_green = $('#flag_green').is(':checked');
            var flag_red = $('#flag_red').is(':checked');
            var flag_yellow = $('#flag_yellow').is(':checked');
            var flag_blue = $('#flag_blue').is(':checked');
            var flag_black = $('#flag_black').is(':checked');
            var flag_all = $('#flag_all').is(':checked');


            if (flag_green) {
                load_ajax_publish_record_data('flag_green', '', '', '');
            } else if (flag_red) {
                load_ajax_publish_record_data('flag_red', '', '', '');
            } else if (flag_yellow) {
                load_ajax_publish_record_data('flag_yellow', '', '', '');
            } else if (flag_blue) {
                load_ajax_publish_record_data('flag_blue', '', '', '');
            } else if (flag_black) {
                load_ajax_publish_record_data('flag_black', '', '', '');
            } else if (flag_all) {
                load_ajax_publish_record_data('', '', '', '');
            }
        });

        $(document).on('click', '.row_status', function (e) {
            var row_yellow = $('#row_yellow').is(':checked');
            var row_orange = $('#row_orange').is(':checked');
            var row_purple = $('#row_purple').is(':checked');
            var row_green = $('#row_green').is(':checked');
            var row_skyblue = $('#row_skyblue').is(':checked');
            var row_blue = $('#row_blue').is(':checked');
            var row_brown = $('#row_brown').is(':checked');
            var row_gray = $('#row_gray').is(':checked');

            if (row_yellow) {
                load_ajax_publish_record_data('', '', '', 'row_yellow');
            } else if (row_orange) {
                load_ajax_publish_record_data('', '', '', 'row_orange');
            } else if (row_purple) {
                load_ajax_publish_record_data('', '', '', 'row_purple');
            } else if (row_green) {
                load_ajax_publish_record_data('', '', '', 'row_green');
            } else if (row_skyblue) {
                load_ajax_publish_record_data('', '', '', 'row_skyblue');
            } else if (row_blue) {
                load_ajax_publish_record_data('', '', '', 'row_blue');
            } else if (row_brown) {
                load_ajax_publish_record_data('', '', '', 'row_brown');
            } else if (row_gray) {
                load_ajax_publish_record_data('', '', '', 'row_gray');
            }

        });

        $(document).on('click', '.sort_by_authorize', function (e) {
            e.preventDefault();
            load_ajax_publish_record_data('', 'sort_authorize', '', '');
        });

        jQuery('.tg-btntoggle').on('click', function (event) {
            event.preventDefault();
            var _this = jQuery(this);
            _this.parents('li').toggleClass('tg-openmenu');
            _this.parents('li').find('.tg-emailmenu').slideToggle('slow');
        });

    });

    function ajax_change_flag_status() {
        $('.record-latest-flags .flag_change').one('click', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');

            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_flag_status'); ?>',
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
            return false;
        });

    }

    function ajax_show_flags_on_hover() {
        $('#doctor_record_publish_table tbody .flag_column ul.report_flags').hide();
        $('#doctor_record_publish_table tbody .flag_column .hover_flags').hover(function () {
            _this = $(this);
            _this.find('ul.report_flags').slideDown('fast');
        }, function () {
            _this.find('ul.report_flags').slideUp('fast');
            return false;
        }
        );
    }

    function ajax_display_comment_box_hover() {

        $(document).on('click', '.show_comments_list_published', function (event) {
            _this = $(this);
            var record_id = _this.data('recordid');
            dynamic_id = _this.data('modalid');
            $('#display_comments_list-' + dynamic_id).modal('show');

            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/show_comments_box'); ?>',
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

    function ajax_add_flag_comments_box() {
        $(document).on('click', '#display_comment_box', function (e) {
            e.preventDefault();
            var _this = $(this);
            dynamic_id = _this.data('modalid');
            $('#flag_comment_model-' + dynamic_id).modal('show');
            $(document).one('click', '.flag_comments_save', function (e) {
                e.preventDefault();
                var _this = $(this);
                var form_data = $('#flag_comment_model-'+dynamic_id).find('#flag_comments_form_'+dynamic_id).serialize();

                $.ajax({
                    url: '<?php echo base_url('/index.php/doctor/save_flag_comments'); ?>',
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

    function ajax_delete_flag_comments() {
        $(document).on('click', '#delete_flag_comment', function (e) {
            e.preventDefault();
            var _this = $(this);
            var flag_id = _this.data('flagid');
            var parent = _this.parent("li");
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/delete_flag_comments'); ?>',
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
    function load_ajax_unpublish_record_data(flag_type, sort_authorize, urgency_type, row_color_code) {

        var url = window.location.href;
        var url_year = url.split('/').reverse()[1];
        var url_type = url.split('/').reverse()[0];
        var ajax_url = "<?php echo base_url('index.php/doctor/display_published_reports_ajax_processing/'); ?>";

        var oTable = $('#doctor_record_unpublish_table').DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "stateSave": true,
            "order": [],
            "language": {
                "infoFiltered": ""
            },
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "ajax": {
                url: ajax_url,
                type: "POST",
                dataType: "json",
                data: {'year': url_year, 'type': url_type, 'flag_type': flag_type, 'sort_authorize': sort_authorize, 'urgency_type': urgency_type, 'row_color_code': row_color_code}
            },
            "columnDefs": [
                {
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17], //first column / numbering column
                    // "order": [[0, asc]],
                    "orderable": true, //set not orderable
                },
            ],
            fnDrawCallback: function () {
                if (datatables_render_table === false) {
                    ajax_display_comment_box_hover();

                    ajax_add_flag_comments_box();
                    ajax_delete_flag_comments();
                    generate_bulk_reports();
                    check_all_checkboxes();
                    ajax_change_flag_status();
                    datatables_render_table = true;
                }
                ajax_show_flags_on_hover();
            },
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                var rowClass = aData[17];
                var rowCodeClass = aData[16];
                rowClass = rowClass.replace(/<(.|\n)*?>/g, '');
                rowCodeClass = rowCodeClass.replace(/<(.|\n)*?>/g, '');
                $('td', nRow).eq(15).addClass('flag_column');
                $('td', nRow).eq(17).addClass('flag_column hide_content');
                $('td', nRow).eq(16).addClass('hide_content');
                $('td', nRow).eq(18).addClass('hide_content');
                $(nRow).addClass(rowClass);
                $('td', nRow).eq(0).addClass(rowCodeClass);
                $(nRow).addClass(rowCodeClass);
            }
        });

        ajax_change_flag_status();
    }

    function load_ajax_publish_record_data(flag_type, sort_authorize, urgency_type, row_color_code) {
        var url = window.location.href;
         var urlInfo = url.split('/');
        var viewtype = '';
        var url_year = url.split('/').reverse()[1];
        var url_type = url.split('/').reverse()[0];
        if(urlInfo.length != 7){
            var viewtype = url.split('/').reverse()[0];
            var url_year = url.split('/').reverse()[2];
            var url_type = url.split('/').reverse()[1];
        }
        var ajax_url = "<?php echo base_url('index.php/doctor/display_published_reports_ajax_processing/'); ?>";

        $('#doctor_record_publish_table').DataTable({
            processing: false,
            serverSide: true,
            stateSave: true,
            order: [],
            "ajax": {
                url: ajax_url,
                type: "POST",
                dataType: "json",
                data: {'year': url_year, 'type': url_type, 'flag_type': flag_type, 'sort_authorize': sort_authorize, 'urgency_type': urgency_type, 'row_color_code': row_color_code, 'viewtype' : viewtype}
            },
            "bDestroy": true,
                fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                 $('td', nRow).eq(9).addClass('flag_column');
            },
                fnDrawCallback: function () {
                if (datatables_render_table === false) {
                    ajax_display_comment_box_hover();

                    ajax_add_flag_comments_box();
                    ajax_delete_flag_comments();
                    generate_bulk_reports();
                    check_all_checkboxes();
                    ajax_change_flag_status();
                    datatables_render_table = true;
                }
                ajax_show_flags_on_hover();
            },
        });

        // var oTable = $('#doctor_record_publish_table').DataTable({
        //     "processing": true,
        //     "serverSide": true,
        //     "destroy": true,
        //     "stateSave": true,
        //     "order": [],
        //     "language": {
        //         "infoFiltered": ""
        //     },
        //     "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        //     "ajax": {
        //         url: ajax_url,
        //         type: "POST",
        //         dataType: "json",
        //         data: {'year': url_year, 'type': url_type, 'flag_type': flag_type, 'sort_authorize': sort_authorize, 'urgency_type': urgency_type, 'row_color_code': row_color_code}
        //     },
        //     "columnDefs": [
        //         {
        //             "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18], //first column / numbering column
        //             // "order": [[0, asc]],
        //             "orderable": true, //set not orderable
        //         },
        //     ],
        //     fnDrawCallback: function () {
        //         if (datatables_render_table === false) {
        //             ajax_display_comment_box_hover();

        //             ajax_add_flag_comments_box();
        //             ajax_delete_flag_comments();
        //             generate_bulk_reports();
        //             check_all_checkboxes();
        //             ajax_change_flag_status();
        //             datatables_render_table = true;
        //         }
        //         ajax_show_flags_on_hover();
        //     },
        //     fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //         setTimeout(function(){
        //             var rowClass = aData[17];
        //             var rowCodeClass = aData[16];
        //             rowClass = rowClass.replace(/<(.|\n)*?>/g, '');
        //             rowCodeClass = rowCodeClass.replace(/<(.|\n)*?>/g, '');
        //             $('td', nRow).eq(15).addClass('flag_column');
        //             $('td', nRow).eq(17).addClass('hide_content');
        //             $('td', nRow).eq(18).addClass('flag_column hide_content');
        //             $('td', nRow).eq(19).addClass('hide_content');
        //             $(nRow).addClass(rowClass);
        //             $('td', nRow).eq(0).addClass(rowCodeClass);
        //             $(nRow).addClass(rowCodeClass);
        //         },100);
        //     }
        // });

        ajax_change_flag_status();
    }

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

    function change_track_flag_status() {
        $(document).on('click', '.flag_change', function (e) {
            e.preventDefault();
            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_flag_status'); ?>',
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
                        _this.parents('.report_listing').find('.flag_message').fadeOut(2000);
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

    function generate_bulk_reports() {
        $(document).on('click', '.generate-bulk-reports', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_ids = [];
            $(_this.parents('#doctor_record_publish_table').find('tbody .bulk_report_generate')).each(function (index) {
                if (this.checked) {
                    record_ids.push($(this).val());
                }
            });
            _this.parents('#doctor_record_publish_table').find('input[name=bulk_report_ids]').val(record_ids);

            var url = _this.data('bulkurl');
            $(record_ids).each(function (index, obj) {
                window.open(url + '?id=' + obj, '_blank');
            });
        });
    }

    function check_all_checkboxes() {
        $("input[name=check_all]").click(function () {
            $('.bulk_report_generate').not(this).prop('checked', this.checked);
        });
    }

    function show_flags_on_hover() {
        $('#doctor_record_list_table tbody .flag_column .hover_flags, #doctor_record_publish_table tbody .flag_column .hover_flags').hover(function () {
            _this = $(this);
            _this.find('ul.report_flags').slideDown('fast');
        }, function () {
            _this.find('ul.report_flags').slideUp('fast');
            return false;
        }
        );
    }

    function display_comment_box_hover() {
        $(document).on('click', '.show_comments_record_list', function (event) {
            event.preventDefault();
            _this = $(this);
            var record_id = _this.data('recordid');
            dynamic_id = _this.data('modalid');
            $('#display_comments_list-' + dynamic_id).modal('show');

            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/show_comments_box'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: {'record_id': record_id},
                success: function (data) {
                    if (data.type === 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
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
            $(document).one('click', '.flag_comments_save_record_list', function (e) {
                e.preventDefault();
                var _this = $(this);
                var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form_'+dynamic_id).serialize();
                $.ajax({
                    url: '<?php echo base_url('/index.php/doctor/save_flag_comments'); ?>',
                    type: 'POST',
                    global: false,
                    dataType: 'json',
                    data: form_data,
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 7000});
                        } else {
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                });
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
                url: '<?php echo base_url('/index.php/doctor/delete_flag_comments'); ?>',
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

    function filter_tat_on_record_list(oTable) {
        $(document).on("click", ".tat", function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {

                var tat5 = $('#tat5').is(':checked');
                var tat10 = $('#tat10').is(':checked');
                var tat20 = $('#tat20').is(':checked');
                var tat30 = $('#tat30').is(':checked');
                var tat_all = $('#all_tat').is(':checked');
                if (tat_all) {
                    $("#all_tat").parent("span").hide();
                }else{
                    $("#all_tat").parent("span").show();
                }

                aData = aData.map(v => v.trim());
                if (tat5 && aData[12] <= 5) {
                    return true;
                } else if (tat10 && aData[12] <= 10) {
                    return true;
                } else if (tat20 && aData[12] > 10 && aData[14] <= 20) {
                    return true;
                } else if (tat30 && aData[12] > 20) {
                    return true;
                } else if (tat_all) {
                    return true;
                }

                return false;
            });
            oTable.draw();
        });
    }

    function filter_row_by_data_type_on_record_list(oTable) {
        $(document).on('click', '.data_type', function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                data_type_val = $(".data_type:checked").val();

                if(aData[19].trim() == data_type_val || data_type_val == 'all') {
                    return true;
                }
                return false;
            });
            oTable.draw();
        });
    }
    function filter_row_by_hospital_on_record_list(oTable) {
        $(document).on('click', '.filter_by_hospital_btn', function (e)
		{
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                selected_hos_val = $(".filter_by_hospital_btn:checked").val();
                console.log(selected_hos_val)
                if (selected_hos_val == '0')
				{
                    $("#aa").parent("span").hide();
                }
				else
				{
                    $("#aa").parent("span").show();
                }
                if (selected_hos_val == '0') {
                    return true;
                }
				//alert(selected_hos_val);
                //alert(aData[2].trim());
				if(aData[2].trim() == selected_hos_val) {
                    return true;
                }
                return false;
            });
            oTable.draw();
        });
    }

    function filter_row_by_status_on_record_list(oTable) {
        $(document).on('click', '.filter_by_status_btn', function (e) {
            $('.filter_by_status_btn').removeClass('active');
            $(this).addClass('active');
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {

                selected_hos_val = $(".filter_by_status_btn.active").attr('title');
                console.log(selected_hos_val, "selected_hos_valselected_hos_val");
                if (selected_hos_val == '' || typeof selected_hos_val == 'undefined' || selected_hos_val == 'Reset All') {
                    $("#aa").parent("span").hide();
                }else{
                    $("#aa").parent("span").show();
                }
                if (selected_hos_val == '' || typeof selected_hos_val == 'undefined' || selected_hos_val == 'Reset All') {
                    $('.filter_by_status_btn').removeClass('active');
                    return true;
                }
				// console.log(aData[18].trim());
				// console.log(selected_hos_val);
                if (aData[18].trim() == selected_hos_val) {
                    return true;
                }
                return false;
            });
            oTable.draw();
        });
    }

    function filter_row_status_on_record_list(oTable) {
        $(document).on('click', '.flag_status', function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                var blue = $('#flag_blue').is(':checked');
                var green = $('#flag_green').is(':checked');
                var yellow = $('#flag_yellow').is(':checked');
                var black = $('#flag_black').is(':checked');
                var red = $('#flag_red').is(':checked');
                var all = $('#flag_all').is(':checked');

                if (all) {
                    $('#flag_all').parent('.tg-flagcolor6').hide();
                }else{
                    $('#flag_all').parent('.tg-flagcolor6').show();
                }

                aData = aData.map(v => v.trim());
				//alert(aData[9]);

                if (blue && aData[9] == 'flag_blue') {
                    return true;
                }
                if (green && aData[9] == 'flag_green') {
                    return true;
                }
                if (yellow && aData[9] == 'flag_yellow') {
                    return true;
                }
                if (black && aData[9] == 'flag_black') {
                    return true;
                }
                if (red && aData[9] == 'flag_red') {
                    return true;
                }
                if (all) {
                    return true;
                }

                return false;
            });
            oTable.draw();
        });
    }

    function filter_report_urgency_status_on_record_list(oTable) {
        $(document).on('click', '.report_urgency_status', function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                aData = aData.map(v => v.trim());
                var report_urgent = $('#report_urgent').is(':checked');
                var report_routine = $('#report_routine').is(':checked');
                var report_2ww = $('#report_2ww').is(':checked');
                var report_clear = $('#report_clear').is(':checked');

                if (report_clear) {
                    $("#report_clear").parent("span").hide();
                }else{
                    $("#report_clear").parent("span").show();
                }

                if (report_urgent && aData[14] == 'Urgent') {
                    return true;
                } else if (report_routine && aData[14] == 'Routine') {
                    return true;
                } else if (report_2ww && aData[14] == '2WW') {
                    return true;
                }else if (report_clear) {
                    return true;
                }

                return false;
            });
            oTable.draw();
        });
    }

   function gettatvalue(tatno)
   {
       load_ajax_publish_record_data('', '', tatno, '');
   }

    function filter_flag_status_on_record_list(oTable) {
        $(document).on("click", ".record-list-filters .flag_status", function (e) {

            var _this = $(this);

            if ($('#flag_green').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'green'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_red').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'red'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_yellow').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'yellow'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_blue').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'blue'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            } else if ($('#flag_black').is(':checked')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/set_color_code_session_data'); ?>",
                    data: {'color_code': 'black'},
                    dataType: "json",
                    success: function (response) {
                    }
                });
            }

            var flag_green = $('#flag_green').is(':checked');
            var flag_red = $('#flag_red').is(':checked');
            var flag_yellow = $('#flag_yellow').is(':checked');
            var flag_blue = $('#flag_blue').is(':checked');
            var flag_black = $('#flag_black').is(':checked');
            var flag_all = $('#flag_all').is(':checked');


            if (flag_green) {
                load_ajax_publish_record_data('flag_green', '', '', '');
            } else if (flag_red) {
                load_ajax_publish_record_data('flag_red', '', '', '');
            } else if (flag_yellow) {
                load_ajax_publish_record_data('flag_yellow', '', '', '');
            } else if (flag_blue) {
                load_ajax_publish_record_data('flag_blue', '', '', '');
            } else if (flag_black) {
                load_ajax_publish_record_data('flag_black', '', '', '');
            } else if (flag_all) {
                load_ajax_publish_record_data('', '', '', '');
            }

        });

        $(document).on('click', '.record-list-flag .flag_change', function (e) {

            e.preventDefault();

            var _this = $(this);
            var _flag = $(this).data('flag');
            var _serial = $(this).data('serial');
            var _recordid = $(this).data('recordid');
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_flag_status'); ?>',
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
            return false;
        });
    }

    $(document).ready(function () {

        $('#private_message_table').DataTable({
            ordering: false,
            "processing": true,
            stateSave: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });

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

     $(document).on('click', '.specimen_pm_msg_btn', function(e){
        e.preventDefault();
        var _this = $(this);
        var lab_user_id = _this.parents('.form').find('input[name=lab_name_id]').val();
        var msg_subject = _this.parents('.form').find('input[name=privmsg_subject]').val();
        var msg_body = _this.parents('.form').find('textarea[name=privmsg_body]').val();
        var record_id = _this.parents('.form').find('input[name=record_id]').val();
        $.ajax({
                url: '<?php echo base_url('/index.php/doctor/sendMessageToLaboratory'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'lab_user_id': lab_user_id, 'msg_subject': msg_subject, 'msg_body': msg_body, 'record_id' : record_id},
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function(){
                            _this.parents('.form').find('input[name=privmsg_subject]').val('');
                            _this.parents('.form').find('textarea[name=privmsg_body]').val('');
                            _this.parents('.modal').modal('hide');
                        }, 1000);
                    }
                }
            });
        });

        var receipent_suggestions = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '<?php echo base_url('index.php/doctor/searchReceipentUsers?query=%QUERY'); ?>',
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

        $(document).one('click', '.add-snomed-code', function(e){
            e.preventDefault();
            var _this = $(this);
            var snomed_type = _this.parents('.snomed_codes').find('input[name=snomed_type]').val();
            if(snomed_type === 't1'){
                var formvalue = jQuery('.snomed_code_from_t1').serialize();
            }else if(snomed_type === 'p'){
                var formvalue = jQuery('.snomed_code_from_p').serialize();
            }else if(snomed_type === 's'){
                var formvalue = jQuery('.snomed_code_from_s').serialize();
            }else{
                var formvalue = jQuery('.snomed_code_from_m').serialize();
            }

            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/addSnomedCodes'); ?>',
                type: 'POST',
                dataType: 'json',
                data: formvalue,
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        });

     $(document).on('click', '.snomed_code_privmsg', function(e){
        e.preventDefault();
        var _this = $(this);
        var msg_subject = _this.parents('.snomed_privmsg_form').find('input[name=privmsg_subject]').val();
        var msg_body = _this.parents('.snomed_privmsg_form').find('textarea[name=privmsg_body]').val();
        var admin_id = _this.parents('.snomed_privmsg_form').find('input[name=admin_id]').val();
        $.ajax({
                url: '<?php echo base_url('/index.php/doctor/sendMessageSnomedToAdmin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'msg_subject': msg_subject, 'msg_body': msg_body, 'admin_id' : admin_id},
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function(){
                            _this.parents('.snomed_privmsg_form').find('textarea[name=privmsg_body]').val('');
                            _this.parents('.modal').modal('hide');
                        }, 1000);
                    }
                }
            });
        });

     $(document).on('click', '.micro_code_privmsg_btn', function(e){
        e.preventDefault();
        var _this = $(this);
        var msg_subject = _this.parents('.micro_code_privmsg_form').find('input[name=privmsg_subject]').val();
        var msg_body = _this.parents('.micro_code_privmsg_form').find('textarea[name=privmsg_body]').val();
        var admin_id = _this.parents('.micro_code_privmsg_form').find('input[name=admin_id]').val();
        $.ajax({
                url: '<?php echo base_url('/index.php/doctor/sendMessageMicrocodeToAdmin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'msg_subject': msg_subject, 'msg_body': msg_body, 'admin_id' : admin_id},
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function(){
                            _this.parents('.micro_code_privmsg_form').find('textarea[name=privmsg_body]').val('');
                            _this.parents('.modal').modal('hide');
                        }, 1000);
                    }
                }
            });
        });

        $(document).on('click', '#save_micro', function (e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = _this.parents('#add_micro_codes').find('#add_microscopic_codes_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/add_microscopic_codes'); ?>',
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

         $(document).on('click', '.edit_micro_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var micro_data = $('.edit_microscopic_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/edit_microscopic_code'); ?>',
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

        $(window).on('load', function(){
            $.each( $('.specimen_content .tg-themenavtabs li'), function( key, value ) {
                if($(this).hasClass('active')){
                    $('#datasets-accordian').find('.dataset_specimen_id').attr('data-datasetspecimenid', $(this).data('currentspceimentab'));
                }
            });
        });
        $('.specimen_content .tg-themenavtabs li').click(function(){
            var _this = $(this);
            $('#datasets-accordian').find('.dataset_specimen_id').attr('data-datasetspecimenid', _this.data('currentspceimentab'));
        });

    });

    function check_surname(){
        jQuery("#check_auth_pass_form .ura-surname-field input").keyup(function () {
            var _this = jQuery(this);
            var surname_letter = _this.val();
            var record_id = _this.parents('.ura-surname-field').data('recordid');
            var key_name = _this.data('namekey');
            var key_value = _this.data('namevalue');
            var surname_array_last = _this.parents('#check_auth_pass_form').find('input[name=surname_data]').val();

            if (_this.val().length >= 1) {
                if(key_value == surname_letter){
                    // jQuery.sticky('Letter Match Successfully', {classList: 'success', speed: 200, autoclose: 5000});
                    var input_flds = _this.closest('#check_auth_pass_form').find('.ura-surname-field :input');
                    input_flds.eq(input_flds.index(_this) + 1).focus();
                    if(parseInt(surname_array_last) === key_name){
                        jQuery('.ura-pin-area').show();
                    }
                    _this.removeClass('surname-field-error');
                    _this.prop('disabled', true);
                }else{
                    _this.addClass('surname-field-error');
                    jQuery.sticky('Letter did not match.', {classList: 'important', speed: 200, autoclose: 5000});
                }
            }else{
                jQuery.sticky('Please enter the letter.', {classList: 'important', speed: 200, autoclose: 5000});
            }
        });
    }

    $(".flags-select li a.badge-info").click(function(){
        $(".select-flag").removeClass("badge-success badge-danger badge-warning badge-dark").addClass("badge-info");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-danger").click(function(){
        $(".select-flag").removeClass("badge-success badge-info badge-warning badge-dark").addClass("badge-danger");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-warning").click(function(){
        $(".select-flag").removeClass("badge-success badge-info badge-danger badge-dark").addClass("badge-warning");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-dark").click(function(){
        $(".select-flag").removeClass("badge-success badge-info badge-danger badge-warning").addClass("badge-dark");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-success").click(function(){
        $(".select-flag").removeClass("badge-dark badge-info badge-danger badge-warning").addClass("badge-success");
        $(".flags-select").removeClass("show");
    });

</script>
<script type="text/javascript">
setTimeout(() => {
    $('[data-toggle="tooltip"]').tooltip();
}, 1000);

    $("#pdf-icon").off('click');
    $("#pdf-icon").click(function() {
        $("#display_iframe_pdf").modal('hide');
        setTimeout(function() {
            $("#user_auth_popup").modal('show');
        }, 300);
    });

    $("#show_pdf_iframe, .show_pdf_iframe2").click(function(){
        $(".display_iframe_pdf").toggleClass("show");
    });
    $(".btn-dismis, .close").click(function(){
        $(".modal.fade").removeClass("in");
        $(".modal.fade").removeClass("show");
    });

    $(".collapse-related-docs").click(function(){
         $("#relateddocs").toggleClass("show");
    });
    $("a#show_hidden").click(function(){
        $("a.tg-detailsicon.hide_tag_selection").toggleClass("hide_tag_selection");
    });

    $(document).ready(function(){
        var site_url = '<?php echo base_url(); ?>';
        setTimeout( "jQuery('.user_edit_status').hide();",10000 );
        setTimeout( "jQuery('.user_add_report_status').hide();",10000 );

        $(".lab_btn").click(function(){
            $(".lab_btn_desc").toggleClass("show");
        });

        $(".checv_up_down").click(function(){
            $(this).children().toggleClass("fa-chevron-up").toggleClass("fa-chevron-down");
            $(this).parent().parent().children(".card").toggleClass("show");
        });
        $(".collapse_all").click(function(){
            $(".card.hidden").toggleClass("show");
            $(".checv_up_down > i").toggleClass("fa-chevron-up").toggleClass("fa-chevron-down");

        });

        $(".tg-themenavtabs.nav.navbar-nav li.nav-item").click(function(){
            $("ul.tg-themenavtabs.nav.navbar-nav li.nav-item").removeClass("active");
            $(this).addClass("active");
        });

        $('body').on('change', '.bill_code', function(){
            let bill_id = Number($(this).val());
            let that = $(this).closest('.row');
            $.get(site_url + 'doctor/get_bill_detail/' + bill_id, function (data) {
                that.find('.bill_price').val(data.price);
                that.find('.bill_code_text').val(data.bill_code);
                that.find('.bill_description').val(data.bill_description);
            });
        });
    });


  $(document).ready(function() {
      // $(".p_id").click(function(){$(".info_nndn").toggleClass("hidden")});
      // $(".p_id").click(function(){$("#p_id_title").toggleClass("hidden")});
      // $(".r_id").click(function(){$("#request_id_title").toggleClass("hidden")});
      // $(".r_id").click(function(){$(".info_nndn2").toggleClass("hidden")});

      $(".make_editable").click(function(){
          $("#p_id_upd_btn").toggleClass("hidden");
          $("#p_id_upd_btn2").toggleClass("hidden");
          if(!$("#request_id").hasClass("show")){
              $("#request_id").toggleClass("show");
          }
          if(!$("#patient_id").hasClass("show")){
              $("#patient_id").toggleClass("show");
          }
          if(!$(".info_nndn").hasClass("hidden")){
              $(".info_nndn").toggleClass("hidden");
          }
          if($("#p_id_title").hasClass("hidden")){
              $("#p_id_title").toggleClass("hidden");
          }
      });

        $("#sidebar-menu").find("a").click(function(event) {
            var loc = $(this).attr('href');
            if (loc != '#') {
                window.location.href = loc;
            }
        });
        $(".grid-table-view").click(function(){
            $(".table_layout").toggleClass("hidden");
            $(".grid_layout").toggleClass("show");
        });

        // $('.flags_check span.tg-radio.first').hover(
        //   function () {
        //     $(".flags_check span.tg-radio").show();
        //   },
        //   function () {
        //     $('.flags_check span.tg-radio').hide();
        //     $('.flags_check span.tg-radio.first').show();
        //   });
        $('.tg-radio').click(function(){
            $(this).parent().children('.tg-cancel').show();
            });
         $('.tg-cancel').click(function(){
            $(this).hide();
        });

        var table = $('.custom-search-table').DataTable();
         $('.custom_search_datatable').on( 'keyup', function () {
            table.search( this.value ).draw();
        } );

         oTable = $('#doctor_record_review_cases').DataTable();
        $('#case_review_search_datatable').keyup(function(){
              oTable.search($(this).val()).draw() ;
        });

    });

    var div_search_collapsed = true;
    $('.adv-search').click(function() {
        var h = $("#collapse_adv_search").height();
        if (div_search_collapsed) {
            div_search_collapsed = false;
            $("#report-list-table").animate({
                "margin-top": h
            },300);
        }
        else{
            div_search_collapsed = true;
            $("#report-list-table").animate({
                "margin-top": 0
            }, 300);
        }
    });
    // $('.report_selected_flag').click(
    //   function () {
    //     $("ul.report_flags").show();
    //   },
    //   function () {
    //     $("ul.report_flags").hide();
    //   }
    // );

   $(".report_selected_flag").mouseover(function(){
        $("ul.report_flags").css("display","none");
        $(this).parent().parent().children("ul.report_flags").css("display","block");
        // $(this).parent().parent().children("ul.report_flags").toggleClass("show");
    });
    $("ul.report_flags .flag_change").click(function(){
        $(this).parent().parent("ul.report_flags").css("display","none");
    });
    $(".table_view_svg svg").click(function(){
        $(this).parent().addClass("green");
        $(this).children("circle").css({"stroke":"green", "fill":"green"});
    });
    $(".table_view_svg.green svg circle").click(function(){
        $(this).removeClass("green");
        $(this).css({"stroke":"orange", "fill":"green"});
    });
</script>


<?php if (isset($twelve_month_tat)) {?>
    <script type="text/javascript">
    //################################## Twelve Month Bar Chart START ################################
    (function (){
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("tats_graph", am4charts.XYChart);
            // chart.numberFormatter.numberFormat = "#";

            // Add data
            chart.data = <?php echo json_encode($twelve_month_tat, JSON_NUMERIC_CHECK); ?>

            // Chart Title
            //       var title = chart.titles.create();
            //           title.text = "TAT Last 12 Months";
            //           title.fontSize = 20;
            //           title.align = "left"
            //           title.marginBottom = 30;
            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            dateAxis.dataFields.category = "publish_month";
            dateAxis.renderer.grid.template.location = 0;
            dateAxis.renderer.minGridDistance = 10;
            dateAxis.renderer.cellStartLocation = 0.3;
            dateAxis.renderer.cellEndLocation = 0.9;
            dateAxis.renderer.labels.template.rotation = 325;
            dateAxis.renderer.grid.template.disabled = true;
            //   dateAxis.dateFormatter = new am4core.DateFormatter();
            //   dateAxis.dateFormatter.dateFormat = "m/YY";
            // dateAxis.baseInterval = {
            //     "timeUnit": "month",
            //     "count": 1
            // }

            var valueAxis1 = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis1.title.text = "# of Cases";
            valueAxis1.renderer.grid.template.disabled = true;

            var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis2.title.text = "TAT < 10 (%age)";
            valueAxis2.renderer.opposite = true;
            valueAxis2.renderer.grid.template.disabled = true;

            // Create series
            function createSeries(field, name,color) {
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = field;
                series.dataFields.categoryX  = "publish_month";
                series.strokeWidth = 2;
                series.minBulletDistance = 40;
                series.name = name;
                series.stroke = color;
                series.fill = color
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.columns.template.height = am4core.percent(100);
                //        series.sequencedInterpolation = true;
                series.numberFormatter.numberFormat = "#";
                series.columns.template.width = am4core.percent(80);

                var hs = series.columns.template.states.create("active");
                hs.properties.fillOpacity = 1

                // series.columns.template.events.on("hit", highlighColumn);

            }
            createSeries("num_of_cases", "Total Cases",am4core.color('#34444C'));
            createSeries("tat_less_ten", "Cases < 10 TAT",am4core.color('#019FEB'));

            var series3 = chart.series.push(new am4charts.LineSeries());
            series3.dataFields.valueY = "target_less_ten";
            series3.dataFields.categoryX  = "publish_month";
            series3.name = "Target Cases <10 TAT";
            series3.strokeWidth = 2;
            series3.tensionX = 0.7;
            series3.yAxis = valueAxis1;
            series3.stroke = am4core.color('#AA3631');
            series3.fill = am4core.color('#AA3631');
            series3.tooltipText = "{name}\n[bold font-size: 20]{valueY}[/]";
            series3.numberFormatter.numberFormat = "#.";

            var bullet3 = series3.bullets.push(new am4charts.CircleBullet());
            bullet3.circle.radius = 3;
            bullet3.circle.strokeWidth = 2;
            bullet3.circle.fill = am4core.color("#fff");

            var series4 = chart.series.push(new am4charts.LineSeries());
            series4.dataFields.valueY = "tat_less_ten_percent";
            series4.dataFields.categoryX  = "publish_month";
            series4.name = "Tat < 10";
            series4.strokeWidth = 2;
            series4.tensionX = 0.7;
            series4.yAxis = valueAxis2;
            series4.tooltipText = "{name}\n[bold font-size: 20]{valueY}%[/]";
            // series4.stroke = chart.colors.getIndex(0).lighten(0.5);
            series4.stroke = am4core.color('#262F4C');
            series4.fill = am4core.color('#262F4C');
            // series4.strokeDasharray = "3,3";
            series4.calculatePercent = true;

            var bullet4 = series4.bullets.push(new am4charts.CircleBullet());
            bullet4.circle.radius = 3;
            bullet4.circle.strokeWidth = 2;
            bullet4.circle.fill = am4core.color("#fff");

            // Add cursor
            chart.cursor = new am4charts.XYCursor();

            // Add legend
            chart.legend = new am4charts.Legend();
            chart.legend.position = "bottom";

            // Enable export
            chart.exporting.menu = new am4core.ExportMenu();

        }); // end am4core.ready()
    })();
    //################################## Twelve Month Bar Chart END ##################################
  </script>
  <script type="text/javascript">
      $(".request_form_table").DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
      });
  </script>
<?php }?>
</html>