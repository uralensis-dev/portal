<style>
/* The alert message box */
.alert {
  padding: 20px;
  background-color: #4CAF50; /* Red */
  color: white;
  margin-bottom: 15px;
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
</style>
<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Draft</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo site_url('auth/index'); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Draft</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="<?php echo site_url('pm/compose'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> Compose</a>
								
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					<?php if( isset($type) && $type==1){?>
					<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
 Message has been deleted!!
</div>
<?php } ?>
					<div class="row">
					
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-body">
									<div class="email-header">
										<div class="row">
											<div class="col top-action-left">
												<div class="float-left">
													<!--<div class="btn-group dropdown-action">
														<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down "></i></button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="#">All</a>
															<a class="dropdown-item" href="#">None</a>
															<div class="dropdown-divider"></div> 
															<a class="dropdown-item" href="javascript:" onclick="markasread(1)">Mark As Read</a>
															<a class="dropdown-item" href="javascript:" onclick="markasread(0)">Mark As Unread</a>
														</div>-->
													</div>
													<!--<div class="btn-group dropdown-action">
														<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down "></i></button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="#">Reply</a>
															<a class="dropdown-item" href="#">Forward</a>
															<a class="dropdown-item" href="#">Archive</a>
															<div class="dropdown-divider"></div> 
															<a class="dropdown-item" href="#">Mark As Read</a>
															<a class="dropdown-item" href="#">Mark As Unread</a>
															<div class="dropdown-divider"></div> 
															<a class="dropdown-item" href="#">Delete</a>
														</div>
													</div>
													<!--<div class="btn-group dropdown-action">
														<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i> <i class="fa fa-angle-down"></i></button>
														<div role="menu" class="dropdown-menu">
															<a class="dropdown-item" href="#">Social</a>
															<a class="dropdown-item" href="#">Forums</a>
															<a class="dropdown-item" href="#">Updates</a>
															<div class="dropdown-divider"></div> 
															<a class="dropdown-item" href="#">Spam</a>
															<a class="dropdown-item" href="#">Trash</a>
															<div class="dropdown-divider"></div> 
															<a class="dropdown-item" href="#">New</a>
														</div>
													</div>
													<div class="btn-group dropdown-action">
														<button type="button" data-toggle="dropdown" class="btn btn-white dropdown-toggle"><i class="fa fa-tags"></i> <i class="fa fa-angle-down"></i></button>
														<div role="menu" class="dropdown-menu">
															<a class="dropdown-item" href="#">Work</a>
															<a class="dropdown-item" href="#">Family</a>
															<a class="dropdown-item" href="#">Social</a>
															<div class="dropdown-divider"></div> 
															<a class="dropdown-item" href="#">Primary</a>
															<a class="dropdown-item" href="#">Promotions</a>
															<a class="dropdown-item" href="#">Forums</a>
														</div>
													</div>-->
												</div>
												<!--<div class="float-left d-none d-sm-block">
													<input type="text" placeholder="Search Messages" class="form-control search-message">
												</div>-->
											</div>
											<div class="col-auto top-action-right">
												<div class="text-right">
													<button type="button" title="Refresh" data-toggle="tooltip" class="btn btn-white d-none d-md-inline-block"><i class="fa fa-refresh"></i></button>
													<div class="btn-group">
														<a class="btn btn-white"><i class="fa fa-angle-left"></i></a>
														<a class="btn btn-white"><i class="fa fa-angle-right"></i></a>
													</div>
												</div>
												<div class="text-right">
													<span class="text-muted d-none d-md-inline-block">Showing 10 of 112 </span>
												</div>
											</div>
										</div>
									</div>
									<div class="email-content">
										<div class="table-responsive">
											<table class="table table-inbox table-hover">
												<thead>
													<tr>
														<th colspan="6">
													<!--		<input type="checkbox" class="checkbox-all" onclick="toggle(this)">-->
														</th>
													</tr>
												</thead>
												<tbody>
												<?php
												//debug($messages);exit;
												foreach($draf as $rec){

												
												  ?>
													<tr class="<?php echo $class?>">
														<td>
															<!--<input type="checkbox" class="checkmail" id="emails<?php echo $messages[$i][TF_PM_ID]?>" name="emails" value="<?php echo $messages[$i][TF_PM_ID]?>" onclick="toggle(this)">-->
														</td>
														<td><span class="mail-important"><i class="fa fa-star starred"></i></span></td>
														<td class="name"><?php
																			echo $rec->privmsg_subject;
																			
																			?>
														</td>
														<td class="subject"><a href='<?php echo site_url().'/pm/compose/'.$rec->privmsg_id; ?>/1/'><?php echo $rec->privmsg_body ;?></a></td>
														<!--<td><i class="fa fa-paperclip"></i></td>-->
														<td class="mail-date"><?php echo $rec->privmsg_date; ?></td>
														<td class="mail-date"><a href="javascript:" onclick="deletedraft(<?php echo $rec->privmsg_id?>)">Delete</td>
													</tr>
													<?php }?>
													
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="messages_id" id="messages_id" />
					<script>


				

				function toggle(source) {

						checkboxes = window.document.getElementsByName('emails');
						var idstring="";
						for(var i=0, n=checkboxes.length;i<n;i++) {
							//alert(checkboxes[i].value);
							idstring += checkboxes[i].value + ",";
							checkboxes[i].checked = source.checked;
							if(checkboxes[i].checked)
							{
								window.document.getElementById("messages_id").value = idstring;
							}else{
								var messags = window.document.getElementById("messages_id").value ;
								messags = messags.replace(checkboxes[i].value + ",","");
								window.document.getElementById("messages_id").value = messags;
								
							}
						}

						
						
				}
			

					
					</script>