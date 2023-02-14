<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/**
 * Get Session Variable
 * 
 */
$record_id = '';
if ($this->session->userdata('record_id') !== '') {
    $record_id = $this->session->userdata('record_id');
}
?>
<style type="text/css">
    .nav-tabs.nav-tabs-solid>li {
        margin-bottom: 6px;
    }

    .nav-tabs.nav-tabs-solid>li>a {
        color: #fff;
        margin-left: 10px;
        font-size: 20px;
        font-family: inherit;
        border-radius: 0px !important;
        padding: 15px 20px;
        float: left;
    }
    .tooltipIcon img {
        max-width: 34px;
        margin-top: 10px;
    }
    
    .btn-link:hover{
        text-decoration: none;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 45px;
    }

    #template_preview .card {
        min-height: 475px;
    }

    .custom_card .card {
        min-height: 597px;
    }

    span.tooltipIcon {
        position: absolute;
        top: 0px;
        left: 17px;
        display: none;
    }

    button.add_temp {
        height: auto;
        right: 0;
        padding: 0 12px;
        width: auto;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .fa-file-o {
        position: absolute;
        left: 20px;
        width: 40px;
        text-align: center;
        font-size: 32px;
        z-index: 99;
        top: 15px;
    }
    .page-header .breadcrumb {
        background-color: transparent;
        color: #6c757d;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 0;
        padding: 0;
    }

    .page-header .breadcrumb a {
        color: #333;
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }


    #barcode_no {
        height: 50px;
    }

    .nav-tabs.nav-tabs-solid>li>.dropdown-action {
        float: right;
    }

    /*.blue-border {
    border: 1px solid blue !important;
}*/

    .dropdown-menu-right a.dropdown-item {
        background: transparent;
        color: #222;
        font-size: 14px;
    }

    .nav-tabs.nav-tabs-solid>li>a:hover,
    .nav-tabs.nav-tabs-solid>li>a:focus {
        background-color: #00c5fb !important;
        border-color: #00c5fb !important;
        color: #fff !important;
    }

    .list_view {
        display: none;
    }

    .show {
        display: block;
    }

    .hide {
        display: none;
    }

    .cog-class {
        line-height: 1;
        margin-top: 10px;
    }

    .fa-th:before {
        content: "\f00a" !important;
    }

    a.action-icon.dropdown-toggle {
        background: #1b75cd;
        color: #fff;
        padding: 0 10px;
        height: 51px;
        border-radius: 0 !important;
        padding: 13px;
    }

    a.action-icon.dropdown-toggle:hover,
    a.action-icon.dropdown-toggle:focus {
        background-color: #00c5fb !important;
        border-color: #00c5fb !important;
        color: #fff !important;
    }

    .card {
        margin-bottom: 0;
    }

    .accordion-button {
        font-size: 1.5rem;
    }

    #patient-table tbody tr:hover {
        background-color: lightblue;
        cursor: pointer;
    }

    .page-wrapper.sidebar-patient {
        padding: 75px 30px 0;
    }

    .danger-text { 
        color: red;
    }

    #speciality-container {
        display: flex;
        flex-wrap: wrap;
    }

    .speciality-box {
        min-width: 200px;
        margin-right: 20px;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 5px 5px 20px rgba(200, 200, 200, 0.7);
        cursor: pointer;
    }

    .selected-speciality {
        background-color: lightblue;
    }

    #next-button {
        position:absolute;
        bottom: 0;
        right: 10px;
        display: none;
    }

    .profile-widget{
        padding: 50px 15px;

    }

    .profile-img{
        width: auto;
        height: auto;
        margin-bottom: 20px;
    }

    .danger-text { 
        color: red;
    }

    #speciality-container {
        display: flex;
        flex-wrap: wrap;
    }


    .speciality-box {
        min-width: 200px;
        margin-right: 20px;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 5px 5px 20px rgba(200, 200, 200, 0.7);
        cursor: pointer;
    }

    .selected-speciality {
        background-color: lightblue;
    }


</style>
<div class="row">
    <div class="col-md-12">
        
        <h3 class="page-title">Attached Documents</h3>
        <br />
        <?php
        if ($this->session->flashdata('upload_error') != '') {
            echo html_purify($this->session->flashdata('upload_error'));
        }
        ?>
        <?php
        if ($this->session->flashdata('upload_success') != '') {
            echo html_purify($this->session->flashdata('upload_success'));
        }
        ?>
        <?php
        if ($this->session->flashdata('delete_file') != '') {
            echo html_purify($this->session->flashdata('delete_file'));
        }
        ?>
        <form method="post" class="form-inline" enctype="multipart/form-data" action="<?php echo base_url('index.php/institute/do_upload_download_section_files/' . intval($record_id)); ?>">
            <div class="form-group">
                <input required id="upload_user_file" class="form-control" type="file" name="userfile" />
            </div>
            <button type="submit" class="btn btn-default">Upload</button>
        </form>
        <div id="files">
            <table class="table table-striped">
                <h3>Files</h3>
                <tr style="background-color:#fff">
                    <th>File Name</th>
                    <th>Type</th>
                    <th>File Ext</th>
                    <th>View File</th>
                    <th>Download File</th>
                    <th>Delete</th>
                    <th>Uploaded by</th>
                    <th>Upload on</th>
                </tr>
                <?php
                if (isset($files) && is_array($files)) {
                    $hospital_id = $this->ion_auth->user()->row()->id;
                    foreach ($files as $file) {
                        $file_id = $file->files_id;
                        $file_path = $file->file_path;
                        $session_data = array(
                            'file_path' => $file_path
                        );
                        $this->session->set_userdata($session_data);
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
                                <a href="<?php echo base_url() . 'uploads/' . html_purify($file->file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                    <?php echo ucfirst($file->title); ?>
                                </a>
                            </td>
                            <td>
                                <a download href="<?php echo base_url() . 'uploads/' . html_purify($file->file_name); ?>" target="_blank">
                                    <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                    <?php echo ucfirst($file->title); ?>
                                </a>
                            </td>
                            <td>
                                <?php if($hospital_id == $file->user_id) : ?>
                                <a href="<?php echo site_url() . '/institute/delete_download_section_files/' . intval($file_id); ?>">
                                    <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                </a>
                                <?php else :  ?>
                                <span>No Access</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo ucwords($file->user); ?></td>
                            <td><?php
                            $time = $file->upload_date;
                            echo date('M j Y g:i A', strtotime($time)); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        </div>

    </div>
</div>