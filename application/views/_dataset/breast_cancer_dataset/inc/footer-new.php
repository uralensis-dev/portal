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



    jQuery(function () {
        // remove the below comment in case you need chnage on document ready
        // location.href=jQuery("#selectbox").val(); 
        jQuery("#dataset_title").change(function () {
            if (jQuery("#dataset_title").val() == 'Breast Cancer') {
                location.href = '<?php echo  site_url('_dataset/breast_cancer_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)) ?>';
            } else {
                location.href = '<?php echo  site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6) . '/' . $this->uri->segment(7) . '/' . $this->uri->segment(8)) ?>';
            }
        })
    })
</script>
</html>