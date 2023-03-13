<style type="text/css">


.specimen_sticy {
    position: fixed;
    top: 125px;
    right: 0;
    width: 100%;
    left: 13%;
    z-index: 1000;
    padding-left: 35px;
    background: #fff;
    border-bottom: solid 1px #ccc;
}
/* style sheet for "letter" printing */
@media print and (width: 8.5in) and (height: 11in) {
    @page {
        margin: 1in;
    }
}

/* A4 Landscape*/
@page {
    size: A4 landscape;
    margin: 10%;
}
    #tinymce p {
        font-family: "CircularStd", sans-serif !important;
        font-size: 14px !important;
    }
    .form_input_container.focused{
        border-color: #00c5fb
    }
    .cims_area{display: none;}
    .table .edit_icon{opacity: 0;}
    .table:hover .edit_icon{opacity: 1; margin-right: 45px !important;}

    #macroscopic-description-container{margin-bottom: 10px;}
    .form-group.halfform-group[style="float: right"]{
        display: block; float:none !important;width: 100%;
    }
    .tg-tabfieldsettwo .btn-info.block_model_btn_1 {
    margin: 10px 0 0;
} 
.tg-inputicon {
    position: relative;
    margin-top: -22px;
    margin-left: 35px;
}
.tg-tabfieldset .form-group textarea.form-control{
    padding:15px;
}
table.info_nndn2 tbody tr td span {
    font-weight: 100 !important;
    font-size: 16px !important;
}
.table>thead>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th {
    font-size: 16px;
}
#tinymce,
#tinymce span{
    font-size: 16px !important;
}
.page-buttons {
    display: inherit;
    width: auto;
    position: fixed;
    bottom: 0;
    left: 260px;
    background: #f5f5f5;
    right: 16px;
    padding: 9px 90px 9px 35px;
    z-index: 99;
    border-radius: 5px;
}
.feedback_to_trainee_button{display: none;}
    .table.custom-table.info_nndn{margin-right: 40px;}
    .table.custom-table.info_nndn.hidden{margin-right: 10px;}
    label{
        font-weight: 300 !important
    }
    .chat.chat-left .chat-bubble:last-child .chat-content{
        max-width: 100%;
        width: 100%;
    }
    .bootstrap-select .bs-ok-default::after {
        width: 0.3em;
        height: 0.6em;
        border-width: 0 0.1em 0.1em 0;
        transform: rotate(45deg) translateY(0.5rem);
    }
    .chat{margin:0 0 15px; border-bottom: 1px solid #eee}
    .chat-bubble{min-height: 80px;}
    .task-chat-user{font-size: 20px;}
    .chat-time{font-size: 16px; margin: 0 0 10px;}
    .btn.dropdown-toggle:focus {
        outline: none !important;
        color: #fff;
    }
    .table.border-less tbody tr td{border: 0px !important; padding: 0 5px;}
    button.btn.btn-info.btn-sm.btn_collapse_all {
        font-size: 28px;
        padding: 5px; 
        line-height: 0;
        border-radius: 5px;
    }
    .w-100{width: 100%}
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn){
        width: 100%;
    }
    .px-1{padding-left: 5px; padding-right: 5px;}


    .custom_list_opi li {
        margin-bottom: 15px;
    }

    .custom_list_opi li a.btn.btn-default {
        background: #efefef !important;
    }

    .custom_list_opi li a.btn.btn-default:hover,
    .custom_list_opi li a.btn.btn-default:focus {
        background: #ddd !important;
    }
    #labEnquiryForm .error{
        color:red;
    }
    .microscopy-form-container,
    .tg-tabfieldset .form-group {
       /* border: 0px !important; */
       margin-bottom: 10px;
       padding: 0;
    }
    .form-group.form-group-tiny label {
    padding-left: 10px;
    padding-top: 5px;
}
.tg-themeinputbtn li label{
padding: 0!important;
}
.tg-tabfieldset .tg-themeinputbtn{
    padding: 5px 2px 0px 15px!important;
    width: 100%;
    border-top: 1px solid #ddd;
}
.tox-edit-area html body p{
    font-size:16px!important;
    font-weight:300!important;
}

     .cust_dd .dropdown-menu{min-width: 570px; padding: 0; top: 0; background: transparent;border-color: transparent; left: -185px !important;}
    .cust_dd .dropdown-menu li{padding: 0;}
    .cust_dd .dropdown-menu li a {
        margin:5px 0 0 5px;
        padding: unset;
        color: #fff;
        font-size: 24px;
        float: left;
        clear: none;
        line-height: 2;
    }
    .cust_dd .dropdown-menu li a:hover,
    .cust_dd .dropdown-menu li a:focus{background: #00c5fb;}
    .select2-container--default .select2-selection--multiple {
        height: auto !important;
    }

    p {
        font-family: 'CircularStd', sans-serif !important;
    }

    .modal-body {
        max-height: 825px !important;
    }

    .checkbox-wrap {
        margin: 0;
    }

    .tg-searchrecordoptionvtwo li a {
        background: transparent;
        width: auto;
        min-width: 46px; 
    }

    .circle {
        width: 15px;
        height: 15px;
        display: inline-block;
        margin-left: 10px;
        border-radius: 50%;
    }

    .info_nndn2 tbody tr td {
        border-top: 0px !important;
        font-weight: bold;
        padding: 0 5px !important;
    }

    .sec_title.p_id, .sec_title.p_id2, .sec_title.r_id, .sec_title.t_id {
        position: relative;
    }

    .form-group.halfform-group[style="float: right"] .sec_title {
        float: none !important;
        width: 100%;
    }

    .form-group.halfform-group[style="float: right"] .sec_title a {
        float: right;
    }
    .btn-success-outline {
        border-color: green;
        color: green;
        padding: 5px 8px;
        animation: blinker 1s linear infinite;
        background: green;
        color: #fff;
    }
    @keyframes blinker {
      50% {
        opacity: 0.5;
      }
    }

    .tox .tox-statusbar {
        display: none !important
    }

    select.form-control {
        height: 44px;
    }

    .vertical-align-p {
        margin: 10px 0 0 -10px;
        font-size: 1.5rem;
    }

    .info_nndn tbody tr td,
    .info_nndn2 tbody tr td {
        border-top: 0px !important;
        font-weight: bold;
    }

    .sec_title.p_id, .sec_title.p_id2, .sec_title.r_id, .sec_title.t_id {
        position: relative;
        background: #fff;
        padding: 6px;
        border: 1px solid #eee;
        border-bottom: 0;
        margin-bottom: 0;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }

    #p_id_title, #request_id_title {
        font-size: 20px;
    }

    .sec_title.p_id a.checv_up_down, .sec_title.p_id2 a.checv_up_down,
    .sec_title.r_id a.checv_up_down, .sec_title.r_id2 a.checv_up_down,
    .sec_title.t_id a.checv_up_down {
        position: absolute;
        top: 50%;
        margin-top: -13px;
        right: 25px;
        font-size: 20px;
    }

    .custom_badge_tat .badge {
        min-width: 36px;
        line-height: 28px;
        min-height: 36px;
    }

    ul li.hover_it {
        position: relative;
    }

    ul.list-unstyled.hover_cont {
        position: absolute;
    left: -164px;
    width: 200px;
    top: -4px;
    padding: 5px 0;
        display: none;
    }

    ul li.hover_it:hover ul.hover_cont {
        display: block;
    }

    .npr {
        padding-right: 0;
    }

    .new_sel:focus {
        border-color: #006df1
    }

    .circle.circle_blue {
        background: #006df1;
    }

    .circle.circle_green {
        background: #92dd59;
    }

    .circle.circle_yellow {
        background: #f0ce3b;
    }

    .circle.circle_black {
        background: #000;
    }

    .circle.circle_red {
        background: #e74c3c;
    }

    .carousel-control.left, .carousel-control.right {
        background-image: unset !important;
        background-repeat: unset;
    }

    .carousel-control.left {
        left: 10px !important
    }

    .carousel-control.right {
        right: 10px !important
    }

    .carousel-control {
        bottom: unset !important;
        font-size: 32px !important;
        text-shadow: unset !important;
        color: #000 !important;
        top: 50% !important;
        width: auto !important;
        /*left: 0  !important;*/
        transform: translateY(-50%) !important;
    }

    .p-l-0 {
        padding-left: 0;
    }

    .carousel-inner .item a {
        color: #000;
    }

    .carousel-inner .item img {
        width: 100%;
        height: 220px;
    }

    .tg-nextecord a i, .tg-previousrecord a i {
        width: 46px;
        height: 46px;
        font-size: 36px;
        line-height: 41px;
    }

    .tg-searchrecord fieldset .form-group .form-control {
        height: 46px;
        width: 260px;
        font-size: 16px;
    }

    .tg-searchrecord fieldset .form-group i {
        top: 6px;
        font-size: 26px;
    }
    .page-title {
        float: none;
    }

    .cims_area span.circle {
        display: inline-block;
        background: #f5f5f5;
        height: 50px;
        width: 50px;
        border: 1px solid #ddd;
        line-height: 3.5;
        text-align: center;

    }

    .page-header .breadcrumb {
        color: #6c757d;
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 0;
        display: block;
        padding-left: 0 !important;
        overflow: unset !important;
    }

    .cims_area .wrap_con {
        position: relative;
    }

    .cims_area .tabs_area {
        width: 80px;
        position: fixed;
        right: 0;
        top: 200px;
    }

    .microscopy_title_detail {
        margin-left: 20px;
        margin-bottom: 10px;
        display: inline-block;
    }

    #sendprivatemessage .form-group {
        width: 100%;
    }

    .cims_area .nav-tabs.nav-tabs-solid > li {
        display: block;
        width: 100%;
        text-align: center;
    }

    .cims_area .nav-tabs.nav-tabs-solid > li a {
        display: block;
        background: #fff;
        margin: 0;
        padding: 10px 0;
        /*height: 80px;*/
        /*border-bottom: 1px solid #ddd;*/
        /*line-height: 3.5;*/
    }

    .cims_area .nav-tabs.nav-tabs-solid > li a.active {
        background: #00c5fb;
        line-height: 3.5;
    }

    .cims_area .tab-content {
        width: 92%;
        float: left;
    }

    .cims_area .nav-link .simple {
        width: 50px;
    }

    .cims_area .nav-link.active .simple {
        display: none;
    }

    .cims_area .on_active {
        display: none;
    }

    .cims_area .nav-link.active .on_active {
        display: block;
        margin: 0 auto;
        width: 50px;
    }

    .cims_area span.circle {
        display: inline-block;
        background: #f5f5f5;
        height: 50px;
        width: 50px;
        border: 1px solid #ddd;
        line-height: 3;
        text-align: center;
    }

    .cims_area span.circle.bg-warning {
        color: #fff;
        border-color: #ffbc34;
        box-shadow: 0 0 2px #ffbc34;
    }

    .thumbnail p {
        color: #555;
        text-align: center;
        padding: 0 6px;
    }

    .thumbnail_slide {
        padding: 10px 12px;

        min-width: 85px !important;
        width: 123px !important;
        background-color: rgba(250, 250, 250, 1);
        border-radius: 15px;
    }

    .thumbnail_slide label {
        font-size: 1.2rem;
        line-height: 13px;
    }

    .thumbnail_slide_container {
        max-width: 175px;
    }

    .page-buttons .btn {
        font-size: 14px;
    }

    .doctorCard .tg-themeinputbtn {
        padding-left: 22px;
        background: transparent !important;
    }

    .page-header .breadcrumb li:first-child:before {
        display: none;
    }

    .flags-select {
        width: 265px;
    }

    .second-sidebar {
        top: 185px !important;
    }

    .badge-lg, .tg-namelogo {
        margin: 0 5px;
        width: 46px;
        height: 46px;
        font-size: 18px;
        line-height: 2.5;
    }

    /*.tg-namelogo{line-height: 2.4}*/

    .nav-tabs {
        border-bottom: 0px;
    }

    .nav-tabs a.tg-detailsicon {
        background: #6c757b !important;
        color: #fff !important;
        margin-right: 10px;
    }

    a#show_hidden:hover, a#show_hidden:focus {
        background: #555 !important;
    }

    .nav-tabs a.tg-detailsicon .tg-notificationtag {
        background: #6c757b;
        border-color: #6c757b;
        line-height: 26px;
        font-size: 14px;
        width: 30px;
        height: 30px;
        top: -20px;
        right: -10px;
    }

    .sec_title, .sec_title a {
        font-size: 20px !important;
        font-weight: 500;
        color: #1f1f1f;
    }
    .sec_title{
        background: #fff;
        background: #fff;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 0;
        border-bottom: 1px solid #ddd;
    }
    .sec_title a{float: right;}

    .checv_up_down {
        margin-left: 20px;
    }

    .delete_add_specimen a.tg-detailsicon {
        float: right;
        margin: 0 3px;
    }

    .show {
        display: block !important;
    }

    .tg-nameandtrackimg {
        position: absolute;
        top: 0;
        right: 15px;
    }

    .carousel-inner {
        width: 100%;
        max-width: 90%;
        margin: 30px auto;
        padding: 30px 35px 10px;
    }

    .carousel-control-prev, .carousel-control-next {
        width: 50px;
        opacity: 1;
    }

    .carousel-control-prev .fa, .carousel-control-next .fa {
        border: 1px solid #fff;
        font-size: 18px;
        border-radius: 20px;
        padding: 10px 12px;
        color: #222;

    }
    .chat-left .chat-body{margin-left:0px;}
    .chat-avatar .avatar.chat_image {
        width: 50px;
        height: auto;
        /*border:1px solid #eaeaea;*/
        padding: 5px;
        background: transparent;
        /*border-radius: 15px;*/
    }
    .chat-avatar .avatar.chat_image img{
        border-radius: 50%;
    }
    .chat-left .chat-time{display: inline-block;margin-left: 30px;}
    .nothing {
        background: none;
        box-shadow: none;
        padding: 0px;
        border-radius: 0px;
        border: 0px;
    }

    .breadcrumb {
        padding: 0 !important
    }

    .microscopy-form-container {
        border: 1px solid rgba(230, 230, 230, 1);
        margin-top: 30px;
        width: 100%;
    }

    #macroscopic-description-container {
        height: 320px;
        width: 100%;
    }

    #specimen_macroscopic_description {
        height: 90%;
    }



    @media screen and (min-width: 1600px) {
        body {
            font-size: 14px;
        }

        .tg-searchrecordoptionvtwo li a {
            min-width: 46px;
            height: 46px;
            width: auto;
        }

    }
    
    

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
        color: #fff;
        display: block;
        padding: 0 20px;
        font-size: 15px;
        border-radius: 50px;
        background: #007899 !important;
        line-height: inherit;
    }
    .tg-themenavtabs li  a{background: #888}
    .tg-themenavtabs li.active a,.tg-themenavtabs li.active a:hover, .tg-themenavtabs li a:focus, .tg-themenavtabs li a:hover{background: #00c5fb !important;}
    /*.tg-themenavtabs li.active a:hover{background: #007899;}*/

    .nav-tabs > li > a {
        color: #fff;
        display: block;
        padding: 0 20px;
        font-size: 15px;
        border-radius: 50px;
        background: #00c5fb;
        line-height: inherit;
        margin: 10px;
    }

    /*.nav-tabs > li > a:hover {
        background: #007899 !important;
    }*/

    /*.nav-tabs > li > a.active {
        background: #007899 !important;
    }*/
    .tg-themedetailsicon li + li {
        border-left: 1px solid #fff;
    }
</style>
<style type="text/css">
    [class^="ti-"],
    [class*=" ti-"] {
        line-height: inherit;
    }

    #slide-carousel {
        margin-top: 10px;
        margin-bottom: 10px;
        display: none;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black !important;
    }

    .table-view-container {
        background-color: rgb(250, 250, 250);
        width: 100%;
        height: 68px;
        padding: 10px;
        border: 1px solid rgb(180, 180, 180);
    }

    .table-view-heading {
        margin-bottom: 1px;
        font-size: 1.65rem;
        color: #222;
        font-weight: 300;
    }

    #table-view-patient .row .col-sm-3, #table-view-request .row .col-sm-3,
    #table-view-test .row .col-sm-3 {
        margin: 0;
        padding: 0;
    }

    #table-view-patient, #table-view-request {
        margin: 10px 10px 10px 20px;
    }

    #table-view-patient fieldset, #table-view-request fieldset {
        margin-bottom: 20px;
    }

    .form_input_container {
        height: 43px;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 0 15px;
    }

    .form_input {
        display: inline-block;
        width: 82%;
        border: none !important;
        margin-top: -17px !important;
        background-color: transparent !important;
    }

    #edit-view-patient .form-group {
        height: 80px;
    }

    #edit-view-request .form-group {
        height: 80px;
    }


    .radial_btn_container {
        width: 15%;
        margin: 0;
        height: 25px;
        margin-top: 7px;
        display: inline-block;
    }

    .table_view_svg {
        margin-top: 8px;
        margin-left: 8px;
    }

    .pDs {
        padding: 5px;
        font-weight: bold;
        font-size: 1.2em;
        border-bottom: 1px solid gainsboro;
        margin-right: 10px;
    }

    .cDs {
        padding: 5px;
        margin-left: 25px;
    }
    .border-bottom-0{border-bottom: 0px;}
    .border-right-0{border-right: 0px;}

    .tg-tabfieldsettwo .form-group {
    margin: 0;
    padding: 5px;
    width: 25%;
    float: left;
}
.tg-formgrouphold {
    float: left;
    width: 100%;
}
.specimen_snomed_options {
    width: 25%;
    float: left;
}
.tg-disabled-form-group textarea{
background:#f7f7f7 !important
}
.form-group.form-group-tiny .tg-tinymceeditor {
    height: 180px;
}
.tox-edit-area iframe body:before{
    font-size: 16px!important;
    font-weight: 300!important; 
}
.sec_title, .sec_title a {
    font-size: 18px !important;
    font-weight: 400;
    color: #1f1f1f;
}
body{
    font: 300 14px/24px 'CircularStd', sans-serif !important;
    font-weight: 300 !important;
}
.bg-info, .badge-info {
    background-color: #55ce63ab !important;
}
.mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
    font-size: 16px!important;
    font-weight: 300!important;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: #000;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: #000;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: #000;
}
@media screen and (max-width: 640px) {
        .tg-tabfieldsetfour .form-group{
            width: 100% !important;
        }
        .tg-tabfieldsettwo .form-group{width: 100%}
        .card-body{overflow-x: auto;width: 100%;}
        .tg-themenavtabs{margin: 0;}
        .tg-themenavtabs li a{margin: 5px 0;}
        .tg-themenavtabs li{width: 50%;}
        .tg-inputshold{padding: 5px 15px 70px;}
        table.table.custom-table.info_nndn2 tr td {
            display: block;
            width: 100%;
        }
        .sec_title.p_id a.checv_up_down, .sec_title.p_id2 a.checv_up_down, .sec_title.r_id a.checv_up_down, .sec_title.r_id2 a.checv_up_down, .sec_title.t_id a.checv_up_down {
            top: 20px;
            right: 11px;
        }
        
        .doctor_record_detail_page .tg-tabform .tg-tabfieldset .form-group {
            padding: 0 15px;
        }
        
        .tg-searchrecord{display: none;}
        .tg-modaldialog{width: 90%;}
    }
    .error{color: red;}
	
	.breadcrumb {
    margin-bottom: 0px;
}
.form-group {
    margin-bottom: 0px;
}
.tg-inputicon .form_input{
    top:7px;
    background: transparent!important;
}
.text-set {
    display: none;
}
.sticky .text-set {
    display: block;
}
.container-fluid.tab-full .col-xs-9.col-sm-9.col-md-9.col-lg-9 {
    width: 100%;
}
.sticky .container-fluid.tab-full .col-xs-9.col-sm-9.col-md-9.col-lg-9 {
 width: auto; 
}
.sticky .tg-themedetailsicon li {
    padding: 0 4px;
}
fieldset.tg-tabfieldset .form-group {
    width: 48%!important;
    max-width: 48%;
    margin: 5px 10px;
}
</style>
<?php
if ($request_query[0]->specimen_publish_status == 1) $disableDiv = "style=pointer-events:none;opacity:0.7;";
else $disableDiv = " ";


