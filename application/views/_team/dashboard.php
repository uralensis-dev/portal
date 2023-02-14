<?php
error_reporting(0);
$all_groups_without_hospital = getAllUserGroupsWithoutHospital();
?>

<style type="text/css">
    .team-members{
        display: block;
    }
    .team-members li{
        display: inline-block;
    }
    .team-members li img{
        width: 40px !important;
        height: 40px !important;
        border-radius: 20px;
    }
    .members_list{
        padding: 0;
    }
    .members_list li{
        margin-bottom: 10px;
    }
    .new_list li{
        padding: 2px;
        height: auto;
        border-bottom: 0px;
    }
    .avatar > img{
        width: 40px;
        height: 40px;
    }
    .new_list li label{
        margin: 0 0 3px;
        text-transform: capitalize;
    }
    .new_list li input[type=checkbox], input[type=radio]{
        width: 18px;
        height: 18px;
    }
    .mb-15{margin-bottom: 15px;}
</style>

<!-- Page Header -->
<div class="page-header">

    <div class="row align-items-center">

        <div class="col">

            <h3 class="page-title">Teams</h3>

            <ul class="breadcrumb">

                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>

                <li class="breadcrumb-item active">Teams</li>

            </ul>

        </div>

        <div class="col-auto float-right ml-auto">

            <a href="javascript:;" class="btn add-btn btn-rounded" data-toggle="modal" data-target="#create_team"><i class="fa fa-plus"></i> Create Team</a> 

            <a href="<?php echo  site_url('_rota/rota_category') ?>" class="btn add-btn btn-rounded" style="margin:0px 10px;"><i class="fa fa-list"></i> Rota Group</a>

        </div>

    </div>

</div>
<!-- /Page Header -->

<!-- Search Filter -->
<form action="<?php echo site_url('_team/team/dashboard/'); ?>" method="GET" accept-charset="utf-8">

    <div class="row filter-row">

        <div class="col-sm-6 col-md-4">  

            <div class="form-group form-focus">

                <input type="text" class="form-control" name="team_name">

                <label class="focus-label">Team Name</label>

            </div>

        </div>

        <div class="col-sm-6 col-md-4">  

            <div class="form-group form-focus select-focus">

                <select class="select floating"  name='group_id'> 

                    <option value="">Select User Group</option>

                    <?php foreach ($all_groups_without_hospital as $all_group_without_hospital): ?>

                        <option value='<?php echo $all_group_without_hospital['id']; ?>'><?php echo $all_group_without_hospital['name'] ?></option>

                    <?php endforeach; ?>

                </select>

                <label class="focus-label">User Group</label>

            </div>

        </div>

        <!--        <div class="col-sm-6 col-md-3"> 
        
                    <div class="form-group form-focus select-focus">
        
                        <select class="select floating"  name='user_id'>
        
                            <option value="">Select Team Member</option>
        
        <?php foreach ($userList as $users): ?>
                
                                        <option value='<?php echo $users['user_id']; ?>'><?php echo $users['enc_first_name'] . " " . $users['enc_last_name'] ?></option>
                
        <?php endforeach; ?>
        
                        </select>
        
                        <label class="focus-label">Users</label>
        
                    </div>
        
                </div>-->

        <div class="col-sm-6 col-md-2">  

            <button type='submit' class="btn btn-success btn-block"> Search </button>  

        </div>     

        <div class="col-sm-6 col-md-1">  

            <a href="<?php echo  site_url('_team/team/dashboard') ?>" class="btn btn-success btn-block" style="padding:7px 0 0"> <i class="fa fa-refresh fa-2x"></i> </a>  

        </div>     

    </div>

</form>
<!-- Search Filter -->

<?php
if ($this->session->flashdata('inserted') === true) {

    $type = $this->session->flashdata('type');

    if (!isset($type) && $type == '') {

        $type = "success";
    }
    ?>

    <div class="row">



        <div class="col-lg-12">



            <div class="alert alert-<?php echo $type; ?> alert-dismissible" role="alert">

                <strong><?php echo $this->session->flashdata('tckSuccessMsg'); ?></strong>



                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

        </div>

    </div>

<?php } else if ($this->session->flashdata('error') === true) {
    ?>
    <div class="row">



        <div class="col-lg-12">



            <div class="alert alert-danger alert-dismissible" role="alert">

                <strong>Something went wrong, try again. <?php echo  $this->session->flashdata('error_msg') ?></strong>



                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">×</span>

                </button>

            </div>

        </div>

    </div> 
<?php }
?>

