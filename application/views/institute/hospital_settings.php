<style type="text/css">
.section_title {
  font-size: 22px;
  font-weight: 500;
  padding: 0px 0 20px;
  display: block;
}

img.setting_images {
  width: 40px;
  height: 40px;
  margin-bottom: 15px;
}

.text {
  font-size: 16px;
  font-weight: 500;
}

.user_image {
  max-width: 40px;
  border-radius: 20px;
  margin-right: 5px;
}

.breadcrumb-item + .breadcrumb-item::before {
  display: inline-block;
  padding-right: .5rem;
  color: #6c757d;
  content: "/";
}

#active-directory-select {
  width: 100%;
}

.dash-widget {
  cursor: pointer;
  transition: 0.2s;
}

.dash-widget:hover {
  background-color: #edfbff;
}

.btn {
  border-radius: 8px;
}

.ac-card {
  padding: 10px;
}

.add-btn {
  border-radius: 35px;
}

.add-user-btn {
  border-radius: 1000px;
  padding: 0;
  width: 28px;
  font-size: 13px;
}

</style>

<div class="content container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item active">Hospital Settings</li>
        </ul>
      </div>
      <div class="col-auto float-right ml-auto">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">Institute Settings</h3>
          </div>
        </div>
      </div>
      <!-- /Page Header -->
      <?php echo form_open_multipart('', array('id' => 'hospital_form')); ?>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
      value="<?php echo $this->security->get_csrf_hash(); ?>">
      <section class="form-group">
        <div class="card profile-box flex-fill">
          <div class="card-body">
            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">

            <h3 class="card-title"><a href="#" id="btn_edit_hosp" class="edit-icon hidden"
              data-toggle="modal" data-target="#edit_user"><i
              class="fa fa-pencil"></i></a></h3>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Institute Name <span class="text-danger">*</span></label>
                    <input class="form-control <?php if ($errors) echo empty($hospital_data['hospital_name']['error']) ? 'is-valid' : 'is-invalid' ?>" name="hospital_name" id="hospital_name" onblur="CheckHospitalName()" onchange="CheckHospitalName()" type="text" value="<?php echo $hospital_data['hospital_name']['value']; ?>">
                    <div class="invalid-feedback">
                      <?php if ($errors) echo $hospital_data['hospital_name']['error'] ?>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>First Initial<span class="text-danger">*</span></label>
                    <input class="form-control <?php if ($errors) echo empty($hospital_data['hospital_initials_1']['error']) ? 'is-valid' : 'is-invalid'; ?>"
                    name=" hospital_initials_1" id="hospital_initials_1" type="text"
                    value="<?php echo $hospital_data['hospital_initials_1']['value']; ?>">
                    <div class="invalid-feedback">
                      <?php if ($errors) echo $hospital_data['hospital_initials_1']['error'] ?>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Last Initial<span class="text-danger">*</span></label>
                    <input class="form-control <?php if ($errors) echo empty($hospital_data['hospital_initials_2']['error']) ? 'is-valid' : 'is-invalid'; ?>"
                    name="hospital_initials_2" id="hospital_initials_2" type="text"
                    value="<?php echo $hospital_data['hospital_initials_2']['value']; ?>">
                    <div class="invalid-feedback">
                      <?php if ($errors) echo $hospital_data['hospital_initials_2']['error'] ?>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" name="hospital_address" id="hospital_address"
                    type="text"
                    value="<?php echo $hospital_data['hospital_address']['value']; ?>">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="form-group">
                    <label>Country</label>
                    <select class="select form-control" name="hospital_country"
                    id="hospital_country">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) { ?>
                      <?php $selected = ''; ?>
                      <?php if ($country['id'] == $hospital_data['hospital_country']['value']) $selected = 'selected' ?>
                      <option <?php echo $selected; ?>
                      value="<?php echo $country['id']; ?>"><?php echo $country['nicename']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label>City</label>
                  <input class="form-control" name="hospital_city" id="hospital_city"
                  value="<?php echo $hospital_data['hospital_address']['value']; ?>"
                  type="text">
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label>State/Province</label>
                  <input class="form-control" type="text" name="hospital_state"
                  id="hospital_state"
                  placeholder="<?php echo $hospital_data['hospital_state']['value']; ?>">
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="form-group">
                  <label>Postal Code</label>
                  <input class="form-control" name="hospital_post_code" id="hospital_post_code"
                  value="<?php echo $hospital_data['hospital_post_code']['value']; ?>"
                  type="text">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control <?php if ($errors) echo empty($hospital_data['hospital_email']['error']) ? 'is-valid' : 'is-invalid' ?>"
                  name="hospital_email" id="hospital_email"
                  value="<?php echo $hospital_data['hospital_email']['value'] ?>"
                  type="email">
                  <div class="invalid-feedback">
                    <?php if ($errors) echo $hospital_data['hospital_email']['value']; ?>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone Number</label>
                  <input class="form-control" name="hospital_number" id="hospital_number"
                  value="<?php echo $hospital_data['hospital_number']['value'] ?>"
                  type="text">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Mobile Number</label>
                  <input class="form-control" name="hospital_mobile_num" id="hospital_mobile_num"
                  value="<?php echo $hospital_data['hospital_mobile_num']['value'] ?>"
                  type="text">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Fax</label>
                  <input class="form-control" name="hospital_fax" id="hospital_fax"
                  value="<?php echo $hospital_data['hospital_fax']['value'] ?>"
                  type="text">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Website Url</label>
                  <input class="form-control <?php if ($errors) echo empty($hospital_data['hospital_website']['error']) ? 'is-valid' : 'is-invalid' ?>"
                  name="hospital_website" id="hospital_website"
                  value="<?php echo $hospital_data['hospital_website']['value'] ?>"
                  type="text">
                  <div class="invalid-feedback">
                    <?php if ($errors) echo $hospital_data['hospital_website']['value']; ?>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </section>
      <section class="form-group">
        <div class="section_title">Finance Details</div>

        <div class="card">
          <div class="card-body">
            <h2 class="section_title">Sales Setting</h2>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Default Account</label>
                  <input class="form-control" placeholder="XXXXXXXXX000" name="sales_account_no"
                  id="sales_account_no"
                  value="<?php echo $hospital_finance[0]['sales_account_no'] ?>"
                  type="text">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Default Project</label>
                  <input class="form-control" name="sales_project" id="sales_project"
                  value="<?php echo $hospital_finance[0]['sales_project'] ?>"
                  type="text">
                </div>
              </div>
            </div>
            <h2 class="section_title">Purchase Setting</h2>
            <div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Default Account</label>
                  <input class="form-control" placeholder="XXXXXXXXX000"
                  name="purchase_account_no" id="purchase_account_no"
                  value="<?php echo $hospital_finance[0]['purchase_account_no'] ?>"
                  type="text">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Default Project</label>
                  <input class="form-control" name="purchase_project" id="purchase_project"
                  value="<?php echo $hospital_finance[0]['purchase_project'] ?>"
                  type="text">
                </div>
              </div>
            </div>
            <h2 class="section_title">VAT</h2>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Default Sales VAT</label>
                  <input class="form-control" name="sales_vat" id="sales_vat"
                  value="<?php echo $hospital_finance[0]['sales_vat'] ?>"
                  type="text">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Default Purchase VAT</label>
                  <input class="form-control" name="purchase_vat" id="purchase_vat"
                  value="<?php echo $hospital_finance[0]['purchase_vat'] ?>"
                  type="text">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Company Registration Number</label>
                  <input class="form-control" name="comp_reg_number" id="comp_reg_number"
                  value="<?php echo $hospital_finance[0]['comp_reg_number'] ?>"
                  type="text">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Credit Card Amount</label>
                  <input class="form-control" name="card_limit_amount" id="card_limit_amount"
                  value="<?php echo $hospital_finance[0]['card_limit_amount'] ?>"
                  type="text">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Credit Limit Block</label>
                  <input class="form-control" name="block_limit" id="block_limit"
                  value="<?php echo $hospital_finance[0]['block_limit'] ?>"
                  type="text">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Sales Discount %</label>
                  <input class="form-control" name="sales_discount" id="sales_discount"
                  value="<?php echo $hospital_finance[0]['sales_discount'] ?>"
                  type="text">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Bill Due Date</label>
                  <input class="form-control" name="bill_due_date" id="bill_due_date"
                  value="<?php echo $hospital_finance[0]['bill_due_date'] ?>"
                  type="text">
                </div>
              </div>
            </div>

            <div class="col-md-12 text-right">
              <button class="btn btn-success">Update</button>
            </div>
          </div>
        </div>
      </section>
    </form>


    <section class="form-group">
      <div class="section_title">Account Holders</div>

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <label><img src="<?php echo base_url() ?>assets/img/user.jpg" class="user_image"/>
              Account Holder</label>
              <select class="select form-control" id="account_holder">

                <?php foreach ($hospital_users as $user) : ?>
                  <option value="<?php echo $user['id']; ?>"><?php echo $user['first_name'] . ' ' . $user['last_name'] . ' (' . $user['email'] . ')'; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label><img src="<?php echo base_url() ?>assets/img/user.jpg" class="user_image"/>
              Deputy Account Holder</label>
              <select class="select form-control" id="deputy_account_holder">

                <?php foreach ($hospital_users as $user) : ?>
                  <option value="<?php echo $user['id']; ?>"><?php echo $user['first_name'] . ' ' . $user['last_name'] . ' (' . $user['email'] . ')'; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="form-group">
      <div class="section_title">Finance</div>
      <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
          <div class="card dash-widget">
            <div class="card-body">
              <span class="dash-widget-icon"><img
                src="<?php echo base_url() ?>assets/icons/Profiles.png" alt=""></span>
                <div class="dash-widget-info">
                  <h3 id="customer-network-name-title">0</h3>
                  <span><a href="<?php echo base_url() ?>customer">Customer</a></span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
            <div class="card dash-widget" onclick="openGroupModal('L');">
              <div class="card-body">
                <span class="dash-widget-icon"><img
                  src="<?php echo base_url() ?>assets/icons/Laboratory.png" alt=""></span>
                  <div class="dash-widget-info">
                    <h3 id="lab-count-title">0</h3>
                    <span><a href="#">Supplier</a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="form-group">
          <div class="section_title">Groups</div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
              <div class="card dash-widget" data-toggle="modal" data-target="#network-modal">
                <div class="card-body">
                  <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                  <div class="dash-widget-info">
                    <h3 id="network-name-title">0</h3>
                    <span><a href="#">Networks</a></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
              <div class="card dash-widget" onclick="openGroupModal('CS');">
                <div class="card-body">
                  <span class="dash-widget-icon"><img
                    src="<?php echo base_url() ?>assets/icons/Clinical.png" alt=""></span>
                    <div class="dash-widget-info">
                      <h3 id="cs-count-title">0</h3>
                      <span><a href="#">Cancer Service</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="form-group">


            <div class="section_title">Add User</div>
            <div class="row">

<!--                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget" onclick="openCategoryModal('C');">
      <div class="card-body">
          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/Clinical-Physician.png"
                      alt=""></span>

          <div class="dash-widget-info">
              <h3 id="c-count-title"></h3>
              <span><a href="#">Clinician</a></span>
          </div>
      </div>
  </div>
</div>-->
<!--                    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget" onclick="aopenCategoryModal('R');">
      <div class="card-body">
          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/Profiles.png" alt=""></span>
          <div class="dash-widget-info">
              <h3 id="r-count-title"></h3>
              <span><a href="#">Requestor</a></span>
          </div>
      </div>
  </div>
</div>-->


<div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget"
  onclick="openCategoryModal('<?php echo $group_type ?>', '<?php echo $group_id; ?>');">
  <div class="card-body">

    <span class="dash-widget-icon"><img
      src="<?php echo base_url() ?>assets/icons/Pathologist.png" alt=""></span>
      <div class="dash-widget-info">
        <h3 id="d-count-title_bkp"><?php echo ($huserCount > 0)?$huserCount : '0'; ?></h3>
        <span><a href="#">Add Users</a></span>
      </div>
    </div>
  </div>
</div>

  <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget" >
      <div class="card-body">

          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/hospital_accounts.svg"></span>
          <div class="dash-widget-info">
              <h3 id="s-count-title_"><?php echo ($HAusers) ? $HAusers : '0';?></h3>
              <span><a href="<?php echo base_url().'husers/huserlist?t=63';?>">Hospital Accounts</a></span>
          </div>
      </div>
  </div>
</div>
<div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget" >
      <div class="card-body" >
          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/clinician.svg" alt=""></span>
          <div class="dash-widget-info">
              <h3 id="t-count-title_"><?php echo ($CSusers) ? $CSusers : '0';?></h3>
              <span><a href="<?php echo base_url().'husers/huserlist?t=33';?>">Clinician / Surgery</a></span>
          </div>
      </div>
  </div>
</div>

<div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget" >
      <div class="card-body">
          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/requester.svg" alt=""></span>
          <div class="dash-widget-info">
              <h3 id="t-count-title_"><?php echo ($Rusers) ? $Rusers : '0';?></h3>
              <span><a href="<?php echo base_url().'husers/huserlist?t=45';?>">Requestor</a></span>
          </div>
      </div>
  </div>
</div>

<div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget">
      <div class="card-body">
          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/pathology_secretary.svg" alt=""></span>
          <div class="dash-widget-info">
              <h3 id="t-count-title_"><?php echo ($HSusers) ? $HSusers : '0';?></h3>
              <span><a href="<?php echo base_url().'husers/huserlist?t=14';?>">Hospital Secretary</a></span>
          </div>
      </div>
  </div>
</div>

<div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
  <div class="card dash-widget" >
      <div class="card-body">
          <span class="dash-widget-icon"><img
                      src="<?php echo base_url() ?>assets/icons/cancer_service_icon.png"  class="img-fluid" alt=""></span>
          <div class="dash-widget-info">
              <h3 id="t-count-title_"><?php echo ($CANusers) ? $CANusers : '0';?></h3>
              <span><a href="<?php echo base_url().'husers/huserlist?t=15';?>">Cancer Service</a></span>
          </div>
      </div>
  </div>
</div>

</div>
</section>
<section class="form-group">
  <div class="section_title">Admin Hospital Settings</div>
  <div class="row">
    <div class="col-md-2 col-sm-6 text-center form-group">
      <div class="card" style="min-height: 121px;">
        <div class="card-body">
          <img src="<?php echo base_url() ?>assets/icons/admin_set01.png " class="setting_images">
          <div class="text">Report Template</div>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-6 text-center form-group">
      <div class="card" style="min-height: 121px;">
        <div class="card-body">
          <img src="<?php echo base_url() ?>assets/icons/admin_set02.png " class="setting_images">
          <div class="text">MDT Dates</div>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-6 text-center form-group">
      <div class="card" style="min-height: 121px;">
        <div class="card-body">
          <img src="<?php echo base_url() ?>assets/icons/admin_set03.png " class="setting_images">
          <div class="text">Short Codes</div>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-6 text-center form-group">
      <div class="card" style="min-height: 121px;">
        <div class="card-body">
          <img src="<?php echo base_url() ?>assets/icons/admin_set04.png " class="setting_images">
          <div class="text">Clinic Dates</div>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-6 hidden-xs hidden-sm text-center form-group">
      <div class="card" style="min-height: 121px;">
        <div class="card-body">
          <img src="<?php echo base_url() ?>assets/icons/admin_icon.png " class="setting_images">

          <div class="text">
            <a href="<?php echo base_url("leaveManagement/leaveSettings") ?>" style="color: #333">Leave Settings</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-6 hidden-xs hidden-sm text-center form-group">
      <div class="card" style="min-height: 121px;">
        <div class="card-body">
          <img src="<?php echo base_url() ?>assets/icons/admin_set01.png " class="setting_images">

          <div class="text">
            <a href="<?php echo base_url("leaveManagement/leaveRequests") ?>" style="color: #333">Leave Requests</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2 col-sm-6 hidden-xs hidden-sm text-center form-group">
      <div class="card" style="min-height: 121px;">
        <div class="card-body">

          <span class="dash-widget-icon"><img
            src="<?php echo base_url() ?>assets/icons/Pathologist.png" alt=""></span>
            <div class="dash-widget-info" data-toggle="modal" data-target="#courier_user_modal">
              <h3 id="ds-count-title"></h3>
              <span><a href="#">Courier</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--        </div>-->
  </section>

  <section class="form-group">
    <div class="section_title">Security</div>
    <div class="row">
      <div class="col-md-2 col-sm-6 text-center form-group">
        <div class="card" style="min-height: 121px;">
          <div class="card-body change_time_div">
            <img src="<?php echo base_url() ?>assets/icons/admin_set04.png " class="setting_images">
            <div class="text">Password Expiry Time</div>
          </div>
        </div>
      </div>
        <div class="col-md-2 col-sm-6 text-center form-group">
            <div class="card" style="min-height: 121px;">
                <div class="card-body">
                    <img src="<?php echo base_url() ?>assets/icons/Setting.png " class="setting_images">
                    <div class="text">
                        <a href="<?php echo base_url() ?>settings/payment_info">Payment Info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

</div>
</div>
</div>
<!-- /Page Content -->


<!-- Modals -->

<div id="network-modal" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Network</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Current Network</h4>
        <ul class="list-group">
          <li class="list-group-item" id="current-network">N/A</li>
        </ul>
        <hr>
        <h4>All Networks</h4>
        <ul class="list-group">
          <?php foreach ($networks as $network) : ?>
            <li id="network-<?php echo $network['id']; ?>" class="list-group-item">
              <div class="row">
                <div class="col-md-9">
                  <?php echo $network['description']; ?>
                </div>
                <div class="col-md-3 text-right">
                  <button class="btn btn-success">Request Join</button>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<div id="group-modal" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Laboratories</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-12 text-center suc_mesg" style="padding:5px;" id="suc_mesg"></div>
          <div class="col-md-6">
            <h3 id="list-group-title">All Labs</h3>
          </div>
          <div class="col-md-6 text-left">
            <a href="<?php echo base_url('institute/AddLaboratory'); ?>" class="btn add-btn">
              <i class="fa fa-plus"></i><span>New</span></a>

              <a href="#" onclick="ShowAllLabs_Data('L')" id="add-group-btn" class="btn add-btn">
                <i class="fa fa-plus"></i><span>Lab</span></a>
              </div>

              <div class="col-md-12" id="active-directory-select-container2"></div>
            </div>
          </div>
          <ul class="list-group" id="group-list-container">

          </ul>
        </div>
      </div>
    </div>


    <div id="courier_user_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Add Courier User</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-8 form-group">
                  <div class="form-focus select-focus">
                    <label class="focus-label">User</label>
                    <select class="floating select" name="courier_user" id="courier_user"
                    style="width: 100%">
                    <option> -- Select --</option>
                    <?php
                    foreach ($hospital_users_new as $user) { ?>
                      <option value="<?php echo $user->user_id; ?>"><?php echo $user->first_name . " " . $user->last_name; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <button class="btn btn-success btn_add_courier">Add Users</button>
              </div>
            </div>
            <div class="row">
              <table class="table table-responsive table-striped custom-table">
                <thead>
                  <th>User</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php foreach ($courier_users as $cuser) { ?>
                    <tr>
                      <td><?php echo $cuser->first_name . " " . $cuser->last_name ?></td>
                      <td>
                        <button class="btn btn-sm btn-danger btn_courier_delete"
                        data-id="<?php echo $cuser->user_id; ?>"><i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="category-modal" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Users</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <h3>User</h3>
          </div>
          <div class="col-md-6 text-right">

            <a href="#" id="add-category-btn" class="btn add-btn"><i
              class="fa fa-plus"></i><span>User</span></a>
            </div>
          </div>
          <ul class="list-group" id="category-list-container">

          </ul>
        </div>
      </div>
    </div>
  </div>


  <div id="show_Lab_details" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Labortotry</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="collapse" id="lab-directory-show-container"></div>
        </div>
      </div>
    </div>
  </div>

  <div id="add-user-modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">New User</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
 <?php echo form_open_multipart("institute/create_user", array('class' => 'tg-formtheme tg-editform create_user_form')); ?>
          <div class="card mb-4 ac-card">
            <div class="row">
              <div class="col-md-12">
                <div class="form-grou
                p tg-inputwithicon">
                <i class="lnr lnr-lock"></i>
                <select class="select form-control" name="user_main_groups" onchange="ShowUsersGroup(this.value)" id="user_main_groups">
                  <option value="">Select Group</option>
                          <!--<?php foreach ($hospital_mainGroups as $groupKey => $groupValue) { ?>
                              <option value="<?php echo $groupValue['id']; ?>"><?php echo $groupValue['description']; ?></option>
                              <?php } ?>-->
                              <option value="HA" >Hospital Admin</option>
                              <option value="HAS" >Hospital Accounts</option>
                              <option value="C" >Clinician/Surgery</option>
                              <option value="R" >Requestor</option>
                              <option value="HS" >Hospital Secretary</option>
                              <option value="CS" >Cancer Service</option>
                              <option value="D" >Pathologist</option>
                              <!-- <option value="M" >General Users</option> -->
                            </select>
                          </div>
                        </div>

                      </div>
                      <div class="row mb-4">


                        <div class="col-md-12" data-target="#active-directory-select-container_new">

                        </div>
                      </div>


                      <div class="" id="active-directory-select-container_new"></div>

                    </div>
                    <div class="tg-editformholder">
                      <?php if (array_key_exists('general', $user_error)) : ?>
                        <div class="row">
                          <div class="col">
                            <p style="color: red;">Cannot create user now try again later</p>
                          </div>
                        </div>
                      <?php endif; ?>
                     
                      <input type="hidden" name="user_group_type" id="user_group_type"/>
                      <input type="hidden" id="active_directory_user" name="active_directory_user" value=""/>
                      <div class="card mb-4">
                        <div class="card-body">
                          <!-- Profile Picture Input -->
                          <div class="row">
                            <div class="col-md-12">
                              <div class="profile-img-wrap edit-img">
                                <img class="inline-block" id="profile-pic-preview"
                                src="<?php echo base_url('assets/newtheme/img/profiles/avatar-02.jpg'); ?>"
                                alt="user">
                                <div class="fileupload btn">
                                  <san class="btn-text">edit</span>
                                    <input class="upload" type="file" id="profile-pic" name="profile_pic"
                                    accept="image/*"/>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- User Personal Information START -->
                            <fieldset>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                    <i class="lnr lnr-user"></i>
                                    <?php echo form_input(array('type' => 'text', 'name' => 'first_name', 'id' => 'first_name', 'value' => $user_data['first_name'], 'class' => 'form-control ' . (array_key_exists('first_name', $user_error) ? 'is-invalid' : ''), 'placeholder' => 'First Name')); ?>
                                    <div class="invalid-feedback">
                                      Please provide a valid name
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                    <i class="lnr lnr-user"></i>
                                    <?php echo form_input(array('type' => 'text', 'name' => 'last_name', 'id' => 'last_name', 'value' => $user_data['last_name'], 'class' => 'form-control', 'placeholder' => 'Last Name')); ?>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                    <i class="lnr lnr-apartment"></i>
                                    <?php echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => $user_data['company'], 'class' => 'form-control', 'placeholder' => 'Company Name')); ?>
                                  </div>
                                </div>
                                

                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                    <i class="lnr lnr-phone-handset"></i>
                                    <?php echo form_input(array('type' => 'text', 'name' => 'phone', 'id' => 'phone', 'value' => $user_data['phone'], 'class' => 'form-control', 'placeholder' => 'Phone')); ?>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                   <select class="form-control" name="division_id"  onchange="getDepartment_list(this.value)"> 
                                     <option value=""> Select Division</option>
                                     <?php if(!empty($division)){
                                      foreach($division as $dv){
                                        ?>
                                        <option value="<?php echo $dv['id'];?>"><?php echo $dv['title'];?></option>
                                      <?php 
                                        }
                                      }
                                      ?>
                                     
                                   </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                   <select class="form-control" name="department_id" id="devision_department_list" onchange="department_spe(this.value)">
                                     <option value=""> Select Department</option>
                                    
                                   </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                   <select class="form-control" name="speciality_id" id="speciality_list" onchange="getcategory(this.value)">
                                     <option value=""> Select Speciality</option>
                                    
                                   </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group tg-inputwithicon">
                                   <select class="form-control" name="category_id" id="cat_department_list">
                                     <option value=""> Select Category</option>
                                    
                                   </select>
                                  </div>
                                </div>
                                <div class="col-md-12" id="select_user_role">
                                  <div class="form-group tg-inputwithicon">
                                    <i class="lnr lnr-apartment"></i>	
                                    <select class="form-control" name="user_role" onchange="">
                                     <option value="">Select Role</option>
                                     <option value="H" >Hospital Admin</option>
                                     <option value="AC" >Hospital Accounts</option>
                                     <option value="C" >Clinician/Surgery</option>
                                     <option value="R" >Requestor</option>
                                     <option value="HS" >Hospital Secretary</option>
                                     <option value="CS" >Cancer Service</option>
                                     <option value="D" >Pathologist</option>
                                   </select></div>
                                 </div>
                                 </div>
                                 <div class="form-group tg-inputwithicon">
                                  <i class="lnr lnr-envelope"></i>
                                  <?php echo form_input(array('type' => 'text', 'name' => 'email', 'id' => 'email', 'value' => $user_data['email'], 'class' => 'form-control' . (array_key_exists('email', $user_error) ? 'is-invalid' : ''), 'placeholder' => 'Email')); ?>
                                  <span id="email_span" style="display: none;color: red"></span>
                                  <div class="invalid-feedback">
                                    <?php echo array_key_exists('email', $user_error) ? $user_error['email'] : ''; ?>
                                  </div>
                                </div>

                                <div class="row" id="password-row">
                                  <div class="col-md-6">
                                    <div class="form-group tg-inputwithicon">
                                      <i class="lnr lnr-lock"></i>
                                      <?php echo form_input(array('type' => 'password', 'name' => 'password', 'id' => 'password', 'value' => '', 'class' => 'form-control show_pass pr-password check_password', 'placeholder' => 'Password')); ?>
                                      <div class="view_password"><i class="fa fa-eye"></i></div>
                                    </div>
                                  </div>



                                  <div class="col-md-6">
                                    <div class="form-group tg-inputwithicon">
                                      <i class="lnr lnr-lock"></i>
                                      <?php echo form_input(array('type' => 'password', 'name' => 'password_confirm', 'id' => 'password_confirm', 'value' => '', 'class' => 'form-control show_pass check_password', 'placeholder' => 'Retype Password')); ?>
                                      <span id="confirm_span" style="display: none;color: red">Password not matched</span>
                                      <div class="view_password"><i class="fa fa-eye"></i></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group tg-inputwithicon" id="memo-row">
                                      <i class="lnr lnr-apartment"></i>
                                      <?php echo form_input(array('type' => 'text', 'name' => 'memorable', 'id' => 'memorable', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Memorable', 'maxlength' => 10, 'size' => 10)); ?>
                                    </div>
                                  </div>
              <!-- <div class="col-md-6">
                  <div class="form-group tg-inputwithicon" id="pin-row">
                      <i class="lnr lnr-apartment"></i>
                      <?php //echo form_input(array('type' => 'text', 'name' => 'pin_code', 'id' => 'pin_code', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Pin Code', 'maxlength' => 4, 'size' => 4)); ?>
                  </div>
              </div>
              <div class="col-md-6">-->
                <!--                                        <div class="form-group tg-inputwithicon">-->
                  <!--                                            <i class="lnr lnr-lock"></i>-->
                  <!--                                            --><?php //echo form_input(array('type' => 'text', 'name' => 'company', 'id' => 'company', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Organisation/ Company')); ?>
                  <!--                                        </div>-->
                  <!--                                    </div>-->
                </div>
                <div id="location_area">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group tg-inputwithicon">
                        <i class="lnr lnr-lock"></i>
                        <?php echo form_input(array('type' => 'text', 'name' => 'address1', 'id' => 'address1', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 1')); ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group tg-inputwithicon">
                        <i class="lnr lnr-lock"></i>
                        <?php echo form_input(array('type' => 'text', 'name' => 'address2', 'id' => 'address2', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Address 2')); ?>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group tg-inputwithicon">
                        <i class="lnr lnr-lock"></i>
                        <select class="select form-control" name="country" id="country">
                          <option value="">Select Country</option>
                          <?php foreach ($countries as $country) { ?>
                            <option value="<?php echo $country['nicename']; ?>"><?php echo $country['nicename']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group tg-inputwithicon">
                        <i class="lnr lnr-lock"></i>
                        <?php echo form_input(array('type' => 'text', 'name' => 'postcode', 'id' => 'postcode', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Post Code')); ?>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group tg-inputwithicon">
                        <i class="lnr lnr-lock"></i>
                        <?php echo form_input(array('type' => 'text', 'name' => 'telephone', 'id' => 'telephone', 'value' => '', 'class' => 'form-control', 'placeholder' => 'Telephone No.')); ?>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="group_id" id="user_group_id" value="<?php echo $user_data['group_id'] ?>">
                <input type="hidden" name="active_directory_user"
                value="<?php echo $user_data['active_directory_user'] ?>">
                <div class="form-group">
                  <button class="btn btn-success" id="user-create-btn">Create</button>
                  <button class="btn btn-warning" id="user-form-clear-btn" type="button">Clear
                  </button>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Profile Modal -->
<div id="password_info" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Password Expiry Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open(uri_string(), array('id' => 'update_password_form')); ?>
        <input type="hidden" name="password_status" id="password_status" value="0"/>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-1 col-form-label"></label>
          <label for="staticEmail" class="col-sm-2 col-form-label">No. of Days</label>
          <div class="col-sm-6">
            <input type="number" min="0" id="num_days" name="num_days" class="form-control" value="">
          </div>
        </div>
        <div class="submit-section">
          <button class="btn btn-primary updatepwd-submit-btn" type="button">Submit</button>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>
<!-- /Profile Modal -->

<div id="add-group-modal" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card ac-card">
          <form action="<?php echo base_url(); ?>institute/create_group" method="post">
            <div class="form-group">
              <label for="new-group-name">Name</label>
              <input id="new-group-name" name="name" placeholder="Name" type="text" class="form-control">
              <div class="invalid-feedback">
                Already exists
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="new-group-initial-1">First Initial</label>
                  <input id="new-group-initial-1" required name="first_initial"
                  placeholder="First Initial" maxlength="1" type="text" class="form-control">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="new-group-initial-2">Last Initial</label>
                  <input id="new-group-initial-2" required name="last_initial" maxlength="1"
                  placeholder="Last Initial" type="text" class="form-control">

                </div>
              </div>
            </div>
            <div class="form-group" id="lab-mask-container">
              <label for="new-group-lab-mask">Lab Mask</label>
              <input id="new-group-lab-mask" name="lab_mask" placeholder="Lab Mask" type="text"
              class="form-control">
            </div>
            <div class="form-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="ac" id="active-directory" checked
                value="1">
                <label class="form-check-label" for="active-directory">Active Directory</label>
              </div>
            </div>
            <input type="hidden" name="group_type" id="new-group-type">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
            id="new-group-csrf">
            <div class="form-group">
              <button id="new-group-add-btn" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script> 
  function markInputInvalid(ele, msg="Please enter a valid input") {
    $(ele).addClass('is-invalid').removeClass('is-valid');
    if ($(ele).siblings('.invalid-feedback').length === 0) {
      $(ele).insertAfter($(`<div class="invalid-feedback">${msg}</div>`))
    } else {
      $(ele).siblings('.invalid-feedback').html(msg);
    }
  }

  function markInputValid(ele) {
    $(ele).addClass('is-valid').removeClass('is-invalid');
  }


  function CheckHospitalName()
  {
    var val = $("#hospital_name").val();
    val = val.trim();
    if (val.length === 0) {
      markInputInvalid($("#hospital_name").get(0), 'Please enter hospital name');
    } else {
      $.get(_base_url+`auth/setting_validation_is_unique_hospital_name?name=${encodeURIComponent(val)}`, function(is_unique) {
        if (is_unique) {
          markInputValid($("#hospital_name").get(0));
          var hospital_name = val;
          var first_initials = hospital_name.charAt(0);
          $("#hospital_initials_1").val(first_initials);

var matches = hospital_name.match(/\b(\w)/g); // ['J','S','O','N']
var acronym = matches.join(''); // JSON
var last_initials = acronym.charAt(1);
$("#hospital_initials_2").val(last_initials);

} else {
  markInputInvalid($("#hospital_name").get(0), "Hospital already exists");
}
}).fail(function(err) {
  console.log(err);
  markInputInvalid($("#hospital_name").get(0), 'Server error try again later');
});
}
// $("#table-institute-name").html(`<b>${val}</b>`);

}
function ShowUsersGroup(gid)
{   
  $.get(_base_url + 'institute/get_active_directory_users_lab?type='+gid, function(data) 
  {
    $("#active-directory-select-container_new").empty();
    $('#select_user_role').hide();
    var template = $(`<select id="active-directory-select" name ="active-directory-select" class="select">
      </select>`);
    if (data.length === 0) {
      template = $('<p>Active directory empty for this group</p>');
    }
    if(data !=0){
      template.append(`<option value="">Select Active Director User</option>`);
    }
    for (let i = 0; i < data.length; i++) {
      var user = data[i];
      template.append(`<option value="${user.id}">${user.first_name} ${user.last_name}</option>`);
    }

// console.log(template);
$("#active-directory-select-container_new").append(template);
$("#active-directory-select").select2({width: '100%'});

$("#active-directory-select").on('select2:select', function() {
  var user_id = $(this).val();
  $('input[name="active_directory_user"]').val(user_id);
  $.get(_base_url + 'institute/get_user_details?id='+user_id, function(data) 
  {
    
    $("#password-row").hide();
    $("#memo-row").hide();
    $("#location_area").hide();
    $("#email").prop('readonly', true);
    $("#first_name").val(data['first_name']);
    $("#last_name").val(data['last_name']);
    $("#company").val(data['company']);
    $("#phone").val(data['phone']);
    $("#email").val(data['email']);
    $("#password").val('');
    $("#password").prop('disabled', true);
    $("#first_name").prop('readonly', true);
    $("#last_name").prop('readonly', true);
    $("#company").prop('readonly', true);
    $("#phone").prop('readonly', true);
    $("#email").prop('readonly', true);
    $("#memorable").prop('readonly', true);                  
    $("#password_confirm").prop('disabled', true);
    $("#user-create-btn").prop('disabled', false);
    $("#active_directory_user").val($("#active-directory-select").val());
    if (!(data['profile_picture'] === null || data['profile_picture'].length === 0)) {
      $("#profile-pic").val('');
      $("#profile-pic-preview").attr('src', _base_url+data['profile_picture']);
    }
  });
});
$("#user_group_type").val(group_type);
$('#select_user_role').show();
});
}			

function ShowAllLabs_Data(group_type) {
  setTimeout(function () {
    $.get(_base_url + 'institute/get_active_directory_labs?type=' + group_type, function (data) {
      $("#active-directory-select-container2").empty();
      var template = $(`<select id="active-directory-select" class="select"><option>Select lab to add supplier</option></select>`);
      if (data.length === 0) 
	  {
        template = $('<p>Active directory empty for this group</p>');
      }
      for (let i = 0; i < data.length; i++) {
        var user = data[i];
        template.append(`<option value="${user.id}">${user.description}</option>`);
      }
      console.log(template);
      $("#active-directory-select-container2").append(template);
      $("#active-directory-select").select2({width: '100%'});
      $("#active-directory-select").on('select2:select', function () 
	  {
        var user_id = $(this).val();
        $('input[name="active_directory_user"]').val(user_id);
        $.get(_base_url + 'institute/update_labGroup_details?id=' + user_id, function (data) {
          $.get(_base_url + 'institute/fetch_all_labs?type=L', function (data) {
            for (let i = 0; i < data.length; i++) {
              var lab = data[i];
              var users = lab.users;
              var template = `
              <li class="list-group-item">
              <div class="row">
              <div class="col-md-6" style="cursor: pointer;" data-toggle="collapse" data-target="#lab-users-${lab.id}">
              ${lab.description}
              </div>
              
              </div>
              <div class="collapse" id="lab-users-${lab.id}">
              <ul class="list-group">

              </ul>
              </div>
              </li>`;
              var lab_row = $(template);
              for (let j = 0; j < users.length; j++) {
                var user = users[j];
                var img_src = _base_url + 'assets/img/user.jpg';
                if (user['profile_picture']) {
                  img_src = _base_url + user['profile_picture'];
                }
                var user_template = `<li class="list-group-item"> <img src="${img_src}" class="user_image"/> ${user.first_name} ${user.last_name}</li>`;
                lab_row.find('.list-group').append($(user_template));
              }
              $("#group-list-container").append(lab_row);
            }
            $("#group-modal").modal('show');
          });
          $('#suc_mesg').append("<font style='color:red;'>Lab added successfully</font>");
          location.reload();
        });
      });
    });
  }, 500);
}

var division_id='';
var department_id='';
function getDepartment_list(divisionid){
  division_id = divisionid;
  setTimeout(function () {
    $.get(_base_url + 'institute/get_active_department?type=' + division_id, function (data) {
     var html='<option value="">Select Department</option>';
     for (let i = 0; i < data.length; i++) {
      if(data[i]['id']==division_id){
        let departLen = data[i]['department'];

        for (var key in departLen){

            var value = departLen[key];
            html+=`<option value="`+departLen[key]['d_id']+`">`+departLen[key]['name']+`</option>`;
        }       
      }
      
     } 
     $('#devision_department_list').html(html);
     $('#speciality_list').html('<option value="">Select Speciality</option>');
     $('#cat_department_list').html('<option value="">Select Category</option>');
    });
  }, 500);
}

function department_spe(departmentid){
  department_id = departmentid;
  setTimeout(function () {
    $.get(_base_url + 'institute/get_active_department?type=' + division_id, function (data) {
     var html='<option value="">Select Department</option>';
     for (let i = 0; i < data.length; i++) {
      if(data[i]['id']==division_id){
        let departLen = data[i]['department'];

        for (var key in departLen){
          if(key == department_id){
          let speciality = departLen[key]['specialties'];
            for (var k1 in speciality){
              html+=`<option value="`+speciality[k1]['s_id']+`">`+speciality[k1]['name']+`</option>`;
            }
          }
            
            
        }       
      }
      
     } 
     $('#speciality_list').html(html);
     $('#cat_department_list').html('<option value="">Select Category</option>');
    });
  }, 500);

}

function getcategory(specialityid){
 setTimeout(function () {
    $.get(_base_url + 'institute/get_active_department?type=' + division_id, function (data) {
     var html='<option value="">Select Department</option>';
     for (let i = 0; i < data.length; i++) {
      if(data[i]['id']==division_id){
        let departLen = data[i]['department'];

        for (var key in departLen){
          if(key == department_id){
          let speciality = departLen[key]['specialties'];
            for (var k1 in speciality){
              
              let category =speciality[k1]['categories'];
              for (var k2 in category){
                html+=`<option value="`+category[k2]['category_id']+`">`+category[k2]['name']+`</option>`;
              }
              
            }
            
          }
        }       
      }
      
     } 
     $('#cat_department_list').html(html);
    });
  }, 500);

  
}


</script>
<?php if ($has_user_error) { ?>
  <script>
    var has_user_error = true;
  </script>
<?php } else { ?>
  <script>
    var has_user_error = false;
  </script>
  <?php } ?>