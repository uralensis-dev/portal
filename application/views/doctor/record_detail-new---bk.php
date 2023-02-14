<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
//debug($specimen_query);exit;

    $record_id = $this->uri->segment(3);
    $doc_id = $this->ion_auth->user()->row()->id;
   
    
    if (!empty($record_edit_status)) {
        $user_id = $record_edit_status[0]->user_id_for_edit;
        $edit_timestamp = $record_edit_status[0]->user_record_edit_timestamp;
        /* Get First & Last Name */
        $first_name = '';
        $last_name = '';
        $getdatils = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$doc_id));
        //echo last_query();exit;
      /*  if (!empty($this->ion_auth->user($user_id)->row()->first_name)) {
            $first_name = $this->ion_auth->user($user_id)->row()->first_name;
        }
        
        if (!empty($this->ion_auth->user($user_id)->row()->last_name)) {
            $last_name = $this->ion_auth->user($user_id)->row()->last_name;
        }*/

        $edit_full_name = $getdatils[0]->first_name . '&nbsp;' . $getdatils[0]->last_name;
     
    }
   // debug($request_query);exit;

    if (!empty($request_query)) {
        $userid = $request_query[0]->request_add_user;
        $record_add_timestamp = $request_query[0]->request_add_user_timestamp;
        $first_name = '';
        $last_name = '';
        $getuserdetails = getRecords("AES_DECRYPT(first_name, '".DATA_KEY."') AS first_name,AES_DECRYPT(last_name, '".DATA_KEY."') AS last_name","users",array("id"=>$userid));
       
       /* if (!empty($this->ion_auth->user($userid)->row()->first_name)) {
            $first_name = $this->ion_auth->user($userid)->row()->first_name;
        }
        if (!empty($this->ion_auth->user($userid)->row()->last_name)) {
            $last_name = $this->ion_auth->user($userid)->row()->last_name;
        }*/
        $add_full_name = $getuserdetails[0]->first_name . '&nbsp;' . $getuserdetails[0]->last_name;
    }

    $micro_codes_data = array();
    if (!empty($micro_codes)) {
        foreach ($micro_codes as $mi_codes) {
            $micro_codes_data[] = $mi_codes;
        }
    }

    if (!empty($user_id) && $edit_timestamp) {
    }   
        ?>
