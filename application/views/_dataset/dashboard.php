<?php
$hospital = getAllHospitals();
$specialty = getSpecialty();
?>

<style type="text/css">
    .btn-default {
        background: #f5f5f5;
        line-height: 1;
        min-height: auto !important;
        padding: 8px 10px !important;
    }
</style>

<!-- Page Header -->

<div class="page-header">
    <div class="row">
        <div class="col-sm-10">
            <h3 class="page-title">Datasets</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Datasets</li>
            </ul>
        </div>
        <div class="col-sm-2 text-right float-right ml-auto">
            <a href="javascript:;" class="btn btn-primary btn-lg btn-rounded" data-toggle="modal" data-target="#create_dataset"><i class="fa fa-plus"></i> Create Dataset</a>

        </div>
    </div>
</div>


<!-- /Page Header -->



<!-- Search Filter -->

<form action="<?php echo site_url('_dataset/dataset/dashboard/'); ?>" method="GET" accept-charset="utf-8">

    <div class="row filter-row">

        <div class="col-sm-6 col-md-3">  

            <div class="form-group form-focus">

                <input type="text" class="form-control" name="dataset_name">

                <label class="focus-label">Dataset Name</label>

            </div>

        </div>

        <div class="col-sm-6 col-md-3">  

            <div class="form-group form-focus select-focus">

                <select class="select floating"  name='hospital_id'> 

                    <option value="">Select Hospital</option>

                    <?php foreach ($hospital as $hospitals): ?>

                        <option value='<?php echo $hospitals['id']; ?>'><?php echo $hospitals['name'] ?></option>

                    <?php endforeach; ?>

                </select>

                <label class="focus-label">Hospital</label>

            </div>

        </div>

        <div class="col-sm-6 col-md-3"> 

            <div class="form-group form-focus select-focus">

                <select class="select floating"  name='specialty_id'>

                    <option value="">Select Specialty</option>

                    <?php foreach ($specialty as $specialties): ?>

                        <option value='<?php echo $specialties['id']; ?>'><?php echo $specialties['name'] ?></option>

                    <?php endforeach; ?>

                </select>

                <label class="focus-label">Specialty</label>

            </div>

        </div>

        <div class="col-sm-6 col-md-2">  

            <button type='submit' class="btn btn-success btn-block"> Search </button>  

        </div>     

        <div class="col-sm-6 col-md-1">  

            <a href="<?php echo site_url('_dataset/dataset/dashboard') ?>" class="btn btn-success btn-block" style="padding:0"> <img src="<?php echo base_url('uploads/res-removebg-preview.png') ?>" style="width: 50px;"> </a>  


        </div>     

    </div>

</form>

<!-- Search Filter -->



<?php
if ($this->session->flashdata('inserted') === true) {

    $type = $this->session->flashdata('type');

    if (!isset($type) && $type == '') {

        $type = "success";
    }
    ?>

    <div class="row">



        <div class="col-lg-12">



            <div class="alert-<?php echo $type; ?> " role="alert" style="padding: 14px;margin: 10px 0px;">

                <strong><?php echo $this->session->flashdata('tckSuccessMsg'); ?></strong>



                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

        </div>

    </div>

<?php } else if ($this->session->flashdata('error') === true) {
    ?>

    <div class="row">



        <div class="col-lg-12">



            <div class="alert-danger alert-dismissible" role="alert" style="padding: 14px;margin: 10px 0px;">

                <strong>Something went wrong, try again. <?php echo $this->session->flashdata('error_msg') ?></strong>



                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

        </div>

    </div> 

<?php }
?>

<div class="row">

    <?php
