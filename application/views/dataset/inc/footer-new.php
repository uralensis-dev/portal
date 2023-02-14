<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
<!-- /Page Content -->
</div>
<!-- /Page Wrapper -->

</div>
<script src="https://cdn.tiny.cloud/1/mcnf3z49bi3hvs29al81mrwfygelhkh5ya3vkn0tush8eu9v/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
<script src="<?php echo base_url('assets/newtheme/js/multiselect.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/fullcalendar/core/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/fullcalendar/daygrid/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/fullcalendar/interaction/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/newtheme/js/jquery.blockUI.js'); ?>"></script>
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
    });
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
        $("#show_hidden").click(function(){
            $(".tg-detailsicon.hide_tag_selection").removeClass("hide_tag_selection");
        });
        
        $(".patient_info").click(function(){
            $(".hide_it_info").addClass("hidden");
            $(".patient_info_collapse").removeClass("hidden")
        });

        $(".gross_cut_up").click(function(){
            $(".hide_it_info").addClass("hidden");
            $(".grow_up_collapse").removeClass("hidden")
        });
        $(".clinical_info").click(function(){
            $(".hide_it_info").addClass("hidden");
            $(".clinical_info_collapse").removeClass("hidden")
        });
        $(".request_id").click(function(){
            $(".hide_it_info").addClass("hidden");
            $(".request_id_collapse").removeClass("hidden")
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
            $(".hide_main").addClass("hidden");
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".specimen_type_main").removeClass("hidden")
        });
        $(".specimen_sideBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".specimen_side").removeClass("hidden")
        });
        $(".specimen_radio_seenBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".specimen_radio_seen").removeClass("hidden")
        });
        $(".memo_abnorBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".memo_absormality").removeClass("hidden")
        });
        $(".core_biopsyBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".core_biopsy_seen").removeClass("hidden")
        });
        $(".historical_clacificationBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".surgical_specimen_selection").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".histological_calcification").removeClass("hidden")
        });

        $(".benign_lesionsBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".benign_lesions_main").removeClass("hidden");
        });
        $(".epithelial_proliferationBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".epithelial_proliferation_main").removeClass("hidden");
        });
        $(".Malignant_in_situ_lesionBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Malignant_in_situ_lesion").removeClass("hidden");
        });
        $(".Malignant_in_situ_componentsBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Malignant_in_situ_components").removeClass("hidden");
        });
        $(".DCIS_gradeBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".DCIS_grade").removeClass("hidden");
        });
        $(".DCIS_growth_patternBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".DCIS_growth_pattern").removeClass("hidden");
        });
        $(".DCIS_necrosisBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".DCIS_necrosis").removeClass("hidden");
        });
        $(".InflammationBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Inflammation").removeClass("hidden");
        });
        $(".Pure_DCIS_size_mmBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Pure_DCIS_size_mm").removeClass("hidden");
        });
        $(".LCISBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".LCIS").removeClass("hidden");
        });
        $(".Pagets_diseaseBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Pagets_disease").removeClass("hidden");
        });
        $(".MicroinvasiveBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Malignant_lesions_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Microinvasive").removeClass("hidden");
        });

        $(".Size_and_extentBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Size_and_extent_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".tumor_sizes_mm").removeClass("hidden");
        });
        $(".Disease_extentBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Size_and_extent_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Disease_extent").removeClass("hidden");
        });
        $(".Invasive_tumour_typeBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Invasive_tumour_type_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Invasive_tumour_type").removeClass("hidden");
        });
        $(".Histological_gradeBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Histological_grade_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Histological_grade").removeClass("hidden");
        });
        $(".Invasive_carcinomaBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Invasive_carcinoma_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Invasive_carcinoma").removeClass("hidden");
        });
        $(".Tubule_formationBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Histological_grade_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Tubule_formation").removeClass("hidden");
        });
        $(".Nuclear_pleomorphismBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Histological_grade_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Nuclear_pleomorphism").removeClass("hidden");
        });
        $(".MitosesBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Histological_grade_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Mitoses").removeClass("hidden");
        });        
        $(".Lymphovascular_invasionBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Lymphovascular_invasion_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Lymphovascular_invasion").removeClass("hidden");
        });
        $(".Intra_opetarative_assesmentBtn").click(function(){
            $(".hide_main").addClass("hidden");
            $(".Lymph_node_stage_main").removeClass("hidden");
            $(".hide_it").addClass("hidden");
            $(".Lymph_node_stage").removeClass("hidden");
        });
        $("#Sentinel_LN_assessed_positive").click(function(){
            $(".hide_it").addClass("hidden");
            $(".Sentinel_LN_positve").removeClass("hidden");
        });
        $("#Sentinel_LN_assessed_negative").click(function(){
            $(".hide_it").addClass("hidden");
            $(".Sentinel_LN_negative").removeClass("hidden");
        });

        $("#pure_check").click(function(){
            $(".mixed_checked").addClass("hidden");
            $(".pure_checked").removeClass("hidden");
        });
        $("#mixed_check").click(function(){
            $(".pure_checked").addClass("hidden");
            $(".mixed_checked").removeClass("hidden");
        });


    })

        
    $(document).ready(function() {
        $("#sidebar-menu").find("a").click(function(event) {
            var loc = $(this).attr('href');
            if (loc != '#') {
                window.location.href = loc;
            }
        });
    });
</script>
</html>