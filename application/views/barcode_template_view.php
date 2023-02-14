
<div class="modal fade bd-example-modal-xl" id="br_template_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Barcode Template</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6" style="border-right: 1px solid #777;">
                    <div class='tmp_title'><h5><strong>Barcode Design</strong></h5><hr></div>
                    <div class='' id='custom_br_box'>
                        <div class='text-center' style="margin: 0 auto; text-align: center; height: 95px !important; width: 95px !important; overflow:hidden;">
                        <center>
                            <div class='barcode_wrap' style="border: 1px solid #777;padding: 2px;border-radius: 5px;">   
                                <center>
                                    <img src="<?= base_url().'assets/img/sample_barcode.png'; ?>" id="ex_barcode_img" alt="Barcode" style='max-width: 90px;' />
                                        <table class='br_table' style="font-size:10px !important;">
                                        <tr style="line-height: 12px; "><td class='text-center br_label' id='ex_lab_no' title='Lab No'>AB123456</td></tr>
                                        <tr style="line-height: 12px; "><td class='text-center br_label' id='ex_patient_name' title='Patient Name'>John Duo</td></tr>
                                        <tr style="line-height: 12px; "><td class='text-center br_label hide' id='ex_nhs_no' title='NHS No'>1928374655</td></tr>
                                        <tr style="line-height: 12px; "><td class='text-center br_label hide' id='ex_dob' title='DOB'>1 Jan 2000</td></tr>
                                        <tr style="line-height: 12px; "><td class='text-center br_label hide' id='ex_age' title='Age'>45 Years</td></tr>
                                        <tr style="line-height: 12px; "><td class='text-center br_label hide' id='ex_gender' title='Gender'>Male</td></tr>
                                        <tr style="line-height: 12px; "><td class='text-center br_label hide' id='ex_lab_no2' title='Lab No2'>PB112233</td></tr>
                                        <tr style="line-height: 12px; "><td class='text-center br_label hide' id='ex_contact_no' title='Contact No'>123-456-7890</td></tr>
                                    </table>
                                    </center>
                                </div>
                            </div>
                        </center>                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class='tmp_title'><h5 class='tmp_title'><strong>Choose the Label which you want to print on Barcode</strong></h5><hr></div>
                    <form action="<?= site_url('barcode/save_template'); ?>" method="post" id="template_form" class="pl-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">                            
                                    <input type="checkbox" name="ex_patient_name" class="template_field" id="ch_group1" value="1" /> 
                                    <label for="ch_group1">Patient Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">                            
                                    <input type="checkbox" name="ex_nhs_no" class="template_field" value="1" id="ch_group2" /> <label for="ch_group2">NHS Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">                            
                                    <input type="checkbox" name="ex_dob" class="template_field" value="1" id="ch_group3" /> <label for="ch_group3">Date of Birth</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">                            
                                    <input type="checkbox" name="ex_age" class="template_field" value="1" id="ch_group4" /> <label for="ch_group4">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col-md-6">
                                <div class="form-group">                            
                                    <input type="checkbox" name="ex_gender" class="template_field" value="1" id="ch_group5" /> <label for="ch_group5">Gender</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="ex_lab_no" class="template_field" value="1" id="ch_group6" /> <label for="ch_group6">Lab Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="ex_contact_no" class="template_field" value="1" id="ch_group7" /> <label for="ch_group7">Contact No</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="ex_lab_no2" class="template_field" value="1" id="ch_group8" /> <label for="ch_group8">Lab Number2</label>
                                    <input type="hidden" name="hospital_id" class="form-control" id="tmp_hospital_id" value="" />
                                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                </div>
                            </div>                                                    
                        </div>
                    </form>
                </div>                
            </div>
      </div>
      <div class="modal-footer">        
        <a href="javascript:save_template();" class="btn btn-primary save_template">Save Template</a>
        <a href="javascript:print_custom_barcode();" class="btn btn-primary print_barcode hide">Print Barcode</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>