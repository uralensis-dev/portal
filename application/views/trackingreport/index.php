<style>
    .trackBtnWrap {
        display: flex;
        flex-direction: row;
    }

    .trackBtnWrap .trackBtn {
        margin: 10px;
    }


    .containertrack {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .containertrack input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }


    /* On mouse-over, add a grey background color */
    .containertrack:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .containertrack input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .containertrack input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .containertrack .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url();?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tracking Report</li>
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
                        <h3 class="page-title">Tracking Report</h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <form method="get" action="<?php echo base_url() . "TrackingReport/lab_record_list/" ?>">

                <section class="form-group">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <div class="trackBtnWrap">
                                <div class="trackBtn">
                                    <label class="containertrack">Published Reports
                                        <input type="radio" checked="checked" name="reportType" value="published">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="trackBtn">
                                    <label class="containertrack">Published & UnPublished Reports
                                        <input type="radio" name="reportType" value="all">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <h3>Select Fields</h3>
                                        <label class="containertrack">Lab No
                                            <input type="checkbox" name="fields[labNo]" values="labNo" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Clinic
                                            <input type="checkbox" name="fields[clinic]" values="clinic" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Speciality
                                            <input type="checkbox" name="fields[speciality]" values="speciality" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Courier No
                                            <input type="checkbox" name="fields[courierNo]" values="courierNo" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Patient
                                            <input type="checkbox" name="fields[patient]" values="patient" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">DOB
                                            <input type="checkbox" name="fields[dob]" values="dob" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">TAT
                                            <input type="checkbox" name="fields[tat]" values="tat" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Pathologist
                                            <input type="checkbox" name="fields[pathologist]" values="pathologist" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Added By
                                            <input type="checkbox" name="fields[addedby]" values="addedby" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Requested Date
                                            <input type="checkbox" name="fields[requestedDate]" values="requestedDate" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">Published Date
                                            <input type="checkbox" name="fields[publishedDate]" values="publishedDate" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Requested date from</label>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-calendar-full"></i>
                                        <input type="date" name="start" id="dob-start" value="" class="form-control" placeholder="Choose Requested date from">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Requested date to</label>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-calendar-full"></i>
                                        <input type="date" name="end" id="dob-end" value="" class="form-control" placeholder="Choose Requested date to">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Published date from</label>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-calendar-full"></i>
                                        <input type="date" name="publish-start" id="published-dob-start" value="" class="form-control" placeholder="Choose Published date from">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Published date to</label>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-calendar-full"></i>
                                        <input type="date" name="publish-end" id="published-dob-end" value="" class="form-control" placeholder="Choose Published date to">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Hospital</label>
                                    <div class="form-group tg-inputwithicon">
                                        <select type="text" name="group" id="group-input" value="" class="form-control select" onchange="GetPathologist(this)">
                                            <option value="">--Select Hospital--</option>
                                            <?php foreach ($hospital_info as $key => $hospital) { ?>
                                                <option value="<?php echo $hospital['group_id'] ?>"><?php echo $hospital['description'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Pathologist</label>
                                    <div class="form-group tg-inputwithicon">
                                        <select type="text" name="pathologist" id="pathologist-input" value="" class="form-control select" >
                                            <option value="">--Select Pathologist--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <h3>Make sure Supplementary Reported</h3>
                                        <label class="containertrack">Yes
                                            <input type="radio" name="supplementaryReported" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">No
                                            <input type="radio" name="supplementaryReported" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Supplementary date from</label>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-calendar-full"></i>
                                        <input type="date" name="sup-start" id="sup-start" value="" class="form-control" placeholder="Choose Supplementary date from">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Choose Supplementary date to</label>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-calendar-full"></i>
                                        <input type="date" name="sup-end" id="sup-end" value="" class="form-control" placeholder="Choose Supplementary date to">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <h3> Further Work</h3>
                                        <label class="containertrack">Yes
                                            <input type="radio" name="furtherwork" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containertrack">No
                                            <input type="radio" name="furtherwork" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label><strong>Age</strong></label>
                                    <div class="form-group tg-inputwithicon">
                                        <i class="lnr lnr-calendar-full"></i>
                                        <input type="text" name="age" id="age" value="" class="form-control" placeholder="Enter age to search" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label><strong>Age Between</strong></label>
                                    <div class="form-group tg-inputwithicon">
                                        <select name="ageBetween" id="group-input" class="form-control select select2-hidden-accessible" data-select2-id="group-input" tabindex="-1" aria-hidden="true">
                                            <option value="above">Above &  Equal to</option>
                                            <option value="below">Below &  Equal to</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                                <div>

                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
</div>
<script>
    function GetPathologist(row) {

        var selectedValue = $(row).val()
        $.ajax({
            type: "POST",
            url: _base_url + 'TrackingReport/GetPathologist',
            data: {
                'groupId': selectedValue,
                [csrf_name]: csrf_hash
            },
            success: function(response) {
                $('#pathologist-input').html(response);
            }
        });
    }
</script>