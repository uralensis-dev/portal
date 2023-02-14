<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" />
<style type="text/css">
    .page-header {
        margin:0 0 1.875rem;
        border-bottom:0px;
    }
    .content{background: #f5f5f5}
    table tr th:nth-child(13),
    table tr th:nth-child(14),
    table tr td:nth-child(13),
    table tr td:nth-child(14){
        display: none;
    }
    .row_purple{border-left: 0px !important;}
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top:-58px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding:0;
    }
    /*div.dataTables_wrapper div.dataTables_filter{display: none !important}*/
    .edit_icon {
        background: #e5e5e5;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 1.7;
        font-size: 18px;
        border-radius: 15px;
        cursor: pointer;
        color: #000;
    }
    div.dataTables_wrapper div.dataTables_filter label{
    margin: 0;
        }

        .tg-searchrecordhold{padding: 0;}

    .user_image{
        width: 50px;
        border-radius: 30px;
    }
    div.dataTables_wrapper div.dataTables_filter {
        position: relative;
        top: -52px;
        right: 15px;
        max-width: 210px;
        float: right;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        border-radius: 4px;
        height: 37px !important;
        padding: 0;
    }
    div.dataTables_wrapper div.dataTables_filter:before {
        content: "\f002";
        position: absolute;
        right: -12px;
        top: 0;
        bottom: 0;
        width: 40px;
        z-index: 9;
        background: #55ce63;
        text-align: center;
        line-height: 2;
        color: #fff;
        font-family: 'FontAwesome';
        cursor: pointer;
    }
    .dataTables_wrapper .row:first-child{height: 1px;}
    
    .doct_pic_table{
        width: 40px;
        float: left;
        border-radius: 20px;
        margin-right: 5px;
    }
    .ubpub_pic{width: 25px; margin: 0 auto;}
    .record_id_unpublish:focus{outline: none;}
    .user-menu.nav > li > a > img{padding-top: 19px;}
    #admin_display_records.table > thead > tr > th:last-child,
    #admin_display_records.table > tbody > tr > td:last-child{
        text-align: right;
    }
    div.dataTables_wrapper div.dataTables_length select{
        padding: 0 10px;
    }
    .tg-cancel input{
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 40px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
        margin-left: 2px;
    }
	div.dataTables_wrapper .dataTables_filter {
        display: block !important;
    }
    @media screen and (min-width: 1480px){
        div.dataTables_wrapper div.dataTables_filter{
            top:-58px;
            right: 15px;
        }
    }
    .tg-statusbar.tg-flagcolor .tg-checkboxgroup .tg-radio label{
        font-size: 14px;
        font-weight: 300;
    }
    .breadcrumb{position: relative; top:5px; left: -15px;}

    .breadcrumb-item{
        font-size: 14px;
    }

    .breadcrumb-item:nth-child(1)::before{
        display: none;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Records</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Unpublish Records</li>
            </ul>
        </div>
    </div>
</div>
<!-- /Page Header -->
<div class="tg-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor">
                            
                        </li>
                        <li class="tg-statusbar tg-flagcolor" style="padding: 5px">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo numbers_check">
                                <span class="tg-radio tg-flagcolor1">
                                    <input class="tat" name="tat" id="tat5"  type="radio">
                                    <label for="tat5"><span>&lt;5</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor2">
                                    <input class="tat" type="radio" name="tat" id="tat10">
                                    <label for="tat10"><span>&lt;10</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor3">
                                    <input class="tat" type="radio" name="tat" id="tat20">
                                    <label for="tat20"><span>&lt;20</span></label>
                                </span>
                                <span class="tg-radio tg-flagcolor4">
                                    <input class="tat" type="radio" name="tat" id="tat30">
                                    <label for="tat30"><span>&gt;20</span></label>
                                </span>
                                <span class="tg-cancel tg-flagcolor4" style="display: none;">
                                    <input class="tat" type="radio" name="tat" id="all_tat">
                                    <label for="all_tat">
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>
                        
                        <li class="tg-flagcolor" style="padding: 3px 8px">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo flags_check">
                                <?php
                                if ($this->session->userdata('color_code') !== '') {
                                    $session_color = $this->session->userdata('color_code');
                                }
                                ?>
                                <span class="tg-radio tg-flagcolor1 first">
                                    
                                    <input type="radio" id="flag_blue" class="flag_status" name="flag_sorting">
                                    <label for="flag_blue"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor2">
                                    
                                    <input type="radio" id="flag_green" class="flag_status" name="flag_sorting">
                                    <label for="flag_green"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor3">
                                    
                                    <input type="radio" id="flag_yellow" class="flag_status" name="flag_sorting">
                                    <label for="flag_yellow"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor4">
                                    
                                    <input type="radio" id="flag_black" class="flag_status" name="flag_sorting">
                                    <label for="flag_black"></label>
                                </span>
                                <span class="tg-radio tg-flagcolor5">
                                    
                                    <input type="radio" id="flag_red" class="flag_status" name="flag_sorting">
                                    <label for="flag_red"></label>
                                </span>
                                <span class="tg-cancel tg-flagcolor6" style="display: none">
                                    <input checked type="radio" class="flag_status"  name="flag_sorting" id="flag_all">
                                    <label for="falg_all">
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>

                        <li class="tg-statusbar tg-flagcolor custome-flagcolors">
                            <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                
                                <span class="tg-radio tg-flagcolor4" title="Urgent">
                                    <input id="report_urgent" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_urgent">
            
                                        <img src="<?php echo base_url('/assets/icons/Urgent-wb.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Urgent-wb-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4" title="Routine">
                                    <input id="report_routine" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_routine">
                                    <img src="<?php echo base_url('/assets/icons/Rotate.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/Rotate-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-radio tg-flagcolor4" title="2WW">
                                    <input id="report_2ww" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_2ww">
                                        <img src="<?php echo base_url('/assets/icons/2ww-wc.png'); ?>" class="img-responsive uncheck">
                                        <img src="<?php echo base_url('/assets/icons/white/2ww-wc-white.png'); ?>" class="img-responsive checkd">
                                    </label>
                                </span>

                                <span class="tg-cancel tg-flagcolor4" title="Clear" style="display: none;">
                                    <input id="report_clear" class="report_urgency_status" type="radio" name="report_urgency">
                                    <label for="report_clear">
                                        <img src="<?php echo base_url();?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors last float-right" style="padding: 0 10px; display: none;">                              
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li>
                        <li class="tg-statusbar tg-flagcolor custome-flagcolors float-right nobefore search_li" style="padding: 0">
                            <!-- <div class="input-group">
                                <input id="unpub_custom_filter" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                  <button class="btn btn-success" type="submit">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </div>
                            </div> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
</div>
<div class="tg-dashboardform tg-haslayout custom-haslayout">
    <div class="collapse" id="collapse_adv_search">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-dashboardformhold">
                    <form class="tg-formtheme" action="<?php echo base_url('index.php/doctor/search_request'); ?>" method="post">
                        <fieldset class="row col-md-12">
                            <div class="col-md-3 form-group">
                                <input class="form-control" type="text" id="adv_search_first_name" name="first_name" placeholder="First Name" value="<?php echo $sr_first_name; ?>" >
                            </div>
                            <div class="col-md-3  form-group">
                                <input class="form-control" type="text" id="adv_search_sur_name" name="sur_name" placeholder="Last Name" value="<?php echo $sr_sur_name; ?>" >
                            </div>
                            <div class="col-md-3 form-group">
                                <input class="form-control" type="text" id="adv_search_nhs_no" name="nhs_no" placeholder="NHS Number" value="<?php echo $sr_nhs_no; ?>" >
                            </div>
                            <div class="col-md-3 form-group">
                                <span class="tg-select">
                                    <select data-placeholder="Gender" id="adv_search_gender" name="gender">
                                        <option value="">Gender</option>
                                        <option value="male" <?php echo (($sr_gender == 'male'?'selected':'')); ?> >Male</option>
                                        <option value="female"  <?php echo (($sr_gender == 'female'?'selected':'')); ?>>Female</option>
                                    </select>
                                </span>
                            </div>

                        </fieldset>
                        <fieldset class="col-md-12 row" style="padding-top: 10px !important;">
                            <div class="col-md-3 form-group tg-inputicon">
                                <i class="lnr lnr-calendar-full"></i>
                                <input type="text" name="dob" id="adv_search_dob" class="form-control unstyled" placeholder="DOB" value="<?php echo $sr_dob; ?>" >
                            </div>
                            <div class="col-md-3 form-group ">
                                <input type="text" name="" class="form-control" placeholder="Track No">
                            </div>
                            <div class="col-md-3 form-group ">
                                <input type="text" name="" class="form-control" placeholder="Lab No">
                            </div>
                            
                            <div class="col-md-3 form-group ">
                                <span class="tg-select">
                                    <select id="adv_search_speciality" data-placeholder="Speciality" name="specialty">
                                        <option value="">Speciality</option>
                                        <?php foreach($get_specialties as $spec){ ?>
                                            <option value="<?php echo $spec['specialty']; ?>" <?php echo (($spec['id'] == $sr_specialty?'selected':'')); ?> > <?php echo $spec['specialty']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </span>
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="hidden" name="speciality_group_hdn" value="<?php echo $speciality_group_hdn; ?>">
                                <button type="submit" class="btn btn-success btn-search">Advance Search</button>
                            </div>

                        </fieldset>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="collapse_filter_hospital" class="collapse">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-2">
                <div class="tg-dashboardformhold">
                    <div class="tg-titlevtwo">
                        <h3>Filter By Hospital</h3>
                    </div>
                    <form method="post" class="filter_by_hospital_form">
                        <table class="table table-bordered">
                            <tr class="bg-primary">
                                <th>Choose Clinic</th>
                            </tr>
                            <tr>
                                <td class="col-md-12">
                                    <select class="form-control filter_by_hospital" name="filter_by_hospital">
                                        <option value="0">Choose Clinic</option>
                                        <?php
                                        if (!empty($get_hospitals)) {
                                            foreach ($get_hospitals as $list_hospitals) {
                                               
                                                echo '<option value="' . $list_hospitals->id . '" >' . $list_hospitals->description . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="pull-right">
                            <button type="button" class="btn btn-warning filter_by_hospital_btn">Filter Result</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Filter -->

<div class="row">
    <div class="col-md-12">
        <div class="">
            <table id="admin_display_records"  class="table table-striped custom-table mb-0">
                <thead>
                    <tr>
                        <th></th>
                        <th>DIGI No.<br />Track No.</th>
                        <th>Client<br />Clinic</th>
                        <th>Courier<br />Assignment No.</th>
                        <th>Batch<br />PCI No.</th>
                        <th>Patient Name<br />NHS No<br />Age</th>
                        <th>LAB No.<br />Rel Date</th>
                        <th>Speciality</th>
                        <th>TAT</th>
                        <th><i class="la la-layers" style="font-size:18px;"></i></th>
                        <th>Doc<br />Name</th>
                        <th style="text-align: center; width: 104px;">Flag</th>
                        <th><i class="la la-bubble" style="font-size:18px;"></i></th>
                        <th><i class="la la-file-empty" style="font-size:18px;"></i></th>
                        <th><i class="las la-user-check" style="font-size:26px;" title="Assigned"></i></th>
                        <th><i class="la la-cloud-upload-alt"  style="font-size:28px;" title="Published / Unpublished"></i></th>
                        <th><img src="<?php echo base_url();?>assets/icons/Actions-Black.png" class="img-responsive pull-right" title="Actions" style="width: 30px"></th></th>
                        
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
</form>
<script>





function new_data(ids)
{
	var str = $("#assign_id").val();
	var result=str+"_"+ids;
	var str = $("#assign_id").val(result);
}




function load_filtered_data(docIDs) 
	{
		//alert(docIDs);
        var url = window.location.href;
        var url_year = url.split('/').reverse()[1];
        var url_type = url.split('/').reverse()[0];
        // $.blockUI({ message: null });
		var docs_ids = docIDs;
		//alert(docs_ids);
        var ajax_url = "<?php echo base_url('index.php/admin/display_all_ajax_unprocessing/'); ?>";
        var oTable = $('#admin_display_records').DataTable({
            "processing": false,
            "serverSide": true,
            "destroy": true,
			"searching": true,
            stateSave: true,
            "language": {
                "infoFiltered": ""
            },
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "order": [],
            "ajax": {
                url: ajax_url,
                type: "POST",
                complete: function () {
                    $.unblockUI();
                },
                data: {
                    'year': url_year,
                    'type': url_type,
                    'docs_ids': docs_ids,					
                }
            }
        });
    }
	
function show_filteredrecords(ids)
{
    var searchIDs = $("#doccheckbox input:checkbox:checked").map(function(){
      return $(this).val();
    }).get();
    load_filtered_data(searchIDs);
}
var custom_table = $('.custom-table').DataTable();
 
// #myInput is a <input type="text"> element
$('#unpub_custom_filter').on( 'keyup', function () {
    custom_table.search( this.value ).draw();
} );
</script>
