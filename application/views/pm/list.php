<?php
if(count($messages)>0):?>
<table id="private_message_table"  class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<td width="40%" style="font-weight:bold; background:#F2F2F2; padding:4px;">
				<?php if($type != MSG_SENT) echo 'From'; else echo 'Recipients'; ?>
			</td>
			<td width="25%" style="font-weight:bold; background:#F2F2F2; padding:4px;">
				Subject
			</td>
			<td width="5%" style="font-weight:bold; background:#F2F2F2; padding:4px;">Record</td>
			<td width="15%" style="font-weight:bold; background:#F2F2F2; padding:4px;">
				Date
			</td>
			<?php if($type != MSG_SENT): ?>
			<td width="8%" style="font-weight:bold; background:#F2F2F2; padding:4px;">
				Reply
			</td>
			<?php endif; ?>
			<td width="7%" align="center" style="font-weight:bold; background:#F2F2F2; padding:4px;">
				<?php if($type != MSG_DELETED) echo 'Delete'; else echo 'Restore'; ?>
			</td>
		</tr>
	</thead>
	<tbody>
		<?php for ($i=0; $i<count($messages); $i++): ?>
		<tr style="background:#FCFBF3;">
			<td style="padding:20px;">
				<?php
				if($type != MSG_SENT) echo $messages[$i][TF_PM_AUTHOR];
				else
				{
				  	$recipients = $messages[$i][PM_RECIPIENTS];
					foreach ($recipients as $recipient)
						echo (next($recipients)) ? $recipient.', ' : $recipient;
				}?>
				
			</td>
			<td style="padding:4px;">
				<a href='<?php echo site_url().'/pm/message/'.$messages[$i][TF_PM_ID]; ?>'>
					<?php echo $messages[$i][TF_PM_SUBJECT] ?></a>
			</td>
			<td>
				<?php if(!empty($messages[$i]['record_id'])){
					$record_id = $messages[$i]['record_id'];
					echo anchor('laboratory/view_record/'.$record_id, '<button class="btn btn-primary btn-xs"><i class="fa fa-eye" style="margin-right:5px;"></i> View</button>');
				} ?>
			</td>
			<td style="padding:4px;">
				<?php echo $messages[$i][TF_PM_DATE]; ?>
			</td>
			<?php if($type != MSG_SENT): ?>
			<td style="padding:4px;" class="text-center">
				<?php echo '<a href="'.site_url().'/pm/send/'.$messages[$i][TF_PM_AUTHOR].'/RE&#58;'.$messages[$i][TF_PM_SUBJECT].'/true/'.$messages[$i]['privmsg_id'].'"> <button class="btn btn-info btn-xs"><i class="fa fa-reply"></i> Reply </button> </a>' ?>
			</td>
			<?php endif; ?>
			<td style="padding:4px;" align="center" class="text-center">
				<?php if($type != MSG_DELETED)
					echo '<a href="'.site_url().'/pm/delete/'.$messages[$i][TF_PM_ID].'/'.$type.'"> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button> </a>';
				  else
					echo '<a href="'.site_url().'/pm/restore/'.$messages[$i][TF_PM_ID].'"> <button class="btn btn-primary btn-xs"><i class="fa fa-undo"></i></button> </a>'; ?>
			</td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>
<?php else:?>
<div class="alert alert-danger">No message found.</div>
<?php endif;?>