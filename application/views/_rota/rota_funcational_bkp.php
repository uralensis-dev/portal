<?php
//$all_groups_without_hospital = getAllUserGroupsWithoutHospital();
//_print_r($dataSet);
//_print_r($this->input->get());
?>
<!-- Page Header -->
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
            <a href="<?php echo  site_url('_rota/rota') ?>" class="btn  add-btn" ><i class="fa fa-refresh"></i> Refresh</a>
        </div>
    </div>
</div>


<?php /* if ($this->session->flashdata('inserted') === true) { ?>
  <div class="row">
  <div class="col-lg-12">
  <div class="alert alert-success alert-dismissible" role="alert">
  <strong><?php echo $this->session->flashdata('tckSuccessMsg'); ?></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">×</span>
  </button>
  </div>
  </div>
  </div>
  <?php } */ ?>
<input type="hidden" id="base_url" value="<?php echo  site_url('_rota/rota') ?>">
<?php
if (!empty($this->input->get())) {
    echo '<input type="hidden" id="_flag" value="1">';
    echo '<input type="hidden" id="user_type" value="' . $this->input->get('type') . '">';
    echo '<input type="hidden" id="team_id" value="' . $this->input->get('team_id') . '">';
    echo '<input type="hidden" id="user_id" value="' . $this->input->get('user_id') . '">';
    echo '<input type="hidden" id="team_name" value="' . base64_decode($this->input->get('team_name')) . '">';
    echo '<input type="hidden" id="user_name" value="' . base64_decode($this->input->get('name')) . '">';
//    echo '<input type="hidden" id="info" value="'. base64_encode(json_encode(getAllEvents($this->input->get('user_id')),JSON_PRETTY_PRINT)).'">';
    $events = json_encode(getAllEvents($this->input->get('user_id')), JSON_PRETTY_PRINT);
} else {
    echo '<input type="hidden" id="_flag" value="0">';
//    echo '<input type="hidden" id="info" value="'. base64_encode(json_encode(getAllEvents(),JSON_PRETTY_PRINT)).'">';
    $events = json_encode(getAllEvents(), JSON_PRETTY_PRINT);
}
$this->session->set_userdata('events', $events);
?>
<!-- /Page Header -->

<div class="row">
    <!-- Sidebar -->


    <!-- /Sidebar -->
    <div class="col-lg-3">
        <ul class="main-list">
            <p>Hospital Knightbridge</p>                      
            <?php
            $groups = array();
            $html = $styleLeader = $styleDeputy = '';
            $count = 1;
            foreach ($dataSet as $team) {

                if ($count == 1) {
                    $class = 'active';
                } else {
                    $class = '';
                }

                if ($team['team_id'] == $this->input->get('team_id')) {
                    $dispay = 'block';
                } else {
                    $display = 'none';
                }


                if ($team['team_leader'] == $this->input->get('user_id')) {
                    $styleLeader = 'style="background: #0180de;padding: 12px;color: white;"';
                } else {
                    $styleLeader = '';
                }

                if ($team['deputy_team_leader'] == $this->input->get('user_id')) {
                    $styleDeputy = 'style="background: #0180de;padding: 12px;color: white;"';
                } else {
                    $styleDeputy = '';
                }

                $teamGroup = $this->rota->getGroupName(@explode(",", $team['group_id']));
                ?>
                                    <!--            <p style="text-transform: capitalize;">  <span style="font-weight: 100"><?php echo  $count ?>) GROUP :</span>  
                <?php
//                    if (!empty($teamGroup)) {
//                        foreach ($teamGroup as $tgrp) {
//                            $groups[] .= ' ' . $tgrp['name'];
//                        }
//                    }
//                    echo implode(',', $groups);
                ?>

                                                    </p>-->

                <?php
//                echo "<hr>";
                $html .= '<li id="" class="' . $class . '" onclick="return toggleSubMenu(' . $team['team_id'] . ')">
                                <a href="javascript:void(0)">   <strong>TEAM ' . $count . ' :</strong>  ' . $team['team_name'] . '<span class="fa fa-chevron-down pull-right"></span></a>
                                <ul style="display:' . $display . ';" id="' . $team['team_id'] . '">
                                    <li><a ' . $styleLeader . ' href="' . site_url('_rota/rota/?type=1&team_id=' . $team['team_id'] . '&user_id=' . $team['team_leader'] . '&team_name=' . base64_encode($team['team_name']) . '&name=' . base64_encode($team['leader_first_name'] . ' ' . $team['leader_first_name'])) . '"><strong>Lead: </strong>' . $team['leader_first_name'] . ' ' . $team['leader_last_name'] . '</a></li>
                                    <li><a ' . $styleDeputy . ' href="' . site_url('_rota/rota/?type=2&team_id=' . $team['team_id'] . '&user_id=' . $team['deputy_team_leader'] . '&team_name=' . base64_encode($team['team_name']) . '&name=' . base64_encode($team['deputy_first_name'] . ' ' . $team['deputy_first_name'])) . '"><strong>Deputy: </strong>' . $team['deputy_first_name'] . ' ' . $team['deputy_last_name'] . '</a></li>';
                $temMembers = $this->rota->getUserDetails(@explode(",", $team['team_member']));
                if (!empty($temMembers)) {
                    $styleMember = '';
                    foreach ($temMembers as $lead) {

                        if ($lead['user_id'] == $this->input->get('user_id')) {
                            $styleMember = 'style="background: #0180de;padding: 12px;color: white;"';
                        } else {
                            $styleMember = '';
                        }

                        $html .= '<li><a ' . $styleMember . ' href="' . site_url('_rota/rota/?type=3&team_id=' . $team['team_id'] . '&user_id=' . $lead['user_id'] . '&team_name=' . base64_encode($team['team_name']) . '&name=' . base64_encode($lead['enc_first_name'] . ' ' . $lead['enc_first_name'])) . '">' . $lead['enc_first_name'] . ' ' . $lead['enc_last_name'] . '</a></li>';
                    }
                }
                $html .= '</ul>
                            </li>';

                echo $html;
                echo "<hr>";
                $html = '';
                $count++;
            }
            ?>

        </ul>



    </div>
    <div class="col-lg-9">
        <div class="card mb-0">
            <div class="card-body">

                <!-- Calendar -->
                <div id="rota_calender"></div>
                <!-- /Calendar -->

            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->


<!-- Event Modal -->
<div class="modal custom-modal fade" id="event-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php // if (!empty($this->input->get())) {   ?>
            <div class="modal-body" id="modal_inner_container"></div>

            <div class="modal-footer text-center">
                <button type="submit" id="save-event" class="btn btn-success submit-btn save-event">Create event</button>
                <button type="button" class="btn btn-danger submit-btn delete-event" data-dismiss="modal">Delete</button>
            </div>
            <?php
//            } else {
//                echo "<div class='alert alert-danger' style='margin-left: 0px;'>Error, Please Select the Team/Member to proceed!</div>";
//            }
            ?>
        </div>
    </div>
</div>
<!-- /Event Modal -->
 