<div class="row">

    <?php foreach ($teamList as $team): ?>


        <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown dropdown-action profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item edit_btn" href="#" 
                               data-team_id='<?php echo  $team['team_id'] ?>'
                               data-team_name='<?php echo  $team['team_name'] ?>'
                               data-team_leader='<?php echo  $team['team_leader'] ?>'
                               data-deputy_team_leader='<?php echo  $team['deputy_team_leader'] ?>'
                               data-team_member='<?php echo  $team['team_member'] ?>'
                               data-rota_type='<?php echo  $team['rota_type'] ?>'
                               data-description='<?php echo  $team['description'] ?>'
                               data-group_id='<?php echo  $team['group_id'] ?>'
                               ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                            <a class="dropdown-item delete_btn" href="#" data-team_id='<?php echo $team['team_id']; ?>'><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                    </div>
                    <h4 class="project-title"><a href="javascript:;"><?php echo  $team['team_name'] ?></a></h4>
                    <small class="block text-ellipsis m-b-15">
                        <span class="text-xs">
                            <?php echo  1 + sizeof(explode(',', $team['team_member'])) + sizeof(explode(',', $team['deputy_team_leader'])) ?> <span class="text-muted">Member(s)</span>   
                        </span>
                    </small>
                    <p class="text-muted">
                        <?php echo  $team['description'] ?>
                    </p>
                    <div class="pro-deadline m-b-15">
                        <div class="sub-title">
                            Date Created:
                        </div>
                        <div class="text-muted">
                            <?php echo  date('d M Y', strtotime($team['created_at'])) ?>
                            <!-- <?php
                            $userCreated = $this->teams->getUserDetails($team['created_by']);

                            echo $userCreated[0]['enc_first_name'] . ' ' . $userCreated[0]['enc_last_name'];

                            if ($team['modified_by'] > 0) {
                                echo "<p><span class='' style='padding: 0;'><small>Edited At: <strong>" . date('d M Y', strtotime($team['modified_at'])) . '</strong></small></span>';
                            }
                            ?>  -->    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 project-members m-b-15">
                            <div>Team Leader :</div>
                            <ul class="team-members">

                                <?php
                                $teamLeads = $this->teams->getUserDetails($team['team_leader']);

                                if (!empty($teamLeads)):

                                    $counter = 1;
                                    ?>

                                    <?php foreach ($teamLeads as $lead): ?>


                                        <li>
                                            <img title="<?php echo $lead['enc_first_name'] . ' ' . $lead['enc_last_name'] ?>" src="<?php
                                            if (empty($lead['profile_picture_path']))
                                                echo base_url('assets/img/dummy-doctors.jpg');
                                            else
                                                echo base_url($lead['profile_picture_path']);
                                            ?>">


                                        </li>  


                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <?php echo "<li><span class='badge badge-danger'>Un-Assigned</span></li>"; ?>

                                <?php endif; ?>

                            </ul>
                        </div>
                        <div class="col-md-6  project-members m-b-15">
                            <div>Deputy :</div>
                            <ul class="team-members">

                                <?php
                                $teamLeads = $this->teams->getUserDetails($team['deputy_team_leader']);

                                if (!empty($teamLeads)):

                                    $counter = 1;
                                    ?>

                                    <?php foreach ($teamLeads as $lead): ?>

                                        <li>
                                            <img title="<?php echo $lead['enc_first_name'] . ' ' . $lead['enc_last_name'] ?>" src="<?php
                                            if (empty($lead['profile_picture_path']))
                                                echo base_url('assets/img/dummy-doctors.jpg');
                                            else
                                                echo base_url($lead['profile_picture_path']);
                                            ?>">


                                        </li>  


                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <?php echo "<li><span class='badge badge-danger'>Un-Assigned</span></li>"; ?>

                                <?php
                                endif;
                                ?>

                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 project-member">
                            <div>Team</div>
                            <ul class="team-members members_list">

                                <?php
                                $temMembers = $this->teams->getUserDetails($team['team_member']);

                                if (!empty($temMembers)):

                                    $counter = 1;
                                    ?>

                                    <?php foreach ($temMembers as $lead): ?>


                                        <li>
                                            <img title="<?php echo $lead['enc_first_name'] . ' ' . $lead['enc_last_name'] ?>" src="<?php
                                            if (empty($lead['profile_picture_path']))
                                                echo base_url('assets/img/dummy-doctors.jpg');
                                            else
                                                echo base_url($lead['profile_picture_path']);
                                            ?>">

                                        </li>  


                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <?php echo "<li><span class='badge badge-danger'>Un-Assigned</span></li>"; ?>

                                <?php endif; ?>

                            </ul>
                        </div> 
                    </div>
                    <!-- <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                    <div class="progress progress-xs mb-0">
                        <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="" style="width: 40%" data-original-title="40%"></div>
                    </div> -->
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<!-- Create Team Modal -->
<div id="create_team" class="modal custom-modal fade" role="dialog">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Create Team</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <?php
                $attributes = array('method' => 'POST', 'enctype' => "multipart/form-data", "id" => 'cst-team-form');

                echo form_open("_team/team/saveData/", $attributes);
                ?>



                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">

                            <label>Team Name</label>

                            <input type="text" name="team_name" required class="form-control">

                        </div>


                        <div class="form-group">

                            <label>Add Leader</label>

                            <select class="form-control adv-search select2" style="width:100%" type="text" name='team_leader' id='team_leader' required >

                                <option value=''>Select Team Leader</option>

                                <?php // foreach ($userList as $users):     ?>

                                    <!--<option value='<?php echo $users['user_id']; ?>'><?php echo $users['enc_first_name'] . " " . $users['enc_last_name'] ?></option>-->

                                <?php // endforeach;     ?>



                            </select>

                        </div>




                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">

                            <label>User Group</label>

                            <!--                            <ul class="list-unstyled new_list">
                            <?php // foreach ($all_groups_without_hospital as $all_group_without_hospital):  ?>
                                                                <li class="list-item" style="list-style: none;">
                                                                    <label>
                                                                        <input type="checkbox" class="group_id" name="group_id[]" value="<?php // echo $all_group_without_hospital['id'];        ?>"> <?php // echo $all_group_without_hospital['name']        ?>  
                                                                    </label>
                                                                    
                                                                </li>
                            <?php // endforeach;  ?>
                                                        </ul>-->

                            <select class="form-control adv-search select2 group_id" style="width:100%" type="text" name='group_id[]' id='group_id' required multiple>

                                <option value=''>Select User Group</option>

                                <?php foreach ($all_groups_without_hospital as $all_group_without_hospital): ?>

                                    <option value='<?php echo $all_group_without_hospital['id']; ?>'><?php echo $all_group_without_hospital['name'] ?> </option>

                                <?php endforeach; ?>



                            </select>



                        </div>
                        <div class="form-group">

                            <label>Add Deputy Leader</label>

                            <select class="form-control adv-search select2" style="width:100%" id="deputy_team_leader" multiple="multiple" type="text" name='deputy_team_leader[]' required>

                                <option value=''>Select Deputy Team Leader</option>

                                <?php // foreach ($userList as $users):     ?>

                                    <!--<option value='<?php echo $users['user_id']; ?>'><?php echo $users['enc_first_name'] . " " . $users['enc_last_name'] ?></option>-->

                                <?php // endforeach;     ?>



                            </select>

                        </div>

                        <div class="form-group">

                            <label>Add Member</label>

                            <select class="form-control adv-search select2" style="width:100%" id="team_member" multiple="multiple" type="text" name='team_member[]' required>

                                <option value=''>Select Team Member</option>

                                <?php // foreach ($userList as $users):     ?>

                                    <!--<option value='<?php echo $users['user_id']; ?>'><?php echo $users['enc_first_name'] . " " . $users['enc_last_name'] ?></option>-->

                                <?php // endforeach;     ?>



                            </select>

                        </div>
                    </div>
                </div>


                <div class="clearfix"></div>
                <label>Setting</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p>
                                <label>
                                    <input type="checkbox"> Assign to Rota
                                </label>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Rota Groups</label>

                        <select class="form-control select2"  type="text" name='rota_type' id='rota_type'>

                            <option value=''>Select Rota Groups</option>

                            <?php
                            foreach ($rota_categories as $rotaCat) {
                                echo "<option value='" . $rotaCat['name'] . "'>" . $rotaCat['name'] . "</option>";
                            }
                            ?>

                        </select>

                    </div>
                </div>
                <div class="clearfix"></div> 
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p>
                                <label>
                                    <input type="checkbox"> Assign to Project
                                </label>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Project Groups</label>

                        <select class="form-control select2"  type="text" name='' id=''>

                            <option value=''>Select Project Groups</option>                          

                        </select>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">

                    <label>Description</label>

                    <textarea rows="4" class="form-control summernote" placeholder="Enter your message here"  name='description' required></textarea>

                </div>






                <div class="submit-section">

                    <button type='submit' class="btn btn-primary submit-btn" id='cst-add-form-btn'>Submit</button>

                </div>

                </form>

            </div>

        </div>

    </div>

