<!-- Add Today Work Modal -->
<div id="addTodayWorkModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Today Work details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $attributes = array('id' => 'addUserTaskForm');
                echo form_open(current_url(), $attributes);
                ?>
                <!--                <form>-->
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>User ID
                            <?php
                            $user_id= $this->ion_auth->user()->row()->id;
                            $userinfo = getLoggedInUserProfile(intval($user_id));
                            $generated_user_id = $this->Userextramodel->generate_userid(intval($user_id));
                            ?>
                            <span class="user-img">
                            <img style="border-radius: 50%;width: 25px;height: 25px"
                                 src="<?php echo get_profile_picture($userinfo[0]->profile_picture_path, $userinfo[0]->first_name, $userinfo[0]->last_name); ?>"
                                 alt="">
                            </span>
                            <span><?php echo $userinfo[0]->first_name . ' ' . $userinfo[0]->last_name; ?></span>
                        </label>
                        <input type="text" name="user_id" value="<?php echo $generated_user_id; ?>" class="form-control"
                               disabled="disabled"/>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Date<span class="text-danger"></span></label>
                        <input type="text" class="form-control" value="<?php echo date("Y-m-d")?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label>Start Time<span class="text-danger"></span></label>
                        <input type="text" class="form-control" value="<?php echo date("h:i A",strtotime($start_time))?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Task Detail <span class="text-danger">*</span></label>
                    <textarea rows="4" id="task_detail" name="task_detail" class="form-control"></textarea>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Submit</button>
                </div>
                <?php echo form_close()?>
            </div>
        </div>
    </div>
</div>
<!-- /Add Today Work Modal -->

<script>
    if ($(".update_session_timer")[0]){
        // Do something if class exists
        setInterval(function () {
            $.ajax({
                type: "POST",
                url: _base_url + '/timesheet/updateSessionTime',
                data: {[csrf_name]: csrf_hash},
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $(".update_session_timer").text(response.totalDurationSessionTime)
                    }
                }
            });
            return false; // required to block normal submit since you used ajax
        }, 20000);
    }

    $("#addUserTaskForm").validate({
        // ignore: ":hidden",
        rules: {
            task_detail: {
                required: true
            }
        },
        submitHandler: function (form) {

            // console.log(form);return false;

            $.ajax({
                type: "POST",
                url: _base_url + '/timesheet/addTask',
                data: $(form).serialize(),
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#addTodayWorkModal').modal('hide');
                        // $("#specimen_" + specimenId + " .block_table").append(response.data);
                        $.sticky(response.message, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        location.reload();
                    } else {
                        $.sticky(response.message, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
</script>