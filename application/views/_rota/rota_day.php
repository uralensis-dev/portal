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
            <h3 class="page-title">Rota</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item active">Rota</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a target="_blank" href="<?php echo  site_url('_rota/rota_inner_category') ?>" class="btn add-btn btn-rounded"><i class="fa fa-plus"></i> Rota Category</a>
        </div>
    </div>
</div>

<div class="row form-group">
    <div class="col-sm-4">
        From: <strong><?php echo date('d M Y', strtotime($monday)) ?></strong><br> To: <strong><?php echo date('d M Y', strtotime($monday)) ?></strong>
    </div>
    <div class="col-sm-4 text-center">
        <h3><strong><script type="text/javascript">
            document.write(monthNames[d.getMonth()]);
            document.write("<span style='margin-left:10px;'>" + year);
                </script></strong></h3>
    </div>
    <div class="col-sm-4 text-right">   
        <h3><strong>Today: </strong><?php echo  date('d M Y', strtotime(date('Y-m-d'))) ?></h3>
    </div>
    <div class="clearfix"></div>
    <input type="hidden" id="base_url" value="<?php echo  site_url('_rota/rota') ?>">

</div>


<div class="card new_card">
    <div class="card-header" id="headingOne">
        <div class="row">
            <div class="col-sm-12" style="border-bottom: 1px solid #ddd;">
                <div class="main-list" style="padding: 5px 0; text-transform: capitalize;">
                    <p class="mb-0 pull-left"><?php echo  get_user_group_name($this->ion_auth->user()->row()->id); ?></p>
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
                <ul class="list_rota day_wise list-unstyled">
                    <li class="list-item">Tuesday<p><?php echo  date('d M Y', strtotime($monday)) ?></p></li>
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

    <div id="team<?php echo  $team['team_id'] ?>">
        <div class="card mb-0">
            <div class="card-header bg-white" id="team0<?php echo  $team['team_id'] ?>">
                <div class="row">
                    <div class="col-sm-12">
                        <div style="margin-top: 5px; float: left;"><strong><?php echo  $uri_segment ?>:</strong> <?php echo  $team['team_name'] ?></div>
                        <div style="float:right;">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo  $team['team_id'] ?>" aria-expanded="false" aria-controls="collapse<?php echo  $team['team_id'] ?>">
                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </button></div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </div>

            <div id="collapse<?php echo  $team['team_id'] ?>" class="collapse show" aria-labelledby="team0<?php echo  $team['team_id'] ?>" data-parent="#team<?php echo  $team['team_id'] ?>">
                <div class="card-body" style="padding-top: 0px;">
                    <div class="row" style="border-bottom: 1px solid #ddd;">
                        <div class="col-sm-3">
                            <strong>Time</strong>
                        </div>
                        <div class="col-sm-9 nopadding">
                            <table class="table hours_table">
                                <thead>
                                    <tr>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>21</th>
                                        <th>22</th>
                                        <th>23</th>
                                        <th>00</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </div>
                    </div>

                    <?php if ($team['leader_first_name'] != '') { ?>

                        <div class="row" style="border-bottom: 1px solid #ddd;">
                            <div class="col-sm-3">
                                <div data-toggle="modal" data-target="#user_info_modal" style="padding-top: 5px;"><strong>Leader:</strong> <?php echo  $leaderInfo = $team['leader_first_name'] . ' ' . $team['leader_last_name'] ?></div>
                            </div>
                            <div class="col-sm-9 nopadding">
                                <div class=""> 
                                    <ul class="list_rota rota_list2 day_wise list-unstyled">
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 

                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $this_week_sd ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $this_week_sd ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <!-- <li class="list_item rota_pop">
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $monday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $monday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $tuesday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $tuesday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $wednesday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $wednesday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn"
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $thursday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $thursday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn"
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $friday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $friday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $saturday ?>"
                                                        data-TYPE="1" 

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $leaderInfo ?>"
                                                        data-DateOfRota="<?php echo  $saturday ?>"
                                                        data-TYPE="1"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li> -->
                                    </ul>                  
                                </div>
                            </div>   
                        </div>
                    <?php } if ($team['deputy_first_name'] != '') { ?>
                        <div class="row"  style="border-bottom: 1px solid #ddd;">
                            <div class="col-sm-3">
                                <span><strong>Deputy:</strong> <?php echo  $deputyInfo = $team['deputy_first_name'] . ' ' . $team['deputy_last_name'] ?></span>
                            </div>
                            <div class="col-sm-9 nopadding">
                                <div class="">                    
                                    <ul class="list_rota rota_list2 day_wise list-unstyled">
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $this_week_sd ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $this_week_sd ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <!-- <li class="list_item rota_pop">
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $monday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $monday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $tuesday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $tuesday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $wednesday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $wednesday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $thursday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $thursday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 

                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $friday ?>"
                                                        data-TYPE="2"
                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $friday ?>"
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $saturday ?>"
                                                        data-TYPE="2"

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $team['deputy_team_leader'] ?>"
                                                        data-UserNAME="<?php echo  $deputyInfo ?>"
                                                        data-DateOfRota="<?php echo  $saturday ?>"
                                                        data-TYPE="2"
                                                        >
                                                        <i class='fa fa-plus'></i>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li> -->
                                    </ul> 
                                </div>
                            </div>   
                        </div>
                    <?php } foreach ($temMembers as $lead) { ?>
                        <div class="row" style="border-bottom: 1px solid #ddd;">
                            <div class="col-sm-3">
                                <div style="padding-top: 5px;"><?php echo  $memberInfo = $lead['enc_first_name'] . ' ' . $lead['enc_last_name'] ?></div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">                    
                                    <ul class="list_rota rota_list2 day_wise list-unstyled">
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
                                                    <li class="<?php echo  $dep_class ?> edit_btn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo  $memberInfo ?>"
                                                        data-DateOfRota="<?php echo  $this_week_sd ?>"
                                                        data-TYPE="3"

                                                        data-StartTime ="<?php echo  $dep_rota_info[0]['start_time_of_rota'] ?>"
                                                        data-EndTime="<?php echo  $dep_rota_info[0]['end_time_of_rota'] ?>"
                                                        data-Category="<?php echo  $dep_rota_info[0]['event_category'] ?>"
                                                        data-EventID="<?php echo  $dep_rota_info[0]['event_id'] ?>" 
                                                        data-RotaType="<?php echo  $dep_rota_info[0]['rota_type'] ?>" >
                                                        <span><strong><?php echo  $dep_rota_info[0]['event_category'] ?> <br> <?php echo  $dep_rota_info[0]['start_time_of_rota'] ?> - <?php echo  $dep_rota_info[0]['end_time_of_rota'] ?></strong></span>
                                                    </li>
                                                <?php } else { ?>
                                                    <li class="list_item rota_pop myBtn" id="myBtn" 
                                                        data-TeamID="<?php echo  $team['team_id'] ?>"
                                                        data-TeamNAME="<?php echo  $team['team_name'] ?>"
                                                        data-UserID="<?php echo  $lead['user_id'] ?>"
                                                        data-UserNAME="<?php echo  $memberInfo ?>"
                                                        data-DateOfRota="<?php echo  $this_week_sd ?>"
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
                <input type="hidden" name="uri_segment_3" id="uri_segment_3" value="<?php echo  $this->uri->segment(3) ?>">
                <input type="hidden" name="uri_segment_4" id="uri_segment_4" value="<?php echo  $this->uri->segment(4) ?>">
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
<!--                        <div class="col-md-6 form-group">
                            <label>Start Time</label>
                            <input type="time" name="start_time_of_rota" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>End Time</label>
                            <input type="time" name="end_time_of_rota" class="form-control" required>
                        </div>-->
                        <div class="col-md-12 form-group">
                            <label>Category</label>
                            <select name='event_category' class="form-control">
                                <?php
                                foreach ($rota_inner_category as $ric) {
                                    echo "<option value='" . $ric['name'] . "'>" . $ric['name'] . "</option>";
                                }
                                ?>
                                <!--                                <option value='Cut Up'>Cut Up</option>
                                                                <option value='MDT'>MDT</option>
                                                                <option value='Microscopy'>Microscopy</option>
                                                                <option value='Holiday Hours'>Holiday Hours</option>
                                                                <option value='Sick Days'>Sick Days</option>
                                                                <option value='Ovetime'>Overtime</option>-->
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
                <input type="hidden" name="uri_segment_3" id="edit_uri_segment_3" value="<?php echo  $this->uri->segment(3) ?>">
                <input type="hidden" name="uri_segment_4" id="edit_uri_segment_4" value="<?php echo  $this->uri->segment(4) ?>">
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
                                <!--                                <option value='Cut Up'>Cut Up</option>
                                                                <option value='MDT'>MDT</option>
                                                                <option value='Microscopy'>Microscopy</option>
                                                                <option value='Holiday Hours'>Holiday Hours</option>
                                                                <option value='Sick Days'>Sick Days</option>
                                                                <option value='Ovetime'>Overtime</option>-->
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


<div class="modal" id="user_info_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <div class="card mb-0">
                    <div class="card-header">
                        <span class="pull-left"><strong>Taqi Raza Khan</strong></span>
                        <span class="pull-right">Remaining<div class="" style="float:right; margin-left:5px; width:20px; height: 20px; background: #ffff4b"></div></span>
                        <div class="clearfix"></div>
                        <span class="pull-left">Software Engineer</span>
                        <span class="pull-right">Scheduled<div class="" style="float:right; margin-left:5px; width:20px; height: 20px; background: #ffbc34"></div></span>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled user_review">
                            <li>
                                <div class="row">
                                    <div class="col-sm-1 text-right">
                                        <i class="fa fa-wrench"></i>
                                    </div>
                                    <div class="col-sm-4 npr">Target Hours <span class="badge badge-default pull-right"><i class="fa fa-times"></i></span></div>
                                    <div class="col-sm-4">
                                        <div class="progress" style="height:10px; margin-top:8px;">
                                            <div class="progress-bar bg-warning" style="width:40%;height:10px"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        1234/2232
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-1 text-right">
                                        <i class="fa fa-plane"></i>
                                    </div>
                                    <div class="col-sm-4 npr">Holiday Hours <span class="badge badge-default pull-right"><i class="fa fa-times"></i></span></div>
                                    <div class="col-sm-4">
                                        <div class="progress" style="height:10px; margin-top:8px;">
                                            <div class="progress-bar bg-success" style="width:40%;height:10px"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        1234/2232
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-1 text-right">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="col-sm-4 npr">Sick Days <span class="badge badge-default pull-right"><i class="fa fa-times"></i></span></div>
                                    <div class="col-sm-4">
                                        <div class="progress" style="height:10px; margin-top:8px;">
                                            <div class="progress-bar bg-danger" style="width:40%;height:10px"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        1234/2232
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-sm-1 text-right">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                    <div class="col-sm-4 npr">Overtime <span class="badge badge-default pull-right"><i pull-right class="fa fa-times"></i></span></div>
                                    <div class="col-sm-4">
                                        <div class="progress" style="height:10px; margin-top:8px;">
                                            <div class="progress-bar bg-info" style="width:40%;height:10px"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        1234/2232
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


