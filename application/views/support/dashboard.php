<style type="text/css">
	.freq_search {
	    width: 25%;
	}
	.faq-card .card-body {
	    max-height: 300px;
	    overflow-y: auto;
	}
	.images_list{overflow: hidden;}
	.images_list li{
		float: left;
		width: 30%;
		margin-right: 10px;
		margin-bottom: 10px;
	}
	.images_list li:nth-child(3n){
		margin-right: 0;
	}
	.images_list li img{width: 100%	}
	@media screen and (min-width: 1600px) {
		body{font-size: 18px;}
		.form-focus .form-control,.form-focus .select2-container .select2-selection--single{height: 70px; font-size: 18px;}
		.form-focus .focus-label{font-size: 18px;}
		.form-focus .form-control:focus ~ .focus-label, .form-focus .form-control:-webkit-autofill ~ .focus-label,
		.form-focus.select-focus .focus-label{font-size: 14px;}
		.form-focus .select2-container--default .select2-selection--single .select2-selection__rendered{font-size: 18px; line-height: 50px}
	}
</style>

<!-- Page Header -->
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">PathHub Support Centre</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo  site_url('/admin/home'); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Support</li>
            </ul>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Add Ticket</a>
		</div>
	</div>
</div>


<div class="row" style="min-height: 80vh">
	<div class="col-lg-8 message-view task-view task-left-sidebar">
		<div class="chat-window">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group form-focus">
						<input type="text" class="form-control floating">
						<label class="focus-label">What are you searching for?</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group form-focus select-focus">
						<select class="select floating"> 
							<option>Pathologist</option>
							<option>Pathologist</option>
							<option>Pathologist</option>
							
						</select>
						<label class="focus-label">Select a Topic</label>
					</div>
				</div>
			</div>
			<div class="faq-card">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							<a class="collapsed" data-toggle="collapse" href="#collapseOne">How to login?</a>
						</h4>
					</div>
					<div id="collapseOne" class="card-collapse collapse">
						<div class="card-body">
							<p>To login in central PathHub must have set up your account as there is no online registration for security. Once your registration is working you will be sent the password details securely and the system will allow you to change the password on first login. You will also need to add a token for each visit and your activity is monitored. Please view the accompanying video.</p>
							
							<ul class="images_list">
								<li class="list-inline-item">
									<script type="text/javascript" async src="https://play.vidyard.com/embed/v4.js"></script>
									<img
									  style="width: 100%; margin: auto; display: block;"
									  class="vidyard-player-embed"
									  src="https://play.vidyard.com/5H8PiiHohyMUh8E1gjjrHB.jpg"
									  data-uuid="5H8PiiHohyMUh8E1gjjrHB"
									  data-v="4"
									  data-type="inline"
									/>
								</li>
								<li class="list-inline-item">
									<script type="text/javascript" async src="https://play.vidyard.com/embed/v4.js"></script>
									<img
									  style="width: 100%; margin: auto; display: block;"
									  class="vidyard-player-embed"
									  src="https://play.vidyard.com/5Tij6UszTvr8UGt9img1WF.jpg"
									  data-uuid="5Tij6UszTvr8UGt9img1WF"
									  data-v="4"
									  data-type="inline"
									/>
									
								</li>
								<li class="list-inline-item">
									<script type="text/javascript" async src="https://play.vidyard.com/embed/v4.js"></script>
									<img
									  style="width: 100%; margin: auto; display: block;"
									  class="vidyard-player-embed"
									  src="https://play.vidyard.com/MBiaqn73qTyK7fY4z7EunY.jpg"
									  data-uuid="MBiaqn73qTyK7fY4z7EunY"
									  data-v="4"
									  data-type="inline"
									/>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							<a class="collapsed" data-toggle="collapse" href="#collapseTwo">How do I Bookin a case ?</a>
						</h4>
					</div>
					<div id="collapseTwo" class="card-collapse collapse">
						<div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
							<p>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							<a class="collapsed" data-toggle="collapse" href="#collapseThree">How do I change my password ?</a>
						</h4>
					</div>
					<div id="collapseThree" class="card-collapse collapse">
						<div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
							<p>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							<a class="collapsed" data-toggle="collapse" href="#collapseFour">How do I view a report ? </a>
						</h4>
					</div>
					<div id="collapseFour" class="card-collapse collapse">
						<div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
							<p>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							<a class="collapsed" data-toggle="collapse" href="#collapseFive">How do I authorise a case ? </a>
						</h4>
					</div>
					<div id="collapseFive" class="card-collapse collapse">
						<div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
							<p>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							<a class="collapsed" data-toggle="collapse" href="#collapseFive">What if I cannt remember my PIN ? </a>
						</h4>
					</div>
					<div id="collapseFive" class="card-collapse collapse">
						<div class="card-body">
							<p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
							<p>Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card form-group">
			<div class="card-header">
				<h4 class="card-title">
					Frequently searched Topics
				</h4>
			</div>
			<div class="card-body">
				<ul class="list-unstyled">
					<li class="list-item"><a href="javascript:;">How to login?</a></li>
					<li class="list-item"><a href="javascript:;">How to create user?</a></li>
				</ul>
			</div>
		</div>

		<div class="card form-group">
			<div class="card-header">
				<h4 class="card-title">
					Support Video 
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group form-focus">
						<input type="text" class="form-control floating">
						<label class="focus-label">What video are you searching for?</label>
					</div>
				<ul class="list-unstyled">
					<li class="list-item">
						<video  height="300"  style="width: 100%;" controls autoplay="">
						  <source src="<?php echo base_url()?>assets/videos/Dash-F.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
						<!-- <script type="text/javascript" async src="https://play.vidyard.com/embed/v4.js"></script>
						<img
						  style="width: 100%; margin: auto; display: block;"
						  class="vidyard-player-embed"
						  src="https://play.vidyard.com/MBiaqn73qTyK7fY4z7EunY.jpg"
						  data-uuid="MBiaqn73qTyK7fY4z7EunY"
						  data-v="4"
						  data-type="inline"
						/> -->
					</li>
					<li class="list-item">
						<video  height="300" style="width: 100%;" controls autoplay="">
						  <source src="<?php echo base_url()?>assets/videos/Login.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>

						<!-- <script type="text/javascript" async src="https://play.vidyard.com/embed/v4.js"></script>
						<img
						  style="width: 100%; margin: auto; display: block;"
						  class="vidyard-player-embed"
						  src="https://play.vidyard.com/5Tij6UszTvr8UGt9img1WF.jpg"
						  data-uuid="5Tij6UszTvr8UGt9img1WF"
						  data-v="4"
						  data-type="inline"
						/> -->
					</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- <div class="col-lg-3">
		<div class="chat-main-row" style="top:150px;">
			<div class="chat-main-wrapper">
				<div class="message-view task-chat-view task-right-sidebar" id="task_window">

				</div>
			</div>
		</div>
		<div class="chat-window">
			<div class="fixed-header">
				<div class="navbar">
					<div class="task-assign">
						<a class="task-complete-btn" id="task_complete" href="javascript:void(0);">
							<i class="material-icons">check</i> Mark Ticket Complete
						</a>
					</div>
					<ul class="nav float-right custom-menu">
						<li class="dropdown dropdown-action">
							<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="javascript:void(0)">Delete Ticket</a>
								<a class="dropdown-item" href="javascript:void(0)">Settings</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="chat-contents task-chat-contents">
				<div class="chat-content-wrap">
					<div class="chat-wrap-inner">
						<div class="chat-box">
							<div class="chats">
								<h4>Hospital Administration Phase 1</h4>
								<div class="task-header">
									<div class="assignee-info">
										<a href="#" data-toggle="modal" data-target="#assignee">
											<div class="avatar">
												<img alt="" src="assets/img/profiles/avatar-02.jpg">
											</div>
											<div class="assigned-info">
												<div class="task-head-title">Assigned To</div>
												<div class="task-assignee">John Doe</div>
											</div>
										</a>
										<span class="remove-icon">
											<i class="fa fa-close"></i>
										</span>
									</div>
									<div class="task-due-date">
										<a href="#" data-toggle="modal" data-target="#assignee">
											<div class="due-icon">
												<span>
													<i class="material-icons">date_range</i>
												</span>
											</div>
											<div class="due-info">
												<div class="task-head-title">Due Date</div>
												<div class="due-date">Mar 26, 2019</div>
											</div>
										</a>
										<span class="remove-icon">
											<i class="fa fa-close"></i>
										</span>
									</div>
								</div>
								<hr class="task-line">
								<div class="task-desc">
									<div class="task-desc-icon">
										<i class="material-icons">subject</i>
									</div>
									<div class="task-textarea">
										<textarea class="form-control" placeholder="Description"></textarea>
									</div>
								</div>
								<hr class="task-line">
								<div class="task-information">
									<span class="task-info-line"><a class="task-user" href="#">Lesley Grauer</a> <span class="task-info-subject">created task</span></span>
									<div class="task-time">Jan 20, 2019</div>
								</div>
								<div class="task-information">
									<span class="task-info-line"><a class="task-user" href="#">Lesley Grauer</a> <span class="task-info-subject">added to Hospital Administration</span></span>
									<div class="task-time">Jan 20, 2019</div>
								</div>
								<div class="task-information">
									<span class="task-info-line"><a class="task-user" href="#">Lesley Grauer</a> <span class="task-info-subject">assigned to John Doe</span></span>
									<div class="task-time">Jan 20, 2019</div>
								</div>
								<hr class="task-line">
								<div class="task-information">
									<span class="task-info-line"><a class="task-user" href="#">John Doe</a> <span class="task-info-subject">changed the due date to Sep 28</span> </span>
									<div class="task-time">9:09pm</div>
								</div>
								<div class="task-information">
									<span class="task-info-line"><a class="task-user" href="#">John Doe</a> <span class="task-info-subject">assigned to you</span></span>
									<div class="task-time">9:10pm</div>
								</div>
								<div class="chat chat-left">
									<div class="chat-avatar">
										<a href="profile.html" class="avatar">
											<img alt="" src="assets/img/profiles/avatar-02.jpg">
										</a>
									</div>
									<div class="chat-body">
										<div class="chat-bubble">
											<div class="chat-content">
												<span class="task-chat-user">John Doe</span> <span class="chat-time">8:35 am</span>
												<p>I'm just looking around.</p>
												<p>Will you tell me something about yourself? </p>
											</div>
										</div>
									</div>
								</div>
								<div class="completed-task-msg"><span class="task-success"><a href="#">John Doe</a> completed this task.</span> <span class="task-time">Today at 9:27am</span></div>
								<div class="chat chat-left">
									<div class="chat-avatar">
										<a href="profile.html" class="avatar">
											<img alt="" src="assets/img/profiles/avatar-02.jpg">
										</a>
									</div>
									<div class="chat-body">
										<div class="chat-bubble">
											<div class="chat-content">
												<span class="task-chat-user">John Doe</span> <span class="file-attached">attached 3 files <i class="fa fa-paperclip"></i></span> <span class="chat-time">Feb 17, 2019 at 4:32am</span>
												<ul class="attach-list">
													<li><i class="fa fa-file"></i> <a href="#">project_document.avi</a></li>
													<li><i class="fa fa-file"></i> <a href="#">video_conferencing.psd</a></li>
													<li><i class="fa fa-file"></i> <a href="#">landing_page.psd</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="chat chat-left">
									<div class="chat-avatar">
										<a href="profile.html" class="avatar">
											<img alt="" src="assets/img/profiles/avatar-16.jpg">
										</a>
									</div>
									<div class="chat-body">
										<div class="chat-bubble">
											<div class="chat-content">
												<span class="task-chat-user">Jeffery Lalor</span> <span class="file-attached">attached file <i class="fa fa-paperclip"></i></span> <span class="chat-time">Yesterday at 9:16pm</span>
												<ul class="attach-list">
													<li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="chat chat-left">
									<div class="chat-avatar">
										<a href="profile.html" class="avatar">
											<img alt="" src="assets/img/profiles/avatar-16.jpg">
										</a>
									</div>
									<div class="chat-body">
										<div class="chat-bubble">
											<div class="chat-content">
												<span class="task-chat-user">Jeffery Lalor</span> <span class="file-attached">attached file <i class="fa fa-paperclip"></i></span> <span class="chat-time">Today at 12:42pm</span>
												<ul class="attach-list">
													<li class="img-file">
														<div class="attach-img-download"><a href="#">avatar-1.jpg</a></div>
														<div class="task-attach-img"><img src="assets/img/user.jpg" alt=""></div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div class="task-information">
									<span class="task-info-line">
										<a class="task-user" href="#">John Doe</a>
										<span class="task-info-subject">marked task as incomplete</span>
									</span>
									<div class="task-time">1:16pm</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="chat-footer">
				<div class="message-bar">
					<div class="message-inner">
						<a class="link attach-icon" href="#"><img src="assets/img/attachment.png" alt=""></a>
						<div class="message-area">
							<div class="input-group">
								<textarea class="form-control" placeholder="Type message..."></textarea>
								<span class="input-group-append">
									<button class="btn btn-primary" type="button"><i class="fa fa-send"></i></button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="project-members task-followers">
					<span class="followers-title">Followers</span>
					<a class="avatar" href="#" data-toggle="tooltip" title="Jeffery Lalor">
						<img alt="" src="assets/img/profiles/avatar-16.jpg">
					</a>
					<a class="avatar" href="#" data-toggle="tooltip" title="Richard Miles">
						<img alt="" src="assets/img/profiles/avatar-09.jpg">
					</a>
					<a class="avatar" href="#" data-toggle="tooltip" title="John Smith">
						<img alt="" src="assets/img/profiles/avatar-10.jpg">
					</a>
					<a class="avatar" href="#" data-toggle="tooltip" title="Mike Litorus">
						<img alt="" src="assets/img/profiles/avatar-05.jpg">
					</a>
					<a href="#" class="followers-add" data-toggle="modal" data-target="#task_followers"><i class="material-icons">add</i></a>
				</div>
			</div>
		</div>
	</div> -->
</div>
<!-- 
<div class="chat-main-row" style="top:150px;">
	<div class="chat-main-wrapper">
		
	</div>
</div> -->

<!-- Add Client Modal -->
<div id="add_ticket" class="modal custom-modal fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add Ticket</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Subject <span class="text-danger">*</span></label>
								<input class="form-control" type="text">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-form-label">Topic</label>
								<select class="form-control">
									<option>Select Topic</option>
									<option>Pathologist</option>
									<option>Pathologist</option>
									<option>Pathologist</option>
									<option>Pathologist</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="col-form-label">Message <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="5"></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<button class="btn btn-primary add-btn btn-rounded">Send Ticket</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>