<?php
$attributes = array('id' => 'add_courier_form');
echo form_open('', $attributes);

?>
<input type="hidden" name='save_type' id='save_type' value='add'/>
<input type="hidden" name='edit_id' id='edit_id' value=''/>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group form-focus">
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
            <input type="text" name="user_id" value="<?php echo $generated_user_id; ?>"
                   class="form-control" disabled="disabled"/>
        </div>


    </div>
    <div class="col-sm-4">
        <div class="form-group form-focus">
            <label>Request No.</label>
            <input type="text" name="courier_no" id="courier_no"
                   value="<?php echo strtoupper(substr($_SESSION['first_name'], 0, 1)) . strtoupper(substr($_SESSION['last_name'], 0, 1)) . "-" . date("y") . "-" . $courier_no; ?>"
                   class="form-control" disabled="disabled"/>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group form-focus">
            <label>Date</label>
            <input type="text" id="requested_date" name="" value="<?php echo date("d-m-Y") ?>" class="form-control"
                   disabled="disabled"/>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group form-focus">
            <input type="text" name="consignment_no" id="consignment_no" class="form-control floating">
            <label class="focus-label">Consignment No.</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-focus">
            <!--					<input type="text" class="form-control floating" disabled="disabled">-->
            <input class="form-control floating datepicker_new" type="text" name="collection_date" id="collection_date"
                   readonly>
            <label class="focus-label">Collection Date & Time</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group form-focus">
            <input type="text" class="form-control floating" name="parcel_weight"
                   onkeypress="return isNumberKey(event)">
            <label class="focus-label">Parcel Wieght (gm)</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-focus">
            <select class="floating select2" name="organization_id" id="organization_id"
                    style="width: 100%">
                <option value=""> -- Select --</option>
                <?php
                $selectedShow = (count($user_organizations) == 1 ? "selected" : "");
                foreach ($user_organizations as $organization) { ?>
                    <option value="<?php echo $organization->id; ?>" <?php echo $selectedShow; ?>><?php echo $organization->name; ?></option>
                <?php } ?>
            </select>
            <label class="focus-label">Organization</label>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group form-focus select-focus">
            <select class="select2 floating" name="urgency_type" style="width: 100%">
                <option value=""> -- Select --</option>
                <option value="FD"> Fast Delivery</option>
                <option value="FC"> First Class</option>
                <option value="SC"> Second Class</option>
            </select>
            <label class="focus-label">Choose Urgency</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group form-focus select-focus">
            <select class="select2 floating" name="courier_company" style="width: 100%">
                <option value=""> -- Select --</option>
                <option value="DPD"> DPD</option>
                <option value="APC"> APC</option>
                <option value="FedEx"> FedEx</option>
            </select>
            <label class="focus-label">Courier Company</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 form-group">
        <div class="form-focus select-focus">
            <select class="floating select2" name="sender_search" id="sender_search"
                    style="width: 100%">
                <option value=""> -- Select --</option>
                <?php
                foreach ($user_data as $user) { ?>
                    <option data-address="<?php echo $user->address1; ?>" data-address2="<?php echo $user->address2; ?>"
                            value="<?php echo $user->user_id; ?>" <?php echo($userinfo[0]->id == $user->id ? "selected" : "") ?>><?php echo $user->first_name . " " . $user->last_name; ?></option>
                <?php } ?>
                <option value="add-user">--Add User--</option>
            </select>
            <label class="focus-label">Sender Search</label>
        </div>
    </div>
    <div class="col-md-6 form-group">
        <div class="form-focus select-focus">
            <select class="floating select2" name="receiver_search" id="receiver_search"
                    style="width: 100%">
                <option value=""> -- Select --</option>
                <?php
                foreach ($user_data as $user) { ?>
                    <option data-address="<?php echo $user->address1; ?>" data-address2="<?php echo $user->address2; ?>"
                            value="<?php echo $user->user_id; ?>"><?php echo $user->first_name . " " . $user->last_name; ?></option>
                <?php } ?>
                <option value="add-user">--Add User--</option>
            </select>
            <label class="focus-label">Receiver Search</label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 form-group">
        <div class="form-group form-focus">
            <input type="text" class="form-control floating" id="s_address" name="sender_address" readonly>
            <label class="focus-label">Sender Address</label>
        </div>
    </div>
    <div class="col-md-6 form-group">
        <div class="form-group form-focus">
            <input type="text" class="form-control floating" id="r_address" name="receiver_address" readonly>
            <label class="focus-label">Receiver Address</label>
        </div>
    </div>
</div>
<div class="submit-section">
    <button class="btn btn-primary submit-btn tck-smbt-btn" type='submit'>Update Request</button>
</div>
<?php echo form_close(); ?>
