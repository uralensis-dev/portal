<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
</head>
<body>

	<table style="width: 100%; max-width: 450px; margin: 0 auto; border:1px solid #ddd; border-radius: 5px" cellpadding="0" cellpadding="0">
		<tr>
			<td align="center"><img src="<?php echo base_url(); ?>uploads/logo/pathhub_logo.png" alt="pathhub_logo" style="margin: 20px 0 50px;"></td>
		</tr>
		<tr>
			<td>
				<div style="padding:0 20px; margin-bottom: 20px; box-sizing: border-box;">
					Hello <span><?php echo $first_name; ?></span> ,
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding: 0 20px; margin-bottom: 20px; box-sizing: border-box;">
					A new web browser is just signed in your PathHub account. To help keep your account secure , let us know  if this is you.
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="margin:0 20px; padding: 15px; box-sizing: border-box; margin-bottom: 20px; background:#ecf0f1; border-radius: 5px;">
					<p style="margin: 0 0 15px;"><strong>Is this you?</strong></p>
					<p style="margin: 0 0 15px;">
						<span style="margin-left: 30px;">When :</span>
<!--                        July 30, 2021 at 3:04 PM (GMT)-->
                        <strong><?php echo date("F d, Y")." at ".date("h:i A");?></strong>
					</p>
                    <p style="margin: 0 0 15px;">
                        <span style="margin-left: 30px;">Where :</span>
                        <!--                        July 30, 2021 at 3:04 PM (GMT)-->
                        <strong><?php
                            $this->db->where('ip_address',$client_ip);
                            $ip_info = $this->db->get('ip_location')->row_array();
//                            $ip_info = ip_info($client_ip);
                            echo $ip_info['city'].", ".$ip_info['region_name'].", ".$ip_info['country_name'];
                            ?></strong>
                    </p>
					<p style="margin: 0 0 15px;">
						<span style="margin-left: 30px;">What :</span>
						<strong><?php echo $client_user_agent; ?> on <?php echo $user_agent_platform; ?></strong>
					</p>
					<p style="margin: 0 0 15px;">
						<ul style="padding:0 30px; list-style:none;text-align: center;">
							<li style="display: inline-block;">
                                <?php
                                $userDataYes = base64_encode($session_userid."___".$client_ip."___1");
                                $userDataNo = base64_encode($session_userid."___".$client_ip."___2");
                                ?>
								<a href="<?php echo base_url()?>auth/verifyActivity/<?php echo $userDataYes;?>" style="display: inline-block; padding:8px 35px;background: #f5f5f5; border:1px solid #ddd; text-decoration: none; color: #000; font-weight: bold;">Yes</a>
							</li>
							<li style="display: inline-block;">
								<a href="<?php echo base_url()?>auth/verifyActivity/<?php echo $userDataNo;?>" style="display: inline-block; padding:8px 35px;background: #f5f5f5; border:1px solid #ddd; text-decoration: none; color: #000; font-weight: bold;">No</a>
							</li>
						</ul>
						
					</p>
<!--					<p>-->
<!--						<a href="" style="font-weight: 500; color: blue; text-decoration: none;">I am not sure</a>-->
<!--					</p>-->
<!--					-->
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div style="padding: 0 20px; margin-bottom: 20px; box-sizing: border-box;">
					<p>
						Learn more on how to <a href="" style="font-weight: 500; color: blue; text-decoration: none;">protect your account.</a>
					</p>
					<p>
						Thanks,
					</p>
					<p>
                        The Pathhub Team
					</p>
				</div>
			</td>
		</tr>
	</table>

</body>
</html>