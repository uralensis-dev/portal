<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$src_url = base_url('/assets/subassets/js/jquery-3.2.1.min.js');
echo "<script src='$src_url'></script>";
?>
<style>
.no_record_message {
    margin: auto;
    width: 400px;
    text-align: center;
    margin-top: 150px;
}

</style>
<div class="container-fluid" style="width: 100%; height: 100%; margin: 0; padding: 0; margin-top: -15px;">
    <div class="row" style="width: 100%; height: 100%; margin: 0; padding: 0;">
    
        <?php if(!isset($request_query[0]->remote_record)|| $request_query[0]->remote_record == NULL ||$request_query[0]->remote_record == 0 ): ?>
        <div class="no_record_message">
        <h1>No Related Records for this patient.</h1>
        <button class="btn btn-primary"
                onclick="window.location.href = '<?php echo base_url();?>doctor/doctor_record_detail_old/<?php echo $this->uri->segment(3);?>'">Go Back</button>
        </div>
        <?php elseif($request_query[0]->remote_record == 1): ?>
            <button class="btn btn-primary go-back-button"
                onclick="window.location.href = '<?php echo base_url();?>doctor/doctor_record_detail_old/<?php echo $this->uri->segment(3);?>'">Go Back</button>
        <iframe style="width: 100%;" src="<?php echo BRIDGEHEAD_URL.''.$request_query[0]->nhs_number ?>" frameborder="0"></iframe>
        <?php endif;?>
    </div>
</div>

<script>
    $(document).ready(function() {
        var height = $("body").height();
        $("iframe").height(height);
        $(window).resize(function() {
            var height = $("body").height();
            $("iframe").height(height);
        });
    });
</script>
