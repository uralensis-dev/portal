<!-- Page Header -->
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
    <div class="col-sm-12 col-md-12">
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
                        <td><a href="<?php echo site_url('institute/allocated_requests/'.$specialty->specialty_id);?>"><?php echo  $specialty->specialty; ?></a></td>
                        <td><?php echo  $specialty->cases; ?></td>
                        <td><?php echo  $specialty->rcpath; ?></td>
                        <td class="text-right"><a href="<?php echo  site_url('/institute/allocate_specialty/' . $specialty->specialty_id); ?>" class="btn btn-link text-success">
                                <i class="fa fa-arrow-right"></i>
                            </a></td>
                    </tr>
                <?php endforeach; ?>
                <?php if(!empty($requests_needing_attention)):?>
                <tr>
                    <td><?php echo  $requests_needing_attention->from_date; ?></td>
                    <td><a href="<?php echo  site_url('/institute/needs_attention'); ?>" class="text-warning"><i class="fa fa-exclamation-triangle"></i> Needs Attention</a> </td>
                    <td><?php echo  $requests_needing_attention->cases; ?></td>
                    <td><?php echo  $requests_needing_attention->rcpath; ?></td>
                    <td class="text-right"> &nbsp;</td>
                </tr>
                <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /Page Content -->
