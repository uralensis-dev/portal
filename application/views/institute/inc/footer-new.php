</div></div>
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



<!-- Bootstrap Core JS -->
<script src="<?php echo base_url() ?>/assets/institute/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>/assets/institute/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="<?php echo base_url() ?>/assets/institute/js/jquery.slimscroll.min.js"></script>

<!-- Chart JS -->
<script src="<?php echo base_url() ?>/assets/institute/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url() ?>/assets/institute/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>/assets/institute/js/chart.js"></script>


<script src="<?php echo base_url() ?>/assets/institute/js/jquery.smartWizard.js"></script>

<script src="<?php echo base_url() ?>/assets/institute/js/jquery.date-dropdowns.js"></script>


<!-- Datetimepicker JS -->
<script src="<?php echo base_url() ?>/assets/institute/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>/assets/institute/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap-select.min.js"></script>

<script src="<?php echo base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>/assets/newtheme/js/dataTables.bootstrap4.min.js"></script>

<script src="<?php echo base_url('/assets/newtheme/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/vfs_fonts.js'); ?>"></script>   
<script src="<?php echo base_url('/assets/newtheme/js/jszip.min.js'); ?>"></script>

<?php $this->load->view("session");?>
<script src="<?php echo base_url() ?>/assets/js/select2.min.js"></script>
<script src="<?php echo base_url('/assets/js/scrollbar.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.blockUI.js'); ?>"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url('/assets/js/jquery.cookie.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/bloodhound.js'); ?>"></script

<!-- Custom JS -->
<script src="<?php echo base_url('/assets/js/sticky_message.js'); ?>"></script>
<script src="<?php echo base_url() ?>/assets/newtheme/js/app.js"></script>
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
<script>
    // Base url as javascript variable
    const _base_url = `<?php echo base_url() ?>`
    const default_profile_pic = `<?php echo base_url().DEFAULT_PROFILE_PIC?>`;
