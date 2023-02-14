<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Header -->


<style type="text/css">
	.checked_chk ul{
		border:1px solid #dddddd;
	}
	.checked_chk ul li{
		border-bottom:1px solid #dddddd;
		padding: 3px 10px 0;
	}
	.checked_chk ul li:last-child{
		border-bottom:0px;
	}
	.checked_chk ul li label{
		margin-bottom: 0px;
	}
	.custom-table-search tr td{
		text-transform: capitalize;
	}
	.cinput input{
		width: 20px;
		height: 20px;
	}

	.qucikSearch{
	    list-style: none;
	    padding: 0;
	    margin: 0;
		overflow: hidden;
		width: 100%;
	}
	.qucikSearch li{
		padding:0 1px 5px;
		float: left;
		width: 33%;
	}
	.specimen_list li{position: relative;}
	.specimen_list li:not(:last-child){margin-right: 2px;}
	.specimen_list li a {
	    border: 1px solid #ccc;
	    color: #000;
	    display: inline-block;
	    width: 40px;
	    height: 40px;
	    text-align: center;
	    line-height: 2.2;
	    border-radius: 20px;
	}
	.specimen_list li.last-child a{
		/*border:0;*/
		/*background: transparent;*/
	}
	.specimen_list_inners {
	    display: none;
	    position: absolute;
	    min-width: 140px;
	    right: 0;
	    padding-top: 5px;
	    /*width: 100%;*/
	}

	.specimen_list li.last-child a{
		padding: 0 5px;
		box-sizing: border-box;
	}
	.specimen_list li.last-child a img{width: 100%; height: auto}
	.specimen_list li.last-child a.white{
		display: none;
	}
	.specimen_list li:hover .specimen_list_inners{display: block;}
	.specimen_list li.last-child:hover a.white{
		display: block;
	}
	.specimen_list li.last-child:hover a.blk{
		display: none;
	}
	.specimen_list li img{
		width: 39px;
		height: 38px;
	}
	.specimen_list li a:hover, .specimen_list li a:focus, .specimen_list li a.active{
		background-color: #009efb;
    	border: 1px solid #009efb;
    	color: #fff;
	}
	/*.specimen_list li.last-child a:hover,.specimen_list li.last-child a:focus,*/
	/*.specimen_list li.last-child a.active{background-color: unset; border:unset;}*/
	.qucikSearch li a{font-size: 14px; padding: 4px;}

	.qucikSearch li label{margin-bottom: 0px;}
	@media screen and (min-width: 1500px) {
		.qucikSearch li{width: 33%;}
		.qucikSearch li a{font-size: 16px;}
	}
	@media screen and (min-width: 1800px) {
		.qucikSearch li{width: calc(100%/5);padding: 2px;}
	}
	@media print{
		body, .page-wrapper{background:#fff!important; margin: 0 !important}
		.header, .sidebar,.card,.page-header,.print_button{display: none;}
		.card.print_section{border:0px; box-shadow: unset; display: block; width: 100%;}
		.card-header{border-bottom: 0px;}
		#print_section{display: block; width: 100%;}
	}

    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }

    .panel-default {
        border-color: #ddd;
    }

    .panel-default>.panel-heading {
        color: #333;
        background-color: #f5f5f5;
        border-color: #ddd;
        font-size: 12pt;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .panel-title {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 16px;
        color: inherit;
    }

    link, .nav-tabs .nav-link {
        color: #ffffff;
        background-color: #028ee1;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    link, .nav-tabs .nav-link.active {
        color: #ffffff;
        background-color: #55ce63;
        /*border-color: #dee2e6 #dee2e6 #fff;*/
        /*border: 1px solid #028ee1*/
    }

    .custom-control {
        position: relative;
        display: block;
        min-height: 1.5rem;
        padding-left: 2.5rem;
    }

</style>
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">Requestor</h3>
			<ul class="breadcrumb">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Requestor</li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-xl-7">
		<div class="card">
			<div class="card-body">
				<div class="col-lg-12 form-group">
					<div class="row">
						<div class="col-lg-2 form-group nopadding">
							<label for="" style="margin-top: 10px;">Intials: <span>MRP</span></label>
						</div>
						<div class="col-lg-5 form-group">
							<input type="text" name="" class="form-control" placeholder="Lab No.">
						</div>
						<div class="col-lg-5 form-group">
							<ul class="list-inline text-right specimen_list">
							    <li id="speci-list" class="list-inline-item s_list" data-text="Specimen 1">
							    	<a href="javascript:;" class="">S1</a>
							    	<ul class="list-inline specimen_list_inners">
                                        <li class="list-inline-item" data-text="Specimen 1">
                                            <a href="javascript:;" class="" data-specimen-id="1" data-specimen-text="S1" >S1</a>
                                        </li>
                                        <li class="list-inline-item" data-text="Specimen 2">
									    	<a href="javascript:;" class="" data-specimen-id="2" data-specimen-text="S2">S2</a>
									    </li>
									    <li class="list-inline-item" data-text="Specimen 3">
									    	<a href="javascript:;" class="" data-specimen-id="3" data-specimen-text="S3">S3</a>
									    </li>
									    <li class="list-inline-item" data-text="Specimen 4">
									    	<a href="javascript:;" class="" data-specimen-id="4" data-specimen-text="S4">S4</a>
									    </li>
							    	</ul>
							    </li>
							    <li id="block-list" class="list-inline-item b_list">
							    	<a href="javascript:;" class="">B1</a>
							    	<ul class="list-inline specimen_list_inners">
                                        <li class="list-inline-item">
                                            <a href="javascript:;" class="" data-block-id="1" data-block-text="B1">B1</a>
                                        </li>
							    		<li class="list-inline-item">
									    	<a href="javascript:;" class="" data-block-id="2" data-block-text="B2">B2</a>
									    </li>
									    <li class="list-inline-item">
									    	<a href="javascript:;" class="" data-block-id="3" data-block-text="B3">B3</a>
									    </li>
									    <li class="list-inline-item">
									    	<a href="javascript:;" class="" data-block-id="4" data-block-text="B4">B4</a>
									    </li>
							    	</ul>
							    </li>
							    <li class="list-inline-item last-child">
							    	<a href="javascript:;" class="blk" ><img src="<?php echo base_url();?>assets/icons/Urgent-wb.png" style="max-width: 40px;"></a>
							    	<a href="javascript:;" class="white" data-toggle="modal" data-target="#myModal"><img src="<?php echo base_url();?>assets/icons/Urgent-wb-white.png" style="max-width: 40px;"></a>
							    </li>
							</ul>
						</div>
						<div class="clearfix"></div>
						
					</div>
					<br>
				</div>
				<div class="clearfix"></div>
				<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                    <?php if(isset($complete_records) && is_array($complete_records))
					{
                        foreach ($complete_records as $key => $complete_record){ ?>
                            <li class="nav-item"><a class="nav-link <?php echo ($key == 0)? 'active' : ''; ?> mr-1 mb-1" href="#<?php echo 'tab-'.$key; ?>" data-toggle="tab" data-parent-id="<?php echo $complete_record['id']; ?>" data-level="<?php echo $complete_record['level']; ?>"><?php echo $complete_record['text']; ?></a></li>
                    <?php
                        }
                    } ?>
				</ul>
				<div class="tab-content">
                    <?php if(is_array($complete_records) && !empty($complete_records)){ ?>
                        <?php foreach($complete_records as $first_level_key => $first_level_records){ ?>
                            <div class="tab-pane show <?php echo ($first_level_key == 0)? 'active' : ''; ?>" id="<?php echo 'tab-'.$first_level_key; ?>">
                                <?php if(is_null($first_level_records['has_level'])){ ?>
                                    <div class="row m-0">
                                        <?php if(is_array($first_level_records['tests']) && !empty($first_level_records['tests'])){ ?>
                                            <div class="form-group">
                                                <ul class="qucikSearch">
                                                    <?php if(is_array($first_level_records['tests']) && !empty($first_level_records['tests'])){ ?>
                                                        <?php foreach ($first_level_records['tests'] as $first_level_test){ ?>
                                                            <li><a href="javascript:;" class="btn btn-info btn-block test-record" data-test-id="<?php echo $first_level_test['id'] ?>" data-cost="<?php echo $first_level_test['cost']; ?>" data-sale="<?php echo $first_level_test['sale']; ?>"  data-test-name="<?php echo $first_level_test['name']; ?>"><?php echo $first_level_test['name'] ?></a></li>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <p>No Test Found</p>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php }elseif ($first_level_records['has_level'] == 1 || $first_level_records['has_level'] == 2 ) { ?>
                                    <div class="col-md-12">
                                        <?php if(is_array($first_level_records['nodes']) && !empty($first_level_records['nodes'])){ ?>
                                            <?php foreach($first_level_records['nodes'] as $second_level_key => $second_level_record){ ?>
                                                    <div class="col-md-12">
                                                        <h3><?php //echo $second_level_record['text'] ?></h3>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <ul class="qucikSearch">
                             <?php if(is_array($second_level_record['tests']) && !empty($second_level_record['tests'])){ ?>
                                               <?php foreach ($second_level_record['tests'] as $second_level_test){ ?>
              <li><a href="javascript:;" class="btn btn-info btn-block test-record" data-test-id="<?php echo $second_level_test['id'] ?>" data-cost="<?php echo $second_level_test['cost']; ?>" data-sale="<?php echo $second_level_test['sale']; ?>" data-test-name="<?php echo $second_level_test['name']; ?>"><?php echo $second_level_test['name'] ?></a></li>
                                                                <?php } ?>
                                                            <?php } else { ?>
                                                                <p>No Test Found</p>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } elseif ($first_level_records['has_level'] == 8){ ?>
                                    <div class="form-group">
                                        <?php if(is_array($first_level_records['nodes']) && !empty($first_level_records['nodes'])){ ?>
                                            <?php foreach($first_level_records['nodes'] as $second_level_key => $second_level_record){ ?>
                                                <div class="row m-0">
                                                    <div class="col-md-12">
                                                        <h3><?php echo $second_level_record['text'] ?></h3>
                                                    </div>
                                                    <?php if(is_array($second_level_record['nodes']) && !empty($second_level_record['nodes'])){ ?>
                                                        <?php foreach ($second_level_record['nodes'] as $third_level_key => $third_level_record){ ?>
                                                            <div class="col-md-3 mb-3">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h3 class="panel-title"><?php echo $third_level_record['text']; ?> <input type="checkbox" class="check-all-childrens"></h3>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        <?php if(is_array($third_level_record['tests']) && !empty($third_level_record['tests'])){ ?>
                                                                            <?php foreach ($third_level_record['tests'] as $third_level_test){ ?>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input class="test-record" type="checkbox" data-test-id="<?php echo $third_level_test['id'] ?>" value="<?php echo $third_level_test['id']; ?>" data-cost="<?php echo $third_level_test['cost']; ?>" data-sale="<?php echo $third_level_test['sale']; ?>" data-test-name="<?php echo $third_level_test['name']; ?>"> <?php echo $third_level_test['name']; ?>
                                                                                    </label>
                                                                                </div>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>

                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
				</div>
                <div class="form-group mt-5">
                    <h4>Levels</h4>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Number of Levels</label>
                            <input type="number" name="" class="form-control">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Last Previous Level</label>
                            <input type="number" name="" class="form-control">
                        </div>
                        <div class="col-sm-12 form-group">
                            <ul class="list-inline cinput">
                                <li class="list-inline-item">
                                    <input id="Shallow" type="radio" name="levels" value="Shallow">
                                    <label for="Shallow">Shallow</label>
                                </li>
                                <li class="list-inline-item">
                                    <input id="Normal" type="radio" name="levels" value="Normal">
                                    <label for="Normal">Normal</label>
                                </li>
                                <li class="list-inline-item">
                                    <input id="Deep" type="radio" name="levels" value="Deep">
                                    <label for="Deep">Deep</label>
                                </li>
                                <li class="list-inline-item">
                                    <input id="Serial_HB" type="radio" name="levels" value="Serial (HB)">
                                    <label for="Serial_HB">Serial (HB)</label>
                                </li>
                                <li class="list-inline-item">
                                    <input id="Deeper_Section" type="radio" name="levels" value="Deeper Section">
                                    <label for="Deeper_Section">Deeper Section</label>
                                </li>
                            </ul>
                            <hr>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

				<div class="row">
					<div class="col-lg-12 form-group">
						<label>Reason for Request</label>
						<input type="text" class="form-control"  id="myInput" value="">
					</div>
					<div class="col-lg-12 form-group">
						<label>Comments</label>
						<input type="text" class="form-control" id="myInput2" value="">
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-xl-5">
		<div id="editor"></div>
		<div class="card print_section" style="width: 100%">
			<div id="print_section" style="overflow: hidden; width: 100%">
				<div class="card-header">
					<div class="card-title mb-0">
						<div class="row">
							<div class="col-sm-12">
								Request List
								<span class="pull-right" style="float: right;">
									<strong>Date:</strong> 08-22-2020
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								Requestor Name : Tim Kilman
								<span class="pull-right"  style="float: right;">
									<strong>Time:</strong> 06:40 PM
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive form-group">
						<table class="table table-stripped custom-table custom-table-search" style="width: 100%;">
							<thead>
								<tr>
									<th>Lab No.</th>
									<th>Patient Intials</th>
									<th>Test</th>
									<th>Specimen</th>
									<th>Block</th>
									<th class="text-right">Cost</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-lg-12 form-group">
							<label>Reason for Request</label>
							<p id="divID"></p>
						</div>

						<div class="col-lg-12 form-group">
							<label>Comments</label>
							<p id="divID2"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<div class="row">
					<div class="col-lg-12 form-group">
						<button class="btn btn-primary print_button" onclick="print()"> <i class="fa fa-print"></i> Print </button>
						<button class="btn btn-primary print_button" onclick="generatePDF2()"><i class="fa fa-file-pdf-o"></i> Save as PDF</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12" style="display: none;">
		<div id="editor2"></div>
		<div class="row" id="print_section_new">
			<div class="col-sm-6">
				<div class="card print_section2">
					<div class="card-header">
						<div class="card-title mb-0 text-right">*18S29657*</div>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<label>Lab No.</label>
										<p>18S29657</p>
									</td>
									<td>
										<label>Blocks</label>
										<p>1</p>
									</td>
									<td>
										<label>Patient Name</label>
										<p>Taqi Raza</p>
									</td>
								</tr>
								<tr>
									<td>
										<label for="">Requesting Path</label>
										<p>IHC	</p>
									</td>
									<td colspan="2">
										<label for="">Date & Time</label>
										<p>11/10/2020 11:17	</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label>Levels</label>
										<p>Level 1</p>
									</td>
								</tr>
								<tr>
									<td>
										<p>18S29657</p>
									</td>
									<td>
										<p>1</p>
									</td>
									<td>
										<p>Taqi Raza</p>
									</td>
								</tr>
								<tr>
									<td>
										<p>IHC	</p>
									</td>
									<td colspan="2">
										<p>11/10/2020 11:17	</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label><strong>Specials</strong></label>
										<ul class="list-unstyled">
											<li>Von Kosa</li>
											<li>Retic</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label><strong>Other Requests</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Free Text) </label>
										<p></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card print_section2">
					<div class="card-header">
						<div class="card-title mb-0 text-right">*18S29657*</div>
					</div>
					<div class="card-body" style="min-height: 706px">
						
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<label>Lab No.</label>
										<p>18S29657</p>
									</td>
									<td>
										<label>Blocks</label>
										<p>1</p>
									</td>
									<td>
										<label>Patient Name</label>
										<p>Taqi Raza</p>
									</td>
								</tr>
								<tr>
									<td>
										<label for="">Requesting Path</label>
										<p>Pandey	</p>
									</td>
									<td colspan="2">
										<label for="">Date & Time</label>
										<p>11/10/2020 11:17	</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label><strong>Immuno</strong></label>
										<ul class="list-unstyled">
											<li>S-100 - Brown</li>
											<li>Melan A - Brown</li>
											<li>Desmin</li>
											<li>CD 34</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Auto Repeat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label class="col-form-label">Specimen:</label>
                            <select id="modal-select-spcimen" name="spcimen[]" class="select2 form-control">
                                <option value="">Select Specimen</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label class="col-form-label">Block:</label>
                            <select id="modal-select-block" name="block[]" class="select2 form-control">
                                <option value="">Select Block</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="auto-repeat" class="btn btn-info btn-rounded btn-lg" type="submit">Submit</button>
                <button type="button" class="btn btn-rounded btn-lg btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>