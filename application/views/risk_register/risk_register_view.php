<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
.risk-manage h2 {
    padding: 10px 0px;
    background: #0161d2;
    text-align: center;
    width: 100%;
    color: #fff;
    font-size: 22px;
    margin: 0;
    margin-top: 30px;
}

.img_cont_msg {
    height: 40px;
    width: 40px;
}
.user_img_msg {
    height: 40px;
    width: 40px;
    border: 1.5px solid #f5f6fa;
}
.msg_cotainer {
    margin-top: auto;
    min-width: 137px;
    margin-bottom: auto;
    margin-left: 10px;
	min-width: 80px;
    border-radius: 25px;
    background-color: #82ccdd;
    padding: 10px;
    position: relative;
}
.msg_time {
    position: absolute;
    left: 0;
    bottom: -15px;
    color: #000;
    font-size: 10px;
}
.chat-box .card {
    height: 400px;
    border-radius: 0px !important;
    background-color:#eeee!important;
}
.msg_cotainer_send {
    margin-top: auto;
    margin-bottom: auto;
    margin-right: 10px;
    min-width: 137px;
    border-radius: 25px;
    background-color: #78e08f;
    padding: 10px;
    position: relative;
    text-align: right;
}
.msg_time_send {
    position: absolute;
    right: 0;
    bottom: -15px;
    color: #000;
    font-size: 10px;
}
.card-footer {
    padding: .75rem 1.25rem;
    background-color: #ffffff;
    border-top: 1px solid rgba(0,0,0,.125);
}
.card-footer {
    border-radius: 0 0 15px 15px !important;
    border-top: 0 !important;
}
.input-group-append {
    margin-left: -1px;
}
.attach_btn {
    border-radius: 15px 0 0 15px !important;
    background-color: rgba(0,0,0,0.3) !important;
    border: 0 !important;
    color: white !important;
    cursor: pointer;
}
.type_msg {
    background-color: rgba(0,0,0,0.3) !important;
    border: 0 !important;
    color: white !important;
    height: 60px !important;
    overflow-y: auto;
}   
.send_btn {
    border-radius: 0 15px 15px 0 !important;
    background-color: rgba(0,0,0,0.3) !important;
    border: 0 !important;
    color: white !important;
    cursor: pointer;
}
.send_btn i{
    font-size: 18px;
}
.msg_card_body {
    overflow-y: auto;
}
h4.mt-3 {
    background: #007cdd;
    width: 97.5%;
    border-bottom: 2px solid #34444c;
    margin-left: 15px!important;
    box-shadow: 0 0 10px #fff;
    padding: 12px 10px;
    margin: 0 auto;
    color: #fff;
}
.col-sm-6.form-outline.mb-4 {
    float: left;
}
</style>	
<div class="page-header" style="margin-bottom: 5px;">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Risk Management Section</h3>
            <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('Document') ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('Risk_Register'); ?>">Risk Register</a></li>
            </ul>
        </div>
       
      
    </div>
</div>

<div class="container risk-manage">
<div class="row mx-lg-n0">	
<h2>Risk Management</h2></div>

<div class='row mx-lg-n0'>
<?php
foreach ($result as $key => $value) {
	if($key == "risk_level") {
		$key = "Risk Level";
		if($value == 'E') $value = "Extreme";
		if($value == 'H') $value = 'High';
		if($value == 'M') $value = 'Moderate';
		if($value == 'L') $value = 'Low';
	}
	echo "<div class='col-sm-3 py-3 px-lg-5 border bg-light'>".$key."</div><div class='col-sm-3 py-3 px-lg-5 border bg-light'>".$value."</div>";
}

?>
  </div>
  
</div>

<?php if(!empty($comment)): ?>
<div class="row">
	<h4 class="mt-3">Recent Comments</h4>

	
<div class="col-sm-12 chat-box">
    <div class="card">
      <div class="card-body msg_card_body">

      		<?php 
      		foreach ($comment as $key => $value) :

      			// $created_at = date_create($value['created_at']);
         		//$view_date = date_format($created_at,'d-M-Y');

                // Next revision date
                $next_rev = date_create($value['next_revision_date']);
                $next_revision_date = date_format($next_rev,'d-M-Y');

                $user_id = $value['user_id'];
                if($key == 0) $old_user_id = $user_id;
                if($old_user_id == $value['user_id']){
                	echo '<div class="d-flex justify-content-end mb-4"><div class="msg_cotainer_send">'.$value['comment'].'<span class="msg_time_send"> Next Revision on '.$next_revision_date.'</span></div><div class="img_cont_msg"><img src="'.$value['user_img'].'" class="rounded-circle user_img_msg"></div></div>';
                	$old_user_id = $comment[$key]['user_id'];
                }
                else {
                	echo '<div class="d-flex justify-content-start mb-4"><div class="img_cont_msg"><img src="'.$value['user_img'].'" class="rounded-circle user_img_msg"></div><div class="msg_cotainer">'.$value['comment'].'<span class="msg_time"> Next Revision on '.$next_revision_date.'</span></div></div>';
                }
      			
      		endforeach;

      		 ?>
        </div>
    </div>


	<!---<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Comment</th>
	      <th scope="col">Next Reveion Date</th>
	    </tr>
	  </thead>
	  <tbody>
	  <//? php $counter = 1;
	  foreach ($comment as $key => $value):
	  	echo "<tr><th scope='row'>".$counter++."</th><td>".$value['comment']."</td><td>".$value['next_revision_date']."</td></tr>";
	  endforeach; ?>
	    
	  </tbody>
	</table>  -->
</div>
	</div>
<?php endif; ?>


  <?php echo form_open('', array('id' => 'add-risk-comment', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
<h3 class="mt-2">Add a Comment</h3>
<div class="row d-flex">
  <div class="col-md-6 col-lg-12">
    <div class="card shadow-0 border" style="background-color: #f0f2f5;margin-top: 1%">
      <div class="card-body p-4">
        <div class="col-sm-12 form-outline mb-4">
        <label>Comment</label>
          <textarea name="add_comment" class="form-control" required="required"></textarea>
          <!-- <input type="text" name="add_comment" class="form-control" placeholder="Type comment..." /> -->
        </div>
         <div class="col-sm-6 form-outline mb-4">
         	<label>Severty</label>
	        <select class="form-control" name="severty" required="required">
	        	<option value="">Select Severity </option>
			    <?php foreach ($severity as $crow) : ?>
                    <option value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                <?php endforeach; ?>
	        </select>
        </div>

        <div class="col-sm-6 form-outline mb-4">
         	<label>Next Revision Date</label>
	        <input type="date" name="next_revision_date" class="form-control" required="required" value="<?php echo date("Y-m-j"); ?>">
        </div>

		<div class="box">
        <button type="submit" style="margin-left:15	px;" class="btn btn-primary">Add Comment</button>
				</div>
       
      </div>
    </div>
  </div>
</div>
</form>