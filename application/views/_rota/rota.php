<script type="text/javascript">
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const d = new Date();
    var year = d.getFullYear();

</script>

<?php
$last_sunday = strtotime("last monday"); // Updated from Sunday to Monday
$last_sunday = date('w', $last_sunday) == date('w') ? $last_sunday + 7 * 86400 : $last_sunday;
$monday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +1 days"));
$tuesday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +2 days"));
$wednesday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +3 days"));
$thursday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +4 days"));
$friday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +5 days"));
$saturday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +6 days"));
$this_week_sd = date("Y-m-d", $last_sunday);
// echo "Current week start from  ";

$uri_segment = '';
if ($this->uri->segment(3) != '') {
    if ($this->uri->segment(3) == 'booking_in') {
        $uri_segment = 'Booking In';
    }
    if ($this->uri->segment(3) == 'cut_up') {
        $uri_segment = 'Cut Up';
    }
    if ($this->uri->segment(3) == 'embedding') {
        $uri_segment = 'Embedding';
    }
    if ($this->uri->segment(3) == 'sectioning') {
        $uri_segment = 'Sectioning';
    }
}
?>
<style>
    .list_rota .rota_pop:hover {
        background: azure;
    }
    .edit_btn:hover {
        cursor: pointer;
        background: #fff;
    }
    @media screen and (min-width: 1600px) {
        .page-header .breadcrumb a, 
        .breadcrumb-item.active{font-size: 18px;}
    }
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <?php if(empty($rota_type)) $rota_type = ''; ?>
            <h3 class="page-title">Rota / <?php echo $rota_type; ?></h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item active">Rota</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a target="_blank" href="<?php echo site_url('_rota/rota_inner_category') ?>" class="btn add-btn btn-rounded"><i class="fa fa-plus"></i> Rota Category</a>
        </div>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-4">
        From: <strong><?php echo date('d M Y', strtotime($this_week_sd)) ?></strong><br> To: <strong><?php echo date('d M Y', strtotime($saturday)) ?></strong>
    </div>
    <div class="col-sm-4 text-center">
        <h3><strong><script type="text/javascript">
            document.write(monthNames[d.getMonth()]);
            document.write("<span style='margin-left:10px;'>" + year + "</span>");
        </script></strong></h3>
    </div>
    <div class="col-sm-4 text-right">   
        <h3><strong>Today: </strong><?php echo date('d M Y', strtotime(date('Y-m-d'))) ?></h3>
    </div>
    <div class="clearfix"></div>
    <input type="hidden" id="base_url" value="<?php echo site_url('_rota/rota') ?>">

</div>


<div class="card new_card">
    <div class="card-header" id="headingOne">
        <div class="row">
            <div class="col-sm-12" style="border-bottom: 1px solid #ddd;">
                <div class="main-list" style="padding: 5px 0">
                    <p class="mb-0 pull-left"><?php echo get_user_group_name($this->ion_auth->user()->row()->id); ?></p>
                    <!--<p class="mb-0 text-right pull-right">Pathologist</p>-->
                    <div class="clearfix"></div> 
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-3" style="border-right: 1px solid #ddd; padding-top: 10px;">
                <!--<p><input type="text" name="" class="form-control" placeholder="Search Team"></p>-->
                <p>
                    <select name="search_team" id="team_id" class="form-control">
                        <option value="">Select Team</option>
                        <?php
                        foreach (getTeamsByGroupId('', '', $uri_segment) as $team) {
                            $selection = "";
                            if ($team['team_id'] == $this->uri->segment(4)) {
                                $selection = "selected='selected'";
                            }
                            echo "<option $selection  value='" . $team['team_id'] . "'>" . $team['team_name'] . "</option>";
                        }
                        ?>
                    </select>
                </p>
            </div>
            <div class="col-sm-9 bg-white">
                <ul class="list_rota list-unstyled">
                    <li class="list-item">Mon<p><?php echo date('d M Y', strtotime($this_week_sd)) ?></p></li>
                    <li class="list-item">Tue<p><?php echo date('d M Y', strtotime($monday)) ?></p></li>
                    <li class="list-item">Wed<p><?php echo date('d M Y', strtotime($tuesday)) ?></p></li>
                    <li class="list-item">Thu<p><?php echo date('d M Y', strtotime($wednesday)) ?></p></li>
                    <li class="list-item">Fri<p><?php echo date('d M Y', strtotime($thursday)) ?></p></li>
                    <li class="list-item">Sat<p><?php echo date('d M Y', strtotime($friday)) ?></p></li>
                    <li class="list-item">Sun<p><?php echo date('d M Y', strtotime($saturday)) ?></p></li>
                </ul>
            </div>   
        </div>
    </div>
</div>

