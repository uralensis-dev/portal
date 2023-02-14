<!-- Chat Main Wrapper -->
					<div class="chat-main-wrapper">
					<input type="hidden" name="hidden_receiver_id_array" id="hidden_receiver_id_array" />

						<!-- Chats View -->
						<div class="col-lg-9 message-view task-view">
							<div class="chat-window">
								<div class="fixed-header">
									<div class="navbar">
										<div class="user-details mr-auto">
											<div class="float-left user-img">
												<a class="avatar" href="profile.html">
													<img src="assets/img/profiles/avatar-05.jpg" alt="" class="rounded-circle">
													<span class="status online"></span>
												</a>
											</div>
											<div class="user-info float-left" id="dynamic_title">
												
											</div>
										</div>
										<div class="search-box">
											<div class="input-group input-group-sm">
												<input type="text" placeholder="Search" class="form-control">
												<span class="input-group-append">
													<button type="button" class="btn"><i class="fa fa-search"></i></button>
												</span>
											</div>
										</div>
										<!--<ul class="nav custom-menu">
											<li class="nav-item">
												<a class="nav-link task-chat profile-rightbar float-right" id="task_chat" href="#task_window"><i class="fa fa-user"></i></a>
											</li>
											<li class="nav-item">
												<a href="voice-call.html" class="nav-link"><i class="fa fa-phone"></i></a>
											</li>
											<li class="nav-item">
												<a href="video-call.html" class="nav-link"><i class="fa fa-video-camera"></i></a>
											</li>
											<li class="nav-item dropdown dropdown-action">
												<a aria-expanded="false" data-toggle="dropdown" class="nav-link dropdown-toggle" href=""><i class="fa fa-cog"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a href="javascript:void(0)" class="dropdown-item">Delete Conversations</a>
													<a href="javascript:void(0)" class="dropdown-item">Settings</a>
												</div>
											</li>
										</ul>-->
									</div>
								</div>
								<div class="chat-contents">
									<div class="chat-content-wrap">
										<div class="chat-wrap-inner">
											<div class="chat-box">
												<div class="chats" id="chat_body">
													
													
													
													
													
													
													
													
													
													
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="chat-footer">
									<div class="message-bar">
										<div class="message-inner">
											<a class="link attach-icon" href="#" data-toggle="modal" data-target="#drag_files"><img src="assets/img/attachment.png" alt=""></a>
											<div class="message-area">
												<div class="input-group">
													<textarea class="form-control" name="chat_message_area" id="chat_message_area" placeholder="Type message..." ></textarea>
													<span class="input-group-append">
														<button class="btn btn-custom" type="button" name="send_chat" id="send_chat"><i class="fa fa-send"></i></button>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Chats View -->
						
						<!-- Chat Right Sidebar -->
						<div class="col-lg-3 message-view chat-profile-view chat-sidebar" id="task_window">
							<div class="chat-window video-window">
								<div class="fixed-header">
									<ul class="nav nav-tabs nav-tabs-bottom">
										<li class="nav-item"><a class="nav-link active" href="#calls_tab" data-toggle="tab">Search</a></li>
										<!--<li class="nav-item"><a class="nav-link" href="#profile_tab" data-toggle="tab">Profile</a></li>-->
									</ul>
								</div>
								<div class="tab-content chat-contents">
									<div class="content-full tab-pane show active" id="calls_tab">
										<div class="chat-wrap-inner">
											<div class="chat-box">
												<div class="chats">
													<div class="chat chat-left">
														<div class="col-md-8">
															<input type="text" name="search_user" id="search_user" class="form-control input-sm" placeholder="Search User" />
														</div>
														<div class="col-md-4">
															<button type="button" name="search_button" id="search_button" class="btn btn-primary btn-sm">Search</button>
														</div>

														<div id="search_user_area"></div>
													</div>


													<div class="panel-body" id="notification_area">

												</div>
													
													
														
													</div>
													<div class="chat chat-left">
														
														
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--<div class="content-full tab-pane" id="profile_tab">
										<div class="display-table">
											<div class="table-row">

												<div class="panel panel-default" style="height: 380px; overflow-y: scroll;">
													<div class="panel-heading">Nofication</div>
													

												<div class="table-body">
													<div class="table-content">
														<div class="chat-profile-img">
															<div class="edit-profile-img">
																<img src="assets/img/profiles/avatar-02.jpg" alt="">
																<span class="change-img">Change Image</span>
															</div>
															<h3 class="user-name m-t-10 mb-0">John Doe</h3>
															<small class="text-muted">Web Designer</small>
															<a href="javascript:void(0);" class="btn btn-primary edit-btn"><i class="fa fa-pencil"></i></a>
														</div>
														<div class="chat-profile-info">
															<ul class="user-det-list">
																<li>
																	<span>Username:</span>
																	<span class="float-right text-muted">johndoe</span>
																</li>
																<li>
																	<span>DOB:</span>
																	<span class="float-right text-muted">24 July</span>
																</li>
																<li>
																	<span>Email:</span>
																	<span class="float-right text-muted">johndoe@example.com</span>
																</li>
																<li>
																	<span>Phone:</span>
																	<span class="float-right text-muted">9876543210</span>
																</li>
															</ul>
														</div>
														<div class="transfer-files">
															<ul class="nav nav-tabs nav-tabs-solid nav-justified mb-0">
																<li class="nav-item"><a class="nav-link active" href="#all_files" data-toggle="tab">All Files</a></li>
																<li class="nav-item"><a class="nav-link" href="#my_files" data-toggle="tab">My Files</a></li>
															</ul>
															<div class="tab-content">
																<div class="tab-pane show active" id="all_files">
																	<ul class="files-list">
																		<li>
																			<div class="files-cont">
																				<div class="file-type">
																					<span class="files-icon"><i class="fa fa-file-pdf-o"></i></span>
																				</div>
																				<div class="files-info">
																					<span class="file-name text-ellipsis">AHA Selfcare Mobile Application Test-Cases.xls</span>
																					<span class="file-author"><a href="#">Loren Gatlin</a></span> <span class="file-date">May 31st at 6:53 PM</span>
																				</div>
																				<ul class="files-action">
																					<li class="dropdown dropdown-action">
																						<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
																						<div class="dropdown-menu">
																							<a class="dropdown-item" href="javascript:void(0)">Download</a>
																							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#share_files">Share</a>
																						</div>
																					</li>
																				</ul>
																			</div>
																		</li>
																	</ul>
																</div>
																<div class="tab-pane" id="my_files">
																	<ul class="files-list">
																		<li>
																			<div class="files-cont">
																				<div class="file-type">
																					<span class="files-icon"><i class="fa fa-file-pdf-o"></i></span>
																				</div>
																				<div class="files-info">
																					<span class="file-name text-ellipsis">AHA Selfcare Mobile Application Test-Cases.xls</span>
																					<span class="file-author"><a href="#">John Doe</a></span> <span class="file-date">May 31st at 6:53 PM</span>
																				</div>
																				<ul class="files-action">
																					<li class="dropdown dropdown-action">
																						<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
																						<div class="dropdown-menu">
																							<a class="dropdown-item" href="javascript:void(0)">Download</a>
																							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#share_files">Share</a>
																						</div>
																					</li>
																				</ul>
																			</div>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>-->
								</div>
							</div>
						</div>
						<!-- /Chat Right Sidebar -->
						
					</div>
					<!-- /Chat Main Wrapper -->
					
				</div>
				<!-- /Chat Main Row -->
				
				<!-- Drogfiles Modal -->
				<div id="drag_files" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Drag and drop files upload</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                                <form id="js-upload-form">
									<div class="upload-drop-zone" id="drop-zone">
										<i class="fa fa-cloud-upload fa-2x"></i> <span class="upload-text">Just drag and drop files here</span>
									</div>
                                    <h4>Uploading</h4>
                                    <ul class="upload-list">
                                        <li class="file-list">
                                            <div class="upload-wrap">
                                                <div class="file-name">
                                                    <i class="fa fa-photo"></i>
                                                    photo.png
                                                </div>
                                                <div class="file-size">1.07 gb</div>
                                                <button type="button" class="file-close">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </div>
                                            <div class="progress progress-xs progress-striped">
												<div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
											</div>
                                            <div class="upload-process">37% done</div>
                                        </li>
                                        <li class="file-list">
                                            <div class="upload-wrap">
                                                <div class="file-name">
                                                    <i class="fa fa-file"></i>
                                                    task.doc
                                                </div>
                                                <div class="file-size">5.8 kb</div>
                                                <button type="button" class="file-close">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </div>
                                            <div class="progress progress-xs progress-striped">
												<div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
											</div>
                                            <div class="upload-process">37% done</div>
                                        </li>
                                        <li class="file-list">
                                            <div class="upload-wrap">
                                                <div class="file-name">
                                                    <i class="fa fa-photo"></i>
                                                    dashboard.png
                                                </div>
                                                <div class="file-size">2.1 mb</div>
                                                <button type="button" class="file-close">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </div>
                                            <div class="progress progress-xs progress-striped">
												<div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
											</div>
                                            <div class="upload-process">Completed</div>
                                        </li>
                                    </ul>
                                </form>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Submit</button>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Drogfiles Modal -->
				
				<!-- Add Group Modal -->
				<div id="add_group" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Create a group</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Groups are where your team communicates. They’re best when organized around a topic — #leads, for example.</p>
								
								<div class="form-group">
									<label>Group Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text" name="group_name" id="group_name">
								</div>
								<!--<div class="form-group">
									<label>Send invites to: <span class="text-muted-light">(optional)</span></label>
									
								</div>-->
								<div class="submit-section">
									<button class="btn btn-primary btn" onClick="creatgroup()">Submit</button>
								</div>
							
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Group Modal -->


				<!-- Group Chat Model -->
				<?php foreach($groups as $rec){
					$group_id .=$rec->id.",";
					 ?>
				<div id="chat_group_<?=$rec->id?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"><?=$rec->name?></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Groups are where your team communicates. They’re best when organized around a topic — #leads, for example.</p>
								
								<div class="chats" id="group_chat_body_<?=$rec->id?>">
								<?php
								$groupchat = getRecords("*","chat_messages_group", array("group_id"=>$rec->id));
								foreach($groupchat as $recchat)
								{
									$user = getRecords("*","chat_user",array("user_id"=>$recchat->sender_id));
									if($recchat->sender_id==$this->session->userdata('chat_user_id'))
									{

										$chathtml .= '<div class="chat chat-left"><div class="chat-body"><div class="chat-bubble"><div class="chat-content">'.$user[0]->first_name." ".$user[0]->last_name.'<p>'.$recchat->chat_messages_text.'</p><span class="chat-time">'.$recchat->chat_messages_datetime.'</span>';
         $chathtml.='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         $chathtml.='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>';
										
										
									}else{
										$chathtml .= '<div class="chat chat-right"><div class="chat-body"><div class="chat-bubble"><div class="chat-content">'.$user[0]->first_name." ".$user[0]->last_name.'<p>'.$recchat->chat_messages_text.'</p><span class="chat-time">'.$recchat->chat_messages_datetime.'</span>';
         $chathtml.='</div><div class="chat-action-btns"><ul><li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li><li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>';
         $chathtml.='<li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li></ul></div></div></div></div>';

									}
								}
							echo $chathtml;
								
								 ?>
												</div>
								
								<div class="form-group" id="<?=$rec->id?>">
									<textarea class="form-control" name="chat_message_area_group" id="chat_message_area_group_<?=$rec->id?>" placeholder="Type message..." ></textarea>
													<span class="input-group-append">
								<button class="btn btn-custom group_chat_btn" type="button" name="send_chat_group" id="<?=$rec->id?>" ><i class="fa fa-send"></i></button>
													</span>
								</div>
							
							</div>
						</div>
					</div>
				</div>
				<?php } ?>	
				<input type="text" name="group_ids" id="group_ids" value="<?=$group_id?>" />



				<!-- Group Chat Model -->
				
				<!-- Add Chat User Modal -->
				<div id="add_chat_user" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Direct Chat</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="input-group m-b-30">
									<input placeholder="Search to start a chat" class="form-control search-input" type="text">
									<span class="input-group-append">
										<button class="btn btn-primary">Search</button>
									</span>
								</div>
								<div>
									<h5>Recent Conversations</h5>
									<ul class="chat-user-list">
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar align-self-center">
														<img src="assets/img/profiles/avatar-16.jpg" alt="">
													</span>
												<div class="media-body align-self-center text-nowrap">
													<div class="user-name">Jeffery Lalor</div>
													<span class="designation">Team Leader</span>
												</div>
												<div class="text-nowrap align-self-center">
													<div class="online-date">1 day ago</div>
												</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media ">
													<span class="avatar align-self-center">
														<img src="assets/img/profiles/avatar-13.jpg" alt="">
													</span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">Bernardo Galaviz</div>
														<span class="designation">Web Developer</span>
													</div>
													<div class="align-self-center text-nowrap">
														<div class="online-date">3 days ago</div>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar align-self-center">
														<img src="assets/img/profiles/avatar-02.jpg" alt="">
													</span>
													<div class="media-body text-nowrap align-self-center">
														<div class="user-name">John Doe</div>
														<span class="designation">Web Designer</span>
													</div>
													<div class="align-self-center text-nowrap">
														<div class="online-date">7 months ago</div>
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Submit</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Chat User Modal -->
				
				<!-- Share Files Modal -->
				<div id="share_files" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Share File</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="files-share-list">
									<div class="files-cont">
										<div class="file-type">
											<span class="files-icon"><i class="fa fa-file-pdf-o"></i></span>
										</div>
										<div class="files-info">
											<span class="file-name text-ellipsis">AHA Selfcare Mobile Application Test-Cases.xls</span>
											<span class="file-author"><a href="#">Bernardo Galaviz</a></span> <span class="file-date">May 31st at 6:53 PM</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Share With</label>
									<input class="form-control" type="text">
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Share</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Share Files Modal -->