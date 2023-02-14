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
<!-- Multiselect JS -->
<script src="<?php echo base_url('assets/newtheme/js/multiselect.min.js'); ?>"></script>
<!--Full Calendar JS Files-->
<script src="<?php echo base_url('/assets/fullcalendar/core/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/fullcalendar/daygrid/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/fullcalendar/interaction/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.blockUI.js'); ?>"></script>
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

    $(document).ready(function(){
        $('.datatable').dataTable( {
          "ordering": false
        } );
        $("#show_hidden").click(function(){
            $(".tg-detailsicon.hide_tag_selection").removeClass("hide_tag_selection");
        });

        $(".nextBtn2").click(function(){
            $(".step2").removeClass("hidden");
            $(".step1").removeClass("show");
        });
        $(".nextBtn3").click(function(){
            $(".step1").removeClass("show");
            $(".step2").addClass("hidden");
            $(".step3").removeClass("hidden");
        });

        $(".backBtn1").click(function(){
            $(".step2").addClass("hidden");
            $(".step1").addClass("show");
        });
        $(".backBtn2").click(function(){
            $(".step1").removeClass("show");
            $(".step2").removeClass("hidden");
            $(".step3").addClass("hidden");
        });
        $(".specimen_typeBtn").click(function(){
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden")
            $(".specimen_type_main").removeClass("hidden")
        });
        $(".specimen_sideBtn").click(function(){
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden")
            $(".specimen_side").removeClass("hidden")
        });
        $(".specimen_radio_seenBtn").click(function(){
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden")
            $(".specimen_radio_seen").removeClass("hidden")
        });
        $(".memo_abnorBtn").click(function(){
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden")
            $(".memo_absormality").removeClass("hidden")
        });
        $(".core_biopsyBtn").click(function(){
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden")
            $(".core_biopsy_seen").removeClass("hidden")
        });
        $(".historical_clacificationBtn").click(function(){
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden")
            $(".histological_calcification").removeClass("hidden")
        });
    })

        
</script>
</html>