<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
function manage_documents($record_id, $doctor_id) {
    ?>
    <div class="row">
        <div class="col-md-12">
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
                    <form method="post" class="form-inline" enctype="multipart/form-data" action="<?php echo base_url('index.php/doctor/do_upload/' . $record_id); ?>">

                        <div class="form-group">

                            <input required id="upload_user_file" class="form-control" type="file" name="userfile" />
                        </div>
                        <button type="submit" class="btn btn-default">Upload</button>
                    </form>
                    <div id="files">
                        <table class="table table-striped">
                            <h3>Files</h3>
                            <tr class="bg-info">
                                <th>File Name</th>
                                <th>Type</th>
                                <th>File Ext</th>
                                <th>View File</th>
                                <th>Download File</th>
                                <th>Delete</th>
                                <th>Uploaded by</th>
                                <th>Upload On</th>
                            </tr>
                            <?php
                            if (isset($files) && is_array($files)) {

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
                                            <a href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/view.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a download href="<?php echo base_url() . 'uploads/' . $file->file_name; ?>" target="_blank">
                                                <img src="<?php echo base_url('assets/img/download.png'); ?>" />
                                                <?php echo ucfirst($file->title); ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($doctor_id == $file->user_id) : ?>
                                                <a href="<?php echo site_url() . '/doctor/delete_record_files?file_id=' . $file_id . '&record_id=' . $record_id; ?>">
                                                    <img src="<?php echo base_url('assets/img/delete.png'); ?>" />
                                                </a>
                                            <?php else : ?>
                                                <span>No Access</span>
                                            <?php endif; ?>

                                        </td>
                                        <td><?php echo ucwords($file->user); ?></td>
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
    <?php
}
