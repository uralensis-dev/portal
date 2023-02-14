<style>
    .page-wrapper.sidebar-patient {
    padding-top: 50px!important;
}
</style>
<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:0px;
        height: 37px !important;
        width: 50px !important;
        left: 15px;
        padding:0;
    }
    .input-group-btn{
        right: 26px;
        z-index: 999;
    }
    .form-focus{
        height: auto;
    }
    .form-focus .form-control {
        height: 36px;
        padding: 0 12px;
    }
    .comments_icon{
        position: relative;
    }
    .comments_icon .badge {
        position: absolute;
        top: -20px;
        right: -10px;
    }
    .users_hh {
        display: none; 
        position: absolute;
        top: 24px;
        background: #fff;
        font-size: 14px;
        border: 1px solid #ddd;
        padding: 0 5px;
        color: #555;
        cursor: default;
    }
    .like:hover .users_hh{
        display: block;
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
    ul.tg-filters.record-list-filters.new_fil li span label:focus {
        background: #006df1 !important;
        color: #fff;
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
    /*.flags_check span.tg-radio {
        display: none;
    }
    .flags_check span.tg-radio.first {
        display: block;
    }*/
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
}}

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
    #doctor_record_list_table tbody tr:hover{
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .tg-filterhold{
        width: auto;

    }

    #doctor_record_list_table_wrapper .row:nth-child(1){
        padding: 0 15px
    }

    #doctor_record_list_table_wrapper .row:nth-child(2){
        margin: 0;
    }

    #doctor_record_list_table_wrapper .row:nth-child(2) .col-sm-12{
        padding: 0 15px;
    }
    .tg-rightarea{top: 55px; position: relative; z-index: 2;}
   .tg-filterss.record-list-filters{
        display:inline-block;
        list-style:none;
    }
    #doctor_record_list_table_filter {
    /* display: none; */
}
div#doctor_record_list_table_length {
    position: absolute;
}
div.dataTables_wrapper div.dataTables_length select {
    top: -90px;
    left: 0;
}
.tg-filters > li:first-child {
    padding-left: 0;
    margin-left: 80px;
}
div.dataTables_wrapper div.dataTables_info {
    padding-left: 15px;
}


.list-track {
    list-style: none;
}
.list-track li {
    display: inline-block;
    margin: 0px!important;
}
.list-track li i {
    fill: #56c0ef;
    vertical-align: middle;
    padding: 2px;
    color: #56c0ef;
    width: 25px;
    text-align: center;
    font-size: 20px;
}
.list-track li svg {
    width: 25px;
    height: 25px;
    fill: #56c0ef;
    vertical-align: middle;
    padding: 2px;
}

.list-track li a {
    border-radius: 50px;
    border: 1px solid #56c0ef;
    padding: 8px 5px;
}
.tg-filters > li {
    display: inline-block;
    vertical-align: text-top;
    float:none;
} 
.tg-filters {
    float: none;
    list-style: none;
    text-align: end;
} 
.track-item {
    position: relative;
    float: left;
    width: 100%;
    top:10px;
}
.tg-flagcolor .tg-radio input[type=radio] + label:before {
    width: 38px;
    height: 38px;
}
.list-track li .active {
    border: 1px solid #fff;
    background: #56c0ef;
}
.list-track li .active svg{
  fill:#fff;
}

@media screen and (max-width: 1024px) {
    div.dataTables_wrapper div.dataTables_length select{
      left: 0;
    }
    .tg-flagcolor .tg-radio input[type=radio] + label:before{
      width: 30px!important;
    height: 30px!important;
    }
    .tg-radio label span {
    position: relative;
    top: -3px;
}
.list-track li {
    padding-left: 0px!important;
}
.list-track li a{
  padding: 10px 5px!important;
}
}
@media screen and (max-width: 768px) {
    .tg-filters {
    float: none;
    list-style: none;
    text-align: start;
}
.tg-filters > li:first-child {
    margin-left: 0px;
}
.tg-inputicon {
    left: 40px;
}
}
@media screen and (max-width: 580px) {

.track-item {
    float: none;
    width: 100%;
    padding: 5px 15px;
}
.list-track li {
    margin: 10px 0px!important;
}
#doctor_record_list_table_wrapper .row .col-sm-12.col-md-6 {
    width: 100%;
}
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 6.5em;
}
div.dataTables_wrapper div.dataTables_length select {
    left: 0px;
}
}
@media screen and (max-width:440px) {
    div#doctor_record_list_table_length {
    position: relative;
}
div.dataTables_wrapper div.dataTables_length select {
    left: 0px;
    top: -4px;
}
}

@media screen and (max-width:400px) {
.user-menu.nav > li > a {
    padding: 0 5px;
}
div.dataTables_wrapper div.dataTables_filter input {
    margin-left: 3.5em;
}
div.dataTables_wrapper div.dataTables_length select {
    left: -80px;
}
div#doctor_record_list_table_length {
    position: relative;
}
div.dataTables_wrapper div.dataTables_length select {
    left: 0px;
    top: -4px;
}
}

</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-md-8">
                <h3 class="page-title">Teaching Cases</h3>
                <div class="tg-breadcrumbarea tg-searchrecordhold">
                    <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                        <li><a href="javascript:;">Dashboard</a></li>
                        <li class="active">Teaching Cases</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <a id="doctor_advance_search" href="javascript:void(0);" class="btn btn-default"><i class="fa fa-cog fa-2x"></i></a></div>
            </div>
        </div>
        

<div class="row">    
    <div class="col-md-12">
        <div id="advance_search_table">
            <?php
                   $attributes = array('class' => '');
                    echo form_open("Doctor/search_request", $attributes);
                    ?>
                <table class="table custom-table">
                    <tr>
                        <th>First Name</th>
                        <th>Sur Name</th>
                        <th>EMIS No</th>
                        <th>LAB No</th>
                        <th colspan="2">NHS No</th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control" type="text" id="first_name" name="first_name">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="sur_name" name="sur_name">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="emis_no" name="emis_no">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="lab_no" name="lab_no">
                        </td>
                        <td>
                            <input class="form-control" type="text" id="nhs_no" name="nhs_no">
                        </td>
                        <td>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block" style="margin-top:7px; font-size: 1.1em">Search</button>
                            </div> 
                        </td>
                    </tr>
                </table>
                
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 form-group">
        <div class="panel panel-default">
          <div class="panel-heading" style="padding: 10px 15px; font-size: 20px;font-weight: 700">Teaching Cases List</div>
          <div class="panel-body">  
            <div class="row">
                <div class="col-md-12">
                    <div class="edu_msg"></div>
                    <form id="list_education_cases">
                        <div class="form-group">
                            <label for="education_cats_data">Select Education Category to List Record.</label>
                            <select name="education_cats_data" id="education_cats_data" class="form-control">
                                <option value="0">Select Education Category</option>
                                <?php
                                if (!empty($edu_cats)) {

                                    foreach ($edu_cats as $cats) {
                                        $selected = '';
                                        if ($cats->ura_tec_mdt_id === $request_query[0]->teaching_case) {

                                            $selected = 'selected';
                                        }
                                        echo '<option ' . $selected . ' value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="display_edu_data"></div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

