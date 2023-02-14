<!-- Page Header -->
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">Upload CSV</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Upload CSV</li>
			</ul>
		</div>
		
	</div>
</div>
<br /></br>
<!-- /Page Header -->
<!-- /Search Filter -->
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped custom-table mb-0">
				<thead>
					<tr>
						<th>#</th>
						<th>PathHub Index
                        </th>
						<th><select>
                        <option selected="selected">Category</option>
                        <option>Department</option>
                        <option>Billing Code</option>
                        <option>Description</option>
                        <option>Rate</option>
                        <option>Country</option>                                                                        
                        </select></th>
						<th><select>
                        <option >Category</option>
                        <option selected="selected">Department</option>
                        <option>Billing Code</option>
                        <option>Description</option>
                        <option>Rate</option>
                        <option>Country</option>                                                                        
                        </select></th>
						<th><select>
                        <option >Category</option>
                        <option >Department</option>
                        <option selected="selected">Billing Code</option>
                        <option>Description</option>
                        <option>Rate</option>
                        <option>Country</option>                                                                        
                        </select></th>
						<th> <select>
                        <option >Category</option>
                        <option >Department</option>
                        <option >Billing Code</option>
                        <option selected="selected">Description</option>
                        <option>Rate</option>
                        <option>Country</option>                                                                        
                        </select></th>
						<th><select>
                        <option >Category</option>
                        <option >Department</option>
                        <option >Billing Code</option>
                        <option >Description</option>
                        <option selected="selected">Rate</option>
                        <option>Country</option>                                                                        
                        </select> </th>
                        <th><select>
                        <option >Category</option>
                        <option >Department</option>
                        <option >Billing Code</option>
                        <option >Description</option>
                        <option >Rate</option>
                        <option selected="selected">Country</option>                                                                        
                        </select></th>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Path-0011</td>
						<td>Pathology </td>
						<td>Histopathology </td>
						<td>88300</td>
						<td>unit of service for gross and microscopic surgical pathology</td>
						<td>10</td>
						<td>UK/GPY</td>						
					</tr>
					<tr>
						<td>2</td>
						<td>Path-0011</td>
						<td>Pathology </td>
						<td>Histopathology </td>
						<td>88300</td>
						<td>unit of service for gross and microscopic surgical pathology</td>
						<td>10</td>
						<td>UK/GPY</td>						
					</tr>
					<tr>
						<td>3</td>
						<td>Path-0011</td>
						<td>Pathology </td>
						<td>Histopathology </td>
						<td>88300</td>
						<td>unit of service for gross and microscopic surgical pathology</td>
						<td>10</td>
						<td>UK/GPY</td>
						
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="http://localhost/uralensiswebapp/pathhub/assets/newtheme/js/jquery-3.2.1.min.js"></script>
<!-- Jquery UI -->
<script src="http://localhost/uralensiswebapp/pathhub/assets/js/jquery-ui.js"></script>
<script>
$("#hide_div").click(function(){
  $("#upload_csv").hide(1000);
});

$("#show_div").click(function(){
  $("#upload_csv").show(1000);
});
</script>
<!-- /Page Content -->