</script>
<script>
    // Type
    // success, info, important, warning
    function message(msg="", type="success", duration=7000) {
        jQuery.sticky(msg, {classList: type, speed: 200, autoclose: duration});
    }
    // CSRF Token
    var csrf_cookie = $.cookie("<?php echo $this->config->item("csrf_cookie_name"); ?>");
    var csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>


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

    function confirmDelete() {
        if (confirm('Are you sure to want delete this entry?')) {
            return true;
        } else {
            return false;
        }
    }

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
        $(".tg-cancel label").click(function() {
            $(this).parent("span").find("input").prop("checked", true);
            $(this).parent("span").find("input").trigger("click");
        });
        $('.tg-radio').click(function(){
            $(this).parent().children('.tg-cancel').show();
            });
         $('.tg-cancel').click(function(){
            $(this).hide();
        });

        $('#dateandtime').datetimepicker({
            "defaultDate": new Date(),
            dateFormat: 'yyyy:mm:dd',
        });

        $('#edit_req_from_to').on('submit', function (e) {
            e.preventDefault();
            if ($('#ed_identifier_name').val() == '') {
                $error_html = '<div class="alert alert-danger alert-dismissible">' +
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                    '<span>Identifier name cannot be empty</span>' +
                    '</div>';
                $('#ed_error_alert').html($error_html);
                $('#ed_identifier_name').focus();
            } else {
                $.ajax({
                    url: "<?php echo base_url('index.php/institute/edit_request_from_to_data'); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                        if (response.type === 'success') {
                            $('#ed_error_alert').html('');
                            $success_html = '<div class="alert alert-success alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>' + response.msg + '</span>' +
                                '</div>';
                            $('#ed_success_alert').html($success_html);
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $error_html = '<div class="alert alert-danger alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>' + response.msg + '</span>' +
                                '</div>';
                            $('#ed_error_alert').html($error_html);
                        }
                    }
                });
            }
        });

        $('#add_req_from_to').on('submit', function (e) {
            e.preventDefault();
            if ($('#ad_identifier_name').val() == '') {
                $error_html = '<div class="alert alert-danger alert-dismissible">' +
                    '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                    '<span>Identifier name cannot be empty</span>' +
                    '</div>';
                $('#ad_error_alert').html($error_html);
                $('#ad_identifier_name').focus();
            } else {
                $.ajax({
                    url: "<?php echo base_url('index.php/institute/add_request_from_to_data'); ?>",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                        if (response.type === 'success') {
                            $('#ad_error_alert').html('');
                            $success_html = '<div class="alert alert-success alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>' + response.msg + '</span>' +
                                '</div>';
                            $('#ad_success_alert').html($success_html);
                            window.setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        } else {
                            $error_html = '<div class="alert alert-danger alert-dismissible">' +
                                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                                '<span>' + response.msg + '</span>' +
                                '</div>';
                            $('#ad_error_alert').html($error_html);
                        }
                    }
                });
            }
        });



        $(document).on('click', '#insertspecimen', function (e) {
            e.preventDefault();

            var form_data = $('#add_specimen_form').serialize() + '&<?php echo   $this->security->get_csrf_token_name(); ?>=<?php echo   $this->security->get_csrf_hash(); ?>';

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/AddSubmitSpecimenHospital'); ?>',

                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {

                    if (data.type === 'success') {
                        alert(data.msg);

                        //alert("Data Saved!!")
                        // document.location.reload();
                    } else {
                        alert("Something Went Wrong!!")

                    }
                }
            });
        });


        $(document).on('click', '.updateSpec', function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
            var idno = id.split("_");


            var form_data = $('#edit_form_' + idno[1]).serialize() + '&<?php echo   $this->security->get_csrf_token_name(); ?>=<?php echo   $this->security->get_csrf_hash(); ?>';

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/SubmitSpecimenHospital/'); ?>' + idno[1],

                type: 'POST',
                global: false,
                dataType: 'json',
                data: form_data,
                success: function (data) {
                    if (data.type === 'success') {
                        alert(data.msg);

                        //alert("Data Saved!!")
                        // document.location.reload();
                    } else {
                        alert("Something Went Wrong!!")

                    }
                }
            });

        });

        $(".select2").select2();

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
    });


    function set_templates_scrollbar() {
        //Scoll Script
        $('.ura-custom-scrollbar').mCustomScrollbar({
            axis: "y",
        });
    }

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

    function flag_tooltip() {
        $('.flag_column').on('mouseover', 'li', function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'hover',
                html: true
            });
        });
    }



    function deletespeciment(id) {
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/deletespeciment'); ?>',

            type: 'POST',
            global: false,
            dataType: 'json',
            data: {'specimen_id': id},
            success: function (data) {

                if (data.type === 'success') {

                    alert(data.msg);
                    window.location.reload(true);

                }
            }
        });

    }


    function getAge(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        $("#age").val(age);
    }



    function DeleteTemplate() {
        var templateid = $("#template_id").val();

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/updateTemplateWithId'); ?>',
            beforeSend: function () {
                // setTimeout($.blockUI(), 2000);
                // Handle the beforeSend event
            },
            complete: function () {
                //  $.unblockUI();
                // Handle the complete event
            },
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {"value": '0', "collumnName": "temp_status", "template_id": $("#template_id").val()},
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        // alert("Template Deleted!!");
                        jQuery.sticky("Template Deleted!!", {classList: 'success', speed: 200, autoclose: 7000});
                        location.reload();
                    }, 500);

                }
            }
        });

    }


    function getcodeEdit(value) {

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/getTCodes'); ?>',
            beforeSend: function () {
                //  setTimeout($.blockUI(), 2000);
                // Handle the beforeSend event
            },
            complete: function () {
                //  $.unblockUI();
                // Handle the complete event
            },
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {'specialty_id': value},
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        $('#spctype_divedit').html(data.data);
                    }, 500);

                }
            }
        });

    }

    function getCodes(value) {

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/getTCodes'); ?>',
            beforeSend: function () {
                // setTimeout($.blockUI(), 2000);
                // Handle the beforeSend event
            },
            complete: function () {
                // $.unblockUI();
                // Handle the complete event
            },
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {'specialty_id': value},
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        $('#spctype_div').html(data.data);
                    }, 500);

                }
            }
        });

    }


    function submitAllBookinPAge() {
        //setTimeout($.unblockUI, 2000);

        var barcode = $("#barcode_no").val();
        var nhs_number = $("#nhs_number").val();
        var serial_number = $("#serial_number").val();
        var clinic_txt = $("#clinic_txt").val();
        var assessment_no = $("#assessment_no").val();
        var hospital_no = $("#hospital_no").val();
        var f_name = $("#f_name").val();
        var sur_name = $("#sur_name").val();
        var dob = $("#dob").val();
        var age = $("#age").val();
        var gender = $("#gender").val();
        var emis_no = $("#emis_no").val();
        var courier_no = $("#courier_no").val();
        var batch_no = $("#batch_no").val();
        var clinician_no = $("#clinician_no").val();
        var location = $("#location").val();
        var toDate = $("#toDate").val();
        var Speciality = $("#Speciality").val();
        var digino = $("#digino").val();
        var urgency = $("#urgency").val();
        var labdate = $("#labdate").val();
        var rcpath = $("#rcpath").val();
        var specimen_snomed_t = $("#specimen_snomed_t").val();
        var specimen_diagnosis_description = $("#specimen_diagnosis_description").val();
        var specimen_macroscopic_description = $("#specimen_macroscopic_description").val();
        var request_id = $("#request_id").val();
        var specimen_block = $("#specimen_block").val();

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record_submit'); ?>',
            beforeSend: function () {
                // setTimeout($.blockUI(), 2000);
                // Handle the beforeSend event
            },
            complete: function () {
                //  $.unblockUI();
                // Handle the complete event
            },
            type: 'POST',
            global: false,
            dataType: 'json',
            data: {
                'barcode': barcode,
                'nhs_number': nhs_number,
                'serial_number': serial_number,
                'clinic_txt': clinic_txt,
                'assessment_no': assessment_no,
                'hospital_no': hospital_no,
                'f_name': f_name,
                'sur_name': sur_name,
                'dob': dob,
                'age': age,
                'gender': gender,
                'emis_no': emis_no,
                'courier_no': courier_no,
                'batch_no': batch_no,
                'clinician_no': clinician_no,
                'location': location,
                'toDate': toDate,
                'Speciality': Speciality,
                'digino': digino,
                'urgency': urgency,
                'labdate': labdate,
                'rcpath': rcpath,
                'specimen_snomed_t': specimen_snomed_t,
                'specimen_diagnosis_description': specimen_diagnosis_description,
                'specimen_macroscopic_description': specimen_macroscopic_description,
                'request_id': request_id,
                'specimen_block': specimen_block
            },
            success: function (data) {
                if (data.type === 'success') {
                    setTimeout(function () {
                        getsearchbarcode();
                        console.log("submitAllBookinPAge sending alert");
                        jQuery.sticky(data.msg, {classList: 'success', speed: 200, autoclose: 7000});
                        // alert(data.msg);
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
    $("#sidebar-menu").find("a").click(function(event) {
            var loc = $(this).attr('href');
            if (loc != '#') {
                window.location.href = loc;
            }
        });

    $("#tags").focusin(function () {
        if ($(this).val() != '') {
            $(".new_temp").addClass("show_div");
        }
    });

    var d = new Date();
    var currMonth = d.getMonth();
    var currYear = d.getFullYear();
    var startDate = new Date(currYear, currMonth, 1);

    $(".datepicker").datepicker("setDate", startDate);
    $(".batch_up").click(function(){
        $("#batch-bookingin").removeClass("show");
        $("#patient-booking").removeClass("show");
    });


</script>

<script>
$(document).ready(function() {
    var csrfToken = {
        "<?php echo   $this->security->get_csrf_token_name(); ?>": "<?php echo   $this->security->get_csrf_hash(); ?>",
    };

    //Show templates boxes data on click
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

    $(document).on('click', "input[name='lab_name']", function() {
        var _this = $(this);
        var lab_name = $("input[name='lab_name']:checked").data('labname');
        var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Lab: <em>' + lab_name + '</em><i>+</i></span></a>';
        _this.parents('.tg-topic').find('.display_selected_option').text(lab_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-labs').html(tag_html);
    });
    $(document).on('click', "input[name='pathologist']", function() {
        var _this = $(this);
        var pathologist_name = $("input[name='pathologist']:checked").data('pathologist');
        var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Pathologist: <em>' + pathologist_name + '</em><i>+</i></span></a>';
        _this.parents('.tg-topic').find('.display_selected_option').text(pathologist_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-pathologist').html(tag_html);
    });
    $(document).on('click', "input[name='report_urgency']", function() {
        var _this = $(this);
        var urgency_name = $("input[name='report_urgency']:checked").data('urgency');
        var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Urgency: <em>' + urgency_name + '</em><i>+</i></span></a>';
        _this.parents('.tg-topic').find('.display_selected_option').text(urgency_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-urgency').html(tag_html);
    });
    $(document).on('click', "input[name='specimen_type']", function() {
        var _this = $(this);
        var specimentype_name = $("input[name='specimen_type']:checked").data('specimentype');
        var tag_html = '<a class="tg-tag" href="javascript:;"><i class="fa fa-check"></i><span>Specimen Type: <em>' + specimentype_name + '</em><i>+</i></span></a>';
        _this.parents('.tg-topic').find('.display_selected_option').text(specimentype_name);
        _this.parents('.show-data-holder').css({ "opacity": "0", "visibility": "hidden" });
        _this.parents('.tg-catagoryholder').find('.content-overlay').remove();
        _this.parents('.tg-trackrecords').find('.tg-tagsarea .tg-specimen').html(tag_html);
    });

    //Close Template Tags Data
    $(document).on('click', '.collapse_temp_data_btn', function(e) {
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

    //Update Pre-added template using ajax
    $(document).on('click', '.update-track-template', function(e) {
        e.preventDefault();

        var form_data = $('.track_temp_edit_form').serialize();

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/update_track_edit_temp_data'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Add New Track Teamplate
    $(document).on('click', '.add_new_track_template', function(e) {
        e.preventDefault();
        var _this = $(this);
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/load_track_new_template'); ?>',
            type: 'POST',
            data: csrfToken,
            global: false,
            dataType: 'json',
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-new-template-data').html(data.tmpl_new_data);
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    set_templates_scrollbar();
                } else {
                    _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-new-template-data').html('');
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Save new track template
    $(document).on('click', '.save-track-template', function(e) {
        e.preventDefault();

        if ($('input[name=pathologist]').is(':checked') === false) {
            jQuery.sticky('Please select the pathologist first.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }

        if ($('input[name=tracking_no]').val() === '') {
            jQuery.sticky('Please enter the tracking no.', { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }


        $('.show_template_name_input').show();

        if ($('input[name=track_template_name]').val() === '') {
            jQuery.sticky("Please enter the template name first.", { classList: 'important', speed: 200, autoclose: 7000 });
            return false;
        }


        var form_data = $('.track_temp_edit_form').serialize() + '&<?php echo   $this->security->get_csrf_token_name(); ?>=<?php echo   $this->security->get_csrf_hash(); ?>';

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/save_new_track_temp_data'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    document.location.reload();
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Search Track Template Ajax Request.
    $(document).on('click', '.tracking_template_button', function(e) {
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
            data: Object.assign(csrfToken, { 'templateid': templateid, 'hospitalid': hospitalid, 'clinicid': clinicid, 'pathologist': pathologist, 'labname': labname, 'urgency': urgency, 'speci': speci }),
            success: function(data) {
                _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html('');
                if (data.type === 'error') {
                    _this.parents('.tg-trackrecords').find('.track_temp_tags').html('');
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                } else {
                    _this.parents('.tg-trackrecords').find('.track_temp_tags').html(data.tags_data);
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Track Template edit button ajax request
    $(document).on('click', '.track_edit_template', function(e) {
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
            data: { 'template_id': template_id, 'hospital_id': hospital_id, 'clinic_userid': clinic_userid, 'pathologist': pathologist, 'labname': labname, 'urgency': urgency, 'specitype': specitype },
            success: function(data) {
                if (data.type === 'error') {
                    _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html('');
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                } else {
                    _this.parents('.tg-trackrecords').find('.tg-catagorytopics .load-track-edit-template-data').html(data.tmpl_edit_data);
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').find('.track_temp_edit_form .temp_id').val(template_id);
                    set_templates_scrollbar();
                }
            }
        });
    });

    //On Click get the data attribute
    //and embed it on list parent
    $(document).on('click', '.check_status_btn', function(e) {
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

    $(document).on('change', 'input[name=barcode_no]', function() {
        $(".barcode_no_search").trigger("click");
    });
    $(document).on('click', '.barcode_no_search', function(e) {
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
        $('.load-temp-data-list li').each(function(index) {
            if ($(this).hasClass('active')) {
                template_id = $(this).parents('.tg-trackrecords').find('.template-tags-container').data('templateid');
                is_template_select = true;
                return false;
            }
        });

        $('.statuses_tab .tab_status_content div').each(function(index) {
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
                data: Object.assign(csrfToken, { 'search_type': 'only_search', 'barcode': barcode }),
                success: function(data) {
                    if (data.type === 'success') {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                            _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                            $('input[name=barcode_no]').val('');
                            $('input[name=barcode_no]').focus();
                        }, 500);

                    } else {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                            _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                        }, 500);
                    }
                }
            });
        } else if (is_template_select === true && is_status_select === true) {
            console.log('adding', { 'search_type': 'add_record', 'barcode': barcode, 'template_id': template_id, 'status_code': status_code, 'csrf_token': csrfToken['csrf_token'] });

            _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { 'search_type': 'add_record', 'barcode': barcode, 'template_id': template_id, 'status_code': status_code, 'csrf_token': csrfToken['csrf_token'] },
                success: function(data) {
                    if (data.type === 'success') {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            _this.parents('.tg-searchspecimen').find('.tg-recordfound').hide();
                            _this.parents('.tg-searchspecimen').find('.tg-recordfound p').text('');
                            jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                            _this.parents('.tg-trackrecords').next('.row').find('.record_add_result').html(data.track_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                        }, 500);
                    } else if (data.type === 'update_statuses') {
                        setTimeout(function() {
                            $(_this.parents('.tg-trackrecords').next('.row').find('.track_search_table .track_session_row')).each(function(index) {
                                if ($(this).data('trackno') == barcode) {
                                    $(this).find('.tg-liststatuses').html(data.encode_status);
                                }
                            });
                            _this.parents('.tg-inputicon').find('i').remove();
                            _this.parents('.tg-searchspecimen').find('.tg-recordfound').show();
                            _this.parents('.tg-searchspecimen').find('.tg-recordfound p').text(data.status_msg);
                            jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                            set_templates_scrollbar();
                        }, 500);
                    } else {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                            _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                        }, 500);
                    }
                    setTimeout(function() {
                        $('input[name=barcode_no]').val('');
                        $('input[name=barcode_no]').focus();
                    }, 500);
                }
            });
        } else if (is_template_select === false && is_status_select === true) {
            _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
            console.log(Object.assign(csrfToken, { 'search_type': 'only_search', 'barcode': barcode }));

            $.ajax({
                url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { 'search_type': 'only_search', 'barcode': barcode },
                success: function(data) {
                    if (data.type === 'success') {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                            _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                            $('input[name=barcode_no]').val('');
                            $('input[name=barcode_no]').focus();
                        }, 500);
                    } else {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                            _this.parents('.tg-trackrecords').find('.tracking_search_result').html('');
                        }, 500);
                    }
                }
            });
        } 
		else if (is_template_select === true && is_status_select === false) 
		{
            _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/search_and_add_barcode_record'); ?>',
                type: 'POST',
                global: false,
                dataType: 'json',
                data: { 'search_type': 'only_search', 'barcode': barcode },
                success: function(data) {
                    if (data.type === 'success') {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                            _this.parents('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                            $('input[name=barcode_no]').val('');
                            $('input[name=barcode_no]').focus();
                        }, 500);
                    } else {
                        setTimeout(function() {
                            _this.parents('.tg-inputicon').find('i').remove();
                            jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
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
        if ($(this).text() === 'More') {
            $(this).find('i').removeClass('fa fa-angle-down');
            $(this).html('<span>Less</span><i class="fa fa-angle-up"></i>');
        } else {
            $(this).find('i').removeClass('fa fa-angle-up');
            $(this).html('<span>More</span><i class="fa fa-angle-down"></i>');
        }
    });

    $(document).on('change', 'input[name=searchspecimen]', function() {
        var _this = $(this);
        var search_val = _this.val();
        _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
        var redirect_url = '<?php echo base_url('index.php/institute/record_tracking'); ?>' + '/' + search_val;

        setTimeout(function() {
            _this.parents('.tg-inputicon').find('i').remove();
            window.location.href = redirect_url;
        }, 1500);
    });

    $(document).on('click', '.barcode_no_search_dashboard', function() {
        var _this = $(this);
        var search_val = _this.next('input[name=searchspecimen]').val();
        _this.parents('.tg-inputicon').append('<i class="fa fa-spin fa-spinner"></i>');
        var redirect_url = '<?php echo base_url('index.php/institute/record_tracking'); ?>' + '/' + search_val;

        setTimeout(function() {
            _this.parents('.tg-inputicon').find('i').remove();
            window.location.href = redirect_url;
        }, 1500);
    });


    //Toggle fw print options.
    $(document).on('click', '.display_fw_print_opt', function(e) {
        e.preventDefault();
        $('.fw_print_option').fadeToggle();
    });

    $(document).on('click', '.delete_hospital_doc', function(e) {
        e.preventDefault();
        var _this = $(this);
        var files_id = _this.data('filesid');
        var parent = _this.parent("td").parent("tr");
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/delete_institute_document_file'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'files_id': files_id },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(2500, function() {
                        parent.remove();
                    });
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
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
                { title: 'Upload Document', extensions: "doc,docx,xls,xlsx,ppt,pptx,csv,pdf,jpg,jpeg,gif,png" }
            ],
            max_file_size: '50mb',
            prevent_duplicates: true
        }
    });
    ProfileUploader.init();
    /* Run after adding file */
    ProfileUploader.bind('FilesAdded', function(up, files) {
        var html = '';
        var profileThumb = "";
        plupload.each(files, function(file) {
            profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
        });
        jQuery('.profile-img-wrap').html(profileThumb);
        up.refresh();
        ProfileUploader.start();

    });
    /* Run during upload */
    ProfileUploader.bind('UploadProgress', function(up, file) {
//            jQuery("#thumb-" + file.id).append('<figure class="user-avatar"><span class="tg-loader"><i class="fa fa-spinner"></i></span><span class="tg-uploadingbar"><span class="tg-uploadingbar-percentage" style="width:' + file.percent + ';"></span></span></figure>');
    });
    /* In case of error */
    ProfileUploader.bind('Error', function(up, err) {
        jQuery.sticky(err.message, { classList: 'important', speed: 200, autoclose: 5000 });
    });
    /* If files are uploaded successfully */
    ProfileUploader.bind('FileUploaded', function(up, file, ajax_response) {

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
            jQuery.sticky(response.message, { classList: 'important', speed: 200, autoclose: 5000 });
        }
    });
    //Delete Award Image
    jQuery(document).on('click', '.profile-img-wrap .delete_profile_pic', function(e) {
        e.preventDefault();
        var _this = jQuery(this);
        var file_path = _this.parents('.upload_area_form').find('input[name=upload_area_full_path]').val();
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/delete_upload_area_document'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'file_path': file_path },
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.upload_area_form').find('input[name=upload_area_file_name]').val('');
                    _this.parents('.upload_area_form').find('input[name=upload_area_file_path]').val('');
                    _this.parents('.upload_area_form').find('input[name=upload_area_full_path]').val('');
                    _this.parents('.upload_area_form').find('input[name=upload_area_file_ext]').val('');
                    _this.parents('.gallery-thumb-item').remove();
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Save Upload Area Document
    $(document).on('click', '.upload_area_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.upload_area_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/save_upload_area_document'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    window.location.reload();
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Upload Area Delete File
    $(document).on('click', '.upload_area_delete_file', function(e) {
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
            data: { 'file_id': file_id, 'full_path': full_path },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(2500, function() {
                        parent.remove();
                    });
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Update Upload Area Document Permissions.
    $(document).on('click', '.update_file_perms', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('.update_upload_area_perm').serialize();

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/update_upload_area_document_perms'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.modal').modal('hide');
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });


    //Login Tab Accrodian Script
    jQuery('.tg-panelcontent').hide();
    jQuery('.tg-accordion h4:first').addClass('active').next().slideDown('slow');
    jQuery('.tg-accordion h4').on('click', function() {
        if (jQuery(this).next().is(':hidden')) {
            jQuery('.tg-accordion h4').removeClass('active').next().slideUp('slow');
            jQuery(this).toggleClass('active').next().slideDown('slow');
        }
    });

    jQuery('#tg-btntoggle').on('click', function(event) {
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
                { title: 'Upload Document', extensions: "doc,docx,xls,xlsx,ppt,pptx,csv,pdf,jpg,jpeg,gif,png" }
            ],
            max_file_size: '50mb',
            prevent_duplicates: true
        }
    });
    Cl_Doc_Uploader.init();
    /* Run after adding file */
    Cl_Doc_Uploader.bind('FilesAdded', function(up, files) {
        var html = '';
        var profileThumb = "";
        plupload.each(files, function(file) {
            profileThumb += '<div class="tg-galleryimg gallery-item gallery-thumb-item" id="thumb-' + file.id + '">' + '' + '</div>';
        });
        jQuery('.cl-doc-profile-img-wrap').html(profileThumb);
        up.refresh();
        Cl_Doc_Uploader.start();

    });

    Cl_Doc_Uploader.bind('UploadProgress', function(up, file) {
    });

    Cl_Doc_Uploader.bind('Error', function(up, err) {
        jQuery.sticky(err.message, { classList: 'important', speed: 200, autoclose: 5000 });
    });

    Cl_Doc_Uploader.bind('FileUploaded', function(up, file, ajax_response) {

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
            jQuery.sticky(response.message, { classList: 'important', speed: 200, autoclose: 5000 });
        }
    });

    jQuery(document).on('click', '.cl-doc-profile-img-wrap .delete_profile_pic', function(e) {
        e.preventDefault();
        var _this = jQuery(this);
        var file_path = _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_full_path]').val();
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/delete_upload_area_document'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'file_path': file_path },
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_file_name]').val('');
                    _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_file_path]').val('');
                    _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_full_path]').val('');
                    _this.parents('.cl_doc_upload_area_form').find('input[name=upload_area_file_ext]').val('');
                    _this.parents('.gallery-thumb-item').remove();
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', '.cl_doc_upload_area_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = $('.cl_doc_upload_area_form').serialize();
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/cl_doc_save_upload_area_document'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    window.location.reload();
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', '.cl_doc_upload_area_delete_file', function(e) {
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
            data: { 'file_id': file_id, 'full_path': full_path },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(2500, function() {
                        parent.remove();
                    });
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', '.cl_doc_update_file_perms', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('.cl_doc_update_upload_area_perm').serialize();

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/cl_doc_update_upload_area_document_perms'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.modal').modal('hide');
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', '.create_sess_list_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/create_new_session_track_record_list'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            success: function(data) {
                if (data.type === 'success') {
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.tg-trackrecords').next('.row').find('.record_add_result').html('');
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', '.record_id_delete', function() {
        var record_url = $(this).data('delrecordid');
        var record_serial = $(this).data('recordserial');
        if (confirm("Are You Sure You Want To Delete This " + record_serial + " Record.")) {
            document.location = record_url;
        } else {
            return false;
        }
    });

    $(document).on('change', '.search_yearly_invoice', function(e) {
        e.preventDefault();

        var _this = $(this);
        var year = _this.val();
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/load_accumulative_yearly_invoices'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'year': year },
            success: function(data) {
                if (data.type === 'success') {
                    _this.parents('.row').next('.row').find('.load_hospital_accumulative_invoice').html(data.encode_data);
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    _this.parents('.row').next('.row').find('.load_hospital_accumulative_invoice').html('');
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', '.download_request_form', function(e) {
        e.preventDefault();
        var _this = $(this);
        var file_id = _this.data('fileid');
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/download_document_file'); ?>',
            type: 'GET',
            global: false,
            dataType: 'json',
            data: { 'file_id': file_id },
            success: function(data) {
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

$(window).on('load', function() {
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
                data: { 'search_type': 'only_search', 'barcode': track_no },
                success: function(data) {
                    if (data.type === 'success') {
                        setTimeout(function() {
                            jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                            $('.tg-trackrecords').find('.tracking_search_result').html(data.encode_data);
                            show_flags_on_hover();
                            change_flag_status();
                            flag_tooltip();
                            $('input[name=barcode_no]').val('');
                            $('input[name=barcode_no]').focus();
                        }, 500);

                    } else {
                        setTimeout(function() {
                            jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
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
    $('#display_track_addded_records .flag_column .hover_flags, .track_search_table .flag_column .hover_flags').hover(function() {
            _this = $(this);
            _this.find('ul.report_flags').fadeIn('fast');
        }, function() {
            _this.find('ul.report_flags').fadeOut('fast');
            return false;
        }
    );
}

function show_comment_box_hover() {

    $('#display_track_addded_records .flag_column .comments_icon').on('click', '.show_comments_list', function(event) {
        var _this = $(this);
        var record_id = _this.data('recordid');
        dynamic_id = _this.data('modalid');
        $('#display_comments_list-' + dynamic_id).modal('show');
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/show_comments_box'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'record_id': record_id },
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

function display_comment_box() {
    $('#display_track_addded_records .flag_column .comments_icon').on('click', '#display_comment_box', function(e) {
        e.preventDefault();
        var _this = $(this);
        dynamic_id = _this.data('modalid');
        $('#flag_comment_model-' + dynamic_id).modal('show');
        $(document).on('click', '#flag_comments_save', function(e) {
            e.preventDefault();
            var _this = $(this);
            var form_data = $('#flag_comment_model-' + dynamic_id).find('#flag_comments_form').serialize();
            $.ajax({
                url: '<?php echo base_url('/index.php/institute/save_flag_comments'); ?>',
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

function change_flag_status() {
    $('#display_track_addded_records .flag_column, .track_search_table .flag_column').on('click', '.flag_change', function(e) {
        e.preventDefault();
        var _this = $(this);
        var _flag = $(this).data('flag');
        var _serial = $(this).data('serial');
        var _recordid = $(this).data('recordid');
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/set_flag_status'); ?>',
            type: 'POST',
            dataType: 'json',
            data: { 'flag_status': _flag, 'record_id': _recordid },
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

function delete_flag_comment() {
    $(document).on('click', '#delete_flag_comment', function(e) {
        e.preventDefault();
        var _this = $(this);
        var flag_id = _this.data('flagid');
        var parent = _this.parent("li");
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/delete_flag_comments'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'flag_id': flag_id },
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

function flag_tooltip() {
    $('.flag_column').on('mouseover', 'li', function() {
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
$(document).ready(function() {
        // $(".dropdown-toggle.nav-link.notification").hover(function(){$(".dropdown-menu.notification").toggleClass("force_hide")});
        // $(".dropdown-toggle.nav-link.comments").hover(function(){$(".dropdown-menu.comments").toggleClass("force_hide")});
        // $(".dropdown-toggle.nav-link.notification").click(function(){$(".dropdown-menu.notification").toggleClass("force_hide")});
        // $(".dropdown-toggle.nav-link.comments").click(function(){$(".dropdown-menu.comments").toggleClass("force_hide")});

    $(document).idle({
        onIdle: function() {
            jQuery.sticky('Session has timedout, Please wait while the page refresh.', { classList: 'success', speed: 200, autoclose: 7000 });
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        },
        onShow: function() {

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
        _this.typeahead('val', selection.username);
    });

    /*********************************************
     * Add Incident Report From Ajax Request
     ********************************************/
    $(document).on('click', '.save_incident_report_btn', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('.incident_report_modal').find('.save_incident_report_form').serialize();

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/saveIncidentReport'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                    _this.parents('.incident_report_modal').modal('hide');
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    $(document).on('click', '.edit_incident_reprot', function(e) {
        e.preventDefault();
        var _this = $(this);
        var form_data = _this.parents('.save_incident_report_form').serialize();

        $.ajax({
            url: '<?php echo base_url('/index.php/institute/updateIncidentReport'); ?>',
            type: 'POST',
            dataType: 'json',
            data: form_data,
            success: function(data) {
                if (data.type === 'success') {
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });

    //Upload Area Delete File
    $(document).on('click', '.delete_incident_report', function(e) {
        e.preventDefault();
        var _this = $(this);
        var recordid = _this.data('recordid');
        var parent = _this.parent("td").parent("tr");
        $.ajax({
            url: '<?php echo base_url('/index.php/institute/deleteIncidentReport'); ?>',
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { 'recordid': recordid },
            success: function(data) {
                if (data.type === 'success') {
                    parent.css("background-color", "#ffe6e6");
                    parent.fadeOut(2500, function() {
                        parent.remove();
                    });
                    jQuery.sticky(data.msg, { classList: 'success', speed: 200, autoclose: 7000 });
                } else {
                    jQuery.sticky(data.msg, { classList: 'important', speed: 200, autoclose: 7000 });
                }
            }
        });
    });
});

</script>
<script type="text/javascript">
      $(".request_form_table").DataTable({
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
      });
  </script>
</html>