<?php
$count = 1;
foreach ($dataSet as $team) {
    $temMembers = $this->rota->getUserDetails(@explode(",", $team['team_member']));
    ?>

    <div id="team<?php echo $team['team_id'] ?>">
        <div class="card mb-0">
            <div class="card-header bg-white" id="team0<?php echo $team['team_id'] ?>">
                <div class="row">
                    <div class="col-sm-12">
                        <div style="margin-top: 5px; float: left;"><strong><?php echo $uri_segment ?>:</strong> <?php echo $team['team_name'] ?></div>
                        <div style="float:right;">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $team['team_id'] ?>" aria-expanded="false" aria-controls="collapse<?php echo $team['team_id'] ?>">
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </button></div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>

            <div id="collapse<?php echo $team['team_id'] ?>" class="collapse show" aria-labelledby="team0<?php echo $team['team_id'] ?>" data-parent="#team<?php echo $team['team_id'] ?>">
                <div class="card-body" style="padding-top: 0px;">
                    <?php if ($team['leader_first_name'] != '') { ?>
                        <div class="row" style="border-bottom: 1px solid #ddd;">
                            <div class="col-sm-3">
                                <div data-toggle="modal" data-target="#user_info_modal" style="padding-top: 5px;"><strong>Leader:</strong> <?php echo $leaderInfo = $team['leader_first_name'] . ' ' . $team['leader_last_name'] ?></div>
                            </div>
                            <div class="col-sm-9 nopadding">
                                <div class=""> 
                                    <ul class="list_rota rota_list2 list-unstyled">
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($this_week_sd, $team['team_id'], 1, $team['team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 

                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $this_week_sd ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $this_week_sd ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($monday, $team['team_id'], 1, $team['team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $monday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $monday ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($tuesday, $team['team_id'], 1, $team['team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $tuesday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $tuesday ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($wednesday, $team['team_id'], 1, $team['team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $wednesday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $wednesday ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($thursday, $team['team_id'], 1, $team['team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn"
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $thursday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $thursday ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($friday, $team['team_id'], 1, $team['team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn"
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $friday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $friday ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($saturday, $team['team_id'], 1, $team['team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $saturday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo $saturday ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>                  
                                </div>
                            </div>   
                        </div>
                    <?php } if ($team['deputy_first_name'] != '') { ?>
                        <div class="row"  style="border-bottom: 1px solid #ddd;">
                            <div class="col-sm-3">
                                <span><strong>Deputy:</strong> <?php echo $deputyInfo = $team['deputy_first_name'] . ' ' . $team['deputy_last_name'] ?></span>
                            </div>
                            <div class="col-sm-9 nopadding">
                                <div class="">                    
                                    <ul class="list_rota rota_list2 list-unstyled">
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($this_week_sd, $team['team_id'], 2, $team['deputy_team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $this_week_sd ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $this_week_sd ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($monday, $team['team_id'], 2, $team['deputy_team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $monday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $monday ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($tuesday, $team['team_id'], 2, $team['deputy_team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $tuesday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $tuesday ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($wednesday, $team['team_id'], 2, $team['deputy_team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $wednesday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $wednesday ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($thursday, $team['team_id'], 2, $team['deputy_team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $thursday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $thursday ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($friday, $team['team_id'], 2, $team['deputy_team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 

                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $friday ?>"
                                                        data-TYPE="2"
                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $friday ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($saturday, $team['team_id'], 2, $team['deputy_team_leader']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $saturday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo $saturday ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul> 
                                </div>
                            </div>   
                        </div>
                    <?php } foreach ($temMembers as $lead) { ?>
                        <div class="row" style="border-bottom: 1px solid #ddd;">
                            <div class="col-sm-3">
                                <div style="padding-top: 5px;"><?php echo $memberInfo = $lead['enc_first_name'] . ' ' . $lead['enc_last_name'] ?></div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">                    
                                    <ul class="list_rota rota_list2 list-unstyled">
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($this_week_sd, $team['team_id'], 3, $lead['user_id']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $this_week_sd ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $this_week_sd ?>"
                                                        data-TYPE="3"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($monday, $team['team_id'], 3, $lead['user_id']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $monday ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $monday ?>"
                                                        data-TYPE="3"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($tuesday, $team['team_id'], 3, $lead['user_id']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $tuesday ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $tuesday ?>"
                                                        data-TYPE="3"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($wednesday, $team['team_id'], 3, $lead['user_id']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $wednesday ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $wednesday ?>"
                                                        data-TYPE="3"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($thursday, $team['team_id'], 3, $lead['user_id']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $thursday ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $thursday ?>"
                                                        data-TYPE="3"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($friday, $team['team_id'], 3, $lead['user_id']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $friday ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $friday ?>"
                                                        data-TYPE="3"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <li class="list_item rota_pop">
                                            <ul class="rota-inner">
                                                <?php
                                                $dep_rota_info = get_rota_info($saturday, $team['team_id'], 3, $lead['user_id']);
                                                if (sizeof($dep_rota_info) > 0) {
                                                    $dep_class = '';
                                                    if ($dep_rota_info[0]['rota_type'] == 'on_rota') {
                                                        $dep_class = 'success_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'off_rota') {
                                                        $dep_class = 'warning_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'al') {
                                                        $dep_class = 'primary_eve';
                                                    } else if ($dep_rota_info[0]['rota_type'] == 'sick_leave') {
                                                        $dep_class = 'danger_eve';
                                                    }
                                                    ?>
                                                    <li class="<?php echo $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $saturday ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo $dep_rota_info[0]['event_category'] ?> <br> <?php echo $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo $team['team_name'] ?>"
                                                        data-UserID="<?php echo $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo $memberInfo ?>"
                                                        data-DateOfRota="<?php echo $saturday ?>"
                                                        data-TYPE="3"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>  
                                </div>
                            </div>   
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <?php
    $count++;
}
?>


<!-- Modal Rota Scheduling -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rota Scheduling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('_rota/rota/save_rota'); ?>
                <input type="hidden" name="uri_segment_3" id="uri_segment_3" value="<?php echo $this->uri->segment(3) ?>">
                <input type="hidden" name="uri_segment_4" id="uri_segment_4" value="<?php echo $this->uri->segment(4) ?>">
                <input type="hidden" name="team_id" id="rota_team_id" value="">
                <input type="hidden" name="team_name" id="rota_team_name" value="">
                <input type="hidden" name="user_id" id="rota_user_id" value="">
                <input type="hidden" name="user_name" id="rota_user_name" value="">
                <input type="hidden" name="date_of_event" id="rota_date_of_event" value="">
                <input type="hidden" name="type" id="rota_user_type" value="">
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-6 form-group">
                            <label>Start Time</label>
                            <input type="text" name="start_time_of_rota" id="" class="step time form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Time</label>
                            <input type="text" name="end_time_of_rota" id="" class="step time form-control" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Category</label>
                            <select name='event_category' class="form-control">
                                <?php
                                foreach ($rota_inner_category as $ric) {
                                    echo "<option value='" . $ric['name'] . "'>" . $ric['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="on_rota" checked>
                            <div class="icon_sch">
                                <i class="fa fa-calendar-check-o  text-success"></i>
                            </div>
                            <div class="title_sch">On Rota</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="off_rota">
                            <div class="icon_sch">
                                <i class="fa fa-calendar-times-o  text-warning"></i>
                            </div>
                            <div class="title_sch">Off Rota</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-warning"></i>
                            </div>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="al">
                            <div class="icon_sch">
                                <i class="fa fa-plane text-info"></i>
                            </div>
                            <div class="title_sch">AL</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-info"></i>
                            </div>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="sick_leave">
                            <div class="icon_sch">
                                <i class="fa fa-user-o text-danger"></i>
                            </div>
                            <div class="title_sch">Sick Leave</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-danger"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Rota Scheduling -->
<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Rota Scheduling</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('_rota/rota/save_rota');?>
                <input type="hidden" name="uri_segment_3" id="edit_uri_segment_3" value="<?php echo $this->uri->segment(3) ?>">
                <input type="hidden" name="uri_segment_4" id="edit_uri_segment_4" value="<?php echo $this->uri->segment(4) ?>">
                <input type="hidden" name="team_id" id="edit_rota_team_id" value="">
                <input type="hidden" name="team_name" id="edit_rota_team_name" value="">
                <input type="hidden" name="user_id" id="edit_rota_user_id" value="">
                <input type="hidden" name="user_name" id="edit_rota_user_name" value="">
                <input type="hidden" name="date_of_event" id="edit_rota_date_of_event" value="">
                <input type="hidden" name="type" id="edit_rota_user_type" value="">
                <input type="hidden" name="event_id" id="edit_event_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Start Time</label>
                            <input type="text" name="start_time_of_rota" id="edit_start_time_of_rota" class="time step form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Time</label>
                            <input type="text" name="end_time_of_rota" id="edit_end_time_of_rota" class="time step form-control" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Category</label>
                            <select name='event_category' id="edit_event_category" class="form-control">
                                <?php
                                foreach ($rota_inner_category as $ric) {
                                    echo "<option value='" . $ric['name'] . "'>" . $ric['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="on_rota" checked>
                            <div class="icon_sch">
                                <i class="fa fa-calendar-check-o  text-success"></i>
                            </div>
                            <div class="title_sch">On Rota</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-success"></i>
                            </div>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="off_rota">
                            <div class="icon_sch">
                                <i class="fa fa-calendar-times-o  text-warning"></i>
                            </div>
                            <div class="title_sch">Off Rota</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-warning"></i>
                            </div>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="al">
                            <div class="icon_sch">
                                <i class="fa fa-plane text-info"></i>
                            </div>
                            <div class="title_sch">AL</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-info"></i>
                            </div>
                        </div>
                        <div class="col-md-3 text-center form-group">
                            <input type="radio" name="rota_type" value="sick_leave">
                            <div class="icon_sch">
                                <i class="fa fa-user-o text-danger"></i>
                            </div>
                            <div class="title_sch">Sick Leave</div>
                            <div class="symble_sch">
                                <i class="fa fa-circle text-danger"></i>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <input type="submit" value="Delete" name="Delete" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>
</div>