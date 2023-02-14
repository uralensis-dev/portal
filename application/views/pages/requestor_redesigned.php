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
        color: #495057;
        background-color: #fff;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    link, .nav-tabs .nav-link.active {
        color: #ffffff;
        background-color: #028ee1;
        border-color: #dee2e6 #dee2e6 #fff;
        border: 1px solid #028ee1
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
                                <li class="list-inline-item s_list" data-text="Specimen 1">
                                    <a href="javascript:;" class="">S1</a>
                                    <ul class="list-inline specimen_list_inners">
                                        <li class="list-inline-item" data-text="Specimen 2">
                                            <a href="javascript:;" class="">S2</a>
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
                                    <a href="javascript:;" class="blk"><img src="<?php echo base_url();?>assets/icons/Urgent-wb.png" style="max-width: 40px;"></a>
                                    <a href="javascript:;" class="white"><img src="<?php echo base_url();?>assets/icons/Urgent-wb-white.png" style="max-width: 40px;"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <br>
                </div>
                <div class="clearfix"></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#solid-rounded-tab1" data-toggle="tab">Routine & Specials</a></li>
                    <li class="nav-item"><a class="nav-link" href="#solid-rounded-tab2" data-toggle="tab">Immunochemistry</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="solid-rounded-tab1">
                        <div class="form-group">
                            <ul class="qucikSearch">
                                <li><a href="javascript:;" class="btn btn-info btn-block">Alcian Blue</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AB PAS</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">AB DPAS</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Congo Red</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">EVG</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Formalin Pig Removal</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Giemsa</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Gram</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Gram Twort</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Grocott</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Hales</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">MSB</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Mason Fontana</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Oil Red O</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">P.A. Silver</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PAS</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">PAS +D</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Perl's</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Thick Perl's</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Retic</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Rhodanine</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Shikata</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Von Kossa</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">ZN</a></li>
                                <li><a href="javascript:;" class="btn btn-info btn-block">Mod ZN</a></li>
                            </ul>
                        </div>
                        <div class="form-group mb-0">
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
                    </div>
                    <div class="tab-pane table-responsive" id="solid-rounded-tab2">
                        <div class="form-group">
                            <div class="row m-0">
                                <div class="col-md-3 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Undiff' neoplas</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">MNF116</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">VIM</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">MNF116</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">VIM</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Meso. vs adenoca</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">MNF116</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">VIM</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Soft Tissue Tumour</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Lelanoma</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">MNF116</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">VIM</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Panel title</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">MNF116</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">VIM</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">MNF116</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">VIM</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Soft Tissue Tumour</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">CD45</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input">
                                                <label class="custom-control-label" for="customControlValidation1">HMB45</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
