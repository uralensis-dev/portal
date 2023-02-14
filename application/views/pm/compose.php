<?php
$this->load->library('session');
$MAX_INPUT_LENGTHS = $this->config->item('$MAX_INPUT_LENGTHS', 'pm');
$recipients_value = '';

$recipients_max_len = 400;
if (isset($MAX_INPUT_LENGTHS) && !is_null($MAX_INPUT_LENGTHS)) {
	$recipients_max_len = $MAX_INPUT_LENGTHS[PM_RECIPIENTS];
}

$recipients = array(
	'name' => PM_RECIPIENTS,
	'id' => PM_RECIPIENTS,
	'value' => $recipients_value,
	'maxlength' => $recipients_max_len,
	'size' => 40,
);


$subject_value = '';
if (isset($message) && !is_null($message)) {
	$subject_value = set_value(TF_PM_SUBJECT, $message[0]['TF_PM_SUBJECT']);
}
$subject_max_len = 100;
if (isset($MAX_INPUT_LENGTHS) && !is_null($MAX_INPUT_LENGTHS)) {
	$subject_max_len = $MAX_INPUT_LENGTHS[TF_PM_SUBJECT];
}

$subject = array(
	'name' => TF_PM_SUBJECT,
	'id' => TF_PM_SUBJECT,
	'value' => $subject_value,
	'maxlength' => $subject_max_len,
	'size' => 40
);
// set_value(TF_PM_BODY, $message[TF_PM_BODY])
$body = array(
	'name' => TF_PM_BODY,
	'id' => TF_PM_BODY,
	'value' => '',
	'cols' => 80,
	'rows' => 5
);
?>


<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Compose</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo site_url('auth/index'); ?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Compose</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<?php
                $user_email = $this->ion_auth->user()->row()->enc_email;
//                echo "<pre>";print_r($message);exit;

                $attributes = ['class' => 'email', 'id' => 'pm_form', 'name' => 'pm_form', 'autocomplete' => 'off'];
				echo form_open_multipart('pm/SendMessage', $attributes);

				?>
				<div class="form-group">
<!--					<input class="form-control" list="desc" placeholder="To" name="recipients" value="--><?php //echo  (isset($userinfo) && $userinfo->email != '') ? $userinfo->email : ''; ?><!--" required>-->
<!--					<datalist id="desc">-->
<!--						--><?php //foreach ($userList as $rec) {
//
//						?>
<!--							<option value="--><?php //echo  $rec['email'] ?><!--">--><?php //echo  $rec['first_name'] . " " . $rec['last_name'] ?>
<!--							</option>-->
<!--						--><?php //} ?>
<!---->
<!---->
<!--					</datalist>-->
                    <label class="">To:</label>
                    <select class="class-select2" name="recipients[]" multiple>
                        <?php foreach ($userList as $rec) {

                            ?>
                            <option title="<?php echo  $rec['profile_picture_path'] ?>" value="<?php echo  $rec['email'] ?>" <?php echo (in_array($rec['id'],$messageTo)?"selected":"");?>><?php echo  $rec['first_name'] . " " . $rec['last_name'] ?>
                            </option>
                        <?php } ?>

                    </select>

					<input type="hidden" name="message_id" value="<?php echo(isset($message_id)? $message_id:''); ?>" />
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
                            <?php
                            $searchArray = explode(";",$message[0]['privmsg_cc']);
                            $pos = array_search($user_email, $searchArray);
                            unset($searchArray[$pos]);
                            ?>
                            <!--							<input type="email" placeholder="Cc" class="form-control" name="email_cc" value="--><?php //echo $message[0]['privmsg_cc'] ?><!--">-->
                            <label class="">CC:</label>
                            <select class="class-select2" name="email_cc[]" multiple>
                                <?php foreach ($userList as $rec) {

                                    ?>
                                    <option title="<?php echo  $rec['profile_picture_path'] ?>" value="<?php echo  $rec['email'] ?>" <?php echo (in_array($rec['email'],$searchArray)?"selected":"");?>><?php echo  $rec['first_name'] . " " . $rec['last_name'] ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
                            <?php
                            $searchArray = explode(";",$message[0]['privmsg_bcc']);
                            $pos = array_search($user_email, $searchArray);
                            unset($searchArray[$pos]);
                            ?>
<!--							<input type="email" placeholder="Bcc" class="form-control" name="email_bcc" value="--><?php //echo $message[0]['privmsg_bcc']  ?><!--">-->
                            <label class="">BCC:</label>
                            <select class="class-select2" name="email_bcc[]" multiple>
                                <?php foreach ($userList as $rec) {

                                    ?>
                                    <option title="<?php echo  $rec['profile_picture_path'] ?>" value="<?php echo  $rec['email'] ?>" <?php echo ((isset($draft) && $draft != "") ? (in_array($rec['email'],$searchArray)?"selected":""):"");?>><?php echo  $rec['first_name'] . " " . $rec['last_name'] ?>
                                    </option>
                                <?php } ?>

                            </select>
                        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                            <label class="">Attachment:</label>
							<input type="file" class="form-control" name="files[]" multiple />

						</div>
					</div>

				</div>
				<div class="form-group">
                    <label class="">Subject:</label>
					<?php if (isset($draft) && $draft != "") { ?>
						<input type="text" name="privmsg_subject" placeholder="Subject" value="<?php echo  $message[0]['privmsg_subject'] ?>" class="form-control" required>
                        <input type="hidden" name="draft_id" value="<?php echo $message[0]['privmsg_id']; ?>"  />

					<?php } else {
					?>
						<input type="text" name="privmsg_subject" placeholder="Subject" value="<?php echo  (isset($message) && $message[0]['privmsg_subject'] != '') ? "RE:" . $message[0]['privmsg_subject'] : ''; ?>" class="form-control" required>

					<?php
					} ?>
				</div>
				<div class="form-group">
                    <label class="">Message:</label>
					<?php if (isset($draft) && $draft != "") { ?>
						<textarea rows="4" name="privmsg_body" class="form-control" placeholder="Enter your message here" required><?php echo  $message[0]['privmsg_body'] ?></textarea>
					<?php } else { ?>
						<textarea rows="4" name="privmsg_body" class="form-control" placeholder="Enter your message here" required><?php if (isset($message) && $message[0]['privmsg_body'] != "") echo "\n\n=============================\n".$message[0]['privmsg_body']; ?></textarea>
					<?php } ?>
				</div>
				<div class="form-group mb-0">
					<div class="text-center">
						<button class="btn btn-primary" type="submit" name="send" value="1"><span>Send</span> <i class="fa fa-send m-l-5"></i></button>
						<button class="btn btn-success m-l-5" type="submit" name="send" value="2"><span>Draft</span> <i class="fa fa-floppy-o m-l-5"></i></button>
<!--						<button class="btn btn-success m-l-5" type="button" onClick="deletecompose()"><span>Delete</span> <i class="fa fa-trash-o m-l-5"></i></button>-->
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<!-- /Page Content -->

</div>
<!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<script>
	$(document).ready(function() {
		$('input:submit').click(function(e) {
			if (!$.validate())
				e.preventDefault();
		});
	});
</script>