$disableDiv = " ";
?>
<div class="doctor_record_detail_page">
    <?php
    
    $record_id = $this->uri->segment(3);
    $doc_id = $this->ion_auth->user()->row()->id;

    if (!empty($record_edit_status)) 
	{
        $user_id = $record_edit_status[0]->user_id_for_edit;
        $edit_timestamp = $record_edit_status[0]->user_record_edit_timestamp;
        /* Get First & Last Name */
        $first_name = '';
        $last_name = '';
        $getdatils = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $doc_id));

        $edit_full_name = $getdatils[0]->first_name . '&nbsp;' . $getdatils[0]->last_name;
    }

    if (!empty($request_query)) {
        $userid = $request_query[0]->request_add_user;
        $record_add_timestamp = $request_query[0]->request_add_user_timestamp;
        $first_name = '';
        $last_name = '';
        $getuserdetails = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $userid));

        $add_full_name = $getuserdetails[0]->first_name . '&nbsp;' . $getuserdetails[0]->last_name;
    }

    $micro_codes_data = array();
    if (!empty($micro_codes)) {
        foreach ($micro_codes as $mi_codes) {
            $micro_codes_data[] = $mi_codes;
        }
    }

   if (!empty($user_id) && $edit_timestamp) {
    ?>
    <div class="col-md-12">
            <span class="user_edit_status">Record Last Edited By : <?php echo $edit_full_name; ?>, At :
                <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?>
                <span><a href="javascript:;" data-toggle="modal"
                         data-target="#edit_record_history">View History</a></span>
            </span>
        <?php } ?>
        <?php
        if (!empty($userid) && $record_add_timestamp) {
        ?>
        <span class="user_add_report_status">&nbsp; | &nbsp;&nbsp;&nbsp; Record Added By : <?php echo $add_full_name; ?>, At :
                <?php echo date('d-m-Y h:i:s A', $record_add_timestamp); ?></span>
    </div>
<?php } ?>
<div id="edit_record_history" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?php
                    if (!empty($record_edit_status_full)) {
                        foreach ($record_edit_status_full as $value) {
                            $user_id = $value->user_id_for_edit;
                            $edit_timestamp = $value->user_record_edit_timestamp;
                            $getUDetails = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name", "users", array("id" => $user_id));
                            $full_name = $getUDetails[0]->first_name . '&nbsp;' . $getUDetails[0]->last_name;
                            ?>
                            <div class="well">Record Last Edited By : <?php echo $full_name; ?>, At :
                                <?php echo date('d-m-Y h:i:s A', $edit_timestamp); ?></div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">   
        <div class="cims_area">
            <div class="tabs_area">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active" href="#patient_info" data-toggle="tab">
                            <img src="<?php echo base_url() ?>assets/icons/cims_tab1_w.png" class="img-fluid on_active">
                            <img src="<?php echo base_url() ?>assets/icons/cims_tab1.png" class="img-fluid simple">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#investigation" data-toggle="tab">
                            <img src="<?php echo base_url() ?>assets/icons/cims_tab2_w.png" class="img-fluid on_active">
                            <img src="<?php echo base_url() ?>assets/icons/cims_tab2.png" class="img-fluid simple">
                        </a>
                    </li>
                    <li class="nav-item">
                        <!--<a class="nav-link" href="<?php echo base_url() ?>index.php/dataset/dashboard">-->
                        <!--<a class="nav-link" href="#" data-toggle="modal" data-target="#bcc_ds_modal_full_view">-->
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#datasetLinks">
                            <img src="<?php echo base_url() ?>assets/icons/cims_tab7_w.png" class="img-fluid on_active">
                            <img src="<?php echo base_url() ?>assets/icons/cims_tab7.png" class="img-fluid simple">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php if($this->session->flashdata('error') == true){ ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <strong style="color: red;"><?php echo $this->session->flashdata('message');?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('success') == true){ ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong style="color: green;"><?php echo $this->session->flashdata('message');?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                <?php
                if ($this->session->flashdata('specimen_added') != '') {
                    echo $this->session->flashdata('specimen_added');
                }
                ?>
                <div class="tg-breadcrumbarea tg-searchrecordhold">
                    <div class="clearfix"></div>
                    <div class="col-md-3 style="padding-left: 15px;">
                        <h3 class="page-title">Records </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('/doctor'); ?>">Dashboard</a></li>                            
                            <li class="breadcrumb-item active">Records</li>
                        </ul>
                        <?php //echo !empty($breadcrumbs) ? $breadcrumbs : '';   ?>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="tg-searchrecordslide">
                            <?php get_next_previous_records($unpublish_list, $record_id, true, 'prev'); ?>
                            <?php get_next_previous_records($unpublish_list, $record_id, true, 'next'); ?>
                            <form class="tg-formtheme tg-searchrecord hidden" >
                                <fieldset>
                                    <div class="form-group tg-inputicon">
                                        <input type="text" class="form-control typeahead" placeholder="Search Record">
                                        <i class="lnr lnr-magnifier"></i>
                                    </div>
                                </fieldset>
                            </form>
                       </div>
                    </div>
                    
                    <div class="col-md-3 text-right tg-rightarea tg-rightsearchrecord">
                        
                        <figure class="tg-logobar pull-right hidden">
                            <?php if (!empty($request_query)) { ?>
                                <span class="tg-namelogo" data-toggle="tooltip" data-placement="top"
                                      title="<?php echo $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->description; ?>"><?php echo $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->first_initial . $this->ion_auth->group($request_query[0]->hospital_group_id)->row()->last_initial; ?></span>
                            <?php } ?>
                        </figure>
                        <ul class="tg-searchrecordoption pull-right tg-searchrecordoptionvtwo hidden-md hidden-sm hidden-xs">
                            <li>
                                <a class="custom_badge_tat">
                                    <?php
                                    $now = time();
                                    $date_taken = !empty($request_query[0]->date_taken) ? $request_query[0]->date_taken : '';
                                    $request_date = !empty($request_query[0]->request_datetime) ? $request_query[0]->request_datetime : '';
                                    $tat_date = '';

                                    $tat_settings = uralensis_get_tat_date_settings($request_query[0]->hospital_group_id);
                                    // echo last_query();exit;
                                    // var_dump($tat_settings['ura_tat_date_data']);exit;

                                    if (!empty($tat_settings) && $tat_settings['ura_tat_date_data'] === 'date_sent_touralensis') {
                                        $date_sent_to_uralensis = !empty($request_query[0]->date_sent_touralensis) ? $request_query[0]->date_sent_touralensis : '';
                                        $tat_date = $date_sent_to_uralensis;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'date_rec_by_doctor') {
                                        $data_rec_by_doctor = !empty($request_query[0]->date_rec_by_doctor) ? $request_query[0]->date_rec_by_doctor : '';
                                        $tat_date = $data_rec_by_doctor;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'data_processed_bylab') {
                                        $data_processed_bylab = !empty($request_query[0]->data_processed_bylab) ? $request_query[0]->data_processed_bylab : '';
                                        $tat_date = $data_processed_bylab;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'date_received_bylab') {
                                        $date_received_bylab = !empty($request_query[0]->date_received_bylab) ? $request_query[0]->date_received_bylab : '';
                                        $tat_date = $date_received_bylab;
                                    } elseif ($tat_settings['ura_tat_date_data'] === 'publish_datetime') {
                                        $publish_datetime = !empty($request_query[0]->publish_datetime) ? $request_query[0]->publish_datetime : '';
                                        $tat_date = $publish_datetime;
                                    } else {
                                        if (!empty($date_taken)) {
                                            $tat_date = $date_taken;
                                        } else {
                                            $category = $request_date;
                                        }
                                    }


                                    if (!empty($tat_settings) && empty($tat_date)) {
                                        $record_old_count = 'NR';
                                    } elseif (!empty($tat_settings) && !empty($tat_date)) {
                                        $compare_date = strtotime("$tat_date");
                                        $datediff = $now - $compare_date;
                                        $record_old_count = floor($datediff / (60 * 60 * 24));
                                    } else {
                                        $compare_date = strtotime("$tat_date");
                                        $datediff = $now - $compare_date;
                                        $record_old_count = floor($datediff / (60 * 60 * 24));
                                    }

                                    $compare_date = strtotime($request_query[0]->stDate);
                                    $collectionDates = !empty($request_query[0]->collection_date_custom) ? $request_query[0]->collection_date_custom : '';
                                    if($collectionDates != ''){
                                        $compare_date = strtotime("$collectionDates");
                                    }
                                    $datediff = $now - $compare_date;
                                    $record_old_count = floor($datediff / (60 * 60 * 24));

                                    $badge = '';
                                    if ($record_old_count <= 10) {
                                        $badge = 'bg-success';
                                    } elseif ($record_old_count > 10 && $record_old_count <= 20) {
                                        $badge = 'bg-warning';
                                    } else {
                                        $badge = 'bg-danger';
                                    }
                                    ?>
                                    <span class="badge <?php echo $badge; ?>">
                                        <?php echo $record_old_count; ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        
                        <div class="tg-flagcolor tg-flagcolortopbar pull-right hidden-md hidden-sm hidden-xs">
                            <div class="tg-checkboxgroup">
                                <ul class="list-unstyled">
                                    <li class="hover_it">
                                        <span class="tg-radio tg-flagcolor1">
                                            <?php
                                            $checked = '';
                                            if ($request_query[0]->flag_status === 'flag_blue') {
                                                $checked = 'checked';
                                            }
                                            ?>
                                            <input <?php echo $checked; ?> data-flag="flag_blue"
                                                                           data-serial="<?php echo $request_query[0]->serial_number; ?>"
                                                                           data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"
                                                                           class="detail_flag_change" type="radio"
                                                                           id="flag_blue" name="flag_sorting">
                                            <label for="flag_blue" data-toggle="tooltip" data-placement="top"
                                                   title="This case marked for ready to authorize."
                                                   class="custom-tooltip"></label>
                                        </span>


                                        <ul class="list-unstyled hover_cont">
                                            <li class="">
                                                <span class="tg-radio tg-flagcolor2">
                                                    <?php
                                                    $checked = '';
                                                    if ($request_query[0]->flag_status === 'flag_green') {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <input <?php echo $checked; ?> data-flag="flag_green"
                                                                                   data-serial="<?php echo $request_query[0]->serial_number; ?>"
                                                                                   data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"
                                                                                   class="detail_flag_change"
                                                                                   type="radio" id="flag_green"
                                                                                   name="flag_sorting">
                                                    <label for="flag_green" data-toggle="tooltip" data-placement="top"
                                                           title="This case marked as new case."
                                                           class="custom-tooltip"></label>
                                                </span>
                                            </li>
                                            <li class="">
                                                <span class="tg-radio tg-flagcolor3">
                                                    <?php
                                                    $checked = '';
                                                    if ($request_query[0]->flag_status === 'flag_yellow') {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <input <?php echo $checked; ?> data-flag="flag_yellow"
                                                                                   data-serial="<?php echo $request_query[0]->serial_number; ?>"
                                                                                   data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"
                                                                                   class="detail_flag_change"
                                                                                   type="radio" id="flag_yellow"
                                                                                   name="flag_sorting">
                                                    <label for="flag_yellow" data-toggle="tooltip" data-placement="top"
                                                           title="This case marked for review."
                                                           class="custom-tooltip"></label>
                                                </span>
                                            </li>
                                            <li class="">
                                                <span class="tg-radio tg-flagcolor4">
                                                    <?php
                                                    $checked = '';
                                                    if ($request_query[0]->flag_status === 'flag_black') {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <input <?php echo $checked; ?> type="radio" data-flag="flag_black"
                                                                                   data-serial="<?php echo $request_query[0]->serial_number; ?>"
                                                                                   data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"
                                                                                   class="detail_flag_change"
                                                                                   id="flag_black" name="flag_sorting">
                                                    <label for="flag_black" data-toggle="tooltip" data-placement="top"
                                                           title="This case marked as complete."
                                                           class="custom-tooltip"></label>
                                                </span>
                                            </li>
                                            <li class="">
                                                <span class="tg-radio tg-flagcolor5">
                                                    <?php
                                                    $checked = '';
                                                    if ($request_query[0]->flag_status === 'flag_red') {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <input <?php echo $checked; ?> data-flag="flag_red"
                                                                                   data-serial="<?php echo $request_query[0]->serial_number; ?>"
                                                                                   data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"
                                                                                   class="detail_flag_change"
                                                                                   type="radio" id="flag_red"
                                                                                   name="flag_sorting">
                                                    <label for="flag_red" data-toggle="tooltip" data-placement="top"
                                                           title="This case marked as urgent."
                                                           class="custom-tooltip"></label>
                                                </span>
                                            </li>
                                        </ul>

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
        <div class="container-fluid tab-full">
            <!-- <div class="col-md-12 nopadding-right">
                <table class="table custom-table">
                    <tr style="box-shadow:0px 0px 0px 0px !important; border: 1px solid #ddd;">
                        <td>
                            <span class="tg-namelogo"><?php echo uralensis_get_user_data($request_query[0]->uralensis_request_id, 'initial'); ?></span>
                            <span style="display:inline-block; margin-top: 12px;"><?php echo uralensis_get_user_data($request_query[0]->uralensis_request_id, 'fullname'); ?></span>
                        </td>
                        <td>
                            <span>Age: <?php print @date_diff(date_create($request_query[0]->dob), date_create('today'))->y;?> y <?php print @date_diff(date_create($request_query[0]->dob), date_create('today'))->m;?> m </span>
                        </td>
                        <td><span>NHS No: <?php echo $request_query[0]->nhs_number; ?></span></td>
                        <td>
                            <span>Gender:<?php print $request_query[0]->gender; ?>
                                <?php echo $gender; ?>
                            </span>
                        </td>
                        <td>
                            <span class="edit_icon pull-right make_editable"
                                  style="margin-right: 10px;">
                                <i class="fa fa-pencil"></i>
                            </span>
                            <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-down"></i></a>
                           
                        </td>
                    </tr>
                </table>
            </div> -->
            <div class="row" <?=$disableDiv?>>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group col-md-2 text-right nopadding-right" style="float: right;">
                        <div class="form_input_container" data-key="gender" style="background: white;">
                            <select class="form_input" style="margin-top: 0 !important;" onchange="updateStatus(this)" name="changeStatus" id="changeStatus">
                                <option value="" <?php echo ($request_query[0]->request_code_status == "") ? "selected":""; ?>>--Select Status--</option>
                                <option value="Lab Entry" <?php echo ($request_query[0]->request_code_status == "Lab Entry") ? "selected":""; ?>>Lab Entry</option>
                                <option value="Specimen Labelling" <?php echo ($request_query[0]->request_code_status == "Specimen Labelling") ? "selected":""; ?>>Specimen Labelling</option>
                                <option value="Cut up / Grossing" <?php echo ($request_query[0]->request_code_status == "Cut up / Grossing") ? "selected":""; ?>>Cut up / Grossing</option>
                                <option value="Embedding & Microtomy" <?php echo ($request_query[0]->request_code_status == "Embedding & Microtomy") ? "selected":""; ?>>Embedding & Microtomy</option>
                                <option value="Staining" <?php echo ($request_query[0]->request_code_status == "Staining") ? "selected":""; ?>>Staining</option>
                                <option value="Quality Assurance" <?php echo ($request_query[0]->request_code_status == "Quality Assurance") ? "selected":""; ?>>Quality Assurance</option>
                                <option value="Slide Scanner" <?php echo ($request_query[0]->request_code_status == "Slide Scanner") ? "selected":""; ?>>Slide Scanner</option>
                                <option value="Reporting" <?php echo ($request_query[0]->request_code_status == "Reporting") ? "selected":""; ?>>Reporting</option>
                                <option value="Admin Support" <?php echo ($request_query[0]->request_code_status == "Admin Support") ? "selected":""; ?>>Admin Support</option>
                                <option value="Further Work" <?php echo ($request_query[0]->request_code_status == "Further Work") ? "selected":""; ?>>Further Work</option>
                            </select>
                        </div>
                    </div>
                    <?php if($request_query[0]->specimen_publish_status == 1) {?>
                    <div class="form-group col-md-9 text-right nopadding-right">
                        <button class="btn btn-primary btn-sm" onclick="GenerateReport()" style="height: 43px;font-size: 14px;border : 1px solid #ddd;border-radius : 10px">Approve changes</button>
                    </div>
                    <?php } ?>
                    <div class="col-md-<?php echo ($request_query[0]->specimen_publish_status == 1) ? "1" : "10" ?> text-right nopadding-right">
                        <button class="btn btn-collapse btn-sm btn_collapse_all nopadding" title="Collapse All">
                            <!-- <i class="la la-compress-arrows-alt"></i> -->
                            <!-- <i class="las la-expand-arrows-alt"></i> -->
                            <img src="<?php echo base_url();?>assets/icons/collapse_all.jpg" class="img-fluid hidden show" style="width: 40px;">
                            <img src="<?php echo base_url();?>assets/icons/minimize_all.jpg" class="img-fluid hidden" style="width: 40px;">
                        </button>
                    </div>
                    
                    <?php
                    if ($this->session->flashdata('update_report_message') != '') {
                        echo $this->session->flashdata('update_report_message');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('update_specimen_message') != '') {
                        echo $this->session->flashdata('update_specimen_message');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('final_report_message') != '') {
                        echo $this->session->flashdata('final_report_message');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('message_additional') != '') {
                        ?>
                        <p class="bg-success" style="padding:7px;">
                            <?php echo $this->session->flashdata('message_additional'); ?></p>
                    <?php } ?>
                    <?php
                    if ($this->session->flashdata('message_further') != '') {
                        echo $this->session->flashdata('message_further');
                    }
                    if ($this->session->flashdata('message_email_send') != '') {
                        echo $this->session->flashdata('message_email_send');
                    }
                    if ($this->session->flashdata('message_email_not_sent') != '') {
                        echo $this->session->flashdata('message_email_not_sent');
                    }
                    ?>

                    <form class="tg-formtheme" id="doctor_update_personal_record" method="post" <?=$disableDiv?>>
                        <div class="col-md-12 form-group" style="padding-right: 0;">
                            <div class="sec_title p_id form-group">



                               <!--  <span id="p_id_title">
                                    Patient ID 
                                    <span class="edit_icon pull-right make_editable hidden" id="p_edit_area" style="margin-right: 40px">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <span id="p_save_area" class="btn btn-info btn-sm pull-right btn_save_sec hidden"
                                          style="margin-right: 10px; border-radius: 4px;">
                                        <i class="fa fa-save"></i>
                                    </span>
                                    <span class="btn btn-success-outline btn-sm pull-right updated_btn hidden"
                                          style="margin-right: 10px; border-radius: 4px;">
                                        Updated
                                    </span>
                                </span> -->
                                <?php
                               $p_result=get_table_data("patients","id=".$request_query[0]->patient_id);
							   //print "<pre>";
							   //print_r($p_result);
							   //print "</pre>";	
							  // echo $p_result->nhs_number;						   
								?>
                                <table class="custom-table info_nndn2" style="margin-bottom: 0; width:98%">
                                    <tr style="box-shadow:0px 0px 0px 0px !important;">
                                        <td style="width:40%">
                                            <span  style="font-weight: 500" class="tg-namelogo"><?php echo uralensis_get_user_data($request_query[0]->uralensis_request_id, 'initial'); ?></span>
                                            <span  style="font-weight: 500; display:inline-block; margin-top: 12px;"><?php echo $p_result[0]->first_name; ?> <?php print $p_result[0]->last_name; ?></span>
                       
                                        </td>
                                       
                                        <td  style="width:20%">
                                            <span style="font-weight: 500">Age/Gender: <?php print @date_diff(date_create($request_query[0]->dob), date_create('today'))->y;?> / <?php print $p_result[0]->gender; ?></span>
                                        </td>
                                        <td  style="width:20%"><span style="font-weight: 500">DOB: <?php print $request_query[0]->dob;?> </span></td>
                                       <td style="width:20%">
                                            <span style="font-weight: 500">City: <?php print $p_result[0]->city;?>                                                
                                            </span>
                                        </td>
                                        <!--<td>
                                            <span style="font-weight: 500">Postcode: <?php print $p_result[0]->post_code;?></span>
                                        </td>-->
                                        
                                       <!-- <td>
                                            <span class="pull-right edit_icon make_editable r_id_icon p_id_icon" style="margin-right: 25px;">
                                                <i class="fa fa-pencil"></i> </span> 
                                        </td>
                                        
                                         
                                        <td>
                                                                                      
                                        </td>
                                        
                                        <td class="text-right">
                                            <span style="font-weight: 500" class="pull-right edit_icon  new_edit">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <span class="btn btn-info btn-sm pull-right btn_save_sec hidden" id="save_patient" style="margin-right:10px; border-radius:4px;">
                                                <i class="fa fa-save"></i>
                                            </span>
                                            <span class="btn btn-success-outline btn-sm pull-right updated_btn hidden"
                                                  style="margin-right: 10px; border-radius: 4px;">
                                                Updated
                                            </span>
                                        </td> -->
                                    </tr>
                                </table>


                            
                                <a href="javascript:;" class="checv_up_down"><i class="las la-eye" style="font-size: 27px;"></i></a>

                            </div>
                            <div class="show_save card hidden show">
                                <div class="card-body form-group">
                                    <?php
                                    $json = array();
                                    if (!empty($request_query) && is_array($request_query)) 
									{
                                        foreach($request_query as $row) 
                                        {
                                            //print_r($row);
                                            $record_edit_serial = $row->record_edit_status;
                                            $redit_status = unserialize($record_edit_serial);
                                            
                                            
                                        foreach ($patient_query as $row2) 
                                        {
                                            $row2->city;
                                            $row2->hospital_id;
                                            $row2->address_1;
                                            $row2->post_code;
                                            $row2->id;
                                        }
                                            
                                            ?>
                                <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $row2->id?>" />
                                            <div id="table-view-patient" style="display:none;">

                                                <div class="row">
                                                    <div class="form-group col-sm-3" style="display:none">
                                                        <span
                                                                class="tg-namelogo"><?php echo uralensis_get_user_data($row->uralensis_request_id, 'initial'); ?></span>
                                                        <div class="tg-nameandtrack">
                                                            <h3><?php echo $p_result[0]->first_name; ?> <?php print $p_result[0]->owner_name; ?></h3>
                                                            <span><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number'); ?>
                                                                <em>|</em>
                                                                <em><?php //echo uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no'); ?></em>
                                                            </span>
                                                        </div>
                                                        <?php
                                                        $initial = uralensis_get_user_data($row->uralensis_request_id, 'initial');
                                                        //$p_city = uralensis_get_patient_data($row->uralensis_request_id);
                                                        //print_r($p_city);
                                                        //$p_address_1 = uralensis_get_patient_data($row->uralensis_request_id, 'address_1');
                                                        //$p_post_code = uralensis_get_patient_data($row->uralensis_request_id, 'post_code');
                                                        $fullname = uralensis_get_user_data($row->uralensis_request_id, 'fullname');
                                                        $serial_number = uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number');
                                                        $ura_barcode_no = uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no');
                                                        $request_type = uralensis_get_record_db_detail($row->uralensis_request_id, 'request_type');
                                                        $ura_dob = date('d-m-Y', strtotime($request_query[0]->dob));
                                                        $ura_nhs = $request_query[0]->nhs_number;
                                                        $ura_gender = $gender;
                                                        ?>
                                                        <figure class="tg-nameandtrackimg">
                                                            <span> <?php //echo uralensis_get_user_data($row->uralensis_request_id, 'gender'); ?></span>
                                                            <span><?php //echo uralensis_get_user_data($row->uralensis_request_id, 'age'); ?></span>
                                                        </figure>
                                                    </div>
                                                    <div class="col-md-6 nopadding">
                                                        <div class="col-sm-6 nopadding">
                                                            <div class="table-view-container">
                                                                <?php
                                                                $color_status = 'orange';
                                                                if (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '1') {
                                                                    $color_status = 'green';
                                                                } elseif (!empty($redit_status['patient_initial']) && $redit_status['patient_initial'] == '2') {
                                                                    $color_status = 'blue';
                                                                }
                                                                ?>
                                                                <div class="row" data-key="patient_initial">
                                                                    <div class="table_view_svg col-xs-2 change_status_color"
                                                                         style="margin-left: 0">

                                                                        <svg class="svg_patient_initial" width="26"
                                                                             height="26">
                                                                            <circle cx="13" cy="13" r="12"
                                                                                    stroke="<?php echo $color_status; ?>"
                                                                                    fill-opacity="0" stroke-width="1"/>
                                                                            <circle cx="13" cy="13" r="7"
                                                                                    stroke="<?php echo $color_status; ?>"
                                                                                    fill="<?php echo $color_status; ?>"
                                                                                    stroke-width="2"/>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="col-xs-9 ">
                                                                        <div class="table-view-heading">First Name</div>
                                                                        <div class="hide" id="ptnt_id"><?php print $p_result[0]->id; ?></div>
                                                                        <div class="table-view-content" id="pt_first_name"><?php print $p_result[0]->first_name; ?></div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-6 nopadding">
                                                            <div class="table-view-container">
                                                                <?php
                                                                $color_status = 'orange';
                                                                if (!empty($redit_status['gender']) && $redit_status['gender'] == '1') {
                                                                    $color_status = 'green';
                                                                } elseif (!empty($redit_status['gender']) && $redit_status['gender'] == '2') {
                                                                    $color_status = 'blue';
                                                                }
                                                                ?>
                                                                <div class="row" data-key="gender">
                                                                    <div class="table_view_svg col-xs-2 change_status_color"
                                                                         style="margin-left: 0">

                                                                        <svg class="svg_gender" width="26" height="26">
                                                                            <circle cx="13" cy="13" r="12"
                                                                                    stroke="<?php echo $color_status; ?>"
                                                                                    fill-opacity="0" stroke-width="1"/>
                                                                            <circle cx="13" cy="13" r="7"
                                                                                    stroke="<?php echo $color_status; ?>"
                                                                                    fill="<?php echo $color_status; ?>"
                                                                                    stroke-width="2"/>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="col-xs-9 ">
                                                                    <div class="table-view-heading">Last Name</div>
                                                                    <div class="table-view-content" id="pt_last_name"><?php print $p_result[0]->last_name; ?></div>
                                                                </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="table-view-container">
                                                            <?php
                                                            $color_status = 'orange';
                                                            if (!empty($redit_status['f_name']) && $redit_status['f_name'] == '1') {
                                                                $color_status = 'green';
                                                            } elseif (!empty($redit_status['f_name']) && $redit_status['f_name'] == '2') {
                                                                $color_status = 'blue';
                                                            }
                                                            ?>
                                                            <div class="row" data-key="f_name">
                                                                <div class="table_view_svg col-xs-2 change_status_color">

                                                                    <svg class="svg_f_name" width="26" height="26">
                                                                        <circle cx="13" cy="13" r="12"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill-opacity="0" stroke-width="1"/>
                                                                        <circle cx="13" cy="13" r="7"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill="<?php echo $color_status; ?>"
                                                                                stroke-width="2"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="col-xs-9 ">
                                                                        <div class="table-view-heading">Sex</div>
                                                                        <div class="table-view-content"><?php echo $row->gender; ?></div>
                                                                    </div>
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="table-view-container">
                                                            <?php
                                                            $color_status = 'orange';
                                                            if (!empty($redit_status['dob']) && $redit_status['dob'] == '1') {
                                                                $color_status = 'green';
                                                            } elseif (!empty($redit_status['dob']) && $redit_status['dob'] == '2') {
                                                                $color_status = 'blue';
                                                            }
                                                            ?>
                                                            <div class="row" data-key="dob">
                                                                <div class="table_view_svg col-xs-2 change_status_color">

                                                                    <svg class="svg_dob" width="26" height="26">
                                                                        <circle cx="13" cy="13" r="12"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill-opacity="0" stroke-width="1"/>
                                                                        <circle cx="13" cy="13" r="7"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill="<?php echo $color_status; ?>"
                                                                                stroke-width="2"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="col-xs-9 ">
                                                                    <div class="table-view-heading">DOB</div>
                                                                    <div class="table-view-content"><?php echo !empty($row->dob) ? date('d-m-Y', strtotime($row->dob)) : ''; ?></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="table-view-container">
                                                            <?php
                                                            $color_status = 'orange';
                                                            if (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '1') {
                                                                $color_status = 'green';
                                                            } elseif (!empty($redit_status['nhs_number']) && $redit_status['nhs_number'] == '2') {
                                                                $color_status = 'blue';
                                                            }
                                                            ?>
                                                            <div class="row" data-key="nhs_number">
                                                                <div class="table_view_svg col-xs-2 change_status_color">

                                                                    <svg class="svg_nhs_number" width="26" height="26">
                                                                        <circle cx="13" cy="13" r="12"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill-opacity="0" stroke-width="1"/>
                                                                        <circle cx="13" cy="13" r="7"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill="<?php echo $color_status; ?>"
                                                                                stroke-width="2"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="col-xs-9 ">
                                                                    <div class="table-view-heading">NHS No.</div>
                                                                    <div class="table-view-content"><?php print $p_result[0]->nhs_number; ?></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                   
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="table-view-container">
                                                            <?php
                                                            $color_status = 'orange';
                                                            ?>
                                                            <div class="row">
                                                                <div class="table_view_svg col-xs-2">

                                                                    <svg width="26" height="26">
                                                                        <circle cx="13" cy="13" r="12"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill-opacity="0" stroke-width="1"/>
                                                                        <circle cx="13" cy="13" r="7"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill="<?php echo $color_status; ?>"
                                                                                stroke-width="2"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="col-xs-9 ">
                                                                    <div class="table-view-heading">Email
                                                                    </div>
                                                                    <div class="table-view-content"><?php print $p_result[0]->email; ?></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 nopadding">
                                                        <div class="table-view-container">
                                                            <?php
                                                            $color_status = 'orange';
                                                            ?>
                                                            <div class="row">
                                                                <div class="table_view_svg col-sm-1">

                                                                    <svg width="26" height="26">
                                                                        <circle cx="13" cy="13" r="12"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill-opacity="0" stroke-width="1"/>
                                                                        <circle cx="13" cy="13" r="7"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill="<?php echo $color_status; ?>"
                                                                                stroke-width="2"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="col-xs-9 ">
                                                                    <div class="table-view-heading">Address</div>
                                                                    <div class="table-view-content"><?php print $p_result[0]->address_1; ?></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    
                                                        <div class="col-sm-3 nopadding">
                                                        <div class="table-view-container">
                                                            <?php
                                                            $color_status = 'orange';
                                                            ?>
                                                            <div class="row">
                                                                <div class="table_view_svg col-xs-2">

                                                                    <svg width="26" height="26">
                                                                        <circle cx="13" cy="13" r="12"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill-opacity="0" stroke-width="1"/>
                                                                        <circle cx="13" cy="13" r="7"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill="<?php echo $color_status; ?>"
                                                                                stroke-width="2"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="col-xs-9 ">
                                                                    <div class="table-view-heading">City</div>
                                                                    <div class="table-view-content"><?php print $p_result[0]->city; ?></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 nopadding">
                                                        <div class="table-view-container">
                                                            <?php
                                                            $color_status = 'orange';
                                                            ?>
                                                            <div class="row">
                                                                <div class="table_view_svg col-xs-2">

                                                                    <svg width="26" height="26">
                                                                        <circle cx="13" cy="13" r="12"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill-opacity="0" stroke-width="1"/>
                                                                        <circle cx="13" cy="13" r="7"
                                                                                stroke="<?php echo $color_status; ?>"
                                                                                fill="<?php echo $color_status; ?>"
                                                                                stroke-width="2"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="col-xs-9 ">
                                                                    <div class="table-view-heading">Postcode</div>
                                                                    <div class="table-view-content"><?php print $p_result[0]->post_code; ?></div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                            <div id="edit-view-patient" >


                                                <fieldset>

                                                    <div class="form-group col-md-3" style="display:none">
                                                        <span
                                                                class="tg-namelogo"><?php echo uralensis_get_user_data($row->uralensis_request_id, 'initial'); ?></span>
                                                        <div class="tg-nameandtrack">
                                                            <h3><?php echo $p_result[0]->first_name; ?> <?php print $p_result[0]->owner_name; ?>
                                                            </h3>
                                                            <span><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number'); ?>
                                                                <em>|</em>
                                                                <em><?php echo uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no'); ?></em>
                                                            </span>
                                                        </div>

                                                        <?php
                                                        $initial = uralensis_get_user_data($row->uralensis_request_id, 'initial');
                                                        $fullname = uralensis_get_user_data($row->uralensis_request_id, 'fullname');
                                                        $serial_number = uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number');
                                                        $ura_barcode_no = uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no');
                                                        ?>
                                                        <figure class="tg-nameandtrackimg">
                                                            <span><?php //echo uralensis_get_user_data($row->uralensis_request_id, 'gender'); ?></span>
                                                            <span><?php //echo uralensis_get_user_data($row->uralensis_request_id, 'age'); ?></span>
                                                        </figure>
                                                    </div>
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['first_name']) && $redit_status['first_name'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['first_name']) && $redit_status['first_name'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>

                                                    <div class="form-group col-md-3">
                                                        <label for="first_name">First Name </label>
                                                        <div class="form_input_container" data-key="f_name">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_f_name" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="tg-formtheme">
                                                                <fieldset>
                                                                    <div class="tg-inputicon">
                                                                        <input type="text" name="f_name" class="typeahead form_input fname patient_fname" placeholder="First Name" value="<?= $row->f_name; ?>" onblur="save_case_request(this.name)">
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <?php $json['f_name'] = $row->f_name; ?>
                                                    </div>
                                                    <!--<div class="form-group col-md-3">
                                                        <label for="first_name">First Name </label>
                                                        <div class="form_input_container" data-key="f_name">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_f_name" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php /*echo $color_status; */?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php /*echo $color_status; */?>"
                                                                            fill="<?php /*echo $color_status; */?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                    <input id="first_name" onblur="save_case_request(this.name)" type="text" name="f_name" class="form_input fname" placeholder="First Name" value="<?php /*echo $row->f_name; */?>">
                                                        </div>
                                                        <?php /*$json['f_name'] = $row->f_name; */?>
                                                    </div>-->

                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['sur_name']) && $redit_status['sur_name'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>

                                                    <div class="form-group col-md-3">
                                                        <label for="sur_name">Last Name</label>
                                                        <div class="form_input_container" data-key="sur_name">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_sur_name" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="tg-formtheme">
                                                                <fieldset>
                                                                    <div class="tg-inputicon">
                                                                        <input id="sur_name" type="text" name="sur_name" class="typeahead form_input fname patient_lname" placeholder="Last Name" value="<?= $row->sur_name; ?>" onblur="save_case_request(this.id)">
                                                                    </div>
                                                                </fieldset>
                                                            </div>
<!--                                                            <input id="sur_name" type="text" onblur="save_case_request(this.id)" name="sur_name" class="form_input" placeholder="Surname" value="--><?php //print $p_result[0]->last_name; ?><!--">-->
                                                        </div>
                                                        <!-- <label></label> -->
                                                        <?php $json['sur_name'] = $row->sur_name; ?>
                                                    </div>
                                                    
                                                    

                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['gender']) && $redit_status['gender'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['gender']) && $redit_status['gender'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>

                                                    <div class="form-group col-md-3">
                                                        <label for="gender">Gender - CR0080</label>
                                                        <div class="form_input_container" data-key="gender">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_gender" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                            <select class="form_input" onchange="save_case_request(this.id)" name="gender" id="gender">
                                                                <?php
                                                                $gender_array = array(
                                                                    'Male' => 'Male',
                                                                    'Female' => 'Female',																	
                                                                    'Other' => 'Other'
                                                                );

                                                                foreach ($gender_array as $key => $gender) {
                                                                    $selected = '';
                                                                    if ($key == $row->gender) {

                                                                        $selected = 'selected';
                                                                    }
                                                                    ?>
                                                                    <option <?php echo $selected; ?>
                                                                            value="<?php echo $key; ?>"><?php echo $gender; ?></option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>
                                                        <label></label>
                                                        <?php $json['gender'] = $row->gender; ?>
                                                    </div>

                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['dob']) && $redit_status['dob'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['dob']) && $redit_status['dob'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>

                                                    <div class="form-group col-md-3">
                                                        <label for="dob">DOB -CR0100</label>
                                                        <div class="form_input_container" data-key="dob">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_dob" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                            <input type="text" onblur="save_case_request(this.id)" name="dob" id="dob" class="form_input"
                                                                   placeholder="Date of Birth"
                                                                   value="<?php echo !empty($row->dob) ? date('d-m-Y', strtotime($row->dob)) : ''; ?>"/>
                                                        </div>
                                                        <?php $json['dob'] = date('d-m-Y', strtotime($row->dob)); ?>
                                                    </div>

                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($p_result[0]->nhs_number)) {
                                                        $color_status = 'green';
                                                    } elseif (!empty($p_result[0]->nhs_number)) {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>

                                                    <div class="form-group col-md-3">
                                                        <label for="nhs_number">NHS No. - CR0010</label>
                                                        <div class="form_input_container" data-key="nhs_number">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_nhs_number" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                        <input type="text" onblur="save_case_request(this.id)" class="form_input" id="nhs_number" name="nhs_number" placeholder="Nhs Number" value="<?php print $p_result[0]->nhs_number; ?>">
                                                        </div>
                                                        <?php $json['nhs_number'] = $p_result[0]->nhs_number; ?>
                                                    </div>


                                                    <?php
                                                        $color_status = 'orange';
                                                        if (!empty($p_result[0]->p_id_1) && $p_result[0]->p_id_1 == '1') {
                                                            $color_status = 'green';
                                                        } elseif (!empty($p_result[0]->p_id_1) && $p_result[0]->p_id_1 == '2') {
                                                            $color_status = 'blue';
                                                        }
                                                    ?>
                                                    <div class="form-group col-md-3">
                                                        <label for="postcode">Patient ID 1</label>
                                                        <div class="form_input_container" data-key="postcode">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_postcode" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12" stroke="<?= $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7" stroke="<?= $color_status; ?>" fill="<?= $color_status; ?>" stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <input type="text" onblur="save_case_request(this.id)" class="form_input" id="p_id_1" name="p_id_1" placeholder="Patient ID 1" value="<?= $p_result[0]->p_id_1; ?>">
                                                        </div>
                                                    </div>

                                                    <?php
                                                        $color_status = 'orange';
                                                        if (!empty($p_result[0]->p_id_2) && $p_result[0]->p_id_2 == '1') {
                                                            $color_status = 'green';
                                                        } elseif (!empty($p_result[0]->p_id_2) && $p_result[0]->p_id_2 == '2') {
                                                            $color_status = 'blue';
                                                        }
                                                    ?>
                                                    <div class="form-group col-md-3">
                                                        <label for="postcode">Patient ID 2</label>
                                                        <div class="form_input_container" data-key="postcode">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_postcode" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12" stroke="<?= $color_status; ?>" fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7" stroke="<?= $color_status; ?>" fill="<?= $color_status; ?>" stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <input type="text" onblur="save_case_request(this.id)" class="form_input" id="p_id_2" name="p_id_2" placeholder="Patient ID 2" value="<?= $p_result[0]->p_id_2; ?>">
                                                        </div>
                                                    </div>
                                                   
                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="form-group col-md-3">
                                                        <label for="patient_usual_address">Address - CR0030</label>
                                                        <div class="form_input_container"
                                                             data-key="patient_usual_address">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_patient_usual_address" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                            <input type="text" onblur="save_case_request(this.id)" class="form_input"
                                                                   id="patient_usual_address"
                                                                   name="patient_usual_address" placeholder="Address"
                                                                   value="<?php echo $p_result[0]->address_1;?>" >
                                                        </div>
                                                    </div>

                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="form-group col-md-3">
                                                        <label for="patient_city">Patient City -
                                                            CR0030</label>
                                                        <div class="form_input_container" data-key="patient_city">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_patient_city" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                            <input type="text" onblur="save_case_request(this.id)" class="form_input" id="patient_city"
                                                                   name="patient_city" placeholder="City" value="<?php echo $p_result[0]->city;?>"
                                                                   >
                                                        </div>
                                                    </div>


                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="form-group col-md-3">
                                                        <label for="postcode">Postcode -
                                                            CR0070</label>
                                                        <div class="form_input_container" data-key="postcode">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_postcode" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                            <input type="text" onblur="save_case_request(this.id)" class="form_input" id="postcode"
                                                                   name="postcode" placeholder="Postcode" value="<?php echo $p_result[0]->post_code;?>">
                                                        </div>
                                                    </div>
                                                    <?php uralensis_get_cost_code_dropdown($row->hospital_group_id, $row); ?>

                                                </fieldset>
                                                <fieldset>

                                                    <?php
                                                    if (!empty($row->cl_detail)) {
                                                        ?>
                                                        <div class="form-group" style="width:100%;">
                                                            <textarea style="height:100px;" class="form-control"
                                                                      required name="cl_detail"
                                                                      id="cl_detail"
                                                                      placeholder="Clinical Detail"><?php echo $row->cl_detail; ?></textarea>
                                                        </div>
                                                    <?php } ?>


                                                </fieldset>

                                            </div>
                                            <?php
											 break;
                                        }//endforeach
                                    }//endif 
                                    ?>
                                    <?php $json_data = json_encode($json); ?>
                                    <input type="hidden" name="json_edit_data" value='<?php echo $json_data; ?>'>
                                    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">

                                </div>
                                <div class="clearfix"></div>
                            </div>


                        </div>

                        <div class="col-md-12 form-group" style="padding-right: 0;">
                            <div class="sec_title r_id form-group">

                                <!-- <span id="request_id_title">
                                    Request ID
                                    <span class="edit_icon pull-right make_editable hidden" style="margin-right: 40px;">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <span class="btn btn-info btn-sm pull-right btn_save_sec hidden" id="save_patient" style="margin-right:10px; border-radius:4px;">
                                        <i class="fa fa-save"></i>
                                    </span>
                                    <span class="btn btn-success-outline btn-sm pull-right updated_btn hidden"
                                          style="margin-right: 10px; border-radius: 4px;">
                                        Updated
                                    </span>
                                </span> -->


<?php
if($row2->hospital_id!='')
{
$hospital_data=get_table_data("groups","id=".$row2->hospital_id);
$hospital_infodata=get_table_data("hospital_information","group_id=".$row2->hospital_id);
}
else
{
$hospital_data=get_table_data("groups","id=0");	
$hospital_infodata=get_table_data("hospital_information","group_id=0");
}





$path_id=get_table_data("request_assignee","request_id=".$row->uralensis_request_id);
$Usersgetdatils = getRecords("AES_DECRYPT(first_name, '" . DATA_KEY . "') AS first_name,AES_DECRYPT(last_name, '" . DATA_KEY . "') AS last_name, profile_picture_path, id", "users", array("id" => $path_id[count($path_id) - 1]->user_id));

$dr_full_name = $Usersgetdatils[0]->first_name . '&nbsp;' . $Usersgetdatils[0]->last_name;


?>

                                <table class="custom-table info_nndn2" style="margin-bottom: 0; width:98%">
                                    <tr style="box-shadow:0px 0px 0px 0px !important;">


                                        <td><span style="font-weight: 500">Lab No: <?php echo $row->lab_number;?></span></td>
                                        <td><span style="font-weight: 500">Pathologist: <span><img src="<?php echo get_profile_picture($Usersgetdatils[0]->profile_picture_path, $Usersgetdatils[0]->first_name, $Usersgetdatils[0]->last_name); ?>" class="img-fluid img-circle" width="40" title="<?php echo $Usersgetdatils[0]->first_name;?> <?php echo $Usersgetdatils[0]->last_name;?>"></span></span></td>
                                        
                                        <td><span style="font-weight: 500">Clinic: <?php echo $hospital_data[0]->description;?>
                                            </span> 
                                        </td>
                                        <td>
                                            <span style="font-weight: 500">Lab: <?php echo getGroupNameById($row->lab_id); ?></span>
                                        </td>
                                        <!--<td>
                                            <span style="font-weight: 500">Specimen: <?php echo $request_type; ?>
                                            </span>
                                        </td>-->
                                        <td class="text-right">
                                          <!--  <span class="pull-right edit_icon make_editable r_id_icon" style="margin-right:25px;">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                             <span class="btn btn-info btn-sm pull-right btn_save_sec hidden" id="save_patient" style="margin-right:10px; border-radius:4px;">
                                                <i class="fa fa-save"></i>
                                            </span>
                                            <span class="btn btn-success-outline btn-sm pull-right updated_btn hidden"
                                                  style="margin-right: 10px; border-radius: 4px;">
                                                Updated
                                            </span> -->
                                        </td>
                                    </tr>
                                </table>

                                <a href="javascript:;" class="checv_up_down"><i class="las la-eye" style="font-size: 27px;"></i></a>


                            </div>

                            <div class="show_save card hidden show" style="margin-bottom: 0px; ">
                                <div class="card-body">

                                    <div id="table-view-request" style="display:none;">

                                        <div class="row">
                                            <div class="col-sm-3 nopadding" style="display:none">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="serial_number">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_serial_number" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">UL No.</div>
                                                            <div class="table-view-content"><?php echo $row->serial_number; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding" style="display:none">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="row">
                                                        <div class="table_view_svg col-xs-2">

                                                            <svg width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Track No.</div>
                                                            <div class="table-view-content"><?php echo $row->ura_barcode_no; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="lab_number">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_lab_number" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Lab No.</div>
                                                            <div class="table-view-content"><?php echo $labNo = $row->lab_number; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="row">
                                                        <div class="table_view_svg col-xs-2">

                                                            <svg width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Digi Number</div>
                                                            <div class="table-view-content" id='digi_number'><?php echo $row->pci_number; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
<div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="date_taken">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_date_taken" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Date Taken</div>
                                                            <?php
                                                            $date_taken = '';
                                                            if (!empty($row->date_taken)) {
                                                                $date_taken = date('d-m-Y', strtotime($row->date_taken));
                                                            }
                                                            ?>
                                                            <div class="table-view-content"><?php echo $date_taken; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
<div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['location']) && $redit_status['location'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['location']) && $redit_status['location'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="location">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_location" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Clinician</div>
                                                            <div class="table-view-content">
                                                                <?php echo uralensisGetUsername($row->dermatological_surgeon, 'fullname'); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="dermatological_surgeon">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_dermatological_surgeon" width="26"
                                                                 height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Clinic</div>
                                                            <div class="table-view-content">
                                                                <?php echo $this->Doctor_model->display_hospitals_list_with_org([$hospital_data[0]->id])[0]->name; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="lab_name">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_lab_name" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Lab Processing</div>
                                                            <div class="table-view-content"><?php echo getGroupNameById($row->lab_id); ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3 nopadding" style="display:none">
                                                <div class="table-view-container">
                                                    <?php $color_status = 'orange'; ?>
                                                    <div class="row">
                                                        <div class="table_view_svg col-xs-2">
                                                            <svg width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Organisation site identifier</div>
                                                            <div class="table-view-content" id="org_site_identifier_text"><?php echo $hospital_infodata[0]->site_identifier;?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding" style="display:none">
                                                <div class="table-view-container">
                                                    <?php $color_status = 'orange'; ?>
                                                    <div class="row">
                                                        <div class="table_view_svg col-xs-2">
                                                            <svg width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Organisation identifier</div>
                                                            <div class="table-view-content" id="org_identifier_text"><?php echo $hospital_infodata[0]->identifier;?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="row">
                                                        <div class="table_view_svg col-xs-2">

                                                            <svg width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Pathologist</div>
                                                            <div class="table-view-content"><?php echo $dr_full_name; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="row">
                                                        <div class="table_view_svg col-xs-2">

                                                            <svg width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Specimen Nature</div>
                                                            <div class="table-view-content"><?php echo $row->specimen_no; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            


                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="date_received_bylab">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_date_received_bylab" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Rec Lab</div>
                                                            <?php
                                                            $date_received_bylab = '';
                                                            if (!empty($row->date_received_bylab)) {
                                                                $date_received_bylab = date('d-m-Y', strtotime($row->date_received_bylab));
                                                            }
                                                            ?>
                                                            <div class="table-view-content"><?php echo $date_received_bylab; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="date_sent_touralensis">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_date_sent_touralensis" width="26"
                                                                 height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Rel Lab</div>
                                                            <?php
                                                            $sent_to_uralensis_date = date('Y-m-d');
                                                            if (!empty($row->date_sent_touralensis)) {
                                                                $sent_to_uralensis_date = date('d-m-Y', strtotime($row->date_sent_touralensis));
                                                            } else {
                                                                if (!empty($bck_frm_lab_date_data)) {
                                                                    $sent_to_uralensis_date = date('d-m-Y', strtotime($bck_frm_lab_date_data));
                                                                }
                                                            }
                                                            ?>
                                                            <div class="table-view-content"><?php echo $sent_to_uralensis_date; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="row">
                                                        <div class="table_view_svg col-xs-2">

                                                            <svg width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Courier No.</div>
                                                            <div class="table-view-content"><?php echo $row->courier_no; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <div class="table-view-container">
                                                    <?php
                                                    $color_status = 'orange';
                                                    if (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '1') {
                                                        $color_status = 'green';
                                                    } elseif (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '2') {
                                                        $color_status = 'blue';
                                                    }
                                                    ?>
                                                    <div class="row" data-key="report_urgency">
                                                        <div class="table_view_svg col-xs-2 change_status_color">

                                                            <svg class="svg_report_urgency" width="26" height="26">
                                                                <circle cx="13" cy="13" r="12"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill-opacity="0" stroke-width="1"/>
                                                                <circle cx="13" cy="13" r="7"
                                                                        stroke="<?php echo $color_status; ?>"
                                                                        fill="<?php echo $color_status; ?>"
                                                                        stroke-width="2"/>
                                                            </svg>
                                                        </div>
                                                        <div class="col-xs-9 ">
                                                            <div class="table-view-heading">Status</div>
                                                            <?php $report_urgency = array(
                                                                'Routine' => 'Routine',
                                                                'Urgent' => 'Urgent',
                                                                '2WW' => '2WW'
                                                            ); ?>
                                                            <div class="table-view-content"><?php echo $report_urgency[$row->report_urgency]; ?></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="edit-view-request" >
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['serial_number']) && $redit_status['serial_number'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3" style="display:none">
                                                <label for="serial_number">UL No.</label>
                                                <div class="form_input_container" data-key="serial_number">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_serial_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input id="serial_number" onblur="save_case_request(this.id)" type="text" name="serial_number"
                                                           class="form_input" placeholder="UL No."
                                                           value="<?php echo $row->serial_number; ?>" >
                                                </div>
                                                <?php $json['serial_number'] = $row->serial_number; ?>
                                            </div>


                                            <?php
                                            $color_status = 'orange';
                                            ?>
                                            <div class="form-group col-md-3" style="display:none">
                                                <label for="track_number">Track No.</label>
                                                <div class="form_input_container" data-key="track_number">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_track_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input type="text" onblur="save_case_request(this.id)" class="form_input" id="track_number"
                                                           name="track_number" placeholder="Track No" value="<?php echo $row->ura_barcode_no; ?>">
                                                </div>
                                                <label></label>
                                            </div>

                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="lab_number">Lab No. - CR0010</label>
                                                <div class="form_input_container" data-key="lab_number">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_lab_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input type="text" readonly="readonly" class="form_input" id="lab_number"
                                                           name="lab_number" placeholder="Lab Number"
                                                           value="<?php echo $row->lab_number; ?>">
                                                </div>
                                                <?php $json['lab_number'] = $row->lab_number; ?>
                                            </div>
                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['ref_lab_number']) && $redit_status['ref_lab_number'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['ref_lab_number']) && $redit_status['ref_lab_number'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="form-group col-md-3">
                                                <label for="lab_number">Referral Lab Number</label>
                                                <div class="form_input_container" >
                                                    <div class="radial_btn_container">
                                                        <svg class="svg_lab_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input type="text" class="form_input" id="ref_lab_number"
                                                           name="ref_lab_number" placeholder="Referral Lab Number"
                                                           value="<?php echo $row->ref_lab_number; ?>">
                                                </div>
                                                <?php $json['lab_number'] = $row->lab_number; ?>
                                            </div>
                                            
                                             <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['pci_number']) && $redit_status['pci_number'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="pci_number">Digi Number - Pcr0950</label>
                                                <div class="form_input_container" data-key="pci_number">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_pci_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input id="pci_number" onblur="save_case_request(this.id)" type="text" name="pci_number"
                                                           class="form_input" placeholder="Digi Number"
                                                           value="<?php echo $row->pci_number; ?>">
                                                </div>
                                                <?php $json['pci_number'] = $row->pci_number; ?>
                                            </div>

 <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['date_taken']) && $redit_status['date_taken'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="date_taken">Date Taken - Pcr1010</label>
                                                <div class="form_input_container" data-key="date_taken">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_date_taken" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <?php
                                                    $date_taken = '';
                                                    if (!empty($row->date_taken)) {
                                                        $date_taken = date('d-m-Y', strtotime($row->date_taken));
                                                    }
                                                    ?>
                                                    <input class="form_input" onblur="save_case_request(this.id)" type="text" name="date_taken"
                                                           id="datetaken_doctor" placeholder="Date Taken"
                                                           value="<?php echo $date_taken; ?>"/>
                                                </div>
                                                <?php $json['date_taken'] = date('d-m-Y', strtotime($row->date_taken)); ?>
                                            </div>

                                            
 <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['dermatological_surgeon']) && $redit_status['dermatological_surgeon'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="dermatological_surgeon">Clinician &nbsp;
                                                    <!-- <a href="javascript:void(0);" class="add_new_clinician" title="Add New Clinician" data-toggle="modal" data-target="#add_clinician_modal">
                                                        <i class="fa fa-plus"></i>
                                                    </a> -->
                                                </label>
                                                <div class="form_input_container" data-key="dermatological_surgeon">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg  class="svg_dermatological_surgeon" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>
                                                    </div>
                                                    <select name="dermatological_surgeon" onchange="save_case_request(this.id)" id="dermatological_surgeon" class="form_input">
                                                        <option value="">Choose</option>
                                                        <?php echo $this->Doctor_model->get_clinician_and_derm($row->hospital_group_id, 'dermatological', $row->dermatological_surgeon); ?>
                                                    </select>
                                                </div>
                                                <?php $json['dermatological_surgeon'] = $row->dermatological_surgeon; ?>
                                            </div>

                                            <?php
                                                    $color_status = 'orange';
                                                    ?>
                                                    <div class="form-group col-md-3">
                                                        <label for="hospital_no">Clinic:</label>
                                                        <div class="form_input_container" data-key="hospital_no">
                                                            <div class="radial_btn_container change_status_color">
                                                                <svg class="svg_hos_id" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>

                                                            </div>
                                                             <select class="form_input hos_name clinic_list" data-current="<?php echo $request_query[0]->hospital_group_id; ?>" id="hos_id" onchange="save_case_request(this.id)" name="hos_id">
                                                        <option value="0">Choose</option>
                                                       
                                                        <?php
                                                        $get_hos_names = $this->Doctor_model->display_hospitals_list_with_org();
                                                        if (!empty($get_hos_names) && is_array($get_hos_names)) :
                                                            foreach ($get_hos_names as $hos_key => $hos_val) 
															{																
                                                                $selected = '';
                                                                if ($hos_val->id == $request_query[0]->hospital_group_id) 
																{
                                                                    $selected = 'selected';
                                                                }
                                                                echo '<option data-org-site="'.$hos_val->site_identifier.'" data-org-identifier="'.$hos_val->identifier.'" data-labnameid="' . $hos_val->id . '" ' . $selected . ' value="' . $hos_val->id . '">' . ucwords($hos_val->description) . '</option>';
                                                            }
                                                        endif;
                                                        ?>                                                        
                                                    </select>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                             <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="lab_name">Lab Processing</label>
                                                <div class="form_input_container" data-key="lab_name">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_lab_id" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <select class="form_input lab_name" onblur="save_case_request(this.id)" id="lab_id" name="lab_name">
                                                        <option value="0">Choose</option>
                                                        <?php
                                                        $get_lab_names = $this->Doctor_model->getLabNamesFromLabGroups();

                                                        if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                                            foreach ($get_lab_names as $lab_key => $lab_val) {
                                                                $selected = '';
                                                                if ($lab_val['id'] == $row->lab_id) {
                                                                    $selected = 'selected';
                                                                }
                                                                echo '<option data-labnameid="' . $lab_val['id'] . '" ' . $selected . ' value="' . $lab_val['id'] . '">' . ucwords($lab_val['description']) . '</option>';
                                                            }
                                                        endif;
                                                        ?>
                                                        <?php
                                                        $selected = '';
                                                        if ($row->lab_name === 'U') {
                                                            $selected = 'selected';
                                                        }
                                                        ?>
                                                        <option <?php echo $selected; ?> value="U">Other</option>
                                                    </select>
                                                </div>
                                                <?php $json['lab_name'] = $row->lab_name; ?>
                                            </div>       
                                                    
                                                    
                                                    
                                                    <div class="form-group col-md-3">
                                                <label for="lab_name">Lab Reporting</label>
                                                <div class="form_input_container" data-key="lab_name">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_lab_id" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <select class="form_input lab_name" onblur="save_case_request(this.id)" id="lab_report" name="lab_report">
                                                        <option value="0">Choose</option>
                                                        <?php
                                                        $get_lab_names = $this->Doctor_model->getLabNamesFromLabGroups();

                                                        if (!empty($get_lab_names) && is_array($get_lab_names)) :
                                                            foreach ($get_lab_names as $lab_key => $lab_val) {
                                                                $selected = '';
                                                                if ($lab_val['id'] == $row->lab_processing_id) {
                                                                    $selected = 'selected';
                                                                }
                                                                echo '<option data-labnameid="' . $lab_val['id'] . '" ' . $selected . ' value="' . $lab_val['id'] . '">' . ucwords($lab_val['description']) . '</option>';
                                                            }
                                                        endif;
                                                        ?>
                                                        <?php
                                                        $selected = '';
                                                        if ($row->lab_name === 'U') {
                                                            $selected = 'selected';
                                                        }
                                                        ?>
                                                        <option <?php echo $selected; ?> value="U">Other</option>
                                                    </select>
                                                </div>
                                                <?php $json['lab_name'] = $row->lab_name; ?>
                                            </div>
                                                    
                                            <div class="form-group col-md-3" style="display:none">
                                                <label for="organisation_site_identifier">Organisation
                                                    site identifier</label>
                                                <div class="form_input_container"
                                                     data-key="organisation_site_identifier">
                                                    <div class="radial_btn_container">
                                                        <svg class="svg_organisation_site_identifier" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input type="text" onblur="save_case_request(this.id)" class="form_input"
                                                           id="organisation_site_identifier"
                                                           name="organisation_site_identifier"
                                                           placeholder="Organisation site identifier" value="<?php echo $hospital_infodata[0]->site_identifier;?>" disabled>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-3" style="display:none">
                                                <label for="organisation_identifier">Organisation
                                                    identifier</label>
                                                <div class="form_input_container" data-key="organisation_identifier">
                                                    <div class="radial_btn_container">
                                                        <svg class="svg_organisation_identifier" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input type="text" onblur="save_case_request(this.id)" class="form_input" id="organisation_identifier"
                                                           name="organisation_identifier"
                                                           placeholder="Organisation Identifier" value="<?php echo $hospital_infodata[0]->identifier;?>" disabled>
                                                </div>
                                            </div>


                                            

                                           
                                            
                                            <?php
                                            $color_status = 'orange';
                                            ?>
                                            <div class="form-group col-md-3">
                                                <label for="pathologist">Pathologist - Pcr6990 &nbsp;
                                                    <a href="javascript:void(0);" class="add_new_pathologist" title="Add New Pathologist" data-toggle="modal" data-target="#add_pathologist_modal">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </label>
                                                <div class="form_input_container" data-key="pathologist">
                                                    <div class="radial_btn_container">
                                                        <svg class="svg_location" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
<!--                                                   <input type="text" class="form_input" onblur="save_case_request(this.id)" id="location" name="location" placeholder="Location" value="--><?php //echo $Usersgetdatils[0]->first_name;?><!-- --><?php //echo $Usersgetdatils[0]->last_name;?><!--" disabled>-->
                                                    <select name="assigned_user_id" onchange="save_case_request(this.id)" id="assigned_user_id" class="form_input">
                                                        <option value="">Choose</option>
                                                        <?php echo $this->Doctor_model->get_pathologist(118, 'assigned_user_id', $Usersgetdatils[0]->id); ?>
                                                    </select>
                                                </div>
                                            </div>


                                           
 <?php
                                            $color_status = 'orange';
                                            ?>
                                            <div class="form-group col-md-3" style="display:none">
                                            
                                             
                                                <label for="specimen_nature">Specimen Nature -
                                                    Pcr0970</label>
                                                <div class="form_input_container" data-key="specimen_nature">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_specimen_nature" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input type="text" class="form_input" onblur="save_case_request(this.id)" id="specimen_nature"
                                                           name="specimen_nature" placeholder="Specimen Nature" value="<?php echo $request_type; ?>"  >
                                                </div>
                                            </div>


                                           
                                            

                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['date_received_bylab']) && $redit_status['date_received_bylab'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="date_received_bylab">REC LAB - Pcr0770</label>
                                                <div class="form_input_container" data-key="date_received_bylab">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_date_received_bylab" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <?php
                                                    $date_received_bylab = '';
                                                    if (!empty($row->date_received_bylab)) {
                                                        $date_received_bylab = date('d-m-Y', strtotime($row->date_received_bylab));
                                                    }
                                                    ?>
                                                    <input class="form_input" onblur="save_case_request(this.id)" type="text" name="date_received_bylab"
                                                           id="datetaken_doctor" placeholder="REC LAB"
                                                           value="<?php echo $date_received_bylab; ?>"/>
                                                </div>
                                                <?php $json['date_received_bylab'] = date('d-m-Y', strtotime($row->date_received_bylab)); ?>
                                            </div>


                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['date_sent_touralensis']) && $redit_status['date_sent_touralensis'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="date_sent_touralensis">REL LAB</label>
                                                <div class="form_input_container" data-key="date_sent_touralensis">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_date_sent_touralensis" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <?php
                                                    $sent_to_uralensis_date = date('Y-m-d');
                                                    if (!empty($row->date_sent_touralensis)) {
                                                        $sent_to_uralensis_date = date('d-m-Y', strtotime($row->date_sent_touralensis));
                                                    } else {
                                                        if (!empty($bck_frm_lab_date_data)) {
                                                            $sent_to_uralensis_date = date('d-m-Y', strtotime($bck_frm_lab_date_data));
                                                        }
                                                    }
                                                    ?>
                                                    <input type="text" onblur="save_case_request(this.id)" name="date_sent_touralensis" class="form_input"
                                                           id="date_sent_touralensis" placeholder="Uralensis Sent Date"
                                                           value="<?php echo $sent_to_uralensis_date; ?>"/>
                                                </div>
                                                <?php $json['date_sent_touralensis'] = date('d-m-Y', strtotime($sent_to_uralensis_date)); ?>
                                            </div>

                                           

                                           

                                            

                                            
                                            
                                            <?php
                                           $color_status = 'orange';
                                            if (!empty($redit_status['courier_no']) && $redit_status['courier_no'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['courier_no']) && $redit_status['courier_no'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>
                                            <div class="form-group col-md-3">
                                                <label for="courier_no">Courier no.</label>
                                                <div class="form_input_container" data-key="courier_no">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_emis_number" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <input type="text" onblur="save_case_request(this.id)" class="form_input" id="emis_number"
                                                           name="emis_number" placeholder="Courier no." value="<?php echo $row->courier_no; ?>">
                                                </div>
                                            </div>

                                            

                                            <?php
                                            $color_status = 'orange';
                                            if (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '1') {
                                                $color_status = 'green';
                                            } elseif (!empty($redit_status['report_urgency']) && $redit_status['report_urgency'] == '2') {
                                                $color_status = 'blue';
                                            }
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="report_urgency">Status</label>
                                                <div class="form_input_container" data-key="report_urgency">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_report_urgency" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <select name="report_urgency" onchange="save_case_request(this.id)" class="form_input "
                                                            id="report_urgency">
                                                        <?php
                                                        $report_urgency = array(
                                                            'Routine' => 'Routine',
                                                            'Urgent' => 'Urgent',
                                                            '2WW' => '2WW'
                                                        );

                                                        foreach ($report_urgency as $key => $urgency) {
                                                            $selected = '';
                                                            if ($key == $row->report_urgency) {
                                                                $selected = 'selected';
                                                            }
                                                            ?>
                                                            <option <?php echo $selected; ?>
                                                                    value="<?php echo $key; ?>"><?php echo $urgency; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <?php $json['report_urgency'] = $row->report_urgency; ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="date_collectionDate">Collection Date</label>
                                                <div class="form_input_container" data-key="date_collectionDate">
                                                    <div class="radial_btn_container change_status_color">
                                                        <svg class="svg_date_collectionDate" width="26" height="26">
                                                            <circle cx="13" cy="13" r="12"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill-opacity="0" stroke-width="1"/>
                                                            <circle cx="13" cy="13" r="7"
                                                                    stroke="<?php echo $color_status; ?>"
                                                                    fill="<?php echo $color_status; ?>"
                                                                    stroke-width="2"/>
                                                        </svg>

                                                    </div>
                                                    <?php
                                                    $collection_date = '';
                                                    if (!empty($row->collection_date)) {
                                                        $collection_date = date('d-m-Y', strtotime($row->collection_date));
                                                    } else {
                                                        if (!empty($bck_frm_lab_date_data)) {
                                                            $collection_date = date('d-m-Y', strtotime($bck_frm_lab_date_data));
                                                        }
                                                    }
                                                    ?>
                                                    <input type="text" onblur="save_case_request(this.id)" name="collection_date" class="form_input"
                                                           id="collection_date" placeholder="Collection Date"
                                                           value="<?php echo $collection_date; ?>" autocomplete="off"/>
                                                </div>
                                                <?php $json['collection_date'] = date('d-m-Y', strtotime($collection_date)); ?>
                                            </div>                
                                            <div class="form-group col-md-12">
                                                <span class="">
                                                    <label> Copy to &nbsp;<a href="javascript:void(0);" class="add_new_clinician" title="Add New Clinician" data-toggle="modal" data-target="#add_clinician_modal">
                                                        <i class="fa fa-plus"></i>
                                                    </a></label>
                                                    <select multiple name="copy_to[]"
                                                            class="form-control select2"
                                                            onchange="save_case_request('copy_to')">
                                                        <option data-hidden="true">Nothing Select</option>
                                                        <option value="">Choose</option>
                                                        <?php echo $this->Doctor_model->get_clinician_and_derm($row->hospital_group_id, 'dermatological', $row->dermatological_surgeon, "copy_to", $row->uralensis_request_id); ?>
                                                    </select>
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                       <!--  <div class="col-md-12 test_area" style="padding-right: 0;">
                            <div class="sec_title t_id form-group">

                                <span id="test_id_title">
                                    Test ID
                                    <span class="edit_icon pull-right make_editable hidden" style="margin-right: 40px;">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <span class="btn btn-info btn-sm pull-right btn_save_sec hidden"
                                          style="margin-right: 10px; border-radius: 4px;">
                                        <i class="fa fa-save"></i>
                                    </span>
                                    <span class="btn btn-success-outline btn-sm pull-right updated_btn hidden"
                                          style="margin-right: 10px; border-radius: 4px;">
                                        Updated
                                    </span>
                                </span>

                                <a href="javascript:;" class="checv_up_down"><i class="fa fa-chevron-down"></i></a>

                            </div>

                            <div class="card hidden" style="margin-bottom: 0px; ">
                                <div class="card-body">

                                    <div id="table-view-test">

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="table-view-container">

                                                        <div class="row" data-key="serial_number">
                                                            <div class="table_view_svg col-xs-2 change_status_color">

                                                                <svg class="svg_serial_number" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="col-xs-9 ">
                                                                <div class="table-view-heading">Lab No.</div>
                                                                <div class="table-view-content"><?php echo $labNo = $row->lab_number; ?></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="table-view-container">
                                                        <?php
                                                        $color_status = 'orange';
                                                        ?>
                                                        <div class="row">
                                                            <div class="table_view_svg col-xs-2">

                                                                <svg width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="col-xs-9 ">
                                                                <div class="table-view-heading">Speciality</div>
                                                                <div class="table-view-content"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="table-view-container">
                                                        <?php
                                                        $color_status = 'orange';
                                                        if (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '1') {
                                                            $color_status = 'green';
                                                        } elseif (!empty($redit_status['lab_number']) && $redit_status['lab_number'] == '2') {
                                                            $color_status = 'blue';
                                                        }
                                                        ?>
                                                        <div class="row" data-key="lab_number">
                                                            <div class="table_view_svg col-xs-2 change_status_color">

                                                                <svg class="svg_lab_number" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="col-xs-9 ">
                                                                <div class="table-view-heading">T Code</div>
                                                                <div class="table-view-content"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="table-view-container">
                                                        <?php
                                                        $color_status = 'orange';
                                                        ?>
                                                        <div class="row">
                                                            <div class="table_view_svg col-xs-2">

                                                                <svg width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="col-xs-9 ">
                                                                <div class="table-view-heading">Specimen</div>
                                                                <div class="table-view-content"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="table-view-container">
                                                        <?php
                                                        $color_status = 'orange';
                                                        ?>
                                                        <div class="row">
                                                            <div class="table_view_svg col-xs-2">

                                                                <svg width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="col-xs-9 ">
                                                                <div class="table-view-heading">Block</div>
                                                                <div class="table-view-content"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="table-view-container">
                                                        <?php
                                                        $color_status = 'orange';
                                                        ?>
                                                        <div class="row">
                                                            <div class="table_view_svg col-xs-2">

                                                                <svg width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="col-xs-9 ">
                                                                <div class="table-view-heading">Block Description</div>
                                                                <div class="table-view-content"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="table-view-container">
                                                        <?php
                                                        $color_status = 'orange';
                                                        if (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '1') {
                                                            $color_status = 'green';
                                                        } elseif (!empty($redit_status['lab_name']) && $redit_status['lab_name'] == '2') {
                                                            $color_status = 'blue';
                                                        }
                                                        ?>
                                                        <div class="row" data-key="lab_name">
                                                            <div class="table_view_svg col-xs-2 change_status_color">

                                                                <svg class="svg_lab_name" width="26" height="26">
                                                                    <circle cx="13" cy="13" r="12"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill-opacity="0" stroke-width="1"/>
                                                                    <circle cx="13" cy="13" r="7"
                                                                            stroke="<?php echo $color_status; ?>"
                                                                            fill="<?php echo $color_status; ?>"
                                                                            stroke-width="2"/>
                                                                </svg>
                                                            </div>
                                                            <div class="col-xs-9 ">
                                                                <div class="table-view-heading">Tests</div>
                                                                <div class="table-view-content"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                                    <div id="edit-test-request" class="hidden">

                                        <div class="row form-group">
                                            <div class="col-md-3">
                                                <label for="">Lab No.</label>
                                                <input type="text" name="" value="<?php echo $labNo = $row->lab_number; ?>" class="form-control"/>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Speciality</label>
                                                <select class="form-control">
                                                    <option>Select Speciality</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">T Code</label>
                                                <input type="text" name="" class="form-control"/>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Specimen</label>
                                                <input type="text" name="" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-md-3">
                                                <label for="">Block</label>
                                                <input type="text" name="" class="form-control"/>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Block Description</label>
                                                <input type="text" name="" class="form-control"/>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Tests</label>
                                                <select class="form-control">
                                                    <option>Select Tests</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="clearfix"></div>
                                    </div>

                                </div>


                            </div>

                        </div> -->


                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="tg-haslayout uralensis_icons_actions" id="myHeader"> 
        <div class="container-fluid tab-full" style="padding-right: 130px; padding-left: 30px;">
            <div class="row">
            <div class="col-xs-3 col-sm-4 col-md-3 col-lg-3 text-set" style="padding:15px 0px; font-size:14px;">Lab ID: <?php echo $row->lab_number;?> Patient: <?php echo $p_result[0]->first_name; ?> <?php print $p_result[0]->last_name; ?> <?php print @date_diff(date_create($request_query[0]->dob), date_create('today'))->y;?> / <?php print $p_result[0]->gender; ?></div>
               
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                
                
                    <ul class="tg-themedetailsicon">
                            <li>
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="collapse" title="Uploaded Documents"
                                   data-target="#relateddocs"><i class="ti-clip" title="Uploaded Documents" ></i></a>
                                </li>

                            
                            <li>
                                
                                <a href="javascript:void(0);" class="tg-detailsicon" data-toggle="modal" data-target="#view_doc" <?php echo (!empty($files && is_array($files)) ? 'onclick="embed_doc()"' : '') ?> title="Related Documents"><span
                                        title="Related Documents"   class="tg-notificationtag"><?php echo count($files); ?></span>
                                    <i class="ti-eye"></i>
                                </a>
                                </li>

                            
                            <li>
                                <a href="javascript:void(0);" class="tg-detailsicon" data-toggle="modal" data-target="#capture_webcam" id="capture_webcam_img"  title="Capture Image">
                                    <span title="Capture Image"   class="tg-notificationtag">0</span>
                                    <i class="ti-camera"></i>
                                </a>
                                </li>

                            
                            <li>
                                
                                
                                <?php if ($request_query[0]->specimen_update_status == 1) { ?>
                                    <a href="javascript:;" class="tg-detailsicon tg-filtercolors" title="View Report" id="show_pdf_iframe">
                                        <i title="View Report" class="ti-search"></i>
                                    </a>
                                <?php } ?>
                                
                            </li>

                            
                            <li class="cust_dd_show hidden">
                                        <?php if ($request_query[0]->specimen_publish_status == 1) { ?>
                                    <a href="<?php echo site_url() . '/doctor/generate_report/' . $request_query[0]->uralensis_request_id; ?>"
                                       target="_blank" class="tg-detailsicon" id="show_pdf_iframe">
                                       <i title="View Final PDF" class="ti-notepad"></i></a>
                                   <?php } ?>
                               </li>
                               <li class="cust_dd_show hidden">
                                
                                <a href="javascript:;" class="tg-detailsicon" title="Add to Queue"
                                   data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"
                                   id="add_to_authorization">
                                   <span title="Add to Queue" class="tg-notificationtag"><i class="fa fa-plus"></i></span>
                                   <i title="Add to Queue"
                                                             class="ti-layers"></i></a>
                                                         </li>

                                <li class="cust_dd_show hidden">                             
                                 <a href="<?php echo site_url() . '/doctor/add_further_work_new/' . $request_query[0]->uralensis_request_id; ?>" class="tg-detailsicon"  title="Add Further Work">
                                    <span title="Add Further Work" class="tg-notificationtag">
                                        <?php echo uralensis_get_further_work_data(); ?>
                                    </span>
                                    <i title="Add Further Work" class="ti-target"></i></a>
                                </li>
                                <li class="cust_dd_show hidden">
                                                             
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="MDT"
                                   data-target="#mdt_data_modal"><i title="MDT"
                                                                 class="ti-archive"></i></a>
                                </li>
                                <li class="cust_dd_show hidden">
                                <a href="javascript:;" class="tg-detailsicon request_for_opinion" title="Request for opinion">
                                    <i title="Request for opinion" class="ti-pulse"></i></a>
                                </li>
                                <li class="cust_dd_show hidden">
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Assign to other doctor"
                                   data-target="#assign_doctor_modal">

                                   <span title="Assign to other doctor" class="tg-notificationtag"><i class="fa fa-plus"></i></span>

                                   <i title="Assign to other doctor" class="ti-support"></i></a>
                               </li>
                               <li class="cust_dd_show hidden">
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Assign as teaching and cpc"
                                   data-target="#teaching_cpc_modal">
                                   <span title="Assign as teaching and cpc" class="tg-notificationtag"><i class="fa fa-plus"></i></span>
                                   <i title="Assign as teaching and cpc"
                                                                     class="ti-bell"></i></a>
                                </li>
                                <li class="cust_dd_show hidden">
                                    <?php if ($request_query[0]->specimen_publish_status == 1) { ?>
                                    <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Add Supplementarty Report"
                                       data-target="#add_supplementary">
                                       <span title="Add Supplementarty Report" class="tg-notificationtag"><i class="fa fa-plus"></i></span>
                                       <i title="Add Supplementarty Report" class="ti-plus"></i></a></li>
                                                                       <li class="cust_dd_show hidden">
                                   <?php } ?>
                                   <?php if ($request_query[0]->additional_data_state === 'in_session') { ?>
                                    <a href="javascript:;" id="publish_supplementary_btn" title="Publish Supplementarty Report"
                                       data-recordid="<?php echo $request_query[0]->uralensis_request_id; ?>"
                                       class="tg-detailsicon">
                                       <span title="Publish Supplementarty Report" class="tg-notificationtag"><i class="las la-cloud-upload-alt"></i></span>
                                       <i title="Publish Supplementarty Report"
                                                              class="ti-check-box"></i></a>
                                    <?php } ?>
                                    </li>
                                <li class="cust_dd_show hidden">
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Manage Supplementary"
                                   data-target="#manage_supple">
                                   <span title="Manage Supplementary" class="tg-notificationtag"><i class="las la-tasks"></i></span>
                                   <i title="Manage Supplementary"
                                                                class="ti-wallet"></i></a>
                                </li>
                                <li class="cust_dd_show hidden">
                                
                                <a href="javascript:;" class="tg-detailsicon" data-toggle="modal" title="Record History"
                                   data-target="#rec_history_modal"><i class="ti-folder" title="Record History" ></i></a>
                                   </li>
                                <li class="cust_dd_show hidden">
                                   <?php if (!isset($request_query[0]->remote_record) || $request_query[0]->remote_record == NULL || $request_query[0]->remote_record == 0): ?>
                                    <a href="<?php echo base_url('/doctor/doctor_record_detail/' . $request_query[0]->uralensis_request_id . '/bridgehead'); ?>" class="tg-detailsicon" title="Related Records">
                                    <?php elseif ($request_query[0]->remote_record == 1): ?>
                                        <a href="#" class="tg-detailsicon" id="bridgehead-button" title="Related Records">
                                        <?php endif; ?>
                                        <i title="Related Records" ><img width="45px" src="<?php echo base_url('assets/img/box.png'); ?>"></i>
                                    </a>
                                    </li>
                                <li class="cust_dd_show hidden">
                                    <!-- Old code 
                                     <a title="Datasets" href="<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no)) ?>" class="tg-detailsicon">
                                        <i class="ti-harddrive" title="Datasets"></i></a> -->
                                <!--                            <a title="Datasets" href="<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/') ?>" class="tg-detailsicon">
                                                                <i class="ti-harddrive" title="Datasets"></i></a>-->




                                                            <?php
                            //                                $check_record = check_dataset_record($this->uri->segment(3), '');
                                                            //  if ($check_record[0]['dataset_type'] == 'Basal Cell') {
                                                            ?>
                            <!--                                    <a class="tg-detailsicon" title="Datasets"  title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo)) ?>"> <i class="ti-harddrive" title="Datasets"></i>  </a>-->
                                                            <?php
                                    // } else {
                                    ?>
                                    <!-- Trigger the modal with a button -->
                                    <a class="tg-detailsicon" title="Datasets" data-toggle="modal" data-target="#datasetLinks"><i class="ti-harddrive" title="Datasets"></i></a>

                                    <!-- Modal -->
                                    <div id="datasetLinks" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Available Datasets</h4>
                                                </div>
                                                <div class="modal-body">

                            <!--              <h3><a title="Breast Cancer" href="<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no)) ?>">
                                                     <i class="ti-harddrive" title="Breast Cancer"></i> Breast Cancer</a></h3>
                                   <br><h3><a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no)) ?>">
                                                     <i class="ti-harddrive" title="Basal Cell Carcinoma"></i> Basal Cell Carcinoma</a></h3>
                                                                    -->


                                                                    <?php
                                //_print_r(get_Datasets());  
                                                    //_print_r($specimen_query);                                  
                                                    ?>

                                                    <ul class="nav nav-tabs" role="tablist">

                                                        <?php
                                                        $sqCount = 1;
                                                        foreach ($specimen_query as $sq) {
                                                            ?>    
                                                            <li role="presentation"><a href="#Specimen<?= $sqCount ?>DS" aria-controls="Specimen<?= $sqCount ?>DS" role="tab" data-toggle="tab">Specimen <?= $sqCount ?></a></li>
                                                            <?php
                                                            $sqCount++;
                                                        }
                                                        ?>    
                                                    </ul>     


                                                    <div class="tab-content">
                                                        <?php
                                                        $sqCountt = 1;
                                                        foreach ($specimen_query as $sq) {
                                                            ?>                 
                                                            <div role="tabpanel" class="tab-pane <?= $sqCountt == 1 ? 'active' : '' ?>" id="Specimen<?= $sqCountt ?>DS"> <?php
                                                                foreach (get_Datasets() as $ds) {
                                                                    if ($ds->parent_dataset_id == 0) {
                                                                        echo "<div class='pDs'><i class='fa fa-chevron-right pDs'></i>" . $ds->dataset_name . "</div>";
                                                                    }
                                                                    if ($ds->parent_dataset_id > 0) {
                                                                        echo "<div class='cDs'><i class='fa fa-chevron-right pDs'></i>";
                                                                        if ($ds->dataset_id == 14) {
                                                                            ?>
                                                                            <a title="Breast Cancer" href="<?php echo site_url('_dataset/breast_cancer_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo)) . '/' . $sqCountt ?>"> <?= $ds->dataset_name ?>  </a>

                                                                        <?php } else if ($ds->dataset_id == 18) { ?>
                                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo)) . '/' . $sqCountt ?>"> <?= $ds->dataset_name ?>  </a>
                                                                        <?php } else if ($ds->dataset_id == 19) { ?>
                                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/cutaneous_malignant_melanoma_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo)) . '/' . $sqCountt ?>"> <?= $ds->dataset_name ?>  </a>
                                                                        <?php } else if ($ds->dataset_id == 21) { ?>
                                                                            <a title="Basal Cell Carcinoma" href="<?php echo site_url('_dataset/squamous_cell_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo)) . '/' . $sqCountt ?>"> <?= $ds->dataset_name ?>  </a>

                                                                            <?php
                                                                        } else {
                                                                            echo $ds->dataset_name;
                                                                        } echo "</div>";
                                                                    }
                                                                }
                                                                ?> 
                                                            </div>              
                                                            <?php
                                                            $sqCountt++;
                                                        }
                                                        ?>                  
                                                    </div>                                 




                                           





                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>        


                                    <?php // }  ?>


                                    </li>
                                    <li class="cust_dd">
                                    <a href="javascript:;" class="tg-detailsicon"><i class="las la-ellipsis-v"></i></a>                                
                                
                            </li>
                            
                        </ul>
                </div>
            </div>


            <!-- BCC DATASET VIEW Modal -->
            <div id="bcc_ds_modal_full_view" class="modal fade" role="dialog">
                <div class="modal-dialog" style="width: 930px;">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h2 class="modal-title">
                                <i style="background: #00c5fb;color: white;padding: 10px;border-radius: 30px;font-size: 35px;"
                                   class="ti-harddrive" title="Datasets"></i>
                                Reporting proforma for cutaneous basal cell carcinoma removed
                                with therapeutic intent
                            </h2>
                        </div>
                        <div class="modal-body">
                            <?php
                            $initial = uralensis_get_user_data($row->uralensis_request_id, 'initial');
                            $fullname = uralensis_get_user_data($row->uralensis_request_id, 'fullname');
                            $serial_number = uralensis_get_record_db_detail($row->uralensis_request_id, 'serial_number');
                            $ura_barcode_no = uralensis_get_record_db_detail($row->uralensis_request_id, 'ura_barcode_no');
                            $ura_dob = date('d-m-Y', strtotime($request_query[0]->dob));
                            $ura_nhs = $request_query[0]->nhs_number;
                            $ura_gender = $gender;
                            //                            echo '
                            //                                <table class="table custom-table info_nndn" style="margin-bottom: 0;">
                            //                                    <tr style="box-shadow:0px 0px 0px 0px !important;">
                            //                                        <td>
                            //                                            <span class="tg-namelogo">' . uralensis_get_user_data($request_query[0]->uralensis_request_id, 'initial') . '</span>
                            //                                            <span style="display:inline-block; margin-top: 12px;">' . uralensis_get_user_data($request_query[0]->uralensis_request_id, 'fullname') . '</span>
                            //                                        </td>
                            //                                        <td><span>DOB: ' . (!empty($request_query[0]->dob) ? date('d-m-Y', strtotime($request_query[0]->dob)) : '') . '</span></td>
                            //                                        <td><span>NHS: ' . $request_query[0]->nhs_number . '</span></td>
                            //                                        <td>
                            //                                            <span>Gender: ' . ($request_query[0]->gender == 'Male' ? 'M' : 'F') . '</span>
                            //                                        </td>
                            //                                        <td>
                            //                                            <a title="Download Basal Cell Carcinoma" href="' . site_url('/_dataset/gen_pdf/index/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo) . $get_bcc_record[$clinical_arr]['patient_specimen']) . '" target="_blank" class="btn btn-primary btn-rounded">
                            //                          <i class="fa fa-floppy-o"></i>
                            //                          </a>
                            //                                        </td>
                            //                                    </tr>
                            //                                </table> ';
                            $html_response = '';
                            $get_bcc_record = get_bcc_dataset_record($this->uri->segment(3), '');

                            $_PDF_html = '';
                            if (!empty($get_bcc_record)) {


                                $ura_logo = base_url('/application/helpers/tcpdf/uralensis_latest.jpg');

                                $header_text = <<<EOD
                
<table width="100%">
    <tr>
        <td width="25%" align="left">
            <img width="180px" src="$ura_logo" />
        </td>
        <td width="32%" align="center" style="font-size:20px;"><b>Histopathology Report</b></td>
        <td width="50%" align="right">
            <table style="font-size:12.5px;text-align:left;">
                <tr><td width="45%">Serial Number : </td><td><b> $serial_number </b></td></tr>
                <tr><td>PCI Number : </td><td><b> $ura_barcode_no </b></td></tr>
                <tr><td>Patient : </td><td><b> $fullname  </b></td></tr>
        <tr><td>Lab Ref : </td><td> $sent_to_uralensis_date </td></tr>
        <tr><td>NHS ID : </td><td> $ura_nhs </td></tr>
                <tr><td>Date of Birth : </td><td> $ura_dob </td></tr>
                <tr><td>Gender : </td><td> $ura_gender </td></tr>
                <tr><td>Clinic Date : </td><td> $date_taken </td></tr>
            </table>
        </td>
    </tr>
</table>
EOD;

                                echo $header_text;

                                for ($clinical_arr = 0; $clinical_arr < sizeof($get_bcc_record); $clinical_arr++) {

                                    $html_response = $get_bcc_record[$clinical_arr]['bcc_response_html'];
                                    $data_set = json_decode($get_bcc_record[$clinical_arr]['bcc_data'], true);

                                    $_PDF_html .= $_PDF_head . '<table class="table table-bordered">';
                                    $_PDF_html .= '<h2>Specimen ' . $get_bcc_record[$clinical_arr]['patient_specimen'] . '  <a title="Basal Cell Carcinoma" href="' . site_url('_dataset/basal_cell_dataset/dashboard/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo) . $get_bcc_record[$clinical_arr]['patient_specimen']) . '" class="btn btn-primary btn-rounded">
                          <i class="fa fa-pencil"></i>
                          </a>
                          <a onclick="return confirm_delete();" href="' . site_url('_dataset/basal_cell_dataset/removeDatasetbyID/' . $get_bcc_record[$clinical_arr]['dataset_record_id'] . '/' . $get_bcc_record[$clinical_arr]['record_id']) . '" class="btn btn-danger btn-rounded"><i class="fa fa-trash"></i> </a></h2>  <a title="Download Basal Cell Carcinoma" href="' . site_url('/_dataset/gen_excel/index/' . $this->uri->segment(3) . '/' . urlencode($initial) . '/' . urlencode($fullname) . '/' . urlencode($serial_number) . '/' . urlencode($ura_barcode_no) . '/' . urlencode($ura_dob) . '/' . urlencode($ura_nhs) . '/' . urlencode($ura_gender) . '/' . urlencode($labNo) . $get_bcc_record[$clinical_arr]['patient_specimen']) . '" target="_blank" class="btn btn-primary btn-rounded">
                          <i class="fa fa-floppy-o"></i>
                          </a>';
                                    $data_arr = '';

                                    foreach ($data_set as $key => $val) {

                                        if ($this->uri->segment(13) != '') {

                                            if ($this->uri->segment(13) == 'clinical') {
                                                $data_arr = array('clinicaldimention', 'Specimen_type', 'Incision', 'Excision', 'Punch', 'Curettings', 'Shave', 'CDOther');
                                            }
                                            if ($this->uri->segment(13) == 'macro') {
                                                $data_arr = array('specimendimention1', 'specimendimention2', 'specimendimention3', 'MDMacroscopic_description', 'Macroscopic');
                                            }
                                            if ($this->uri->segment(13) == 'micro') {
                                                $data_arr = array('Histological_low', 'n_invasion', 'n_invasion_present', 'n_invasion_yes_m', 'n_Peripheral', 'n_Deep', 'Maximum_Indicate', 'Maximum_Dimention', 'Histological_high', 'n_Histological_Specify_tissue', 'n_bone_minor', 'n_bone_gross', 'n_bone_foraminal');
                                            }
                                        } else {
                                            $data_arr = array('clinicaldimention', 'Specimen_type', 'Incision', 'Excision', 'Punch', 'Curettings', 'Shave', 'CDOther', 'specimendimention1', 'specimendimention2', 'specimendimention3', 'MDMacroscopic_description', 'Macroscopic', 'Histological_low', 'n_invasion', 'n_invasion_present', 'n_invasion_yes_m', 'n_Peripheral', 'n_Deep', 'Maximum_Indicate', 'Maximum_Dimention', 'Histological_high', 'n_Histological_Specify_tissue', 'n_bone_minor', 'n_bone_gross', 'n_bone_foraminal', 'ptnm', 'ptnm_N', 'ptnm_M', 'bcc_comments');
                                        }

                                        if (in_array($key, $data_arr)) {

                                            if ($key == 'clinicaldimention') {
                                                $key = 'Maximum clinical dimension/diameter';
                                                $val = $val . ' mm';
                                            }
                                            if ($key == 'Specimen_type') {
                                                $key = 'Specimen type';
                                            }
                                            if ($key == 'CDOther') {
                                                $key = 'Other';
                                            }
                                            if ($key == 'specimendimention1') {
                                                $key = 'Dimension of specimen (Length)';
                                                $val = $val . ' mm';
                                            }
                                            if ($key == 'specimendimention2') {
                                                $key = '(Breath)';
                                                $val = $val . ' mm';
                                            }
                                            if ($key == 'specimendimention3') {
                                                $key = '(Depth)';
                                                $val = $val . ' mm';
                                            }
                                            if ($key == 'MDMacroscopic_description') {
                                                $key = 'Maximum dimension';
                                                $val = $val . ' mm';
                                            }
                                            if ($key == 'Macroscopic') {
                                                $key = 'Diameter of lesion';
                                            }
                                            if ($key == 'Histological_low') {
                                                $key = 'Low risk subtype';
                                            }
                                            if ($key == 'n_invasion') {
                                                $key = 'Perineural invasion† :**';
                                            }
                                            if ($key == 'n_invasion_present') {
                                                $key = 'If present: Meets criteria to upstage pT1/pT2 to pT3?**';
                                            }
                                            if ($key == 'n_invasion_yes_m') {
                                                $key = 'If yes: Named nerve';
                                            }
                                            if ($key == 'n_Peripheral') {
                                                $key = 'Margins†: (Peripheral)';
                                            }
                                            if ($key == 'n_Deep') {
                                                $key = 'Margins†: (Deep)';
                                            }
                                            if ($key == 'Maximum_Indicate') {
                                                $key = 'Maximum dimension/diameter of lesion (Indicate which used)';
                                            }
                                            if ($key == 'Maximum_Dimention') {
                                                $key = '(Dimension)';
                                            }
                                            if ($key == 'Histological_high') {
                                                $key = 'High risk if present';
                                            }
                                            if ($key == 'n_Histological_Specify_tissue') {
                                                $key = 'Specify tissue';
                                            }
                                            if ($key == 'n_bone_minor') {
                                                $key = 'Minor bone erosion';
                                            }
                                            if ($key == 'n_bone_gross') {
                                                $key = 'Gross cortical/marrow invasion';
                                            }
                                            if ($key == 'n_bone_foraminal') {
                                                $key = 'Axial/skull base/foraminal invasion';
                                            }
                                            if ($key == 'ptnm') {
                                                $key = 'pTNM pT';
                                            }
                                            if ($key == 'ptnm_N') {
                                                $key = 'pTNM pN';
                                            }
                                            if ($key == 'ptnm_M') {
                                                $key = 'Distant metastasis M';
                                            }
                                            if ($key == 'bcc_comments') {
                                                $key = 'COMMENTS';
                                            }


                                            if ($this->uri->segment(13) != '') {

                                                if ($this->uri->segment(13) == 'clinical') {
                                                    $key == 'Maximum clinical dimension/diameter' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Clinical Data</td></tr>' : '';
                                                }
                                                if ($this->uri->segment(13) == 'macro') {
                                                    $key == 'Dimension of specimen (Length)' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Macroscopic Description</td></tr>' : '';
                                                }
                                                if ($this->uri->segment(13) == 'micro') {
                                                    $key == 'Low risk subtype' || $key == 'High risk if present' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Microscopic Description / Histological Data</td></tr>' : '';
                                                }
                                            } else {
                                                $key == 'Maximum clinical dimension/diameter' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Clinical Data</td></tr>' : '';
                                                $key == 'Dimension of specimen (Length)' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Macroscopic Description</td></tr>' : '';
                                                $key == 'Low risk subtype' || $key == 'High risk if present' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Microscopic Description / Histological Data</td></tr>' : '';
                                                $key == 'Maximum dimension/diameter of lesion (Indicate which used)' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">Maximum dimension/diameter of lesion</td></tr>' : '';
                                                $key == 'pTNM pT' ? $_PDF_html .= '<tr style="color:black;font-size:15px;font-weight:bold"><td colspan="2">pTNM & COMMENTS</td></tr>' : '';
                                            }


                                            $_PDF_html .= "<tr> <td> $key </td> <td> $val </td> </tr>";
                                        }
                                    }

                                    $_PDF_html .= '</table><tcpdf pagebreak="true"/>';
                                }
                            }

                            $_PDF_html .= <<<EOD
                </table>
EOD;
                            echo $_PDF_html;
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <div id="relatedrecordscollapse" class="collapse">
                <?php
                $hospital_name = '';
                if (!empty($related_query)) {
                    $hospital_name = $this->ion_auth->group($related_query[0]->hospital_group_id)->row()->description;
                    display_related_posts($related_query, $hospital_name);
                } else {
                    echo '<div class="alert alert-info">Sorry No Related Records Found.</div>';
                }
                ?>
            </div>

            <div id="datasets" class="collapse">
                <?php set_datasets_data($datasets, $record_id); ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php
                    if ($this->session->userdata('id') !== '') {
                        $record_id = $this->session->userdata('id');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('upload_error') != '') {
                        echo $this->session->flashdata('upload_error');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('upload_success') != '') {
                        echo $this->session->flashdata('upload_success');
                    }
                    ?>
                    <?php
                    if ($this->session->flashdata('delete_file') != '') {
                        echo $this->session->flashdata('delete_file');
                    }
                    ?>
                    <div id="relateddocs" class="collapse">
                        <h3>Related Documents</h3>
                        <div class="well">

                            <?php
                            $attributes = array('class' => 'form-inline');
                            echo form_open_multipart("doctor/do_upload_multiple/" . $record_id, $attributes);
                            ?>
                            <!--<form method="post" class="form-inline" enctype="multipart/form-data" action="<?php //echo base_url('index.php/doctor/do_upload/' . $record_id);       ?>">-->
                            <div class="form-group">
                                <input required id="upload_user_file" class="form-control" type="file"
                                       multiple="" name="userfile[]"/>
                                <select class="form-control" name="file_tag" id="file_type_uploads" required>
                                    <option value="0">Select File Tag</option>
                                    <option value="file">Request Form</option>
                                    <option value="case">Macro Image</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">Upload</button>
                            </form>
                            <div class="related-doc-collapse-section">
                                <div class="">
                                    <table class="table custom-table table-striped datatables dataTable no-footer">
                                       
                                        <tr class="">
                                            <th>Documents Name</th>
                                            <th>Type</th>
                                            <th>File Ext</th>
                                            <th>View File</th>
                                            <th>Download File</th>
                                            <th>Uploaded by</th>
                                            <th>Upload On</th>
                                        </tr>
                                        <?php
                                        if (isset($files) && is_array($files)) {
                                            $doctor_id = $this->ion_auth->user()->row()->id;
                                            $record_id = $this->uri->segment(3);
                                            foreach ($files as $file) {
                                                $file_id = $file->files_id;
                                                $file_path = $file->file_path;
                                                $session_data = array(
                                                    'file_path' => $file_path
                                                );
                                                $file_ext = ltrim($file->file_ext, ".");
                                                $modify_ext = strtolower($file_ext);
                                                $this->session->set_userdata($session_data);

                                                $path1 = 'lab_uploads/' . $file->file_name;
                                                $path2 = 'uploads/' . $file->file_name;
                                                if(file_exists($path1)){
                                                    $srcVal = base_url() . $path1;
                                                } else {
                                                    $srcVal = base_url() . $path2;
                                                }

                                                ?>
                                                <tr>
                                                    <td><?php echo $file->title; ?></td>
                                                    <td><?php
                                                        if ($file->is_image == 1) {
                                                            echo '<img src="' . base_url('assets/img/image_type.png') . '" />';
                                                        } else {
                                                            echo '<img src="' . base_url('assets/img/doc_type.png') . '" />';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $file->file_ext; ?></td>
                                                    <td>
                                                        <a class="hover_image" data-exttype="<?php echo $modify_ext; ?>"
                                                           data-imageurl="<?php echo base_url() . 'uploads/' . $file->file_name; ?>"
                                                           href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>"
                                                           target="_blank">
                                                            <img src="<?php echo base_url('assets/img/view.png'); ?>"/>
                                                            <?php echo ucfirst($file->title); ?>
                                                        </a>
                                                        <?php if ($modify_ext === 'png' || $modify_ext === 'jpg') { ?>
                                                            <div style="display:none;"
                                                                 class="hover_image_frame hover_<?php echo $modify_ext; ?>">
                                                                 <button class="btn btn-warning" id="close_hover_image" style="float: right;">
                                                                    Close
                                                                </button>
                                                                 <hr>
                                                                <img src="<?= $srcVal; ?>">
                                                                <hr>
                                                                
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($modify_ext === 'pdf' || $modify_ext === 'txt') { ?>
                                                            <div style="display:none;"
                                                                 class="hover_image_frame hover_<?php echo $modify_ext; ?>">
                                                                 <button class="btn btn-warning" id="close_hover_image" style="float: right;">
                                                                    Close
                                                                </button>
                                                                <hr>
                                                                <iframe width="700" height="500" src="<?= $srcVal; ?>"></iframe>
                                                                
                                                                
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a download
                                                           href="<?php echo $srcVal; ?>"
                                                           target="_blank">
                                                            <img src="<?php echo base_url('assets/img/download-1.png'); ?>"/>
                                                            <?php echo ucfirst($file->title); ?>
                                                        </a>
                                                    </td>


                                                    <td><?php echo ucwords($file->uploaded_by); ?></td>
                                                    <td><?php
                                                        $time = $file->upload_date;
                                                        echo date('M j Y g:i A', strtotime($time));
                                                        ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="further_work" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Further Work</h4>
                        </div>
                        <div class="modal-body">
                            <div class="fw_msg"></div>
                            <form id="further_work_form" method="post">
                                <div class="form-group">
                                    <?php
                                    $req_id = $this->uri->segment(3);
                                    $doc_name = $this->session->userdata('doc_name');
                                    $check_count = 1;
                                    $hospital_id = $request_query[0]->hospital_group_id;
                                    $get_cost_codes['cost_codes'] = $this->Doctor_model->get_cost_codes($hospital_id);

                                    if (!empty($get_cost_codes['cost_codes'])) {
                                        foreach ($get_cost_codes['cost_codes'] as $codes) {
                                            $selected = '';
                                            $fw_levels = '';
                                            if ($codes->ura_cost_code_type == $request_query[0]->fw_levels) {
                                                $selected = 'checked disabled';
                                                $fw_levels = $codes->ura_cost_code_type;
                                            }
                                            if ($codes->ura_cost_code_type == $request_query[0]->fw_immunos) {
                                                $selected = 'checked disabled';
                                                $fw_levels = $codes->ura_cost_code_type;
                                            }
                                            if ($codes->ura_cost_code_type == $request_query[0]->fw_imf) {
                                                $selected = 'checked disabled';
                                                $fw_levels = $codes->ura_cost_code_type;
                                            }
                                            ?>
                                            <input type="hidden" name="<?php echo $codes->ura_cost_code_type; ?>"
                                                   value="<?php echo $fw_levels; ?>">

                                            <label
                                                    for="report_check_<?php echo $check_count; ?>"><?php echo $codes->ura_cost_code_desc; ?></label>
                                            <input id="report_check_<?php echo $check_count; ?>" <?php echo $selected; ?>
                                                   name="<?php echo $codes->ura_cost_code_type; ?>" type="checkbox"
                                                   value="<?php echo $codes->ura_cost_code_type; ?>">
                                            <?php
                                            $check_count++;
                                        }//endforeach
                                    }//endif
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label>Further Work Date</label>
                                    <input type="text" value="" readonly class="form-control" name="furtherwork_date"
                                           id="furtherwork_date" placeholder="Further Work Date">
                                    <input type="hidden" value="" name="furtherwork_date" id="further_work_date_hide">
                                </div>
                                <div class="form-group">
                                    <label for="further_work">Further Work:</label>
                                    <textarea class="form-control" rows="5" id="further_work"
                                              name="description"></textarea>
                                </div>
                                <input type="hidden" name="record_id" value="<?php echo $req_id; ?>">
                                <input type="hidden" name="hospital_group_id" value="<?php echo $hospital_id; ?>">
                                <button type="button" id="fw_submit_btn" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <?php
            $record_id = $this->uri->segment(3);
            $user_id = $this->ion_auth->user()->row()->id;
            ?>
            <div id="display_iframe_pdf" class="modal fade display_iframe_pdf" role="dialog" data-backdrop="static"
                 data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <object type="application/pdf"
                                    data="<?php echo site_url() . '/doctor/generate_report/' . $record_id; ?>" width="100%"
                                    style="height: 80vh;">No Support
                            </object>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                            <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
                                <a class="pull-left" style="cursor: pointer;" id="pdf-icon">
                                    <img data-toggle="tooltip" data-placement="top" title="Click To Publish This Report"
                                         src="<?php echo base_url('assets/img/pdf.png'); ?>">
                                </a>
                            <?php } else { ?>
                                <p class="label label-success pull-left" style="font-size:16px;">Report Already Has Been
                                    Published!</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($request_query[0]->specimen_update_status == 1 && $request_query[0]->specimen_publish_status == 0) { ?>
                <div id="user_auth_popup" class="modal fade user_auth_popup" role="dialog" data-backdrop="static"
                     data-keyboard="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Publish Report</h4>
                            </div>
                            <div class="modal-body">
                                <?php if (empty($request_query[0]->mdt_case) && empty($request_query[0]->mdt_case_status)) { ?>
                                    <div class="well">
                                        <p>Please Select One Of The MDT Option.</p>
                                        <button class="btn btn-sm btn-success" id="close_popups_for_mdt">Add MDT
                                        </button>
                                    </div>
                                <?php } ?>
                                <div id="publish_button"></div>
                                <div class="publish_report_form">
                                    <form class="form" method="post" id="check_auth_pass_form">
                                        <?php
                                        $split_surname = uralensis_get_record_db_detail($record_id, 'f_name');
                                        if (!empty($split_surname)) {
                                            ?>
                                            <div class="form-group ura-surname-field"
                                                 data-recordid="<?php echo $record_id; ?>">
                                                <p><strong>Enter Name Letters.</strong></p>
                                                <p><strong>* </strong><em>Insert patient name from Request Form as final ID
                                                        check.</em></p>
                                                <?php
                                                $dom_array = array();
                                                $splitted_name = str_split(strtolower($split_surname));
                                                $custom_split_data = array();
                                                if (!empty($splitted_name)) {
                                                    foreach ($splitted_name as $key_name => $key_value) {
                                                        $dom_array[] = trim($key_value);
                                                        echo '<input maxlength="1" type="text" data-namekey="' . $key_name . '" data-namevalue="' . $key_value . '" name="checksurname[]"> ';
                                                    }
                                                }
                                                ?>
                                                <input type="hidden" name="surname_data"
                                                       value='<?php echo count($dom_array) - 1; ?>'>
                                            </div>
                                            <div class="ura-pin-area">
                                                <div class="form-group ura-password-fields">
                                                    <p>Enter Your Pin To Publish This Report.</p>
                                                    <input autofocus maxlength="1" type="password" id="auth_pass1"
                                                           name="auth_pass1">
                                                    <input maxlength="1" type="password" name="auth_pass2">
                                                    <input maxlength="1" type="password" name="auth_pass3">
                                                    <input maxlength="1" type="password" name="auth_pass4">
                                                    <input name="request_id" type="hidden"
                                                           value="<?php echo $record_id; ?>">
                                                    <input name="user_id" type="hidden" value="<?php echo $user_id; ?>">
                                                    <?php
                                                    if (empty($request_query[0]->mdt_case) && empty($request_query[0]->mdt_case_status)) {
                                                        echo '<input name="mdt_not_select" type="hidden" value="mdt_uncheck">';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" id="check_pass"
                                                            class="btn btn-warning pull-right">Submit
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <?php
                                        } else {
                                            echo 'Please enter the surname first.';
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div id="request_for_opinion" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="form opinion_cases_form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="col-md-5">
                                    <h4 class="modal-title">Opinion Request</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="checkbox-wrap checkbox-primary">
                                                Internal
                                                <input type="radio" class="internal_external_radio"
                                                       name="internal_opnion_request" value="internal"
                                                       id="internal_opnion_request" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="checkbox-wrap checkbox-primary"><i class="fa fa-paper-plane"></i> External
                                                <input type="radio" class="internal_external_radio"
                                                       name="internal_opnion_request" value="external"
                                                       id="external_opnion_request">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="modal-body">
                                <!--                            --><?php //echo "<pre>";print_r($all_doctors_list);exit;?>

                                <?php $rec_id = $this->uri->segment(3); ?>
                                <!--                            <form class="form opinion_cases_form">-->
                                <input type="hidden" value="<?php echo $specimen_query[0]->patient_initial; ?>"
                                       name="request_patient_initials" id="request_patient_initials">
                                <input type="hidden" value="<?php echo $specimen_query[0]->lab_number; ?>"
                                       name="request_lab_no" id="request_lab_no">
                                <input type="hidden" value="<?php echo $specimen_query[0]->age; ?>" name="request_age"
                                       id="request_age">
                                <input type="hidden" value="<?php echo $specimen_query[0]->dob; ?>" name="request_dob"
                                       id="request_dob">
                                <input type="hidden" value="<?php echo $hospital_name; ?>" name="request_hospital_name"
                                       id="request_hospital_name">
                                <?php $countSp = 1; foreach ($slide_data as $index => $specimen_slide) { ?>
                                    <input type="hidden" value="<?php echo $specimen_slide['specimen_id']; ?>" name="email_specimen_ids[]">
                                <?php } ?>
                                <div class="form-group" id="opinion_internal_email_div">
                                    <label for="opinion_case_doctors">Choose Doctors</label>
                                    <select name="opinion_case_doctors[]" id="opinion_case_doctors"
                                            class="form-control select_multiple_imgs" multiple>
                                        <option value="">Nothing Selected</option>
                                        <?php
                                        if (!empty($all_doctors_list)) {
                                            foreach ($all_doctors_list as $value) { ?>
                                                <option value="<?php echo $value->id; ?>" title="<?php echo $value->profile_picture_path; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
<!--                                <div class="form-group" id="opinion_external_email_div" style="display: none;">-->
<!--                                    <label>Email</label>-->
<!--                                    <input type="text" value="" readonly class="form-control"-->
<!--                                           name="opinion_external_email"-->
<!--                                           id="opinion_external_email" placeholder="External Email">-->
<!--                                </div>-->
                                <div class="form-group col-md-6">
                                    <label>Opinion Request Date</label>
                                    <input type="text" value="" readonly class="form-control" name="opinion_date"
                                           id="opinion_date" placeholder="Opinion Request Date">
                                    <input type="hidden" value="" name="opinion_date" id="opinion_date_hide">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Opinion Request Due Date</label>
                                    <input type="text" value="" readonly class="form-control datepicker_new"
                                           name="opinion_last_date"
                                           id="opinion_last_date" placeholder="Opinion Request Last Date">
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        <label class="checkbox-wrap checkbox-primary" style="margin: 5px 0;">All
                                            <input type="checkbox" name="opinion_all_slides"
                                                   id="opinion_all_slides">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <?php $countSp = 1; foreach ($slide_data as $index => $specimen_slide) { ?>
                                            <div class="col-md-4 form-group mb-3 px-1">
                                                <select multiple data-style="btn-primary btn-rounded" class="selectpicker w-100" name="email_request_specimen_<?php echo $specimen_slide['specimen_id']?>[]" title="Specimen <?php echo $countSp++; ?>">
                                                    <!-- <option data-hidden="true" selected>Specimen <?php// echo $countSp++; ?> :</option> -->
                                                    <?php foreach ($specimen_slide['slides'] as $index => $slide) { ?>
                                                        <option value="<?php echo $slide['url']?>"><?php echo $slide['slide_name']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } ?>

                                        </div>

                                        <!-- <?php //$countSp = 1; foreach ($slide_data as $index => $specimen_slide) { ?>
                                            <div class="col-md-4 nopadding-left dropdown">
                                                <label>Specimen <?php //echo $countSp++; ?></label>
                                                <select class="select2"
                                                        name="email_request_specimen_<?php //echo $specimen_slide['specimen_id']?>[]" multiple>
                                                    <option value="">--Select--</option>
                                                    <?php// foreach ($specimen_slide['slides'] as $index => $slide) { ?>
                                                        <option value="<?php// echo $slide['url']?>"><?php// echo $slide['slide_name']?></option>
                                                    <?php //} ?>
                                                </select>
                                            </div>
                                        <?php //} ?> -->
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label for="opinion_comment">Opinion Comment</label>
                                    <textarea id="opinion_comment" name="opinion_comment" class="form-control" rows="1" style="resize: none"></textarea>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-inline custom_list_opi">
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Consensus Opinion</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Difficult Case</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Not sure if benign or malignant</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Looks inflammatory</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Any dysplasia?</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Wonder if malignant</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Thank You</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"
                                                       class="btn btn-default btn-block btn-comment-text">Think it is benign?</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="record_id" value="<?php echo $rec_id; ?>">
                                <div class="col-md-6 col-md-offset-3 form-group">
                                    <button type="button"
                                            class="btn btn-success btn-lg btn-block assign_to_opinion_case">Assign
                                    </button>
                                </div>
                                <!--                            </form>-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="assign_doctor_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Assign to other doctor</h4>
                        </div>
                        <div class="modal-body">
                            <div class="assign_doctor_and_authorize">
                                <div class="doctor_assign_msg"></div>
                                <form id="doctor_assign_form">
                                    <select class="form-control" name="assign_doctor" id="assign_doctor">
                                        <option value="0">Choose Doctor</option>
                                        <?php
                                        if (!empty($list_doctors)) {
                                            foreach ($list_doctors as $value) {
                                                ?>
                                                <option value="<?php echo $value->id; ?>">
                                                    <?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="teaching_cpc_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Education and CPC</h4>
                        </div>
                        <div class="modal-body">
                            <form id="teach_and_mdt_form" class="form teach_and_mdt_form">
                                <div class="teach_mdt_cpc_msg"></div>
                                <div class="form-group">
                                    <label for="education_cats">Education</label>
                                    <select name="education_cats" id="education_cats" class="form-control">
                                        <option value="0">Select Education Category</option>
                                        <?php
                                        if (!empty($education_cats)) {
                                            foreach ($education_cats as $cats) {
                                                $selected = '';
                                                if ($cats->ura_tec_mdt_id === $request_query[0]->teaching_case) {
                                                    $selected = 'selected';
                                                }
                                                echo '<option ' . $selected . ' value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cpc_cats">CPC</label>
                                    <select name="cpc_cats" id="cpc_cats" class="form-control">
                                        <option value="0">Select CPC Category</option>
                                        <?php
                                        if (!empty($cpc_cats)) {
                                            foreach ($cpc_cats as $cats) {
                                                echo '<option value="' . $cats->ura_tec_mdt_id . '">' . $cats->ura_tech_mdt_cat . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="record_id" id="record_id"
                                           value="<?php echo $record_id; ?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="record_download_history" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Record Download History</h4>
                        </div>
                        <div class="modal-body">
                            <table class='table table-bordered'>
                                <tr>
                                    <th>ID</th>
                                    <th>Record</th>
                                    <th>Timestamp</th>
                                </tr>
                                <?php
                                if (!empty($download_history)) {
                                    foreach ($download_history as $key => $value) {
                                        $timestamp = '';
                                        if (!empty($value['ura_bulk_report_timestamp'])) {
                                            $timestamp = date('d-m-Y H:i:s', $value['ura_bulk_report_timestamp']);
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $value['ura_bulk_report_history']; ?></td>
                                            <td><?php echo $value['ura_bulk_report_record_data']; ?></td>
                                            <td><?php echo $timestamp; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php record_history($record_history, $userid, $record_add_timestamp, $add_full_name); ?>

            <div id="mdt_data_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="float:left;width:100%;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Assign to MDT</h4>
                        </div>
                        <div class="modal-body">
                            <div class="record_detail_page">
                                <?php
                                $recordid = $this->uri->segment(3);
                                display_mdt($mdt_cats, $recordid, $request_query, $mdt_assign_dates);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Show this modal when user wants to add message-->
            <div id="mdt_message_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content" style="width:100%;float:left;">
                        <div class="modal-header">
                            <h4 class="modal-title">MDT Message</h4>
                        </div>
                        <div class="modal-body">

                            <form class="form" id="mdt_message_form">
                                <div class="form-group">
                                    <label for="add_mdt_message">Add MDT Message</label>
                                    <textarea class="form-control" id="add_mdt_message" name="mdt_message"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="record_id" value="<?php echo $this->uri->segment(3); ?>">
                                    <button class="btn btn-primary" id="add_mdt_msg_btn">Add Message</button>
                                    <button class="btn btn-warning pull-right" id="leave_mdt_notes_msg_btn">Leave
                                        this.
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Show this modal when user wants to add message-->
            <div id="add_supplementary" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Supplementary</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            $attributes = array('id' => 'addiotional', 'class' => 'addiotional');
                            echo form_open(site_url() . "/doctor/additional_work", $attributes);
                            ?>
                            <!-- <form method="post" action="<?php echo site_url('doctor/additional_work'); ?>">-->
                            <input type="hidden" name="additional_id" value="0" id="additional_id"/>
                            <div class="form-group">
                                <label for="additional_work">Add Supplementary Report:</label>
                                <textarea class="form-control" rows="5" id="additional_work"
                                          name="additional_description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <?php if (!empty($request_query[0]->additional_work)) { ?>
                            <br/>
                            <table class='table table-bordered'>
                                <tr>
                                    <th>Description</th>
                                    <th>Timestamp</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                if (!empty($request_query[0]->additional_work)) {
                                    foreach ($request_query[0]->additional_work as $key1 => $value) {
                                        $timestamp = '';
                                        if (!empty($value['additional_work_time'])) {
                                            $timestamp = date('d-m-Y H:i:s', strtotime($value['additional_work_time']));
                                        }
                                        ?>
                                        <tr id="additional_row<?php echo $value['additional_id'];  ?>">
                                            <td><?php echo $value['description']; ?></td>
                                            <td><?php echo $timestamp; ?></td>
                                            <td style="text-align:center; padding-right: 10px;">
                                                <a title="Edit" href="javascript:void(0)" class="edit_additional_work" data-description="<?php echo $value['description']; ?>" data-id="<?php echo $value['additional_id'] ?>"><i class="fa fa-pencil m-r-5"></i> </a>
                                                <a title="Delete" href="javascript:void(0)" class="delete_additional_work" data-id="<?php echo $value['additional_id'] ?>"><i class="fa fa-trash-o m-r-5"></i> </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php show_supplementary_modal($record_id, $supplementary_query); ?>
        </div>
    </div>
    <div class="tg-haslayout">
        <div class="container-fluid tab-full" style="padding-left: 30px;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php
                    if (empty($opinion_data)) {
                        $opinion_data = array();
                    }

                    $hospital_id = $request_query[0]->hospital_group_id;
                     $get_cost_codes['cost_codes'] = $this->Doctor_model->get_cost_codes_by_block($hospital_id);
//$hospital_id = 87;
                    get_specimens($specimen_query, $request_query, $request_query[0]->uralensis_request_id, $get_cost_codes['cost_codes'], $opinion_data, $specimen_accepted_by, $specimen_assisted_by, $specimen_block_checked_by, $specimen_cutup_by, $specimen_labeled_by, $specimen_qcd_by, $slide_data, $specimen_blocks, $testListArr, $categoriesArr);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }
            if (!empty($request_query[0]->comment_section)) {
                comment_section($record_id, $request_query, $opinion_data);
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }

            if (!empty($request_query[0]->special_notes)) {
                if (class_exists('Notes')) {
                    Notes::special_notes($record_id, $request_query, $opinion_data);
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (empty($opinion_data)) {
                $opinion_data = array();
            }
            if (empty($opinion_data_reply['opinion_data_reply'])) {
                $opinion_data_reply = array();
            }
            if (class_exists('Opinion_Cases')) {
                Opinion_Cases::display_comments($record_id, $opinion_data, $opinion_data_reply);
            }
            ?>
        </div>
    </div>
    
    </div>




<div id="view_doc" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart(uri_string(), array('id' => 'edit_cv_appraisal', 'name' => 'edit_cv_appraisal')); ?>
            <input type="hidden" name="edit_cv_appraisal" value="1">
            <div class="modal-body" id="doc_embed">
                <?php print $file_path = $cv_appr_data['cv_doc_file_name']; ?>

            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <hr>
                    <span id="total_docs"
                          style="float:left; padding: 0px 0px 10px 0px">Total Uploaded Document(s): 0</span>
                </div>
                <div class="col-md-6">
                    <a href="javascript:void(0)" class="btn btn-primary pull-left" id="prev_button">Previous</a>
                </div>
                <div class="col-md-6">
                    <a href="javascript:void(0)" class="btn btn-primary pull-right" id="next_button">Next</a>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div id="capture_webcam" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart("doctor/do_upload_captured/" . $record_id, array('id' => 'form_capture_webcam_image', 'name' => 'form_capture_webcam_image')); ?>
            <div class="modal-body" id="doc_embed">
                <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>">
                <input type="hidden" name="record_id" id="record_id" value="<?php echo $record_id; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br/>
                        <input type="button" class="btn btn-primary" value="Take Snapshot" onClick="take_snapshot()">
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                    <div class="col-md-6">
                        <div id="results" style="text-align: center">Your captured image will appear here...</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <hr>
                    <button id="submit_captured_photo" class="btn btn-primary">Save Image</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div id="add_clinician_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Clinician</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body edt_modal_bdy">
                <div class="col-md-12">
                    <?php echo form_open_multipart("laboratory/create_clinician", array('id' => 'create_clinician_form')); ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">First Name</label>
                                <input type="hidden" name="record_id" value="<?= $record_id; ?>">
                                <input type="text" name="first_name" placeholder="Enter first name" class="form-control" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Last Name</label>
                                <input type="text" name="last_name" placeholder="Enter last name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Email</label>
                                <input type="text" name="email" placeholder="Enter email address" class="form-control check_email2">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Provider No</label>
                                <input type="text" name="provider_no" placeholder="Enter Provider No" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row"></div>
                    <div class="clearfix"></div>
                    <div class="row mt-3">
                        <div class="col-sm-2" style="margin-left: 45%">
                            <button class="btn btn-primary" type='submit'>Save</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_pathologist_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Pathologist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body edt_modal_bdy">
                <div class="col-md-12">
                    <?php echo form_open_multipart("laboratory/create_pathologist", array('id' => 'create_pathologist_form')); ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">First Name</label>
                                <input type="hidden" name="record_id" value="<?= $record_id; ?>">
                                <input type="text" name="first_name" placeholder="Enter first name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Last Name</label>
                                <input type="text" name="last_name" placeholder="Enter last name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label class="focus-label">Email</label>
                                <input type="text" name="email" placeholder="Enter email address" class="form-control check_email2">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Fee / Case</label>
                                <input type="text" name="fee_per_case" placeholder="Enter fee per case" class="form-control numberonly" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="focus-label">Fee / Specimen</label>
                                <input type="text" name="fee_per_specimen" placeholder="Enter fee per specimen" class="form-control numberonly" />
                            </div>
                        </div>
                    </div>
                    <div class="row"></div>
                    <div class="clearfix"></div>
                    <div class="row mt-3">
                        <div class="col-sm-2" style="margin-left: 45%">
                            <button class="btn btn-primary" type='submit'>Save</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php block_history($request_query[0]->block_history, $userid, $record_add_timestamp, $add_full_name); ?>
<script>
    var micro_data = <?php echo json_encode($micro_codes_data); ?>;
</script>
<script>
$(document).ready(function () {

    $(document).on('click',"#save_patient2", function () 
    {
        
        //alert("yes");
        //$(this).closest(".update_opinion").submit();
    });

    $(document).find('.numberonly').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });
});



</script>

<script defer type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    function viewRecord(id) {
        var url = new URL(
            "<?php echo base_url('/doctor/doctor_record_detail/' . $request_query[0]->uralensis_request_id . '/view'); ?>"
        );
        url.searchParams.append('slide', id);
        window.location.href = url.href;
        console.log(url.href);
    }

    function GenerateReport(){
        jQuery.ajax({
                    type: "POST",
                    url: "<?php echo site_url() . '/doctor/generate_report/' . $request_query[0]->uralensis_request_id; ?>",
                    data: {'actionType': "regenerate", [csrf_name]: csrf_hash},
                    success: function (response) {
                        jQuery.sticky("Approved changes sucessfully!!!", {classList: 'success', speed: 200, autoclose: 5000});
                    }
                });
    }

    $(document).ready(function () {
        $(".cust_dd").click(function(){
            $(".cust_dd_show").toggleClass("hidden");
            $(".cust_dd i.la-ellipsis-v").toggleClass("la-minus");
        });
        // $(".new_edit").click(function(){
        //     $(this).parent().parent().parent().parent().parent().parent().children().toggleClass("hidden");
        //     $(this).parent().parent().parent().parent().parent().removeClass("hidden");
        // });
        $(".btn_collapse_all").click(function(){
            $(".card").toggleClass("show");
            $(".card.show_hidden").toggleClass("hidden");
            $(".btn_collapse_all img").toggleClass("show");
        });
        $(".p_id_icon").click(function(){
            $("#table-view-patient").toggleClass("hidden"); 
            $("#edit-view-patient").toggleClass("show");

        });
        $(".r_id_icon").click(function(){
            $("#table-view-request").toggleClass("hidden"); 
            $("#edit-view-request").toggleClass("show");
        });

         $(".form_input_container input").focusin(function(){
            $(this).parent().addClass("focused");
        });
        $(".form_input_container input").focusout(function(){
            $(this).parent().removeClass("focused");
        });
        $(".checv_up_down").click(function()
		{
            $(this).parent().find('.make_editable').toggleClass("show");
            $(this).parent().find('.btn_save_sec').removeClass("show");
			$(this).parent().find('.las').addClass("la-eye-slash");
            $(this).parent().find('.las').removeClass("la-eye");
			
        });
		
        $(".checv_up_down .la-eye-slash").click(function()
		{
            $(this).removeClass("fa-chevron-down");
            $(this).removeClass("fa-chevron-up"); 
            $(this).toggleClass("la-eye-slash");
            $(this).toggleClass("la-eye");
			$(this).parent().find('.las').addClass("la-eye");
            $(this).parent().find('.las').removeClass("la-eye-slash");
        });
        $("#p_edit_area").click(function()
        {
            $(this).parent().find('.btn_save_sec').toggleClass("show");
            $('#p_edit_area').hide();
            
        });
        
        
        var data = JSON.parse('<?php echo json_encode($slide_data); ?>');


        $('.doctor-detail-specimen-tab').click(function () {
            var id = $(this).attr('id');
            var index = id.split("-")[4];
            console.log(index);
            $(".slide-image-container").hide();
            $("#slide-image-container-" + index).show();
        });

        $('#slide-carousel').slick({
            slidesToShow: 6,
            slidesToScroll: 6,
        });
        $("#slide-carousel").show();

        $(".thumbnail_slide_img").on('load', function () {
            var height = $(this).height();
            var width = $(this).width();
            if (height == 0)
                return;
            var ratio = height / width;
            if (width > 100) {
                width = 100;
                height = width * ratio;
            }
            $(this).height(height);
            $(this).width(width);
        });

        setTimeout(function () {
            $(".thumbnail_slide_img").each(function () {
                var height = $(this).height();
                var width = $(this).width();
                if (height == 0)
                    return;
                var ratio = height / width;
                if (width > 100) {
                    width = 100;
                    height = width * ratio;
                }
                $(this).height(height);
                $(this).width(width);
            });
        }, 1000);

        setTimeout(function () {
            $("#bridgehead-button").off();
            $("#bridgehead-button").click(function () {
                window.open("<?php echo BRIDGEHEAD_URL . '' . $request_query[0]->nhs_number; ?>", '_blank');
            });
        }, 500);

        jQuery('.delete_additional_work').bind('click', function (e) {
            e.preventDefault();
            if (!confirm('Are You Sure You Want To Delete?')) {
                return false;
            } else {
                var _this = $(this);
                var record_id = _this.data('id');
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/index.php/doctor/deleteAdditionalWork'); ?>",
                    data: {'addtional_id': record_id, [csrf_name]: csrf_hash},
                    dataType: "json",
                    success: function (response) {
                        if (response.type === 'success') {
                            $('#additional_row'+record_id).remove();
                            jQuery.sticky(response.msg, {classList: 'success', speed: 200, autoclose: 5000});
                        } else {
                            jQuery.sticky(response.msg, {classList: 'important', speed: 200, autoclose: 5000});
                        }
                    }
                });
            }
        });

        jQuery('.edit_additional_work').bind('click', function (e) {
            e.preventDefault();
            var _this = $(this);
            var record_id = _this.data('id');
            var description = _this.data('description');
            $('#additional_id').val(record_id);
            $('#additional_work').val(description);
        });
    });

    function embed_doc() {
        var base_url = '<?php echo base_url(); ?>';
        var files = <?php echo json_encode($files); ?>;
        var total_files = files.length;
        // console.log(files[0]); return false;
        //first_file = base_url + 'lab_uploads/' + files[0]['file_name'];
        first_file = base_url + 'lab_uploads/' + files[0]['file_name'];


        var embed_div = document.getElementById('doc_embed');
        var total_docs_span = document.getElementById('total_docs');
        total_docs_span.innerHTML = "";
        total_docs_span.innerHTML = "Total Uploaded Document(s): " + total_files;

        embed_div.innerHTML = "";
        embed_div.innerHTML = "<embed src='" + first_file + "' name='embeded_doc'  frameborder='0' width='100%' height='600px'>";

        var i = 0;

        function nextItem() {
            i = i + 1; // increase i by one
            i = i % files.length; // if we've gone too high, start from `0` again
            return base_url + 'lab_uploads/' + files[i]['file_name'];
            // return files[i]; // give us back the item of where we are now
        }

        function prevItem() {
            if (i === 0) { // i would become 0
                i = files.length; // so put it at the other end of the array
            }
            i = i - 1; // decrease by one
            return base_url + 'lab_uploads/' + files[i]['file_name'];
            // return files[i]; // give us back the item of where we are now
        }

        document.getElementById('prev_button').addEventListener(
            'click', // we want to listen for a click
            function (e) { // the e here is the event itself
                var prev_file = prevItem();
                embed_div.innerHTML = "";
                embed_div.innerHTML = "<embed src='" + prev_file + "' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='600px'>";

            }
        );

        document.getElementById('next_button').addEventListener(
            'click', // we want to listen for a click
            function (e) { // the e here is the event itself
                var next_file = nextItem();
                embed_div.innerHTML = "";
                embed_div.innerHTML = "<embed src='" + next_file + "' name='embeded_doc' type='application/pdf' frameborder='0' width='100%' height='600px'>";

            }
        );

    }
</script>
<script>
window.onscroll = function() {myFunction(); SpecimnenScrollFunction() ;};

var headerne = document.getElementById("myHeader");
var sticky = headerne.offsetTop;
var specimentHeaderne = document.getElementById("specimentHeader");
var specimentsticky = specimentHeaderne.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    headerne.classList.add("sticky");
  } else {
    headerne.classList.remove("sticky");
  }
}

function SpecimnenScrollFunction() {
  if (window.pageYOffset > specimentsticky) {
    specimentHeaderne.classList.add("specimen_sticy");
  } else {
    specimentHeaderne.classList.remove("specimen_sticy");
  }
}
</script>

<style>

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 102px;
}

.sticky {
    top: 60px;
    width: 100%;
    z-index: 1000;
    /* background: #fff; */
}

    </style>                