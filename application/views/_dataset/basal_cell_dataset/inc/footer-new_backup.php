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

    $("input[name='Specimen_type']").click(function () {
        $('#1st_spec1').html('- Specimen type');
        var Specimen_type = $("input[name='Specimen_type']:checked").val();
        if (Specimen_type == 'Not stated') {
            show_answer('slide1', Specimen_type, 'slide_007', 'Specimen type');
        }
        if (Specimen_type == 'Incision') {
            show_answer('slide1', Specimen_type, 'slide_02', 'Incision');
        }
        if (Specimen_type == 'Punch') {
            show_answer('slide1', Specimen_type, 'slide_03', 'Excision');
        }
        if (Specimen_type == 'Curettings') {
            show_answer('slide1', Specimen_type, 'slide_04', 'Punch');
        }
        if (Specimen_type == 'Shave') {
            show_answer('slide1', Specimen_type, 'slide_05', 'Curettings');
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
        show_answer('slide007', 'Legnth: ' + $("input[name='specimendimention1']").val() + ' Breadth: ' + $("input[name='specimendimention2']").val() + ' Depth: ' + $("input[name='specimendimention3']").val(), 'slide_07', 'Dimension of specimen');
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

    $("input[name='Macroscopic']").click(function () {
        show_answer('slide7', 'Lenght ' + $("input[name='MDMacroscopic_description']").val() + ' (mm) and ' + $("input[name='Macroscopic']:checked").val(), 'slide_08', 'Macroscopic Description');
    });
    $("input[name='Histological_low']").click(function () {
        $('#1st_spec3').html('- Histological data');
        show_answer('slide8', $("input[name='Histological_low']:checked").val(), 'slide_09', 'Histological data');
    });
    $("input[name='Histological_high']").click(function () {
        $('#1st_spec3').html('- Histological data');
        show_answer('slide9', $("input[name='Histological_high']:checked").val(), 'slide_11', 'Histological data');
    });
    $("input[name='n_Histological_Present']").click(function () {
        $('#1st_spec3').html('- Histological data');
        show_answer('slide11', $("input[name='n_Histological_Present']:checked").val(), 'slide_12', 'Deep invasion');
    });
    $("#his_btn").click(function () {
        show_answer('slide12', $("input[name='n_Histological_thickness_Present']").val(), 'slide_17', 'For pure superficial basal cell carcinoma, invasive entries can be omitted');
    });
    $("input[name='Maximum_Indicate']").click(function () {
        $('#1st_spec4').html('- Maximum dimension/diameter of lesion');
        show_answer('slide19', $("input[name='Maximum_Indicate']:checked").val(), 'slide_20', 'Indicate which used:');
    });
    $("input[name='Maximum_Demention']").click(function () {
        show_answer('slide20', $("input[name='Maximum_Demention']:checked").val(), '', 'Dimension');
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
</script>
</html>