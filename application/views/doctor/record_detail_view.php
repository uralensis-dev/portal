<!-- Page Wrapper -->
<style>
#no-slide-msg {
    width: 800px;
    height: 600px;
}

iframe {
    width: 100%;
    height: 100%;
}

.record-main .card .card-body {
    padding: 0.4rem 0.7rem;
}

.record-main .card-group {
    display: flex
}

.record-main .card-group .card {
    flex: 1 0 0;
    margin: 0 3px;
}

.record-main .card-group .card:nth-child(4) {
    flex: 2 0 0;
}

.record-main .page-buttons .btn {
    margin-top: 0;
    margin-bottom: 0;
}

.record-main .slide-container {
    width: 100%;
    flex: 1 !important;
    margin-right: 0px;
    padding-left: 80px;
    padding-right: 80px;
    position: relative;
}

.record-main .slide-container .slide-container-inner {
    position: relative;
    padding: 15px 50px;
    box-shadow: none;
}

.record-main .slide-container .slide-container-inner .card {
    width: 80px;
    margin: 5px;
    height: 150px;
    float: left
}

.record-main .slide-container .slide-container-inner .card {
    margin-bottom: 20px;
}

.record-main .slide-container .card .title {
    transform: none;
    top: 110px;
}

.record-main .slide-container .card img {
    height: 100px;
}

.record-main .slide-container .card .badge {
    left: 0px;
    top: 0px;
}

.record-main .card .card-body .badge {
    color: #ffffff;
    margin-right: -10px;
    position: relative;
    z-index: 100
}

.record-main .card .card-body {
    padding: 0.4rem 0.7rem;
}


a.control_prev,
a.control_next {
    position: absolute;
    /*top: 20px;*/
    z-index: 999;
    display: block;
    padding: 4% 3%;
    width: auto;
    height: auto;
    background: transparent;
    color: #878787;
    text-decoration: none;
    font-weight: 600;
    font-size: 40px;
    opacity: 1;
    cursor: pointer;
}

a.control_prev:hover,
a.control_next:hover {
    opacity: 1;
    -webkit-transition: all 0.2s ease;
}

a.control_prev {
    left: -20px;
    border-radius: 0 2px 2px 0;
}

a.control_next {
    right: 0;
    border-radius: 2px 0 0 2px;
}
#slide-carousel {
    height: 200px;
    margin-top: 10px;
    margin-bottom: 10px;
}

.slick-prev:before, .slick-next:before {
    color: black !important;
}
.nav-tabs .nav-link.active {	
    background: gray;	
    color: white;	
}
</style>
<script src="<?php echo base_url('/assets/subassets/js/jquery-3.2.1.min.js')?>"></script>
<script defer type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- Page Content -->
<div class="container-fluid">
    <div class="row">
        <!-- Specimen -->
        <div class="col-md-3 col-lg-3 col-xl-2 record-sidebar">
            <button class="btn btn-primary"
                onclick="window.location.href = '<?php echo base_url();?>doctor/doctor_record_detail_old/<?php echo $this->uri->segment(3);?>'">View Case</button>
            <div class="card">
                <div class="card-body">
                <ul class="nav nav-tabs" id="specimen_tab" role="tablist">
                <?php foreach ($specimen_query as $ind => $specimen_q) {	
                        $url = '';	
                       	
                        foreach ($slide_data as $key => $slide) {	
                            if (count($slide['slides']) > 0) {	
                                if ($slide['specimen_id'] == $specimen_q->specimen_id) {	
                                    $url = $slide['slides'][0]['url'];	
                                }	
                            }	
                        } ?>	
                        <li class="nav-item">	
                            <a class="selectedTab nav-link <?php echo ($slide_specimen_id == $specimen_q->specimen_id) ? 'active' : ''; ?>" data-url="<?php echo $url; ?>" id="specimen-tab-<?php echo $ind; ?>" data-toggle="tab" href="#specimen-<?php echo $ind; ?>" role="tab" aria-controls="Specimen <?php echo $ind + 1; ?>" aria-selected="<?php echo ($slide_specimen_id == $specimen_q->specimen_id) ? 'true' : 'false'; ?>">Specimen <?php echo $ind + 1; ?></a>	
                        </li>	
                    <?php } ?>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <?php foreach($specimen_query as $ind => $specimen_q): ?>
                    <div class="tab-pane  <?php if ($ind == 0) echo 'active';?>" id="specimen-<?php echo $ind?>" role="tabpanel" aria-labelledby="specimen-<?php echo $ind?>">
                        <p>
                            <strong>Clinical History</strong><br><?php echo $specimen_q->specimen_clinical_history ?>
                        </p>
                        <p>
                            <strong>Macro Description</strong><br><?php echo $specimen_q->specimen_macroscopic_description ?>
                        </p>
                        
                        <p>
                            <strong>Micro Description</strong><br><?php echo $specimen_q->specimen_microscopic_description ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                    
                </div>    
                
                </div>
            </div>
        </div>
<?php
//print_r($slide_data);
?>

        <!-- Iframe container -->
        <div class="col-md-9 col-lg-9 col-xl-10 record-main">

            <div class="row">
                <div class="col-md-12">
                    <div id="iframe-content">
                         <iframe allow="fullscreen" src="" frameborder="0" style="width:100% !important;"></iframe>
                    </div>
                    <p style="display: none;" id="no-slide-msg">No Slides In this cases</p>
                </div>

            </div>
            
        </div>

    </div>
</div>

<script>

var slides = <?php
if (count($slide_data) != 0) echo 'true';
else echo 'false'; ?> ;

function loadIframe(url) {
    $("#iframe-content").show();
    $("#main-content").hide();
    $("iframe").attr('src', url);
}

function calcHeight() {
    height = window.innerHeight - 160;
    if (height <= 800) {
        height = 800;
    }
    return height;

}



$(document).ready(function() {
    $(document).on("click",'.selectedTab',function (){	
        var iframeUrl = $(this).attr('data-url');	
        if(iframeUrl === ''){	
            $('#no-slide-msg').show();	
            $('#iframe-content').hide();	
        }else{	
            loadIframe(iframeUrl);	
            $('#iframe-content').show();	
            $('#no-slide-msg').hide();	
        }	
    })
    if (slides) {
        $("#no-slide-msg").hide();
        <?php if (!isset($slide_url)) { ?>
            loadIframe("<?php echo $slide_data[0]['slides'][0]['url'] ;?>");
        <?php }else{   ?>
            loadIframe("<?php echo $slide_url;?>");
        <?php }?>
    } else {
        $("#iframe-content").hide();
    }

    $('iframe').css('height', calcHeight());

    $(window).resize(function() {
        $('iframe').css('height', calcHeight() + 'px');
    });

    $('#slide-carousel').slick({
            slidesToShow: 6,
            slidesToScroll: 6
    });
});
</script>