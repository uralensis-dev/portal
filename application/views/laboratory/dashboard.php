<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>-->
<!--<link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">-->
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>-->
<link rel="canonical" href="https://css-tricks.com/examples/DragAndDropFileUploading/">
<style>
    .container{
        width: 100%;
        text-align: center;
        margin: 0 auto;
    }
    .box {
        font-size: 1.25rem; /* 20 */
        background-color: #c8dadf;
        position: relative;
        padding: 45px 10px;
    }
    .box.has-advanced-upload {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;

        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
    }
    .box.is-dragover {
        outline-offset: -20px;
        outline-color: #c8dadf;
        background-color: #fff;
    }
    .box__dragndrop, .box__icon {
        display: none;
    }
    .box.has-advanced-upload .box__dragndrop {
        display: inline;
    }
    .box.has-advanced-upload .box__icon {
        width: 100%;
        height: 80px;
        fill: #92b0b3;
        display: block;
        margin-bottom: 40px;
    }
    .box.is-uploading .box__input, .box.is-success .box__input, .box.is-error .box__input {
        visibility: hidden;
    }
    .box__uploading, .box__success, .box__error {
        display: none;
    }
    .box.is-uploading .box__uploading, .box.is-success .box__success, .box.is-error .box__error {
        display: block;
        position: absolute;
        top: 50%;
        right: 0;
        left: 0;

        -webkit-transform: translateY( -50% );
        transform: translateY( -50% );
    }
    .box__uploading {
        font-style: italic;
    }
    .box__success {
        -webkit-animation: appear-from-inside .25s ease-in-out;
        animation: appear-from-inside .25s ease-in-out;
    }
    .dash_images {
        float: left;
        max-width: 50px;
    }
    @-webkit-keyframes appear-from-inside
    {
        from	{ -webkit-transform: translateY( -50% ) scale( 0 ); }
        75%		{ -webkit-transform: translateY( -50% ) scale( 1.1 ); }
        to		{ -webkit-transform: translateY( -50% ) scale( 1 ); }
    }
    @keyframes appear-from-inside
    {
        from	{ transform: translateY( -50% ) scale( 0 ); }
        75%		{ transform: translateY( -50% ) scale( 1.1 ); }
        to		{ transform: translateY( -50% ) scale( 1 ); }
    }

    .box__restart
    {
        font-weight: 700;
    }
    .box__restart:focus,
    .box__restart:hover
    {
        color: #39bfd3;
    }

    .js .box__file
    {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .js .box__file + label
    {
        max-width: 80%;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
    }
    .js .box__file + label:hover strong,
    .box__file:focus + label strong,
    .box__file.has-focus + label strong
    {
        color: #39bfd3;
    }
    .js .box__file:focus + label,
    .js .box__file.has-focus + label
    {
        outline: 1px dotted #000;
        outline: -webkit-focus-ring-color auto 5px;
    }
    .js .box__file + label *
    {
        /* pointer-events: none; */ /* in case of FastClick lib use */
    }

    .no-js .box__file + label
    {
        display: none;
    }

    .no-js .box__button
    {
        display: block;
    }
    .box__button
    {
        font-weight: 700;
        color: #e5edf1;
        background-color: #39bfd3;
        display: block;
        padding: 8px 16px;
        margin: 40px auto 0;
    }
    .box__button:hover,
    .box__button:focus
    {
        background-color: #0f3c4b;
    }

</style>

<style type="text/css">
	#advance_search_table{display: none;}
	.card-body a{color: #000;}
	
    .dropdown-toggle::after{display: none;}
    .table-hover{
        cursor: pointer;
    }
	.e-avatar{
		width:35px;
		height:35px;
	}
	ul.histo_lab_staus li{
		width: calc(100% / 3);
	}

	.dash-card-content p{
		font-size: 16px;
	}
    td.text-right a.dropdown-item{
        padding: 0;
        display: inline-block;
        width: auto;
    }
    .error_list {
        margin: 15px 0px;
        background-color: red;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    .success_list {
        margin: 15px 0px;
        background-color: lightgreen;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
</style>
<div class="container-fluid lab-heading top-boxed">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-8">
				<h3 class="page-title">Welcome</h3>
			</div>
			<div class="col-sm-4">
				<div class="pull-right">
                    
                    <div class="col-auto float-right ml-auto">
                    <?php if($is_hospital_admin) { ?>                    
                        <a style="margin-right: 10px;" href="<?php echo base_url('laboratory/create_user'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> User</a>  &nbsp;&nbsp;                  
                    <?php } ?>
                    
                    
                        <a style="margin-right: 10px;" href="<?php echo base_url('laboratory/create_hospital'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> Clinic</a>
                    </div>
			<!--	<a href="javascript:void(0);" id="doctor_advance_search"><i class="fa fa-cog fa-2x"></i></a>
				 <a id="doctor_advance_search" class="btn btn-info btn-lg newbtn" href="javascript:void(0);"> Advance Search</a> -->
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        	<ul class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:;">Laboratory Dashboard</a></li>
                </ul>
	        </div>
	    </div>
	</div>

	<?php if ($this->session->flashdata('upload_error') != '') { ?>
        <div class="error_list">
            <?= $this->session->flashdata('upload_error'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('upload_success') != '') { ?>
        <div class="success_list">
            <?= $this->session->flashdata('upload_success'); ?>
        </div>
    <?php } ?>

	<div id="advance_search_table">
		<?php
	           $attributes = array('class' => '');
	            echo form_open("Doctor/search_request", $attributes);
	            ?>
	            <div class="row">
	            <div class="col-xs-12 col-sm-6 col-md-2">
	            	<div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="first_name" name="first_name">
                    	<label class="focus-label">First Name</label>
                    </div>
	            </div>
	            <div class="col-xs-12 col-sm-6 col-md-2">
	            	<div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="sur_name" name="sur_name">
                    	<label class="focus-label">Surname</label>
                    </div>
	            </div>
	            <div class="col-xs-12 col-sm-6 col-md-2">
	            	<div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="emis_no" name="emis_no">
                        	<label class="focus-label">EMIS No.</label>
                        </div>
	            </div>
	            <div class="col-xs-12 col-sm-6 col-md-2">
	            	<div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="lab_no" name="lab_no">
                        	<label class="focus-label">Lab No.</label>
                        </div>
	            </div>
	            <div class="col-xs-12 col-sm-6 col-md-2">
	            	<div class="form-group form-focus">
                            <input type="text" class="form-control floating" id="nhs_no" name="nhs_no">
                        	<label class="focus-label">NHS No.</label>
                        </div>
	            </div>
	            <div class="col-xs-12 col-sm-6 col-md-2">
	            	<button type="submit" class="btn btn-success btn-lg btn-block newbtn">Search</button>
	            </div>
	        <div>
	            </div>
	        </div> 
	    </form>
	</div>
	<div class="clearfix"></div>
	<div class="row">
 
      <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <a href="<?php echo base_url('laboratory/Labview/H'); ?>" >
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-hospital-o"></i></span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($hospital_count[0]["hospital_count"]) ? $hospital_count[0]["hospital_count"] : 0);?></h3>
                        <span>Clinic</span>
                    </div>
                </div>
            </div>
            </a>
        </div>
        
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <a href="<?php echo base_url('laboratory/Labview/L'); ?>" >
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/laboratory_icon.png" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($firstRowCounts[0]["lab_counts"]) ? $firstRowCounts[0]["lab_counts"] : 0);?></h3>
                        <span>Laboratories</span>
                    </div>
                </div>
            </div>
            </a>
        </div>
        
        
        
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3" style="display:none">
        <a href="<?php echo base_url('auth/dashoardDetails?group_type=CS'); ?>" >
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/cancer_service_icon.png" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($firstRowCounts[0]["cancer_counts"]) ? $firstRowCounts[0]["cancer_counts"] : 0);?></h3>
                        <span>Cancer Service</span>
                    </div>
                </div>
            </div>
            </a>
        </div>
        
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <a href="<?php echo base_url('laboratory/team_view'); ?>" >
            <div class="card dash-widget">
                <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url('assets/icons/pathologist.svg'); ?>" class="img-fluid"/>
                </span>
                    <div class="dash-widget-info">
                        <h3><?php echo (isset($team) ? $team[0]['team_count'] : 0);?></h3>
                        <span>Team Members</span>
<!--                        <span><a href="--><?php //echo base_url('auth/dashoardDetails?group_type=CS'); ?><!--" >Pathologist</a></span>-->
<!--                        <span><a href="--><?php //echo base_url('admin/usergroups/6/pathologist'); ?><!--" >Pathologist</a></span>-->
                    </div>
                </div>
            </div>
            </a>
        </div>
        
        <div class="col-sm-6 col-md-3">
			<div class="card dash-widget">
				<div class="card-body">
					<a href="<?php echo base_url() ?>doctor/showSnomedCodes">
						<span class="dash_images">
							<img src="<?php echo base_url('assets/icons/invoices.png'); ?>" class="img-responsive">
						</span>
						<div class="dash-widget-info">
							<h3>Codes</h3>
							<!-- <span>Employees</span> -->
						</div>
					</a>
					<div class="progress mb-2" style="height: 5px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<p class="mb-0 text-center">SNOMED &amp; Short Codes</p>
				</div>
			</div>
		</div>
        
        
    </div>

	<div class="row dashboard_widgets">
        <div class="col-sm-6 col-md-3">
        <a href="<?php echo base_url()?>index.php/institute/bookingin">
            <div class="card dash-widget">
                <div class="card-body">
                   
						<span class="dash-widget-icon">
							<img src="<?php echo base_url('assets/icons/invoices.png'); ?>" class="img-responsive">
						</span>
                        <div class="dash-widget-info">
                            <h3>Booking In</h3>
                            <!-- <h3>Invoices</h3> -->
                            <!-- <span>Employees</span> -->
                        </div>
                    
                    <!-- <div class="progress mb-2" style="height: 5px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p class="mb-0 text-center">Overall Employees 218</p> -->
                </div>
            </div>
            </a>
        </div>
        <!--		<div class="col-sm-6 col-md-3">-->
<!--			<div class="card dash-widget">-->
<!--				<div class="card-body xl-level">-->
<!--					<a href="--><?php //echo base_url('index.php/doctor/view_further_work?fw_page=requested'); ?><!--">-->
<!--						<span class="dash-widget-icon">-->
<!--							<img src="--><?php //echo base_url('assets/icons/Laboratory.png'); ?><!--" class="img-responsive">-->
<!--						</span>-->
<!--						<div class="dash-widget-info">-->
<!--							<h3>Lab Requests</h3>-->
<!--							<span>Clients</span> -->
<!--						</div>-->
<!--					</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
        <div class="col-sm-6 col-md-3">
        <a href="<?php echo base_url('AddCourier'); ?>">
            <div class="card dash-widget">
                <div class="card-body xl-level">
                    
						<span class="dash-widget-icon">
							<img src="<?php echo base_url('assets/icons/Courier.png'); ?>" class="img-responsive">
						</span>
                        <div class="dash-widget-info">
                            <h3>Courier</h3>
                            <span><i class="la la-file-alt"></i> <?=$new;?>  <i class="la la-retweet"></i> <?=$ackoweldge;?></span>
                        </div>
                    
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3">
        <a href="<?php echo base_url('labEnquiries'); ?>">
			<div class="card dash-widget">
				<div class="card-body xl-level">
					
						<span class="dash-widget-icon">
							<img src="<?php echo base_url('assets/icons/enquiry_icon.png'); ?>" class="img-responsive">
						</span>
						<div class="dash-widget-info">
							<h3>Extra Work</h3>
							<!-- <span>Tasks</span> -->
						</div>
					
				</div>
			</div>
            </a>
		</div>
        <div class="col-sm-6 col-md-3">
        <a href="<?php echo base_url('tracking/laboratory_track'); ?>">
            <div class="card dash-widget">
                <div class="card-body xl-level">
                    
						<span class="dash-widget-icon">
							<img src="<?php echo base_url('assets/icons/Track.png'); ?>" class="img-fluid">
						</span>
                        <div class="dash-widget-info">
                            <h3>Track</h3>
                            <!-- <span>Projects</span> -->  
                        </div>
                    
                </div>
            </div>
            </a>
        </div>
        
    </div>

	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body dash_tabs nopadding">
					<ul class="nav nav-tabs nav-tabs-solid ">
						<li class="nav-item"><a class="nav-link active" href="#booking_in" data-toggle="tab">Histo Lab Status</a></li>
						
						<li class="nav-item"><a class="nav-link" href="#specimen_block_prefix" data-toggle="tab">Lab Accession ID</a></li>
					</ul>
                    <?php
                    $labEntry = $specimenLabeling = $cutUp = $embedding = $staining = $quality = $slideScanner = $reporting = $furtherWork = 0; 
                    if(count($status_count) > 0){
                        foreach($status_count as $key => $status){
                            if($status->request_code_status == 'Lab Entry') $labEntry = $status->request_status_count;
                            if($status->request_code_status == 'Specimen Labelling') $specimenLabeling = $status->request_status_count;
                            if($status->request_code_status == 'Cut up / Grossing') $cutUp = $status->request_status_count;
                            if($status->request_code_status == 'Embedding & Microtomy') $embedding = $status->request_status_count;
                            if($status->request_code_status == 'Staining') $staining = $status->request_status_count;
                            if($status->request_code_status == 'Quality Assurance') $quality = $status->request_status_count;
                            if($status->request_code_status == 'Slide Scanner') $slideScanner = $status->request_status_count;
                            if($status->request_code_status == 'Reporting') $reporting = $status->request_status_count;
                            if($status->request_code_status == 'Further Work') $furtherWork = $status->request_status_count;
                        }
                    }
                    ?>
					<div class="tab-content" style="padding: 20px;">
						<div class="tab-pane active" id="booking_in">
							<ul class="histo_lab_staus list-unstyled">
								<li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Lab Entry') ?>" class="numbers"><span><?php echo $labEntry; ?></span> Lab Entry</a>
								</li>
								<li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Specimen Labelling') ?>" class="numbers"><span><?php echo $specimenLabeling; ?></span> Specimen Labelling </a>
								</li>
								<li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Cut up / Grossing') ?>" class="numbers"><span><?php echo $cutUp; ?></span> Cut up/Grossing</a>
								</li>
								<li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Embedding & Microtomy') ?>" class="numbers"><span><?php echo $embedding; ?></span> Embedding & Microtomy</a>
								</li>
								<li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Staining') ?>" class="numbers"><span><?php echo $staining; ?></span> Staining</a>
								</li>
								<li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Quality Assurance') ?>" class="numbers"><span><?php echo $quality; ?></span> Quality Assurance</a>
								</li>
								<li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Slide Scanner') ?>" class="numbers"><span><?php echo $slideScanner; ?></span> Slide Scanner</a>
								</li>
                                <li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Reporting') ?>" class="numbers"><span><?php echo $reporting; ?></span> Reporting</a>
								</li>
                                <li>
									<a href="<?php echo base_url()."index.php/lab/lab_record_list/".base64_encode('Further Work') ?>" class="numbers"><span><?php echo $furtherWork; ?></span> Further Work</a>
								</li>
							</ul>
						</div>
                        
						<div class="tab-pane" id="cup_up">
							<table class="table custom-table table-bordered text-center">
								<thead>
									<tr>
										<th colspan="2">Main Lab</th>
										<th colspan="2">Immunochemistry</th>
										<th colspan="2">Molecular </th>
									</tr>
									<tr>
										<th>Extras (HE)</th>
										<th>Specials</th>
										<th>Urgents </th>
										<th>Routine </th>
										<th>Urgents </th>
										<th>Routine </th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>0/6</td>
										<td>1/6</td>
										<td>2/6</td>
										<td>3/6</td>
										<td>4/6</td>
										<td>5/6</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pane" id="further_work_lab">
							<h3>Cytology</h3>

							<ul class="histo_lab_staus list-unstyled mt-4 mb-4">
								<li>
									<a href="javascript:;" class="numbers"><span>40</span> Orders Log</a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>40</span> Data Entry </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>40</span> Sample Preps</a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>40</span> Order Dispatched</a>
								</li>
							</ul>

							<h3>Cytology</h3>

							<ul class="histo_lab_staus list-unstyled mt-4 mb-4">
								<li>
									<a href="javascript:;" class="numbers"><span>122</span> Non Gynae </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>1/6</span>Urgents  </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>2/6</span>Routine </a>
								</li>
								
							</ul>
							<h3>Cyto-Extras</h3>

							<ul class="histo_lab_staus list-unstyled mt-4">
								
								<li>
									<a href="javascript:;" class="numbers"><span>1/6</span>Urgents  </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>2/6</span>Routine </a>
								</li>
								
							</ul>
						</div>
						<div class="tab-pane" id="embedding">
							<ul class="histo_lab_staus list-unstyled mt-4">
								
								<li>
									<a href="javascript:;" class="numbers"><span>200</span>Post Mortems </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>100</span>Deaths  </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>100</span>PM Histology </a>
								</li>
								
							</ul>
						</div>
						
						<div class="tab-pane" id="slide_scan">
							<ul class="histo_lab_staus list-unstyled mt-4">
								
								<li>
									<a href="javascript:;" class="numbers"><span>200</span>Non Conformance </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>100</span>Incidence  </a>
								</li>
								<li>
									<a href="javascript:;" class="numbers"><span>100</span>Reports</a>
								</li>
								
							</ul>
						</div>
						<div class="tab-pane" id="specimen_block_prefix">
						<!----><?php //$attributes = array('id' => 'specimen_block_prefix');
						//                            echo form_open('', $attributes); ?>
						<!-- --><?php //echo '<pre>'; print_r($lab_info['lab_id']); exit; ?>
                            <form id="specimen_block_prefix_form">
                                <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
                                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>"
                                       value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" name="lab_info_id" id="lab_info_id" value="<?php echo $lab_info['lab_id']; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="focus-label">Specimen Prefix</label>
											<!--<input type="text" class="form-control" id="specimen_prefix" name="specimen_prefix" value="--><?php //echo (!empty($lab_info['lab_specimen_prefix'])?$lab_info['lab_specimen_prefix']:''); ?><!--">-->
                                            <select class="form-control" id="specimen_prefix" name="specimen_prefix">
                                                <option value="">-- Select Option --</option>
                                                <option value="Alphabetical" <?php echo ($lab_info['lab_specimen_prefix']=='Alphabetical'?'selected':''); ?> >Alphabetical</option>
                                                <option value="Numeric" <?php echo ($lab_info['lab_specimen_prefix']=='Numeric'?'selected':''); ?> >Numeric</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="focus-label">Specimen Block Prefix</label>
                                            <select class="form-control" id="specimen_block_prefix" name="specimen_block_prefix">
                                                <option value="">-- Select Option --</option>
                                                <option value="Alphabetical" <?php echo ($lab_info['lab_specimen_block_prefix']=='Alphabetical'?'selected':''); ?> >Alphabetical</option>
                                                <option value="Numeric" <?php echo ($lab_info['lab_specimen_block_prefix']=='Numeric'?'selected':''); ?> >Numeric</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="focus-label">Laboratory No. Prefix</label>
                                            <input type="text" class="form-control" id="lab_no_prefix" name="lab_no_prefix" value="<?php echo (!empty($lab_info['lab_no_prefix'])?$lab_info['lab_no_prefix']:''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="save_specimen_prefix_btn" class="btn btn-info btn-lg btn-rounded btn-save">Save</button>
                                    </div>
                                </div>
                            </form>
							<!-- --><?php //echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="col-md-6">
			<div class="card card-table flex-fill" style="height: 447px; overflow-y: auto;">
				<div class="card-body dash_tabs nopadding">
					<ul class="nav nav-tabs nav-tabs-solid ">
                    <li class="nav-item"><a class="nav-link active" href="#requestForm" data-toggle="tab">Request Form</a></li>
						<li class="nav-item"><a class="nav-link" href="#checkList" data-toggle="tab">Check List</a></li>
						<li class="nav-item"><a class="nav-link" href="#Sops" data-toggle="tab">SOP's</a></li>
						
					</ul>
					<div class="tab-content" style="padding: 0px;">	
                    
                    <div class="tab-pane active" id="requestForm">
							<div class="card card-table flex-fill" style="height: 404px; overflow-y: hide; border: 0;">
								<div class="card-header">
									<h3 class="card-title mb-0">Request Form
										<i class="fa fa-cloud-upload pull-right" data-toggle="modal" data-target="#upload_request_forms" style="color:green; margin-left:10px"></i>
									</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table custom-table mb-0">
											<thead>
											<tr>
												<th>File</th>
												<th>Request</th>
												<th>Uploaded By</th>
												<th>Uploaded On</th>
												<th class="text-right">Action</th>
											</tr>
											</thead>
											<tbody>
											<?php if (!empty($upload_docs)) {
												foreach ($upload_docs as $row) {
													if($row->file_type == "Request Form"){ 
													?>
														<tr>
															<td>
															<a href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i>
															<?=$row->file_name; ?></a></td>
															<th></th>
															<td><?= $row->last_name." ".$row->first_name; ?></td>
															<td><?= date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?></td>
															<td class="text-right">
																<?php if($row->group_name == 'admin'){ ?>
																	<div class="dropdown dropdown-action">
																		<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-eye m-r-5"></i></a>
																		<div class="dropdown-menu dropdown-menu-right" style="width: 100px;">
																			<a class="dropdown-item" href="javascript:void(0)" onclick="embed_document_track('<?= $row->id; ?>', '<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i> View </a>
																		</div>
																	</div>
																<?php } else { ?>
																	<a class="" href="<?= base_url('laboratory/download_forms/'.$row->file_name); ?>" ><i class="fa fa-cloud-download m-r-5"></i></a>
																			<a class="" href="<?= base_url('laboratory/delete_upload_docs/'.$row->id); ?>" ><i class="fa fa-trash-o m-r-5"></i></a>
																<?php } ?>
															</td>
														</tr>
													<?php } } } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="<?= base_url('documents'); ?>" class="d-block">View all</a>
								</div>
							</div>
						</div>
                    					
						<div class="tab-pane" id="checkList">
							<div class="card card-table flex-fill" style="height: 404px; overflow-y: hide; border: 0;">
								<div class="card-header">
									<h3 class="card-title mb-0">Check List
										<i class="fa fa-cloud-upload pull-right" data-toggle="modal" data-target="#upload_check_list" style="color:green; margin-left:10px"></i>
									</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>File</th>
                                                    <th>Request</th>
													<th>Uploaded By</th>
													<th>Uploaded On</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php if (!empty($upload_docs)) 
											{
												foreach ($upload_docs as $row) {
													if($row->file_type == "Check List"){
														?>
														<tr>
															<td><a href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i><?=$row->file_name; ?></a></td>
															<td></td>
															<td><?= $row->last_name." ".$row->first_name; ?></td>
															<td><?= date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?></td>
															<td class="text-right">
																<?php if($row->group_name == 'admin'){ ?>
																	<div class="dropdown dropdown-action">
																		<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
																		<div class="dropdown-menu dropdown-menu-right" style="width: 100px;">
																			<a class="dropdown-item" href="javascript:void(0)" onclick="embed_document_track('<?= $row->id; ?>', '<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i> View </a>
																		</div>
																	</div>
																<?php } else { ?>
																	<a class="" href="<?= base_url('laboratory/download_forms/'.$row->file_name); ?>" ><i class="fa fa-cloud-download m-r-5"></i></a>
																	<a class="" href="javascript:delete_check_list('<?= base_url('laboratory/delete_upload_docs/'.$row->id); ?>')" ><i class="fa fa-trash-o m-r-5"></i></a>
																<?php } ?>
															</td>
														</tr>
													<?php } } } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="javascript:;" class="d-block">View all</a>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="Sops">
							<div class="card card-table flex-fill" style="height: 404px; overflow-y: hide; border: 0;">
								<div class="card-header">
									<h3 class="card-title mb-0">SOP's
										<i class="fa fa-cloud-upload pull-right" data-toggle="modal" data-target="#upload_sops" style="color:green; margin-left:10px"></i>
									</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table mb-0">
											<thead>
												<tr>
													<th>File</th>
													<th>Uploaded By</th>
													<th>Uploaded On</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php if (!empty($upload_docs)) {
												foreach ($upload_docs as $row) {
													if($row->file_type == "SOP Form"){
														?>
														<tr>
															<td><?= $row->file_name; ?></td>
															<td><?= $row->last_name." ".$row->first_name; ?></td>
															<td><?= date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?></td>
															<td class="text-right">
																<?php if($row->group_name == 'admin'){ ?>
																	<div class="dropdown dropdown-action">
																		<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-eye m-r-5"></i></a>
																		<div class="dropdown-menu dropdown-menu-right" style="width: 100px;">
																			<a class="dropdown-item" href="javascript:void(0)" onclick="embed_document_track('<?= $row->id; ?>', '<?= base_url($row->file_path); ?>')"><i class="fa fa-eye m-r-5"></i> View </a>
																		</div>
																	</div>
																<?php } else { ?>
																	<a class="" href="<?= base_url('laboratory/download_forms/'.$row->file_name); ?>" ><i class="fa fa-cloud-download m-r-5"></i></a>
																			<a class="" href="<?= base_url('laboratory/delete_upload_docs/'.$row->id); ?>" ><i class="fa fa-trash-o m-r-5"></i></a>
																<?php } ?>
															</td>
														</tr>
													<?php } } } ?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="card-footer">
									<a href="javascript:;" class="d-block">View all</a>
								</div>
							</div>
						</div>

						
					</div>

					
				</div>


				
			</div>
		</div>	
		
	</div>

	

	<div class="row">

<div class="col-md-6 col-sm-12 d-flex">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover custom-table mb-0" style="    white-space: nowrap;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Login</th>
                                <th>IP</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($usersLogins as $uDetail){?>
                                <?php
                                $user_detail = base64_encode($uDetail->session_userid."___".$uDetail->client_ip);
                                ?>
                                <tr onClick="(function(){
                                        window.location = '<?php echo base_url()."/laboratory/";?>getLoginDetail/<?php echo $user_detail;?>';
                                        return false;
                                        })();return false;">
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="" class="avatar dashboard_admin">
                                                <img alt="" class="profile-pic"
                                                     src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                            <a href="<?php echo base_url()."/laboratory/";?>getLoginDetail/<?php echo $user_detail;?>"><?php echo  $uDetail->first_name." ".$uDetail->last_name; ?> <span><?php echo  $this->ion_auth->get_users_groups($uDetail->session_userid )->row()->description; ?></span></a>                                    </h2>
                                    </td>
                                    <td><?php echo date("d-M-Y h:i A",$uDetail->login_time); ?></td>
                                    <td><?php echo $uDetail->client_ip; ?></td>
                                    <td>
                                        <?php
                                        $innerText=$innerClass="";
                                        if($uDetail->remember==0){
                                            $innerText = "New IP";
                                            $innerClass = "warning";
                                            $toolText = "A new sign on has been detected but not verified";
                                        }else if($uDetail->remember==1){
                                            $innerText = "Approved IP";
                                            $innerClass = "success";
                                            $toolText = "New sign on verified by user";
                                        } else {
                                            $innerText = "Reported IP";
                                            $innerClass = "danger";
                                            $toolText = "New sign no not recognised by user";
                                        }
                                        ?>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-dot-circle-o text-<?php echo $innerClass;?>"></i> <?php echo $innerText; ?>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo site_url('laboratory/allLoginUsers'); ?>">View all</a>
                </div>
            </div>
        </div>
    
		<div class="col-md-6">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Hospitals/Clinic
<!--                        <i class="fa fa-upload pull-right" data-toggle="modal" data-target="#upload_request_forms"-->
<!--                           style="color:green; margin-left:10px"></i>-->
                    </h3>
                </div>
                
                <div class="card-body" style="min-height: 344px">
                    <div class="table-responsive">
                        <table class="table table-striped table-padding custom-table mb-0">
                            <thead>
                            <tr>
                                <th>Name</th>                               
                                <th align="center">Patients</th>
                                <th align="center">Request</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($hospital_list)) {
                                foreach ($hospital_list as $row) { ?>
                                    <tr>
                                        <td><a href="profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-09.jpg"></a><?= $row['description']; ?></td>
                                        <td align="center"><?= $row['patient_count']; ?></td>
                                        <td align="center"><?= $row['request_count']; ?></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                	<a href="javascript:;" class="d-block">View all</a>
                </div>
            </div>
        </div>
		
	</div>

    <div class="row">
       
       
        
        <div class="col-md-6 d-flex" style="display: none !important;">
            <div class="card flex-fill dash-statistics">
                <div class="card-body">
                    <h5 class="card-title">Governance</h5>
                    <div class="stats-list">
                        <div class="stats-info">
                            <p>Today Leave <strong>4 <small>/ 65</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="stats-info">
                            <p>Pending Invoice <strong>15 <small>/ 92</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="stats-info">
                            <p>Completed Projects <strong>85 <small>/ 112</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="stats-info">
                            <p>Open Tickets <strong>190 <small>/ 212</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="stats-info">
                            <p>Closed Tickets <strong>22 <small>/ 212</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



	
</div>

<div id="add_permission" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Permissions</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                    	<div class="form-group form-focus">
	                        <input type="text" class="form-control floating" id="sur_name" name="sur_name">
	                    	<label class="focus-label">Name</label>
	                    </div>
                    </div>
                    <div class="col-md-6">
                    	<input class="form-control input-lg" type="file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info btn-lg btn-rounded btn-save">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="upload_sops" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload SOP's Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 700px;">
                <div class="container" role="main">
                    <form method="post" action="<?= base_url('laboratory/upload_docs_form'); ?>" enctype="multipart/form-data" novalidate class="box">
                        <input type="hidden" name="file_type" value="SOP Form">
                        <div class="box__input">
                            <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"/></svg>
                            <input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple />
                            <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
<!--                            <button type="submit" class="box__button">Upload</button>-->
                        </div>
                        <div class="box__uploading">Uploading&hellip;</div>
                        <div class="box__success">Documents uploaded successfully!</div>
                        <div class="box__error">Error! Recheck and try again. </div>
                        <button class="btn btn-primary submit-btn box__button">Submit</button>
                    </form>
                </div>

                <?php //echo form_open_multipart('laboratory/upload_docs_form', array('id' => 'upload_sop_form', 'name' => 'upload_sop_form')); ?>
<!--                <input type="hidden" name="file_type" value="SOP Form">-->
                <!--<div class="form-group">
                    <label>Upload Files</label>
                    <input class="form-control" name="upload_doc[]" type="file" multiple="multiple">
                </div>-->

                <!--<div class="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                    <div class="drag_upload_file">
                        <p>Drop file(s) here</p>
                        <p>or</p>
                        <p><input type="button" value="Select File(s)" onclick="file_explorer();" /></p>
                        <input class="" name="upload_doc[]" type="file" id="selectfile" multiple="multiple" >
                    </div>
                </div>-->

                <!--<div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>-->
                <?php //echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div id="upload_check_list" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Check List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 700px;">
                <div class="container" role="main">
                    <form method="post" action="<?= base_url('laboratory/upload_docs_form'); ?>" enctype="multipart/form-data" novalidate class="box">
                        <input type="hidden" name="file_type" value="Check List">
                        <div class="box__input">
                            <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"/></svg>
                            <input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple />
                            <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
<!--                            <button type="submit" class="box__button">Upload</button>-->
                        </div>
                        <div class="box__uploading">Uploading&hellip;</div>
                        <div class="box__success">Documents uploaded successfully!</div>
                        <div class="box__error">Error! Recheck and try again. </div>
                        <button class="btn btn-primary submit-btn box__button">Submit</button>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</div>


<div id="upload_request_forms" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Request Forms</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container" role="main">
                    <form method="post" action="<?= base_url('laboratory/upload_docs_form'); ?>" enctype="multipart/form-data" novalidate class="box">
                        <input type="hidden" name="file_type" value="Request Form">
                        <div class="box__input">
                            <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"/></svg>
                            <input type="file" name="files[]" id="file" class="box__file" data-multiple-caption="{count} files selected" multiple />
                            <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
                            <!--                            <button type="submit" class="box__button">Upload</button>-->
                        </div>
                        <div class="box__uploading">Uploading&hellip;</div>
                        <div class="box__success">Documents uploaded successfully!</div>
                        <div class="box__error">Error! Recheck and try again. </div>
                        <button class="btn btn-primary submit-btn box__button">Submit</button>
                    </form>
                </div>

                <?php //echo form_open_multipart('laboratory/upload_docs_form', array('id' => 'upload_sop_form', 'name' => 'upload_sop_form')); ?>
<!--                <input type="hidden" name="file_type" value="Request Form">-->
                <!--<div class="form-group">
                    <label>Upload Files</label>
                    <input class="form-control" name="upload_doc" type="file">
                </div>-->
                <!--<div class="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                    <div class="drag_upload_file">
                        <p>Drop file(s) here</p>
                        <p>or</p>
                        <p><input type="button" value="Select File(s)" onclick="file_explorer();" /></p>
                        <input class="" name="upload_doc[]" type="file" id="selectfile" multiple="multiple" >
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                </div>-->
                <?php //echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div id="view_doc" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart(uri_string(), array('id'=>'edit_cv_appraisal','name' => 'edit_cv_appraisal')); ?>
            <input type="hidden" name="edit_cv_appraisal" value="1">
            <div class="modal-body" id="doc_embed">
                <?php $file_path = $cv_appr_data['cv_doc_file_name']; ?>

            </div>
            <div class="modal-footer">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal custom-modal fade" id="delete_check_list_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Check List Item</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn check-list-delete-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="">
	$(document).ready(function () {
		$("#doctor_advance_search").click(function(){
			$("#advance_search_table").slideToggle();
		});
	})	
</script>

<script>
    // Base url as javascript variable
    const _base_url = `<?php echo base_url() ?>`
    const default_profile_pic = `<?php echo base_url().DEFAULT_PROFILE_PIC?>`;
</script>

<script type="text/javascript">

    function embed_document(file_name){
        var embed_div = document.getElementById('doc_embed');
        embed_div.innerHTML="";
        embed_div.innerHTML = "<embed src='"+file_name+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";
    }
    function embed_document_track(document_id, file_name){
        $(document).find('#view_doc').modal('hide');
        $.ajax({
            url: `${_base_url}laboratory/track_viewer`,
            type: 'POST',
            global: false,
            dataType: 'json',
            data: { "document_id": document_id },
            success: function (response) {
                if (response.status === 'success') {
                    $(document).find('#view_doc').modal('show');
                    embed_document(file_name);
                } else {
                    $.sticky(response.message, {classList: 'important', speed: 200, autoclose: 7000});
                }
            }
        });
    }
    function upload_file(e) {
        e.preventDefault();
        //ajax_file_upload(e.dataTransfer.files);
    }
    function file_explorer() {
        document.getElementById('selectfile').click();
        document.getElementById('selectfile').onchange = function() {
            files = document.getElementById('selectfile').files;
            //ajax_file_upload(files);
        };
    }
    function ajax_file_upload(files_obj) {
        if(files_obj != undefined) {
            var form_data = new FormData();
            console.log(files_obj);
            for(i=0; i<files_obj.length; i++) {
                form_data.append('upload_doc[]', files_obj[i]);
            }
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "laboratory/upload_docs_form", true);
            xhttp.onload = function(event) {
                if (xhttp.status == 200) {
                    //alert(this.responseText);
                } else {
                    alert("Error " + xhttp.status + " occurred when trying to upload your file.");
                }
            }

            //xhttp.send(form_data);
        }
    }
</script>

<script>

    'use strict';

    ;( function ( document, window, index )
    {
        // feature detection for drag&drop upload
        var isAdvancedUpload = function()
        {
            var div = document.createElement( 'div' );
            return ( ( 'draggable' in div ) || ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
        }();


        // applying the effect for every form
        var forms = document.querySelectorAll( '.box' );
        Array.prototype.forEach.call( forms, function( form )
        {
            var input		 = form.querySelector( 'input[type="file"]' ),
                label		 = form.querySelector( 'label' ),
                errorMsg	 = form.querySelector( '.box__error span' ),
                restart		 = form.querySelectorAll( '.box__restart' ),
                droppedFiles = false,
                showFiles	 = function( files )
                {
                    label.textContent = files.length > 1 ? ( input.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name;
                },
                triggerFormSubmit = function()
                {
                    var event = document.createEvent( 'HTMLEvents' );
                    event.initEvent( 'submit', true, false );
                    form.dispatchEvent( event );
                };

            // letting the server side to know we are going to make an Ajax request
            var ajaxFlag = document.createElement( 'input' );
            ajaxFlag.setAttribute( 'type', 'hidden' );
            ajaxFlag.setAttribute( 'name', 'ajax' );
            ajaxFlag.setAttribute( 'value', 1 );
            form.appendChild( ajaxFlag );

            // automatically submit the form on file select
            input.addEventListener( 'change', function( e )
            {
                showFiles( e.target.files );


            });

            // drag&drop files if the feature is available
            if( isAdvancedUpload )
            {
                form.classList.add( 'has-advanced-upload' ); // letting the CSS part to know drag&drop is supported by the browser

                [ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach( function( event )
                {
                    form.addEventListener( event, function( e )
                    {
                        // preventing the unwanted behaviours
                        e.preventDefault();
                        e.stopPropagation();
                    });
                });
                [ 'dragover', 'dragenter' ].forEach( function( event )
                {
                    form.addEventListener( event, function()
                    {
                        form.classList.add( 'is-dragover' );
                    });
                });
                [ 'dragleave', 'dragend', 'drop' ].forEach( function( event )
                {
                    form.addEventListener( event, function()
                    {
                        form.classList.remove( 'is-dragover' );
                    });
                });
                form.addEventListener( 'drop', function( e )
                {
                    droppedFiles = e.dataTransfer.files; // the files that were dropped
                    showFiles( droppedFiles );

                });
            }


            // if the form was submitted
            form.addEventListener( 'submit', function( e )
            {
                // preventing the duplicate submissions if the current one is in progress
                if( form.classList.contains( 'is-uploading' ) ) return false;

                form.classList.add( 'is-uploading' );
                form.classList.remove( 'is-error' );

                if( isAdvancedUpload ) // ajax file upload for modern browsers
                {
                    e.preventDefault();

                    // gathering the form data
                    var ajaxData = new FormData( form );
                    if( droppedFiles )
                    {
                        Array.prototype.forEach.call( droppedFiles, function( file )
                        {
                            ajaxData.append( input.getAttribute( 'name' ), file );
                        });
                    }

                    // ajax request
                    var ajax = new XMLHttpRequest();
                    ajax.open( form.getAttribute( 'method' ), form.getAttribute( 'action' ), true );

                    ajax.onload = function()
                    {
                        form.classList.remove( 'is-uploading' );
                        if( ajax.status >= 200 && ajax.status < 400 )
                        {
                            var data = JSON.parse( ajax.responseText );
                            form.classList.add( data.success == true ? 'is-success' : 'is-error' );
                            if( !data.success ) errorMsg.textContent = data.error;
                            if( data.success == true ){
                                setTimeout(function(){
                                    window.location.reload();
                                },3000);
                            }
                        }
                        else alert( 'Error. Please, contact the webmaster!' );
                    };

                    ajax.onerror = function()
                    {
                        form.classList.remove( 'is-uploading' );
                        alert( 'Error. Please, try again!' );
                    };

                    ajax.send( ajaxData );
                }
                else // fallback Ajax solution upload for older browsers
                {
                    var iframeName	= 'uploadiframe' + new Date().getTime(),
                        iframe		= document.createElement( 'iframe' );

                    $iframe		= $( '<iframe name="' + iframeName + '" style="display: none;"></iframe>' );

                    iframe.setAttribute( 'name', iframeName );
                    iframe.style.display = 'none';

                    document.body.appendChild( iframe );
                    form.setAttribute( 'target', iframeName );

                    iframe.addEventListener( 'load', function()
                    {
                        var data = JSON.parse( iframe.contentDocument.body.innerHTML );
                        form.classList.remove( 'is-uploading' )
                        form.classList.add( data.success == true ? 'is-success' : 'is-error' )
                        form.removeAttribute( 'target' );
                        if( !data.success ) errorMsg.textContent = data.error;
                        iframe.parentNode.removeChild( iframe );
                    });
                }
            });


            // restart the form if has a state of error/success
            Array.prototype.forEach.call( restart, function( entry )
            {
                entry.addEventListener( 'click', function( e )
                {
                    e.preventDefault();
                    form.classList.remove( 'is-error', 'is-success' );
                    input.click();
                });
            });

            // Firefox focus bug fix for file input
            input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
            input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });

        });
    }( document, window, 0 ));
    function delete_check_list(url){
        $('#delete_check_list_modal').modal('show');    
        $('.check-list-delete-btn').attr('href', url);
    }
</script>