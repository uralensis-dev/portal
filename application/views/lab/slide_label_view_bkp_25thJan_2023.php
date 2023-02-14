<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
   div.dataTables_wrapper div.dataTables_length select {
   position: absolute;
   /* top:-125px; */
   height: 28px !important;
   width: 50px !important;
   left: 15px;
   padding:0;
   }
   .input-group-btn{
   right: 26px;
   z-index: 999;
   }
   .form-focus .form-control {
   height: 36px;
   padding: 0 12px;
   }
   .btn-default{
   background: #f5f5f5 !important;
   }
   .breadcrumb{padding: 0 !important}
   .tg-cancel input{
   display: none;
   }
   .tg-cancel label i {
   color: red;
   }
   .tg-cancel label {
   cursor: pointer;
   margin-bottom: 0;
   width: 45px;
   padding: 8px;
   border: 1px solid #ddd;
   border-radius: 50%;
   }
   .table .dropdown-action .dropdown-menu{
   min-width: 90px;
   }
   .table .dropdown-action .dropdown-menu .dropdown-item{
   font-size: 14px;
   }
   .header .tg-searchrecord fieldset .form-group .form-control{
   height: 44px !important;
   }
   .tg-inputicon i{
   top: 9px !important;
   }
   /*.flags_check span.tg-radio {
   display: none;
   }
   .flags_check span.tg-radio.first {
   display: block;
   }*/
   .ui-selectmenu-menu .ui-menu.customicons .ui-menu-item-wrapper {
   padding: 0.5em 0 0.5em 3em;
   }
   .ui-selectmenu-menu .ui-menu.customicons .ui-menu-item .ui-icon {
   height: 24px;
   width: 24px;
   top: 0.1em;
   }
   /* select with CSS avatar icons */
   option.avatar {
   background-repeat: no-repeat !important;
   padding-left: 20px;
   }
   .avatar .ui-icon {
   background-position: left top;
   }
   td img.doctor-pic {
   display: block;
   width: 30px;
   height: 30px;
   background: #1b75cd;
   color: #ffffff;
   text-align: center;
   border-radius: 50%;
   line-height: 15px;
   font-size: 8px;
   letter-spacing: -1px;
   }
   td a.hospital_initials {
   display: block;
   width: 30px;
   height: 30px;
   background: #1b75cd;
   color: #ffffff;
   text-align: center;
   border-radius: 50%;
   line-height: 30px;
   font-size: 11px;
   letter-spacing: -1px;
   }
   @media screen and (min-width: 1600px) {
   body{font-size: 18px;}
   .table .dropdown-action .dropdown-menu .dropdown-item{
   font-size: 16px;
   }
   }
   @media screen and (max-width: 1580px) {
   .tg-cancel label {
   width: 35px;
   padding: 5px;
   }
   div.dataTables_wrapper div.dataTables_length select{
   /* top: -125px; */
   }
   }
   ol.breadcrumb{float: left;}
   .form-focus .select2-container .select2-selection--single{
   height: 40px;
   }
   .form-focus .select2-container--default .select2-selection--single .select2-selection__arrow{
   height: 38px;
   }
   .form-focus .select2-container .select2-selection--single .select2-selection__rendered{
   padding-top: 0;
   }
   .tg-filterhold, .tg-breadcrumbarea{
   position: relative;
   }
   div.dataTables_wrapper div.dataTables_length select{
   margin-top:-10px;
   }
   #doctor_record_list_table_wrapper{
   padding: 0 15px;
   }
   .success_list {
   margin: 15px 0px;
   background-color: lightgreen;
   color: white;
   padding: 10px;
   border-radius: 5px;
   }
   #doctor_record_list_table_wrapper .row:nth-child(2){
   margin-left: 0;
   }
   #doctor_record_list_table_wrapper .row:nth-child(2) .col-sm-12{
   padding: 0;
   margin-top: 10px;
   }
   div.dataTables_wrapper div.dataTables_filter input{
   border-radius: 4px;
   height: 37px !important;
   }
   #doctor_record_list_table_filter:before {
   content: "\f002";
   position: absolute;
   right: 15px;
   top: 0;
   bottom: 0;
   width: 40px;
   height: 37px;
   z-index: 9;
   background: #55ce63;
   text-align: center;
   line-height: 34px;
   color: #fff;
   font-family: 'FontAwesome';
   cursor: pointer;
   }
   .dt-button{
    border-radius: 4px;
    border: 1px solid #00c5fb;
    font-size: 13px;
    padding: 8px 20px;
    background-color: #00c5fb;
    color: #fff;
   }
 .left-box .dt-buttons {
    width: 40%;
    float: left;
   }
   .modal-xl{
      width : 920px !important;
   }
   .widht_filter {
    width: 100%;
    max-width: 250px;
}
   .my_filters{ position: absolute;right: 25%;top: 17%;}
