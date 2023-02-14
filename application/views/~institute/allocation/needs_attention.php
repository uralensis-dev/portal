<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Needs Attention</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Institute</a></li>
                <li class="breadcrumb-item"><a href="<?php echo  site_url('/institute/allocate_requests'); ?>">Allocate Requests</a></li>
                <li class="breadcrumb-item active">Needs Attention</li>
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
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="table-responsive">
            <table class="table datatable table-striped">
                <thead>
                <tr>
                    <th>Request Date</th>
                    <th>Specialty</th>
                    <th>RCPath</th>
                    <th class="text-right">Update</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo  $request->from_date; ?></td>
                        <td><?php echo  empty($request->specialty) ? 'Not Assigned': $request->specialty; ?></td>
                        <td><?php echo  $request->rcpath; ?></td>
                        <td class="text-right"><a href="<?php echo  site_url('/institute/view_singlerecord/' . $request->uralensis_request_id); ?>" class="btn btn-link text-primary">
                                <i class="fa fa-edit"></i>
                            </a></td>
                    </tr>
                <?php endforeach; ?>
                <?php if(!empty($requests_needing_attention)):?>
                <tr>
                    <td><?php echo  $requests_needing_attention->from_date; ?></td>
                    <td><a href="<?php echo  site_url('/institute/needs_attention/' . $specialty->specialty_id); ?>">Needs Attention</a> </td>
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
