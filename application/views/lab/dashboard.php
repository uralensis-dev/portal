<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>

	.text-center{text-align: center !important}
	.text-black{color: #000;}
    #DataTables_Table_2_wrapper .row:first-child,
    #DataTables_Table_0_wrapper .row:first-child,
    #DataTables_Table_1_wrapper .row:first-child {
        display: none !important;
    }
    #DataTables_Table_2_wrapper thead tr th[colspan="2"]{
    	width: 121px !important;
    }
    .table thead tr th img, .table tfoot tr th img{
    	min-width: 25px !important;
    }
    .tab-content>.tab-pane{
        min-height: 720px !important;
    }
    .btn_gre, .btn_bl{
    	background: transparent;
    	border:1px solid;
    	padding: 0;
    	width: 20px;
    }
    .new_height{
    	min-height: 400px;
    	/*overflow-y: auto;*/
    }
    div.dataTables_wrapper div.dataTables_filter label{color: #fff;}
    #request_form_table_filter input {
        position: relative;
        top: -50px;
        right: 70px;
        border-radius: 18px;
    }
    div.dataTables_wrapper div.dataTables_filter label{
        position: relative;
    }
    #request_form_table_filter label:after{
        position: absolute;
        content: "\f002";
        font-family: "fontawesome";
        position: absolute;
        top: -50px;
        right: 70px;
        background: #00c5fb;
        z-index: 99;
        color: #fff;
        line-height: 1;
        padding: 8px;
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
    }
    @media screen and (min-width: 1450) {
    	.form-control {
		    font-size: 18px !important;
		    color: #000;
		}
    }
    @media screen and (max-width: 540px) {
    	.mobile_hidden_table_cell{display: none !important}
    }


</style>
<div class="container-fluid">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-8">
				<h3 class="page-title">Welcome <?php echo $decryptedDetails->first_name." ".$decryptedDetails->last_name?></h3>
<!--				<h3 class="page-title">Welcome</h3>-->
			</div>
			<div class="col-sm-4">
				<div class="pull-right">
				<a href="javascript:void(0);" id="doctor_advance_search"><i class="fa fa-cog fa-2x"></i></a>
				<!-- <a id="doctor_advance_search" class="btn btn-info btn-lg newbtn" href="javascript:void(0);"> Advance Search</a> -->
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	        	<div class="tg-breadcrumbarea tg-searchrecordhold">
	            	<ol class="tg-breadcrumb tg-breadcrumbvtwo">
	            		<li><a href="javascript:;">Dashboard</a></li>
	            	</ol>
	                <!-- <button class="btn btn-primary" data-toggle="collapse" data-target="#collapse_filter_hospital">Filter By Hospital</button> -->
	            </div>
	        </div>
	    </div>
	</div>
	<div id="advance_search_table" style="display: none">
		<div class="row">
			<?php
	           $attributes = array('class' => '');
	            echo form_open("Doctor/search_request", $attributes);
	            ?>
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

	<div class="row dashboard_widgets">
		<div class="col-sm-6 col-md-3">
        <a href="<?php echo base_url('index.php/doctor/record_tracking'); ?>">
			<div class="card dash-widget">
				<div class="card-body xl-level">
					<a href="<?php echo base_url('index.php/doctor/record_tracking'); ?>">
						<span class="dash_images">
							<img src="<?php echo base_url('assets/icons/Track.png'); ?>" class="img-responsive">
						</span>
						<div class="dash-widget-info">
							<h3>Track</h3>
							<!-- <span>Projects</span> -->
						</div>
					
				</div>
			</div>
            </a>
		</div>
