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

    .disable_anchor {
        pointer-events: none;
        cursor: default;
        background-color: gray;
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
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Further Work</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Further Work</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
<?php
//print_r($recordDetails[0]);
?>
<div class="col-lg-6 col-xl-7">
<form id="saveFurtherRequest" method="post">
<input type="hidden" id="request_id" name="request_id" value="<?php echo $recordDetails[0]["uralensis_request_id"]; ?>" />
<input type="hidden" id="num_of_levels" name="num_of_levels" value="1" />
<input type="hidden" id="num_of_levels" name="last_pre_levels" value="1" />
<input type="hidden" id="num_of_levels" name="levels" value="1" />
<input type="hidden" id="num_of_levels" name="levels" value="1" />
<input type="hidden" id="group_id" name="group_id" value="<?php echo $recordDetails[0]["hospital_group_id"]; ?>" />
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 form-group">
                    <div class="row">
                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Patient:</label>
                        </div>
                        <div class="col-lg-4 form-group">
                            <input type="text" name="animal_name" id="animal_name" value="<?php echo $recordDetails[0]["f_name"]; ?> <?php echo $recordDetails[0]["sur_name"]; ?>" readonly="readonly" class="form-control" placeholder="Lab No.">
                        </div>

                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">DOB:</label>
                        </div>
                        <div class="col-lg-4 form-group">
                            <input type="text" name="lab_no" id="animal_id" value="<?php echo $recordDetails[0]["dob"]; ?>" readonly="readonly" class="form-control" placeholder="DOB">
                        </div>
                        
                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Lab ID:</label>
                        </div>
                        <div class="col-lg-4 form-group">
                            <input type="text" name="lab_no" id="lab_no" value="<?php echo $recordDetails[0]["lab_number"]; ?>" readonly="readonly" class="form-control" placeholder="Lab No.">
                        </div>

                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Lab:</label>
                        </div>
                        <div class="col-lg-4 form-group">
                            <select class="form-control select2" id="myInput3">
                                <?php foreach ($labName as $labKey => $labValue) { ?> 
                                    <option value="<?php echo $labValue["id"]; ?>" <?php echo ($labValue["id"] == $recordDetails[0]["lab_id"] ? 'selected=selected' : '');?> ><?php echo $labValue["name"]; ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="col-lg-2 form-group nopadding hide">
                            <label for="" style="margin-top: 10px;">Specimen:</label>
                        </div>
                        <div class="col-lg-4 form-group hide">
                            <select class="form-control select2 " id="myInput4" name="specimen_id" onchange="javascript:document.getElementById('blockcount').value=1;">
                                <?php 
                               
                                    $c =0;
                                    foreach ($specimen_query as $sKey => $sValue) 
									{
                                       
									   
									   $alphabet = range(1, 10);

//echo $alphabet[3]; // returns D


									   ?> 
                                    <option value="<?php echo $sValue->specimen_id; ?>"><?php echo $alphabet[$c]; ?></option>
                                <?php $c++; } ?>

                            </select>
                            <input type="hidden" name="blockcount" id="blockcount" value="1" />
                        </div>

                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Digi No:</label>
                        </div>
                        <div class="col-lg-4 form-group" >
                            <input type="text" name="pci_number" id="pci_number" value="<?php echo $recordDetails[0]["pci_number"]; ?>" readonly="readonly" class="form-control" placeholder="Digi No">
                        </div>


                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Block:</label>
                        </div>
                        <div class="col-lg-4 form-group" >
                            <select class="form-control select2 speciment_block_select2" name="block_no[]" id="blockSelections" multiple>
                                <?php if(count($block_no_list) > 0){ foreach ($block_no_list as $key => $row) { ?>
                                    <option value="<?= $row->block_no; ?>" data-speciment="<?php echo $row->specimen_id; ?>" <?php echo ($key == 0) ? "selected" : ""; ?>><?= $row->block_no; ?></option>
                                <?php } } else{ ?>
                                    <option value="1A">1A</option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        
                        
                        
                        
                        

<!--                        <div class="col-lg-5 form-group">
                            <ul class="list-inline text-right specimen_list">
                                <li class="list-inline-item s_list" data-text="Specimen 1">
                                    <a href="javascript:;" class="">S1</a>
                                    <ul class="list-inline specimen_list_inners">
                                        <li class="list-inline-item" data-text="Specimen 2">
                                            <a href="javascript:;" class="active">S2</a>
                                        </li>
                                        <li class="list-inline-item" data-text="Specimen 3">
                                            <a href="javascript:;" class="">S3</a>
                                        </li>
                                        <li class="list-inline-item" data-text="Specimen 4">
                                            <a href="javascript:;" class="">S4</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="list-inline-item b_list">
                                    <a href="javascript:;" class="">B1</a>
                                    <ul class="list-inline specimen_list_inners">
                                        <li class="list-inline-item">
                                            <a href="javascript:;" class="">B2</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:;" class="">B3</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:;" class="">B4</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="list-inline-item last-child">
                                    <a href="javascript:;" class="blk"><img src="<?php echo base_url(); ?>assets/icons/Urgent-wb.png" style="max-width: 40px;"></a>
                                    <a href="javascript:;" class="white"><img src="<?php echo base_url(); ?>assets/icons/Urgent-wb-white.png" style="max-width: 40px;"></a>
                                </li>
                            </ul>
                        </div>-->
                        <div class="clearfix"></div>

                    </div>
                    <br>
                </div>
                <div class="clearfix"></div>
                <div id="setFurtherWorkTabData">
                    <?php if(isset($test_sub_categories)) { ?>
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <?php
                        $cnt = 0;
                        foreach ($test_sub_categories["main_cat"] as $mainKey => $mainValue) {
                            $cnt++;
                            ?>
                            <li class="nav-item"><a class="nav-link <?php echo ($cnt == 1 ? 'active' : ''); ?>" href="#solid-rounded-tab<?php echo $mainValue["main_cat_id"]; ?>" data-toggle="tab"><?php echo $mainValue["main_cat_name"]; ?></a></li>
                        <?php } ?>

                        <li class="nav-item" style="margin-left: auto;">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" id="quickBox">
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <?php
                        $t = 0;
                        foreach ($test_sub_categories["main_cat"] as $catKey => $catValue){
                            ?>
                            <div class="tab-pane <?php echo ($t == 1 ? 'show active' : ''); ?>" id="solid-rounded-tab<?php echo $catValue['main_cat_id']; ?>">
                                <?php foreach ($catValue["sub_cat"] as $subKey => $suBValue) { $t++; ?>
                                <div class="form-group">
                                    <h4 style="display:none;"><?php echo $suBValue["sub_cat_name"]; ?>:</h4>
                                    <ul class="qucikSearch">
                                        <?php if(isset($suBValue["tests"]) && count($suBValue["tests"]) > 0){
                                            foreach ($suBValue["tests"] as $subTestKey => $subTestValue)
                                            { 
                                                $speciment_blocks = '';
                                                $single_class = '';
                                                foreach($specimen_blocks_with_tests as $stkey => $bockTest){
                                                    if($subTestValue["test_id"] == $bockTest['test_id'] && $subTestValue['test_desction'] == $bockTest['test_name']){
                                                        $speciment_blocks =  $bockTest['blocks'];
                                                        $temp = explode("_",$speciment_blocks);
                                                        foreach($temp as $tr => $exploded_test){
                                                            $single_class .= " stests".$temp[$tr]." ";
                                                        }
                                                        $single_class = trim($single_class);
                                                    }
                                                }
                                                ?>
                                            <li class="commomstest stests<?php echo $speciment_blocks. " ".$single_class; ?>">
                                                <a href="javascript:;" title="<?php echo $subTestValue['test_name'] .' : '. $subTestValue["test_desction"]; ?>" data-id="<?php echo $subTestValue["test_id"]; ?>" class="btn btn-info btn-block">
                                                    <?php echo (strlen($subTestValue["test_desction"]) > 20) ? (substr($subTestValue["test_desction"], 0, 20)).'...' : $subTestValue["test_desction"]; ?>
                                                </a>
                                            </li>
                                        <?php } } ?>
                                        <div style="clear:both;"></div>
                                    </ul>
                                </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-12 form-group">
                        <label>Reason for Request</label>
                        <div class="clearfix"></div>
                        <!-- <input type="text" class="form-control select2"  id="myInput" value=""> -->
                        <select class="form-control select2" id="reasonForRequest" name="request_reason">
                            <option value="Routine Diagnostic">Routine Diagnostic</option>
                            <option value="EQA">EQA</option>
                            <option value="Exam">Exam</option>
                            <option value="QC">QC</option>
                            <option value="Teaching">Teaching</option>
                            <option value="Clinical Trial">Clinical Trial</option>
                            
                        </select>
                    </div>
                    <div class="col-lg-12 form-group">
                        <label>Comments</label>
                        <input type="text" class="form-control" id="myInput2" name="request_comment" value="">
                        <div id="test_date"></div>
                    </div>
                </div>

            </div>
        </div>
         </form>
    </div>
    
   
    
    <div class="col-lg-6 col-xl-5">
        <div id="editor"></div>
        <div class="card print_section" style="width: 100%">
            <div id="print_section" style="overflow: hidden; width: 100%">
                <div class="card-header" style="padding-left: .5rem; padding-right: .5rem;">
                    <div class="card-title mb-0">
                        <div class="row">
                            <div class="col-sm-12">
                                <p style="font-size: 17px;"><strong>Request List</strong>
                                <span class="pull-right" style="float: right;">
                                    <strong>Date:</strong> <?php echo date("Y-m-d"); ?>
                                </span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                            <p style="font-size: 17px;"><strong>Requestor Name :</strong> <?php echo $request_query[0]->first_name . " " . $request_query[0]->last_name; ?>
                                <span class="pull-right"  style="float: right;">
                                    <strong>Time:</strong> <?php echo date("H:i"); ?>
                                </span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive form-group">
                        <table class="table table-stripped custom-table custom-table-search" style="width: 100%;">
                            <thead class="thead-light" style="background-color: #fafafa;">
                                <tr>
                                    <th><b>Lab No.</b></th>                                    
                                    <th><b>Test</b></th>
                                    <th><b>Specimen</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 form-group" style="padding-left: 1.60rem">
                            <label>Reason for Request</label>
                            <p id="divID" ></p>
                        </div>

                        <div class="col-lg-12 form-group" style="padding-left: 1.60rem">
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
                        <button class="btn btn-primary print_button save-btn-furtherwork" id="further-request-new"  class="further-request-new"><i class="fa fa-file-pdf-o"></i> Save </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="width: 100%">
            <div style="overflow: hidden; width: 100%">
                <div class="card-header" style="padding-left: .5rem; padding-right: .5rem">
                    <div class="card-title mb-0">
                        <div class="row">
                            <div class="col-sm-12">
                            Current Block/Test ID
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive form-group">
                        <table class="table table-stripped custom-table" style="width: 100%;">
                            <thead class="thead-light">
                                <tr>
                                    <th><b>Lab No.<b></th>                                    
                                    <th><b>Block No</th>
                                    <th><b>Test<b></th>
                                    <th><b>Block Description<b></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($specimen_blocks as $sp_block) {
                                    
                                        ?>
                                        <tr>
                                            <td><?php echo $recordDetails[0]["lab_number"]; ?></td>
                                            <td><?php echo $sp_block->block_no; ?></td>
                                            <td><?php if($sp_block->name!='') { echo $sp_block->name; } else { print "H&E";} ?></td>
                                            <td><?php echo $sp_block->description; ?></td>
                                            <td class="remove_test_data" data-id="<?= $sp_block->id; ?>" data-url="<?= base_url() . 'doctor/delete_test_data/'.$primary_id.'/'.$sp_block->id; ?>"><i class="fa fa-trash" title="delete"></i></td>
                                        </tr>
                                        <?php
                                    }
                               
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<div class="modal custom-modal fade" id="delete_test_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Test</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn test-delete-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
   
    
    function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("print_section");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save('further_request');
      }
      function generatePDF2() {
      	
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("print_section_new");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save('further_request_nnh');
      }

      $( "#divID" ).text( $( "#reasonForRequest" ).val() );
    $( "#reasonForRequest" )   
	  .change(function() {
	    var value = $( this ).val();
	    $( "#divID" ).text( value );
	  })
	  .keyup();
	  $( "#myInput2" )
	  .keyup(function() {
	    var value = $( this ).val();
	    $( "#divID2" ).text( value );
	  })
	  .keyup();
  
   $('#myInput').select2({
			  multiple: true,
			  tags: "true"
			});
                        
   $('#myInputBlock').select2({
			  multiple: true,
			  tags: "true"
			});
    
      $('#specimen_selector').change(function(){
	        $('.colors').hide();
	        $('#' + $(this).val()).show();
	    });

	    $("#basic_screen_tests").hide();
		$("#bs_info").click(function() {
		    if($(this).is(":checked")) {
		        $("#basic_screen_tests").show(300);
		    } else {
		        $("#basic_screen_tests").hide(200);
		    }
		});
                
                
                $("#sidebar-menu").find("a").click(function(event) {
            var loc = $(this).attr('href');
            if (loc != '#') {
                window.location.href = loc;
            }
        });

        // $("#qucikSearch li").hide();
    
        $('.qucikSearch li').each(function(i) 
		{
		    $(this).attr('data-text', function() 
			{
		      return $(this).text().toLowerCase();
		    });
		  });
    
    
    
    var modal_select_spcimen = $('#modal-select-spcimen').select2({
        placeholder: 'Select Specimen',
        width: '100%'
    });
    var modal_select_block = $('#modal-select-block').select2({
        placeholder: 'Select Block',
        width: '100%'
    });

    $('.speciment_block_select2').select2({
        placeholder: 'Select Block',
        width: '100%'
    });


    //Toggle Checkboxes
    $('input.check-all-childrens').click(function () {
        // && is_block_selected()
        if (is_specimen_selected()) {
            let checkboxes = $(this).closest('div.panel-default').find('input.test-record');
            if (checkboxes.length > 0) {
                $.each(checkboxes, function (index, checkbox) {
                    $(checkbox).trigger('click');
                });
            }
        } else {
            $(this).prop("checked", false);
            alert('Please select Specimen and Block first!');
        }
    });


    $('li.speci-list > ul > li.list-inline-item').click(function () {
        if (selected_tests.length > 0) {
            reset_selected_tests();
            selected_tests = [];
        }
        $(this).closest('li.speci-list').find(".inner_specimen").addClass('active');
        $(this).siblings('li.list-inline-item ').children('a').removeClass('active');
        $(this).closest('li.speci-list').siblings('li.list-inline-item ').children('a').removeClass('active');
        $(this).children('a').addClass('active');
        $(this).children('a').html($(this).children('a').html()).addClass('active');
    });

    function is_specimen_selected() {
        let selected_specimen = $('li.speci-list > ul > li.list-inline-item a.active');
        if (selected_specimen.length > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_selected_specimen() {
        let selected_specimen = $('li.speci-list > ul > li.list-inline-item a.active');
        if (selected_specimen.length > 0) {
            return selected_specimen;
        } else {
            return null;
        }
    }
    
    $('li#block-list > ul > li.list-inline-item').click(function () {
        // if(selected_tests.length > 0){
        //     if(confirm('Did you want to Select all the selected tests for this Block too?')){
        //         $(get_all_selected_tests()).trigger('click');
        //         $(this).children('a').addClass('active');
        //         $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
        //     }else{
        //         reset_selected_tests();
        //         $(this).children('a').addClass('active');
        //         $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
        //     }
        //
        // }else{
        //     $(this).siblings('li.list-inline-item').children('a').removeClass('active');
        //     $(this).children('a').addClass('active');
        //     $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
        // }
        if (selected_tests.length > 0) {
            reset_selected_tests();
        }
        $(this).siblings('li.list-inline-item').children('a').removeClass('active');
        $(this).children('a').addClass('active');
        $('li#block-list').children('a').html($(this).children('a').html()).addClass('active');
    });

    function is_block_selected() {
        let selected_block = $('li#block-list > ul > li.list-inline-item a.active');
        if (selected_block.length > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_selected_block() {
        let selected_block = $('li#block-list > ul > li.list-inline-item a.active');
        if (selected_block.length > 0) {
            return selected_block;
        } else {
            return null;
        }
    }


    var selected_tests = [];
    $('input.test-record, a.test-record').on('click', function (e) {
        // e.preventDefault();
        // && is_block_selected()
        if (is_specimen_selected()) {
            let specimen = get_selected_specimen();
            let block = get_selected_block();
            let test_record = {
                'specimen_id': $(specimen).data('specimen-id'),
                'specimen_text': $(specimen).data('specimen-text'),
                // 'block_id': $(block).data('block-id'),
                'block_text': $(specimen).data('block-text'),
                'test_id': $(this).data('test-id'),
                'test_name': $(this).data('test-name'),
                'test_cost': $(this).data('cost'),
                'test_sale': $(this).data('sale'),

            };

            let search_result = search_test(test_record, selected_tests);

            if (search_result > -1) {
                selected_tests.splice(search_result, 1);
                remove_record(test_record);
                if ($(this).is('input')) {
                    $(this).prop("checked", false);
                } else if ($(this).is('a')) {
                    $(this).removeClass('active');
                }
            } else {
                selected_tests.push(test_record);
                insert_record(test_record);
                if ($(this).is('input')) {
                    $(this).prop("checked", true);
                } else if ($(this).is('a')) {
                    $(this).addClass('active');
                }
            }

            // console.log(selected_tests, search_result);


        } else {
            $(this).prop("checked", false);
            alert('Please select Specimen and Block first!');
        }
    });

    function insert_record(record) {
        let record_id = generate_record_id(record);
        var lab_number = $("#lab_number").val();
        var html = "<tr id=" + record_id + ">";
        html += "<td>" + lab_number + "</td>";
        html += "<td>Patient</td>";
        html += "<td>" + record.test_name + "</td>";
        html += "<td>" + record.specimen_text + "</td>";
        html += "<td>" + record.block_text + "</td>";
       // html += "<td class='text-right'>" + record.test_cost + "</td>";
        html += "</tr>";
        $(".custom-table-search tbody").append(html);
    }

    function remove_record(record) {
        let record_id = generate_record_id(record);
        $(".custom-table-search tbody tr[id='" + record_id + "']").remove();
    }

    function generate_record_id(record) {
        return record.specimen_id + '-' + record.test_id;
    }

    function search_test(test_object, array_selected_tests) {
        for (var i = 0; i < array_selected_tests.length; i++) {
            if (array_selected_tests[i].specimen_id == test_object.specimen_id && array_selected_tests[i].block_id == test_object.block_id && array_selected_tests[i].test_id == test_object.test_id) {
                return i;
            }
        }
    }

    function get_all_selected_tests() {
        return $('input.test-record:checked, a.test-record.active');
    }

    function reset_selected_tests() {
        var specimenId = $(".list-inline-item ul > li.list-inline-item a.active").data('specimen-id');
        let selected_tests = get_all_selected_tests();
        $.each(selected_tests, function (index, test) {
            var testId = $(test).data('test-id');
            var tableId = specimenId + '-' + testId;
            $("#" + tableId).remove();
            if ($(test).is('input')) {
                $(test).prop("checked", false);
            } else if ($(test).is('a')) {
                $(test).removeClass('active');
            }
        });
    }

    $('#myModal').on('show.bs.modal', function (e) {
        if (selected_tests.length > 0) {
            let specimen_options = $('li#speci-list > ul > li.list-inline-item a');
            let block_options = $('li#block-list > ul > li.list-inline-item a');

            if (specimen_options.length > 0) {
                $.each(specimen_options, function (index, option) {
                    if (!$(option).hasClass('active')) {
                        let data = {
                            id: $(option).data('specimen-id'),
                            text: $(option).data('specimen-text')
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        modal_select_spcimen.append(newOption);
                    }
                });
                modal_select_spcimen.trigger('change');
            }

            if (block_options.length > 0) {
                $.each(block_options, function (index, option) {
                    if (!$(option).hasClass('active')) {
                        let data = {
                            id: $(option).data('block-id'),
                            text: $(option).data('block-text')
                        };

                        var newOption = new Option(data.text, data.id, false, false);
                        modal_select_block.append(newOption);
                    }
                });
                modal_select_block.trigger('change');
            }
        } else {
            e.preventDefault();
            alert("First Select Test");
        }

    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        modal_select_spcimen.empty();
        modal_select_spcimen.trigger('change');
        modal_select_block.empty();
        modal_select_block.trigger('change');
    });

    $('#auto-repeat').click(function () {
        let modal_selected_specimen = $(modal_select_spcimen).select2('data');
        let modal_selected_block = $(modal_select_block).select2('data');
        console.log('hi', modal_selected_specimen, modal_selected_block);

        if (selected_tests.length > 0) {
            $.each(selected_tests, function (index, test) {
                let test_record = {
                    'specimen_id': modal_selected_specimen[0].id,
                    'specimen_text': modal_selected_specimen[0].text,
                    'block_id': modal_selected_block[0].id,
                    'block_text': modal_selected_block[0].text,
                    'test_id': test.test_id,
                    'test_name': test.test_name,
                    'test_cost': test.test_cost,
                    'test_sale': test.test_sale,
                };

                let search_result = search_test(test_record, selected_tests);

                if (typeof search_result == 'undefined') {
                    selected_tests.push(test_record);
                    insert_record(test_record);
                }

            })
        }
    });

    $("#myInput").on("keyup", function () {
        $("#divID").text($(this).val());
    });
    
    $("#myInput2").on("keyup", function () {
        $("#divID2").text($(this).val());
    });

    function processFormData(formData, selected_tests) {
        var data = formData;
        $.each(selected_tests, function (index, test) {
            formData.push(
                {name: 'specimen_id[]', value: test.specimen_id},
                {name: 'specimen_text[]', value: test.specimen_text},
                {name: 'block_text[]', value: test.block_text},
                {name: 'test_id[]', value: test.test_id},
                {name: 'test_name[]', value: test.test_name},
                {name: 'test_cost[]', value: test.test_cost},
                {name: 'test_sale[]', value: test.test_sale}
            );
        });

        return formData;
    }

function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("print_section");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save('further_request');
      }

    // $(".save-btn-furtherwork").on("click", function () {
    //     var baseUrl = "https://vet.uralensiswebapp.co.uk";
    //     var formData = $("#saveFurtherRequest").serializeArray();
    //     formData = processFormData(formData, selected_tests);
    //     $.ajax({
    //         url: baseUrl + "/doctor/save_further_request",
    //         type: "POST",
    //         dataType: 'json',
    //         async: false,
    //         data: formData,
    //         success: function (response) {
    //             // var specimenId = $('#block_specimen_id').val();
    //             if (response.status === 'success') {
    //                 $('#add_leave_modal').modal('hide');
    //                 // $("#specimen_" + specimenId + " .block_table").append(response.data);
    //                 $.sticky(response.message, {
    //                     classList: 'success',
    //                     speed: 200,
    //                     autoclose: 7000
    //                 });
    //                 window.location.href = baseUrl+'/doctor/doctor_record_detail_old/'+response.redirectId;
    //             } else {
    //                 $.sticky(response.message, {
    //                     classList: 'important',
    //                     speed: 200,
    //                     autoclose: 7000
    //                 });
    //             }
    //         }
    //     });
    // });

});
</script>