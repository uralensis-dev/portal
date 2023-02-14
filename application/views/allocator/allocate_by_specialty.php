<!-- Page Header -->
<style>
.modal-dialog-full-width {
    width: 90% !important;
    height: 95% !important;
    margin: 0 auto !important;
    padding: 0 !important;
    max-width: none !important;
}

.modal-content-full-width {
    height: auto !important;
    min-height: 90% !important;
    border-radius: 10px !important;
    background-color: #f7f7f7 !important;
    margin-top: 50px;
}

.modal-header-full-width {
    border-bottom: 1px solid #9ea2a2 !important;
}

.modal-footer-full-width {
    border-top: 1px solid #9ea2a2 !important;
}

.small-text {
    font-size: 0.75rem;
}

.t-code-btn {
    margin-bottom: 5px;
    border-radius: 15px;
}
.py-10{padding-top: 10px; padding-bottom: 10px;}

select.form-control {
    background-color: #f7f7f7;
}

.next-day-btn, .date-found {
    float: right;
}

.prev-day-btn {
    float: left;
}

.assign-doctor-header, .assign-doctor-footer {
    height: 15px;
}

.selected-doctor {
    border: 3px solid green !important;
}

.table .team-members > li > a {
    width: 48px;
    height: 48px;
}

.rc-path-points {
    font-size: 0.70rem;
    margin: auto;
    display: block;
    text-align: center;
}

strike {
    color: red;
}

.text-green {
    color: green;
}

.table .team-members > li > a {
    margin-left: 5px;
}

.assign-to-doctor {
    min-width: 150px;    
    margin-top: 15px;
}

</style>


