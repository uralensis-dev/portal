<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Ready To Allocate</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Institute</a></li>
                <li class="breadcrumb-item"><a href="<?php echo  site_url("/allocator/allocate_requests/$hospital_id"); ?>">Allocate Requests</a></li>
                <li class="breadcrumb-item active">Ready To Allocate</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="row">
    <?php if (!empty($group_menu)): ?>
        <?php $this->load->view('/allocator/partials/group_menu', $group_menu); ?>
    <?php endif; ?>
    <div class="col-sm-12 col-md-<?php echo  empty($group_menu) ? 12 : 9; ?>">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Serial No.</th>
                    <th>RC Path</th>
                    <th>Specimens</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($requests as $request): ?>
                    <tr>
                        <td><?php echo  $request->request_datetime; ?></td>
                        <td><?php echo  $request->serial_number; ?></td>
                        <td><?php echo  $request->rcpath; ?></td>
                        <td><?php echo  $request->num_specimen; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /Page Content -->
