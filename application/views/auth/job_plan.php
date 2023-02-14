<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Job Plan</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active">Update Job Plan</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_job_plan"><i class="fa fa-plus"></i> Add Job Plan</a>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="row">
    <div class="col-lg-12">
        <div class="card ">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    <h3 class="card-title">Job Plan <a href="<?php echo base_url() ?>auth/job_plan/<?php echo $user_id ?>" class="edit-icon"><i class="fa fa-pencil"></i></a></h3>
                        <h5 class="section-title"></h5>
                        <hr>
                        <?php 
                            $week = array(
                                'mon' => array(),
                                'tue' => array(),
                                'wed' => array(),
                                'thu' => array(),
                                'fri' => array(),
                                'sat' => array(),
                                'sun' => array()
                            );

                            foreach ($job_plan as $plan) {
                                switch ($plan['dayOfWeek']) {
                                    case 'mon':
                                        array_push($week['mon'], $plan);
                                        break;
                                    case 'tue':
                                        array_push($week['tue'], $plan);
                                        break;
                                    case 'wed':
                                        array_push($week['wed'], $plan);
                                        break;
                                    case 'thu':
                                        array_push($week['thu'], $plan);
                                        break;
                                    case 'fri':
                                        array_push($week['fri'], $plan);
                                        break;
                                    case 'sat':
                                        array_push($week['sat'], $plan);
                                        break;                                        
                                    case 'sun':
                                        array_push($week['sun'], $plan);
                                        break;
                                }
                            }

                            $max_length = 0;
                            foreach ($week as $w) {
                                $len = count($w);
                                if ($len > $max_length) {
                                    $max_length = $len;
                                }
                            }
                        ?>
                        <?php if ($max_length == 0) {?>
                            <h4>No Job Plan Saved</h4>
                        <?php }else{ ?>
                        <h5 class="section-title">Job Plan</h5>
                        <div class="table-responsive">
	                        <table class="table table-striped custom-table">
		                        <thead>
		                            <tr>
		                                <th></th>
		                                <th>Mon</th>
		                                <th>Tue</th>
		                                <th>Wed</th>
		                                <th>Thu</th>
		                                <th>Fri</th>
		                                <th>Sat</th>
		                                <th>Sun</th>
		                            </tr>
		                        </thead>
		                        <tbody>
                                    <?php
                                        $total_pa = array();
                                        $total_pa['mon'] = 0;
                                        $total_pa['tue'] = 0;
                                        $total_pa['wed'] = 0;
                                        $total_pa['thu'] = 0;
                                        $total_pa['fri'] = 0;
                                        $total_pa['sat'] = 0;
                                        $total_pa['sun'] = 0;
                                    ?>
                                    <?php for ($i=0; $i < $max_length; $i++) { ?>
		                                <tr>
                                        <?php 
		                                    $mon_text = '';
		                                    if ($i < count($week['mon'])) {
                                                $mon_text = '';
                                                $mon_plan = $week['mon'][$i];
                                                if ($mon_plan['event'] == 'Microscopy' && $mon_plan['specialty_id'] != NULL) {
                                                    $from_time = $mon_plan['from_time'];
                                                    $to_time = $mon_plan['to_time'];
                                                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa =  $diff / 4;
                                                    $mon_text = $week['mon'][$i]['event'].'<br>'.'<span class="job-plan-spec">('.$mon_plan['specialty'].')</span><br><span>PA: '.round($pa, 2).'</span><br>'.date("H:i",strtotime($week['mon'][$i]['from_time'])).' - '.date('H:i', strtotime($week['mon'][$i]['to_time']));
                                                    $total_pa['mon'] += $pa;
                                                }else{
                                                    $mon_text = $week['mon'][$i]['event'].'<br>'.date("H:i",strtotime($week['mon'][$i]['from_time'])).' - '.date('H:i', strtotime($week['mon'][$i]['to_time']));
                                                }
		                                    }if ($week_leave['mon']) {
		                                        $mon_text = '<span class="text-danger"> On Leave </span>';
		                                        if ($i > 0) {
		                                            $mon_text = 0;
		                                        }
		                                    }

		                                    $tue_text = '';
		                                    if ($i < count($week['tue'])) {
                                                $tue_text = '';
                                                $tue_plan = $week['tue'][$i];
                                                if ($tue_plan['event'] == 'Microscopy' && $tue_plan['specialty_id'] != NULL) {
                                                    $from_time = $tue_plan['from_time'];
                                                    $to_time = $tue_plan['to_time'];
                                                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa =  $diff / 4;
                                                    $tue_text = $week['tue'][$i]['event'].'<br>'.'<span class="job-plan-spec">('.$tue_plan['specialty'].')</span><br><span>PA: '.round($pa, 2).'</span><br>'.date("H:i",strtotime($week['tue'][$i]['from_time'])).' - '.date('H:i', strtotime($week['tue'][$i]['to_time']));
                                                    $total_pa['tue'] += $pa;
                                                }else{
                                                    $tue_text = $week['tue'][$i]['event'].'<br>'.date("H:i",strtotime($week['tue'][$i]['from_time'])).' - '.date('H:i', strtotime($week['tue'][$i]['to_time']));
                                                }
		                                        
		                                    }if ($week_leave['tue']) {
		                                        $tue_text = '<span class="text-danger"> On Leave </span>';
		                                        if ($i > 0) {
		                                            $tue_text = 0;
		                                        }
		                                    }

		                                    $wed_text = '';
		                                    if ($i < count($week['wed'])) {
                                                $wed_text = '';
                                                $wed_plan = $week['wed'][$i];
                                                if ($wed_plan['event'] == 'Microscopy' && $wed_plan['specialty_id'] != NULL) {
                                                    $from_time = $wed_plan['from_time'];
                                                    $to_time = $wed_plan['to_time'];
                                                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa =  $diff / 4;
                                                    $wed_text = $week['wed'][$i]['event'].'<br>'.'<span class="job-plan-spec">('.$wed_plan['specialty'].')</span><br><span>PA: '.round($pa, 2).'</span><br>'.date("H:i",strtotime($week['wed'][$i]['from_time'])).' - '.date('H:i', strtotime($week['wed'][$i]['to_time']));
                                                    $total_pa['wed'] += $pa;
                                                }else{
                                                    $wed_text = $week['wed'][$i]['event'].'<br>'.date("H:i",strtotime($week['wed'][$i]['from_time'])).' - '.date('H:i', strtotime($week['wed'][$i]['to_time']));
                                                }
		                                    }if ($week_leave['wed']) {
		                                        $wed_text = '<span class="text-danger"> On Leave </span>';
		                                        if ($i > 0) {
		                                            $wed_text = 0;
		                                        }
		                                    }

		                                    $thu_text = '';
		                                    if ($i < count($week['thu'])) {
                                                $thu_text = '';
                                                $thu_plan = $week['thu'][$i];
                                                if ($thu_plan['event'] == 'Microscopy' && $thu_plan['specialty_id'] != NULL) {
                                                    $from_time = $thu_plan['from_time'];
                                                    $to_time = $thu_plan['to_time'];
                                                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa =  $diff / 4;
                                                    $thu_text = $week['thu'][$i]['event'].'<br>'.'<span class="job-plan-spec">('.$thu_plan['specialty'].')</span><br><span>PA: '.round($pa, 2).'</span><br>'.date("H:i",strtotime($week['thu'][$i]['from_time'])).' - '.date('H:i', strtotime($week['thu'][$i]['to_time']));
                                                    $total_pa['thu'] += $pa;
                                                }else{
                                                    $thu_text = $week['thu'][$i]['event'].'<br>'.date("H:i",strtotime($week['thu'][$i]['from_time'])).' - '.date('H:i', strtotime($week['thu'][$i]['to_time']));
                                                }
		                                    }if ($week_leave['thu']) {
		                                        $thu_text = '<span class="text-danger"> On Leave </span>';
		                                        if ($i > 0) {
		                                            $thu_text = 0;
		                                        }
		                                    }
		                                    $fri_text = '';
		                                    if ($i < count($week['fri'])) {
                                                $fri_text = '';
                                                $fri_plan = $week['fri'][$i];
                                                if ($fri_plan['event'] == 'Microscopy' && $fri_plan['specialty_id'] != NULL) {
                                                    $from_time = $fri_plan['from_time'];
                                                    $to_time = $fri_plan['to_time'];
                                                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa =  $diff / 4;
                                                    $fri_text = $week['fri'][$i]['event'].'<br>'.'<span class="job-plan-spec">('.$fri_plan['specialty'].')</span><br><span>PA: '.round($pa, 2).'</span><br>'.date("H:i",strtotime($week['fri'][$i]['from_time'])).' - '.date('H:i', strtotime($week['fri'][$i]['to_time']));
                                                    $total_pa['fri'] += $pa;
                                                }else{
                                                    $fri_text = $week['fri'][$i]['event'].'<br>'.date("H:i",strtotime($week['fri'][$i]['from_time'])).' - '.date('H:i', strtotime($week['fri'][$i]['to_time']));
                                                }
		                                    }if ($week_leave['fri']) {
		                                        $fri_text = '<span class="text-danger"> On Leave </span>';
		                                        if ($i > 0) {
		                                            $fri_text = 0;
		                                        }
		                                    }

		                                    $sat_text = '';
		                                    if ($i < count($week['sat'])) {
                                                $sat_text = '';
                                                $sat_plan = $week['sat'][$i];
                                                if ($sat_plan['event'] == 'Microscopy' && $sat_plan['specialty_id'] != NULL) {
                                                    $from_time = $sat_plan['from_time'];
                                                    $to_time = $sat_plan['to_time'];
                                                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa =  $diff / 4;
                                                    $sat_text = $week['sat'][$i]['event'].'<br>'.'<span class="job-plan-spec">('.$sat_plan['specialty'].')</span><br><span>PA: '.round($pa, 2).'</span><br>'.date("H:i",strtotime($week['sat'][$i]['from_time'])).' - '.date('H:i', strtotime($week['sat'][$i]['to_time']));
                                                    $total_pa['sat'] += $pa;
                                                }else{
                                                    $sat_text = $week['sat'][$i]['event'].'<br>'.date("H:i",strtotime($week['sat'][$i]['from_time'])).' - '.date('H:i', strtotime($week['sat'][$i]['to_time']));
                                                }
		                                    }if ($week_leave['sat']) {
		                                        $sat_text = '<span class="text-danger"> On Leave </span>';
		                                        if ($i > 0) {
		                                            $sat_text = 0;
		                                        }
		                                    }

		                                    $sun_text = '';
		                                    if ($i < count($week['sun'])) {
                                                $sun_text = '';
                                                $sun_plan = $week['sun'][$i];
                                                if ($sun_plan['event'] == 'Microscopy' && $sun_plan['specialty_id'] != NULL) {
                                                    $from_time = $sun_plan['from_time'];
                                                    $to_time = $sun_plan['to_time'];
                                                    $diff =  round((strtotime($to_time) - strtotime($from_time))/3600, 1);
                                                    $diff = $diff < 0 ? $diff * -1 : $diff;
                                                    $pa =  $diff / 4;
                                                    $sun_text = $week['sun'][$i]['event'].'<br>'.'<span class="job-plan-spec">('.$sun_plan['specialty'].')</span><br><span>PA: '.round($pa, 2).'</span><br>'.date("H:i",strtotime($week['sun'][$i]['from_time'])).' - '.date('H:i', strtotime($week['sun'][$i]['to_time']));
                                                    $total_pa['sun'] += $pa;
                                                }else{
                                                    $sun_text = $week['sun'][$i]['event'].'<br>'.date("H:i",strtotime($week['sun'][$i]['from_time'])).' - '.date('H:i', strtotime($week['sun'][$i]['to_time']));
                                                }
		                                    }if ($week_leave['sun']) {
		                                        $sun_text = '<span class="text-danger"> On Leave </span>';
		                                        if ($i > 0) {
		                                            $sun_text = 0;
		                                        }
		                                    }
		                                ?>        
                                            <td><a href="javascript:;" class="text-dark" style="font-size: 1rem;"><strong><?php echo 'Session '.($i + 1); ?></strong></a> </td>
                                            <td><a href="javascript:;" class="text-dark" ><?php echo $mon_text; ?></a></td>
                                            <td><a href="javascript:;" class="text-dark" ><?php echo $tue_text; ?></a></td>
                                            <td><a href="javascript:;" class="text-dark" ><?php echo $wed_text; ?></a></td>
                                            <td><a href="javascript:;" class="text-dark" ><?php echo $thu_text; ?></a></td>
                                            <td><a href="javascript:;" class="text-dark" ><?php echo $fri_text; ?></a></td>
                                            <td><a href="javascript:;" class="text-dark" ><?php echo $sat_text; ?></a></td>
                                            <td><a href="javascript:;" class="text-dark" ><?php echo $sun_text; ?></a></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><a href="javascript:;" class="text-dark" style="font-size: 1rem;"><strong>Total</strong></a> </td>
                                        <td><a href="javascript:;" class="text-dark" ><strong><?php echo round($total_pa['mon'], 2)?></strong></a></td>
                                        <td><a href="javascript:;" class="text-dark" ><strong><?php echo round($total_pa['tue'], 2)?></strong></a></td>
                                        <td><a href="javascript:;" class="text-dark" ><strong><?php echo round($total_pa['wed'], 2)?></strong></a></td>
                                        <td><a href="javascript:;" class="text-dark" ><strong><?php echo round($total_pa['thu'], 2)?></strong></a></td>
                                        <td><a href="javascript:;" class="text-dark" ><strong><?php echo round($total_pa['fri'], 2)?></strong></a></td>
                                        <td><a href="javascript:;" class="text-dark" ><strong><?php echo round($total_pa['sat'], 2)?></strong></a></td>
                                        <td><a href="javascript:;" class="text-dark" ><strong><?php echo round($total_pa['sun'], 2)?></strong></a></td>
                                    </tr>
		                        </tbody>
		                    </table>
		                </div>
	                    <?php }?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                    
                        <!-- Calendar -->
                        <div id="job-plan-calendar"></div>
                        <!-- /Calendar -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /Page Content -->

<!-- Add Event Modal -->
<div id="add_job_plan" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Job Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url().'auth/add_job_plan/'.$user_id); ?>
                    <div class="form-group">
                        <label> Title <span class="text-danger">*</span></label>
                        <input class="form-control <?php if ($has_errors && in_array('event', $form_errors)) {echo 'is-invalid';} ?>" type="text" name="event" value="<?php if ($has_errors) {echo $form_values['event'];} ?>" required>
                        <div class="invalid-feedback">
                            Please enter valid event title
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Specialty</label>
                        <select name="specialty" value="<?php if ($has_errors) {echo $form_values['specialty_id'];} ?>" id="job-plan-specialty" class="form-control <?php if ($has_errors && in_array('specialty_id', $form_errors)) {echo 'is-invalid';} ?>">
                            <option value="" <?php if (!$has_errors) {echo 'selected';} ?> ></option>
                            <?php foreach ($user_specialties as $specialty) { ?>
                                <option value="<?php echo $specialty['specialty_id'] ?>"><?php echo $specialty['specialty']?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            Please enter valid specialty
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Day</label>
                        <select value="<?php if ($has_errors) {echo $form_values['dayOfWeek'];} ?>" name="dayOfWeek" id="job-plan-dayOfWeek" class="form-control <?php if ($has_errors && in_array('dayOfWeek', $form_errors)) {echo 'is-invalid';} ?>">
                            <option value="mon">Monday</option>
                            <option value="tue">Tuesday</option>
                            <option value="wed">Wednesday</option>
                            <option value="thu">Thursday</option>
                            <option value="fri">Friday</option>
                            <option value="sat">Saturday</option>
                            <option value="sun">Sunday</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter valid Day
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Color</label>
                        <select value="<?php if ($has_errors) {echo $form_values['color'];} ?>" name="color" class="select form-control <?php if ($has_errors && in_array('color', $form_errors)) {echo 'is-invalid';} ?>">
                            <option value="bg-danger">Danger</option>
                            <option value="bg-success">Success</option>
                            <option value="bg-purple">Purple</option>
                            <option value="bg-primary">Primary</option>
                            <option value="bg-pink">Pink</option>
                            <option value="bg-info" selected>Info</option>
                            <option value="bg-inverse">Inverse</option>
                            <option value="bg-orange">Orange</option>
                            <option value="bg-brown">Brown</option>
                            <option value="bg-teal">Teal</option>
                            <option value="bg-warning">Warning</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter valid Color
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Time From <span class="text-danger">*</span></label>
                                <div class="input-group date" id="time_from" data-target-input="nearest">
                                    <input id="add_job_plan_from_time" value="<?php if ($has_errors) {echo $form_values['from_time'];} ?>" name="from_time" type="text" required class="form-control datetimepicker-input <?php if ($has_errors && (in_array('from_time', $form_errors)||in_array('invalid_time', $form_errors)  )) {echo 'is-invalid';} ?>" data-target="#time_from"/>
                                    <div class="input-group-append" data-target="#time_from" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter valid time
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Time To <span class="text-danger">*</span></label>

                                <div class="input-group date" id="time_to" data-target-input="nearest">
                                    <input id="add_job_plan_to_time" value="<?php if ($has_errors) {echo $form_values['to_time'];} ?>" name="to_time" type="text" required class="form-control datetimepicker-input <?php if ($has_errors && (in_array('to_time', $form_errors)||in_array('invalid_time', $form_errors)  )) {echo 'is-invalid';} ?>" data-target="#time_to"/>
                                    <div class="input-group-append" data-target="#time_to" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter valid time
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<div id="edit_job_plan" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Job Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label> Title <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="edit-job-plan-title" name="event" value="" required>
                        <div class="invalid-feedback">
                            Please enter valid event title
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Specialty</label>
                        <select name="specialty" value="" id="edit-job-plan-specialty" class="form-control">
                            <option value="" ></option>
                            <?php foreach ($user_specialties as $specialty) { ?>
                                <option value="<?php echo $specialty['specialty_id'] ?>"><?php echo $specialty['specialty']?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            Please enter valid specialty
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Day</label>
                        <select value="" name="dayOfWeek" id="edit-job-plan-dayOfWeek" class="form-control">
                            <option value="mon">Monday</option>
                            <option value="tue">Tuesday</option>
                            <option value="wed">Wednesday</option>
                            <option value="thu">Thursday</option>
                            <option value="fri">Friday</option>
                            <option value="sat">Saturday</option>
                            <option value="sun">Sunday</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter valid Day
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Color</label>
                        <select value="" id="edit-job-plan-color" name="color" class="select form-control">
                            <option value="bg-danger">Danger</option>
                            <option value="bg-success">Success</option>
                            <option value="bg-purple">Purple</option>
                            <option value="bg-primary">Primary</option>
                            <option value="bg-pink">Pink</option>
                            <option value="bg-info" selected>Info</option>
                            <option value="bg-inverse">Inverse</option>
                            <option value="bg-orange">Orange</option>
                            <option value="bg-brown">Brown</option>
                            <option value="bg-teal">Teal</option>
                            <option value="bg-warning">Warning</option>
                        </select>
                        <div class="invalid-feedback">
                            Please enter valid Color
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Time From <span class="text-danger">*</span></label>
                                <div class="input-group date" id="time_from" data-target-input="nearest">
                                    <input id="edit-job-plan-from-time" value="" name="from_time" type="text" required class="form-control datetimepicker-input" data-target="#time_from"/>
                                    <div class="input-group-append" data-target="#time_from" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter valid time
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Time To <span class="text-danger">*</span></label>

                                <div class="input-group date" id="time_to" data-target-input="nearest">
                                    <input id="edit-job-plan-to-time" value="" name="to_time" type="text" required class="form-control datetimepicker-input" data-target="#time_to"/>
                                    <div class="input-group-append" data-target="#time_to" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter valid time
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button id="edit-job-plan-save-button" type="button" class="btn btn-primary submit-btn">Update</button>
                        <button id="job-plan-delete-button" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- /Add Job Plan  Modal -->

<!-- Event Modal -->
<div class="modal custom-modal fade" id="job-plan-event-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Job Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-success submit-btn save-event">Create Plan</button>
                <button type="button" class="btn btn-danger submit-btn delete-event" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- /Event Modal -->

<!-- Add Category Modal-->
<div class="modal custom-modal fade" id="add-job-plan-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add a category</h4>
            </div>
            <div class="modal-body p-20">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label">Category Name</label>
                            <input class="form-control" placeholder="Enter name" type="text" name="category-name">
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Choose Category Color</label>
                            <select class="form-control" data-placeholder="Choose a color..." name="category-color">
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                                <option value="info">Info</option>
                                <option value="pink">Pink</option>
                                <option value="primary">Primary</option>
                                <option value="warning">Warning</option>
                                <option value="orange">Orange</option>
                                <option value="brown">Brown</option>
                                <option value="teal">Teal</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger save-category" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    <?php if ($has_errors) echo "var job_plan_modal_open = true;"; ?>
</script>
<!-- /Add Category Modal-->