<p>Hello <?php echo $user->first_name.' '.$user->last_name; ?>, </p>
<br>
<p>A ticket has been assigned to you by <?php echo $requestor->first_name.' '.$requestor->last_name; ?></p>
<p><strong>Ticket Details</strong></p>
<p>Type: <?php echo $ticket['ticket_type']; ?></p>
<p>Subject: <?php echo $ticket['ticket_subject']; ?></p>
<p>Message: <?php echo $ticket['ticket_message']; ?></p>
<p>Priority: <?php echo $ticket['ticket_priority']; ?></p>
<p>Status: <?php echo $ticket['ticket_status']; ?></p>
<p>Date: <?php echo $ticket['ticket_created_on']; ?></p>