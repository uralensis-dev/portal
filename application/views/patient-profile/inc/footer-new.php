<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script src="https://cdn.tiny.cloud/1/mcnf3z49bi3hvs29al81mrwfygelhkh5ya3vkn0tush8eu9v/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
</div>
<!-- /Page Wrapper -->

<script>
    tinymce.init({
        menubar: false,
        selector: '.tg-tinymceeditor',

        toolbar: 'undo redo ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        font_formats: "CircularStd=CircularStd;",
        content_style: "@import url('https://db.onlinewebfonts.com/c/860c3ec7bbc5da3e97233ccecafe512e?family=CircularStd'); body { font-family: CircularStd !important; }"
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
</script>

</body>
</html>

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
<?php
if (!(strtolower($this->uri->segment(1)) == 'doctor' && strtolower($this->uri->segment(2)) == 'doctor_record_detail')) {
    $src_url = base_url('/assets/subassets/js/jquery-3.2.1.min.js');
    echo "<script src='$src_url'></script>";
    // echo "<h1>This is true</h1>";
}
?>
<script src="<?php echo base_url('/assets/js/jquery-ui.js'); ?>"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url('/assets/subassets/js/popper.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/subassets/js/bootstrap.min.js') ?>"></script>

<!-- Slimscroll JS -->
<script src="<?php echo base_url('/assets/subassets/js/jquery.slimscroll.min.js') ?>"></script>

<!-- Chart JS -->
<script src="<?php echo base_url('/assets/subassets/plugins/morris/morris.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/subassets/plugins/raphael/raphael.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/subassets/js/chart.js') ?>"></script>


<script src="<?php echo base_url('/assets/subassets/js/jquery.smartWizard.js') ?>"></script>

<script src="<?php echo base_url('/assets/subassets/js/jquery.date-dropdowns.js') ?>"></script>


<!-- Datetimepicker JS -->
<script src="<?php echo base_url('/assets/subassets/js/moment.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/subassets/js/bootstrap-datetimepicker.min.js') ?>"></script>


<script src="<?php echo base_url('/assets/js/jquery.countTo.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/circle-progress.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.plugin.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/jquery.datepick.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/moment-with-locales.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/typeahead.jquery.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.bpopup.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery-te-1.4.0.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/jquery.idle.min.js'); ?>"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!-- Custom JS -->
<script src="<?php echo base_url('/assets/subassets/js/app.js') ?>"></script>

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


    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
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
    $(document).on('click', '.btnRemove', function () {
        $(this).closest("tr").remove();
    });


    $(document).on('click', '.btnPlus', function () {
        var table = $('#tblItems');
        table.append('<tr><td></td><td><input class="form-control" name="itemName[]" type="text" style="min-width:150px"></td><td><input class="form-control" name="itemDescription[]" type="text" style="min-width:150px"></td><td><input class="cost form-control" name="itemCost[]" style="width:100px" type="text"></td><td><input class="qty form-control" name="itemQty[]" style="width:80px" type="text"></td><td><input class="form-control amount" name="amount[]" readonly="" style="width:120px" type="text"></td><td><a href="javascript:void(0)" class="btnRemove text-danger font-18" title="Add"><i class="fa fa-trash-o"></i></a></td></tr>');
    });
    $(document).on('input', '.cost', function () {

        var qty = $(this).closest("tr").find("input[name='itemQty[]']").val();
        var amount = $(this).closest("tr").find("input[name='amount[]']");

        amount.val($(this).val() * qty);
        updateTotal();
        updateTax();

    });

    $(document).on('input', '.qty', function () {

        var cost = $(this).closest("tr").find("input[name='itemCost[]']").val();
        var amount = $(this).closest("tr").find("input[name='amount[]']");

        amount.val($(this).val() * cost);
        updateTotal();
        updateTax();

    });
    $(document).on('change', '.selectTaxt', function () {
        updateTax();
    });

    function updateTotal() {
        var sum = 0;
        $("input[name='amount[]']").each(function () {
            sum += Number($(this).val());
        });
        $("input[name='invoiceAmount']").val(sum);
    }

    function updateTax() {
        var sum = $("input[name='invoiceAmount']").val();
        var tax = $("select[name='tax']").val()
        $("input[name='invoiceTax']").val(sum * tax / 100);
    }

    $('#statusChange a').on('click', function (event) {
        event.preventDefault();
        var upperAnchor = $(this).closest('.changeStat').find('a.btn');
        var stats = $(this).find("input[name='statusChange']").val();
        var id = $(this).closest("#statusChange").find("input[name='invoiceId']").val();
        $.ajax({
            type: "get",
            url: "<?php echo base_url(); ?>/invoices/changeStatus",
            data: {
                statusChange: stats,
                changeId: id
            },
            success: function (response) {
                var textChange = '<a class=" btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-' + stats + '"></i>' + stats + '</a>'
                upperAnchor.replaceWith(textChange);
            },
            error: function () {
                alert("Error");
            },
        });
    });

    $(document).ready(function () {

        $(window).resize(function () {
            var prevheight = $('.patient-menu').height();
            $('.sidebar').css('top', prevheight);
            $('.page-wrapper.sidebar-patient').css('padding-top', prevheight);
        }).resize();


        $(".day").prop('required', true);
        $(".month").prop('required', true);
        $(".year").prop('required', true);
        $("#inputPatientDateOfBirth").dateDropdowns();

        // Fetch patient data
        var userData = null;


        $('#personal_info_modal').on("show.bs.modal", function (e) {

            var $inputs = $(this).find(':input');

            $.get("<?php echo base_url();?>/patient/fetch", function (data, status) {
                console.log(status + 'status');
                if (status == 'success') {
                    userData = JSON.parse(data);
                    if (userData.new) {
                        console.log('new');
                    } else {
                        console.log(userData);
                        $.each(userData, function (key, val) {
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
            scrollTop: 0
        }, 700);
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

        // tinymce.init({
        // 	selector: '.specimen_microscopic_description',
        // 	theme: 'modern',
        //     menubar: false,
        //     statusbar: false,
        //     toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist forecolor undo redo",
        // 	plugins: [
        //         'advlist autolink lists textcolor',
        //         'wordcount'
        //     ],
        //     toolbar: ' undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat ',
        //     setup: function (editor) {
        //         editor.on('change', function (e) {
        //             editor.save();
        //             console.log(editor.getContent());
        //         });
        //     }
        // });

        $('ul.nav li.dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
        });

        jQuery('.ura-pin-area').hide();
        var surnameData = jQuery('input[name=surname_data]').val();
        // check_surname();

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

        jQuery('.timer').countTo();

        $('#doctor_record_review_cases, #doctor_opinion_record_list_table, #teaching_case_table, #further_work_table_completed, #further_work_table_requested, #mdt_table_post, #mdt_table_pending, #doctor_invoice_table').DataTable({
            ordering: false,
            stateSave: true,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
        $('.doctors_tat_table').DataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
        });
        $('div.dataTables_filter input').focus();

        oTable = $('#doctor_record_list_table').dataTable({
            ordering: false,
            "processing": true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            fnDrawCallback: function () {
                show_flags_on_hover();
                delete_flag_comments();
            }
        });

        display_comment_box_hover();
        add_flag_comments_box();
        filter_tat_on_record_list(oTable);
        filter_row_status_on_record_list(oTable);
        filter_row_by_hospital_on_record_list(oTable);
        filter_report_urgency_status_on_record_list(oTable);
        filter_flag_status_on_record_list(oTable);

        $(window).on('load', function () {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                var flag_green = $('#flag_green').is(':checked');
                var flag_red = $('#flag_red').is(':checked');
                var flag_yellow = $('#flag_yellow').is(':checked');
                var flag_blue = $('#flag_blue').is(':checked');
                var flag_black = $('#flag_black').is(':checked');
                var flag_all = $('#flag_all').is(':checked');
                if (flag_green && aData[14] === 'flag_green') {
                    return true;
                } else if (flag_red && aData[14] === 'flag_red') {
                    return true;
                } else if (flag_yellow && aData[14] === 'flag_yellow') {
                    return true;
                } else if (flag_blue && aData[14] === 'flag_blue') {
                    return true;
                } else if (flag_black && aData[14] === 'flag_black') {
                    return true;
                } else if (flag_all) {
                    return true;
                }
                return false;
            });
            oTable.fnDraw();
        });

        jQuery('#check_pass').on('click', function (e) {
            e.preventDefault();
            if ($('input[name=date_sent_touralensis]').val() === '') {
                jQuery.sticky('Released Lab Date Must Not Be Empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('input[name=rec_by_doc_date]').val() === '') {
                jQuery.sticky('Received By Doctor Date Must Not Be Empty.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }
            if ($('select[name=cost_codes]').val() === '') {
                jQuery.sticky('Please select cost code first in order to publish. If you have not added the cost code yet then add first.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
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
                        jQuery('#publish_button').html(response.message);
                        window.setTimeout(function () {
                            window.location.href = "<?php echo base_url('/index.php/institute/doctor_record_list?msg=success'); ?>";
                        }, 2000);
                    } else {
                        jQuery('#publish_button').html(response.message);
                    }
                }
            });
        });

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

        jQuery(document).on('click', '.update_doctor_personal_report_btn', function (e) {
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
                        }, 2000);
                    } else {
                        jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
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

        jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", true).css('background', '#ccc');
        jQuery("#make_editable").on('click', function (e) {
            e.preventDefault();
            if (jQuery("#make_editable").hasClass('disable')) {
                jQuery("#make_editable").removeClass('disable');
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", false);
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").css('background', 'white');
                jQuery("#make_editable").addClass('enable');
                jQuery("#make_editable").css('background-color', '#ccc');
            } else if (jQuery("#make_editable").hasClass('enable')) {
                jQuery("#make_editable").removeClass('enable');
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").prop("readonly", true);
                jQuery("#doctor_update_personal_record input[type='text'], #doctor_update_personal_record textarea, #doctor_update_personal_record select").css('background', '#ccc');
                jQuery("#make_editable").addClass('disable');
                jQuery("#make_editable").css('background-color', '#4bd12b');
            }

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
            } else {
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
            $('#advance_search_table').toggle('slow');
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

        if ($('input[name=mdt_dates_radio]:checked').val() === 'for_mdt') {
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
                                setTimeout(function () {
                                    $('#mdt_message_modal').modal('show');
                                }, 500);
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
                        return '<div class="' + item.umc_added_by + '">' + item.umc_code + '</div>';
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
            _this.attr('data-microcodeid', selection.umc_id);
            clearInterval(timer);
            timer = setTimeout(function (e) {
                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/doctor/set_populate_micro_data'); ?>',
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
                                            var classification_value = _this.val();

                                            if ($.inArray(classification_value, classification_array) !== -1) {
                                                _this.prop('checked', true);
                                            }
                                        });
                                    } else if (index === 'umc_snomed_m_code') {
                                        var snomed_m_code = value;
                                        snomed_m_code_array = snomed_m_code.split(',');
                                        var snomed_m_code_val = _this.parents('#doctor_update_specimen_record_' + form_id).find('.specimen_snomed_m_' + form_id);
                                        $(snomed_m_code_val).selectpicker('val', snomed_m_code_array);
                                        $('#snomed-values-' + form_id).find('.snomed-m').text(value);

                                        var snome_multi_selected_vals = $('#doctor_update_specimen_record_' + form_id).find(".specimen_snomed_m_" + form_id + " option:selected");
                                        console.log(snome_multi_selected_vals);
                                        var snomedDiagnosesArr = [];
                                        var snomedVals = [];
                                        var rcpathScore = [];
                                        $.each(snome_multi_selected_vals, function (parent_key, parent_value) {
                                            snomedDiagnosesArr = $(this).data('diagnoses').split(',');
                                            rcpathScore[parent_key] = $(this).data('rcpath');
                                        });
                                        var snomedCheckBox = jQuery('#doctor_update_specimen_record_' + form_id).find('.specimen_classification_' + form_id);
                                        $.each(snomedDiagnosesArr, function (key, value) {
                                            $.each(snomedCheckBox, function (input_key, input_value) {
                                                if (typeof value !== 'undefined' && value == $(this).val()) {
                                                    $(this).prop('checked', true);
                                                }
                                            });
                                        });

                                        var rcpathMaxVal = Math.max.apply(Math, rcpathScore);
                                        jQuery('#doctor_update_specimen_record_' + form_id).find('.rcpath_codedata_' + form_id).val(rcpathMaxVal);

                                    } else {
                                        if (index === 'umc_micro_desc') {
                                            console.log(_this);
                                            // tinymce.get("specimen_microscopic_description_"+form_id).setContent(value);
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find("#specimen_microscopic_description_" + form_id).val(value);
                                        }
                                        if (index === 'umc_rcpath_score') {
                                            _this.parents('#doctor_update_specimen_record_' + form_id).find('.rcpath_codedata_' + form_id).val(value);
                                        }
                                    }
                                });
                                $("#ajax_loading_effect").fadeOut();
                            }, 1000);

                            window.setTimeout(function () {
                                $('#doctor_update_specimen_record_' + form_id).find('.specimen-micro-area .change-micro-btn').show();
                                var micro_desc = _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_' + form_id).val().match(/\sX\s|\sx\s/g);
                                if (micro_desc != null && micro_desc.length != 0) {
                                    _this.parents('#doctor_update_specimen_record_' + form_id).find('#change-micro-x-val-' + form_id).modal('show');
                                }
                            }, 1000);

                            $(document).on('click', '.btn-add-x-val', function (e) {
                                e.preventDefault();
                                var _this = $(this);
                                var inputXVal = _this.parents('#change-micro-x-val-' + form_id).find('input[name=micro_x_val]').val();

                                var micro_desc = _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_' + form_id).val();
                                micro_desc = micro_desc.replace(/\sX\s|\sx\s/, ' ' + inputXVal + ' ');
                                _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_' + form_id).val(micro_desc);
                                _this.parents('#change-micro-x-val-' + form_id).modal('hide');
                                _this.parents('#change-micro-x-val-' + form_id).find('input[name=micro_x_val]').val('');
                            });

                            $('#change-micro-x-val-' + form_id).on('hidden.bs.modal', function () {
                                var micro_desc = _this.parents('#doctor_update_specimen_record_' + form_id).find('#specimen_microscopic_description_' + form_id).val().match(/\sX\s|\sx\s/g);
                                if (micro_desc != null && micro_desc.length != 0) {
                                    _this.parents('#doctor_update_specimen_record_' + form_id).find('#change-micro-x-val-' + form_id).modal('show');
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

        $(document).on('click', '.btn-spcimen-add', function (e) {
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
                data: {
                    password1: password1,
                    password2: password2,
                    password3: password3,
                    password4: password4,
                    record_ids: check_value
                },
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
                    data: {'lab_id': lab_id},
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
                    data: {'lab_number': lab_number},
                    success: function (data) {
                        if (data.type === 'error') {
                            jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                            _this.parents('#doctor_update_personal_record').find('#update_doctor_personal_report_btn').hide();
                        } else {
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
                            location.reload();
                        }, 1800);
                    } else {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    }
                }
            });
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
            var input_key = _this.parents('.input_color').data('key');
            if ($("#make_editable").hasClass('enable')) {
                var record_data = '&key=' + input_key + '&' + $('#doctor_update_personal_record').serialize();

                jQuery.ajax({
                    url: '<?php echo base_url('/index.php/doctor/set_input_change_color'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: record_data,
                    success: function (data) {
                        if (data.type === 'success') {
                            _this.parents('.input_color').addClass(data.color_code);
                            jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        }
                    }
                });
            } else {
                jQuery.sticky('Please enable the fields first.', {classList: 'important', speed: 200, autoclose: 5000});
            }
        });

        jQuery(document).on('change', '.dataset-form-html input[type=checkbox]', function () {
            var _this = $(this);
            if (_this.is(':checked')) {
                _this.attr('checked', 'checked');
            } else {
                _this.removeAttr('checked');
            }
        });

        jQuery(document).on('click', '.moveable_text', function (e) {
            e.preventDefault();
            var _this = jQuery(this);
            var specimen_id = _this.data('datasetspecimenid');
            var record_id = _this.data('recordid');
            var form_html = document.querySelector('.dataset-form-html').innerHTML;

            tinymce.get("specimen_microscopic_description_" + specimen_id).setContent('<div class="form">' + form_html + '</div>');
            var form_data = jQuery('.dataset_form').serialize();

            jQuery.ajax({
                url: '<?php echo base_url('/index.php/doctor/set_microscopic_data'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'form_data': form_html, 'record_id': record_id},
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
    });

    $(document).ready(function () {

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
            } else {
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
                jQuery.sticky('Please select the clinic user first.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            if ($('input[name=pathologist]').is(':checked') === false) {
                jQuery.sticky('Please select the pathologist first.', {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
                return false;
            }

            if ($('input[name=tracking_no]').val() === '') {
                jQuery.sticky('Please enter the tracking no.', {classList: 'important', speed: 200, autoclose: 7000});
                return false;
            }

            $('.show_template_name_input').show();

            if ($('input[name=track_template_name]').val() === '') {
                jQuery.sticky("Please enter the template name first.", {
                    classList: 'important',
                    speed: 200,
                    autoclose: 7000
                });
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
                limit: 300,
                templates: {
                    suggestion: function (item) {
                        return '<div><a href="<?= base_url(SEARCH_RECORD_LINK_PATH); ?>' + item.record_id + '">' + item.serial_number + ' --- ' + item.first_name + ' ' + item.surname + '</a></div>';
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

        $(document).on('click', '.collapse-related-docs', function (e) {
            e.preventDefault();
            $('.related-doc-collapse-section').collapse('toggle');
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
    });


    $(document).ready(function () {
        datatables_render_table = false;
        load_ajax_publish_record_data('', '', '', '');

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
                var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
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

    function load_ajax_publish_record_data(flag_type, sort_authorize, urgency_type, row_color_code) {

        var url = window.location.href;
        var url_year = url.split('/').reverse()[1];
        var url_type = url.split('/').reverse()[0];
        var ajax_url = "<?php echo base_url('index.php/doctor/display_published_reports_ajax_processing/'); ?>";

        var oTable = $('#doctor_record_publish_table').DataTable({
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
                data: {
                    'year': url_year,
                    'type': url_type,
                    'flag_type': flag_type,
                    'sort_authorize': sort_authorize,
                    'urgency_type': urgency_type,
                    'row_color_code': row_color_code
                }
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
                var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
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

                if (tat5 && aData[12] <= 5) {
                    return true;
                } else if (tat10 && aData[12] <= 10) {
                    return true;
                } else if (tat20 && aData[12] > 10 && aData[12] <= 20) {
                    return true;
                } else if (tat30 && aData[12] > 20) {
                    return true;
                } else if (tat_all) {
                    return true;
                }

                return false;
            });
            oTable.fnDraw();
        });
    }

    function filter_row_by_hospital_on_record_list(oTable) {
        $(document).on('click', '.filter_by_hospital_btn', function (e) {
            e.preventDefault();
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                var selected_hos_val = $('.filter_by_hospital').val();
                if (selected_hos_val && aData[17] === selected_hos_val) {
                    return true;
                }
                return false;
            });
            oTable.fnDraw();
        });
    }

    function filter_row_status_on_record_list(oTable) {
        $(document).on('click', '.row_status', function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                var row_yellow = $('#row_yellow').is(':checked');
                var row_orange = $('#row_orange').is(':checked');
                var row_purple = $('#row_purple').is(':checked');
                var row_green = $('#row_green').is(':checked');
                var row_skyblue = $('#row_skyblue').is(':checked');
                var row_blue = $('#row_blue').is(':checked');
                var row_brown = $('#row_brown').is(':checked');
                var row_gray = $('#row_gray').is(':checked');

                if (row_yellow && aData[15] === 'row_yellow') {
                    return true;
                } else if (row_orange && aData[15] === 'row_orange') {
                    return true;
                } else if (row_purple && aData[15] === 'row_purple') {
                    return true;
                } else if (row_green && aData[15] === 'row_green') {
                    return true;
                } else if (row_skyblue && aData[15] === 'row_skyblue') {
                    return true;
                } else if (row_blue && aData[15] === 'row_blue') {
                    return true;
                } else if (row_brown && aData[15] === 'row_brown') {
                    return true;
                } else if (row_gray) {
                    return true;
                }
                return false;
            });
            oTable.fnDraw();
        });
    }

    function filter_report_urgency_status_on_record_list(oTable) {
        $(document).on('click', '.report_urgency_status', function (e) {
            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
                var report_urgent = $('#report_urgent').is(':checked');
                var report_routine = $('#report_routine').is(':checked');
                var report_2ww = $('#report_2ww').is(':checked');


                if (report_urgent && aData[16] === 'Urgent') {
                    return true;
                } else if (report_routine && aData[16] === 'Routine') {
                    return true;
                } else if (report_2ww && aData[16] === '2WW') {
                    return true;
                }

                return false;
            });
            oTable.fnDraw();
        });
    }

    function gettatvalue(tatno) {
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


            $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {

                var flag_green = $('#flag_green').is(':checked');
                var flag_red = $('#flag_red').is(':checked');
                var flag_yellow = $('#flag_yellow').is(':checked');
                var flag_blue = $('#flag_blue').is(':checked');
                var flag_black = $('#flag_black').is(':checked');
                var flag_all = $('#flag_all').is(':checked');


                if (flag_green && aData[14] === 'flag_green') {
                    return true;
                } else if (flag_red && aData[14] === 'flag_red') {
                    return true;
                } else if (flag_yellow && aData[14] === 'flag_yellow') {
                    return true;
                } else if (flag_blue && aData[14] === 'flag_blue') {
                    return true;
                } else if (flag_black && aData[14] === 'flag_black') {
                    return true;
                } else if (flag_all) {
                    return true;
                }
                return false;
            });

            oTable.fnDraw();
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
                jQuery.sticky('Session has timedout, Please wait while the page refresh.', {
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

        $(document).on('click', '.specimen_pm_msg_btn', function (e) {
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
                data: {
                    'lab_user_id': lab_user_id,
                    'msg_subject': msg_subject,
                    'msg_body': msg_body,
                    'record_id': record_id
                },
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function () {
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

        $(document).one('click', '.add-snomed-code', function (e) {
            e.preventDefault();
            var _this = $(this);
            var snomed_type = _this.parents('.snomed_codes').find('input[name=snomed_type]').val();
            if (snomed_type === 't1') {
                var formvalue = jQuery('.snomed_code_from_t1').serialize();
            } else if (snomed_type === 'p') {
                var formvalue = jQuery('.snomed_code_from_p').serialize();
            } else {
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
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    }
                }
            });
        });

        $(document).on('click', '.snomed_code_privmsg', function (e) {
            e.preventDefault();
            var _this = $(this);
            var msg_subject = _this.parents('.snomed_privmsg_form').find('input[name=privmsg_subject]').val();
            var msg_body = _this.parents('.snomed_privmsg_form').find('textarea[name=privmsg_body]').val();
            var admin_id = _this.parents('.snomed_privmsg_form').find('input[name=admin_id]').val();
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/sendMessageSnomedToAdmin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'msg_subject': msg_subject, 'msg_body': msg_body, 'admin_id': admin_id},
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function () {
                            _this.parents('.snomed_privmsg_form').find('textarea[name=privmsg_body]').val('');
                            _this.parents('.modal').modal('hide');
                        }, 1000);
                    }
                }
            });
        });

        $(document).on('click', '.micro_code_privmsg_btn', function (e) {
            e.preventDefault();
            var _this = $(this);
            var msg_subject = _this.parents('.micro_code_privmsg_form').find('input[name=privmsg_subject]').val();
            var msg_body = _this.parents('.micro_code_privmsg_form').find('textarea[name=privmsg_body]').val();
            var admin_id = _this.parents('.micro_code_privmsg_form').find('input[name=admin_id]').val();
            $.ajax({
                url: '<?php echo base_url('/index.php/doctor/sendMessageMicrocodeToAdmin'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {'msg_subject': msg_subject, 'msg_body': msg_body, 'admin_id': admin_id},
                success: function (data) {
                    if (data.type == 'error') {
                        jQuery.sticky(data.msg, {classList: 'important', speed: 200, autoclose: 5000});
                    } else {
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        setTimeout(function () {
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

        $(window).on('load', function () {
            $.each($('.specimen_content .tg-themenavtabs li'), function (key, value) {
                if ($(this).hasClass('active')) {
                    $('#datasets-accordian').find('.dataset_specimen_id').attr('data-datasetspecimenid', $(this).data('currentspceimentab'));
                }
            });
        });
        $('.specimen_content .tg-themenavtabs li').click(function () {
            var _this = $(this);
            $('#datasets-accordian').find('.dataset_specimen_id').attr('data-datasetspecimenid', _this.data('currentspceimentab'));
        });

    });

    function check_surname() {
        jQuery("#check_auth_pass_form .ura-surname-field input").keyup(function () {
            var _this = jQuery(this);
            var surname_letter = _this.val();
            var record_id = _this.parents('.ura-surname-field').data('recordid');
            var key_name = _this.data('namekey');
            var key_value = _this.data('namevalue');
            var surname_array_last = _this.parents('#check_auth_pass_form').find('input[name=surname_data]').val();

            if (_this.val().length >= 1) {
                if (key_value == surname_letter) {
                    // jQuery.sticky('Letter Match Successfully', {classList: 'success', speed: 200, autoclose: 5000});
                    var input_flds = _this.closest('#check_auth_pass_form').find('.ura-surname-field :input');
                    input_flds.eq(input_flds.index(_this) + 1).focus();
                    if (parseInt(surname_array_last) === key_name) {
                        jQuery('.ura-pin-area').show();
                    }
                    _this.removeClass('surname-field-error');
                    _this.prop('disabled', true);
                } else {
                    _this.addClass('surname-field-error');
                    jQuery.sticky('Letter did not match.', {classList: 'important', speed: 200, autoclose: 5000});
                }
            } else {
                jQuery.sticky('Please enter the letter.', {classList: 'important', speed: 200, autoclose: 5000});
            }
        });
    }

    $('#doctor_record_list_table_wrapper').dataTable({
        "bInfo": false
    });
    $(".flags-select li a.badge-info").click(function () {
        $(".select-flag").removeClass("badge-success badge-danger badge-warning badge-dark").addClass("badge-info");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-danger").click(function () {
        $(".select-flag").removeClass("badge-success badge-info badge-warning badge-dark").addClass("badge-danger");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-warning").click(function () {
        $(".select-flag").removeClass("badge-success badge-info badge-danger badge-dark").addClass("badge-warning");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-dark").click(function () {
        $(".select-flag").removeClass("badge-success badge-info badge-danger badge-warning").addClass("badge-dark");
        $(".flags-select").removeClass("show");
    });
    $(".flags-select li a.badge-success").click(function () {
        $(".select-flag").removeClass("badge-dark badge-info badge-danger badge-warning").addClass("badge-success");
        $(".flags-select").removeClass("show");
    });

</script>
<script type="text/javascript">
    $("#show_pdf_iframe, .show_pdf_iframe2").click(function () {
        $(".display_iframe_pdf").toggleClass("show");
    });
    $(".btn-dismis, .close").click(function () {
        $(".modal.fade").removeClass("in");
        $(".modal.fade").removeClass("show");
    });

    $(".collapse-related-docs").click(function () {
        $("#relateddocs").toggleClass("show");
    });
    $("a#show_hidden").click(function () {
        $("a.tg-detailsicon.hide_tag_selection").removeClass("hide_tag_selection");
    });

    $(document).ready(function () {
        setTimeout("jQuery('.user_edit_status').hide();", 10000);
        setTimeout("jQuery('.user_add_report_status').hide();", 10000);
    });
</script>
<script type="text/javascript">
    window.onload = function () {
        var chart = new CanvasJS.Chart("tats_graph",
            {
                title: {
                    // text: "A Combination of five dataSeries"

                },
                axisX: {
                    // title: "Year",
                    xValueFormatString: "MMM YYYY",
                    //reversed: true
                },
                data: [{
                    type: "column",
                    color: "#00c5fb",
                    axisXType: "secondary",
                    dataPoints: [
                        {x: new Date(2019, 1), y: 171},
                        {x: new Date(2019, 2), y: 155},
                        {x: new Date(2019, 3), y: 150},
                        {x: new Date(2019, 4), y: 165},
                        {x: new Date(2019, 5), y: 195},
                        {x: new Date(2019, 6), y: 168},
                        {x: new Date(2019, 7), y: 128},
                        {x: new Date(2019, 8), y: 134},
                        {x: new Date(2019, 9), y: 114},
                        {x: new Date(2019, 10), y: 190}
                    ]
                },
                    // {
                    //   type: "column",
                    //   color:"#0253cc",
                    //   dataPoints: [
                    //   { x: new Date(2019, 1), y: 101 },
                    //   { x: new Date(2019, 2), y: 105 },
                    //   { x: new Date(2019, 3), y: 100 },
                    //   { x: new Date(2019, 4), y: 105 },
                    //   { x: new Date(2019, 5), y: 105 },
                    //   { x: new Date(2019, 6), y: 108 },
                    //   { x: new Date(2019, 7), y: 108 },
                    //   { x: new Date(2019, 8), y: 104 },
                    //   { x: new Date(2019, 9), y: 104 },
                    //   { x: new Date(2019, 10), y: 117 }
                    //   ]
                    // },

                    {
                        type: "line",
                        color: "#ffbc34",
                        axisXType: "secondary",
                        lineDashType: "dash",
                        dataPoints: [
                            {x: new Date(2019, 1), y: 71},
                            {x: new Date(2019, 2), y: 55},
                            {x: new Date(2019, 3), y: 50},
                            {x: new Date(2019, 4), y: 65},
                            {x: new Date(2019, 5), y: 95},
                            {x: new Date(2019, 6), y: 68},
                            {x: new Date(2019, 7), y: 28},
                            {x: new Date(2019, 8), y: 34},
                            {x: new Date(2019, 9), y: 14},
                            {x: new Date(2019, 10), y: 29}
                        ]
                    },
                    {
                        type: "line",
                        color: "#FF0000",
                        axisXType: "secondary",
                        lineDashType: "dash",
                        dataPoints: [
                            {x: new Date(2019, 1), y: 171},
                            {x: new Date(2019, 2), y: 105},
                            {x: new Date(2019, 3), y: 90},
                            {x: new Date(2019, 4), y: 65},
                            {x: new Date(2019, 5), y: 75},
                            {x: new Date(2019, 6), y: 68},
                            {x: new Date(2019, 7), y: 28},
                            {x: new Date(2019, 8), y: 34},
                            {x: new Date(2019, 9), y: 84},
                            {x: new Date(2019, 10), y: 98}
                        ]
                    }
                ]
            });

        chart.render();
    }
</script>
