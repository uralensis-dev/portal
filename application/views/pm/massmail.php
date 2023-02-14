<?php
$this->load->library('session');
$MAX_INPUT_LENGTHS = $this->config->item('$MAX_INPUT_LENGTHS', 'pm');
/*$recipients = array(
	'name' => PM_RECIPIENTS,
	'id' => PM_RECIPIENTS,
	'value' => set_value(PM_RECIPIENTS, $message[PM_RECIPIENTS]),
	'maxlength' => $MAX_INPUT_LENGTHS[PM_RECIPIENTS],
	'size' => 40,
);*/
$subject = array(
	'name' => TF_PM_SUBJECT,
	'id' => TF_PM_SUBJECT,
	'value' => set_value(TF_PM_SUBJECT, $message[TF_PM_SUBJECT]),
	'maxlength' => $MAX_INPUT_LENGTHS[TF_PM_SUBJECT],
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

<?php echo form_open($this->uri->uri_string(), array('class' => 'form tg-formtheme tg-editform pm-form2')); ?>
<fieldset>
	
	<div class="form-group tg-inputwithicon">
		<i class="lnr lnr-user"></i>
		<?php echo form_input($subject, '', "class='form-control' placeholder='Subject'"); ?>
		<?php echo form_error($subject['name']); ?>
	</div>
	<div class="form-group tg-inputwithicon" style="width:100%;">
		<i class="lnr lnr-envelope"></i>
		<?php echo form_textarea($body, '', "class='form-control' placeholder='Message'"); ?>
		<?php echo form_error($body['name']); ?>
	</div>
	<div class="tg-btnarea">
		<button type="submit" name="btnSend" id="btnSend" class="tg-btn">Send</button>
		<button type="button" class="tg-btn pull-right saveasdraft">Save As Draft</button>
	</div>
</fieldset>
<?php
/*if (isset($status)) echo $status . ' ';
if ($this->session->flashdata('status')) echo $this->session->flashdata('status') . ' ';
if (!$found_recipients) {
	foreach ($suggestions as $original => $suggestion) {
		echo 'Did you mean <font color="#00CC00">' . $suggestion . '</font> for <font color="#CC0000">' . $original . '</font> ?';
		echo '<br />';
	}
}*/
?>

<?php echo form_close(); ?>