<!--		<div class="col-sm-6 col-md-3">-->
<!--			<div class="card dash-widget">-->
<!--				<div class="card-body xl-level">-->
<!--					<a href="--><?php //echo base_url('index.php/institute/view_further_work?fw_page=requested'); ?><!--">-->
<!--						<span class="dash_images">-->
<!--							<img src="--><?php //echo base_url('assets/icons/Laboratory.png'); ?><!--" class="img-responsive">-->
<!--						</span>-->
<!--						<div class="dash-widget-info">-->
<!--							<h3>Lab Requests</h3>-->
<!--							 <span>Clients</span> -->
<!--						</div>-->
<!--					</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
		<div class="col-sm-6 col-md-3">
			<div class="card dash-widget">
				<div class="card-body xl-level">
					<a href="<?php echo base_url('AddCourier'); ?>">
						<span class="dash_images">
							<img src="<?php echo base_url('assets/icons/Courier.png'); ?>" class="img-responsive">
						</span>
						<div class="dash-widget-info">
							<h3>Courier</h3>
							<!-- <span>Tasks</span> -->
						</div>
					</a>
				</div>
			</div>
		</div>
        <div class="col-sm-6 col-md-3">
            <div class="card dash-widget">
                <div class="card-body xl-level">
                    <a href="<?php echo base_url('labEnquiries'); ?>">
						<span class="dash-widget-icon">
							<img src="<?php echo base_url('assets/icons/Courier.png'); ?>" class="img-responsive">
						</span>
                        <div class="dash-widget-info">
                            <h3>Lab Support</h3>
                            <!-- <span>Tasks</span> -->
                        </div>
                    </a>
                </div>
            </div>
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

	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-body dash_tabs nopadding new_height">
					<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
						<li class="nav-item"><a class="nav-link" href="#scheduled" data-toggle="tab">Job Plan</a></li>
						<li class="nav-item"><a class="nav-link" href="#teams" data-toggle="tab">Teams</a></li>
						<li class="nav-item"><a class="nav-link active" href="#work_list" data-toggle="tab">Work List</a></li>
						<li class="nav-item"><a class="nav-link" href="#tats" data-toggle="tab">TAT's</a></li>
						<li class="nav-item"><a class="nav-link" href="#twenty_thirty" data-toggle="tab">20-30 days</a></li>
						<li class="nav-item"><a class="nav-link" href="#thirty_plus" data-toggle="tab">30+ days</a></li>
						<!-- <li class="nav-item"><a class="nav-link" href="#finance" data-toggle="tab">Finance</a></li> -->
					</ul>
					<div class="tab-content">
						<div class="tab-pane" id="scheduled">
                            <div class="table-responsive">
                                <table class="table custom-table mb-0">
                                    <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>Time Slot</th>
                                        <th>Plan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Monday</td>
                                        <td>AM</td>
                                        <td>Cut up</td>
                                    </tr>
                                    <tr>
                                        <td>Monday</td>
                                        <td>PM</td>
                                        <td>Microscopy</td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td>AM</td>
                                        <td>MDT</td>
                                    </tr>
                                    <tr>
                                        <td>Tuesday</td>
                                        <td>PM</td>
                                        <td>SPA</td>
                                    </tr>
                                    <tr>
                                        <td>Wednesday</td>
                                        <td>All day</td>
                                        <td>Cut up</td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td>AM</td>
                                        <td>MDT</td>
                                    </tr>
                                    <tr>
                                        <td>Thursday</td>
                                        <td>PM</td>
                                        <td>Microscopy</td>
                                    </tr>
                                    <tr>
                                        <td>Friday</td>
                                        <td>AM</td>
                                        <td>Cut up</td>
                                    </tr>
                                    <tr>
                                        <td>Monday</td>
                                        <td>PM</td>
                                        <td>Microscopy</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 15px 0px 0px 15px;">
                                <a href="<?php echo base_url('auth/job_plan/'.$this->ion_auth->user()->row()->id); ?>" class="btn btn-primary btn-rounded btn-sm">View Job Plan</a>
                            </div>

						</div>
						<div class="tab-pane" id="teams">
							<div class="table-responsive">
								<table class="table custom-table mb-0">
									<thead>
										<tr>
											<th>Specialty</th>
											<th>Team Lead</th>
											<th>Members</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Pulmonary Pathology</td>
											<td>Dr Rob Hadden</td>
											<td></td>
										</tr>
										<tr>
											<td>Breast Pathology</td>
											<td>Dr Leonid Semkin</td>
											<td>Dr Rob Hadden</td>
										</tr>
										<tr>
											<td>Dermatopathology</td>
											<td>Dr Tim Bracey</td>
											<td>Dr Rob Hadden, Dr Leonid Semkin</td>
										</tr>
										<tr>
											<td>Genitourinary Pathology</td>
											<td>Dr Paul Hiley</td>
											<td></td>
										</tr>
										<tr>
											<td>Gastrointestinal Pathology</td>
											<td>Dr Tim Bracey</td>
											<td>Dr Paul Hiley, Dr Leonid Semkin</td>
										</tr>
										<tr>
											<td>Lympho-reticular Pathology</td>
											<td>Dr Paul Hiley</td>
											<td></td>
										</tr>
										<tr>
											<td>Head and Neck Pathology</td>
											<td>Dr Tim Bracey</td>
											<td></td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>

						<div class="tab-pane active" id="work_list">
							
							<div class="sub_tab_title">In Progress Cases</div>
							

							<div class="table-responsive form-group">
                                <table class="table doctors_pub_upub_table table custom-table mb-0" style="width: 100% !important">
                                    <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th>Specialty</th>
                                        <th>Hospital</th>
                                        <th colspan="2" width="85" style="text-align: center;">Urgent</th>
                                        <th colspan="2" width="85" style="text-align: center;">2WW</th>
                                        <th colspan="2" width="85" style="text-align: center;" class="mobile_hidden_table_cell">Routine</th>
                                        <th colspan="2" width="85" style="text-align: center;">Total</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align: center; width: 48px !important" title="To Scan">
                                            <img src="<?php echo base_url()?>assets/icons/black_microscope.png" style="width: 25px;">
                                        </th>
                                        <th style="text-align: center; width: 48px !important" title="Scanned">
                                            <img src="<?php echo base_url()?>assets/icons/green_microscope.png" style="width:25px;">
                                        </th>
                                        <th style="text-align: center; width: 48px !important" title="To Scan">
                                            <img src="<?php echo base_url()?>assets/icons/black_microscope.png" style="width: 25px;">
                                        </th>
                                        <th style="text-align: center; width: 48px !important" title="Scanned">
                                            <img src="<?php echo base_url()?>assets/icons/green_microscope.png" style="width:25px;">
                                        </th>
                                        <th class="mobile_hidden_table_cell" style="text-align: center; width: 48px !important" title="To Scan">
                                            <img src="<?php echo base_url()?>assets/icons/black_microscope.png" style="width: 25px;">
                                        </th>
                                        <th class="mobile_hidden_table_cell" style="text-align: center; width: 48px !important" title="Scanned">
                                            <img src="<?php echo base_url()?>assets/icons/green_microscope.png" style="width:25px;">
                                        </th>
                                        <th style="text-align: center; width: 48px !important" title="To Scan">
                                            <img src="<?php echo base_url()?>assets/icons/black_microscope.png" style="width: 25px;">
                                        </th>
                                        <th style="text-align: center; width: 48px !important" title="Scanned">
                                            <img src="<?php echo base_url()?>assets/icons/green_microscope.png" style="width:25px;">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(!empty($unpublished_stats)){
                                        $urgent_usc =0; $urgent_sc =0; $tww_usc =0; $tww_sc =0; $routine_usc=0; $routine_sc=0; $spec_total_usc=0; $spec_total_sc=0;
                                        foreach ($unpublished_stats as $row){
                                            $curr_date     =$row['cur_date'];
                                            $speciality_id     =$row['speciality_id'];
                                            $urgent_usc     =$urgent_usc+$row['urgent_unscanned'];
                                            $urgent_sc      =$urgent_sc +$row['urgent_scanned'];

                                            $tww_usc        =$tww_usc+$row['tww_unscanned'];
                                            $tww_sc         =$tww_sc+$row['tww_scanned'];
                                            $routine_usc    =$routine_usc+$row['routine_unscanned'];
                                            $routine_sc     =$routine_sc+$row['routine_scanned'];
                                            $spec_total_usc =$spec_total_usc+$row['specialty_usc_total'];
                                            $spec_total_sc  =$spec_total_sc+$row['specialty_sc_total'];
                                            ?>
                                            <tr>
                                                <td><?php echo $row['cur_date']; ?></td>
                                                <td><?php echo $row['specialty']; ?></td>
                                                <td><?php echo $row['hospital']; ?></td>
                                                <td class="text-black text-center font-20 font-md-16"><?php echo $row['urgent_unscanned']; ?></td>
                                                <td class="text-success text-center font-20 font-md-16"><?php echo $row['urgent_scanned']; ?></td>
                                                <td class="text-black text-center font-20 font-md-16"><?php echo $row['tww_unscanned']; ?></td>
                                                <td class="text-success text-center font-20 font-md-16"><?php echo $row['tww_scanned']; ?></td>
                                                <td class="text-black text-center mobile_hidden_table_cell font-20 font-md-16"><?php echo $row['routine_unscanned']; ?></td>
                                                <td class="text-success text-center mobile_hidden_table_cell font-20 font-md-16"><?php echo $row['routine_scanned']; ?></td>
                                                <td class=" text-center font-20 font-md-16">
                                                	 <button class="btn_bl"><?php echo $row['specialty_usc_total']; ?></button>
                                                </td>
                                                <td class="text-success text-center font-20 font-md-16">
                                                    <form action="<?php echo base_url('doctor/search_request'); ?>" method="post">
                                                        <input type="hidden" name="specialty" value="<?php echo $row['speciality_id'];?>">
                                                        <button class="btn_gre"><?php echo $row['specialty_sc_total']; ?></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <tr>
                                            <td><?php echo $curr_date; ?></td>
                                            <td>Total</td>
                                            <td>All</td>
                                            <td class="text-black text-right font-20 font-md-16"><?php echo $urgent_usc; ?></td>
                                            <td class="text-success text-right font-20 font-md-16"><?php echo $urgent_sc; ?></td>
                                            <td class="text-black text-right font-20 font-md-16"><?php echo $tww_usc; ?></td>
                                            <td class="text-success text-right font-20 font-md-16"><?php echo $tww_sc; ?></td>
                                            <td class="mobile_hidden_table_cell text-black text-right font-20 font-md-16"><?php echo $routine_usc; ?></td>
                                            <td class="mobile_hidden_table_cell text-success text-right font-20 font-md-16"><?php echo $routine_sc; ?></td>
                                            <td class="text-black text-right font-20 font-md-16"><?php echo $spec_total_usc; ?></td>
                                            <td class="text-success text-right font-20 font-md-16">
                                                <button style="background: transparent; border: 1px solid;" ><a class="text-success" href="<?php echo base_url('doctor/doctor_record_list'); ?>"><?php echo $spec_total_sc; ?></a></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
							</div>


							<div class="sub_tab_title">
                                Authorised Cases
                                <div class=" pull-right mr-2">
                                    <select class="form-control" id="authorized_case_period" name="published_period" >
                                        <option value="0">Select Period</option>
                                        <option selected value="7">Week</option>
                                        <option value="14">Fortnight</option>
                                        <option value="30">Month</option>
                                        <option value="90">Quarter</option>
                                        <option value="183">Half</option>
                                        <option value="365">Year</option>
                                    </select>
                                </div>
                            </div>

							<div class="table-responsive form-group">
								<table class="doctors_pub_table table custom-table mb-0">
									<thead>
										<tr>
											<th>Date Period</th>
											<th>Specialty</th>
											<th>Hospital</th>
											<th style="text-align: center;">Urgent</th>
											<th style="text-align: center;">2WW</th>
											<th style="text-align: center;">Routine</th>
											<th style="text-align: center;">Total</th>
										</tr>
									</thead>
									<tbody>
                                    <?php if(!empty($published_stats)){
                                    $urgent_sc =0; $tww_sc =0; $routine_sc=0; $spec_total_sc=0;
                                    foreach ($published_stats as $row){
                                        $curr_date     =$row['cur_date'];
                                        $urgent_sc      =$urgent_sc +$row['urgent_scanned'];
                                        $tww_sc         =$tww_sc+$row['tww_scanned'];
                                        $routine_sc     =$routine_sc+$row['routine_scanned'];
                                        $spec_total_sc  =$spec_total_sc+$row['specialty_sc_total'];
                                    ?>
										<tr>
											<td><?php echo $row['cur_date']; ?></td>
											<td><?php echo $row['specialty']; ?></td>
											<td><?php echo $row['hospital']; ?></td>
											<td style="text-align: right;  font-size:20px"><?php echo $row['urgent_scanned']; ?></td>
											<td style="text-align: right;  font-size:20px"><?php echo $row['tww_scanned']; ?></td>
											<td style="text-align: right;  font-size:20px"><?php echo $row['routine_scanned']; ?></td>
											<td style="text-align: right;  font-size:20px"><?php echo $row['specialty_sc_total']; ?></td>
										</tr>
                                    <?php } ?>
										<tr>
											<td><?php echo $curr_date; ?></td>
											<td>Total </td>
											<td>All</td>
											<td style="text-align: right;  font-size:20px"><?php echo $urgent_sc; ?></td>
											<td style="text-align: right;  font-size:20px"><?php echo $tww_sc; ?></td>
											<td style="text-align: right;  font-size:20px"><?php echo $routine_sc; ?></td>
											<td style="text-align: right;  font-size:20px"><?php echo $spec_total_sc; ?></td>
										</tr>
                                    <?php } ?>
                                    </tbody>
								</table>
							</div>
						</div>

						<div class="tab-pane" id="tats" style="padding: 15px;">
							<div id="tats_graph" style="min-height: 440px; width: 100%;"></div>
						</div>


						<div class="tab-pane" id="twenty_thirty">
                            <div class="table-responsive" style="min-height: 550px !important;">
                                <table class=" doctors_tat_table table custom-table mb-0">
                                    <thead>
                                    <tr>
                                        <th>UL No. <br> Track No.</th>
                                        <th>Client <br> Clinic</th>
                                        <!-- <th>Courier No. <br> Batch No</th> -->
                                        <th>First Name <br> Surname</th>
                                        <th>NHS No.<br>DOB</th>
                                        <th>Digi No.<br>Rel Date</th>
                                        <th> Flag</th>
                                        <th>Tat</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $flag_count = 11;
                                    foreach ($query as $row) {

                                        $now = time();
                                        $date_taken = !empty($row->date_taken) ? $row->date_taken : '';
                                        $request_date = !empty($row->request_datetime) ? $row->request_datetime : '';
                                        $tat_date = '';

                                        $tat_settings = uralensis_get_tat_date_settings($row->hospital_group_id);

                                        if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
                                            $date_sent_to_uralensis = !empty($row->date_sent_touralensis) ? $row->date_sent_touralensis : '';
                                            $tat_date = $date_sent_to_uralensis;
                                        } elseif ($tat_settings['ura_tat_date_data'] === 'date_rec_by_doctor') {
                                            $data_rec_by_doctor = !empty($row->date_rec_by_doctor) ? $row->date_rec_by_doctor : '';
                                            $tat_date = $data_rec_by_doctor;
                                        } elseif ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
                                            $data_processed_bylab = !empty($row->data_processed_bylab) ? $row->data_processed_bylab : '';
                                            $tat_date = $data_processed_bylab;
                                        } elseif ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
                                            $date_received_bylab = !empty($row->date_received_bylab) ? $row->date_received_bylab : '';
                                            $tat_date = $date_received_bylab;
                                        } elseif ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
                                            $publish_datetime = !empty($row->publish_datetime) ? $row->publish_datetime : '';
                                            $tat_date = $publish_datetime;
                                        } else {
                                            if (!empty($date_taken)) {
                                                $tat_date = $date_taken;
                                            } else {
                                                $tat_date = $request_date;
                                            }
                                        }

                                        if (!empty($tat_settings) && empty($tat_date)) {
                                            $record_old_count = 'NR';
                                        } elseif (!empty($tat_settings) && !empty($tat_date)) {
                                            $compare_date = strtotime("$tat_date");
                                            $datediff = $now - $compare_date;
                                            $record_old_count = floor($datediff / (60 * 60 * 24));
                                        } else {
                                            $compare_date = strtotime("$tat_date");
                                            $datediff = $now - $compare_date;
                                            $record_old_count = floor($datediff / (60 * 60 * 24));
                                        }

                                        $badge = '';
                                        if ($record_old_count >= 20 && $record_old_count <= 30) {
                                            $badge = 'badge-warning'; ?>
                                            <!--############################## Data Display Start #########################################-->
                                            <?php  $urgency_class = '';
                                            $urgency_title = '';
                                            if (!empty($row->report_urgency) && $row->report_urgency === 'Urgent') {
                                                $urgency_class = 'urgent-wb';
                                                $urgency_title = 'Urgent';
                                            } elseif (!empty($row->report_urgency) && $row->report_urgency === '2WW') {
                                                $urgency_class = 'two_ww';
                                                $urgency_title = '2WW';
                                            } else {
                                                $urgency_class = 'routine';
                                                $urgency_title = 'Routine';
                                            }

                                            $dob = '';
                                            if (!empty($row->dob)) {
                                                $dob = date('d-m-Y', strtotime($row->dob));
                                            }
                                            $courierNo = '';
                                            if (isset($row->ura_courier_id) && !empty($row->ura_courier_id)) {
                                                $courierNo = $row->ura_courier_id;
                                            }
                                            $batchNo = '';
                                            if (isset($row->ura_batch_ref) && !empty($row->ura_batch_ref)) {
                                                $batchNo = $row->ura_batch_ref;
                                            }
                                            $lab_release_date = '';
                                            if (!empty($row->date_received_bylab)) {
                                                $lab_release_date = date('d-m-Y', strtotime($row->date_received_bylab));
                                            }

                                            ?>
                                            <tr class="<?php //echo $row_code; ?>">
                                                <td class="<?php // echo $row_code; ?>"><?php echo $row->serial_number; ?><br><?php echo $row->ura_barcode_no; ?></td>
                                                <td>
                                                    <?php
                                                    $f_initial = '';
                                                    $l_initial = '';
                                                    if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->first_initial)) {
                                                        $f_initial = $this->ion_auth->group($row->hospital_group_id)->row()->first_initial;
                                                    }
                                                    if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->last_initial)) {
                                                        $l_initial = $this->ion_auth->group($row->hospital_group_id)->row()->last_initial;
                                                    }
                                                    ?>
                                                    <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="javascript:;" >
                                                        <?php echo $f_initial . ' ' . $l_initial; ?>
                                                    </a>
                                                </td>
                                                <!-- <td style="width:146px !important" width="146"><?php //echo $courierNo; ?><br><?php //echo $batchNo; ?></td> -->
                                                <td style="width:93px !important" width="93"><?php echo $row->f_name; ?><br><?php echo $row->sur_name; ?></td>
                                                <td><?php echo $row->nhs_number; ?><br><?php echo $dob; ?></td>
                                                <td><?php echo $row->lab_number; ?><br><?php echo $lab_release_date; ?></td>
                                                <!-- <td style="text-align:center">&nbsp;</td> -->
                                                <td class="flag_column text-center">
                                                    <div class="hover_flags">
                                                        <div class="flag_images">
                                                            <?php if ($row->flag_status === 'flag_red') { ?>
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                                                            <?php } elseif ($row->flag_status === 'flag_yellow') { ?>
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                                                            <?php } elseif ($row->flag_status === 'flag_blue') { ?>
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                                                            <?php } elseif ($row->flag_status === 'flag_black') { ?>
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                                                            <?php } elseif ($row->flag_status === 'flag_gray') { ?>
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_gray.png'); ?>">
                                                            <?php } else { ?>
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                                                            <?php } ?>
                                                        </div>
                                                        <ul class="report_flags record-list-flag list-unstyled list-inline" style="display:none;">
                                                            <?php
                                                            $active = '';
                                                            if ($row->flag_status === 'flag_green') {
                                                                $active = 'flag_active';
                                                            }
                                                            ?>
                                                            <li class="<?php echo $active; ?>">
                                                                <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                    <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $active = '';
                                                            if ($row->flag_status === 'flag_red') {
                                                                $active = 'flag_active';
                                                            }
                                                            ?>
                                                            <li class="<?php echo $active; ?>">
                                                                <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                    <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $active = '';
                                                            if ($row->flag_status === 'flag_yellow') {
                                                                $active = 'flag_active';
                                                            }
                                                            ?>
                                                            <li class="<?php echo $active; ?>">
                                                                <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                    <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $active = '';
                                                            if ($row->flag_status === 'flag_blue') {
                                                                $active = 'flag_active';
                                                            }
                                                            ?>
                                                            <li class="<?php echo $active; ?>">
                                                                <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                    <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $active = '';
                                                            if ($row->flag_status === 'flag_black') {
                                                                $active = 'flag_active';
                                                            }
                                                            ?>
                                                            <li class="<?php echo $active; ?>">
                                                                <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                    <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                                                </a>
                                                            </li>
                                                            <?php
                                                            $active = '';
                                                            if ($row->flag_status === 'flag_gray') {
                                                                $active = 'flag_active';
                                                            }
                                                            ?>
                                                            <li class="<?php echo $active; ?>">
                                                                <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                    <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a>
                                                <span class="badge <?php echo $badge; ?> dash_bade">
                                        <?php echo $record_old_count; ?>
                                    </span>
                                                    </a>
                                                </td>
                                                <td style="text-align:right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="<?php echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                                            <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                    <!-- <a href="<?php //echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?>" class="btn btn-info btn-sm"><i class="lnr lnr-pencil"></i></a> -->
                                                </td>
                                            </tr>
                                            <!--############################## Data Display END #########################################-->
                                        <?php } ?>

                                        <?php
                                        $flag_count++;



                                    }//endforeach
                                    ?>

                                    </tbody>
                                </table>
                            </div>
						</div>
						<div class="tab-pane" id="thirty_plus">
                        	<div class="table-responsive" style="height: 550px !important; overflow-y: auto">
                            <table class="doctors_tat_table table custom-table mb-0">
                                <thead>
                                <tr>
                                    <th>UL No. <br> Track No.</th>
                                    <th>Client <br> Clinic</th>
                                    <!-- <th>Courier No. <br> Batch No</th> -->
                                    <th>First Name <br> Surname</th>
                                    <th>NHS No.<br>DOB</th>
                                    <th>Digi No.<br>Rel Date</th>
                                    <th> Flag</th>
                                    <th>Tat</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $flag_count = 11;
                                foreach ($query as $row) {

                                    $now = time();
                                    $date_taken = !empty($row->date_taken) ? $row->date_taken : '';
                                    $request_date = !empty($row->request_datetime) ? $row->request_datetime : '';
                                    $tat_date = '';

                                    $tat_settings = uralensis_get_tat_date_settings($row->hospital_group_id);

                                    if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
                                        $date_sent_to_uralensis = !empty($row->date_sent_touralensis) ? $row->date_sent_touralensis : '';
                                        $tat_date = $date_sent_to_uralensis;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'date_rec_by_doctor') {
                                        $data_rec_by_doctor = !empty($row->date_rec_by_doctor) ? $row->date_rec_by_doctor : '';
                                        $tat_date = $data_rec_by_doctor;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
                                        $data_processed_bylab = !empty($row->data_processed_bylab) ? $row->data_processed_bylab : '';
                                        $tat_date = $data_processed_bylab;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
                                        $date_received_bylab = !empty($row->date_received_bylab) ? $row->date_received_bylab : '';
                                        $tat_date = $date_received_bylab;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
                                        $publish_datetime = !empty($row->publish_datetime) ? $row->publish_datetime : '';
                                        $tat_date = $publish_datetime;
                                    } else {
                                        if (!empty($date_taken)) {
                                            $tat_date = $date_taken;
                                        } else {
                                            $tat_date = $request_date;
                                        }
                                    }

                                    if (!empty($tat_settings) && empty($tat_date)) {
                                        $record_old_count = 'NR';
                                    } elseif (!empty($tat_settings) && !empty($tat_date)) {
                                        $compare_date = strtotime("$tat_date");
                                        $datediff = $now - $compare_date;
                                        $record_old_count = floor($datediff / (60 * 60 * 24));
                                    } else {
                                        $compare_date = strtotime("$tat_date");
                                        $datediff = $now - $compare_date;
                                        $record_old_count = floor($datediff / (60 * 60 * 24));
                                    }

                                    $badge = '';
                                    if ($record_old_count >30) {
                                        $badge = 'badge-danger'; ?>
									<!--######### Data Display Start ############-->
                                        <?php  $urgency_class = '';
                                        $urgency_title = '';
                                        if (!empty($row->report_urgency) && $row->report_urgency === 'Urgent') {
                                            $urgency_class = 'urgent-wb';
                                            $urgency_title = 'Urgent';
                                        } elseif (!empty($row->report_urgency) && $row->report_urgency === '2WW') {
                                            $urgency_class = 'two_ww';
                                            $urgency_title = '2WW';
                                        } else {
                                            $urgency_class = 'routine';
                                            $urgency_title = 'Routine';
                                        }

                                        $dob = '';
                                        if (!empty($row->dob)) {
                                            $dob = date('d-m-Y', strtotime($row->dob));
                                        }
                                        $courierNo = '';
                                        if (isset($row->ura_courier_id) && !empty($row->ura_courier_id)) {
                                            $courierNo = $row->ura_courier_id;
                                        }
                                        $batchNo = '';
                                        if (isset($row->ura_batch_ref) && !empty($row->ura_batch_ref)) {
                                            $batchNo = $row->ura_batch_ref;
                                        }
                                        $lab_release_date = '';
                                        if (!empty($row->date_received_bylab)) {
                                            $lab_release_date = date('d-m-Y', strtotime($row->date_received_bylab));
                                        }

                                        ?>
                                        <tr class="<?php //echo $row_code; ?>">
                                            <td class="<?php // echo $row_code; ?>"><?php echo $row->serial_number; ?><br><?php echo $row->ura_barcode_no; ?></td>
                                            <td>
                                                <?php
                                                $f_initial = '';
                                                $l_initial = '';
                                                if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->first_initial)) {
                                                    $f_initial = $this->ion_auth->group($row->hospital_group_id)->row()->first_initial;
                                                }
                                                if (!empty($this->ion_auth->group($row->hospital_group_id)->row()->last_initial)) {
                                                    $l_initial = $this->ion_auth->group($row->hospital_group_id)->row()->last_initial;
                                                }
                                                ?>
                                                <a class="hospital_initials" data-toggle="tooltip" data-placement="top" title="<?php echo $this->ion_auth->group($row->hospital_group_id)->row()->description; ?>" href="javascript:;" >
                                                    <?php echo $f_initial . ' ' . $l_initial; ?>
                                                </a>
                                            </td>
                                            <!-- <td style="width:146px !important" width="146"><?php// echo $courierNo; ?><br><?php //echo $batchNo; ?></td> -->
                                            <td style="width:93px !important" width="93"><?php echo $row->f_name; ?><br><?php echo $row->sur_name; ?></td>
                                            <td><?php echo $row->nhs_number; ?><br><?php echo $dob; ?></td>
                                            <td><?php echo $row->lab_number; ?><br><?php echo $lab_release_date; ?></td>
                                            <!-- <td style="text-align:center">&nbsp;</td> -->
                                            <td class="flag_column text-center">
                                                <div class="hover_flags">
                                                    <div class="flag_images">
                                                        <?php if ($row->flag_status === 'flag_red') { ?>
                                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_red.png'); ?>">
                                                        <?php } elseif ($row->flag_status === 'flag_yellow') { ?>
                                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_yellow.png'); ?>">
                                                        <?php } elseif ($row->flag_status === 'flag_blue') { ?>
                                                            <img data-toggle="tooltip" data-placement="top" title="This case marked for Pre-Authorization." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_blue.png'); ?>">
                                                        <?php } elseif ($row->flag_status === 'flag_black') { ?>
                                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as further work." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_black.png'); ?>">
                                                        <?php } elseif ($row->flag_status === 'flag_gray') { ?>
                                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as awaiting reviews." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_gray.png'); ?>">
                                                        <?php } else { ?>
                                                            <img data-toggle="tooltip" data-placement="top" title="This case marked as released." class="report_selected_flag" src="<?php echo base_url('assets/img/flag_lg_green.png'); ?>">
                                                        <?php } ?>
                                                    </div>
                                                    <ul class="report_flags record-list-flag list-unstyled list-inline" style="display:none;">
                                                        <?php
                                                        $active = '';
                                                        if ($row->flag_status === 'flag_green') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_green" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as released." src="<?php echo base_url('assets/img/flag_green.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row->flag_status === 'flag_red') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_red" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked as urgent." src="<?php echo base_url('assets/img/flag_red.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row->flag_status === 'flag_yellow') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_yellow" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for typing." src="<?php echo base_url('assets/img/flag_yellow.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row->flag_status === 'flag_blue') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_blue" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked for pre authorization." src="<?php echo base_url('assets/img/flag_blue.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row->flag_status === 'flag_black') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_black" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked further work." src="<?php echo base_url('assets/img/flag_black.png'); ?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                        $active = '';
                                                        if ($row->flag_status === 'flag_gray') {
                                                            $active = 'flag_active';
                                                        }
                                                        ?>
                                                        <li class="<?php echo $active; ?>">
                                                            <a href="javascript:;" data-flag="flag_gray" data-serial="<?php echo $row->serial_number; ?>" data-recordid="<?php echo $row->uralensis_request_id; ?>" class="flag_change">
                                                                <img data-toggle="tooltip" data-placement="top" title="This case marked awaiting reviews." src="<?php echo base_url('assets/img/flag_gray.png'); ?>">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <a>
                                                <span class="badge <?php echo $badge; ?> dash_bade">
                                        <?php echo $record_old_count; ?>
                                    </span>
                                                </a>
                                            </td>
                                            <td style="text-align:right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="<?php echo site_url() . '/doctor/doctor_record_detail_old/' . $row->uralensis_request_id; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#"><i class="fa fa-eye m-r-5"></i> View</a>
                                                        <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                                <!-- <a href="<?php //echo site_url() . '/doctor/doctor_record_detail/' . $row->uralensis_request_id; ?>" class="btn btn-info btn-sm"><i class="lnr lnr-pencil"></i></a> -->
                                            </td>
                                        </tr>
										<!--###### Data Display END #########-->
                                    <?php } ?>

                                    <?php
                                    $flag_count++;



                                }//endforeach
                                ?>

                                </tbody>
                            </table>
                        	</div>
                        </div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="card form-group">

				<div class="card-body">
					<div class="pull-right">
						<!-- <div class="dropdown action-label">
							<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
								<i class="fa fa-dot-circle-o text-success"></i> Active
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
								<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
							</div>
						</div> -->
						<i class="fa fa-pencil edit_cv" data-toggle="modal" data-target="#edit_active_list" ></i>
					</div>

					<ul class="active_list">
						<li>
                            <div class="col-md-6 col-sm-6">
                                <div class="active_list_title">My CV
                                    <!-- <span class="pull-left" style="margin-right: 10px;">
	                                    <?php if($cv_appr_data['cv_doc_file_name'] !=""){ ?>
	                                        <span class="fa fa-check"></span>
	                                    <?php } ?>
	                                </span> -->
                                    <span class="pull-left" style="margin-right: 10px;">
                                        <span class="fa fa-check"></span>
                                    </span>
                                </div>
                                <div class="active_list_sub_title">

                                    <!--<button class="btn btn-sm btn-info"><span class="fa fa-file-text font-weight-bold"> View CV</span></button>-->

                                    <div class="row">
                                        <div class="col-md-8 col-sm-8">
                                            <span>GMC No: <?php echo $cv_appr_data['gmc_no'] ?></span>
                                            <span>Status: Active</span>
                                        </div>

                                        <div class="col-md-4 col-sm-4 pull-right">
		                                <span class="pull-left" style="margin-right: 10px;">
		                                    <?php if($cv_appr_data['cv_doc_file_name'] !=""){ ?>
		                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#view_cv"><img data-toggle="tooltip" title="" src="<?php echo base_url('assets/icons/Status.png'); ?>" class="img-responsive" data-original-title="View" style="width: 55% !important;"> </a>
		                                    <?php } ?>
		                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="date"></div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="active_list_title">Appraisal
                                    <span class="pull-left"  style="margin-right: 10px;">
                                    <?php if($cv_appr_data['last_appraisal'] !=""){ ?>
                                        <span class="fa fa-check"></span>
                                    <?php } ?>
								<!--<span class="badge badge-info">4</span>-->
								</span>
                                </div>
                                <div class="row">
                                    <?php $padding = ($cv_appr_data['last_appraisal']!=""?'7px':'0px'); ?>
                                    <div class="col-md-6 col-sm-6 " style="padding: <?php echo $padding; ?> 0px 0px 16px; width: 50%">
                                        Last Date
                                        <div class="date"><?php echo ($cv_appr_data['last_appraisal'] !=""?date('M d, Y', strtotime($cv_appr_data['last_appraisal'])):''); ?></div>
                                    </div>

                                    <div class="col-md-6  col-sm-6 pull-right">
                                        Next Date
                                        <div class="date"><?php echo ($cv_appr_data['next_appraisal'] !=""?date('M d, Y', strtotime($cv_appr_data['next_appraisal'])):''); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
						</li>
						<li>
                            <div class="col-md-6 col-sm-6">
                                <div class="active_list_title">RCPath
                                    <span class="pull-left"  style="margin-right: 10px;">
                                <?php if($cv_appr_data['cpd_last'] !=""){ ?>
                                    <span class="fa fa-check"></span>
                                <?php } ?>
                                <!--<span class="badge badge-info">4</span>-->
                                    </span>
                                </div>

                                <div class="active_list_sub_title">
                                    <div class="row">
                                        <?php $padding = ($cv_appr_data['cpd_last']!=""?'7px':'0px'); ?>
                                        <div class="col-md-6 col-sm-6" style="padding: <?php echo $padding; ?> 0px 0px 16px; width: 50%">
                                            CPD Last Return
                                            <div class="date"><?php echo ($cv_appr_data['cpd_last'] !=""?date('M d, Y', strtotime($cv_appr_data['cpd_last'])):''); ?></div>
                                        </div>

                                        <div class="col-md-6 col-sm-6 pull-right">
                                            Next Return
                                            <div class="date"><?php echo ($cv_appr_data['cpd_next'] !=""?date('M d, Y', strtotime($cv_appr_data['cpd_next'])):''); ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="active_list_title">Revalidation
                                    <span class="pull-left" style="margin-right: 10px;">
                                    <?php if($cv_appr_data['revalidation'] !=""){ ?>
                                        <span class="fa fa-check"></span>
                                    <?php } ?>
                                    <!-- <span class="badge badge-info">4</span> -->
								</span>
                                </div>
                                <div class="active_list_sub_title">
                                </div>
                                <div class="date"><?php echo ($cv_appr_data['revalidation'] !=""?date('M d, Y', strtotime($cv_appr_data['revalidation'])):''); ?></div>
                            </div>
                            <div class="clearfix"></div>

						</li>


						<li style="border-bottom: 0px">
                            <div class="col-md-6 col-sm-6">
                                <?php if($cv_appr_data['trainee_name'] !=""){ ?>
                                    <div class="active_list_title">Trainee Name
                                        <span class="pull-left" style="margin-right: 10px;">
                                    <?php if($cv_appr_data['trainee_name'] !=""){ ?>
                                        <span class="fa fa-check"></span>
                                    <?php } ?>
                                    <!-- <span class="badge badge-info">4</span> -->
								</span>
                                    </div>
                                    <div class="active_list_sub_title">
                                    </div>
                                    <div class="date"><?php echo $cv_appr_data['trainee_name'];?></div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <?php if($cv_appr_data['trainee_period_start'] !=""){ ?>
                                    <div class="active_list_title">Training Period
                                        <span class="pull-left" style="margin-right: 10px;">
                                <?php if($cv_appr_data['trainee_period_start'] !=""){ ?>
                                    <span class="fa fa-check"></span>
                                <?php } ?>
                                <!--<span class="badge badge-info">4</span>-->
                                    </span>
                                    </div>

                                    <div class="active_list_sub_title">
                                        <div class="row">
                                            <?php $padding = ($cv_appr_data['trainee_period_start']!=""?'7px':'0px'); ?>
                                            <div class="col-md-6 col-sm-6" style="padding: <?php echo $padding; ?> 0px 0px 16px; width: 50%">
                                                Start
                                                <div class="date"><?php echo ($cv_appr_data['trainee_period_start'] !=""?date('M d, Y', strtotime($cv_appr_data['trainee_period_start'])):''); ?></div>
                                            </div>

                                            <div class="col-md-6 col-sm-6 pull-right" style="padding: 0px 0px 0px 16px;">
                                                End
                                                <div class="date"><?php echo ($cv_appr_data['trainee_period_end'] !=""?date('M d, Y', strtotime($cv_appr_data['trainee_period_end'])):''); ?></div>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        </li>

					</ul>
				</div>
			</div>
			<div class="card card-table flex-fill">
				<div class="card-header">
					<h3 class="card-title mb-0">Network Pathologists</h3>
				</div>
					<div class="card-body"  style="height: 300px; overflow-y: auto;">
						<div class="table-responsive">
							<table class="pathologists_table table custom-table mb-0">
								<thead>
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Hospital</th>
										<th>Status</th>
<!--										<th>Action</th>-->
									</tr>
								</thead>
								<tbody>
                                <?php if($active_pathologists){
                                    foreach ($active_pathologists as $row){
                                    ?>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="javascript:void(0)" class="avatar">
<!--                                                    --><?php //if(file_exists(base_url($row->profile_pic))){ ?>
                                                    <img alt="IMG" src="<?php echo base_url($row->profile_picture_path); ?>">
<!--                                                    --><?php //} ?>
                                                </a>
												<a href="javascript:void(0)"><?php echo $row->doctor_name; ?></a>
											</h2>
										</td>
										<td><?php echo $row->email; ?></td>
										<td><?php echo $row->hospital_name; ?></td>
										<td>
											<div class="dropdown action-label">
												<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
													<i class="fa fa-dot-circle-o text-success"></i> Active
												</a>
											</div>
										</td>
<!--										<td style="text-align:center">-->
<!--											<div class="dropdown dropdown-action">-->
<!--												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>-->
<!--												<div class="dropdown-menu dropdown-menu-right">-->
<!--													<a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-commenting m-r-5"></i> Chat</a>-->
<!--												</div>-->
<!--											</div>-->
<!--										</td>-->
									</tr>

                                <?php }
                                } ?>

								</tbody>
							</table>
						</div>
					</div>
				
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="card card-table flex-fill" style="min-height: 248px;">
				<div class="card-header">
					<h3 class="card-title mb-0">SOP's</h3>
				</div>
				<div class="card-body" style="height: 300px; overflow-y: auto;">
					<div class="table-responsive">
						<table class="table custom-table mb-0">
							<thead>
								<tr>
                                    <th>File</th>
                                    <th>Uploaded By</th>
                                    <th>Uploaded On</th>
                                    <th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
                            <?php if (!empty($upload_docs)) {
                                foreach ($upload_docs as $row) {
                                    if($row->file_type == "SOP Form"){
                                        ?>
                                        <tr>
                                            <td><?php echo $row->file_name; ?></td>
                                            <td><?php echo $row->last_name." ".$row->first_name; ?></td>
                                            <td><?php echo date('d/m/Y H:i:s', strtotime($row->uploaded_at)); ?></td>
                                            <td class="text-right">
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?php echo base_url($row->file_path);?>')"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo base_url('Institute/download_forms/'.$row->file_name); ?>" ><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } ?>
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
		<div class="col-md-6">
			<div class="card card-table flex-fill"  style="min-height: 248px;">
				<div class="card-header">
					<h3 class="card-title mb-0">Request Form</h3>
				</div>
				<div class="card-body" style="height: 330px; overflow-y: auto;">
						<div class="table-responsive">
                            <table class="table custom-table request_form_table mb-0" id="request_form_table">
                                <thead>
                                <tr>
                                    <th>File</th>
                                    <th>Case Record</th>
                                    <th>Uploaded By</th>
                                    <th>Uploaded On</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($doc_case_files)) {
                                    foreach ($doc_case_files as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row->title; ?></td>
                                                <td><a href="<?php echo base_url('doctor/doctor_record_detail_old').'/'.$row->record_id; ?>" target="_blank"><?php echo $row->record_id; ?></a></td>
                                                <td><?php echo $row->uploaded_by; ?></td>
                                                <td><?php echo $row->upload_date; ?></td>
                                                <td class="text-right">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#view_doc" onclick="embed_document('<?php echo base_url($row->file_path);?>')"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php echo base_url('Institute/download_forms/'.$row->file_name); ?>" ><i class="fa fa-download"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                    }
                                } ?>
                                </tbody>
                            </table>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3 d-flex nopadding-right padding-right-sm">
			<div class="card flex-fill dash-statistics">
				<div class="card-body" style="min-height: 420px;">
					<h5 class="card-title">Activity</h5>
					<div class="stats-list">
						<div class="stats-info">
							<p>Leaves <strong>4 <small>/ 65</small></strong></p>
							<div class="progress">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="stats-info">
							<p>Projects <strong>15 <small>/ 92</small></strong></p>
							<div class="progress">
								<div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="stats-info">
							<p>Support <strong>85 <small>/ 112</small></strong></p>
							<div class="progress">
								<div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<!-- <div class="stats-info">
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
						</div> -->
					</div>
				</div>
			</div>
		</div>
        <?php if (!empty($task_stats)): ?>
            <?php $this->load->view('tasks/widgets/task_stats', ['task_stats' => $task_stats]); ?>
        <?php endif; ?>
<!--		<div class="col-md-4 d-flex">-->
<!--			<div class="card card-table flex-fill">-->
<!--				<div class="card-header">-->
<!--					<h3 class="card-title mb-0">Login</h3>-->
<!--				</div>-->
<!--				<div class="table-responsive">-->
<!--					<table class="table custom-table mb-0">-->
<!--						<thead>-->
<!--							<tr>-->
<!--								<th>Login Time</th>-->
<!--								<th>LogOff Time</th>-->
<!--								<th>User</th>-->
<!--							</tr>-->
<!--						</thead>-->
<!--						<tbody>-->
<!--							<tr>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-in"  style="color:green"></span> <span>22-06-2020 09:00:30 GMT</span>-->
<!--								</td>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-out" style="color:red"></span> <span>22-06-2020 09:00:30 GMT </span>								</td>-->
<!--								<td>--><?php //echo $user_id; ?><!--</td>-->
<!--							</tr>-->
<!--							<tr>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-in"  style="color:green"></span> <span>22-06-2020 09:00:30 GMT</span>-->
<!--								</td>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-out" style="color:red"></span> <span>22-06-2020 09:00:30 GMT </span>								</td>-->
<!--								<td>--><?php //echo $user_id; ?><!--</td>-->
<!--							</tr>-->
<!--							<tr>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-in"  style="color:green"></span> <span>22-06-2020 09:00:30 GMT</span>-->
<!--								</td>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-out" style="color:red"></span> <span>22-06-2020 09:00:30 GMT </span>								</td>-->
<!--								<td>--><?php //echo $user_id; ?><!--</td>-->
<!--							</tr>-->
<!--							<tr>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-in"  style="color:green"></span> <span>22-06-2020 09:00:30 GMT</span>-->
<!--								</td>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-out" style="color:red"></span> <span>22-06-2020 09:00:30 GMT </span>								</td>-->
<!--								<td>--><?php //echo $user_id; ?><!--</td>-->
<!--							</tr>-->
<!--							<tr>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-in"  style="color:green"></span> <span>22-06-2020 09:00:30 GMT</span>-->
<!--								</td>-->
<!--								<td>-->
<!--									<span class="fa fa-sign-out" style="color:red"></span> <span>22-06-2020 09:00:30 GMT </span>								</td>-->
<!--								<td>--><?php //echo $user_id; ?><!--</td>-->
<!--							</tr>-->
<!--						</tbody>-->
<!--					</table>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
	
        <div class="col-md-5 d-flex nopadding-left padding-left-sm">
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0">Logins</h3>
                </div>
                <div class="card-body" style="height: 330px; overflow-y: auto;">
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
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
                                <tr>
                                    <?php
                                    $user_detail = base64_encode($uDetail->session_userid."___".$uDetail->client_ip);
                                    ?>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="#" class="avatar dashboard_admin">
                                                <img alt="" class="profile-pic"
                                                     src="<?php echo get_profile_picture($uDetail->profile_picture_path, $uDetail->first_name, $uDetail->last_name); ?>"></a>
                                            <a href="<?php echo base_url()."/doctor/";?>getLoginDetail/<?php echo $user_detail;?>"><?php echo  $uDetail->first_name." ".$uDetail->last_name; ?> <span><?php echo  $this->ion_auth->get_users_groups($uDetail->session_userid )->row()->description; ?></span></a>                                    </h2>
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
                    <a href="<?php echo site_url('doctor/allLoginUsers'); ?>">View all Logins</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="edit_active_list" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CV, Appraisal  & Revalidation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart(uri_string(), array('id'=>'edit_cv_appraisal','name' => 'edit_cv_appraisal')); ?>
            <input type="hidden" name="edit_cv_appraisal" value="1">
            <div class="modal-body" style="overflow-y: inherit;">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="focus-label">GMC No.</label>
                        <input class="form-control" name="gmc_no" type="text" value="<?php echo $cv_appr_data['gmc_no']; ?>">
                    </div>
                    <div class="col-md-6 form-group">
                    	<div class="form-focus">
                            <label for="upload_snomed_csv">Upload CV</label>
                            <input class="form-control" type="file" name="upload_cv" id="upload_cv" style="padding: 12px 12px 6px !important;">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6 form-group">
                        <label class="focus-label">Appraisal Last and Next Date</label>
                        <div class="form-group">
							<div class="cal-icon">
								<input data-bind="daterangepicker: dateRange" class="form-control date_range" name="last_appraisal" type="text" value="<?php echo date('Y/m/d', strtotime($cv_appr_data['last_appraisal']))." - ".date('Y/m/d', strtotime($cv_appr_data['next_appraisal'])); ?>">
							</div>
						</div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="focus-label">RCPath CPD Last and Next Return Date</label>
                    	<div class="form-group">
							<div class="cal-icon">
								<input class="form-control date_range" name="date_range" type="text" value="<?php echo date('Y/m/d', strtotime($cv_appr_data['cpd_last']))." - ".date('Y/m/d', strtotime($cv_appr_data['cpd_next'])); ?>">
							</div>
						</div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="focus-label">Revalidation Date</label>
                        <div class="form-group form-focus">
							<div class="cal-icon">
								<input class="form-control floating datetimepicker" name="revalidation" type="text" value="<?php echo $cv_appr_data['revalidation']; ?>">
							</div>
						</div>
                    </div>

                    <div class="col-md-12">
                        <!-- <label class="focus-label">Education Supervisor</label> -->
                        <div class="form-focus">
                            <input class="form-control" id="is_supervisor" name="is_education_supervisor" style="width: 20px; margin-top: -4px; height: 20px !important;" type="checkbox" value="1" onclick="toggle_supervisor()" <?php echo ($cv_appr_data['trainee_name']!=''?'checked':'') ?>> &nbsp; Education Supervisor</span> 
                        </div>
                    </div>
                    <?php $display = ($cv_appr_data['trainee_name']!=''?'block':'none'); ?>
                    <div id="trainee_fields" style="display:<?php echo $display; ?>;">
                        <div class="col-md-6 form-group">
                            <label class="focus-label">Trainee Name</label>
                            <div class="form-group form-focus">
                                <input class="form-control floating" name="trainee_name" type="text" value="<?php echo $cv_appr_data['trainee_name']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 form-group" style=" padding-bottom: 250px !important;">
                            <label class="focus-label">Period</label>
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating date_range" name="train_period" type="text" value="<?php echo ($cv_appr_data['trainee_period_start']!=''?date('Y/m/d', strtotime($cv_appr_data['trainee_period_start']))." - ".date('Y/m/d', strtotime($cv_appr_data['trainee_period_end'])):''); ?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info btn-lg btn-rounded btn-save">Update</button>
            </div>
        </div>
    </div>
</div>


<div id="view_cv" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart(uri_string(), array('id'=>'edit_cv_appraisal','name' => 'edit_cv_appraisal')); ?>
            <input type="hidden" name="edit_cv_appraisal" value="1">
            <div class="modal-body">
                <?php $file_path = $cv_appr_data['cv_doc_file_name']; ?>
                <embed src = "<?php echo base_url($file_path); ?>"
                       name ="markid1" type='application/pdf' frameborder="0"
                       width="100%" height="400px">
            </div>
            <div class="modal-footer">
            </div>
            <?php echo form_close(); ?>
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

<script>
    function toggle_supervisor() {
        // Get the checkbox
        var checkBox = document.getElementById("is_supervisor");
        // Get the output text
        var trainee_fields = document.getElementById("trainee_fields");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
            trainee_fields.style.display = "block";
        } else {
            trainee_fields.style.display = "none";
        }
    }
    function embed_document(file_name){
        var embed_div = document.getElementById('doc_embed');
        embed_div.innerHTML="";
        embed_div.innerHTML = "<embed src='"+file_name+"' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='400px'>";

    }

</script>