</div>
<!-- /Create Team Modal -->

<!-- Delete Team Modal -->
<div class="modal custom-modal fade" id="delete_team" role="dialog">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-body">

                <div class="form-header">

                    <h3>Delete Team</h3>

                    <p>Are you sure want to delete? <br> All tasks in the Team will be Removed as well.</p>

                </div>

                <div class="modal-btn delete-action">

                    <div class="row">

                        <div class="col-6">

                            <?php
                            $attributes = array('method' => 'POST', 'id' => "deleteTeam");

                            echo form_open("_team/team/removeTeam/", $attributes);
                            ?>

                            <input type='hidden' id='delete_team_id' name='team_id' value=''/>

                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" id='cnfrmDelete'>Delete</a>

                            </form>

                        </div>

                        <div class="col-6">

                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- /Delete Team Modal -->


<!-- Edit Team Modal -->
<div id="edit_team" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Team</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('method' => 'POST', 'enctype' => "multipart/form-data", "id" => 'edit_form');

                echo form_open("_team/team/saveData/", $attributes);
                ?>
                <input type="hidden" name="team_id" id="edit_team_id" class="edit_team_id" value="">





                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">

                            <label>Team Name</label>

                            <input type="text" name="team_name" id="edit_team_name" value="" required class="form-control">

                        </div>


                        <div class="form-group">

                            <label>Add Leader</label>

                            <select class="form-control adv-search select2 edit_team_leader" style="width:100%" type="text" name='team_leader' id='edit_team_leader' required >

                                <option value=''>Select Team Leader</option>


                                <?php foreach ($userList as $users): ?>

                                    <option data-img='<?php echo $users['profile_picture_path']; ?>' value='<?php echo $users['user_id']; ?>'><?php echo $users['enc_first_name'] . " " . $users['enc_last_name'] ?></option>

                                <?php endforeach; ?>

                            </select>

                        </div>




                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">

                            <label>User Group</label>

                            <select class="form-control adv-search select2 edit_group_id" style="width:100%" type="text" name='group_id[]' id='edit_group_id' data-TeamID='<?php echo  $team['team_id'] ?>' required multiple>

                                <option value=''>Select User Group</option>
                                <?php foreach ($all_groups_without_hospital as $all_group_without_hospital): ?>

                                    <option value='<?php echo $all_group_without_hospital['id']; ?>'><?php echo $all_group_without_hospital['name'] ?> </option>

                                <?php endforeach; ?>

                            </select>



                        </div>
                        <div class="form-group">

                            <label>Add Deputy Leader</label>

                            <select class="form-control adv-search select2 edit_deputy_team_leader" style="width:100%" id="edit_deputy_team_leader" multiple="multiple" type="text" name='deputy_team_leader[]' required>

                                <option value=''>Select Deputy Team Leader</option>
                                <?php foreach ($userList as $users): ?>

                                    <option data-img='<?php echo $users['profile_picture_path']; ?>' value='<?php echo $users['user_id']; ?>'><?php echo $users['enc_first_name'] . " " . $users['enc_last_name'] ?></option>

                                <?php endforeach; ?>
                            </select>

                        </div>

                        <div class="form-group">

                            <label>Add Member</label>

                            <select class="form-control adv-search select2 edit_team_member" style="width:100%" id="edit_team_member" multiple="multiple" type="text" name='team_member[]' required>

                                <option value=''>Select Team Member</option>
                                <?php foreach ($userList as $users): ?>

                                    <option data-img='<?php echo $users['profile_picture_path']; ?>' value='<?php echo $users['user_id']; ?>'><?php echo $users['enc_first_name'] . " " . $users['enc_last_name'] ?></option>

                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                </div>


                <div class="clearfix"></div>
                <label>Setting</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p>
                                <label>
                                    <input type="checkbox" id="edit_check_rota"> Assign to Rota
                                </label>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Rota Groups</label>

                        <select class="form-control select2"  type="text" name='rota_type' id='edit_rota_type'>

                            <option value=''>Select Rota Groups</option>

                            <?php
                            foreach ($rota_categories as $rotaCat) {
                                echo "<option value='" . $rotaCat['name'] . "'>" . $rotaCat['name'] . "</option>";
                            }
                            ?>

                        </select>

                    </div>
                </div>
                <div class="clearfix"></div> 
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p>
                                <label>
                                    <input type="checkbox"> Assign to Project
                                </label>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label>Project Groups</label>

                        <select class="form-control select2"  type="text" name='' id=''>

                            <option value=''>Select Project Groups</option>                          

                        </select>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">

                    <label>Description</label>

                    <textarea rows="4" class="form-control summernote" placeholder="Enter your message here"  name='description' id="edit_description" required></textarea>

                </div>






                <div class="submit-section">

                    <button type='submit' class="btn btn-primary submit-btn" id='cst-add-form-btn'>Update</button>

                </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Team Modal -->