<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Allocate Requests</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Institute</a></li>
                <li class="breadcrumb-item active">Allocate Requests</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <!--            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Project</a>-->
            <div class="view-icons">
                <!--                <a href="projects.html" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>-->
                <!--                <a href="project-list.html" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>-->
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->
<?php if ($this->session->flashdata('allocation_success')): ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert ml-0 alert-success bg-success alert-dismissible fade show" role="alert">
            <b><?php echo  $this->session->flashdata('allocation_success'); ?></b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if ($this->session->flashdata('allocation_warning')): ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert ml-0 alert-warning bg-warning alert-dismissible fade show" role="alert">
            <b><?php echo  $this->session->flashdata('allocation_warning'); ?></b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <?php if (!empty($group_menu)): ?>
    <?php $this->load->view('/allocator/partials/group_menu', $group_menu); ?>
    <?php endif; ?>
    <div class="col-sm-12 col-md-<?php echo  empty($group_menu) ? 12 : 9; ?>">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>From Date</th>
                        <th>Specialty</th>
                        <th>Cases</th>
                        <th>RCPath</th>
                        <th class="text-right">Allocate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests_by_specialty as $specialty): ?>
                    <tr>
                        <td><?php echo  $specialty->from_date; ?></td>
                        <td><a
                                href="<?php echo  site_url('allocator/ready_to_allocate/' . $specialty->speciality_id.'/'.$hospital_id); ?>"><?php echo  $specialty->specialty; ?></a>
                        </td>
                        <td><?php echo  $specialty->cases; ?></td>
                        <td><?php echo  $specialty->rcpath; ?></td>
                        <!-- <td class="text-right"><a href="<?php echo  site_url('/allocator/allocate_specialty_old/' . $specialty->speciality_id.'/'.$hospital_id); ?>" class="btn btn-link text-success">
                                <i class="fa fa-arrow-right"></i>
                            </a></td> -->
                        <td class="text-right"><a data-toggle="modal" onclick = "openAllocateModal([<?php echo $specialty->speciality_id.', '.$hospital_id; ?>], '<?php echo $specialty->specialty; ?>')" data-target="#allocateCaseModal"
                                class="btn btn-link text-success">
                                <i class="fa fa-arrow-right"></i>
                            </a></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (!empty($requests_needing_attention)): ?>
                    <tr>
                        <td><?php echo  $requests_needing_attention->from_date; ?></td>
                        <td><a href="<?php echo  site_url('/allocator/needs_attention/'.$hospital_id); ?>"
                                class="text-warning"><i class="fa fa-exclamation-triangle"></i> Needs Attention</a></td>
                        <td><?php echo  $requests_needing_attention->cases; ?></td>
                        <td><?php echo  $requests_needing_attention->rcpath; ?></td>
                        <td class="text-right"> &nbsp;</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade right" id="allocateCaseModal" tabindex="-1" role="dialog"
    aria-labelledby="allocateCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width   modal-header text-center">
                <h3 class="modal-title w-100" id="allocateCaseModalLabel">Allocate <span id="specialty-heading">Heamtopathology</span> Case</h3>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span style="font-size: 1.3em;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <table class="table" id="allocate-table" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Case #</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Date Requested</th>
                            <th scope="col">Specimen Count</th>
                            <th scope="col">Specimen T Codes</th>
                            <th scope="col">RCPathPoints</th>
                            <!-- <th scope="col">Avaiable Doctor</th>
                            <th scope="col">Assign To</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- TEMPLATE FOR TABLE ROW -->
                    <script id="allocate-table-row-template" type="text/x-custom-template">
                        <tr>
                            <th scope="row row-index">1</th>
                            <td class="row-serial-number">UL-0000-0000</td>
                            <td class="row-date-requested"> <span class="row-date-requested-date">20-04-2020</span> <br><span  class="small-text row-days-ago" ><strong>5</strong> days ago</span></td>
                            <td class="row-specimen-count">3</td>
                            <td class="row-t-codes">
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                            </td>
                            <td class="row-rc-path-points">27</td>
                        </tr>
                    </script>
                    <tr>
                            <th scope="row row-index">1</th>
                            <td class="row-serial-number">UL-0000-0000</td>
                            <td class="row-date-requested"> <span class="row-date-requested-date">20-04-2020</span> <br><span  class="small-text row-days-ago" ><strong>5</strong> days ago</span></td>
                            <td class="row-specimen-count">3</td>
                            <td class="row-t-codes">
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                            </td>
                            <td class="row-rc-path-points">27</td>
                            
                        </tr>
                        <tr>
                            <th scope="row row-index">1</th>
                            <td class="row-serial-number">UL-0000-0000</td>
                            <td class="row-date-requested"> <span class="row-date-requested-date">20-04-2020</span> <br><span  class="small-text row-days-ago" ><strong>5</strong> days ago</span></td>
                            <td class="row-specimen-count">3</td>
                            <td class="row-t-codes">
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                            </td>
                            <td class="row-rc-path-points">27</td>
                            
                        </tr>
                        <tr>
                            <th scope="row row-index">1</th>
                            <td class="row-serial-number">UL-0000-0000</td>
                            <td class="row-date-requested"> <span class="row-date-requested-date">20-04-2020</span> <br><span  class="small-text row-days-ago" ><strong>5</strong> days ago</span></td>
                            <td class="row-specimen-count">3</td>
                            <td class="row-t-codes">
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                            </td>
                            <td class="row-rc-path-points">27</td>
                            
                        </tr>
                        <tr>
                            <th scope="row row-index">1</th>
                            <td class="row-serial-number">UL-0000-0000</td>
                            <td class="row-date-requested"> <span class="row-date-requested-date">20-04-2020</span> <br><span  class="small-text row-days-ago" ><strong>5</strong> days ago</span></td>
                            <td class="row-specimen-count">3</td>
                            <td class="row-t-codes">
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                            </td>
                            <td class="row-rc-path-points">27</td>
                            
                        </tr>
                        <tr>
                            <th scope="row row-index">1</th>
                            <td class="row-serial-number">UL-0000-0000</td>
                            <td class="row-date-requested"> <span class="row-date-requested-date">20-04-2020</span> <br><span  class="small-text row-days-ago" ><strong>5</strong> days ago</span></td>
                            <td class="row-specimen-count">3</td>
                            <td class="row-t-codes">
                                <button data-toggle="tooltip" data-placement="right" title = "Desc" type="button" class="btn btn-success btn-sm t-code-btn">T-0011</button>
                            </td>
                            <td class="row-rc-path-points">27</td>
                            
                        </tr>


                        
                    </tbody>
                </table>

                
            </div>
            <div class="modal-footer-full-width  modal-footer">
                <div class="col">
                    <div class="row">
                        <div class="col-md-1 py-10"><i class="fa fa-arrow-right text-success"></i></div>
                        <div class="col-md-5">
                            <select class="form-control select2">
                                <option selected disabled>Available Doctor</option>
                                <option>Dr. Chaudhry</option>
                                <option>Dr. Robin</option>
                                <option>Dr. ABC</option>
                                <option>Dr. XYZ</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control select2">
                                <option selected disabled>Assign To</option>
                                <option>Dr. Chaudhry</option>
                                <option>Dr. Robin</option>
                                <option>Dr. ABC</option>
                                <option>Dr. XYZ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary pull-right btn-md btn-rounded">Save changes</button>    
                    <button type="button" class="btn btn-danger pull-right btn-md btn-rounded" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->