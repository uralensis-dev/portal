<p>Hello <?php echo $userDetails->first_name;?>,</p>

<p>Your account has been created successfully. You can change the account password from following link.</p>
<?php
$email = encrypt_data($userDetails->id."____".$userDetails->email);
$url = base_url()."auth/password_change/$email"

?>
<p><a href="<?php echo $url?>">Change Password</a></p>

<p>Regards<br />
    Support Team</p>

<p>&nbsp;</p>
