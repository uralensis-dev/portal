
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
		<div class="sidebar-menu">
			<ul>
				<li> 
					<a href="<?php echo base_url() ?>index.php"><i class="la la-home"></i> <span>Back to AdminHub</span></a>
				</li>
				<li class="active"> 
					<a href="<?php echo base_url() ?>index.php/comms/inbox">Inbox <span class="mail-count">(21)</span></a>
				</li>
				<li> 
					<a href="javascript:;">Starred</a>
				</li>
				<li> 
					<a href="javascript:;">Sent Mail</a>
				</li>
				<li> 
					<a href="javascript:;">Trash</a>
				</li>
				<li> 
					<a href="javascript:;">Draft <span class="mail-count">(8)</span></a>
				</li>
				<li class="menu-title">Label <a href="javascript:;"><i class="fa fa-plus"></i></a></li>
				<li> 
					<a href="javascript:;"><i class="fa fa-circle text-success mail-label"></i> Work</a>
				</li>
				<li> 
					<a href="javascript:;"><i class="fa fa-circle text-danger mail-label"></i> Office</a>
				</li>
				<li> 
					<a href="javascript:;"><i class="fa fa-circle text-warning mail-label"></i> Personal</a>
				</li>
			</ul>
		</div>
    </div>
</div>


<!-- Page Header -->
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">Inbox</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
				<li class="breadcrumb-item active">Inbox</li>
			</ul>
		</div>
		<div class="col-auto float-right ml-auto">
			<a href="javascript:;" class="btn add-btn"><i class="fa fa-plus"></i> Compose</a>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="row">
	<div class="col-md-12">
		<div class="card mb-0">
			<div class="card-body">
				<div class="email-header">
					<div class="row">
						<div class="col top-action-left">
							<div class="float-left">
								<div class="btn-group dropdown-action">
									<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Select <i class="fa fa-angle-down "></i></button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="javascript:;">All</a>
										<a class="dropdown-item" href="javascript:;">None</a>
										<div class="dropdown-divider"></div> 
										<a class="dropdown-item" href="javascript:;">Read</a>
										<a class="dropdown-item" href="javascript:;">Unread</a>
									</div>
								</div>
								<div class="btn-group dropdown-action">
									<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down "></i></button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="javascript:;">Reply</a>
										<a class="dropdown-item" href="javascript:;">Forward</a>
										<a class="dropdown-item" href="javascript:;">Archive</a>
										<div class="dropdown-divider"></div> 
										<a class="dropdown-item" href="javascript:;">Mark As Read</a>
										<a class="dropdown-item" href="javascript:;">Mark As Unread</a>
										<div class="dropdown-divider"></div> 
										<a class="dropdown-item" href="javascript:;">Delete</a>
									</div>
								</div>
								<div class="btn-group dropdown-action">
									<button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown"><i class="fa fa-folder"></i> <i class="fa fa-angle-down"></i></button>
									<div role="menu" class="dropdown-menu">
										<a class="dropdown-item" href="javascript:;">Social</a>
										<a class="dropdown-item" href="javascript:;">Forums</a>
										<a class="dropdown-item" href="javascript:;">Updates</a>
										<div class="dropdown-divider"></div> 
										<a class="dropdown-item" href="javascript:;">Spam</a>
										<a class="dropdown-item" href="javascript:;">Trash</a>
										<div class="dropdown-divider"></div> 
										<a class="dropdown-item" href="javascript:;">New</a>
									</div>
								</div>
								<div class="btn-group dropdown-action">
									<button type="button" data-toggle="dropdown" class="btn btn-white dropdown-toggle"><i class="fa fa-tags"></i> <i class="fa fa-angle-down"></i></button>
									<div role="menu" class="dropdown-menu">
										<a class="dropdown-item" href="javascript:;">Work</a>
										<a class="dropdown-item" href="javascript:;">Family</a>
										<a class="dropdown-item" href="javascript:;">Social</a>
										<div class="dropdown-divider"></div> 
										<a class="dropdown-item" href="javascript:;">Primary</a>
										<a class="dropdown-item" href="javascript:;">Promotions</a>
										<a class="dropdown-item" href="javascript:;">Forums</a>
									</div>
								</div>
							</div>
							<div class="float-left d-none d-sm-block">
								<input type="text" placeholder="Search Messages" class="form-control search-message">
							</div>
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
										<input type="checkbox" class="checkbox-all">
									</th>
								</tr>
							</thead>
							<tbody>
								<tr class="unread clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star starred"></i></span></td>
									<td class="name">John Doe</td>
									<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
									<td><i class="fa fa-paperclip"></i></td>
									<td class="mail-date">13:14</td>
								</tr>
								<tr class="unread clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">Envato Account</td>
									<td class="subject">Important account security update from Envato</td>
									<td></td>
									<td class="mail-date">8:42</td>
								</tr>
								<tr class="clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">Twitter</td>
									<td class="subject">HRMS Bootstrap Admin Template</td>
									<td></td>
									<td class="mail-date">30 Nov</td>
								</tr>
								<tr class="unread clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">Richard Parker</td>
									<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
									<td></td>
									<td class="mail-date">18 Sep</td>
								</tr>
								<tr class="clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">John Smith</td>
									<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
									<td></td>
									<td class="mail-date">21 Aug</td>
								</tr>
								<tr class="clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">me, Robert Smith (3)</td>
									<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
									<td></td>
									<td class="mail-date">1 Aug</td>
								</tr>
								<tr class="unread clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">Codecanyon</td>
									<td class="subject">Welcome To Codecanyon</td>
									<td></td>
									<td class="mail-date">Jul 13</td>
								</tr>
								<tr class="clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">Richard Miles</td>
									<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
									<td><i class="fa fa-paperclip"></i></td>
									<td class="mail-date">May 14</td>
								</tr>
								<tr class="unread clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star-o"></i></span></td>
									<td class="name">John Smith</td>
									<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
									<td></td>
									<td class="mail-date">11/11/16</td>
								</tr>
								<tr class="clickable-row" data-href="javascript:;">
									<td>
										<input type="checkbox" class="checkmail">
									</td>
									<td><span class="mail-important"><i class="fa fa-star starred"></i></span></td>
									<td class="name">Mike Litorus</td>
									<td class="subject">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
									<td></td>
									<td class="mail-date">10/31/16</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>