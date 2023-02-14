<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container-fluid">
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
        
    </div>
    
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

