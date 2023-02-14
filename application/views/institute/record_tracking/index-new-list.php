  <!-- Page Wrapper -->
<style type="text/css">
    i.fa-file-o {
        /*height: 52px;*/
        line-height: 4;
        z-index: 1;
        left: 8px;
    }
</style>

<div class="page-wrapper patient-doctor no-sidebar">

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- <div class="bottom-section" id="top_delay">
            <p class="text-center">
                <img src="<?php //echo base_url() ?>assets/institute/img/trackIcon.png">
                 Track Satus: Lab Release

                 <span id="cdate" style="margin-left:20px;">
                    <script type="text/javascript">
                    var d = new Date();
                    document.getElementById("cdate").innerHTML = d;
                    </script>
                </span>
            </p>
        </div> -->
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php //echo $breadcrumbs; ?>
            <div class="tg-breadcrumbarea tg-searchrecordhold">
               <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
                  <li class="active">New Record</li>
               </ol>
            </div>                            
        </div>
        <div class="doctorSCard">
            <div class="row">
                <div class="col-sm-6 col-md-3">  
                    <h4 class="title_specimen">Laboratory Specimen No.</h4>
                </div>
                <div class="col-sm-6 col-md-3">  
                    
                    <div class="form-group form-focus">
                        <input type="search" id="tags" class="form-control floating" style="padding-right:85px;" name="template_name" id="template_name" onsearch="getTemplates()" >
                        <label class="focus-label">My Templates</label>
                        <span class="tooltipIcon" data-toggle="tooltip" title="Pathologist/Specialty/Clinic/Physician/Specimen No.">
                            <img src="<?php echo base_url() ?>assets/institute/img/infoIcon.png">
                        </span>
                        <button type="button" class="btn btn-primary add_temp" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-ellipsis-v"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?php echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?>"><i class="fa fa-plus m-r-5"></i> Add</a>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#edit_temp"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="barcode_no" name="barcode_no">
                    <label class="focus-label">Search / Add Record</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">  
                    <div class="row">
                        <div class="col-md-9 col-lg-9  col-xl-9">
                            <button class="btn btn-success btn-block btn-lg search_btn"  onClick="getsearchbarcode()">Search</button>
                        </div>    
                        <div class="col-md-3  col-lg-3 col-xl-3 nopadding">
                            <i class="fa fa-cog fa-2x cog-class"  data-toggle="collapse" data-target="#adv_searc_area" style="margin-right:5px"></i>
                            <a href="<?php echo base_url('index.php/institute/record_tracking_new'); ?>" class=""><i class="fa fa-th fa-2x cog-class"></i></a>
                        </div>    
                    </div>
                </div>                            
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable" id="booking_in_list">
                        <thead>
                            <tr>
                                <th>UL No.</th>
                                <th>Track No.</th>
                                <th>Client</th>
                                <th>First Name</th>
                                <th>Surname</th>
                                <th>DOB</th>
                                <th>NHS No.</th>
                                <th>Lab No.</th>
                                <th>Urgency</th>
                                <th><img data-toggle="tooltip" title="" src="https://mskcc.uralensisdigital.co.uk/development/assets/icons/flag-skyblue.png" class="img-responsive" data-original-title="Flag" aria-describedby="tooltip656672"></th>
                                <th><img data-toggle="tooltip" title="" src="https://mskcc.uralensisdigital.co.uk/development/assets/icons/Comments.png" class="img-responsive" data-original-title="Comments" aria-describedby="tooltip157063"></th>
                                <th>Status</th>
                                <th class="text-right">
                                    <img src="https://mskcc.uralensisdigital.co.uk/development/assets/icons/Actions-Blue.png" class="img-responsive pull-right">
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach($result as $rec){
                             $f_initial = '';
                             $l_initial = '';
                            
                            if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->first_initial)) {
                                $f_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->first_initial;
                            }
                            if (!empty($this->ion_auth->group($query['hospital_group_id'])->row()->last_initial)) {
                                $l_initial = $this->ion_auth->group($query['hospital_group_id'])->row()->last_initial;
                            }
                             ?>
                            <tr>
                                <td><?php echo $rec['serial_number']?></td>
                                <td><?php echo $rec['ura_barcode_no']?></td>
                                <td><?php echo $f_initial." ".$l_initial?></td>
                                <td><?php echo $rec['f_name']?></td>
                                <td><?php echo $rec['sur_name']?></td>
                                <td><?php echo date('d-m-Y', strtotime($rec['dob']));?></td>
                                <td><?php echo $rec['nhs_number']?></td>
                                <td><?php echo $rec['lab_number']?></td>
                                <td><?php echo ucwords(substr($rec['report_urgency'], 0, 1))?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="https://mskcc.uralensisdigital.co.uk/development/index.php/doctor/doctor_record_detail/43843"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                          

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

    </div>
   <!-- /Page Content -->
</div>
<!-- Page Wrapper -->
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
<!-- /Page Wrapper -->

<script>
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



<!-- Footer Template -->

<!-- Model OverLay -->

