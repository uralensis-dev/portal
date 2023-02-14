<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />  -->
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" /> 
<link rel="stylesheet" href="http://localhost/pci/assets/newtheme/css/style.css">
<style type="text/css">
    .page-header {
        margin:0 0 1.875rem;
        border-bottom:0px;
    }
    .content{background: #f5f5f5}
    
    /*div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-58px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }*/
    /*div.dataTables_wrapper div.dataTables_filter{display: none !important}*/
    div.dataTables_wrapper div.dataTables_length select{
        padding: 0 8px;
    }
    table.dataTable thead > tr > th{font-weight: 600 !important;}
    .edit_icon {
        background: #e5e5e5;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 1.7;
        font-size: 18px;
        border-radius: 15px;
        cursor: pointer;
        color: #000;
    }
    .add-btn {
        background-color: #00c5fb;
        border: 1px solid #00c5fb;
        border-radius: 3px !important;
        color: #fff;
        float: right;
        font-weight: 500 !important;
        min-width: 140px;
        font-size: 16px;
    }
    .add-btn:hover,
    .add-btn:focus{
        color: #fff !important;
    }
    .add-btn i {
        margin-right: 5px;
    }

    .card-body a{color: #000;}
	.dash-card-content p{
		font-size: 16px;
	}
 .left-box-info {
    width: 70%;
    text-align: left;
    float: left;
    padding-left: 20px;
}
.right-box-user {
    width: 30%;
    float: right;
}
.left-box-info p {
    width: 100%;
    text-align: left;
    margin-bottom: 5px;
    color: #5e5e5e;
}
.left-box-info h4 {
    color: #000;
    font-weight: 800;
    font-size: 16px;
}
.left-box-info p a {
    color: #5e5e5e;
    text-decoration: none;
}
    /*div.dataTables_wrapper div.dataTables_filter label{
    margin: 0;
        }

        .tg-searchrecordhold{padding: 0;}

    .user_image{
        width: 50px;
        border-radius: 30px;
    }
    div.dataTables_wrapper div.dataTables_filter {
        position: relative;
        top: -52px;
        right: 60px;
        max-width: 210px;
        float: right;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border-radius: 4px;
        height: 37px !important;
    }
    div.dataTables_wrapper div.dataTables_filter:before {
        content: "\f002";
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 40px;
        z-index: 9;
        background: #55ce63;
        text-align: center;
        line-height: 2;
        color: #fff;
        font-family: 'FontAwesome';
        cursor: pointer;
    }
    .dataTables_wrapper .row:first-child{height: 1px;}
    
    .doct_pic_table{
        width: 40px;
        float: left;
        border-radius: 20px;
        margin-right: 5px;
    }*/
    /*.table.custom-table .dropdown-menu .dropdown-item{font-size: 14px;}*/
    /*.ubpub_pic{width: 25px; margin: 0 auto;}
    .record_id_unpublish:focus{outline: none;}
    .user-menu.nav > li > a > img{padding-top: 19px;}
    #admin_display_records.table > thead > tr > th:last-child,
    #admin_display_records.table > tbody > tr > td:last-child{
        text-align: right;
    }*/
    /*div.dataTables_wrapper div.dataTables_length select{
        padding: 0 10px;
    }*/
    /*.tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 40px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
        margin-left: 2px;
    }*/
    /*div.dataTables_wrapper .dataTables_filter {
        display: block !important;
    }
    @media screen and (min-width: 1480px){
        div.dataTables_wrapper div.dataTables_filter{
            top:-58px;
            right: 70px;
        }
    }*/
    /*.tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label{font-size: 14px;}
    .tg-filters > li.last .adv-search{line-height: 1.5;}
    .viewerCount {
        font-size: 18px;
        color: darkturquoise;
    }*/
</style>
<div class="page-header breadcrimsetup">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title m-0">Risk Register and Document</h3>
            <div class="tg-breadcrumbarea">
            <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                <li class=""><a href="<?php echo base_url(); ?>">Dashboard</a></li>
               
</ol> 
</div>
        </div>
        <div class="col-auto float-right ml-auto">
            <div class="tg-breadcrumbarea tg-searchrecordhold hidden">
            <?php echo $breadcrumbs; ?>
            <div class="tg-rightarea">
                <div class="tg-haslayout">
                    <div class="row hidden">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding-right">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters ">
                                    <li class="tg-statusbar tg-flagcolor" style="padding-right: 10px !important;">
                                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                            <?php $hospitals = getAllHospitals(); ?>
                                            <?php foreach($hospitals as $hospital): ?>
                                            <span title="<?php echo $hospital['description']?>" class="tg-radio tg-flagcolor1">
                                                <input value="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>" class="filter_by_hospital_btn" name="hostpital" id="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>"  type="radio">
                                                <label for="<?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?>"><span><?php echo $hospital['first_initial']?><?php echo $hospital['last_initial']?></span></label>
                                            </span>
                                            <?php endforeach; ?>
                                            <span title="All" class="tg-cancel tg-flagcolor1" style="display: none;">
                                                <input value="0" class="filter_by_hospital_btn" name="hostpital" id="aa"  type="radio">
                                                <label for="aa"><span><img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll"></span></label>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
               
            
        </div>
    </div>
</div>
<!-- /Page Header -->


<div class="row">
         <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
         <a href="<?php echo base_url('Document_List'); ?>">
            <div class="card dash-widget">
                <div class="card-body">
                    <!-- <span class="dash-widget-icon"></span> -->
                   <span class="dash-widget-icon">
                   <i class="la la-network-wired"></i>
                    </span>
                    <div class="dash-widget-info">
                        <h3><?php echo $total_document;  ?></h3>
                        <span>Document</span>
                    </div>
                </div>
            </div>
            </a>
        </div> 
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <a href="<?php echo base_url('Risk_Register'); ?>">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon"><i class="fa fa-hospital-o"></i></span>
                    <div class="dash-widget-info">
                        <h3><?php echo $total_risk;  ?></h3>
                        <span>Risk Register</span>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <a href="javascript:;">
            <div class="card dash-widget">
                <div class="card-body">
                    <span class="dash-widget-icon">
                        <img src="<?php echo base_url();?>assets/icons/laboratory_icon.png" class="img-fluid"/>
                    </span>
                    <div class="dash-widget-info">
                        <h3>19</h3>
                        <span>Audits</span>
                    </div>
                </div>
            </div>
            </a>
        </div>
     
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
        <a href="<?php echo base_url('Quality_Improvement'); ?>">
            <div class="card dash-widget">
                <div class="card-body">
                <span class="dash-widget-icon">
                    <img src="<?php echo base_url('assets/icons/pathologist.svg'); ?>" class="img-fluid"/>
                </span>
                    <div class="dash-widget-info">
                        <h3>234</h3>
                        <span>Quality Improvement</span>                   
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>


    <div class="row">
    <div class="col-md-6">
        <div class="card card-table flex-fill">
                
                <div class="card-body" style="min-height: 344px">
                    <div class="table-responsive">
                        <table class="table table-striped table-padding custom-table mb-0">
                            <thead>
                            <tr>
                                <th>My Document</th> 
								<th>Description</th> 
								<th>Share Date</th>  	
                                <th align="center">Renewal/ Review</th>
                               
                                
                            </tr>
                            </thead>
                            <tbody>
								<?php foreach($last5_document as $row){  ?>
							
                                <tr>
                                  <td><a href="#" class="avatar"><img alt="" src="<?php echo base_url($row['profile_picture_path']) ?>"></a><?= $row['document_title']; ?><strong>  </strong></td>
								  <td><?php echo $row['sdescription'];  ?></td>
								  <td align="center"><?php echo date("d/m/Y",strtotime($row['sdate'])); ?></td>
                                   
                                <td align="center"><?php echo date("d/m/Y",strtotime($row['date_of_next_review'])); ?></td>
                                    </tr>
								<?php } ?>	
                                   
                
                            </tbody>
                        </table>
                    </div>
                </div>
              
            </div>
        </div>
		


 <div class="col-md-6">
<div class="profile-widget">
    <div class="left-box-info">
        <h3>Quality Manager</h3>
        <h4><?php echo $user_info->first_name.' '.$user_info->last_name; ?></h4>
       
        <p><a href="mailto:<?php echo $user_info->email; ?>"><?php echo $user_info->email; ?></a></p>
       
       

    </div>
    <div class="right-box-user">
                    <div class="profile-img">
                        <a href="" class="avatar">
                            <img src="<?php echo $user_info->profile_picture_path; ?>" alt="">
                        </a>
                    </div>
                   
                    </div>
    </div>




	</div>
  </div>





<?php if ($this->session->flashdata('upload_error') != '') { ?>
    <div class="error_list" style="color: red;">
        <?= $this->session->flashdata('upload_error'); ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('upload_success') != '') { ?>
    <div class="success_list" style="color: green;">
        <?= $this->session->flashdata('upload_success'); ?>
    </div>
<?php } ?>

<div class="">
    


<div id="add_doc" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">New Document</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tg-editformholder">
                    <?php echo form_open_multipart('documents/upload_files', array('class' => 'tg-formtheme tg-editform', 'id' => 'upload_document_form', 'name' => 'upload_document_form')); ?>
                    <?php //echo form_open('', array('id' => 'add-patient-form', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <!-- Patient Personal Information START -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <input type="text" name="name" value="" class="form-control" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="assign_to" id="" class="form-control" required>
                                            <option value="">Assigned To</option>
                                            <option value="Hospital">Hospital</option>
                                            <option value="Laboratory">Laboratory</option>
                                            <option value="Pathologist">Pathologist</option>
                                            <option value="Clinician">Clinician</option>
                                            <option value="All">All</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <input type="file" name="upload_doc" class="form-control" placeholder="Upload pdf | doc | jpg | png">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="tg-inputwithicon">
                                            <select name="file_type" value="" class="form-control" required>
                                                <option value="SOP Form">SOP's</option>
                                                <option value="Request Form">Request Form</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group1">
                                            <button class="btn btn-success" id="user-create-btn">Uplaod Document</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>

                            </fieldset>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