//    _print_r($datasetList); 
    foreach ($datasetList as $dataset):
        if ($dataset['parent_dataset_id'] == 0) {
            ?>



            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">

                <div class="card">

                    <div class="card-body">

                        <div class="dropdown dropdown-action profile-action">

                            <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                            <div class="dropdown-menu dropdown-menu-right">

                                                                <!--<a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#edit_dataset" data-dataset='<?php echo $dataset['dataset_id']; ?>'><i class="fa fa-pencil m-r-5"></i> Edit</a>-->
                                <a class="dropdown-item edit_btn" href="#" 
                                   data-dataset_id='<?php echo $dataset['dataset_id'] ?>'
                                   data-dataset_name='<?php echo $dataset['dataset_name'] ?>'
                                   data-hospital_id='<?php echo $dataset['hospital_id'] ?>'
                                   data-speciality_id='<?php echo $dataset['specialty_id'] ?>'
                                   data-parent_dataset_id='<?php echo $dataset['parent_dataset_id'] ?>'><i class="fa fa-pencil m-r-5"></i> Edit</a>

                <!--                            <a class="dropdown-item" onclick="javascript:strartDelete(this);" data-toggle="modal" data-target="#delete_dataset" data-dataset='<?php echo $dataset['dataset_id']; ?>'><i class="fa fa-trash-o m-r-5"></i> Delete</a>-->

                            </div>

                        </div>

                        <h4 class="dataset-title"><strong><?= $dataset['pDatasetName'] ?></strong> &#8594;  <?php echo $dataset['dataset_name'] ?></h4>





                        <div class="pro-deadline m-b-15">

                            <div class="sub-title">

                                Created At & Owner:

                            </div>

                            <div class="text-muted">

                                <?php echo date('d M Y', strtotime($dataset['created_at'])) ?> 

                                <?php
                                $userCreated = $this->datasets->getUserDetails($dataset['created_by']);

                                echo $userCreated[0]['enc_first_name'] . ' ' . $userCreated[0]['enc_last_name'];
                                ?>

                            </div>

                        </div>

                        <div class="dataset-members m-b-15">

                            <h4>Hospital</h4>
                            <p><?php echo $dataset['hospital'] ?></p>

                        </div>

                        <div class="dataset-members m-b-15">

                            <h4>Specialty</h4>
                            <p><?php echo $dataset['specialty'] ?></p>

                        </div>

                        <!--                    <div class="dataset-members m-b-15">
                        <?php if ($dataset['dataset_name'] == 'Breast Cancer DataSet') { ?>
                                                            <a href="<?php echo site_url($dataset['data_set_performa']) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Tumour Board Pathology Cancer Dataset </a>
                        <?php } else if ($dataset['dataset_name'] == 'Basal Cell Dataset') { ?>
                                                            <a href="<?php echo site_url($dataset['data_set_performa']) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Cutaneous Basal Cell Carcinoma </a>
                        <?php } ?>
                        
                                            </div>-->

                    </div>

                </div>

            </div>
            <?php
            foreach ($datasetList as $datasetC):
                if ($datasetC['parent_dataset_id'] == $dataset['dataset_id']) {
                    ?>



                    <div class="col-lg-2">

                        <div class="card">

                            <div class="card-body">

                                <div class="dropdown dropdown-action profile-action">

                                    <a href="javascript:;" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>

                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="dropdown-item edit_btn" href="#" 
                                           data-dataset_id='<?php echo $datasetC['dataset_id'] ?>'
                                           data-dataset_name='<?php echo $datasetC['dataset_name'] ?>'
                                           data-hospital_id='<?php echo $datasetC['hospital_id'] ?>'
                                           data-speciality_id='<?php echo $datasetC['specialty_id'] ?>'
                                           data-parent_dataset_id='<?php echo $datasetC['parent_dataset_id'] ?>'><i class="fa fa-pencil m-r-5"></i> Edit</a>

                                    </div>

                                </div>

                                <h4 class="dataset-title"><?php echo $datasetC['dataset_name'] ?></h4>





                                <div class="pro-deadline m-b-15">

                                    <div class="sub-title">

                                        Created At & Owner:

                                    </div>

                                    <div class="text-muted">

                                        <?php echo date('d M Y', strtotime($datasetC['created_at'])) ?> 

                                        <?php
                                        $userCreated = $this->datasets->getUserDetails($datasetC['created_by']);

                                        echo $userCreated[0]['enc_first_name'] . ' ' . $userCreated[0]['enc_last_name'];
                                        ?>

                                    </div>

                                </div>

                                <div class="dataset-members m-b-15">

                                    <h4>Hospital</h4>
                                    <p><?php echo $datasetC['hospital'] ?></p>

                                </div>

                                <div class="dataset-members m-b-15">

                                    <h4>Specialty</h4>
                                    <p><?php echo $datasetC['specialty'] ?></p>

                                </div>


                            </div>

                        </div>

                    </div>

                <?php } endforeach; ?>

            <div class="col-sm-12"><hr></div>

        <?php } endforeach; ?>

</div>



<!-- Create Dataset Modal -->

