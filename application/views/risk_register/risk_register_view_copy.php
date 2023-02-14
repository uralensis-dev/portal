<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h4>Risk Management</h4>
<div class="container px-lg-5">
<?php
foreach ($result as $key => $value) {
	if($key == "risk_level") {
		$key = "Risk Level";
		if($value == 'E') $value = "Extreme";
		if($value == 'H') $value = 'High';
		if($value == 'M') $value = 'Moderate';
		if($value == 'L') $value = 'Low';
	}
	echo "<div class='row mx-lg-n0'><div class='col py-3 px-lg-5 border bg-light'>".$key."</div><div class='col py-3 px-lg-5 border bg-light'>".$value."</div></div>";
}

?>
  
  
</div>

<?php if(!empty($comment)): ?>
<div class=" container row">
	<h4 class="mt-3">Recent Comments</h4>
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Comment</th>
	      <th scope="col">Next Reveion Date</th>
	    </tr>
	  </thead>
	  <tbody>
	  <?php $counter = 1;
	  foreach ($comment as $key => $value):
	  	echo "<tr><th scope='row'>".$counter++."</th><td>".$value['comment']."</td><td>".$value['next_revision_date']."</td></tr>";
	  endforeach; ?>
	    
	  </tbody>
	</table>
</div>
<?php endif; ?>


  <?php echo form_open('', array('id' => 'add-risk-comment', 'class' => 'tg-formtheme tg-editform create_user_form')); ?>
<h3 class="mt-2">Add a Comment</h3>
<div class="row d-flex">
  <div class="col-md-8 col-lg-6">
    <div class="card shadow-0 border" style="background-color: #f0f2f5;margin-top: 1%">
      <div class="card-body p-4">
        <div class="form-outline mb-4">
        <label>Comment</label>
          <textarea name="add_comment" class="form-control"></textarea>
          <!-- <input type="text" name="add_comment" class="form-control" placeholder="Type comment..." /> -->
        </div>
         <div class="form-outline mb-4">
         	<label>Severty</label>
	        <select class="form-control" name="severty">
	        	<option value="">Select Severity </option>
			    <?php foreach ($severity as $crow) : ?>
                    <option value="<?php echo $crow['id'] ?>"><?php echo $crow['name']; ?></option>
                <?php endforeach; ?>
	        </select>
        </div>

        <div class="form-outline mb-4">
         	<label>Next Revision Date</label>
	        <input type="date" name="next_revision_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Comment</button>
       
      </div>
    </div>
  </div>
</div>
</form>