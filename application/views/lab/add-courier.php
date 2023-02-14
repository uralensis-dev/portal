<!-- Page Content -->
<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        float: left;
        margin-right: 12px;
    }

    .checkbox label {
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
    }

    @media screen and (max-width: 1380px) {
        .form-focus .focus-label {
            font-size: 14px;
        }
    }
</style>

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Add Courier Consignment</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Add Courier Consignment</li>
            </ul>
        </div>
    </div>
</div>
<?php
$attributes = array('id' => 'add_courier_form');
echo form_open('', $attributes);
?>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<div class="row form-group">
    <div class="col-md-3">
        <label>Batch No.</label>
        <input type="text" name="batch_no" value="<?php echo "BN-" . date("y") . "-" . $batch_no; ?>"
               class="form-control" disabled="disabled"/>
    </div>
    <div class="col-md-3">
        <label>Courier No.</label>
        <input type="text" name="courier_no" value="<?php echo "CN-" . date("y") . "-" . $courier_no; ?>"
               class="form-control" disabled="disabled"/>
    </div>
    <div class="col-md-3">
        <label>User ID
            <?php
            $userinfo = getLoggedInUserProfile(intval($this->ion_auth->user()->row()->id));
            ?>
            <span class="user-img">
                            <img style="border-radius: 50%;width: 25px;height: 25px"
                                 src="<?php echo get_profile_picture($userinfo[0]->profile_picture_path, $userinfo[0]->first_name, $userinfo[0]->last_name); ?>"
                                 alt="">
            </span>
            <span><?php echo $userinfo[0]->first_name . ' ' . $userinfo[0]->last_name; ?></span>
        </label>
        <input type="text" name="user_id" value="<?php echo $generated_user_id; ?>" class="form-control"
               disabled="disabled"/>
    </div>
    <div class="col-md-3">
        <label>Date</label>
        <input type="text" name="" value="<?php echo date("Y-m-d") ?>" class="form-control" disabled="disabled"/>
    </div>
