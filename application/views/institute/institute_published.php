<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
    /*.container-fluid{
        margin-left: 20px;
    }*/
    div.dataTables_wrapper div.dataTables_length select {
        width: 55px;
        display: inline-block;
        padding: 0 5px;
        position: absolute;
        top: -56px;
        /*left: 0;*/
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
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }
    .customBtn{
        padding: 5px 20px !important;
    border-radius: 5px !important;
    color: white !important;
    font-weight: 500 !important;
    font-size: 16px !important;
    }
     @media screen and (min-width: 1600px) {
        body{font-size: 18px;}
    }
    @media screen and (max-width: 1580px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }
        div.dataTables_wrapper div.dataTables_length select{top: -59px;}
    }
    #display_new_records_filter{
        display : block !important;
    }
    div.dataTables_wrapper div.dataTables_length select{
        position: absolute;
        top: -52px;
        height: 37px !important;
        width: 50px !important;
        left: 25px;
        padding: 0;
    }
</style>
<div class="container-fluid">
    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if ($type == 'published') {
	$active_bcrumb = $title = 'Published Reports';
} else if ($type == 'unpublished') {
	$active_bcrumb = $title = 'Unpublished Reports';
} else {
	$active_bcrumb = $title = 'All Reports';
}?>
        <h3 class="page-title"><?=$title;?> </h3>
        <div class="tg-breadcrumbarea tg-searchrecordhold">
            <div class="tg-breadcrumbarea tg-searchrecordhold">
                <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                    <li><a href="javascript:;">Dashboard</a></li>
                    <li><a href="javascript:;" class="active"><?=$active_bcrumb;?></a></li>
                </ol>

            </div>
            <div class="tg-rightarea hide">
                <div class="tg-haslayout">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding-right">
                            <div class="tg-filterhold">
                                <ul class="tg-filters record-list-filters">
                                    <li class="tg-statusbar tg-flagcolor">
                                        <div class="tg-checkboxgroup tg-checkboxgroupvtwo">
                                            <?php $hospitals = getAllHospitals();?>
                                            <?php foreach ($hospitals as $hospital): ?>
                                            <span title="<?php echo $hospital['description'] ?>" class="tg-radio tg-flagcolor1">
                                                <input value="<?php echo $hospital['id'] ?>" class="filter_by_hospital_btn" name="hostpital" id="<?php echo $hospital['first_initial'] ?><?php echo $hospital['last_initial'] ?>"  type="radio">
                                                <label for="<?php echo $hospital['first_initial'] ?><?php echo $hospital['last_initial'] ?>"><span><?php echo $hospital['first_initial'] ?><?php echo $hospital['last_initial'] ?></span></label>
                                            </span>
                                            <?php endforeach;?>
                                            <span title="All" class="tg-cancel tg-flagcolor1" style="display: none;">
                                                <input value="0" class="filter_by_hospital_btn" name="hostpital" id="aa"  type="radio">
                                                <label for="aa"><span><img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll"></span></label>
                                            </span>
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
    <div class="tg-haslayout">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="tg-filterhold">
                    <ul class="tg-filters record-list-filters">
                        <li class="tg-statusbar tg-flagcolor">

                        </li>
                        <li class="tg-statusbar tg-flagcolor hide" style="padding: 5px">
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
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>

                        <li class="tg-flagcolor hide" style="padding: 3px 8px">
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
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>

                        <li class="tg-statusbar tg-flagcolor custome-flagcolors hide">
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
                                        <img src="<?php echo base_url(); ?>assets/img/clearAll.png" class="img-responsive clearAll">
                                    </label>
                                </span>
                            </div>
                        </li>
                        <!-- <li class="tg-statusbar tg-flagcolor custome-flagcolors last pull-right" style="padding: 0 10px;">
                            <button type="submit" class="btn btn-default adv-search" data-toggle="collapse" data-target="#collapse_adv_search"><i class="fa fa-cog"></i></button>
                        </li> -->
                        <li class="">
                            <a href="<?php echo base_url(); ?>institute/reports/published/1" class="btn btn-success customBtn">Viewed</a>
                            <a href="<?php echo base_url(); ?>institute/reports/published/2" class="btn btn-success customBtn">Notviewed</a>
                            <a href="<?php echo base_url(); ?>institute/reports/published/3" class="btn btn-success customBtn">View All</a>
                        </li>
                        <li class="hide tg-statusbar tg-flagcolor custome-flagcolors pull-right nobefore search_li" style="padding: 0">
                            <div class="input-group">
                                <input id="unpub_custom_filter" type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                  <button class="btn btn-success" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                  </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
