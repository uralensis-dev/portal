<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Allocated Requests</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Institute</a></li>
                <li class="breadcrumb-item"><a href="<?php echo  site_url('/institute/allocate_requests'); ?>">Allocate Requests</a></li>
                <li class="breadcrumb-item active">Allocated Requests</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Allocation</th>
                    <?php foreach ($week as $day): ?>
                        <th><?php echo  date('d/m', strtotime($day)); ?> Cases</th>
                        <th><?php echo  date('d/m', strtotime($day)); ?> RCPath</th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($allocation as $key => $value): ?>
                    <tr>
                        <td><?php echo  $key; ?></td>
                        <td><?php echo  count($value); ?> days</td>
                        <?php foreach ($week as $day): ?>
                            <?php if (empty($value[$day])): ?>
                                <?php if (empty($leave[$key])): ?>
                                    <td></td>
                                    <td></td>
                                <?php elseif (strtotime($leave[$key]->start) <= strtotime($day) && strtotime($leave[$key]->end) >= strtotime($day)): ?>
                                        <td>Leave</td>
                                        <td>Leave</td>
                                <?php endif; ?>
                            <?php else: ?>
                                <td><?php echo  $value[$day]->cases; ?></td>
                                <td><?php echo  $value[$day]->rc_points; ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /Page Content -->
