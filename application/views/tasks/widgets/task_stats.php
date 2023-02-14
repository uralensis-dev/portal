<div class="col-md-6 col-lg-4 col-xl-4 d-flex">
    <div class="card flex-fill" style="min-height: 420px;">
        <div class="card-body">
            <h4 class="card-title">Task Statistics</h4>
            <div class="statistics">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-6 text-center">
                        <div class="stats-box mb-4">
                            <p>Total Tasks</p>
                            <h3><?php echo  $task_stats->total; ?></h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-6 text-center">
                        <div class="stats-box mb-4">
                            <p>Overdue Tasks</p>
                            <h3><?php echo  $task_stats->overdue; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <?php $colors = ['purple', 'warning', 'success', 'danger', 'info']; ?>
            <div class="progress mb-4">
                <?php
                $counter = 0;
                foreach ($task_stats->status_counts as $count):
                    $percent = $task_stats->total > 0 ? $count / $task_stats->total * 100 : 0;
                    ?>
                    <div class="progress-bar bg-<?php echo  $colors[$counter]; ?>" role="progressbar" style="width: <?php echo  $percent; ?>%" aria-valuenow="<?php echo  $percent; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo  $percent; ?>%</div>
                    <?php $counter++;
                endforeach; ?>
            </div>
            <div>
                <?php
                $counter = 0;
                foreach ($task_stats->status_counts as $status => $count): ?>
                    <p><i class="fa fa-dot-circle-o text-<?php echo  $colors[$counter]; ?> mr-2"></i><?php echo  $status; ?> Tasks <span class="float-right"><?php echo  $count; ?></span></p>
                    <?php
                    $counter++;
                endforeach; ?>
            </div>
        </div>
    </div>
</div>