<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Allocated Requests</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Institute</a></li>
                <li class="breadcrumb-item"><a href="<?php echo  site_url('/allocator/allocate_requests'); ?>">Allocate Requests</a></li>
                <li class="breadcrumb-item active">Allocated Requests</li>
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
                    <th>Doctor</th>
                    <th>Allocation</th>
                    <?php foreach ($week as $day): ?>
                        <th><?php echo  date('d/m', strtotime($day)); ?></th>
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
                                    <td>
                                        Cases: 0<br/>
                                        RC Points: 0
                                    </td>
                                <?php elseif (strtotime($leave[$key]->start) <= strtotime($day) && strtotime($leave[$key]->end) >= strtotime($day)): ?>
                                    <td>Leave</td>
                                <?php endif; ?>
                            <?php else: ?>
                                <td>
                                    Cases: <?php echo  $value[$day]->cases; ?><br/>
                                    RC Points: <?php echo  $value[$day]->rc_points; ?>
                                </td>
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