</style>
<?= @$br_template; ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="clearfix"></div>
<div class="content container-fluid publish-record">
<div class="record_publish_listing">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0; margin-bottom: 15px;">
      <h3 class="page-title">Slide Label</h3>
      <ol class="tg-breadcrumb tg-breadcrumbvtwo">
         <li><a href="<?= base_url(); ?>">Dashboard</a></li>
         <li class="active">Print List</li>
      </ol>
   <div class="clearfix"></div>
   <div class="row mid-box">
      <div class="col-md-6">
      <?php if($this->session->flashdata('error_msg')){ ?>
         <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error_msg');?></div>
      <?php } ?>
      </div>
      <div class="col-md-6 text-right">
         <select name="user_id" id="filter_user_id" class="widht_filter">
            <option value="All">-ALL-</option>
            <?php if(!empty($users)){
               foreach($users as $user){
                  ?>
                  <option value="<?= $user['user_id']; ?>"><?= $user['user_name']; ?></option>
                  <?php
               }?>
            <?php 
            } ?>
         </select>
         <input type="text" id="filter_date" name="filter_date" placeholder="MM/DD/YYYY"/>
         <a href="javascript:reset_filter();" class='btn btn-primary dt-button' title='Reset Filters'>Reset</a>
   </div>
   </div>
   </div>
   <div class="clearfix"></div>
   <div class="left-box">
   <form action='<?= base_url(); ?>GenerateBarcode/bulk_barcode' method='post' id='barcode_frm'> 
   <input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
   <input type="hidden" name='submit_type' value='barcode' id='submit_type' />
   <input type="hidden" name='request_action' value='sp_pot' id='request_action' />
   <input type="hidden" name="action_type" value="" id="action_type">
   <table id="slide_label_list" class="table custom-table table-striped" cellspacing="0" width="100%" style="margin-top:10px !important">
      <thead>
         <tr>
            <th colspan="9">
               <a href="javascript:print_barcode(1);" id="btn_barcode" class="btn btn-primary hide">Generate Barcode</a>
               <a href="javascript:format_barcode();" id="btn_updated_barcode" class="btn btn-warning hide">Choose Barcode Format</a>
               <a href="javascript:format_barcode();" id="btn_updated_sp_pot" class="btn btn-warning hide">Choose Specimen Pot Barcode Format</a>
               <a href="javascript:format_barcode();" id="btn_updated_request" class="btn btn-warning hide">Choose Request Barcode Format</a>
               <a href="javascript:print_barcode(3);" id="btn_sp_pot" class="btn btn-success hide">Specimen Pot</a>
               <a href="javascript:print_barcode(2);" id="btn_sp_request" class="btn btn-info hide">Request</a>
               <a href="javascript:print_barcode(4);" id="" class="downloadBtn btn btn-info hide">Download Barcode</a>
               <a href="javascript:print_barcode(5);" id="" class="downloadBtn btn btn-info hide">Download Specimen Barcode</a>
               <a href="javascript:print_barcode(6);" id="" class="downloadBtn btn btn-info hide">Download Request Barcode</a>
               <a href="javascript:print_barcode(7);" id="" class="downloadBtn btn btn-info hide">Download Cassette</a>
            </th>
         </tr>
         <tr>
            <th>
               <input type="checkbox" name="barcode_all" id="barcode_all" class="">
            </th>
            <th>Request ID</th>
            <th>Lab No</th>
            <th>LIMS Number</th>
            <th>Patient</th>
            <th>Test</th>
            <th>No Of Spec</th>
            <th>Pathologist</th>
            <th>Barcode</th>
         </tr>
      </thead>
      <tbody></tbody>
   </table>
   </form>
         </div>
  </div>
  <div class="modal fade" id="barcode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Barcode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class='col-md-12 text-center' id='br_box'>
            <center style="text-align: left;min-height: 125px !important;width: 155px !important;overflow: hidden !important;">
                <div class='barcode_wrap' style="padding: 2px;border-radius: 5px;">    
                    <center>
                    <div class="d-flex" style="display: flex;align-items: center;justify-content: space-around;">
                       <img src="#" id="barcode_img" alt="Barcode" style='max-width: 55px !important;' >
                       <img src="assets/img/qrLogo.jpeg" class="qrlogo" style="max-width: 60px !important;max-height: 60px !important;object-fit: cover;" alt="Barcode">
                     </div>
                            <table style="font-size:10px !important;">
                            <!-- <tr style="line-height: 12px; "><td class='text-center' id='br_digi_number'></td></tr> -->
                            <tr style="line-height: 12px; "><td class='text-center' id='br_lab_number'></td></tr>
                            <tr style="line-height: 12px; "><td class='text-center' id='br_patient'></td></tr>
                            <tr style="line-height: 12px; "><td class='text-center' id='br_test'></td></tr>
                        </table>
                        </center>
                    </div>
                </div>
            </center>
            <div class='col-md-12 text-center hide' id='br_error_box'>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:print_barcode('br_box')" class="btn btn-primary">Print</a>
      </div>
    </div>
  </div>
</div>
<script>
    var site_url = "<?php echo site_url() ?>";    
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/scripts/barcode_template.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/scripts/slide_label.js"></script>