<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">MDT Dates Settings</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->
							
							
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Select hospital <span class="text-danger">*</span></label>
                                            <select name="hospital_id" class="form-control tg-select display_mdt_list_on_hospital">
                                    <option value="">Choose Hospital</option>
                                    <?php
                                    if (!empty($hospitals_list)) {
                                        foreach ($hospitals_list as $hospitals) {
                                            echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                                        }
                                    }
                                    ?>
                                </select>										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
                                        <div class="row">
                        <div class="col-md-6">
                            <div class="mdt_date_msg"></div>
                            <h3 class="text-center">Add MDT Dates</h3>
                            <div class="well mdt_category_area" style="width:100%; float:left;">
                                <button data-toggle="collapse" data-target="#add-mdt-category">Add MDT Category</button>
                                <button class="refresh_mdt_category_data pull-right" data-refreshtype="button">Refresh MDT Category</button>
                                <div id="add-mdt-category" class="collapse in" aria-expanded="true">
                                                        <?php
                                $attributes = array('class' => 'form mdt_category_form');
                                    echo form_open("", $attributes);
                                    ?>
                                  <!--  <form class="form mdt_category_form">-->
                                        <div class="form-group">
                                            <label>Add MDT Category</label>
                                            <input type="text" class="form-control" name="mdt_category_name">
                                            <input type="hidden" name="mdt_category_hospital_id" value="">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary save_mdt_category">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="mdt_category_list" style="width:100%;float:left;"></div>
                            </div>
                            </form>
                                     <?php
                                $attributes = array('id'=>'mdt_dates_form','class' => 'form mdt_dates_form');
                                    echo form_open("", $attributes);
                                    ?>
                            <!--<form class="form mdt_dates_form" id="mdt_dates_form">-->
                                <div class="form-group">
                                    <label for="mdt_date"></label>
                                    <div class="input-group date" id="mdt_dates" style="margin-top:8px;">
                                        <input  type="text" name="mdt_date" id="mdt_date" class="form-control" style="margin-top:0px;" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="show_mdt_categories_inputs"></div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="mdt_date_hospital_id" value="">
                                    <button type="button" id="add_mdt_date_btn" class="btn btn-primary">Add Date</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div id='mdt_dates_calendar'></div>
                            <div id="fullCalModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                            <h4 id="modalTitle" class="modal-title"></h4>
                                        </div>
                                        <div id="modalBody" class="modal-body">
                                            <p id="mdt_date"></p>
                                            <p id="mdt_cat_names"></p>
                                            <p id="mdt_total_records"></p>
                                            <p id="mdt_records_ids"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <!-- <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                            
                                            
                                            										</div>
									</div>
									
									
									
								
								</div>
								
							
                                    
								
							
						</div>
					</div>