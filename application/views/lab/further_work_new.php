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
    <div class="col-lg-6 col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 form-group">
                    <div class="row">
                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Intials: <span>MRP</span></label>
                        </div>
                        <div class="col-lg-4 form-group">
                            <input type="text" name="lab_no" id="lab_no" value="<?php echo $recordDetails[0]["lab_number"]; ?>" readonly="readonly" class="form-control" placeholder="Lab No.">
                        </div>

                        <div class="col-lg-1 form-group nopadding">
                            <label for="" style="margin-top: 10px;">LABS:</label>
                        </div>
                        <div class="col-lg-5 form-group">
                            <select class="form-control select2" id="myInput3">
                                <?php foreach ($labName as $labKey => $labValue) { ?> 
                                    <option value="<?php echo $labValue["id"]; ?>" <?php echo ($labValue["id"] == $recordDetails[0]["lab_id"] ? 'selected=selected' : '');?> ><?php echo $labValue["name"]; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        
                        
                        
                        <div class="col-lg-2 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Specimen:</label>
                        </div>
                        <div class="col-lg-4 form-group">
                            <select class="form-control select2" id="myInput4">
                                <?php 
                               
                                    $c =0;
                                    foreach ($specimen_query as $sKey => $sValue) {
                                       $c++; ?> 
                                    <option value="<?php echo $sValue->specimen_id; ?>">S<?php echo $c; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                        
                        <div class="col-lg-1 form-group nopadding">
                            <label for="" style="margin-top: 10px;">Blocks:</label>
                        </div>
                        <div class="col-lg-5 form-group">
                            <select class="form-control select2" id="myInput" multiple>
                                <?php 
                               
                                    $b =0;
                                    foreach ($specimen_blocks as $bKey => $bValue) {
                                       $b++; ?> 
                                    <option value="<?php echo $bValue->id; ?>">B<?php echo $b; ?></option>
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
                    foreach ($test_sub_categories["main_cat"] as $catKey => $catValue) {
                        $t++;
                        ?>
                        <div class="tab-pane <?php echo ($t == 1 ? 'show active' : ''); ?>" id="solid-rounded-tab<?php echo $catValue["main_cat_id"]; ?>">
                            <div class="form-group">
                                <ul class="qucikSearch">
                                    <?php foreach ($catValue["sub_cat"] as $subKey => $suBValue) { ?>
                                        <h4><?php echo $suBValue["sub_cat_name"]; ?>:</h4>
                                        <?php foreach ($suBValue["tests"] as $subTestKey => $subTestValue) { ?>
                                            <li><a href="javascript:;" class="btn btn-info btn-block"><?php echo $subTestValue["test_name"]; ?></a></li>
                                        <?php } ?> <div style="clear:both;"></div>
                                        <br>   
                                    <?php } ?>   

                                </ul>
                            </div>

                        </div>
                    <?php } ?>


                </div>

                <div class="row">

                    <div class="col-lg-12 form-group">
                        <label>Reason for Request</label>
                        <div class="clearfix"></div>
                        <!-- <input type="text" class="form-control select2"  id="myInput" value=""> -->
                        <select class="form-control select2" id="request_reasons" name="request_reasons">
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
                                    <strong>Date:</strong> <?php echo date("Y-m-d"); ?>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                Requestor Name : <?php echo $request_query[0]->first_name . " " . $request_query[0]->last_name; ?>
                                <span class="pull-right"  style="float: right;">
                                    <strong>Time:</strong> <?php echo date("H:i"); ?>
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