$records_data = array();
if (!empty($query)) {
	foreach ($query as $records) {
		$records_data[] = $records->uralensis_request_id;
	}
}
?>
            <script>
                var record_data = <?php echo json_encode($records_data); ?>;
            </script>
            <!-- <button type="button" id="mark_as_read_btn" class="btn btn-warning">Mark all as Viewed</button>
            <hr> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->session->flashdata('record-msg'); ?>
            <table id="display_new_records" class="table table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="check_all" id="check_all_request"><a href="javascript:;" class="generate-bulk-reports" data-bulkurl="<?php echo base_url('index.php/institute/generateBulkReports'); ?>"><img style="min-width: 15px; width: 25px; margin-left: 5px;" src="<?php echo base_url('assets/img/download-1.png'); ?>"></a><input type="hidden" name="bulk_report_ids"></th>
                        <th>UL No.<br />Track No.</th>
                        <th>Client<br />Clinic</th>
                        <th>Batch<br />PCI No.</th>
                        <th>Patient</th>
                        <th>NHS No.<br />DOB</th>
                        <!-- <th>LAB No.<br />EMIS No.</th> -->
                        <!-- <th><i class="lnr lnr-layers" style="font-size:18px;"></i></th> -->
                        <th>Detail</th>
                        <th>Status</th>
                        <!-- <th>V.Report</th> -->
                        <!-- <th>D.Report</th> -->
                        <th>Docs</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
     $(document).on("click", '.markedViewed', function(){
        var rid = $(this).attr('data-rid');
        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>/institute/MarkedAsViewed",
            data: {
                changeId: rid,
                [csrf_name]: csrf_hash,
            },
            success: function (response) {

            },
            error: function () {
                alert("Something went wrong. Please try again!");
            },
        });
    });
    // setTimeout(() => {
    //     $('#display_new_records').DataTable().destroy();
    //     $('#display_new_records').DataTable();
    // }, 500);
    var type = "<?=$type;?>";
     var viewType = "<?=$viewType;?>";
    var url = window.location.href;
    var url_year = url.split('/').reverse()[0];
    $('#display_new_records').DataTable({
        "processing": true,
        "serverSide": true,
		"searching": true,
        // stateSave: true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "order": [],
        "language": {
            "infoFiltered": ""
        },
        "ajax": {
            url: "<?php echo base_url('Institute/type_wise_report'); ?>",
            type: "post",
            data: {
                    [csrf_name]: csrf_hash,
                    'type': type,
                    'viewType': viewType
                },
        },
        "columnDefs": [
            {
                "targets": [0],
                "orderable": false
            }
        ], 
    });

    $('#check_all_request').change(function(){
        var all_br = $(this).prop('checked');
        $(".bulk_report_generate").prop('checked', all_br);
    });

    $('.generate-bulk-reports').click(function(){
        var radioChecked = $(".bulk_report_generate:checked").length;
        if(radioChecked > 0){
            var requestIds = '';
            $(".bulk_report_generate:checked").each(function() {
                requestIds += $(this).val()+ ",";
            });
            requestIds = requestIds.replace(/,\s*$/, "");
            var link = document.createElement('a');
            link.style.display = "none"; // because Firefox sux
            document.body.appendChild(link); // because Firefox sux
            link.href = "<?php echo base_url(); ?>/institute/DownloadRequestZip/"+encodeURIComponent(requestIds);
            link.target = "_blank";
            link.click();
            document.body.removeChild(link); // because Firefox sux
        }
    });

});
</script>