<div id="create_dataset" class="modal custom-modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Create Dataset</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <?php
                $attributes = array('method' => 'POST', 'enctype' => "multipart/form-data", "id" => 'cst-dataset-form');

                echo form_open("_dataset/dataset/saveData/", $attributes);
                ?>



                <div class="row">

                    <div class="col-sm-12">

                        <div class="form-group">

                            <label>Dataset Name</label>

                            <input type="text" name="dataset_name" required class="form-control">

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="form-group">

                            <label>Hospital</label>

                            <select class="select floating"  name='hospital_id'> 

                                <option value="">Select Hospital</option>

                                <?php foreach ($hospital as $hospitals): ?>

                                    <option value='<?php echo $hospitals['id']; ?>'><?php echo $hospitals['name'] ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="form-group">

                            <label>Specialty</label>

                            <select class="select floating"  name='specialty_id'>

                                <option value="">Select Specialty</option>

                                <?php foreach ($specialty as $specialties): ?>

                                    <option value='<?php echo $specialties['id']; ?>'><?php echo $specialties['name'] ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>


                    <div class="col-sm-12"> 

                        <div class="form-group form-focus select-focus">

                            <select class="select floating"  name='parent_dataset_id'>

                                <option value="">Select Parent Dataset</option>

                                <?php foreach ($datasetList as $row): ?>

                                    <option value='<?php echo $row['dataset_id']; ?>'><?php echo $row['dataset_name'] ?></option>

                                <?php endforeach; ?>

                            </select>

                            <label class="focus-label">Parent Dataset</label>

                        </div>

                    </div>

                </div>


                <div class="submit-section">

                    <button type='submit' class="btn btn-primary submit-btn" id='cst-add-form-btn'>Submit</button>

                </div>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- /Create Dataset Modal -->



<!-- Delete Dataset Modal -->

<div class="modal custom-modal fade" id="delete_dataset" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">

                <div class="form-header">

                    <h3>Delete Dataset</h3>

                    <p>Are you sure want to delete? <br> All tasks in the Dataset will be Removed as well.</p>

                </div>

                <div class="modal-btn delete-action">

                    <div class="row">

                        <div class="col-6">

                            <?php
                            $attributes = array('method' => 'POST', 'id' => "deleteDataset");

                            echo form_open("_dataset/dataset/removeDataset/", $attributes);
                            ?>

                            <input type='hidden' id='dataset_id' name='dataset_id' value=''/>

                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id='cnfrmDelete'>Delete</a>

                            </form>

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

<!-- /Delete Dataset Modal -->


<!-- Edit Dataset Modal -->
<div id="edit_dataset" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Update Dataset</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <?php
                $attributes = array('method' => 'POST', 'enctype' => "multipart/form-data", "id" => 'cst-dataset-form');

                echo form_open("_dataset/dataset/saveData/", $attributes);
                ?>
                <input type="hidden" name="dataset_id" id="edit_dataset_id" class="edit_dataset_id" value="">



                <div class="row">

                    <div class="col-sm-12">

                        <div class="form-group">

                            <label>Dataset Name</label>

                            <input type="text" name="dataset_name" id="dataset_name" required class="form-control">

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="form-group">

                            <label>Hospital</label>

                            <select class="select floating"  name='hospital_id'  id='hospital_id'> 

                                <option value="">Select Hospital</option>

                                <?php foreach ($hospital as $hospitals): ?>

                                    <option value='<?php echo $hospitals['id']; ?>'><?php echo $hospitals['name'] ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-sm-6">

                        <div class="form-group">

                            <label>Specialty</label>

                            <select class="select floating"  name='specialty_id'  id='specialty_id'>

                                <option value="">Select Specialty</option>

                                <?php foreach ($specialty as $specialties): ?>

                                    <option value='<?php echo $specialties['id']; ?>'><?php echo $specialties['name'] ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>


                    <div class="col-sm-12"> 

                        <div class="form-group form-focus select-focus">

                            <select class="select floating"  name='parent_dataset_id'  id='parent_dataset_id'>

                                <option value="">Select Parent Dataset</option>

                                <?php foreach ($datasetList as $row): ?>

                                    <option value='<?php echo $row['dataset_id']; ?>'><?php echo $row['dataset_name'] ?></option>

                                <?php endforeach; ?>

                            </select>

                            <label class="focus-label">Parent Dataset</label>

                        </div>

                    </div>

                </div>


                <div class="submit-section">

                    <button type='submit' class="btn btn-primary submit-btn" id='cst-add-form-btn'>Submit</button>

                </div>

                </form>

            </div>

        </div>

    </div>
</div>
<!-- /Edit Dataset Modal -->