<!-- Page Content -->
<style type="text/css">
.sidebar-patient .content{
    background: #f5f5f5 !important;
}
</style>
<div class="content container-fluid d-flex new_setting">
                    <div class="sidebar second-sidebar ">
                        <ul>
                            <li>
                                <a class="btn btn-light btn-round" href="#">JS</a>
                            </li>
                            <li>
                                <a class="btn btn-light btn-round" href="#">JS</a>
                            </li>
                            <li class="active">
                                <a class="btn btn-light btn-round" href="#">JS</a>
                            </li>
                            <li>
                                <a class="btn btn-light btn-round" href="#">JS</a>
                            </li>
                            <li>
                                <a class="btn btn-light btn-round" href="#">JS</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                    	<div class="row">
                    <div class="col-xl-3">
                    <div class="slide-container">
                        <div class="slide-container-inner">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    
                                </div>
                            </div>
                           <div class="card">
                                <span class="title">Add case title here</span>
                                <img class="img-responsive" src="<?php echo base_url()?>assets/subassets/img/slidePlaceholder.jpg" />   
                                <span class="badge badge-pill bg-white color-green">
                                    <i class="fa fa-check"></i>
                                </span>                             
                            </div>
                            <div class="card">
                                <span class="title">Add case title here</span>
                                <img src="<?php echo base_url()?>assets/subassets/img/slidePlaceholder.jpg" />   
                                <span class="badge badge-pill bg-white color-green">
                                    <i class="fa fa-check"></i>
                                </span>                             
                            </div>
                            <div class="card">
                                <span class="title">Add case title here</span>
                                <img src="<?php echo base_url()?>assets/subassets/img/slidePlaceholder.jpg" />   
                                <span class="badge badge-pill bg-white color-green">
                                    <i class="fa fa-check"></i>
                                </span>                             
                            </div>
                            <div class="card">
                                <span class="title">Add case title here</span>
                                <img src="<?php echo base_url()?>assets/subassets/img/slidePlaceholder.jpg" />   
                                <span class="badge badge-pill bg-white color-black">
                                    <i class="fa fa-spinner"></i>
                                </span>                             
                            </div>
                            <div class="card">
                                <span class="title">Add case title here</span>
                                <img src="<?php echo base_url()?>assets/subassets/img/slidePlaceholder.jpg" />   
                                <span class="badge badge-pill bg-white color-black">
                                    <i class="fa fa-spinner"></i>
                                </span>                             
                            </div>
                            <div class="card">
                                <span class="title">Add case title here</span>
                                <img src="<?php echo base_url()?>assets/subassets/img/slidePlaceholder.jpg" />   
                                <span class="badge badge-pill bg-white color-black">
                                    <i class="fa fa-spinner"></i>
                                </span>                             
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    <div class="col-xl-9">
                    <div class="dashboard-wrapper patient-group">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">
                                    <span>Lab No: <?php echo $request_query[0]->lab_number?></span>
                                </h3>
                                <ul class="breadcrumb ">                                    
                                    <li class="breadcrumb-item"><div>
                                    <?php echo $request_query[0]->lab_name?></div></li>
                                    <li class="breadcrumb-item second-child">
                                        <div>
                                            <span class="badge badge-lg badge-pill badge-danger" href="#">
                                                60
                                            </span>
                                            <span class="badge badge-lg badge-pill color-blue bg-tr" href="#">
                                                <i class="fa fa-flag"></i>
                                            </span>
                                            <span class="badge badge-lg badge-pill bg-green color-white" href="#">
                                                <i class="fa fa-flag"></i>
                                            </span>
                                            <span class="badge badge-lg badge-pill color-yellow bg-tr" href="#">
                                                <i class="fa fa-flag"></i>
                                            </span>
                                            <span class="badge badge-lg badge-pill color-black bg-tr" href="#">
                                                <i class="fa fa-flag"></i>
                                            </span>
                                            <span class="badge badge-lg badge-pill color-red bg-tr" href="#">
                                                <i class="fa fa-flag"></i>
                                            </span>
                                        </div>
                                        </li>
                                    <!-- <li class="breadcrumb-item active"><div>Flags</div></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->

                    <!-- Cards -->
                    <div class="row alignRight">
                        <a class="btn btn-primary btn-sm" href="" style="font-size:14px !important;"><i class="fa fa-unlock"></i> </a>
                    </div>
                    <div class="row d-block rc_det">
                        <!-- <div class="left-btn-cont">
                            <a class="btn btn-primary btn-sicon" href=""></a>
                            <a class="btn btn-light btn-sicon" href=""></a>
                        </div> -->
                        <div class="col-lg-3 nopadding-right">
                            <div class="card">
                                <div class="card-body">
                                	<div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo $request_query[0]->first_name?>">
                                        <label class="focus-label">First Name</label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo $request_query[0]->date_rec_by_doctor?>">
                                        <label class="focus-label">Clinic Date</label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo $request_query[0]->date_taken?>">
                                        <label class="focus-label">Date Taken</label>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 nopadding-right">
                            <div class="card">
                                <div class="card-body">
                                	<div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo $request_query[0]->emis_number?>">
                                        <label class="focus-label">NHS No</label>
                                    </div>
	                                <div class="form-group form-focus">
	                                    <?php
                                            $getClinic = getRecords("*","uralensis_clinician",array("hospital_id"=>$request_query[0]->hospital_group_id));    
                                        ?>
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo $getClinic[0]->clinician_name?>">
                                        <label class="focus-label">Clinician</label>
                                    </div>
                                    <div class="form-group form-focus">
                                    	<?php
                                        	$getClinic = getRecords("*","uralensis_dermatological_surgeon",array("hospital_id"=>$request_query[0]->hospital_group_id));
                                        ?>
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo ($getClinic[0]->dermatological_surgeon_name!="")?$getClinic[0]->dermatological_surgeon_name:"No Surgeon"?>">
                                        <label class="focus-label">Surgeon</label>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 nopadding-right">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo $request_query[0]->emis_number?>">
                                        <label class="focus-label">EMIC Number</label>
                                    </div>
                                    <div class="form-group form-focus">
                                    	
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo date("Y/d/m",strtotime($request_query[0]->date_sent_touralensis))?>">
                                        <label class="focus-label">REL LAB</label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo date("Y/d/m",strtotime($request_query[0]->date_rec_by_doctor))?>">
                                        <label class="focus-label">Rec by Doc</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 nopadding-right">
                            <div class="card">
                                <div class="card-body">
                                	<div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="">
                                        <label class="focus-label">Age</label>
                                    </div>
                                	<div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value="<?php echo $request_query[0]->pci_number?>">
                                        <label class="focus-label">PCI NO</label>
                                    </div>
                                    
                                    <div class="form-group form-focus">
                                        <input type="text" class="form-control floating" disabled="" value=" Dob Here">
                                        <label class="focus-label">DOB</label>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Cards -->

                    <!-- Tabs -->
                    <div class="row d-block">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs block-tab nav-tabs-top">
                                <?php
                            $active = 'active';
                            $count = 1;
                            foreach ($specimen_query as $row) {
                        ?>
                                    <li class="nav-item"><a class="nav-link <?php echo $active; ?>" href="#top-tab<?php echo $count; ?>" data-toggle="tab">Specimen <?php echo $count; ?> : RCPath 3</a></li>
                            <?php 
                          $active = '';
                          $count++;
                        } ?>
                                                                     
                                    <li class="pull-right">
                                        <div class="right-btns">
                                            <button class="btn btn-light btn-round ">
                                               ...                             
                                            </button>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="MDT">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"></button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                        <div role="separator" class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#">Separated link</a>
                                                    </div>
                                                </div>
                                            </div>   
                                            <a class="btn btn-primary btn-sicon" href="#">
                                                <img src="<?php echo base_url()?>assets/subassets/img/iconTarget.png">
                                            </a>
                                            <a class="btn btn-primary btn-sicon" href="#">
                                                <i class="fa fa-search"></i>
                                            </a>
                                             <a class="btn btn-primary btn-sicon" href="#">
                                                 <i class="fa fa-link"></i>
                                                 <span class="badge badge-pill">3</span>
                                            </a>
                                        </div>                                     
                                    </li>                                   
                                </ul>
                                <div class="tab-content">

                                <?php
                                        $tabs_active = 'active';
                                        $inner_tab_count = 1;
                                        $specimen_total_count = count($specimen_query);
                                        foreach ($specimen_query as $key => $row) { 
                                            if($inner_tab_count==1){
                                 ?>
                                    <div class="tab-pane show <?php echo $tabs_active; ?>" id="top-tab<?php echo $inner_tab_count; ?>">
                                        <div class="row">
                                            <div class="col-xl-10">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="card doctorCard">
                                                        <textarea class="tinyTextarea"><?php echo $row->specimen_clinical_history; ?></textarea>
                                                         <ul class="tg-themeinputbtn">
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                                                    <label for="specimen_benign_1">BT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                 <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                                                    <label for="specimen_inflammation_1">IN</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                                                    <label for="specimen_atypical_1">AT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                                                    <label for="specimen_malignant_1">MT</label>
                                                                </span>
                                                            </li>
                                                             <li class="pull-right">
                                                                <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="card doctorCard">
                                                        <div class="input-group">
                                                           <span class="input-group-text" id="basic-addon1">
                                                                <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png" align="btn">
                                                            </span>
                                                            <input class="form-control" list="desc" />
                                                                <datalist id="desc">
                                                                  <option value="Macroscopic Description 1">
                                                                  <option value="Macroscopic Description 2">
                                                                  <option value="Macroscopic Description 3">
                                                                  <option value="Macroscopic Description 4">
                                                                  <option value="Macroscopic Description 5">
                                                                </datalist>  
                                                           
                                                        </div>
                                                        <textarea class="form-control" name=""><?php echo $row->specimen_macroscopic_description?></textarea>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card doctorCard">
                                                        <ul>
                                                            <li>
                                                                Patient initial: <?php echo $row->patient_initial?>
                                                            </li>
                                                            <li>
                                                                Surname: <?php echo $row->sur_name?>
                                                            </li>
                                                            <li>
                                                                First Name: <?php echo $row->f_name?>
                                                            </li>
                                                            <li>
                                                                Lab Number: <?php echo $row->lab_number?>
                                                            </li>
                                                           
                                                        </ul>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png" align="btn">
                                                                </span>
                                                            </div>
                                                                <input class="form-control" list="desc" />
                                                                <datalist id="desc">
                                                                  <option value="Macroscopic Description 1" />
                                                                  <option value="Macroscopic Description 2" />
                                                                  <option value="Macroscopic Description 3" />
                                                                  <option value="Macroscopic Description 4" />
                                                                  <option value="Macroscopic Description 5" />
                                                                </datalist>  
                                                           
                                                        </div>
                                                        <textarea class="form-control" name=""><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                                                        <ul class="tg-themeinputbtn">
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                                                    <label for="specimen_benign_1">BT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                                                    <label for="specimen_inflammation_1">IN</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                                                    <label for="specimen_atypical_1">AT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                                                    <label for="specimen_malignant_1">MT</label>
                                                                </span>
                                                            </li>
                                                             <li class="pull-right">
                                                                <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                                                            </li>
                                                        </ul>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12 d-flex">
                                                    
                                                    <select class="form-control">
                                                        <option value="">Diagnosis</option>
                                                        <option value="">Diagnosis</option>
                                                        <option value="">Diagnosis</option>
                                                    </select>
                                                    <button class="btn btn-primary btn-sicon">
                                                        <img src="<?php echo base_url()?>assets/subassets/img/layersIcon.png" />
                                                    </button>
                                                    <button class="btn btn-primary btn-sicon">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                                
                                            </div>
                                <div class="row mb-3">
                                                <div class="col-md-12 d-flex">
                                                <?php
                                    $snomed_t_array = getSnomedCodes('t1');
                                    $snomed_t_id = $row->specimen_snomed_t;
                                    $snomed_t_arr = explode(',', $snomed_t_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_t_array as $snomed_t_code) {
                                            $selected = '';
                                            $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                            if (in_array($snomed_t, $snomed_t_arr)) {
                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_t_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t_code['usmdcode_code'].' '.$snomed_t_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>
                                                    <?php
                                    $snomed_p_array = getSnomedCodes('p');
                                    $snomed_p_id = $row->specimen_snomed_p;
                                    $snomed_p_arr = explode(',', $snomed_p_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_p_array as $snomed_p_code) {
                                            $selected = '';
                                            $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                                            if (in_array($snomed_p, $snomed_p_arr)) {

                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_p_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-pdesc="'.$snomed_p_code['usmdcode_code_desc'].'" value="'.$snomed_p.'" '.$selected.'>'.$snomed_p_code['usmdcode_code'].' '.$snomed_p_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>

                                                    <?php
                                    $snomed_t2_array = getSnomedCodes('t1');
                                    $snomed_t2_id = $row->specimen_snomed_t2;
                                    $snomed_t2_arr = explode(',', $snomed_t2_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_t2_array as $snomed_t2_code) {
                                            $selected = '';
                                            $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t2_code['usmdcode_code'])));
                                            if (in_array($snomed_t, $snomed_t2_arr)) {
                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_t2_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t2_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t2_code['usmdcode_code'].' '.$snomed_t2_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>

                                                    <?php
                                    $snomed_m_array = getSnomedCodes('m');
                                    $snomed_m_id = $row->specimen_snomed_m;
                                    $snomed_m_arr = explode(',', $snomed_m_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_m_array as $snomed_m_code) {
                                            $selected = '';
                                            $snomed_m = strtolower(str_replace(' ', '', trim($snomed_m_code['usmdcode_code'])));
                                            if (in_array($snomed_m, $snomed_m_arr)) {

                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_m_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-rcpath="'.$snomed_m_code['rc_path_score'].'" data-diagnoses="'.$snomed_m_code['snomed_diagnoses'].'" data-mdesc="'.$snomed_m_code['usmdcode_code_desc'].'" value="'.$snomed_m.'" '.$selected.'>'.$snomed_m_code['usmdcode_code'].' '.$snomed_m_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>
                                                </div>                                            
                                            </div>
                                        </div>
                                        <div class="col-xl-2 doctorRCard">
                                            <div class="card mb-0">
                                                <div class="card-body text-muted">
                                                    <span>C2 </span>
                                                </div>
                                            </div>
                                            <div class="card mb-5">
                                                <div class="card-body text-muted">
                                                    <span>C2 </span>
                                                </div>
                                            </div>
                                            <div class="card mb-0">
                                                <div class="card-body pad-0 text-muted">
                                                    <textarea class="form-control">Comments</textarea>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body pad-0 text-muted">
                                                    <textarea class="form-control">Notes</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <?php $inner_tab_count++;}} ?>
                                </div>

                                <?php
                               
                                        $tabs_active = 'active';
                                        $inner_tab_count = 1;
                                        $specimen_total_count = count($specimen_query);
                                       
                                        foreach ($specimen_query as $key => $row) { 
                                            

                                            if($inner_tab_count >1){
                                 ?>
                                    <div class="tab-pane" id="top-tab<?php echo $inner_tab_count?>">
                                    <div class="row">
                                            <div class="col-xl-10">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="card doctorCard">
                                                        <textarea class="tinyTextarea"><?php echo $row->specimen_clinical_history; ?></textarea>
                                                         <ul class="tg-themeinputbtn">
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                                                    <label for="specimen_benign_1">BT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                 <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                                                    <label for="specimen_inflammation_1">IN</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                                                    <label for="specimen_atypical_1">AT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                                                    <label for="specimen_malignant_1">MT</label>
                                                                </span>
                                                            </li>
                                                             <li class="pull-right">
                                                                <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="card doctorCard">
                                                        <div class="input-group">
                                                           <span class="input-group-text" id="basic-addon1">
                                                                <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png" align="btn">
                                                            </span>
                                                            <input class="form-control" list="desc" />
                                                                <datalist id="desc">
                                                                  <option value="Macroscopic Description 1">
                                                                  <option value="Macroscopic Description 2">
                                                                  <option value="Macroscopic Description 3">
                                                                  <option value="Macroscopic Description 4">
                                                                  <option value="Macroscopic Description 5">
                                                                </datalist>  
                                                           
                                                        </div>
                                                        <textarea class="form-control" name=""><?php echo $row->specimen_macroscopic_description?></textarea>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card doctorCard">
                                                        <ul>
                                                        <li>
                                                                Patient initial: <?php echo $row->patient_initial?>
                                                            </li>
                                                            <li>
                                                                Surname: <?php echo $row->sur_name?>
                                                            </li>
                                                            <li>
                                                                First Name: <?php echo $row->f_name?>
                                                            </li>
                                                            <li>
                                                                Lab Number: <?php echo $row->lab_number?>
                                                            </li>
                                                           
                                                        </ul>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="<?php echo base_url()?>assets/subassets/img/iconBtn.png" align="btn">
                                                                </span>
                                                            </div>
                                                                <input class="form-control" list="desc" />
                                                                <datalist id="desc">
                                                                  <option value="Macroscopic Description 1" />
                                                                  <option value="Macroscopic Description 2" />
                                                                  <option value="Macroscopic Description 3" />
                                                                  <option value="Macroscopic Description 4" />
                                                                  <option value="Macroscopic Description 5" />
                                                                </datalist>  
                                                           
                                                        </div>
                                                        <textarea class="form-control" name=""><?php echo trim($row->specimen_microscopic_description); ?></textarea>
                                                        <ul class="tg-themeinputbtn">
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" class="specimen_classification_1" name="specimen_benign" value="benign" type="checkbox" id="specimen_benign_1">
                                                                    <label for="specimen_benign_1">BT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_inflammation" value="inflammation" id="specimen_inflammation_1">
                                                                    <label for="specimen_inflammation_1">IN</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_atypical" value="atypical" id="specimen_atypical_1">
                                                                    <label for="specimen_atypical_1">AT</label>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span class="tg-radio">
                                                                    <input checked="" type="checkbox" class="specimen_classification_1" name="specimen_malignant" value="malignant" id="specimen_malignant_1">
                                                                    <label for="specimen_malignant_1">MT</label>
                                                                </span>
                                                            </li>
                                                             <li class="pull-right">
                                                                <i class="fa fa-dot-circle-o mt-2 mr-2"></i>
                                                            </li>
                                                        </ul>
                                                    </div>                                            
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12 d-flex">
                                                    
                                                    <select class="form-control">
                                                        <option value="">Diagnosis</option>
                                                        <option value="">Diagnosis</option>
                                                        <option value="">Diagnosis</option>
                                                    </select>
                                                    <button class="btn btn-primary btn-sicon">
                                                        <img src="<?php echo base_url()?>assets/subassets/img/layersIcon.png" />
                                                    </button>
                                                    <button class="btn btn-primary btn-sicon">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </div>
                                                
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12 d-flex">
                                                    
                                                <?php
                                    $snomed_t_array = getSnomedCodes('t1');
                                    $snomed_t_id = $row->specimen_snomed_t;
                                    $snomed_t_arr = explode(',', $snomed_t_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_t_array as $snomed_t_code) {
                                            $selected = '';
                                            $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t_code['usmdcode_code'])));
                                            if (in_array($snomed_t, $snomed_t_arr)) {
                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_t_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t_code['usmdcode_code'].' '.$snomed_t_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>
                                                    <?php
                                    $snomed_p_array = getSnomedCodes('p');
                                    $snomed_p_id = $row->specimen_snomed_p;
                                    $snomed_p_arr = explode(',', $snomed_p_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_p_array as $snomed_p_code) {
                                            $selected = '';
                                            $snomed_p = strtolower(str_replace(' ', '', trim($snomed_p_code['usmdcode_code'])));
                                            if (in_array($snomed_p, $snomed_p_arr)) {

                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_p_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-pdesc="'.$snomed_p_code['usmdcode_code_desc'].'" value="'.$snomed_p.'" '.$selected.'>'.$snomed_p_code['usmdcode_code'].' '.$snomed_p_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>

                                                    <?php
                                    $snomed_t2_array = getSnomedCodes('t1');
                                    $snomed_t2_id = $row->specimen_snomed_t2;
                                    $snomed_t2_arr = explode(',', $snomed_t2_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_t2_array as $snomed_t2_code) {
                                            $selected = '';
                                            $snomed_t = strtolower(str_replace(' ', '', trim($snomed_t2_code['usmdcode_code'])));
                                            if (in_array($snomed_t, $snomed_t2_arr)) {
                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_t2_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-tdesc="'.$snomed_t2_code['usmdcode_code_desc'].'" value="'.$snomed_t.'" '.$selected.'>'.$snomed_t2_code['usmdcode_code'].' '.$snomed_t2_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>

                                                    <?php
                                    $snomed_m_array = getSnomedCodes('m');
                                    $snomed_m_id = $row->specimen_snomed_m;
                                    $snomed_m_arr = explode(',', $snomed_m_id);
                                ?>
                                                    <select class="form-control">
                                                    <?php
                                        foreach ($snomed_m_array as $snomed_m_code) {
                                            $selected = '';
                                            $snomed_m = strtolower(str_replace(' ', '', trim($snomed_m_code['usmdcode_code'])));
                                            if (in_array($snomed_m, $snomed_m_arr)) {

                                                $selected = 'selected';
                                            }
                                            $added_by = '';
                                            if($snomed_m_code['snomed_added_by'] === $user_id){
                                                $added_by = 'snomed_provisional';
                                            }
                                            echo '<option class="'.$added_by.'" data-rcpath="'.$snomed_m_code['rc_path_score'].'" data-diagnoses="'.$snomed_m_code['snomed_diagnoses'].'" data-mdesc="'.$snomed_m_code['usmdcode_code_desc'].'" value="'.$snomed_m.'" '.$selected.'>'.$snomed_m_code['usmdcode_code'].' '.$snomed_m_code['usmdcode_code_desc'].'</option>';
                                        }
                                    ?>
                                                    </select>
                                                </div>                                            
                                            </div>
                                        </div>
                                    </div>
                                            <?php } $inner_tab_count++;} ?>
                                   
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <!-- Tabs -->

                    <div class="row">
                        <!-- Buttons Container -->
                        <div class="page-buttons">
                            <button class="btn btn-light">
                                <i class="fa fa-dot-circle-o mr-3"></i>
                                Lab: 
                                <span class="badge badge-pill bg-blue">3</span>
                            </button>

                            <button class="btn btn-light">
                                <i class="fa fa-dot-circle-o"></i>
                                Secretary: 
                                <span class="badge badge-pill bg-blue">3</span>
                            </button>

                            <button class="btn btn-light">                            
                                Error Log: 
                                <span class="badge badge-pill bg-blue">3</span>
                            </button>
                           
                            <button class="btn btn-light">
                                <span class="badge badge-pill bg-blue">3</span>
                                Primary Doctors                             
                            </button>

                            <button class="btn btn-light">
                                <span class="badge badge-pill bg-blue">3</span>
                                Others                             
                            </button>
                            <button class="btn btn-light">
                                <span class="badge badge-pill bg-blue">3</span>
                                GI                            
                            </button>
                            <button class="btn btn-light">
                                <span class="badge badge-pill bg-blue">3</span>
                                Others                             
                            </button>
                            <button class="btn btn-primary btn-sm btn-round">
                               <i class="fa fa-arrow-right"></i>                             
                            </button>

                            <button type="button" class="btn btn-primary btn-lg pull-right">Update Record</button>
                        </div>
                    </div>
                    <!-- /Buttons Container -->
                    </div>

                </div>
                <!-- /Page Content --></div>
                    </div></div>