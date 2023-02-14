<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
    #upload_csv{
        margin-bottom: 40px;
        padding-left: 0;
        display:none;
    }
    .csv_div{
        border: 1px solid lightgrey;
        padding: 25px!important;
        border-radius: 5px;
    }
    .success_list {
        margin: 15px 0px;
        background-color: lightgreen;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    .error_list{
        margin: 15px 0px;
        background-color: lightcoral;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
    .cr-boundary{
        width: 250px !important;
        height: 250px !important;
    }
.hide_upload_div {
    color: #0470d8;
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Patients</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('patient'); ?>">Patients</a></li>
            </ul>
        </div>
        <a href="javascript:void(0);" class="btn add-btn mr-2" id="show_upload_div"><i class="fa fa-upload"></i> Import CSV</a> &nbsp;
        <div class="col-auto float-right ml-auto">
            <?php if ($group_type != 'D') : ?>
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_patient"><i class="fa fa-plus"></i>Patient</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="notification">
    <?php if ($this->session->flashdata('success') != '') { ?>
        <div class="success_list">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('error') != '') { ?>
        <div class="error_list">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
</div>

<div class="col-sm-12" id="upload_csv">
    <form method="POST" action="<?= base_url('patient/addPatientDataFromCsv'); ?>" enctype="multipart/form-data" name="impForm" id="ImpForm">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
        <div class="modal-body csv_div">
            <div class="row" style="margin-bottom:-15px;">
                <div class="col-sm-2 col-md-2 text-right">
                    <strong>Select CSV File:</strong>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <!--<label class="col-form-label">Select CSV File</label>-->
                        <input type="file" name="UploadCSV" id="UploadCSV">
                    </div>
                </div>
                <div class="col-sm-3 col-md-3" style="text-align: center;">
                    <div class="form-group">
                        <a href="<?= base_url('uploads/Patients.csv'); ?>"><i class="fa fa-download"></i> Download Sample File</a>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="form-group">
                        <button class="btn btn-info btn-rounded btn-sm submit">Submit</button>
                    </div>
                </div>
                <div class="col-sm-1 col-md-1 text-right">
                    <i class="fa fa-close hide_upload_div"></i>
                </div>
            </div>
        </div>
        <!-- <div class="modal-footer">
            <button class="btn btn-info btn-rounded btn-lg">Submit</button>
        </div> -->
    </form>
</div>

<div class="row mb-3" style="display:none">
    <div class="col text-right">
        <?php foreach ($hospitals as $h) : ?>
            <div data-toggle="tooltip" data-placement="top" title="<?php echo $h['description']; ?>" class="hospital-info"><?php echo $h['first_initial'] . $h['last_initial'] ?></div>
        <?php endforeach; ?>
        <span class="lnr lnr-cross-circle" id="clear-hospital" style="margin-left: 10px; position: relative; top: 4px; cursor: pointer;"></span>
    </div>
</div>
<div class="table-responsive">
    <form action="<?= site_url('patient/delete_bulk_patient'); ?>" method="post" id="delete_pt_frm">
    <input type="hidden" name='<?= $this->security->get_csrf_token_name(); ?>' value='<?= $this->security->get_csrf_hash(); ?>'>
        <table class="table table-striped no-footer" id="patient-table" style="width: 100%;">
            <thead>        
                <tr>
                    <th colspan="10" class="boder-bottom" style="padding:8px 0px;">
                        <div class='col-md-2' style="padding:0;">
                        <a href="javascript:delete_patient('bulk_delete');" class="btn btn-danger deletebtn"  style='display:none;' id="btn_pt_delete">Delete Selected</a>
                        </div>
                    </th>
                </tr>
                <tr>
                     <th><input type="checkbox" name="all_patient" id="all_patient" class=""></th>
                    <th>ID.</th>
                    <th>Patient</th>
                    <th>Contact Details</th>
                    <th>Hospital</th>
                    <th>Patient IDs</th>
                    <th>Address</th>
                    <th>Records</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table> 
    </form>     

            <div class="panel panel-default" style='display:none;'>
                <div class="panel-body">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Fist Name</th>
                                <th>Last Name</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                                <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                <td>Carlos</td>
                                <td>Mathias</td>
                                <td>Leme</td>
                                <td>SP</td>
                                <td>new</td>
                            </tr>                            
                            <tr>
                                <td colspan="12" class="hiddenRow">
                                    <div class="accordian-body collapse" id="demo1"> 
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="info">
                                                    <th>Job</th>
                                                    <th>Company</th>
                                                    <th>Salary</th>		
                                                    <th>Date On</th>	
                                                    <th>Date off</th>	
                                                    <th>Action</th>	
                                                </tr>
                                            </thead>	
                                            <tbody>                                                                
                                                <tr data-toggle="collapse"  class="accordion-toggle" data-target="#demo10">
                                                    <td> <a href="#">Enginner Software</a></td>
                                                    <td>Google</td>
                                                    <td>U$8.00000 </td>
                                                    <td> 2016/09/27</td>
                                                    <td> 2017/09/27</td>
                                                    <td><a href="#" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-cog"></i></a></td>
                                                </tr>                                                                
                                                <tr>
                                                    <td colspan="12" class="hiddenRow">
                                                        <div class="accordian-body collapse" id="demo10"> 
                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <td><a href="#"> XPTO 1</a></td>
                                                                        <td>XPTO 2</td>
                                                                        <td>Obs</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>item 1</th>
                                                                        <th>item 2</th>
                                                                        <th>item 3 </th>
                                                                        <th>item 4</th>
                                                                        <th>item 5</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>item 1</td>
                                                                        <td>item 2</td>
                                                                        <td>item 3</td>
                                                                        <td>item 4</td>
                                                                        <td>item 5</td>
                                                                        <td>
                                                                            <a href="#" class="btn btn-default btn-sm">
                                                                                <i class="glyphicon glyphicon-cog"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>                           
                                                        </div> 
                                                    </td>
                                                </tr>
                                                                                                                            
                                                <tr>
                                                    <td>Scrum Master</td>
                                                    <td>Google</td>
                                                    <td>U$8.00000 </td>
                                                    <td> 2016/09/27</td>
                                                    <td> 2017/09/27</td>
                                                    <td> 
                                                        <a href="#" class="btn btn-default btn-sm">
                                                            <i class="glyphicon glyphicon-cog"></i>
                                                        </a>
                                                    </td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                
                                    </div> 
                                </td>
                            </tr>
                            <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                                <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                <td>Silvio</td>
                                <td>Santos</td>
                                <td>São Paulo</td>
                                <td>SP</td>
                                <td>new</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="hiddenRow">
                                    <div id="demo2" class="accordian-body collapse">Demo2</div>
                                </td>
                            </tr>
                            <tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">
                                <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                <td>John</td>
                                <td>Doe</td>
                                <td>Dracena</td>
                                <td>SP</td>
                                <td> New</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="hiddenRow">
                                    <div id="demo3" class="accordian-body collapse">Demo3 sadasdasdasdasdas</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>        
            </div>         
        
    
</div>


<div id="add_patient" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Patient</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tg-editformholder">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div id="upload-demo"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>Select Image:</strong>
                            <br/><br/>
                            <input type="file" id="upload" name="profile_pic" accept="image/*"/>
                            <br/><br/>
                            <button class="btn btn-success upload-result">Upload Image</button>
                        </div>
                        <div class="col-md-4" style="">
                            <div id="upload-demo-i" style="background:#e1e1e1;padding:30px;height:250px;"></div>
                        </div>
                    </div>
                    <?php //echo form_open_multipart("patient/add_patient", array('id' => 'add-patient-form123')); ?>
                    <?php echo form_open('', array('id' => 'add-patient-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
                                <!--<div class="col-md-4 mx-auto text-center">
                                    <div class="profile-img-wrap edit-img">
                                        <img class="inline-block" id="profile-pic-preview" src="<?php /*echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); */?>" alt="user">
                                        <div class="fileupload btn">
                                            <span class="btn-text">Profile Pic</span>
                                            <input class="upload" type="file" id="upload" name="profile_pic" accept="image/*"/>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <?php 
									//print $group_type."========";
									
									if ($group_type == 'H') { ?>
                                        <input type="hidden" id="group-input" name="group" value="<?php echo $hospitals[0]['id']; ?>">
                                        <input type="text" readonly disabled name="group-text" value="<?php echo $hospitals[0]['description']; ?>" class="form-control">
                                    <?php }
                                     ?>
                                        <label>Select Hospital</label>
                                        <select type="text" name="group" id="group-input" value="" class="form-control select">
                                            <?php foreach ($hospitals as $hospital) : ?>
                                                <option value="<?php echo $hospital['id'] ?>"><?php echo $hospital['description']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php  ?>

                                </div>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <input type="text" name="first_name" id="first-name-input" value="" class="form-control" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-user"></i>
                                            <input type="text" name="last_name" id="last-name-input" value="" class="form-control" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-license"></i>
                                            <input type="text" name="nhs_number" id="nhs-number-input" value="" class="form-control" placeholder="NHS Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-license"></i>
                                            <input type="text" name="hospital_id" id="hospital-id-input" value="" class="form-control" placeholder="Hospital No">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender-input">Gender</label>
                                            <select name="gender" id="gender-input" value="" class="form-control">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="dob-input">Date of Birth</label>
                                            <i class="lnr lnr-calendar-full"></i>
                                            <input type="date" name="dob" id="dob-input" value="" class="form-control" placeholder="Date Of Birth">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="password-row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-envelope"></i>
                                            <input type="email" name="email" id="email-input" value="" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <span>
                                                <i class="lnr lnr-phone-handset"></i>
                                            </span>
                                            <input type="text" name="phone" id="phone-input" value="" class="form-control" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Patient ID</label>
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="p_id_1" id="p_id_1" value="" class="form-control" placeholder="Patient ID 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                               
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="p_id_2" id="p_id_2" value="" class="form-control" placeholder="Patient ID 2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <label for="address1-input">Address</label>
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="address1" id="address1-input" value="" class="form-control" placeholder="Address Line 1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-apartment"></i>
                                            <input type="text" name="address2" id="address2-input" value="" class="form-control" placeholder="Address Line 2">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-map-marker"></i>
                                            <input type="text" name="city" id="city-input" value="" class="form-control" placeholder="City">
                                        </div>
                                    </div>
                                   <!-- <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-map"></i>
                                            <input type="text" name="state" id="state-input" value="" class="form-control" placeholder="State">
                                        </div>
                                    </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-earth"></i>
                                            <input type="text" name="country" id="country-input" value="United Kingdom" class="form-control" placeholder="Country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group tg-inputwithicon">
                                            <i class="lnr lnr-pushpin"></i>
                                            <input type="text" name="post_code" id="post-code-input" value="" class="form-control" placeholder="Post Code">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="profile_picture_path" id="profile_picture_path" value="">
                                    <input type="hidden" name="picture_name" id="picture_name" value="">
                                <!--<button class="btn btn-success" id="user-create-btn">Create</button>-->
                                    <button class="btn btn-success" type="submit">Create</button>
                                    <button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear</button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <!--</form>-->
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal custom-modal fade" id="delete_patient_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Patient</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn patient-delete-btn">Delete</a>
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

<script type="text/javascript">
    $(".hide_upload_div").click(function () {
        $("#upload_csv").hide(1000);
    });
    $("#hide_upload_div").click(function () {
        $("#upload_csv").hide(1000);
    });
    $("#show_upload_div").click(function () {
        $("#upload_csv").show(1000);
    });
    $(document).ready( function() {
        setTimeout(function (){
            $('.notification').hide(9000);
        }, 5000);
    });
    var site_url = '<?= base_url(); ?>';
</script>