</div>
<div class="card form-group">
    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>"
           value="<?= $this->security->get_csrf_hash(); ?>">
    <div class="card-body">
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus">
                    <input type="text" name="consignment_no" class="form-control floating">
                    <label class="focus-label">Consignment No.</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus">
                    <!--					<input type="text" class="form-control floating" disabled="disabled">-->
                    <input class="form-control floating datepicker_new" type="text" name="collection_date" readonly>
                    <label class="focus-label">Collection Date</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus">
                    <!--					<input type="text" class="form-control floating" disabled="disabled">-->
                    <input type="text" class="form-control floating timepicker" name="collection_time" readonly>
                    <label class="focus-label">Collection Time</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating" name="parcel_weight"
                           onkeypress="return isNumberKey(event)">
                    <label class="focus-label">Parcel Wieght (gm)</label>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus select-focus">
                    <select class="select2 floating" name="urgency_type" style="width: 100%">
                        <option> -- Select --</option>
                        <option value="Fast Delivery"> Fast Delivery</option>
                        <option value="First Class"> First Class</option>
                        <option value="Second Class"> Second Class</option>
                    </select>
                    <label class="focus-label">Choose Urgency</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <div class="form-group form-focus select-focus">
                    <select class="select2 floating" name="courier_company" style="width: 100%">
                        <option> -- Select --</option>
                        <option value="DPD"> DPD </option>
                        <option value="APC"> APC </option>
                        <option value="FedEx"> FedEx</option>
                    </select>
                    <label class="focus-label">Courier Company</label>
                </div>
            </div>

            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                <a href="javascript:;" class="btn btn-success btn-block text-captilized btn-item-add"> <i
                            class="fa fa-plus"></i> Item </a>
            <br/>
            </div>


            <div class="clearfix"></div>

            <div class="col-sm-12 form-group">
                <table class="table">
                    <tbody class="itembody">
                    <tr class="duplicate_row" id="row_1">
                        <td style="width:5%"><strong class="item-counter">1</strong></td>
                        <td style="width:20%">
                            <div class="">
                                <div class="form-focus select-focus">
                                    <select class="floating item_type form-control" style="width: 100%" name="item_type[]">
                                        <option> -- Select --</option>
                                        <option value="specimen"> Specimen</option>
                                        <option value="parcel"> Parcel</option>
                                        <option value="other"> Other</option>
                                    </select>
                                    <label class="focus-label">Select Item</label>
                                </div>
                            </div>
                        </td>
                        <td style="width:75%">
                            <div class="row specimen_div " style="display: none">
                                <!--                                <div class="col-md-3">-->
                                <div class="form-group form-focus">
                                    <select class="floating item_department form-control" style="width: 100%"
                                            name="item_departments[]">
                                        <option> -- Select --</option>
                                        <?php foreach ($departments as $d_id => $department) { ?>
                                            <option value="<?php echo $d_id; ?>"><?php echo $department['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <label class="focus-label">Department</label>
                                </div>
                                <div class="form-group form-focus">
                                    <select class="floating item_st form-control" style="width: 100%"
                                            name="item_st[]">
                                        <option> -- Select --</option>
                                    </select>
                                    <label class="focus-label">Specimen Type</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="item_lab[]">
                                    <label class="focus-label">Lab No.</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="item_block[]">
                                    <label class="focus-label">Block No.</label>
                                </div>

                            </div>
                            <div class="row other_div " style="display: none">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="other_detail[]">
                                    <label class="focus-label">Detail</label>
                                </div>
                            </div>

                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <!-- Search Filter -->

</div>

<div class="row form-group">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <!--						<input type="text" name="" class="form-control" placeholder="Sender Search">-->
                        <div class="form-focus select-focus">
                            <select class="floating select2" name="sender_search" id="sender_search"
                                    style="width: 100%">
                                <option> -- Select --</option>
                                <?php
                                foreach ($user_data as $user) { ?>
                                    <option value="<?php echo $user->id; ?>"><?php echo $user->first_name . " " . $user->last_name; ?></option>
                                <?php } ?>
                            </select>
                            <label class="focus-label">Sender Search</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Organization</label>
                            </div>
                            <div class="col-md-8 s_organization"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Person Name</label>
                            </div>
                            <div class="col-md-8 s_person"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Contact Details</label>
                            </div>
                            <div class="col-md-8 s_phone"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>First Line Address</label>
                            </div>
                            <div class="col-md-8 s_address1"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Second Line Address</label>
                            </div>
                            <div class="col-md-8 s_address2"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>County</label>
                            </div>
                            <div class="col-md-8 s_county"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Country</label>
                            </div>
                            <div class="col-md-8 s_country"></div>
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Post Code</label>
                            </div>
                            <div class="col-md-8 s_postcode"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <!--						<input type="text" name="" class="form-control" placeholder="Destination Search">-->
                        <div class="form-focus select-focus">
                            <select class="floating select2" name="receiver_search" id="receiver_search"
                                    style="width: 100%">
                                <option> -- Select --</option>
                                <?php
                                foreach ($user_data as $user) { ?>
                                    <option value="<?php echo $user->id; ?>"><?php echo $user->first_name . " " . $user->last_name; ?></option>
                                <?php } ?>
                            </select>
                            <label class="focus-label">Destination Search</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Organization</label>
                            </div>
                            <div class="col-md-8 r_organization"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Person Name</label>
                            </div>
                            <div class="col-md-8 r_person"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Contact Details</label>
                            </div>
                            <div class="col-md-8 r_phone"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>First Line Address</label>
                            </div>
                            <div class="col-md-8 r_address1"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Second Line Address</label>
                            </div>
                            <div class="col-md-8 r_address2"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>County</label>
                            </div>
                            <div class="col-md-8 r_county"></div>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Country</label>
                            </div>
                            <div class="col-md-8 r_country"></div>
                        </div>
                    </div>

                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Post Code</label>
                            </div>
                            <div class="col-md-8 r_postcode"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group stext-center">
    <div class="col-md-12 text-center">
        <a href="#" class="btn btn-primary btn-rounded btn-lg" id="add_courier_btn">Submit</a>
    </div>
</div>


<?php echo form_close(); ?>

<script>
    const departments = JSON.parse(`
        <?php echo json_encode($departments); ?>
    `);
    console.log(departments);
</script>