  <!-- Page Wrapper -->
            <div class="page-wrapper patient-doctor no-sidebar">
            
                <!-- Page Content -->
                <div class="content container-fluid">
                    
                    <div class="card doc-card">
                        <div class="row">
                            <div class="card ">
                                <!-- <img src="<?php //echo base_url() ?>assets/institute/img/heartIcon.png" /> -->
                                <img src="<?php echo base_url() ?>assets/icons/Clinic-blk.png" />
                                <label>Clinic</label>
                               <a href="#" class="btn btn-white float-right ml-2" data-toggle="modal" data-target="#add_task_board"> <i class="fa fa-plus"></i></a>
                            </div>                              
                            <div class="card ">
                                <!-- <img src="<?php //echo base_url() ?>assets/institute/img/heartIcon.png" /> -->
                                <img src="<?php echo base_url() ?>assets/icons/Physician-blk.png" />
                                <label>Physician</label>
                                <i class="fa fa-plus"></i>
                            </div>
                            
                            <div class="card ">
                                <!-- <img src="<?php //echo base_url() ?>assets/institute/img/heartsIcon.png" /> -->
                                <img src="<?php echo base_url() ?>assets/icons/Pathologist-blk.png" />
                                <label>Pathologist</label>
                                <i class="fa fa-plus"></i>
                            </div>
                            
                            <div class="card ">
                                <!-- <img src="<?php //echo base_url() ?>assets/institute/img/clockIcon.png" /> -->
                                <img src="<?php echo base_url() ?>assets/icons/Specimen-Type-blk.png" />
                                <label>Speciment Type</label>
                                <i class="fa fa-plus"></i>
                            </div>
                            
                            <div class="card ">
                                <!-- <img src="<?php //echo base_url() ?>assets/institute/img/filesIcon.png" /> -->
                                <img src="<?php echo base_url() ?>assets/icons/Specimen-No-blk.png" />
                                <label>Speciment no.</label>
                                <i class="fa fa-plus"></i>
                            </div>                              
                        </div>
                    </div>
                    <div class="card doctorSCard">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="inputSysNo">Lab. no.: Search /Add Record</label>
                                <div class="input-group-append">
                                   <span class="input-group-text" id="basic-addon1">
                                        <i class="fa fa-search-plus" onClick="getsearchbarcode"></i>
                                    </span>
                                    <input class="form-control" id="barcode_no" name="barcode_no" placeholder="Search By Track Number">
                                </div>
                                
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputSysNo">My Templates
                                    <span class="tooltipIcon" data-toggle="tooltip" title="Pathologist/Specialty/Clinic/Physician/Specimen No.">
                                        <img src="<?php echo base_url() ?>assets/institute/img/infoIcon.png">
                                    </span>
                                </label>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">
                                        <button type="button" class="btn btn-primary" data-toggle="dropdown">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                        <button class="btn btn-light btn-round ml-1">
                                           36                            
                                        </button>
                                    </span>
                                    <input class="form-control ">
                                </div>
                               
                                
                            </div>
                            <div class="form-group col-md-2">
                                <label class="focus-label">Date of Birth</label>
                                <div class="cal-icon">
                                    
                                    <input name="toDate" class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card doc-card">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="focus-label">First Name</label>
                                <input name="f_name" id="f_name" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">Surname<span style="color: red;">*</span></label>
                                <input name="sur_name" id="sur_name" class="form-control " type="text">
                            </div>
                           
                            <div class="form-group col-md-3">
                                <label class="focus-label">Date of Birth</label>
                                <div class="cal-icon">
                                    
                                    <input name="dob" id="dob" class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                             
                           
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="focus-label">UL No.</label>
                                <input name="serial_number" id="serial_number" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="focus-label">Track No.</label>
                                <input name="lab_number"  id="lab_number" class="form-control " type="text">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">NHS No.</label>
                                <input name="nhs_number" id="nhs_number" class="form-control " type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputgender">Gender<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="inputPatientLastName" name="lastName" placeholder="gender" required="">
                                <div class="invalid-feedback">
                                    Please provide Gender.
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputgender">Hospital No.<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="inputPatientLastName" name="lastName" placeholder="gender" required="">
                                <div class="invalid-feedback">
                                    Please provide Hospital No.
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">EMIS</label>
                                <input name="" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">Digit No.</label>
                                <input name="" class="form-control " type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">Age</label>
                                <input name="" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">Clinitian</label>
                                <input name="" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">Clinic</label>
                                <input name="" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">Location (ward/OPD)</label>
                                <input name="" class="form-control " type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="focus-label">Clinic Date</label>
                                <div class="cal-icon">
                                    
                                    <input name="toDate" class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">RCPath Score</label>
                                <input name="" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Status</label>
                                <select name="tax" class="form-control selectTaxt" tabindex="-1" aria-hidden="true">
                                    <option>Routine</option>
                                    <option>Urgent</option>
                                    <option>2WW</option>
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="card doc-card">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputPatientFirstName">P Code</label>
                                <input name="" class="form-control " type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="focus-label">Lab. Rcv. Date</label>
                                <div class="cal-icon">
                                    
                                    <input name="toDate" class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                            <div class="form-group col-md-6 d-block">
                                <label class="focus-label">Macro</label>
                                 <button type="submit" class="btn btn-danger btn-sicon pull-right"> 
                                    <i class="fa fa-trash-o"></i>
                                 </button>
                                 <button type="submit" class="btn btn-primary btn-sicon pull-right"> 
                                    <i class="fa fa-plus"></i> 
                                 </button>
                                 <button type="submit" class="btn btn-primary ml-1 btn-lg pull-right"> 
                                Specimen 2 </button>
                                <button type="submit" class="btn btn-lg btn-primary ml-1 pull-right"> 
                                Specimen 1 </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <textarea class="tinyTextarea"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group col-md-12">
                                    <label for="inputPatientFirstName">Pot Label</label>
                                    <input name="" class="form-control " type="text">
                                </div>
                                <div class="doctorSCard col-md-12 d-block ">
                                    <div class="input-group">
                                       <span class="input-group-text" id="basic-addon1">
                                            <label class="focus-label">Description</label>
                                            <img src="<?php echo base_url() ?>assets/institute/img/iconBtn.png" align="btn">
                                        </span>
                                        <input class="form-control" list="desc">
                                            <datalist id="desc">
                                              <option value="Macroscopic Description 1">
                                              </option><option value="Macroscopic Description 2">
                                              </option><option value="Macroscopic Description 3">
                                              </option><option value="Macroscopic Description 4">
                                              </option><option value="Macroscopic Description 5">
                                            </option></datalist>  
                                       
                                    </div>
                                    <textarea class="form-control" name=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card doctorSCard">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Cut Up (Primary)</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Cut Up (Secondary)</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Assisted</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Block Checked</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Processor</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Embedded</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Sectioned</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Labeled</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">No. of Slides</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">QCd</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Date Rel. by Lab</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">RCPath Score</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">No. of Blocks</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputSysNo">Block Detail</label>
                                <div class="input-group-append">
                                        <img src="<?php echo base_url() ?>assets/institute/img/qrCode.png" >
                                    <input class="form-control ">
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="submit-section ">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </div>
                <div class="bottom-section">
                        <p class="text-center">
                            <img src="<?php echo base_url() ?>assets/institute/img/trackIcon.png">
                            Track Satus: Lab Release
                        </p>
                    </div>
               <!-- /Page Content -->
            </div>
 <!-- Page Wrapper -->
            <script>
            tinymce.init({
              selector: '.tinyTextarea',
              height: 200,
              menubar: false,
              plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
              ],
              toolbar: 'undo redo | formatselect | ' +
              'bold italic backcolor | alignleft aligncenter ' +
              'alignright alignjustify | bullist numlist outdent indent | ' +
              'removeformat | help',
              content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        </script>
<!-- /Page Wrapper -->

        <script>
            tinymce.init({
              selector: '.tinyTextarea',
              height: 200,
              menubar: false,
              plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
              ],
              toolbar: 'undo redo | formatselect | ' +
              'bold italic backcolor | alignleft aligncenter ' +
              'alignright alignjustify | bullist numlist outdent indent | ' +
              'removeformat | help',
              content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        </script>



<!-- Footer Template -->

<!-- Model OverLay -->
<div id="add_task_board" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Add Task Board</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label>Task Board Name</label>
									<input type="text" class="form-control">
								</div>
								<div class="form-group task-board-color">
									<label>Task Board Color</label>
									<div class="board-color-list">
										<label class="board-control board-primary">
											<input name="radio" type="radio" class="board-control-input" value="primary" checked="">
											<span class="board-indicator"></span>
										</label>
										<label class="board-control board-success">
											<input name="radio" type="radio" class="board-control-input" value="success">
											<span class="board-indicator"></span>
										</label>
										<label class="board-control board-info">
											<input name="radio" type="radio" class="board-control-input" value="info">
											<span class="board-indicator"></span>
										</label>
										<label class="board-control board-purple">
											<input name="radio" type="radio" class="board-control-input" value="purple">
											<span class="board-indicator"></span>
										</label>
										<label class="board-control board-warning">
											<input name="radio" type="radio" class="board-control-input" value="warning">
											<span class="board-indicator"></span>
										</label>
										<label class="board-control board-danger">
											<input name="radio" type="radio" class="board-control-input" value="danger">
											<span class="board-indicator"></span>
										</label>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary btn-lg">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>